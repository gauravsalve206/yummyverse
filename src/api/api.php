<?php
header("Content-Type: application/json");

// DB Connection
$config = require __DIR__ . '/config.php';
$DB_servername = $config['DB_HOST'];
$DB_username = $config['DB_USER'];
$DB_password = $config['DB_PASS'];
$DB_database = $config['DB_NAME'];


function getPDOConnection() {
    global $DB_servername, $DB_username, $DB_password, $DB_database;
    try {
        return new PDO("mysql:host=$DB_servername;dbname=$DB_database;charset=utf8", $DB_username, $DB_password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(["error" => "Database connection failed"]);
        exit();
    }
}

function searchById($recipe_id) {
    $pdo = getPDOConnection();
    $sql = "SELECT 'local' AS source, r.recipe_id AS idMeal, r.name AS strMeal, r.instructions AS strInstructions, r.image_url AS strMealThumb, r.video_url AS strYoutube, c.name AS strCategory, a.name AS strArea
            FROM recipes r
            LEFT JOIN categories c ON r.category_id = c.category_id
            LEFT JOIN areas a ON r.area_id = a.area_id
            WHERE r.recipe_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$recipe_id]);
    $recipe = $stmt->fetch();
    if ($recipe) {
        $sql_ingredients = "SELECT i.name AS ingredient, ri.measure FROM recipe_ingredients ri
                            LEFT JOIN ingredients i ON ri.ingredient_id = i.ingredient_id
                            WHERE ri.recipe_id = ?";
        $stmt_ingredients = $pdo->prepare($sql_ingredients);
        $stmt_ingredients->execute([$recipe_id]);
        $ingredients = [];
        $measures = [];
        $counter = 1;
        while ($row = $stmt_ingredients->fetch()) {
            $ingredients["strIngredient" . $counter] = $row['ingredient'];
            $measures["strMeasure" . $counter] = $row['measure'];
            $counter++;
        }
        for ($i = $counter; $i <= 20; $i++) {
            $ingredients["strIngredient" . $i] = null;
            $measures["strMeasure" . $i] = null;
        }
        return json_encode(["meals" => [array_merge($recipe, $ingredients, $measures)]]);
    }
    return json_encode(["meals" => null]);
}

function searchByIngredients($ingredient_names) {
    $pdo = getPDOConnection();
    $placeholders = implode(',', array_fill(0, count($ingredient_names), '?'));
    $sql = "SELECT DISTINCT 'local' AS source, r.recipe_id AS idMeal, r.name AS strMeal, r.instructions AS strInstructions, r.image_url AS strMealThumb, r.video_url AS strYoutube, c.name AS strCategory, a.name AS strArea
            FROM recipes r
            LEFT JOIN categories c ON r.category_id = c.category_id
            LEFT JOIN areas a ON r.area_id = a.area_id
            JOIN recipe_ingredients ri ON r.recipe_id = ri.recipe_id
            JOIN ingredients i ON ri.ingredient_id = i.ingredient_id
            WHERE LOWER(i.name) IN ($placeholders)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array_map('strtolower', $ingredient_names));
    $recipes = $stmt->fetchAll();
    return json_encode(["meals" => $recipes ?: null]);
}

function searchByName($recipe_name) {
    $pdo = getPDOConnection();
    $sql = "SELECT 'local' AS source, r.recipe_id AS idMeal, r.name AS strMeal, r.instructions AS strInstructions, r.image_url AS strMealThumb, r.video_url AS strYoutube, c.name AS strCategory, a.name AS strArea
            FROM recipes r
            LEFT JOIN categories c ON r.category_id = c.category_id
            LEFT JOIN areas a ON r.area_id = a.area_id
            WHERE r.name LIKE ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(["%$recipe_name%"]);
    $local_recipes = $stmt->fetchAll();
    $api_url = "https://www.themealdb.com/api/json/v1/1/search.php?s=" . urlencode($recipe_name);
    $api_response = file_get_contents($api_url);
    $mealdb_recipes = json_decode($api_response, true)['meals'] ?? [];
    return json_encode(["meals" => array_merge($local_recipes, $mealdb_recipes)]);
}

function getAllRecipes() {
    $pdo = getPDOConnection();
    $sql = "SELECT 'local' AS source, r.recipe_id AS idMeal, r.name AS strMeal, r.instructions AS strInstructions, r.image_url AS strMealThumb, r.video_url AS strYoutube, c.name AS strCategory, a.name AS strArea
            FROM recipes r
            LEFT JOIN categories c ON r.category_id = c.category_id
            LEFT JOIN areas a ON r.area_id = a.area_id";
    $stmt = $pdo->query($sql);
    $recipes = $stmt->fetchAll();
    return json_encode(["meals" => $recipes ?: null]);
}

if ($_SERVER['REQUEST_METHOD'] === "GET") {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        echo is_numeric($id) ? searchById($id) : json_encode(["error" => "Invalid recipe ID"]);
    }
    if (isset($_GET['ing'])) {
        echo searchByIngredients(explode(",", strtolower($_GET['ing'])));
    }
    if (isset($_GET['s'])) {
        echo searchByName($_GET['s']);
    }
    if (isset($_GET['all'])) {
        echo getAllRecipes();
    }
} else {
    http_response_code(405);
    echo json_encode(["error" => "Only GET requests are allowed"]);
}

<?php
header("Content-Type: application/json");
//DB Connection
$DB_servername = "localhost";
$DB_username = "root";
$DB_password = "";
$DB_database = "yummyverse";

//search recipe by id
function searchById($recipe_id)
{
    global $DB_database, $DB_password, $DB_servername, $DB_username;
    $conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_database);
    // Check connection
    if ($conn->connect_error) {
        http_response_code(500); // Internal Server Error
        echo json_encode(["error" => "Database connection failed"]);
        exit();
    }
    // SQL query to fetch recipe details
    $sql = "SELECT 
                'local' AS source,
                r.recipe_id AS idMeal,
                r.name AS strMeal,
                r.instructions AS strInstructions,
                r.image_url AS strMealThumb,
                r.video_url AS strYoutube,
                c.name AS strCategory,
                a.name AS strArea
            FROM recipes r
            LEFT JOIN categories c ON r.category_id = c.category_id
            LEFT JOIN areas a ON r.area_id = a.area_id
            WHERE r.recipe_id = ?";
    // Execute the query
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $recipe_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        //store recipe details of table recipe in varaible recipe
        $recipe = $result->fetch_assoc();

        // Fetch ingredients and measures
        $sql_ingredients = "SELECT i.name AS ingredient, ri.measure 
                            FROM recipe_ingredients ri
                            LEFT JOIN ingredients i ON ri.ingredient_id = i.ingredient_id
                            WHERE ri.recipe_id = ?";
        $stmt_ingredients = $conn->prepare($sql_ingredients);
        $stmt_ingredients->bind_param("i", $recipe_id);
        $stmt_ingredients->execute();
        $result_ingredients = $stmt_ingredients->get_result();

        // Create ingredient and measure fields dynamically
        $ingredients = [];
        $measures = [];
        $counter = 1;
        while ($row = $result_ingredients->fetch_assoc()) {
            $ingredients["strIngredient" . $counter] = $row['ingredient'];
            $measures["strMeasure" . $counter] = $row['measure'];
            $counter++;
        }

        // Fill remaining keys with null
        for ($i = $counter; $i <= 20; $i++) {
            $ingredients["strIngredient" . $i] = null;
            $measures["strMeasure" . $i] = null;
        }

        // Merge ingredients and measures with recipe
        $response = array_merge(
            ["meals" => [
                array_merge($recipe, $ingredients, $measures)
            ]]
        );
        // Close the database connection before returning the response
        $stmt->close();
        $stmt_ingredients->close();
        $conn->close();
        //return the responce in json format
        return json_encode($response);
    } else {
        $stmt->close();
        $conn->close();
        //if not found show meals = null
        return json_encode(["meals" => null]);
    }
}
//search recipies by ingredients names

function searchByIngredients($ingredient_names)
{
    global $DB_database, $DB_password, $DB_servername, $DB_username;
    $conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_database);
    // Check connection
    if ($conn->connect_error) {
        http_response_code(500); // Internal Server Error
        echo json_encode(["error" => "Database connection failed"]);
        exit();
    }
    // Convert ingredient names into a format for SQL IN clause
    // to create this SELECT * FROM ingredients WHERE name IN (?, ?, ?)
    $placeholders = implode(',', array_fill(0, count($ingredient_names), '?'));

    // SQL query to find recipes that use the specified ingredients
    $sql = "SELECT DISTINCT 
    'local' AS source,
    r.recipe_id AS idMeal,
    r.name AS strMeal,
    r.instructions AS strInstructions,
    r.image_url AS strMealThumb,
    r.video_url AS strYoutube,
    c.name AS strCategory,
    a.name AS strArea
    FROM recipes r
    LEFT JOIN categories c ON r.category_id = c.category_id
    LEFT JOIN areas a ON r.area_id = a.area_id
    JOIN recipe_ingredients ri ON r.recipe_id = ri.recipe_id
    JOIN ingredients i ON ri.ingredient_id = i.ingredient_id
    WHERE LOWER(i.name) IN ($placeholders)
    ";

    $stmt = $conn->prepare($sql);

    // Bind parameters dynamically
    $types = str_repeat("s", count($ingredient_names)); // "s" for string type
    $stmt->bind_param($types, ...$ingredient_names);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $recipes = [];
        // create an array of recipies
        while ($row = $result->fetch_assoc()) {
            $recipes[] = $row;
        }
        $stmt->close();
        $conn->close();
        return json_encode(["meals" => $recipes]);
    } else {
        $stmt->close();
        $conn->close();
        return json_encode(["meals" => null]);
    }
}

function searchByName($recipe_name)
{
    global $DB_database, $DB_password, $DB_servername, $DB_username;

    // Connect to the database
    $conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_database);
    if ($conn->connect_error) {
        http_response_code(500); // Internal Server Error
        echo json_encode(["error" => "Database connection failed"]);
        exit();
    }

    // Search in the local database
    $sql = "SELECT 
                'local' AS source,
                r.recipe_id AS idMeal,
                r.name AS strMeal,
                r.instructions AS strInstructions,
                r.image_url AS strMealThumb,
                r.video_url AS strYoutube,
                c.name AS strCategory,
                a.name AS strArea
            FROM recipes r
            LEFT JOIN categories c ON r.category_id = c.category_id
            LEFT JOIN areas a ON r.area_id = a.area_id
            WHERE r.name LIKE CONCAT('%', ?, '%')";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $recipe_name);
    $stmt->execute();
    $result = $stmt->get_result();

    $local_recipes = [];
    while ($row = $result->fetch_assoc()) {
        $local_recipes[] = $row;
    }

    // Close the local database connection
    $stmt->close();
    $conn->close();

    // Fetch from MealDB API
    $api_url = "https://www.themealdb.com/api/json/v1/1/search.php?s=" . urlencode($recipe_name);
    $api_response = file_get_contents($api_url);

    if ($api_response === FALSE) {
        http_response_code(500); // Internal Server Error
        return json_encode(["error" => "Failed to fetch data from MealDB API"]);
    }

    $api_data = json_decode($api_response, true);
    $mealdb_recipes = $api_data['meals'] ?? [];

    // Combine both local and MealDB recipes
    $combined_recipes = [
        "meals" => array_merge($local_recipes, $mealdb_recipes)
    ];

    // Return the combined response in JSON format
    return json_encode($combined_recipes);
}


if ($_SERVER['REQUEST_METHOD'] === "GET") {
    // if request to search by id
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        // Validate ID
        if (!is_numeric($id)) {
            http_response_code(400); // Bad Request
            echo json_encode(["error" => "Invalid recipe ID"]);
        } else {
            // Call searchById function and handle errors
            try {
                $result = searchById($id);
                if ($result) {
                    echo $result;
                } else {
                    http_response_code(404); // Not Found
                    echo json_encode(["error" => "Recipe not found"]);
                }
            } catch (Exception $e) {
                http_response_code(500); // Internal Server Error
                echo json_encode(["error" => "An error occurred while fetching the recipe"]);
            }
        }
    }
    // if request to search by ingredients
    if (isset($_GET['ing'])) {
        $ingredient_names = explode(",", $_GET['ing']); // Expecting comma-separated ingredient names
        $ingredient_names = array_map('strtolower', $ingredient_names);
        echo searchByIngredients($ingredient_names);
    }

    // if requeste to search by name
    if (isset($_GET['s'])) {
        $name = $_GET['s'];
        echo searchByName($name);
    }
} else {
    http_response_code(405); // Method Not Allowed
    echo json_encode(["error" => "Only GET requests are allowed"]);
}

<?php
header("Content-Type: application/json");
//DB Connection
$DB_servername = "localhost";
$DB_username = "root";
$DB_password = "";
$DB_database = "yummyverse";

$conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_database);
// Check connection
if ($conn->connect_error) {
    http_response_code(500); // Internal Server Error
    echo json_encode(["error" => "Database connection failed"]);
    exit();
}

//search recipe by id
function searchById($recipe_id)
{
    global $conn;
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
        //return the responce in json format
        return json_encode($response);
    } else {
        //if not found show meals = null
        return json_encode(["meals" => null]);
    }
}

if ($_SERVER['REQUEST_METHOD'] === "GET") {
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
    } else {
        http_response_code(400); // Bad Request
        echo json_encode(["error" => "Recipe ID is required"]);
    }
} else {
    http_response_code(405); // Method Not Allowed
    echo json_encode(["error" => "Only GET requests are allowed"]);
}

// Close the connection
$conn->close();

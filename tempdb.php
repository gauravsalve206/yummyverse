<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Recipe with Ingredients</title>
</head>
<body>
    <h1>Insert a New Recipe</h1>
    <form action="tempdb.php" method="POST">
        <!-- Recipe Details -->
        <label for="name">Recipe Name:</label><br>
        <input type="text" id="name" name="name" required><br><br>

        <label for="instructions">Instructions:</label><br>
        <textarea id="instructions" name="instructions" required></textarea><br><br>

        <label for="image_url">Image URL:</label><br>
        <input type="text" id="image_url" name="image_url"><br><br>

        <label for="video_url">Video URL:</label><br>
        <input type="text" id="video_url" name="video_url"><br><br>

        <label for="source_url">Source URL:</label><br>
        <input type="text" id="source_url" name="source_url"><br><br>

        <!-- Category and Area -->
        <label for="category">Category:</label><br>
        <input type="text" id="category" name="category" required><br><br>

        <label for="area">Area:</label><br>
        <input type="text" id="area" name="area" required><br><br>

        <!-- Ingredients -->
        <h3>Ingredients</h3>
        <div id="ingredients">
            <div>
                <label for="ingredient_name[]">Ingredient Name:</label>
                <input type="text" name="ingredient_name[]" required>
                <label for="measure[]">Measure:</label>
                <input type="text" name="measure[]" required><br><br>
            </div>
        </div>
        <button type="button" onclick="addIngredient()">Add Another Ingredient</button><br><br>

        <button type="submit" name="submit">Insert Recipe</button>
    </form>

    <script>
        function addIngredient() {
            const div = document.createElement('div');
            div.innerHTML = `
                <label for="ingredient_name[]">Ingredient Name:</label>
                <input type="text" name="ingredient_name[]" required>
                <label for="measure[]">Measure:</label>
                <input type="text" name="measure[]" required><br><br>
            `;
            document.getElementById('ingredients').appendChild(div);
        }
    </script>
    <?php
if (isset($_POST['submit'])) {
    // Database connection details
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'yummyverse';

    // Connect to the database
    $conn = new mysqli($host, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get form data
    $name = $conn->real_escape_string($_POST['name']);
    $instructions = $conn->real_escape_string($_POST['instructions']);
    $image_url = $conn->real_escape_string($_POST['image_url']);
    $video_url = $conn->real_escape_string($_POST['video_url']);
    $source_url = $conn->real_escape_string($_POST['source_url']);
    $category = $conn->real_escape_string($_POST['category']);
    $area = $conn->real_escape_string($_POST['area']);

    // Insert category if it doesn't exist
    $result = $conn->query("SELECT category_id FROM categories WHERE name='$category'");
    if ($result->num_rows > 0) {
        $category_id = $result->fetch_assoc()['category_id'];
    } else {
        $conn->query("INSERT INTO categories (name) VALUES ('$category')");
        $category_id = $conn->insert_id;
    }

    // Insert area if it doesn't exist
    $result = $conn->query("SELECT area_id FROM areas WHERE name='$area'");
    if ($result->num_rows > 0) {
        $area_id = $result->fetch_assoc()['area_id'];
    } else {
        $conn->query("INSERT INTO areas (name) VALUES ('$area')");
        $area_id = $conn->insert_id;
    }

    // Insert recipe
    $conn->query("INSERT INTO recipes (name, instructions, image_url, video_url, source_url, category_id, area_id)
                  VALUES ('$name', '$instructions', '$image_url', '$video_url', '$source_url', $category_id, $area_id)");
    $recipe_id = $conn->insert_id;

    // Insert ingredients and link to recipe
    foreach ($_POST['ingredient_name'] as $index => $ingredient_name) {
        $ingredient_name = $conn->real_escape_string($ingredient_name);
        $measure = $conn->real_escape_string($_POST['measure'][$index]);

        // Check if the ingredient exists
        $result = $conn->query("SELECT ingredient_id FROM ingredients WHERE name='$ingredient_name'");
        if ($result->num_rows > 0) {
            $ingredient_id = $result->fetch_assoc()['ingredient_id'];
        } else {
            $conn->query("INSERT INTO ingredients (name) VALUES ('$ingredient_name')");
            $ingredient_id = $conn->insert_id;
        }

        // Link recipe to ingredient with measure
        $conn->query("INSERT INTO recipe_ingredients (recipe_id, ingredient_id, measure)
                      VALUES ($recipe_id, $ingredient_id, '$measure')");
    }

    echo "Recipe inserted successfully!";
    $conn->close();
}
?>

</body>
</html>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>cpp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Demo Search</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/cpp/result.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Dropdown
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                    </li>
                </ul>
                <form class="d-flex" role="search" method="get" action="./search.php">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="mealName">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container">
        <H1>Wellcome</H1>
        <div class="content">
            <?php

            $mealId = $_GET['mealId'];
            // API endpoint
            if ($mealId < 50) {
                $url = "http://localhost/cpp/api.php?id={$mealId}";//query for localdb
            } 
            else {
                $url = "https://www.themealdb.com/api/json/v1/1/lookup.php?i={$mealId}";//query for mealdb
            } 



            // Fetch data from the API
            $response = file_get_contents($url);

            // Check if the response is valid
            if ($response === FALSE) {
                // Display Bootstrap alert if 'meals' no responce
                alertMeal();
                exit;
            }

            // Decode JSON response into a PHP array
            $data = json_decode($response, true);

            if (isset($data['meals']) && is_array($data['meals'])) {
                //display the data
                $meal = $data['meals'][0];
                if ($meal['strCategory'] === 'Beef') {
                    alertMeal(); // Skip this recipe not per Our Standards
                }
                $urlYT = htmlspecialchars($meal['strYoutube']);
                $parts = explode('v=', $urlYT);
                echo "<h3 id='mealName'>Meal Name: " . htmlspecialchars($meal['strMeal']) . "</h3>\n";
                echo '<iframe width="560" height="315" id="YouTube" src="https://www.youtube.com/embed/' . htmlspecialchars($parts[1]) . '?autoplay=1" title="YouTube video player" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';
                echo "<div class='category'><b>Category:</b> " . htmlspecialchars($meal['strCategory']) . "\n</div>";
                echo "<div class='ingrediants list'>";
                echo "<h3 id='mealIngredient'>Ingrediants</h3><UL>";
                for ($i = 1; $i <= 20; $i++) {
                    if (($meal['strIngredient' . $i]) <> null and ($meal['strIngredient' . $i]) <> "") {
                        echo "<li>" . $meal['strIngredient' . $i] . " " . $meal['strMeasure' . $i] . "</li>";
                    }
                }
                echo "</UL></div>";
                echo "<div class='instructions'><b>Instructions:</b> " . nl2br(htmlspecialchars($meal['strInstructions'])) . "\n</div>";
            } else {
                // Display Bootstrap alert if 'meals' is null or not an array
                alertMeal();
            }

            ?>

        </div>

    </div>
    <?php
    function alertMeal()
    {
        //display alert
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Erro!</strong> Error occurred while fetching data..
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
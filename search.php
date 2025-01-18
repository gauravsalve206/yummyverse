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
            <a class="nav-link active" aria-current="page" href="#">Home</a>
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
      $mealName = $_GET['mealName'];
      // API endpoint
      $url = "https://www.themealdb.com/api/json/v1/1/search.php?s={$mealName}"; //query

      // Fetch data from the API
      $response = file_get_contents($url);

      // Check if the response is valid
      if ($response === FALSE) {
        // Display Bootstrap alert if 'meals' no responce
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Erro!</strong> Error occurred while fetching data..
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        exit;
      }

      // Decode JSON response into a PHP array
      $data = json_decode($response, true);

      if (isset($data['meals']) && is_array($data['meals']) && $mealName) {
        echo "<div class='mealList'>\n";
        // Loop through the meals and display the data
        foreach ($data['meals'] as $meal) {
          echo "<div class='meal'>\n";
          echo "<a href='viewRecipe.php?mealId=" . urlencode($meal['idMeal']) . "'><h3>Meal Name: " . htmlspecialchars($meal['strMeal']) . "</h3></a>\n<br>";
          echo "<img height='200px' width='200px' src=" . $meal['strMealThumb'] . ">\n";
          echo "Category: " . htmlspecialchars($meal['strCategory']) . "<br>\n";
          echo "</div>\n";
        }
        echo "</div>";
      } else {
        // Display Bootstrap alert if 'meals' is null or not an array
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> No data found for the requested meal.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
      }

      ?>

    </div>

  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
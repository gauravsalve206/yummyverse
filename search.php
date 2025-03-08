<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>cpp</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="footer.css" />
  <link rel="stylesheet" href="card.css" />
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
      $i = 0;
      if (isset($_GET['mealName'])){
      $mealName = $_GET['mealName'];
      // API endpoint
        $url = "http://localhost/cpp/src/api/api.php?s={$mealName}"; //query for localdb
      }
      if (isset($_GET['ing'])){
        $ing = $_GET['ing'];
      // API endpoint
        $url = "http://localhost/cpp/src/api/api.php?ing={$ing}"; //query for localdb
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
        foreach ($data['meals'] as $meal) {
          $i++;
          if ($meal['strCategory'] === 'Beef') {
            continue; // Skip this recipe not per Our Standards

          }
          echo "<div class='card' >
                  <!-- like btn -->
                  <div class='toggle'>
                      <div class='toggle-btn'>
                          <input type='checkbox' id='heart-check" . $i . "' />
                          <input type='hidden' id='mealId' name='mealId' value=" . htmlspecialchars($meal['idMeal']) . ">
                          <label for='heart-check" . $i . "' id='heart" . $i . "'>
                              <svg viewBox='0 0 24 22' version='1.1' xmlns='http://www.w3.org/2000/svg'
                                  xmlns:xlink='http://www.w3.org/1999/xlink'>
                                  <path id='initial'
                                      d='M11.8189091,20.3167303 C17.6981818,16.5505143 20.6378182,12.5122542 20.6378182,8.20195014 C20.6378182,5.99719437 18.8550242,4 16.3283829,4 C13.777264,4 12.5417153,6.29330284 11.8189091,6.29330284 C11.0961029,6.29330284 10.1317157,4 7.30943526,4 C4.90236126,4 3,5.64715533 3,8.20195014 C3,12.5122346 5.93963637,16.5504946 11.8189091,20.3167303 Z'>
                                  </path>
                                  <path id='stroke' fill='none'
                                      d='M11.8189091,20.3167303 C17.6981818,16.5505143 20.6378182,12.5122542 20.6378182,8.20195014 C20.6378182,5.99719437 18.8550242,4 16.3283829,4 C13.4628072,4 10.284995,6.64162063 10.284995,8.70392731 C10.284995,10.0731789 10.8851209,10.9874447 11.8189091,10.9874447 C12.7526973,10.9874447 13.3528232,10.0731789 13.3528232,8.70392731 C13.3528232,6.64162063 10.1317157,4 7.30943526,4 C4.90236126,4 3,5.64715533 3,8.20195014 C3,12.5122346 5.93963637,16.5504946 11.8189091,20.3167303 Z'>
                                  </path>
                              </svg>
                          </label>
                      </div>
                  </div>
                  <span class='tag'>" . htmlspecialchars($meal['strCategory']) . "</span>
                  <a href='viewRecipe.php?mealId=" . urlencode($meal['idMeal']) . "'>
                      <img src=" . $meal['strMealThumb'] . " alt='Recipe " . htmlspecialchars($meal['idMeal']) . "' />
                      <h3>" . htmlspecialchars($meal['strMeal']) . "</h3>
                  </a>
              </div>";
        }
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
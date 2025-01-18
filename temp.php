<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="footer.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />

  <script src="script.js"></script>
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet" />
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=search" />
</head>

<body>
    <div class="card">
        <!-- like btn -->
        <div class="toggle">
            <div class="toggle-btn">
                <input type="checkbox" id="heart-check2" />

                <label for="heart-check2" id="heart2">
                    <svg viewBox="0 0 24 22" version="1.1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink">
                        <path id="initial"
                            d="M11.8189091,20.3167303 C17.6981818,16.5505143 20.6378182,12.5122542 20.6378182,8.20195014 C20.6378182,5.99719437 18.8550242,4 16.3283829,4 C13.777264,4 12.5417153,6.29330284 11.8189091,6.29330284 C11.0961029,6.29330284 10.1317157,4 7.30943526,4 C4.90236126,4 3,5.64715533 3,8.20195014 C3,12.5122346 5.93963637,16.5504946 11.8189091,20.3167303 Z">
                        </path>
                        <path id="stroke" fill="none"
                            d="M11.8189091,20.3167303 C17.6981818,16.5505143 20.6378182,12.5122542 20.6378182,8.20195014 C20.6378182,5.99719437 18.8550242,4 16.3283829,4 C13.4628072,4 10.284995,6.64162063 10.284995,8.70392731 C10.284995,10.0731789 10.8851209,10.9874447 11.8189091,10.9874447 C12.7526973,10.9874447 13.3528232,10.0731789 13.3528232,8.70392731 C13.3528232,6.64162063 10.1317157,4 7.30943526,4 C4.90236126,4 3,5.64715533 3,8.20195014 C3,12.5122346 5.93963637,16.5504946 11.8189091,20.3167303 Z">
                        </path>
                    </svg>
                </label>
            </div>
        </div>
        <span class="tag">Indian</span>
        <a href="">
            <img src="./src/recipe1.jpg" alt="Recipe 2" />
            <h3>Matar Paneer</h3>
        </a>
    </div>

    <?php
            
            $mealId = array();
            // API endpoint
            $url = "https://www.themealdb.com/api/json/v1/1/lookup.php?i={$mealId}"; //query

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
                $meal=$data['meals'][0];
                    if ($meal['strCategory'] === 'Beef') {
                        alertMeal(); // Skip this recipe not per Our Standards
                    }
                    $urlYT = htmlspecialchars($meal['strYoutube']);
                    $parts = explode('v=', $urlYT);
                    echo "<h3 id='mealName'>Meal Name: " . htmlspecialchars($meal['strMeal']) . "</h3>\n";
                    echo '<iframe width="560" height="315" id="YouTube" src="https://www.youtube.com/embed/'.htmlspecialchars($parts[1]).'?autoplay=1" title="YouTube video player" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';
                    echo "<div class='category'><b>Category:</b> " . htmlspecialchars($meal['strCategory']) . "\n</div>";
                    echo "<div class='ingrediants list'>";
                    echo "<h3 id='mealIngredient'>Ingrediants</h3><UL>";
                    for($i=1; $i<=20; $i++) {
                        if(($meal['strIngredient'.$i])<>null and ($meal['strIngredient'.$i])<>""){
                        echo "<li>".$meal['strIngredient'.$i]." ".$meal['strMeasure'.$i]."</li>";
                        }
                    }
                    echo "</UL></div>";
                    echo "<div class='instructions'><b>Instructions:</b> " . nl2br(htmlspecialchars($meal['strInstructions'])) . "\n</div>";
                
            } else {
                // Display Bootstrap alert if 'meals' is null or not an array
                alertMeal();
            }

            ?>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="card.css" />
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
    <?php
    $i=0;
    $mealIds = array(52772, 11, 25, 8, 5, 22);
    foreach ($mealIds as $mealId) {


        // API endpoint
        if ($mealId < 50) {
            $url = "http://localhost/cpp/api.php?id={$mealId}"; //query for localdb
        } else {
            $url = "https://www.themealdb.com/api/json/v1/1/lookup.php?i={$mealId}"; //query for mealdb
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
                            <input type='checkbox' id='heart-check".$i."' />
                            <input type='hidden' id='mealId' name='mealId' value=" . htmlspecialchars($meal['idMeal']) . ">
                            <label for='heart-check".$i."' id='heart".$i."'>
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
                    <a href='viewRecipe.php?mealId=". urlencode($meal['idMeal'])."'>
                        <img src=" . $meal['strMealThumb'] . " alt='Recipe " . htmlspecialchars($meal['idMeal']) . "' />
                        <h3>" . htmlspecialchars($meal['strMeal']) . "</h3>
                    </a>
                </div>";
                
            }
        } else {
            // Display Bootstrap alert if 'meals' is null or not an array
            alertMeal();
        }
    }
    ?>
    <?php
    function alertMeal()
    {
        //display alert
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Erro!</strong> Error occurred while fetching data..
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    }
    ?>
</body>

</html>
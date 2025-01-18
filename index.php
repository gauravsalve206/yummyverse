<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
    <nav class="navbar">
      <div class="navdiv">
        <div class="logo">
          <a href=""><img src="./src//icons/pngegg.png" alt="" width="70px" /></a>
        </div>
        <div class="logoname">
          <span style="color: green">YUMMYVERSE</span>
        </div>
    
        <div class="navcontent">
          <ul>
            <li><a href="#">Recieps</a></li>
            <li><a href="#">Bookmarks</a></li>
            <li><a href="#">Bachelors</a></li>
            <button type="button">Login</button>
          </ul>
        </div>
      </div>
    </nav>
</head>

<body>

  <div class="main">
    <div class="container">
      <div class="text">
        <h2 class="heading">
          Hello <span class="highlight">Foddies,</span>Whats Cooking Today?
        </h2>
        <!-- Search bar code -->
        <form action="" method="get">
          <div class="search">
            <div class="searchicon">
              <img src="src/icons/icons8-search-30.png" width="" />
            </div>

            <input type="search" id="sbar" class="searchinput" placeholder="" />
          </div>
        </form>

        <div class="textbelow">
          <span>Discover delicious recipes for every craving. Let’s cook up
            <br />something amazing!</span>
        </div>
      </div>
      <div class="chefcontainer">
        <div class="mainimg-container">
          <img src="./src/chef.png" alt="" class="mainimg" />
        </div>
        <div class="greenbg"></div>
      </div>
    </div>
  </div>

  <h1 style="color: #004526" id="fr">Featured recipes</h1>

  <br />
  <!-- Featured Recipes -->
  <div class="featured-recipes">
    <div class="greenbg-fr"></div>
    <div class="slider">
      <div class="card">
        <!-- like btn -->
        <div class="toggle">
          <div class="toggle-btn">
            <input type="checkbox" id="heart-check1" />

            <label for="heart-check1" id="heart1">
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

        <span class="tag">Italian</span>

        <a href="">
          <img src="./src/recipe1.jpg" alt="Recipe 2" />
          <h3>Matar Paneer</h3>
        </a>
      </div>

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

      <div class="card">
        <!-- like btn -->
        <div class="toggle">
          <div class="toggle-btn">
            <input type="checkbox" id="heart-check3" />
            <label for="heart-check3" id="heart3">
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
      <div class="card">
        <!-- like btn -->
        <div class="toggle">
          <div class="toggle-btn">
            <input type="checkbox" id="heart-check4" />
            <label for="heart-check4" id="heart4">
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

      <div class="card">
        <!-- like btn -->
        <div class="toggle">
          <div class="toggle-btn">
            <input type="checkbox" id="heart-check5" />

            <label for="heart-check5" id="heart5">
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
    </div>
    <div class="find-recipe">
      <h2>Find Recipes by Ingredients</h2>
      <div class="ing-cont">
        <div class="first-row">
          <button class="ing-btn">
            <img class="ing-icon" src="src/ing-icon.png" width="35px" alt="ing-img" />potato
          </button>
          <button class="ing-btn">
            <img class="ing-icon" src="src/ing-icon.png" width="35px" alt="ing-img" />potato
          </button>
          <button class="ing-btn">
            <img class="ing-icon" src="src/ing-icon.png" width="35px" alt="ing-img" />potato
          </button>
          <button class="ing-btn">
            <img class="ing-icon" src="src/ing-icon.png" width="35px" alt="ing-img" />potato
          </button>
          <button class="ing-btn">
            <img class="ing-icon" src="src/ing-icon.png" width="35px" alt="ing-img" />potato
          </button>
        </div>
        <div class="second-row">
          <button class="ing-btn">
            <img class="ing-icon" src="src/ing-icon.png" width="35px" alt="ing-img" />potato
          </button>
          <button class="ing-btn">
            <img class="ing-icon" src="src/ing-icon.png" width="35px" alt="ing-img" />potato
          </button>
          <button class="ing-btn">
            <img class="ing-icon" src="src/ing-icon.png" width="35px" alt="ing-img" />potato
          </button>
          <button class="ing-btn">
            <img class="ing-icon" src="src/ing-icon.png" width="35px" alt="ing-img" />potato
          </button>
        </div>
      </div>
    </div>
    <!-- search by ingredients list and searchbar -->
    <div class="search-ing-cont">
      <form action="">
        <!-- SearchBar and ingrediants buttons -->
        <div class="searcbar-cont">
          <input type="text" class="ing-searchbar" placeholder="Search..." />
          <i class="fa fa-search search-icon"></i>
        </div>
        <div class="ing-btn-cont">
          <button type="button"><img src="src/add-ing.png" alt="add" class="add-ing">Potato</button>
          <button type="button"><img src="src/add-ing.png" alt="add" class="add-ing">Potato</button>
          <button type="button"><img src="src/add-ing.png" alt="add" class="add-ing">Potato</button>
          <button type="button"><img src="src/add-ing.png" alt="add" class="add-ing">Potato</button>
          <button type="button"><img src="src/add-ing.png" alt="add" class="add-ing">Potato</button>
          <button type="button"><img src="src/add-ing.png" alt="add" class="add-ing">Potato</button>
        </div>
      </form>

      <div class="ing-list-cont">
        <i class="fa-solid fa-list"></i>
        <h2 id="ing-list-heading">Ingredients List</h2>
      </div>
    </div>
  </body>
  <footer>
    <div class="navigate">
    <h2 id="navigate-text">Navigate</h2>
    <ul>
    <li><a href="">Home</a></li>
    <li> <a href="">Bookmark</a></li>
    <li> <a href="">Bachelors</a></li>

    </ul>
  </div>
  <div class="info">
    <img src="src/footer-png.png" alt="" id="footer-png">
    <h1 style="color: white;">YUMMYVERSE</h1>
    <p id="info">Join the yummyverse community and bring flavors to life, one dish at a time. YUMMYVERSE Where Every Bite Tells a Story</p>
  </div>
  </footer>
</html>
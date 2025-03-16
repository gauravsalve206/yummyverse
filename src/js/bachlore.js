window.addEventListener('load', function () {

    const mealContainer = document.querySelector('.card-container');
  
    // Fetch all meals from localhost API
    fetch('http://yummyverse.free.nf/src/api/api.php?all=true')
      .then(response => {
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        return response.json();
      })
      .then(data => {
        if (data.meals && Array.isArray(data.meals)) {
  
          // Loop through all meals and display them
          data.meals.forEach((meal, index) => {
  
            // Exclude meals with 'Beef' category
            if (meal.strCategory === 'Beef') return;
  
            // Create a card element
            const card = document.createElement('div');
            card.className = 'card';
  
            card.innerHTML = `
              <div class='toggle'>
                <div class='toggle-btn'>
                  <input type='checkbox' id='heart-check${index}' />
                  <input type='hidden' id='mealId${index}' name='mealId' value='${meal.idMeal}'>
                  <label for='heart-check${index}' id='heart${index}'>
                    <svg viewBox='0 0 24 22' xmlns='http://www.w3.org/2000/svg'>
                      <path id='initial'
                        d='M11.8189091,20.3167303 C17.6981818,16.5505143 20.6378182,12.5122542 20.6378182,8.20195014 C20.6378182,5.99719437 18.8550242,4 16.3283829,4 C13.777264,4 12.5417153,6.29330284 11.8189091,6.29330284 C11.0961029,6.29330284 10.1317157,4 7.30943526,4 C4.90236126,4 3,5.64715533 3,8.20195014 C3,12.5122346 5.93963637,16.5504946 11.8189091,20.3167303 Z'>
                      </path>
                    </svg>
                  </label>
                </div>
              </div>
              <span class='tag'>${meal.strCategory}</span>
              <a href='viewRecipe.html?mealId=${meal.idMeal}' target='_blank'>
                <img src='${meal.strMealThumb}' alt='Recipe ${meal.idMeal}' />
                <h3>${meal.strMeal}</h3>
              </a>
            `;
  
            // Append the card to the meal-container
            mealContainer.appendChild(card);
          });
        }
      })
      .catch(() => {
        console.error('Failed to fetch meals from API');
        alert('Failed to fetch meals from your local database.');
      });
  });
  
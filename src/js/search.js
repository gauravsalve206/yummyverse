document.addEventListener("DOMContentLoaded", function () {
  const urlParams = new URLSearchParams(window.location.search);
  let mealName = urlParams.get("mealName");
  let ing = urlParams.get("ing");
  let apiUrl = "";

  if (mealName) {
    apiUrl = `https://yummyverse.free.nf/src/api/api.php?s=${mealName}`;
  } else if (ing) {
    apiUrl = `https://yummyverse.free.nf/src/api/api.php?ing=${ing}`;
  }

  if (apiUrl) {
    fetch(apiUrl)
      .then((response) => response.json())
      .then((data) => {
        if (data.meals && Array.isArray(data.meals)) {
          displayMeals(data.meals);
        } else {
          alertMeal();
        }
      })
      .catch(() => alertMeal());
  }
});

function displayMeals(meals) {
  const contentDiv = document.querySelector(".card-container");
  contentDiv.innerHTML = "";
  let i = 0;

  meals.forEach((meal) => {
    if (meal.strCategory === "Beef") return; // Skip beef recipes
    i++;

    const mealCard = document.createElement("div");
    mealCard.classList.add("card");
    mealCard.innerHTML = `
      <div class='toggle'>
        <div class='toggle-btn'>
          <input type='checkbox' id='heart-check${i}' />
          <input type='hidden' id='mealId' name='mealId' value='${meal.idMeal}' />
          <label for='heart-check${i}' id='heart${i}'>
            <svg viewBox='0 0 24 22' version='1.1' xmlns='http://www.w3.org/2000/svg'>
              <path id='initial' d='M11.8189091,20.3167303 C17.6981818,16.5505143...'></path>
              <path id='stroke' fill='none' d='M11.8189091,20.3167303 C17.6981818,16.5505143...'></path>
            </svg>
          </label>
        </div>
      </div>
      <span class='tag'>${meal.strCategory}</span>
      <a href='viewRecipe.html?mealId=${encodeURIComponent(meal.idMeal)}'>
        <img src='${meal.strMealThumb}' alt='Recipe ${meal.idMeal}' />
        <h3>${meal.strMeal}</h3>
      </a>
    `;
    contentDiv.appendChild(mealCard);
  });
}

function alertMeal() {
  alert("Meal not found");
}
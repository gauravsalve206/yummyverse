document.addEventListener("DOMContentLoaded", () => {
  const selectedIngredientsList = document.getElementById("selectedIngredients");
  const ingredientButtons = document.querySelectorAll(".ing-btn-cont button");
  const searchInput = document.getElementById("searchInput");
  const addBtn = document.getElementById("addSearchedIngredient");

  // Add from existing buttons
  ingredientButtons.forEach((button) => {
    button.addEventListener("click", () => {
      const ingredient = button.textContent.trim();
      addIngredient(ingredient);
    });
  });

  // Add from search input
  addBtn.addEventListener("click", () => {
    const ingredient = searchInput.value.trim();
    if (ingredient) {
      addIngredient(ingredient);
      searchInput.value = "";
    }
  });

  



  function addIngredient(ingredient) {
    const alreadyExists = [...selectedIngredientsList.querySelectorAll("span")].some(span =>
      span.textContent.trim().toLowerCase() === ingredient.toLowerCase()
    );
    if (alreadyExists) return;
  
    const li = document.createElement("li");
  
    const span = document.createElement("span");
    span.textContent = ingredient;
  
    const removeBtn = document.createElement("button");
    removeBtn.textContent = "X";
    removeBtn.classList.add("remove-btn");
    removeBtn.addEventListener("click", () => li.remove());
  
    li.appendChild(span);       // ✅ Add ingredient name in span
    li.appendChild(removeBtn);  // ✅ Add remove button
    selectedIngredientsList.appendChild(li);
  }
  
  document.querySelector('.search-recipe-btn').addEventListener('click', function () {
    const ingredientSpans = document.querySelectorAll('#selectedIngredients li span'); // only get span text
  
    const ingredients = Array.from(ingredientSpans)
      .map(span => span.textContent.trim()) // ✅ no "X" included
      .filter(text => text.length > 0);
  
    if (ingredients.length > 0) {
      const query = ingredients.join(',');
      window.location.href = `https://yummyverse.free.nf/search.html?ing=${encodeURIComponent(query)}`;
    } else {
      alert("No recipe found!");
    }
  });
  

});
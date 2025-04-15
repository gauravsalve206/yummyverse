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
    // Prevent duplicates
    const alreadyExists = [...selectedIngredientsList.children].some(item =>
      item.textContent.replace("X", "").trim().toLowerCase() === ingredient.toLowerCase()
    );
    if (alreadyExists) return;

    const li = document.createElement("li");
    li.textContent = ingredient;

    const removeBtn = document.createElement("button");
    removeBtn.textContent = "X";
    removeBtn.classList.add("remove-btn");
    removeBtn.addEventListener("click", () => li.remove());

    li.appendChild(removeBtn);
    selectedIngredientsList.appendChild(li);
  }
});
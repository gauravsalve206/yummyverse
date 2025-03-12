const selectedIngredientsList = document.getElementById("selectedIngredients");
const ingredientButtons = document.querySelectorAll(".ing-btn-cont button");
const searchInput = document.getElementById("searchInput")

// ✅ Attach onclick event dynamically to existing buttons
ingredientButtons.forEach((button) => {
  button.addEventListener("click", () => {
    const ingredient = button.textContent.trim(); // Get the ingredient name
    addIngredient(ingredient);
  });
});

// ✅ Function to add ingredient to the list
function addIngredient(ingredient) {
  // Prevent duplicates
  if (![...selectedIngredientsList.children].some(item => item.textContent === ingredient)) {
    const li = document.createElement("li");
    li.textContent = ingredient;

    // ✅ Add Remove Button
    const removeBtn = document.createElement("button");
    removeBtn.textContent = "X";
    removeBtn.classList.add("remove-btn");
    
    // Remove ingredient when clicked
    removeBtn.addEventListener("click", () => {
        li.remove();
    });
 // ✅ Add button to list item
 li.appendChild(removeBtn);
    selectedIngredientsList.appendChild(li);
  }
}

// ✅ Filter Ingredients Based on Search Input
function filterIngredients() {
  const searchTerm = document.getElementById("searchInput").value.toLowerCase();
  const buttons = document.querySelectorAll(".ing-btn-cont button");

  buttons.forEach(button => {
    if (button.textContent.toLowerCase().includes(searchTerm)) {
      button.style.display = "inline-block";
    } else {
      button.style.display = "none";
    }
  });
}

document.addEventListener("DOMContentLoaded", () => {
    const searchBar = document.getElementById("sbar");
    const recipes = ["Paneer Masala", "Chicken Biryani", "Mattar Paneer", "Chocolate Cake", "Butter Chiken"];
    let recipeIndex = 0;
    let typingInterval; // To store the animation interval
    let enteredText = ""; // Store the text entered by the user
  
    function typePlaceholder(text) {
      let i = 0;
      searchBar.placeholder = ""; // Clear placeholder before starting typing animation
  
      function type() {
        if (i < text.length) {
          searchBar.placeholder += text.charAt(i); // Add one character
          i++;
          typingInterval = setTimeout(type, 100); // Adjust typing speed
        }
      }
  
      type();
    }
  
    // Start typing animation for recipe names
    function startRecipeTyping() {
      let i = 0;
      function type() {
        if (i < recipes[recipeIndex].length) {
          searchBar.placeholder += recipes[recipeIndex].charAt(i); // Add one character
          i++;
          typingInterval = setTimeout(type, 100); // Adjust typing speed
        } else {
          typingInterval = setTimeout(() => {
            searchBar.placeholder = ""; // Clear placeholder after typing
            recipeIndex = (recipeIndex + 1) % recipes.length; // Move to the next recipe
            startRecipeTyping(); // Restart animation with the next recipe
          }, 1000); // Pause before switching to the next recipe
        }
      }
      type();
    }
  
    // Start typing animation initially for the recipes
    startRecipeTyping();
  
    // Stop animation and clear placeholder on focus
    searchBar.addEventListener("focus", () => {
      clearTimeout(typingInterval); // Stop the animation
      enteredText = searchBar.value; // Store the text entered by the user
      searchBar.placeholder = ""; // Clear the placeholder when focused
    });
  
    // Restart animation with the entered text when blur is triggered
    searchBar.addEventListener("blur", () => {
      if (enteredText.trim() !== "") {
        typePlaceholder(enteredText); // Display the entered text with animation
      } else {
        startRecipeTyping(); // Continue recipe animation if nothing was entered
      }
    });
  });
  

  //navbar scroll shadow
  window.addEventListener("scroll", () => {
    const navbar = document.querySelector(".navdiv");
    if (window.scrollY > 0) {
      navbar.classList.add("shadow");
    } else {
      navbar.classList.remove("shadow");
    }
  });
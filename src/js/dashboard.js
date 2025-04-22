import { getAuth, signOut } from "https://www.gstatic.com/firebasejs/9.15.0/firebase-auth.js";
import { initializeApp } from "https://www.gstatic.com/firebasejs/9.15.0/firebase-app.js";

// Firebase Configuration
const firebaseConfig = {
    apiKey: "AIzaSyAZKbYYMLOrJebgWpf_cW-cJ50qxgVVsak",
    authDomain: "yummyverse-793ad.firebaseapp.com",
    projectId: "yummyverse-793ad",
    storageBucket: "yummyverse-793ad.appspot.com",
    messagingSenderId: "179075175539",
    appId: "1:179075175539:web:7b7f9461481801d8c94606",
    measurementId: "G-N6QPLP872C"
};

const app = initializeApp(firebaseConfig);
const auth = getAuth(app);

// Logout Functionality
document.getElementById('logoutButton').addEventListener('click', function () {
    console.log("1")
    firebase.auth().signOut().then(() => {
        alert('You have been logged out successfully.');
        window.location.href = 'login.html';  // Redirect to login page
    }).catch((error) => {
        console.error('Logout Error:', error.message);
        alert('Failed to log out. Please try again.');
    });
});





document.addEventListener("DOMContentLoaded", () => {
    const selectedIngredientsList = document.getElementById("selectedIngredients");
    const searchInput = document.getElementById("searchInput");
    const addBtn = document.getElementById("addSearchedIngredient");
  
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
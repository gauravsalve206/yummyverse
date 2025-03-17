import { initializeApp } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-app.js";
import { getFirestore, collection, getDocs, doc, getDoc } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-firestore.js";
import { getAuth, onAuthStateChanged } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-auth.js";

// Your Firebase configuration
const firebaseConfig = {
  apiKey: "AIzaSyAZKbYYMLOrJebgWpf_cW-cJ50qxgVVsak",
    authDomain: "yummyverse-793ad.firebaseapp.com",
    projectId: "yummyverse-793ad",
    storageBucket: "yummyverse-793ad.appspot.com",
    messagingSenderId: "179075175539",
    appId: "1:179075175539:web:7b7f9461481801d8c94606",
    measurementId: "G-N6QPLP872C"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const db = getFirestore(app);
const auth = getAuth(app);

async function fetchSavedRecipeIds() {
  return new Promise((resolve, reject) => {
    onAuthStateChanged(auth, async (user) => {
      if (user) {
        try {
          const userId = user.uid;
          const usersCollection = collection(db, 'users');
          const userDocRef = doc(usersCollection, userId);
          const userDocSnapshot = await getDoc(userDocRef);

          if (userDocSnapshot.exists()) {
            const userData = userDocSnapshot.data();
            const savedRecipeIds = userData.savedRecipies || []; // Handle undefined savedRecipies
            resolve(savedRecipeIds);
          } else {
            console.log("User document not found!");
            resolve([]); // Resolve with an empty array
          }
        } catch (error) {
          console.error("Error fetching saved recipes:", error);
          reject(error);
        }
      } else {
        console.log("No user is currently signed in.");
        resolve([]); // Resolve with an empty array
      }
    });
  });
}

let mealIds = [];

function generateCards() {
  const mealContainer = document.querySelector('.card-container');
  if (!mealContainer) { // Check if the container exists
    console.error("Meal container element not found!");
    return;
  }

  mealIds.forEach((mealId, index) => {
    const url = mealId < 50
      ? `https://yummyverse.free.nf/src/api/api.php?id=${mealId}`
      : `https://www.themealdb.com/api/json/v1/1/lookup.php?i=${mealId}`;

    fetch(url)
      .then(response => {
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        return response.json();
      })
      .then(data => {
        if (data.meals && Array.isArray(data.meals)) {
          data.meals.forEach(meal => {
            if (meal.strCategory === 'Beef') return; // Exclude Beef meals

            const card = document.createElement('div');
            card.className = 'card';

            card.innerHTML = `
              <div class='toggle'>
                <div class='toggle-btn'>
                  <input type='checkbox' id='heart-check${index}' />
                  <input type='hidden' id='mealId${index}' name='mealId' value='${meal.idMeal}'>
                  <label for='heart-check${index}' id='heart${index}'>
                    <svg viewBox='0 0 24 22' xmlns='http://www.w3.org/2000/svg'>
                      <path id='initial' d='M11.8189091,20.3167303 C17.6981818,16.5505143 20.6378182,12.5122542 20.6378182,8.20195014 C20.6378182,5.99719437 18.8550242,4 16.3283829,4 C13.777264,4 12.5417153,6.29330284 11.8189091,6.29330284 C11.0961029,6.29330284 10.1317157,4 7.30943526,4 C4.90236126,4 3,5.64715533 3,8.20195014 C3,12.5122346 5.93963637,16.5504946 11.8189091,20.3167303 Z'></path>
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

            mealContainer.appendChild(card);
          });
        }
      })
      .catch(() => {
        console.error('Failed to fetch meals from API');
        alert('Failed to fetch meals.');
      });
  });
}


fetchSavedRecipeIds()
  .then(recipeIds => {
    mealIds = recipeIds;
    generateCards(); // Call generateCards after mealIds are fetched
  })
  .catch(error => {
    console.error("Error fetching recipe IDs:", error);
  });

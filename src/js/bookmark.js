import { 
  auth, 
  db, 
  doc, 
  getDoc,
  updateDoc,
  arrayRemove
} from './firebaseconfig.js';
import { onAuthStateChanged } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-auth.js";

document.addEventListener('DOMContentLoaded', async () => {
  const mealContainer = document.querySelector('.card-container');
  if (!mealContainer) return;

  mealContainer.innerHTML = '<div class="loading">Loading your saved recipes...</div>';

  onAuthStateChanged(auth, async (user) => {
    if (!user) {
      mealContainer.innerHTML = '<div class="login-prompt">Please log in to view saved recipes</div>';
      return;
    }

    try {
      const userRef = doc(db, 'users', user.uid);
      const userDoc = await getDoc(userRef);

      if (!userDoc.exists()) {
        mealContainer.innerHTML = '<div class="empty">No saved recipes found</div>';
        return;
      }

      const savedRecipes = userDoc.data().savedRecipies || [];

      if (savedRecipes.length === 0) {
        mealContainer.innerHTML = '<div class="empty">You haven\'t saved any recipes yet</div>';
        return;
      }

      mealContainer.innerHTML = '';
      let recipesLoaded = 0;

      for (const recipe of savedRecipes) {
        // If the recipe is a full object (local recipe)
        if (typeof recipe === 'object' && recipe.id && recipe.title) {
          recipesLoaded++;
          createLocalCard(recipe, mealContainer, user.uid);
        } 
        // If recipe is just an ID (remote)
        else if (typeof recipe === 'string') {
          try {
            const url = parseInt(recipe) < 50 
              ? `https://yummyverse.free.nf/src/api/api.php?id=${recipe}`
              : `https://www.themealdb.com/api/json/v1/1/lookup.php?i=${recipe}`;

            const response = await fetch(url);
            const data = await response.json();

            if (data.meals && data.meals.length > 0) {
              recipesLoaded++;
              const meal = data.meals[0];
              createRemoteCard(meal, mealContainer, user.uid);
            }
          } catch (err) {
            console.error(`Failed to load remote meal ${recipe}:`, err);
          }
        }
      }

      if (recipesLoaded === 0) {
        mealContainer.innerHTML = '<div class="empty">Could not load any saved recipes</div>';
      }

    } catch (error) {
      console.error("Error loading saved recipes:", error);
      mealContainer.innerHTML = '<div class="error">Failed to load saved recipes</div>';
    }
  });
});

function createLocalCard(recipe, container, userId) {
  const card = document.createElement('div');
  card.className = 'card';

  card.innerHTML = `
    <div class='like-container'>
      <input type='checkbox' id='like-${recipe.id}' class='like-checkbox' checked />
      <label for='like-${recipe.id}' class='heart-label liked'>♥</label>
    </div>
    <span class='tag'>${recipe.category || 'Recipe'}</span>
    <a href='viewRecipe.html?mealId=${recipe.id}&isLocal=true'>
      <img src='${recipe.image}' alt='${recipe.title}' onerror="this.src='fallback-image.jpg'">
      <h3>${recipe.title}</h3>
    </a>
  `;

  container.appendChild(card);
  setupUnlikeLocal(recipe, userId, card);
}

function createRemoteCard(meal, container, userId) {
  const card = document.createElement('div');
  card.className = 'card';
  const uniqueId = meal.idMeal;

  card.innerHTML = `
    <div class='like-container'>
      <input type='checkbox' id='like-${uniqueId}' class='like-checkbox' checked />
      <label for='like-${uniqueId}' class='heart-label liked'>♥</label>
    </div>
    <span class='tag'>${meal.strCategory}</span>
    <a href='viewRecipe.html?mealId=${meal.idMeal}'>
      <img src='${meal.strMealThumb}' alt='${meal.strMeal}' onerror="this.src='fallback-image.jpg'">
      <h3>${meal.strMeal}</h3>
    </a>
  `;

  container.appendChild(card);
  setupUnlikeRemote(uniqueId, userId, card);
}

function setupUnlikeLocal(recipeObj, userId, cardElement) {
  const checkbox = document.querySelector(`#like-${recipeObj.id}`);
  const heartLabel = document.querySelector(`label[for='like-${recipeObj.id}']`);

  checkbox.addEventListener('change', async () => {
    if (!checkbox.checked) {
      try {
        const userRef = doc(db, 'users', userId);
        await updateDoc(userRef, {
          savedRecipies: arrayRemove(recipeObj)
        });

        cardElement.remove();
        updateEmptyState();
      } catch (err) {
        console.error("Error removing local recipe:", err);
        checkbox.checked = true;
        alert("Failed to remove. Please try again.");
      }
    }
  });
}

function setupUnlikeRemote(mealId, userId, cardElement) {
  const checkbox = document.querySelector(`#like-${mealId}`);
  const heartLabel = document.querySelector(`label[for='like-${mealId}']`);

  checkbox.addEventListener('change', async () => {
    if (!checkbox.checked) {
      try {
        const userRef = doc(db, 'users', userId);
        await updateDoc(userRef, {
          savedRecipies: arrayRemove(mealId)
        });

        cardElement.remove();
        updateEmptyState();
      } catch (err) {
        console.error("Error removing remote recipe:", err);
        checkbox.checked = true;
        alert("Failed to remove. Please try again.");
      }
    }
  });
}

function updateEmptyState() {
  const container = document.querySelector('.card-container');
  if (container && container.children.length === 0) {
    container.innerHTML = '<div class="empty">No saved recipes remaining</div>';
  }
}
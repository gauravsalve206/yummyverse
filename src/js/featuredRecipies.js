import { 
  auth, 
  db, 
  doc, 
  setDoc, 
  updateDoc, 
  arrayUnion, 
  arrayRemove,
  getDoc
} from './firebaseconfig.js';

document.addEventListener('DOMContentLoaded', async () => {
  const mealIds = [52772, 11, 25, 8, 5, 22];
  const slider = document.querySelector('.slider');

  for (const mealId of mealIds) {
    try {
      const url = mealId < 50 
        ? `https://yummyverse.free.nf/src/api/api.php?id=${mealId}` 
        : `https://www.themealdb.com/api/json/v1/1/lookup.php?i=${mealId}`;
      const response = await fetch(url);
      const data = await response.json();
      
      if (data.meals) {
        data.meals.forEach(meal => {
          const card = document.createElement('div');
          card.className = 'card';
          const uniqueId = meal.idMeal;

          card.innerHTML = `
            <div class='like-container'>
              <input type='checkbox' id='like-${uniqueId}' class='like-checkbox' />
              <label for='like-${uniqueId}' class='heart-label'>♥</label>
            </div>
            <span class='tag'>${meal.strCategory}</span>
            <a href='viewRecipe.html?mealId=${meal.idMeal}'>
              <img src='${meal.strMealThumb}' alt='${meal.strMeal}'>
              <h3>${meal.strMeal}</h3>
            </a>
          `;

          slider.appendChild(card);
          setupLikeButton(meal.idMeal);
        });
      }
    } catch (error) {
      console.error(`Failed to fetch meal ${mealId}:`, error);
    }
  }
});

async function setupLikeButton(mealId) {
  const checkbox = document.querySelector(`#like-${mealId}`);
  const heartLabel = document.querySelector(`label[for='like-${mealId}']`);

  // Check initial like status
  const user = auth.currentUser;
  if (user) {
    const userRef = doc(db, "users", user.uid);
    const userDoc = await getDoc(userRef);
    
    if (userDoc.exists()) {
      const savedRecipies = userDoc.data().savedRecipies      || [];
      checkbox.checked = savedRecipies.includes(mealId);
      if (checkbox.checked) heartLabel.classList.add('liked');
    }
  }

  // Handle like/unlike
  checkbox.addEventListener('change', async () => {
    const user = auth.currentUser;
    
    if (!user) {
      alert('Please log in to like recipes');
      checkbox.checked = false;
      return;
    }

    const userRef = doc(db, "users", user.uid);

    try {
      if (checkbox.checked) {
        await updateDoc(userRef, {
          savedRecipies: arrayUnion(mealId)
        });
        heartLabel.classList.add('liked');
        console.log("Recipe liked!");
      } else {
        await updateDoc(userRef, {
          savedRecipies: arrayRemove(mealId)
        });
        heartLabel.classList.remove('liked');
        console.log("Recipe unliked!");
      }
    } catch (error) {
      console.error("Error updating like:", error);
      
      // Create document if it doesn't exist
      if (error.code === 'not-found') {
        await setDoc(userRef, {
          savedRecipies: checkbox.checked ? [mealId] : []
        });
      } else {
        checkbox.checked = !checkbox.checked; // Revert UI on error
      }
    }
  });
}
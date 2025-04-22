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

window.addEventListener('load', function() {
  const mealContainer = document.querySelector('.card-container');
  
  if (!mealContainer) {
    console.error("Meal container not found");
    return;
  }

  mealContainer.innerHTML = '<div class="loading">Loading recipes...</div>';

  // Fetch all meals from localhost API
  fetch('https://yummyverse.free.nf/src/api/api.php?all=true')
    .then(response => {
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      return response.json();
    })
    .then(async data => {
      if (data.meals && Array.isArray(data.meals)) {
        mealContainer.innerHTML = ''; // Clear loading message

        // Get user's liked recipes if logged in
        let savedRecipies = [];
        const user = auth.currentUser;
        if (user) {
          const userRef = doc(db, "users", user.uid);
          const userDoc = await getDoc(userRef);
          if (userDoc.exists()) {
            savedRecipies = userDoc.data().savedRecipies || [];
          }
        }

        data.meals.forEach((meal, index) => {
          if (meal.strCategory === 'Beef') return;

          const uniqueId = `${meal.idMeal || index}`;
          const isLiked = savedRecipies.some(recipe => recipe.id === uniqueId);

          const card = document.createElement('div');
          card.className = 'card';
          card.innerHTML = `
            <div class='like-container'>
              <input type='checkbox' id='like-${uniqueId}' class='like-checkbox' ${isLiked ? 'checked' : ''}/>
              <label for='like-${uniqueId}' class='heart-label ${isLiked ? 'liked' : ''}'>
                ♥
              </label>
            </div>
            <span class='tag'>${meal.strCategory}</span>
            <a href='viewRecipe.html?mealId=${meal.idMeal}&isLocal=true'>
              <img src='${meal.strMealThumb}' alt='${meal.strMeal}' onerror="this.src='fallback-image.jpg'">
              <h3>${meal.strMeal}</h3>
            </a>
          `;

          mealContainer.appendChild(card);
          setupLikeButton(uniqueId, meal); // pass the full meal object
        });
      }
    })
    .catch(error => {
      console.error('Failed to fetch meals:', error);
      mealContainer.innerHTML = '<div class="error">Failed to load recipes</div>';
    });
});

async function setupLikeButton(mealId, mealData) {
  const checkbox = document.querySelector(`#like-${mealId}`);
  const heartLabel = document.querySelector(`label[for='like-${mealId}']`);

  if (!checkbox || !heartLabel) {
    console.error('Like button elements not found');
    return;
  }

  checkbox.addEventListener('change', async () => {
    const user = auth.currentUser;

    if (!user) {
      alert('Please log in to like recipes');
      checkbox.checked = false;
      return;
    }

    const userRef = doc(db, "users", user.uid);

    const recipeObject = {
      id: mealId,
      title: mealData.strMeal,
      image: mealData.strMealThumb,
      category: mealData.strCategory
    };

    try {
      const userDoc = await getDoc(userRef);
      let currentList = [];

      if (userDoc.exists()) {
        currentList = userDoc.data().savedRecipies || [];
      }

      if (checkbox.checked) {
        // Add only if not already present
        if (!currentList.some(r => r.id === mealId)) {
          await updateDoc(userRef, {
            savedRecipies: arrayUnion(recipeObject)
          });
        }
        heartLabel.classList.add('liked');
      } else {
        // Remove by filtering manually since Firestore can't match object directly
        const updatedList = currentList.filter(r => r.id !== mealId);
        await setDoc(userRef, { savedRecipies: updatedList }, { merge: true });
        heartLabel.classList.remove('liked');
      }
    } catch (error) {
      console.error("Error updating like:", error);
      checkbox.checked = !checkbox.checked;
    }
  });
}
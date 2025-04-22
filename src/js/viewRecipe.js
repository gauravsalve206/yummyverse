const recipeContent = document.getElementById('recipeContent');

// Show loading state early
if (recipeContent) {
    recipeContent.innerHTML = '<p>Loading recipe...</p>';
}

// Get mealId from URL
const urlParams = new URLSearchParams(window.location.search);
const mealId = urlParams.get('mealId');

// Validate mealId
if (!mealId) {
    showAlert('Meal ID not provided in the URL.');
    throw new Error('Missing meal ID.');
}

const mealIdNum = parseInt(mealId, 10);

// Dynamic API selection
const apiUrl = mealIdNum < 50
    ? `https://yummyverse.free.nf/src/api/api.php?id=${mealIdNum}`
    : `https://www.themealdb.com/api/json/v1/1/lookup.php?i=${mealIdNum}`;

// Fetch Recipe
fetch(apiUrl)
    .then(response => response.json())
    .then(data => {
        if (!data.meals || !data.meals.length) {
            showAlert('No meal found.');
            return;
        }

        const meal = data.meals[0];

        // Block beef category
        if (meal.strCategory === 'Beef') {
            showAlert('This recipe contains Beef and is not allowed as per our standards.');
            return;
        }

        // Embed YouTube video
        const youtubeEmbed = meal.strYoutube ? getYouTubeEmbed(meal.strYoutube) : '';

        // Ingredients list
        let ingredients = '<ul>';
        for (let i = 1; i <= 20; i++) {
            const ingredient = meal[`strIngredient${i}`];
            const measure = meal[`strMeasure${i}`];
            if (ingredient && ingredient.trim()) {
                ingredients += `<li>${ingredient} - ${measure}</li>`;
            }
        }
        ingredients += '</ul>';

        // Update HTML content
        recipeContent.innerHTML = `
            <h2>${meal.strMeal}</h2>
            <div class="video-container">${youtubeEmbed}</div>
            <p><strong>Category:</strong> ${meal.strCategory}</p>
            <h4>Ingredients</h4>
            ${ingredients}
            <h4>Instructions</h4>
            <p>${meal.strInstructions.replace(/\n/g, '<br>')}</p>
        `;
    })
    .catch(err => {
        console.error(err);
        showAlert('Error fetching meal details.');
    });

// YouTube Video Embed - Responsive
function getYouTubeEmbed(url) {
    const match = url.match(/(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|.*[?&]v=))([^#&?]+)/);
    const videoId = match ? match[1] : null;

    if (videoId) {
        return `
            <iframe 
                src="https://www.youtube.com/embed/${videoId}" 
                frameborder="0" 
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                allowfullscreen>
            </iframe>`;
    } else {
        return '<p>No valid YouTube video available.</p>';
    }
}

// Simple alert wrapper
function showAlert(message) {
    alert(message);
}
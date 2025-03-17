const recipeContent = document.getElementById('recipeContent');

// Get the mealId from URL
const urlParams = new URLSearchParams(window.location.search);
const mealId = urlParams.get('mealId');

// Check if mealId is provided
if (!mealId) {
    showAlert('Meal ID not provided in the URL.');
}

// API Endpoint - Dynamic Based on ID
const apiUrl = mealId < 50
    ? `https://localhost/cpp/src/api/api.php?id=${mealId}`
    : `https://www.themealdb.com/api/json/v1/1/lookup.php?i=${mealId}`;

// Fetch Recipe Details
fetch(apiUrl)
    .then(response => response.json())
    .then(data => {
        if (data.meals === null || !data.meals.length) {
            showAlert('No meal found.');
            return;
        }

        const meal = data.meals[0];

        // Exclude Beef recipes
        if (meal.strCategory === 'Beef') {
            showAlert('This recipe contains Beef and is not allowed as per our standards.');
            return;
        }

        // YouTube Video Embed
        const youtubeEmbed = meal.strYoutube ? getYouTubeEmbed(meal.strYoutube) : '';

        // Generate Ingredients List
        let ingredients = '<ul>';
        for (let i = 1; i <= 20; i++) {
            const ingredient = meal[`strIngredient${i}`];
            const measure = meal[`strMeasure${i}`];
            if (ingredient && ingredient.trim() !== '') {
                ingredients += `<li>${ingredient} - ${measure}</li>`;
            }
        }
        ingredients += '</ul>';

        // Append Data to Content
        recipeContent.innerHTML = `
                    <h3>Meal Name: ${meal.strMeal}</h3>
                    ${youtubeEmbed}
                    <div><strong>Category:</strong> ${meal.strCategory}</div>
                    <div><strong>Ingredients:</strong> ${ingredients}</div>
                    <div><strong>Instructions:</strong> ${meal.strInstructions.replace(/\n/g, '<br>')}</div>
                `;
    })
    .catch(err => {
        console.error(err);
        showAlert('Error fetching meal details.');
    });

// Function to Embed YouTube Video
// Function to Embed YouTube Video
// Function to Embed YouTube Video
function getYouTubeEmbed(url) {
    if (!url) return '<p>No YouTube link available</p>'; // Handle missing URL
    
    console.log("YouTube URL:", url); // Debugging line to confirm the URL

    // Improved regex for different YouTube link formats
    const videoIdMatch = url.match(
        /(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|.*[?&]v=))([^#&?]+)/
    );
    const videoId = videoIdMatch ? videoIdMatch[1] : null;

    console.log("Extracted videoId:", videoId); // Debugging line to confirm video ID

    if (videoId) {
        return `
            <iframe width="560" height="315" 
                src="https://www.youtube.com/embed/${videoId}?autoplay=1&controls=1" 
                frameborder="0" 
                allow="autoplay; encrypted-media" 
                allowfullscreen>
            </iframe>`;
    } else {
        return '<p>Invalid YouTube link</p>';
    }
}


// Function to Show Alert
function showAlert(message) {
    alert(message);
}
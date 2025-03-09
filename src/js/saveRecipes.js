window.addEventListener('load', function() {
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
    if (!firebase.apps.length) {
      firebase.initializeApp(firebaseConfig);
    }
  
    const db = firebase.firestore();
    const auth = firebase.auth();
  
    // Handle Like Button Click
    document.getElementById("likeButon").addEventListener('click', function(event) {
      alert("Click");
        const mealId = event.target.getAttribute('data-mealId');
  
        // Check if user is authenticated
        auth.onAuthStateChanged(user => {
          if (user) {
            const userId = user.uid;
            
            // Reference to user's likedMeals sub-collection
            const mealRef = db.collection('users').doc(userId).collection('likedMeals').doc(mealId);
  
            // Set only mealId without any other data
            mealRef.set({ mealId: mealId })
              .then(() => {
                alert('Meal Liked Successfully!');
              })
              .catch(err => {
                console.error('Error Liking Meal:', err);
              });
          } else {
            alert('Please login to like the meal.');
          }
        });
      
    });
  });
  
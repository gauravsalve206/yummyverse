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
            const savedRecipeIds = userData.savedRecipies; // Handle the case where savedRecipies might be undefined
            resolve(savedRecipeIds);
          } else {
            console.log("User document not found!");
            resolve();
          }
        } catch (error) {
          console.error("Error fetching saved recipes:", error);
          reject(error);
        }
      } else {
        console.log("No user is currently signed in.");
        resolve();
      }
    });
  });
}

// Array to store the fetched recipe IDs
let recipeIdsArray =[]; 

fetchSavedRecipeIds()
  .then(recipeIds => {
    recipeIdsArray = recipeIds; // Store the fetched IDs in the array

    if (recipeIdsArray.length > 0) {
      recipeIdsArray.forEach(recipeId => {
        console.log("Recipe ID:", recipeId);
      });
    } else {
      console.log("No saved recipes found for this user.");
    }
  })
  .catch(error => {
    console.error("Error fetching recipe IDs:", error);
  });
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

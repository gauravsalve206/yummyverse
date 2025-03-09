// Firebase Configuration
import { initializeApp } from "https://www.gstatic.com/firebasejs/10.6.0/firebase-app.js";
import { getAuth, signOut, onAuthStateChanged, setPersistence, browserSessionPersistence } 
  from "https://www.gstatic.com/firebasejs/10.6.0/firebase-auth.js";

// Initialize Firebase
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

// Set session persistence to automatically log out on tab close
setPersistence(auth, browserSessionPersistence)
    .then(() => console.log('Session persistence set to browser session.'))
    .catch((error) => console.error('Error setting persistence:', error));

// Update Navbar Based on Auth State
window.addEventListener('DOMContentLoaded', () => {
    const loginLink = document.querySelector('.navcontent ul li a[href="loginSignup.html"]');

    if (!loginLink) {
        console.error('Login link not found in DOM.');
        return;
    }

    onAuthStateChanged(auth, (user) => {
        if (user) {
            loginLink.textContent = "Dashboard";
            loginLink.href = "dashboard.html"; // Redirect to user's dashboard
        } else {
            loginLink.textContent = "Login";
            loginLink.href = "loginSignup.html";
        }
    });
});

// Automatically log out the user when the tab or browser is closed
window.addEventListener('DOMContentLoaded', () => {
    const logoutBtn = document.getElementById('logoutBtn');

    if (logoutBtn) {
        logoutBtn.addEventListener('click', () => {
            alert("click")
            signOut(auth)
                .then(() => {
                    alert("Logged out successfully!");
                    window.location.href = "loginSignup.html"; // Redirect to login page
                })
                .catch((error) => {
                    console.error('Logout error:', error);
                    alert("Error logging out. Please try again.");
                });
        });
    }
});

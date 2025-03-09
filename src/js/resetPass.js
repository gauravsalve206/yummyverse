// Firebase Imports
import { initializeApp } from "https://www.gstatic.com/firebasejs/11.4.0/firebase-app.js";
import { getAuth, sendPasswordResetEmail } from "https://www.gstatic.com/firebasejs/11.4.0/firebase-auth.js";

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

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const auth = getAuth(app);

document.addEventListener("DOMContentLoaded", () => {
    const resetPasswordLink = document.getElementById("resetPassword");

    if (!resetPasswordLink) {
        console.error("❌ #resetPassword element not found!");
        return;
    }

    resetPasswordLink.addEventListener("click", (event) => {
        event.preventDefault(); // Prevent default link behavior

        const email = document.getElementById("email").value;

        if (!email) {
            alert("❗ Please enter your email before requesting a reset link.");
            return;
        }

        sendPasswordResetEmail(auth, email)
            .then(() => {
                alert(`✅ Password reset email sent to: ${email}`);
            })
            .catch((error) => {
                console.error("❌ Error sending password reset email:", error.message);
                alert(`❌ Error: ${error.message}`);
            });
    });
});

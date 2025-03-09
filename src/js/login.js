// Firebase Imports
import { initializeApp } from "https://www.gstatic.com/firebasejs/11.4.0/firebase-app.js";
import { getAuth, signInWithEmailAndPassword, sendPasswordResetEmail } from "https://www.gstatic.com/firebasejs/11.4.0/firebase-auth.js";

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
const rbtn = document.getElementById("rpass")
// Login Logic
document.getElementById("logbtn").addEventListener("click", (e) => {
    e.preventDefault();

    alert("Login Successfull!!");
    const email = document.getElementById("email").value;
    const password = document.getElementById("pass").value;

    signInWithEmailAndPassword(auth, email, password)
        .then((userCredential) => {
            window.location.href = "index.html";

        })
        .catch((error) => {
            alert(`❌ Error: ${error.message}`);
        });
});

// Toggle between Login and Registration
const container = document.querySelector(".container");

document.querySelector(".register-btn").addEventListener("click", () => {
    container.classList.add("active");
});

document.querySelector(".login-btn").addEventListener("click", () => {
    container.classList.remove("active");
});

rbtn.addEventListener("click", function () {
    console.log("clicked")
})



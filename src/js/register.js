// Firebase Imports
import { initializeApp } from "https://www.gstatic.com/firebasejs/11.4.0/firebase-app.js";
import { getAuth, createUserWithEmailAndPassword } from "https://www.gstatic.com/firebasejs/11.4.0/firebase-auth.js";
import { getFirestore, doc, setDoc } from "https://www.gstatic.com/firebasejs/11.4.0/firebase-firestore.js";

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
const db = getFirestore(app);

// Registration Logic
document.getElementById("regbtn").addEventListener("click", async (e) => {
    e.preventDefault();

    const email = document.getElementById("emailReg").value;
    const uname=document.getElementById('uname').value
    const password = document.getElementById("passReg").value;

    try {
        const userCredential = await createUserWithEmailAndPassword(auth, email, password,uname);
        const user = userCredential.user;

        // Store user details in Firestore
        await setDoc(doc(db, "users", user.uid), {
            Email: email,
            Role: "User",  // Default role as "User"
            Uid: user.uid,
            Username:uname
        });

        alert("🎉 Registration Successful! Your details have been saved.");
    } catch (error) {
        alert(`❌ Error: ${error.message}`);
    }
});

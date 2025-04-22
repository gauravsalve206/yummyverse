import { initializeApp } from "https://www.gstatic.com/firebasejs/10.11.0/firebase-app.js";
import { getAuth } from "https://www.gstatic.com/firebasejs/10.11.0/firebase-auth.js";
import { 
  getFirestore,
  doc,
  setDoc,
  updateDoc,
  arrayUnion,
  arrayRemove,
  getDoc
} from "https://www.gstatic.com/firebasejs/10.11.0/firebase-firestore.js";

const firebaseConfig = {
  apiKey: "AIzaSyAZKbYYMLOrJebgWpf_cW-cJ50qxgVVsak",
  authDomain: "yummyverse-793ad.firebaseapp.com",
  projectId: "yummyverse-793ad",
  storageBucket: "yummyverse-793ad.appspot.com",
  appId: "1:179075175539:web:7b7f9461481801d8c94606"
};

const app = initializeApp(firebaseConfig);
const auth = getAuth(app);
const db = getFirestore(app);

// Export for use in other files
export { auth, db, doc, setDoc, updateDoc, arrayUnion, arrayRemove, getDoc };
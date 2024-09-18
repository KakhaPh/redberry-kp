import './bootstrap';

import { initializeApp } from "firebase/app";

const firebaseConfig = {
  apiKey: "AIzaSyAdTp_M_vB8L2Y5QFMvcQWKZPqUyBsm1Io",
  authDomain: "redberry-kp.firebaseapp.com",
  projectId: "redberry-kp",
  storageBucket: "redberry-kp.appspot.com",
  messagingSenderId: "102077587892",
  appId: "1:102077587892:web:acc0216caa74d9731e12e1"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);

<?php
session_start();
include_once "../Models/Services/tokenservices.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   // Récupérer les valeurs soumises du formulaire
   $username = $_POST['username'];
   $password = $_POST['password'];
   include_once "../Models/Database/daoUsers.php";
   $user = findUserByEmailAndPassword($username, $password);
   if ($user) {

      if ($user['role'] == "1")
         $_SESSION['SuperUser'] = true;
      $_SESSION['LOGIN'] = $user['username'];
      $_SESSION['token'] = generateToken($user['id']);
      header('Location: ../index.php');

   } else {
      header('Location: ../Views/inscription.php?login=1&msgErreur=Username et/ou mot de passe incorrecte');
   }
}
if (isset($_GET['logout'])) {
   session_destroy();
   header('Location: ../index.php');
}
<?php
// inscriptionController.php
include_once "../Models/Database/daoUsers.php";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   // Récupérer les valeurs soumises du formulaire
   $username = $_POST['username'];
   $password = $_POST['password'];
   $confirmPassword = $_POST['confirmPassword'];

   include_once '../Models/Services/createAccount.php';
   $msgErreur = checkSubmitteddata($username, $password, $confirmPassword);
   // Vérifier s'il y a des erreurs
   if (count($msgErreur) > 0) {
      // Il y a des erreurs, afficher les messages personnalisés
      header('Location: ../Views/inscription.php?msgErreur=' . implode('<br>', $msgErreur));
   } else {
      $token = bin2hex(random_bytes(32));
      registerUser($username, $password, $token);
      session_start();
      $_SESSION['LOGIN'] = $username;
      $_SESSION['token'] = $token;
      header('Location: ../index.php');
   }
}
?>
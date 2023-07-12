<?php

function checkSubmitteddata($username, $password, $confirmPassword)
{
   $msgErreur = []; // Variable pour stocker les messages d'erreur

   // Validation du nom d'utilisateur (minimum 3 lettres)
   if (strlen($username) < 3) {
      $msgErreur[] = "Le nom d'utilisateur doit comporter au moins 3 lettres";
   }
   include_once "../Models/Database/daoUsers.php";
   // Validation de l'unicité de l'email (vérification dans la base de données)
   $resultat = manageUsername($username);

   if ($resultat > 0) {
      $msgErreur[] = "Cet nom d'utilisateur est déjà utilisé, veuillez en choisir un autre";
   }

   // Validation des mots de passe correspondants
   if ($password !== $confirmPassword) {
      $msgErreur[] = "Les mots de passe ne correspondent pas";
   }
   return $msgErreur;
}
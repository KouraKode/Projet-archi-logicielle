<?php
function connexion()
{
   $serveur = 'localhost';
   $utilisateur = 'az';
   $motDePasse = 'passer';
   $baseDeDonnees = 'actuapp';
   try {
      $connexion = new PDO("mysql:host=$serveur;dbname=$baseDeDonnees", $utilisateur, $motDePasse);
      $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $connexion;
   } catch (PDOException $e) {
      echo "connexion echoue  ," . $e->getMessage();
   }
}
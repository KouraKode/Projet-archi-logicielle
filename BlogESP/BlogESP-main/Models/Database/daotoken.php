<?php
include_once "daoConnexion.php";

function storeToken($id, $token)
{
   $connexion = connexion();
   $requete = $connexion->prepare("UPDATE users SET token = :token WHERE id = :id");
   $requete->execute([':token' => $token, ':id' => $id]);

}

function getToken($username)
{
   $connexion = connexion();
   $requete = $connexion->prepare("SELECT token FROM users WHERE username = :username");
   $requete->execute([':username' => $username]);
   return $requete->fetch();
}
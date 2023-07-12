<?php
include_once "daoConnexion.php";

function manageUsername($username)
{


   $connexion = connexion();
   $requete = $connexion->prepare("SELECT COUNT(*) FROM users WHERE username = :username");
   $requete->execute(['username' => $username]);
   $resultat = $requete->fetchColumn();
   return $resultat;
}

function registerUser($username, $password, $token)
{
   try {

      $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
      $connexion = connexion();
      $requete = $connexion->prepare("INSERT INTO users (username, password,token) VALUES (:username, :password, :token)");
      $requete->execute(['username' => $username, 'password' => $hashedPassword, 'token' => $token]);
   } catch (PDOException $e) {
      echo $e->getMessage();
   }
}

function findUserByEmailAndPassword($username, $password)
{
   $connexion = connexion();
   $requete = $connexion->prepare("SELECT * FROM users WHERE username = :username");
   $requete->execute(['username' => $username]);

   $user = $requete->fetch();

   if ($user && password_verify($password, $user['password'])) {
      // Mot de passe correct, retourner les informations de l'utilisateur
      return $user;
   }

   return null; // Utilisateur non trouvé ou mot de passe incorrect
}


function getUsers()
{
   $connexion = connexion();
   $requete = $connexion->prepare("SELECT id, username,role ,token FROM users");
   $requete->execute();

   return $requete->fetchAll();

}
function getUser($id)
{
   $connexion = connexion();
   $requete = $connexion->prepare("SELECT username,role FROM users where id= :id");
   $requete->execute(['id' => $id]);
   return $requete->fetch();

}

function deleteUser($id)
{
   $connexion = connexion();
   $requete = $connexion->prepare("DELETE from users where id= :id");
   $requete->execute(['id' => $id]);
}
function updateUser($id, $username, $password, $isAdmin)
{
   $connexion = connexion();
   $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
   $requete = $connexion->prepare("UPDATE users set username = :username, password = :password, role = :isAdmin where id = :id");
   $requete->execute(['username' => $username, 'password' => $hashedPassword, 'isAdmin' => $isAdmin, 'id' => $id]);

}
function adminAddUser($username, $password, $isAdmin)
{
   $connexion = connexion();
   $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
   $requete = $connexion->prepare("INSERT INTO users (username, password,role) VALUES (:username, :password, :isAdmin)");
   $requete->execute(['username' => $username, 'password' => $hashedPassword, 'isAdmin' => $isAdmin]);

}

function supprimerToken($id)
{
   $connexion = connexion();
   $requete = $connexion->prepare("UPDATE users set token = null where id= :id");
   $requete->execute(['id' => $id]);
}
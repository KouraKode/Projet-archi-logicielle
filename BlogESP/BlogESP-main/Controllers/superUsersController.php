<?php
session_start();

if (!isset($_SESSION['SuperUser']))
   exit();


define('ROOT', 'C:/xampp/htdocs/BlocESP/');
include_once ROOT . "Models/Database/daoUsers.php";
include_once ROOT . "Models/Services/tokenServices.php";


$username = $_SESSION['LOGIN'];
$token = $_SESSION['token'];
if (verifyToken($username, $token)) {

   if ($_SERVER['REQUEST_METHOD'] === 'GET') {



      if (isset($_GET['methode'])) {

         if (($_GET['methode'] == "supprimer")) {
            $id = $_GET['id'];
            deleteUser($id);
            unset($_GET['delete']);
            header('Location: /superUser');
         }
         if (($_GET['methode'] == "supprimerToken")) {
            $id = $_GET['id'];
            supprimerToken($id);
            unset($_GET['delete']);
            header('Location: /superUser');
         }
         if ($_GET['methode'] == 'modifier') {
            $id = $_GET['id'];
            $user = getUser($id);
            include_once(ROOT . "Views/modifyUser.php");
            exit();
         }
         if ($_GET['methode'] == 'ajouter') {
            include_once(ROOT . "Views/ajouterUser.php");
            exit();
         }
      }
   }

   if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Récupérer les valeurs soumises du formulaire

      if (isset($_GET['methode'])) {
         $username = $_POST['username'];
         $password = $_POST['password'];
         $isAdmin = isset($_POST['isAdmin']) ? 1 : 0;

         //si la methode est modifier on recupere l id du user
         if ($_GET['methode'] == 'modifier') {
            $id = $_GET['id'];
            updateUser($id, $username, $password, $isAdmin);

         }
         //si la methode est ajouter , on store le user dans la base de donnees
         else if ($_GET['methode'] == 'ajouter') {
            adminAddUser($username, $password, $isAdmin);
         }
         header('Location: /superUser');
      }
   }

   $users = getUsers();
   include_once ROOT . "/Views/admindashboard.php";

}
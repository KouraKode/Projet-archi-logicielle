<?php

include_once "daoConnexion.php";



function getCategoriesOrArticles($categorieOrArticle)
{
   try {
      $connexion = connexion();
      $requete = $connexion->prepare('SELECT * FROM ' . $categorieOrArticle);
      $requete->execute();
      $donnees = $requete->fetchAll();
      return $donnees;
   } catch (PDOException $e) {
      echo 'getCategoriesOrArticles  ' . $e->getMessage();
   }
}

function getArticlesDependingOncategorie(int $categorie_id)
{
   $connexion = connexion();

   try {

      $requete = $connexion->prepare('SELECT * FROM article WHERE categorie = :categorie_id');
      $requete->execute([
         ':categorie_id' => $categorie_id,
      ]);
      return $requete->fetchAll();
   } catch (PDOException $e) {
      echo 'getArticlesDependingOncategorie  ' . $e->getMessage();
   }
}

function getArtcicleDependingOnId(int $id)
{
   $connexion = connexion();
   try {

      $requete = $connexion->prepare('SELECT * FROM article WHERE id = :id');
      $requete->execute([
         ':id' => $id
      ]);

      return $requete->fetch();
   } catch (PDOException $e) {
      echo 'getArtcicleDependingOnId  ' . $e->getMessage();
   }
}

function ajouterArticle($titre, $contenu, $categorie_id)
{
   $connexion = connexion();
   try {

      $requete = $connexion->prepare('INSERT INTO article (titre, contenu, categorie, dateModification ) VALUES (:titre, :contenu, :categorie_id, NOW())');
      $requete->execute([
         ':titre' => $titre,
         ':contenu' => $contenu,
         ':categorie_id' => $categorie_id

      ]);
   } catch (PDOException $e) {
      echo 'ajouterArticle  ' . $e->getMessage();
   }
}
function modifierArticle($titre, $contenu, $categorie_id, $id)
{
   $connexion = connexion();
   try {

      $requete = $connexion->prepare("UPDATE article SET titre = :titre, contenu = :contenu , categorie = :categorie_id ,  dateModification = NOW() WHERE id = :id");
      $requete->execute([
         ':titre' => $titre,
         ':contenu' => $contenu,
         ':categorie_id' => $categorie_id,
         ':id' => $id
      ]);
   } catch (PDOException $e) {
      echo 'modifierArticle  ' . $e->getMessage();
   }
}
function supprimerArticle($id)
{
   $connexion = connexion();
   $requete = $connexion->prepare('DELETE FROM article WHERE id = :id');
   $requete->execute([
      ':id' => $id
   ]);
}


function maxId()
{
   $connexion = connexion();
   $requete = $connexion->prepare('SELECT MAX(id) FROM categorie');
   $requete->execute();
   $donnees = $requete->fetch();
   return $donnees[0];
}
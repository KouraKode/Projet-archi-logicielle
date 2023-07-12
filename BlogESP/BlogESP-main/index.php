<?php

session_start();

define('ROOT', 'C:/xampp/htdocs/BlocESP/');
include_once ROOT . "Models/Database/daoArticleAndCategories.php";

$categories = getCategoriesOrArticles('categorie');

$id = isset($_GET['categorie']) ? $_GET['categorie'] : 0;

$active = $id;

// id = 0 alors on recupere tous les articles sinon on recupere les articles de la categorie 
$articles = $id == 0 ? getCategoriesOrArticles('article') : getArticlesDependingOncategorie($id);
$articles_par_page = 5;
$page_actuelle = isset($_GET['page']) ? $_GET['page'] : 1;

// Calculer le nombre total de pages
$total_pages = ceil(count($articles) / $articles_par_page);

// Récupérer les articles pour la page actuelle
$index_debut = ($page_actuelle - 1) * $articles_par_page;
$articles = array_slice($articles, $index_debut, $index_debut + $articles_par_page);



include_once(ROOT . 'Views/home.php');
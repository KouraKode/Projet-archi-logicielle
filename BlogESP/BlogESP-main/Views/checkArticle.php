<!DOCTYPE html>
<html>

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Bloc ESP - Page d'accueil</title>
   <link rel="stylesheet" href="../src/style/form.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
   <div class="container">
      <a href="/accueille" class="back"><button>&laquo;--retour a l acueille</button></a>


      <article>
         <h3>
            <?= $article['titre'] ?>
         </h3>
         <p>
            <?= $article['contenu'] ?>
         </p>
         <div class="bas">

            <p>Ajouter le :
               <?= $article['dateCreation'] ?>
            </p>
            <p>Modifier le :
               <?= $article['dateModification'] ?>
            </p>
            <?php
            if (isset($_SESSION['LOGIN'])):
               ?>
            <p>
               <a href="/modifier_article/<?= $article['id'] ?>">modifier</a>
               <a href="/supprimer_article/<?= $article['id'] ?>">supprimer</a>
            </p>
            <?php endif; ?>
         </div>
      </article>

   </div>
</body>

</html>
<style>
.bas {
   display: flex;
   flex-direction: row;
   align-items: center;
   gap: 10px;
}

.bas a {
   text-decoration: none;
   color: var(--primary);
}

.back button {
   /* border: none; */
   border-radius: 20px;
   margin-top: 20px;
   padding: 5px;
   outline: none;
   cursor: pointer;
   margin-left: 20px;
}

article {
   flex: 1;
   border-color: black;
   border-radius: 30px;
   display: flex;
   flex-direction: column;
   /* gap: 10px; */
   margin: 10px;
   padding-left: 20px;
   padding: 20px;
   background-color: #B5DEEf;
}

article:hover {
   background-color: #B5DEE3;
   cursor: pointer;
}
</style>
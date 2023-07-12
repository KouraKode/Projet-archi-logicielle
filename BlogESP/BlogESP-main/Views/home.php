<!DOCTYPE html>
<html>

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Bloc ESP - Page d'accueil</title>
   <link rel="stylesheet" href="../src/style/index.css">
</head>

<body>
   <?php

   include_once(ROOT . 'Views/components/header.php');

   ?>
   <h2 style="text-align: center;">Les dernières actualités</h2>
   <div>
      <?php
      include_once(ROOT . 'Views/components/article.php');
      ?>
   </div>
   <?php include_once(ROOT . 'Views/components/footer.php');
   ?>
</body>

</html>
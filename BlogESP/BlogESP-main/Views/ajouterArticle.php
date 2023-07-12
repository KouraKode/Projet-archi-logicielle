<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Ajouter un Article</title>
   <link rel="stylesheet" href="../src/style/form.css">
</head>

<body>
   <?php
   if (isset($_SESSION['LOGIN'])) { ?>

      <div>

         <div class="container">
            <div class="banner">
               <text>Bonjour <?= $_SESSION['LOGIN'] ?> creez un article </text>
            </div>
            <form method="POST" action="/ajouter_article">
               <div>
                  <label for="categorie">Categorie</label>
                  <select name="categorie_id">
                     <?php foreach ($categories as $categorie) : ?>
                        <?php if ($categorie['id'] == $categorie_id) : ?>
                           <option value="<?= $categorie['id'] ?>" selected><?= $categorie['libelle'] ?></option>
                        <?php else : ?>
                           <option value="<?= $categorie['id'] ?>"><?= $categorie['libelle'] ?></option>
                        <?php endif; ?>
                     <?php endforeach; ?>
                  </select>
               </div>
               <div>
                  <label for="titre">Titre</label>
                  <input type="text" name="titre" />
               </div>
               <div>
                  <label for="contenu">Contenu</label>
                  <textarea style="min-height: 200px; resize: none" name="contenu"></textarea>

               </div>
               <button type="submit">Valider</button>
            </form>
         </div>
      </div>
   <?php
   } else { ?>
      <div style="text-align: center">
         <p style="color: red">Vous n'êtes pas connecté !</p>
      </div>

   <?php
   } ?>

</body>

</html>
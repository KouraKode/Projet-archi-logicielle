<?php
define('ROOT', 'C:/xampp/htdocs/BlocESP/');

$login = isset($_GET['login']) ? true : false;
$msgErreur = "";
if (isset($_GET['msgErreur'])) {
   $msgErreur = $_GET['msgErreur'];
} ?>


<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Inscription</title>
   <link rel="stylesheet" href="../src/style/form.css">
</head>

<body>
   <div class="container">
      <div class="banner">
         <?php if ($login): ?><text> Nous Sommes Ravi de vous compter parmi nous</text>
         <?php else: ?><text>
            Bienvenu</text>
         <?php endif; ?>
      </div>
      <div>
         <p class="erreur">
            <?= $msgErreur ?>
         </p>
      </div>
      <form method="POST" action="../Controllers/inscriptionController.php"
         style="<?php if ($login): ?>display:none<?php endif; ?>">
         <div>
            <label for="username">Nom de l'utilisateur</label>
            <input type="text" name="username" />
         </div>
         <div>
            <label for="password">Mot de passe</label>
            <input type="password" name="password" />
         </div>
         <div>
            <label for="confirmPassword">Confirmer Votre mot de passe</label>
            <input type="password" name="confirmPassword" />
         </div>
         <button type="submit">S'inscrire</button>
      </form>
      <form method="POST" action="../Controllers/loginController.php"
         style="<?php if ($login): ?>display:block<?php else: ?> display:none<?php endif; ?>">
         <div>
            <label for="username">Nom de l'utilisateur</label>
            <input type="text" name="username" />
         </div>
         <div>
            <label for="password">Mot de passe</label>
            <input type="password" name="password" />
         </div>
         <button type="submit">Se connecter</button>
      </form>
      <?php if (!$login): ?>
      <text>Vous avez deja un Compte ? <a href="?login=1">connecter vous</a></text>
      <?php else: ?>
      <text>Vous n'avez pas un Compte ? <a href="?">creez en un</a></text>
      <?php endif; ?>
   </div>
</body>
<?php
include_once ROOT . 'Views/components/footer.php';
?>

</html>
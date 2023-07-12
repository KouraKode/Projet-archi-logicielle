<?php

if (!empty($articles)) {

   foreach ($articles as $article) { ?>
<article>
   <a href=<?= "/article/" . $article['id'] ?>>

      <h3>
         <?= $article['titre'] ?>
      </h3>
      <p>
         <?= $article['contenu'] ?>
      </p>
      <div class="bas">
         <div class="bas-info">

            <p>Ajouter le :
               <?= $article['dateCreation'] ?>
            </p>
            <p>Modifier le :
               <?= $article['dateModification'] ?>
            </p>
         </div>
         <?php
               if (isset($_SESSION['LOGIN'])):
                  ?>
         <a href="/modifier_article/<?= $article['id'] ?>">modifier</a>
         <a href="/supprimer_article/<?= $article['id'] ?>">supprimer</a>
         <?php endif; ?>
      </div>
   </a>
</article>

<?php
   }
} else { ?>

<div>
   <p style="font-size: 25px;font-style: bold;text-align: center">Pas d'articles pour cette categorie pour le moment ,
      rester a l' écoute 🚀🚀🚀🔥</p>
</div>
<?php } ?>
<div class="pagination">
   <?php if ($page_actuelle > 1): ?>
   <a href="<?= '?page=' . ($page_actuelle - 1) ?>" class="previous">&laquo; Precedent</a>
   <?php endif; ?>

   Page
   <?= $page_actuelle ?> sur
   <?= $total_pages ?>

   <?php if ($page_actuelle < $total_pages): ?>
   <a href="<?= '?page=' . ($page_actuelle + 1) ?>" class="next">Suivant &raquo;</a>
   <?php endif; ?>
</div>
<style>
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

.pagination {
   /* display: flex; */
   flex-direction: row;
   margin-left: 20px;
}

.pagination a {
   text-decoration: none;
   display: inline-block;
   padding: 8px 16px;
}

.pagination a:hover {
   background-color: #ddd;
   color: black;
}

.previous {
   background-color: #f1f1f1;
   color: black;
}

.next {
   background-color: #04AA6D;
   color: white;
}

article a {
   text-decoration: none;
   color: inherit;
}

.bas-info {
   color: gray;
   display: flex;
   flex-direction: row;
   margin-right: 20px;
   gap: 10px;
}
</style>
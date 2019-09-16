        <section>
            <h3>Blog</h3>
            <div class="listeBlog">
                <!--container pour Flexbox -->
                <?php

require "php/mes-fonctions.php";
$tabArticle = lireTable("blog");
foreach($tabArticle as $ligneAsso)
{
    $titre = $ligneAsso["titre"];
    $contenu = $ligneAsso["contenu"];
    $photo = $ligneAsso["photo"];
    // ... à compléter
    // construire le code HTML
    echo
<<<CODEHTML
    <article>
        <h3>$titre</h3>
        <img src="$photo" alt="$photo">
        <p>$contenu</p>
    </article>
CODEHTML;
}
?>
            </div>
        </section>

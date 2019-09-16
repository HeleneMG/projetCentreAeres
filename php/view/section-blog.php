        <section>
            <h3>Blog</h3>
            <div class="listeBlog">
                <!--container pour Flexbox -->
                <?php
// ON VA AFFICHER LA LISTE DES ARTICLES
// etape1: il faut charger mes fonctions
require "php/mes-fonctions.php";

// etape2: on appelle la fonction
$tabArticle = lireTable("blog");

// on fait une boucle pour parcourir la liste des articles
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

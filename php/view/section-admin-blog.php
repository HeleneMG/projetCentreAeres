<section>
    <h3>Admin: Blog UPDATE</h3>

    <!-- formulaire de création d'article de blog -->
    <form action="api-json.php" method="POST">
        <label>
            <p>id</p>
            <input type="text" name="id" required placeholder="entrez id">
        </label>
        <label>
            <p>titre</p>
            <input type="text" name="titre" required placeholder="entrez le titre">
        </label>
        <label>
            <p>contenu</p>
            <textarea name="contenu" cols="80" rows="10" required placeholder="entrez le contenu"></textarea>
        </label>
        <label>
            <p>photo</p>
            <input type="text" name="photo" required placeholder="choisissez la photo" value="assets/images/photo1.jpg">
        </label>
        <label>
            <p>date publication</p>
            <!--fonction php pour la date: https://www.php.net/manual/fr/function.date.php -->
            <input type="text" name="datePublication" required placeholder="entrez la date" value="<?php echo date("Y-m-d H:i:s")?>">
        </label>
        <label>
            <p>catégorie</p>
            <input type="text" name="categorie" required placeholder="choisissez la photo" value="blog">
        </label>
        <button type="submit">modifier votre article</button>
        <!-- partie technique du formulaire -->
        <div class="confirmation">
            <!-- ici on verra le message de confirmation -->
        </div>
        <input type="hidden" name="idFormulaire" value="blog-update">
    </form>
</section>

<section>
    <h3>Admin: Blog DELETE</h3>
    <form action="api-json.php" method="POST">
        <input type="text" name="nomTable" required placeholder="entrez le nom de la table">
        <input type="number" name="id" required placeholder="entrez id de la ligne">
        <button type="submit">supprimer la ligne</button>
        <div class="confirm"></div>
        <input type="hidden" name="idFormulaire" value="blog-delete">
    </form>
</section>

<section>
    <h3>Admin: Blog CREATE</h3>
    <!-- formulaire de création d'article de blog -->
    <form action="api-json.php" method="POST">
        <label>
            <p>titre</p>
            <input type="text" name="titre" required placeholder="entrez le titre">
        </label>
        <label>
            <p>contenu</p>
            <textarea name="contenu" cols="80" rows="10" required placeholder="entrez le contenu"></textarea>
        </label>
        <label>
            <p>photo</p>
            <input type="text" name="photo" required placeholder="choisissez la photo" value="assets/images/photo1.jpg">
        </label>
        <label>
            <p>date publication</p>
            <!--fonction php pour la date: https://www.php.net/manual/fr/function.date.php -->
            <input type="text" name="datePublication" required placeholder="entrez la date" value="<?php echo date("Y-m-d H:i:s")?>">
        </label>
        <label>
            <p>catégorie</p>
            <input type="text" name="categorie" required placeholder="choisissez la photo" value="blog">
        </label>
        <button type="submit">publier votre article</button>
        <!-- partie technique du formulaire -->
        <div class="confirmation">
            <!-- ici on verra le message de confirmation -->
        </div>
        <input type="hidden" name="idFormulaire" value="blog-create">
    </form>
</section>
<section>
<pre>
    <!-- la balise pre garde les espaces et les retours à la ligne: cool 
    
Create
 Read
  Update
   Delete
   
On stocke les informations en Base De Données SQL (BDD)
* On va créer une BDD pour ce projet (dans phpmyadmin...)
        nom de la BDD:  cms
        charset:        utf8mb4_general_ci

* Dans la BDD cms, on va créer une table SQL pour gérer nos articles
        nom de la table SQL: blog
        colonnes de la table:
id                  INT             INDEX=PRIMARY       A_I(auto_increment)
titre               VARCHAR(160)
contenu             TEXT
photo               VARCHAR(160)
datePublication     DATETIME
categorie           VARCHAR(160)


TYPE DATETIME   YYYY-MM-DD HH:II:SS
* exemple:      2019-09-16 10:20:30
* => lisible par un être humain


INSERT INTO 
`blog` 
(`id`, `titre`, `contenu`, `photo`, `datePublication`, `categorie`) 
VALUES 
(NULL, 'titre1028', 'contenu1028', 'assets/images/photo1.jpg', '2019-09-16 10:28:00', 'blog');
-->
            </pre>
</section>

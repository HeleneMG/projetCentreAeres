<section class="admin-blog">
    <h3>Admin BLOG</h3>
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
            <input type="text" name="categorie" required placeholder="choisissez la catégorie" value="blog">
        </label>
        <button type="submit">Publication</button>

        <div class="confirmation"></div>
        <input type="hidden" name="idFormulaire" value="blog-create">
    </form>
</section>

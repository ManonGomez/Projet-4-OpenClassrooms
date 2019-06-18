<section class="createbutton">
    <div>
       <a href="admin.php"> <button type="button" id="topb" class="btn btn-info" >Ecrire un article</button></a>
        <a href="gestioncom.php"><button type="button" id="topb" class="btn btn-primary">Modérer les commentaires</button></a>
    </div>
</section>
<section class="table">
    <table class="table">
        <thead class="thead-dark">
            <tr>
                
                <th scope="col">Article</th>
                <th scope="col">Lire</th>
                <th scope="col">Modifier</th>
                <th scope="col">Supprimer</th>
            </tr>
        </thead>
        <tbody>
                <?php while ($showarticles = $articles->fetch()) { ?>
            <tr>
                <td scope="col"><a href="article.php?id=<?= $showarticles['IDarticle'] ?>"><?= $showarticles['titlearticle'] ?></a></td>
                <td><a href="article.php?id=<?= $showarticles['IDarticle'] ?>"><button type="button" class="btn btn-success"><i class="fas fa-book-open"></i></button></a></td>
                <td><a href="updatearticle.php?id=<?= $showarticles['IDarticle'] ?>"><button type="button" class="btn btn-warning"><i class="fas fa-pencil-alt"></i></button></a></td>
                <td><a href="delete.php?id=<?= $showarticles['IDarticle'] ?>"><button type="button" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button></a></td>
                 </tr>
                   <?php } ?>
        </tbody>
    </table>
</section>

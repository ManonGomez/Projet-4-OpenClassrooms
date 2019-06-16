<?php
include 'header.php';
include 'bdd.php';

 $articles = $bdd->query('SELECT * FROM articles ORDER BY datearticle ASC');

//selectionner l'article en fonction du titre qui apparait dans la table = celui de la bdd
//$articledelete = $bdd->prepare("DELETE articles(IDarticle, titlearticle, textarticle, datearticle) VALUES(?, ?, ?, ?,)");

//faire un get pour recuperer les champs
//$updateraticle = $bdd->prepare(" UPDATE * FROM  comment(txtcomment, datecomment, pseudocomment) VALUES(?, NOW(), ?)");
//$updatearticle->execute(array($textcomment, $pseudocomment));
?>

<!-- lecture des billets, modification et supression et écriture qui redirige vers admin / modération des commentaire !-->
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



<?php
include 'footer.php';
?>

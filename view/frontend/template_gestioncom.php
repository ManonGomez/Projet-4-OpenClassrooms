<section class="tablecom">
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Commentaire</th>
                <th scope="col">valider</th>
                <th scope="col">Supprimer</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($showcom = $comment->fetch()) { ?>
            <tr>
                <th scope="row"><a href="article.php?id=<?= $showcom['IDcomment'] ?>"><?= $showcom['txtcomment'] ?></a></th>
                <td><a href="validcom.php?id=<?= $showcom['IDcomment'] ?>"><button type="button" class="btn btn-success"><i class="fas fa-check"></i></button></a></td>
                 <td><a href="deletecom.php?id=<?= $showcom['IDcomment'] ?>"><button type="button" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button></a></td>
            </tr>
             <?php } ?>
        </tbody>
    </table>
</section>


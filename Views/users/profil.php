<div class="container">
    <a href="/ajoutProduct" class="btn btn-primary">Créer un produit</a>
</div>

<div class="container">
    <!-- <?php var_dump($products) ?> -->

    <table class="table table-hover">
        <thead>
            <tr>
                <th>Description</th>
                <th>Prix</th>
                <th>Photo</th>
                <th>Date</th>
                <th>Catégorie</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- Ici je boucle sur $products pour créer une ligne par produit -->
            <?php foreach ($products as $key => $product) : ?>

                <tr>
                 <!-- <?php var_dump($products) ?> -->
                    <?php foreach ($product as $key => $info) : ?>
                        <?php if ($key != 'idCategory' && $key != 'idUser' && $key != 'idProduct' && $key != 'title') : ?>
                            <!-- on boucle ici pour insérer les images -->
                            <?php if ($key == 'image') : ?>
                                <td><img src="/image/<?= $info ?>" alt=" <?= $info ?>" width="50px"></td>
                            <?php else : ?>
                                <td><?= $info ?></td>
                            <?php endif ?>
                        <?php endif ?>
                    <?php endforeach   ?>
                    <td>
                        <a href="/detailProduct?id=<?= $product['idProduct'] ?>" class="btn btn-info m-2">Détail</a>
                        <a href="/modifProduct?id=<?= $product['idProduct'] ?>" class="btn btn-warning m-2">Modifier</a>
                        <a href="/suppProducst?id=<?= $product['idProduct'] ?>" class="btn btn-danger m-2">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach   ?>
        </tbody>
    </table>
</div>
<?php var_dump($products) ?>

<div class="container border border-secondary p-5">
    <div class="row justify-content-around">
        <?php foreach ($products as $product) : ?>
            <div class="card text-white bg-success mb-3" style="max-width: 20rem;">
                <div class="card-header">Catégorie : <?= $product['catTitle'] ?></div>
                <div class="card-body">
                    <h4 class="card-title"><?= $product['productTitle'] ?></h4>
                    <img src="image/<?= $product['image'] ?>" alt=" <?= $product['productTitle'] ?>" class="img-fluid" >
                    <p class="card-text"><?= $product['description'] ?></p>
                    <p> <span class=" text-black"> <?= $product['price'] ?>€</span></p>
                </div>
                <div class="card-footer text-center">
                    <a href="/detailProduct?id=<?= $product['idProduct'] ?>" class="btn btn-secondary">détail</a>
                </div>
            </div>

        <?php endforeach ?>
    </div>

</div>
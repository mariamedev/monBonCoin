<?php if ($erreur != "") : ?>
  <div class="alert alert-dismissible alert-primary">
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    <strong>Oh stop!</strong> <a href="#" class="alert-link"></a>
    <p><?= $erreur ?></p>
  </div>
<?php else : ?>
  <div class="card">
    <div class="card-header bg-primary text-center">
      <h3><?= $product['productTitle'] ?></h3>
    </div>
    <div class="card-body" text-center>
      <div class="row">
        <div class="col-12 col-md-6">
          <img src="/image/<?= $product['image'] ?>" alt="<?= $product['productTitle'] ?>" class="img-fluid img-thumbnail" width="200px;">
        </div>
        <div class="col-12 col-md-6">

          <iframe src="https://www.google.com/maps?q=<?= $user['city'] ?>&t=&z=13&ie=UTF8&iwloc=&output=embed" width='100%' height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="p-2"></iframe>
        </div>
        <!-- pour intégré une itéraire on va sur googlemaps on tape dans la  barre de recherche le nom de l'adresse apres on clique sur partager et puis intégrer une carte puis copier le contenu html-->
      </div>
      <div class="row">
        <div class="col-12 col-md-6 bg-info">
          <p><u>Description :</u></p>
          <p><u>64GB</u></p>
          <p><?= $product['description'] ?></p>
        </div>
        <div class="col-12 col-md-6 bg-info">
          <p><u>Prix :</u></p>
          <p><?= $product['price'] ?> €</p>
        </div>
      </div>
      <div class="card-footer text-center bg-primary">
        <a href="/panier" class="btn btn-secondary">Ajouter au panier</a>
      </div>

    </div>
  </div>
<?php endif ?>


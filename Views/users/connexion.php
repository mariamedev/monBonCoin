<div class="container">
  <?php if ($messageErreur) : ?>
    <div class="alert alert-dismissible alert-primary">
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      <strong><?= $messageErreur ?></strong></a>
    </div>
  <?php endif ?>
  <form action="" method="post">
    <div class="row justify-content-around my-2">
      <div class="col-12 col-md-4">
        <label for="login">Votre Email</label>
        <input type="email" name="login" id="email" placeholder="Votre email" class="form-control">
      </div>
      <div class="col-12 col-md-4">
        <label for="password">Votre mot de passe</label>
        <input type="password" name="password" id="password" placeholder="Votre mot de passe" class="form-control">
      </div>
      <button type="submit" class="btn btn-primary w100 m-5 p-2">Connexion</button>
    </div>
  </form>
  <div class="text-center">Pas encore de compte ? <a href="/inscription">S'inscrire</a></div>
</div>
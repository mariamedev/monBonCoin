<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=, initial-scale=1.0">
  <link rel="stylesheet" href="https://bootswatch.com/5/minty/bootstrap.min.css">
  <title>Mon Bon Coin | <?= $title ?></title>
</head>

<body>
  <header>
    <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="/">Accueil</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarColor01">
          <ul class="navbar-nav me-auto">
            <li class="nav-item">
              <a class="nav-link" href="/products">Tous les Produits</a>
            </li>
          </ul>
          <?php if (isset($_SESSION['user'])) : ?>
            <ul class="navbar-nav me-auto">
              <li class="nav-item mx-5">
                <a class="btn btn-info" href="/deconnexion">Deconnexion</a>
              </li>
              <li class="nav-item mx-5">
                <a class="btn btn-info" href="/profil">profil</a>
              </li>
            </ul>
          <?php else : ?>
          <ul class="navbar-nav me-auto">
            <li class="nav-item mx-5">
              <a class="btn btn-info" href="/connexion">connexion</a>
            </li>
          </ul>
          <?php endif ?>
          <form class="d-flex">
            <input class="form-control me-sm-2" type="search" placeholder="Search">
            <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
          </form>
        </div>
      </div>
    </nav>
  </header>

  <main>
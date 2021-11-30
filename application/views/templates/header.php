<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Station Galana</title>
    <link rel="stylesheet" href=" <?php echo site_url("assets/Bootstrap/css/bootstrap.min.css") ?> ">
    <link rel="stylesheet" href="<?php echo site_url("assets/css/style.css") ?>">
    <link rel="stylesheet" href="<?php echo site_url("assets/Fontawesome/css/all.min.css") ?>">
    <script src="<?php echo site_url("assets/Bootstrap/jquery-3.5.1.min.js") ?>" charset="utf-8"></script>
  </head>
  <body>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 px-0">
          <nav class="navbar justify-content-between">
            <a class="navbar-brand text-dark" href="#">
              <!-- <img src="/./assets/brand/bootstrap-solid.svg" width="30" height="30" alt=""> -->
              <i class="fas fa-road"></i> Galana Central
            </a>
            <!-- <ul class="nav">
              <li class="nav-item">
                <a class="nav-link btn btn-outline-dark mr-1" href="#">Routes</a>
              </li>
              <li class="nav-item">
                <a class="nav-link btn btn-outline-dark" href="#">Reparations</a>
              </li>
            </ul> -->
            <div class="btn-users">
              <?php if(!isset($_SESSION['loggedAdmin'])){ ?>
              <a href="<?php echo site_url('login'); ?>" class="btn btn-primary">Connexion</a>
              <a href="<?php echo site_url('register'); ?>" class="btn btn-primary">S'inscrire</a>
            <?php } else{ ?>
              <a href="<?php echo site_url('logout'); ?>" class="btn btn-primary"><?php echo $_SESSION['loggedAdmin']->username.' / Deconnexion'; ?></a>
            <?php } ?>
            </div>
          </nav>
        </div>
      </div>
      <div class="row h-100 vh-100">
        <div class="col-2 bg-dark pt-3">
          <div class="col-12 text-center">
            <h3 class="text-uppercase text-white">Station</h3>
          </div>
          <hr class="bg-white">
          <div class="col-12">
            <ul class="nav nav-pills flex-column">
              <li class="nav-item">
                <a class="nav-link text-white" href="<?php echo site_url('produits'); ?>">Produits</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white" href="<?php echo site_url('statistiques'); ?>">Statistiques</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white" href="<?php echo site_url('benefices'); ?>">Benefices</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white" href="<?php echo site_url('graphiques'); ?>">Graphiques</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white" href="<?php echo site_url('stock'); ?>">Stocks</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white" href="<?php echo site_url('import_data'); ?>">Importer les donnees</a>
              </li>
            </ul>
            <a href="<?php echo site_url('export_produits'); ?>" class="btn btn-success">Exporter les produits</a>
          </div>
        </div>
        <div class="col-10 p-4">

<?php

require 'server.php';

?>
<!DOCTYPE html>
<html class="no-js">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Cicerone</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" crossorigin="anonymous">
  <link rel="stylesheet" href="template/plugins/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="template/plugins/animate-css/animate.css">
  <link rel="stylesheet" href="template/plugins/magnific-popup/dist/magnific-popup.css">
  <link rel="stylesheet" href="template/plugins/slick-carousel/slick/slick.css">
  <link rel="stylesheet" href="template/plugins/slick-carousel/slick/slick-theme.css">
  <link rel="stylesheet" href="template/css/ciceronev2.css">
  <link href="https://fonts.googleapis.com/css?family=Handlee" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Patrick+Hand&display=swap" rel="stylesheet">
  <link rel="icon" href="/immagini/ciceroneicon.png" />
</head>

<body id="body" data-spy="scroll" data-target=".navbar" data-offset="50">
  <header id="navigation" class="navbar navbar-inverse">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/index.php">
          <img src="/immagini/cicerone3.png" height="50">
        </a>
      </div>
      <?php include 'navbar.php' ?>
    </div>
  </header>

  <section class="bg-one">
    <div class="container">
      <div class="row">
        <div class="title text-center wow fadeIn" data-wow-duration="1500ms" >
          <br />
          <font size ="70" face="Patrick Hand">COS'È <span class="color">CICERONE</span>&nbsp?</font>
          <div class="border"></div>
        </div>
        <h2 align="center">Cicerone è l'amico guida del viaggiatore!
          <br>
          Il nostro sito web consente ai nostri utenti Globetrotter di trovare persone esperte
        del territorio in cui si recano, per svolgere attività culturali ed esperienze divertenti!</h2><br><br>
        <div class="col-md-4 text-center wow fadeInUp" data-wow-duration="500ms" >
          <div class="wrap-about">
          <a class="inserisci_attività" href="/inserisci_attivita.php">
            <br><i class="fa fa-plus-circle fa-4x"></i>
            <div class="about-content text-center">
              <h2 class="ddd">Inserisci</h2></a>
              <h3>Proponi delle attività di viaggio come Cicerone per i Globetrotter inserendo foto e descrizioni, stanno solo aspettando te!</h3>
            </div>
          </div>
        </div>

        <div class="col-md-4 text-center wow fadeInUp" data-wow-duration="500ms" data-wow-delay="250ms">
          <div class="wrap-about">
            <br><a class="ricerca_attività" href="/ricerca_attivita.php">
 			     <i class="fa fa-search-location fa-4x"></i>
             <div class="about-content text-center">
              <h2>Ricerca</h2> </a>
              <h3>Cicerone ti permette di ricercare attività di viaggio, che aggiungano sempre qualcosa
              di memorabile alle tue esperienze!</h3>
            </div>
          </div>
        </div>

        <div class="col-md-4 text-center wow fadeInUp" data-wow-duration="500ms" data-wow-delay="500ms">
          <div class="wrap-about kill-margin-bottom">
            <br><a class="profilo" href="<?php echo isset($_SESSION['id']) ? '/profilo.php?id='. $_SESSION['id'] : '/login.php' ?>">
            <i class="fas fa-american-sign-language-interpreting fa-4x"></i>
            <div class="about-content text-center">
              <h2>Condividi</h2></a>
              <h3>Condividi le tue esperienze di viaggio con altri Globetrotter come te,
              instaurando nuove amicizie in giro per il mondo!</h3>
            </div>
          </div>
        </div>
      </div>
    </div>
    <br />
  </section>

  <section class="bg-one">
    <div class="container">
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12 text-center wow fadeInDown" data-wow-duration="500ms">
          <div class="counters-item">
            <div>
              <span data-speed="3000" data-to="<?php include 'conta_utenti.php' ?>"><?php include 'conta_utenti.php' ?></span>
            </div>
            <i class="fa fa-users fa-3x"></i>
            <h3>Utenti registrati</h3>
          </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12 text-center wow fadeInDown" data-wow-duration="500ms" data-wow-delay="200ms">
          <div class="counters-item">
            <div>
              <span data-speed="3000" data-to="0"><?php include 'conta_attivita.php' ?></span>
            </div>
            <i class="fa fa-map-marker fa-3x"></i>
            <h3>Attività inserite</h3>
          </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12 text-center wow fadeInDown" data-wow-duration="500ms" data-wow-delay="400ms">
          <div class="counters-item">
            <div>
              <span data-speed="3000" data-to="0"><?php include 'conta_ciceroni.php' ?></span>
            </div>
            <i class="fa fa-male fa-3x"></i>
            <h3>Ciceroni registrati</h3>
          </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12 text-center wow fadeInDown" data-wow-duration="500ms" data-wow-delay="600ms">
          <div class="counters-item kill-margin-bottom">
            <div>
              <span data-speed="5" data-to="0"><?php include 'media_recensioni.php' ?></span>
              <span>/5</span>
            </div>
            <i class="fa fa-star fa-3x"></i>
            <h3>Media recensioni </h3>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="bg-one">
    <div class="container">
      <div class="row">
  		<div class="copyright text-center">
     		<h3>Copyright © 2020 - Nomi, informazioni e immagini citati in questo sito sono dei rispettivi proprietari.</h3>
  		</div>
  	  </div>
  	</div>
  </section>
            
 
  <script type="text/javascript" src="template/plugins/jquery/dist/jquery.min.js"></script>
  <script type="text/javascript" src="template/plugins/bootstrap/dist/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="template/plugins/slick-carousel/slick/slick.min.js"></script>
  <script type="text/javascript" src="template/plugins/mixitup/dist/mixitup.min.js"></script>
  <script type="text/javascript" src="template/plugins/smooth-scroll/dist/js/smooth-scroll.min.js"></script>
  <script type="text/javascript" src="template/plugins/magnific-popup/dist/jquery.magnific-popup.min.js"></script>
  <script type="text/javascript" src="template/plugins/Sticky/jquery.sticky.js"></script>
  <script type="text/javascript" src="template/plugins/count-to/jquery.countTo.js"></script>
  <script type="text/javascript" src="template/plugins/wow/dist/wow.min.js"></script>
  <script type="text/javascript" src="template/js/script.js"></script>
</body>
</html>

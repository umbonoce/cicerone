<?php

require 'server.php';

if (!isset($_SESSION['id'])) {
  header('Location: login.php');
}

?>
<!DOCTYPE html>
<html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Inserisci Attività - Cicerone</title>
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

<body id="body">
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

  <section id="about" class="bg-one">
    <div class="container">
      <div class="row">
        <div class="contact-form col-md-8 text-center wow fadeInUp" data-wow-duration="500ms" data-wow-delay="250ms">
          <div class="title text-center wow fadeIn" data-wow-duration="1500ms" >
            LA TUA <span class="color">ATTIVITÀ</span>
            <div class="border"></div>
          </div>
          <div class="wrap-about">
            <h3 font size="20">
              <script>
               function Notifica() {
                 alert("Attività inserita");
               }
              </script>
              <form onsubmit="Notifica()"
                    method="post" action="inserisci_attivita.php" enctype="multipart/form-data">
                <?php include 'errors.php' ?>
                <div class="form-group col-md-7">
                  <label for="titolo">Titolo</label>
                  <input required type="text" style="font-size: 20px;" class="form-control" id="titolo" name="titolo" placeholder="Titolo">
                </div>
                <div class="form-group col-md-5">
                  <label for="categoria">Categoria</label>
                  <br>
                  <select name="categorie" id="categoria" style="background-color:transparent">
                    <?php include 'categorie.php' ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="descrizione">Descrizione</label>
                  <textarea required style="font-size: 20px;" rows="5" cols="40" class="form-control" id="descrizione" name="descrizione" placeholder="Descrivi la tua attività"></textarea>
                </div>
                <div class="form-group col-md-4">
                  <label for="immagine">Immagine</label>
                  <input class="form-group" style="font-size: 14px;" id="immagine" type="file" name="immagine" accept="image/*">
                </div>
                <div class="form-group col-md-4">
                  <label for="data-di-inizio">Data e ora di inizio</label>
                  <input required class="form-control" style="font-size: 20px;" id="data-di-inizio" type="datetime-local" name="data-di-inizio"
                         <?php $current = date('Y-m-d\TH:i'); echo " value=\"$current\" min=\"$current\"" ?>>
                </div>
                <div class="form-group col-md-4">
                  <label for="prezzo">Costo di partecipazione</label>
                  <input required class="form-control" style="font-size: 20px;" id="prezzo" type="number" min="0" max="500.00" step="0.50" name="prezzo" placeholder="€">
                </div>
                <div class="form-group col-md-6">
                  <label for="iterazioni">Quante volte l'attività sarà ripetuta?</label>
                  <input required class="form-control" style="font-size: 20px;" id="iterazioni" type="number" name="iterazioni" value="0" min=0>
                </div>
                <div class="form-group col-md-6">
                  <label for="cadenza">Ogni quanti giorni sarà ripetuta?</label>
                  <input required class="form-control" style="font-size: 20px;" id="cadenza" type="number" name="cadenza" min=1>
                </div>
                <button type="submit" style="background-color:#333333" class="btn btn-primary" name="inserisci-attivita">Inserisci Attività</button>
              </form>
            </h3>
          </div>
        </div>

        <div class="col-md-4 text-center wow fadeInUp" data-wow-duration="500ms" >
          <div class="wrap-about">

            <br><i class="fas fa-grin-wink fa-4x"></i>
            <div class="about-content text-center">
              <h2 class="ddd">Seleziona la giusta categoria</h2>
              <h3>Ti consigliamo di scegliere attentamente la categoria della tua attività in modo da raggiungere i Globetrotter interessati.</h3>
              <br>
            </div>

          </div>
        </div>
        <div class="col-md-4 text-center wow fadeInUp" data-wow-duration="500ms" >
          <div class="wrap-about">
            <i class="fas fa-money-bill-alt fa-4x"></i>
            <div class="about-content text-center">
              <h2 class="ddd">Guadagni extra</h2>
              <h3>Attraverso la promozione delle tue attività otterrai dei compensi dai partecipanti.</h3>
            </div>

          </div>
        </div>
        <div class="col-md-4 text-center wow fadeInUp" data-wow-duration="500ms" >
          <div class="wrap-about">
            <br><i class="fas fa-equals fa-4x"></i>
            <div class="about-content text-center">

              <h2 class="ddd">Puntualità e coerenza</h2>
              <h3>Sii sempre coerente con la descrizione di ciò che offri e puntuale rispetto l'orario fissato per rispetto della community. </h3>

            </div>

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

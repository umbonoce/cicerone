<?php include 'server.php' ?>
<!DOCTYPE html>
<html class="no-js" lang="it"> <!--<![endif]-->
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Registrazione - Cicerone</title>
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
        <div class="title text-center wow fadeIn" data-wow-duration="1500ms" >
          PERCHÈ <span class="color">ISCRIVERSI</span>
          <div class="border"></div>
        </div>
        <div class="col-md-4 text-center wow fadeInUp" data-wow-duration="500ms" >
          <div class="wrap-about">
            <br><i class="fas fa-money-bill-alt fa-4x"></i>
            <div class="about-content text-center">
              <h2 class="ddd">Guadagni extra</h2>
              <h3>Attraverso la promozione delle tue attività otterrai dei compensi dai partecipanti.</h3>
            </div>
          </div>
        </div>

        <div class="contact-form col-md-4 text-center wow fadeInUp" data-wow-duration="500ms" data-wow-delay="25ms">
          <div class="wrap-about" align="center">
            <h3><form method="post" action="registrazione.php">
              <?php include 'errors.php'; ?>
              <div class="form-group">
                <label for="nome">Nome</label>
                <input required type="text" style="font-size: 20px;" class="form-control" id="nome" name="nome" value="<?php echo $nome ?>" placeholder="Nome">
              </div>
              <div class="form-group">
                <label for="cognome">Cognome</label>
                <input required type="text" style="font-size: 20px;" class="form-control" id="cognome" name="cognome" value="<?php echo $cognome ?>" placeholder="Cognome">
              </div>
              <div class="form-group">
                <label for="data-di-nascita">Data di Nascita</label>
                <input required type="date" style="font-size: 20px;" class="form-control" id="data-di-nascita" name="data-di-nascita" min="1900-01-01" max="2003-01-01" value="<?php echo $data_di_nascita ?>"> 
           </div>
              <div class="form-group">
                <label for="username">Username</label>
                <input required type="text" style="font-size: 20px;" class="form-control" id="username" name="username" value="<?php echo $username ?>" placeholder="Nome Utente">
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input required type="password" style="font-size: 20px;" class="form-control" id="password" name="password" placeholder="Password">
              </div>
              <div class="form-group">
                <label for="conferma-password">Conferma Password</label>
                <input required type="password" style="font-size: 20px;" class="form-control" id="conferma-password" name="conferma-password" placeholder="Password">
              </div>
                	<button type="submit" style="background-color:#333333" class="btn btn-primary" name="registrazione_utente">Conferma Registrazione</button>

            </form>
          </h3>
          <h3>
                	<button type="submit" style="background-color:#333333" class="btn btn-primary" onclick="window.location.href = '/index.php';">Annulla</button>
          </h3>
        </div>
      </div>


      <div class="col-md-4 text-center wow fadeInUp" data-wow-duration="500ms" data-wow-delay="500ms">
        <div class="wrap-about kill-margin-bottom">
          <br><i class="fas fa-child fa-4x"></i>
          <div class="about-content text-center">
            <h2>Nuove Esperienze</h2>
            <h3>Da utente Globetrotter potrai svolgere nuove esperienze in giro per il mondo.</h3>
          </div>
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
  
<script type="text/javascript" src="tema/template/plugins/jquery/dist/jquery.min.js"></script>
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

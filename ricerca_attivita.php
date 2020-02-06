<?php require 'server.php'; ?>
<!DOCTYPE html>
<html class="no-js" lang="it">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Ricerca Attività - Cicerone</title>
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


 <section id="about" class="bg-one">
  <div class="container">
   <div class="row">
     <div class="contact-form col-md-12 text-center wow fadeInUp" data-wow-duration="500ms" data-wow-delay="250ms">
       <div class="title text-center wow fadeIn" data-wow-duration="1500ms" >
         RICERCA <span class="color">ATTIVITÀ</span>
       </div>
       <div class="wrap-about" align="center">
         <h3 font size="20">
          <form method="post" action="#ricerca">
            <?php include 'errors.php' ?>
            <div class="form-group col-md-5">
              <label for="categoria">Quale categoria preferisci?</label>
              <br>
              <select name="categorie" id="categoria" style="background-color:transparent">
                <?php include 'categorie.php' ?>
              </select>
            </div>
            <div class="form-group col-md-7">
              <label for="data-di-inizio">Quando vuoi partecipare?</label>
          		<input required class="form-control" style="font-size: 20px;" id="data-di-inizio" type="datetime-local" name="data-di-inizio"
                <?php $current = date('Y-m-d\TH:i'); echo " value=\"$current\" min=\"$current\"" ?>>
            </div>
            <div class="form-group col-md-12">
                	<button type="submit" style="background-color:#333333" class="btn btn-primary" name="ricerca-attivita" onclick="document.href='#ricerca';">Ricerca Attività</button>
            </div>
          </form>
        </h3>
      </div>
    </div>

	  <!-- <div class="col-md-4 text-center wow fadeInUp" data-wow-duration="500ms" >
	       <div class="wrap-about">
	       <br><i class="fas fa-lightbulb fa-4x"></i>
	       <div class="about-content text-center">
	       <h2 class="ddd">Seleziona la giusta categoria</h2>
	       <h3>Cicerone ti permette di ricercare attività di viaggio, che aggiungano sempre qualcosa di memorabile alle tue esperienze!</h3>
	       <br>
	       </div>

	       </div>
       </div> -->
     </div>
   </div>
 </section>

 <section id="result" class="bg-one">
  <div class="container">
   <div class="row">
     <div class="contact-form col-md-12 text-center wow fadeInUp" data-wow-duration="500ms" data-wow-delay="250ms">
      <?php if(count($risultati_ricerca)): ?>
       <div class="title text-center wow fadeIn" data-wow-duration="1500ms" >
         <a name="#ricerca"><font size ="70" face="Patrick Hand" id="ricerca">RISULTATI <span class="color">RICERCA</span></font>
         <div class="border"></div></a>
       </div>
     <?php endif?>
		
     <?php foreach($risultati_ricerca as $risultato): ?>
       <div class="col-md-6">
         <a href="/attivita.php?id=<? echo $risultato['id_attivita']?>" hover="color:white;"> <article class="team-mate">
          <div class="member-title">
            <h3><?= $risultato['nome_cicerone'] . ' ' . $risultato['cognome_cicerone'] ?></h3>
            <h2><?= $risultato['titolo_attivita'] ?></h2>
          </div>
          <div class="member-info">
            <h3><?= $risultato['descrizione_attivita'] ?></h3>
          </div>
        </article></a>
      </div>
    <?php endforeach ?> 
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

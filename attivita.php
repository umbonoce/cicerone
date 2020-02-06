<?php

require 'server.php';

$link = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_SCHEMA);

if (!$link) {
  die('Impossible connettersi al database: ' . $link->connect_error);
}

if(!isset($_GET['id'])){
  header("Location: /");
}

$id_richiesto = $_GET['id'];
// TODO: controllo errori durante l'esecuzione della query
if ($stmt = $link->prepare('SELECT id_cicerone, titolo, descrizione, prezzo, nome, cognome, max(data_inizio) FROM attivita, utente, storico WHERE attivita.id=? AND utente.id=attivita.id_cicerone AND storico.id_attivita=attivita.id ORDER BY data_inizio DESC')) {
  $stmt->bind_param('i', $id_richiesto);
  $stmt->execute();
  $stmt->bind_result($id_cicerone, $titolo, $descrizione, $prezzo, $nome, $cognome, $data_inizio);
  $stmt->fetch();
  $stmt->close();
}

if ($stmt = $link->prepare('SELECT AVG(stelle) FROM feedback as f, prenotazione as p, storico as s, attivita as a WHERE f.da_cicerone=0 AND f.id_prenotazione=p.id AND p.id_storico=s.id AND s.id_attivita=?')) {
  $stmt->bind_param('i', $id_richiesto);
  $stmt->execute();
  $stmt->bind_result($media);
  while ($stmt->fetch());
  $stmt->close();
}


$feedback=array();
if ($stmt = $link->prepare('SELECT u.nome, u.cognome, commento, stelle FROM utente as u, feedback as f, attivita as a, prenotazione as p, storico as s WHERE f.da_cicerone=0 AND  p.id=f.id_prenotazione AND p.id_utente=u.id AND s.id=p.id_storico AND s.id_attivita=a.id AND a.id=?')) {
  $stmt->bind_param('i', $id_richiesto);
  $stmt->execute();
  $stmt->bind_result($nome_f, $cognome_f, $commento, $stelle);
  $feedback = $stmt->get_result();
    while ($tupla = $feedback->fetch_array(MYSQLI_ASSOC)) {
      array_push($feedback, $tupla);
    }  
  $stmt->close();
}else{
    array_push($errors, $link->error);
  } 
?>
<!DOCTYPE html>
<html class="no-js" lang="it">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="description" content="">
  <meta name="author" content="">
  <title><?php echo $titolo; ?> - Cicerone</title>
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
         <img src="/immagini/cicerone3.png" height="50" alt="">
       </a>
     </div>
     <?php include 'navbar.php' ?>
   </div>
 </header>

 <section class="bg-one">
  <div class="container">
   <div class="row">
     <div class="title text-center " data-wow-duration="1500ms" >
       <br />
       <?php echo $titolo?>
       <div class="border"></div>
     	<h3><?php echo $descrizione?></h3>
       <h3>Ti inseressa l'<span class="color">attività</span>?
         
          <form method="post" action="pagina controllo"> <!-- PERMETTE DI PRENOTARSI ALLA ATTIVITA' PER LA PRIMA OCCORRENZA POSSIBILE (?) -->
                <button type="submit" style="background-color:#333333" class="btn btn-primary" name="partecipa-attivita">Invia una richiesta di partecipazione</button>
          </form>
     </h3></div>
     <div class="col-md-4 text-center wow fadeInUp" data-wow-duration="500ms" >
       <div class="wrap-about">
         <i class="fas fa-calendar-alt fa-4x"></i>
         <div class="about-content text-center">
          <h2 class="ddd">Quando sarà svolta l'attività?</h2>
          <h3><?= $data_inizio?></h3>
        </div>
      </div>
    </div>

    <div class="col-md-4 text-center wow fadeInUp" data-wow-duration="500ms" data-wow-delay="250ms">
     <div class="wrap-about">
       <i class="fas fa-money-bill-alt fa-4x"></i>
       <div class="about-content text-center">
        <h2>Quanto costa partecipare?</h2>
        <h3><?= $prezzo?> €</h3>
      </div>
    </div>
  </div>

  <div class="col-md-4 text-center wow fadeInUp" data-wow-duration="500ms" data-wow-delay="500ms">
   <div class="wrap-about kill-margin-bottom">
     <i class="fas fa-user-circle fa-4x"></i>
     <div class="about-content text-center">
      <h2>Chi offre questa esperienza?</h2>
      <h3><a href="/profilo.php?id=<?= $id_cicerone?>"><?php echo $nome, " " , $cognome?></a></h3>
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
<h3>&nbsp;<i class="fas fa-hand-point-down"></i> Le recensioni di questa attività(<?=(float) $media?>/5 <i class="fas fa-star"></i>)</h3><br>
<?php $check=false; foreach($feedback as $feed):?>
         <div class="col-md-4">
         <article class="team-mate">
          <div class="member-title">
			<?php if($feed["id"]==$_SESSION["id"]):$check=true; endif?>
            <h3><?=$feed["nome"]?> <?=$feed["cognome"]?></h3>
            <h2> <?php for($i = 1; $i <= $feed["stelle"]; $i++):?>
            <i class="fas fa-star"></i>
            <?php endfor ?> </h2>  </div>
          <div class="member-info">
            <h3><?=$feed["commento"]?></h3>
          </div>
        </article>
        <?php if ($id_cicerone==$_SESSION["id"]):?>
         <a href="/inserisci_feedback.php">
        <h4>Lascia anche tu una recensione per <?=$feed["nome"]?> <?=$feed["cognome"]?><i class="fas fa-hand-point-up"></i></h4>
        </a>
        <?php endif?>
      	</div>
<?php endforeach?>
<div class="contact-form col-md-12 wow fadeInUp" data-wow-duration="500ms" data-wow-delay="250ms">
<?php if(empty($feed)):?>Questa attività non è ancora stata recensita da alcun Globetrotter. Sii il primo a farlo!<?php endif?>
<?php if ($check!=true):?>
          <div class="wrap-about">
            <h3>
              <script>
               function Notifica() {
                 alert("Grazie, il tuo feedback è stato aggiunto!");
               }
              </script>
              <form onsubmit="Notifica()"
              action="/inserisci_recensione.php" method="post" enctype="multipart/form-data">
<div class="form-group">
	
      <label for="descrizione">Hai svolto questa attività, lascia una recensione!</label>
         <textarea required style="font-size: 20px;" rows="5" cols="40" class="form-control" id="feedback" name="feedback" placeholder="Descrivi la tua esperienza"></textarea>

	<button type="submit" style="background-color:#333333" class="btn btn-primary" name="inserisci-feedback">Aggiungi recensione</button>
</div></form></h3>
</div>
</div>
<?php endif?>
<div class="col-md-12">
  <section class="bg-one">
    <div class="container">
      <div class="row">
  		<div class="copyright text-center">
     		<h3>Copyright © 2020 - Nomi, informazioni e immagini citati in questo sito sono dei rispettivi proprietari.</h3>
  		</div>
  	  </div>
  	</div>
  </section>
 </div> 
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

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
if ($stmt = $link->prepare('SELECT id,username,nome,cognome,data_di_nascita FROM utente WHERE id=?')) {
  $stmt->bind_param('i', $id_richiesto);
  $stmt->execute();
  $stmt->bind_result($id, $username, $nome, $cognome, $data_di_nascita);
  $stmt->fetch();
  $oggi = new DateTime();
  $eta = $oggi->diff(new DateTime($data_di_nascita))->y;

  $stmt->close();
}

if ($stmt = $link->prepare('SELECT COUNT(id_cicerone) FROM attivita WHERE id_cicerone=? ')) {
  $stmt->bind_param('i', $id_richiesto);
  $stmt->execute();
  $stmt->bind_result($organizzate);
  $stmt->fetch();
  $stmt->close();
}

if ($stmt = $link->prepare('SELECT COUNT(id_utente) FROM prenotazione  WHERE id_utente=? ')) {
  $stmt->bind_param('i', $id_richiesto);
  $stmt->execute();
  $stmt->bind_result($partecipate);
  $stmt->fetch();
  $stmt->close();
}

$sto = array();
if ($stmt = $link->prepare('SELECT id_attivita, storico.data_inizio, attivita.titolo, categoria.nome FROM storico, attivita, categoria WHERE storico.id_attivita=attivita.id AND attivita.id_categoria=categoria.id AND id_cicerone=?')) {  
  $stmt->bind_param('i', $id_richiesto);
  $stmt->execute();
  $stmt->bind_result($id_attivita, $data_inizio, $titolo, $categoria);
  $sto = $stmt->get_result();
    while ($tupla = $sto->fetch_array(MYSQLI_ASSOC)) {
      array_push($sto, $tupla);
    }
  $stmt->close();
}

if ($stmt = $link->prepare('SELECT a.id, s.data_inizio, a.titolo, c.nome FROM storico AS s, attivita AS a, categoria AS c, prenotazione AS p WHERE s.id_attivita=a.id AND a.id_categoria=c.id AND p.id_storico=s.id AND p.id_utente=?')) {  
  $stmt->bind_param('i', $id_richiesto);
  $stmt->execute();
  $stmt->bind_result($id_attivita, $data_inizio, $titolo, $categoria);
  $part = $stmt->get_result();
    while ($tupla = $part->fetch_array(MYSQLI_ASSOC)) {
      array_push($part, $tupla);
    }
  $stmt->close();
}

$feedback=array();
if ($stmt = $link->prepare('SELECT a.id, a.titolo, u.nome, u.cognome, commento, stelle FROM utente as u, feedback as f, attivita as a, prenotazione as p, storico as s WHERE f.da_cicerone=1 AND p.id=f.id_prenotazione AND p.id_storico=s.id AND s.id_attivita=a.id AND a.id_cicerone=u.id AND p.id_utente=?')) {
  $stmt->bind_param('i', $id_richiesto);
  $stmt->execute();
  $stmt->bind_result($id, $titolo, $nome_f, $cognome_f, $commento, $stelle);
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
  <title>Profilo di <?= $username ?> - Cicerone</title>
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
  <section id="about" class="bg-one">
    <div class="container">
      <div class="row">
        <div class="contact-form col-md-4 text-center wow fadeInUp" data-wow-duration="500ms" data-wow-delay="250ms">
    	<h4><i class="fa fa-user-circle fa-4x"></i></h4>
            <div align="center" class="about-content text-center">
              <?php if ($_SESSION['id'] == $_GET['id']): ?>
               <form align="center" method="post" action="">
                  <label for="nome">Nome</label>
                  <i class="fas fa-edit"></i><input required type="text" style="font-size: 20px;" class="form-control" name="nome" id="nome"  value="<?= $nome ?>">
                  <br>
                  <label for="cognome">Cognome</label>
                  <i class="fas fa-edit"></i><input required type="text" style="font-size: 20px;" class="form-control" name="cognome" id="cognome" value="<?= $cognome ?>">
                  <br>
                  <label for="cognome">Data Di Nascita</label>
                  <i class="fas fa-edit"></i><input required type="date" style="font-size: 20px;" class="form-control" id="data-di-nascita" name="data-di-nascita" value="<?php echo $data_di_nascita ?>">
                  <br>                 
                <button type="submit" style="background-color:#333333" class="btn btn-primary" name="aggiorna-profilo">Aggiorna Informazioni</button>
              </form>
      		<?php if ($_SESSION['id'] == $_GET['id']): ?>
                <button type="submit" style="background-color:#b30000" class="btn btn-danger" name="aggiorna-profilo" onclick="location.href='/logout.php'">Logout</button>
              	<?php endif ?>
              <?php else: ?>
                <h3>Nome: <?= $nome ?></h3>
                <h3>Cognome: <?= $cognome ?></h3>
                <h3>Data Di Nascita: <?= $data_di_nascita ?></h3>
                <h3>Età: <?= $eta ?></h3>
              <?php endif ?>


            </div>
          </div>

        <div class="col-md-8 wow fadeInUp" data-wow-duration="500ms" data-wow-delay="250ms">
          <div class="wrap-about">
            <h4 align="center"><i class="fa fa-handshake fa-4x"></i></h4>
            <div class="about-content text-center">
              <h1>Piacere, io sono <?= $nome ?></h1>
              <h3>Ho partecipato a <?= $partecipate ?> attività, organizzandone <?= $organizzate ?>.</h3>
            </div>
          </div>
          
          <?php if ($organizzate>0): ?>
          <h3>&nbsp;<i class="fas fa-hand-point-down"></i> Cosa ho organizzato?</h3>
          <table class="table table-hover">
  			<thead>
    			<tr>
      				<th scope="col">Data</th>
      				<th scope="col">Nome Attività</th>
      				<th scope="col">Categoria</th>
                    <?php if ($_SESSION['id'] == $_GET['id']): ?>
                    <th scope="col">Modifica</th>
                    <?php endif ?>
    			</tr>
  			</thead><tbody>
             <?php foreach($sto as $org): ?>
    			<tr>
      				<th scope="row"><? echo $org['data_inizio']?></th>
      				<td><a href="attivita.php?id=<?=$org['id_attivita']?>"><?= $org['titolo']?></a></td>
      				<td>  <?= $org['nome']?></td>
                    <?php if ($_SESSION['id'] == $_GET['id']): ?>
                    <th scope="col"> <a href="modifica_attivita.php?id=<?=$org['id_attivita']?>"><i class="fa fa-pen-square"></i></a></th>
                    <?php endif ?>
    			</tr> <?php endforeach ?> 
  			</tbody>
		</table>
        <?php endif ?>
        
        <?php if ($partecipate>0): ?>
        <h3>&nbsp;<i class="fas fa-hand-point-down"></i> A cosa ho partecipato?</h3>
          <table class="table table-hover">
  			<thead>
    			<tr>
      				<th scope="col">Data</th>
      				<th scope="col">Nome Attività</th>
      				<th scope="col">Categoria</th>
                    <?php if ($_SESSION['id'] == $_GET['id']): ?>
                    <th scope="col">Rilascia un feedback</th>
                    <?php endif ?>
    			</tr>
  			</thead>
  			<tbody>
            	<?php foreach($part as $par): ?>
    			<tr>
      				<th scope="row"><?=$par['data_inizio']?></th>
      				<td><a href="attivita.php?id=<?=$par['id']?>"><?=$par['titolo']?></a></td>
      				<td><?=$par['nome']?></td>
                    <?php if ($_SESSION['id'] == $_GET['id']): ?>
                    <th scope="col"><a href="attivita.php?id=<?=$par['id']?>"><i class="fas fa-comment-dots"></i></a></th>
                    <?php endif ?>
    			</tr>
                <?php endforeach ?>
  			</tbody>
		</table>
        
        
        <h3>&nbsp;<i class="fas fa-hand-point-down"></i> Cosa pensano i Ciceroni di me</h3>
         <div class="col-md-12">
         <?php foreach($feedback as $feed):?>
         <article class="team-mate">
          <div class="member-title">
            <h3><?=$feed['nome']?> <?=$feed['cognome']?> per <br> 
            <a href="/attivita.php?id=<?=$feed['id']?>"><?=$feed['titolo']?></a></h3>
            <h2> <?php for($i = 1; $i <= $feed["stelle"]; $i++):?>
            <i class="fas fa-star"></i>
            <?php endfor ?> </h2> 
          </div>         
          <div class="member-info">
            <h3><?=$feed['commento']?> </h3>
          </div>    
        </article>
        <br>
        <?php endforeach?>
        <?php if(empty($feed)):?>
        <h4>Purtroppo non ci sono recensioni per questo globetrotter, occorre dargli fiducia!</h4>
        <?php endif?>
      	</div>
        </div>
      </div>
    </div>
    <?php endif ?>
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

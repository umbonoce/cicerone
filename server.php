<?php

require 'configurazione.php';
require 'functions.php';

session_start();

$errors = array();

$link = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_SCHEMA);

if ($link->connect_error) {
  die('Errore di connessione (' . $link->connect_errno . ') ' . $link->connect_error);
}

if (isset($_POST['registrazione_utente'])) {
  $nome = $link->real_escape_string($_POST['nome']);
  $cognome = $link->real_escape_string($_POST['cognome']);
  $data_di_nascita = $link->real_escape_string($_POST['data-di-nascita']);
  $username = $link->real_escape_string($_POST['username']);
  $password = $link->real_escape_string($_POST['password']);
  $conferma_password = $link->real_escape_string($_POST['conferma-password']);

  if ($password != $conferma_password) {
   array_push($errors, 'Le password non corrispondono');
 }

 if (count($errors) == 0) {
   if ($stmt = $link->prepare('SELECT * FROM utente WHERE username=?')) {
     $stmt->bind_param('s', $username);
     $stmt->execute();
     $stmt->store_result();
     if ($stmt->num_rows) {
      array_push($errors, 'Username esiste già');
    }
    $stmt->close();
  }
}

if (count($errors) == 0) {
    $query = 'INSERT INTO utente (username, nome, cognome, data_di_nascita, password) VALUES (?, ?, ?, ?, ?)';
    if ($stmt = $link->prepare($query)) {
   $hashed_password = password_hash($password, PASSWORD_DEFAULT);
   $stmt->bind_param('sssss', $username, $nome, $cognome, $data_di_nascita, $hashed_password);
   if (!$stmt->execute()) {
    array_push($errors, "Errore nella registrazione: " . $stmt->error);
  } else {
    header("Location: index.php");
  }
  $stmt->close();
}
}
}

if (isset($_POST['login_utente'])) {
  $username = $link->real_escape_string($_POST['username']);
  $password = $link->real_escape_string($_POST['password']);

  if ($stmt = $link->prepare('SELECT id, nome, password FROM utente WHERE username=?')) {
   $stmt->bind_param('s', $username);

   if (!$stmt->execute()) {
     array_push($errors, 'Errore nel contattare il database: ' . $stmt->error);
   }

   if (count($errors) == 0) {
     $stmt->store_result();
     if ($stmt->num_rows == 0) {
      array_push($errors, 'Username errato');
    } else {
      $stmt->bind_result($id, $nome, $hashed_password);
      $stmt->fetch();
      if (password_verify($password, $hashed_password)) {
        $_SESSION['id'] = $id;
        $_SESSION['nome'] = $nome;
        header('Location: index.php');
      } else {
        array_push($errors, 'Password errata');
      }
    }
  }
  $stmt->close();
}
}

if (isset($_POST['inserisci-attivita'])) {
  $categoria = $_POST['categorie'];
  $titolo = $link->real_escape_string(trim($_POST['titolo']));
  $descrizione = $link->real_escape_string(trim($_POST['descrizione']));
  $immagine = 'todo';
  $data_di_inizio = $_POST['data-di-inizio'];
  $prezzo = $_POST['prezzo'];
  $iterazioni = $_POST['iterazioni'];
  $cadenza = $_POST['cadenza'];
  $id_cicerone = $_SESSION['id'];

  $link->begin_transaction();

  $query = 'INSERT INTO attivita(id_categoria, id_cicerone, titolo, descrizione, cadenza, iterazioni, immagine, prezzo)
  VALUES(?, ?, ?, ?, ?, ?, ?, ?)';

  if ($stmt = $link->prepare($query)) {
   $stmt->bind_param('ssssssss', $categoria, $id_cicerone, $titolo, $descrizione, $cadenza, $iterazioni, $immagine, $prezzo);
   if ($stmt->execute()) {
     $id_attivita_appena_inserita = $link->insert_id;
     $stmt->close();
     if ($stmt = $link->prepare('INSERT INTO storico(id_attivita, data_inizio) VALUES(?, ?)')) {
      $stmt->bind_param('is', $id_attivita_appena_inserita, $data_di_inizio);
      if (!$stmt->execute()) {
        array_push($errors, $stmt->errors);
      }
      $stmt->close();
    } else {
      array_push($errors, $link->error);
    }
    if (array_key_exists('immagine', $_FILES))
      upload_immagine($link, $id_attivita_appena_inserita, $_FILES['immagine']);
  } else {
   array_push($errors, $stmt->error);
   $stmt->close();
 }
} else {
    array_push($errors, $link->error);
}

$link->commit();
}

$risultati_ricerca = array();
if (isset($_POST['ricerca-attivita'])) {
  $categoria = $link->real_escape_string($_POST['categorie']);
  $data_di_inizio = $link->real_escape_string($_POST['data-di-inizio']);
  $query = 'SELECT u.nome AS nome_cicerone, u.cognome AS cognome_cicerone, a.id AS id_attivita, a.titolo AS titolo_attivita, a.descrizione AS descrizione_attivita
            FROM storico s INNER JOIN attivita a ON s.id_attivita = a.id INNER JOIN utente u ON a.id_cicerone = u.id
            WHERE data_inizio >= ? AND data_inizio >= CURRENT_DATE() AND id_categoria = ?';

  if (!$stmt = $link->prepare($query)) {
    array_push($errors, $link->error);
  } else {
    $stmt->bind_param('si', $data_di_inizio, $categoria);
    $stmt->execute();
    $risultato = $stmt->get_result();
    while ($tupla = $risultato->fetch_array(MYSQLI_ASSOC)) {
      array_push($risultati_ricerca, $tupla);
    }
    $stmt->close();
  }
}

if (isset($_POST['aggiorna-profilo'])) {
  aggiorna_utente($link, $_SESSION['id'], $_POST['nome'], $_POST['cognome'], $_POST['data-di-nascita']);
}

$link->close();

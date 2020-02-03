<?php

function aggiorna_utente(mysqli $link, int $id_utente, string $nuovo_nome, string $nuovo_cognome, string $nuova_data_di_nascita)
{
  $nuovo_nome = $link->real_escape_string($nuovo_nome);
  $nuovo_cognome = $link->real_escape_string($nuovo_cognome);
  $nuova_data_di_nascita = $link->real_escape_string($nuova_data_di_nascita);

  if ($stmt = $link->prepare('UPDATE utente SET nome = ?, cognome = ?, data_di_nascita = ? WHERE id = ?')) {
    $stmt->bind_param('sssi', $nuovo_nome, $nuovo_cognome, $nuova_data_di_nascita, $id_utente);
    $stmt->execute();
    if ($stmt->affected_rows)
      header("Location: profilo.php?id=$id_utente");
  }
}

function aggiorna_attivita(
  mysqli $link,
  int $id_attivita,
  string $nuovo_titolo,
  string $nuova_descrizione,
  int $nuova_cadenza,
  int $nuove_iterazioni,
  float $nuovo_prezzo)
{
  $nuovo_titolo = $link->real_escape_string($nuovo_titolo);
  $nuova_descrizione = $link->real_escape_string($nuova_descrizione);

  if ($stmt = $link->prepare('UPDATE attivita SET titolo = ?, descrizione = ?, cadenza = ?, iterazioni = ?, prezzo = ? WHERE id = ?')) {
    $stmt->bind_param('ssiidi', $nuovo_titolo, $nuova_descrizione, $nuova_cadenza, $nuove_iterazioni, $nuovo_prezzo, $id_attivita);
    $stmt->execute();
    if ($stmt->affected_rows)
      header("Location: attivita.php?id=$id_attivita");
  }
}

function upload_immagine(mysqli $link, int $id_attivita, array $dati_immagine)
{
  $cartella_upload = 'uploads/' . $id_attivita . '/';

  /* var_dump(get_current_user()); */

  mkdir($cartella_upload, 0700, true);
  $file = $cartella_upload . basename($dati_immagine['name']);
  $ok = 1;
  /* var_dump(getcwd());
   * var_dump($_SERVER); */
  $tipo_file = strtolower(pathinfo($file, PATHINFO_EXTENSION));

  // Check if image file is a actual image or fake image
  if(isset($_POST['submit'])) {
    $check = getimagesize($_FILES['immagine']['tmp_name']);
    if($check !== false) {
      echo 'File is an image - ' . $check['mime'] . '.';
      $ok = 1;
    } else {
      echo 'File is not an image.';
      $ok = 0;
    }
  }

  // Check file size
  if ($_FILES['immagine']['size'] > 500000) {
    echo 'Sorry, your file is too large.';
    $ok = 0;
  }
  var_dump($tipo_file);
  // Allow certain file formats
  /* if($tipo_file != 'jpg' && $tipo_file != 'png' && $tipo_file != 'jpeg' && $tipo_file != 'gif') {
   *   echo 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.';
   *   $ok = 0;
   * }
   */
  // Check if $ok is set to 0 by an error
  if ($ok == 0) {
    echo 'Sorry, your file was not uploaded.';
    // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES['immagine']['tmp_name'], $file)) {
      echo 'The file '. basename( $_FILES['immagine']['name']). ' has been uploaded.';
    } else {
      echo 'Sorry, there was an error uploading your file.';
    }
  }
}

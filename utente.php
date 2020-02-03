<?php

$link = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_SCHEMA);

if ($stmt = $link->prepare("SELECT * FROM utente WHERE 1")) {
  if ($stmt->execute()) {
    $stmt->bind_result($id, $nome, $cognome, $username);
    while ($stmt->fetch()) {
      echo $nome;
    }
  } else {
    array_push($errors, $stmt->error);
  }
  $stmt->close();
}

$link->close();

<?php

$link = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_SCHEMA);

if ($stmt = $link->prepare('SELECT * FROM categoria')) {
  if ($stmt->execute()) {
    $stmt->bind_result($id, $nome);
    while ($stmt->fetch()) {
      echo "<option value=\"$id\">$nome</option>";
    }
  } else {
    array_push($errors, $stmt->error);
  }
  $stmt->close();
}

$link->close();

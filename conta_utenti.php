<?php

$link = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_SCHEMA);

if ($stmt = $link->prepare('SELECT COUNT(*) FROM utente')) {
	$stmt->execute();
  $stmt->bind_result($users);
  while ($stmt->fetch()) {
    echo $users;
  }
  $stmt->close();
}

$link->close();

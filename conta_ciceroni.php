<?php

$link = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_SCHEMA);

if ($stmt = $link->prepare('SELECT COUNT(DISTINCT id_cicerone) FROM attivita')) {
  $stmt->execute();
  $stmt->bind_result($cicerone);
  while ($stmt->fetch()) {
    echo $cicerone;
  }
  $stmt->close();
}

$link->close();

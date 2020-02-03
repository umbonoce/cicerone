<?php

$link = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_SCHEMA);

if ($stmt = $link->prepare('SELECT AVG(stelle) FROM feedback')) {
  $stmt->execute();
  $stmt->bind_result($media);
  while ($stmt->fetch()) {
    echo (float) $media;
  }
  $stmt->close();
}

$link->close();

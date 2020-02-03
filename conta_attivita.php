<?php

$link = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_SCHEMA);

if ($stmt = $link->prepare('SELECT COUNT(*) FROM attivita')) {
	$stmt->execute();
  $stmt->bind_result($activity);
  while ($stmt->fetch()) {
    echo $activity;
  }
  $stmt->close();
}

$link->close();

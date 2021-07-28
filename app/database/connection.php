<?php

$dbhost = "localhost";
$dbname = 'pienissimo_db';

$dbuser = 'root';
$dbpass = '';

try {

  $pdo = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);

  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {

  exit("Impossibile connettersi al database: " . $e->getMessage());

}
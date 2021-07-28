<?php

$dbhost = "localhost";
$dbname = 'pienissimo_db';

$dbuser = 'root';
$dbpass = '';

$dbUsersTable = 'users';
$dbTasksTable = 'tasks';

try {

  $pdo = new PDO("mysql:host=$dbhost", $dbuser, $dbpass);

  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $stmt = $pdo->prepare("
    SELECT SCHEMA_NAME
    FROM INFORMATION_SCHEMA.SCHEMATA
    WHERE SCHEMA_NAME = :dbname"
  );

  $stmt->execute(array(":dbname" => $dbname));

  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  if($stmt->rowCount() === 1) {

    // $msg = "Database $dbname e tabelle $dbUsersTable e $dbTasksTable esistono.";
    $pdo = null;

  } else {

    // echo "Il database non esiste";
    $stmt = $pdo->prepare("
      CREATE DATABASE IF NOT EXISTS $dbname;

      CREATE TABLE IF NOT EXISTS $dbname.$dbUsersTable (
        id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
        first_name varchar(255) NOT NULL,
        email varchar(255) NOT NULL,
        password varchar(255) NOT NULL,
        joined_at datetime NOT NULL,
        PRIMARY KEY (id),
        UNIQUE KEY email (email)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

      CREATE TABLE $dbname.$dbTasksTable (
        id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
        user_id  int(11) UNSIGNED NOT NULL,
        title varchar(255) NOT NULL,
        note TINYTEXT,
        created_at datetime NOT NULL,
        updated_at datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        FOREIGN KEY (user_id) REFERENCES users(id)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    ");

    $stmt->execute();

    $pdo = null;
    // $msg = "Database $dbname creato. Tabelle $dbUsersTable e $dbTasksTable create.";
  }
  
} catch(PDOException $e) {

  exit("Impossibile creare database e tabelle: " . $e->getMessage());

}

// header('Location: ../index.php');
// exit;
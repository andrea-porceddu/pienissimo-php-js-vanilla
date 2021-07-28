<?php

session_start();

require_once('../../database/connection.php');

if(isset($_POST['userID']) && isset($_POST['taskTitle']) && isset($_POST['taskNote'])){

  /*********test*********
  $data = [
    // "titolo" => $_POST['taskTitle'],
    // "nota" => $_POST['taskNote']
    // "user_id" => $_POST['userID'],
    "user_id" => 8,
    "titolo" => 'log titolo',
    "nota" => 'log nota'
  ];
  echo json_encode($data);
  *********test*********/

  // funzione sostituzione apostrofo
  function escapeApo($str) {
    return str_replace("'", "\'", $str);
  }

  $userID = escapeApo($_POST['userID']) ?? '';

  $title = escapeApo($_POST['taskTitle']) ?? '';

  $note = escapeApo($_POST['taskNote']) ?? '';

  $query = "
    INSERT INTO tasks (user_id, title, note, created_at, updated_at)
    VALUES ($userID, '$title', '$note', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
  ";

  $check = $pdo->prepare($query);

  $check->execute();

}

$pdo = null;
?>
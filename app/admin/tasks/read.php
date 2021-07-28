<?php

session_start();

require_once('../../database/connection.php');

if(isset($_POST['taskID'])){

  /********* test *********
  $data = [
    "id" => $_POST['taskID'],
    "titolo" => "task1",
    "nota" => "nota di andrea"
  ];
  echo json_encode($data);
  ********* test *********/

  $taskID = $_POST['taskID'] ?? '';

  $query = "
    SELECT *
    FROM tasks
    WHERE id = $taskID;
  ";

  $check = $pdo->prepare($query);

  $check->execute();

  $records = $check->fetchAll();

  foreach ($records as $task) {
    $data = [
      "id" => $task["id"],
      "idUtente" => $task["user_id"],
      "titolo" => $task["title"],
      "nota" => $task["note"],
      "dataCreazione" => $task["created_at"],
      "ultimoAggiornamento" => $task["updated_at"]
    ];
  }

  echo json_encode($data);

}

$pdo = null;
?>
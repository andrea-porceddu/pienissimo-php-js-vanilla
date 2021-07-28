<?php

require_once('../database/connection.php');

if (isset($_POST['register'])) {

  // null coalescing operator (??)
  // viene utilizzato per sostituire l'operazione ternaria in combinazione con la funzione isset()
  // restituisce il suo primo operando se esiste e non è NULL altrimenti restituisce il suo secondo operando.
  $username = $_POST['username'] ?? '';

  $email = $_POST['email'] ?? '';

  $password = $_POST['password'] ?? '';

  // filter_var() filtra una variabile con un filtro specifico
  $isEmailValid = filter_var($email, FILTER_VALIDATE_EMAIL);

  // strlen salvo la lunghezza della stringa in una variabile
  // alternativa (mb_strlen)
  $pwdLenght = strlen($password);

  if (empty($username) || empty($email) || empty($password)) {

    // %s con printf o sprintf i caratteri preceduti dal segno %
    // vengono sostituiti da una variabile passata come argomento
    $msg = 'Compila tutti i campi %s';

  } elseif ($isEmailValid === false) {

    $msg = 'Email non valida';

    // controllo sulla lunghezza della password
  } elseif ($pwdLenght < 8 || $pwdLenght > 20) {

    $msg = '
      Lunghezza minima password 8 caratteri. Lunghezza massima 20 caratteri <br>
      <a href="../../index.php">Torna Indietro</a>
    ';

  } else {
    
    // hashing della password
    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    $query = "
      SELECT id
      FROM users
      WHERE email = :email
    ";

    $check = $pdo->prepare($query);

    // bindParam() filtra i dati da passare alla query prima che venga processata da PDO
    // in questo modo viene effettuato l'escape dell'input evitando SQL injection
    $check->bindParam(':email', $email, PDO::PARAM_STR);

    $check->execute();

    $mail = $check->fetchAll(PDO::FETCH_ASSOC);

    // controllo che la mail sia unica per ogni user
    if (count($mail) > 0) {

      $msg = '
        Email già in uso! Per favore utilizza un\'altra email <br>
        <a href="../../index.php">Torna Indietro</a>';

    } else {

      $query = "
        INSERT INTO users
        VALUES (0, :username, :email, :password, CURRENT_TIMESTAMP)
      ";

      $check = $pdo->prepare($query);

      $check->bindParam(':username', $username, PDO::PARAM_STR);

      $check->bindParam(':email', $email, PDO::PARAM_STR);

      $check->bindParam(':password', $password_hash, PDO::PARAM_STR);

      $check->execute();

      if ($check->rowCount() > 0) {

        $msg = '
          Registrazione eseguita con successo! <br>
          <a href="../../index.php">Effettua il Log In</a>
        ';

      } else {

        $msg = '
          Problemi con l\'inserimento dei dati <br>
          <a href="../../index.php">Torna indietro</a>
        ';

      }

    }

  }

  // echo($msg) . '<br>';
  // echo '<a href="../../index.php">Torna Indietro</a>';

  echo($msg);

}

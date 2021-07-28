<?php

// inizializzo una sessione, se il login darà esito positivo
// memorizzo alcune variabili
// tutte le pagine in cui vengono gestite variabili di sessione devono
// avere in testa allo script la funzione session_start()
// è buona norma installare un certificato SSL/TLS per rendere la connessione
// sicura tra client e server
session_start();

require_once('../database/connection.php');

// controllo se utente già loggato
// in caso positivo viene reindirizzato alla dashboard
if (isset($_SESSION['session-id'])) {

  header('Location: ../admin/dashboard.php');

  exit;

}

if (isset($_POST['login'])) {

  $email = $_POST['email'] ?? '';

  $password = $_POST['password'] ?? '';

  if (empty($email) || empty($password)) {

    $msg = 'Inserisci email e password %s';

  } else {

    $query = "
      SELECT id, first_name, email, password
      FROM users
      WHERE email = :email
    ";

    // prelevo i dati associati allo user inseriti in fase di login
    $check = $pdo->prepare($query);

    $check->bindParam(':email', $email, PDO::PARAM_STR);

    $check->execute();

    $user = $check->fetch(PDO::FETCH_ASSOC);

    // doppio controllo verifica autenticazione utente
    // se l'utente non esiste oppure la password inserita è errata, il login fallisce
    // password_verify()  consente di confrontare due hash
    if (!$user || password_verify($password, $user['password']) === false) {

      $msg = 'Credenziali errate %s';

    } else {

      // Se il login va buon fine, viene rigenerato il session id
      // e memorizzate alcune variabili di sessione
      session_regenerate_id();

      $_SESSION['session-id'] = session_id();

      $_SESSION['session-user-id'] = $user['id'];

      $_SESSION['session-email'] = $user['email'];

      $_SESSION['session-username'] = ucfirst($user['first_name']);

      header('Location: ../admin/dashboard.php');

      exit;
      
    }

  }

  printf($msg, '<br> <a href="../../index.php">Torna Indietro</a>');
  
}

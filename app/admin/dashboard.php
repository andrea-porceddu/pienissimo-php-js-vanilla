<?php

session_start();

require_once('../database/connection.php');    

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- console GET http://localhost/favicon.ico fix/workaround-->
  <link rel="shortcut icon" href="#">
  <!-- jquery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
    integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer">
  </script>
  <!-- google font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Ubuntu+Mono:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
  <!-- fontawesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"/>
  <!-- bootstrap css -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <!-- custom css -->
  <link rel="stylesheet" href="../../css/style.css">
  <title>Pienissimo Vanilla PHP - Dashboard</title>
</head>
<body>



  <nav class="navbar navbar-expand-lg dark-bg sticky-top px-4">
    <a class="navbar-brand ml-sm-2" href="#">
      <img src="../../img/pienissimo.png" width="30" height="30" class="d-inline-block align-top" alt="pienissimo">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarText">
      <form action="./logout.php" class="form-inline">
      <?php

      // verifica inizializzazione session id. in caso positivo visualizzazione dashboard
      if (isset($_SESSION['session-id'])) {

        // htmlspecialchars() escape che consente di prevenire attacchi XSS
        // convertendo eventuali tag HTML presenti nella stringa
        // ENT_QUOTES (necessario se i dati vengono sostituiti in un attributo HTML) comprime l'output tra virgolette singole
        // garantisce che le virgolette siano codificate, in modo che non terminino prematuramente l'attributo value="..."
        // https://stackoverflow.com/questions/16870186/what-does-htmlentities-with-ent-quotes-and-utf-8-do
        
        $sessionId = htmlspecialchars($_SESSION['session-id'], ENT_QUOTES, 'UTF-8');
        $sessionUserId = htmlspecialchars($_SESSION['session-user-id'], ENT_QUOTES, 'UTF-8');
        $sessionEmail = htmlspecialchars($_SESSION['session-email'], ENT_QUOTES, 'UTF-8');
        $sessionUsername = htmlspecialchars($_SESSION['session-username'], ENT_QUOTES, 'UTF-8');

        echo '<span class="mr-sm-4 white-txt">' . $sessionUsername . '</span>';
        echo '<button class="btn btn-sm btn-secondary my-2 my-sm-0 mr-sm-2" type="submit">Log Out</button>';

      } else {

        echo "<span class='mr-sm-2 white-txt'>Effettua il <a href='../../index.php'>Log In</a> per accedere all'area riservata</span>";
      
      }

      // $pdo = null;

      ?>
      </form>
    </div>
  </nav>

  <div class="container-fluid">
    <div class="row">

      <nav class="col-md-3 col-lg-2 d-md-block sidebar dark-bg collapse">
        <div class="sidebar-sticky pt-3">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link white-txt red-hover" href="#"><i class="fas fa-home red-txt"></i> 
                Home
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link white-txt red-hover" href="#"><i class="fas fa-list red-txt"></i>
                Tasks
              </a>
            </li>
          </ul>
        </div>
      </nav>

      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 mb-4">
          <h1 class="h2">Lista Tasks</h1>
          <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
              <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-create">Crea Task</button>
            </div>
          </div>
        </div>

        <!-- create modal -->
        <div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="modal-create-label" aria-hidden="true">
          <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="modal-create-label">Crea nuova Task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form>
                  <!-- user id -->
                  <div class="form-group">
                    <input type="hidden" name="task-user-id" value="<?php echo $sessionUserId ?>">
                  </div>
                  <div class="form-group">
                    <label for="task-edit-title" class="col-form-label">Titolo:</label>
                    <input type="text" class="form-control" name="task-edit-title">
                  </div>
                  <div class="form-group">
                    <label for="task-edit-note" class="col-form-label">Nota:</label>
                    <textarea class="form-control" name="task-edit-note"></textarea>
                  </div>
                  <button type="button" class="btn btn-primary btn-create modal-create-close">Salva</button>
                  <a type="button" class="btn btn-secondary" data-dismiss="close">Chiudi</a>
                </form>
              </div>
            </div>
          </div>
        </div>

        <div class="table-responsive">
          <table class="table">
            <thead class="text-left">
              <tr>
                <th style="width: 2%">#</th>
                <th style="width: 74%">Titolo</th>
                <th style="width: 8%" class="text-center">Note</th>
                <th style="width: 8%" class="text-center">Modifica</th>
                <th style="width: 8%" class="text-center">Elimina</th>
              </tr>
            </thead>
            <tbody>

              <?php
              $query = "
                SELECT tasks.id, tasks.title
                FROM tasks
                INNER JOIN users
                ON users.id = tasks.user_id
                WHERE users.email = '$sessionEmail'
                ORDER BY tasks.id ASC;
              ";

              $check = $pdo->prepare($query);

              $check->execute();

              // $records = $check->setFetchMode(PDO::FETCH_ASSOC);
              $records = $check->fetchAll(PDO::FETCH_ASSOC);

              foreach ($records as $task) {
                echo '
                  <tr>
                    <td class="task-id">' . $task["id"] . '</td>
                    <td>' . $task["title"] . '</td>
                    <td class="text-center">
                      <button type="button" class="btn btn-info btn-sm btn-read" data-toggle="modal" data-target="#modal-read">
                        <i class="fas fa-info"></i>
                      </button>
                    </td>
                    <td class="text-center">
                      <button type="button" class="btn btn-warning btn-sm btn-edit">
                        <i class="fas fa-edit"></i>
                      </button>
                    </td>
                    <td class="text-center">
                      <button type="button" class="btn btn-danger btn-sm btn-delete">
                        <i class="fas fa-trash-alt"></i>
                      </button>
                    </td>
                  </tr>
                ';
              }
              ?>

            </tbody>
          </table>
          
        </div>
      </main>

      <!-- read modal -->
      <div class="modal fade" id="modal-read" tabindex="-1" aria-labelledby="modal-read-label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modal-read-label">
                <p class="small my-0">Task #<span class="read-response-task-id"></span></p>
                <p class="small my-0">creata il: <span class="read-response-task-created-at"></span></p>
                <p class="small my-0">ultimo aggiornamento: <span class="read-response-task-updated-at"></span></p>
              </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p class="my-1">Titolo: <span class="read-response-task-title"></span></p>
              <p class="my-1">Nota: <span class="read-response-task-note"></span></p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Chiudi</button>
            </div>
          </div>
        </div>
      </div>

      <!-- edit modal -->
      <!-- <div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="modal-edit-label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modal-edit-label">Modal title</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              modal edit
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Chiudi</button>
              <button type="button" class="btn btn-primary">Salva</button>
            </div>
          </div>
        </div>
      </div> -->

      <!-- delete modal -->
      <!-- <div class="modal fade" id="modal-delete" tabindex="-1" aria-labelledby="modal-delete-label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modal-delete-label">Modal title</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              modal delete
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Chiudi</button>
              <button type="button" class="btn btn-primary">Salva</button>
            </div>
          </div>
        </div>
      </div> -->

    </div>
  </div>

  <!-- bootstrap js bundle -->
  <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
  <!-- custom js -->
  <script src="../../js/script.js"></script>

</body>
</html>
# pienissimo-php-js-vanilla

simple php js vanilla SPA with basic CRUD actions 

## Installation

You just need to start your web server and configure the installer.php and the connection.php files inside the app/database folder setting the database user and password:

```bash
<?php
$dbuser = 'root';
$dbpass = '';
```
The installer.php script will create the database and two tables: users and tasks

```bash
try {

  $pdo = new PDO("mysql:host=$dbhost", $dbuser, $dbpass);

  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $stmt = $pdo->prepare("
    SELECT SCHEMA_NAME
    FROM INFORMATION_SCHEMA.SCHEMATA
    WHERE SCHEMA_NAME = :dbname"
  );

  $stmt->execute(array(":dbname" => $dbname));
...
```

## Usage
Once the script has created database and tables you can register through a form and then login.
it's a simple application that provides, momentarily, only Creation and Reading of tasks

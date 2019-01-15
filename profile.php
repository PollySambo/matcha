<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'config/database.php';
// print_r($_SESSION);

try {
  $con = new PDO("mysql:host=$DB_DNS;dbname=$DB_NAME", $DB_USER, $DB_PASSWORD, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

  if (isset($_SESSION['loggedin']) === true)
  {

      $stmt = $con->query("SELECT * FROM users,pro_pic");
      while ($row =  $stmt->fetch(PDO::FETCH_ASSOC)){
     
    echo ' 
              <div class="centered">
              <h1 style="text-transform: uppercase;">'.$Username.'</h1>

                  <img  style=" border-radius: 20%;" src="'.$row['path'].'"  width="250 height="250" />
                  
                  <p><b>Name : '.$row['Name'].'</b></p>
                  <p><b>Surname : '.$row['Surname'].'</b></p>
                  <p><b>Gender : '.$row['gender'].'</b></p>
                  <p><b>Interest : '.$row['preference'].'</b></p>
                  <p><b>Age : 20</b></p>
                  
  
              </div>
           ';
  }
}

  }

  catch(PDOException $e)
  {
      die($e->getMessage());
  }

?>

<!Doctype html>
<html lang="en">
  <head>
    <title>profile</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
                <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
                <script src="https://unpkg.com/typewriter-effect/dist/core.js"></script>
    <link rel="stylesheet"  type=text/css href="profile.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  </head>
  <body>

        <nav class="navbar navbar-expand-sm bg navbar fixed-top">
                            <a class="navbar-brand" href="#">
                                <img src="images/logo.png" width="100" height="100" class="d-inline-block align-top" alt="">
                            </a>
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item" style="margin-right:30px">
                                <a class="fas fa-home" href="index.php"> home</a>


                            </ul>
        </nav>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>


  </body>
</html>
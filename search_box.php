<?php
session_start();

require_once 'config/database.php';
// print_r($_SESSION);


$con = new PDO("mysql:host=$DB_DNS;dbname=$DB_NAME", $DB_USER, $DB_PASSWORD, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

        // get the name that is beig searched for 
        $name = isset($_GET['name']) ? trim($_GET['name']) : '';

         // the simple sql query that i will be running
        // $sql = "SELECT ''"

        // add % for wildcard search
        $name = "%$name%";

        // prepare the SELECT staement
        $stmt = $con->prepare($sql);

        // bind the $name varible to our :name parameter.
        $stmt->bindValue(':name', $name);

        // execute the SQL statement.
        $stmt->execute();

        // fetch result as an assoiative array.
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // echo the $res array in a JSON formatas that we can 
        // easily handle the results with the javascript / jQuerry
        echo json_encode($res);
        ?>


<!DOCTYPE html>
<html>
  <head>
    <title>Search Box</title>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js">        </script>
     <script src="typeahead.min.js"></script>

    <link rel="stylesheet" type="text/css" media="screen" href="search_box.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  </head>

  <body>

  <nav class="navbar navbar-expand-sm bg navbar fixed-top">
                            <a class="navbar-brand" href="#">
                                <img src="images/logo.png" width="100" height="100" class="d-inline-block align-top" alt="">
                            </a>
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item" style="margin-right:30px">
                                <a class="fas fa-sign-out-alt" href="login.php"> signin</a>
                                </li>
                                <li class="nav-item">
                                <a class="fas fa-user-plus" href="signup.php"> signup</a>
                                </li>
                            </ul>
    </nav>

    <div class="container h-100">
      <div class="d-flex justify-content-center h-100">
        <div class="searchbar">
          <input class="search_input" type="text" name="" placeholder="Search...">
          <a href="#" class="search_icon"><i class="fas fa-search"></i></a>
        </div>
      </div>
    </div>
        <!-- using the typeahead library for the search box -->
    <script>
        $(document).ready(function(){
            $('input.typeahead').typeahead({
                name :'typeahead',
                remote : 'search_box.php?key=%QUERY',
                limit : 10
            });
        });
    </script>

  </body>
</html>

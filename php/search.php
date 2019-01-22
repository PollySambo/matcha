<!doctype html>
<html lang="en">
  <head>
  <link rel="stylesheet" type="text/css" media="screen" href="../css/search.css" />
     
    <title>search</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  </head>
  <body>

            <!-- navbar -->
      <nav style=" background-color: transparent;" class="navbar navbar-light bg-light">
          <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
              <a   class="fas fa-power-off" class="nav-link" href="sign_out.php"> Sign out</a>
            </li>
         </ul>
      </nav>
      

      <div id="container">
            <p><a href="https://en.wikipedia.org/wiki/Orange">
            SEARCH
            </a></p>
      </div>


        <div class="profile center ">
          <form action ="search.php" method= "POST">
                <input style="text-align: center;" type="text" name="search_box" placeholder= "search via tag "/>
                <label for="sort"> Sort by:</label>
                <br>

                <div class="form-group">
                  <label for="gender1" class="col-sm-2 control-label">With Bootstrap:</label>
                    <div class="col-sm-2">
                      <select class="form-control" id="gender1">
                            <option>Male</option>
                            <option>Female</option>
                          </select>          
                        </div>
                    </div>  
                  </select>
                <br>
                <button  class="r" type="submit" value= "search" name="search">Search</button>
          </form>
        </div>

        <!-- output -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>


<?php
  session_start();
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
 
  include '../config/database.php';
 
       try {
         $con = new PDO("mysql:host=$DB_DNS;dbname=$DB_NAME", $DB_USER, $DB_PASSWORD);
         // now set the PDO error mode to exception
         $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         // create your desired database
         $stmt = $con->prepare("SELECT * FROM users, hobby WHERE hobby.user_id = users.user_id");
         $stmt->execute();
         $results =  $stmt->fetchAll(PDO::FETCH_ASSOC);
         
         // echo "<pre>";
         // var_dump($results);
         // echo "<pre>";
         // die();

        
 
         }
       catch(PDOException $e)
       {
           die($e->getMessage());
       } 
 
?>
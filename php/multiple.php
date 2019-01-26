<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../config/database.php';
// require_once 'funcions.php';

print_r($_SESSION);

try {
    $con = new PDO("mysql:host=$DB_DNS;dbname=$DB_NAME", $DB_USER, $DB_PASSWORD, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

    if (isset($_POST["submit"]))
    {
            $filename = $_FILES['img']['name'];
            $tmpname = $_FILES['img']['tmp_name'];
            $filetype = $_FILES['img']['type'];
            $username = $_SESSION['username'];
            $user_id = $_SESSION['user_id'];

            for($i=0; $i<=count($tmpname)-1; $i++)
            {
                $name = addslashes($filename[$i]);
                $tmp = addslashes(file_get_contents($tmpname[$i]));
               

                $sql = "INSERT INTO four (`user_id` ,`name`, `image`, `user`)
                VALUES ('".$user_id."', '".$name."', '".$tmp."', '".$username."')";
                $stmt = $con->prepare($sql);
                $stmt->execute();
                header('location:location.php');

                

            }
    }
}

    catch(PDOException $e)
    {
        die($e->getMessage());
    }


               $stmt = $con->prepare("SELECT * FROM four WHERE user_id = :user_id");
                // $stmt = $con->prepare($sql);
                $stmt->bindParam(':user_id', $user_id);
                $stmt->execute();


                while ($row =  $stmt->fetch(PDO::FETCH_ASSOC))
                {
                    $display = $row['image'];


                            echo '
                            <div class="wrapper">
                                <img src="data:image/jpeg;base64,'.base64_encode($display).'" class="image--cover  width="250 height="250"/>

                            </div>
                            ';
            // <!-- <div class="wrapper">

            // <img src="data:image/jpeg;base64,'.base64_encode($display).'" class="image--cover">
            
            // <img src="http://imgc.allpostersimages.com/images/P-473-488-90/68/6896/2GOJ100Z/posters/despicable-me-2-minions-movie-poster.jpg" alt="" class="image--cover" />
            
            // <img src="http://static.eharmony.com/blog/wp-content/uploads/2010/04/eHarmony-Blog-profile-picture.jpg" alt="" class="image--cover" />
            
            // <img src="https://i2.cdn.turner.com/cnnnext/dam/assets/140926165711-john-sutter-profile-image-large-169.jpg" alt="" class="image--cover" />
            // </div> -->
                }

?>




<!doctype html>
<html lang="en">
  <head>
    <title>multiple</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" media="screen" href="../css/multiple.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    </head>
    <body style="background-color: #222222; background: repeating-linear-gradient(45deg, #2b2b2b 0%, #2b2b2b 10%, #222222 0%, #222222 50%) 0 / 15px 15px;" >

            <!-- navbar -->
            <nav style=" background-color: transparent;" class="navbar ">
            <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
                <b><a   class="fas fa-power-off" class="nav-link" href="sign_out.php"> Sign out</b></a>
            </li>
            </ul>
            </nav>

            <div id="container">
                        <p><a href="https://en.wikipedia.org/wiki/Orange">
                        MULTIPLE.
                        </a></p>
            </div>

            <form  action="multiple.php" method="post" enctype="multipart/form-data">
                <input type="file" name="img[]" multiple="multiple"  />
                <input  class="r"name="submit" type="submit" />
            </form>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
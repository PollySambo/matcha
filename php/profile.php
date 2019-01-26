<!doctype html>
<html lang="en">
  <head>
    <title>profile</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- card -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" media="screen" href="../css/profile.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  </head>
  <body style="background-color: #222222; background: repeating-linear-gradient(45deg, #2b2b2b 0%, #2b2b2b 10%, #222222 0%, #222222 50%) 0 / 15px 15px;" >

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
                        PROFILE.
                        </a></p>
            </div>
           

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
    $con = new PDO("mysql:host=$DB_DNS;dbname=$DB_NAME", $DB_USER, $DB_PASSWORD, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
  
    if (isset($_SESSION['loggedin']) === true)
    {
        $user_id = $_SESSION['user_id'];
        $username =$_SESSION['username'];
  
       
        var_dump($_SESSION);
  
            $stmt = $con->prepare("SELECT * FROM users WHERE user_id=:user_id");
            $stmt->bindValue(':user_id', $user_id);
            $stmt->execute();
            $rowIMG =  $stmt->fetch(PDO::FETCH_ASSOC);

            $stmt = $con->prepare("SELECT * FROM hobby WHERE user_id=:user_id");
            $stmt->bindValue(':user_id', $user_id);
            $stmt->execute();
            $row =  $stmt->fetch(PDO::FETCH_ASSOC);
            
               echo 
               '

                
                  <div class="profile-card">

                            <header>
        
                                <img style=" border-radius: 30%;" src="'.$row['path'].'"  width="250px" height="250px"/>
                            
                                <div ><h1>'.$_SESSION["username"].'</h1></div>

                                <div ><h2>'.$row['gender'].'</h2></div>

                            </header>
                        <div class="profile-bio">
                        <h1 style="color:  #ff1177;"><b>My Profile<b></h1>

<br/>
                    <div ><h1>Name :'.$rowIMG["name"].'</h1></div>
                    <div ><h1>Interest : '.$row["preference"].'</h1></div>
                    <div ><h1>Bio: '.$row["bio"].'</h1></div>
                    <div><h1>Age: '.$row["age"].'</h1></div>
                    <a  id="p" href="suggestions.php">see suggestions</a>
                    <a  id="p" href="modify_username">change username</a>
                    <a  id="p" href="modify_email.php">change email</a>
                    <a  id="p" href="suggestions.php">location</a>
                    <a  id="p" href="blocked.php">block</a>

</div>

            ';
    }
  
  }
  
    catch(PDOException $e)
    {
        die($e->getMessage());
    }


?>
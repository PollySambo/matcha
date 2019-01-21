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
  <body>


  <aside class="profile-card"> 

<header>

    <!-- here’s the avatar -->
    
        <img src="https://c7.uihere.com/files/893/362/507/mitch-muscle-man-sorenstein-muscle-woman-character-regular-show-season-4-cartoon-network-cartoon-porn-thumb.jpg" width="220px" height="220px" />
    

    <!-- the username -->
   
    <div class="moon"><h1>Psambo</h1></div> 

    <!-- gender -->

    <div class="moon"><h2>Female</h2></div>

</header>

<!-- bit of a bio; who are you? -->
<div class="profile-bio">
<h1>My Profile</h1>

<br/>
                    <div class="moon"><p><b>Name : polit sambo</b></p></div>
                    <div class="moon"><p><b>Gender : Female</b></p></div>
                    <div class="moon"><p><b>Interest : Women</b></p></div>
                    <div class="moon"><p><b>Bio: some text</b></p></div>
                    <div class="moon"><p><b>Bio: some text</b></p></div>

</div>



</aside>



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
        $userame = $username['username'];
  
        // $stmt = $con->prepare("SELECT * FROM users WHERE user_id=:user_id");
        // $stmt->bindValue(':user_id', $user_id);
        // $stmt->execute();
        // $row =  $stmt->fetch(PDO::FETCH_ASSOC);
        // // var_dump($row);
  
            $stmt = $con->prepare("SELECT * FROM hobby WHERE user_id=:user_id");
            $stmt->bindValue(':user_id', $user_id);
            $stmt->execute();
            $rowIMG =  $stmt->fetch(PDO::FETCH_ASSOC);
            print_r($rowIMG);
               echo 
               '


                  <aside class="profile-card">

                            <header>
        
                                <img style=" border-radius: 30%;" src="'.$rowIMG['path'].'"  width="250px" height="250px"/>
                            
                                <div class="moon"><h1>'.$row["username"].'</h1></div>

                                <div class="moon"><h2>'.$row['gender'].'</h2></div>

                            </header>
                        <div class="profile-bio">
                        <h1>My Profile</h1>

<br/>
                    <div class="moon"><p><b>Name :'.$row["name"].'</b></p></div>
                    <div class="moon"><p><b>Interest : '.$row["preference"].'</b></p></div>
                    <div class="moon"><p><b>Bio: '.$row["bio"].'</b></p></div>
                    <div class="moon"><p><b>Age: '.$row["age"].'</b></p></div>

</div>



</aside>
            ';
    }
  
  }
  
    catch(PDOException $e)
    {
        die($e->getMessage());
    }


?>
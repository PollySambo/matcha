<!doctype html>
<html lang="en">
  <head>
    <title>hobbies</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


  <!-- look -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" media="screen" href="../css/hobby.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  </head>
  <body >

    <h1 id="header">continue</h1>

        <div class="inner contact">
                <!-- Form Area -->
                <div class="contact-form">
                    <!-- Form -->
                    <form id="contact-us" method="post" action="hobby.php"  enctype="multipart/form-data">
                        <!-- Left Inputs -->
                        <div class="col-xs-6 wow animated slideInLeft" data-wow-delay=".5s">
                            <!-- age -->
                            <input type="number" name="age" id="name" required="required" class="form" placeholder="Age" />
                            <!-- gendrr -->
                            <input type="text" name="gender" id="mail" required="required" class="form" placeholder="Gender" />
                            <!-- pref -->
                            <input type="text" name="preference" id="subject" required="required" class="form" placeholder="Preference" />
                            <!-- location -->
                           <input type="text" name="location" id="subject" required="required" class="form" placeholder="Location" />

                             

                        </div><!-- End Left Inputs -->
                        <!-- Right Inputs -->
                      
                       
                      
                        <div class="col-xs-6 wow animated slideInRight" data-wow-delay=".5s">
                            <!-- Message -->
                            <textarea name="bio" id="message" class="form textarea"  placeholder="About Me"></textarea>
                        </div>
                        
                          <!--  profle picture-->
                          <input type="file" name="uploadedfile"  class="form" class="form" >

                        <!-- End Right Inputs -->

                        <!-- Bottom Submit -->
                        <div class="relative fullwidth col-xs-12">
                            <!-- Send Button -->
                            <input type="submit" name="submit" class="form-btn semibold"  value="submit"/>
                        </div><!-- End Bottom Submit -->
                        <!-- Clear -->
                        <div class="clear"></div>
                    </form>

                    
                    </div>

                </div><!-- End Contact Form Area -->
            </div><!-- End Inner -->
 

      


    <!-- look -->
    
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

print_r($_SESSION);


include '../config/database.php';

if (!empty($_POST['age']) || !empty($_POST['gender']) || !empty($_POST['preference']) || !empty($_POST['location']) || !empty($_POST['bio'])) {
  $age = trim(htmlspecialchars($_POST['age']));
  $gender = trim(htmlspecialchars($_POST['gender']));
  $preference = trim(htmlspecialchars($_POST['preference']));
  $location = trim(htmlspecialchars($_POST['location']));
  $bio = trim(htmlspecialchars($_POST['bio']));

  // image
    $target_path="../images/";
    $target_path=$target_path.basename($_FILES['uploadedfile']['name']);

    // session variables
    $username = $_SESSION['username'];
    $user_id = $_SESSION['user_id'];

    if (move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path))
    {
      try {
        $con = new PDO("mysql:host=$DB_DNS;dbname=$DB_NAME", $DB_USER, $DB_PASSWORD, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

                $sql = "INSERT INTO `hobby` ( `user_id`,`user`,`path`, `age`, `gender`, `preference`, `location`, `bio`)
                VALUES ('".$user_id."','".$username."', '".$target_path."', '".$age."', '".$gender."', '".$preference."', '".$location."', '".$bio."')";
                $stmt = $con->prepare($sql);
                $stmt->execute();
                header('location:multiple.php');

        }

        catch(PDOException $e)
        {
            die($e->getMessage());
        }
  }

}


?>
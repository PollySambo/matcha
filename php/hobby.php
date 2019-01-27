<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

print_r($_SESSION);


include '../config/database.php';

if (!empty($_POST['age']) || !empty($_POST['gender']) || !empty($_POST['preference']) || !empty($_POST['bio'])) {
  $age = trim(htmlspecialchars($_POST['age']));
  $gender = trim(htmlspecialchars($_POST['gender']));
  $preference = trim(htmlspecialchars($_POST['preference']));
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

                $sql = "INSERT INTO `hobby` ( `user_id`,`user`,`path`, `age`, `gender`, `preference`, `bio`)
                VALUES ('".$user_id."','".$username."', '".$target_path."', '".$age."', '".$gender."', '".$preference."', '".$bio."')";
                $stmt = $con->prepare($sql);
                $stmt->execute();

                header('location: http://localhost:8080/matcha/php/location.html');

        }

        catch(PDOException $e)
        {
            die($e->getMessage());
        }
  }

}
?>

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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  </head>

<body>
  <!-- <body style="background-color: #222222; background: repeating-linear-gradient(45deg, #2b2b2b 0%, #2b2b2b 10%, #222222 0%, #222222 50%) 0 / 15px 15px;" > -->

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
                        ABOUT ME.
                        </a></p>
            </div>

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


                        		<!-- links -->
                   <a  id="p" href="fame_ratings.php">like or comment</a>
                   <a  id="p" href="suggestions.php">see suggestions</a>
                    <a  id="p" href="modify_email.php">change email</a>
                    <a  id="p" href="blocked.php">blocked</a>


                    
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

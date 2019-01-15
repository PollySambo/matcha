<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    require_once 'config/database.php';
    if ( !empty($_POST['fname']) || !empty($_POST['lname']) || !empty($_POST['username']) || !empty($_POST['email']) || !empty($_POST['pwd']) || !empty($_POST['re_pwd']))
    {
        $fname          = trim(htmlspecialchars($_POST['fname']));
        $lname          = trim(htmlspecialchars($_POST['lname']));
        $username       = trim(htmlspecialchars($_POST['username']));
        $email          = trim(htmlspecialchars($_POST['email']));
        $pwd          = trim(htmlspecialchars($_POST['pwd']));
        $re_pwd         = trim(htmlspecialchars($_POST['re_pwd']));
        if ( isset($_POST[ 'female']))
                $gender = 'female';
        else
            $gender = 'male';
        $legal = 0;
        if ( isset($_POST['legal']) )
          $legal = 1;
        $preference = $_POST['preference'];
        $active         = false;
        $notifi         = true;
        $token			= bin2hex(openssl_random_pseudo_bytes(16));
        $Age = trim(htmlspecialchars($_POST['Age']));
        if (!isset($username) || empty($username) || strlen($username) < 4)
        {
          echo "! Username input is invalid - *also check to see if username is more than 4 characters long<br>";
        }
        else if (!isset($email) || empty($email) || !(filter_var($email, FILTER_VALIDATE_EMAIL)))
        {
          echo "! Email input is invalid<br>";
        }
        else if (!isset($pwd) || empty($pwd) || !($pwd === $re_pwd) || !(strlen($pwd) > 6) || (!preg_match('/(?=.*[a-z])(?=.*[0-9]).{6,}/i', $pwd)))
        {
            echo "! Password input is invalid<br>";
            if (!($pwd === $re_pwd))
            {
              echo "! Password fields do not match<br>";
            }
            if (!(strlen($pwd) > 6))
            {
              echo "! Password length is too short, must be atleast 6 characters long<br>";
            }
            if (!preg_match('/(?=.*[a-z])(?=.*[0-9]).{6,}/i', $pwd))
            {
              echo "! Password must contain letters and digits<br>";
            }
        }
        else if ((isset($username) && !empty($username) && !(strlen($username) < 4)) 
          && (isset($email) && !empty($email) && (filter_var($email, FILTER_VALIDATE_EMAIL))) 
          && (isset($pwd) && !empty($pwd) && ($pwd === $re_pwd) && (strlen($pwd) > 6) || (preg_match('/(?=.*[a-z])(?=.*[0-9]).{6,}/i', $pwd))))
        {
          //       $con = new PDO("mysql:host=$DB_DNS;dbname=$DB_NAME", $DB_USER, $DB_PASSWORD);
          // $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
          //       $user = checkExist($username, $email, $con);
                // if (!$user)
                // {
            $hashpass = password_hash($pwd, PASSWORD_BCRYPT);
            try {
              $con = new PDO("mysql:host=$DB_DNS;dbname=$DB_NAME", $DB_USER, $DB_PASSWORD, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
              // // PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING
              // $con->setAttribute();
                      $sql = "INSERT INTO `users` ( `Username`, `Name`, `Surname`, `Age`, `email`, `Password`, `token`, `active`, `notifications`, `gender`, `legal`, `preference`)
                      VALUES (:username, :fname, :lname, :Age, :email, :pwd, :token, :activated, :notifications, :gen, :legal, :pref)";
                      $stmt = $con->prepare($sql);
                      $stmt->bindParam(':username', $username);
                      $stmt->bindParam(':fname', $fname);
                      $stmt->bindParam(':lname', $lname);
                      $stmt->bindParam(':Age', $Age);
                      $stmt->bindParam(':email', $email);
                      $stmt->bindParam(':pwd', $hashpass);
                      $stmt->bindParam(':token', $token);
                      $stmt->bindParam(':gen', $gender);
                      $stmt->bindParam(':legal', $legal);
                      $stmt->bindParam(':pref', $preference);
                      $stmt->bindParam(':activated', $active, PDO::PARAM_BOOL);
                      $stmt->bindParam(':notifications', $notifi , PDO::PARAM_BOOL);
                      $stmt->execute();
                    } catch(PDOException $e)
                    {
                      die($e->getMessage());
                    }

                                $message ="
    Thank you for registering with MaTcHa.
    You can log in using the following credentials after verification:
    -------------------
    USERNAME :".$Username."
    -------------------
    please verify your account by clicking the link below
    http://127.0.0.1:8080/matcha/verify.php?email=$email&token=$token

    Kind regards
    MaTcHa Team";

                    $subject = "verify your account";
                    if (mail($email,$subject,$message))
                    {
                        $msg = "Mail sent OK";
                        echo "<script>alert('signed up');</script>";
                        header('location:login.php');
                    }
                    else
                        die('email failed to send');
                }
                else
                    die('Username/Email Already Exists');
            // }
            // else
            //     die('something went wrong');
            //         $conn = null;
    }
?>



<!DOCTYPE html>
<html>
  <head>
    <title>Home Page</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <script src="https://unpkg.com/typewriter-effect/dist/core.js"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="signup.css" />
      <script src="myscripts.js"></script>
  </head>
  <body>
    <nav class="navbar navbar-expand-sm bg navbar fixed-top">
      <a class="navbar-brand" href="#">
          <img src="images/logo.png" width="100" height="100" class="d-inline-block align-top" alt="">
      </a>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item"  style="margin-right:30px">
          <a class="fas fa-home" href="index.php"> home</a>
        </li>
        <li class="nav-item" >
          <a class="fas fa-sign-out-alt" href="login.php"> signin</a>
        </li>
      </ul>
    </nav>
    <div class="form_wrapper">
      <div class="form_container">
        <div class="title_container">
          <h2>Sign Up</h2>
        </div>
        <div class="row clearfix">
          <div class="">
            <form action='signup.php' method="post">

          


                  <!-- <div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
                    <input type="text" name="username" placeholder="Username" />
                  </div> -->
            <div class="row clearfix">
           

                <div class="col_half">
                  <div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
                    <input type="text" name="fname" placeholder="First Name" />
                  </div>
                </div>
                <div class="col_half">
                  <div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
                    <input type="text" name="lname" placeholder="Last Name" required />
                  </div>
                </div>

               <div class="col_half">
            <div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
                <input id="username" type="text" name="username" placeholder="Username" required />
              </div>
            </div>

              </div>
              <div class="input_field"> <span><i aria-hidden="true" class="fa fa-envelope"></i></span>
                <input type="email" name="email" placeholder="Email" required />
              </div>
              <div class="input_field"> <span><i aria-hidden="true" class="fa fa-lock"></i></span>
                <input type="password" name="pwd" placeholder="Password" required />
              </div>
              <div class="input_field"> <span><i aria-hidden="true" class="fa fa-lock"></i></span>
                <input type="password" name="re_pwd" placeholder="Re_type Password" required />
              </div>
                  <div > <span><i aria-hidden="true" class="fa fa-child"></i></span>
                  <input id="testage" type="number" name="Age" placeholder="Age" required />
                  </div>
              <!-- <div class="input_field"> <span><i aria-hidden="true" class="fa fa-lock"></i></span>
                <input type="number" name="Age" placeholder="Age" required />
              </div> -->
              
                  <div class="input_field radio_option">
                      <input type="radio" name="male" id="rd1">
                      <label for="rd1">Male</label>
                      <input type="radio" name="female" id="rd2">
                      <label for="rd2">Female</label>
                  </div>
                  <div class="input_field select_option">
                    <select name='preference'>
                      <option>Select a sexual preference</option>
                      <option value="male">Male</option>
                      <option value="female">Female</option>
                      <option value="both">Both</option>
                    </select>
                    <div class="select_arrow"></div>
                  </div>
                <div class="input_field checkbox_option">
                  <input type="checkbox" name="legal" id="cb1">
              <label for="cb1">Im Over 18</label>
                </div>
                <!-- <div class="input_field checkbox_option">
                  <input type="checkbox" name="notifications">
              <label for="cb2">I want to receive the newsletter</label>
                </div> -->
              <input class="button" type="submit" value="Register" />
            </form>
          </div>
        </div>
      </div>
  </div>
    <footer class="footer container-fluid text-center">
        <b><p>&copy psambo  matcha 2018</p></b>
    </footer>

</body>
</html>
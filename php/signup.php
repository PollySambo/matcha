<!doctype html>
<html lang="en">
  <head>
    <title>signup</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" media="screen" href="http://localhost:8080/matcha2/css/signup.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  </head>
  <body>
      
        <!-- form -->

    <form class="form-signup">
          
            <h1 class="h3 mb-3 font-weight-normal">Please sign up</h1>

            <label for="inputName" class="sr-only">Full Name/label>
            <input type="text"  name="name"  class="form-control" placeholder="username" required autofocus>
           
                <label for="inputEmail" class="sr-only">Email</label>
                <input type="email"  name="email"  class="form-control" placeholder="username" required autofocus>

            <label for="inputEmail" class="sr-only">Username</label>
            <input type="text"  name="username"  class="form-control" placeholder="username" required autofocus>

                <label for="inputPassword" class="sr-only">Password</label>
                <input type="password"  name="password" class="form-control" placeholder="Password" required>

            <label for="inputPassword" class="sr-only">Re-Password</label>
            <input type="password"  name="re_password" class="form-control" placeholder="Re_Password" required>

                 <button class="btn btn-lg btn-primary btn-block" type="submit">Sign up</button>

                 <p class="mt-5 mb-3 text-muted">&copy; <i>psambo 2018</i></p>
       
        
    </form>

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

        require_once 'config/database.php';
        if (!empty($_POST['name']) || !empty($_POST['username']) || !empty($_POST['email']) || !empty($_POST['password']) || !empty($_POST['re_password'])) {
            $name = trim(htmlspecialchars($_POST['name']));
            $username = trim(htmlspecialchars($_POST['username']));
            $email = trim(htmlspecialchars($_POST['email']));
            $password = trim(htmlspecialchars($_POST['password']));
            $re_passsword = trim(htmlspecialchars($_POST['re_password']));
            $active = false;
            $notifi = true;
            $token = bin2hex(openssl_random_pseudo_bytes(16));

            if (!isset($username) || empty($username) || strlen($username) < 4) {
                echo '! Username input is invalid - *also check to see if username is more than 4 characters long<br>';
            } elseif (!isset($email) || empty($email) || !(filter_var($email, FILTER_VALIDATE_EMAIL))) {
                echo '! Email input is invalid<br>';
            } elseif (!isset($password) || empty($password) || !($pwd === $re_passsword) || !(strlen($password) > 6) || (!preg_match('/(?=.*[a-z])(?=.*[0-9]).{6,}/i', $password))) {
                echo '! Password input is invalid<br>';
                if (!($password === $re_passsword)) {
                    echo '! Password fields do not match<br>';
                }
                if (!(strlen($password) > 6)) {
                    echo '! Password length is too short, must be atleast 6 characters long<br>';
                }
                if (!preg_match('/(?=.*[a-z])(?=.*[0-9]).{6,}/i', $password)) {
                    echo '! Password must contain letters and digits<br>';
                }
            } elseif ((isset($username) && !empty($username) && !(strlen($username) < 4))
              && (isset($email) && !empty($email) && (filter_var($email, FILTER_VALIDATE_EMAIL)))
              && (isset($password) && !empty($password) && ($password === $re_passsword) && (strlen($password) > 6) || (preg_match('/(?=.*[a-z])(?=.*[0-9]).{6,}/i', $password)))) {
                $hashpass = password_hash($password, PASSWORD_BCRYPT);
                try {
                    $con = new PDO("mysql:host=$DB_DNS;dbname=$DB_NAME", $DB_USER, $DB_PASSWORD, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
                    // // PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING
                    // $con->setAttribute();
                    $sql = 'INSERT INTO `users` ( `name`, `email`, `username`, `password`, `token`, `active`, `notifi`)
                          VALUES (:name, :email, :username, :password, :token, :active, :noti)';
                    $stmt = $con->prepare($sql);
                    $stmt->bindParam(':name', $username);
                    $stmt->bindParam(':email', $fname);
                    $stmt->bindParam(':username', $email);
                    $stmt->bindParam(':password', $hashpass);
                    $stmt->bindParam(':token', $token);
                    $stmt->bindParam(':activated', $active, PDO::PARAM_BOOL);
                    $stmt->bindParam(':notifications', $notifi, PDO::PARAM_BOOL);
                    $stmt->execute();
                } catch (PDOException $e) {
                    die($e->getMessage());
                }

                $message = '
        Thank you for registering with MaTcHa.
        You can log in using the following credentials after verification:
        -------------------
        USERNAME :'.$username."
        -------------------
        please verify your account by clicking the link below
        http://127.0.0.1:8080/matcha2/verify.php?email=$email&token=$token
    
        Kind regards
        MaTcHa Team";

                $subject = 'verify your account';
                if (mail($email, $subject, $message)) {
                    $msg = 'Mail sent OK';
                    echo "<script>alert('signed up');</script>";
                    header('location:signin.php');
                } else {
                    die('email failed to send');
                }
            } else {
                die('Username/Email Already Exists');
            }
        } else {
            die('something went wrong');
        }
                        $con = null;

?>
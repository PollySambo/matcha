<!doctype html>
<html lang="en">
  <head>
    <title>signup</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" media="screen" href="http://localhost:8080/matcha/css/signup.css" />
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
                        SIGN UP
                        </a></p>
            </div>

        <!-- form -->
        <div class="container center">
                    <div class="row">
                    <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2">

        <form class="form-horizontal" method="post" action="signup.php center">
                <br>
                <fieldset>
                <legend>Signup here</legend>			
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Your Name</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="name" placeholder="Enter your Name" required>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="email" class="cols-sm-2 control-label">Your Email</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="email" id="email"  placeholder="Enter your Email"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="username" class="cols-sm-2 control-label">Username</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="username"  placeholder="Enter your Username"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="password" class="cols-sm-2 control-label">Password</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
									<input type="password" class="form-control" name="password"   placeholder="Enter your Password"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="confirm" class="cols-sm-2 control-label">Confirm Password</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
									<input type="password" class="form-control" name="confirm" placeholder="Confirm your Password"/>
								</div>
							</div>
						</div>

						<div class="form-group ">
							<input class="r" type="submit" value="submit"/>
						</div>
 </fieldset>
					</form>

</div>
</div>
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

    if (!empty($_POST['name']) || !empty($_POST['email']) || !empty($_POST['username']) || !empty($_POST['password']) || !empty($_POST['confirm'])) {
        $name = trim(htmlspecialchars($_POST['name']));
        $email = trim(htmlspecialchars($_POST['email']));
        $username = trim(htmlspecialchars($_POST['username']));
        $password = trim(htmlspecialchars($_POST['password']));
        $confirm = trim(htmlspecialchars($_POST['confirm']));
        $token = bin2hex(openssl_random_pseudo_bytes(16));
        $notifi = true;
        $active = false;
       

        if (!isset($username) || empty($username) || strlen($username) < 4) {
            echo '! Username input is invalid - *also check to see if username is more than 4 characters long<br>';
        } elseif (!isset($email) || empty($email) || !(filter_var($email, FILTER_VALIDATE_EMAIL))) {
            echo '! Email input is invalid<br>';
        } elseif (!isset($password) || empty($password) || !($password === $confirm) || !(strlen($password) > 6) || (!preg_match('/(?=.*[a-z])(?=.*[0-9]).{6,}/i', $password))) {
            echo '! Password input is invalid<br>';
            if (!($password === $confirm)) {
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
          && (isset($password) && !empty($password) && ($password === $confirm) && (strlen($password) > 6) || (preg_match('/(?=.*[a-z])(?=.*[0-9]).{6,}/i', $password)))) {
            $hashpass = password_hash($password, PASSWORD_BCRYPT);

            try {
                $con = new PDO("mysql:host=$DB_DNS;dbname=$DB_NAME", $DB_USER, $DB_PASSWORD, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

                $sql = 'INSERT INTO `users` ( `name`, `email`, `username`, `password`, `token`, `active`, `notifications`)
                      VALUES (:name, :email, :username, :password, :token, :active, :notifications)';
                $stmt = $con->prepare($sql);
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':password', $hashpass);
                $stmt->bindParam(':token', $token);
                $stmt->bindParam(':active', $active, PDO::PARAM_BOOL);
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
    http://127.0.0.1:8080/matcha/verify.php?email=$email&token=$token

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
    } 

    $con = null;
?>

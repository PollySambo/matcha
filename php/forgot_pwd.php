<!doctype html>
<html lang="en">
  <head>
	<title>forgot_password</title>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
	<link rel="stylesheet" type="text/css" media="screen" href="../css/forgot.css" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  </head>
  <body style="background-color: #222222; background: repeating-linear-gradient(45deg, #2b2b2b 0%, #2b2b2b 10%, #222222 0%, #222222 50%) 0 / 15px 15px;" >
  
  <!-- navbar -->
        <nav style=" background-color: transparent;" class="navbar navbar-light bg-light">
                    <ul class="navbar-nav px-3">
                    <li class="nav-item text-nowrap">
                    <a   class="fas fa-power-off" class="nav-link" href="signup.php"> Sign up</a>
                    </li>
                    </ul>
        </nav>

        <div id="container">
                    <p><a href="https://en.wikipedia.org/wiki/Orange">
                    INPUT EMAIL
                    </a></p>
        </div>

  			<form class="wrapper center" action="forgot_pwd.php" method="post">
				<input type="email" placeholder="Email Address" name="email" required>
				<input type="submit" name="signup" value="submit">
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

	require '../config/database.php';

	$email	= $_POST['email'];
	$token	= bin2hex(openssl_random_pseudo_bytes(16));
	var_dump($email);
	if (isset($email) && !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL))
	{
		$conn = new PDO("mysql:host=$DB_DSN;dbname=$DB_NAME", $DB_USER, $DB_PASSWORD);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		$sql = "USE ".$DB_NAME;
		$stmt = $conn->prepare("SELECT * FROM users WHERE email=:email");
		$stmt->bindValue(':email', $email);
		$stmt->execute();
		$result = $stmt->fetch();
		if (!$result)
			echo('email does not exist');
		else
		{
			// var_dump($token);
			
			$conn = new PDO("mysql:host=$DB_DSN;dbname=$DB_NAME", $DB_USER, $DB_PASSWORD);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			$sql = "USE ".$DB_NAME;
			$stmt = $conn->prepare("UPDATE users SET token = :token");
			$stmt->bindParam(':token', $token);
			$stmt->execute();
			echo "added token\n";
			echo "$email";
			
			$to			= $email; 
			$subject	= 'Password Reset';
			$message	= 
			"
cant believe you forgot your password, but anyway lets reset it OK:):
	http://localhost:8080/matcha/php/reset_pwd.php?email='$email'&token='$token'
			";
			if (mail($to, $subject, $message))
			{
				echo "email sent\n";
				//header('Location: index.php');
				exit;
			}
			else
				echo "email failed to send\n";
		}			
	}
	$conn = null;
?>


<!doctype html>
<html lang="en">
  <head>
    <title>forgot password</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" type="text/css" media="screen" href="../css/reset.css" />
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
                        RESET 
                        </a></p>
            </div>

			<div class="contain">
				<form  action="reset_pwd.php" method="post">
					<input type="password" placeholder="Password" name="pwd_new" required>
					<input type="password" placeholder="Re_type Password" name="psw_repeat" required>
					<input type="submit" name="signup" value="submit">
				</form>
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
	$token 			= $_SESSION['token'];
	$email 			= $_SESSION['email'];
	$passw_new		= htmlspecialchars($_POST['psw_new']);
	$passw_repeat	= htmlspecialchars($_POST['psw_repeat']);
	try
	{
		if (!isset($passw_new) || empty($passw_new) || !(strlen($passw_new) > 6) || (!preg_match('/(?=.*[a-z])(?=.*[0-9]).{6,}/i', $passw_new)) 
			|| (!isset($passw_repeat) || empty($passw_repeat) && !($passw_new === $passw_repeat)))
			{
				echo "! Password input is invalid<br>";
				if (!(strlen($passw_new) > 6))
				{
					echo "! Password length is too short, must be atleast 6 characters long<br>";
				}
				if (!preg_match('/(?=.*[a-z])(?=.*[0-9]).{6,}/i', $passw_new))
				{
					echo "! Passowrd must contain letters and digits<br>";
				}
			}
		else if ((isset($passw_new) && !empty($passw_new) && (strlen($passw_new) > 6) && (preg_match('/(?=.*[a-z])(?=.*[0-9]).{6,}/i', $passw_new))) 
			&& (isset($passw_repeat) && !empty($passw_repeat) && ($passw_new === $passw_repeat)))
		{
			$conn = new PDO("$DB_DNS;dbname=$DB_NAME", $DB_USER, $DB_PASSWORD);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			$sql = "USE ".$DB_NAME;		
			$conn->exec($sql);
			$stmt = $conn->prepare("SELECT email = :email AND token = :token FROM users");
			$stmt->bindParam(':email', $email);
			$stmt->bindParam(':token', $token);
			$stmt->execute();
			$user = $stmt->fetch();
			if (!$user)
				die('Could not access credentials through database!');
			else
			{
			
				$stmt = $conn->prepare("UPDATE users SET password = :password_new");
				$passw_new = password_hash($passw_new, PASSWORD_BCRYPT);
				$stmt->bindParam(':password_new', $passw_new);
				$stmt->execute();
				
				session_unset($_SESSION['token']);
        session_unset($_SESSION['email']);
        
        echo "<script>alert('password updated');</script>";
				header('Location: signin.php');
				exit;		
			}
		 }
		else 
			die('Something went wrong...');
	}
	catch(PDOException $e)
	{
		echo $stmt . "<br>" . $e->getMessage();
	}
	$conn = null;
?>
<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//  print_r($_SESSION);
include '../config/database.php';

	try
	{
		var_dump($_SESSION);
		if (isset($_SESSION['loggedin']) === true)
		{
			$usersi	= $_SESSION['username'];
			$mail	= $_SESSION['email'];
		}
		else
            die ('no session variables have been set');
        if (!empty($_POST['username']) || !empty($_POST['email']))
        {
            $email   = trim(htmlspecialchars($_POST['email']));
           
	     if (isset($email) && !empty($email))
			{
				$con = new PDO("mysql:host=$DB_DNS;dbname=$DB_NAME", $DB_USER, $DB_PASSWORD);
			    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
				$sql = "USE ".$DB_NAME;	
				
					$stmt = $con->prepare("SELECT * FROM users WHERE email=:email");
                    $stmt->bindValue(':email', $mail);
                    //$stmt->bindValue(':email', $email);
					$stmt->execute();
					$mailfetch = $stmt->fetch();
					var_dump($email);
					if (!$mailfetch)
						die('change failed.');
					else
					{
                        $stmt = $con->prepare("UPDATE users SET email = :email WHERE email = :mail");
                        /*SET email = :email WHERE email = :email
                        SET pwd = :pwd WHERE pwd = :pwd");*/
                        $stmt->bindValue(':mail', $mail);
						$stmt->bindValue(':email', $email);
                        //$stmt->bindValue(':email', $email);
                        //$stmt->bindValue(':pwd', $pwd);
						$stmt->execute();
						
						echo "email changed\n";
						// $_SESSION['username'] = $username;
						 $_SESSION['email'] = $email;
						exit;
				}
			}

			else
				die('Something went wrong...');
    }
}
	catch(PDOException $e)
	{
		echo $stmt . "<br>" . $e->getMessage();
	}
	$conn = null;
?>


<!doctype html>
<html lang="en">
	<head>
		<title>modify account</title>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link rel="stylesheet" type="text/css" media="screen" href="http://localhost:8080/matcha/css/fame_ratings.css" />
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
				<form class="box2" action="modify_email.php" method="post">
						<h1>Modify Your Account</h1>
						<input type="email" placeholder="Emmail Adress" name="email" required>
						<!-- <input type="email" placeholder="Email Address" name="email" required>
						<input type="password" placeholder="Password" name="pwd" required>
						<input type="submit" name="signup" value="submit"> -->
    	</form>

		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	</body>
</html>
<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'config/database.php';

try
	{
		if (!empty($_POST['Username']) || !empty($_POST['Password'])) // this is checking if the fields are not empty
		{
			$Username = htmlspecialchars($_POST['Username']); // check for html script and converts to harmless string.
			$Password = htmlspecialchars($_POST['Password']);

		if (isset($_SESSION['loggedin']) == 1) // check if there is a variable called loggedin and see if it is = 1
		{
			header('Location: me.php'); // if it is 1 you are logged in
		}
		// Check for errors
		if (!isset($Username) || empty($Username))  // if username was not set or was left empty
		{
			echo "! Username input is invalid<br>"; //print out error
		}
		else if (!isset($Password) || empty($Password) || !(strlen($Password) > 6) || (!preg_match('/(?=.*[a-z])(?=.*[0-9]).{6,}/i', $Password))) //check if the password was empty , notset or of the length was too short or does not have all required characters 
		{
			echo "! Password input is invalid<br>";
			if (!(strlen($Password) > 6))
			{
				echo "! Password length is too short, must be atleast 6 characters long<br>"; // password too short
			}
			if (!preg_match('/(?=.*[a-z])(?=.*[0-9]).{6,}/i', $Password))
			{
				echo "! Password must contain letters and digits<br>"; // something is missing
			}
        }
        else if (isset($Username) && !empty($Username) && isset($Password) && !empty($Password)) // if username is set and the password is set  then lets connect
		{
            $con = new PDO("mysql:host=$DB_DNS;dbname=$DB_NAME", $DB_USER, $DB_PASSWORD); // connect ot DB
            // set the PDO error mode to exception
          $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $con->prepare("SELECT * FROM users WHERE Username = :Username");
          $stmt->bindParam(':Username', $Username);
          $stmt->execute();
          $result = $stmt->fetch();
          if (!$result)
				die('Could not access credentials through database!');
			else
			{
				if ($result['Active'])
				{
					$validpassword = password_verify($Password, $result['Password']);
					if ($validpassword)
					{
						// here we are creating session variables
						$_SESSION['user_id'] = $result['user_id'];
						$_SESSION['Username'] = $result['Username'];
						$_SESSION['loggedin'] = true;
						$_SESSION['logged_in'] = time();
						//$_SESSION['email_notify'] = $result['notifications'];
						// print_r($_SESSION);
						// die();
						header('Location: me.php?');
                        exit;

					}
					else
						die('Incorrect username / password combination!');
				}
				else
					die('You have not verified your account, check your email!');
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

<!DOCTYPE html>
<html lang="en">
<head>
                <title>Home Page</title>
                <!-- Required meta tags -->
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

                <!-- Bootstrap CSS -->
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
                <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
                <script src="https://unpkg.com/typewriter-effect/dist/core.js"></script>
                <link rel="stylesheet" type="text/css" media="screen" href="match.css" />
                <script src="myscripts.js"></script>
              </head>
<body>

                      <nav class="navbar navbar-expand-sm bg navbar fixed-top">
                            <a class="navbar-brand" href="#">
                                <img src="images/logo.png" width="100" height="100" class="d-inline-block align-top" alt="">
                            </a>
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item" style="margin-right:30px">
                                <a class="fas fa-home" href="index.php"> home</a>
                                </li>
                                <li class="nav-item" >
                                    <a class="fas fa-sign-out-alt" href="signup.php"> signup</a>
                                  </li>
                            </ul>
                    </nav>

                  <!-- sign in form -->

                    <div class="signin">
                      <form action="login.php" method="post">
                          <h2 style="color: white">login</h2>
                          <input type="text" name="Username" placeholder="Username">
                          <input type="password" name="Password" placeholder="Password">
                          <input type="submit" value="Log in"  style="margin-top:70px;"></br>
                      </br>
                      <div id="container">
                          <a href="#" style=" margin-right:0px; font-size:13px;
                          font-family: tahoma, Geneva, sans-serif;">Forgot Password</a>
                      </div></br></br>
                      Dont have account?<a href="signup.php">&nbsp;Sign Up</a>
                      </form>
                  </div>
</body>
</html>
<!doctype html>
<html lang="en">
  <head>
    <title>signin</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" media="screen" href="http://localhost:8080/matcha/css/signin.css" />
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
                    SIGN IN
                    </a></p>
        </div>
      
      <!-- signin form -->
        <form method="post" action="signin.php" class="form-signin" >
                    <img class="mb-4" src="{{ site.baseurl }}/docs/{{ site.docs_version }}/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
                    <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
                    <label for="inputEmail" class="sr-only">Username</label>
                    <input type="text"  name="username"  class="form-control" placeholder="username" required autofocus>
                    <label for="inputPassword" class="sr-only">Password</label>
                    <input type="password"  name="password" class="form-control" placeholder="Password" required>
        <!-- <div class="checkbox mb-3">
                <label>
                <input type="checkbox" value="remember-me"> Remember me
                </label>
        </div> -->
                
                <button class="r" type="submit">login</button>
                <hr/>
                <hr/>
            
                <a  id="p" href="forgot_pwd.php">forgot password?</a>

                <h3 class="mt-5 mb-3 text-muted">&copy; <i>psambo 2018</i></h3>
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

  include '../config/database.php';



  try {
      if (!empty($_POST['username']) || !empty($_POST['password'])) { // this is checking if the fields are not empty
        $username = htmlspecialchars($_POST['username']); // check for html script and converts to harmless string.
        $password = htmlspecialchars($_POST['password']);

          if (isset($_SESSION['loggedin']) == 1) { // check if there is a variable called loggedin and see if it is = 1
        header('Location: dashboard.php'); // if it is 1 you are logged in
          }
          // Check for errors
      if (!isset($username) || empty($username)) {  // if username was not set or was left empty
        echo '! username input is invalid<br>'; //print out error
      } elseif (!isset($password) || empty($password) || !(strlen($password) > 6) || (!preg_match('/(?=.*[a-z])(?=.*[0-9]).{6,}/i', $password))) { //check if the password was empty , notset or of the length was too short or does not have all required characters
        echo '! password input is invalid<br>';
          if (!(strlen($password) > 6)) {
              echo '! password length is too short, must be atleast 6 characters long<br>'; // password too short
          }
          if (!preg_match('/(?=.*[a-z])(?=.*[0-9]).{6,}/i', $password)) {
              echo '! Password must contain letters and digits<br>'; // something is missing
          }
      } elseif (isset($username) && !empty($username) && isset($password) && !empty($password)) { // if username is set and the password is set  then lets connect
              $con = new PDO("mysql:host=$DB_DNS;dbname=$DB_NAME", $DB_USER, $DB_PASSWORD); // connect ot DB
              // set the PDO error mode to exception
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $con->prepare('SELECT * FROM users WHERE username = :username');
          $stmt->bindParam(':username', $username);
          $stmt->execute();
          $result = $stmt->fetch();
          if (!$result) {
              die('Could not access credentials through database!');
          } else {
              if ($result['active']) {
                  $validpassword = password_verify($password, $result['password']);
                  if ($validpassword) {
                      // here we are creating session variables
                      $_SESSION['user_id'] = $result['user_id'];
                      $_SESSION['username'] = $result['username'];
                      $_SESSION['loggedin'] = true;
                      $_SESSION['logged_in'] = time();
                      $_SESSION['email']= $result['email'];

                      exit;
                  } else {
                      die('Incorrect username / password combination!');
                  }
              } else {
                  die('You have not verified your account, check your email!');
              }
          }
      } else {
          die('Something went wrong...');
      }
      }
  } catch (PDOException $e) {
      echo $stmt.'<br>'.$e->getMessage();
  }
      $con = null;

?>
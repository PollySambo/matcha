
<?php
    session_start();
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    //Get the unique user ID of the user that has just registered.
    include '../config/database.php';

    //Make sure that our query string parameters exist.
    if (isset($_GET['token']) && isset($_GET['email'])) {
        $token = trim($_GET['token']);
        $email = trim($_GET['email']);

        // print_r($_GET);

        $pdo = new PDO("mysql:host=$DB_DNS;dbname=$DB_NAME", $DB_USER, $DB_PASSWORD);
        // // set the PDO error mode to exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email AND token = :token');
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':token', $token);

        $stmt->execute();
        $result = $stmt->fetch();
        if ($result) {
            // print_r($result);

            $active = 1;

            $sql = "UPDATE users SET active = 1 WHERE email = '$email'";
            $stmt = $pdo->prepare($sql);
            // die($sql);
            $stmt->execute();

            header('location: signin.php');
        } else {
            //Token is not valid.
            echo 'Check your emails?.';
        }
        $pdo = null;
    }
?>
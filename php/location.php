<?php
    session_start();
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
  
    include '../config/database.php';

// var_dump($_POST['longitude']);
// var_dump($_POST['latitude']);

    // if (isset($_POST['longitude']) && isset($_POST['latitude']))
    // {
    //     echo "<p>my name is not" + $_POST['longitude']. + $_POST['latitude']."</p>";
    // }

    try {
        

            if (isset($_POST['longitude']) && isset($_POST['latitude']))
            {
                // echo "<p>my name is not" . $_POST['longitude'] . ' ' . $_POST['latitude']."</p>";
                // die();
                

                $con = new PDO("mysql:host=$DB_DNS;dbname=$DB_NAME", $DB_USER, $DB_PASSWORD, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

                $user = $_SESSION['username'];
                $user_id = $_SESSION['user_id'];

                $sql = 'INSERT INTO `location` ( `user_id`, `user`, `longitude`, `latitude`)
                    VALUES (:user_id, :user, :longitude, :latitude)';
                $stmt = $con->prepare($sql);
                $stmt->bindParam(':user_id', $user_id);
                $stmt->bindParam(':user', $user);
                $stmt->bindParam(':longitude', $_POST['longitude']);
                $stmt->bindParam(':latitude', $_POST['latitude']);
                $stmt->execute();
            }  
    } catch (PDOException $e) {
        die($e->getMessage());
    }

?>
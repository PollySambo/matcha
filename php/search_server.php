<?php
session_start();
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../config/database.php';

// print_r($_SESSION);
if (isset($_POST['Username']))
{

    try{
    $con = new PDO("mysql:host=$DB_DNS;dbname=$DB_NAME", $DB_USER, $DB_PASSWORD, [PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING]);
    
    
            // get the name that is being searched for 
            $Username = $_POST['Username'];
            //  ? trim($_POST['Username']) : '';
            // var_dump($Username);
            // die();
    
    
             // the simple sql query that i will be running
                $stmt = $con->prepare("SELECT * FROM users WHERE `Username` LIKE :Username");
                $stmt->bindValue(':Username', $Username);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            // add % for wildcard search
                // $Username = "%$Username%"

            // echo the $res array in a JSON formatas that we can 
            // easily handle the results with the javascript / jQuerry
            if (!$result)
                echo "no results";
            else
                echo json_encode($result);
    }
    catch(PDOException $e)
        {
            echo $stmt . "<br>" . $e->getMessage();
        }
}
?>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    require_once 'database.php';

try {
    $conn = new PDO("mysql:host=$DB_DNS", $DB_USER, $DB_PASSWORD);
    // now set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // create your desired database
    $sql = "CREATE DATABASE IF NOT EXISTS matcha";
    // user exec() because no results are returned
    $conn->exec($sql);
    echo "Database matcha created successfully<br>";
    }
catch(PDOException $e)
    {
        echo $sql . "<br>" . $e->getMessage();
    }
    $conn = null;


//now we create another connection to create a table to store the users info
try {
    $conn = new PDO("mysql:host=$DB_DNS;dbname=$DB_NAME", $DB_USER, $DB_PASSWORD);
        // now set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //create the table users
    $sql = "CREATE TABLE IF NOT EXISTS users
    (
        user_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
        Name VARCHAR(255) NOT NULL,
        Surname VARCHAR(255) NOT NULL,
        Username VARCHAR(255) NOT NULL,
        Email VARCHAR(255) NOT NULL,
        Password VARCHAR(255) NOT NULL,
        Token VARCHAR(255) NOT NULL,
        Active BOOLEAN NOT NULL,
        Notifications BOOLEAN NOT NULL
    )";

     // user exec() because no results are returned
     $conn->exec($sql);
     echo "Table users created successfully<br>";
    }

catch(PDOException $e)
{
    echo $sql . "<br>" . $e->getMessage();
}
 $conn = null;

?>
<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

        require_once 'database.php';

                // database
        try {
            $con = new PDO("mysql:host=$DB_DNS", $DB_USER, $DB_PASSWORD);
            // now set the PDO error mode to exception
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // create your desired database
            $sql = "CREATE DATABASE IF NOT EXISTS matcha";
            // user exec() because no results are returned
            $con->exec($sql);
            echo "Database matcha created successfully<br>";
            }
        catch(PDOException $e)
            {
                echo $sql . "<br>" . $e->getMessage();
            }
            $con = null;


            // table for users

            try {
                $con = new PDO("mysql:host=$DB_DNS;dbname=$DB_NAME", $DB_USER, $DB_PASSWORD);
                    // now set the PDO error mode to exception
                $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    //create the table users
                $sql = "CREATE TABLE IF NOT EXISTS users
                (
                    `user_id` INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
                    `name` VARCHAR(255) NOT NULL,
                    `email` VARCHAR(255) NOT NULL,
                    `username` VARCHAR(255) NOT NULL,
                    `password` VARCHAR(255) NOT NULL,
                    `token` VARCHAR(255) NOT NULL,
                    `active` BOOLEAN NOT NULL,
                    `notifications` BOOLEAN NOT NULL,
                    `block` BOOLEAN NOT NULL
                )";
            
                 $con->exec($sql);
                 echo "Table users created successfully<br>";
                }
            
            catch(PDOException $e)
            {
                echo $sql . "<br>" . $e->getMessage();
            }
             $con = null;


            // table for hobbies 

            try {
                $con = new PDO("mysql:host=$DB_DNS;dbname=$DB_NAME", $DB_USER, $DB_PASSWORD);
                    // now set the PDO error mode to exception
                $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    //create the table users
                $sql = "CREATE TABLE IF NOT EXISTS hobby
                (
                    `hobby_id` INT(100) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
                    `user_id` INT(6) UNSIGNED,
                    `user` VARCHAR(255) NOT NULL,
                    `path` VARCHAR(255) NOT NULL, 
                    `age` INT(80) NOT NULL,
                    `gender` VARCHAR(255) NOT NULL,
                    `preference` VARCHAR(255) NOT NULL,
                    `bio` VARCHAR(255) NOT NULL,
                    FOREIGN KEY (user_id) REFERENCES users(user_id)
            
                )";
            
                 // user exec() because no results are returned
                 $con->exec($sql);
                 echo "Table hobby created successfully<br>";
                }
            
            catch(PDOException $e)
            {
                echo $sql . "<br>" . $e->getMessage();
            }
             $con = null;
             
             
             //this is the table for the four pictures

            try {
                $con = new PDO("mysql:host=$DB_DNS;dbname=$DB_NAME", $DB_USER, $DB_PASSWORD);
                    // now set the PDO error mode to exception
                $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    //create the table users
                $sql = "CREATE TABLE IF NOT EXISTS four
                (
                    `image_id` INT(100) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
                    `user_id` INT(6) UNSIGNED,
                    `user` VARCHAR(255) NOT NULL,
                    `name` VARCHAR(255) NOT NULL,
                    `image` longblob NOT NULL,
                    FOREIGN KEY (user_id) REFERENCES users(user_id)

                )";

                // user exec() because no results are returned
                $con->exec($sql);
                echo "Table four created successfully<br>";
                }

            catch(PDOException $e)
            {
                echo $sql . "<br>" . $e->getMessage();
            }
            $con = null;



             //this is the table for geo-location

             try {
                $con = new PDO("mysql:host=$DB_DNS;dbname=$DB_NAME", $DB_USER, $DB_PASSWORD);
                    // now set the PDO error mode to exception
                $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    //create the table users
                $sql = "CREATE TABLE IF NOT EXISTS location
                (
                    `location_id` INT(100) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
                    `user_id` INT(6) UNSIGNED,
                    `user` VARCHAR(255) NOT NULL,
                    `longitude` VARCHAR(255) NOT NULL,
                    `latitude` VARCHAR(255) NOT NULL,
                    FOREIGN KEY (user_id) REFERENCES users(user_id)

                )";

                    // user exec() because no results are returned
                $con->exec($sql);
                echo "Table location created successfully<br>";
                }

            catch(PDOException $e)
            {
                echo $sql . "<br>" . $e->getMessage();
            }
            $con = null;


                    // table for likes
            try {
                $conn = new PDO("mysql:host=$DB_DNS;dbname=$DB_NAME", $DB_USER, $DB_PASSWORD);
                // set the PDO error mode to exception
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                // sql to create table
                $sql = "CREATE TABLE IF NOT EXISTS likes (
                `like_id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
                `image_id` INT(11),
                `user` varchar(200),
                `image` INT(11)
                   )";
                // use exec() because no results are returned
                $conn->exec($sql);
                echo "Table likes created successfully<br>";
                }
            catch(PDOException $e)
                {
                echo $sql . "<br>" . $e->getMessage();
                }
                $con = null;
                
                
                // table for fame ratings
                try {
                    $conn = new PDO("mysql:host=$DB_DNS;dbname=$DB_NAME", $DB_USER, $DB_PASSWORD);
                    // set the PDO error mode to exception
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                    // sql to create table
                    $sql = "CREATE TABLE IF NOT EXISTS images (
                    `image_id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
                    `image`VARCHAR(200) NOT NULL,
                    `user` VARCHAR(255) NOT NULL,
                    `text` TEXT(30) NOT NULL
                    )";
                
                    // use exec() because no results are returned
                    $conn->exec($sql);
                    echo "Table images created successfully<br>";
                    }
                catch(PDOException $e)
                    {
                    echo $sql . "<br>" . $e->getMessage();
                    }
                
                $conn = null;

                // comments table
                try {
                    $conn = new PDO("mysql:host=$DB_DNS;dbname=$DB_NAME", $DB_USER, $DB_PASSWORD);
                    // set the PDO error mode to exception
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                    // sql to create table
                    $sql = "CREATE TABLE IF NOT EXISTS comments (
                    `comment_id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
                    `Username` VARCHAR(255) NOT NULL,
                    `comment` TEXT NOT NULL,
                    `image_id` INT(255) NOT NULL,
                    `date_added` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL	
                       )";
                
                    // use exec() because no results are returned
                    $conn->exec($sql);
                    echo "Table comments created successfully";
                    }
                catch(PDOException $e)
                    {
                    echo $sql . "<br>" . $e->getMessage();
                    }
                
                $conn = null;
?>
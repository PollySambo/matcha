<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'config/database.php';
include_once 'functions.php';

print_r($_SESSION);

if (isset($_POST['submit']))
{
    $Username = $_SESSION['Username'];
    $target_path="profiles/";
    $target_path=$target_path.basename($_FILES['uploadedfile']['name']);
    $uploadOk = 1;
   

    // Check file size
        if ($_FILES["uploadedfile"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

    // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";

        //this is where we move the file to the desired destination and
        //also connect to the database and also put the image to the database
    if (move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path))
    {
        try {
            $con = new PDO("mysql:host=$DB_DNS;dbname=$DB_NAME", $DB_USER, $DB_PASSWORD, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

                    $sql = "INSERT INTO `pro_pic` ( `path`, `user`)
                    VALUES ('".$target_path."', '".$Username."')";
                    $stmt = $con->prepare($sql);
                    $stmt->execute();



            }

        catch(PDOException $e)
        {
            die($e->getMessage());
        }
        $uploadOk = 1;
    }
    else
    {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    }
}

?>



<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <link rel="stylesheet" type="text/css" media="screen" href="me.css" />
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  </head>
  <body>

        <!-- this is where the the header will be -->
        <!-- <div class="o-wall">
						<div class="o-wall__claim">
							<div class="o-wall__letters-list">
							<b class="o-wall__letters-list--letter">
								C
							</b>
							<b class="o-wall__letters-list--letter">
								H
							</b>
							<b class="o-wall__letters-list--letter">
								O
							</b>
							<b class="o-wall__letters-list--letter">
								O
							</b>
							<b class="o-wall__letters-list--letter">
								S
                            </b>

                            <b class="o-wall__letters-list--letter">
								  **
							</b>


							<b class="o-wall__letters-list--letter">
								A
                            </b>

                            <b class="o-wall__letters-list--letter">
								  **
                            </b>

                            <b class="o-wall__letters-list--letter">
								P
							</b>
							<b class="o-wall__letters-list--letter">
								R
							</b>
							<b class="o-wall__letters-list--letter">
								O
							</b>
							<b class="o-wall__letters-list--letter">
								F
							</b>
							<b class="o-wall__letters-list--letter">
								I
							</b>
							<b class="o-wall__letters-list--letter">
								L
                            </b>
                            <b class="o-wall__letters-list--letter">
								E
							</b>
						</div>
							<div class="o-wall__letters-list">
							<b class="o-wall__letters-list--letter">
								P
                            </b>
                            <b class="o-wall__letters-list--letter">
								I
                            </b>
                            <b class="o-wall__letters-list--letter">
								C
                            </b>
                            <b class="o-wall__letters-list--letter">
								T
                            </b>
                            <b class="o-wall__letters-list--letter">
								U
                            </b>
                            <b class="o-wall__letters-list--letter">
								R
                            </b>
                            <b class="o-wall__letters-list--letter">
								E
							</b>

							</div>

						</div>
			</div> -->


            <!-- form for the image -->
        <form method="post" action="me.php" enctype="multipart/form-data">
                <input type="hidden" name="MAX_FILE_SIZE" value="1000000"/>
                <input type="submit" value="submit" name="submit">
                <input name="uploadedfile" type="file" style="height:35px;" />
        </form>


  </body>
</html>
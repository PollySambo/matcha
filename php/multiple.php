<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../config/database.php';
// require_once 'funcions.php';

print_r($_SESSION);

try {
    $con = new PDO("mysql:host=$DB_DNS;dbname=$DB_NAME", $DB_USER, $DB_PASSWORD, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

    if (isset($_POST["submit"]))
    {
            $filename = $_FILES['img']['name'];
            $tmpname = $_FILES['img']['tmp_name'];
            $filetype = $_FILES['img']['type'];
            $username = $_SESSION['username'];
            $user_id = $_SESSION['user_id'];

            for($i=0; $i<=count($tmpname)-1; $i++)
            {
                $name = addslashes($filename[$i]);
                $tmp = addslashes(file_get_contents($tmpname[$i]));
               

                $sql = "INSERT INTO four (`user_id` ,`name`, `image`, `user`)
                VALUES ('".$user_id."', '".$name."', '".$tmp."', '".$username."')";
                $stmt = $con->prepare($sql);
                $stmt->execute();
                header('profile.php');

                

            }
    }
}

    catch(PDOException $e)
    {
        die($e->getMessage());
    }


                $result =  $sth = $con->query("SELECT * FROM four ");

                while ($row =  $sth->fetch(PDO::FETCH_ASSOC))
                {
                    $display = $row['image'];


                            echo '
                            <div class="wrapper">
                                <img src="data:image/jpeg;base64,'.base64_encode($display).'" class="image--cover  width="250 height="250"/>

                            </div>
                            ';
            // <!-- <div class="wrapper">

            // <img src="data:image/jpeg;base64,'.base64_encode($display).'" class="image--cover">
            
            // <img src="http://imgc.allpostersimages.com/images/P-473-488-90/68/6896/2GOJ100Z/posters/despicable-me-2-minions-movie-poster.jpg" alt="" class="image--cover" />
            
            // <img src="http://static.eharmony.com/blog/wp-content/uploads/2010/04/eHarmony-Blog-profile-picture.jpg" alt="" class="image--cover" />
            
            // <img src="https://i2.cdn.turner.com/cnnnext/dam/assets/140926165711-john-sutter-profile-image-large-169.jpg" alt="" class="image--cover" />
            // </div> -->
                }

?>




<html>
    <head>
        <title>multiple</title>
    </head>

<body>

    <form action="multiple.php" method="post" enctype="multipart/form-data">
        <input type="file" name="img[]" multiple="multiple"  />
        <input name="submit" type="submit" />
    </form>

</body>
</html>
<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'config/database.php';
// require_once 'funcions.php';

print_r($_SESSION);

try {
    $con = new PDO("mysql:host=$DB_DNS;dbname=$DB_NAME", $DB_USER, $DB_PASSWORD, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

    if (isset($_POST["submit"]))
    {
            $filename = $_FILES['img']['name'];
            $tmpname = $_FILES['img']['tmp_name'];
            $filetype = $_FILES['img']['type'];
            $Username = $_SESSION['Username'];

            for($i=0; $i<=count($tmpname)-1; $i++)
            {
                $name = addslashes($filename[$i]);
                $tmp = addslashes(file_get_contents($tmpname[$i]));
                // echo $tmp;

                $sql = "INSERT INTO multiple ( `name`, `image`, `user`)
                VALUES ('".$name."', '".$tmp."', '".$Username."')";
                $stmt = $con->prepare($sql);
                $stmt->execute();

                // header('location:profile.php');

            }
    }
}

    catch(PDOException $e)
    {
        die($e->getMessage());
    }


                $result =  $sth = $con->query("SELECT * FROM multiple");

                while ($row =  $sth->fetch(PDO::FETCH_ASSOC))
                {
                    $display = $row['image'];

                    echo '<img src="data:image/jpeg;base64,'.base64_encode($display).'"  width="250 height="250" />';
                }

?>




<html>
    <head>
        <title>multiple</title>
    </head>

<body>

    <form action="#" method="post" enctype="multipart/form-data">
        <input type="file" name="img[]" multiple="multiple"  />
        <input name="submit" type="submit" />
    </form>

</body>
</html>
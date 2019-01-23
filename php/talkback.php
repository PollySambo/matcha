<?php
print_r($_POST);
// var_dump($_POST['longitude']);
// var_dump($_POST['latitude']);

    if (isset($_POST['longitude']) && isset($_POST['latitude']))
    {
        echo "<p>my name is not" + $_POST['longitude']. + $_POST['latitude']."</p>";
    }

    
    // print_r($_SESSION['myname'])    ?>
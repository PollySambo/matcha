<?php
    session_start();
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
  
    // print_r($_SESSION);
    include '../config/database.php';


    try {
            $user_id = $_SESSION['user_id'];
            $username = $_SESSION['username'];
            if (isset($_POST['longitude']) && isset($_POST['latitude']))
            {
            
                $con = new PDO("mysql:host=$DB_DNS;dbname=$DB_NAME", $DB_USER, $DB_PASSWORD, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

                $sql = 'INSERT INTO `location` ( `user_id`, `user`, `longitude`, `latitude`)
                    VALUES (:user_id, :username, :longitude, :latitude)';
                $stmt = $con->prepare($sql);
                $stmt->bindParam(':user_id', $user_id);
                $stmt->bindParam(':user', $username);
                $stmt->bindParam(':longitude', $_POST['longitude']);
                $stmt->bindParam(':latitude', $_POST['latitude']);
                $stmt->execute();
            }  
    } catch (PDOException $e) {
        die($e->getMessage());
    }

?>

<!doctype html>
<html lang="en">
  <head>
    <title>location map</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link rel="stylesheet" type="text/css" media="screen" href="../css/location.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  </head>
  
  <body style="background-color: #222222; background: repeating-linear-gradient(45deg, #2b2b2b 0%, #2b2b2b 10%, #222222 0%, #222222 50%) 0 / 15px 15px;" >

<!-- navbar -->
<nav style=" background-color: transparent;" class="navbar navbar-light bg-light">
 <ul class="navbar-nav px-3">
   <li class="nav-item text-nowrap">
     <a   class="fas fa-power-off" class="nav-link" href="sign_out.php"> Sign out</a>
   </li>
</ul>
</nav>

   <div id="container">
               <p><a href="https://en.wikipedia.org/wiki/Orange">
               LOCATION.
               </a></p>
   </div>

   <!-- map -->
   <div id="mapid"></div>
   <a  id="p" href="profile.php">profile</a>
   <a  id="p" href="fame_ratings.php">like or comment
					</a>
					<a  id="p" href="suggestions.php">see suggestions</a>
                    <a  id="p" href="modify_username">change username</a>
                    <a  id="p" href="modify_email.php">change email</a>
                    <a  id="p" href="fame_ratings.php">fame</a>


    <!-- Optional JavaScript -->
    <script src="https://d3js.org/d3.v3.min.js"></script>
    <script src="https://d3js.org/topojson.v0.min.js"></script>
	<link rel="stylesheet" href="https://npmcdn.com/leaflet@1.0.0-rc.2/dist/leaflet.css" />
	 <script src="https://npmcdn.com/leaflet@1.0.0-rc.2/dist/leaflet.js"></script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <script>
            navigator.geolocation.getCurrentPosition(function(location) {
            var latlng = new L.LatLng(location.coords.latitude, location.coords.longitude);

                     var req = new XMLHttpRequest();
                    req.onreadystatechange = function() {
                        if (req.readyState == 4 && req.status == 200)
                        {
                            alert("i have received this text" + req.responseText);
                        }
                    };

            var mymap = L.map('mapid').setView(latlng, 13)
            L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
                attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://mapbox.com">Mapbox</a>',
                maxZoom: 18,
                id: 'mapbox.streets',
                accessToken: 'pk.eyJ1IjoiYmJyb29rMTU0IiwiYSI6ImNpcXN3dnJrdDAwMGNmd250bjhvZXpnbWsifQ.Nf9Zkfchos577IanoKMoYQ'
            }).addTo(mymap);

            var marker = L.marker(latlng).addTo(mymap);

                    req.open("post", "http://localhost:8080/matcha/php/location.php", true);
                    req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    req.send("longitude="+location.coords.longitude + "&" + "latitude="+location.coords.latitude);

            });
    </script>
  </body>
</html>
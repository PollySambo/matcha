<!doctype html>
<html lang="en">
  <head>
  <link rel="stylesheet" type="text/css" media="screen" href="../css/search.css" />
     
    <title>search</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  </head>
  <body>

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
            SEARCH
            </a></p>
      </div>


        <div class="profile center ">
          <form action ="search.php" method= "POST">
                <input id="user_info" style="text-align: center;" type="text" name="search_box" placeholder= "search via tag "/>
                <label for="sort"> Sort by:</label>
                <br>

                <div class="form-group">
                  <label for="gender1" class="col-sm-2 control-label">With Bootstrap:</label>
                    <div class="col-sm-2">
                      <select class="form-control" id="gender1">
                            <option>Male</option>
                            <option>Female</option>
                          </select>          
                        </div>
                    </div>  
                  </select>
                <br>
                <button id="search_button" class="r" type="submit" value= "search" name="search">Search</button>
                <div id="search_results" style="padding:5px;"></div>
          </form>
        </div>

        <!-- output -->
         <!-- JQuery library -->
         <script
            src="https://code.jquery.com/jquery-3.3.1.js"
            integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
            crossorigin="anonymous">
          </script>
<script>

  document.getElementById("search_button").addEventListener("click", function(event)
  {
  event.preventDefault()
});
    //Add a JQuery click listener to our search button.
    $('#search_button').click(function(){
        //If the search button is clicked,
        //get the employee name that is being search for
        //from the search_box.
        var user_info = $('#searching').val();
 
        //Carry out a GET Ajax request using JQuery
        $.ajax({
            //The URL of the PHP file that searches MySQL.
            type: "POST",
            url: 'search_server.php',
            data: {
                Username: user_info
            },
            success: function(returnData){
                //Set the inner HTML of our search_results div to blank to
                //remove any previous search results.
                $('#search_results').html('');
                //Parse the JSON that we got back from search_box.php
                var results = JSON.parse(returnData);
               
                //Loop through our employee array and append their
                //names to our search results div.
                $.each(results, function(key, value){
                    //The name of the employee will be present
                    //in the "name" property.
                    $('#search_results').append(value. Username + '<br>');
                });
                //If no employees match the name that was searched for, display a
                //message saying that no results were found.
                if(results.length == 0){
                    $('#search_results').html('No employees with that name were found!');
                }
            }
        
    });
        // $.ajax({type: "POST", url: 'search.php', data: {
        //         Username: user_info
        //     },
        //     success: function(returnData){
        //         //Set the inner HTML of our search_results div to blank to
        //         //remove any previous search results.
        //         $('#search_results').html('');
        //         //Parse the JSON that we got back from search_box.php
        //         var results = JSON.parse(returnData);
               
        //         //Loop through our employee array and append their
        //         //names to our search results div.
        //         $.each(results, function(key, value){
        //           console.log(key);
        //           console.log(value);
        //             console.log(value. Username);
        //             //The name of the employee will be present
        //             //in the "name" property.
        //             $('#search_results').append(value. Username + '<br>');
        //         });
        //         //If no employees match the name that was searched for, display a
        //         //message saying that no results were found.
        //         if(results.length == 0){
        //           console.log("nada");
        //             $('#search_results').html('No employees with that name were found!');
        //         }
        //     }
        // });
    });
</script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>


<?php
  session_start();
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
 
  include '../config/database.php';
 
  if (isset($_POST['Username']))
  {
  
      try{
      $con = new PDO("mysql:host=$DB_DNS;dbname=$DB_NAME", $DB_USER, $DB_PASSWORD, [PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING]);
      
      
              // get the name that is being searched for 
              $Username = $_POST['Username'];
              // var_dump($Username);
              // die();
      
      
               // the simple sql query that i will be running
                  $stmt = $con->prepare("SELECT * FROM users, hobby WHERE `Username` LIKE :Username");
                 
                  $stmt->execute();
                  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
             
  
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
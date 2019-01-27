<!DOCTYPE html>
<html>
  <head>
    <title>Search Box</title>

    

   <link rel="stylesheet" type="text/css" media="screen" href="../css/search.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  </head>

   <body style="background-color: #222222; background: repeating-linear-gradient(45deg, #2b2b2b 0%, #2b2b2b 10%, #222222 0%, #222222 50%) 0 / 15px 15px;" >

 

  <nav class="navbar navbar-expand-sm bg navbar fixed-top">
                
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item" style="margin-right:30px">
                                <a class="fas fa-sign-out-alt" href="profile.php"> Profile</a>
                                </li>
                                <li class="nav-item">
                                <a class="fas fa-user-plus" href="fame_ratings.php"> Fame</a>
                                </li>
                            </ul>
    </nav>



   <div id="container">
               <p><a href="https://en.wikipedia.org/wiki/Orange">
               PROFILE.
               </a></p>
   </div>

    <div class="container h-100">
      <div class="d-flex justify-content-center h-100">
        <div class="searchbar">
          <input id="user_info" class="search_input" type="text" name="" placeholder="Search...">
          <a href="#"  id="search_button" class="search_icon"><i class="fas fa-search"></i></a>
           <!-- This div will contain a list of all .. names that match our search term -->
             <div id="search_results" style="padding:5px;"></div>
        </div>
      </div>
    </div>
    <a  id="p" href="fame_ratings.php">like or comment
					</a>
					<a  id="p" href="suggestions.php">see suggestions</a>
                    <a  id="p" href="modify_username">change username</a>
                    <a  id="p" href="modify_email.php">change email</a>
                    <a  id="p" href="location.html.php">location</a>
        <!-- JQuery library -->
        <script
            src="https://code.jquery.com/jquery-3.3.1.js"
            integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
            crossorigin="anonymous">
          </script>
<script>
    //Add a JQuery click listener to our search button.
    $('#search_button').click(function(){
        //If the search button is clicked,
        //get the employee name that is being search for
        //from the search_box.
        var user_info = $('#user_info').val().trim();
 
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
                console.log(returnData);
                //Loop through our employee array and append their
                //names to our search results div.
                $.each(results, function(key, object){
                    //The name of the employee will be present
                    //in the "name" property.
                    console.log(key);
                    console.log(object);
                    $('#search_results').append(object.email + object.user_id + object.username + '<br>');
                });
                //If no employees match the name that was searched for, display a
                //message saying that no results were found.
                if(results.length == 0){
                    $('#search_results').html('No employees with that name were found!');
                }
            }
        });
    });
</script>

  </body>
</html>

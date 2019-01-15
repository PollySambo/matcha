<<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>

<div class="split left">
              <div class="centered">
              <h1 style="text-transform: uppercase;">'.$Username.'</h1>

                  <img  style=" border-radius: 20%;" src="'.$row['path'].'"  width="250 height="250" />
                  <table>
                    <tr>
                      <td><img src="data:image/png;base64,' . $image[0]['image'] . '" /></td>
                      <td><img src="data:image/png;base64,' . $image[1]['image'] . '" /></td>
                      <td><img src="data:image/png;base64,' . $image[2]['image'] . '" /></td>
                      <td><img src="data:image/png;base64,' . $image[3]['image'] . '" /></td>
                    </tr>                  
                  </table>
                  <p><b>Name : '.$row['Name'].'</b></p>
                  <p><b>Surname : '.$row['Surname'].'</b></p>
                  <p><b>Gender : '.$row['gender'].'</b></p>
                  <p><b>Interest : '.$row['preference'].'</b></p>
                  <p><b>Age : 20</b></p>
                  
  
              </div>
          </div>


        <div class="split right">
            <div class="centered">
                <h1 style="text-transform: uppercase;">'.$Username.'</h1>
                <img src="data:image/jpeg;base64,'.($row['path']).'"  width="250 height="250" />
                    <p><b>Age : 20</b></p>
                    <p><b>Gender : Female</b></p>
                    <p><b>Interest : Women</b></p>
                    <p>Bio: some text</p>
                </div>
          </div>
        </div> ';
    
</body>
</html>



 $Username = $_SESSION['Username'];


$stmt = $con->query("SELECT * FROM users,pro_pic");
while ($row =  $stmt->fetch(PDO::FETCH_ASSOC)){
// $stmt->execute();

// TABLE - you need an user_id , a image id and the actual image
// $stmt = $con->prepare("SELECT * FROM multiple WHERE user_id=:user_id LIMIT " . $page_first_result . "," .  $results_per_page);
// $stmt->bindValue(':user_id', $user_id);
// $stmt->execute();
// $image = $stmt->fetchAll(); // here I am storing all the images for that user id in a variable called $image
// Images per page

echo ' 
        <div class="centered">
        <h1 style="text-transform: uppercase;">'.$Username.'</h1>

            <img  style=" border-radius: 20%;" src="'.$row['path'].'"  width="250 height="250" />
            <table>
              <tr>
                <td><img src="data:image/png;base64,' . $image[0]['image'] . '" /></td>
                <td><img src="data:image/png;base64,' . $image[1]['image'] . '" /></td>
                <td><img src="data:image/png;base64,' . $image[2]['image'] . '" /></td>
                <td><img src="data:image/png;base64,' . $image[3]['image'] . '" /></td>
              </tr>                  
            </table>
            
            <p><b>Name : '.$row['Name'].'</b></p>
            <p><b>Surname : '.$row['Surname'].'</b></p>
            <p><b>Gender : '.$row['gender'].'</b></p>
            <p><b>Interest : '.$row['preference'].'</b></p>
            <p><b>Age : 20</b></p>
            

        </div>
     ';
}
}
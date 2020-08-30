<?php
// session_start();
// print_r($_SESSION);
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

require_once '../config/database.php';
            $con = new PDO("mysql:host=$DB_DNS;dbname=$DB_NAME", $DB_USER, $DB_PASSWORD); // connect ot DB
              // set the PDO error mode to exception
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  

$stmt = $con->query("
                    SELECT
                    images.image_id,
					images.image,
					text,
                    COUNT(likes.like_id) AS likes,
                    GROUP_CONCAT(users.Username SEPARATOR '|') AS liked_by
                    
                    FROM images

                    LEFT JOIN likes
                    ON images.image_id = likes.image_id

                    LEFT JOIN users
                    ON likes.user = users.Username

                    GROUP BY images.image_id
                    ");
$stmt->execute();
    
while($result = $stmt->fetch(PDO::FETCH_ASSOC))
{
    $result['liked_by'] = $result['liked_by'] ? explode('|', $result['liked_by'] ) : [];
    $img[] = $result;
}

// echo '<pre>'; print_r($img);echo '</pre>';

?>

<?php
session_start();
print_r($_SESSION);

try{
	          $con = new PDO("mysql:host=$DB_DNS;dbname=$DB_NAME", $DB_USER, $DB_PASSWORD); // connect ot DB
              // set the PDO error mode to exception
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
	// Initialize message variable
	$msg = "";
  
	// If upload button is clicked ...
	if (isset($_POST['upload'])) {
		// Get image name
		$image = $_FILES['image']['name'];
		// Get text
	$image_text = $_POST['image_text'];
  
		// image file directory
		$target = "../pictures/".basename($image);
		echo $username = $_SESSION['Username'];
  
		$sql = "INSERT INTO images (image, user, text) 
		  VALUES ('".$image."', '".$username."', '".$image_text."')";
		  $stmt = $con->prepare($sql);
		  $stmt->execute();
		// execute query
  
		if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
			$msg = "Image uploaded successfully";
		}else{
			$msg = "Failed to upload image";
		}
	}
	$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	  $stmt = $con->prepare("SELECT * FROM images");
	  $stmt->bindParam(':images', $images);
	  $stmt->execute();
	  $result = $stmt->fetch();
	//$result = mysqli_query($con, "SELECT * FROM images");
  }
  catch(PDOException $e)
  {
	  echo "connection failed: " . $e->getMessage();
  }

?>


<!DOCTYPE html>
<html>
<head>
    <title>Image Upload</title>
    <link rel="stylesheet" type="text/css" media="screen" href="../css/fame.css" />
</head>
<!-- <body>> -->
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
                        FAME.
                        </a></p>
            </div>
	
		<div id="content">

	<?php foreach ($img as $pic):?>
		  <div class="pic">
			  <div id='img_div'>
				<img src='../images/<?=$pic['image'];?>' width="250px" height="250px" >
				<h3><?=$pic['text'];?></h3>
		  	</div>
				<a href="like.php?type=image&image_id=<?php echo $pic['image_id']; ?>">LIKE</a>
				<h3><?php echo $pic['likes']; ?> people liked this.</h3>
				
                <?php if(!empty($pic['liked_by'])): ?>
                <ul>
                    <?php foreach($pic['liked_by'] as $_SESSION['Username']): ?>
                    <li><?php echo $_SESSION['Username'] ?></li>
                    <?php endforeach; ?>
                </ul>
				<?php endif; ?>
				<form action="gallery_comments.php" id="commentform" method="GET">
					<input type= "hidden" value="<?php echo $pic['image_id']; ?>" name="image_id">
					<textarea type="text" name="commet_txt"></textarea>
					<input type="submit">
				</form>
				<?php
					$id = $pic['image_id'];
					$stmt = $con->prepare("SELECT * FROM comments WHERE image_id=:image_id");
					$stmt->bindValue(':image_id', $id);
					$stmt->execute();
					$comments = $stmt->fetchAll();
					echo '<table><ul>';
					for ($j=0; $j < sizeof($comments); $j++) 
					{ 
						$comment = $comments[$j]['comment'];
						$comment_by = $comments[$j]['Username'];
					echo'
						<tr>
							<td><li>'
								. $comment_by . 
								' - </li><td>'
								. $comment . 
								'</td>' .
							'</td>
						</tr>
						';
					}
					echo '
					</ul></table>
					';
				?>

				
        </div>
	<?php endforeach; ?>
	
	<form method="POST" action="fame_ratings.php" enctype="multipart/form-data" >
  	<input type="hidden" name="size" value="1000000">
  	<div>
  	  <input type="file" name="image">
  	</div>
  	<div>
      <textarea 
      	id="text" 
      	cols="40" 
      	rows="4"
      	name="image_text" 
      	placeholder="Say something about this image..."></textarea>
  	</div>
  	<div>
  		<button type="submit" name="upload">POST</button>
  	</div>
  </form>

  <a  id="p" href="profile.php">profile</a>
   <a  id="p" href="fame_ratings.php">like or comment</a>
   <a  id="p" href="suggestions.php">see suggestions</a>
   <a  id="p" href="modify_username">change username</a>
   <a  id="p" href="modify_email.php">change email</a>
   <a  id="p" href="fame_ratings.php">fame</a>
   <a  id="p" href="blocked.php">blocked</a>

</body>
</html>
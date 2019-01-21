<!doctype html>
<html lang="en">
	<head>
		<title>heahh
		</title>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" type="text/css" media="screen" href="http://localhost:8080/matcha/css/suggest.css" />
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	</head>
	<body>
				
		<!-- <div class="profile-wrapper center">
				<div class="profile-body">
								<img src="http://images.equipboard.com/uploads/user/image/524/big_calvin-harris.jpg?v=1466072866" alt="" />
								<div class="profile-details">
												<h1>Calvin Harris</h1>
												<p class="description">Scottish DJ, record producer, singer</p>
												<p>view full profile</p>
								</div>
				</div>
				<hr/>
						<div class="clearfix"></div>
								<div class="actions">
										<button  name="like" class="primary">Like</button>
										<button  name="send_message" class="secondary">Send Message</button>
								</div>
		</div> -->


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

			try {
				$con = new PDO("mysql:host=$DB_DNS;dbname=$DB_NAME", $DB_USER, $DB_PASSWORD);
				// now set the PDO error mode to exception
				$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				// create your desired database
				$stmt = $con->prepare("SELECT * FROM users, hobby WHERE hobby.user_id = users.user_id");
				$stmt->execute();
				$results =  $stmt->fetchAll(PDO::FETCH_ASSOC);
				$this_many_arrays = $stmt->rowCount();
				// echo "<pre>";
				// var_dump($results);
				// echo "<pre>";
				// die();
				echo '
				<div class="profile-wrapper center">';
					foreach ($results as $result) {
								echo'
						<div class="profile-body">
										<img src="'.$result['path'].'" alt="" />
										<div class="profile-details">
														<h1>'.$result['name'].'</h1>
														<p class="description">'.$result['bio'].'</p>
														<p>view full profile</p>
										</div>
						</div>
						<hr/>
								<div class="clearfix"></div>
										<div class="actions">
												<button  name="like" class="primary">Like</button>
												<button  name="send_message" class="secondary">Block</button>
										</div>
						';
					}
					echo '</div>';

				}
			catch(PDOException $e)
			{
					die($e->getMessage());
			} 




?>
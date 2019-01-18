<!doctype html>
<html lang="en">
  <head>
    <title>modify_account</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  </head>
  <body>
      
      <!-- MOD PREFEREVCES -->

		<div id="prefs" class="modal_pref page_popup">
			<div class="modal_container">
				<h1>Modify Account</h1>
				<p>Make changes to your account</p>
				<hr>
					<div class="pref_buttons">
						<!-- <a class="right" onclick="document.getElementById('prefs').style.display='block'" >preferences</a> -->
						<a onclick="document.getElementById('users_mod').style.display='block'; document.getElementById('prefs').style.display='none'" >
							<button>Username</button>
						</a>
						<a onclick="document.getElementById('email_mod').style.display='block'; document.getElementById('prefs').style.display='none'" >
							<button>Email</button>
						</a>
						<a onclick="document.getElementById('psw_mod').style.display='block'; document.getElementById('prefs').style.display='none'" >
							<button>Password</button>
						</a>
						<a onclick="document.getElementById('not_mod').style.display='block'; document.getElementById('prefs').style.display='none'" >
							<button onclick="triggernot(this)">Notifications</button>
						</a>
					</div>
				<hr>
				</div>
			</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
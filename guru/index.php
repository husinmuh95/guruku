<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
include_once 'includes/register.inc.php';

sec_session_start();

if(login_check($mysqli) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>GURUKU | Secure Login</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script type="text/JavaScript" src="js/sha512.js"></script>
	<script type="text/JavaScript" src="js/forms.js"></script>
	
	<style>
		.container {
			max-width: 500px;
			margin: auto;
		}
		h1, h3 {
			text-align: center;
		}
		.btn {
			padding: 14px 20px;
			width: 100%;
			margin: 8px 0;
			border: none;
			cursor: pointer;
		}
	</style>
</head>
<body>
	<?php if(isset($_GET['error'])) : ?>
		<script>
			alert("Login gagal");
		</script>
	<?php endif; ?>
	
	<div class="container">
		<h1><strong>GURUKU</strong></h1>
		<h3>Sistem Login For Teacher</h3>
		<hr>
		<form class="form-horizontal" action="includes/process_login.php" method="post" name="login_form">
			<div class="form-group">
				<div class="row">
					<label class="control-label col-sm-2" for="email">Email</label>
					<div class="col-sm-10">
						<input class="form-control" type="text" name="email"/>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<label class="control-label col-sm-2" for="password">Password</label>
					<div class="col-sm-10">
						<input class="form-control" type="password" name="password" id="password"/>
					</div>
				</div>
			</div>
			<input class="btn btn-primary" type="button" value="Login" id="login" onclick="formhash(this.form, this.form.password);"/>
		</form>
		<hr>
		<?php 
			if(login_check($mysqli) == true) {
				echo '<p align="center">Currently logged ' . $logged . ' as ' . htmlentities($_SESSION['username']) . '.</p>';
				echo '<p align="center">Apakah Anda ingin mengubah user? <a href="includes/logout.php">Logout</a>.</p>';
			} else {
				echo '<p align="center">Currently logged ' . $logged . '</p>';
				echo '<p align="center">Jika Anda tidak memiliki identitas login, mohon <a href="register.php">mendaftar</a></p>';
			}
		?>
	</div>	
	
	<script>
		var input = document.getElementById("password");
		input.addEventListener("keyup", function(event) {
			event.preventDefault();
			if(event.keyCode === 13) {
				document.getElementById("login").click();
			}
		});
	</script>
</body>
</html>

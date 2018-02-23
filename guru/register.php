<?php
	include_once 'includes/register.inc.php';
	include_once 'includes/functions.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Secure Login : Registration Form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/JavaScript" src="js/sha512.js"></script>
    <script type="text/JavaScript" src="js/forms.js"></script>
	
	<style>
		.container {
			max-width: 1000px;
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
	<div class="container">
		<h1><strong>GURUKU</strong></h1>
		<h3>Registration For Teacher</h3>
		<hr>
		<?php 
			if(!empty($error_msg)) {
				echo $error_msg;
			}
		?>
		<div class="row">
			<div class="col-sm-6">
				<form class="form-horizontal" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" method="post" name="registration_form">
					<div class="form-group">
						<div class="row">
							<label class="control-label col-sm-3" for="username">Username</label>
							<div class="col-sm-9">
								<input class="form-control" type="text" name="username" id="username"/>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<label class="control-label col-sm-3" for="email">Email</label>
							<div class="col-sm-9">
								<input class="form-control" type="text" name="email" id="email"/>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<label class="control-label col-sm-3" for="password">Password</label>
							<div class="col-sm-9">
								<input class="form-control" type="password" name="password" id="password"/>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<label class="control-label col-sm-3" for="confirmpwd">Confirm Password</label>
							<div class="col-sm-9">
								<input class="form-control" type="password" name="confirmpwd" id="confirmpwd"/>
							</div>
						</div>
					</div>
					<input class="btn btn-primary" type="button" value="Register" onclick="return regformhash(this.form,
						this.form.username,
						this.form.email,
						this.form.password,
						this.form.confirmpwd);"/>
				</form>
				<hr>
				<p align="center">Kembali ke <a href="index.php">halaman log in</a>.</p>
			</div>
			<div class="col-sm-6">
				<ul>
					<li>Username hanya bisa mencakup digit, huruf-huruf besar dan kecil, dan garis bawah</li>
					<li>Email harus memiliki format yang valid</li>
					<li>Password harus setidaknya sepanjang 6 karakter</li>
					<li>Password harus mengandung
						<ul>
							<li>Setidaknya satu huruf besar (A..Z)</li>
							<li>Setidaknya satu huruf kecil (a..z)</li>
							<li>Setidaknya satu angka (0..9)</li>
						</ul>
					</li>
					<li>Password Anda dan konfirmasinya harus cocok</li>
				</ul>
			</div>
		</div>
	</div>
</body>
</html>
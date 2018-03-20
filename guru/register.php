<?php
include_once 'includes/register.inc.php';
include_once 'includes/functions.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Secure Login : Registration Form</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	
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
<!--container background-->
<div class="bgimg w3-display-container w3-row">
    <!--container login form-->
    <div class="w3-display-middle w3-half">
        <div class="login w3-card-4 w3-animate-zoom w3-light-grey w3-opacity-min w3-round-xlarge">
            <!--header guruku-->
            <header class="w3-amber w3-round-xlarge w3-center">
                <h1 class="logo w3-strong w3-xxxlarge w3-padding"><b>GURUKU </b></h1>
            </header>
            <div class="w3-container w3-center">
                <h3> Sistem Login for Teacher </h3>
            </div>
            <?php
            if(!empty($error_msg)) {
                echo $error_msg;
            }
            ?>
            <!--form login-->
            <div class="w3-row">
                <div class="w3-half w3-center">
                    <form action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" method="post" name="registration_form" class="w3-container">
                        <div class="w3-row w3-section">
                            <div class="w3-col s2">
                                <i class="w3-xxlarge fa fa-user"></i>
                            </div>
                            <div class="w3-rest">
                                <input class="w3-input w3-border" id="username" name="username" type="text" placeholder="Username" required>
                            </div>
                        </div>
                        <div class="w3-row w3-section">
                            <div class="w3-col s2">
                                <i class="w3-xxlarge fa fa-envelope"></i>
                            </div>
                            <div class="w3-rest">
                                <input class="w3-input w3-border" id="email" name="email" type="email" placeholder="Email" required>
                            </div>
                        </div>
                        <div class="w3-row w3-section">
                            <div class="w3-col s2">
                                <i class="w3-xxxlarge fa fa-lock"></i>
                            </div>
                            <div class="w3-rest">
                                <input class="w3-input w3-border" id="password" name="password" type="password" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" required>
                            </div>
                        </div>
                        <div class="w3-row w3-section">
                            <div class="w3-col s2">
                                <i class="w3-xxxlarge fa fa-unlock-alt"></i>
                            </div>
                            <div class="w3-rest">
                                <input class="w3-input w3-border" id="confirmpwd" name="confirmpwd" type="password" placeholder="Confirm Password" required>
                            </div>
                        </div>
                        <button class="w3-button w3-block w3-section w3-amber w3-ripple w3-padding" onclick="regformhash(this.form,
                            this.form.username,
                            this.form.email,
                            this.form.password,
                            this.form.confirmpwd)">Register</button>
                    </form>
                </div>
                <div class="w3-rest w3-padding-large w3-margin-top">
                    <ul>
                        <li>Username hanya bisa mencakup <b>digit</b>, <b>huruf-huruf besar<br> dan kecil</b>, dan <b>garis bawah</b></li>
                        <li>Email harus memiliki format yang <b>valid</b></li>
                        <li>Password harus setidaknya sepanjang <b>6 karakter</b></li>
                        <li>Password harus mengandung
                            <ul>
                                <li>Setidaknya <b>satu huruf besar (A..Z)</b></li>
                                <li>Setidaknya <b>satu huruf kecil (a..z)</b></li>
                                <li>Setidaknya <b>satu angka (0..9)</b></li>
                            </ul>
                        </li>
                        <li>Password Anda dan konfirmasinya harus cocok</li>
                    </ul>
                </div>
            </div>
            <hr class="w3-border-grey" style="margin:auto;width:80%">
            <div class="w3-container w3-center w3-padding">
                <p>Kembali ke <a href="index.php">halaman login</a> </p>
            </div>
        </div>
    </div>
</div>
</body>
</html>
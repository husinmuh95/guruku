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
<title>GURUKU |Secure Login</title>
<meta charset="UTF-8">
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
    body,h1 {font-family: "Roboto", sans-serif}
    body, html {height: 100%}
    .bgimg {
        background-image: url('media/bg.jpg');
        min-height: 100%;
        background-position: center;
        background-size: cover;
    }
    .login:hover {
        opacity: 1.0;
    }
</style>

<script>
    var input = document.getElementById("password");
    input.addEventListener("keyup", function(event) {
        event.preventDefault();
        if(event.keyCode === 13) {
            document.getElementById("login").click();
        }
    });
</script>

<body>
<?php
if(isset($_GET['error'])) {
    echo '<p class="error">Login gagal!</p>';
}
?>

<!--form login-->
<div class="bgimg w3-display-container">
    <div class="w3-display-middle">
        <div class="login w3-card-4 w3-animate-zoom w3-light-grey w3-opacity-min w3-round-xlarge w3-center">
            <header class="w3-amber w3-round-xlarge">
                <h1 class="w3-strong w3-xxxlarge"><b>GURUKU </b></h1>
            </header>
            <div class="w3-container">
                <h3> Sistem Login for Teacher </h3>
            </div>
            <form action="includes/process_login.php" method="post" name="login_form" class="w3-container">
                <div class="w3-row w3-section">
                    <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-user"></i></div>
                    <div class="w3-col" style="width: 500px">
                        <input class="w3-input w3-border" name="email" type="text" placeholder="Email" required>
                    </div>
                </div>

                <div class="w3-row w3-section">
                    <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-lock"></i></div>
                    <div class="w3-col" style="width: 500px">
                        <input class="w3-input w3-border" name="password" type="password" placeholder="Password" required>
                    </div>
                </div>
                <button id="login" onclick="formhash(this.form, this.form.password)" class="w3-button w3-block w3-section w3-amber w3-ripple w3-padding">Login</button>
            </form>
            <hr class="w3-border-grey" style="margin:auto;width:80%">
            <div class="w3-container">
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
        </div>
    </div>
</div>

</body>
</html>

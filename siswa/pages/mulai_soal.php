<?php 
	include_once '../includes/db_connect.php';
	include_once '../includes/functions.php';
	
	sec_session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>GURUKU | Student</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	
	<link href="../components/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="../components/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
	<style>
		#loader {
			position: absolute;
			left: 50%;
			top: 50%;
			z-index: 1;
			width: 150px;
			height: 150px;
			margin: -75px 0 0 -75px;
			border: 16px solid #f3f3f3;
			border-radius: 50%;
			border-top: 16px solid #3498db;
			width: 120px;
			height: 120px;
			-webkit-animation: spin 2s linear infinite;
			animation: spin 2s linear infinite;
		}
		@-webkit-keyframes spin {
			0% { -webkit-transform: rotate(0deg); }
			100% { -webkit-transform: rotate(360deg); }
		}
		@keyframes spin {
			0% { transform: rotate(0deg); }
			100% { transform: rotate(360deg); }
		}
	</style>
	
</head>
<body onload="loader()" style="margin:0;">
	<?php 
		if(login_check($mysqli) == true) {
			if(isset($_POST['mulai'])) {
				mysqli_autocommit($mysqli, FALSE);
				$kode = $_POST['inputKode'];
				$waktu = $_POST['waktu'];
				$checkJawab = "SELECT * FROM jawab WHERE username='".htmlentities($_SESSION['username'])."' AND kode_paket='".$kode."';";
				$result = $mysqli->query($checkJawab);
				if($result->num_rows > 0) {
					$sqlJawab = "UPDATE jawab SET mulai='".date('r')."' WHERE username='".htmlentities($_SESSION['username'])."' AND kode_paket='".$kode."';";
				} else {
					$sqlJawab = "INSERT INTO jawab (username, kode_paket, mulai) VALUES (
									'".htmlentities($_SESSION['username'])."', 
									'".$kode."', 
									'".date('r')."');";
				}
				mysqli_query($mysqli, $sqlJawab);
				mysqli_commit($mysqli);
			}
	?>
		<div id="loader"></div>
		
		<script>
			var load;
			function loader() {
				load = setTimeout(showPage, 3000);
			}
			function showPage() {
				location.replace("kerja_soal.php?kode=<?php echo $kode; ?>");
			}
		</script>
	<?php 
		} else {
			echo "
				<p>
					<span class='error'>Anda tidak berhak mengakses halaman ini.</span> Silakan <a href='../index.php'>melakukan login</a>.
				</p>";
		}
	?>
	
</body>
</html>
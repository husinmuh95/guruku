<?php
	include_once '../includes/db_connect.php';
	include_once '../includes/functions.php';
	
	sec_session_start();

	if(login_check($mysqli) == true) {
		if(isset($_POST["aktifkan"])) {
			$id = $_POST["inputID"];
			$sql = "UPDATE paket SET aktif=1 WHERE id=".$id.";";
			mysqli_query($mysqli, $sql);
		} else if(isset($_POST["nonaktifkan"])) {
			$id = $_POST["inputID"];
			$sql = "UPDATE paket SET aktif=0 WHERE id=".$id.";";
			mysqli_query($mysqli, $sql);
		}
		header("location: paket.php");
	} else {
		echo '
			<p>
				<span class="error">Anda tidak berhak mengakses halaman ini.</span> Silakan <a href="../index.php">melakukan login</a>.
			</p>';
	}
?>
	
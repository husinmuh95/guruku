<?php 

	include_once "../includes/db_connect.php";
	include_once "../includes/functions.php";
	
	sec_session_start();
	
	if(isset($_GET['id'])) {
		$sql = "SELECT tipe_soal_gambar, soal_gambar FROM soal WHERE id=".$_GET['id'].";";
		$result = $mysqli->query($sql);
		$row = $result->fetch_assoc();
		header("Content-type: ".$row['tipe_soal_gambar']);
		echo $row['soal_gambar'];
	} else {
		echo '
			<p>
				<span class="error">Anda tidak berhak mengakses halaman ini.</span> Silakan <a href="../index.php">melakukan login</a>.
			</p>';
	}
?>
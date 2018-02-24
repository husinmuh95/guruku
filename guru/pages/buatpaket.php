<?php 
	
	include_once "../includes/db_connect.php";
	include_once "../includes/functions.php";
	
	sec_session_start();
	
	if(login_check($mysqli) == true) {
		
		if(isset($_POST['save'])) {
			$soal = "";
			if(!empty($_POST['check_list'])) {
				foreach($_POST['check_list'] as $selected) {
					$soal = $soal." ".$selected;
				}
			}
			$nama = $_POST['inputNama'];
			$mapel = $_POST['inputMapel'];
			$kelas = $_POST['inputKelas'];
			$waktu = $_POST['inputWaktu'];
			$kode = $_POST['inputKode'];
			$soal = trim($soal," ");
			
			mysqli_autocommit($mysqli, FALSE);
			
			mysqli_query($mysqli, "INSERT INTO paket (kelas, nama, id_mapel, kode, waktu, soal) VALUES (".$kelas.", '".$nama."', ".$mapel.", '".$kode."', ".$waktu.", '".$soal."');");
			mysqli_commit($mysqli);
			
		} elseif(isset($_POST['edit'])) {
			$soal = "";
			if(!empty($_POST['check_list'])) {
				foreach($_POST['check_list'] as $selected) {
					$soal = $soal." ".$selected;
				}
			}
			$nama = $_POST['inputNama'];
			$kelas = $_POST['inputKelas'];
			$waktu = $_POST['inputWaktu'];
			$kode = $_POST['inputKode'];
			$soal = trim($soal, " ");

			mysqli_autocommit($mysqli, FALSE);

			mysqli_query($mysqli, "UPDATE paket SET kelas=".$kelas.", nama='".$nama."', waktu=".$waktu.", soal='".$soal."' WHERE kode='".$kode."';");
			mysqli_commit($mysqli);
		}
		header('location: paket.php');
	} else {
		echo '
			<p>
				<span class="error">Anda tidak berhak mengakses halaman ini.</span> Silakan <a href="../index.php">melakukan login</a>.
			</p>';
	}
?>
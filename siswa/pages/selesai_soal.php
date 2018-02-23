<?php 
	include_once '../includes/db_connect.php';
	include_once '../includes/functions.php';
	
	sec_session_start();
	
	if(login_check($mysqli) == true) {
		if(isset($_POST['selesai'])) {
			$kode = $_POST['kode'];
			$jmlSoal = $_POST['jmlSoal'];
			$username = htmlentities($_SESSION['username']);
			$jawab = array();
			for($i=0; $i<$jmlSoal; $i++) {
				$jawab[$i] = $_POST['pilih'.$i];
			}
			$jawabString = implode(" ", $jawab);
			$sql = "UPDATE jawab SET jawab = '".$jawabString."' WHERE kode_paket='".$kode."' AND username='".$username."';";
			
			mysqli_query($mysqli, $sql);
			
			$sqlGetSoal = "SELECT soal FROM paket WHERE kode='".$kode."';";
			$result = $mysqli->query($sqlGetSoal);
			$res = $result->fetch_assoc();
			$soal = explode(" ", $res["soal"]);
			mysqli_free_result($result);
			$sqlGetKunci = "SELECT kunci FROM kunci WHERE ";
			for($i=0; $i<count($soal)-1; $i++) {
				$sqlGetKunci .= "id_soal=".$soal[$i]." OR ";
			}
			$sqlGetKunci .= "id_soal=".$soal[count($soal)-1].";";
			$result = $mysqli->query($sqlGetKunci);
			$kunci = array();
			$numKunci = 0;
			if($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					$kunci[$numKunci] = $row["kunci"];
					$numKunci++;
				}
			}
			
			$jmlBenar = 0;
			$jmlSalah = 0;
			for($i=0; $i<count($soal); $i++) {
				if($jawab[$i] == $kunci[$i]) {
					$jmlBenar++;
				} else {
					$jmlSalah++;
				}
			}
			$nilai = ($jmlBenar / count($soal)) * 100;
			
			mysqli_free_result($result);
			$sqlCheckHasil = "SELECT * FROM hasil WHERE username='".$username."' AND kode_paket='".$kode."';";
			$result = $mysqli->query($sqlCheckHasil);
			if($result->num_rows > 0) {
				$sqlHasil = "UPDATE hasil SET jmlBenar=".$jmlBenar.", jmlSalah=".$jmlSalah.", nilai=".$nilai." WHERE username='".$username."' AND kode_paket='".$kode."';";
			} else {
				$sqlHasil = "INSERT INTO hasil (username, kode_paket, jmlBenar, jmlSalah, nilai) VALUES (
								'".$username."', '".$kode."', ".$jmlBenar.", ".$jmlSalah.", ".$nilai.");";
			}
			mysqli_query($mysqli, $sqlHasil);
			
		}
		header('location: hasil.php');
	} else {
		echo "
			<p>
				<span class='error'>Anda tidak berhak mengakses halaman ini.</span> Silakan <a href='../index.php'>melakukan login</a>.
			</p>";
	}
	
?>
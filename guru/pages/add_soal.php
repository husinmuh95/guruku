<?php

	include_once "../includes/db_connect.php";
	include_once "../includes/functions.php";
	
	sec_session_start();
	
	if(login_check($mysqli) == true) {
		if(isset($_POST['import'])) {
			$nama_file_baru = 'data.xlsx';
			
			require_once 'PHPExcel/PHPExcel.php';
			
			$excelreader = new PHPExcel_Reader_Excel2007();
			$loadexcel = $excelreader->load('tmp/'.$nama_file_baru);
			$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true, true);
			
			mysqli_autocommit($mysqli, FALSE);
			
			$numrow = 2;
			foreach($sheet as $row) {
				$kelas = $row['B'];
				$mapel = $row['C'];
				$bab = $row['F'];
				$kategori = $row['G'];
				$jenis = $row['H'];
				$soal = $row['I'];
				$soal_gambar = $row['J'];
				$soal_video = $row['K'];
				$soal_audio = $row['L'];
				$jawab_A = $row['M'];
				$gambar_A = $row['N'];
				$jawab_B = $row['O'];
				$gambar_B = $row['P'];
				$jawab_C = $row['Q'];
				$gambar_C = $row['R'];
				$jawab_D = $row['S'];
				$gambar_D = $row['T'];
				$jawab_E = $row['U'];
				$gambar_E = $row['V'];
				$kunci = $row['W'];
				$acak = $row['X'];
				if(empty($soal))
					continue;
				if($numrow > 2) {
					mysqli_query($mysqli, "INSERT INTO soal (id_mapel, kelas, kontributor, referensi, bab, kategori, jenis, soal, soal_gambar, soal_video, soal_audio, jawab_A, gambar_A, jawab_B, gambar_B, jawab_C, gambar_C, jawab_D, gambar_D, jawab_E, gambar_E, acak) VALUES (".$mapel.", ".$kelas.", '".$kontributor."', '".$referensi."', '".$bab."', ".$kategori.", ".$jenis.", '".$soal."', '".$soal_gambar."', '".$soal_video."', '".$soal_audio."', '".$jawab_A."', '".$gambar_A."', '".$jawab_B."', '".$gambar_B."', '".$jawab_C."', '".$gambar_C."', '".$jawab_D."', '".$gambar_D."', '".$jawab_E."', '".$gambar_E."', ".$acak.");");
					mysqli_query($mysqli, "INSERT INTO kunci (id_soal, kunci) VALUES (LAST_INSERT_ID(), ".$kunci.");");
					mysqli_commit($mysqli);
				}
				$numrow++;
			}
		} else if(isset($_POST['simpan'])) {
			$mapel = $_POST['inputMapel'];
			$kelas = $_POST['inputKelas'];
			$kategori = $_POST['inputKategori'];
			$jenis = 1;
			$bab = $_POST['inputBab'];
			$soal = $_POST['inputSoal'];
			$jawab_A = $_POST['jawab_A'];
			$jawab_B = $_POST['jawab_B'];
			$jawab_C = $_POST['jawab_C'];
			$jawab_D = $_POST['jawab_D'];
			$kunci = $_POST['kunci'];
			
			$tipeSoalGambar = "";
			$soalGambar = "";
			$tipeSoalVideo = "";
			$soalVideo = "";
			$tipeSoalAudio = "";
			$soalAudio = "";
			$tipeGambar_A = "";
			$gambar_A = "";
			$tipeGambar_B = "";
			$gambar_B = "";
			$tipeGambar_C = "";
			$gambar_C = "";
			$tipeGambar_D = "";
			$gambar_D = "";
			
			if(!empty($_FILES['soalGambar']['name'])) {
				$target_dir = "image/";
				$target_file = $target_dir . basename($_FILES['soalGambar']['name']);
				$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
				$extension_arr = array("jpg", "jpeg", "png", "gif");
				if(in_array($imageFileType, $extension_arr)) {
					$tipeSoalGambar = mime_content_type($_FILES['soalGambar']['tmp_name']);
					$soalGambar = addslashes(file_get_contents($_FILES['soalGambar']['tmp_name']));
				}
			}
			if(!empty($_FILES['soalVideo']['name'])) {
				$target_dir = "video/";
				$target_file = $target_dir . basename($_FILES['soalVideo']['name']);
				$videoFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
				$extension_arr = array("mp4", "webm", "ogg");
				if(in_array($videoFileType, $extension_arr)) {
					$tipeSoalVideo = mime_content_type($_FILES['soalVideo']['tmp_name']);
					$soalVideo = addslashes(file_get_contents($_FILES['soalVideo']['tmp_name']));
				}
			}
			if(!empty($_FILES['soalAudio']['name'])) {
				$target_dir = "audio/";
				$target_file = $target_dir . basename($_FILES['soalAudio']['name']);
				$audioFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
				$extension_arr = array("mp3", "wav", "ogg");
				if(in_array($audioFileType, $extension_arr)) {
					$tipeSoalAudio = mime_content_type($_FILES['soalAudio']['tmp_name']);
					$soalAudio = addslashes(file_get_contents($_FILES['soalAudio']['tmp_name']));
				}
			}
			if(!empty($_FILES['gambar_A']['name'])) {
				$target_dir = "image/";
				$target_file = $target_dir . basename($_FILES['gambar_A']['name']);
				$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
				$extension_arr = array("jpg", "jpeg", "png", "gif");
				if(in_array($imageFileType, $extension_arr)) {
					$tipeGambar_A = mime_content_type($_FILES['gambar_A']['tmp_name']);
					$gambar_A = addslashes(file_get_contents($_FILES['gambar_A']['tmp_name']));
				}
			}
			if(!empty($_FILES['gambar_B']['name'])) {
				$target_dir = "image/";
				$target_file = $target_dir . basename($_FILES['gambar_B']['name']);
				$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
				$extension_arr = array("jpg", "jpeg", "png", "gif");
				if(in_array($imageFileType, $extension_arr)) {
					$tipeGambar_B = mime_content_type($_FILES['gambar_B']['tmp_name']);
					$gambar_B = addslashes(file_get_contents($_FILES['gambar_B']['tmp_name']));
				}
			}
			if(!empty($_FILES['gambar_C']['name'])) {
				$target_dir = "image/";
				$target_file = $target_dir . basename($_FILES['gambar_C']['name']);
				$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
				$extension_arr = array("jpg", "jpeg", "png", "gif");
				if(in_array($imageFileType, $extension_arr)) {
					$tipeGambar_C = mime_content_type($_FILES['gambar_C']['tmp_name']);
					$gambar_C = addslashes(file_get_contents($_FILES['gambar_C']['tmp_name']));
				}
			}
			if(!empty($_FILES['gambar_D']['name'])) {
				$target_dir = "image/";
				$target_file = $target_dir . basename($_FILES['gambar_D']['name']);
				$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
				$extension_arr = array("jpg", "jpeg", "png", "gif");
				if(in_array($imageFileType, $extension_arr)) {
					$tipeGambar_D = mime_content_type($_FILES['gambar_D']['tmp_name']);
					$gambar_D = addslashes(file_get_contents($_FILES['gambar_D']['tmp_name']));
				}
			}

			mysqli_autocommit($mysqli, FALSE);
			
			mysqli_query($mysqli, "INSERT INTO soal (id_mapel, kelas, bab, kategori, jenis, soal, tipe_soal_gambar, soal_gambar, tipe_soal_video, soal_video, tipe_soal_audio, soal_audio, jawab_A, tipe_gambar_A, gambar_A, jawab_B, tipe_gambar_B, gambar_B, jawab_C, tipe_gambar_C, gambar_C, jawab_D, tipe_gambar_D, gambar_D, acak) VALUES (".$mapel.", ".$kelas.", '".$bab."', ".$kategori.", ".$jenis.", '".$soal."', '".$tipeSoalGambar."', '".$soalGambar."', '".$tipeSoalVideo."' ,'".$soalVideo."', '".$tipeSoalAudio."' ,'".$soalAudio."', '".$jawab_A."', '".$tipeGambar_A."' ,'".$gambar_A."', '".$jawab_B."', '".$tipeGambar_B."' ,'".$gambar_B."', '".$jawab_C."', '".$tipeGambar_C."' ,'".$gambar_C."', '".$jawab_D."', '".$tipeGambar_D."' ,'".$gambar_D."', 1);");
			mysqli_query($mysqli, "INSERT INTO kunci (id_soal, kunci) VALUES (LAST_INSERT_ID(), ".$kunci.");");
			mysqli_commit($mysqli);
			
		} else if(isset($_POST['edit'])) {
			$id = $_POST['inputID'];

			$sql = "SELECT tipe_soal_gambar, soal_gambar FROM soal WHERE id=".$id.";";
			$result = $mysqli->query($sql);
			$row = $result->fetch_assoc();
			$tipeSoalGambarMime = $row['tipe_soal_gambar'];
			$soalGambar = $row['soal_gambar'];

			$mapel = $_POST['inputMapel'];
			$kelas = $_POST['inputKelas'];
			$kategori = $_POST['inputKategori'];
			$jenis = 1;
			$bab = $_POST['inputBab'];
			$soal = $_POST['inputSoal'];
			$jawab_A = $_POST['jawab_A'];
			$jawab_B = $_POST['jawab_B'];
			$jawab_C = $_POST['jawab_C'];
			$jawab_D = $_POST['jawab_D'];
			$kunci = $_POST['kunci'];
			$tipeSoalGambar = "";

			if(!empty($_FILES['soalGambar']['name'])) {
				$target_dir = "image/";
				$target_file = $target_dir . basename($_FILES['soalGambar']['name']);
				$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
				$extension_arr = array("jpg", "jpeg", "png", "gif");
				if(in_array($imageFileType, $extension_arr)) {
					$tipeSoalGambar = getImageSize($_FILES['soalGambar']['tmp_name']);
					$tipeSoalGambarMime = $tipeSoalGambar['mime'];
					$soalGambar = addslashes(file_get_contents($_FILES['soalGambar']['tmp_name']));
				}
			}

			mysqli_autocommit($mysqli, FALSE);

			mysqli_query($mysqli, "UPDATE soal SET id_mapel=".$mapel.", kelas=".$kelas.", kategori=".$kategori.", bab='".$bab."', soal='".$soal."',tipe_soal_gambar='".$tipeSoalGambarMime."', soal_gambar='".$soalGambar."', jawab_A='".$jawab_A."', jawab_B='".$jawab_B."', jawab_C='".$jawab_C."', jawab_D='".$jawab_D."' WHERE id=".$id.";");
			mysqli_query($mysqli, "UPDATE kunci SET kunci=".$kunci." WHERE id_soal=".$id.";");
			mysqli_commit($mysqli);
		}

		header('location: view_soal.php');
	} else {
		echo '
			<p>
				<span class="error">Anda tidak berhak mengakses halaman ini.</span> Silakan <a href="../index.php">melakukan login</a>.
			</p>';
	}
?>
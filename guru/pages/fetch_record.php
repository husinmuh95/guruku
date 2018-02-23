<?php 

	include_once "../includes/db_connect.php";
	include_once "../includes/functions.php";
	
	sec_session_start();
	
	function kategoriString($kategori) {
		$kategoriStr = "";
		if($kategori == "1") {
			$kategoriStr = "Mudah";
		} else if($kategori == "2") {
			$kategoriStr = "Sedang";
		} else if($kategori == "3") {
			$kategoriStr = "Sulit";
		}
		return $kategoriStr;
	}
	
	function jenisString($jenis) {
		$jenisStr = "";
		if($jenis == "1") {
			$jenisStr = "Pilihan Ganda";
		} else if($jenis == "2") {
			$jenisStr = "Esai";
		}
		return $jenisStr;
	}
	
	function cekJawab($jawab, $kunci) {
		$check = "";
		if($jawab == $kunci) {
			$check = "<i class='fa fa-lg fa-check' style='color:green'></i>";
		}
		return $check;
	}
	
	if(login_check($mysqli) == true) {
		if(isset($_POST['rowid'])) {
			$id = $_POST['rowid'];
			$sql = "SELECT soal.kelas, mapel.mapel, soal.bab, soal.kategori, soal.jenis, soal.soal, soal.jawab_A, soal.jawab_B, soal.jawab_C, soal.jawab_D, kunci.kunci FROM ((soal INNER JOIN mapel ON soal.id_mapel=mapel.id_mapel) INNER JOIN kunci ON soal.id=kunci.id_soal) WHERE soal.id=".$id.";";
			$result = $mysqli->query($sql);
			$row = $result->fetch_assoc();
			echo "
				<div class='row'>
					<div class='col-sm-3'>
						<p><strong>Kelas</strong></p>
					</div>
					<div class='col-sm-1'>
						<p>:</p>
					</div>
					<div class='col-sm-8'>
						<p>".$row["kelas"]."</p>
					</div>
				</div>
				<div class='row'>
					<div class='col-sm-3'>
						<p><strong>Mata Pelajaran</strong></p>
					</div>
					<div class='col-sm-1'>
						<p>:</p>
					</div>
					<div class='col-sm-8'>
						<p>".$row["mapel"]."</p>
					</div>
				</div>
				<div class='row'>
					<div class='col-sm-3'>
						<p><strong>Bab</strong></p>
					</div>
					<div class='col-sm-1'>
						<p>:</p>
					</div>
					<div class='col-sm-8'>
						<p>".$row["bab"]."</p>
					</div>
				</div>
				<div class='row'>
					<div class='col-sm-3'>
						<p><strong>Kategori</strong></p>
					</div>
					<div class='col-sm-1'>
						<p>:</p>
					</div>
					<div class='col-sm-8'>
						<p>".kategoriString($row["kategori"])."</p>
					</div>
				</div>
				<hr>
				<div class='row'>
					<div class='col-sm-3'>
						<p><strong>Soal</strong></p>
					</div>
					<div class='col-sm-9'>
						<p>:</p>
					</div>
				</div>
				<p>".$row["soal"]."</p>
				<hr>
				<div class='row'>
					<div class='col-sm-3'>
						<p><strong>Pilihan Jawaban</strong></p>
					</div>
					<div class='col-sm-9'>
						<p>:</p>
					</div>
				</div>";
			echo "
				<div class='row'>
					<div class='col-sm-1'>
					".cekJawab("1", $row["kunci"])."
					</div>
					<div class='col-sm-1'>
						<p>A.</p>
					</div>
					<div class-'col-sm-10'>
						<p>".$row["jawab_A"]."</p>
					</div>
				</div>
				<div class='row'>
					<div class='col-sm-1'>
					".cekJawab("2", $row["kunci"])."
					</div>
					<div class='col-sm-1'>
						<p>B.</p>
					</div>
					<div class-'col-sm-10'>
						<p>".$row["jawab_B"]."</p>
					</div>
				</div>
				<div class='row'>
					<div class='col-sm-1'>
					".cekJawab("3", $row["kunci"])."
					</div>
					<div class='col-sm-1'>
						<p>C.</p>
					</div>
					<div class-'col-sm-10'>
						<p>".$row["jawab_C"]."</p>
					</div>
				</div>
				<div class='row'>
					<div class='col-sm-1'>
					".cekJawab("4", $row["kunci"])."
					</div>
					<div class='col-sm-1'>
						<p>D.</p>
					</div>
					<div class-'col-sm-10'>
						<p>".$row["jawab_D"]."</p>
					</div>
				</div>
				";
			
		}
		
		if(isset($_POST['paketid'])) {
			$id = $_POST['paketid'];
			$sql = "SELECT paket.kelas, paket.nama, mapel.mapel, paket.kode, paket.waktu, paket.soal FROM paket INNER JOIN mapel ON mapel.id_mapel=paket.id_mapel WHERE paket.id=".$id.";";
			$result = $mysqli->query($sql);
			$row = $result->fetch_assoc();
			echo "
					<div class='row'>
						<div class='col-sm-3'>
							<p><strong>Nama Paket Soal</strong></p>
						</div>
						<div class='col-sm-1'>
							<p>:</p>
						</div>
						<div class='col-sm-8'>
							<p>".$row["nama"]."</p>
						</div>
					</div>
					<div class='row'>
						<div class='col-sm-3'>
							<p><strong>Kelas</strong></p>
						</div>
						<div class='col-sm-1'>
							<p>:</p>
						</div>
						<div class='col-sm-8'>
							<p>".$row["kelas"]."</p>
						</div>
					</div>
					<div class='row'>
						<div class='col-sm-3'>
							<p><strong>Mata Pelajaran</strong></p>
						</div>
						<div class='col-sm-1'>
							<p>:</p>
						</div>
						<div class='col-sm-8'>
							<p>".$row["mapel"]."</p>
						</div>
					</div>
					<div class='row'>
						<div class='col-sm-3'>
							<p><strong>Waktu</strong></p>
						</div>
						<div class='col-sm-1'>
							<p>:</p>
						</div>
						<div class='col-sm-8'>
							<p>".$row["waktu"]." Menit</p>
						</div>
					</div>
					<div class='row'>
						<div class='col-sm-3'>
							<p><strong>Kode</strong></p>
						</div>
						<div class='col-sm-1'>
							<p>:</p>
						</div>
						<div class='col-sm-8'>
							<p>".$row["kode"]."</p>
						</div>
					</div>
					<div class='row'>
						<div class='col-sm-3'>
							<p><strong>Jumlah Soal</strong></p>
						</div>
						<div class='col-sm-1'>
							<p>:</p>
						</div>
						<div class='col-sm-8'>
							<p>".count(explode(" ",$row["soal"]))."</p>
						</div>
					</div>
					<hr>
					<table id='example' class='table table-hover'>
						<thead>
							<tr>
								<th>No.</th>
								<th>Soal</th>
								<th>Bab</th>
								<th>Jenis</th>
								<th>Kategori</th>
							</tr>
						</thead>
						<tbody>";
			$soal = explode(" ",$row["soal"]);
			for($i=0; $i<count(explode(" ",$row["soal"])); $i++) {
				$res = $mysqli->query("SELECT soal.soal, soal.bab, soal.jenis, soal.kategori FROM soal WHERE soal.id=".$soal[$i].";");
				$r = $res->fetch_assoc();
				echo "
					<tr>
						<td>".($i+1)."</td>
						<td>".$r["soal"]."</td>
						<td>".$r["bab"]."</td>
						<td>".jenisString($r["jenis"])."</td>
						<td>".kategoriString($r["kategori"])."</td>
					</tr>";
			}
			echo "
					</tbody>
				</table>";
				
		}
	} else {
		echo '
			<p>
				<span class="error">Anda tidak berhak mengakses halaman ini.</span> Silakan <a href="../index.php">melakukan login</a>.
			</p>';
	}
?>
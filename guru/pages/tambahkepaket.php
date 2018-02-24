<?php 
	include_once '../includes/db_connect.php';
	include_once '../includes/functions.php';
	
	sec_session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>GURUKU | Tambah Paket Soal</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	
	<link href="../components/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="../components/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic" rel="stylesheet">
	<link href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css" rel="stylesheet">
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
	
	<style>
		html, body {
			height: 100%;
		}
		body {
			padding-top: 80px;
		}
		.navbar {
			background-color: #1a3547;
			border: none;
		}
		.custom-select {
			position: relative;
		}
		.custom-select select {
			display: none;
		}
		.select-selected {
			background-color: DodgerBlue;
		}
		.select-selected:after {
			position: absolute;
			content: "";
			top: 14px;
			right: 10px;
			width: 0;
			height: 0;
			border: 6px solid transparent;
			border-color: #fff transparent transparent transparent;
		}
		.select-selected.select-arrow-active:after {
			border-color: transparent transparent #fff transparent;
			top: 7px;
		}
		.select-items div, .select-selected {
			color: #ffffff;
			padding: 8px 16px;
			border: 1px solid transparent;
			border-color: transparent transparent rgba(0, 0, 0, 0.1) transparent;
			cursor: pointer;
			user-select: none;
		}
		.select-items {
			position: absolute;
			background-color: DodgerBlue;
			top: 100%;
			left: 0;
			right: 0;
			z-index: 99;
		}
		.select-hide {
			display: none;
		}
		.select-items div:hover {
			background-color: rgba(0, 0, 0, 0.1);
		}
		.block {
			display: block;
			width: 100%;
			border: none;
			background-color: DodgerBlue;
			padding: 14px 28px;
			font-size: 16px;
			cursor: pointer;
			text-align: center;
			color: white;
			margin-bottom: 20px;
		}
	</style>
	
</head>
<body>
	<?php if(login_check($mysqli) == true) : ?>
	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="#">GURUKU</a>
			</div>
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo htmlentities($_SESSION['username']); ?></a>
					<ul class="dropdown-menu">
						<li><a href="#">Profile</a></li>
						<li><a href="#">Sign Out</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</nav>
	
	<?php if(isset($_POST['save'])) : ?>
		<?php
			$nama = $_POST['inputNama'];
			$mapel = $_POST['inputMapel'];
			$kelas = $_POST['inputKelas'];
			$waktu = $_POST['inputWaktu'];
			$kode = $_POST['inputKode'];
			
			$sql = "SELECT mapel FROM mapel WHERE id_mapel=".$mapel.";";
			$result = $mysqli->query($sql);
			$mpl = $result->fetch_assoc();
			$mapelString = $mpl["mapel"];
		?>
	
		<div class="container-fluid">
			<a href="paket.php" class="btn btn-danger pull-right">
				<span class="fa fa-times"></span> Cancel
			</a>
			<h3>Form Buat Paket Soal</h3>
			<hr>
			<div class='row'>
				<div class='col-sm-3'>
					<p><strong>Nama Paket Soal</strong></p>
				</div>
				<div class='col-sm-1'>
					<p>:</p>
				</div>
				<div class='col-sm-8'>
					<p><?php echo $nama; ?></p>
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
					<p><?php echo $kelas; ?></p>
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
					<p><?php echo $mapelString; ?></p>
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
					<p><?php echo $waktu; ?> Menit</p>
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
					<p><?php echo $kode; ?></p>
				</div>
			</div>
			<form method="post" action="buatpaket.php">
				<input name="inputNama" type="hidden" value="<?php echo $nama; ?>">
				<input name="inputMapel" type="hidden" value="<?php echo $mapel; ?>">
				<input name="inputKelas" type="hidden" value="<?php echo $kelas; ?>">
				<input name="inputWaktu" type="hidden" value="<?php echo $waktu; ?>">
				<input name="inputKode" type="hidden" value="<?php echo $kode; ?>">
				<hr>
				<table id="example" class="table table-hover">
					<thead>
						<tr>
							<th>Select</th>
							<th>ID Soal</th>
							<th>Pertanyaan</th>
							<th>Bab</th>
							<th>Jenis</th>
							<th>Kategori</th>
							<th>Lihat</th>
						</tr>
					</thead>
					<tbody>
					<?php
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
						mysqli_free_result($result);
						$sql = "SELECT soal.id, soal.kelas, mapel.mapel, soal.soal, soal.bab, soal.jenis, soal.kategori FROM soal INNER JOIN mapel ON soal.id_mapel=mapel.id_mapel WHERE soal.id_mapel=".$mapel.";";
						$result = $mysqli->query($sql);
						if($result->num_rows > 0) {
							while($row = $result->fetch_assoc()) {
								echo "
									<tr>
										<td align='center'><input type='checkbox' name='check_list[]' value='".$row["id"]."'/></td>
										<td align='center'>".$row["id"]."</td>
										<td>".$row["soal"]."</td>
										<td>".$row["bab"]."</td>
										<td>".jenisString($row["jenis"])."</td>
										<td>".kategoriString($row["kategori"])."</td>
										<td>
											<a href='#modalSoal".$row["id"]."' class='btn btn-default' id='soalId' data-toggle='modal'>
												<span class='fa fa-search'></span>
											</a>
											<div class='modal fade' id='modalSoal".$row["id"]."' tabindex='-1' role='dialog' aria-labelledby='myModalLabel".$row["id"]."' aria-hidden='true'>
												<div class='modal-dialog'>
													<div class='modal-content'>
														<div class='modal-header'>
															<button type='button' class='close' data-dismiss='modal' id='closeModalSoal'>
																<span aria-hidden='true'>&times;</span>
																<span class='sr-only'>Close</span>
															</button>
															<h4 class='modal-title' id='myModalLabel".$row["id"]."'>Lihat Soal</h4>
														</div>
														<div class='modal-body'>
															<div class='row'>
																<div class='col-sm-9'>
																	<div class='row'>
																		<div class='col-sm-4'>
																			<p><strong>Kelas</strong></p>
																		</div>
																		<div class='col-sm-1'>
																			<p>:</p>
																		</div>
																		<div class='col-sm-7'>
																			<p>".$row["kelas"]."</p>
																		</div>
																	</div>
																	<div class='row'>
																		<div class='col-sm-4'>
																			<p><strong>Mata Pelajaran</strong></p>
																		</div>
																		<div class='col-sm-1'>
																			<p>:</p>
																		</div>
																		<div class='col-sm-7'>
																			<p>".$row["mapel"]."</p>
																		</div>
																	</div>
																	<div class='row'>
																		<div class='col-sm-4'>
																			<p><strong>Bab</strong></p>
																		</div>
																		<div class='col-sm-1'>
																			<p>:</p>
																		</div>
																		<div class='col-sm-7'>
																			<p>".$row["bab"]."</p>
																		</div>
																	</div>
																	<div class='row'>
																		<div class='col-sm-4'>
																			<p><strong>Kategori</strong></p>
																		</div>
																		<div class='col-sm-1'>
																			<p>:</p>
																		</div>
																		<div class='col-sm-7'>
																			<p>".kategoriString($row["kategori"])."</p>
																		</div>
																	</div>
																</div>
																<div class='col-sm-3'>
																	<form method='post' action='tambah_soal.php?type=edit'>
																		<input type='hidden' name='idSoal' value='".$row["id"]."'>
																		<button type='submit' class='btn btn-primary'>Edit Soal</button>
																	</form>
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
															<p>".$row["soal"]."</p>";
								if(!empty($row["soal_gambar"])) {
									echo "
															<a href='imageView.php?id=".$row["id"]."' target='_blank' type='button' class='btn btn-primary'>
																<span class='fa fa-image'></span> Lihat Gambar
															</a>";
															
								}
								echo "
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
														</div>
														<div class='modal-footer'>
															<button type='button' class='btn btn-default pull-right' data-dismiss='modal'>Close</button>
														</div>
													</div>
												</div>
											</div>
										</td>
									</tr>";
							}
						}
					?>
					</tbody>
				</table>
				<hr>
				<button type="submit" name="save" class="block"><span class="fa fa-save"></span> Simpan Paket Soal</button>
			</form>
		</div>
		<br></br>

	<?php elseif(isset($_POST['edit'])) : ?>
		<?php
			$kode = $_POST['kode'];
			$sql = "SELECT paket.nama, paket.kelas, paket.id_mapel, paket.waktu, paket.soal FROM paket WHERE paket.kode='".$kode."';";
			$result = $mysqli->query($sql);
			$row = $result->fetch_assoc();
			$nama = $row['nama'];
			$kelas = $row['kelas'];
			$mapel = $row['id_mapel'];
			$waktu = $row['waktu'];
			$soal = explode(" ", $row['soal']);

		?>
		<div class="container-fluid">
			<a href="paket.php" class="btn btn-danger pull-right">
				<span class="fa fa-times"></span> Cancel
			</a>
			<h3>Form Edit Paket Soal</h3>
			<hr>
			<form method="post" action="buatpaket.php">
				<div class='row'>
					<div class='col-sm-3'>
						<p><strong>Nama Paket Soal</strong></p>
					</div>
					<div class='col-sm-1'>
						<p>:</p>
					</div>
					<div class='col-sm-8'>
						<input type="text" class="form-control" name="inputNama" value="<?php echo $nama; ?>">
					</div>
				</div>
				<br>
				<div class="form-group">
					<div class="row">
						<label class="control-label col-sm-3" for="inputKelas">Kelas</label>
						<div class="col-sm-1">
							<p>:</p>
						</div>
						<div class="col-sm-8">
							<div class="custom-select" style="width:200px;">
								<select name="inputKelas">
									<option value="0">Kelas</option>
									<option value="7" <?php if($kelas == "7") echo "selected"; ?>>7</option>
									<option value="8" <?php if($kelas == "8") echo "selected"; ?>>8</option>
									<option value="9" <?php if($kelas == "9") echo "selected"; ?>>9</option>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class='row'>
					<label class="control-label col-sm-3" for="inputWaktu">Waktu</label>
					<div class='col-sm-1'>
						<p>:</p>
					</div>
					<div class='col-sm-8'>
						<div class="custom-select" style="width:200px;">
							<select name="inputWaktu">
								<option value="0">Waktu</option>
								<option value="30" <?php if($waktu == "30") echo "selected"; ?>>30 Menit</option>
								<option value="60" <?php if($waktu == "60") echo "selected"; ?>>60 Menit</option>
								<option value="90" <?php if($waktu == "90") echo "selected"; ?>>90 Menit</option>
								<option value="120" <?php if($waktu == "120") echo "selected"; ?>>120 Menit</option>
							</select>
						</div>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-sm-3">
						<p><strong>Mata Pelajaran</strong></p>
					</div>
					<div class="col-sm-1">
						<p>:</p>
					</div>
					<div class="col-sm-8">
						<p>
							<?php
								mysqli_free_result($result);
								$sql = "SELECT mapel FROM mapel WHERE id_mapel=".$mapel.";";
								$result = $mysqli->query($sql);
								$row = $result->fetch_assoc();
								echo $row['mapel'];
							?>
						</p>
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
						<p><?php echo $kode; ?></p>
					</div>
				</div>
				<input name="inputKode" type="hidden" value="<?php echo $kode; ?>">
				<hr>
				<table id="example" class="table table-hover">
					<thead>
						<tr>
							<th>Select</th>
							<th>ID Soal</th>
							<th>Pertanyaan</th>
							<th>Bab</th>
							<th>Jenis</th>
							<th>Kategori</th>
							<th>Lihat</th>
						</tr>
					</thead>
					<tbody>
					<?php
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
						mysqli_free_result($result);
						$sql = "SELECT soal.id, soal.kelas, mapel.mapel, soal.soal, soal.bab, soal.jenis, soal.kategori, soal.soal_gambar, soal.jawab_A, soal.jawab_B, soal.jawab_C, soal.jawab_D, kunci.kunci FROM ((soal INNER JOIN mapel ON soal.id_mapel=mapel.id_mapel) INNER JOIN kunci ON soal.id=kunci.id_soal) WHERE soal.id_mapel=".$mapel.";";
						$result = $mysqli->query($sql);
						if($result->num_rows > 0) {
							while($row = $result->fetch_assoc()) {
								echo "
									<tr>
										<td align='center'><input type='checkbox' name='check_list[]' value='".$row["id"]."' ";
								if(in_array($row["id"], $soal)) {
									echo "checked='checked'";
								}
								echo "
											/></td>
										<td align='center'>".$row["id"]."</td>
										<td>".$row["soal"]."</td>
										<td>".$row["bab"]."</td>
										<td>".jenisString($row["jenis"])."</td>
										<td>".kategoriString($row["kategori"])."</td>
										<td>
											<a href='#modalSoal".$row["id"]."' class='btn btn-default' id='soalId' data-toggle='modal'>
												<span class='fa fa-search'></span>
											</a>
											<div class='modal fade' id='modalSoal".$row["id"]."' tabindex='-1' role='dialog' aria-labelledby='myModalLabel".$row["id"]."' aria-hidden='true'>
												<div class='modal-dialog'>
													<div class='modal-content'>
														<div class='modal-header'>
															<button type='button' class='close' data-dismiss='modal' id='closeModalSoal'>
																<span aria-hidden='true'>&times;</span>
																<span class='sr-only'>Close</span>
															</button>
															<h4 class='modal-title' id='myModalLabel".$row["id"]."'>Lihat Soal</h4>
														</div>
														<div class='modal-body'>
															<div class='row'>
																<div class='col-sm-4'>
																	<p><strong>Kelas</strong></p>
																</div>
																<div class='col-sm-1'>
																	<p>:</p>
																</div>
																<div class='col-sm-7'>
																	<p>".$row["kelas"]."</p>
																</div>
															</div>
															<div class='row'>
																<div class='col-sm-4'>
																	<p><strong>Mata Pelajaran</strong></p>
																</div>
																<div class='col-sm-1'>
																	<p>:</p>
																</div>
																<div class='col-sm-7'>
																	<p>".$row["mapel"]."</p>
																</div>
															</div>
															<div class='row'>
																<div class='col-sm-4'>
																	<p><strong>Bab</strong></p>
																</div>
																<div class='col-sm-1'>
																	<p>:</p>
																</div>
																<div class='col-sm-7'>
																	<p>".$row["bab"]."</p>
																</div>
															</div>
															<div class='row'>
																<div class='col-sm-4'>
																	<p><strong>Kategori</strong></p>
																</div>
																<div class='col-sm-1'>
																	<p>:</p>
																</div>
																<div class='col-sm-7'>
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
															<p>".$row["soal"]."</p>";
								if(!empty($row["soal_gambar"])) {
									echo "
															<a href='imageView.php?id=".$row["id"]."' target='_blank' type='button' class='btn btn-primary'>
																<span class='fa fa-image'></span> Lihat Gambar
															</a>";
															
								}
								echo "
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
														</div>
														<div class='modal-footer'>
															<button type='button' class='btn btn-default pull-right' data-dismiss='modal'>Close</button>
														</div>
													</div>
												</div>
											</div>
										</td>
									</tr>";
							}
						}
					?>
					</tbody>
				</table>
				<hr>
				<button type="submit" name="edit" class="block"><span class="fa fa-save"></span> Simpan Paket Soal</button>
			</form>
		</div>
		<br></br>
	<?php endif; ?>

	<script>

		$(document).ready(function() {
			$('#example').DataTable();
		});
		
		var x, i, j, selElement, a, b, c;
		x = document.getElementsByClassName("custom-select");
		for(i=0; i<x.length; i++) {
			selElement = x[i].getElementsByTagName("select")[0];
			a = document.createElement("DIV");
			a.setAttribute("class", "select-selected");
			a.innerHTML = selElement.options[selElement.selectedIndex].innerHTML;
			x[i].appendChild(a);
			b = document.createElement("DIV");
			b.setAttribute("class", "select-items select-hide");
			for(j=1; j<selElement.length; j++) {
				c = document.createElement("DIV");
				c.innerHTML = selElement.options[j].innerHTML;
				c.addEventListener("click", function(e) {
					var i, s, h;
					s = this.parentNode.parentNode.getElementsByTagName("select")[0];
					h = this.parentNode.previousSibling;
					for(i=0; i<s.length; i++) {
						if(s.options[i].innerHTML == this.innerHTML) {
							s.selectedIndex = i;
							h.innerHTML = this.innerHTML;
							break;
						}
					}
					h.click();
				});
				b.appendChild(c);
			}
			x[i].appendChild(b);
			a.addEventListener("click", function(e) {
				e.stopPropagation();
				closeAllSelect(this);
				this.nextSibling.classList.toggle("select-hide");
				this.classList.toggle("select-arrow-active");
			});
		}
		
		function closeAllSelect(element) {
			var x, y, i, arrNo = [];
			x = document.getElementsByClassName("select-items");
			y = document.getElementsByClassName("select-selected");
			for(i=0; i<y.length; i++) {
				if(element == y[i]) {
					arrNo.push(i)
				} else {
					y[i].classList.remove("select-arrow-active");
				}
			}
			for(i=0; i<x.length; i++) {
				if(arrNo.indexOf(i)) {
					x[i].classList.add("select-hide");
				}
			}
		}
		
		document.addEventListener("click", closeAllSelect);

	</script>
	
	<?php else : ?>
		<p>
			<span class="error">Anda tidak berhak mengakses halaman ini.</span> Silakan <a href="../index.php">melakukan login</a>.
        </p>
	<?php endif; ?>
	
</body>
</html>

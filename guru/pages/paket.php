<?php 
	include_once '../includes/db_connect.php';
	include_once '../includes/functions.php';
	
	sec_session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>GURUKU | Paket Soal</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
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
			padding-left: 190px;
		}
		.navbar {
			background-color: #1a3547;
			border: none;
		}
		.sidenav {
			height: 100%;
			width: 200px;
			position: fixed;
			z-index: 1;
			top: 0;
			left: 0;
			background-color: #1a3547;
			overflow-x: hidden;
			padding-top: 60px;
		}
		.sidenav a, .dropdown-btn {
			padding: 6px 8px 6px 16px;
			text-decoration: none;
			font-size: 18px;
			color: #818181;
			display: block;
			border: none;
			background: none;
			width: 100%;
			text-align: left;
			cursor: pointer;
			outline: none;
		}
		.sidenav a:hover, dropdown-btn:hover {
			color: #f1f1f1;
		}
		.sidenav a.active {
			color: #f1f1f1;
		}
		.dropdown-container {
			display: none;
			background-color: #23516f;
			padding-left: 8px;
		}
		.fa-caret-down {
			float: right;
			padding-right: 8px;
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
						<li><a href="profil.php">Profile</a></li>
						<li><a href="../includes/logout.php">Sign Out</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</nav>
	<div class="sidenav">
		<button class="dropdown-btn" id="dataSiswa">
			<span class="fa fa-users"></span> Data Siswa
			<i class="fa fa-caret-down"></i>
		</button>
		<div class="dropdown-container">
			<a href="daftarsiswa.php"><span class="fa fa-user"></span> Daftar Siswa</a>
		</div>
		<button class="dropdown-btn" id="bankSoal">
			<span class="fa fa-archive"></span> Bank Soal
			<i class="fa fa-caret-down"></i>
		</button>
		<div class="dropdown-container">
			<a href="#" class="active"><span class="fa fa-book"></span> Paket Soal</a>
			<a href="view_soal.php"><span class="fa fa-plus-square"></span> Daftar Soal</a>
		</div>
		<a href="mapel.php"><span class="fa fa-list-alt"></span> Mata Pelajaran</a>
	</div>
	
	<div class="container-fluid">
		<div class="panel panel-default">
			<div class="panel-body">
				<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modalPaket">
					<span class="fa fa-book"></span>  Buat Paket Soal
				</a>
				<div class="modal fade" id="modalPaket" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">
									<span aria-hidden="true">&times;</span>
									<span class="sr-only">Close</span>
								</button>
								<h4 class="modal-title" id="myModalLabel">Buat Paket Soal</h4>
							</div>
							<form class="form-horizontal" method="post" action="tambahkepaket.php">
								<div class="modal-body">
									<div class="form-group">
										<div class="row">
											<label class="control-label col-sm-3" for="inputNama">Nama Paket Soal</label>
											<div class="col-sm-9">
												<input type="text" class="form-control" name="inputNama" placeholder="Nama Paket Soal"/>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<label class="control-label col-sm-3" for="inputMapel">Mata Pelajaran</label>
											<div class="col-sm-9">
												<div class="custom-select" style="width:200px;">
													<select name="inputMapel">
														<?php 
															$sql = "SELECT id_mapel, mapel FROM mapel;";
															$result = $mysqli->query($sql);
															if($result->num_rows > 0) {
																while($row = $result->fetch_assoc()) {
																	echo "<option value='".$row["id_mapel"]."'>".$row["mapel"]."</option>";
																}
															}
														?>
													</select>
												</div>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<label class="control-label col-sm-3" for="inputKelas">Kelas</label>
											<div class="col-sm-9">
												<div class="custom-select" style="width:200px;">
													<select name="inputKelas">
														<option value="7">7</option>
														<option value="8">8</option>
														<option value="9">9</option>
													</select>
												</div>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<label class="control-label col-sm-3" for="inputWaktu">Waktu</label>
											<div class="col-sm-9">
												<div class="custom-select" style="width:200px;">
													<select name="inputWaktu">
														<option value="30">30 Menit</option>
														<option value="60">60 Menit</option>
														<option value="90">90 Menit</option>
														<option value="120">120 Menit</option>
													</select>
												</div>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<label class="control-label col-sm-3" for="inputKode">Kode Ujian</label>
											<div class="col-sm-9">
												<?php 
													function generateRandomString($length = 5) {
														$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
														$characterslength = strlen($characters);
														$randomString = '';
														for($i=0; $i<$length; $i++) {
															$randomString .= $characters[rand(0, $characterslength-1)];
														}
														/*$s = "SELECT kode FROM paket;";
														$res = $conn->query($s);
														$kodeArr = mysqli_fetch_array($res, MYSQLI_NUM);
														while($kodeArr[0] == $randomString) {
															$randomString = '';
															for($i=0; $i<$length; $i++) {
																$randomString .= $characters[rand(0, $characterslength-1)];
															}
														}*/
														return $randomString;
													}
												?>
												<input type="text" class="form-control" name="inputKode" value="<?php echo generateRandomString(); ?>"/>
											</div>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
									<input type="submit" name="save" class="btn btn-primary pull-right" value="Save"></input>
								</div>
							</form>
						</div>
					</div>
				</div>
				
				
				<br></br>
				<table id="example" class="table table-hover">
					<thead>
						<tr>
							<th>No.</th>
							<th>Nama</th>
							<th>Mata Pelajaran</th>
							<th>Kelas</th>
							<th>Kode Ujian</th>
							<th>Waktu</th>
							<th>Status</th>
							<th>Detail</th>
							<th>Hapus</th>
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

							$sql = "SELECT paket.id, paket.kode, paket.aktif, mapel.mapel, paket.nama, paket.kelas, paket.waktu, paket.soal FROM paket INNER JOIN mapel ON paket.id_mapel=mapel.id_mapel;";
							$result = $mysqli->query($sql);

							if($result->num_rows > 0) {
								while($row = $result->fetch_assoc()) {
									echo "
										<tr>
											<td>".$row["id"]."</td>
											<td>".$row["nama"]."</td>
											<td>".$row["mapel"]."</td>
											<td>".$row["kelas"]."</td>
											<td>".$row["kode"]."</td>
											<td>".$row["waktu"]." Menit</td>
											<td>";
									if($row["aktif"] == "0") {
										echo "
												<a href='#modalAktif".$row["id"]."' class='btn btn-danger' data-toggle='modal'>
													Tidak Aktif
												</a>
												<div class='modal fade' id='modalAktif".$row["id"]."' tabindex='-1' role='dialog' aria-labelledby='myModalLabel".$row["id"]."' aria-hidden='true'>
													<div class='modal-dialog'>
														<div class='modal-content'>
															<form method='post' action='aktifpaket.php'>
																<div class='modal-header'>
																	<button type='button' class='close' data-dismiss='modal'>
																		<span aria-hidden='true'>&times;</span>
																		<span class='sr-only'>Close</span>
																	</button>
																	<h4 class='modal-title' id='myModalLabel".$row["id"]."'>Aktifkan Paket Soal</h4>
																</div>
																<div class='modal-body'>
																	<p>Apakah Anda mau mengaktifkan paket soal ini?</p>
																	<input type='hidden' name='inputID' value='".$row["id"]."'>
																</div>
																<div class='modal-footer'>
																	<button type='submit' name='aktifkan' class='btn btn-success pull-right'>Aktifkan</button>
																</div>
															</form>
														</div>
													</div>
												</div>";
									} else if($row["aktif"] == "1") {
										echo "
												<a href='#modalAktif".$row["id"]."' class='btn btn-success' data-toggle='modal'>
													Aktif
												</a>
												<div class='modal fade' id='modalAktif".$row["id"]."' tabindex='-1' role='dialog' aria-labelledby='myModalLabel".$row["id"]."' aria-hidden='true'>
													<div class='modal-dialog'>
														<div class='modal-content'>
															<form method='post' action='aktifpaket.php'>
																<div class='modal-header'>
																	<button type='button' class='close' data-dismiss='modal'>
																		<span aria-hidden='true'>&times;</span>
																		<span class='sr-only'>Close</span>
																	</button>
																</div>
																<div class='modal-body'>
																	<p>Apakah Anda mau menonaktifkan paket soal ini?</p>
																	<input type='hidden' name='inputID' value='".$row["id"]."'>
																</div>
																<div class='modal-footer'>
																	<button type='submit' name='nonaktifkan' class='btn btn-danger pull-right'>Non-aktifkan</button>
																</div>
															</form>
														</div>
													</div>
												</div>";
									}
									echo "
											</td>
											<td>
												<a href='#modalPaket".$row["id"]."' class='btn btn-default' id='paketId' data-toggle='modal'>
													<span class='fa fa-search'></span>
												</a>
												<div class='modal fade' id='modalPaket".$row["id"]."' tabindex='-1' role='dialog' aria-labelledby='myModalLabel".$row["id"]."' aria-hidden='true'>
													<div class='modal-dialog modal-lg'>
														<div class='modal-content'>
															<div class='modal-header'>
																<button type='button' class='close' data-dismiss='modal'>
																	<span aria-hidden='true'>&times;</span>
																	<span class='sr-only'>Close</span>
																</button>
																<h4 class='modal-title' id='myModalLabel".$row["id"]."'>Lihat Paket Soal</h4>
															</div>
															<div class='modal-body'>
																<div class='row'>
																	<div class='col-sm-9'>
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
																	</div>
																	<div class='col-sm-3'>
																		<form action='tambahkepaket.php' method='post'>
																			<input type='hidden' name='kode' value='".$row["kode"]."'>
																			<button type='submit' name='edit' class='btn btn-primary pull-right'>Edit Paket Soal</button>
																		</form>
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
																</table>
															</div>
														</div>
													</div>
												</div>
											</td>
											<td>
												<a href='#modalDelete".$row["id"]."' class='btn btn-danger' id='paketId' data-toggle='modal'>
													<span class='fa fa-trash'></span>
												</a>
												<div class='modal fade' id='modalDelete".$row["id"]."' tabindex='-1' role='dialog' aria-labelledby='myModalLabel".$row["id"]."' aria-hidden='true'>
													<div class='modal-dialog'>
														<div class='modal-content'>
															<form method='post' action='delete_record.php'>
																<div class='modal-header'>
																	<button type='button' class='close' data-dismiss='modal'>
																		<span aria-hidden='true'>&times;</span>
																		<span class='sr-only'>Close</span>
																	</button>
																	<h4 class='modal-title' id='myModalLabel".$row["id"]."'>Hapus Paket Soal</h4>
																</div>
																<div class='modal-body'>
																	<p>Apakah Anda yakin ingin menghapus paket soal ini ?</p>
																	<input name='inputID' type='hidden' value='".$row["id"]."'>
																</div>
																<div class='modal-footer'>
																	<button type='submit' name='deletePaket' class='btn btn-danger pull-right'>Delete</button>
																</div>
															</form>
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
			</div>
		</div>
	</div>
	
	<script>
		var dropdown = document.getElementsByClassName("dropdown-btn");
		var i;
		
		for (i=0; i<dropdown.length; i++) {
			dropdown[i].addEventListener("click", function() {
				this.classList.toggle("active");
				var dropdownContent = this.nextElementSibling;
				if (dropdownContent.style.display === "block") {
					dropdownContent.style.display = "none";
				} else {
					dropdownContent.style.display = "block";
				}
			});
		}
		
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
		
		document.getElementById("bankSoal").click();
		
	</script>
	
	<?php else : ?>
		<p>
			<span class="error">Anda tidak berhak mengakses halaman ini.</span> Silakan <a href="../index.php">melakukan login</a>.
        </p>
	<?php endif; ?>
	
</body>
</html>

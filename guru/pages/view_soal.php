<?php 
	include_once '../includes/db_connect.php';
	include_once '../includes/functions.php';
	
	sec_session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>GURUKU | View Soal</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	
	<link href="../components/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="../components/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic" rel="stylesheet">
	<link href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css" rel="stylesheet">
	<link href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.bootstrap.min.css" rel="stylesheet">
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
	<script src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script>
	<script src="https://cdn.datatables.net/responsive/2.2.1/js/responsive.bootstrap.min.js"></script>
	
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
		.modal-img {
			display: none;
			position: fixed;
			z-index: 1;
			padding-top: 100px;
			left: 0;
			top: 0;
			width: 100%;
			height: 100%;
			overflow: auto;
			background-color: rgb(0, 0, 0);
			background-color: rgba(0, 0, 0, 0.9);
		}
		#imageSoal {
			margin: auto;
			display: block;
			width: 80%;
			max-width: 700px;
			-webkit-animation-name: zoom;
			-webkit-animation-duration: 0.6s;
			animation-name: zoom;
			animation-duration: 0.6s;
		}
		@-webkit-keyframes zoom {
			from {-webkit-transform: scale(0)}
			to {-webkit-transform: scale(1)}
		}
		@keyframes zoom {
			from {transform: scale(0)}
			to {transform: scale(1)}
		}
		#closeImage {
			position: absolute;
			top: 15px;
			right: 35px;
			color: #f1f1f1;
			font-size: 40px;
			font-weight: bold;
			transition: 0.3s;
		}
		#closeImage:hover, #closeImage:focus {
			color: #bbb;
			text-decoration: none;
			cursor: pointer;
		}
		@media only screen and (max-width: 700px){
			#imageSoal {
				width: 100%;
			}
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
						<li><a href="../includes/logout.php">Sign Out</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</nav>
	<div class="sidenav">
		<button class="dropdown-btn" id="bankSoal">
			<span class="fa fa-archive"></span> Bank Soal
			<i class="fa fa-caret-down"></i>
		</button>
		<div class="dropdown-container">
			<a href="paket.php"><span class="fa fa-book"></span> Paket Soal</a>
			<a href="#" class="active"><span class="fa fa-plus-square"></span> Tambah Soal</a>
		</div>
		<a href="mapel.php"><span class="fa fa-list-alt"></span> Mata Pelajaran</a>
	</div>
	
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-body">
				<a href="tambah_soal.php?type=add" class="btn btn-warning">
					<span class="fa fa-plus-circle"></span> Pilihan Ganda
				</a>
				<a href="tambah_soal.php?type=import" class="btn btn-primary">
					<span class="fa fa-upload"></span> Upload Soal
				</a>
				<br></br>
				<table id="example" class="table table-hover">
					<thead>
						<tr>
							<th>No.</th>
							<th>Pertanyaan</th>
							<th>Mata Pelajaran</th>
							<th>Bab</th>
							<th>Jenis</th>
							<th>Lihat</th>
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
							
							function cekJawab($jawab, $kunci) {
								$check = "";
								if($jawab == $kunci) {
									$check = "<i class='fa fa-lg fa-check' style='color:green'></i>";
								}
								return $check;
							}
							
							$sql = "SELECT soal.id, mapel.mapel, soal.soal, soal.bab, soal.jenis, soal.kategori, soal.kelas, soal.soal_gambar, soal.soal_video, soal.soal_audio, soal.jawab_A, soal.gambar_A, soal.jawab_B, soal.gambar_B, soal.jawab_C, soal.gambar_C, soal.jawab_D, soal.gambar_D, kunci.kunci FROM ((soal INNER JOIN mapel ON soal.id_mapel=mapel.id_mapel) INNER JOIN kunci ON soal.id=kunci.id_soal);";
							$result = $mysqli->query($sql);
							if($result->num_rows > 0) {
								$i = 1;
								while($row = $result->fetch_assoc()) {
									echo "
										<tr>
											<td>".$i."</td>
											<td>".$row["soal"]."</td>
											<td>".$row["mapel"]."</td>
											<td>".$row["bab"]."</td>
											<td>".jenisString($row["jenis"])."</td>
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
											<td>
												<a href='#modalDelete".$row["id"]."' class='btn btn-danger' id='soalId' data-toggle='modal'>
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
																	<h4 class='modal-title' id='myModalLabel".$row["id"]."'>Delete Soal</h4>
																</div>
																<div class='modal-body'>
																	<p>Apakah Anda yakin ingin menghapus soal ini ?</p>
																	<input name='inputID' type='hidden' value='".$row["id"]."'>
																</div>
																<div class='modal-footer'>
																	<button type='submit' name='deleteSoal' class='btn btn-danger pull-right'>Delete</button>
																</div>
															</form>
														</div>
													</div>
												</div>
											</td>
										</tr>";
									$i++;
								}
							}
						?>
					</tbody>
				</table>
				<?php
					/*echo "
						<div class='modal modal-img' id='imageModal".$row["id"]."'>
							<span class='close' id='closeImage'>&times;</span>
							<img src='imageView.php?id=".$row["id"]."' class='modal-content' id='imageSoal'>
						</div>";*/
				?>
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
		
		document.getElementById("bankSoal").click();
		
		/*document.getElementById("imageModal").onclick = function() {
			document.getElementsByClassName("modal-img")[0].style.display = "block";
		}
		
		document.getElementById("closeImage").onclick = function() {
			document.getElementsByClassName("modal-img")[0].style.display = "none";
		}*/
		
	</script>
	<?php else : ?>
		<p>
			<span class="error">Anda tidak berhak mengakses halaman ini.</span> Silakan <a href="../index.php">melakukan login</a>.
        </p>
	<?php endif; ?>
</body>
</html>

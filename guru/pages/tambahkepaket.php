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
			font-size: 20px;
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
		.dropdown-container {
			display: none;
			background-color: #23516f;
			padding-left: 8px;
		}
		.fa-caret-down {
			float: right;
			padding-right: 8px;
		}
		.squaredOne {
			width: 28px;
			height: 28px;
			position: relative;
			margin: 20px auto;
			background: #fcfff4;
			background: -webkit-gradient(linear, left top, left bottom, from(#fcfff4), color-stop(40%, #dfe5d7), to(#b3bead));
			background: linear-gradient(to bottom, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
			-webkit-box-shadow: inset 0px 1px 1px white, 0px 1px 3px rgba(0, 0, 0, 0.5);
			box-shadow: inset 0px 1px 1px white, 0px 1px 3px rgba(0, 0, 0, 0.5);
		}
		.squaredOne label {
			width: 20px;
			height: 20px;
			position: absolute;
			top: 4px;
			left: 4px;
			cursor: pointer;
			background: -webkit-gradient(linear, left top, left bottom, from(#222222), to(#45484d));
			background: linear-gradient(to bottom, #222222 0%, #45484d 100%);
			-webkit-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.5), 0px 1px 0px white;
			box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.5), 0px 1px 0px white;
		}
		.squaredOne label:after {
			content: '';
			width: 16px;
			height: 16px;
			position: absolute;
			top: 2px;
			left: 2px;
			background: #27ae60;
			background: -webkit-gradient(linear, left top, left bottom, from(#27ae60), to(#145b32));
			background: linear-gradient(to bottom, #27ae60 0%, #145b32 100%);
			-webkit-box-shadow: inset 0px 1px 1px white, 0px 1px 3px rgba(0, 0, 0, 0.5);
			box-shadow: inset 0px 1px 1px white, 0px 1px 3px rgba(0, 0, 0, 0.5);
			opacity: 0;
		}
		.squaredOne label:hover::after {
			opacity: 0.3;
		}
		.squaredOne input[type=checkbox] {
			visibility: hidden;
		}
		.squaredOne input[type=checkbox]:checked + label:after {
			opacity: 1;
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
	
	<?php
		if(isset($_POST['save'])) {
			$nama = $_POST['inputNama'];
			$mapel = $_POST['inputMapel'];
			$kelas = $_POST['inputKelas'];
			$waktu = $_POST['inputWaktu'];
			$kode = $_POST['inputKode'];
			
			$sql = "SELECT mapel FROM mapel WHERE id_mapel=".$mapel.";";
			$result = $mysqli->query($sql);
			$mpl = $result->fetch_assoc();
			$mapelString = $mpl["mapel"];
		}
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
			<input name="inputWaktu" type="hidden" value="<?php echo $waktu; ?> Menit">
			<input name="inputKode" type="hidden" value="<?php echo $kode; ?>">
			<hr>
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
				echo "<table id='example' class='table table-hover'>
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
				<tbody>";
				mysqli_free_result($result);
				$sql = "SELECT soal.id, soal.soal, soal.bab, soal.jenis, soal.kategori FROM soal WHERE id_mapel='".$mapel."';";
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
									<a href='#modalSoal' class='btn btn-default' id='soalId' data-toggle='modal' data-id='".$row["id"]."'>
										<span class='fa fa-search'></span>
									</a>
									<div class='modal fade' id='modalSoal' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
										<div class='modal-dialog'>
											<div class='modal-content'>
												<div class='modal-header'>
													<button type='button' class='close' data-dismiss='modal'>
														<span aria-hidden='true'>&times;</span>
														<span class='sr-only'>Close</span>
													</button>
													<h4 class='modal-title' id='myModalLabel'>Lihat Soal</h4>
												</div>
												<div class='modal-body'>
													<div class='fetched-data'></div>
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
				echo "<tbody></table>";
				echo "<hr>";
				echo "<button type='submit' name='save' class='btn btn-primary btn-lg'>Save</button>";
				echo "</form>";
			?>
	</div>
	<br></br>
	<script>
		$(document).ready(function() {
			$('#example').DataTable();
		});
		
		$(document).ready(function() {
			$('#modalSoal').on('show.bs.modal', function(e) {
				var rowid = $(e.relatedTarget).data('id');
				$.ajax({
					type : 'post',
					url : 'fetch_record.php',
					data : 'rowid=' + rowid,
					success : function(data) {
						$('.fetched-data').html(data);
					}
				});
			});
		});
	</script>
	
	<?php else : ?>
		<p>
			<span class="error">Anda tidak berhak mengakses halaman ini.</span> Silakan <a href="../index.php">melakukan login</a>.
        </p>
	<?php endif; ?>
	
</body>
</html>

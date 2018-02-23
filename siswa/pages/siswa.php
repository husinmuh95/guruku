<?php 
	include_once '../includes/db_connect.php';
	include_once '../includes/functions.php';
	
	sec_session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>GURUKU | Student</title>
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
		.button {
			padding: 15px 100px;
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
		<a href="#" class="active"><span class="fa fa-home"></span> Home</a>
		<a href="hasil.php"><span class="fa fa-briefcase"></span> Hasil</a>
	</div>
	
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-body">
				<h3>Masukkan Kode Soal :</h3>
				<form class="form-horizontal" method="post" action="siswa.php">
					<div class="row">
						<div class="col-sm-3">
							<input class="form-control" type="text" name="inputKode" placeholder="Masukkan Kode Soal"/>
						</div>
						<div class="col-sm-9">
							<button type="submit" name="submit" class="btn btn-primary">Submit</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<hr>
		<?php if(isset($_POST['submit'])) : ?>
			<?php
				$kode = $_POST['inputKode'];
				$sql = "SELECT paket.nama, mapel.mapel, paket.kelas, paket.waktu, paket.soal FROM paket INNER JOIN mapel ON paket.id_mapel=mapel.id_mapel WHERE paket.kode='".$kode."';";
				$result = $mysqli->query($sql);
				$row = $result->fetch_assoc();
			?>
			<div class="panel panel-default">
				<div class="panel-body">
					<h3>Mulai Mengerjakan Soal :</h3><br>
					<div class='row'>
						<div class='col-sm-3'>
							<p><strong>Nama Paket Soal</strong></p>
						</div>
						<div class='col-sm-1'>
							<p>:</p>
						</div>
						<div class='col-sm-8'>
							<p><?php echo $row['nama']; ?></p>
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
							<p><?php echo $row['kelas']; ?></p>
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
							<p><?php echo $row['mapel']; ?></p>
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
							<p><?php echo $row['waktu']; ?> Menit</p>
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
							<p><?php echo count(explode(" ",$row["soal"])); ?></p>
						</div>
					</div>
					<form method="post" action="mulai_soal.php">
						<input type="hidden" name="inputKode" value="<?php echo $kode; ?>"/>
						<input type="hidden" name="waktu" value="<?php echo $row['waktu']; ?>"/>
						<button type="submit" name="mulai" class="button btn btn-primary btn-lg">Mulai</button>
					</form>
				</div>
			</div>
		<?php endif; ?>
	</div>
	
	
	<?php else : ?>
		<p>
			<span class="error">Anda tidak berhak mengakses halaman ini.</span> Silakan <a href="../index.php">melakukan login</a>.
        </p>
	<?php endif; ?>
	
</body>
</html>
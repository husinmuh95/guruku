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
		<a href="siswa.php"><span class="fa fa-home"></span> Home</a>
		<a href="#" class="active"><span class="fa fa-briefcase"></span> Hasil</a>
	</div>
	
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-body">
				<table id="example" class="table table-hover">
					<thead>
						<tr>
							<th>No.</th>
							<th>Nama Paket Soal</th>
							<th>Mata Pelajaran</th>
							<th>Jumlah Benar</th>
							<th>Jumlah Salah</th>
							<th>Nilai</th>
							<th>Lihat</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$sql = "SELECT paket.nama, mapel.mapel, hasil.jmlBenar, hasil.jmlSalah, hasil.nilai FROM ((hasil 
										INNER JOIN paket ON hasil.kode_paket = paket.kode)
										INNER JOIN mapel ON paket.id_mapel = mapel.id_mapel);";
							$result = $mysqli->query($sql);
							if($result->num_rows > 0) {
								$i = 1;
								while($row = $result->fetch_assoc()) {
									echo "
										<tr>
											<td>".$i."</td>
											<td>".$row["nama"]."</td>
											<td>".$row["mapel"]."</td>
											<td>".$row["jmlBenar"]."</td>
											<td>".$row["jmlSalah"]."</td>
											<td>".$row["nilai"]."</td>
											<td>NONE</td>
										</tr>";
									$i++;
								}
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	
	<script>
	
		$(document).ready(function() {
			$('#example').DataTable();
		});
		
	</script>
	
	<?php else : ?>
		<p>
			<span class="error">Anda tidak berhak mengakses halaman ini.</span> Silakan <a href="../index.php">melakukan login</a>.
        </p>
	<?php endif; ?>
	
</body>
</html>
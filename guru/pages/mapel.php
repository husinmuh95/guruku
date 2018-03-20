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
						<li><a href="profil">Profile</a></li>
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
			<a href="paket.php"><span class="fa fa-book"></span> Paket Soal</a>
			<a href="view_soal.php"><span class="fa fa-plus-square"></span> Daftar Soal</a>
		</div>
		<a href="#" class="active"><span class="fa fa-list-alt"></span> Mata Pelajaran</a>
	</div>
	
	<div class="container-fluid">
		<div class="panel panel-default">
			<div class="panel-body">
				<table id="example" class="table table-hover">
					<thead>
						<th>No.</th>
						<th>ID Mata Pelajaran</th>
						<th>Mata Pelajaran</th>
						<th>Detail</th>
					</thead>
					<tbody>
						<?php
							$sql = "SELECT id_mapel, mapel FROM mapel;";
							$result = $mysqli->query($sql);
							if($result->num_rows > 0) {
								$i = 1;
								while($row = $result->fetch_assoc()) {
									echo "
										<tr>
											<td>".$i."</td>
											<td>".$row["id_mapel"]."</td>
											<td>".$row["mapel"]."</td>
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
		
	</script>
	
	<?php else : ?>
		<p>
			<span class="error">Anda tidak berhak mengakses halaman ini.</span> Silakan <a href="../index.php">melakukan login</a>.
        </p>
	<?php endif; ?>
	
</body>
</html>

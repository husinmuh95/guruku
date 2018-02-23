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
			padding-top: 20px;
			padding-bottom: 100px;
		}
		.container-fluid {
			padding-left: 20px;
			padding-right: 270px;
		}
		.navbar {
			background-color: #1a3547;
			border: none;
			position: fixed;
			bottom: 0;
			width: 78%;
			height: 15%;
			overflow: hidden;
			text-align: center;
		}
		.sidenav {
			height: 100%;
			width: 250px;
			position: fixed;
			z-index: 1;
			top: 0;
			right: 0;
			background-color: #dbdbdb;
			overflow-x: hidden;
			padding-top: 20px;
			padding-bottom: 60px;
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
		.panel-body {
			text-align: center;
		}
		.btn-soal {
			margin-left: 3px;
			margin-right: 3px;
			margin-top: 3px;
			margin-bottom: 3px;
			width: 37px;
			text-align: center;
		}
		.soalContent {
			display: none;
			padding: 10px 20px;
			border: 1px solid #ccc;
		}
		#timer {
			font-size: 50px;
			padding: 6px 8px 6px 16px;
		}
		.pilihan {
			display: block;
			position: relative;
			padding-left: 35px;
			margin-bottom: 12px;
			cursor: pointer;
			font-size: 18px;
			-webkit-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
			user-select: none;
		}
		.pilihan input {
			position: absolute;
			opacity: 0;
			cursor: pointer;
		}
		.checkmark {
			position: absolute;
			top: 0;
			left: 0;
			height: 25px;
			width: 25px;
			background-color: #eee;
			border-radius: 50%;
		}
		.pilihan:hover input ~ .checkmark {
			background-color: #ccc;
		}
		.pilihan input:checked ~ .checkmark {
			background-color: #2196F3;
		}
		.checkmark:after {
			content: "";
			position: absolute;
			display: none;
		}
		.pilihan input:checked ~ .checkmark:after {
			display: block;
		}
		.pilihan .checkmark:after {
			top: 9px;
			left: 9px;
			width: 8px;
			height: 8px;
			border-radius: 50%;
			background: white;
		}
		#selesai {
			display: none;
		}
		.btn-selesai {
			position: absolute;
			bottom: 0;
			padding: 14px 70px;
			font-size: 20px;
			margin-bottom: 20px;
			margin-left: 20px;
		}
		.prev {
			margin-top: 25px;
			font-size: 20px;
			padding-left: 50px;
			text-align: center;
		}
		.next {
			margin-top: 25px;
			font-size: 20px;
			padding-right: 50px;
			text-align: center;
		}
		.flexible {
			display: flex;
			flex-flow: row wrap;
			justify-content: center;
		}
		#defaultPilihan {
			display: none;
		}
		.img-responsive {
			border-radius: 5px;
			cursor: pointer;
			transition: 0.3s;
		}
		.img-responsive:hover {
			opacity: 0.7;
		}
		.modal {
			display: none;
			position: fixed;
			z-index: 1;
			padding-top: 100px;
			left: 0;
			top: 0;
			width: 100%;
			height: 100%;
			overflow: auto;
			background-color: rgb(0,0,0);
			background-color: rgba(0,0,0,0.9);
		}
		.modal-content {
			margin: auto;
			display: block;
			width: 80%;
			max-width: 700px;
			animation-name: zoom;
			animation-duration: 0.6s;
		}
		@keyframes zoom {
			from {
				transform: scale(0);
			}
			to {
				transform: scale(1);
			}
		}
		.close {
			position: absolute;
			top: 15px;
			right: 35px;
			color: #f1f1f1;
			font-size: 40px;
			font-weight: bold;
			transition: 0.3s;
		}
		.close:hover, .close:focus {
			color: #bbb;
			text-decoration: none;
			cursor: pointer;
		}
		@media only screen and (max-width: 700px) {
			.modal-content {
				width: 100%;
			}
		}
	</style>
	
</head>
<body>
	<?php if(login_check($mysqli) == true) : ?>
	<?php 
		if(isset($_GET['kode'])) {
			$kode = $_GET['kode'];
			$sql = "SELECT jawab.mulai, paket.waktu, paket.soal FROM jawab INNER JOIN paket ON jawab.kode_paket=paket.kode WHERE jawab.username='".htmlentities($_SESSION['username'])."' AND jawab.kode_paket='".$kode."';";
			$result = $mysqli->query($sql);
			$res = $result->fetch_assoc();
			$mulai = $res["mulai"];
			$waktu = $res["waktu"];
			$soal = explode(" ", $res["soal"]);
			mysqli_free_result($result);
			$getSoal = "SELECT id, soal, tipe_soal_gambar, soal_gambar, jawab_A, jawab_B, jawab_C, jawab_D FROM soal WHERE ";
			for($i=0; $i<count($soal)-1; $i++) {
				$getSoal .= "id=".$soal[$i]." OR ";
			}
			$getSoal .= "id=".$soal[count($soal)-1].";";
			$result = $mysqli->query($getSoal);
			$numSoal = 0;
			$soalView = array();
			$idSoal = array();
			if($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					$idSoal[$numSoal] = $row['id'];
					$soalView[$numSoal][0] = $row['soal'];
					$soalView[$numSoal][1] = $row['tipe_soal_gambar'];
					$soalView[$numSoal][2] = $row['soal_gambar'];
					$soalView[$numSoal][3] = $row['jawab_A'];
					$soalView[$numSoal][4] = $row['jawab_B'];
					$soalView[$numSoal][5] = $row['jawab_C'];
					$soalView[$numSoal][6] = $row['jawab_D'];
					$numSoal++;
				}
			}
		}
	?>
	<div class="container-fluid">
		<div class="navbar">
			<button type="button" class="btn btn-default btn-lg prev" onclick="prevSoal()"><span class="fa fa-caret-left"></span></button>
			<button type="button" class="btn btn-default btn-lg next" onclick="nextSoal()"><span class="fa fa-caret-right"></span></button>
		</div>
	</div>
	<div class="sidenav">
		<p id="timer"></p>
		<hr>
		<div class="panel panel-default">
			<div class="panel-body flexible">
				<button type="button" class="btn btn-default btn-soal" onclick="openSoal(event, '0')" id="defaultOpen">1</button>
				<?php for($i=1; $i<count($soal); $i++) : ?>
					<button type="button" class="btn btn-default btn-soal" onclick="openSoal(event, '<?php echo $i; ?>')"><?php echo ($i+1); ?></button>
				<?php endfor; ?>
			</div>
		</div>
		<p id="demo"></p>
		<button type="button" class="btn btn-danger btn-selesai" data-toggle="modal" data-target="#modalSelesai">Selesai</button>
	</div>
	
	<div class="modal fade" id="modalSelesai" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true">&times;</span>
						<span class="sr-only">Close</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">Selesai Mengerjakan</h4>
				</div>
				<div class="modal-body">
					<p>Apakah Anda yakin sudah selesai mengerjakan ?</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary pull-right" data-dismiss="modal">No</button>
					<button type="button" class="btn btn-primary pull-left" onclick="selesaiSoal()">Yes</button>
				</div>
			</div>
		</div>
	</div>
	
	<div class="container-fluid">
		<form action="selesai_soal.php" method="post">
			<?php for($i=0; $i<count($soal); $i++) : ?>
				<div class="soalContent" id="<?php echo $i; ?>">
					<?php if(!empty($soalView[$i][2])) : ?>
						<div class="row">
							<div class="col-sm-9">
								<h2><?php echo ($i+1); ?></h2>
								<h4><?php echo $soalView[$i][0]; ?></h4>
							</div>
							<div class="col-sm-3">
								<img class="img-responsive" id="imageSoal" src="data:<?php echo $soalView[$i][1]; ?>; base64, <?php echo base64_encode($soalView[$i][2]); ?>" width="250" onclick="openImage(event, 'modalImage<?php echo $idSoal[$i]; ?>')">
								<div id="modalImage<?php echo $idSoal[$i]; ?>" class="modal">
									<span class="close" id="closeModal" onclick="closeImage(event, 'modalImage<?php echo $idSoal[$i]; ?>')">&times;</span>
									<img class="modal-content" id="imageInModal<?php echo $idSoal[$i]; ?>" src="data:<?php echo $soalView[$i][1]; ?>; base64, <?php echo base64_encode($soalView[$i][2]); ?>" width="100%">
								</div>
							</div>
						</div>
					<?php else : ?>
						<h2><?php echo ($i+1); ?></h2>
						<h4><?php echo $soalView[$i][0]; ?></h4>
					<?php endif; ?>
					<hr>
					<input type="radio" id="defaultPilihan" name="pilih<?php echo $i; ?>" value="0" checked="checked">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="pilihan"><?php echo $soalView[$i][3]; ?>
									<input type="radio" name="pilih<?php echo $i; ?>" value="1">
									<span class="checkmark"></span>
								</label>
							</div>
							<br>
							<div class="form-group">
								<label class="pilihan"><?php echo $soalView[$i][4]; ?>
									<input type="radio" name="pilih<?php echo $i; ?>" value="2">
									<span class="checkmark"></span>
								</label>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="pilihan"><?php echo $soalView[$i][5]; ?>
									<input type="radio" name="pilih<?php echo $i; ?>" value="3">
									<span class="checkmark"></span>
								</label>
							</div>
							<br>
							<div class="form-group">
								<label class="pilihan"><?php echo $soalView[$i][6]; ?>
									<input type="radio" name="pilih<?php echo $i; ?>" value="4">
									<span class="checkmark"></span>
								</label>
							</div>
						</div>
					</div>
				</div>
			<?php endfor; ?>
			<input type="hidden" name="kode" value="<?php echo $kode; ?>"/>
			<input type="hidden" name="jmlSoal" value="<?php echo count($soal); ?>"/>
			<button id="selesai" type="submit" name="selesai">Selesai</button>
		</form>
	</div>
	
	<script>
		var countDownDate = new Date("<?php echo $mulai; ?>").getTime() + (<?php echo $waktu; ?> * 60000) + 5000;
		var x = setInterval(function() {
			var now = new Date().getTime();
			var distance = countDownDate - now;
			var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
			var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
			var seconds = Math.floor((distance % (1000 * 60)) / 1000);
			document.getElementById("timer").innerHTML = hours + " : " + minutes + " : " + seconds;
			if(distance < 0) {
				clearInterval(x);
				document.getElementById("timer").innerHTML = "EXPIRED";
			}
		}, 1000);
		
		function openSoal(evt, id) {
			var i, soalContent, btnSoal;
			soalContent = document.getElementsByClassName("soalContent");
			for(i=0; i<soalContent.length; i++) {
				soalContent[i].style.display = "none";
			}
			btnSoal = document.getElementsByClassName("btn-soal");
			for(i=0; i<btnSoal.length; i++) {
				btnSoal[i].className = btnSoal[i].className.replace(" active", "");
			}
			document.getElementById(id).style.display = "block";
			evt.currentTarget.className += " active";
		}

		function openImage(evt, id) {
			var i, imageSoal, modalImage, imageInModal;
			imageSoal = document.getElementsByClassName("img-responsive");
			modalImage = document.getElementsByClassName("modal");
			for(i=0; i<modalImage.length; i++) {
				modalImage[i].style.display = "none";
			}
			document.getElementById(id).style.display = "block";
		}

		$(document).ready(function() {
			$('.modal').on('show.bs.modal', function(e) {

			})
		})

		function closeImage(evt, id) {
			document.getElementById(id).style.display = "none";
		}
		
		document.getElementById("defaultOpen").click();	
		
		function nextSoal() {
			var panel = document.getElementsByClassName("panel-body");
			var active = panel[0].getElementsByClassName("active");
			var next = parseInt(active[0].innerHTML);
			var btnSoal = document.getElementsByClassName("btn-soal");
			btnSoal[next].click();
		}
		
		function prevSoal() {
			var panel = document.getElementsByClassName("panel-body");
			var active = panel[0].getElementsByClassName("active");
			var current = parseInt(active[0].innerHTML);
			var prev = current - 2;
			var btnSoal = document.getElementsByClassName("btn-soal");
			btnSoal[prev].click();
		}
		
		function selesaiSoal() {
			document.getElementById("selesai").click();
		}

		/*var jmlSoal = document.getElementsByClassName("soalContent").length;
		document.
		
		var modal = document.getElementById("modalImage");
		var img = document.getElementById("imageSoal");
		var modalImg = document.getElementById("imageInModal");
		img.onclick = function() {
			modal.style.display = "block";
			modalImg.src = this.src;
		}
		var span = document.getElementById("closeModal");
		span.onclick = function() {
			modal.style.display = "none";
		}*/
		var soal = document.getElementsByClassName("soalContent");
		/*var i;
		var modal = [];
		var img = [];
		var modalImg = [];
		var span = [];
		for(i=0; i<soal.length; i++) {
			modal = soal[i].getElementById("modalImage");
			img = soal[i].getElementById("imageSoal");
			modalImg = soal[i].getElementById("imageInModal");
			img.onclick = function() {
				modal.style.display = "block";
				modalImg.src = this.src;
			}
			span = soal[i].getElementsByClassName("close")[0];
			span.onclick = function() {
				modal.style.display = "none";
			}
		}*/

	</script>
	
	<?php else : ?>
		<p>
			<span class="error">Anda tidak berhak mengakses halaman ini.</span> Silakan <a href="../index.php">melakukan login</a>.
        </p>
	<?php endif; ?>
	
</body>
</html>
<?php 
	include_once '../includes/db_connect.php';
	include_once '../includes/functions.php';
	
	sec_session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>GURUKU | Tambah Soal</title>
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
		.fileUpload {
			position: relative;
			overflow: hidden;
			margin: 5px;
			background-color: #BDBDBD;
			height: 150px;
			width: 150px;
			text-align: center;
		}
		.fileUpload input.upload {
			position: absolute;
			top: 0;
			right: 0;
			margin: 0;
			padding: 0;
			font-size: 20px;
			cursor: pointer;
			opacity: 0;
			filter: alpha(opacity=0);
			height: 100%;
			text-align: center;
		}
		.custom-span {
			font-weight: bold;
			font-size: 70px;
			color: DodgerBlue;
		}
		#uploadFile {
			border: none;
			margin-left: 10px;
			width: 150px;
		}
		.custom-para {
			font-weight: bold;
			font-size: 18px;
			color: #585858;
			text-align: center;
		}
		.switch {
			position: relative;
			display: inline-block;
			width: 60px;
			height: 34px;
		}
		.switch input {
			display: none;
		}
		.slider {
			position: absolute;
			cursor: pointer;
			top: 0;
			left: 0;
			right: 0;
			bottom: 0;
			background-color: #ccc;
			-webkit-transition: .4s;
			transition: .4s;
		}
		.slider:before {
			position: absolute;
			content: "";
			height: 26px;
			width: 26px;
			left: 4px;
			bottom: 4px;
			background-color: white;
			-webkit-transition: .4s;
			transition: .4s;
		}
		input:checked + .slider {
			background-color: #2196F3;
		}
		input:checked + .slider {
			box-shadow: 0 0 1px #2196F3;
		}
		input:checked + .slider:before {
			-webkit-transform: translateX(26px);
			-ms-transform: translateX(26px);
			transform: translateX(26px);
		}
		.slider.round {
			border-radius: 34px;
		}
		.slider.round:before {
			border-radius: 50%;
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
		<?php if(isset($_GET['type'])) : ?>
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
			<?php if($_GET['type'] == 'import') : ?>
				<div class="container-fluid">
					<a href="view_soal.php" class="btn btn-danger pull-right">
						<span class="fa fa-times"></span> Cancel
					</a>
					<h3>Form Import Soal</h3>
					<hr>
					<form method="post" action="" enctype="multipart/form-data">
						<input type="file" name="file" class="pull-left">
						<button type="submit" name="preview" class="btn btn-success">
							<span class="fa fa-eye"></span> Preview
						</button>
					</form>
					<hr>
					<?php
						function mapelString($mapel) {
							$mapelStr = "";
							switch($mapel) {
								case 1 :
									$mapelStr = "Matematika";
									break;
								case 2 :
									$mapelStr = "Fisika";
									break;
							}
							return $mapelStr;
						}
						
						function jenisString($jenis) {
							$jenisStr = "";
							switch($jenis) {
								case 1 :
									$jenisStr = "Pilihan Ganda";
									break;
								case 2 :
									$jenisStr = "Esai";
									break;
							}
							return $jenisStr;
						}
						
						if(isset($_POST['preview'])) {
							$nama_file_baru = 'data.xlsx';
							if(is_file('tmp/'.$nama_file_baru))
								unlink('tmp/'.$nama_file_baru);
							$tipe_file = $_FILES['file']['type'];
							$tmp_file = $_FILES['file']['tmp_name'];
							if($tipe_file == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet") {
								move_uploaded_file($tmp_file, 'tmp/'.$nama_file_baru);
								require_once 'PHPExcel/PHPExcel.php';
								$excelreader = new PHPExcel_Reader_Excel2007();
								$loadexcel = $excelreader->load('tmp/'.$nama_file_baru);
								$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true, true);
								
								echo "<form method='post' action='add_soal.php'>";
								echo "<table class='table table-bordered'>
								<tr>
									<th colspan='4' class='text-center'>Preview Data</th>
								</tr>
								<tr>
									<th>Pertanyaan</th>
									<th>Mata Pelajaran</th>
									<th>Bab</th>
									<th>Jenis</th>
								</tr>";
								
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
									if($numrow > 3) {
										echo "<tr>";
										echo "<td>".$soal."</td>";
										echo "<td>".mapelString($mapel)."</td>";
										echo "<td>".$bab."</td>";
										echo "<td>".jenisString($jenis)."</td>";
										echo "</tr>";
									}
									$numrow++;
								}
								echo "</table>";
								echo "<hr>";
								echo "<button type='submit' name='import' class='btn btn-primary'><span class='fa fa-upload'></span> Import</button>";
								echo "</form>";
							}
						}
					?>
				</div>
				<br></br>
			<?php elseif($_GET['type'] == 'add') : ?>
				<div class="container-fluid">
					<a href="view_soal.php" class="btn btn-danger pull-right">
						<span class="fa fa-times"></span> Cancel
					</a>
					<h3>Form Tambah Soal</h3>
					<hr>
					<form action="add_soal.php" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<div class="row">
								<label class="control-label col-sm-2" for="inputMapel">Mata Pelajaran</label>
								<div class="col-sm-10">
									<div class="custom-select" style="width:200px;">
										<select name="inputMapel">
											<option value="0">Mata Pelajaran</option>
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
								<label class="control-label col-sm-2" for="inputKelas">Kelas</label>
								<div class="col-sm-10">
									<div class="custom-select" style="width:200px;">
										<select name="inputKelas">
											<option value="0">Kelas</option>
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
								<label class="control-label col-sm-2" for="inputKategori">Tingkat Kesulitan</label>
								<div class="col-sm-10">
									<div class="custom-select" style="width:200px;">
										<select name="inputKategori">
											<option value="0">Kategori</option>
											<option value="1">Mudah</option>
											<option value="2">Sedang</option>
											<option value="3">Sulit</option>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label" for="inputBab">Bab :</label>
							<input type="text" class="form-control" name="inputBab" style="width:650px;"/>
						</div>
						<div class="row">
							<div class="form-group col-sm-6">
								<label class="control-label" for="inputSoal">Soal :</label>
								<textarea class="form-control" rows="7" name="inputSoal"></textarea>
							</div>
							<div class="form-group col-sm-2">
								<div class="fileUpload">
									<span class="custom-span">+</span>
									<p class="custom-para">Add Images</p>
									<input id="uploadBtn" type="file" class="upload" name="soalGambar"/>
								</div>
								<input id="uploadFile" placeholder="0 files selected" disabled="disabled"/>
							</div>
							<div class="form-group col-sm-2">
								<div class="fileUpload">
									<span class="custom-span">+</span>
									<p class="custom-para">Add Video</p>
									<input id="uploadBtn" type="file" class="upload" name="soalVideo"/>
								</div>
								<input id="uploadFile" placeholder="0 files selected" disabled="disabled"/>
							</div>
							<div class="form-group col-sm-2">
								<div class="fileUpload">
									<span class="custom-span">+</span>
									<p class="custom-para">Add Audio</p>
									<input id="uploadBtn" type="file" class="upload" name="soalAudio"/>
								</div>
								<input id="uploadFile" placeholder="0 files selected" disabled="disabled"/>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="form-group col-sm-1">
								<p>Jawab A</p>
								<label class="switch">
									<input type="radio" name="kunci" value="1">
									<span class="slider round"></span>
								</label>
							</div>
							<div class="form-group col-sm-2">
								<div class="fileUpload">
									<span class="custom-span">+</span>
									<p class="custom-para">Add Image</p>
									<input id="uploadBtn" type="file" class="upload" name="gambar_A"/>
								</div>
								<input id="uploadFile" placeholder="0 files selected" disabled="disabled"/>
							</div>
							<div class="form-group col-sm-6">
								<textarea class="form-control" rows="5" name="jawab_A"></textarea>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-sm-1">
								<p>Jawab B</p>
								<label class="switch">
									<input type="radio" name="kunci" value="2">
									<span class="slider round"></span>
								</label>
							</div>
							<div class="form-group col-sm-2">
								<div class="fileUpload">
									<span class="custom-span">+</span>
									<p class="custom-para">Add Image</p>
									<input id="uploadBtn" type="file" class="upload" name="gambar_B"/>
								</div>
								<input id="uploadFile" placeholder="0 files selected" disabled="disabled"/>
							</div>
							<div class="form-group col-sm-6">
								<textarea class="form-control" rows="5" name="jawab_B"></textarea>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-sm-1">
								<p>Jawab C</p>
								<label class="switch">
									<input type="radio" name="kunci" value="3">
									<span class="slider round"></span>
								</label>
							</div>
							<div class="form-group col-sm-2">
								<div class="fileUpload">
									<span class="custom-span">+</span>
									<p class="custom-para">Add Image</p>
									<input id="uploadBtn" type="file" class="upload" name="gambar_C"/>
								</div>
								<input id="uploadFile" placeholder="0 files selected" disabled="disabled"/>
							</div>
							<div class="form-group col-sm-6">
								<textarea class="form-control" rows="5" name="jawab_C"></textarea>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-sm-1">
								<p>Jawab D</p>
								<label class="switch">
									<input type="radio" name="kunci" value="4">
									<span class="slider round"></span>
								</label>
							</div>
							<div class="form-group col-sm-2">
								<div class="fileUpload">
									<span class="custom-span">+</span>
									<p class="custom-para">Add Image</p>
									<input id="uploadBtn" type="file" class="upload" name="gambar_D"/>
								</div>
								<input id="uploadFile" placeholder="0 files selected" disabled="disabled"/>
							</div>
							<div class="form-group col-sm-6">
								<textarea class="form-control" rows="5" name="jawab_D"></textarea>
							</div>
						</div>
						<hr>
						<button type="submit" name="simpan" class="block"><span class="fa fa-save"></span> Simpan Soal</button>
					</form>
				</div>
			<?php endif; ?>
		<?php endif; ?>
		
		<script>
		
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
		
			document.getElementById("uploadBtn").onchange = function() {
				document.getElementById("uploadFile").value = this.value;
			};
			
		</script>
	<?php else : ?>
		<p>
			<span class="error">Anda tidak berhak mengakses halaman ini.</span> Silakan <a href="../index.php">melakukan login</a>.
        </p>
	<?php endif; ?>
</body>
</html>
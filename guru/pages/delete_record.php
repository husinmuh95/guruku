<?php 

	include_once "../includes/db_connect.php";
	include_once "../includes/functions.php";
	
	sec_session_start();
	
	if(login_check($mysqli) == true) {
		if(isset($_POST['deleteSoal'])) {
			$deleteID = $_POST['inputID'];
			mysqli_autocommit($mysqli, FALSE);
			mysqli_query($mysqli, "DELETE FROM kunci WHERE id_soal=".$deleteID.";");
			mysqli_query($mysqli, "DELETE FROM soal WHERE id=".$deleteID.";");
			mysqli_commit($mysqli);
			header('location: view_soal.php');
		}
		
		if(isset($_POST['paketid'])) {
			$id = $_POST['paketid'];
			echo "
				<form class='form-horizontal' method='post' action='delete_record.php'>
					<div class='form-group'>
						<label class='col-sm-4 control-label'>ID Paket</label>
						<div class='col-sm-8'>
							<input class='form-control' name='inputID' type='text' value='".$id."'>
						</div>
					</div>
					<button type='submit' name='deletePaket' class='btn btn-danger pull-right'>Delete</button>
				</form>";
		}
		
		if(isset($_POST['deletePaket'])) {
			$deleteID = $_POST['inputID'];
			mysqli_autocommit($mysqli, FALSE);
			mysqli_query($mysqli, "DELETE FROM paket WHERE id=".$deleteID.";");
			mysqli_commit($mysqli);
			header('location: paket.php');
		}
	} else {
		echo '
			<p>
				<span class="error">Anda tidak berhak mengakses halaman ini.</span> Silakan <a href="../index.php">melakukan login</a>.
			</p>';
	}
?>
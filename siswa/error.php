<?php 
	
	$error = filter_input(INPUT_GET, 'err', $filter = FILTER_SANITIZE_STRING);
	
	if(!$error) {
		$error = "Ups! Something's wrong.";
	}
	
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Secure Login: Error</title>
</head>
<body>
	<h1>Ada masalah</h1>
	<p class="error"><?php echo $error; ?></p>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Process Data</title>
</head>
<body>
	<!-- menampilkan data dari processData_form.html -->
	<!-- data dikirim lewat method POST -->
	<!-- ditampilkan satu per satu pakai foreach -->


<h3>Posted data: </h3>
<?php
foreach ($_POST as $key => $value)
	echo "($key) => ($value)<br/>";

//$surname = $_POST['surname'];
?>
</body>
</html>

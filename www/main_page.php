<!DOCTYPE html>
<html lang="en">
<head>
	 <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Document</title>
	<link rel="stylesheet" href="css/main_page_style.css">
</head>
<body>
	<div class="main-container">
		<?php 
			include("table.php");

			$dataBase = new DAtaBase();
			$dataBase-> connectDB("control_system_project");
			$dataBase-> getAllDataView();
		?>
	</div>
</body>
</html>
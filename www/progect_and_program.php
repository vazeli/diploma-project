<?php include("table.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="css/main_page_style.css">
</head>
<body>
	<?php 
			$dataBase = new DAtaBase();
		$dataBase-> connectDB("control_system_project");
		$dataBase-> getAllProjectAndProgram();
	 ?>
</body>
</html>
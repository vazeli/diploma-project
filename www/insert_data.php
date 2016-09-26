<?php
session_start();
include("table.php");
$data = new dataToDB();
$dataBase = new DataBase();
$dataBase-> connectDB("control_system_project");

//	insert data //
$_SESSION["insert"] = false;
$_SESSION["delete"] = false;
if(isset($_POST['insert']) && $_SESSION["insert"] === false){
	$_SESSION["insert"] = true;
	
	//$data-> replaceNameProgram();
	
	//$data-> printArray();


	$data-> getDataFile("files/customer.txt");
	$data-> toArray(2);
	//$data-> printArray();
	$dataBase-> insertDataToCustomer($data->getData());

		$data-> getDataFile("files/3.txt");
	$data-> toArray(1);
	$dataBase-> insertDataToProject($data->getData());
	//	$data-> printArray();

}

//	delete data //
if(isset($_POST['delete']) && $_SESSION["delete"] === false){
	$_SESSION["delete"] = true;
	$dataBase->clearAllData();
}

$dataBase->closeDB();
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>Document</title>
	<link rel="stylesheet" href="css/style.css" />
</head>
<body>
	<div class="main">
		<div class="inset-form">
			<a target="_blank" href="http://localhost/Tools/phpMyAdmin/index.php?db=control_system_project&token=404e73f369b94c5025b312ddbb640146">phpMyAdmin</a>
			<form action="" method="POST">
				<p>Insert all data to DB</p>
				<input type="submit" name="insert" />
				<p>Delete all data from DB</p>
				<input type="submit" name="delete" />
			</form>
		</div>
	</div>
</body>
</html>



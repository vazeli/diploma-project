<?php 
	include("table.php");

	$dataBase = new DAtaBase();
	$dataBase-> connectDB("control_system_project");
	$dataBase-> getAllDataView();

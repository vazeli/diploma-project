<?php 

include('table.php');
$dataBase = new DAtaBase();
$dataBase-> connectDB("control_system_project");

$dataBase->db->query ( "set names utf8" );
$name = $_REQUEST['name'];
$level = $_REQUEST['level'];
$pr_one = $_REQUEST['pr_one'];
$pr_two = $_REQUEST['pr_two'];
if($level == "one")
{
	$sql = 'SELECT lvl2, lvl3, lvl4 FROM `view_all_program_tree` WHERE lvl1 = "'.$name.'"';
}
if($level == "two")
{
	$sql = 'SELECT  lvl3, lvl4 FROM `view_all_program_tree` WHERE lvl2 = "'.$name.'" and lvl1 = "'.$pr_one.'"';
}
if($level == "tree")
{
	$sql = 'SELECT  lvl4 FROM `view_all_program_tree` WHERE lvl3 = "'.$name.'" and lvl2 = "'.$pr_one.'" and lvl1 = "'.$pr_two.'"';
}

$res = $dataBase->db->query($sql);
$array = array();
$i = 0;
while($row = $res->fetch_array())
{
	$array[$i] = $row;
	
	$i++;
}


echo json_encode($array);
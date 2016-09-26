<?php 

class dataToDB{
	
	private  $file;
	private  $array = array(array());
	function getDataFile($name){
		$this->file = file($name);
	}

	function printArray(){
		$arr = $this->array;
		for($i = 0; $i < count($arr); $i++){
			for($j = 0; $j < count($arr[$i]); $j++){
				echo "< ".$arr[$i][$j]." > | ";
			}
			echo "<br>";
		}
	}

	function droppingCount($value, $type){
		if ($type == 1)
		{
			if($value<5)
				return $value + 1;
			else
				return 0;
		}
		if ($type == 2)
		{
			if($value<2)
				return $value + 1;
			else
				return 0;
		}

	}
	//****************
	//
	//если type == 1 парсим project 
	//если type == 2 парсим customer 
	//
	//****************
	function toArray($type){
		$count = 0;
		$array = array(array());
		print_r($array);
		if ($type == 1)
		{
			foreach ($this->file as $key => $value) {
				for($i=0; $i<strlen($value);$i++){		

					if($value[$i] != "\t" && $value[$i] != "\n"){
						$string .= $value[$i];
					}
					else{
						$this->array[$key][$count] = $string;
						$count = $this->droppingCount($count, $type);
						$string = "";
					}		
				}
			}
		}

		if($type == 2)
		{
			foreach ($this->file as $key => $value) {
				for($i=0; $i<strlen($value);$i++){		
					if($value[$i] != "\t" && $value[$i] != "\n"){
						$string .= $value[$i];
					}
					else{
						$this->array[$key][$count] = $string;
						$count = $this->droppingCount($count, $type);
						$string = "";
					}		
				}
			}
		}
	}

	function replaceNameProgram(){
		for($i = 0; $i < count($this->array); $i++){
			$buff = $this->array[$i][1];
			switch ($buff[0]) {
				case 1:
				$this->array[$i][1] = "first project";
				break;
				case 2:
				$this->array[$i][1] = "second project";
				break;
				case 3:
				$this->array[$i][1] = "third project";
				break;
				
				default:
				$this->array[$i][1] = "does not project";
				break;
			}
		}
	}
	
	function getData()
	{
		return $this->array;
	}
}

class DataBase{
	public $db;
	public $position = 1;

	function connectDB($name_db){
		$this->db = new mysqli("localhost","root","",$name_db);
		$this->db->query("SET NAMES 'cp1251'");
	}
	
	function closeDB(){
		$this->db->close();
	}
	
	function insertDataToProject($data){
		for ($i = 0; $i<count($data); $i++){

			$query = "insert into project (global_program, name, customer, time_start, time_finish) values (".'"'.$data[$i][1].'"'.",".'"'.$data[$i][2].'"'.",".'"'.$data[$i][3].'"'.",".'"'.$data[$i][4].'"'.",".'"'.$data[$i][5].'"'.")";
			//echo $query."<br>";
			$res= $this->db->query($query);
		
		//	echo $res." <br>";
		}
	}

	function insertDataToCustomer($data){
		for ($i = 0; $i<count($data); $i++){

			$query = "insert into customer (name) values (".'"'.$data[$i][1].'"'.")";
			//echo $query."<br>";
			$this->db->query($query);
		}
	}

	function clearAllData(){
		$query = "delete from project";
		$this->db->query($query);
		$query = 'ALTER TABLE project AUTO_INCREMENT=0';
		$this->db->query($query);
		$query = "delete from customer";
		$this->db->query($query);
		$query = "ALTER TABLE customer AUTO_INCREMENT=0";
		$this->db->query($query);
	}

	function getAllDataView(){
		$sql = "select * from view_project_and_customer";
		$res = $this->db->query($sql);
		echo "<table class='table-all-data'>";
		while ($row = $res->fetch_array(MYSQLI_ASSOC)){
			echo "<tr>";
		//	echo "<td>" .$row['name_global_program'] ."</td>";
			echo "<td>" .$row['customer'] ."</td>";
			echo "<td>" .$row['project_name'] ."</td>";
			if($row['start_time'] != "0000-00-00")
				echo "<td width='80px'>" .$row['start_time'] ."</td>";
			else
				echo "<td width='80px'> not filled </td>";
			if($row['finish_time'] != "0000-00-00")
				echo "<td width='80px'>" .$row['finish_time'] ."</td>";
			else
				echo "<td width='80px'> not filled </td>";
			echo "</tr>";
		}
		echo "</table>";
	}

	function getAllCustomer(){
		$sql = "select DISTINCT name from customer";
		$res = $this->db->query($sql);
		echo "<table class='table-all-data'>";
		while ($row = $res->fetch_array(MYSQLI_ASSOC)){
			echo "<tr>";
			
			echo "<td onclick='show_project(this);'>" .$row['name'] ."</td>";
		
			echo "</tr>";
		}
		echo "</table>";
	}

	function getAllCustomerType(){
		$sql = "select DISTINCT name from customer_type";
		$res = $this->db->query($sql);
		echo "<table class='table-all-data'>";
		while ($row = $res->fetch_array(MYSQLI_ASSOC)){
			echo "<tr>";
			
			echo "<td onclick='show_project(this);'>" .$row['name'] ."</td>";
		
			echo "</tr>";
		}
		echo "</table>";
	}

	function getProjectWithOutProgram(){
		$sql = "select * from project where program = '' ";
		$res = $this->db->query($sql);
		echo("<table class='table-all-data'>");
		while($row = $res->fetch_array(MYSQLI_ASSOC)){
			echo("<tr>");

			echo("<td>".$row["name"]."</td>");
			echo("<td>".$row["customer"]."</td>");
			echo("<td>".$row["time_start"]."</td>");
			echo("<td>".$row["time_finish"]."</td>");
	
			echo("<td> set project <input type='text'></td>");
			echo("<td> <p onclick='set(this);'>set</p> </td>");
			echo("</tr>");
		}

		echo("</table>");
		echo "<p onclick='show()'>show/hide</p>";
		echo "<div  class='show'>";
		$sql = "select * from view_all_program_tree_and_id ";
		$res = $this->db->query($sql);
		echo("<table class='table-all-data'>");
		while($row = $res->fetch_array(MYSQLI_ASSOC)){
			echo("<tr>");

			echo("<td>".$row["one"]."</td>");
			echo("<td>".$row["two"]."</td>");
			echo("<td>".$row["three"]."</td>");
			echo("<td>".$row["five"]."</td>");
			echo("<td>".$row["ID"]."</td>");
	
		
			echo("</tr>");
		}

		echo("</table>");

		echo "</div>";
	}



	function getAllProjectAndProgram(){
		$sql = "select * from all_data ";
		$res = $this->db->query($sql);
		echo("<table class='table-all-data'>");
		while($row = $res->fetch_array(MYSQLI_ASSOC)){
			echo("<tr>");

			echo("<td>".$row["lvl_one"]."</td>");
			echo("<td>".$row["lvl_two"]."</td>");
			echo("<td>".$row["lvl_tree"]."</td>");
			echo("<td>".$row["lvl_four"]."</td>");
			echo("<td>".$row["project"]."</td>");
			echo("<td>".$row["time_start"]."</td>");
			echo("<td>".$row["time_finish"]."</td>");

			echo("</tr>");
		}

		echo("</table>");
	}

	function getAllProjectAndProgramLowFilter(){
		$sql = "select * from all_data ";
		$res = $this->db->query($sql);
		echo("<table class='table-all-data'>");
		while($row = $res->fetch_array(MYSQLI_ASSOC)){
			echo("<tr>");

			echo("<td  class='lvl_one' onclick='view_low_level(this);'>".$row["lvl_one"]."</td>");
			echo("<td  class='lvl_two' onclick='view_low_level(this);'>".$row["lvl_two"]."</td>");
			echo("<td  class='lvl_tree' onclick='view_low_level(this);'>".$row["lvl_tree"]."</td>");
			echo("<td  class='lvl_four' onclick='view_low_level(this);'>".$row["lvl_four"]."</td>");
			echo("<td  class='project' onclick='view_low_level(this);'>".$row["project"]."</td>");


			echo("</tr>");
		}

		echo("</table>");
	}

	function getAllTree(){
		$sql = "select * from view_all_program_tree ";
		$res = $this->db->query($sql);
		echo("<table  class='table-all-data'>");
		while($row = $res->fetch_array(MYSQLI_ASSOC)){
			echo("<tr>");

			echo("<td class='one' onclick='view_low_level(this);'>".$row["lvl1"]."</td>");
			echo("<td class='two' onclick='view_low_level(this);'>".$row["lvl2"]."</td>");
			echo("<td class='tree' onclick='view_low_level(this);'>".$row["lvl3"]."</td>");
			echo("<td class='four' onclick='view_low_level(this);'>".$row["lvl4"]."</td>");
	

			echo("</tr>");
		}

		echo("</table>");
	}



	function getInfo($type){
		switch($type){
			case 1: 
				$sql = "SELECT count(*) FROM project";
				break;
			case 2: 
				$sql = "SELECT count(*) FROM customer";
				break;
			case 3:
				$sql = "SELECT count(project_name), customer_name  FROM `view_project_info` group by customer_name ";
				break;
			case 4:
				$sql = "SELECT count(customrt_type), customrt_type  FROM `view_project_info` group by customrt_type";
				break;
			case 5:
				$sql = "SELECT count(financing_name), financing_name  FROM `view_project_info` group by financing_name";
				break;
			case 6:
				$sql = "SELECT sum(cost)  FROM project";
				break;
			case 7:
				$sql = "SELECT three, COUNT( * ) FROM  view_all_program_tree_and_id WHERE two = 'Конкурентоспроможність та зростання ВРП' GROUP BY three";
				break;
			case 8:
				$sql = "SELECT three, COUNT( * ) FROM  view_all_program_tree_and_id` WHERE two = Зменшення територіальних диспропорцій у якості життя та поліцентричний розвиток' GROUP BY three";
				break;
			case 9: 
				$sql = "SELECT three, COUNT( * ) FROM  view_all_program_tree_and_id WHERE two = 'Ефективне управління місцевим розвитком'GROUP BY three";	
				break;
			case 10:
				$sql = "SELECT lvl_tree ,count(*) FROM `all_data` GROUP BY lvl_tree ";
			//	$sql = "SELECT three, COUNT( * ) FROM  `view_all_program_tree_and_id`  GROUP BY three";	
				break;
		}
		
		$res = $this->db->query($sql);
	
		$i = 0;
		while($row = $res->fetch_array())
		{
			$ret[$i] = $row;
			$i++;
		}
		
		return $ret;
	}

	
}







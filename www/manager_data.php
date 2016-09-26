<?php 
include("table.php"); 
include("graph/pChart/pData.class");
include("graph/pChart/pChart.class");
$dataBase = new DAtaBase();
$dataBase-> connectDB("control_system_project");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<script src="js/jquery.js"></script>
	<script>
		function show_block(e){
			var displ = $( e ).children().css( "display" );
			if(displ == "none")
				$(e ).children().css("display","block");
			else
				$(e ).children().css("display","none");
		}

	</script>
	<style>
		.block_info{
			width: 800px;
			
			padding: 10px;
			background-color: #99ccff;
			margin: 20px auto;
		}
	</style>
</head>
<body>
	<div class="block_info">
		<p>count of registered projects</p>
		<?php 
		$count = $dataBase->getInfo(1);
		echo $count[0][0];
		?>
	</div>
	<div class="block_info">
		<p>cost all projects</p>
		<?php 
		$count = $dataBase->getInfo(6);
		echo $count[0][0];
		?>
	</div>
	<div class="block_info">
		<p>count coustomers</p>
		<?php 
		$count =  $dataBase->getInfo(2);
		echo $count[0][0];
		?>
	</div>
	<div class="block_info" onclick="show_block(this);">
		show/hide all customer and count project registed
		<div class="cutomer" style="display:none">
			<?php 
			$data =  $dataBase->getInfo(3);

			for($i = 0; $i < count($data); $i++){
				echo $data[$i][1]. " - ". $data[$i][0]."<br>";
			}
			?>
		</div>
	</div>
	<div class="block_info" onclick="show_block(this);">
		show/hide all type customer and count 
		<div class="cutomer" style="display:none">
			<?php 
			$data =  $dataBase->getInfo(4);

			for($i = 0; $i < count($data); $i++){
				echo $data[$i][1]. " - ". $data[$i][0]."<br>";
			}
			?>
		</div>
		
	</div>

	<div class="block_info" onclick="show_block(this);">
		show/hide all type customer and count financing 
		<div class="cutomer" style="display:none">
			<?php 
			$data =  $dataBase->getInfo(5);

			for($i = 0; $i < count($data); $i++){
				echo $data[$i][1]. " - ". $data[$i][0]."<br>";
				$graph_point[$i] = $data[$i][0];
				$graph_name[$i] = $data[$i][1];
			}
			?>
		</div>
	</div>

	<div class="block_info" onclick="show_block(this);">
		show/hide all type program level three and count project 
		<div class="cutomer" style="display:none">
		<br>
	
			<?php 
			$data =  $dataBase->getInfo(10);

			for($i = 0; $i < count($data); $i++){
				echo $data[$i][1]. " - ". $data[$i][0]."<br>";
			}
			?>

		</div>
	</div>

	<div class="block_info">
		<p>chart of project financing</p>
		<?php include("draw_pie.php"); ?>
	</div>

</body>
</html>
<?php include("table.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="css/main_page_style.css">
	<script src="js/jquery.js"></script>
	<script src="js/1.js"></script>
	<script >
		function show(){
			var displ = $(".show").css( "display" );
			if(displ == "none"){
				$(".show").css("display","block");
				
			}
			else
				$(".show").css("display","none");
		}

		function set(e){
			var a = e.parentNode.previousSibling.previousSibling.previousSibling.previousSibling.previousSibling;
			
			var name = a.innerHTML;
			var progr  = e.parentNode.previousSibling.childNodes[1].value;
			$.ajax({
				url: 'ajax_update.php',
				type: 'POST',
				data: {name : name, progr:progr},
				dataType: 'json',
				success: function(data){
					 location.reload(true)

					alert("data update");

				}	
			});
			alert(progr);
		}

	</script>
</head>
<body>
	<?php 
	$dataBase = new DAtaBase();
	$dataBase-> connectDB("control_system_project");
	$dataBase-> getProjectWithOutProgram();
	?>
</body>
</html>
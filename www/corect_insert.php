<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<script src="js/jquery.js"></script>
<style>
	.insert{
		width: 650px;
		background-color: #99ccff;
		padding: 20px;

	}
	.but{
		padding: 20px;
		border: 1px solid black;
		width: 40px;
	}
	.block{
		display: inline-block;
	}
</style>
<script>
	function insrt(par){
	
		alert($("#finish").val());
		if(par === 1){
			$.ajax({
				url: 'ajax_insert.php',
				type: 'POST',
				data: {cust_type : $("#name_insert").val(), proj: $("#name_proj").val(), start:$("#start").val(), finish: $("#finish").val()},
				dataType: 'json',
				success: function(data){
					alert(data);
				}	
			});
		}
		if(par === 2){

		}
	} 
</script>
<body>
	<div class="insert">
		<p>INSERT DATA</p>
		<div class="block"><p>customer</p><input id="name_insert" type="text"></div>
		<div class="block"><p>project name</p><input id="name_proj" type="text"></div>
		<div class="block"><p>data start</p><input id="start" type="date"></div>
		<div class="block"><p>data finish</p><input id="finish" type="date"></div>
		<p class="but" onclick="insrt(1);">insert</p>

	</div>

</body>
</html>
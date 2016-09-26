		<?php 
 // Dataset definition 
		$DataSet = new pData;
		$DataSet->AddPoint($graph_point,"Serie1");
		for($i = 0;$i < count($graph_name); $i++){
			$graph_name[$i] = iconv('cp1251', 'utf-8', $graph_name[$i]);
		}
		$DataSet->AddPoint($graph_name,"Serie2");
		$DataSet->AddAllSeries();
		$DataSet->SetAbsciseLabelSerie("Serie2");

 // Initialise the graph
		$Test = new pChart(500,200);
		$Test->setFontProperties("graph/Fonts/tahoma.ttf",8);

		
 // Draw the pie chart
		$Test->AntialiasQuality = 0;

		$Test->drawFlatPieGraphWithShadow($DataSet->GetData(),$DataSet->GetDataDescription(),120,100,60,PIE_PERCENTAGE,8);


		$Test->drawPieLegend(230,15,$DataSet->GetData(),$DataSet->GetDataDescription(),255,255,255);

		$Test->Render("romka.png");
		?>
		<img src="romka.png" alt="">
<?php

error_reporting(E_ERROR | E_WARNING | E_PARSE);

$row = 1;

function cmp($a, $b) {
	print_r($a);
	return ($a[0] > $b[0]) ? -1 : 1;
}

if (!$DataFile = fopen("clicks.csv", "r")) {echo "Failure: cannot open file"; die;};
while ($data = fgetcsv($DataFile, 5000, ",")) {
		$row++;
		$results[] = array($data[0], $data[1], $data[2], $data[3], $data[4], $data[5]);
	}

if ($results) {
		
	$linkPos = array();
	$pageNo = array();
	$linkType = array();
	$linkSource = array();
	$linkOpac = array();
	
	foreach ($results as $key => $value) {
		
		// Build chart for link location
		
		$linkPosition = $value[1];
						
		$link = $linkPosition;
		if($link != "") {
			if(isset($linkPos[$link]))
		        $linkPos[$link] += 1;
		    else
		        $linkPos[$link] = 1;
		}
		
		// Build chart for page no
		
		$pageClicked = $value[3];
		if($pageClicked != "") {
			if(isset($pageNo[$pageClicked]))
		        $pageNo[$pageClicked] += 1;
		    else
		        $pageNo[$pageClicked] = 1;
		}
		
		// Build chart for which link
		
		$whichLink = $value[2];
		if($whichLink != "") {
			if(isset($linkType[$whichLink]))
		        $linkType[$whichLink] += 1;
		    else
		        $linkType[$whichLink] = 1;
		}
		
		$linkSrc = $value[4];
		if($linkSrc != "") {
			if(isset($linkSource[$linkSrc]))
		        $linkSource[$linkSrc] += 1;
		    else
		        $linkSource[$linkSrc] = 1;
		}
		
	}	
	ksort($linkPos);
	ksort($pageNo);
	
	foreach($linkSource as $key => $value) {
		$OpacTotal = $OpacTotal + $value;
		if(($key == "Book") || ($key == "eBook") || ($key == "Video Recording") || ($key == "Journal")) {
			$OpacSource["OPAC"] += $value;
		} else {
			$OpacSource["Non-OPAC"] += $value;
		}
	}
	
}

?>

<html>
  <head>
    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">

      // Load the Visualization API and the piechart package.
      google.load('visualization', '1.0', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(drawChart);
	// Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(pageChart);
	// Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(linkChart);
	// Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(clickChart);
	// Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(sourceChart);
	// Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(sourcePerChart);
	// Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(sourceOpacChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Link Position');
        data.addColumn('number', 'Clicks');
        data.addRows([
	
	<?php
	
		foreach ($linkPos as $key => $value) {
			
			echo "['" . $key . "', " . $value . "],";
		
		}
	
	?>
        
        ]);

        // Set chart options
        var options = {'title':'Clicks on Summon Results by Position',
                       'width':960,
                       'height':1000};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }

	 function sourceChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Source Type');
        data.addColumn('number', 'Clicks');
        data.addRows([

	<?php

		foreach ($linkSource as $key => $value) {

			echo "['" . $key . "', " . $value . "],";

		}

	?>

        ]);

        // Set chart options
        var options = {'title':'Clicks on Summon Results by Item Type',
                       'width':960,
                       'height':600};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.BarChart(document.getElementById('source_div'));
        chart.draw(data, options);
      }

	function sourcePerChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Source Type');
        data.addColumn('number', 'Clicks');
        data.addRows([

	<?php

		foreach ($linkSource as $key => $value) {

			echo "['" . $key . "', " . $value . "],";

		}

	?>

        ]);

        // Set chart options
        var options = {'title':'Clicks on Summon Results by Item Type',
                       'width':300,
                       'height':240};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('source_perc_div'));
        chart.draw(data, options);
      }

	function sourceOpacChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Source Type');
        data.addColumn('number', 'Clicks');
        data.addRows([

	<?php

		foreach ($OpacSource as $key => $value) {

			echo "['" . $key . "', " . $value . "],";

		}

	?>

        ]);

        // Set chart options
        var options = {'title':'Clicks on Summon Results by Holdings',
                       'width':300,
                       'height':240};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('source_opac_div'));
        chart.draw(data, options);
      }
	function pageChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Page #');
        data.addColumn('number', 'Clicks');
        data.addRows([

	<?php

		foreach ($pageNo as $key => $value) {

			echo "['" . $key . "', " . $value . "],";

		}

	?>

        ]);

        // Set chart options
        var options = {'title':'Clicks on Summon by Page',
                       'width':300,
                       'height':240};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('page_div'));
        chart.draw(data, options);
      }

	function clickChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Link Position');
        data.addColumn('number', 'Clicks');
        data.addRows([

			<?php

				foreach ($linkPos as $key => $value) {

					echo "['" . $key . "', " . $value . "],";

				}

			?>
        ]);

        // Set chart options
        var options = {'title':'Clicks on Summon by Position',
                       'width':300,
                       'height':240};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('clicks_div'));
        chart.draw(data, options);
      }

	function linkChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Which Link');
        data.addColumn('number', 'Clicks');
        data.addRows([

			<?php

				foreach ($linkType as $key => $value) {

					echo "['" . $key . "', " . $value . "],";

				}

			?>
        ]);

        // Set chart options
        var options = {'title':'Clicks on Summon by Position',
                       'width':300,
                       'height':240};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('link_div'));
        chart.draw(data, options);
      }
    </script>

	<style>
	body { font-family: Helvetica, "HelveticaNeue", Verdana, Arial, sans-serif;}
	h6 { font-size: .55em; color: #000;}
	.big_number { font-size: 6em; color: #069;}
	/* Grid styles : Based on Nicole Sullivan's OOCSS grids */

	.line{overflow:hidden;*overflow:visible;*zoom:1;clear:both;}	
	.size1of1{float:none;width:100%;}
	.size1of2,.size1of4,.size3of4 {width:100%;}
	.size1of3,.size2of3{width:100%;}
	.unit{padding:.5em 1% .5em 0;}

	@media screen and (min-width:550px) {
	.unit{float:left;}
	.size1of4,.size1of4{width:49%;}	
	.size1of3{width:32%;}
	.size2of3{width:65%;}
	}

	@media screen and (min-width:900px) {
	.size1of2{width:49%;}
	.size1of4{width:24%;}
	.size3of4{width:74%;}
	}
		</style>
	
  </head>

  <body>
    <!--Div that will hold the pie chart-->
    <div id="chart_div"></div>

	<div class="line">
		<div class="size1of3 unit">
			<div id="clicks_div"></div>
		</div>
		
		<div class="size1of3 unit">
			<div id="link_div"></div>
		</div>
		
		<div class="size1of3 unit lastUnit">
			<div id="page_div"></div>
		</div>
	</div>
	
	<div class="line">
		<div class="size1of1 unit">
			<div id="source_div"></div>
		</div>
	</div>
	
	<div class="line">
		<div class="size1of3 unit">
			<div id="source_perc_div"></div>
		</div>
		
		<div class="size1of3 unit">
			<!--div id="source_opac_div"></div-->
			<div id="summon_opac_usage">
				<h6><strong>Clicked items that are in the OPAC</h6>
				
<?php
	// Calculate the percentage of OPAC records clicked on - mapping Books and eBooks

	$TotalOpacRecords = number_format((($OpacSource["OPAC"]/$OpacTotal)*100), 1);
	
	echo '<div class="big_number">' . $TotalOpacRecords . '%</div>';
	
?>
				
				
			</div>
		</div>
		
		<div class="size1of3 unit lastUnit">
			<div id=""></div>
		</div>
	</div>
	
	<div class="line">
		<div class="size1of1 unit">
			<p style="text-align:center;color:#777;"><small>This tool written by <a href="http://matthewreidsma.com">Matthew Reidsma</a> :: &copy; 2012 <abbr title="Grand Valley State University">GVSU</abbr> Libraries. Source code <a href="https://github.com/mreidsma/Summon-Stats">available on Github</a>.</small></p>
		
 </body>
</html>
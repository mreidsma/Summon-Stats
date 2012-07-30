<?php
	header("Access-Control-Allow-Origin: *");

	$navString = $_SERVER['REQUEST_URI']; 
	// Returns "/pathto/script/LinkPosition/Type/Page/"

	$parts = explode('/', $navString); // Break into an array

	// Grab fixed position fields
	//$parts[3] = Timestamp of click
	//$parts[4] = Position of click
	//$parts[5] = Type of click
	//$parts[6] = Page number of click
	//$parts[7] = Content Type
	//$parts[8] = Number of clicks this search 

	$data = array($parts[3],$parts[4],$parts[5],$parts[6],$parts[7],$parts[8]);
	
	// More sane CSV code thanks to Michael Oehrlich, oehrlich@thulb.uni-jena.de

	if (!$DataFile = fopen("clicks.csv", "a")) {echo "Failure: cannot open file"; die;};
	if (!fputcsv($DataFile, $data)) {echo "Failure: cannot write to file"; die;};
	fclose($DataFile);
	echo "file write successful";

?>
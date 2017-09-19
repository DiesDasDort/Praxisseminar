<?php

$valid_format = array("csv");
$max_file_size = 1000000;
$path = "csvFiles/";
$number = 0;

foreach ($_FILES['files']['name'] as $f => $name) {

	// Skip file if any error found
	if ($_FILES['files']['error'][$f] == 4) {
	        continue;
	}

	if ($_FILES['files']['error'][$f] == 0) {

		// Skip files that are too big
		if ($_FILES['files']['size'][$f] > $max_file_size) {
			echo nl2br ("Datei $name ist zu groß!");
	            	continue;
	        }

		// Skip files that arent CSV
		elseif( ! in_array(pathinfo($name, PATHINFO_EXTENSION), $valid_format) ){
			echo nl2br ("Datei $name ist keine CSV Datei.");
			continue;
		}

	        else{
	        	if(move_uploaded_file($_FILES["files"]["tmp_name"][$f], $path.$name))
	        	$number++;
			echo nl2br ("Datei $number ($name) erfolgreich hochgeladen. \n");

	        }
	}
}

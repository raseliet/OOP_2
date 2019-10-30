<?php

function array_to_file($array, $filename) {
	$string = json_encode($array);
	$file = file_put_contents($filename, $string);
	
	if ($file !== false) {
		return true;
	}
	
	return false;
}
function file_to_array($file) {
	if (file_exists($file)) {
		$json_string = file_get_contents($file);
		if ($json_string !== false) {
			return json_decode($json_string, true);
		}
	}
	
	return false;
}

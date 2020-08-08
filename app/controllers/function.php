<?php

function limited_echo($x, $length)
{
	if (strlen($x) <= $length) {
		echo $x;
	} else {
		$y = substr($x, 0, $length) . '...';
		echo $y;
	}
}


function separator($media)
{

	$type = substr($media, strpos($media, '.') + 1);
	$type = strtoupper($type);
	$vFormat = array("AVI", "FLV", 'WMV', 'MP4', 'MOV', 'MKV');
	$iFormat = array('JPEG', 'PNG', 'JPG', 'SVG', 'JFIF', 'WEBP');

	if (in_array($type, $iFormat)) {
		return 0;
	} elseif (in_array($type, $vFormat)) {
		return 1;
	} else {
		return -1;
	}
}
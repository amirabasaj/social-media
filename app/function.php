<?php

global $wanted_author;
global $wanted_title;
global $wanted_tags;
global $wanted_tagsp;
global $wanted_tage;
global $wanted_tagp;
global $flag;

function confirmQuery($result)
{
	global $conn;
	if ($result) {
		die("Query Failed" . mysqli_error($conn));
	}
}






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
	$iFormat = array('JPEG', 'PNG', 'JPG', 'SVG');

	if (in_array($type, $iFormat)) {
		return 0;
	} elseif (in_array($type, $vFormat)) {
		return 1;
	} else {
		return -1;
	}
}

function tag()
{
	if ($post_tags == 1) {
		$post_tags = '#علمی';
	} else {
		$post_tags = '';
	}
	if ($post_tagsp == 1) {
		$post_tagsp = '#ورزشی';
	} else {
		$post_tagsp = '';
	}
	if ($post_tage == 1) {
		$post_tage = '#اقتصادی';
	} else {
		$post_tage = '';
	}
	if ($post_tagp == 1) {
		$post_tagp = '#سیاسی';
	} else {
		$post_tagp = '';
	}
}

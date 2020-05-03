<?php

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

function like(){
	global $flag;
	global $conn;
	$selected_post_id =0;
	if ($flag == 0) {
		if (isset($_GET['liked'])) {
			$selected_post_id = $_GET['liked'];
		}

		$query = "UPDATE posts SET likes = likes + 1	 WHERE post_id ={$selected_post_id} ";
		$result = mysqli_query($conn, $query);
		$flag += 1;
	}

}
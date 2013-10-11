<?php
	include 'conn.php';
	$rs = mysql_query("select nNature, designation AS nature from nature where parent IS NULL");
	
	$items = array();
	while($row = mysql_fetch_object($rs)){
		array_push($items, $row);
	}
	echo json_encode($items);

?>
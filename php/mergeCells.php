<?php
	
	include 'conn.php';
	$rs = mysql_query("select COUNT( * ) AS  count,nRecu FROM operation GROUP BY  nRecu ORDER BY nRecu DESC");	
	$items = array();
	while($row = mysql_fetch_object($rs)){
		array_push($items, $row);
	}
	echo json_encode($items);

?>
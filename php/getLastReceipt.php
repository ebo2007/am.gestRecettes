<?php
	$nature= intval($_GET['nNature']);
	
	if (isset($nature)) {
		include 'conn.php';
		$rs = mysql_query("select nNature AS nRubrique, designation AS rubrique from nature where parent=".$nature);		
		$items = array();
		while($row = mysql_fetch_object($rs)){
			array_push($items, $row);
		}
		echo json_encode($items);
	}

?>
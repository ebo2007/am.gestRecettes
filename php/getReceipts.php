<?php
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
	$offset = ($page-1)*$rows;
	$result = array();

	include 'conn.php';

	$qry ='select recettes.nRecu,recettes.dateRecu,nature.designation AS rubrique,nature_1.designation AS nature,operation.mtn,recettes.mtnGlobal,recettes.client';
	$qry.=' FROM ((recettes.nature nature INNER JOIN recettes.operation operation ON (nature.nNature = operation.rubrique))';
	$qry.=' INNER JOIN recettes.recettes recettes ON (recettes.nRecu = operation.nRecu)) INNER JOIN recettes.nature nature_1 ON (nature_1.nNature = nature.parent)';
	$qry.=' ORDER BY recettes.nRecu DESC LIMIT '.$offset.','.$rows;


	$rs = mysql_query("select count(*) from operation");
	$row = mysql_fetch_row($rs);
	$result["total"] = $row[0];
	$rs = mysql_query("select * from recettes order by nRecu desc limit $offset,$rows");
	
	$items = array();
	while($row = mysql_fetch_object($rs)){
		array_push($items, $row);
	}
	$result["rows"] = $items;

	echo json_encode($result);

?>
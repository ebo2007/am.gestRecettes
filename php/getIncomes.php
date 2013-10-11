<?php
	$nRecu = isset($_REQUEST['nRecu']) ? intval($_REQUEST['nRecu']) : 0;
	$result = array();

	include 'conn.php';

	$rs = mysql_query("select count(*) from operation where nRecu = $nRecu");
	$row = mysql_fetch_row($rs);
	$result["total"] = $row[0];

	$rs = mysql_query("select SUM(mtn) from operation where nRecu = $nRecu");
	$row = mysql_fetch_row($rs);
	$footer= array(array('rubrique'=>'Total:', 'mtn'=>$row[0]));

	$query ="select operation.nOperation AS nOperation,operation.rubrique AS nRubrique, nature.nNature AS nNature, nature_1.designation AS rubrique, nature.designation AS nature, operation.mtn AS mtn";   
	$query.=" FROM (recettes.operation operation  INNER JOIN recettes.nature nature_1 ON (operation.rubrique = nature_1.nNature)) ";
	$query.="INNER JOIN recettes.nature nature ON (nature.nNature = nature_1.parent) WHERE operation.nRecu = $nRecu";

	$rs = mysql_query($query);

	$items = array();
	while($row = mysql_fetch_object($rs)){
		array_push($items, $row);
	}
	$result["rows"] = $items;
	$result["footer"] = $footer;

	echo json_encode($result);

?>
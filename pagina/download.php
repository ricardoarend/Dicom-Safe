<?php
 
$arquivo = $_GET["arquivo"];
if(isset($arquivo) && file_exists($arquivo)){  
	//$tipo="image/dcm";
	header("Content-Description: File Transfer");
	header("Content-Type: application/save");
	header("Content-Disposition: attachment; filename=".basename($arquivo));
	//header("Content-Transfer-Encoding: binary");
	readfile($arquivo);
	exit;
}
 
?>
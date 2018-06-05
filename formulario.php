<?php 
	$url=__DIR__."hola";
	require_once __DIR__ ."/function.php";

	$actividades=new actividades();
	$actividades->inicio($url);

 ?>
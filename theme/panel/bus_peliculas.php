<?php
	$name=$_GET["name"];

	$data_tam =json_decode( file_get_contents("http://localhost/programacion/theme/data/apiP.php/film?filter=title,cs,".$name."&transform=1"), true );



	for($i=0;$i<count($data_tam["film"]);$i++){


?>

	<div class="col-8"><?php echo $data_tam["film"][$i]["title"]?></div>
	<div class="col-4"><button class="agregar" id="agregar<?echo $i; ?>">+</button></div>
	


<?php
	}

?>


<?php
error_reporting(0);
	$name=$_GET["name"];
	$last=$_GET["last_name"];
	if(isset($last)){
	$data_tam =json_decode( file_get_contents("http://localhost/programacion/theme/data/api.php/employees?filter[]=first_name,sw,".$name."&filter[]=last_name,sw,".$last."&transform=1"), true );
	
	}else{
	$data_tam =json_decode( file_get_contents("http://localhost/programacion/theme/data/api.php/employees?filter=first_name,sw,".$name."&transform=1"), true );

	}

	for($i=0;$i<count($data_tam["employees"]);$i++){


?>
<div class="row">
	<div class="col-4"><?php echo $data_tam["employees"][$i]["first_name"]?></div>
	<div class="col-4"><?php echo $data_tam["employees"][$i]["last_name"]?></div>
	<div class="col-4"><a href="http://localhost/programacion/theme/panel/peliculas.php?id=<?php  echo $data_tam['employees'][$i]['emp_no']?>">Seleccionar</a></div>
</div>

<?php
	}

?>


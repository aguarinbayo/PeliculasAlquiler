<?php
$url=__DIR__."/pelicula_info.php";
require_once dirname(dirname(__DIR__))."/function.php";
$actividades=new actividades();
?>
<!DOCTYPE html>
<html>
	<?php
		$actividades->head();
	?>
<body>
	<div class="container">	
	<div class="row">
		<div class="col-12">

	<?php 

		$actividades->inicio($url);

	 ?>
		</div>			
	</div>	
 </div>
</body>
</html>
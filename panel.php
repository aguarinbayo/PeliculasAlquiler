<?php 
error_reporting(0);
	$url=__DIR__."/theme/panel/panel_sesion.php";
	require_once __DIR__ ."/function.php";

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
	<?php 

		$actividades->inicio($url);

	 ?>
	</div>
 </div>
</body>
</html>

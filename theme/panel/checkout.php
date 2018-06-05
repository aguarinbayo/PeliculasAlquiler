<?php
require_once dirname(dirname(__DIR__))."/function.php";
$actividades= new actividades();

$actividades->head();


	$peliculas=explode(",", $_GET["peli"]);
	$id=$_GET["cliente"];


	$user =json_decode( file_get_contents("http://localhost/programacion/theme/data/api/employees?filter=emp_no,eq,".$id."&transform=1"), true );


foreach ($peliculas as $value) {
	$infoPeliculas[]=json_decode( file_get_contents("http://localhost/programacion/theme/data/apiP/film?filter=film_id,eq,".$value."&transform=1"), true );
}


	$count=count($peliculas);
	$mult=$count%3;
	$valor=2;
	$envio=2;
?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body class="container">
	<div class="row">
		<div class="col-md-12">
		<div class="row">
			<div class="col-md-12">
				<h2>Datos comprador</h2>
			</div>
			<div class="col-md-6">
				<input type="text" name="" disabled="desabled" value="<?php echo $user['employees'][0]['first_name']; ?>">
			</div>
			<div class="col-md-6">
				<input type="text" name="" disabled="desabled" value="<?php echo $user['employees'][0]['last_name']; ?>">
			</div>

			
		</div>
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-12">
						<h2>Peliculas a alquilar</h2>
					</div>
				</div>
				<div class="row">
				<?php
					for($i=0;$i<$count;$i++):
						?>
						<p class="col-md-8"><?php echo $infoPeliculas[$i]["film"][0]["title"]; ?></p>
						<p class="col-md-4">US $<?php echo $valor; ?></p>
						<?php
					endfor;
				?>
				</div>

				<div class="row">
					<div class="col-md-8">
						Sub-Total
					</div>
					<div class="col-md-4">
						US $
						<?php $sub=$valor*$count;
							echo $sub;
						 ?>
					</div>
				</div>

				<div class="row">
					<div class="col-md-8">
						<p>Descuentos</p>
					</div>
					<div class="col-md-4">
						US $
						<?php if($mult==0):
								$des=($sub*10)/100;
							else:
								$des=0;
							endif;

							echo $des;
						?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-8">
						<label>Agregar envio</label>
						<input type="radio" name="">
					</div>
					<div class="col-md-4">
						<p id="envios">
							
						</p>
					</div>
				</div>

				<div class="row">
					<div class="col-md-8">
						<p>Total a pagar</p>
					</div>
					<div class="col-md-4">
						<p id="total">
							US $<?php $totales= $sub-$des;
								echo $totales;
							 ?>
						</p>
					</div>
				</div>

			</div>
		</div>
	</div>


        <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" id="forPago">
            <input type="hidden" name="cmd" value="_xclick">
            <input type="hidden" name="no_shipping" value="1" id="envioP">
            <input type="hidden" name="business" value="aguarinbayo-facilitator@uniminuto.edu.co">
            <input type="hidden" name="item_name" value="Premium Subscription">
            <input type="hidden" name="currency_code" value="USD">
            <input type="hidden" name="amount" value="<?php echo $totales;?>" id="paypal">
            <input type="image"  id="enviarP" src="http://www.paypal.com/es_XC/i/btn/x-click-but01.gif"
                   name="submit"
                   alt="Make payments with PayPal - it's fast, free and secure!">
            <input type="hidden" name="return" value="http://localhost/programacion/theme/panel/pagado.php">
			<input type="hidden" name="cancel_return" value="http://localhost/programacion/theme/panel/cancelado.php">
        </form>
 
</body>
</html>

<style type="text/css">

</style>
<script type="text/javascript">
		var tot;
	$(":radio").click(function(){
		var envio=<?php echo $envio; ?>;
		var total=<?php echo $totales; ?>;

		var tot=envio+total;

		$("#total").html("US $"+tot);
		$("#envios").html("US $"+envio);
		$("#paypal").attr("value",tot);
		$("#envioP").attr("name","");
		$("#envioP").attr("value",0);

	});

</script>
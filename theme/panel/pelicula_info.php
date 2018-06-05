<?php
$data_tam =json_decode( file_get_contents("http://localhost/programacion/theme/data/apiP.php/film?transform=1"), true );
$id_u=$_GET["id"];
?>


<script type="text/javascript">
$(document).ready(function(){
     $("#nombre").keyup(function(){
      var datas=$(this).val();

          $.ajax({
            type:'get',
             url:'bus_peliculas.php',
             data: {"name":datas},
             success: function(data) {
             $("#msot").html(data);
               }
        });
      
        
      
  });
     var peli=new Array();
     $(".agregar").click(function(){
     	var id=$(this).attr("id").split("agr_");
     	var int=parseInt(id[1]);
     	peli.push(int);
     	$(this).css("display","none");
     	$("#dele_"+id[1]).css("display","block");
     	console.log(peli);
     	
     });

      $(".eliminar").click(function(){
      	var contas;
     	var id=$(this).attr("id").split("dele_");
     	var int=parseInt(id[1]);
     	for(var i=0;i<peli.length;i++){
     			
     		if(int==peli[i]){
     			contas=i;
     		}else{

     		}
     	}
     	peli.splice(contas,1);

     	$(this).css("display","none");
     	$("#agr_"+id[1]).css("display","block");
   
   		console.log(peli);
     });

      $("#pagar").click(function(){

          window.location.href="checkout.php?cliente=<?php echo $id_u ?>&peli="+peli;
      });

});
 

</script>

<div class="row">
<div class="col-md-12">
 
    <input type="button" name="enviar"  id="pagar" value="pagar">
 
</div>
</div>
<div class="row pagination" id="msot">
  <div class=" col-md-8 col-md-offset-4 ">
<?php


for($i=0;$i<count($data_tam["film"]);$i++):
	/*if($i%$numero==0){
	echo $i." es múltiplo de ".$numero;
	}
		$numero++;*/
?>


  <div class="row dataP">
	<div class="col-8">
		<?php echo $data_tam["film"][$i]["title"] ?>
	</div>
	<div class="col-4 bton">
		<button class="agregar" id="agr_<?php echo $data_tam['film'][$i]['film_id'] ?>">+</button>
		<button class="eliminar" id="dele_<?php echo $data_tam['film'][$i]['film_id'] ?>">x</button>
	</div>
  </div>


<?php
endfor;
?>
</div>
</div>
<div id="pagina"></div>

<style type="text/css">
  
  .agregar{
    background-color: #00FF00;
    border:0px;
    border-radius: 15px;
    color: #fff;
  }
   .eliminar{
    background-color: #FF0000;
    border:0px;
    border-radius: 15px;
    color: #fff;
  }

  .dataP{
    background-color: #f1f1f1;
    margin-bottom: 5px;
  }
</style>

<script type="text/javascript">
$(document).ready(function(){
     $("#nombre").keyup(function(){
      var datas=$(this).val();

      if(datas.match(/ /)){
      
      var conpu=datas.split(" ");
         $.ajax({
            type:'get',
             url:'./theme/panel/usuario.php',
             data: {"name":conpu[0],"last_name":conpu[1]},
             success: function(data) {
             $("#mos").html(data);
               }
        });
      }else{
          $.ajax({
            type:'get',
             url:'./theme/panel/usuario.php',
             data: {"name":datas},
             success: function(data) {
             $("#mos").html(data);
               }
        });
      }
        
      
  });
});
 

</script>

<div class="col-md-12">
 
    <input type="text" name="nombre"  id="nombre" placeholder="Nombre">
 
</div>
<div id="mos" class="col-md-12"> </div>


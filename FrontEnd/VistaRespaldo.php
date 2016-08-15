<?php
    include "BarNav.php";
    require_once "imports2.php";
?>
<head>
    <title>Respaldos</title>
    <meta charset="utf-8" />
</head>
<div class="row">
    <div class="col l10 offset-l1 m12 s12">
        <br>
        <h5 class="center">Respaldos</h5>
        <br><hr><br>
    </div>
</div>





<div class="row">
    <div class="col l10 offset-l1 m12 s12">
        <div id="here_table">
        </div>
    </div>
</div>



<script>

    /*CARGAR TABLA*/
    $(document).ready(Cargar);
    function Cargar(){
  $.ajax({
           url:"../BackEnd/Back.php",
           type:'post',
           data:({
            action:"Respaldos",
            Metodo: "GetRespaldos"
           }),
           success: function (data) {
               data=JSON.parse(data);
               if(data.length!=0){
                   for (var i in data){
                       $('#here_table').empty();
                       var table = $('<table class="responsive-table striped"><thead><tr><th>Nombre anterior</th><th>Nuevo nombre</th><th>Fecha cambio</th> </tr> </thead></table>');
                       for(i=0; i<data.length; i++){
                           table.append('<tr><td>'+data[i].nombreanterior+'</td><td>'+data[i].nombrenuevo+'</td><td>'+data[i].fechacambio+'</td></tr>');
                       }
                       $('#here_table').append(table);
                   }
               }
               else{
                   $('#here_table').empty();
                   var table = $('<table class="responsive-table striped"><thead><tr><th>Nombre anterior</th><th>Nuevo nombre</th><th>Fecha cambio</th> </tr> </thead></table>');
                   $('#here_table').append(table);
               }
           }
       });
    };



</script>
































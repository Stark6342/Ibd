<?php
session_start();
if(!isset($_SESSION["Validado"])) {
    header("location:../");
}
else {
if($_SESSION['Validado']=="aceptado"){
    include "BarNav.php";
    require_once "imports2.php";
        require_once "../BackEnd/CargaSelect.php";

    $Select=new CargaSelect();
    $Sel1=$Select->get_clientes();
    $Sel2=$Select->get_direcciones();
    $Sel3=$Select->get_articulos();

?>
<head>
    <title>Gestion de Pedidos</title>
    <meta charset="utf-8" />
</head>
<div class="row">
    <div class="col l10 offset-l1 m12 s12">
        <br>
        <h5 class="center">Gestion de Pedidos</h5>
        <br><hr><br>
        <a href="#alta" class="btn-floating btn-large waves-effect waves-light green white-text modal-trigger1 right"><i class="material-icons">add</i></a>
    </div>
</div>



<!-- Modal para dar de alta y editar -->
<div id="alta" class="modal">
    <div class="modal-content">
        <form id="AltaProveedor">
            <h4>Alta Pedidos</h4>


           <div class="row">
                <div class="input-field col s12">
                    <select required id="Cliente_label">
                        <option value=null disabled selected>Seleccione</option>
                             <?php
                        foreach ($Sel1 as $row){
                            echo '<option value="'.$row['codigocliente'].'">'.$row['nombre'].'</option>';
                        }
                        ?>
                    </select>
                    <label>Clientes</label>
                </div>
            </div>


           <div class="row">
                <div class="input-field col s12">
                    <select required id="Direccion_label">
                        <option value=null disabled selected>Seleccione</option>
                        <?php
                        foreach ($Sel2 as $row){
                            echo '<option value="'.$row['codigodireccion'].'">'.$row['direccion'].'</option>';
                        }
                        ?>
                    </select>
                    <label>Direcciones</label>
                </div>
            </div>


           <div class="row">
                <div class="input-field col s12">
                    <select required id="Articulo_label">
                        <option value=null disabled selected>Seleccione</option>
                                <?php
                        foreach ($Sel3 as $row){
                            echo '<option value="'.$row['codigoarticulo'].'">'.$row['nombre'].'</option>';
                        }
                        ?>
                    </select>
                    <label>Articulos</label>
                </div>
            </div>



            <div class="row">
                <div class="input-field col s12">
                    <input placeholder="Cantidad" id="Cantidad_label" type="text" class="validate" required>
                    <label for="Cantidad_label">Cantidad</label>
                </div>
            </div>

             <div class="row">
                <div class="input-field col s12">
                    <input placeholder="Descuento" id="Descuento_label" type="text" class="validate" required>
                    <label for="Descuento_label">Descuento</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <input placeholder="Descripcion" id="Descripcion_label" type="text" class="validate" required>
                    <label for="Descripcion_label">Descripcion</label>
                </div>
            </div>

            <div class="modal-footer center">
                <a href="" class="modal-action modal-close waves-effect red white-text btn-flat ">Cancelar</a>
                <button id="Enviar" type="submit" class="modal-action waves-effect green white-text btn-flat">Aceptar</button>
            </div>
        </form>
    </div>
</div>



<!--Modal para dar de baja-->
<div id="baja" class="modal">
    <div class="modal-content">
        <form>
            <h4>Baja Pedidos</h4>
             <div>
                <input id="idEliminar" type="text" value="" hidden>
            </div>
            <p class="center">¿Desea eliminar el registro?</p>
            <div class="modal-footer center">
                <a class="modal-action modal-close waves-effect red white-text btn-flat ">Cancelar</a>
                <button id="BAja" class="modal-action waves-effect green white-text btn-flat">Aceptar</button>
            </div>
        </form>
    </div>
</div>


<div class="row">
    <div class="col l10 offset-l1 m12 s12">
        <div id="here_table">
        </div>
    </div>
</div>



<script>
var idedit="0";;

    /*CARGAR TABLA*/
    $(document).ready(Cargar);
    function Cargar(){
       $.ajax({
           url:"../BackEnd/Back.php",
           type:'post',
           data:({
            action:"Pedido",
               Metodo: "GetPedidos"
           }),
           success: function (data) {
               data=JSON.parse(data);
               if(data.length!=0){
                   for (var i in data){
                       $('#here_table').empty();
                       var table = $('<table class="responsive-table striped"><thead><tr><th>Codigo</th><th>Cliente</th><th>Direccion</th> <th>Fecha pedido</th> <th>Articulo</th><th>Descripcion</th><th>Cantidad</th><th>Importe</th><th>Descuento</th> <th class="center">Acciones</th> </tr> </thead></table>');
                       for(i=0; i<data.length; i++){
                           table.append('<tr><td>'+data[i].codigopedido+'</td><td>'+data[i].nombrecliente+'</td><td>'+data[i].direcciondeenvio+'</td><td>'+data[i].fechapedido+'</td><td>'+data[i].nombre+'</td> <td>'+data[i]. descripcionarticulo+'</td> <td>'+data[i].cantidadarticulos+'</td> <td>'+data[i].importetotal+'</td><td>'+data[i].descuento+'</td><td width="200"><a onclick="elementos(this.id)" id="'+data[i].codigopedido+'" class="small material-icons btn red">delete</a><a id="'+data[i].codigopedido+'" onclick="elementos2(this.id)" class="small material-icons btn yellow">mode_edit</a></td></tr>');
                       }
                       $('#here_table').append(table);
                   }
               }
               else{
                   $('#here_table').empty();
                   var table = $('<table class="responsive-table striped"><thead><tr><th>Codigo</th><th>Cliente</th><th>Direccion</th> <th>Fecha pedido</th> <th>Articulo</th><th>Descripcion</th><th>Cantidad</th><th>Importe</th><th>Descuento</th> <th class="center">Acciones</th> </tr> </thead></table>');
                   $('#here_table').append(table);
               }
           }
       });
    };


   function elementos(clicked_id) {
        $('#baja').openModal();
        $('#idEliminar').attr("value",clicked_id);
    }

    function elementos2(clicked_id) {
                        console.log("ENTRA y agrega?");

        //console.log(clicked_id);
        $('#alta').openModal();
        idedit=clicked_id;
        $.ajax({
            url:"../BackEnd/Back.php",
            type:'post',
            data:({
                action:"Pedido",
                Metodo: "GetPedidosPorId",
                id: clicked_id
            }),
            success: function (data) {
                console.log(data);
                data=JSON.parse(data);
                $('#Cantidad_label').val(data[0].cantidadarticulos);
                $('#Descuento_label').val(data[0].descuento);
                $('#Descripcion_label').val(data[0].descripcionarticulo);
            }
        });
        Cargar();
    }




   //funcion para dar de baja los registros
    $(function () {
        $('#BAja').click(function () {
            event.preventDefault();
            var id = $('#idEliminar').val();
            $.ajax({
                url:"../BackEnd/Back.php",
                type:'post',
                data:({
                    action:"Pedido",
                    Metodo: "Baja",
                    id: id
                }),
                success: function (data) {
                    console.log(data)
                    if(data==1){
                        Materialize.toast('Se Elimino con Exito', 4000,"green");
                        $('#baja').closeModal();
                    }
                    else
                        Materialize.toast('Error al Eliminar', 4000,"red");
                    Cargar();
                }
            });
        });
    });



    $(function (){
        $('#Enviar').click(function () {
                console.log("ENTRA?");

            var id=idedit;
                          

            event.preventDefault();
            var cliente=$('#Cliente_label').val();
            var articulo=$('#Articulo_label').val();
            var direccion=$('#Direccion_label').val();
            var cantidad= $('#Cantidad_label').val();
            var descuento=   $('#Descuento_label').val();
            var descripcion=$('#Descripcion_label').val();

            if(id!="0"){
                console.log("EDITAR"+idedit+" ");
                 console.log(" "+cliente+" ");
                 console.log(" "+articulo+" ");
                 console.log(" "+direccion+" ");
                 console.log(" "+cantidad+" ");
                 console.log(" "+descuento+" ");
                 console.log(" "+descripcion+" ");   

                $.ajax({
                url:"../BackEnd/Back.php",
                type:'post',
                data:({
                    action:"Pedido",
                    Metodo: "Cambio",
                    atributos:{
                        id:id,
                        d1:cliente,
                        d2:direccion,
                        d3:articulo,
                        d4:descripcion,
                        d5:cantidad,
                        d6:descuento
                    }
                }),
                success: function(data) {
                 //  console.log(data);
                    if(data=="1"){
                        Materialize.toast('Se Actualizo con Exito', 4000,"green");
                        $('#Cantidad_label').val("");
                        $('#Descuento_label').val("");
                             $('#Descripcion_label').val("");
                          idedit="0";
                        $('#alta').closeModal();
                    }
                    else if(data=="0")
                        Materialize.toast('Error al Insertar', 4000,"red");
                    else
                        Materialize.toast('Faltan Campaos por llenar', 4000,"yellow");
                    Cargar();
                }
                });
            }
            else{
                console.log("ENTRA AL ALTA");
                       console.log("ALTA"+idedit+" ");
                 console.log(" "+cliente+" ");
                 console.log(" "+articulo+" ");
                 console.log(" "+direccion+" ");
                 console.log(" "+cantidad+" ");
                 console.log(" "+descuento+" ");
                 console.log(" "+descripcion+" ");   

                $.ajax({
                    url:"../BackEnd/Back.php",
                    type:'post',
                    data:({
                        action:"Pedido",
                        Metodo: "Alta",
                        atributos:{
                         d1:cliente,
                        d2:direccion,
                        d3:articulo,
                        d4:descripcion,
                        d5:cantidad,
                        d6:descuento
                        }
                    }),
                    success: function(data) {
                  //      console.log(data);
                        if(data=="1"){
                            Materialize.toast('Se Inserto con Exito', 4000,"green");
                           $('#Cantidad_label').val("");
                        $('#Descuento_label').val("");
                             $('#Descripcion_label').val("");
                          idedit="0";
                        $('#alta').closeModal();

                        }
                        else if(data=="0")
                            Materialize.toast('Error al Insertar', 4000,"red");
                        else
                            Materialize.toast('Faltan Campsos por llenar', 4000,"yellow");

                        Cargar();
                    }

                });
            };
        });
    });

    $(document).ready(function() {
        $('select').material_select();
    });
    $('.modal-trigger1').leanModal({
            dismissible: true
        }
    );
</script>

<?php } } ?>
﻿<?php
session_start();
if(!isset($_SESSION["Validado"])) {
    header("location:../");
}
else {
if($_SESSION['Validado']=="aceptado"){
    include "BarNav.php";
    require_once "imports2.php";
    require_once "../BackEnd/CargaSelect.php";
    $Articulos =new CargaSelect();
    $_pro=$Articulos->get_provedor();
?>
<head>
    <title>Gestion de articulos</title>
    <meta charset="utf-8" />
</head>
<!--PArte prinsipal de la pagina Muestra botones y tabla-->
<div class="row">
    <div class="col l10 offset-l1 m12 s12">
        <br>
        <h5 class="center">Gestion de articulos</h5>
        <br><hr><br>
        <a href="#alta" class="btn-floating btn-large waves-effect waves-light green white-text modal-trigger1 right"><i class="material-icons">add</i></a>
    </div>
</div>
<div class="row">
    <div class="col l10 offset-l1 m12 s12">
        <div id="here_table">
        </div>
    </div>
</div>


<!--Modal para dar de baja-->
<div id="baja" class="modal">
    <div class="modal-content">
        <form>
            <h4>Baja Arciculo</h4>
            <p class="center">¿Desea eliminar el registro?</p>
            <div>
                <input id="idEliminar" type="text" value="" hidden>
            </div>
            <div class="modal-footer center">
                <a class="modal-action modal-close waves-effect red white-text btn-flat ">Cancelar</a>
                <button id="BAja" class="modal-action waves-effect green white-text btn-flat">Aceptar</button>
            </div>
        </form>
    </div>
</div>


<!--Modal para dar de alta y edicion-->
<div id="alta" class="modal">
    <div class="modal-content">
        <form id="AltaArticulo" data-parsley-validate >
            <h4>Alta Articulo</h4>
            <div>
                <input id="idCambio" type="text" value="" hidden>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input placeholder="Nombre" id="Nombre_label" type="text" class="validate">
                    <label for="Nombre_label">Nombre</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input placeholder="Precio Venta" id="pv_label" type="text" class="validate" >
                    <label for="pv_label">Precio Venta</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input placeholder="Precio Farbrica" id="pf_label" type="text" class="validate">
                    <label for="pf_label">Precio Farbrica</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <select id="Proveedor_label" >
                        <option value="" disabled selected>Elige tu opcion</option>
                        <?php
                        foreach ($_pro as $row){
                            echo '<option value="'.$row['codigoproveedor'].'">'.$row['nombreproveedor'].'</option>';
                        }
                        ?>
                    </select>
                    <label for="Proveedor_label">Proveedor</label>
                </div>
            </div>
            <div class="modal-footer center">
                <a class="modal-action modal-close waves-effect red white-text btn-flat ">Cancelar</a>
                <button id="Enviar" class="modal-action waves-effect green white-text btn-flat">Aceptar</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Esto Carga LA tabla Automaticamente
    $(document).ready(Cargar);
    function Cargar(){
       $.ajax({
           url:"../BackEnd/Back.php",
           type:'post',
           data:({
               action:"articulos",
               Metodo: "GetArticulos"
           }),
           success: function (data) {
               data=JSON.parse(data);
               if(data.length!=0){
                   for (var i in data){
                       $('#here_table').empty();
                       var table = $('<table class="responsive-table striped"><thead><tr><th>Codigo</th><th>Nombre</th><th>Precio Venta</th> <th>Precio Fabrica</th> <th>Provedor</th> <th class="center">Acciones</th> </tr> </thead></table>');
                       for(i=0; i<data.length; i++){
                           table.append('<tr><td>'+data[i].codigoarticulo+'</td><td>'+data[i].nombre+'</td><td>'+data[i].precioventa+'</td><td>'+data[i].preciofabrica+'</td><td>'+data[i].nombreproveedor+'</td><td width="200"><a onclick="elementos(this.id)" id="'+data[i].codigoarticulo+'" class="small material-icons btn red">delete</a><a id="'+data[i].codigoarticulo+'" onclick="elementos2(this.id)" class="small material-icons btn yellow">mode_edit</a></td></tr>');
                       }
                       $('#here_table').append(table);
                   }
               }
               else{
                   $('#here_table').empty();
                   var table = $('<table class="responsive-table striped"><thead><tr><th>Codigo</th><th>Nombre</th><th>Precio Venta</th> <th>Precio Fabrica</th> <th>Provedor</th> <th class="center">Acciones</th> </tr> </thead></table>');
                   $('#here_table').append(table);
               }
           }
       });
    };

    //estoy son inicialodres para materialize
    $(document).ready(function() {
        $('select').material_select();
    });
    $('.modal-trigger1').leanModal({
            dismissible: true
        }
    );
    $('.modal-trigger2').leanModal({
            dismissible: true
        }
    );
    //esta funcion abre el modal y carga el valor selecionado en la tabla
    function elementos(clicked_id) {
        //console.log(clicked_id);
        $('#baja').openModal();
        $('#idEliminar').attr("value",clicked_id);
    }
    //esta funcion abre el modal de alta y carga el valor selecionado en la tabla
    function elementos2(clicked_id) {
        //console.log(clicked_id);
        $('#alta').openModal();
        $('#idCambio').attr("value",clicked_id);
        $('#idCambio').val(clicked_id);
        $.ajax({
            url:"../BackEnd/Back.php",
            type:'post',
            data:({
                action:"articulos",
                Metodo: "GetFila",
                id: clicked_id
            }),
            success: function (data) {
                console.log(data);
                data=JSON.parse(data);
                $('#Nombre_label').val(data[0].nombre);
                $('#pv_label').val(data[0].precioventa);
                $('#pf_label').val(data[0].preciofabrica);
                $('#Proveedor_label').attr("value",data[0].codigoproveedor);
            }
        });
        Cargar();
    }

    //funcion para dar de baja los registros

    $(function () {
        $('#BAja').click(function () {
            event.preventDefault();
            var nombre = $('#idEliminar').val();
            //console.log(nombre);
            $.ajax({
                url:"../BackEnd/Back.php",
                type:'post',
                data:({
                    action:"articulos",
                    Metodo: "Baja",
                    atributos: nombre
                }),
                success: function (data) {
              //      console.log(data)
                    if(data=="true"){
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

    //funcion paa dar de alta y cambios en un registro

    $(function (){
        $('#Enviar').click(function () {
            var id=$('#idCambio').val();
            event.preventDefault();
            var nombre=$('#Nombre_label').val();
            var pv_label=$('#pv_label').val();
            var pf_label=$('#pf_label').val();
            var Proveedor_label=$('#Proveedor_label').val();
            if(id!=""){
                $.ajax({
                url:"../BackEnd/Back.php",
                type:'post',
                data:({
                    action:"articulos",
                    Metodo: "Cambio",
                    atributos:{
                        id:id,
                        n:nombre,
                        p1:pv_label,
                        p2:pf_label,
                        p3:Proveedor_label
                    }
                }),
                success: function(data) {
                   console.log(data);
                    if(data=="1"){
                        Materialize.toast('Se Actualizo con Exito', 4000,"green");
                        $('#idCambio').val("");
                        $('#Nombre_label').val("");
                        $('#pv_label').val("");
                        $('#pf_label').val("");
                        $('#alta').closeModal();
                    }
                    else if(data=="0")
                        Materialize.toast('Error al Insertar', 4000,"red");
                    else
                        Materialize.toast('Faltan Campos por llenar', 4000,"yellow");
                    Cargar();
                }
                });
            }
            else{
                $.ajax({
                    url:"../BackEnd/Back.php",
                    type:'post',
                    data:({
                        action:"articulos",
                        Metodo: "alta",
                        atributos:{
                            n:nombre,
                            p1:pv_label,
                            p2:pf_label,
                            p3:Proveedor_label
                        }
                    }),
                    success: function(data) {
                  //      console.log(data);
                        if(data=="1"){
                            Materialize.toast('Se Inserto con Exito', 4000,"green");
                            $('#Nombre_label').val("");
                            $('#pv_label').val("");
                            $('#pf_label').val("");
                            $('#alta').closeModal();
                        }
                        else if(data=="0")
                            Materialize.toast('Error al Insertar', 4000,"red");
                        else
                            Materialize.toast('Faltan Campos por llenar', 4000,"yellow");

                        Cargar();
                    }

                });
            };
        });
    });
</script>
<?php } } ?>
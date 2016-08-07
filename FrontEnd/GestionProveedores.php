<?php
    include "BarNav.php";
    require_once "imports2.php";
?>
<head>
    <title>Gestion de Proveedores</title>
    <meta charset="utf-8" />
</head>
<div class="row">
    <div class="col l10 offset-l1 m12 s12">
        <br>
        <h5 class="center">Gestion de Proveedores</h5>
        <br><hr><br>
        <a href="#alta" class="btn-floating btn-large waves-effect waves-light green white-text modal-trigger1 right"><i class="material-icons">+</i></a>
    </div>
</div>



<!-- Modal para dar de alta y editar -->
<div id="alta" class="modal">
    <div class="modal-content">
        <form id="AltaProveedor">
            <h4>Alta Proveedores</h4>
            <div class="row">
                <div class="input-field col s12">
                    <input placeholder="Nombre" id="Nombre_label" type="text" class="validate" required>
                    <label for="Nombre_label">Nombre</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <input placeholder="Telefono" id="Telefono_label" type="text" class="validate" required>
                    <label for="Telefono_label">Telefono</label>
                </div>
            </div>


                          <div class="row">
                <div class="input-field col s12">
                    <select required id="TipoDeProvedor_label">
                        <option value=null disabled selected>Seleccione</option>
                        <option value="1">Principal</option>
                        <option value="2">Secundario</option>
                    </select>
                    <label>Tipo de proveedor</label>
                </div>
            </div>


            <div class="modal-footer center">
                <a href="" class="modal-action modal-close waves-effect red white-text btn-flat ">Cancelar</a>
                <button id="Enviar"  type="submit" class="modal-action waves-effect green white-text btn-flat">Aceptar</button>
            </div>
        </form>
    </div>
</div>



<!--Modal para dar de baja-->
<div id="baja" class="modal">
    <div class="modal-content">
        <form>
            <h4>Baja Proveedores</h4>
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
        <div id="Tabla">
        </div>
    </div>
</div>



<script>
var idedit="0";;
    $(document).ready(function() {
        $('select').material_select();
    });
    $('.modal-trigger1').leanModal({
            dismissible: true
        }
    );

   function elementos(clicked_id) {
        $('#baja').openModal();
        $('#idEliminar').attr("value",clicked_id);
    }

    function elementos2(clicked_id) {
        //console.log(clicked_id);
        $('#alta').openModal();
        idedit=clicked_id;
        $.ajax({
            url:"../BackEnd/Back.php",
            type:'post',
            data:({
                action:"Proveedor",
                Metodo: "GetProveedoresPorId",
                id: clicked_id
            }),
            success: function (data) {
                console.log(data);
                data=JSON.parse(data);
                $('#Nombre_label').val(data[0].nombreproveedor);
                $('#Telefono_label').val(data[0].telefono);
            }
        });
        Cargar();
    }


/*CARGAR LA TABLA*/
    // Esto Carga LA tabla Automaticamente
    $(document).ready(Cargar);
    function Cargar(){

       $.ajax({
           url:"../BackEnd/Back.php",
           type:'post',
           data:({
               action:"Proveedor",
               Metodo: "GetProveedores"
           }),
           success: function (data) {

               data=JSON.parse(data);

               if(data.length!=0){
                   for (var i in data){
                     //console.log("data");
                       $('#Tabla').empty();
                       var table = $('<table class="responsive-table striped"><thead><tr><th>Codigo</th><th>Nombre</th><th>Telefono</th> <th>Total artiulos que provee</th> <th>Tipo proveedor</th> <th class="center">Acciones</th> </tr> </thead></table>');
                       for(i=0; i<data.length; i++){
                           table.append('<tr><td>'+data[i].codigoproveedor+'</td><td>'+data[i].nombreproveedor+'</td><td>'+data[i].telefono+'</td><td>'+data[i].totalarticulosqueprovee+'</td><td>'+data[i].tipo+'</td><td width="200"><a onclick="elementos(this.id)" id="'+data[i].codigoproveedor+'" class="small material-icons btn red">delete</a><a id="'+data[i].codigoproveedor+'" onclick="elementos2(this.id)" class="small material-icons btn yellow">mode_edit</a></td></tr>');
                       }
                       $('#Tabla').append(table);
                   }
               }
               else{
                   $('#Tabla').empty();
                   var table = $('<table class="responsive-table striped"><thead><tr><th>Codigo</th><th>Nombre</th><th>Telefono</th> <th>Total artiulos que provee</th> <th>Tipo proveedor</th> <th class="center">Acciones</th> </tr> </thead></table>');
                   $('#Tabla').append(table);
               }
           }
       });
    };


   //funcion para dar de baja los registros
    $(function () {
        $('#BAja').click(function () {
            event.preventDefault();
            var id = $('#idEliminar').val();
            $.ajax({
                url:"../BackEnd/Back.php",
                type:'post',
                data:({
                    action:"Proveedor",
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

            var id=idedit;
                          console.log("HOLA"+idedit+"HOLA");

            event.preventDefault();
            var nombre=$('#Nombre_label').val();
            var telefo=$('#Telefono_label').val();
            var tipoprove=$('#TipoDeProvedor_label').val();
            

              

            if(id!="0"){
                $.ajax({
                url:"../BackEnd/Back.php",
                type:'post',
                data:({
                    action:"Proveedor",
                    Metodo: "Cambio",
                    atributos:{
                        id:id,
                        d1:nombre,
                        d2:telefo,
                        d3:tipoprove
                    }
                }),
                success: function(data) {
                 //  console.log(data);
                    if(data=="1"){
                        Materialize.toast('Se Actualizo con Exito', 4000,"green");
                        $('#Nombre_label').val("");
                        $('#Telefono_label').val("");
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
                $.ajax({
                    url:"../BackEnd/Back.php",
                    type:'post',
                    data:({
                        action:"Proveedor",
                        Metodo: "Alta",
                        atributos:{
                        d1:nombre,
                        d2:telefo,
                        d3:tipoprove
                        }
                    }),
                    success: function(data) {
                  //      console.log(data);
                        if(data=="1"){
                            Materialize.toast('Se Inserto con Exito', 4000,"green");
                        $('#Nombre_label').val("");
                        $('#Telefono_label').val("");
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

</script>

















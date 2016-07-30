<?php
    require_once "imports2.php";
    require_once "../BackEnd/Articulos.php";

    $Articulos =new Articulos();
    $a_articulos=$Articulos->get_articulos();
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
            <p class="center">Esta seguro que desea eliminarlo?</p>
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
                                echo '<option value="'.$row['CodigoProveedor'].'">'.$row['Nombre'].'</option>';
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
               //console.log(data);
               data=JSON.parse(data);
               for (var i in data){
                   $('#here_table').empty();
                   var table = $('<table class="responsive-table striped"><thead><tr><th>Codigo</th><th>Nombre</th><th>Precio Venta</th> <th>Precio Fabrica</th> <th>Provedor</th> <th class="center">Acciones</th> </tr> </thead></table>');
                   for(i=0; i<data.length; i++){
                       table.append('<tr><td>'+data[i].CodigoArticulo+'</td><td>'+data[i].Nombre+'</td><td>'+data[i].PrecioVenta+'</td><td>'+data[i].PrecioFabrica+'</td><td>'+data[i].NombreProveedor+'</td><td width="200"><a onclick="elementos(this.id)" id="'+data[i].CodigoArticulo+'" class="small material-icons btn red">delete</a><a id="'+data[i].CodigoArticulo+'" onclick="elementos2(this.id)" class="small material-icons btn yellow">mode_edit</a></td></tr>');
                   }
                   $('#here_table').append(table);
               }
           }
       });
    };


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
    function elementos(clicked_id) {
        //console.log(clicked_id);
        $('#baja').openModal();
        $('#idEliminar').attr("value",clicked_id);
    }
    function elementos2(clicked_id) {
        //console.log(clicked_id);
        $('#alta').openModal();
        $('#idCambio').attr("value",clicked_id);
        $.ajax({
            url:"../BackEnd/Back.php",
            type:'post',
            data:({
                action:"articulos",
                Metodo: "GetFila",
                id: clicked_id
            }),
            success: function (data) {
          //      console.log(data);
                data=JSON.parse(data);
                $('#Nombre_label').attr("value",data[0].Nombre);
                $('#pv_label').attr("value",data[0].PrecioVenta);
                $('#pf_label').attr("value",data[0].PrecioFabrica);
            }
        });
        Cargar();
    }
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
    $(function (){
        $('#Enviar').click(function () {
            event.preventDefault();
            var nombre=$('#Nombre_label').val();
            var pv_label=$('#pv_label').val();
            var pf_label=$('#pf_label').val();
            var Proveedor_label=$('#Proveedor_label').val();
            var id=$('#idCambio').val();
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
                //    console.log(data);
                    if(data=="1"){
                        Materialize.toast('Se Inserto/Actualizo con Exito', 4000,"green");
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
                            Materialize.toast('Se Inserto/Actualizo con Exito', 4000,"green");
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
                id="";
            };

        });
    });
</script>

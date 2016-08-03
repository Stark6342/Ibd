<?php
    require_once "imports2.php";
    require_once "../BackEnd/CargaSelect.php";

    $pobla=new CargaSelect();
    $_pop=$pobla->get_poblacion();
?>
<head>
    <title>Gestion Centro de Trabajo</title>
    <meta charset="utf-8" />
</head>
<div class="row">
    <div class="col l10 offset-l1 m12 s12">
        <br>
        <h5 class="center">Gestion Centro de Trabajo</h5>
        <br><hr><br>
        <a href="#alta" class="btn-floating btn-large waves-effect waves-light green white-text modal-trigger1 right"><i class="material-icons">add</i></a>
    </div>
</div>
<div class="row">
    <div class="col l10 offset-l1 m12 s12">
        <div id="Tabla">
        </div>
    </div>
</div>


<!-- Modal para dar de alta y editar -->
<div id="alta" class="modal">
    <div class="modal-content">
        <form id="AltaCDT">
            <h4>Alta Centro de trabajo</h4>
            <div>
                <input id="idCambio" type="text" value="" hidden>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input placeholder="Nombre" id="Nombre_label" type="text" class="validate" required>
                    <label for="Nombre_label">Nombre</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <select required id="Poblacion_label">
                        <option value=null disabled selected>Elije Poblacion</option>
                        <?php
                        foreach ($_pop as $row){
                            echo '<option value="'.$row['idpoblacion'].'">'.$row['nombre'].'</option>';
                        }
                        ?>
                    </select>
                    <label>Poblacion</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <input placeholder="Colonia" id="Colonia_label" type="text" class="validate" required>
                    <label for="Colonia_label">Colonia</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input placeholder="Numero extrior" id="NumeroExterior_label" type="text" class="validate" required>
                    <label for="NumeroExterior_label">Numero extrior</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input placeholder="Calle" id="Calle_label" type="text" class="validate" required>
                    <label for="Calle_label">Calle</label>
                </div>
            </div>
                          <div class="row">
                <div class="input-field col s12">
                    <select required id="Director_label">
                        <option value=null disabled selected>Seleccione</option>
                        <option value="1">Empleado 1</option>
                        <option value="2">Empleado 2</option>
                        <option value="3">Empleado 3</option>
                    </select>
                    <label>Director</label>
                </div>
            </div>
            <div class="modal-footer center">
                <a href="" class="modal-action modal-close waves-effect red white-text btn-flat ">Cancelar</a>
                <button type="submit" class="modal-action waves-effect green white-text btn-flat">Aceptar</button>
            </div>
        </form>
    </div>
</div>



<!--Modal para dar de baja-->
<div id="baja" class="modal">
    <div class="modal-content">
        <form>
            <h4>Baja Centro de Trabajo</h4>
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


<script>
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

    /* Para la carga de la tabla*/
    $(document).ready(Cargar);
    function Cargar(){
        $.ajax({
            url:"../BackEnd/Back.php",
            type:'post',
            data:({
                action:"CentroTrabajo",
                Metodo: "GetCdt"
            }),
            success: function (data) {
                data=JSON.parse(data);
                if(data.length!=0){
                    $('#Tabla').empty();
                    var table = $('<table class="responsive-table striped"><thead><tr><th>Codigo</th> <th>Nombre</th> <th>Poblacion</th><th>Direccion</th> <th>Director</th><th class="center">Acciones</th></tr></thead></table>');
                    for(i=0; i<data.length; i++){
                        table.append('<tr><td>'+data[i].CodigoCDT+'</td><td>'+data[i].NombreCDT+'</td><td>'+data[i].nombrepoblacion+'</td><td>'+data[i].direccion+'</td><td>'+data[i].Director+'</td><td width="200"><a onclick="elementos(this.id)" id="'+data[i].CodigoCDT+'" class="small material-icons btn red">delete</a><a id="'+data[i].CodigoCDT+'" onclick="elementos2(this.id)" class="small material-icons btn yellow">mode_edit</a></td></tr>');
                    }
                    $('#Tabla').append(table);

                }
                else{
                    $('#Tabla').empty();
                    var table = $('<table class="responsive-table striped"><thead><tr><th>Codigo</th><th>Nombre</th><th>Precio Venta</th> <th>Precio Fabrica</th> <th>Provedor</th> <th class="center">Acciones</th> </tr> </thead></table>');
                    $('#Tabla').append(table);
                }
            }
        });
    };

    //funcion para dar de baja
    $(function () {
        $('#BAja').click(function () {
            event.preventDefault();
            var id = $('#idEliminar').val();
            $.ajax({
                url:"../BackEnd/Back.php",
                type:'post',
                data:({
                    action:"CentroTrabajo",
                    Metodo: "Baja",
                    id: id
                }),
                success: function (data) {
                    console.log(data);
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


    //Funcion para enviar y editar
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
            };
        });
    });
</script>

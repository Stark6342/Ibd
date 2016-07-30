<?php
    require_once "imports2.php";
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
            <div class="row">
                <div class="input-field col s12">
                    <input placeholder="Nombre" id="Nombre_label" type="text" class="validate" required>
                    <label for="Nombre_label">Nombre</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <select required id="Poblacion_label">
                        <option value=null disabled selected>Seleccione</option>
                        <option value="1">Poblacion 1</option>
                        <option value="2">Poblacion 2</option>
                        <option value="3">Poblacion 3</option>
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
            <p class="center">¿Desea eliminar el registro?</p>
            <div class="modal-footer center">
                <a class="modal-action modal-close waves-effect red white-text btn-flat ">Cancelar</a>
                <button id="Baja" class="modal-action waves-effect green white-text btn-flat">Aceptar</button>
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
                /*if(data.length!=0){
                    for (var i in data){
                        $('#Tabla').empty();
                        var table = $('<table class="responsive-table striped"><thead><tr><th>Codigo</th><th>Nombre</th><th>Precio Venta</th> <th>Precio Fabrica</th> <th>Provedor</th> <th class="center">Acciones</th> </tr> </thead></table>');
                        for(i=0; i<data.length; i++){
                            table.append('<tr><td>'+data[i].CodigoArticulo+'</td><td>'+data[i].Nombre+'</td><td>'+data[i].PrecioVenta+'</td><td>'+data[i].PrecioFabrica+'</td><td>'+data[i].NombreProveedor+'</td><td width="200"><a onclick="elementos(this.id)" id="'+data[i].CodigoArticulo+'" class="small material-icons btn red">delete</a><a id="'+data[i].CodigoArticulo+'" onclick="elementos2(this.id)" class="small material-icons btn yellow">mode_edit</a></td></tr>');
                        }
                        $('#Tabla').append(table);
                    }
                }
                else{
                    $('#Tabla').empty();
                    var table = $('<table class="responsive-table striped"><thead><tr><th>Codigo</th><th>Nombre</th><th>Precio Venta</th> <th>Precio Fabrica</th> <th>Provedor</th> <th class="center">Acciones</th> </tr> </thead></table>');
                    $('#Tabla').append(table);
                }*/
                console.log(data);
            }
        });
    };
</script>

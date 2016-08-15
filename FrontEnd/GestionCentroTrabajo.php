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

    $pobla=new CargaSelect();
    $_pop=$pobla->get_poblacion();
    $_pop1=$pobla->get_empleados();

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
                          <?php
                        foreach ($_pop1 as $row){
                            echo '<option value="'.$row['codigoempleado'].'">'.$row['nombre'].'</option>';
                        }
                        ?>
                    </select>
                    <label>Director</label>
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
//var idedit="0";
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
        console.log(clicked_id);
        $('#alta').openModal();
       $('#idCambio').attr("value",clicked_id);
       $('#idCambio').val(clicked_id);
        $.ajax({
            url:"../BackEnd/Back.php",
            type:'post',
            data:({
                action:"CentroTrabajo",
                Metodo: "GetCdtPorId",
                id: clicked_id
            }),
            success: function (data) {
                console.log(data);
                data=JSON.parse(data);
                $('#Nombre_label').val(data[0].nombrecdt);
                $('#Colonia_label').val(data[0].colonia);
                $('#NumeroExterior_label').val(data[0].numero);
                $('#Calle_label').val(data[0].calle);
            }
        });
        Cargar();
    }



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
                        table.append('<tr><td>'+data[i].codigocdt+'</td><td>'+data[i].nombrecdt+'</td><td>'+data[i].nombrepoblacion+'</td><td>'+data[i].direccion+'</td><td>'+data[i].director+'</td><td width="200"><a onclick="elementos(this.id)" id="'+data[i].codigocdt+'" class="small material-icons btn red">delete</a><a id="'+data[i].codigocdt+'" onclick="elementos2(this.id)" class="small material-icons btn yellow">mode_edit</a></td></tr>');
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
            console.log(id);
            event.preventDefault();
            var nombre=$('#Nombre_label').val();
            var pob=$('#Poblacion_label').val();
            var col=$('#Colonia_label').val();
            var numext=$('#NumeroExterior_label').val();
            var call=$('#Calle_label').val();
            var prov=$('#Director_label').val();
            if(id!=""){
                console.log("EDITAR");
                $.ajax({
                    url:"../BackEnd/Back.php",
                    type:'post',
                    data:({
                        action:"CentroTrabajo",
                        Metodo: "Cambio",
                        atributos:{
                            id:id,
                            p1:nombre,
                            p2:pob,
                            p3:col,
                            p4:call,
                            p5:numext,
                            p6:prov
                        }
                    }),
                    success: function(data) {
                        //    console.log(data);
                        if(data=="1"){
                            Materialize.toast('Se Inserto/Actualizo con Exito', 4000,"green");
                             idedit="0";
                            $('#Nombre_label').val("");
                            $('#Colonia_label').val("");
                            $('#NumeroExterior_label').val("");
                            $('#Calle_label').val("");
                            $('#idCambio').val("");
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
                console.log("ALTA");
                $.ajax({
                    url:"../BackEnd/Back.php",
                    type:'post',
                    data:({
                        action:"CentroTrabajo",
                        Metodo: "Alta",
                        atributos:{
                            p1:nombre,
                            p2:pob,
                            p3:col,
                            p4:call,
                            p5:numext,
                            p6:prov
                        }
                    }),
                    success: function(data) {
                        console.log(data);
                        if(data=="1"){
                            Materialize.toast('Se Inserto/Actualizo con Exito', 4000,"green");
                             idedit="0";
                            $('#Nombre_label').val("");
                            $('#Colonia_label').val("");
                            $('#NumeroExterior_label').val("");
                            $('#Calle_label').val("");
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
<?php
    include "BarNav.php";
    require_once "imports2.php";
    require_once "../BackEnd/CargaSelect.php";

    $pobla=new CargaSelect();
    $_pop=$pobla->get_habilidad();
    $_pop1=$pobla->get_empleados()

?>
<head>
    <title>Habilidades de empleados</title>
    <meta charset="utf-8" />
</head>
<div class="row">
    <div class="col l10 offset-l1 m12 s12">
        <br>
        <h5 class="center">Habilidades de empleados</h5>
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
        <form id="AltaHE">
            <h4>Agregar habilidad</h4>

            <div class="row">
                <div class="input-field col s12">
                    <select required id="Habilidad_label">
                        <option value=null disabled selected>Seleccione</option>
                        <?php
                        foreach ($_pop as $row){
                            echo '<option value="'.$row['codigohabilidad'].'">'.$row['habilidad'].'</option>';
                        }
                        ?>
                    </select>
                    <label>Habilidad</label>
                </div>
            </div>


                          <div class="row">
                <div class="input-field col s12">
                    <select required id="Empleado_label">
                        <option value=null disabled selected>Seleccione</option>
  <?php
                        foreach ($_pop1 as $row){
                            echo '<option value="'.$row['codigoempleado'].'">'.$row['nombre'].'</option>';
                        }
                        ?>
                    </select>
                    <label>Empleado</label>
                </div>
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
            <h4>Quitar habilidad</h4>
            <div>
                <input id="idEliminar" type="text" value="" >
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
var idedit="0";
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
                action:"Habilidades",
                Metodo: "GetHabilidades"
            }),
            success: function (data) {
                data=JSON.parse(data);
                if(data.length!=0){
                    $('#Tabla').empty();
                    var table = $('<table class="responsive-table striped"><thead><tr><th>Empleado</th> <th>Habilidad</th><th>Descripcion habilidad</th><th class="center">Acciones</th></tr></thead></table>');
                    for(i=0; i<data.length; i++){
                        table.append('<tr><td>'+data[i].nombreempleado+' '+data[i].apellidopempleado+' '+data[i].apellidomempleado+'</td><td>'+data[i].habilidad+'</td><td>'+data[i].desripcion+'</td><td width="200"><a onclick="elementos(this.id)" id="'+data[i].codigo+'" class="small material-icons btn red">delete</a></td></tr>');
                    }
                    $('#Tabla').append(table);

                }
                else{
                    $('#Tabla').empty();
                    var table = $('<table class="responsive-table striped"><thead><tr><th>Empleado</th> <th>Habilidad</th><th>Descripcion habilidad</th><th class="center">Acciones</th></tr></thead></table>');
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
            console.log(id);
            $.ajax({
                url:"../BackEnd/Back.php",
                type:'post',
                data:({
                    action:"Habilidades",
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
            var id=idedit;
            event.preventDefault();
            var em=$('#Empleado_label').val();
            var hab=$('#Habilidad_label').val();
  $.ajax({
                    url:"../BackEnd/Back.php",
                    type:'post',
                    data:({
                        action:"Habilidades",
                        Metodo: "Alta",
                        atributos:{
                            p1:em,
                            p2:hab
                        }
                    }),
                    success: function(data) {
                        //      console.log(data);

                        if(data=="1"){
                            Materialize.toast('Se Inserto/Actualizo con Exito', 4000,"green");
                            $('#Empleado_label').val("");
                            $('#Habilidad_label').val("");

                            $('#alta').closeModal();
                        }
                        else if(data=="0")
                            Materialize.toast('Error al Insertar', 4000,"red");
                        else
                            Materialize.toast('Faltan Campos por llenar', 4000,"yellow");
                        Cargar();
                    }
                });


        });
    });
</script>

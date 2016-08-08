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
    $CDT=new CargaSelect();
    $_pop=$CDT->get_CDT();


?>
<head>
    <title>Gestion de Departamentos</title>
    <meta charset="utf-8" />
</head>
<div class="row">
    <div class="col l10 offset-l1 m12 s12">
        <br>
        <h5 class="center">Gestion de Departamentos</h5>
        <br><hr><br>
        <a href="#alta" class="btn-floating btn-large waves-effect waves-light green white-text modal-trigger1 right"><i class="material-icons">+</i></a>
    </div>
</div>



<!-- Modal para dar de alta y editar -->
<div id="alta" class="modal">
    <div class="modal-content">
        <form id="AltaDepartamento">
            <h4>Alta Departamentos</h4>
            <div class="row">
                <div class="input-field col s12">
                    <input placeholder="Nombre" id="Nombre_label" type="text" class="validate" required>
                    <label for="Nombre_label">Nombre</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <input placeholder="Presupuesto Anual" id="PresupuestoAnual_label" type="text" class="validate" required>
                    <label for="PresupuestoAnual_label">Presupuesto Anual</label>
                </div>
            </div>
                          <div class="row">
                <div class="input-field col s12">
                    <select required id="CDT_label">
                        <option value=null disabled selected>Seleccione</option>
                             <?php
                        foreach ($_pop as $row){
                            echo '<option value="'.$row['codigocdt'].'">'.$row['nombrecdt'].'</option>';
                        }
                        ?>
                    </select>

                    <label>Centro de trabajo</label>
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
            <h4>Baja Departamento</h4>
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
<<<<<<< HEAD
</script>
<?php } } ?>
=======

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
                action:"Departamento",
                Metodo: "GetDepartamentosPorId",
                id: clicked_id
            }),
            success: function (data) {
                console.log(data);
                data=JSON.parse(data);
                $('#Nombre_label').val(data[0].nombre);
                $('#PresupuestoAnual_label').val(data[0].presupuestoanual);
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
               action:"Departamento",
               Metodo: "GetDepartamentos"
           }),
           success: function (data) {

               data=JSON.parse(data);

               if(data.length!=0){
                   for (var i in data){
                     //console.log("data");
                       $('#Tabla').empty();
                       var table = $('<table class="responsive-table striped"><thead><tr><th>Codigo</th><th>Nombre</th><th>Presupuesto anual</th> <th>Centro de Trabajo</th><th class="center">Acciones</th> </tr> </thead></table>');
                       for(i=0; i<data.length; i++){
                           table.append('<tr><td>'+data[i].codigodepartamento+'</td><td>'+data[i].nombre+'</td><td>'+data[i].presupuestoanual+'</td><td>'+data[i].nombrecdt+'</td><td width="200"><a onclick="elementos(this.id)" id="'+data[i].codigodepartamento+'" class="small material-icons btn red">delete</a><a id="'+data[i].codigodepartamento+'" onclick="elementos2(this.id)" class="small material-icons btn yellow">mode_edit</a></td></tr>');
                       }
                       $('#Tabla').append(table);
                   }
               }
               else{
                   $('#Tabla').empty();
                   var table = $('<table class="responsive-table striped"><thead><tr><th>Codigo</th><th>Nombre</th><th>Presupuesto anual</th> <th>Centro de Trabajo</th><th class="center">Acciones</th> </tr> </thead></table>');
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
                    action:"Departamento",
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
                          

            event.preventDefault();
            var nombre=$('#Nombre_label').val();
            var presup=$('#PresupuestoAnual_label').val();
            var CDTVAR=$('#CDT_label').val();
            

            if(id!="0"){
                console.log("HOLA"+idedit+"HOLA");
console.log("HOLA"+nombre+"HOLA");
console.log("HOLA"+presup+"HOLA");
console.log("HOLA"+CDTVAR+"HOLA");

                $.ajax({
                url:"../BackEnd/Back.php",
                type:'post',
                data:({
                    action:"Departamento",
                    Metodo: "Cambio",
                    atributos:{
                        id:id,
                        p1:nombre,
                        p2:presup,
                        p3:CDTVAR
                    }
                }),
                success: function(data) {
                 //  console.log(data);
                    if(data=="1"){
                        Materialize.toast('Se Actualizo con Exito', 4000,"green");
                        $('#Nombre_label').val("");
                        $('#PresupuestoAnual_label').val("");
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
                        action:"Departamento",
                        Metodo: "Alta",
                        atributos:{
                        p1:nombre,
                        p2:presup,
                        p3:CDTVAR
                        }
                    }),
                    success: function(data) {
                  //      console.log(data);
                        if(data=="1"){
                            Materialize.toast('Se Inserto con Exito', 4000,"green");
                        $('#Nombre_label').val("");
                        $('#PresupuestoAnual_label').val("");
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
>>>>>>> 974d2f1bfca4d93b1f2bf9596dd85186aa02e50a

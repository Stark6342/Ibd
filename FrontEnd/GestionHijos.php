<?php
    include "BarNav.php";
    require_once "imports2.php";
        require_once "../BackEnd/CargaSelect.php";

      $Pob=new CargaSelect();
    $_pop=$Pob->get_poblacion();
    $_pop1=$Pob->get_empleados()
?>
<head>
    <title>Gestion de Hijos</title>
    <meta charset="utf-8" />
</head>
<div class="row">
    <div class="col l10 offset-l1 m12 s12">
        <br>
        <h5 class="center">Gestion de Hijos</h5>
        <br><hr><br>
        <a href="#alta" class="btn-floating btn-large waves-effect waves-light green white-text modal-trigger1 right"><i class="material-icons">+</i></a>
    </div>
</div>



<!-- Modal para dar de alta y editar -->
<div id="alta" class="modal">
    <div class="modal-content">
        <form id="AltaHijo">
            <h4>Alta Hijos</h4>
            <div class="row">
                <div class="input-field col s12">
                    <input placeholder="Nombre" id="Nombre_label" type="text" class="validate" required>
                    <label for="Nombre_label">Nombre</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <input placeholder="ApellidoP" id="ApellidoP_label" type="text" class="validate" required>
                    <label for="ApellidoP_label">Apellido Paterno</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <input placeholder="ApellidoM" id="ApellidoM_label" type="text" class="validate" required>
                    <label for="ApellidoM_label">Apellido Materno</label>
                </div>
            </div>


           <div class="row">
                <div class="input-field col s12">
                    <select required id="Sexo_label">
                        <option value=null disabled selected>Seleccione</option>
                        <option value="1">Masculino</option>
                        <option value="2">Femenino</option>
                    </select>
                    <label>Genero</label>
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
                    <input placeholder="Calle" id="Calle_label" type="text" class="validate" required>
                    <label for="Calle_label">Calle</label>
                </div>
            </div>

           <div class="row">
                <div class="input-field col s12">
                    <select required id="Poblacion_label">
                        <option value=null disabled selected>Seleccione</option>
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
                    <input placeholder="NumeroExterior" id="NumeroExterior_label" type="text" class="validate" required>
                    <label for="NumeroExterior_label">Numero Exterior</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <input placeholder="Fecha de nacimiento" id="FechaNacimiento_label" type="date" >
                    <label for="FechaNacimiento_label">Fecha de nacimiento</label>
                </div>
            </div>

       <div class="row">
                <div class="input-field col s12">
                    <select required id="Padre_label">
                        <option value=null disabled selected>Seleccione</option>
                       <?php
                        foreach ($_pop1 as $row){
                            echo '<option value="'.$row['codigoempleado'].'">'.$row['nombre'].'</option>';
                        }
                        ?>
                    </select>
                    <label>Padre/Madre</label>
                </div>
            </div>


            <div class="modal-footer center">
                <a href="" class="modal-action modal-close waves-effect red white-text btn-flat ">Cancelar</a>
                <button id='Enviar' type="submit" class="modal-action waves-effect green white-text btn-flat">Aceptar</button>
            </div>
        </form>
    </div>
</div>



<!--Modal para dar de baja-->
<div id="baja" class="modal">
    <div class="modal-content">
        <form>
            <h4>Baja Hijo</h4>
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
var idedit="0";
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
        console.log(clicked_id);
        $('#alta').openModal();
        idedit=clicked_id;
        $.ajax({
            url:"../BackEnd/Back.php",
            type:'post',
            data:({
                action:"Hijo",
                Metodo: "GetHijosPorId",
                id: clicked_id
            }),
            success: function (data) {
                console.log(data);
                data=JSON.parse(data);      
                    $('#Nombre_label').val(data[0]. nombrehijo);
                    $('#ApellidoP_label').val(data[0].apellidophijo);
                    $('#ApellidoM_label').val(data[0].apellidomhijo);
                    $('#Colonia_label').val(data[0].colonia);
                    $('#Calle_label').val(data[0].calle);
                    $('#NumeroExterior_label').val(data[0].numero);
                    $('#FechaNacimiento_label').val(data[0].fechanacimiento);
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
               action:"Hijo",
               Metodo: "GetHijos"
           }),
           success: function (data) {

               data=JSON.parse(data);

               if(data.length!=0){
                   for (var i in data){
                     //console.log("data");
                       $('#Tabla').empty();
                       var table = $('<table class="responsive-table striped"><thead><tr><th>Codigo</th><th>Nombre</th><th>Apellidos</th> <th>Genero</th><th>Direccion</th><th>Localidad</th><th>Fecha de nacimiento</th><th>Padre</th><th class="center">Acciones</th> </tr> </thead></table>');
                       for(i=0; i<data.length; i++){
                           table.append('<tr><td>'+data[i].codigohijo+'</td><td>'+data[i].nombrehijo+'</td><td>'+data[i].apellidophijo+' '+data[i].apellidomhijo+'</td><td>'+data[i].sexo+'</td><td>'+data[i].colonia+' '+data[i].calle+' '+data[i].numero+'</td><td>'+data[i].nombre+'</td><td>'+data[i].fechanacimiento+'</td><td>'+data[i].nombreempleado+data[i].apellidopempleado+' '+data[i].apellidomempleado+'</td><td width="200"><a onclick="elementos(this.id)" id="'+data[i].codigohijo+'" class="small material-icons btn red">delete</a><a id="'+data[i].codigohijo+'" onclick="elementos2(this.id)" class="small material-icons btn yellow">mode_edit</a></td></tr></td></tr>');
                       }
                       $('#Tabla').append(table);
                   }
               }
               else{
                   $('#Tabla').empty();
                   var table = $('<table class="responsive-table striped"><thead><tr><th>Codigo</th><th>Nombre</th><th>Apellidos</th> <th>Genero</th><th>Direccion</th><th>Localidad</th><th>Fecha de nacimiento</th><th>Padre</th><th class="center">Acciones</th> </tr> </thead></table>');
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
                    action:"Hijo",
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
            var paterno=$('#ApellidoP_label').val();
            var materno=$('#ApellidoM_label').val();
            var genero=$('#Sexo_label').val();
            var colon=$('#Colonia_label').val();
            var calle=$('#Calle_label').val();
            var ciud=$('#Poblacion_label').val();
            var num=$('#NumeroExterior_label').val();
            var FechaNac=$('#FechaNacimiento_label').val();            
            var Pad=$('#Padre_label').val();
                 console.log(" "+idedit+" ");
                console.log(" "+nombre+" ");
                console.log(" "+paterno+" ");
                console.log(" "+materno+" ");
                console.log(" "+genero+" ");
                console.log(" "+colon+" ");
                console.log(" "+calle+" ");
                console.log(" "+ciud+" ");
                console.log(" "+num+" ");
                console.log(" "+FechaNac+" ");
                console.log(" "+Pad+" ");


            if(id!="0"){


                $.ajax({
                url:"../BackEnd/Back.php",
                type:'post',
                data:({
                    action:"Hijo",
                    Metodo: "Cambio",
                    atributos:{
                        id:id,
                        d1:nombre,
                        d2:paterno,
                        d3:materno,
                        d4:genero,
                        d5:colon,
                        d6:calle,
                        d7:num,
                        d8:ciud,
                        d9:FechaNac,
                        d10:Pad
                       
                    }
                }),
                success: function(data) {
                 //  console.log(data);
                    if(data=="1"){
                        Materialize.toast('Se Actualizo con Exito', 4000,"green");
      
                      $('#Nombre_label').val("");
                       $('#ApellidoP_label').val("");
                       $('#ApellidoM_label').val("");
                        $('#Sexo_label').val("");
                       $('#Colonia_label').val("");
                        $('#Calle_label').val("");
                       $('#Poblacion_label').val("");
                        $('#NumeroExterior_label').val("");
                        $('#FechaNacimiento_label').val("");            

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
                       action:"Hijo",
                       Metodo: "Alta",
                       atributos:{
                        d1:nombre,
                        d2:paterno,
                        d3:materno,
                        d4:genero,
                        d5:colon,
                        d6:calle,
                        d7:num,
                        d8:ciud,
                        d9:FechaNac,
                        d10:Pad

                       }
                   }),
                    success: function(data) {
                  //      console.log(data);
                        if(data=="1"){
                            Materialize.toast('Se Inserto con Exito', 4000,"green");
                      $('#Nombre_label').val("");
                       $('#ApellidoP_label').val("");
                       $('#ApellidoM_label').val("");
                        $('#Sexo_label').val("");
                       $('#Colonia_label').val("");
                        $('#Calle_label').val("");
                       $('#Poblacion_label').val("");
                        $('#NumeroExterior_label').val("");
                        $('#FechaNacimiento_label').val("");   

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










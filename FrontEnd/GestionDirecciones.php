<?php
    include "BarNav.php";
    require_once "imports2.php";
        require_once "../BackEnd/CargaSelect.php";

      $Pob=new CargaSelect();
    $_pop=$Pob->get_poblacion();
    $_pop1=$Pob->get_clientes()
?>
<head>
    <title>Gestion de Direcciones</title>
    <meta charset="utf-8" />
</head>
<div class="row">
    <div class="col l10 offset-l1 m12 s12">
        <br>
        <h5 class="center">Gestion de Direcciones</h5>
        <br><hr><br>
        <a href="#alta" class="btn-floating btn-large waves-effect waves-light green white-text modal-trigger1 right"><i class="material-icons">+</i></a>
    </div>
</div>



<!-- Modal para dar de alta y editar -->
<div id="alta" class="modal">
    <div class="modal-content">
        <form id="AltaDireccion">
            <h4>Alta Direcciones</h4>


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
                    <select required id="Cliente_label">
                        <option value=null disabled selected>Seleccione</option>
                       <?php
                        foreach ($_pop1 as $row){
                            echo '<option value="'.$row['codigocliente'].'">'.$row['nombre'].'</option>';
                        }
                        ?>
                    </select>
                    <label>Cliente</label>
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
            <h4>Baja Direccion</h4>
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
        console.log(clicked_id);
        $('#alta').openModal();
        idedit=clicked_id;
        $.ajax({
            url:"../BackEnd/Back.php",
            type:'post',
            data:({
                action:"Direcciones",
                Metodo: "GetDireccionesPorId",
                id: clicked_id
            }),
            success: function (data) {
                console.log(data);
                data=JSON.parse(data);      
                    $('#Colonia_label').val(data[0].colonia);
                    $('#Calle_label').val(data[0].calle);
                    $('#NumeroExterior_label').val(data[0].numero);
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
               action:"Direcciones",
               Metodo: "GetDirecciones"
           }),
           success: function (data) {

               data=JSON.parse(data);

               if(data.length!=0){
                   for (var i in data){
                     //console.log("data");
                       $('#Tabla').empty();
                       var table = $('<table class="responsive-table striped"><thead><tr><th>Codigo</th><th>Colonia</th><th>Calle</th> <th>Numero</th><th>Localidad</th><th>Cliente</th><th class="center">Acciones</th> </tr> </thead></table>');
                       for(i=0; i<data.length; i++){
                           table.append('<tr><td>'+data[i].codigodireccion+'</td><td>'+data[i].colonia+'</td><td>'+data[i].calle+'</td><td>'+data[i].numero+'</td><td>'+data[i].nombre+'</td><td>'+data[i].nombrecl+'</td><td width="200"><a onclick="elementos(this.id)" id="'+data[i].codigodireccion+'" class="small material-icons btn red">delete</a><a id="'+data[i].codigodireccion+'" onclick="elementos2(this.id)" class="small material-icons btn yellow">mode_edit</a></td></tr></td></tr>');
                       }
                       $('#Tabla').append(table);
                   }
               }
               else{
                   $('#Tabla').empty();
                   var table = $('<table class="responsive-table striped"><thead><tr><th>Codigo</th><th>Colonia</th><th>Calle</th> <th>Numero</th><th>Localidad</th><th>Cliente</th><th class="center">Acciones</th> </tr> </thead></table>');
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
                    action:"Direcciones",
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

            var colon=$('#Colonia_label').val();
            var calle=$('#Calle_label').val();
            var ciud=$('#Poblacion_label').val();
            var num=$('#NumeroExterior_label').val();
            var Cli=$('#Cliente_label').val();
     


            if(id!="0"){


                $.ajax({
                url:"../BackEnd/Back.php",
                type:'post',
                data:({
                    action:"Direcciones",
                    Metodo: "Cambio",
                    atributos:{
                        id:id,
                        d1:colon,
                        d2:calle,
                        d3:num,
                        d4:ciud,
                        d5:Cli
                       
                    }
                }),
                success: function(data) {
                 //  console.log(data);
                    if(data=="1"){
                        Materialize.toast('Se Actualizo con Exito', 4000,"green");
    
                       $('#Colonia_label').val("");
                        $('#Calle_label').val("");
                       $('#Poblacion_label').val("");
                        $('#NumeroExterior_label').val("");
                             

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
                       action:"Direcciones",
                       Metodo: "Alta",
                       atributos:{
                        d1:colon,
                        d2:calle,
                        d3:num,
                        d4:ciud,
                        d5:Cli

                       }
                   }),
                    success: function(data) {
                  //      console.log(data);
                        if(data=="1"){
                            Materialize.toast('Se Inserto con Exito', 4000,"green");
                         $('#Colonia_label').val("");
                        $('#Calle_label').val("");
                       $('#Poblacion_label').val("");
                        $('#NumeroExterior_label').val("");
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










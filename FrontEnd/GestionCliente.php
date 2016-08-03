<?php
    require_once "imports2.php";
    require_once "../BackEnd/CargaSelect.php";
    $pobla=new CargaSelect();
    $_pop=$pobla->get_poblacion();
?>
<head>
    <title>Gestion de Clientes</title>
    <meta charset="utf-8" />
</head>
<div class="row">
    <div class="col l10 offset-l1 m12 s12">
        <br>
        <h5 class="center">Gestion de Clientes</h5>
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
        <form id="AltaProveedor">
            <h4>Alta Cliente</h4>
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
                    <input placeholder="NumeroExterior" id="NumeroExterior_label" type="text" class="validate" required>
                    <label for="NumeroExterior_label">Numero Exterior</label>
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
                    <input placeholder="Telefono" id="Telefono_label" type="text" class="validate" required>
                    <label for="Telefono_label">Telefono</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <input placeholder="Saldo" id="Saldo_label" type="text" class="validate" required>
                    <label for="Saldo_label">Saldo</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input placeholder="Saldo" id="SaldoLimite_label" type="text" class="validate" required>
                    <label for="SaldoLimite_label">Saldo Limite</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <select required id="TipoCliente_label">
                        <option value=null disabled selected>Seleccione</option>
                        <option value="0">Persona</option>
                        <option value="1">Empresa</option>
                    </select>
                    <label>Tipo de cliente</label>
                </div>
            </div>

            <div class="modal-footer center">
                <a class="modal-action modal-close waves-effect red white-text btn-flat ">Cancelar</a>
                <button id="Enviar" class="modal-action waves-effect green white-text btn-flat">Aceptar</button>
            </div>
        </form>
    </div>
</div>



<!--Modal para dar de baja-->
<div id="baja" class="modal">
    <div class="modal-content">
        <form>
            <h4>Baja Clientes</h4>
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

    //funcion que te almacena el id para su posterior eliminacion
    function elementos(clicked_id) {
        $('#baja').openModal();
        $('#idEliminar').attr("value",clicked_id);
    }
    //funcion que ayuda a cargar los datos en un modal cuando se edtara
    function elementos2(clicked_id) {
        $('#alta').openModal();
        $('#idCambio').attr("value",clicked_id);
        $('#idCambio').val(clicked_id);
        $.ajax({
            url:"../BackEnd/Back.php",
            type:'post',
            data:({
                action:"Cliente",
                Metodo: "Registro",
                id: clicked_id
            }),
            success: function (data) {
                data=JSON.parse(data);
                console.log(data);
                $('#Nombre_label').val(data[0].Nombre);
                $('#ApellidoP_label').val(data[0].Ap);
                $('#ApellidoM_label').val(data[0].AM);
                $('#Colonia_label').val(data[0].Colonia);//Calle_label
                $('#Calle_label').val(data[0].Calle);
                $('#NumeroExterior_label').val(data[0].Num);
                $('#Telefono_label').val(data[0].tel);
                $('#Saldo_label').val(data[0].sal);
                $('#SaldoLimite_label').val(data[0].lim);

                //$('#Proveedor_label').attr("value",data[0].CodigoProveedor);
            }
        });
    }

    function Cerrar_modal(){
        $('#idCambio').val("");
        $('#Nombre_label').val("");
        $('#ApellidoP_label').val("");
        $('#ApellidoM_label').val("");
        $('#Colonia_label').val("");
        $('#Calle_label').val("");
        $('#NumeroExterior_label').val("");
        $('#Telefono_label').val("");
        $('#Saldo_label').val("");
        $('#SaldoLimite_label').val("");
    };
    $(document).ready(Cargar);
    function Cargar(){
        $.ajax({
            url:"../BackEnd/Back.php",
            type:'post',
            data:({
                action:"Cliente",
                Metodo: "CargaTabla"
            }),
            success: function (data) {
                //console.log(data);
                data=JSON.parse(data);
                //console.log(data);
                if(data.length!=0){
                    $('#Tabla').empty();
                    var table = $('<table class="responsive-table striped"> <thead> <tr> <th>Codigo</th> <th>Nombre</th> <th>Apellidos</th> <th>Sexo</th> <th>Poblacion</th> <th>Direccion</th> <th>Telefono</th> <th>Saldo</th> <th>Tipo de cliente</th><th>Acciones</th> </tr></thead></table>');
                    for(i=0; i<data.length; i++){
                        table.append('<tr><td>'+data[i].CodCliete+'</td><td>'+data[i].NombreCliente+'</td><td>'+data[i].Apellidos+'</td><td>'+data[i].Sexo+'</td><td>'+data[i].Poblacion+'</td><td>'+data[i].Direccion+'</td><td>'+data[i].Telefono+'</td><td>'+data[i].Saldo+'</td><td>'+data[i].Empresa+'</td><td width="200"><a onclick="elementos(this.id)" id="'+data[i].CodCliete+'" class="small material-icons btn red">delete</a><a id="'+data[i].CodCliete+'" onclick="elementos2(this.id)" class="small material-icons btn yellow">mode_edit</a></td></tr>');
                    }
                    $('#Tabla').append(table);
                }
                else{
                    $('#Tabla').empty();
                    var table = $('<table class="responsive-table striped"> <thead> <tr> <th>Codigo</th> <th>Nombre</th> <th>Apellidos</th> <th>Sexo</th> <th>Poblacion</th> <th>Direccion</th> <th>Telefono</th> <th>Saldo</th> <th>Tipo de cliente</th> <th>Acciones</th> </tr></thead></table>');
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
                    action:"Cliente",
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
            var id=$('#idCambio').val();
            event.preventDefault();
            var d1=$('#Nombre_label').val();
            var d2=$('#ApellidoP_label').val();
            var d3=$('#ApellidoM_label').val();
            var d4=$('#Sexo_label').val();
            var d5=$('#Colonia_label').val();
            var d6=$('#Calle_label').val();
            var d7=$('#NumeroExterior_label').val();
            var d8=$('#Poblacion_label').val();
            var d9=$('#Telefono_label').val();
            var d10=$('#Saldo_label').val();
            var d11=$('#SaldoLimite_label').val();
            var d12=$('#TipoCliente_label').val();
            console.log(id);
            console.log(d1);
            console.log(d2);
            console.log(d3);
            console.log(d4);
            console.log(d5);
            console.log(d6);
            console.log(d7);
            console.log(d8);
            console.log(d9);
            console.log(d10);
            console.log(d11);
            console.log(d12);
            if(id!=""){
                $.ajax({
                    url:"../BackEnd/Back.php",
                    type:'post',
                    data:({
                        action:"Cliente",
                        Metodo: "Cambio",
                        atributos:{
                            id:id,
                            d1:d1,
                            d2:d2,
                            d3:d3,
                            d4:d4,
                            d5:d5,
                            d6:d6,
                            d7:d7,
                            d8:d8,
                            d9:d9,
                            d10:d10,
                            d11:d11,
                            d12 : d12
                        }
                    }),
                    success: function(data) {
                        if(data=="1"){
                            Materialize.toast('Se Actualizo con Exito', 4000,"green");
                            $('#idCambio').val("");
                            $('#Nombre_label').val("");
                            $('#ApellidoP_label').val("");
                            $('#ApellidoM_label').val("");
                            $('#Colonia_label').val("");
                            $('#Calle_label').val("");
                            $('#NumeroExterior_label').val("");
                            $('#Telefono_label').val("");
                            $('#Saldo_label').val("");
                            $('#SaldoLimite_label').val("");
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
                console.log("Alta");
                $.ajax({
                    url:"../BackEnd/Back.php",
                    type:'post',
                    data:({
                        action:"Cliente",
                        Metodo: "Alta",
                        atributos:{
                            d1:d1,
                            d2:d2,
                            d3:d3,
                            d4:d4,
                            d5:d5,
                            d6:d6,
                            d7:d7,
                            d8:d8,
                            d9:d9,
                            d10:d10,
                            d11:d11,
                            d12 : d12
                        }
                    }),
                    success: function(data) {
                        if(data=="1"){
                            Materialize.toast('Se Inserto con Exito', 4000,"green");
                            $('#Nombre_label').val("");
                            $('#ApellidoP_label').val("");
                            $('#ApellidoM_label').val("");
                            $('#Colonia_label').val("");
                            $('#Calle_label').val("");
                            $('#NumeroExterior_label').val("");
                            $('#Telefono_label').val("");
                            $('#Saldo_label').val("");
                            $('#SaldoLimite_label').val("");
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























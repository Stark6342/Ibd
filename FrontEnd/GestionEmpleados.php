﻿<?php
session_start();
if(!isset($_SESSION["Validado"])) {
    header("location:../");
}
else {
if($_SESSION['Validado']=="aceptado"){
    include "BarNav.php";
    require_once "imports2.php";
?>
<head>
    <title>Gestion de Empleados</title>
    <meta charset="utf-8" />
</head>
<div class="row">
    <div class="col l10 offset-l1 m12 s12">
        <br>
        <h5 class="center">Gestion de Empleados</h5>
        <br><hr><br>
        <a href="#alta" class="btn-floating btn-large waves-effect waves-light green white-text modal-trigger1 right"><i class="material-icons">+</i></a>
    </div>
</div>



<!-- Modal para dar de alta y editar -->
<div id="alta" class="modal">
    <div class="modal-content">
        <form id="AltaProveedor">
            <h4>Alta Empleados</h4>
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
                        <option value="1">Poblacion 1</option>
                        <option value="2">Poblacion 2</option>
                        <option value="2">Poblacion 3</option>
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
                    <input placeholder="Telefono" id="Telefono_label" type="text" class="validate" required>
                    <label for="Telefono_label">Telefono</label>
                </div>
            </div>


            <div class="row">
                <div class="input-field col s12">
                    <input placeholder="Salario" id="Salario_label" type="text" class="validate" required>
                    <label for="Salario_label">Salario</label>
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
            <h4>Baja Empleados</h4>
            <p class="center">¿Desea eliminar el registro?</p>
            <div class="modal-footer center">
                <a class="modal-action modal-close waves-effect red white-text btn-flat ">Cancelar</a>
                <button id="Baja" class="modal-action waves-effect green white-text btn-flat">Aceptar</button>
            </div>
        </form>
    </div>
</div>





<div class="row">
    <div class="col l10 offset-l1 m12 s12">
        <table class="striped">
            <thead>
            <tr>
                <th></th>
                <tr>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Sexo</th>
                        <th>Direccion</th>
                        <th>Poblacion</th>
                        <th>Telefono</th>
                        <th>Fecha Alta</th>
                        <th>Numero de hijos</th>
                        <th>Salario</th>
                        <th>Departamento</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>
                    <input type="checkbox" id="test5"/>
                </td>
         <tr>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Sexo</th>
                        <th>Direccion</th>
                        <th>Telefono</th>
                        <th>Fecha Alta</th>
                        <th>Numero de hijos</th>
                        <th>Salario</th>
                        <th>Departamento</th>
            </tr>
            </tbody>
        </table>
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
</script>
<?php } } ?>
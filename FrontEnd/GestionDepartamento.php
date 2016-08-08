<?php
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
                        <option value="1">CDT 1</option>
                        <option value="2">CDT 2</option>
                        <option value="3">CDT 3</option>
                    </select>
                    <label>Centro de trabajo</label>
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
            <h4>Baja Departamento</h4>
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
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Presupuesto Anual</th>
                    <th>Centro de Trabajo</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>
                    <input type="checkbox" id="test5"/>
                </td>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Presupuesto Anual</th>
                        <th>Centro de Trabajo</th>
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
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
        <a href="#alta" class="btn-floating btn-large waves-effect waves-light green white-text modal-trigger1 right"><i class="material-icons">+</i></a>
    </div>
</div>
<div id="alta" class="modal">
    <div class="modal-content">
        <form id="AltaArticulo">
            <h4>Alta Articulo</h4>
            <div class="row">
                <div class="input-field col s12">
                    <input placeholder="Nombre" id="Nombre_label" type="text" class="validate" required>
                    <label for="Nombre_label">Nombre</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input placeholder="Poblacion" id="Poblacion_label" type="text" class="validate" required>
                    <label for="Poblacion_label">Poblacion</label>
                </div>
            </div>

                        <div class="row">
                <div class="input-field col s12">
                    <select required>
                        <option value=null disabled selected>Choose your option</option>
                        <option value="1">Poblacion 1</option>
                        <option value="2">Poblacion 2</option>
                        <option value="3">Poblacion 3</option>
                    </select>
                    <label>Materialize Select</label>
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

            <div class="modal-footer center">
                <a href="" class="modal-action modal-close waves-effect red white-text btn-flat ">Cancelar</a>
                <button type="submit" class="modal-action waves-effect green white-text btn-flat">Aceptar</button>
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
                <th>Poblacion</th>
                <th>Direccion</th>
                <th>Empleado</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>
                    <input type="checkbox" id="test5"/>
                </td>
                <td>Codigo</td>
                <td>Nombre</td>
                <td>Poblacion</td>
                <td>Direccion</td>
                <td>Empleado</td>
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

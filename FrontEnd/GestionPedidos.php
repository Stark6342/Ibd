<?php
    require_once "imports2.php";
?>
<head>
    <title>Gestion de Pedidos</title>
    <meta charset="utf-8" />
</head>
<div class="row">
    <div class="col l10 offset-l1 m12 s12">
        <br>
        <h5 class="center">Gestion de Pedidos</h5>
        <br><hr><br>
        <a href="#alta" class="btn-floating btn-large waves-effect waves-light green white-text modal-trigger1 right"><i class="material-icons">+</i></a>
    </div>
</div>



<!-- Modal para dar de alta y editar -->
<div id="alta" class="modal">
    <div class="modal-content">
        <form id="AltaProveedor">
            <h4>Alta Pedidos</h4>


           <div class="row">
                <div class="input-field col s12">
                    <select required id="Cliente_label">
                        <option value=null disabled selected>Seleccione</option>
                        <option value="1">Cliente 1</option>
                        <option value="2">Cliente 2</option>
                    </select>
                    <label>Clientes</label>
                </div>
            </div>


           <div class="row">
                <div class="input-field col s12">
                    <select required id="Direccion_label">
                        <option value=null disabled selected>Seleccione</option>
                        <option value="1">Direccion 1</option>
                        <option value="2">Direccion 2</option>
                    </select>
                    <label>Direcciones</label>
                </div>
            </div>


           <div class="row">
                <div class="input-field col s12">
                    <select required id="Articulo_label">
                        <option value=null disabled selected>Seleccione</option>
                        <option value="1">Articulo 1</option>
                        <option value="2">Articulo 2</option>
                    </select>
                    <label>Articulos</label>
                </div>
            </div>



            <div class="row">
                <div class="input-field col s12">
                    <input placeholder="Cantidad" id="Cantidad_label" type="text" class="validate" required>
                    <label for="Cantidad_label">Cantidad</label>
                </div>
            </div>

             <div class="row">
                <div class="input-field col s12">
                    <input placeholder="Descuento" id="Descuento_label" type="text" class="validate" required>
                    <label for="Descuento_label">Descuento</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <input placeholder="Descripcion" id="Descripcion_label" type="text" class="validate" required>
                    <label for="Descripcion_label">Descripcion</label>
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
            <h4>Baja Pedidos</h4>
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
                        <th>Cliente</th>
                        <th>Direccion</th>
                        <th>Fecha de Pedido</th>
                        <th>Articulo</th>
                        <th>Descripcion Articulo</th>
                        <th>Cantidad</th>
                        <th>Importe Total</th>
                        <th>Descuento</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>
                    <input type="checkbox" id="test5"/>
                </td>
         <tr>
                        <th>Codigo</th>
                        <th>Cliente</th>
                        <th>Direccion</th>
                        <th>Fecha de Pedido</th>
                        <th>Articulo</th>
                        <th>Descripcion Articulo</th>
                        <th>Cantidad</th>
                        <th>Importe Total</th>
                        <th>Descuento</th>
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
































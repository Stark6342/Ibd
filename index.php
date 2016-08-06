<?php
    require_once "imports.php";
?>
<head>
    <title>Login</title>
	<meta charset="utf-8" />
</head>
<div class="row">
    <div class="col l10 offset-l1 m12 s12">

        <br>
        <h5 class="center">Login</h5>
        <br><hr><br>

        <form action="BackEnd/Login.php" id="login">
            <div class="row">
                <div class="input-field col offset-m4 s4">
                    <input placeholder="Usuario" name="username" id="username" type="text" class="validate center" required>
                    <label for="first_name">Usuario</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col offset-m4 s4">
                    <input placeholder="Contraseña"name="password" id="password" type="password" class="center validate" required>
                    <label for="password">Contraseña</label>
                </div>
            </div>
            <div class="row">
                <div class="col s12 center-align">

                   <button class="btn waves-effect waves-light" type="submit" >Aceptar</button>
                    <button class="btn red" type="submit" name="action">Cancelar</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>

</script>
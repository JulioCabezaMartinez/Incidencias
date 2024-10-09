<?php
    
    session_start();

    ini_set('display_errors', 1);
    error_reporting(E_ALL & ~E_NOTICE);

    if (empty($_SESSION)){
        header("Location:../../../src/view/login.php");
        die();
    }

    require_once '../view/Templates/inicio.inc.php';
    
?>
<title>Resolución</title>
</head>
<body>
    <?php
        include_once '../view/Templates/barra_lateral.inc.php';
    ?>

    <div class="col py-3">
        <h1>Modicación de Usuario</h1>
        <form action="../controller/actions_usuario.php" method="post">
            <label for="nombre">Nombre:</label><br>
            <input type="text" name="nombre" maxlength="45" value="<?php echo $usuario->getNombre()?>" required >
            <br><br>
            <label for="apellidos">Apellidos:</label><br>
            <input type="text" name="apellidos"  maxlength="60" value="<?php echo $usuario->getApellidos()?>" required>
            <br><br>
            <label for="correo">Correo:</label><br>
            <input type="email" name="correo" required value="<?php echo $usuario->getCorreo()?>">
            <br><br>
            <label for="DNI">DNI:</label><br>
            <input type="text" name="DNI"  maxlength="9" pattern="(\d{8})([A-Z]{1})" value="<?php echo $usuario->getDNI()?>" required>
            <br><br>
            <label for="telefono">Telefono:</label><br>
            <input type="text" name="telefono" value="<?php echo $usuario->getTelefono()?>" required>
            <br><br>
            <label for="direccion">Dirección:</label><br>
            <input type="text" name="direccion" value="<?php echo $usuario->getDireccion()?>" required>
            <br><br>
            <label for="tipo">Tipo de Empleado:</label><br><br>
            <?php
                if($usuario->getTipo()==1){
                    echo '<input type="radio" name="tipo" value="1" required checked><label>Admin</label><br>';
                }else{
                    echo '<input type="radio" name="tipo" value="1" required><label>Admin</label><br>';
                }

                if($usuario->getTipo()==2){
                    echo '<input type="radio" name="tipo" value="2" checked><label>Cliente</label><br>';
                }else{
                    echo '<input type="radio" name="tipo" value="2"><label>Cliente</label><br>';
                }

                if($usuario->getTipo()==3){
                    echo '<input type="radio" name="tipo" value="3" checked><label>Empleado</label><br>';
                }else{
                    echo '<input type="radio" name="tipo" value="3"><label>Empleado</label><br>';
                }

                if($usuario->getTipo()==4){
                    echo '<input type="radio" name="tipo" value="4" checked><label>Empleado Jefe</label><br>';
                }else{
                    echo '<input type="radio" name="tipo" value="4"><label>Empleado Jefe</label><br>';
                }

                if($usuario->getTipo()==5){
                    echo '<input type="radio" name="tipo" value="5" checked><label>Empleado en espera</label><br>';
                }else{
                    echo '<input type="radio" name="tipo" value="5"><label>Empleado en espera</label><br>';
                }

                if($usuario->getTipo()==6){
                    echo '<input type="radio" name="tipo" value="6" checked><label>Empleado Denegado</label><br>';
                }else{
                    echo '<input type="radio" name="tipo" value="6"><label>Empleado Denegado</label><br>';
                }

                if($usuario->getTipo()==7){
                    echo '<input type="radio" name="tipo" value="7" checked><label>Empleado de baja</label><br>';
                }else{
                    echo '<input type="radio" name="tipo" value="7"><label>Empleado de baja</label><br>';
                }

                if($usuario->getTipo()==8){
                    echo '<input type="radio" name="tipo" value="8" checked><label>Cliente de baja</label><br>';
                }else{
                    echo '<input type="radio" name="tipo" value="8"><label>Cliente de baja</label><br>';
                }
            ?>
            <br><br>
            <label for="nombre">Motivo de la Baja:</label><br>
            <textarea name="motivo_baja" rows="3" class="w-50"><?php echo $usuario->getMotivoBaja()?></textarea>
            <br><br>
            <label for="nombre">Motivo de la Readmision:</label><br>
            <textarea name="motivo_readmision" rows="3" class="w-50"><?php echo $usuario->getMotivoReadmision()?></textarea>
            <br><br>
            <label for="nombre">Fecha de la Baja:</label><br>
            <input type="date" name="fecha_baja" value="<?php echo $usuario->getFechaBaja()?>">
            <br><br>
            <label for="nombre">Fecha de la Readmision:</label><br>
            <input type="date" name="fecha_readmision" value="<?php echo $usuario->getFechaReadmision()?>">
            <br><br>
            <div class="submit">
                <input type="hidden" name="idUsuario" value="<?php echo $usuario->getId()?>">
                <input type="submit" name="modificar" class="btn btn-outline-primary" value="Modificar Usuario">
            </div>
        </form>
    </div>
</div> <!-- Div que cierra la barra lateral para que se mantenga en su lugar -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
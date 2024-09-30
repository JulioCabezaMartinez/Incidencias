<?php

require_once "../view/Templates/inicio.inc.php";

?>
<title>Register</title>
</head>
<body>
    <img class="DonDigitalLogo" src='../../assets/IMG/Imagotipo_Color_Negativo.webp'>
    <br><br>
    <label style="font-size: 150%;font-weight: bold;">REGISTRO</label>
    <div class="registro_login">
        <form action="../controller/actions_usuario.php" method="post">
            <label for="nombre">Nombre:</label><br>
            <input type="text" name="nombre" placeholder="Nombre" maxlength="45" required >
            <br><br>
            <label for="apellidos">Apellidos:</label><br>
            <input type="text" name="apellidos" placeholder="Apellidos" maxlength="60" required>
            <br><br>
            <label for="correo">Correo:</label><br>
            <input type="email" name="correo" maxlength="60" required>
            <br><br>
            <label for="pass">Contraseña:</label><br>
            <input type="password" name="pass" maxlength="60" required>
            <br><br>
            <label for="confirm_pass">Confirmar Contraseña:</label><br>
            <input type="password" name="confirm_pass" maxlength="60" required>
            <br><br>
            <label for="DNI">DNI:</label><br>
            <input type="text" name="DNI" placeholder="12345678A" maxlength="9" pattern="(\d{8})([A-Z]{1})" required> <!-- Poner para el NIE -->
            <br><br>
            <label for="tipo">Tipo de Empleado:</label><br><br>
            <input type="radio" name="tipo" value="Empleado"><label>Empleado</label>
            <input type="radio" name="tipo" value="Cliente" checked><label>Cliente</label>
            <br><br>
            <div class="submit">
                <input type="submit" name="register" value="Registrarse">
                <br>
                <a href="./login.php">Volver</a>
            </div>

            
            
        </form>
    </div>
    
</body>
</html>
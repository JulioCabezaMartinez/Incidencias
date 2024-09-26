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
        <form action="./main.php">
            <label for="nombre">Nombre:</label><br>
            <input type="text" name="nombre" placeholder="Nombre" maxlength="45" required >
            <br><br>
            <label for="apellidos">Apellidos:</label><br>
            <input type="text" name="nombre" placeholder="Apellidos" maxlength="60" required>
            <br><br>
            <label for="correo">Correo:</label><br>
            <input type="email" name="correo" maxlength="60" required>
            <br><br>
            <label for="pass">Contraseña:</label><br>
            <input type="password" name="pass" maxlength="60" required>
            <br><br>
            <label for="DNI">DNI:</label><br>
            <input type="text" name="DNI" placeholder="12345678A" maxlength="9" pattern="(\d{8})([A-Z]{1})" required>
            <br><br>
            <label for="tipo">Tipo de Empleado:</label><br><br>
            <input type="radio" name="tipo"><label>Empleado</label>
            <input type="radio" name="tipo" checked><label>Cliente</label>
            <br><br>
            <div class="submit"><input type="submit" name="registrarse" value="Registrarse"></div>
            
        </form>
    </div>
    
</body>
</html>
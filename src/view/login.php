<?php

require_once "../view/Templates/inicio.inc.php";

?>
    <title>Login</title>
</head>
<body>
    
    <img class="DonDigitalLogo" src='../../assets/IMG/Imagotipo_Color_Negativo.webp'>
    <br><br>
    <label style="font-size: 150%;font-weight: bold;">LOGIN</label>
    <div class="registro_login">
        <form action="./main.php">
            <label for="correo">Correo:</label><br>
            <input type="email" name="correo" maxlength="60">
            <br><br>
            <label for="pass">Contraseña:</label><br>
            <input type="password" name="pass" maxlength="60" required>
            <br><br>
            <input type="submit" name="login" value="Iniciar Sesión">
            <br><br>
            <a style="font-size: 130%;" href="./login.php">Nuevo Usuario</a>
        </form>
        
    </div>
</body>
</html>
<?php

    session_start();

    if (!empty($_SESSION)){
        header("Location:main.php");
        die();
    }

require_once "../view/Templates/inicio.inc.php";

?>
    <title>Login</title>
</head>
<body>
    <?php

        if(isset($_GET['action'])){
            if($_GET['action']==1){
                echo "fallo de Sesion";
            }
            
            if($_GET['action']==2){
                echo "No tiene permitido el acceso. Contacte al administrador.";
            }

        }
    ?>

    <img class="DonDigitalLogo" src='../../assets/IMG/Imagotipo_Color_Negativo.webp'>
    <br><br>
    <label style="font-size: 150%;font-weight: bold;">LOGIN</label>
    <div class="registro_login">
        <form action="../controller/actions_usuario.php" method="post">
            <label for="correo">Correo:</label><br>
            <input type="email" name="correo" maxlength="60">
            <br><br>
            <label for="pass">Contraseña:</label><br>
            <input type="password" name="pass" maxlength="60" required>
            <br><br>
            <input type="submit" name="login" value="Iniciar Sesión">
            <br><br>
            <a style="font-size: 130%;" href="./register.php">Nuevo Usuario</a>
        </form>
        
    </div>
</body>
</html>
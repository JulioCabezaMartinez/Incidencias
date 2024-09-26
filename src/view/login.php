<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/CSS/style.css">
    <title>Login</title>
</head>
<body>
    <h1>LOGIN</h1>
    <img class="DonDigitalLogo" src='../../assets/IMG/Imagotipo_Color_Negativo.webp'>
    <div class="registro_login">
        <form action="./main.php">
            <label for="correo">Correo:</label><br>
            <input type="email" name="correo" maxlength="60">
            <br><br>
            <label for="pass">Contraseña:</label><br>
            <input type="password" name="pass" maxlength="60" required>
            <br><br>
            <input type="submit" name="login" value="Iniciar Sesión">
        </form>
        <a href="./login.php">Nuevo Usuario</a>
    </div>
</body>
</html>
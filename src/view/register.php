<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <h1>REGISTRO</h1>
    <img class="DonDigitalLogo" src='../../assets/IMG/images.png'>
    <br>
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
            <input type="radio" name="tipo">Empleado
            <input type="radio" name="tipo" checked>Cliente
            <br><br>
            <input type="submit" name="registrarse" value="Registrarse">
        </form>
    </div>
    
</body>
</html>
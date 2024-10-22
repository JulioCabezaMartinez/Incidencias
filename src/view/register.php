<?php

    session_start();

require_once "../view/Templates/inicio.inc.php";

?>
<title>Register</title>
</head>
<body>
    <img class="DonDigitalLogo" src='../../assets/IMG/Imagotipo_Color_Negativo.webp'>
    <br><br>
    <label style="font-size: 150%;font-weight: bold;">REGISTRO</label>
    <div class="registro_login">
        <form action="../controller/actions_usuario.php" enctype="multipart/form-data" method="post">
            <label for="nombre">Nombre:</label><br>
            <input class="form-control w-50" type="text" name="nombre" placeholder="Nombre" maxlength="45" required >
            <br><br>
            <label for="apellidos">Apellidos:</label><br>
            <input class="form-control w-50" type="text" name="apellidos" placeholder="Apellidos" maxlength="60" required>
            <br><br>
            <label for="correo">Correo:</label><br>
            <input class="form-control w-50" type="email" name="correo" maxlength="60" required>
            <br><br>
            <label for="pass">Contraseña:</label><br>
            <input class="form-control w-50" type="password" name="pass" maxlength="60" required>
            <br><br>
            <label for="confirm_pass">Confirmar Contraseña:</label><br>
            <input class="form-control w-50" type="password" name="confirm_pass" maxlength="60" required>
            <br><br>
            <label for="imagen">Imagen Perfil: </label>
            <input class="form-control" type="file" name="imagen" id="imagen" accept=".jpg, .jpeg, .png">
            <br><br>
            <label for="DNI">DNI:</label><br>
            <input class="form-control w-50" type="text" name="DNI" placeholder="12345678A" maxlength="9" pattern="(\d{8})([A-Z]{1})" required> <!-- Poner para el NIE -->
            <br><br>
            <label for="telefono">Telefono:</label><br>
            <input class="form-control w-50" type="text" name="telefono" required> <!-- Poner para el NIE -->
            <br><br>
            <label for="direccion">Dirección:</label><br>
            <input class="form-control w-50" type="text" name="direccion" required> 
            <br><br>
            <label for="pais">País:</label><br>
            <select class="form-select w-50" type="text" name="direccion" id="pais" required>
                <option value="es">España</option>
                <option value="us">Estados Unidos</option>
            </select>
            <br><br>
            <label for="cp">Código Postal:</label><br>
            <div class="d-flex flex-row">
                <input class="form-control w-25" type="text" name="cp" id="cp" required>
                <button type="button" id="btn_busqueda_codigo_postal" class="btn btn-outline-primary col-2 w-auto mx-3" ><i class="fa-solid fa-magnifying-glass"></i></button> 
            </div>
            <br><br>
            <label for="ciudad">Ciudad:</label><br>
            <input class="form-control w-50" type="text" name="ciudad" id="ciudad" required readonly> 
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

    <script>
        $(document).ready(function(){
            $("#btn_busqueda_codigo_postal").click(function(){
                let codigo_postal=$("#cp").val();
                let pais=$("#pais").val();
                $.ajax({
                    url: "http://api.zippopotam.us/"+ pais + "/" +codigo_postal,
                    method: "GET",
                    success:function(data){
                        $("#ciudad").val(data.places[0]['place name']);
                    }
                })
            });
        });
    </script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
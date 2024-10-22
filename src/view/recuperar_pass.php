<?php

    ini_set('display_errors', 1);
    error_reporting(E_ALL & ~E_NOTICE);

    require_once '../view/Templates/inicio.inc.php';
    
?>
<title>Recuperación de contraseña:</title>
</head>
<body>
    <div class="col p-3">
            <img class="DonDigitalLogo" src="../../assets/IMG/Imagotipo_Color_Negativo.webp" alt=""><br><br>
            <h2>Recuperación de contraseña</h2><br><br>

            <a href="login.php"><button>← Volver</button></a>

            <div id="comprobacion_codigo" class="d-flex flex-column m-4">
                <div class>
                    <p>Indique el código que ha recibido por email.</p><br>
                    <label for="codigo">Indique el código:</label><br>
                    <input id="codigo" class="form-control" style="width: 20%;" type="password" name="codigo" required>
                    <input id="correo" type="hidden" name="correo" value="<?php echo $_GET['correo'] ?>">
                </div><br>
                <button id="btn_comprueba_codigo" class="btn btn-outline-primary" style="width: 10%;">Comprobar</button>
            </div>  

            <div id="nueva_pass" class="oculto d-flex flex-column m-4">
                <div>
                    <label for="pass">Nueva Contraseña:</label><br>
                    <input class="form-control" style="width: 20%;" type="password" name="pass" id="pass">
                </div>
                <br>
                <div>
                    <label for="confirm_pass">Confirmación Contraseña:</label><br>
                    <input class="form-control" style="width: 20%;" type="password" name="confirm_pass" id="confirm">
                </div>
                <br>
                <button id="btn_cambio_pass" class="btn btn-outline-primary" style="width: 20%;">Cambiar contraseña</button>
            </div>  
    </div>
</div> <!-- Div que cierra la barra lateral para que se mantenga en su lugar -->

<script>
    let correo;
    $(document).ready(function(){
        $("#btn_comprueba_codigo").click(function(){
            let codigo_usuario=$("#codigo").val();
            correo=$("#correo").val();

            console.log(codigo_usuario);
            $.ajax({
                url: "../controller/AJAX.php",
                method: "POST",
                data:{
                    mode: "comprobar_codigo_cambio_pass",
                    codigo: codigo,
                    correo: correo
                },
                success: function(data){
                    if(data=='Código correcto'){
                        $("#comprobacion_codigo").addClass('oculto');
                        $("#nueva_pass").removeClass('oculto');
                    }
                }
            })
        });

        $("#btn_cambio_pass").click(function(){
            let pass=$("#pass").val();
            let confirm=$("#confirm").val();

            $.ajax({
                url: "../controller/AJAX.php",
                method: "POST",
                data: {
                    mode: "reset_pass",
                    pass: pass,
                    confirm: confirm,
                    correo: correo
                },
                success:function(data){
                    console.log(data);
                }
            })
        })
        
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
<?php

    session_start();

    if (!empty($_SESSION)){
        header("Location:../../../src/controller/actions_usuario.php?action=0");
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
                echo '<!-- Modal de Confirmación de fallo de login -->
                            <div class="modal fade" id="fallo_login" tabindex="-1" >
                                <div class="modal-dialog modal-dialog-centered" >
                                    <div class="modal-content">
                                        <div class="modal-header" >
                                            <h5 id="confirmacion_header" class="modal-title" id="exampleModalLongTitle">Fallo de incio de sesión</h5>
                                        </div>
                                        <div class="modal-body">
                                            <label id="confirmacion_body">Las credenciales no son correctas.</label>
                                        </div>
                                        <div class="modal-footer">
                                            <button id="btn_cerrar_confirmacion" type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- Modal de Confirmación de fallo de login -->
                <script>
                    $(document).ready(function(){
                        $("#fallo_login").modal("show");
                        $("#btn_cerrar_confirmacion").on("click", function() {
                            $("#fallo_login").modal("hide");
                        });
                    });
                </script>';
            }
            
            if($_GET['action']==2){
                echo '<!-- Modal de Confirmación de fallo de permisos -->
                            <div class="modal fade" id="fallo_usuario" tabindex="-1" >
                                <div class="modal-dialog modal-dialog-centered" >
                                    <div class="modal-content">
                                        <div class="modal-header" >
                                            <h5 id="confirmacion_header" class="modal-title" id="exampleModalLongTitle">Fallo de permisos de empleado</h5>
                                        </div>
                                        <div class="modal-body">
                                            <label id="confirmacion_body">Usted ya figura como empleado. Pongase en contacto con el administrador.</label>
                                        </div>
                                        <div class="modal-footer">
                                            <button id="btn_cerrar_confirmacion" type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- Modal de Confirmación de fallo de permisos -->
                <script>
                    $(document).ready(function(){
                        $("#fallo_usuario").modal("show");
                        $("#btn_cerrar_confirmacion").on("click", function() {
                            $("#fallo_usuario").modal("hide");
                        });
                    });
                </script>';
            }
            if($_GET['action']==3){
                echo '<!-- Modal de Confirmación de cambio de pass -->
                            <div class="modal fade" id="cambio_pass" tabindex="-1" >
                                <div class="modal-dialog modal-dialog-centered" >
                                    <div class="modal-content">
                                        <div class="modal-header" >
                                            <h5 id="confirmacion_header" class="modal-title" id="exampleModalLongTitle">Cambio de contraseña</h5>
                                        </div>
                                        <div class="modal-body">
                                            <label id="confirmacion_body">Contraseña cambiada con exito.</label>
                                        </div>
                                        <div class="modal-footer">
                                            <button id="btn_cerrar_confirmacion" type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- Modal de Confirmación de cambio de pass -->
                <script>
                    $(document).ready(function(){
                        $("#cambio_pass").modal("show");
                        $("#btn_cerrar_confirmacion").on("click", function() {
                            $("#cambio_pass").modal("hide");
                        });
                    });
                </script>';
            }
            if($_GET['action']=='register'){
                if(isset($error)){
                    echo '<!-- Modal de Confirmación de fallo de permisos -->
                    <div class="modal fade" id="fallo_usuario" tabindex="-1" >
                        <div class="modal-dialog modal-dialog-centered" >
                            <div class="modal-content">
                                <div class="modal-header" >
                                    <h5 id="confirmacion_header" class="modal-title" id="exampleModalLongTitle">Fallo de registro</h5>
                                </div>
                                <div class="modal-body">
                                    <label id="confirmacion_body">'.$error.'</label>
                                </div>
                                <div class="modal-footer">
                                    <button id="btn_cerrar_confirmacion" type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- Modal de Confirmación de fallo de permisos -->
        <script>
            $(document).ready(function(){
                $("#fallo_usuario").modal("show");
                $("#btn_cerrar_confirmacion").on("click", function() {
                    $("#fallo_usuario").modal("hide");
                });
            });
        </script>';
                }else{
                    '<!-- Modal de Confirmación de cambio de pass -->
                            <div class="modal fade" id="registro_ok" tabindex="-1" >
                                <div class="modal-dialog modal-dialog-centered" >
                                    <div class="modal-content">
                                        <div class="modal-header" >
                                            <h5 id="confirmacion_header" class="modal-title" id="exampleModalLongTitle">Registro</h5>
                                        </div>
                                        <div class="modal-body">
                                            <label id="confirmacion_body">Registro realizado con exito.</label>
                                        </div>
                                        <div class="modal-footer">
                                            <button id="btn_cerrar_confirmacion" type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- Modal de Confirmación de cambio de pass -->
                <script>
                    $(document).ready(function(){
                        $("#registro_ok").modal("show");
                        $("#btn_cerrar_confirmacion").on("click", function() {
                            $("#registro_ok").modal("hide");
                        });
                    });
                </script>';
                }
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
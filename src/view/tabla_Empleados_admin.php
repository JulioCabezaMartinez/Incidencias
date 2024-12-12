<?php

session_start();

if (empty($_SESSION)) {
    header("Location:../../../src/view/login.php");
    die();
}

require_once '../view/Templates/inicio.inc.php';

?>
<title>All Empleados</title>
</head>

<body>
    <!-- Modal CAMBIAR password -->
    <div class="modal fade" id="modal_modificar_password" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog d-flex justify-content-center">
            <div class="modal-content w-100">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel3">Modificación de Contraseña</h5>
                </div>
                <div class="modal-body p-4">
                    <form>
                        <div data-mdb-input-init class="form-outline mb-4">
                            <div>
                                <label for="nueva_password">Introduce la nueva Contraseña:</label><br>
                                <input type="password" class="form-control" name="nueva_password" id="nueva_password">
                                <br>
                                <label for="nueva_confirm">Confirme la nueva Contraseña: </label><br>
                                <input type="password" class="form-control" name="nueva_confirm" id="nueva_confirm">
                                <br>
                                <span id="error_pass" class="d-none" style="color: red;">Las contraseñas no coinciden</span>
                            </div>
                        </div>
                        <button id="btn_cerrar_password" type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button id="btn_guardar_modificar_password" type="button" class="btn btn-primary w-50" data-dismiss="modal">Modificar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal CAMBIAR password -->

    <!-- Modal de Baja -->
    <div class="modal fade" id="modal_motivo_baja" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog d-flex justify-content-center">
            <div class="modal-content w-75">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel3">Baja</h5>
                </div>
                <div class="modal-body p-4">
                    <form>
                        <!-- Motivo de Estado input -->
                        <div data-mdb-input-init class="form-outline mb-4">
                            <label class="form-label" for="name3">Motivo de la baja:</label>
                            <input id="motivo_baja" type="text" id="name3" class="form-control" />
                        </div>
                        <button id="btn_cerrar_modal_baja" type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button id="btn_guardar_estado_baja" type="button" class="btn btn-primary w-50" data-dismiss="modal">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal de baja-->

    <!-- Modal de readmision -->
    <div class="modal fade" id="modal_motivo_readmision" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog d-flex justify-content-center">
            <div class="modal-content w-75">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel3">Readmision</h5>
                </div>
                <div class="modal-body p-4">
                    <form>
                        <!-- Motivo de Estado input -->
                        <div data-mdb-input-init class="form-outline mb-4">
                            <label class="form-label" for="name3">Motivo de la readmisión</label>
                            <input id="motivo_readmision" type="text" id="name3" class="form-control" />
                        </div>
                        <button id="btn_cerrar_modal_readmision" type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button id="btn_guardar_estado_readmision" type="button" class="btn btn-primary w-50" data-dismiss="modal">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal de readmision-->
    <?php
    //Barra de busqueda para DNI en tiempo real

    include_once '../view/Templates/barra_lateral.inc.php';
    ?>
    <div class="d-flex flex-column">

        <?php

        if (isset($error)) {
            echo '<h1>' . $error . '</h1>';
        }

        ?>

        <h1>Tabla de Todos los <span id="tipo_usuario"><?php echo $tipoUsuario ?></span></h1>
        <label for="buscador">Busqueda por DNI:</label>
        <input type="text" id="busqueda_DNI_usuario" class="form-control" style="width: 10%;" maxlength="9" placeholder="12345678A">
        <table style="width: 90%;" class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID Empleado</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellidos</th>
                    <th scope="col">DNI</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody id="all_usuarios">

                <?php

                foreach ($lista_empleados as $empleado) {
                    $tipo = match ($empleado->getTipo()) {
                        1 => "Admin",
                        2 => "Cliente",
                        3 => "Empleado",
                        4 => "Empleado Jefe",
                        5 => "Empleado en espera",
                        6 => "Empleado denegando",
                        7 => "Empleado de baja",
                        8 => "Cliente de baja"
                    };
                    echo '<tr>
                            <td>' . $empleado->getId() . '</td>
                                <td>' . $empleado->getCorreo() . '</td>
                                <td>' . $empleado->getNombre() . '</td>
                                <td>' . $empleado->getApellidos() . '</td>
                                <td>' . $empleado->getDNI() . '</td>
                                <td>' . $tipo . '</td>
                                <td>';
                    if ($empleado->getTipo() != 2 && $empleado->getTipo() != 7 && $empleado->getTipo() != 8) {
                        echo '<button id="baja-' . $empleado->getId() . '-' . $empleado->getTipo() . '" class="btn btn-small btn-danger btn_baja"><i class="fa-solid fa-handshake-simple-slash"></i>Baja Empleado</button>';
                    } elseif ($empleado->getTipo() == 2) {
                        echo '<button id="baja-' . $empleado->getId() . '-' . $empleado->getTipo() . '" class="btn btn-small btn-danger btn_baja"><i class="fa-solid fa-user-slash"></i>Baja Cliente</button>';
                    } elseif ($empleado->getTipo() == 8) {
                        echo '<button id="readmision-' . $empleado->getId() . '-' . $empleado->getTipo() . '" class="btn btn-small btn-success btn_readmision"><i class="fa-solid fa-handshake-simple"></i>Readmision Cliente</button>';
                    } elseif ($empleado->getTipo() == 7) {
                        echo '<button id="readmision-' . $empleado->getId() . '-' . $empleado->getTipo() . '" class="btn btn-small btn-success btn_readmision"><i class="fa-solid fa-user-plus"></i>Readmision Empleado</button>';
                    }
                    echo '<br>
                                <a href="../../../src/controller/actions_usuario.php?action=modificar&id=' . $empleado->getId() . '" class="btn btn-small btn-primary my-1"><i class="fa-solid fa-user-pen"></i>Modificar Usuario</a>';
                    echo '<br>
                                <button id="btn_' . $empleado->getId() . '" class=" btn_cambiaPass btn btn-small btn-warning my-1">Cambiar Contraseña</button>';
                    echo '</td>
                                </tr>';
                }

                ?>

            </tbody>
        </table>
    </div>
    </div><!-- Div que cierra la barra lateral para que se mantenga en su lugar -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script>
        var id;
        var tipo;
        $(document).ready(function() {
            // Busqueda por DNI.
            var lista_usuario = $("#all_usuarios").html();
            $('#busqueda_DNI_usuario').keyup(function() {
                var DNI = $(this).val();
                let tipo_usuario = $("#tipo_usuario").text();
                if (DNI == "") {
                    $("#all_usuarios").html(lista_usuario);
                } else {
                    $.ajax({
                        url: "AJAX.php",
                        method: "POST",
                        data: {
                            mode: "busqueda_DNI_usuario",
                            DNI: DNI,
                            tipo_usuario: tipo_usuario
                        },
                        success: function(data) {

                            $("#all_usuarios").html(data);
                        }
                    })
                }

            });

            //Baja
            $(".btn_baja").click(function() {
                let att = $(this).attr("id");
                let array = att.split('-');
                id = array[1];
                tipo = array[2];
                $("#modal_motivo_baja").modal("show");

            });

            $("#btn_guardar_estado_baja").click(function() {
                let motivo_baja = $("#motivo_baja").val();
                $.ajax({
                    url: "AJAX.php",
                    method: "POST",
                    data: {
                        mode: "baja",
                        id: id,
                        motivo_baja: motivo_baja,
                        tipo: tipo
                    },
                    success: function(data) {
                        $("#modal_motivo_baja").modal("show");
                        id = null;
                        tipo = null;
                        location.reload();
                    }
                })
            });

            //Readmision
            $(".btn_readmision").click(function() {
                let att = $(this).attr("id");
                let array = att.split('-');
                id = array[1];
                tipo = array[2];
                $("#modal_motivo_readmision").modal("show");

            });

            $("#btn_guardar_estado_readmision").click(function() {
                let motivo_readmision = $("#motivo_readmision").val();
                $.ajax({
                    url: "AJAX.php",
                    method: "POST",
                    data: {
                        mode: "readmision",
                        id: id,
                        motivo_readmision: motivo_readmision,
                        tipo: tipo
                    },
                    success: function(data) {
                        $("#modal_motivo_readmision").modal("hide");
                        id = null;
                        tipo = null;
                        location.reload();
                    }
                })
            });

            // Cambio Pass
            var id_usuario;
            $(document).on("click", ".btn_cambiaPass" , function() {
                id_usuario = $(this).attr("id").split("_")[1];

                $("#modal_modificar_password").modal("show");
            });

            $("#btn_guardar_modificar_password").click(function(){
                let nueva_pass=$("#nueva_password").val();
                let nueva_confirm=$("#nueva_confirm").val();

                if(nueva_pass==nueva_confirm){
                    $.ajax({
                        url: "AJAX.php",
                        method: "POST",
                        data:{
                            mode: "cambia_pass_admin",
                            nueva_pass:nueva_pass,
                            nueva_confirm:nueva_confirm,
                            id_usuario:id_usuario
                        },
                        success:function(data){
                            
                            if(data=="Todo Correcto"){
                                Swal.fire({
                                title: "Contraseña Modificada",
                                text: "La contraseña se ha modificado con exito",
                                icon: "success"
                                }).then((result)=>{
                                    location.reload();
                                });
                            }else{
                                Swal.fire({
                                title: "Error Servidor",
                                text: "Ha habido un error en el servidor y no se ha modificado la contraseña",
                                icon: "error"
                                }).then((result)=>{
                                    location.reload();
                                });
                            }
                        }
                    })
                }else{
                    $("#error_pass").removeClass("d-none");
                } 
            });

            $("#btn_cerrar_modal_baja").click(function() {
                $("#modal_motivo_baja").modal("hide");
            });

            $("#btn_cerrar_modal_baja_readmision").click(function() {
                $("#modal_motivo_readmision").modal("hide");
            });

            $("#btn_cerrar_password").click(function(){
                $("#modal_modificar_password").modal("hide");
            })
        });
    </script>
</body>

</html>
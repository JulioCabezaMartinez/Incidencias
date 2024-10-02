<?php

    session_start();

    if (empty($_SESSION)){
        header("Location:login.php");
        die();
    }

    require_once "../view/Templates/inicio.inc.php";

?>
    <title>Creacion Incidencia</title>
</head>
<body>

    <!-- Modal de confirmación -->
    <div class="modal fade" id="modal_registro" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" >
            <div class="modal-content">
                <div class="modal-header" >
                    <h5 class="modal-title" id="exampleModalLongTitle">Insercción correcta</h5>
                </div>
                <div class="modal-body">
                    <div class=""> <!-- Falta darle estilos al register (Grid 2 columnas) -->
                        <label for="nombre">Nombre:</label><br>
                        <input id="nombre_modal" type="text" name="nombre" placeholder="Nombre" maxlength="45" required >
                        <br><br>
                        <label for="apellidos">Apellidos:</label><br>
                        <input id="apellidos_modal" type="text" name="apellidos" placeholder="Apellidos" maxlength="60" required>
                        <br><br>
                        <label for="correo">Correo:</label><br>
                        <input id="correo_modal" type="email" name="correo" maxlength="60" required>
                        <br><br>
                        <label for="pass">Contraseña:</label><br>
                        <input id="pass_modal" type="password" name="pass" maxlength="60" required>
                        <br><br>
                        <label for="confirm_pass">Confirmar Contraseña:</label><br>
                        <input id="confirm_modal" type="password" name="confirm_pass" maxlength="60" required>
                        <br><br>
                        <label for="DNI">DNI:</label><br>
                        <input id="DNI_modal" type="text" name="DNI" placeholder="12345678A" maxlength="9" pattern="(\d{8})([A-Z]{1})" required> <!-- Poner para el NIE -->
                        <br><br>
                        <label for="telefono">Telefono:</label><br>
                        <input id="telefono_modal" type="text" name="telefono" required> <!-- Poner para el NIE -->
                        <br><br>
                        <label for="direccion">Dirección:</label><br>
                        <input id="direccion_modal" type="text" name="direccion" required> <!-- Poner para el NIE -->
                        <br><br>
                        <label for="tipo">Tipo de Empleado:</label><br><br>
                        <input type="radio" name="tipo" value="Empleado"><label>Empleado</label>
                        <input type="radio" name="tipo" value="Cliente" checked><label>Cliente</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="btn_cerrar_modal" type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button id="btn_registrar_modal" type="button" class="btn btn-primary w-50" data-dismiss="modal">Registrar</button>
                </div>
            </div>
        </div>
    </div>

    <?php
        include_once '../view/Templates/barra_lateral.inc.php';
    ?>

    <div>
        <h1>Creacion de Incidencias</h1>
        <form action="../../../src/controller/actions_incidencia.php" method="post">
            <div class="row w-50 py-3 container-fluid">
                <div class="col-1 w-50">
                    <h2>Usuario Activo</h2>
                    <label for="nombre">Nombre:</label>
                    <input type="text" name="nombre" class="form-control w-100" id="nombre" value="<?php echo $usuario["nombre"] ?>" readonly>
                    <br>
                    <label for="apellidos">Apellidos:</label>
                    <input type="text" name="apellidos" class="form-control w-100" id="apellidos" value="<?php echo $usuario["apellidos"] ?>" readonly>
                    <br>
                    <label for="DNI">DNI:</label>
                    <input type="text" name="DNI" class="form-control w-100" id="DNI" value="<?php echo $usuario["DNI"] ?>" readonly>
                </div>
                <div class="col-2 w-50">
                    <h2>Cliente</h2>
                    <label for="nombre">Nombre:</label>
                    <input type="text" name="nombreCliente" class="form-control w-100" id="nombreCliente" readonly>
                    <br>
                    <label for="apellidos">Apellidos:</label>
                    <input type="text" name="apellidosCliente" class="form-control w-100" id="apellidosCliente" readonly>
                    <br>
                    <label for="DNI">DNI:</label>
                    <input type="text" name="DNICliente" class="form-control w-100" id="DNICliente" readonly>
                </div>
            </div>
            <button type="button" id="misma_persona" class="btn btn-secondary mx-4" >Son la misma persona</button>
            <?php
                if($_SESSION["tipo"]!=2){ //Los clientes no podrán ver el botón.
            ?>
            <button type="button" id="btn_modal" class="btn btn-outline-primary mx-4" >Registrar nuevo Usuario</button>
            <?php
                }
            ?>
            <div class="mx-4">
                <br><br>
                <h2>Busqueda de Cliente por DNI</h2>
                <label for="DNIBusqueda">DNI:</label><br>
                <input id="DNIBusqueda" name="DNIBusqueda" list="DNIs" class=" form-control w-25">
                <datalist id="DNIs">

                </datalist>
                    
            </div>
            
            <div class="col py-3 mx-4">
                <div class="mb-3">
                    <label for="motivo" class="form-label w-50">Motivo de la Incidencia</label>
                    <input type="text" name="motivo" class="form-control w-50" id="motivoIncidencia" placeholder="Fallo en la instalacion de servicio" required>
                </div>
            </div>
            <input class="btn btn-outline-danger mx-4" type="submit" name="crearIncidencia" value="Crear Incidencia">
        </form>
    </div>
    
</div> <!-- Div que cierra la barra lateral para que se mantenga en su lugar -->

    <!-- Script que copia los mismos datos de creación en cliente -->
    <script>
        $(document).ready(function(){
            $("#misma_persona").click(function(){
                var nombre=$("#nombre").val();
                var apellidos=$("#apellidos").val();
                var DNI=$("#DNI").val();
                $("#nombreCliente").val(nombre);
                $("#apellidosCliente").val(apellidos);
                $("#DNICliente").val(DNI);
            });
        });
    </script>

    <!-- Script modal de Registro -->
    <script type='text/javascript'>
        $("#btn_modal").on('click', function() {
            $('#modal_registro').modal('show');
        });

        //Conexión con AJAX para registrar cliente.
        $("#btn_registrar_modal").on("click", function(){
            var nombre=$("#nombre_modal").val();
            var apellidos=$("#apellidos_modal").val();
            var correo=$("#correo_modal").val();
            var pass=$("#pass_modal").val();
            var confirm=$("#confirm_modal").val();
            var DNI=$("#DNI_modal").val();
            var telefono=$("#telefono_modal").val();
            var direccion=$("#direccion_modal").val();
            var tipo=$("input[name='tipo']:checked").val();
            $.ajax({
                url: "AJAX.php",
                method: "POST",
                data:{
                    mode: registro,
                    nombre: nombre,
                    apellidos: apellidos,
                    correo: correo,
                    pass: pass,
                    confirm: confirm,
                    DNI: DNI,
                    telefono: telefono,
                    direccion: direccion,
                    tipo: tipo
                },
                success: function(data){
                    $("#DNIs").append(data);
                }
            })
        });

        $('#btn_cerrar_modal').on('click', function() {
            $('#modal_registro').modal('hide');
        });
    </script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
<?php

    session_start();

    require_once '../model/BuscadorDB.php';
    require_once '../model/usuario.php';

    if (empty($_SESSION)){
        header("Location:login.php");
        die();
    }

    $lista_DNIs=Usuario::recogerDNIsUsuarios($connection);

    require_once "../view/Templates/inicio.inc.php";

?>
    <title>Creacion Incidencia</title>
</head>
<body>

    <!-- Modal de Registro -->
    <div class="modal fade" id="modal_registro" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" >
            <div class="modal-content">
                <div class="modal-header" >
                    <h5 class="modal-title" id="exampleModalLongTitle">Menu de Registro</h5>
                </div>
                <div class="modal-body">
                    <div class=" "> <!-- Falta darle estilos al register (Grid 2 columnas) -->
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
    <!-- Modal de Confirmación de Registro -->
    <div class="modal fade" id="confirmacion_registro" tabindex="-1" >
        <div class="modal-dialog modal-dialog-centered" >
            <div class="modal-content">
                <div class="modal-header" >
                    <h5 id="confirmacion_header" class="modal-title" id="exampleModalLongTitle">Registro correcto</h5>
                </div>
                <div class="modal-body">
                    <label id="confirmacion_body">El usuario se ha registrado con éxito.</label>
                </div>
                <div class="modal-footer">
                    <button id="btn_cerrar_confirmacion" type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
                </div>
            </div>
        </div>
    </div>
    <?php
        include_once '../view/Templates/barra_lateral.inc.php';
    ?>

    <div>
        <h1>Creacion de Incidencias</h1>
            <div class="row w-75 py-3 container-fluid">
                <div class="col-1 w-25">
                <form action='../../src/controller/actions_incidencia.php' method="post">
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
                <?php
                if($_SESSION["tipo"]!=2){
                    ?>
                <div class="col-2 w-25">
                    <h2>Cliente</h2>
                        <div>
                            <h5>Busqueda de Cliente por DNI</h5>

                            <label for="DNIBusqueda">DNI (Busqueda):</label><br>
                            <div class="d-flex flex-row">
                                <input id="DNIBusqueda" name="DNIBusqueda" list="DNIs" class=" form-control h-25" autocomplete="off">
                                <button type="button" id="btn_busqueda_DNI" class="btn btn-outline-primary mx-3" ><i class="fa-solid fa-magnifying-glass"></i></button>
                            </div>
                            
                            <datalist id="DNIs">
                                <?php
                                    //foreach($lista_DNIs as $DNI){
                                ?>
                                    <!-- <option value="<?php echo $DNI ?>"><?php echo $DNI ?></option> -->
                                <?php
                                    //}
                                ?>
                            </datalist>             
                        </div>
                    <label for="nombre">Nombre:</label>
                    <input type="text" name="nombreCliente" class="form-control w-100" id="nombreCliente" required>
                    <br>
                    <label for="apellidos">Apellidos:</label>
                    <input type="text" name="apellidosCliente" class="form-control w-100" id="apellidosCliente"  required>
                </div>
                <?php
                }
                ?>
            </div>
            <!-- <button type="button" id="misma_persona" class="btn btn-secondary mx-4" >Son la misma persona</button>
            <label>(Utilice este botón para completar los campos de cliente automaticamente)</label><br><br> -->
            <?php
                if($_SESSION["tipo"]!=2){ //Los clientes no podrán ver el botón.
            ?>
            <button type="button" id="btn_modal" class="btn btn-outline-primary mx-4" >Registrar nuevo Usuario</button>
            <?php
                }
            ?>
            
            <div class="col-3 w-25 mx-4">
                <h2>Contacto</h2>
                <label for="nombre_contacto">Nombre de Contacto:</label>
                <input type="text" name="nombre_contacto" class="form-control w-100" id="nombreContacto" required>
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

    <script>
        $(document).ready(function(){
            //Script que copia los mismos datos de creación en cliente
            // $("#misma_persona").click(function(){
            //     var nombre=$("#nombre").val();
            //     var apellidos=$("#apellidos").val();
            //     var DNI=$("#DNI").val();
            //     $("#nombreCliente").val(nombre);
            //     $("#apellidosCliente").val(apellidos);
            //     $("#DNICliente").val(DNI);
            // });

            $("#btn_busqueda_DNI").click(function(){
                var DNI_busqueda_usuario=$("#DNIBusqueda").val();
                var DNI=DNI_busqueda_usuario.substring(0, 9);
                $.ajax({
                    url: "AJAX.php",
                    method: "POST",
                    data:{
                        mode:"DNI_busqueda_usuario",
                        DNI: DNI
                    },
                    success:function(data){
                        console.log(data);
                        datos=JSON.parse(data)
                    $("#nombreCliente").val(datos.nombre);
                    $("#apellidosCliente").val(datos.apellidos);
                    $("#DNICliente").val(datos.DNI);
                    }
                })
            });
        });
    </script>

    <script type='text/javascript'>
        $(document).ready(function(){

            //Script modal de Registro
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
                        mode: "registro",
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

                        $('#modal_registro').modal('hide');

                        console.log(data);

                        if(data=="Todo correcto"){
                            $('#confirmacion_registro').modal("show");
                        }else{
                            console.log("data");
                            $('#confirmacion_header').text("Registro Fallido");
                            $('#confirmacion_body').text(data);
                            $('#confirmacion_registro').modal("show");
                        }
                        
                    }
                })
            });

            $('#DNIBusqueda').keyup(function(){
                var DNI=$(this).val();
                var lista_DNIs=$("#DNIs").html();
                if(DNI==""){

                }else{
                    $.ajax({
                        url: "AJAX.php",
                        method: "POST",
                        data:{
                            mode: "busqueda_DNI",
                            DNI: DNI
                        },
                        success:function(data){
                            $("#DNIs").html(data);
                        }
                    })
                }
                
            });

            //Botón para cerrar los modales.
            $('#btn_cerrar_modal').on('click', function() {
                $('#modal_registro').modal('hide');
            });

            $('#btn_cerrar_confirmacion').on('click', function() {
                $('#confirmacion_registro').modal('hide');
            });
        });
    </script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
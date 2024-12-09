<?php

session_start();

require_once '../model/BuscadorDB.php';
require_once '../model/usuario.php';
require_once '../model/incidencias.php';

if (empty($_SESSION)) {
    header("Location:../../../src/view/login.php");
    die();
}

$lista_DNIs = Usuario::recogerDNIsUsuarios($connection);

require_once "../view/Templates/inicio.inc.php";

?>
<title>Resolución Incidencia</title>
</head>

<body>
    <?php
    include_once '../view/Templates/barra_lateral.inc.php';
    ?>
    <div>
        <h1>Modificación de Incidencias</h1>
        <!-- <?php
                //if($_GET["back"]=="asig"){ //Con esta variable podemos ver de donde viene el usuario para al darle atras pueda volver.
                ?>
                    <a href="../../../src/controller/actions_tabla.php?class=empleados" class="btn btn-secondary">← Atras</a>
                <?php
                //}elseif($_GET["back"]=="all"){
                ?>
                    <a href="../../../src/controller/actions_tabla.php?class=all" class="btn btn-secondary">← Atras</a>
                <?php
                // } 
                ?> -->


        <form action="../controller/actions_incidencia.php" method="post">
            <div class="col py-3 mx-4">
                <div class="mb-3">
                    <label for="nIncidencia" class="form-label w-50">Numero de Incidencia:</label>
                    <input type="text" name="nIncidencia" class="form-control w-25" id="motivoIncidencia" value="<?php echo $incidencia->getNIncidencia() ?>">
                </div>
                <div class="mb-3">
                    <label for="motivo" class="form-label w-50">Motivo de la Incidencia:</label>
                    <input type="text" name="motivo" class="form-control w-50" id="motivoIncidencia" value="<?php echo $incidencia->getMotivo() ?>">
                </div>


                <div class="mb-3 w-50">
                    <label for="motivo" class="form-label">Resolución de la Incidencia:</label>
                    <textarea name="resolucion" id="resolucion_instancia" class="form-control w-75" rows="6"> </textarea>
                </div>
                <br>
                <div class="mb-3 w-50">
                    <label for="estado"><strong>Estado de la Incidencia:</strong></label><br><br>
                    <?php
                    if ($incidencia->getEstado() == 1) {
                    ?>
                        <input type="radio" name="estado" value="1" checked required>Trabajando en la Incidencia
                    <?php
                    } else {
                    ?>
                        <input type="radio" name="estado" value="1" checked required>Trabajando en la Incidencia
                    <?php
                    }
                    ?>
                    <br>
                    <?php
                    if ($incidencia->getEstado() == 2) {
                    ?>
                        <input type="radio" name="estado" value="2" checked>Pendiente
                    <?php
                    } else {
                    ?>
                        <input type="radio" name="estado" value="2">Pendiente
                    <?php
                    }
                    ?>
                    <br>
                    <?php
                    if ($incidencia->getEstado() == 3) {
                    ?>
                        <input type="radio" name="estado" value="3" checked>En Seguimiento
                    <?php
                    } else {
                    ?>
                        <input type="radio" name="estado" value="3">En Seguimiento
                    <?php
                    }
                    ?>
                    <br>
                    <?php
                    if ($incidencia->getEstado() == 4) {
                    ?>
                        <input type="radio" name="estado" value="4" checked>Finalizado
                    <?php
                    } else {
                    ?>
                        <input type="radio" name="estado" value="4">Finalizado
                    <?php
                    }
                    ?>
                </div>

                <div class="mb-3">
                    <label for="motivo_estado" class="form-label w-50">Motivo de estado de Incidencia:</label>
                    <input type="text" name="motivo_estado" class="form-control w-25" id="motivoIncidencia" value="<?php echo $incidencia->getMotivoEstado() ?>">
                </div>

                <div class="d-flex mb-3" style="gap: 10px;">
                    <div style="width: 15%;">
                        <label for="id_creador" class="form-label">Id Creador de Incidencia:</label>
                        <input type="text" name="id_creador" class="form-control w-75" id="id_creador" value="<?php echo $incidencia->getIdCreador() ?>" readonly>
                    </div>
                    <div class="w-25">
                        <label for="id_creador" class="form-label w-50">DNI Creador de Incidencia:</label>
                        <div class="row">
                            <select type="text" name="DNI_creador" class="form-control w-50" id="DNI_creador">
                                <?php
                                    $busqueda_DNI=Usuario::busquedaDNI($_POST["DNI"], $connection);

                                    foreach($busqueda_DNI as $DNI){
                                        echo '<option value="'.$DNI["DNI"].'-'.$DNI["nombre"].' '. $DNI["apellidos"] .'">'.$DNI["DNI"].'-'.$DNI["nombre"].' '. $DNI["apellidos"] .'</option>';
                                    }
                                ?>
                            </select>
                            <button type="button" id="btn_busqueda_DNI_creador" class="btn btn-outline-primary col-2 w-auto mx-3" ><i class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                        
                    </div>
                    
                </div>

                <div class="d-flex mb-3" style="gap: 10px;">
                    <div style="width: 15%;">
                        <label for="id_cliente" class="form-label">Id Cliente de Incidencia:</label>
                        <input type="text" name="id_cliente" class="form-control w-75" id="id_cliente" value="<?php echo $incidencia->getIdCliente() ?>" readonly>
                    </div>
                    <div class="w-25">
                        <label for="DNI_creador" class="form-label w-50">DNI Cliente de Incidencia:</label>
                        <div class="row">
                            <select type="text" name="DNI_cliente" class="form-control w-50" id="DNI_cliente">
                            <?php
                                $busqueda_DNI=Usuario::busquedaDNI($_POST["DNI"], $connection);

                                foreach($busqueda_DNI as $DNI){
                                    echo '<option value="'.$DNI["DNI"].'-'.$DNI["nombre"].' '. $DNI["apellidos"] .'">'.$DNI["DNI"].'-'.$DNI["nombre"].' '. $DNI["apellidos"] .'</option>';
                                }
                            ?>
                            </select>
                            <button type="button" id="btn_busqueda_DNI_cliente" class="btn btn-outline-primary col-2 w-auto mx-3" ><i class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                        
                    </div>
                    
                </div>

                <div class="d-flex mb-3" style="gap: 10px;">
                    <div style="width: 15%;">
                        <label for="id_empleado" class="form-label">Id Empleado de Incidencia:</label>
                        <input type="text" name="id_empleado" class="form-control w-75" id="id_empleado" value="<?php echo $incidencia->getIdEmpleado() ?>" readonly>
                    </div>
                    <div class="w-25">
                        <label for="DNI_empleado" class="form-label w-50">DNI Empleado de Incidencia:</label>
                        <div class="row">
                            <select type="text" name="DNI_empleado" class="form-control w-50" id="DNI_empleado">
                            <?php
                                $busqueda_DNI=Usuario::busquedaDNI($_POST["DNI"], $connection);

                                foreach($busqueda_DNI as $DNI){
                                    echo '<option value="'.$DNI["DNI"].'-'.$DNI["nombre"].' '. $DNI["apellidos"] .'">'.$DNI["DNI"].'-'.$DNI["nombre"].' '. $DNI["apellidos"] .'</option>';
                                }
                                ?>
                            </select>
                            <button type="button" id="btn_busqueda_DNI_empleado" class="btn btn-outline-primary col-2 w-auto mx-3" ><i class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                        
                    </div>
                </div>

                <div class="mb-3">
                    <label for="contacto" class="form-label w-50">Persona de Contacto de Incidencia:</label>
                    <input type="text" name="contacto" class="form-control w-25" id="motivoIncidencia" value="<?php echo $incidencia->getContacto() ?>">
                </div>

                <div class="mb-3 w-50">
                    <label for="motivo" class="form-label">Observaciones: </label>
                    <textarea name="observaciones" id="observaciones_incidencia" class="form-control w-75" rows="3"><?php echo $incidencia->getObservaciones() ?></textarea>
                </div>

                <div class="mb-3 w-50">
                    <label for="motivo" class="form-label">Reabierto: </label>
                    <?php
                    if ($incidencia->getReabierto()) {
                        echo '<input type="checkbox" value=true name="reabierto" checked>Reabierto';
                    } else {
                        echo '<input type="checkbox" name="reabierto">Reabierto';
                    }
                    ?>
                </div>
                <div class="mb-3 w-50">
                    <label for="hora_apertura">Hora de Apertura de Incidencia:</label>
                    <input type="datetime" name="hora_apertura" value="<?php echo $incidencia->getHoraApertura() ?>">
                </div>
                
                <div class="mb-3 w-50">
                    <label for="hora_cierre">Hora de Cierre de Incidencia:</label>
                    <input type="datetime" name="hora_cierre" value="<?php echo $incidencia->getHoraCierre() ?>">
                </div >
                <div class="mb-3 w-50">
                    <label for="total_tiempo">Hora de Cierre de Incidencia:</label>
                    <input type="number" name="total_tiempo" value="<?php echo $incidencia->getTotalTiempo() ?>">
                </div>
            </div>
                <input id="btn_modificar_incidencia" name="modificar_incidencia" type="submit" value="Modificar" class="btn btn-outline-success mb-3">

    </div>
    </form>
    </div>
    </div>
    </div> <!-- Div que cierra la barra lateral para que se mantenga en su lugar -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function(){
            //Creador
            $("#btn_busqueda_DNI_creador").click(function(){
                var DNI_busqueda_usuario=$("#DNI_creador").val();
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
                    $("#id_creador").val(datos.id);
                    }
                })
            });
            //Cliente
            $("#btn_busqueda_DNI_cliente").click(function(){
                var DNI_busqueda_usuario=$("#DNI_cliente").val();
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
                    $("#id_cliente").val(datos.id);
                    }
                })
            });
            //Empleado
            $("#btn_busqueda_DNI_empleado").click(function(){
                var DNI_busqueda_usuario=$("#DNI_empleado").val();
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
                    $("#id_empleado").val(datos.id);
                    }
                })
            });
        })
    </script>
</body>

</html>
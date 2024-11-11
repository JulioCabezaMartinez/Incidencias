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

function recogeSegundos($incidencia)
{
    $hora_inicio = new DateTime($incidencia->getHoraApertura());
    $hora_actual = new DateTime();

    (int)$segundos = $hora_actual->getTimestamp() - $hora_inicio->getTimestamp();

    return (int)$segundos % 60;
}

function recogeMinutos($incidencia)
{
    $hora_inicio = new DateTime($incidencia->getHoraApertura());
    $hora_actual = new DateTime();

    (int)$segundos = $hora_actual->getTimestamp() - $hora_inicio->getTimestamp();

    (int)$minutos = $segundos / 60;

    return (int)$minutos % 60;
}

function recogeHoras($incidencia)
{
    $hora_inicio = new DateTime($incidencia->getHoraApertura());
    $hora_actual = new DateTime();

    (int)$segundos = $hora_actual->getTimestamp() - $hora_inicio->getTimestamp();

    (int)$minutos = $segundos / 60;

    return (int)$horas = $minutos / 60;
}

require_once "../view/Templates/inicio.inc.php";

?>
<title>Resolución Incidencia</title>
</head>

<body>

    <!-- Modal de Estado -->
    <div class="modal fade" id="modal_motivo_estado" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog d-flex justify-content-center">
            <div class="modal-content w-75">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel3">Motivo de estado</h5>
                </div>
                <div class="modal-body p-4">
                    <form>
                        <!-- Motivo de Estado input -->
                        <div data-mdb-input-init class="form-outline mb-4">
                            <label class="form-label" for="name3">Motivo de Estado</label>
                            <input id="motivo_estado" type="text" id="name3" class="form-control" />
                        </div>
                        <button id="btn_cerrar_modal" type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <?php
                        if (!isset($reapertura)) {
                        ?>
                            <button id="btn_guardar_estado_modal" type="button" class="btn btn-primary w-50" data-dismiss="modal">Guardar</button>
                        <?php
                        } else {
                        ?>
                            <button id="btn_guardar_estado_modal_reapertura" type="button" class="btn btn-primary w-50" data-dismiss="modal">Guardar</button>
                        <?php
                        }
                        ?>


                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal de Estado-->

    <!-- Modal de confirmación -->
    <div class="modal fade" id="modal_estado_confirmacion" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <?php
                    if (!isset($reapertura)) {
                    ?>
                        <h5 class="modal-title" id="exampleModalLongTitle">Incidencia Guardada</h5>
                    <?php
                    } else {
                    ?>
                        <h5 class="modal-title" id="exampleModalLongTitle">Reapertura Guardada</h5>
                    <?php
                    }
                    ?>

                </div>
                <div class="modal-body">
                    <?php
                    if (!isset($reapertura)) {
                    ?>
                        Incidencia guardada con éxito.
                    <?php
                    } else {
                    ?>
                        Reapertura guardada con éxito.
                    <?php
                    }
                    ?>
                </div>
                <div class="modal-footer">
                    <button id="cerrar" type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal de confirmación -->

    <?php
    include_once '../view/Templates/barra_lateral.inc.php';
    ?>
    <div>
        <h1>Resolución de Incidencias</h1>
        <div>
            <div>

            </div>
            <div class="my-4">
                <h3>Tiempo trabajado: </h3>
                <?php
                if (!isset($reapertura)) {
                ?>
                    <p><span id="horas"><?php echo recogeHoras($incidencia) ?></span>:<span id="minutos"><?php echo recogeMinutos($incidencia) ?></span>:<span id="segundos"><?php echo recogeSegundos($incidencia) ?></span></p><!-- Contador -->
                <?php
                } else {
                ?>
                    <p><span id="horas"><?php echo recogeHoras($reapertura) ?></span>:<span id="minutos"><?php echo recogeMinutos($reapertura) ?></span>:<span id="segundos"><?php echo recogeSegundos($reapertura) ?></span></p><!-- Contador -->
                <?php
                }
                ?>


            </div>
        </div>

        <?php
        if ($_GET["back"] == "asig") { //Con esta variable podemos ver de donde viene el usuario para al darle atras pueda volver.
        ?>
            <a href="../../../src/controller/actions_tabla.php?class=empleados" class="btn btn-secondary">← Atras</a>
        <?php
        } elseif ($_GET["back"] == "all") {
        ?>
            <a href="../../../src/controller/actions_tabla.php?class=all" class="btn btn-secondary">← Atras</a>
        <?php
        }
        ?>



        <div class="col py-3 mx-4">
            <div class="mb-3">
                <label for="motivo" class="form-label w-50">Motivo de la Incidencia</label>
                <input type="text" name="motivo" class="form-control w-50" id="motivoIncidencia" value="<?php echo $incidencia->getMotivo() ?>"> <!-- Cambiar value por incidencia-->
            </div>

            <form>
                <div class="mb-3 w-50">
                    <label for="motivo" class="form-label">Resolución de la Incidencia</label>
                    <textarea id="resolucion_instancia" class="form-control w-75" rows="6" maxlength="500"></textarea>
                </div>
                <br>
                <div class="mb-3 w-50">
                    <label for="estado"><strong>Estado de la Incidencia:</strong></label><br><br>
                    <?php
                    if (!isset($reapertura)) {
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
                            <input class="finalizado" type="radio" name="estado" value="4" checked>Finalizado
                        <?php
                        } else {
                        ?>
                            <input class="finalizado" type="radio" name="estado" value="4">Finalizado
                        <?php
                        }
                    } else {

                        if ($reapertura->getEstado() == 1) {
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
                        if ($reapertura->getEstado() == 2) {
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
                        if ($reapertura->getEstado() == 3) {
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
                        if ($reapertura->getEstado() == 4) {
                        ?>
                            <input class="finalizado" type="radio" name="estado" value="4" checked>Finalizado
                        <?php
                        } else {
                        ?>
                            <input class="finalizado" type="radio" name="estado" value="4">Finalizado
                    <?php
                        }
                    }

                    ?>

                </div>
                <div class="mb-3 w-50">
                    <label for="motivo" class="form-label">Observaciones: </label>
                    <textarea id="observaciones_incidencia" class="form-control w-75" rows="3"></textarea>
                </div>

                <!-- Firma -->
                <div id="contenedor_firma" class="d-none">

                    <div class="col-md-12">

                        <label class="" for="">Firma Empleado:</label>

                        <br />

                        <div id="sig"></div>

                        <br />

                        <button id="clear">Borrar</button>

                        <textarea id="signature64" name="signed" style="display: none"></textarea>

                    </div>
                    <br />
                </div>
                <!-- Firma -->

                <input type="hidden" id="hidden_nIncidencia" value="<?php echo $incidencia->getNIncidencia() ?>">
                <?php
                if (!isset($reapertura)) {
                ?>
                    <input type="hidden" id="hidden_hApertura" value="<?php echo $incidencia->getHoraApertura() ?>">
                    <input id="btn_guardar_resolucion" type="button" value="Guardar" class="btn btn-outline-success">
                <?php
                } else {
                ?>
                    <input type="hidden" id="hidden_hApertura" value="<?php echo $reapertura->getHoraApertura() ?>">
                    <input type="hidden" id="hidden_nReapertura" value="<?php echo $reapertura->getNreapertura() ?>">
                    <input id="btn_guardar_reapertura" type="button" value="Guardar" class="btn btn-outline-success">
                <?php
                }
                ?>


            </form>
        </div>
    </div>
    </div> <!-- Div que cierra la barra lateral para que se mantenga en su lugar -->


    <!-- Firma -->
    <script type="text/javascript">
        var sig = $('#sig').signature({
            syncField: '#signature64',
            syncFormat: 'PNG'
        });

        $('#clear').click(function(e) {

            e.preventDefault();

            sig.signature('clear');

            $("#signature64").val('');

        });
    </script>
    <!-- Firma -->

    <script>
        function conseguirFecha() {
            let fecha = new Date();
            let año = fecha.getFullYear();
            let mes = (fecha.getMonth() + 1).toString().padStart(2, '0'); // Para asegurar que los meses y días tengan 2 dígitos
            let día = fecha.getDate().toString().padStart(2, '0');
            let horas = fecha.getHours().toString().padStart(2, '0');
            let minutos = fecha.getMinutes().toString().padStart(2, '0');
            let segundos = fecha.getSeconds().toString().padStart(2, '0');

            return `${año}-${mes}-${día}T${horas}:${minutos}:${segundos}`;
        }

        function calcularTiempo(tiempoPrincipio, tiempoFinal) {
            let diferenciaMilisegundos = tiempoFinal - tiempoPrincipio;
            let diferenciaHoras = diferenciaMilisegundos / (1000 * 60);

            return diferenciaHoras;
        }

        //Cuando se pulse el boton de guardar. (Si se ha seleccionado "Trabajando en ello" se guardarán los datos usando AJAX, en caso contrario se abrirá un modal para indicar el motivo del estado)
        //Incidencia
        $(document).ready(function() {
            $("#btn_guardar_resolucion").click(function() {
                let estado = $('input[type="radio"]:checked').val();
                let resolucion = $("#resolucion_instancia").val();
                let observaciones = $("#observaciones_incidencia").val();
                let nIncidencia = $("#hidden_nIncidencia").val();
                let horaApertura = $("#hidden_hApertura").val();
                let horaCierre = conseguirFecha();
                let totalTiempo = calcularTiempo(new Date(horaApertura).getTime(), new Date(horaCierre).getTime());


                if (estado != 1) {
                    $("#modal_motivo_estado").modal("show");
                } else {
                    $.ajax({
                        url: "AJAX.php",
                        method: "POST",
                        data: {
                            mode: "resolucion_Trabajando",
                            estado: estado,
                            resolucion: resolucion,
                            observaciones: observaciones,
                            nIncidencia: nIncidencia,
                            horaApertura: horaApertura,
                            horaCierre: horaCierre,
                            totalTiempo: totalTiempo
                        },
                        success: function(data) {
                            $("#modal_motivo_estado").modal('hide');
                            $("#modal_estado_confirmacion").modal('show');
                        }
                    })
                }
            });

            //Reapertura
            $("#btn_guardar_reapertura").click(function() {
                let estado = $('input[type="radio"]:checked').val();
                let resolucion = $("#resolucion_instancia").val();
                let observaciones = $("#observaciones_incidencia").val();
                let nIncidencia = $("#hidden_nIncidencia").val();
                let nReapertura = $("#hidden_nReapertura").val();
                let horaApertura = $("#hidden_hApertura").val();
                let horaCierre = conseguirFecha();
                let totalTiempo = calcularTiempo(new Date(horaApertura).getTime(), new Date(horaCierre).getTime());


                if (estado != 1) {
                    $("#modal_motivo_estado").modal("show");
                } else {
                    $.ajax({
                        url: "AJAX.php",
                        method: "POST",
                        data: {
                            mode: "resolucion_Reapertura",
                            estado: estado,
                            resolucion: resolucion,
                            observaciones: observaciones,
                            nIncidencia: nIncidencia,
                            nReapertura: nReapertura,
                            horaApertura: horaApertura,
                            horaCierre: horaCierre,
                            totalTiempo: totalTiempo
                        },
                        success: function(data) {
                            $("#modal_motivo_estado").modal('hide');
                            $("#modal_estado_confirmacion").modal('show');
                        }
                    })
                }
            });

            //Botón de guardar Incidencia
            $("#btn_guardar_estado_modal").click(function() {
                let estado = $('input[type="radio"]:checked').val();
                let resolucion = $("#resolucion_instancia").val();
                let observaciones = $("#observaciones_incidencia").val();
                let nIncidencia = $("#hidden_nIncidencia").val();
                let nReapertura = $("#hidden_nReapertura").val();
                let motivo = $("#motivo_estado").val();
                let horaApertura = $("#hidden_hApertura").val();
                let horaCierre = conseguirFecha();
                let totalTiempo = calcularTiempo(new Date(horaApertura).getTime(), new Date(horaCierre).getTime());
                let firma= $("#signature64").val();
                $.ajax({
                    url: "AJAX.php",
                    method: "POST",
                    data: {
                        mode: "resolucion_Trabajando",
                        estado: estado,
                        motivo: motivo,
                        resolucion: resolucion,
                        observaciones: observaciones,
                        nIncidencia: nIncidencia,
                        horaApertura: horaApertura,
                        horaCierre: horaCierre,
                        totalTiempo: totalTiempo,
                        firma: firma

                    },
                    success: function(data) {
                        console.log(data);
                        $("#modal_motivo_estado").modal('hide');
                        $("#modal_estado_confirmacion").modal('show');

                    }
                })
            });

            //Botón de guardar Reapertura
            $("#btn_guardar_estado_modal_reapertura").click(function() {
                let estado = $('input[type="radio"]:checked').val();
                let resolucion = $("#resolucion_instancia").val();
                let observaciones = $("#observaciones_incidencia").val();
                let nIncidencia = $("#hidden_nIncidencia").val();
                let nReapertura = $("#hidden_nReapertura").val();
                let motivo = $("#motivo_estado").val();
                let horaApertura = $("#hidden_hApertura").val();
                let horaCierre = conseguirFecha();
                let totalTiempo = calcularTiempo(new Date(horaApertura).getTime(), new Date(horaCierre).getTime());
                let firma= $("#signature64").val();
                $.ajax({
                    url: "AJAX.php",
                    method: "POST",
                    data: {
                        mode: "resolucion_reapertura",
                        estado: estado,
                        motivo: motivo,
                        resolucion: resolucion,
                        observaciones: observaciones,
                        nIncidencia: nIncidencia,
                        nReapertura: nReapertura,
                        horaApertura: horaApertura,
                        horaCierre: horaCierre,
                        totalTiempo: totalTiempo,
                        firma: firma
                    },
                    success: function(data) {
                        console.log(data);
                        $("#modal_motivo_estado").modal('hide');
                        $("#modal_estado_confirmacion").modal('show');

                    }
                })
            });

            $("#btn_cerrar_modal").click(function() {
                $("#modal_motivo_estado").modal('hide');
            })

            $("#cerrar").click(function() {
                $("#modal_estado_confirmacion").modal('hide');
                window.location.href = "../../../src/controller/actions_tabla.php?class=empleados";
            })

            //Contador
            let segundos = $("#segundos").text();
            let minutos = $("#minutos").text();
            let horas = $("#horas").text();

            setInterval(function() {
                segundos++;
                if (segundos >= 60) {
                    segundos = 0;
                    minutos++;
                }
                if (minutos >= 60) {
                    minutos = 0;
                    horas++;
                }

                $("#horas").text(horas.toString().padStart(2, '0'));
                $("#minutos").text(minutos.toString().padStart(2, '0'));
                $("#segundos").text(segundos.toString().padStart(2, '0'));
            }, 1000);

            $("input[type='radio'][name='estado']").change(function() {
        if ($("input[type='radio'].finalizado").is(":checked")) {
            $("#contenedor_firma").removeClass("d-none");
        } else {
            $("#contenedor_firma").addClass("d-none");
        }
    });

        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>
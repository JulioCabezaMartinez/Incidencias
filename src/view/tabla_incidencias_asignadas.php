<?php

session_start();

if (empty($_SESSION)) {
    header("Location:../../../src/view/login.php");
    die();
}

require_once '../view/Templates/inicio.inc.php';
?>
<title>Incidencias</title>

</head>

<body>
    <!-- Modal de confirmación -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Asignación correcta</h5>
                </div>
                <div class="modal-body">
                    Empleado asociado con éxito.
                </div>
                <div class="modal-footer">
                    <button id="cerrar" type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal del Confirmación -->
    <!-- Modal de subida de Incidencias fisicas -->
    <div class="modal fade" id="modal_upload" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Subida de documento</h5>
                </div>
                <div class="modal-body">
                    <div class=" "> <!-- Falta darle estilos al register (Grid 2 columnas) -->
                        <label for="documento">Incidencia fisica (PDF):</label><br>
                        <input type="file" name="documento" id="documento" accept=".pdf">
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="btn_cerrar_modal" type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button id="btn_upload_modal" type="button" class="btn btn-primary w-50" data-dismiss="modal">Subir</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal de Confirmación de Registro -->
    <?php

    //Barra de busqueda para DNI en tiempo real

    include_once '../view/Templates/barra_lateral.inc.php';

    ?>
    <div class="d-flex flex-column">

        <h1>Tabla de Incidencias Asignadas</h1><br>
        <label for="buscador">Busqueda por DNI:</label>
        <input type="text" id="busqueda_DNI_incidencia" style="width: 10%;" maxlength="9" placeholder="12345678A">
        <table style="width: 85%;" class="table table-striped">
            <thead>
                <tr>
                    <th></th>
                    <th scope="col">N°Incidencia</th>
                    <th scope="col">Motivo</th>
                    <th scope="col">DNI-Cliente</th>
                    <th scope="col">Nombre-Cliente</th>
                    <th scope="col">Estado</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody id="all_incidencias">

                <?php
                foreach ($lista_incidencias as $incidencia) {
                    $usuario = Usuario::recogerUsuarioId($incidencia->getIdCliente(), $connection);
                    $estado = match ($incidencia->getEstado()) {
                        1 => "Trabajando en ello",
                        2 => "Pausa",
                        3 => "En Seguimiento",
                        4 => "Finalizado",
                        5 => "Sin trabajador Asignado"
                    }
                ?>
                    <tr id="main_row_<?php echo $incidencia->getNIncidencia() ?>" class="main-row">
                        <?php
                        if($incidencia->getReabierto()){
                        ?>
                            <td><button class="btn btn-outline-secondary"><i class="fa-solid fa-arrow-down-wide-short"></i></button></td>
                        <?php
                        }else{
                        ?>
                        <td></td>
                        <?php
                        }
                        ?>
                        <td>PTDD<?php echo substr($incidencia->getYear(), 2) ?>-<?php echo $incidencia->getNIncidencia() ?></td>
                        <td><?php echo $incidencia->getMotivo() ?></td>
                        <td><?php echo $usuario["DNI"] ?></td>
                        <td><?php echo $usuario["nombre"] . " " . $usuario["apellidos"] ?></td>
                        <td><?php echo $estado ?></td>
                        <td>
                            <?php
                            if(!$incidencia->getReabierto()){
                            ?>
                                <a href="../../src/controller/actions_tabla.php?class=sol&back=asig&nIncidencia=<?php echo $incidencia->getNIncidencia() ?>" class="btn btn-small btn-primary my-1"><i class="fa-solid fa-briefcase"></i>Trabajar en Incidencia</a><br>
                            <?php
                            }else{
                                if(Reapertura::compruebaEstadoUltimaReapertura($incidencia->getNIncidencia(), $connection)){
                            ?>
                                    <button id="btn_reabrir-<?php echo $incidencia->getNIncidencia() ?>" class="btn btn-small btn-warning my-1 btn_reabrir"><i class="fa-solid fa-envelope-open-text me-2"></i>Reabrir Incidencia</button><br>
                            <?php
                                }
                            }
                            ?>
                            <a href="../../src/controller/genera_PDF.php?nIncidencia=<?php echo $incidencia->getNIncidencia() ?>" class="btn btn-small btn-primary my-1 btn_descarga"><i class="fa-solid fa-file-arrow-down"></i> Descargar Incidencia</a><br>
                            <a href="../../src/controller/actions_tabla.php?nIncidencia=<?php echo $incidencia->getNIncidencia() ?>&class=ver_inci&back=asig" class="btn btn-small btn-primary my-1"><i class="fa-solid fa-file-arrow-down me-2"></i>Ver Incidencia</a><br>
                            <button id="incidencia_fisica/<?php echo $incidencia->getNIncidencia() ?>" class="btn btn-small btn-primary my-1 btn_subir_incidencia"><i class="fa-solid fa-upload me-2"></i>Subir incidencia</button>
                        </td>
                    </tr>
                    <tr class="subelement_<?php echo $incidencia->getNIncidencia() ?>" style="display:none;">
                            <th></th>
                            <th class="bg-dark text-light">N. Reapertura</th>
                            <th class="bg-dark text-light">Estado</th>
                            <th class="bg-dark text-light">Acciones</th>
                    <?php
                        $lista_reaperturas = Reapertura::recogerReaperturas($incidencia->getNIncidencia(), $connection);
                        foreach ($lista_reaperturas as $reapertura) {
                            $estado_reapertura = match ($reapertura->getEstado()) {
                                1 => "Trabajando en ello",
                                2 => "Pausa",
                                3 => "En Seguimiento",
                                4 => "Finalizado"
                            }

                    ?>
                        <tr class="subelement_<?php echo $incidencia->getNIncidencia() ?> ps-4" style="display:none;">
                            <td></td>
                            <td class="filas_reapertura">R-<?php echo $reapertura->getNreapertura() ?></td>
                            <td class="filas_reapertura"><?php echo $estado_reapertura ?></td>
                            <td class="filas_reapertura">
                            <a href="../../src/controller/actions_tabla.php?class=solR&back=all&nIncidencia=<?php echo $incidencia->getNIncidencia() ?>&nReapertura=<?php echo $reapertura->getNreapertura() ?>" class="btn btn-small btn-primary my-1"><i class="fa-solid fa-briefcase"></i>Trabajar en Reapertura</a><br>
                            </td>
                        </tr>
                    <?php
                        }
                    ?>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    </div><!-- Div que cierra la barra lateral para que se mantenga en su lugar -->

    <?php

    if ($_GET["class"] == "add_empleado") {
        echo "<script type='text/javascript'>
                    $(window).on('load', function() {
                        $('#exampleModalCenter').modal('show');
                    });
                    $('#cerrar').on('click', function() {
                        $('#exampleModalCenter').modal('hide');
                    });
                </script>";
    }

    ?>

    <script>
        //Script de busqueda por DNI de AJAX
        $(document).ready(function() {
            var lista_incidencias = $("#all_incidencias").html();
            $('#busqueda_DNI_incidencia').keyup(function() {
                var DNI = $(this).val();
                if (DNI == "") {
                    $("#all_incidencias").html(lista_incidencias);
                } else {
                    $.ajax({
                        url: "AJAX.php",
                        method: "POST",
                        data: {
                            mode: "busqueda_DNI_incidencias",
                            DNI: DNI
                        },
                        success: function(data) {

                            $("#all_incidencias").html(data);
                        }
                    })
                }

            });
            
            var real_nIncidencia;
            $(".btn_subir_incidencia").click(function() {
                let nIncidencia = $(this).attr("id");
                real_nIncidencia = nIncidencia.split('/')[1];
                $("#modal_upload").modal("show");
            });

            $("#btn_upload_modal").click(function() {
                let documento = $("#documento").prop('files')[0];
                let formData = new FormData();
                formData.append('documento', documento);
                formData.append('nIncidencia', real_nIncidencia);
                formData.append('mode', "upload_documento");
                console.log(documento);
                $.ajax({
                    url: "AJAX.php",
                    method: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $("#modal_upload").modal("hide");
                    }
                })
            });
            $("#btn_cerrar_modal").click(function() {
                $("#modal_upload").modal("hide");
            });

            //Mostrar Reaperturas:
            $(document).on('click', '.main-row', function(){
                console.log('soy un boton');
                let incidencia = $(this).attr('id').split('_')[2];
                // console.log(".subelement"+incidencia);
                $(".subelement_" + incidencia).toggle(); // Muestra u oculta el subelemento
            })

            $('.btn_reabrir').click(function(){
                let nIncidencia=$(this).attr('id').split('-')[1];
                $.ajax({
                    url: "AJAX.php",
                    method: "POST",
                    data:{
                        mode: "reabrir_incidencia",
                        nIncidencia: nIncidencia,
                    },
                    success:function(data){
                        location.reload();
                    }
                })
            })
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>
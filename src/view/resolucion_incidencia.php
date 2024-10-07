<?php

    session_start();

    require_once '../model/BuscadorDB.php';
    require_once '../model/usuario.php';
    require_once '../model/incidencias.php';

    if (empty($_SESSION)){
        header("Location:login.php");
        die();
    }

    $lista_DNIs=Usuario::recogerDNIsUsuarios($connection);

    require_once "../view/Templates/inicio.inc.php";

?>
    <title>Resolución Incidencia</title>
</head>
<body>

    <!-- Modal de Guardado -->
    <div class="modal fade" id="modal_motivo_estado" tabindex="-1">
        <div class="modal-dialog d-flex justify-content-center">
            <div class="modal-content w-75">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel3">Motivo de estado</h5>
                </div>
                <div class="modal-body p-4">
                    <form>
                        <!-- Motivo de Estado input -->
                        <div data-mdb-input-init class="form-outline mb-4">
                            <input type="text" id="name3" class="form-control" />
                            <label class="form-label" for="name3">Motivo de Estado</label>
                        </div>
                        <button id="btn_cerrar_modal" type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button id="btn_registrar_modal" type="button" class="btn btn-primary w-50" data-dismiss="modal">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal de Guardado-->

    <!-- Modal de confirmación -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" >
        <div class="modal-dialog modal-dialog-centered" >
            <div class="modal-content">
                <div class="modal-header" >
                    <h5 class="modal-title" id="exampleModalLongTitle">Incidencia Guardada</h5>
                </div>
                <div class="modal-body">
                    Incidencia guardada con éxito.
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
        <a href="#" class="btn btn-secondary">← Atras</a>         
        <div class="col py-3 mx-4">
            <div class="mb-3">
                <label for="motivo" class="form-label w-50">Motivo de la Incidencia</label>
                <input type="text" name="motivo" class="form-control w-50" id="motivoIncidencia" value="<?php echo $_POST["motivo_incidencia"] ?>"> <!-- Cambiar value por incidencia-->
            </div>

            <form action="">
                <div class="mb-3 w-50">
                    <label for="motivo" class="form-label">Resolución de la Incidencia</label>
                    <textarea class="form-control w-75" rows="6"></textarea>
                </div>
                <br>
                <div class="mb-3 w-50">
                    <label for="estado"><strong>Estado de la Incidencia:</strong></label><br><br>
                    <input type="radio" name="estado">Trabajando en la Incidencia
                    <br>
                    <input type="radio" name="estado">Pausa
                    <br>
                    <input type="radio" name="estado">En Seguimiento
                    <br>
                    <input type="radio" name="estado">Finalizado
                </div>
                <div class="mb-3 w-50">
                    <label for="motivo" class="form-label">Observaciones: </label>
                    <textarea class="form-control w-75" rows="3"></textarea>
                </div>
                <input type="submit" value="Guardar" class="btn btn-outline-success">
            </form>
        </div>
    </div>
    
</div> <!-- Div que cierra la barra lateral para que se mantenga en su lugar -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
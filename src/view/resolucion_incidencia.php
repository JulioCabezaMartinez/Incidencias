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
    <div class="modal fade" id="staticBackdrop3" tabindex="-1" aria-labelledby="exampleModalLabel3" aria-hidden="true">
        <div class="modal-dialog d-flex justify-content-center">
            <div class="modal-content w-75">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel3">Motivo de estado</h5>
                    <button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form>
                        <!-- Name input -->
                        <div data-mdb-input-init class="form-outline mb-4">
                            <input type="text" id="name3" class="form-control" />
                            <label class="form-label" for="name3">Name</label>
                        </div>

                        <!-- Email input -->
                        <div data-mdb-input-init class="form-outline mb-4">
                            <input type="email" id="email3" class="form-control" />
                            <label class="form-label" for="email3">Email address</label>
                        </div>

                        <!-- Checkbox -->
                        <div class="form-check d-flex justify-content-center mb-4">
                            <input class="form-check-input me-2" type="checkbox" value="" id="checkbox3" checked />
                            <label class="form-check-label" for="checkbox3">
                                I have read and agree to the terms
                            </label>
                        </div>

                        <!-- Submit button -->
                        <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    
    <?php
        include_once '../view/Templates/barra_lateral.inc.php';
    ?>

    <div>
        <h1>Resolución de Incidencias</h1>      
        <a href="#" class="btn btn-secondary">← Atras</a>         
        <div class="col py-3 mx-4">
            <div class="mb-3">
                <label for="motivo" class="form-label w-50">Motivo de la Incidencia</label>
                <input type="text" name="motivo" class="form-control w-50" id="motivoIncidencia" value="<?php echo $_POST["motivo_incidencia"] ?>">
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
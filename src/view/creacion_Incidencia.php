<?php

require_once "../view/Templates/inicio.inc.php";

?>
    <title>Creacion Incidencia</title>
</head>
<body>

    <?php
        include_once '../view/Templates/barra_lateral.inc.php';
    ?>

    <div>
        <h1>Creacion de Incidencias</h1>
        <form action="">
            <div class="col py-3">
                <div class="row-1 mb-3">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control w-25" id="nombre" value="Nombre Usuario" disabled>
                    <br>
                    <label for="apellidos">Apellidos</label>
                    <input type="text" class="form-control w-25" id="apellidos" value="Apellidos Usuario" disabled>
                </div>
            </div>
            <div class="col py-3">
                <div class="mb-3">
                    <label for="motivoIncidencia" class="form-label w-50">Motivo de la Incidencia</label>
                    <input type="text" class="form-control w-50" id="motivoIncidencia" placeholder="Fallo en la instalacion de servicio">
                </div>
            </div>
            <input class="btn btn-outline-danger" type="submit" name="crear" value="Crear Incidencia">
        </form>
    </div>
    
</div> <!-- Div que cierra la barra lateral para que se mantenga en su lugar -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
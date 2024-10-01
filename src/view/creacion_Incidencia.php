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

    <?php
        include_once '../view/Templates/barra_lateral.inc.php';
    ?>

    <div>
        <h1>Creacion de Incidencias</h1>
        <form action="../../../src/controller/actions_incidencia.php" method="post">
            <div class="col py-3">
                <div class="row-1 mb-3">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" class="form-control w-25" id="nombre" value="<?php echo $usuario["nombre"] ?>" disabled>
                    <br>
                    <label for="apellidos">Apellidos</label>
                    <input type="text" name="apellidas" class="form-control w-25" id="apellidos" value="<?php echo $usuario["apellidos"] ?>" disabled>
                    <br>
                    <label for="DNI">DNI</label>
                    <input type="text" name="DNI" class="form-control w-25" id="DNI" value="<?php echo $usuario["DNI"] ?>" disabled>
                </div>
            </div>
            <div class="col py-3">
                <div class="mb-3">
                    <label for="motivo" class="form-label w-50">Motivo de la Incidencia</label>
                    <input type="text" name="motivo" class="form-control w-50" id="motivoIncidencia" placeholder="Fallo en la instalacion de servicio" required>
                </div>
            </div>
            <input class="btn btn-outline-danger" type="submit" name="crearIncidencia" value="Crear Incidencia">
        </form>
    </div>
    
</div> <!-- Div que cierra la barra lateral para que se mantenga en su lugar -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
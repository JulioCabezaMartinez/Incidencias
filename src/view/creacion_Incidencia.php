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
            <div class="row w-50 py-3 container-fluid">
                <div class="col 1 w-50">
                    <h2>Usuario Activo</h2>
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" class="form-control w-100" id="nombre" value="<?php echo $usuario["nombre"] ?>" readonly>
                    <br>
                    <label for="apellidos">Apellidos</label>
                    <input type="text" name="apellidos" class="form-control w-100" id="apellidos" value="<?php echo $usuario["apellidos"] ?>" readonly>
                    <br>
                    <label for="DNI">DNI</label>
                    <input type="text" name="DNI" class="form-control w-100" id="DNI" value="<?php echo $usuario["DNI"] ?>" readonly>
                </div>

                <div class="col-2 w-50">
                    <h2>Cliente</h2>
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombreCliente" class="form-control w-100" id="nombreCliente" readonly>
                    <br>
                    <label for="apellidos">Apellidos</label>
                    <input type="text" name="apellidosCliente" class="form-control w-100" id="apellidosCliente" readonly>
                    <br>
                    <label for="DNI">DNI</label>
                    <input type="text" name="DNICliente" class="form-control w-100" id="DNICliente" readonly>
                </div>
            </div>
            <button type="button" id="misma_persona" class="btn btn-secondary" >Son la misma persona</button>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
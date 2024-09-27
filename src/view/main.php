<?php

    require_once '../view/Templates/inicio.inc.php'

?>
<title>Main</title>
</head>
<body>
    <?php
        $usurioActivo=1; //Prueba de que con la base de datos funcionando el usuario admin seria el unico que pudiera ver 
    
        include_once '../view/Templates/barra_lateral.inc.php';
    ?>

    <div class="col py-3">
            <img class="DonDigitalLogo" src="../../assets/IMG/Imagotipo_Color_Negativo.webp" alt=""><br><br>
            <!-- Aqui tengo indicar un texto que le de la bienvenida al usuario y botones para crear una incidencia.-->
            <div class="d-flex flex-column justify-content-center align-items-center">
                <h1>Bienvenido, <span>Nombre del usuario</span></h1>
                <h3>Se encuentra en el portal de incidencias de DonDigtal. En caso de que tenga algún problema con alguno de nuestros servicios pulse el siguiente botón para crear una incidencia:</h3>
                <a href="creacion_Incidencia.php" class="btn btn-outline-danger w-50">Crear Incidencia</a>
            </div>
            
    </div>
</div> <!-- Div que cierra la barra lateral para que se mantenga en su lugar -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
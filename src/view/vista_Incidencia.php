<?php
    
    session_start();

    ini_set('display_errors', 1);
    error_reporting(E_ALL & ~E_NOTICE);

    if (empty($_SESSION)){
        header("Location:../../../src/view/login.php");
        die();
    }

    require_once '../view/Templates/inicio.inc.php';
    
?>
<title>Vista Incidencia</title>
</head>
<body>
    <?php
        include_once '../view/Templates/barra_lateral.inc.php';
    ?>

    <div class="col py-3">
        <img class="DonDigitalLogo" src="../../assets/IMG/Imagotipo_Color_Negativo.webp" alt=""><br><br>
        <?php
        if ($_GET["back"] == "asig") { //Con esta variable podemos ver de donde viene el usuario para al darle atras pueda volver.
        ?>
            <a href="../../../src/controller/actions_tabla.php?class=empleados" class="btn btn-secondary back">← Atras</a>
        <?php
        } elseif ($_GET["back"] == "all") {
        ?>
            <a href="../../../src/controller/actions_tabla.php?class=all" class="btn btn-secondary back">← Atras</a>
        <?php
        }
        ?>
        <br><br>
        <h2>Número de Incidencia:</h2>
        <p class="display-6">PTDD<?php echo substr($incidencia->getYear(), 2) ?>-<?php echo $incidencia->getNumeroYear($incidencia->getYear(), $incidencia->getNIncidencia(), $connection) ?></p>
        <br><br>
        <h2>Motivo de la Incidencia:</h2>
        <p class="display-6"><?php echo $incidencia->getMotivo() ?></p>
        <br><br>
        <h2>Solución/Trabajo Realizado:</h2>
        <p class="display-6"><?php echo mb_convert_encoding($incidencia->getSolucion(), 'UTF-8', 'UTF-8'); ?></p>
        <br><br>
        <h2>Tiempo total empleado:</h2>
        <p class="display-6"><?php echo intval(round($incidencia->getTotalTiempo()))." min" ?></p>
    </div>
</div> <!-- Div que cierra la barra lateral para que se mantenga en su lugar -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
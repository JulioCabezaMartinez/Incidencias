<?php
    
    session_start();

    if (empty($_SESSION)){
        header("Location:login.php");
        die();
    }

    require_once '../view/Templates/inicio.inc.php';

?>
<title>Incidencias</title>
</head>
<body>
    <?php
        $usurioActivo=1; //Prueba de que con la base de datos funcionando el usuario admin seria el unico que pudiera ver.
    
        //Barra de busqueda para DNI en tiempo real

        include_once '../view/Templates/barra_lateral.inc.php';
    ?>
    <div class="d-flex flex-column">

        <?php

            if(isset($error)){
                echo '<h1>'.$error.'</h1>';
            }

        ?>

        <h1>Tabla de Incidencias</h1>
        <table style="width: 97%;" class="table table-striped h-25 ">
            <thead>
                <tr>
                <th scope="col">N°Incidencia</th>
                <th scope="col">Motivo</th>
                <th scope="col">Remitente</th>
                <th scope="col">Estado</th>
                <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                
                <?php

                    foreach($lista_incidencias as $incidencia){
                        echo '<tr>
                                <td>01-'. $incidencia->getNIncidencia() .'</td>
                                <td>'. $incidencia->getMotivo() .'</td>
                                <td>'. $incidencia->getIdCreador() .'</td>
                                <td>'. $incidencia->getEstado() .'</td>
                                <td>
                                    <a href="#" class="btn btn-small btn-danger"><i class="fa-solid fa-envelope-open-text"></i></a>
                                    <a href="#" class="btn btn-small btn-danger"><i class="fa-solid fa-envelope-open-text"></i></a>
                                </td>
                            <tr>';
                    }

                ?>
                </tr>
            </tbody>
        </table>
    </div>
</div><!-- Div que cierra la barra lateral para que se mantenga en su lugar -->
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>


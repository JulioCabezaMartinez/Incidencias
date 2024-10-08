<?php
    
    session_start();

    if (empty($_SESSION)){
        header("Location:../../../src/view/login.php");
        die();
    }

    require_once '../view/Templates/inicio.inc.php';

?>
<title>Incidencias</title>
</head>
<body>
    <?php
        //Barra de busqueda para DNI en tiempo real

        include_once '../view/Templates/barra_lateral.inc.php';
    ?>
    <div class="d-flex flex-column">

        <?php

            if(isset($error)){
                echo '<h1>'.$error.'</h1>';
            }

        ?>

        <h1>Tabla de Posibles Empleados</h1>
        <table style="width: 97%;" class="table table-striped" >
            <thead>
                <tr>
                <th scope="col">ID Empleado</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellidos</th>
                <th scope="col">DNI</th>
                <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>

                <?php

                    foreach($lista_empleados as $empleado){
                        echo '<tr>
                        <td>'. $empleado["id"] .'</td>
                            <td>'. $empleado["nombre"] .'</td>
                            <td>'. $empleado["apellidos"] .'</td>
                            <td>'. $empleado["DNI"] .'</td>
                            <td>
                                <a href="../../../src/controller/actions_tabla.php?class=ok&id='.$empleado["id"].'" class="btn btn-small btn-success"><i class="fa-regular fa-thumbs-up"></i></a>
                                <a href="../../../src/controller/actions_tabla.php?class=reject&id='.$empleado["id"].'" class="btn btn-small btn-danger"><i class="fa-solid fa-xmark"></i></a>
                            </td>
                            </tr>';
                    }

                ?>
            </tbody>
        </table>
    </div>
</div><!-- Div que cierra la barra lateral para que se mantenga en su lugar -->
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>


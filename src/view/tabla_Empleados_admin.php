<?php
    
    session_start();

    if (empty($_SESSION)){
        header("Location:../../../src/view/login.php");
        die();
    }

    require_once '../view/Templates/inicio.inc.php';

?>
<title>All Empleados</title>
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

        <h1>Tabla de Todos los Empleados</h1>
        <table style="width: 90%;" class="table table-striped" >
            <thead>
                <tr>
                <th scope="col">ID Empleado</th>
                <th scope="col">Correo</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellidos</th>
                <th scope="col">DNI</th>
                <th scope="col">Tipo</th>
                <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>

                <?php

                        foreach($lista_empleados as $empleado){
                            $tipo=match($empleado->getTipo()){
                                1=>"Admin",
                                2=>"Cliente",
                                3=>"Empleado",
                                4=>"Empleado Jefe",
                                5=>"Empleado en espera",
                                6=>"Empleado denegando",
                                7=>"Empleado de baja",
                                8=>"Cliente de baja"
                            };
                            echo '<tr>
                            <td>'. $empleado->getId() .'</td>
                                <td>'. $empleado->getCorreo() .'</td>
                                <td>'. $empleado->getNombre() .'</td>
                                <td>'. $empleado->getApellidos() .'</td>
                                <td>'. $empleado->getDNI() .'</td>
                                <td>'. $tipo .'</td>
                                <td>';
                                if($empleado->getTipo()!=2 && $empleado->getTipo()!=7 && $empleado->getTipo()!=8){
                                    echo '<a href="../../../src/controller/actions_usuario.php?action=bajaEmpleado&id='.$empleado->getId().'" class="btn btn-small btn-danger"><i class="fa-solid fa-handshake-simple-slash"></i></a>Baja Empleado';
                                }elseif($empleado->getTipo()==2){
                                    echo '<a href="../../../src/controller/actions_usuario.php?action=bajaCliente&id='.$empleado->getId().'" class="btn btn-small btn-danger"><i class="fa-solid fa-user-slash"></i></a>Baja Cliente';
                                }elseif($empleado->getTipo()==8){
                                    echo'<a href="../../../src/controller/actions_usuario.php?action=readmisionCliente&id='.$empleado->getId().'" class="btn btn-small btn-success"><i class="fa-solid fa-handshake-simple"></i></a>Readmision Cliente';
                                }elseif($empleado->getTipo()==7){
                                    echo'<a href="../../../src/controller/actions_usuario.php?action=readmisionEmpleado&id='.$empleado->getId().'" class="btn btn-small btn-success"><i class="fa-solid fa-user-plus"></i></a>Readmision Empleado';
                                }
                                echo '<br>
                                <a href="../../../src/controller/actions_usuario.php?action=modificar&id='.$empleado->getId().'" class="btn btn-small btn-primary my-1"><i class="fa-solid fa-user-pen"></i></a>Moficar Usuario';
                                echo '</td>
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


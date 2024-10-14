<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL & ~E_NOTICE);

    session_start();

    require '../model/BuscadorDB.php';
    require '../model/incidencias.php';
    require '../model/usuario.php';
    

    if(isset($_GET['class'])){

        switch($_GET['class']){

            case 'all':
                $lista_incidencias=Incidencias::recogerTodasIncidencias($connection);

                include '../view/tabla_incidencias.php';
                break;

            case 'cliente':
                $lista_incidencias=Incidencias::recogerTodasIncidenciasUsuario($connection, $_SESSION["id"]);

                include '../view/tabla_incidencias.php';
                break;

            case 'em':
                $lista_empleados=Usuario::verNoEmpleados($connection);
               
                include "../view/tabla_Empleados.php";
                break;

            case 'ok':
                if(Usuario::aceptarEmpleado($_GET['id'], $connection)){
                    $lista_empleados=Usuario::verNoEmpleados($connection);
               
                    include "../view/tabla_Empleados.php";
                    
                }
                break;

            case 'reject':
                if(Usuario::denegarEmpleado($_GET['id'], $connection)){
                    $lista_empleados=Usuario::verNoEmpleados($connection);
               
                    include "../view/tabla_Empleados.php";
                    
                }
                break;
            case 'add_empleado':
                if(Incidencias::asignarEmpleado($_SESSION['id'], $_POST["nIncidencia"], $connection)){
                    $lista_incidencias=Incidencias::recogerTodasIncidenciasAsignadasUsuario($connection, $_SESSION["id"]);
    
                    include '../../src/view/tabla_incidencias_asignadas.php';

                }else{
                    echo mysqli_error($connection);
                }
                break;

            case 'del_empleado':
                if(Incidencias::eliminarEmpleado($_SESSION['id'], $_POST["nIncidencia"], $connection)){
                    $lista_incidencias=Incidencias::recogerTodasIncidenciasAsignadasUsuario($connection, $_SESSION["id"]);
    
                    include '../../src/view/tabla_incidencias_asignadas.php';

                }else{
                    echo mysqli_error($connection);
                }
                break;

            case 'empleados':
                $lista_incidencias=Incidencias::recogerTodasIncidenciasAsignadasUsuario($connection, $_SESSION["id"]);
    
                include '../../src/view/tabla_incidencias_asignadas.php';
                break;
            
            case 'sol':
                $incidencia=Incidencias::recogerIncidencia($connection, $_GET["nIncidencia"]);
                $incidencia->setHoraApertura(date('Y-m-d\TH:i:s'));
                include '../../src/view/resolucion_incidencia.php';
                break;
            
            case 'all_em':
                $lista_empleados=Usuario::verAllEmpleados($connection);
               
                include "../view/tabla_Empleados_admin.php";
                break;
            case 'no_asig':
                $lista_incidencias=Incidencias::recogerTodasIncidenciasNoAsignadas($connection);

                include "../view/tabla_incidencias_no_asignadas.php";
                break;
        }
    }
    
        
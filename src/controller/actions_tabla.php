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

            case 'mi':
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
        }
    }
    
        
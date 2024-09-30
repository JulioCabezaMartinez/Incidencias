<?php

    session_start();

    require '../model/BuscadorDB.php';
    require '../model/incidencias.php';
    require '../model/usuario.php';
    

    if(isset($_GET['class'])){

        if($_GET['class']=='all'){

            $lista_incidencias=Incidencias::recogerTodasIncidencias($connection);

            include '../view/tabla_incidencias.php';

        }elseif($_GET['class']=='mi'){
            
            // $lista_incidencias=Incidencias::recogerTodasIncidenciasUsuario($connection, ); Aqui falta el ID de usuario que se cogerá por sesión.

            include '../view/tabla_incidencias.php';

        }elseif($_GET['class']=='em'){
            $lista_empleados=Usuario::verNoEmpleados($connection);

            if(is_string($lista_empleados)){

                var_dump($lista_empleados);    

            }else{

                include "../view/tabla_Empleados.php";

            }
            


        }
    }
        
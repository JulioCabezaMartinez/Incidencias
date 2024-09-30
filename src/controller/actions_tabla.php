<?php

    session_start();

    require '../model/BuscadorDB.php';
    require '../model/incidencias.php';
    

    if(isset($_GET['class'])){

        if($_GET['class']=='all'){

            $lista_incidencias=Incidencias::recogerTodasIncidencias($connection);

            include '../view/tabla_incidencias.php';

        }elseif($_GET['class']=='mi'){
            
            // $lista_incidencias=Incidencias::recogerTodasIncidenciasUsuario($connection, ); Aqui falta el ID de usuario que se cogerá por sesión.

            include '../view/tabla_incidencias.php';
        }

       
    }
        
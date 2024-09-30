<?php

    session_start();

    require '../model/BuscadorDB.php';
    require '../model/incidencias.php';

    // $lista_incidencias=Incidencias::recogerTodasIncidenciasUsuario($connection, ); Aqui falta el ID de usuario que se cogerá por sesión.

    include '../view/tabla_incidencias.php';
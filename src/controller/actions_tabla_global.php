<?php

    require '../model/BuscadorDB.php';
    require '../model/incidencias.php';

    $lista_incidencias=Incidencias::recogerTodasIncidencias($connection);

    include '../view/tabla_incidencias.php';
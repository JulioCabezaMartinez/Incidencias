<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL & ~E_NOTICE);

    session_start();

    include "../model/BuscadorDB.php";
    include "../model/usuario.php";
    include "../model/incidencias.php";

    if(isset($_GET["inci"])){
        if($_GET["inci"]==1){
            $usuario=Usuario::recogerDatosEmpleado($_SESSION["id"], $connection);

            include "../view/creacion_Incidencia.php";
        }
    }

    if(isset($_POST["crearIncidencia"])){
        $resultado=Incidencias::creacionIncidencia($_POST["motivo"], $_SESSION["id"], $connection);

        var_dump($resultado);

        if($resultado){
            
            header("Location: ../../../src/controller/actions_tabla.php?class=mi&add=ok");
        }else{
            header("Location: ../../../src/view/main.php");
        }
    }
    


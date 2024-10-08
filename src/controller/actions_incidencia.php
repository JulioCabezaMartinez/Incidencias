<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL & ~E_NOTICE);

    session_start();

    if (empty($_SESSION)){
        header("Location:../../../src/view/login.php");
        die();
    }

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
        if($_SESSION["tipo"]==2){
            $id_cliente=$_SESSION["id"];
        }else{
            $id_cliente=Usuario::recogerIDUsuarioDNI($_POST["DNICliente"], $connection);
        }

        $resultado=Incidencias::creacionIncidencia($_POST["motivo"], $_SESSION["id"], $id_cliente, $_POST["nombre_contacto"], $connection);

        var_dump($resultado);

        if($resultado){
            
            header("Location: ../../../src/controller/actions_tabla.php?class=empleados&add=ok");
        }
    }
    


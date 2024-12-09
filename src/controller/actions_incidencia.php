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

        $resultado=Incidencias::creacionIncidencia($_POST["motivo"], $_SESSION["id"], $id_cliente, $_POST["nombre_contacto"], $connection, $_FILES);
        if($resultado){
            if($_SESSION['tipo']==2){
                header("Location: ../../../src/controller/actions_tabla.php?class=cliente&add=ok");
            }else{
                header("Location: ../../../src/controller/actions_tabla.php?class=all&add=ok");
            }
        }else{
            echo $resultado;
        }
    }

    if(isset($_GET["action"])){
        if($_GET["action"]=="mod"){
            $incidencia=Incidencias::recogerIncidencia($connection, $_GET["nIncidencia"]);
            include "../view/modificar_Incidencia.php";
        }
    }

    if(isset($_POST["modificar_incidencia"])){
        if(isset($_POST["reabierto"])){
            $resultado=Incidencias::actualizarIncidencia($_POST["estado"], $_POST["motivo"], $_POST["motivo_estado"], $_POST["id_creador"], $_POST["id_cliente"], $_POST["id_empleado"], $_POST['contacto'], true, $_POST["resolucion"], $_POST["observaciones"], $_POST["nIncidencia"], $_POST["hora_apertura"], $_POST["hora_cierre"], $_POST["total_tiempo"], $connection);
        }else{
            $resultado=Incidencias::actualizarIncidencia($_POST["estado"], $_POST["motivo"], $_POST["motivo_estado"], $_POST["id_creador"], $_POST["id_cliente"], $_POST["id_empleado"], $_POST['contacto'], false, $_POST["resolucion"], $_POST["observaciones"], $_POST["nIncidencia"], $_POST["hora_apertura"], $_POST["hora_cierre"], $_POST["total_tiempo"], $connection);

        }
    
        if($resultado){
            header("Location: ../../src/controller/actions_tabla.php?class=all");
        }else{
            echo mysqli_error($connection);
        }
    }

    


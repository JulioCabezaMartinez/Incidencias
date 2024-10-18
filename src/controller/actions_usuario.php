<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL & ~E_NOTICE);

    session_start();

    

    include "../model/BuscadorDB.php";
    include "../model/usuario.php";
    include "../model/incidencias.php";


    if(isset($_POST["register"])){
        if(isset($_FILES["imagen"])){
            $resultado=Usuario::registrarUsuario($_POST["correo"], $_POST["tipo"], $_POST["pass"], $_POST["confirm_pass"],
         $_POST["nombre"], $_POST["apellidos"], $_POST["DNI"], $_POST["telefono"], $_POST["direccion"], $connection, $_FILES["imagen"]);

            if(is_string($resultado)){
                $error=$resultado;
            }

            echo $error;

            //header('Location: ../view/login.php?action=register');
        }else{
            $resultado=Usuario::registrarUsuario($_POST["correo"], $_POST["tipo"], $_POST["pass"], $_POST["confirm_pass"],
         $_POST["nombre"], $_POST["apellidos"], $_POST["DNI"], $_POST["telefono"], $_POST["direccion"], $connection);

            if(is_string($resultado)){
                $error=$resultado;
            }

            echo var_dump($_FILES   );

            // header('Location: ../view/login.php?action=register');
        }
        
    }

    if(isset($_POST['login'])){
       
        if(Usuario::LogIn($_POST['correo'], $_POST['pass'], $connection)){
            if($_SESSION["tipo"]>=4){

                Usuario::logOut();
                header("Location: ../view/login.php?action=2");

            }else{

                include "../view/main.php";
            } 

        }else{
            header("Location: ../view/login.php?action=1");
        }
    }

    if(isset($_GET['action'])){
        if($_GET['action']=="cerrar"){
            Usuario::logOut();
    
            header("Location: ../view/login.php");
        }

        if($_GET['action']==0){
            include "../view/main.php";
        }

        if($_GET['action']=="modificar"){
            $usuario=Usuario::recogerDatosEmpleadoAdmin($_GET["id"], $connection);
            include "../view/modificar_usuario.php";
        }

        if($_GET['action']=="bajaEmpleado"){
            $usuario=Usuario::bajaEmpleado($_GET["id"], $connection);
            header("Location: ../../../src/controller/actions_tabla.php?class=all_em");
        }

        if($_GET['action']=="readmisionEmpleado"){
            $usuario=Usuario::readmisionEmpleado($_GET["id"], $connection);
            header("Location: ../../../src/controller/actions_tabla.php?class=all_em");
        }

        if($_GET['action']=="bajaCliente"){
            $usuario=Usuario::bajaCliente($_GET["id"], $connection);
            header("Location: ../../../src/controller/actions_tabla.php?class=all_em");
        }

        if($_GET['action']=="readmisionCliente"){
            $usuario=Usuario::readmisionCliente($_GET["id"], $connection);
            header("Location: ../../../src/controller/actions_tabla.php?class=all_em");
        }
    }

    if(isset($_POST["modificar"])){
        $resultado=Usuario::modificarUsuario($_POST["idUsuario"], $_POST["correo"], $_POST["tipo"], $_POST["telefono"], $_POST["direccion"], $_POST["nombre"], $_POST["apellidos"], $_POST["DNI"], $_POST["motivo_baja"], $_POST["motivo_readmision"], $_POST["fecha_baja"], $_POST["fecha_readmision"], $connection);
        if($resultado){
            header("Location: ../../src/controller/actions_tabla.php?class=all_em");
            die();
        }else{
            echo mysqli_error($connection);
        }
    }
   
    if(isset($_POST["guardar_pass"])){

        if(Usuario::cambiarPass($_SESSION["id"], $_POST["old_pass"], $_POST["new_pass"], $_POST["confirm"], $connection)){
            Usuario::logOut();
            header("Location: ../view/login.php?action=3");
            
            die();
        }else{
            return mysqli_error($connection);
        }
    }

?>
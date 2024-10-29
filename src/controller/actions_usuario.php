<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL & ~E_NOTICE);

    session_start();

    

    include "../model/BuscadorDB.php";
    include "../model/usuario.php";
    include "../model/incidencias.php";


    if(isset($_POST["register"])){
        if(!empty($_FILES["imagen"]["name"])){
            if(!empty($_POST["nombre_empresa"])){//Empresa
                $resultado=Usuario::registrarUsuario($_POST["tipo_registro"], $_POST["correo"], "Cliente", $_POST["pass"], $_POST["confirm_pass"],
         $_POST["nombre"], $_POST["apellidos"], $_POST["DNI"], $_POST["telefono"], $_POST["direccion"], $_POST["pais"], $_POST["ciudad"], $connection, image: $_FILES["imagen"], nombre_empresa: $_POST["nombre_empresa"], CIF:$_POST["CIF"]);

            if(is_string($resultado)){
                    $error=$resultado;
                    header('Location: ../view/login.php?action=error&error='.$error.'');
                }else{
                    header('Location: ../view/login.php?action=register');
                }

            }elseif(!empty($_POST["nombre_comercial"])){//Autonomo
                $resultado=Usuario::registrarUsuario($_POST["tipo_registro"], $_POST["correo"], "Cliente", $_POST["pass"], $_POST["confirm_pass"],
         $_POST["nombre"], $_POST["apellidos"], $_POST["DNI"], $_POST["telefono"], $_POST["direccion"], $_POST["pais"], $_POST["ciudad"], $connection, image: $_FILES["imagen"], nombre_comercial:$_POST["nombre_comercial"]);
            
                if(is_string($resultado)){
                    $error=$resultado;
                    header('Location: ../view/login.php?action=error&error='.$error.'');
                }else{
                    header('Location: ../view/login.php?action=register');
                }

            }else{//Particular
                $resultado=Usuario::registrarUsuario($_POST["tipo_registro"], $_POST["correo"], "Cliente", $_POST["pass"], $_POST["confirm_pass"],
                $_POST["nombre"], $_POST["apellidos"], $_POST["DNI"], $_POST["telefono"], $_POST["direccion"], $_POST["pais"], $_POST["ciudad"], $connection, image: $_FILES["imagen"]);
       
                if(is_string($resultado)){
                    $error=$resultado;
                    header('Location: ../view/login.php?action=error&error='.$error.'');
                }else{
                    header('Location: ../view/login.php?action=register');
                }
            }
           
        }else{
            if(!empty($_POST["nombre_empresa"])){
                $resultado=Usuario::registrarUsuario($_POST["tipo_registro"], $_POST["correo"], "Cliente", $_POST["pass"], $_POST["confirm_pass"],
                $_POST["nombre"], $_POST["apellidos"], $_POST["DNI"], $_POST["telefono"], $_POST["direccion"], $_POST["pais"], $_POST["ciudad"], $connection, nombre_empresa: $_POST["nombre_empresa"], CIF:$_POST["CIF"]);
    
                if(is_string($resultado)){
                    $error=$resultado;
                    header('Location: ../view/login.php?action=error&error='.$error.'');
                }else{
                    header('Location: ../view/login.php?action=register');
                }

            }elseif(!empty($_POST["nombre_comercial"])){
                
                $resultado=Usuario::registrarUsuario($_POST["tipo_registro"], $_POST["correo"], "Cliente", $_POST["pass"], $_POST["confirm_pass"],
                $_POST["nombre"], $_POST["apellidos"], $_POST["DNI"], $_POST["telefono"], $_POST["direccion"], $_POST["pais"], $_POST["ciudad"], $connection, nombre_comercial: $_POST["nombre_comercial"]);

                if(is_string($resultado)){
                    $error=$resultado;
                    header('Location: ../view/login.php?action=error&error='.$error.'');
                }else{
                    header('Location: ../view/login.php?action=register');
                }

                

            }else{
                $resultado=Usuario::registrarUsuario($_POST["tipo_registro"], $_POST["correo"], "Cliente", $_POST["pass"], $_POST["confirm_pass"],
                $_POST["nombre"], $_POST["apellidos"], $_POST["DNI"], $_POST["telefono"], $_POST["direccion"], $_POST["pais"], $_POST["ciudad"], $connection);
    
                if(is_string($resultado)){
                    $error=$resultado;
                    header('Location: ../view/login.php?action=error&error='.$error.'');
                }else{
                    header('Location: ../view/login.php?action=register');
                }
            }
            
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
        $resultado=Usuario::modificarUsuario($_POST["idUsuario"], $_POST["correo"], "2", $_POST["telefono"], $_POST["direccion"], $_POST["nombre"], $_POST["apellidos"], $_POST["DNI"], $_POST["motivo_baja"], $_POST["motivo_readmision"], $_POST["fecha_baja"], $_POST["fecha_readmision"], $connection);
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
<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL & ~E_NOTICE);

    session_start();

    include "../model/BuscadorDB.php";
    include "../model/usuario.php";
    include "../model/incidencias.php";


    if(isset($_POST["register"])){ //En este caso falta comprobar correo y/o DNI para evitar la duplicidad de contenido.
        $resultado=Usuario::registrarUsuario($_POST["correo"], $_POST["tipo"], $_POST["pass"], $_POST["confirm_pass"],
         $_POST["nombre"], $_POST["apellidos"], $_POST["DNI"], $_POST["telefono"], $_POST["direccion"], $connection);

        header("Location: ../view/login.php?action=register");
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
    }
   
?>
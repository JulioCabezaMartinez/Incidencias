<?php
    session_start();

    include "../model/BuscadorDB.php";
    include "../model/usuario.php";


    if(isset($_POST["register"])){ //En este caso falta comprobar correo y/o DNI para evitar la duplicidad de contenido.
        $resultado=Usuario::registrarUsuario($_POST["correo"], $_POST["tipo"], $_POST["pass"], $_POST["confirm_pass"],
         $_POST["nombre"], $_POST["apellidos"], $_POST["DNI"], $connection);

        header("Location: ../view/login.php?action=register");
    }

    if(isset($_POST['login'])){
       
        if(Usuario::LogIn($_POST['correo'], $_POST['pass'], $connection)){
            include "../view/main.php";
        }else{
            header("Location: ../view/login.php?action=1");
        }
    }

    if(isset($_GET['action'])){
        if($_GET['action']=="cerrar"){
            Usuario::logOut();
    
            header("Location: ../view/login.php");
        }
    }
   
?>
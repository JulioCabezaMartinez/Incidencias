<?php

    session_start();

    include "../model/BuscadorDB.php";
    include "../model/usuario.php";


    if(isset($_POST["register"])){
        $resultado=Usuario::registrarUsuario($_POST["correo"], $_POST["tipo"], $_POST["pass"], $_POST["confirm_pass"],
         $_POST["nombre"], $_POST["apellidos"], $_POST["DNI"], $connection);
    
        if($resultado){
            echo "Insercción correcta";
        }else{
            echo "Fallo en Insercción";
        }
    }
   
    
?>
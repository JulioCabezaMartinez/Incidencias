<?php

    require "../model/BuscadorDB.php";
    require "../model/usuario.php";

    if(isset($_POST["mode"])){
        if($_POST["mode"]=="registro"){
            $resultado=Usuario::registrarUsuario($_POST["correo"], $_POST["tipo"], $_POST["pass"], $_POST["confirm"],
         $_POST["nombre"], $_POST["apellidos"], $_POST["DNI"], $_POST["telefono"], $_POST["direccion"], $connection);

            

         if(is_string($resultado)){
            echo $resultado;
         }else{
            echo "Todo correcto";
         }
        }

        if($_POST["mode"]=="busqueda_DNI"){
            $busqueda_DNI=Usuario::busquedaDNI($_POST["DNI"], $connection);

            foreach($busqueda_DNI as $DNI){
                echo '<option value="'.$DNI.'"><'.$DNI.'</option>';
            }
        }

        if($_POST["mode"]=="DNI_busqueda_usuario"){
            $cliente=Usuario::recogerUsuarioDNI($_POST["DNI"], $connection);

            echo json_encode($cliente);
        }
    }
<?php

    session_start();

    require "../model/BuscadorDB.php";
    require "../model/usuario.php";
    require "../model/incidencias.php";

    if (empty($_SESSION)){
        header("Location:../../../src/view/login.php");
        die();
    }

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
                echo '<option value="'.$DNI["DNI"].'-'.$DNI["nombre"].' '. $DNI["apellidos"] .'">'.$DNI["DNI"].'-'.$DNI["nombre"].' '. $DNI["apellidos"] .'</option>';
            }
        }

        if($_POST["mode"]=="DNI_busqueda_usuario"){
            $cliente=Usuario::recogerUsuarioDNI($_POST["DNI"], $connection);

            echo json_encode($cliente);
        }

        if($_POST["mode"]=="busqueda_DNI_incidencias"){
            $lista_incidencias=Incidencias::recogerIncidenciasDNI($_POST["DNI"], $connection);

            foreach($lista_incidencias as $incidencia){
                $cliente=Usuario::recogerDatosEmpleado($incidencia->getIdCliente(), $connection);
                echo '<tr>
                        <td>01-'. $incidencia->getNIncidencia() .'</td>
                        <td>'. $incidencia->getMotivo() .'</td>
                        <td>'. $cliente["DNI"] .'</td>
                        <td>'. $cliente["telefono"] .'</td>
                        <td>'. $incidencia->getEstado() .'</td>
                        <td>
                            <a href="#" class="btn btn-small btn-danger"><i class="fa-solid fa-envelope-open-text"></i></a>
                            <a href="#" class="btn btn-small btn-danger"><i class="fa-solid fa-envelope-open-text"></i></a>
                        </td>
                    <tr>';
            }
        }

        if($_POST["mode"]=="resolucion_Trabajando"){
            if(isset($_POST["motivo"])){
                $resultado=Incidencias::actualizarIncidencia((int)$_POST["estado"], $_POST["motivo"], $_POST["resolucion"], $_POST["observaciones"], (int)$_POST["nIncidencia"], $_POST["horaApertura"], $_POST["horaCierre"], (float)$_POST["totalTiempo"], $connection);

                if($resultado){
                    echo (float)$_POST["totalTiempo"];
                }else{
                    echo mysqli_error($connection);
                }
            }else{
                $resultado=Incidencias::actualizarIncidencia((int)$_POST["estado"], "", $_POST["resolucion"], $_POST["observaciones"], (int)$_POST["nIncidencia"], $_POST["horaApertura"], $_POST["horaCierre"], (float)$_POST["totalTiempo"], $connection);

                if($resultado){
                    echo "Todo correcto";
                }else{
                    echo mysqli_error($connection);
                }
            }
        }
    }
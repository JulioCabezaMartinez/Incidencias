<?php

    session_start();

    require "../model/BuscadorDB.php";
    require "../model/usuario.php";
    require "../model/incidencias.php";
    require "../model/reaperturas.php";

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
                $resultado=Incidencias::solucionarIncidencia((int)$_POST["estado"], $_POST["motivo"], $_POST["resolucion"], $_POST["observaciones"], (int)$_POST["nIncidencia"], $_POST["horaApertura"], $_POST["horaCierre"], (float)$_POST["totalTiempo"], $connection);
                // Incidencias::actualizarReabrirIncidencia((int)$_POST["nIncidencia"], $connection);
                if($resultado){
                    echo (float)$_POST["totalTiempo"];
                }else{
                    echo mysqli_error($connection);
                }
            }else{
                $resultado=Incidencias::solucionarIncidencia((int)$_POST["estado"], "", $_POST["resolucion"], $_POST["observaciones"], (int)$_POST["nIncidencia"], $_POST["horaApertura"], $_POST["horaCierre"], (float)$_POST["totalTiempo"], $connection);

                if($resultado){
                    echo "Todo correcto";
                }else{
                    echo mysqli_error($connection);
                }
            }
        }

        if($_POST["mode"]=="resolucion_reapertura"){
            if(isset($_POST["motivo"])){
                $resultado=Reapertura::solucionarReapertura((int)$_POST["estado"], $_POST["motivo"], $_POST["resolucion"], $_POST["observaciones"], (int)$_POST["nIncidencia"], $_POST["nReapertura"], $_POST["horaApertura"], $_POST["horaCierre"], (float)$_POST["totalTiempo"], $connection);
                // Incidencias::actualizarReabrirIncidencia((int)$_POST["nIncidencia"], $connection);
                if($resultado){
                    echo (float)$_POST["totalTiempo"];
                }else{
                    echo mysqli_error($connection);
                }
            }else{
                $resultado=Reapertura::solucionarReapertura((int)$_POST["estado"], "", $_POST["resolucion"], $_POST["observaciones"], (int)$_POST["nIncidencia"], $_POST["nReapertura"], $_POST["horaApertura"], $_POST["horaCierre"], (float)$_POST["totalTiempo"], $connection);

                if($resultado){
                    echo "Todo correcto";
                }else{
                    echo mysqli_error($connection);
                }
            }
        }

        if($_POST["mode"]=="baja"){
            if($_POST["tipo"]==2){
                $usuario=Usuario::bajaCliente($_POST["id"], $connection);

            }elseif($_POST["tipo"]==1 || $_POST["tipo"]>2){

                $usuario=Usuario::bajaEmpleado($_POST["id"], $connection);

            }

            $resultado=Usuario::asignarMotivoBaja($_POST["id"], $_POST["motivo_baja"], $connection);

            if($resultado){
                echo var_dump($resultado); //Pribar que pasa si se pone aqui un header.
            }else{
                echo var_dump($resultado);
            }
        }

        if($_POST["mode"]=="readmision"){
            if($_POST["tipo"]==8){
                $usuario=Usuario::readmisionCliente($_POST["id"], $connection);

            }elseif($_POST["tipo"]==7){

                $usuario=Usuario::readmisionEmpleado($_POST["id"], $connection);

            }

            $resultado=Usuario::asignarMotivoReadmision($_POST["id"], $_POST["motivo_readmision"], $connection);

            if($resultado){
                echo var_dump($resultado); //Pribar que pasa si se pone aqui un header.
            }else{
                echo var_dump($resultado);
            }
        }

        if($_POST["mode"]=="asignar_empleado"){
            if(Incidencias::asignarEmpleado($_POST['id_empleado'], $_POST['nIncidencia'], $connection)){
                echo true;
            }else{
                echo false;
            }
        }

        if($_POST["mode"]=="upload_documento"){

            $extension=strtolower(pathinfo($_FILES['documento']['name'], PATHINFO_EXTENSION));
            $extensionesPermitidas = ['pdf'];

            if($_FILES['documento']['size']>(5*1024*1204)){ //Que el tamaño no sea mayor de 5 mb

                echo "Documento demasiado pesada";

            }elseif(!in_array($extension, $extensionesPermitidas)){

                echo "El archivo tiene un tipo no permitido";

            }else{

                $filename=$_FILES['documento']['name'];
                $tempName=$_FILES['documento']['tmp_name'];
                if(isset($filename)){
                    if(!empty('$filename')){
                        $location='../../assets/PDF/partes_fisicos/'. $filename;
                        move_uploaded_file($tempName, $location);
                    }
                }
            }

            $resultado=Incidencias::guardarDocumento($_FILES['documento']['name'], $_POST['nIncidencia'], $connection);

            if($resultado){
                echo 'Subida correcta';
            }else{
                echo mysqli_error($connection);
            }
        }

        if($_POST["mode"]=="reabrir_incidencia"){
            $reapertura=Reapertura::creaReapertura($_POST['nIncidencia'], $connection);
            echo var_dump($reapertura);
        }
    }
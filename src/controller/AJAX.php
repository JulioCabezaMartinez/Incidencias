<?php

    session_start();

    require "../model/BuscadorDB.php";
    require "../model/usuario.php";
    require "../model/incidencias.php";
    require "../model/reaperturas.php";

    // if (empty($_SESSION)){
    //     header("Location:../../../src/view/login.php");
    //     die();
    // }

    if(isset($_POST["mode"])){
        if($_POST["mode"]=="registro"){
            if(!empty($_POST["nombre_empresa"])){
                $resultado=Usuario::registrarUsuario(tipo_registro: (int)$_POST["tipo_registro"], correo: $_POST["correo"], tipo: $_POST["tipo"], pass: $_POST["pass"], confirmPass: $_POST["confirm"],
                nombre: $_POST["nombre"], apellidos: $_POST["apellidos"], DNI: $_POST["DNI"], telefono: $_POST["telefono"], direccion: $_POST["direccion"], pais: $_POST["pais"], ciudad: $_POST["ciudad"], connection: $connection, nombre_empresa:$_POST["nombre_empresa"]);

                

                if(is_string($resultado)){
                    echo $resultado;
                }else{
                    echo "Todo correcto";
                }
            }else{
                    $resultado=Usuario::registrarUsuario(tipo_registro: (int)$_POST["tipo_registro"], correo: $_POST["correo"], tipo: $_POST["tipo"], pass: $_POST["pass"], confirmPass: $_POST["confirm"],
                    nombre: $_POST["nombre"], apellidos: $_POST["apellidos"], DNI: $_POST["DNI"], telefono: $_POST["telefono"], direccion: $_POST["direccion"], pais: $_POST["pais"], ciudad: $_POST["ciudad"], connection: $connection);

                    

                    if(is_string($resultado)){
                        echo $resultado;
                    }else{
                        echo "Todo correcto";
                    }
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
                $usuario=Usuario::recogerUsuarioId($incidencia->getIdCliente(), $connection);
                $estado=match($incidencia->getEstado()){
                    1=>"Trabajando en ello",
                    2=>"Pausa",
                    3=>"En Seguimiento",
                    4=>"Finalizado",
                    5=>"Sin trabajador Asignado"
                };
                echo '<tr>';
                if($incidencia->getReabierto()){
                    echo '<td><button id="main_row_'.$incidencia->getNIncidencia().'" class="btn btn-outline-secondary main-row"><i class="fa-solid fa-arrow-down-wide-short"></i></button></td>';
                }else{
                    echo '<td></td>';
                }
                
                echo '<td>01-'.$incidencia->getNIncidencia().'</td>
                    <td>'.$incidencia->getMotivo() .'</td>
                    <td>'.$usuario["DNI"] .'</td>
                    <td>'.$usuario["nombre"]. " " .$usuario["apellidos"].'</td>
                    <td>'.$estado .'</td>
                    <td>';
                if(is_null($incidencia->getIdEmpleado()) && $_SESSION["tipo"]!=2){
                    echo '<form action="../../src/controller/actions_tabla.php?class=add_empleado" method="post">
                                <input type="hidden" name="nIncidencia" value="'.$incidencia->getNIncidencia().'">
                                <button type="submit" name="nIncidencia_submit" class="btn btn-small btn-success"><i class="fa-solid fa-user-plus"></i></button>Quedarse con la Incidencia
                            </form>';
                }
                if($incidencia->getIdEmpleado()==$_SESSION["id"]){
                    if($incidencia->getReabierto()){
                        if(Reapertura::compruebaEstadoUltimaReapertura($incidencia->getNIncidencia(), $connection)){
                            echo '<button id="btn_reabrir-'.$incidencia->getNIncidencia().'" class="btn btn-small btn-warning my-1 btn_reabrir"><i class="fa-solid fa-envelope-open-text me-2"></i>Reabrir Incidencia</button><br>';
                        }
                    }else{
                        echo '<a href="../../src/controller/actions_tabla.php?class=sol&back=all&nIncidencia='.$incidencia->getNIncidencia().'" class="btn btn-small btn-primary my-1"><i class="fa-solid fa-briefcase me-2"></i>Trabajar en Incidencia</a><br>';
                    }
                }
                echo '<a href="../../src/controller/genera_PDF.php?nIncidencia='.$incidencia->getNIncidencia().'" class="btn btn-small btn-primary my-1"><i class="fa-solid fa-file-arrow-down me-2"></i>Descargar Incidencia</a><br>';
                
                if ($_SESSION["tipo"] == 1){
                    echo '<a href="../../src/controller/actions_incidencia.php?action=mod&nIncidencia='.$incidencia->getNIncidencia().'" class="btn btn-small btn-primary my-1"><i class="fa-solid fa-file-pen me-2"></i>Modificar Incidencia</a>';
                }
                echo '</td>
                    </tr>';
                
                echo ' <tr class="subelement_'.$incidencia->getNIncidencia().'" style="display:none;">
                        <th></th>
                        <th class="bg-dark text-light">N. Reapertura</th>
                        <th class="bg-dark text-light">Estado</th>
                        <th class="bg-dark text-light">Acciones</th>
                    </tr>';

                $lista_reaperturas = Reapertura::recogerReaperturas($incidencia->getNIncidencia(), $connection);
                foreach ($lista_reaperturas as $reapertura){
                    $estado_reapertura = match ($reapertura->getEstado()) {
                        1 => "Trabajando en ello",
                        2 => "Pausa",
                        3 => "En Seguimiento",
                        4 => "Finalizado"
                    };

                    echo '<tr class="subelement_'.$incidencia->getNIncidencia().'" style="display:none;">
                        <td></td>
                        <td class="filas_reapertura" style="width: 150px">R-'.$reapertura->getNreapertura().'</td>
                        <td class="filas_reapertura">'.$estado_reapertura.'</td>
                        <td class="filas_reapertura">
                            <a href="../../src/controller/actions_tabla.php?class=solR&back=all&nIncidencia='.$incidencia->getNIncidencia().'&nReapertura='.$reapertura->getNreapertura().'" class="btn btn-small btn-primary my-1"><i class="fa-solid fa-briefcase"></i>Trabajar en Reapertura</a><br>
                        </td>
                    </tr>';
                }      
            }
        }

        if($_POST["mode"]=="resolucion_Trabajando"){
            if(isset($_POST["motivo"])){

                if((int)$_POST["estado"]==4){
                    $resultado=Incidencias::solucionarIncidencia((int)$_POST["estado"], $_POST["motivo"], $_POST["resolucion"], $_POST["observaciones"], (int)$_POST["nIncidencia"], $_POST["horaApertura"], $_POST["horaCierre"], (float)$_POST["totalTiempo"], $connection, $_POST["firma"]);
                }else{
                    $resultado=Incidencias::solucionarIncidencia((int)$_POST["estado"], $_POST["motivo"], $_POST["resolucion"], $_POST["observaciones"], (int)$_POST["nIncidencia"], $_POST["horaApertura"], $_POST["horaCierre"], (float)$_POST["totalTiempo"], $connection);
                }
                //Incidencias::actualizarReabrirIncidencia((int)$_POST["nIncidencia"], $connection);
                if($resultado){
                    echo "Todo correcto";
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
                if((int)$_POST["estado"]==4){
                    $resultado=Reapertura::solucionarReapertura((int)$_POST["estado"], $_POST["motivo"], $_POST["resolucion"], $_POST["observaciones"], (int)$_POST["nIncidencia"], $_POST["nReapertura"], $_POST["horaApertura"], $_POST["horaCierre"], (float)$_POST["totalTiempo"], $connection, $_POST["firma"]);
                }else{
                    $resultado=Reapertura::solucionarReapertura((int)$_POST["estado"], $_POST["motivo"], $_POST["resolucion"], $_POST["observaciones"], (int)$_POST["nIncidencia"], $_POST["nReapertura"], $_POST["horaApertura"], $_POST["horaCierre"], (float)$_POST["totalTiempo"], $connection);
                }
                
                //Incidencias::actualizarReabrirIncidencia((int)$_POST["nIncidencia"], $connection);
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

        if($_POST["mode"]=="recuperar_pass"){
            if(!Usuario::compruebaCorreo($_POST["correo"], $connection)){
                $codigo=uniqid();

                $resultado=$connection->query("Insert into recuperacion_pass values('".$_POST["correo"]."', '".$codigo."', '".date('d/m/Y H:i')."') ON DUPLICATE KEY UPDATE codigo = '".$codigo."';");
    
                $para = $_POST["correo"];
                $asunto = "Cambio Contraseña";
                $mensaje = "NO RESPONDER ESTE CORREO.\n
                Su codigo de recuperacion es el siguiente: \n
                ".$codigo." \n
                Si no se encuentra registrado en dondigital.app ignore este mensaje.";
                $cabeceras = "From: passwordreset@dondigital.app";
    
                if(mail($para, $asunto, $mensaje, $cabeceras)){
                    echo "Todo correcto";
                }else{
                    echo "Algo fallo";
                }
            }else{
                echo "Correo no valido";
            }
            
        }

        if($_POST["mode"]=="comprobar_codigo_cambio_pass"){

            $resultado=$connection->query("Select codigo from recuperacion_pass where correo='".$_POST['correo']."';");

            $linea=$resultado->fetch_object();

            if($linea!=null){
                if($linea->codigo == $_POST['codigo_usuario']){
                    echo "Código correcto";
                }else{
                    echo "Código no valido";
                }
            }
        }

        if($_POST['mode']=="reset_pass"){
            
            $prueba=Usuario::resetPass($_POST['correo'], $_POST['pass'], $_POST['confirm'], $connection);
            if($prueba){
                echo "Todo correcto";
            }else{
                echo "Error en el cambio";
            }
            
        }

        if($_POST['mode']=="firmar_cliente"){
            $resultado=Usuario::firmarCliente($_POST["id_cliente"], $_POST["firma"], $connection);
            if($resultado){
                echo "Todo correcto";
            }else{
                echo "Error en la firma";
            }
        }
    }
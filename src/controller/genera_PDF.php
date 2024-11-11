<?php


require "../model/usuario.php";
require "../model/BuscadorDB.php";
require "../model/incidencias.php";
require '../model/reaperturas.php';

require "../library/fpdf/fpdf.php";
require "../library/fpdi/src/autoload.php";

use setasign\Fpdi\Fpdi;

$incidencia=Incidencias::recogerIncidencia($connection, (int)$_GET["nIncidencia"]);
$usuario_Empleado=Usuario::recogerUsuarioID($incidencia->getIdEmpleado(), $connection);
$usuario_Cliente=Usuario::recogerUsuarioID($incidencia->getIdCliente(), $connection);

$pdf= new FPDI();

$pdf->AddPage();
$pdf->setSourceFile("../../assets/PDF/Parte_trabajo.pdf");
$templateIDx= $pdf->importPage(1);
$pdf->useTemplate($templateIDx);

//Número Incidencia
$pdf->SetFont('Arial', 'b', 8);
$pdf->SetXY(178, 22.9);
// $pdf->Cell(16.5, 10, "N-1"); Ejemplo
$anio=substr($incidencia->getYear(), 2);
$numero=$incidencia->getNumeroYear($incidencia->getYear(), $incidencia->getNIncidencia(), $connection);
$pdf->Cell(16.5, 10, "PTDD". $anio ."-".$numero);


//Nombre Apellidos Cliente
$pdf->SetFont('Arial', '', 12);
$pdf->SetXY(80, 24);
// $pdf->Cell(79, 6, "Hola"." Apellido 1 Apellido-Compuesto 2"); Ejemplo
$pdf->Cell(79, 6, $usuario_Cliente['nombre']." ". $usuario_Cliente['apellidos']);



//Motivo
$pdf->SetFont('Arial', '', 12);
$pdf->SetXY(17, 52);
// $pdf->MultiCell(176.2, 6, "Soy una solucion muy completa llena de datos en los que se detalla que el problema no era yo sino que era el servidor web que no funcionaba"); Ejemplo
$pdf->MultiCell(176.2, 6, $incidencia->getMotivo());

//Solución
$pdf->SetFont('Arial', '', 10);
$pdf->SetXY(17, 122);
// $pdf->MultiCell(176.2, 6, "Soy una solucion muy completa llena de datos en los que se detalla que el problema no era yo sino que era el servidor web que no funcionaba"); Ejemplo
$pdf->MultiCell(176.2, 6, utf8_decode($incidencia->getSolucion()));

switch($incidencia->getEstado()){
    case 3:
        //Situacion: En Seguimiento
        $pdf->SetFont('Arial', '', 10);
        $pdf->SetXY(97.5, 195.5);
        $pdf->Cell(16.5, 10, "X");
    break;
    case 2:
        //Situacion: Pendiente
        $pdf->SetFont('Arial', '', 10);
        $pdf->SetXY(67.9, 195.5);
        $pdf->Cell(16.5, 10, "X");
    break;
    case 4:
        //Situacion: Terminado
        $pdf->SetFont('Arial', '', 10);
        $pdf->SetXY(37.2, 195.5);
        $pdf->Cell(16.5, 10, "X");
    break;
    case 6:
        //Situacion: Terminado
        $pdf->SetFont('Arial', '', 10);
        $pdf->SetXY(37.2, 195.5);
        $pdf->Cell(16.5, 10, "X");
    break;
}

//Fecha
$fecha=substr($incidencia->getHoraApertura() ,0, 10);
$pdf->SetFont('Arial', '', 12);
$pdf->SetXY(17, 214.7);
$pdf->Cell(10, 6, $fecha);

//Hora Entrada
$horaEntrada=substr($incidencia->getHoraApertura() ,11);
$pdf->SetFont('Arial', '', 12);
$pdf->SetXY(48, 214.7);
$pdf->Cell(10, 6, $horaEntrada);

//Hora Salida
$horaCierre=substr($incidencia->getHoraCierre() ,11);
$pdf->SetFont('Arial', '', 12);
$pdf->SetXY(76, 214.7);
$pdf->Cell(10, 6, $horaCierre);

//Modo Resolución: Remota
$pdf->SetFont('Arial', '', 10);
$pdf->SetXY(103.7, 214.9);
$pdf->Cell(10, 6, "X");

// //Modo Resolución: Presencial
// $pdf->SetFont('Arial', '', 10);
// $pdf->SetXY(124.7, 214.9);
// $pdf->Cell(10, 6, "X");

// //Modo Resolución: Telefónica
// $pdf->SetFont('Arial', '', 10);
// $pdf->SetXY(151, 214.9);
// $pdf->Cell(10, 6, "X");

//Total Tiempo

$pdf->SetFont('Arial', '', 10);
$pdf->SetXY(176, 214.9);
$pdf->Cell(10, 6, $incidencia->getTotalTiempo()." min");

//Observaciones
$pdf->SetFont('Arial', '', 12);
$pdf->SetXY(17.5, 255.7);
// $pdf->MultiCell(75, 6, "Holaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa"); Ejemplo
$pdf->MultiCell(75, 6, $incidencia->getObservaciones());

if(!is_bool($usuario_Empleado)){
    //Firma Técnico
    $pdf->SetFont('Arial', '', 12);
    // $pdf->MultiCell(48, 5, "Holaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa"); Ejemplo
    //$pdf->MultiCell(48, 5, $usuario_Empleado["nombre"]. " " .$usuario_Empleado["apellidos"]. " " .$usuario_Empleado["DNI"]. " " .$usuario_Empleado["telefono"]);
    if($usuario_Empleado["firma"]!=null){
        //Firma
        $dataURI    = $usuario_Empleado["firma"];
        $dataPieces = explode(',',$dataURI);
        $encodedImg = $dataPieces[1];
        $decodedImg = base64_decode($encodedImg);

        //  Check if image was properly decoded
        if( $decodedImg!==false ){
            //  Save image to a temporary location
            if( file_put_contents("firma_empleado.png",$decodedImg)!==false){
                $pdf->Image("firma_empleado.png", 96, 255.7, 40, 25);

                unlink("firma_empleado.png");
            }
        }
    }
    
}

//Firma Cliente
$pdf->SetFont('Arial', '', 12);
$pdf->SetXY(144.5, 255.7);
// $pdf->MultiCell(48, 5, "Holaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa"); Ejemplo
if($usuario_Cliente['firma']!=null){
    //Firma
    $dataURI_cliente    = $usuario_Cliente["firma"];
    $dataPieces_cliente = explode(',',$dataURI_cliente);
    $encodedImg_cliente = $dataPieces_cliente[1];
    $decodedImg_cliente = base64_decode($encodedImg_cliente);

    //  Check if image was properly decoded
    if( $decodedImg_cliente!==false ){
        //  Save image to a temporary location
        if( file_put_contents("firma_cliente.png",$decodedImg_cliente)!==false){
            $pdf->Image("firma_cliente.png", 146.5, 255.7, 40, 25);

            unlink("firma_cliente.png");
        }
    }
}



if($incidencia->getReabierto()){
    $lista_reapertura=Reapertura::recogerReaperturas($incidencia->getNIncidencia(), $connection);

    foreach($lista_reapertura as $reapertura){
        $pdf->AddPage();
        $pdf->useTemplate($templateIDx);

        //Número Incidencia
        $pdf->SetFont('Arial', '', 12);
        $pdf->SetXY(178, 22.9);
        // $pdf->Cell(16.5, 10, "N-1"); Ejemplo
        $pdf->Cell(16.5, 10, "R-". $reapertura->getNreapertura()."-N-". $incidencia->getNIncidencia());


        //Nombre Apellidos Cliente
        $pdf->SetFont('Arial', '', 12);
        $pdf->SetXY(80, 24);
        // $pdf->Cell(79, 6, "Hola"." Apellido 1 Apellido-Compuesto 2"); Ejemplo
        $pdf->Cell(79, 6, $usuario_Cliente['nombre']." ". $usuario_Cliente['apellidos']);



        //Motivo
        $pdf->SetFont('Arial', '', 12);
        $pdf->SetXY(17, 52);
        // $pdf->MultiCell(176.2, 6, "Soy una solucion muy completa llena de datos en los que se detalla que el problema no era yo sino que era el servidor web que no funcionaba"); Ejemplo
        $pdf->MultiCell(176.2, 6, $incidencia->getMotivo());

        //Solución
        $pdf->SetFont('Arial', '', 12);
        $pdf->SetXY(17, 122);
        // $pdf->MultiCell(176.2, 6, "Soy una solucion muy completa llena de datos en los que se detalla que el problema no era yo sino que era el servidor web que no funcionaba"); Ejemplo
        $pdf->MultiCell(176.2, 6, $reapertura->getSolucion());

        switch($reapertura->getEstado()){
            case 3:
                //Situacion: En Seguimiento
                $pdf->SetFont('Arial', '', 10);
                $pdf->SetXY(97.5, 195.5);
                $pdf->Cell(16.5, 10, "X");
            break;
            case 2:
                //Situacion: Pendiente
                $pdf->SetFont('Arial', '', 10);
                $pdf->SetXY(67.9, 195.5);
                $pdf->Cell(16.5, 10, "X");
            break;
            case 4:
                //Situacion: Terminado
                $pdf->SetFont('Arial', '', 10);
                $pdf->SetXY(37.2, 195.5);
                $pdf->Cell(16.5, 10, "X");
            break;
            case 6:
                //Situacion: Terminado
                $pdf->SetFont('Arial', '', 10);
                $pdf->SetXY(37.2, 195.5);
                $pdf->Cell(16.5, 10, "X");
            break;
        }

        //Fecha
        $fecha=substr($reapertura->getHoraApertura() ,0, 10);
        $pdf->SetFont('Arial', '', 12);
        $pdf->SetXY(17, 214.7);
        $pdf->Cell(10, 6, $fecha);

        //Hora Entrada
        $horaEntrada=substr($reapertura->getHoraApertura() ,11);
        $pdf->SetFont('Arial', '', 12);
        $pdf->SetXY(48, 214.7);
        $pdf->Cell(10, 6, $horaEntrada);

        //Hora Salida
        $horaCierre=substr($reapertura->getHoraCierre() ,11);
        $pdf->SetFont('Arial', '', 12);
        $pdf->SetXY(76, 214.7);
        $pdf->Cell(10, 6, $horaCierre);

        //Modo Resolución: Remota
        $pdf->SetFont('Arial', '', 10);
        $pdf->SetXY(103.7, 214.9);
        $pdf->Cell(10, 6, "X");

        // //Modo Resolución: Presencial
        // $pdf->SetFont('Arial', '', 10);
        // $pdf->SetXY(124.7, 214.9);
        // $pdf->Cell(10, 6, "X");

        // //Modo Resolución: Telefónica
        // $pdf->SetFont('Arial', '', 10);
        // $pdf->SetXY(151, 214.9);
        // $pdf->Cell(10, 6, "X");

        //Total Tiempo

        $pdf->SetFont('Arial', '', 10);
        $pdf->SetXY(176, 214.9);
        $pdf->Cell(10, 6, $reapertura->getTotalTiempo()." min");

        //Observaciones
        $pdf->SetFont('Arial', '', 12);
        $pdf->SetXY(17.5, 255.7);
        // $pdf->MultiCell(75, 6, "Holaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa"); Ejemplo
        $pdf->MultiCell(75, 6, $reapertura->getObservaciones());

        if(!is_bool($usuario_Empleado)){
            //Firma Técnico
        $pdf->SetFont('Arial', '', 12);
        $pdf->SetXY(94, 255.7);
        // $pdf->MultiCell(48, 5, "Holaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa"); Ejemplo
        $pdf->MultiCell(48, 5, $usuario_Empleado["nombre"]. " " .$usuario_Empleado["apellidos"]. " " .$usuario_Empleado["DNI"]. " " .$usuario_Empleado["telefono"]);
        }

        // //Firma Cliente
        $pdf->SetFont('Arial', '', 12);
        $pdf->SetXY(144.5, 255.7);
        // $pdf->MultiCell(48, 5, "Holaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa"); Ejemplo
        $pdf->MultiCell(48, 5, $usuario_Cliente["nombre"]. "" .$usuario_Cliente["apellidos"]. " " .$usuario_Cliente["DNI"]. " " .$usuario_Cliente["telefono"]);

        }
}

// $pdf->Output('D', "hola.pdf");
$pdf->Output('D', $incidencia->getNIncidencia()."(Prueba).pdf");
<?php

class Incidencias{
    private int|null $nIncidencia=null;
    private String $motivo;
    private String|null $solucion=null;
    private int $estado=5; 
    private String|null $motivo_estado=null;
    private String $idCreador;
    private String $idCliente;
    private String|null $idEmpleado=null;
    private String $contacto;
    private String|null $observaciones=null;
    private bool $reabierto=false;
    private String|null $hora_apertura=null;
    private String|null $hora_cierre=null;
    private int|null $totalTiempo=null;

    public function __construct(String $motivo, String $idCreador, String $idCliente, String $contacto, String|null $observaciones=null, int $nIncidencia=null, String|null $solucion=null, int|null $estado=null, String|null $motivo_estado=null, String|null $idEmpleado=null, bool|null $reabierto=null, String|null $hora_apertura=null, String|null $hora_cierre=null, int|null $totalTiempo=null){
        $this->motivo=$motivo;

        $this->solucion=$solucion;

        $this->idCreador=$idCreador;

        $this->idCliente=$idCliente;

        $this->contacto=$contacto;

        $this->observaciones=$observaciones;

        if(!is_null($nIncidencia)){
            $this->nIncidencia=$nIncidencia;
        }

        if(!is_null($solucion)){
            $this->solucion=$solucion;
        }

        if(!is_null($estado)){
            $this->estado=$estado;
        }

        if(!is_null($motivo_estado)){
            $this->motivo_estado=$motivo_estado;
        }

        if(!is_null($idEmpleado)){
            $this->idEmpleado=$idEmpleado;
        }

        if(!is_null($reabierto)){
            $this->reabierto=$reabierto;
        }

        if(!is_null($hora_apertura)){
            $this->hora_apertura=$hora_apertura;
        }

        if(!is_null($hora_cierre)){
            $this->hora_cierre=$hora_cierre;
        }

        if(!is_null($totalTiempo)){
            $this->totalTiempo=$totalTiempo;
        }
    }

    //Getters

    public function getNIncidencia(): int|null{
        return $this->nIncidencia;
    }

    public function getMotivo(): String{
        return $this->motivo;
    }
    public function getSolucion(): String|null{
        return $this->solucion;
    }
    public function getEstado(): int{
        return $this->estado;
    }
    public function getMotivoEstado(): String{
        return $this->motivo_estado;
    }
    public function getIdCreador(): String{
        return $this->idCreador;
    }

    public function getIdCliente(): string {
        return $this->idCliente;
    }

    public function getIdEmpleado(): String|null{
        return $this->idEmpleado;
    }

    public function getContacto(): string {
        return $this->contacto;
    }

    public function getObservaciones(): String|null{
        return $this->observaciones;
    }

    public function getReabierto(): bool{
        return $this->reabierto;
    }

    public function getHoraApertura(): string|null {
        return $this->hora_apertura;
    }

    public function getHoraCierre(): string|null {
        return $this->hora_cierre;
    }

    public function getTotalTiempo(): int|null{
        return $this->totalTiempo;
    }

    //Setters

    public function setNIncidencia(int|null $nIncidencia): void{
         $this->nIncidencia=$nIncidencia;
    }

    public function setMotivo(String $motivo){
        $this->motivo=$motivo;
    }

    public function setSolucion(String|null $solucion) {
        $this->solucion=$solucion;
    }

    public function setEstado(int $estado){
        $this->estado=$estado;
    }

    public function setMotivoEstado(String $motivo_estado){
        $this->motivo_estado=$motivo_estado;
    }

    public function setIdCreador(String $idCreador) {
        $this->idCreador=$idCreador;
    }

    public function setIdCliente($idCliente) {
        $this->idCliente = $idCliente;
    }

    public function setIdEmpleado(String|null $idEmpleado) {
        $this->idCreador=$idEmpleado;
    }

    public function setContacto($contacto) {
        $this->contacto = $contacto;
    }

    public function setObservaciones(String|null $observaciones){
        $this->observaciones=$observaciones;
    }

    public function setReabierto(bool $reabierto){
        $this->reabierto=$reabierto;
    }

    public function setHoraApertura(string|null $hora_apertura): void {
        $this->hora_apertura = $hora_apertura;
    }

    public function setHoraCierre(string|null $hora_cierre): void {
        $this->hora_cierre = $hora_cierre;
    }

    public function setTotalTiempo(int $totalTiempo){
        $this->totalTiempo= $totalTiempo;
    } 

    //Funciones de Clase.

    public static function recogerTodasIncidencias(mysqli $connection){
        $incidencias=[];
        $result=$connection->query("Select * from incidencias");

        if($result!=false){
            $linea=$result->fetch_object();

            while($linea!=null){
                $incidencia=new Incidencias(motivo: $linea->motivo, idCreador: $linea->id_creador, idCliente: $linea->id_cliente, contacto: $linea->persona_contacto, observaciones: $linea->observaciones, nIncidencia: $linea->numero_incidencia, solucion: $linea->solucion, estado: $linea->estado, motivo_estado: $linea->motivo_estado, idEmpleado: $linea->id_empleado, reabierto: $linea->reabierto, hora_apertura: $linea->hora_apertura, hora_cierre: $linea->hora_cierre, totalTiempo: $linea->totalTiempo);
                array_push($incidencias, $incidencia);

                $linea=$result->fetch_object();
            }
        }else{ //Linea escrita para Debug.
            $error="Error de conexion a la BD";
            return $error;
        }

        return $incidencias;
    }

    public static function recogerTodasIncidenciasUsuario(mysqli $connection, String $id_User){
        $incidencias=[];
        $result=$connection->query("Select * from incidencias where id_creador='". $id_User ."'");

        if($result!=false){
            $linea=$result->fetch_object();

            while($linea!=null){
                $incidencia=new Incidencias(motivo: $linea->motivo, idCreador: $linea->id_creador, idCliente: $linea->id_cliente, contacto: $linea->persona_contacto, observaciones: $linea->observaciones, nIncidencia: $linea->numero_incidencia, solucion: $linea->solucion, estado: $linea->estado, motivo_estado: $linea->motivo_estado, idEmpleado: $linea->id_empleado, reabierto: $linea->reabierto, hora_apertura: $linea->hora_apertura, hora_cierre: $linea->hora_cierre, totalTiempo: $linea->totalTiempo);
                array_push($incidencias, $incidencia);

                $linea=$result->fetch_object();
            }
        }else{ //Linea escrita para Debug.
            $error="Error de conexion a la BD";
            return $error;
        }

        return $incidencias;
    }

    public static function recogerTodasIncidenciasAsignadas(mysqli $connection){
        $incidencias=[];
        $result=$connection->query("Select * from incidencias where estado=1");

        if($result!=false){
            $linea=$result->fetch_object();

            while($linea!=null){
                $incidencia=new Incidencias(motivo: $linea->motivo, idCreador: $linea->id_creador, idCliente: $linea->id_cliente, contacto: $linea->persona_contacto, observaciones: $linea->observaciones, nIncidencia: $linea->numero_incidencia, solucion: $linea->solucion, estado: $linea->estado, motivo_estado: $linea->motivo_estado,idEmpleado: $linea->id_empleado, reabierto: $linea->reabierto, hora_apertura: $linea->hora_apertura, hora_cierre: $linea->hora_cierre, totalTiempo: $linea->totalTiempo);
                array_push($incidencias, $incidencia);

                $linea=$result->fetch_object();
            }
        }else{ //Linea escrita para Debug.
            $error="Error de conexion a la BD";
            return $error;
        }

        return $incidencias;
    }


    public static function recogerTodasIncidenciasAsignadasUsuario(mysqli $connection, String $id_User){
        $incidencias=[];
        $result=$connection->query("Select * from incidencias where id_empleado='". $id_User ."' and estado<4");

        if($result!=false){
            $linea=$result->fetch_object();

            while($linea!=null){
                $incidencia=new Incidencias(motivo: $linea->motivo, idCreador: $linea->id_creador, idCliente: $linea->id_cliente, contacto: $linea->persona_contacto, observaciones: $linea->observaciones, nIncidencia: $linea->numero_incidencia, solucion: $linea->solucion, estado: $linea->estado, motivo_estado: $linea->motivo_estado,idEmpleado: $linea->id_empleado, reabierto: $linea->reabierto, hora_apertura: $linea->hora_apertura, hora_cierre: $linea->hora_cierre, totalTiempo: $linea->totalTiempo);
                array_push($incidencias, $incidencia);

                $linea=$result->fetch_object();
            }
        }else{ //Linea escrita para Debug.
            $error="Error de conexion a la BD";
            return $error;
        }

        return $incidencias;
    }

    public static function recogerIncidencia(mysqli $connection, int $numero_incidencia){
        $result=$connection->query("Select * from incidencias where numero_incidencia= '".$numero_incidencia."'");

        if($result!=false){
            $linea=$result->fetch_object();

            while($linea!=null){
                $incidencia=new Incidencias(motivo: $linea->motivo, idCreador: $linea->id_creador, idCliente: $linea->id_cliente, contacto: $linea->persona_contacto, observaciones: $linea->observaciones, nIncidencia: $linea->numero_incidencia, solucion: $linea->solucion, estado: $linea->estado, motivo_estado: $linea->motivo_estado,idEmpleado: $linea->id_empleado, reabierto: $linea->reabierto, hora_apertura: $linea->hora_apertura, hora_cierre: $linea->hora_cierre, totalTiempo: $linea->totalTiempo);
                
                return $incidencia;
            }
        }else{
            $error="Error de conexion a la BD";
            return $error;
        }
    }

    public static function recogerIncidenciasDNI(String $DNI, mysqli $connection){
        $lista_incidencias=[];
        $usuarios=Usuario::busquedaDNI($DNI, $connection);
        
        foreach($usuarios as $usuario){

            $id_cliente=$usuario["id"];

            $result=$connection->query("Select * from incidencias where id_cliente= '".$id_cliente."';");
    
            $linea=$result->fetch_object();
            
            while($linea!=null){
                $incidencia=new Incidencias(motivo: $linea->motivo, idCreador: $linea->id_creador, idCliente: $linea->id_cliente, contacto: $linea->persona_contacto, observaciones: $linea->observaciones, nIncidencia: $linea->numero_incidencia, solucion: $linea->solucion, estado: $linea->estado, motivo_estado: $linea->motivo_estado,idEmpleado: $linea->id_empleado, reabierto: $linea->reabierto, hora_apertura: $linea->hora_apertura, hora_cierre: $linea->hora_cierre, totalTiempo: $linea->totalTiempo);
                
                array_push($lista_incidencias, $incidencia);
                $linea=$result->fetch_object();
            }
        }

        return $lista_incidencias;
       
    }

    public static function creacionIncidencia($motivo, $id_creador, $id_cliente, $contacto, mysqli $connection){
        $incidencia=new Incidencias($motivo, $id_creador, $id_cliente, $contacto);
        
        $result=$connection->query("INSERT INTO incidencias (motivo, estado, id_creador, id_cliente, persona_contacto) VALUES ('". $incidencia->getMotivo() ."', ". $incidencia->getEstado() ." ,'". $incidencia->getIdCreador() ."', '".$incidencia->getIdCliente()."', '".$incidencia->getContacto()."');");

        if($result!=false){
            return true;
        }else return mysqli_error($connection);
    }

    public static function asignarEmpleado($id_Empleado, $numero_incidencia, $connection){
        $result=$connection->query("UPDATE incidencias SET id_empleado = '". $id_Empleado ."', estado=1 WHERE (`numero_incidencia` = '". $numero_incidencia ."');");

        if($result!=false){
            return true;
        }else return false;
    }

    public static function eliminarEmpleado($id_Empleado, $numero_incidencia, $connection){
        $result=$connection->query("UPDATE incidencias SET id_empleado = '". $id_Empleado ."', estado=1 WHERE (`numero_incidencia` = '". $numero_incidencia ."');");

        if($result!=false){
            return true;
        }else return false;
    }

    public static function contarIncidenciasPendientes($id_empleado, mysqli $connection){
        $result=$connection->query("Select count(*) as total from incidencias where estado<4 and id_empleado='". $id_empleado ."';");

        $linea=$result->fetch_object();

        if($result!=false){
            
            return $linea->total;

        }else{
            return false;
        }
    }

    public static function solucionarIncidencia(int $estado, String $motivo_estado, String|null $resolucion, String|null $observaciones, int $nIncidencia, String $horaApertura, String $horaCierre, float $totalTiempo, mysqli $connection){
        $result=$connection->query("UPDATE incidencias SET solucion = '".$resolucion."', estado=".$estado.", motivo_estado = '".$motivo_estado."', observaciones = '".$observaciones."', hora_apertura='".$horaApertura."', hora_cierre='".$horaCierre."', totalTiempo='".$totalTiempo."' WHERE (`numero_incidencia` = '".$nIncidencia."');");

        if($result!=false){
            return true;
        }else return false;
    }

    public static function actualizarIncidencia(int $estado, String $motivo, String $motivo_estado, String|null $resolucion, String|null $observaciones, int $nIncidencia, String $horaApertura, String $horaCierre, float $totalTiempo, mysqli $connection){
        $result=$connection->query("UPDATE incidencias SET motivo='".$motivo."', solucion = '".$resolucion."', estado=".$estado.", motivo_estado = '".$motivo_estado."', observaciones = '".$observaciones."', hora_apertura='".$horaApertura."', hora_cierre='".$horaCierre."', totalTiempo='".$totalTiempo."' WHERE (`numero_incidencia` = '".$nIncidencia."');");

        if($result!=false){
            return true;
        }else return false;
    }
}

?>
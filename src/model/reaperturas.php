<?php
/**
 * Esta clase recoge los atributos de la tabla reaperturas de la Base de Datos.
 */
class Reapertura{
    /**
     * Número de reapertura que  identifica a la reapertura.
     * @var int
     */
    private int|null $nReapertura;
    /**
     * Número de Incidencia que identifica a la Incidencia Padre.
     * @var int
     */
    private int $incidencia_padre;
    /**
     * Solución que se ha proporcionado a la reapertura.
     * @var string|null
     */
    private String|null $solucion=null;
    /**
     * Tipo de estado en el que se puede encontrar una reapertura. Estos tipos son: 0. Reabierto 
     * 1. Trabajando en ello. 2. Finalizado Pendiente. (El trabajador pausa la reapertura) 3. En Seguimiento. (Esperando a que el cliente envie) 
     * 4. Finalizado. (Solo cuando este finalizado se puede reabrir) Por defecto este valor será 1 (Sin trabajador Asignado).
     * @var int
     */
    private int $estado=1; 
    /**
     * Justificación del estado de la reapertura. Este campo se rellena en caso de que la reapertura se tenga que postergar (Tipos 2 y 3).
     * @var string|null
     */
    private String|null $motivo_estado=null;
    /**
     * Aportaciones que el empleado puede indicar en caso de que esa reapertura o su resolución tenga algún tipo de comportamiento inusual.
     * @var string|null
     */
    private String|null $observaciones=null;
    /**
     * Indica la hora a la que se abrio la reapertura para empezar a ser solucionada.
     * @var string|null
     */
    private String|null $hora_apertura=null;
    /**
     * Summary of hora_cierre
     * @var string|null
     */
    private String|null $hora_cierre=null;
    /**
     * Indica la hora a la que se guardó el estado de la reapertura.
     * @var float|null
     */
    private float|null $totalTiempo=null;
    /**
     * Constructor de la reapertura. Los parametros que que tengan un valor por defecto deben de ser indicados obligatoriamente, el resto se le asiganará un valor por defecto al crearse la reapertura.
     * @param int $nReapertura
     * @param int $incidencia_padre
     * @param string|null $observaciones
     * @param int $nreapertura
     * @param string|null $solucion
     * @param int|null $estado
     * @param string|null $motivo_estado
     * @param string|null $hora_apertura
     * @param string|null $hora_cierre
     * @param int|null $totalTiempo
     */
    public function __construct(int $nReapertura, int $incidencia_padre, String|null $observaciones=null, String|null $solucion=null, int|null $estado=null, String|null $motivo_estado=null, String|null $hora_apertura=null, String|null $hora_cierre=null, float|null $totalTiempo=null){
        $this->nReapertura=$nReapertura;

        $this->incidencia_padre=$incidencia_padre;

        if(!is_null($observaciones)){
            $this->observaciones=$observaciones;
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
    /**
     * Getter de la variable nreapertura.
     * @return int|null
     */
    public function getNreapertura(): int{
        return $this->nReapertura;
    }
    /**
     * Getter de la variable incidencia_padre.
     * @return int|null
     */
    public function getIncidenciaPadre(): int{
        return $this->incidencia_padre;
    }
    /**
     * Getter de la variable solucion.
     * @return int|null
     */
    public function getSolucion(): String|null{
        return $this->solucion;
    }
    /**
     * Getter de la variable estado.
     * @return int|null
     */
    public function getEstado(): int{
        return $this->estado;
    }
    /**
     * Getter de la variable motivo_estado.
     * @return int|null
     */
    public function getMotivoEstado(): String{
        return $this->motivo_estado;
    }
    /**
     * Getter de la variable observaciones.
     * @return int|null
     */
    public function getObservaciones(): String|null{
        return $this->observaciones;
    }
    /**
     * Getter de la variable hora_apertura
     * @return int|null
     */
    public function getHoraApertura(): string|null {
        return $this->hora_apertura;
    }
    /**
     * Getter de la variable hora_cierre.
     * @return int|null
     */
    public function getHoraCierre(): string|null {
        return $this->hora_cierre;
    }
    /**
     * Getter de la variable totalTiempo.
     * @return int|null
     */
    public function getTotalTiempo(): int|null{
        return $this->totalTiempo;
    }

    //Setters
    /**
     * Setter de la variable nreapertura.
     * @param int|null $nreapertura
     * @return void
     */
    public function setNreapertura(int|null $nreapertura): void{
        $this->nReapertura=$nreapertura;
    }
    /**
     * Setter de la variable incidencia_padre.
     * @param int|null $incidencia_padre
     * @return void
     */
    public function setIncidenciaPadre(int $incidencia_padre){
        $this->incidencia_padre=$incidencia_padre;
    }
    /**
     * Setter de la variable solucion.
     * @param string|null $solucion
     * @return void
     */
    public function setSolucion(String|null $solucion) {
        $this->solucion=$solucion;
    }
    /**
     * Setter de la variable estado.
     * @param int $estado
     * @return void
     */
    public function setEstado(int $estado){
        $this->estado=$estado;
    }
    /**
     * Setter de la variable motivo_estado.
     * @param string $motivo_estado
     * @return void
     */
    public function setMotivoEstado(String $motivo_estado){
        $this->motivo_estado=$motivo_estado;
    }
    /**
     * Setter de la variable observaciones.
     * @param string|null $observaciones
     * @return void
     */
    public function setObservaciones(String|null $observaciones){
        $this->observaciones=$observaciones;
    }
    /**
     * Setter de la variable hora_apertura
     * @param string|null $hora_apertura
     * @return void
     */
    public function setHoraApertura(string|null $hora_apertura): void {
        $this->hora_apertura = $hora_apertura;
    }
    /**
     * Setter de la variable hora_cierre.
     * @param string|null $hora_cierre
     * @return void
     */
    public function setHoraCierre(string|null $hora_cierre): void {
        $this->hora_cierre = $hora_cierre;
    }
    /**
     * Setter de la variable totalTiempo.
     * @param int $totalTiempo
     * @return void
     */
    public function setTotalTiempo(int $totalTiempo){
        $this->totalTiempo= $totalTiempo;
    } 

    //Funciones de Clase.

    public static function cuentaReaperturas($nIncidencia, mysqli $connection){
        $result=$connection->query("Select count(*) as total from reapertura where nIncidencia_padre=".$nIncidencia.";");

        if(is_numeric($result)){
            if($result=0){
                return 1;
            }else{
                return (int)$result;
            }
        
        }else return mysqli_error($connection);
    }

    public static function creaReapertura($nIncidencia, mysqli $connection){
        $nReapertura=Reapertura::cuentaReaperturas($nIncidencia, $connection);

        $reapertura= new Reapertura($nReapertura, $nIncidencia);

        $resultado=$connection->query("Insert into reaperturas values(".$reapertura->getNreapertura().", ".$reapertura->getIncidenciaPadre().", '".$reapertura->getSolucion()."', ".$reapertura->getEstado().", '".$reapertura->getMotivoEstado()."', '".$reapertura->getObservaciones()."', '".$reapertura->getHoraApertura()."', '".$reapertura->getHoraCierre()."', ".$reapertura->getTotalTiempo().", '')");

        if($resultado!=false){
            return true;
        }else{
            return false;
        }
    }

    public static function recogerReaperturas($nIncidencia, mysqli $connection){
        $lista_reaperturas=[];

        $resultado=$connection->query("Select * from reaperturas where incidencia_padre=".$nIncidencia.";");

        if($resultado!=false){
            $linea=$resultado->fetch_object();

            while($linea!=null){
                $reapertura=new Reapertura($linea->nReapertura, $linea->incidencia_padre, $linea->observaciones, $linea->solucion, $linea->estado, $linea->motivo_estado, $linea->hora_apertura, $linea->hora_cierre, $linea->totalTiempo);
                array_push($lista_reaperturas, $reapertura);

                $linea=$resultado->fetch_object();
            }

            return $lista_reaperturas;
            
        }else{
            return mysqli_error($connection);
        }
    }

}
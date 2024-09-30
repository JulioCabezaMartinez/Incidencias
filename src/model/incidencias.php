<?php

class Incidencias{
    private int $nIncidencia; //Para el número de incidencia vamos a coger el número de incidencia de la ultima entrada que haya en la BD.
    private String $motivo;
    private String|null $solucion;
    private int $estado; //1 Trabajando en ello, 2 Pausa, 3 En Seguimiento, 4 Finalizado, 5 Sin trabajador Asignado.
    private String $idCreador;
    private String|null $idEmpleado;
    private String|null $observaciones;
    private bool $reabierto;

    public function __construct(String $motivo, String $idCreador, String|null $observaciones=null, int $nIncidencia=null, String|null $solucion=null, int|null $estado=null, String|null $idEmpleado=null, bool|null $reabierto=null){
        $this->motivo=$motivo;

        $this->solucion=$solucion;

        $this->idCreador=$idCreador;

        $this->observaciones=$observaciones;

        if(!is_null($nIncidencia)){
            $this->nIncidencia=$nIncidencia;
        }

        if(!is_null($solucion)){
            $this->solucion=$solucion;
        }

        if(!is_null($estado)){
            $this->estado=$estado;
        }else $this->estado=5;

        if(!is_null($idEmpleado)){
            $this->idEmpleado=$idEmpleado;
        }

        if(!is_null($reabierto)){
            $this->reabierto=$reabierto;
        }else $this->reabierto=false;

    }

    public function getNIncidencia(): int{
        return $this->nIncidencia;
    }

    public function getMotivo(): String{
        return $this->motivo;
    }
    public function getSolucion(): String{
        return $this->solucion;
    }
    public function getEstado(): int{
        return $this->estado;
    }
    public function getIdCreador(): String{
        return $this->idCreador;
    }

    public function getIdEmpleado(): String{
        return $this->idEmpleado;
    }

    public function getObservaciones(): String{
        return $this->observaciones;
    }

    public function getReabierto(): bool{
        return $this->reabierto;
    }

    public function setNIncidencia(int $nIncidencia): void{
         $this->nIncidencia=$nIncidencia;
    }

    public function setMotivo(String $motivo){
        $this->motivo=$motivo;
    }

    public function setSolucion(String $solucion) {
        $this->solucion=$solucion;
    }

    public function setEstado(int $estado){
        $this->estado=$estado;
    }

    public function setIdCreador(String $idCreador) {
        $this->idCreador=$idCreador;
    }

    public function setIdEmpleado(String $idEmpleado) {
        $this->idCreador=$idEmpleado;
    }

    public function setObservaciones(String $observaciones){
        $this->observaciones=$observaciones;
    }

    public function setReabierto(bool $reabierto){
        $this->reabierto=$reabierto;
    }

    public static function recogerTodasIncidencias(mysqli $connection){
        $incidencias=[];
        $result=$connection->query("Select * from incidencias");

        if($result!=false){
            $linea=$result->fetch_object();

            while($linea!=null){
                $incidencia=new Incidencias(motivo: $linea->motivo, idCreador: $linea->id_creador, observaciones: $linea->observaciones, nIncidencia: $linea->numero_incidencia, solucion: $linea->solucion, estado: $linea->estado, idEmpleado: $linea->id_empleado, reabierto: $linea->reabierto);
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
                $incidencia=new Incidencias(motivo: $linea->motivo, idCreador: $linea->id_creador, observaciones: $linea->observaciones, nIncidencia: $linea->numero_incidencia, solucion: $linea->solucion, estado: $linea->estado, idEmpleado: $linea->id_empleado, reabierto: $linea->reabierto);
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
                $incidencia=new Incidencias(motivo: $linea->motivo, idCreador: $linea->id_creador, observaciones: $linea->observaciones, nIncidencia: $linea->numero_incidencia, solucion: $linea->solucion, estado: $linea->estado, idEmpleado: $linea->id_empleado, reabierto: $linea->reabierto);
            }
        }else{
            $error="Error de conexion a la BD";
            return $error;
        }

        return $incidencia;
    }

    public static function recogerIncidenciasDNI(array $lista_incidencias, String $DNI){//Esto no tiene que llamar a la base de datos sino al array ya creado.
        $id_Usuario=''; // Aqui es necesario utilizar una función no implementada de Usuarios.
        $listaDNI=array_filter($lista_incidencias, function($incidencia) use($id_Usuario){
            return $incidencia->getIdCreador()==$id_Usuario;
        });

        return $listaDNI;
    }
}

?>
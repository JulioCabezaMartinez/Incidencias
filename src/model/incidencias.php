<?php
/**
 * Esta clase recoge los atributos de la tabla Incidencias de la Base de Datos.
 */
class Incidencias{
    /**
     * Número de incidencia que  identifica a la incidencia.
     * @var int|null
     */
    private int|null $nIncidencia=null;
    /**
     * Descripción del motivo por el que se crea la incidencia, es decir, el problema que tiene el usuario.
     * @var string
     */
    private String $motivo;
    /**
     * Solución que se ha proporcionado a la incidencia.
     * @var string|null
     */
    private String|null $solucion=null;
    /**
     * Tipo de estado en el que se puede encontrar una Incidencia. Estos tipos son: 0. Reabierto 
     * 1. Trabajando en ello. 2. Finalizado Pendiente. (El trabajador pausa la incidencia) 3. En Seguimiento. (Esperando a que el cliente envie) 
     * 4. Finalizado. (Solo cuando este finalizado se puede reabrir) 5. Sin trabajador Asignado. 6. Finalizado sin posibilidad de reabrir. Por defecto este valor será 5 (Sin trabajador Asignado).
     * @var int
     */
    private int $estado=5; 
    /**
     * Justificación del estado de la incidencia. Este campo se rellena en caso de que la incidencia se tenga que postergar (Tipos 2 y 3).
     * @var string|null
     */
    private String|null $motivo_estado=null;
    /**
     * Referencia al id del creador de la incidencia.
     * @var string
     */
    private String $idCreador;
    /**
     * Referencia al id del cliente de la incidencia.
     * @var string
     */
    private String $idCliente;
    /**
     * Referencia al id del empleado que va a solucionar la incidencia.
     * @var string|null
     */
    private String|null $idEmpleado=null;
    /**
     * Persona que contactó al soporte para poder abrir la incidencia.
     * @var string
     */
    private String $contacto;
    /**
     * Aportaciones que el empleado puede indicar en caso de que esa incidencia o su resolución tenga algún tipo de comportamiento inusual.
     * @var string|null
     */
    private String|null $observaciones=null;
    /**
     * Indica si la incidencia ha sido reabierta ya bien por haber finalizado y se necesite reabrir para solucionar otro o el mismo error, o porque se haya puesto en espera por algún motivo.
     * @var bool
     */
    private bool $reabierto=false;
    /**
     * Indica la hora a la que se abrio la incidencia para empezar a ser solucionada.
     * @var string|null
     */
    private String|null $hora_apertura=null;
    /**
     * Summary of hora_cierre
     * @var string|null
     */
    private String|null $hora_cierre=null;
    /**
     * Indica la hora a la que se guardó el estado de la incidencia.
     * @var float|null
     */
    private float|null $totalTiempo=null;
    /**
     * Constructor de la incidencia. Los parametros que que tengan un valor por defecto deben de ser indicados obligatoriamente, el resto se le asiganará un valor por defecto al crearse la incidencia.
     * @param string $motivo
     * @param string $idCreador
     * @param string $idCliente
     * @param string $contacto
     * @param string|null $observaciones
     * @param int $nIncidencia
     * @param string|null $solucion
     * @param int|null $estado
     * @param string|null $motivo_estado
     * @param string|null $idEmpleado
     * @param bool|null $reabierto
     * @param string|null $hora_apertura
     * @param string|null $hora_cierre
     * @param int|null $totalTiempo
     */
    public function __construct(String $motivo, String $idCreador, String $idCliente, String $contacto, String|null $observaciones=null, int $nIncidencia=null, String|null $solucion=null, int|null $estado=null, String|null $motivo_estado=null, String|null $idEmpleado=null, bool|null $reabierto=null, String|null $hora_apertura=null, String|null $hora_cierre=null, float|null $totalTiempo=null){
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
    /**
     * Getter de la variable nIncidencia.
     * @return int|null
     */
    public function getNIncidencia(): int|null{
        return $this->nIncidencia;
    }

    /**
     * Getter de la variable motivo.
     * @return int|null
     */
    public function getMotivo(): String{
        return $this->motivo;
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
     * Getter de la variable idCreador.
     * @return int|null
     */
    public function getIdCreador(): String{
        return $this->idCreador;
    }
    /**
     * Getter de la variable idCliente.
     * @return int|null
     */
    public function getIdCliente(): string {
        return $this->idCliente;
    }
    /**
     * Getter de la variable idEmpleado
     * @return int|null
     */
    public function getIdEmpleado(): String|null{
        return $this->idEmpleado;
    }
    /**
     * Getter de la variable contacto.
     * @return int|null
     */
    public function getContacto(): string {
        return $this->contacto;
    }
    /**
     * Getter de la variable observaciones.
     * @return int|null
     */
    public function getObservaciones(): String|null{
        return $this->observaciones;
    }
    /**
     * Getter de la variable reabierto.
     * @return int|null
     */
    public function getReabierto(): bool{
        return $this->reabierto;
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
     * Setter de la variable nIncidencia.
     * @param int|null $nIncidencia
     * @return void
     */
    public function setNIncidencia(int|null $nIncidencia): void{
         $this->nIncidencia=$nIncidencia;
    }
    /**
     * Setter de la variable motivo
     * @param string $motivo
     * @return void
     */
    public function setMotivo(String $motivo){
        $this->motivo=$motivo;
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
     * Setter de la variable idCreador.
     * @param string $idCreador
     * @return void
     */
    public function setIdCreador(String $idCreador) {
        $this->idCreador=$idCreador;
    }
    /**
     * Setter de la variable idCliente.
     * @param mixed $idCliente
     * @return void
     */
    public function setIdCliente($idCliente) {
        $this->idCliente = $idCliente;
    }
    /**
     * Setter de la variable idEmpleado.
     * @param string|null $idEmpleado
     * @return void
     */
    public function setIdEmpleado(String|null $idEmpleado) {
        $this->idCreador=$idEmpleado;
    }
    /**
     * Setter de la variable contacto.
     * @param mixed $contacto
     * @return void
     */
    public function setContacto($contacto) {
        $this->contacto = $contacto;
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
     * Setter de la variable reabierto.
     * @param bool $reabierto
     * @return void
     */
    public function setReabierto(bool $reabierto){
        $this->reabierto=$reabierto;
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

    /**
     * Método que recoge todos los datos de las incidencias que hay alojadas en la base de datos.
     * @param mysqli $connection Conexión a la base de datos generada con anterioridad.
     * @return array|string Devuelve un array de incidencias con todas las incidencias alojadas en la base de datos, o devuelve el mensaje de error sql.
     */
    public static function recogerTodasIncidencias(mysqli $connection){
        $incidencias=[];
        $result=$connection->query("Select * from incidencias");

        if($result!=false){
            $linea=$result->fetch_object();

            while($linea!=null){
                $incidencia=new Incidencias(motivo: $linea->motivo, idCreador: $linea->id_creador, idCliente: $linea->id_cliente, contacto: $linea->persona_contacto, observaciones: $linea->observaciones, nIncidencia: $linea->numero_incidencia, solucion: $linea->solucion, estado: $linea->estado, motivo_estado: $linea->motivo_estado, idEmpleado: $linea->id_empleado, reabierto: $linea->reabierto, hora_apertura: $linea->hora_apertura, hora_cierre: $linea->hora_cierre, totalTiempo: (float)$linea->totalTiempo);
                array_push($incidencias, $incidencia);

                $linea=$result->fetch_object();
            }
        }else{ //Linea escrita para Debug.
            $error="Error de conexion a la BD";
            return $error;
        }

        return $incidencias;
    }

    /**
     * Método que recoge todas las incidencias asociadas a un usuario creador en especifico.
     * @param mysqli $connection Conexión a la base de datos generada con anterioridad.
     * @param string $id_User Id del usuario creador de las incidencias buscadas.
     * @return array|string Devuelve un array de incidencias con todas las incidencias asociadas al usuario creador alojadas en la base de datos, o devuelve el mensaje de error sql.
     */
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
    /**
     * Método que recoge todas las incidencias que estan en trabajo en ese momento.
     * @param mysqli $connection Conexión a la base de datos generada con anterioridad.
     * @return array|string Devuelve un array de incidencias con todas las incidencias con estado "Trabajando en ello" alojadas en la base de datos, o devuelve el mensaje de error sql.
     */
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

    /**
     * Método que recoge todas las incidencias que no tienen un trabajador asociado en ese momento.
     * @param mysqli $connection Conexión a la base de datos generada con anterioridad.
     * @return array|string Devuelve un array de incidencias con todas las incidencias que no tienen un atrabajador asociado alojadas en la base de datos, o devuelve el mensaje de error sql.
     */
    public static function recogerTodasIncidenciasNoAsignadas(mysqli $connection){
        $incidencias=[];
        $result=$connection->query("Select * from incidencias where estado=5");

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

    /**
     * Método que recoge todas las incidencias que tiene un trabajador asociado a un empleado en específico.
     * @param mysqli $connection Conexión a la base de datos generada con anterioridad.
     * @param string $id_User Id del empleado asociado a las incidencias.
     * @return array|string Devuelve un array de incidencias con todas las incidencias asociadas con un trabajador en específico alojadas en la base de datos, o devuelve el mensaje de error sql.
     */
    public static function recogerTodasIncidenciasAsignadasUsuario(mysqli $connection, String $id_User){
        $incidencias=[];
        $result=$connection->query("Select * from incidencias where id_empleado='". $id_User ."' and estado<4 ");

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

    /**
     * Método que recoge una incidencia identificada con un número de incidencia en concreto.
     * @param mysqli $connection Conexión a la base de datos generada con anterioridad.
     * @param int $numero_incidencia Número de incidencia con el que se identifica a la incidencia que se quiere recoger.
     * @return Incidencias|string Devuelve la incidencia asociada al número de incedencia especificado, o devuelve el mensaje de error sql.
     */
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

    /**
     * Método que recoge todas las incidencias que tiene un cliente asociado, este cliente se consigue a traves de su DNI, a una serie incidencias.
     * @param string $DNI DNI que identifica al cliente que tiene las incidencias.
     * @param mysqli $connection Conexión a la base de datos generada con anterioridad.
     * @return array Devuelve un array de incidencias con todas las incidencias asociadas con un cliente en específico alojadas en la base de datos
     */
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

    /**
     * Método que permite crear una Incidencia y almacenarla en la base de datos.
     * @param mixed $motivo Motivo de la incidencia.
     * @param mixed $id_creador Identificador del usuario creador de la incidencia.
     * @param mixed $id_cliente Identificador del usuario cliente de la incidencia.
     * @param mixed $contacto Nombre de la persona que se ha puesto en contacto para crear la incidencia.
     * @param mysqli $connection Conexión a la base de datos generada con anterioridad.
     * @return bool|string Devuelve true si la insercción en la base de datos ha sido correcta o, en caso contrario, el mensaje de error de sql
     */
    public static function creacionIncidencia($motivo, $id_creador, $id_cliente, $contacto, mysqli $connection){
        $incidencia=new Incidencias($motivo, $id_creador, $id_cliente, $contacto);
        
        $result=$connection->query("INSERT INTO incidencias (motivo, estado, id_creador, id_cliente, persona_contacto) VALUES ('". $incidencia->getMotivo() ."', ". $incidencia->getEstado() ." ,'". $incidencia->getIdCreador() ."', '".$incidencia->getIdCliente()."', '".$incidencia->getContacto()."');");

        if($result!=false){
            return true;
        }else return mysqli_error($connection);
    }
    /**
     * Método que permite añadir un empleado a una incidencia, tenga ya esta un empleado asociado o no.
     * @param mixed $id_Empleado Identificador del empleado que se va a asociar a la incidencia.
     * @param mixed $numero_incidencia Número identificativo de la incidencia a la que se le va a asociar un trabajador.
     * @param mysqli $connection Conexión a la base de datos generada con anterioridad.
     * @return bool Devuelve true si la modificación de la incidencia en la base de datos ha sido correcta o, en caso contrario, false.
     */
    public static function asignarEmpleado($id_Empleado, $numero_incidencia, mysqli $connection){
        $result=$connection->query("UPDATE incidencias SET id_empleado = '". $id_Empleado ."', estado=1 WHERE (`numero_incidencia` = '". $numero_incidencia ."');");

        if($result!=false){
            return true;
        }else return false;
    }
    /**
     * Método que permite eliminar un empleado asociado a una incidencia.
     * @param mixed $id_Empleado Identificador del empleado que se va a asociar a la incidencia.
     * @param mixed $numero_incidencia Número identificativo de la incidencia a la que se le va a eliminar un trabajador.
     * @param mixed $connection Conexión a la base de datos generada con anterioridad.
     * @return bool Devuelve true si la modificación de la incidencia en la base de datos ha sido correcta o, en caso contrario, false.
     */
    public static function eliminarEmpleado($id_Empleado, $numero_incidencia, $connection){
        $result=$connection->query("UPDATE incidencias SET id_empleado = '". $id_Empleado ."', estado=1 WHERE (`numero_incidencia` = '". $numero_incidencia ."');");

        if($result!=false){
            return true;
        }else return false;
    }

    /**
     * Método que cuenta todas las incidencias que se encuentran en trabajo y que tiene un empleado en especifico.
     * @param mixed $id_empleado Id de empleado.
     * @param mysqli $connection Conexión a la base de datos generada con anterioridad.
     * @return mixed
     */
    public static function contarIncidenciasPendientes($id_empleado, mysqli $connection){
        $result=$connection->query("Select count(*) as total from incidencias where estado<4 and id_empleado='". $id_empleado ."';");

        $linea=$result->fetch_object();

        if($result!=false){
            
            return $linea->total;

        }else{
            return false;
        }
    }

    /**
     * Método que permite rellenar los campos asociados a la resolución de una incidencia en especifico.
     * @param int $estado Estado de la incidencia.
     * @param string $motivo_estado Motivo del estado por el cual se ha guardado la incidencia.
     * @param string|null $resolucion Solución que se le ha dado a una incidencia en especifico.
     * @param string|null $observaciones Observaciones adicionales asociadas tanto al motivo como a la solucion de la incidencia.
     * @param int $nIncidencia Número identificativo de la incidencia.
     * @param string $horaApertura Hora a la que se ha abierto la incidencia para empezar a solucionarla.
     * @param string $horaCierre Hora a la que se ha guardado la incidencia.
     * @param float $totalTiempo Tiempo total de trabajado en la incidencia.
     * @param mysqli $connection Conexión a la base de datos generada con anterioridad.
     * @return bool True en caso de que se hayan implementado los datos en la base de datos, false en caso contrario.
     */
    public static function solucionarIncidencia(int $estado, String $motivo_estado, String|null $resolucion, String|null $observaciones, int $nIncidencia, String $horaApertura, String $horaCierre, float $totalTiempo, mysqli $connection){
        $result=$connection->query("UPDATE incidencias SET solucion = '".$resolucion."', estado=".$estado.", motivo_estado = '".$motivo_estado."', observaciones = '".$observaciones."', hora_apertura='".$horaApertura."', hora_cierre='".$horaCierre."', totalTiempo='".$totalTiempo."' WHERE (`numero_incidencia` = '".$nIncidencia."');");

        if($result!=false){
            return true;
        }else return false;
    }

    public static function guardarHoraEntrada(String $hora_apertura, $nIncidencia, mysqli $connection){
        $result=$connection->query("UPDATE incidencias SET hora_apertura='".$hora_apertura."' WHERE (`numero_incidencia` = '".$nIncidencia."');");

        if($result!=false){
            return true;
        }else return false;
    }

    public static function actualizarReabrirIncidencia($nIncidencia, mysqli $connection){
        $result=$connection->query("UPDATE incidencias SET reabierto=1 WHERE (`numero_incidencia` = '".$nIncidencia."');");

        if($result!=false){
            return true;
        }else return false;
    }

    public static function guardarDocumento($documento, $nIncidencia, mysqli $connection){
        $result=$connection->query("UPDATE incidencias SET incidencia_fisica='".$documento."' WHERE (`numero_incidencia` = '".$nIncidencia."');");
    
        if($result!=false){
            return true;
        }else return false;
    }

    /**
     * Método que permite modificar todos los datos de una incidencia en especifico.
     * @param int $estado Estado de la incidencia.
     * @param string $motivo Problema por el que se crea la incidencia.
     * @param string $motivo_estado Motivo del estado por el cual se ha guardado la incidencia.
     * @param string|null $resolucion Solución que se le ha dado a una incidencia en especifico.
     * @param string|null $observaciones Observaciones adicionales asociadas tanto al motivo como a la solucion de la incidencia.
     * @param int $nIncidencia Número identificativo de la incidencia.
     * @param string $horaApertura Hora a la que se ha abierto la incidencia para empezar a solucionarla.
     * @param string $horaCierre Hora a la que se ha guardado la incidencia.
     * @param float $totalTiempo Tiempo total de trabajado en la incidencia.
     * @param mysqli $connection True en caso de que se hayan implementado los datos en la base de datos, false en caso contrario.
     * @return bool
     */
    public static function actualizarIncidencia(int $estado, String $motivo, String $motivo_estado, String|null $resolucion, String|null $observaciones, int $nIncidencia, String $horaApertura, String $horaCierre, float $totalTiempo, mysqli $connection){
        $result=$connection->query("UPDATE incidencias SET motivo='".$motivo."', solucion = '".$resolucion."', estado=".$estado.", motivo_estado = '".$motivo_estado."', observaciones = '".$observaciones."', hora_apertura='".$horaApertura."', hora_cierre='".$horaCierre."', totalTiempo='".$totalTiempo."' WHERE (`numero_incidencia` = '".$nIncidencia."');");

        if($result!=false){
            return true;
        }else return false;
    }
}

?>
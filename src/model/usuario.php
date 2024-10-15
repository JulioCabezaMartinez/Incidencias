<?php

/**
 * Esta clase recoge los atributos de la tabla Usuario de la Base de Datos.
 */
class Usuario {
    /**
     * Serie de caractes que identifica al usuario.
     * @var string|null
     */
    private String|null $id;
    /**
     * Correo electronico del usuario.
     * @var string
     */
    private String $correo;
    /**
     * Como la aplicación identifica al usuario. Los tipos son los siguientes: Roles Usuario: 
     * 1. Admin. 
     * 2. Cliente. 
     * 3. Empleado. 
     * 4. Empleado Jefe. 
     * 5. Empleado en espera. 
     * 6. Empleado denegado. 
     * 7. Empleado de baja. 
     * 8. Cliente de baja.
     * @var int
     */
    private int $tipo;
    /**
     * Contraseña que necesita el usuario para poder acceder a la aplicación.
     * @var string
     */
    private String $pass;
    /**
     * Nombre del usuario.
     * @var string
     */
    private String $nombre;
    /**
     * Apellidos del usuario.
     * @var string
     */
    private String $apellidos;
    /**
     * DNI del usuario.
     * @var string
     */
    private String $DNI;
    /**
     * Telefono del usuario.
     * @var string
     */
    private String $telefono;
    /**
     * Dirección del domicilio del usuario.
     * @var string
     */
    private String $direccion;
    /**
     * Motivo por el cual se ha dado de baja a un usuario.
     * @var string|null
     */
    private String|null $motivo_baja=null;
    /**
     * Motivo por el cual se ha readmitido a un usuario.
     * @var string|null
     */
    private String|null $motivo_readmision=null;
    /**
     * Fecha y hora en la que se dio de baja a un usario.
     * @var string|null
     */
    private String|null $fecha_baja=null;
    /**
     * Fecha y hora en la que se readmitio a un usario.
     * @var string|null
     */
    private String|null $fecha_readmision=null;

    /**
     * Constructor de la incidencia. Los parametros que que tengan un valor por defecto deben de ser indicados obligatoriamente, el resto se le asiganará un valor por defecto al crearse el usuario.
     * @param string $correo
     * @param int $tipo
     * @param string $pass
     * @param string $nombre
     * @param string $apellidos
     * @param string $DNI
     * @param string $telefono
     * @param string $direccion
     * @param string $id
     * @param string|null $motivo_baja
     * @param string|null $motivo_readmision
     * @param string|null $fecha_baja
     * @param string|null $fecha_readmision
     */
    public function __construct(String $correo, int $tipo, String $pass, String $nombre, String $apellidos, String $DNI, String $telefono, String $direccion, String $id=null, String|null $motivo_baja=null, String|null $motivo_readmision=null, String|null $fecha_baja=null, String|null $fecha_readmision=null){
        if(!is_null($id)){
            $this->id=$id;
        }else $this->id=uniqid();
        $this->correo=$correo;
        $this->tipo=$tipo;
        $this->pass=$pass;
        $this->nombre=$nombre;
        $this->apellidos=$apellidos;
        $this->DNI=$DNI;
        $this->telefono=$telefono;
        $this->direccion=$direccion;

        if(!is_null($motivo_baja)){
            $this->motivo_baja=$motivo_baja;
        }
        if(!is_null($motivo_readmision)){
            $this->motivo_readmision=$motivo_readmision;
        }
        if(!is_null($fecha_baja)){
            $this->fecha_baja=$fecha_baja;
        }
        if(!is_null($fecha_readmision)){
            $this->fecha_readmision=$fecha_readmision;
        }
    }

    //Gettter
    /**
     * Getter del ID.
     * @return string
     */
    public function getId(): String {
        return $this->id;
    }
    /**
     * Getter del correo.
     * @return string
     */
    public function getCorreo(): String {
        return $this->correo;
    }
    /**
     * Getter del tipo de usuario.
     * @return int
     */
    public function getTipo(): int {
        return $this->tipo;
    }
    /**
     * Getter de la contraseña.
     * @return string
     */
    public function getPass(): String {
        return $this->pass;
    }
    /**
     * Getter del nombre del usuario.
     * @return string
     */
    public function getNombre(): String {
        return $this->nombre;
    }
    /**
     * Getter de los apellidos del usuario.
     * @return string
     */
    public function getApellidos(): String {
        return $this->apellidos;
    }
    /**
     * Getter del DNI
     * @return string
     */
    public function getDNI(): String {
        return $this->DNI;
    }
    /**
     * Getter del telefono.
     * @return string
     */
    public function getTelefono(): string {
        return $this->telefono;
    }
    /**
     * Getter de la direccion.
     * @return string
     */
    public function getDireccion(): string {
        return $this->direccion;
    }
    /**
     * Getter del motivo de la baja.
     * @return string
     */
    public function getMotivoBaja(): string {
        return $this->motivo_baja;
    }
    /**
     * Getter del motivo de la readmision.
     * @return string
     */
    public function getMotivoReadmision(): string {
        return $this->motivo_readmision;
    }
    /**
     * Getter de la fecha de la baja.
     * @return string
     */
    public function getFechaBaja(): string {
        return $this->fecha_baja;
    }
    /**
     * Gettter de la fecha de readmision.
     * @return string
     */
    public function getFechaReadmision(): string {
        return $this->fecha_readmision;
    }

    //Setters
    /**
     * Setter del ID.
     * @param string $id
     * @return string
     */
    public function setId(String $id)  {
        return $this->id=$id;
    }
    /**
     * Setter del correo.
     * @param string $correo
     * @return void
     */
    public function setCorreo(String $correo): void {
        $this->correo = $correo;
    }
    /**
     * Setter del tipo de usuario.
     * @param int $tipo
     * @return void
     */
    public function setTipo(int $tipo): void {
        $this->tipo = $tipo;
    }
    /**
     * Setter de la contraseña.
     * @param string $pass
     * @return void
     */
    public function setPass(String $pass): void {
        $this->pass = $pass;
    }
    /**
     * Setter del nombre.
     * @param string $nombre
     * @return void
     */
    public function setNombre(String $nombre): void {
        $this->nombre = $nombre;
    }
    /**
     * Setter de los apellidos.
     * @param string $apellidos
     * @return void
     */
    public function setApellidos(String $apellidos): void {
        $this->apellidos = $apellidos;
    }
    /**
     * Setter del DNI.
     * @param string $DNI
     * @return void
     */
    public function setDNI(String $DNI): void {
        $this->DNI = $DNI;
    }
    /**
     * Setter del telefono.
     * @param string $telefono
     * @return void
     */
    public function setTelefono(string $telefono): void {
        $this->telefono = $telefono;
    }
    /**
     * Setter de la direccion.
     * @param string $direccion
     * @return void
     */
    public function setDireccion(string $direccion): void {
        $this->direccion = $direccion;
    }
    /**
     * Setter del motivo de la baja.
     * @param string $motivo_baja
     * @return void
     */
    public function setMotivoBaja(string $motivo_baja): void {
        $this->motivo_baja = $motivo_baja;
    }
    /**
     * Setter del motivo de la readmision.
     * @param string $motivo_readmision
     * @return void
     */
    public function setMotivoReadmision(string $motivo_readmision): void {
        $this->motivo_readmision = $motivo_readmision;
    }
    /**
     * Setter de la fecha de la baja.
     * @param string $fecha_baja
     * @return void
     */
    public function setFechaBaja(string $fecha_baja): void {
        $this->fecha_baja = $fecha_baja;
    }
    /**
     * Setter de la fecha de la readmision.
     * @param string $fecha_readmision
     * @return void
     */
    public function setFechaReadmision(string $fecha_readmision): void {
        $this->fecha_readmision = $fecha_readmision;
    }
    //Funciones de Clase

    //Esta funcion comprueba que no exista ningun usuario con el mismo correo o el mismo DNI dentro de la DB.
    /**
     * Método que corrobora si los datos indicados por el usuario no se encuentran ya en la base de datos.
     * @param mixed $correo Correo proporcionado por el usuario.
     * @param mixed $DNI DNI proporcionado por el usuario.
     * @param mysqli $connection Conexión a la base de datos generada con anterioridad.
     * @return bool En caso de que se encuentre alguno de los datos proporcionado se devolverá false, en caso de que las busquedas sean nulas, se devolverá true.
     */
    public static function compruebaCredenciales($correo, $DNI, mysqli $connection){ 
        $result=$connection->query('Select nombre from usuarios where correo="'. $correo .'";');
        $result2=$connection->query('Select nombre from usuarios where DNI="'. $DNI .'";');

        if($result!=false){
            $linea=$result->fetch_object();
            $linea2=$result2->fetch_object();

            if(is_null($linea) && is_null($linea2)){
                return true;
            }else return false;
        }
    }
    /**
     * Método que registra un usuario en la base de datos.
     * @param string $correo Correo del usuario.    
     * @param string $tipo Tipo de usuario que se intenta crear.
     * @param string $pass Contraseña del usuario.
     * @param string $confirmPass Confirmación de que la contraseña que se intenta insertar es la deseada por el usuario.
     * @param string $nombre Nombre del usuario.
     * @param string $apellidos Apellidos del usuario.
     * @param string $DNI Dni del usuario.
     * @param string $telefono Telefono del usuario.
     * @param string $direccion Dirección del usuario.
     * @param mysqli $connection Conexión a la base de datos generada con anterioridad.
     * @return string En caso de que haya algún fallo, se le indicara al usuario mediante un texto. En caso de que la insercción en la base de datos falle, se indicara el motivo del error.
     */
    public static function registrarUsuario(String $correo, String $tipo, String $pass, String $confirmPass, String $nombre, String $apellidos, String $DNI, String $telefono, String $direccion, mysqli $connection){
        if(!is_null($correo) && !is_null($tipo) && !is_null($pass) && !is_null($confirmPass) && !is_null($nombre) && !is_null($apellidos) && !is_null($DNI) && !is_null($telefono) && !is_null($direccion)){ //Doble comprobación para evitar que inyecciones de datos erroneas en la BD
            if($pass===$confirmPass){
                if(Usuario::compruebaCredenciales($correo, $DNI, $connection)){

                    $confirmTipo=match($tipo){ //Este match le da un int para que se inyecte correctamente en la base de datos
                        "Cliente"=>2,
                        "Empleado"=>4
                    };
    
                    $usuario=new Usuario($correo, $confirmTipo, password_hash($pass, PASSWORD_DEFAULT), $nombre, $apellidos, $DNI, $telefono, $direccion);
    
                    if($tipo=="Empleado"){
                        $result=$connection->query("Insert into relacion_empleados values('66fa89e697c99', '". $usuario->getId() ."', 1)"); // Estado: 1 En espera, 2 Aceptado, 3 Denegado.
                        //El id es el del administrador el cual no va a cambiar. 
    
                        if(!$result){
                            return mysqli_error($connection); //Lineas de debug.
                        }
                    }
    
                    $result=$connection->query("Insert into usuarios values('". $usuario->getId() ."', '". $usuario->getCorreo() ."',". $usuario->getTipo() .", '". $usuario->getPass() ."', '". $usuario->getTelefono() ."', '". $usuario->getDireccion() ."', '". $usuario->getNombre() ."', '". $usuario->getApellidos() ."', '". $usuario->getDNI()."', null, null, null, null, null)");
    
                    if(!$result){
                        return mysqli_error($connection); //Lineas de debug.
                    }

                }else{
                    return "Su DNI o correo ya se encuntra registrado";
                }
            }else{
                return "Contraseñas no coinciden";
            }
        }else{
            return "Faltan datos por rellenar";
        }
    }
    /**
     * Método que le permite a los clientes y empleados acceder a la aplicación.
     * @param mixed $correo Correo del usuario.
     * @param mixed $pass Contraseña del usuario.
     * @param mysqli $connection Conexión a la base de datos generada con anterioridad.
     * @return bool Devuelve true en caso de que el usuario se encuentre en la base de datos, false en caso contrario.
     */
    public static function LogIn($correo, $pass, mysqli $connection){

        $result=$connection->query("Select * from usuarios where correo= '". $correo ."';");

        $linea=$result->fetch_object();

        if(password_verify($pass, $linea->password)){
            $_SESSION["id"]=$linea->id_usuario;
            $_SESSION["nombre"]=$linea->nombre;
            $_SESSION["apellidos"]=$linea->apellidos;
            $_SESSION["tipo"]=(int)$linea->tipo;
            return true;
        }else return false;

    }
    /**
     * Método que elimina la sesión del usuario que se encontraba conectado a la aplicación.
     * @return void 
     */
    public static function logOut(){

        session_unset();
        unset($_SESSION);
        session_destroy();

        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time()-42000, '/');
        }
    }
    /**
     * Método que devuelve una lista de los empleados que se encuentran a la espera de que el administrador los acepte como empleados.
     * @param mysqli $connection Conexión a la base de datos generada con anterioridad.
     * @return array|string Devuelve el array de los empleados en espera, en caso de que falle la busqueda en la base de datos se indicaran los problemas sql de esta busqueda.
     */
    public static function verNoEmpleados(mysqli $connection){
        $lista_empleados=[];
        $result=$connection->query("Select * from usuarios inner join relacion_empleados on usuarios.id_usuario=relacion_empleados.id_empleado where relacion_empleados.estado=1;");

        if($result!=false){
            $linea=$result->fetch_object();

            while($linea!=null){
                $empleado=["id"=>$linea->id_empleado, "nombre"=>$linea->nombre, "apellidos"=>$linea->apellidos, "DNI"=>$linea->DNI];
                array_push($lista_empleados, $empleado);

                $linea=$result->fetch_object();
            }
            
            return $lista_empleados;
        }else{
            return mysqli_error($connection);
        }
    }
    /**
     * Método que devuelve una lista de todos los usuarios que hay en la base de datos.
     * @param mysqli $connection Conexión a la base de datos generada con anterioridad.
     * @return array|string Devuelve el array de los usuarios, en caso de que falle la busqueda en la base de datos se indicaran los problemas sql de esta busqueda.
     */
    public static function verAllEmpleados(mysqli $connection){
        $lista_empleados=[];
        $result=$connection->query("Select * from usuarios;");

        if($result!=false){
            $linea=$result->fetch_object();

            while($linea!=null){
                $empleado=new Usuario($linea->correo, $linea->tipo, "", $linea->nombre, $linea->apellidos, $linea->DNI, $linea->telefono, $linea->direccion, $linea->id_usuario, $linea->motivo_denegacion_baja, $linea->motivo_readmision, $linea->fecha_denegacion_baja, $linea->fecha_readmision);
                array_push($lista_empleados, $empleado);

                $linea=$result->fetch_object();
            }
            
            return $lista_empleados;
        }else{
            return mysqli_error($connection);
        }
    }

    public static function recogerEmpleados(mysqli $connection){
        $lista_empleados=[];
        $result=$connection->query("Select * from usuarios where tipo=3 OR tipo=4;");

        if($result!=false){
            $linea=$result->fetch_object();

            while($linea!=null){
                $empleado=new Usuario($linea->correo, $linea->tipo, "", $linea->nombre, $linea->apellidos, $linea->DNI, $linea->telefono, $linea->direccion, $linea->id_usuario, $linea->motivo_denegacion_baja, $linea->motivo_readmision, $linea->fecha_denegacion_baja, $linea->fecha_readmision);
                array_push($lista_empleados, $empleado);

                $linea=$result->fetch_object();
            }
            
            return $lista_empleados;
        }else{
            return mysqli_error($connection);
        }
    }

    public static function aceptarEmpleado($id ,mysqli $connection){
        $result=$connection->query("UPDATE usuarios SET `tipo` = '3' WHERE id_usuario = '". $id ."';");
        $result=$connection->query("UPDATE relacion_empleados SET estado = 2 WHERE id_empleado =  '". $id ."';");

        if($result!=false){
            return true;
        }else return false;
    }

    public static function bajaEmpleado($id ,mysqli $connection){
        $result=$connection->query("UPDATE usuarios SET `tipo` = '7' WHERE id_usuario = '". $id ."';");

        if($result!=false){
            return true;
        }else return false;
    }

    public static function readmisionEmpleado($id ,mysqli $connection){
        $result=$connection->query("UPDATE usuarios SET `tipo` = '3' WHERE id_usuario = '". $id ."';");

        if($result!=false){
            return true;
        }else return false;
    }

    public static function bajaCliente($id ,mysqli $connection){
        $result=$connection->query("UPDATE usuarios SET `tipo` = '8' WHERE id_usuario = '". $id ."';");

        if($result!=false){
            return true;
        }else return false;
    }

    public static function readmisionCliente($id ,mysqli $connection){
        $result=$connection->query("UPDATE usuarios SET `tipo` = '2' WHERE id_usuario = '". $id ."';");

        if($result!=false){
            return true;
        }else return false;
    }

    public static function denegarEmpleado($id ,mysqli $connection){
        $result=$connection->query("UPDATE usuarios SET `tipo` = '5' WHERE id_usuario = '". $id ."';");
        $result=$connection->query("UPDATE relacion_empleados SET estado = 3 WHERE id_empleado =  '". $id ."';");

        if($result!=false){
            return true;
        }else return false;
    }

    public static function recogerDatosEmpleado($id ,mysqli $connection){
        $result=$connection->query("Select nombre, apellidos, DNI, telefono from usuarios where id_usuario= '". $id ."';");

        $linea=$result->fetch_object();

        if($linea!=null){
            $datos_usuario=["nombre"=>$linea->nombre, "apellidos"=>$linea->apellidos, "DNI"=>$linea->DNI, "telefono"=>$linea->telefono];

            return $datos_usuario;

        }else return false;

    }

    public static function recogerDatosEmpleadoAdmin($id ,mysqli $connection){
        $result=$connection->query("Select * from usuarios where id_usuario= '". $id ."';");

        $linea=$result->fetch_object();

        if($linea!=null){
            $empleado=new Usuario($linea->correo, $linea->tipo, "", $linea->nombre, $linea->apellidos, $linea->DNI, $linea->telefono, $linea->direccion, $linea->id_usuario, $linea->motivo_denegacion_baja, $linea->motivo_readmision, $linea->fecha_denegacion_baja, $linea->fecha_readmision);


            return $empleado;

        }else return false;

    }

    public static function recogerDNIsUsuarios(mysqli $connection){
        $listaDNIs=[];

        $result=$connection->query("Select DNI from usuarios;");

        $linea=$result->fetch_object();

        while($linea!=null){
            array_push($listaDNIs, $linea->DNI);

            $linea=$result->fetch_object();
        }

        return $listaDNIs;
    }

    public static function busquedaDNI( $DNI ,mysqli $connection){
        $busqueda_DNI=[];
        $result=$connection->query("Select DNI, nombre, apellidos,telefono, id_usuario from usuarios where DNI LIKE '$DNI%';");

        $linea=$result->fetch_object();
        while($linea!=null){
            $datos=["DNI"=>$linea->DNI, "nombre"=>$linea->nombre, "apellidos"=>$linea->apellidos, "telefono"=>$linea->apellidos, "id"=>$linea->id_usuario];
            array_push($busqueda_DNI, $datos);

            $linea=$result->fetch_object();
        }

        return $busqueda_DNI;
    }

    public static function recogerUsuarioDNI($DNI, $connection){
        $result=$connection->query("Select nombre, apellidos, DNI, telefono, id_usuario from usuarios where DNI= '". $DNI ."';");

        $linea=$result->fetch_object();

        if($linea!=null){
            $datos_usuario=["nombre"=>$linea->nombre, "apellidos"=>$linea->apellidos, "DNI"=>$linea->DNI, "telefono"=>$linea->telefono, "id"=>$linea->id_usuario];

            return $datos_usuario;

        };
    }

    public static function recogerUsuarioID($id, $connection){
        $result=$connection->query("Select nombre, apellidos, DNI, telefono, id_usuario from usuarios where id_usuario= '". $id ."';");

        $linea=$result->fetch_object();

        if($linea!=null){
            $datos_usuario=["nombre"=>$linea->nombre, "apellidos"=>$linea->apellidos, "DNI"=>$linea->DNI, "telefono"=>$linea->telefono, "id"=>$linea->id_usuario];

            return $datos_usuario;

        }else return false;
    }

    public static function recogerIDUsuarioDNI($DNI, $connection){
        $result=$connection->query("Select id_usuario from usuarios where DNI= '". $DNI ."';");

        $linea=$result->fetch_object();

        if($linea!=null){
            $id=$linea->id_usuario;

            return $id;

        }else return false;
    }

    public static function contarEmpleadosPendientes(mysqli $connection){
        $result=$connection->query("Select count(*) as total from usuarios where tipo=4;");

        $linea=$result->fetch_object();

        if($result!=false){
            
            return $linea->total;

        }else{
            return false;
        }
    }

    public static function cambiarPass($id, $old_pass, $new_pass, $confirm, mysqli $connection){
        if(!is_null($new_pass) && !is_null($new_pass)){
            $result=$connection->query("Select password from usuarios where id_usuario= '". $id ."';");

            $linea=$result->fetch_object();

            if(password_verify($old_pass, $linea->password)){
                if($new_pass==$confirm){
                    $cambio=$connection->query("UPDATE usuarios SET password = '".password_hash($new_pass, PASSWORD_DEFAULT)."' WHERE (`id_usuario` = '".$id."');");

                    if($cambio!=false){
                        return true;
                    }else{
                        return false;
                    }
                }
            }
        }
    }

    public static function modificarUsuario($id, $correo, $tipo, $telefono, $direccion, $nombre, $apellidos, $DNI, $motivo_baja, $motivo_readmision, $fecha_baja, $fecha_readmision, mysqli $connection){
        $result=$connection->query('Update usuarios SET correo = "'.$correo.'", tipo="'.$tipo.'", telefono="'.$telefono.'", direccion="'.$telefono.'", nombre="'.$nombre.'", apellidos="'.$apellidos.'", DNI="'.$DNI.'", motivo_denegacion_baja="'.$motivo_baja.'", motivo_readmision="'.$motivo_readmision.'", fecha_denegacion_baja="'.$fecha_baja.'", fecha_readmision="'.$fecha_readmision.'" WHERE (`id_usuario` = "'.$id.'")');

        if($result!=false){
            return true;
        }else{
            return mysqli_error($connection);
        }
    }

    public static function asignarMotivoBaja($id, $motivo_baja, mysqli $connection){
        $result=$connection->query('Update usuarios SET motivo_denegacion_baja = "'.$motivo_baja.'" WHERE id_usuario="'.$id.'";');

        if($result!=false){
            return true;
        }else{
            return mysqli_error($connection);
        }
    }

    public static function asignarMotivoReadmision($id, $motivo_readmision, mysqli $connection){
        $result=$connection->query('Update usuarios SET motivo_readmision = "'.$motivo_readmision.'" WHERE id_usuario="'.$id.'";');

        if($result!=false){
            return true;
        }else{
            return mysqli_error($connection);
        }
    }
}

?>
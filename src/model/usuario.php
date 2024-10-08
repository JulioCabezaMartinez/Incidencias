<?php


class Usuario {
    private String|null $id;
    private String $correo;
    private int $tipo;
    private String $pass;
    private String $nombre;
    private String $apellidos;
    private String $DNI;
    private String $telefono;
    private String $direccion;

    public function __construct(String $correo, int $tipo, String $pass, String $nombre, String $apellidos, String $DNI, String $telefono, String $direccion, String $id=null){
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
    }

    //Gettter

    public function getId(): String {
        return $this->id;
    }

    public function getCorreo(): String {
        return $this->correo;
    }

    public function getTipo(): int {
        return $this->tipo;
    }
    
    public function getPass(): String {
        return $this->pass;
    }

    public function getNombre(): String {
        return $this->nombre;
    }

    public function getApellidos(): String {
        return $this->apellidos;
    }

    public function getDNI(): String {
        return $this->DNI;
    }

    public function getTelefono(): string {
        return $this->telefono;
    }

    public function getDireccion(): string {
        return $this->direccion;
    }

    //Setters

    public function setId(String $id)  {
        return $this->id=$id;
    }

    public function setCorreo(String $correo): void {
        $this->correo = $correo;
    }

    public function setTipo(int $tipo): void {
        $this->tipo = $tipo;
    }

    public function setPass(String $pass): void {
        $this->pass = $pass;
    }

    public function setNombre(String $nombre): void {
        $this->nombre = $nombre;
    }

    public function setApellidos(String $apellidos): void {
        $this->apellidos = $apellidos;
    }

    public function setDNI(String $DNI): void {
        $this->DNI = $DNI;
    }

    public function setTelefono(string $telefono): void {
        $this->telefono = $telefono;
    }

    public function setDireccion(string $direccion): void {
        $this->direccion = $direccion;
    }

    //Funciones de Clase

    //Esta funcion comprueba que no exista ningun usuario con el mismo correo o el mismo DNI dentro de la DB.
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
    public static function logOut(){

        session_unset();
        unset($_SESSION);
        session_destroy();

        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time()-42000, '/');
        }
    }

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

    public static function aceptarEmpleado($id ,mysqli $connection){
        $result=$connection->query("UPDATE usuarios SET `tipo` = '3' WHERE id_usuario = '". $id ."';");
        $result=$connection->query("UPDATE relacion_empleados SET estado = 2 WHERE id_empleado =  '". $id ."';");

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
            $result=$connection->query("Select pasword from usuarios where id_usuario= '". $id ."';");

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
}

?>
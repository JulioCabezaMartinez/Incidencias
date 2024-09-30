<?php


class Usuario {
    private String|null $id=null;
    private String $correo;
    private int $tipo; //1 Admin, 2 Cliente, 3 Empleado, 4 Empleado en espera, 5 Empleado de baja.
    private String $pass;
    private String $nombre;
    private String $apellidos;
    private String $DNI;

    public function __construct(String $correo, int $tipo, String $pass, String $nombre, String $apellidos, String $DNI){
        $this->id=uniqid();
        $this->correo=$correo;
        $this->tipo=$tipo;
        $this->pass=$pass;
        $this->nombre=$nombre;
        $this->apellidos=$apellidos;
        $this->DNI=$DNI;
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


    //Funciones de Clase

    public static function registrarUsuario(String $correo, String $tipo, String $pass, String $confirmPass, String $nombre, String $apellidos, String $DNI, mysqli $connection){
        if(!is_null($correo) && !is_null($tipo) && !is_null($pass) && !is_null($confirmPass) && !is_null($nombre) && !is_null($apellidos) && !is_null($DNI)){ //Doble comprobación para evitar que inyecciones de datos erroneas en la BD
            if($pass===$confirmPass){

                $confirmTipo=match($tipo){ //Este match le da un int para que se inyecte correctamente en la base de datos
                    "Cliente"=>2,
                    "Empleado"=>4
                };

                $usuario=new Usuario($correo, $confirmTipo, password_hash($pass, PASSWORD_DEFAULT), $nombre, $apellidos, $DNI);
                $result=$connection->query("Insert into usuarios values('". $usuario->getId() ."', '". $usuario->getCorreo() ."', '". $usuario->getPass() ."', '". $usuario->getDNI()."', ". $usuario->getTipo() .", '". $usuario->getNombre() ."', '". $usuario->getApellidos() ."')");

                return $result;
            }else{
                $error="Contraseñas no coinciden";
            }
        }else{
            $error="Faltan datos por rellenar";
        }
    }
}

?>
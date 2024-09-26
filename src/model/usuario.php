<?php


class Usuario {
    private String $correo;
    private int $tipo; //1 Admin, 2 Empleado, 3 Cliente.
    private String $pass;
    private String $nombre;
    private String $apellidos;
    private String $DNI;

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
}

?>
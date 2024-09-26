<?php

class Incidencias{

    private String $nIncidencia;
    private String $motivo;
    private String $solucion;
    private int $estado; //1 Trabajando en ello, 2 Pausa, 3 En Seguimiento, 4 Finalizado.
    private int $idCreador;
    private String $observaciones;

    public function getNIncidencia(): String{
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
    public function getIdCreador(): int{
        return $this->idCreador;
    }
    public function getObservaciones(): String{
        return $this->observaciones;
    }

    public function setNIncidencia(String $nIncidencia): void{
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
    public function setIdCreador(int $idCreador) {
        $this->idCreador=$idCreador;
    }
    public function setObservaciones(String $observaciones){
        $this->observaciones=$observaciones;
    }
}

?>
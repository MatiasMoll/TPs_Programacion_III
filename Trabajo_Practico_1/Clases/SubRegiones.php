<?php

include_once 'Pais.php';


class SubRegiones extends Api{

    public $nombre;
    public $lstPaises;

    public function __construct($nombre)
    {
        parent::__construct();
        $this->nombre = $nombre;
        $this->lstPaises = array(json_encode($this->apiRest->byRegion($nombre)));
    }

    public function MostrarDatos()
    {
        $salida = '';
        foreach ($this->lstPaises as $value) {
            $salida = $salida.$value.PHP_EOL;
        }       
        return $salida;
    }
}
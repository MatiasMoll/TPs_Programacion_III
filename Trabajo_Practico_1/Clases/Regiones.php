<?php

include_once 'Api.php';
require_once './Interfaces/IMostrarDetalle.php';

class Regiones extends Api implements IMostrarDetalle{

    public $nombre;
    public $lstPaises;

    public function __construct($nombre)
    {
        parent::__construct();
        $this->nombre = $nombre;
        $this->lstPaises = $this->apiRest->fields(['name'])->byRegion($nombre);
    }

    public function MostrarDetalle()
    {
        $salida = 'La lista de paises del contiente '.$this->nombre." es: ".PHP_EOL;
        for($i=0;$i<count($this->lstPaises);$i++)
        {
           $salida = $salida.$this->lstPaises[$i]->name.PHP_EOL;     
        }     
        return $salida;
    }
}
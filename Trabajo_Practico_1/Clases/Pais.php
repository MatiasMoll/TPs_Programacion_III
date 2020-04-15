<?php

include_once 'Api.php';
require_once './Interfaces/IMostrarDetalle.php';

class Pais extends Api implements IMostrarDetalle{

    public $nombre;
    public $poblacion;
    public $capital;
    
    public function __construct($nombre,$fullName = false)
    {
        parent::__construct();
        $this->nombre = $nombre;        
        $this->poblacion = $this->apiRest->fields(["population"])->byName($nombre,$fullName)[0]->population;
        $this->capital =$this->apiRest->fields(["capital"])->byName($nombre,$fullName)[0]->capital;
    }
    public  function MostrarDetalle()
    {
        return  "El pais  ".$this->nombre." cuya capital es ".$this->capital." tiene una poblacion de ".$this->poblacion;
    }
}
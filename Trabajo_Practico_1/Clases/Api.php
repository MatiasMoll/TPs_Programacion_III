<?php

ob_start();
require_once '../Interfaces/IMostrarDetalle.php';
require_once __DIR__ .'./../vendor/autoload.php';
ob_end_clean();


use NNV\RestCountries;

abstract class Api implements IMostrarDetalle{

    protected $apiRest;

    public function __construct()
    {
        if($this->apiRest == null)
        {
            $this->apiRest = new RestCountries();
        }
    }

    abstract protected function MostrarDetalle();
}

/*$pruebas = new RestCountries();
$pais = $pruebas->fields(['name'])->byName("Argentina");
var_dump($pais[0]->name);*/
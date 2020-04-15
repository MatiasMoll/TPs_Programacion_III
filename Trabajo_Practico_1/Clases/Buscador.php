<?php

require_once 'Regiones.php';
require_once 'Pais.php';
require_once 'Api.php';
require_once 'SubRegiones.php';

class Buscador extends Api{

    public function __construct()
    {
        parent::__construct();
    }
    function BuscarPorNombre($nombre){
        $pais = new Pais($nombre);
        return $pais->MostrarDetalle();
    }
    function BuscarPorRegion($nombre){
        $region = new Regiones($nombre);
        return $region->MostrarDetalle();
    }

    function BuscarPorCapital($capital){        
           
        $nombrePais = $this->apiRest->fields(['name'])->byCapitalCity($capital)[0]->name;
        $pais = new Pais($nombrePais);
        return $pais->MostrarDetalle();
    }

    function BuscarPorSubRegion($subRegion)
    {
        $subregion = new SubRegiones($subRegion);
        return $subregion->MostrarDetalle();
    }

    function BuscarPorIdioma($idioma)
    {
        $lstPaises = $this->apiRest->fields(['name'])->byLanguage($idioma);
        $salida = "Los paises con el idioma ".$idioma." son: ".PHP_EOL;
        for($i=0;$i<count($lstPaises);$i++)
        {
            $salida = $salida."- ".$lstPaises[$i]->name.PHP_EOL;
        }
        return $salida;
    }
}
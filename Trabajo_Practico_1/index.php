<?php


include_once './Clases/Buscador.php';

$buscador = new Buscador();
$hablaEspañola = $buscador->BuscarPorIdioma('ES');
$pais = $buscador->BuscarPorNombre('Argentina');
$paisPorCapital = $buscador->BuscarPorCapital('Caracas');
$region = $buscador->BuscarPorRegion('Americas');

echo $region;
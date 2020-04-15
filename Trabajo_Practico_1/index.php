<?php

include_once './Clases/Pais.php';
include_once './Clases/SubRegiones.php';

$miPais = new Pais('Argentina');
echo $miPais->MostrarDetalle();

$miContinente = new SubRegiones("Americas");
echo $miContinente->MostrarDetalle();
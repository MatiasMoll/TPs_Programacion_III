<?php

ob_start();

require_once __DIR__ .'./../vendor/autoload.php';

ob_end_clean();


use NNV\RestCountries;

abstract class Api{

    protected $apiRest;

    public function __construct()
    {
        if($this->apiRest == null)
        {
            $this->apiRest = new RestCountries();
        }
    }

}


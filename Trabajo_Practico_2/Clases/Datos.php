<?php

class Data{

    public static function Save($file,$object){

        $response = false;
        $pFile = fopen($file,'a');
        if(!is_null($pFile)){
            $rta = fwrite($pFile,serialize($object).PHP_EOL);
            if($rta > 0){
                $response = true;
            }
            fclose($pFile);
        }
        return $response;
    }

    public static function Load($file){
        $pFile = fopen($file,'r');
        $response = false;
        if(!is_null($pFile)){
            $response = array();
            while(!feof($pFile)){
                array_push($response,unserialize(fgets($pFile)));
            }           
            fclose($pFile);
            array_pop($response);
        }

        return $response;
    }

}
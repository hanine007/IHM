<?php

namespace models;

use Exception;

class Models{

    public static function GetM(string $table){
        
        $classname="models\\".ucfirst($table).'Table';
        
        if(! class_exists($classname)){
            throw new Exception($classname." doesn't exist");
        }
        else{
            return new $classname();
        }
    }


}
<?php

namespace app;

use PDO;

class DB{

    public static function connect()
    {
        return new PDO("mysql:dbname=ihm;host=127.0.0.1","root","",[
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
    }

    
}
<?php 

namespace controller;

use PDO;
use app\DB;

class Controller{

    protected PDO $pdo;
    protected array $params;

    
    public function __construct($params)
    {
        $this->pdo = DB::connect();
        $this->params=$params;
        
    }
}
<?php namespace app;

class CreateAsset{

    private $pdo;
    
    public function __construct()
    {
        $this->pdo=DB::connect();
    }

    
}
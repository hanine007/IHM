<?php 

namespace app;

class SearchData{
    
    public $budget;
    public $category;
    public $chain;
    public $reset;
    public $option;
    

    public function __construct()
    {
        $this->budget= $_GET['budget'] ?? null;
        $this->category =  $_GET['category'] ?? null;
        $this->chain =  $_GET['chain'] ?? null;
        $this->reset= $_GET["reset"] ?? null;
        $this->option= $_GET["option"] ?? null;

        
    }
}
<?php

namespace models;

use app\DB;
use models\tables\Nft;
use models\tables\Users;

class Table{

    protected $table;
    protected $pdo;

    public function __construct()
    {
        $this->pdo= DB::connect();
    }

    /* move to nft_table */
    public function byId(int $id){
        
        $query=$this->pdo->prepare("SELECT t.*,u.username,u.profile_dir FROM {$this->table} t JOIN users u ON t.id_user=u.id WHERE t.id=:id");
        $query->setFetchMode(\PDO::FETCH_CLASS,Nft::class);
        $query->execute([
            "id"=>$id
        ]);

        $nft=$query->fetchAll();
        /* dump($nft);die(); */
        return $nft[0];

        
    }
    
    /* move to nft_table */
    public function All(){
        $query=$this->pdo->query("SELECT n.*,c.name_chain,cat.name_cat FROM {$this->table} n
        JOIN users u ON n.id_user = u.id 
        JOIN chain c ON n.id_chain=c.id 
        JOIN category cat ON n.id_category=cat.id " ); 
        
        $query->setFetchMode(\PDO::FETCH_CLASS,Nft::class);
        return $results=$query->fetchAll();

    }

    public function id_specified($id){
        $query=$this->pdo->prepare("SELECT * FROM {$this->table}  WHERE id=:id");
        $query->setFetchMode(\PDO::FETCH_CLASS,Users::class);
        $query->execute([
            "id"=>$id
        ]);

        $user=$query->fetchAll();
        /* dump($nft);die(); */
        return $user[0];
    }


  
    


}
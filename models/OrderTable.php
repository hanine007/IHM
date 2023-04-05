<?php

namespace models;
use app\SearchData;
use models\tables\Commande;
use models\tables\Nft;
use PDO;

class OrderTable extends Table{

    protected $table='commande';
    protected $pdo;
    protected SearchData $data;

    public function __construct()
    {
        $this->data=new SearchData();
        parent::__construct();
    }

   
    public function add_order(array $order){
        $requete='INSERT INTO commande (id_order,id_user,id_nft,amount,payed_at) 
        VALUES(:id_order,:id_user,:id_nft,:amount,:payed_at)';
        
        $query=$this->pdo->prepare($requete);
        $success=$query->execute([
                "id_order"=>$order['orderID'],
                "id_user"=>$_SESSION['auth'],
                "id_nft"=>$order["nftID"],
                "amount"=>$order["amount"],
                "payed_at"=>$order["date"]
             


                
            ]);
        return $success;
   }

   public function get_collected(int $id){
       $query=$this->pdo->prepare('SELECT n.*,u.username from commande c JOIN nft n ON c.id_nft=n.id JOIN users u ON n.id_user=u.id WHERE c.id_user=:id_user');
       $query->execute([
           "id_user"=>$id
       ]);
       $query->setFetchMode(PDO::FETCH_CLASS,Nft::class);

       $nfts=$query->fetchALL();

       return $nfts;
   }

   public function get_collected_orders(int $id){
    $query=$this->pdo->prepare('SELECT * from commande  WHERE id_user=:id_user');
    $query->execute([
        "id_user"=>$id
    ]);
    $query->setFetchMode(PDO::FETCH_CLASS,Commande::class);

    $orders=$query->fetchALL();
    $results=[];
    foreach($orders as $order){
        $results[$order->id_nft]=$order;
    }


    return $results;
}

public function ifOwned($id_user,$id_nft){
    $query=$this->pdo->prepare('SELECT count(*) from commande  WHERE id_user=:id_user AND id_nft=:id_nft');
    $query->execute([
        "id_user"=>$id_user,
        "id_nft"=>$id_nft
    ]);
    
    $order=$query->fetch();
  
    if($order[0] == 1){
        return true;
    }else{
        return false;
    }
}





    
}
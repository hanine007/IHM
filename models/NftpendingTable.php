<?php

namespace models;
use app\SearchData;
use models\tables\Nft;

class NftpendingTable extends Table{

    protected $table='nft_pending';
    protected $pdo;
    protected SearchData $data;

    public function __construct()
    {
        $this->data=new SearchData();
        parent::__construct();
    }

   
    public function create(){
    
        $requete='INSERT INTO nft_pending (name,description,price,likes,quantity,id_user,id_category,id_chain,dir_nft) 
        VALUES(:title,:description,:price,0,:quantity,:id_user,:id_category,:id_chain,:dir_nft)';
        
        $query=$this->pdo->prepare($requete);
        $success=$query->execute([
                "title"=>$_POST["title"],
                "description"=>$_POST["description"],
                "price"=>$_POST["price"],
                "quantity"=>$_POST["qnt"],
                "id_user"=>$_SESSION['auth'],
                "id_category"=>$_POST["category"],
                "id_chain"=>$_POST["chain"],
                "dir_nft"=>$this->dir_nft()


                
            ]);
        return $success;
   }

   public function deny($id,$message){
        $query=$this->pdo->prepare('UPDATE nft_pending SET message=:message,status=:status WHERE id=:id') ;
        
      
        $action=$query->execute([
                "message"=>$message,
                "status"=>"denied",
                "id"=>$id
            ]); 
            
        return $action;
   }

   public function dashboard(){
    
        $query=$this->pdo->prepare("SELECT n.*,c.name_chain,cat.name_cat,u.username FROM {$this->table} n
        JOIN users u ON n.id_user = u.id 
        JOIN chain c ON n.id_chain=c.id 
        JOIN category cat ON n.id_category=cat.id WHERE status=:status" ); 
        $query->execute([
            "status"=>'review'
        ]);
        
        $query->setFetchMode(\PDO::FETCH_CLASS,Nft::class);
        return $results=$query->fetchAll();

    
   }

   public function get_pending($id){
        $query=$this->pdo->prepare('SELECT p.*,u.username from nft_pending p JOIN users u ON p.id_user=u.id WHERE p.id_user=:id_user AND (status=:status OR status=:statuss)');
        $query->execute([
            "id_user"=>$id,
            "status"=>"review",
            'statuss'=>"denied"

        ]);

        $query->setFetchMode(\PDO::FETCH_CLASS,Nft::class);

        $nfts=$query->fetchALL();

        return $nfts;

   }

   

   private function dir_nft():?string{
        
    if($_FILES["image"]["error"] == 4) {
        return null;
    }else{
        $filename   = uniqid() . "-" . time();
        $extension  = pathinfo( $_FILES["image"]["name"], PATHINFO_EXTENSION ); 
        $basename   = $filename . "." . $extension; 

        $source       = $_FILES["image"]["tmp_name"];
        $destination  = "./SS/images/{$basename}";

        /* move the file */
        move_uploaded_file( $source, $destination );
        return $basename;
    }
       
}

public function byIdP($id){
    $query=$this->pdo->prepare("SELECT * FROM {$this->table}  WHERE id=:id");
    $query->setFetchMode(\PDO::FETCH_CLASS,Nft::class);
    $query->execute([
        "id"=>$id
    ]);

    $nft=$query->fetchAll();
    /* dump($nft);die(); */
    return $nft[0];
}

   
   public function edit_pending($id){
    
    $requete='UPDATE nft_pending SET name=:title,description=:description,price=:price,quantity=:quantity,id_category=:id_category,id_chain=:id_chain,status=:status,message=:message';
    $execute=[
        "title"=>$_POST["title"],
        "description"=>$_POST["description"],
        "price"=>$_POST["price"],
        "quantity"=>$_POST["qnt"],
        "id_category"=>$_POST["category"],
        "id_chain"=>$_POST["chain"],
        "status"=>"review",
        "message"=>null,
        "id"=>$id
    ];

    $path=$this->dir_nft();
        
        if($path != null){
            $requete.=',dir_nft=:dir_nft WHERE id=:id';
            $execute['dir_nft']=$path;

        }else{
            $requete.=' WHERE id=:id';
        }
    
    
    $query=$this->pdo->prepare("{$requete}");

    $success=$query->execute($execute);
    
    return $success;
}







    
}
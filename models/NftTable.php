<?php

namespace models;
use app\SearchData;
use models\tables\Nft;

class NftTable extends Table{

    protected $table='nft';
    protected $pdo;
    protected SearchData $data;

    public function __construct()
    {
        $this->data=new SearchData();
        parent::__construct();
    }

    public function get_nft_home (){
        
        
        $query=$this->pdo->query('SELECT n.*,u.username,c.name_chain FROM nft n JOIN users u ON n.id_user = u.id JOIN chain c ON n.id_chain=c.id WHERE n.quantity>0 ORDER BY likes DESC LIMIT 3');
        $query->setFetchMode(\PDO::FETCH_CLASS, Nft::class);
        $result=$query->fetchAll();

        return $result;
        
    }

    public function requete():array
    {
        $requete="SELECT n.*,u.username,c.name_chain,cat.name_cat FROM nft n 
        JOIN users u ON n.id_user = u.id 
        JOIN chain c ON n.id_chain=c.id 
        JOIN category cat ON n.id_category=cat.id
        WHERE n.quantity > 0";
        
        $keys=[];
        
        /* if($data->my_creation != NULL){
            $requete.=" AND id_user = :id_user";
            $keys["id_user"]=(int)$id_user;
            return [$requete,$keys];
        } */
        
        if($this->data->option == NULL){
            $requete.=" ORDER BY likes DESC";
        }
        
        if($this->data->reset!=NULL){
            return [$requete,$keys];
        }
        if ($this->data->category==NULL && $this->data->budget==NULL && $this->data->chain==NULL && $this->data->option == NULL){
            return [$requete,$keys];
        }
        
       
        if ($this->data->budget!= NULL){
            $requete.=" AND n.price <= :budget";
            $keys["budget"]=(float)$this->data->budget;
            
        }
        if ($this->data->category != NULL){
           
            $requete.=" AND n.id_category=:category";
            $keys["category"]=(int)$this->data->category;
        }
        if($this->data->chain != NULL){
            
            $requete.=" AND n.id_chain=:chain";
            $keys["chain"]=(int)$this->data->chain;

        }

        
        if($this->data->option != NULL){
            $requete.=" ORDER BY ";
            if($this->data->option == "1"){
                $requete.=" n.price ASC"; 
               
            }elseif($this->data->option == "2"){
                $requete.=" n.price DESC";
               
            }else{
                $requete.=" n.likes DESC";
            }
        }
        /* dump($requete);die();  */
        return [$requete,$keys];

        
        


    } 
    
    public function filtered_nft():?array
    {
        $requete=$this->requete();
        /* dump($requete);die(); */  
        $query=$this->pdo->prepare($requete[0]);
        $query->setFetchMode(\PDO::FETCH_CLASS,Nft::class);
        $query->execute($requete[1]);
        $nfts=$query->fetchAll();

        if($nfts){
            return $this->by_id($nfts) ;
        }
        else{
            return NULL;
        }
        
    }

    private function by_id(array $nfts):array{
        
        $nfts_by_id=[];
        foreach($nfts as $nft){
            $nfts_by_id[$nft->id]=$nft;
        }

        return $nfts_by_id;
    }

    public function update_nblikes($id,string $liked){
        
        if($liked === 'unliked'){
            $requete="likes+1";
        }
        else{
            $requete="likes-1";
        }
        
        $query=$this->pdo->prepare("UPDATE nft SET likes= {$requete} WHERE id=:id ");
        $query->execute([
    
        "id"=>(int)$id
    
        ]);
    }

    public function get_nblikes($id){
        $query=$this->pdo->prepare("SELECT likes FROM nft WHERE id=:id ");
        $query->execute([
    
        "id"=>(int)$id
    
        ]);
        $query->setFetchMode(\PDO::FETCH_OBJ);
        $nb_likes=$query->FetchAll();

        return $nb_likes;
    }
    
    private function dir_nft():string{
        $filename   = uniqid() . "-" . time();
        $extension  = pathinfo( $_FILES["image"]["name"], PATHINFO_EXTENSION ); 
        $basename   = $filename . "." . $extension; 

        $source       = $_FILES["image"]["tmp_name"];
        $destination  = "./SS/images/{$basename}";

        /* move the file */
        move_uploaded_file( $source, $destination );
        return $basename;
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

   public function list_approved($id,$cid,$date){
    
    $query=$this->pdo->prepare( 'SELECT * FROM nft_pending WHERE id=:id ');
    $action = $query->execute([
        "id"=>$id
    ]);
    $query->setFetchMode(\PDO::FETCH_CLASS, Nft::class);
    $result=$query->fetchAll();

    
    $this->pdo->beginTransaction(); 
    
    $query=$this->pdo->prepare('INSERT INTO nft (name,description,price,quantity,likes,id_user,id_category,id_chain,dir_nft,ipfs,minted_at)
    VALUE(:name,:description,:price,:qnt,0,:id_user,:id_cat,:id_chain,:dir,:cid,:minted_at)');
    $action=$query->execute([
        "name"=>$result[0]->name,
        "description"=>$result[0]->description,
        "price"=>$result[0]->price,
        "qnt"=>$result[0]->quantity,
        "id_user"=>$result[0]->id_user,
        "id_cat"=>$result[0]->id_category,
        "id_chain"=>$result[0]->id_chain,
        "dir"=>$result[0]->dir_nft,
        "cid"=>$cid,
        "minted_at"=>$date

    ]);
    
   

    $query=$this->pdo->prepare('UPDATE nft_pending SET status=:status WHERE id=:id' );
    $query->execute([
        "id"=>$id,
        "status"=>"approved"
    ]);

    $this->pdo->commit();

    return $action;

}

public function insertIPFS($id,string $cid){
    $query=$this->pdo->prepare('INSERT INTO nft (ipfs)
    VALUE(:cid) WHERE id=:id');

    $query->execute([
        "cid"=>$cid,
        "id"=>$id
    ]);
}

public function edit($id){
    $query=$this->pdo->prepare('UPDATE nft SET name=:title,description=:description,price=:price,quantity=:quantity,id_category=:id_category,id_chain=:id_chain
    WHERE id=:id');

    $success=$query->execute([
    "title"=>$_POST["title"],
    "description"=>$_POST["description"],
    "price"=>$_POST["price"],
    "quantity"=>$_POST["qnt"],
    "id_category"=>$_POST["category"],
    "id_chain"=>$_POST["chain"],
    "id"=>$id]);
    return $success;
}

public function get_created($id){
    
        $query=$this->pdo->prepare('SELECT n.*,u.username from nft n JOIN users u ON n.id_user=u.id WHERE n.id_user=:id_user');
        $query->execute([
            "id_user"=>$id
        ]);
 
        $query->setFetchMode(\PDO::FETCH_CLASS,Nft::class);
 
        $nfts=$query->fetchALL();
 
        return $nfts;
    
}

public function update_quantity($id){
        
    $query=$this->pdo->prepare("UPDATE nft SET quantity= quantity-1 WHERE id=:id ");
    $query->execute([

    "id"=>(int)$id

    ]);
}





    
}
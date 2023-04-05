<?php 

namespace models;

use models\tables\Liked_nft;
use models\tables\Nft;

class Liked_nftTable extends Table{

    protected $table='liked_nft';
    protected $pdo;
    
    public function __construct()
    {
        parent::__construct();
    }

    public function liked_nft(){

        $query=$this->pdo->prepare('SELECT * from liked_nft where id_user=:id_user ');
        $query->execute([
            "id_user"=>$_SESSION['auth'],
            
        ]);

        $query->setFetchMode(\PDO::FETCH_CLASS, Liked_nft::class);
        $all_liked=$query->fetchAll();

        return $all_liked;
    }

    public function like_dislike($id, string $liked){
        
        /* $id=explode('-',$_GET['fav']); */
        
        if($liked === 'unliked'){
            $requete='INSERT INTO liked_nft (id_user,id_nft) VALUES( :id_user,:id_nft)';
        }else{
            $requete='DELETE FROM liked_nft WHERE id_user=:id_user AND id_nft=:id_nft';
        }
       
        $query=$this->pdo->prepare("{$requete}");
        
        $query->execute([
        "id_user"=>$_SESSION['auth'],
        "id_nft"=>(int)$id
        ]);

    }

    public function if_liked(int $id):string{
        
        $query=$this->pdo->prepare('SELECT count(*) as nb from liked_nft WHERE id_nft=:id_nft AND id_user=:id_user');
        $query->execute([
            "id_user"=>$_SESSION['auth'],
            "id_nft"=>$id
        ]);
        
        $result=$query->fetch(\PDO::FETCH_ASSOC);
        
        
        if($result['nb'] == 1){
            return 'liked';
        }else{
            return 'unliked';
        }
    }

    public function get_favorited(){

        $query=$this->pdo->prepare('SELECT n.*,u.username from liked_nft l JOIN nft n ON l.id_nft=n.id JOIN users u ON n.id_user=u.id  where l.id_user=:id_user ');
        $query->execute([
            "id_user"=>$_SESSION['auth'],
            
        ]);

        $query->setFetchMode(\PDO::FETCH_CLASS, Nft::class);
        $all_liked=$query->fetchAll();

        return $all_liked;
    }
   

    
}
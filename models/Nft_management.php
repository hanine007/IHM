<?php

use app\SearchData;

require('Nft.php');


class Nft_management{
    public PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo=$pdo;
    }
    
    
    
    
    private function requete(SearchData $data):array
    {
        $requete='SELECT * FROM nft WHERE quantity > 0';
        
        $keys=[];
        
        /* if($data->my_creation != NULL){
            $requete.=" AND id_user = :id_user";
            $keys["id_user"]=(int)$id_user;
            return [$requete,$keys];
        } */
        
        if($data->reset!=NULL){
            return [$requete,$keys];
        }
        if ($data->category==NULL && $data->budget==NULL && $data->chain==NULL){
            return [$requete,$keys];
        }
        
       
        if ($data->budget!= NULL){
            $requete.=" AND price <= :budget";
            $keys["budget"]=(float)$data->budget;
            
        }
        if ($data->category != NULL){
           
            $requete.=" AND id_category=:category";
            $keys["category"]=(int)$data->category;
        }
        if($data->chain != NULL){
            
            $requete.=" AND id_chain=:chain";
            $keys["chain"]=(int)$data->chain;

        }
        return [$requete,$keys];

        
        


    } 
    
    public function filtered_nft(array $requete)
    {
        $requete=$this->requete(new SearchData());
        $query=$this->pdo->prepare($requete[0]);
        $query->setFetchMode(PDO::FETCH_CLASS, "Nft");
        $query->execute($requete[1]);
        $nft=$query->fetchAll();

        if($nft){
            return $nft;
        }
        else{
            return NULL;
        }
        
    }

    public function getusername(Nft $nft){
        
        $query=$this->pdo->prepare('SELECT username from users WHERE id=:id');
        $query->execute([
            "id"=>$nft->id_user
        ]);
        $nft=$query->fetch();
        return $nft->username;

    }
    
    public function getchain(Nft $nft):string{
        if ($nft->id_chain == 1){
            return "fa-brands fa-ethereum";
        }
        else{
            return "fa-brands fa-btc";
        }
        

    }
    
    public function getcatname(Nft $nft):string{
        
        if ($nft->id_category == 1){
            return "Art";
        }
        elseif($nft->id_category == 2){
            return "Photography";
        }
        elseif($nft->id_category == 3){
            return "Music";

        }
        else{
            return "Sport";

        }
        

    }

    public function get_url(array $data,Nft $nft,int $id):array{
       
        if(isset($_GET["reset"])){
            unset($data["reset"]);
        }
        if(isset($_GET["file"])){
            unset($data["file"]);
        }
        if(isset($_GET["idnft"])){
            unset($data["idnft"]);
        }
        $array=[];
        if(!isset($_SESSION["username"])){
            $array["action"]="forbidden";
            $icon="regular";
        }
        else{
            
                $query=$this->pdo->prepare('SELECT COUNT(*) as count from liked_nft WHERE id_user=:id_user AND id_nft=:id_nft');
                $query->execute([
                "id_user"=>$id,
                "id_nft"=>$nft->id
        
                ]);
                $liked=$query->fetch(PDO::FETCH_ASSOC);
        
                if($liked['count']=='1'){
                    $array["favorite"]="dislike";
                    $array["id"]=$nft->id;
                    $icon="solid";
                    
                }
                else{
                    $array["favorite"]="like";
                    $array["id"]=$nft->id;
                    $icon="regular";
                    
        
                }
                
                
            
          

        }
        $url=http_build_query(array_merge($data,$array));
        
        return [$url,$icon];
    }

    
    
    
    public function favorite_insert_delete(int $id){
        
      
        if (isset($_GET["id"]) && $_GET["favorite"]=="like"){
            $query=$this->pdo->prepare('INSERT INTO liked_nft (id_user,id_nft) VALUES( :id_user,:id_nft)');
            $query->execute([
            "id_user"=>$id,
            "id_nft"=>(int)$_GET["id"]
            
            ]);
            $query=$this->pdo->prepare('UPDATE nft SET likes=likes+1 WHERE id=:id ');
            $query->execute([
            
                "id"=>(int)$_GET["id"]
            
            ]);

        }
        elseif(isset($_GET["id"]) && $_GET["favorite"]=="dislike"){
            $query=$this->pdo->prepare('DELETE FROM liked_nft WHERE id_user=:id_user AND id_nft=:id_nft');
            $query->execute([
            "id_user"=>$id,
            "id_nft"=>(int)$_GET["id"]
            
            ]);
            $query=$this->pdo->prepare('UPDATE nft SET likes=likes-1 WHERE id=:id ');
            $query->execute([
            
                "id"=>(int)$_GET["id"]
            
            ]);

        }
    }

  
    public function get_id_user(){
        
        
        if (isset($_SESSION["username"])){
            $query=$this->pdo->prepare('SELECT id from users WHERE username = :username');
            $query->execute([
            "username"=>$_SESSION["username"]
            ]);

            $result=$query->fetch();

            return $result->id;
            

        }
        else{
            return NULL;
        }
    }

    
    public function get_nft_home (){
        
        
            $query=$this->pdo->query('SELECT * from nft WHERE quantity>0 LIMIT 3');
            $query->setFetchMode(PDO::FETCH_CLASS, "Nft");
            $result=$query->fetchAll();

            return $result;
            
    }

    public function download_bought_nft(){
        if(!empty($_GET['download'])){
            $filename = basename($_GET['download']);
            $filepath = '../images/' . $filename;
            if(!empty($filename) && file_exists($filepath)){
        
        
                header("Cache-Control: public");
                header("Content-Description: FIle Transfer");
                header("Content-Disposition: attachment; filename=$filename");
                header("Content-Type: application/zip");
                header("Content-Transfer-Emcoding: binary");
        
                readfile($filepath);
                /* exit; */
                
            }
            else{
                echo "This File Does not exist.";
            }

        }
        
    }

    public function add_minus_quantity($id):string{
        
        if(isset($_GET['file'])){
            
            $query=$this->pdo->prepare('SELECT 1 FROM nft WHERE id_user=:id_user AND id=:id');
            $query->execute([
                "id_user"=>$id,
                "id"=>$_GET['idnft']
            ]);
            $result=$query->fetch();
            if(empty($result)){
                    $query=$this->pdo->prepare('SELECT 1 FROM bought_nft WHERE id_user=:id_user AND id_nft=:id_nft');
                    $query->execute([
                        "id_user"=>$id,
                        "id_nft"=>$_GET['idnft']
                    ]);
                    $result=$query->fetch();
                    
                    if(empty($result)){
                        $query=$this->pdo->prepare('UPDATE nft SET quantity=quantity-1 WHERE dir_nft=:dir_nft');
                        $query->execute([
                            "dir_nft"=>$_GET["file"]
                        ]);
                        $query=$this->pdo->prepare('INSERT INTO bought_nft (id_user,id_nft) VALUES( :id_user,:id_nft)');
                        $query->execute([
                            "id_user"=>$id,
                            "id_nft"=>$_GET['idnft']
                            
                        ]);
                        return "success";

                    }
                    else{
                        return "owned";
                    }

            }
            else{
                return "self";
            }
            
            
            

        }
    }

    public function join_bought_nft($id){
        
            $query=$this->pdo->prepare('SELECT * FROM bought_nft JOIN nft ON  bought_nft.id_nft = nft.id WHERE bought_nft.id_user= :id_user');
            $query->execute([
                "id_user"=>$id,
                
            ]);
            $query->setFetchMode(PDO::FETCH_CLASS, "Nft");
            $result=$query->fetchALL();
            return $result;
        
    }

    

    



}

?>
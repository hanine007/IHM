<?php

namespace models\tables;

use app\ConvertETH;

class Nft{
    
    public int $id;
    public string $name;
    public string $description;
    public float $price;
    public int $quantity;
    public int $likes;
    public int $id_user;
    public int $id_category;
    public int $id_chain;
    public string $dir_nft;
    public string $ipfs;
    public string $username;
    public string $profile_dir;
    public string $name_chaine;
    public string $name_cat;
    public string $fav='unliked';
    public string $status;
    public ?string $message;
    public ?string $minted_at; 

    public function GetClass():string{
        if ($this->id_chain == 1){
            return "fa-brands fa-ethereum";
        }
        else{
            return "fa-brands fa-btc";
        }
    }

    public function GetClassCat():string{
        if ($this->id_category == 1){
            return "fa-solid fa-palette";
        }
        elseif($this->id_category == 2){
            return "fa-solid fa-camera";
        }elseif($this->id_category == 3){
            return "fa-solid fa-music";
        }else{
            return "fa-solid fa-futbol";
        }
    }

    public function GetLikeClass(array $options):string
    {
        
        
        if(empty($options)){
            return 'regular';
        }else{
            if(array_key_exists($this->id,$options)){
            
                return 'solid';
            }else{
               
                return 'regular';
            }
        }
      
        
    }

    public function GetButton($router,$status){
        if($status == true){
            return <<<HTML
            <a href="#"  class="buttonDownload ">Owned</a>
        HTML;
        }
        
        if(!isset($_SESSION['auth'])){
            return <<<HTML
                <a href="{$router->url('login')}"  class="buttonDownload popup-btn">Buy</a>
            HTML;
          
        }else{
            if((int)$_SESSION['auth']==$this->id_user){
                return <<<HTML
                <a href="{$router->url('edit_asset',['id'=>$this->id,'creator'=>'@'.$this->username])}"  class="buttonDownload">Edit</a>
            HTML;
                
            }else{
                return <<<HTML
                <a href="#"  class="buttonDownload popup-btn">Buy</a>
            HTML;
                
            }   
        }
    }

    public function InUSD(){
        $converter=new ConvertETH();
        $converted=round($converter->ETH_TO_USD($this->price),2) ;

        return $converted;
    }

   
    
}


?>
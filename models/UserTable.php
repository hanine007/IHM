<?php

namespace models;
use app\SearchData;
use models\tables\Nft;
use models\tables\Users;

class UserTable extends Table{

    protected $table='users';
    protected $pdo;
    protected SearchData $data;

    public function __construct()
    {
        $this->data=new SearchData();
        parent::__construct();
    }

   


   public function exist_user(){
       $query=$this->pdo->prepare('SELECT * from users WHERE username=:username OR email=:email');

       $query->execute([
           "username"=>$_POST['username'],
           "email"=>$_POST['email'],
           
       ]);

       $query->setFetchMode(\PDO::FETCH_CLASS,Users::class);

       return $user=$query->fetchAll();
   }

   
   private function dir_profile():?string{
        
    if($_FILES["image"]["error"] == 4) {
        return null;
    }else{
        $filename   = uniqid() . "-" . time();
        $extension  = pathinfo( $_FILES["image"]["name"], PATHINFO_EXTENSION ); 
        $basename   = $filename . "." . $extension; 

        $source       = $_FILES["image"]["tmp_name"];
        $destination  = "./SS/images/profileImg/{$basename}";

        /* move the file */
        move_uploaded_file( $source, $destination );
        return $basename;
    }
       
}
   
   public function edit_user($id,$password){
       
    
        $requete='UPDATE users SET email=:email,username=:username,password=:password';
        
        $execute=["username"=>$_POST['username'],
        "email"=>$_POST['email'],
        "id"=>$id,
        "password"=>$password];
        
        $path=$this->dir_profile();
        
        if($path != null){
            $requete.=',profile_dir=:profile_dir WHERE id=:id';
            $execute['profile_dir']=$path;

        }else{
            $requete.=' WHERE id=:id';
        }
        
        $query=$this->pdo->prepare("{$requete}");
        $action =$query->execute($execute);

        return $action;
   }





    
}
<?php 

namespace controller;

use app\Renderer;
use models\Models;
use app\Redirection;
use app\Validators\Assetvalidator;
use app\Validators\Profilvalidator;

class UsersController extends Controller{

   
    
    public function __construct($params)
    {
       parent::__construct($params);
    }

    public function login(){
        $redirection=new Redirection();
        $redirection->redirectAlreadyConnected();
        Renderer::GetView('users/login/login')->render();
    }

    public function register(){
        $redirection=new Redirection();
        $redirection->redirectAlreadyConnected();
        Renderer::GetView('users/register/register')->render();
    }

    public function logout(){
        
        Renderer::GetView('users/logout/logout')->render();
    }

    public function edit(){
        $redirection=new Redirection();
        $redirection->redirectLogin();
        
        $id_current=$_SESSION['auth'];
        $errors=[];
        $success=null;
        $userTable=Models::GetM('user');
        $current_user=$userTable->id_specified($id_current);
        


        if(isset($_POST['submit'])){
            
            if($_POST['password']==""){
                $password=$current_user->password;
            }else{
                if($_POST['password_confirm']==""){
                    $password=$current_user->password;
                    array_push($errors, "confirmation requise");
                }else{
                    if($_POST['password']==$_POST['password_confirm']){
                        $password=md5($_POST['password']);
                    }else{
                        $password=$current_user->password;
                        array_push($errors, "password doesn't match");
                    }
                }
            }
            $v=new Profilvalidator($_POST);
            if(empty($errors)){
                if($v->validate()){
                    $other_user=$userTable->exist_user();
               
                    if(!empty($other_user) && ($other_user[0]->id != $id_current) ){
                        /* dump($other_user);die(); */
                        if($other_user[0]->email == $_POST['email']){
                            array_push($errors, "email existe déja");
                        }
                        if($other_user[0]->username == $_POST['username']){
                            array_push($errors, "username existe déja");
                        }
                    }else{
                        
                        $success=$userTable->edit_user($id_current,$password);
                        $current_user=$userTable->id_specified($id_current);
                    }
                }else{
                    
                    foreach($v->errors() as $error){
                        foreach($error as $er){
                           array_push($errors,$er ); 
                        }
                    }
                   
                }
            }
            
           
        }
        Renderer::GetView('users/edit/sett',compact("success","current_user",'errors'))->render();
    }

    public function account(){
        $redirection=new Redirection();
        $redirection->redirectLogin();
        
        $nftTable=Models::GetM('nft');
        $orderTable=Models::GetM('order');
        $nftpendingTable=Models::GetM('nftpending');
        $likednftTable=Models::GetM('liked_nft');
        $id_user=$_SESSION['auth'];
        $userTable=Models::GetM('user');
        $current_user=$userTable->id_specified($id_user);
        
        $message=null;
        
        $options=[];
        $orders=null;
        
        $liked_nfts=$likednftTable->liked_nft();
            
        foreach($liked_nfts as $liked_nft){
            $options[$liked_nft->id_nft]="liked";
        }  
        
        
        if(isset($_GET['tab'])){
           if($_GET['tab']=='collected'){
                $nfts=$orderTable->get_collected($id_user);
                $orders=$orderTable->get_collected_orders($id_user);
           }elseif($_GET['tab']=='created'){
                $nfts=$nftTable->get_created($id_user);
           }elseif($_GET['tab']=='favorited'){
                $nfts=$likednftTable->get_favorited($id_user);
           }elseif($_GET['tab']=='pending'){
                $nfts=$nftpendingTable->get_pending($id_user);
           }
       }else{
            $nfts=$nftTable->get_created($id_user);
       }

       if(empty($nfts)){
           $message="no results found";
           $nb_items=0;
       }else{
            $nb_items=count($nfts);
       }
       Renderer::GetView('users/account/myaccount',compact("message","nfts","options","nb_items","orders",'current_user'))->render();
        
    }

    public function deny_access(){
        Renderer::GetView('users/access_denied/access_denied')->render();
    }
}
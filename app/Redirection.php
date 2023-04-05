<?php
namespace app;

use app\Routing;
use app\auth\Auth;

class Redirection{
    
    private $router;
    
    

    public function __construct()
    {
        $this->router=Routing::GetRouting();
       

    }

    public function redirectLogin(){
        if(! Auth::is_connected()){
            header('location:'.$this->router->url('login'));
            exit();
        }
        
    }

    public function redirectDeniedAdmin($user){
       
            if($user->isAdmin == FALSE){
                header('location:'.$this->router->url('deny_access'),true,403);
                exit();
            }
        
    }

    public function redirectDeniedAction($user,$creator){
        if($user->username != $creator){
            header('location:'.$this->router->url('deny_access'),true,403);
            exit();
        }
    }

    public function redirect404($nft,$creator){
        if($nft->username != $creator){
            header('location:'.$this->router->url('deny_access'),true,404);
            exit();
        }
    }

    public function redirectInvalidRoute(){
        header('location:'.$this->router->url('deny_access'),true,404);
        exit();
    }

    public function redirectAlreadyConnected(){
        if( Auth::is_connected()){
            header('location:'.$this->router->url('home'));
            exit();
        }
    }


}
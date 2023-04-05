<?php

namespace app;

use app\auth\Auth;

class Renderer{

    private string $view;
    private ?array $data;
    public function __construct(string $view,?array $data)
    {
       $this->view=$view;
       $this->data=$data; 
    }
    
    public function render(){

       
        
        
        ob_start(); 
        $router=Routing::GetRouting();
        if($this->data != null){
            extract($this->data);
        }
     
        require(dirname(__DIR__)."/views/contents/".$this->view.'.php');
        $content=ob_get_clean();
        require($this->GetLayout());
 
   
    }

    public function renderProducts(){

        ob_start(); 
        $router=Routing::GetRouting();
        extract($this->data);
        require(dirname(__DIR__)."/views/contents/".$this->view.'.php');
        $content=ob_get_clean();
        return $content;
      
    }

    public static function GetView(string $view,?array $data=null):Renderer{
        return new static($view,$data);
    }

    private function GetLayout(){
        
        if($this->view == 'admin/admin' || $this->view == 'users/login/login' || $this->view == 'users/register/register'){
            return $layouts='../views/layouts/nolayout.php';
        }
        
        if(Auth::is_connected()){
            if($this->view == 'home/index'){
                $layouts="../views/layouts/logged-full.php";
            }else{
                $layouts="../views/layouts/logged.php";
            }
            
        }else{
            if($this->view == 'home/index'){
                $layouts="../views/layouts/default-full.php";
            }else{
                $layouts="../views/layouts/default.php";
            }
            
        }
        
        return $layouts;
    } 

}
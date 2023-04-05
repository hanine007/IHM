<?php

namespace app;

use Exception;

use AltoRouter;
use app\Redirection;

class Routing {

    private static $_instance=null;
    private AltoRouter $router;
    
    public function __construct()
    {
        $this->router=new AltoRouter();
    }

    public static function GetRouting(){
        if(self::$_instance == null){
            self::$_instance = new Routing();
        }

        return self::$_instance;
    }

    public function registerG(string $route,array $controller,string $alias){
        $this->router->map('GET',$route,$controller,$alias);

        return $this;
    }

    public function registerP(string $route,array $controller,string $alias){
        $this->router->map('POST',$route,$controller,$alias);

        return $this;
    }

    public function registerPG(string $route,array $controller,string $alias){
        $this->router->map('GET|POST',$route,$controller,$alias);

        return $this;
    }

    public function run(){
        
        $uri=$this->router->match();
       
        if($uri == null){
            $redirection = new Redirection();
            $redirection->redirectInvalidRoute();
        }
        
        $params=$uri['params'];
        
        
        [$classname,$method]=$uri['target'];
       
        if(class_exists($classname) && method_exists($classname,$method)){
            
            $controller= new $classname($params);
            
            return $controller->$method();

        }else{
            throw new Exception($classname." doesn't exists");
        }

        


    }

    public function url(string $alias,array $params=[]){
        return $this->router->generate($alias,$params);
    }



}
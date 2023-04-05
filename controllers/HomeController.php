<?php 

namespace controller;

use app\Renderer;
use models\Models;

class HomeController extends Controller{

   
    
    public function __construct($params)
    {
       parent::__construct($params);
    }

    public function index(){
        
        $table = Models::GetM('nft');
        $nfts=$table->get_nft_home();
        
        Renderer::GetView('home/index',compact("nfts"))->render();
    }
    public function FAQ(){
        
    
        
        Renderer::GetView('home/FAQ')->render();
    }
    public function contact(){
        
        $table = Models::GetM('nft');
        $nfts=$table->get_nft_home();
        
        Renderer::GetView('home/contact')->render();
    }
}
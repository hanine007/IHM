<?php 

namespace controller;

use Exception;
use app\NftIPFS;
use app\Renderer;
use models\Models;
use app\SearchData;
use app\Redirection;
use app\Validators\Assetvalidator;



class AdminController extends Controller{

    
    
    public function __construct($params)
    {
        parent::__construct($params);
    }

    public function index(){
        
        $redirection=new Redirection();
        $redirection->redirectLogin();
        
        $id_user=$_SESSION['auth'];
        $userTable=Models::GetM('user');
        $current_user=$userTable->id_specified($id_user);

      

        $redirection->redirectDeniedAdmin($current_user);
                    
        
        $tableNftpending=Models::GetM('nftpending');

        $nfts=$tableNftpending->dashboard();
        /* dump($nfts);die(); */
        Renderer::GetView('admin/admin',compact("nfts"))->render();
    }

    public function approve(){
        
        $id=$this->params['id'];
        $tableNft=Models::GetM('nft');

        $tableNftpending=Models::GetM('nftpending');
        $nft=$tableNftpending->byId($id);
        
        $ipfs=new NftIPFS();
        $response = $ipfs->store($nft->dir_nft);
        
        foreach (json_decode($response) as $value){
            $array[]=$value;
        };
        
        $date=explode('T',$array[1]->created)[0];
        
        $action=$tableNft->list_approved($id,$array[1]->cid,$date);
        
        Renderer::GetView('admin/approve/approve',compact("action"))->render();
    }

    public function deny(){
        
        $id=$this->params['id'];
        $message=$_POST['message'];
        
        $tableNftpending=Models::GetM('nftpending');
        $action=$tableNftpending->deny($id,$message);
        
        Renderer::GetView('admin/deny/deny',compact("action"))->render();
    }

/*     public function viewPending(){
        $id=$this->params['id'];
        
        $tableNftpending=Models::GetM('nftpending');

        $nft=$tableNftpending->byId($id);
        Renderer::GetView('admin/view/view-asset',compact("nft"))->render();
    } */

   

  
}
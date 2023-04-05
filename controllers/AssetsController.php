<?php 

namespace controller;

use app\auth\Auth;
use Exception;
use app\NftIPFS;
use app\Renderer;
use models\Models;
use app\SearchData;
use app\Redirection;
use app\Validators\Assetvalidator;



class AssetsController extends Controller{

    
    
    public function __construct($params)
    {
        parent::__construct($params);
    }

    public function index(){
        
     
        $tableNft=Models::GetM('nft');
        $tableLikedNft=Models::GetM('liked_nft');
        
       /*  if(isset($_GET['fav'])){
            [$action,$id]=explode("-", $_GET['fav']);
            
            $tableLikedNft->like_dislike($id,$action);
            $tableNft->update_nblikes($id,$action);
        } */
        
        
     
        $nfts=$tableNft->filtered_nft();
        $nb_items=0;
        if($nfts != null){
            $nb_items=count($nfts);
        }
        
        $options=[];
       
        if(isset($_SESSION['auth'])){
            $liked_nfts=$tableLikedNft->liked_nft();
            
            foreach($liked_nfts as $liked_nft){
                $options[$liked_nft->id_nft]="liked";
            }  
        }
        


        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) 
        && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
        && isset($_GET['ajax'])) 
        {
            $content=Renderer::GetView('assets/index/products_V2',compact("nfts","options"))->renderProducts(); 
            
            $send=["content"=>$content,"nb_items"=>$nb_items];
           
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($send);

        }else{
            Renderer::GetView('assets/index/index_V2',compact("nfts","options","nb_items"))->render();
        }
        
        

        
    }

    public function like(){
        
        if(! Auth::is_connected()){
            $send=["count"=>'not'];
            echo json_encode($send);
        }else{
            $json = file_get_contents('php://input');
            $data = json_decode($json);
            $id=(int)$data->id;
            
            
            $tableNft=Models::GetM('nft');
            $tableLikedNft=Models::GetM('liked_nft');
    
            $if_liked=$tableLikedNft->if_liked($id);
            
            $tableLikedNft->like_dislike($id,$if_liked);
            $tableNft->update_nblikes($id,$if_liked);
    
            $nblikes=$tableNft->get_nblikes($id);
            
            $send=["count"=>$nblikes[0]->likes];
            
           /*  header('Content-Type: application/json; charset=utf-8'); */
            echo json_encode($send);
        }
        
       
    }

    public function buy(){
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        
        $orderID=$data->orderID; 
        $nftID= $data->nftID;
        $amount=$data->amount;
        $date=explode('T',$data->date)[0] ;

        $order=["nftID"=>$nftID,"orderID"=>$orderID,"amount"=>$amount,"date"=>$date];
        $tableOrder=Models::GetM('order');
        $success=$tableOrder->add_order($order);
        
        $tableNft=Models::GetM('nft');
        $tableNft->update_quantity($nftID);

        $send=["success"=>$success];
        echo json_encode($send); 

    }

    public function create(){
        
        $redirection=new Redirection();
        $redirection->redirectLogin();
        
        $success=null;
        $errors=null;
        
        $v=new Assetvalidator($_POST);
        if(isset($_POST["submit"])){
            if($v->validate()){
                $tableNft=Models::GetM('nft');
                if($tableNft->create()){
                    $success=true;
                }else{
                    $success=false;
                }
            }else{
                $errors=$v->errors();
                if(!file_exists($_FILES['image']['tmp_name']) || !is_uploaded_file($_FILES['image']['tmp_name'])) {
                   $errors['file']=["asset necessaire"];
                }
                
            }
        }
        
        
        Renderer::GetView('assets/create/upload',compact('errors','success'))->render();
    }

   /*  public function IPFS(){
        
        $ipfs=new NftIPFS();
        $response = $ipfs->store("3_191_china_02.jpg");
        Renderer::GetView('test/test',compact('response'))->render();
    } */

    public function single_asset(){
        $id=$this->params['id'];
        $status=null;
        if(isset($_SESSION['auth'])){
            $tableOrder=Models::GetM('order');
            $status=$tableOrder->ifOwned((int)$_SESSION['auth'],$id);
           
        }
        
        
        $tableNft=Models::GetM('nft');

        $nft=$tableNft->byId($id);
        Renderer::GetView('assets/single-asset/single-asset',compact("nft","status"))->render();
    
    }

    public function edit(){
        
        $id=$this->params['id'];
        $tableNft=Models::GetM('nft');
        $nft=$tableNft->byId($id);
        
        $redirection=new Redirection();
        $redirection->redirectLogin();
        $id_user=$_SESSION['auth'];
        $creator= str_replace('@','',$this->params['creator']) ;
        $userTable=Models::GetM('user');
        $current_user=$userTable->id_specified($id_user);
        $redirection->redirectDeniedAction($current_user,$creator);
      
        $redirection->redirect404($nft,$creator);
        
        
        $success=null;
        $errors=null;
        
        
       
        $v=new Assetvalidator($_POST);
        if(isset($_POST["submit"])){
            if($v->validate()){
                $tableNft=Models::GetM('nft');
                if($tableNft->edit($id)){
                    $success=true;
                }else{
                    $success=false;
                }
            }else{
                $errors=$v->errors();
                
                
            }
        }
        $tableNft=Models::GetM('nft');
        $nft=$tableNft->byId($id);
        
        
        Renderer::GetView('assets/edit/edit',compact("nft",'errors','success'))->render();
    }

    public function edit_denied(){
        
        $id=$this->params['id'];
        $tableNft=Models::GetM('nftpending');
        $nft=$tableNft->byId($id);
        
        $redirection=new Redirection();
        $redirection->redirectLogin();
        $id_user=$_SESSION['auth'];
        $creator= str_replace('@','',$this->params['creator']) ;
        $userTable=Models::GetM('user');
        $current_user=$userTable->id_specified($id_user);
        $redirection->redirectDeniedAction($current_user,$creator);
        $redirection->redirect404($nft,$creator);
        
        $success=null;
        $errors=null;
        
        

       $v=new Assetvalidator($_POST);
        if(isset($_POST["submit"])){
            if($v->validate()){
                $tableNft=Models::GetM('nftpending');
                if($tableNft->edit_pending($id)){
                    $success=true;
                }else{
                    $success=false;
                }
            }else{
                $errors=$v->errors();
                
                
            }
        }
        $tableNft=Models::GetM('nftpending');
        $nft=$tableNft->byId($id);
        
        
        Renderer::GetView('assets/edit_pending/edit_pending',compact("nft",'errors','success'))->render();
    }

    public function viewPending(){
        $id=$this->params['id'];
        $tableNft=Models::GetM('nftpending');
        $nft=$tableNft->byId($id);
        
        $redirection=new Redirection();
        $redirection->redirectLogin();
        $id_user=$_SESSION['auth'];
        $creator= str_replace('@','',$this->params['creator']) ;
        $userTable=Models::GetM('user');
        $current_user=$userTable->id_specified($id_user);
        if($current_user->isAdmin == false){
            $redirection->redirectDeniedAction($current_user,$creator);
        }
       
        $redirection->redirect404($nft,$creator);
        
        Renderer::GetView('assets/view_pending/view-asset',compact("nft","current_user"))->render();
    }


  
}
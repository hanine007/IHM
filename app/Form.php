<?php

namespace app;

use models\tables\Nft;
use models\tables\Commande;

class Form{
    

    public static function errorsHTML(string $champ,?array $errors=null){
        $htmlE=[];
        if(isset($errors[$champ])){
                    
            foreach($errors[$champ] as $error){
                $htmlE[]="<p style='color:red;'>{$error}</p>";
            }
        }
        return implode('',$htmlE);
    }

    public static function GetStyle(string $champ,?array $errors=null){
        if(isset($errors[$champ])){return "border-color:red;";}
    }

    public static function get_html_add( ?bool $message=null){
        if($message != null){
            if($message == false ){
                return <<<HTML
                        <div class="audun_warn">
                            <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                            unknown erreur 
                        </div>
                    HTML;
            }
            elseif($message == true ){
                return <<<HTML
                        <div class="audun_success">
                            <i class="fa fa-check-circle" aria-hidden="true"></i>
                            votre nft a été ajouté avec succée
                        </div>
                    HTML;

            }
        }
      
       
    }

    public static function get_html_add2( ?string $message=null){
        if($message != null){
            if($message == 'failed' ){
                return <<<HTML
                        <div class="audun_warn">
                            <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                            unknown erreur 
                        </div>
                    HTML;
            }
            elseif($message == 'success'){
                return <<<HTML
                        <div class="audun_success">
                            <i class="fa fa-check-circle" aria-hidden="true"></i>
                            operation executé avec success
                        </div>
                    HTML;

            }
        }
      
       
    }

    public static function checked($value,int $cat){
        if($cat==$value){
            return "checked";
        }else{
            return null;
        }
    } 

    public static function selected($value,int $chain){
        if($chain==$value){
            return "selected";
        }else{
            return null;
        }
    } 

    public static function popup_infos(?Nft $nft,?Commande $order,$router){
        
        if(isset($_GET['tab'])){
            if($_GET['tab']=='collected'){
                return <<<HTML
                <div class="info" id="thank-you" style="align-items:center;align-content:center;">
                                                
                    <span style="font-size:25px;color:white;margin-bottom:15px;"><strong>Order:</strong> $order->id_order</span>
                    <span style="font-size:25px;color:white;margin-bottom:15px;"><strong> Total payed:</strong> $order->amount</span>
                    <span style="font-size:25px;color:white;margin-bottom:15px;"><strong>Payed At:</strong> $order->payed_at</span>
                    <span style="font-size:25px;color:white;margin-bottom:15px;"><strong> Payement Method:</strong> Paypal</span>
                                                
                                                
                                            
                </div>
            HTML;
            }elseif($_GET['tab']=='pending'){
                if($nft->status == "review"){
                    return <<<HTML
                <div class="info" id="thank-you" style="align-items:center;align-content:center;">
                                                
                    <span style="font-size:25px;color:white;margin-bottom:30px;"><strong>Status:</strong>"Under Review"</span>
                    <p style="font-size:16px;color:white;text-align:center;font-style:italic;">"Please be patient until one of our admins review your artwork"</p>
                    
                                                
                                                
                                            
                </div>
            HTML;
                }else{
                    return <<<HTML
                <div class="info" id="thank-you" style="align-items:center;align-content:center;">
                                                
                    <span style="font-size:25px;color:white;margin-bottom:30px;"><strong>Status:</strong>"Denied"</span>
                    <span style="font-size:25px;color:white;margin-bottom:10px;"><strong>Motif:</strong></span>
                    <p style="font-size:16px;color:white;text-align:center;font-style:italic;margin-bottom:30px;color:red;">"$nft->message"</p>
                    <a href="{$router->url('edit_denied',['id'=>$nft->id,'creator'=>'@'.$nft->username])}" style="background-color:blue;padding:20px;">Re-soumettre</a>
                                                
                                                
                                            
                </div>
            HTML;
                }
                 
            }
        }else{
            return null; 
        }
        
    }

    public static function  more_options($router,$nft){
        if(isset($_GET['tab'])){
            if($_GET['tab']=='collected'){
                return <<<HTML
                            <a href="https://{$nft->ipfs}.ipfs.nftstorage.link" style="color:white;">View IPFS</a>
                            <a href="#"  class="popup-btn" style="color:white;">View Order</a>
                            <a href="{$router->url('single_asset',['id'=>$nft->id,'creator'=>'@'.$nft->username])}" style="color:white;" target="_blank">View Details</a> 
                HTML;
            }elseif($_GET['tab']=='created'){
                return <<<HTML
                            <a href="{$router->url('edit_asset',['id'=>$nft->id,'creator'=>'@'.$nft->username])}" style="color:white;">Edit</a>
                            <a href="https://{$nft->ipfs}.ipfs.nftstorage.link" style="color:white;">View IPFS</a>
                            <a href="{$router->url('single_asset',['id'=>$nft->id,'creator'=>'@'.$nft->username])}" style="color:white;" target="_blank">View Details</a> 
                HTML;
            }elseif($_GET['tab']=='favorited'){
                  return <<<HTML
                            <a href="https://{$nft->ipfs}.ipfs.nftstorage.link" style="color:white;">View IPFS</a>
                            <a href="{$router->url('single_asset',['id'=>$nft->id,'creator'=>'@'.$nft->username])}" style="color:white;" target="_blank">View Details</a> 
                    HTML;
            }elseif($_GET['tab']=='pending'){
                if($nft->status=="denied"){
                    return <<<HTML
                    <a href="#" class="popup-btn" style="color:white;">View Status</a>
                    <a href="{$router->url('edit_denied',['id'=>$nft->id,'creator'=>'@'.$nft->username])}" style="color:white;">Re-submit</a>
                    <a href="{$router->url('pending_view',['id'=>$nft->id,'creator'=>'@'.$nft->username])}" style="color:white;" target="_blank">View Details</a>
                HTML;
                }else{
                    return <<<HTML
                        <a href="#" class="popup-btn" style="color:white;">View Status</a>
                        <a href="{$router->url('pending_view',['id'=>$nft->id,'creator'=>'@'.$nft->username])}" style="color:white; " target="_blank">View Details</a>
                    HTML;
                }
            }
                
        }else{
            return <<<HTML
                <a href="{$router->url('edit_asset',['id'=>$nft->id,'creator'=>'@'.$nft->username])}" style="color:white;">Edit</a>
                <a href="https://{$nft->ipfs}.ipfs.nftstorage.link" style="color:white;">View IPFS</a>
                <a href="{$router->url('single_asset',['id'=>$nft->id,'creator'=>'@'.$nft->username])}" style="color:white;" target="_blank">View Details</a> 
            HTML;
        }
    }
}
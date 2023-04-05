<?php
                if($nfts == NULL){
                    ?><p><?="aucun resultat trouvé"?></p><?php
                }
                else{
                    foreach($nfts as $nft){
                        ?>
                            <div class="card_container hvr-float" >
                            
                                <div class="bloc1">
                                    <img src="./SS/images/<?=$nft->dir_nft?>" alt="">

                                </div>
                                <div class="bloc2">
                                    <div class="price">
                                        <span ><strong>Price</strong> </span>
                                        <div>
                                            <span style="color: #0097e6;"><strong><?= $nft->price?></strong></span>
                                            <i class="fa-brands fa-ethereum"></i>
                                        </div>

                                    </div>
                                    
                                    <div class="user_nftid">
                                        
                                        <div  class="user">
                                            <span style="margin-right: 3px;"><?=$nft->username ?></span>
                                            <span class="material-icons blue-color">verified</span>
                                        </div>
                                        <span style="font-size: small;"><em>#ID<?= $nft->id?></em> </span>

                                    </div>
                                    

                                </div>
                                <div class="bloc3">
                                    <i class="<?=$nft->GetClass() ?>"></i>
                                    <a href="#" class="popup-btn">
                                        <div class="buy-now" style="margin-left: 30px;">
                                            <i class="large material-icons" style="font-size: 21px;">add_shopping_cart</i>
                                            <strong><span >Buy</span></strong>
                                        </div>
                                    </a>
                                    
                                    <div class="heart_react">
                                        <div>
                                            
                                            <form  style ="margin-bottom:0px;" class ="form-js" action="<?= $router->url('like')?>" method="POST" >
                                                <input type="hidden" id="post-id-js" value="<?=$nft->id?>">
                                                <button type="submit"><i id="iconh-js" style="color:red;font-size:16px" class="fa-<?=  $nft->GetLikeClass($options)?> fa-heart"></i></button>
                                                <span id="count-js" class="nblikes"  style="margin-left: 0px;"><?= $nft->likes?></span>
                                            </form>
                                                
                                            
                                            

                                        </div>
                                        
                                        
                                        

                                    </div>
                                

                                </div>
                                
                                
                            </div>
                        <?php
                    }
                }       
?>
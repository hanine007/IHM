<?php

use app\Form;
use app\PayementPaypal;?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../SS/style/single_asset.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script> 
    <!-- <link rel="stylesheet" href="popup.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.css" integrity="sha512-WEQNv9d3+sqyHjrqUZobDhFARZDko2wpWdfcpv44lsypsSuMO0kHGd3MQ8rrsBn/Qa39VojphdU6CMkpJUmDVw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <title>Document</title> -->
    <link href="../../SS/style/output.css" rel="stylesheet">
  <link href="../../SS/style/style_header_V2.css"  rel="stylesheet">
</head>
<body>
    <div id="service" data-service="<?= htmlspecialchars($nft->id) ?>">
    <div class="main-container">
        <div class="img-container">
            <div class="img-div">
                <a  class="popup" href="../../SS/images/<?=$nft->dir_nft?>"><img src="../../SS/images/<?=$nft->dir_nft?>" alt=""></a>
            </div>
            
            
        </div>
        <div class="infos">
            <span style="font-size: 80px;margin-bottom: 15px;"><?=$nft->name?></span>
            <span style="margin-bottom:15px;color:#767676;">Minted on <?=$nft->minted_at?></span>
            <div class="creator-owner">
                <div class="creator">
                    <span style="margin-bottom: 10px;color:#767676;">Created by</span>
                    <div class="profile-name">
                        <img src="../../SS/images/profileImg/<?=$nft->profile_dir?>" class="image--cover">
                        <span style="margin-left:5px ;">@<?=$nft->username?></span>
                    </div>
                </div>
                <!-- <div class="owner">hachi</div> -->
            </div>
        </div>
        <div class="buy">
           <div class="buy-card">
                <div class="card-left">
                    <span style="color:#767676;" id="price-text">Price </span>
                    <span><?=$nft->price?> ETH => <?=$nft->InUSD()?> USD </span>
                    
                </div>
                <div class="card-right">
                    <?= $nft->GetButton($router,$status)?>
                   
                </div>
                <div class="popup-view">
                        <div class="popup-card" >
                         <a><i class="fas fa-times close-btn"></i></a>
                       
                        <div class="info" id="thank-you">
                         
                            <span style="font-size:40px">Buy Now</span>
                            <p>Confirm the transaction to buy NFT</p>
                            <hr style="margin-bottom:40px;">
                            <div style="display:flex;justify-content:space-between;">
                                <span>Total price</span>
                                <span><?=$nft->InUSD()?> USD</span>
                                

                            </div>
                            <?php
                                $paypal=new PayementPaypal($nft->price);
                                echo $paypal->payementUI();
                            ?> 
                            
                            <!-- <a href="#" style="width:100%;padding:15px;background-color:#0371ac;border-radius:15px;text-align:center;margin-top:10px;">Confirm</a> -->
                        </div>
                        </div>
                </div>
                
           </div> 
            
            
        </div>
        <div class="description">
            <span style="font-size:35px;">Description</span>
            <hr style="width:80% ;margin-left: 0;">
            <p style="width: 80%;margin-top:20px;"><?=$nft->description?></p> 
        </div>
        <div class="details">
            <span style="font-size:35px;">Details</span>
            <hr style="width:80%;margin-left: 0;">
            <div class="chain-cat">
                <div class="chain">
                    <i  style="font-size: 32px;" class="<?=$nft->GetClass()?>" ></i>
                    <span>Chain</span>
                </div>
                <div class="cat">   
                    <i class="<?=$nft->GetClassCat()?>"></i>
                   
                    <span>Category</span>
                </div>
                <div class="ipfs-view">
                   
                    <a href="<?="https://".$nft->ipfs.".ipfs.nftstorage.link"?>" target="_blank">
                        <i class="fa-solid fa-eye"></i>
                        <span>View on IPFS</span>
                    </a>
                    
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script> 
  <!--   <script type="text/javascript" src="popoup.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js" integrity="sha512-IsNh5E3eYy3tr/JiX2Yx4vsCujtkhwl7SLqgnwLNgf04Hrt9BT9SXlLlZlWx+OK4ndzAoALhsMNcCmkggjZB1w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="../../SS/script/buy.js"></script>
    <script>
        $(document).ready(function() {
         $('.popup').magnificPopup({type:'image'});
        });
    </script>
    
</body>
</html>
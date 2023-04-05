<?php
use models\Models;

/* if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}
require('./class/Nft_management.php');
require('./class/Functions.php');
require("./class/db_connect.php"); */



/* $_nft=new Nft_management($pdo); */


/* $idd=(int)$_nft->get_id_user();

if(isset($_GET["idnft"])){
    $value=$_nft->add_minus_quantity($idd);
    if($value=="success"){
        header("location:download_page.php?file={$_GET['file']}");
    }
}
if(isset($_GET["action"])){
    header('location:./login.php');
}
if(isset($_SESSION["username"])){
    require('./header_logged.php'); 
}
else{
    require('./header.php');
}  */





/* $_nft->favorite_insert_delete($idd);

Functions::set_to_null(); */


/* $requete=$_nft->requete($_GET["category"],$_GET["budget"],$_GET["chain"],$_GET["reset"],$_GET["my_creation"],$idd); */



/* if(isset($_GET["nft_achat"])){
    $nfts=$_nft->join_bought_nft($idd);
} */

$message=NULL;
$value=NULL;
/* $table=Models::GetM('nft');
$nfts=$table->filtered_nft(); */

if($nfts == NULL){
    $message="aucun resultat trouvé";
}




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./SS/style/style_assets.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600&family=Sora:wght@700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@700;800&display=swap" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" integrity="sha512-wnea99uKIC3TJF7v4eKk4Y+lMz2Mklv18+r4na2Gn1abDRPPOeef95xTzdwGD9e6zXJBteMIhZ1+68QC5byJZw==" crossorigin="anonymous" referrerpolicy="no-referrer" />  -->
   
    <title>Document</title>
    
</head>
<body>
    
    <nav class="navbar active" style="font-size: 18px;">
        
        <!-- <i class="fa-solid fa-arrow-right"></i> -->
    <form  class="js-filter-form" action="<?= $router->url('assets')?>" method="GET"> 
        <div class="filterhead">
            <div  class="filter-annotation">
                <i style="color:white;font-size: 30px"class="bi bi-filter"></i>
                <span style="margin-left:5px ;margin-bottom: 3px;"> Filter</span>
            </div>
            <i style="color:white;"class="fa-solid fa-arrow-left nav-arrow"></i>
        </div>
            
            <div class="categories">
                <div id="cat-button">
                    <span>Categories</span>
                    <i style="color:white;" class="fa-solid fa-arrow-up cat-arrow"></i>
                </div>
                <div class="cat-content">
                    <input type="radio" name="category" class="demo" value="1" id="art" >
                    <label for="art">
                        <i  style="color:#141414;" class="fa-solid fa-palette"></i>
                        <span> Art</span>
                    </label>
                    <input type="radio" name="category" class="demo" value="2" id="photo">
                    <label for="photo">
                        <i style="color:#141414;" class="fa-solid fa-camera"></i>
                        <span>Photo</span> 
                    </label>
                    <input type="radio" name="category" class="demo" value="3" id="music">
                    <label for="music">
                        <i style="color:#141414;" class="fa-solid fa-music"></i>
                        <span>Music</span> 
                    </label>
                    <input type="radio" name="category" class="demo" value="4" id="sport">
                    <label for="sport">
                        <i style="color:#141414;" class="fa-solid fa-futbol"></i>
                        <span>Sport</span> 
                    </label>
                </div>
            </div>
        
            <div class="price">
                <div id="price-button">
                    <span>Budget</span>
                    <i style="color:white;" class="fa-solid fa-arrow-up price-arrow"></i>
                </div>
                <div class="price-content">
                <div class="price_filter">
                    <div class="price_range">
                        
                        <div class="price_eth">
                            <span id="rangeValue" style="color:#0097e6">0.1</span>
                            <span style="font-size: 40px; color: rgb(255, 255, 255); margin-left: 5px;">
                                <sup><i class="fab fa-ethereum" ></i></sup>

                            </span>

                        </div>
                        
                        <input class="range" type="number" name="budget" step="0.1" value="0.1" min="0.1" onChange="rangeSlide(this.value)" onmousemove="rangeSlide(this.value)" >
                        
                    </div>
                 

                  </div>
                </div>
                
            </div>
        
            <div class="chain">
                <div id="chain-button">
                    <span>Chain</span>
                    <i style="color:white;"class="fa-solid fa-arrow-up chain-arrow"></i>
                </div>
                <div class="chain-content">
                    <div class="wrapper_chain">
                            
                        <input type="radio" name="chain" value="1" id="option-1">
                        <input type="radio" name="chain" value="2" id="option-2" >
                        <label for="option-1" class="option option-1">
                            <div class="dot"></div>
                            <span style="font-size: 30px; color: #141414;margin-top: 5px;margin-bottom: 5px;">
                                <i class="fab fa-ethereum" ></i>

                            </span>
                            
                            </label>
                        <label for="option-2" class="option option-2">
                            <div class="dot"></div>
                            <span style="font-size: 30px; color: #141414;margin-top: 5px;margin-bottom: 5px;">
                                <i class="fa-brands fa-btc"></i>
                            </span>
                        </label>
                        
                    </div>
                </div>
            </div>
           <!--  <button class="favorite styled hvr-shrink" type="submit" name="filterr" id="desktop_btn" style="cursor: pointer;">Apply Filter</button>  -->
    </form>
       
       
     <!--    <div id="price">
            <span>price</span>
            <i class="fa-solid fa-arrow-down arrowcat"></i>
        </div>
        <div id="chain">
            <span>chain</span>
            <i class="fa-solid fa-arrow-down arrowcat"></i>
        </div> -->
        
    </nav>
    <form class="js-filter-form-3" action="<?= $router->url('assets')?>" method="GET">
        <div class="mobile_filter">
            
            <div style="width: 100%;" class="mobile_cat">
                <div class="radio-toolbar">
                    <input type="radio" id="radioApple" name="category" value="1" >
                    <label for="radioApple">Art</label>
                
                    <input type="radio" id="radioBanana" name="category" value= "2" >
                    <label for="radioBanana">Photo</label>
                
                    <input type="radio" id="radioOrange" name="category" value= "3" >
                    <label for="radioOrange">Music</label> 
                    
                    <input type="radio" id="radioOrangee" name="category" value= "4" >
                    <label for="radioOrangee">Sport</label> 
                    
                    
                </div>
                
                

            </div>
            <div id="#mbprice" class="mobile_price">
                <h3 id="Budgettext">Budget</h3>
                <i  id="ethtag"class="fa-brands fa-ethereum" style="color: #0097e6;margin-right: 10px;"></i>
                <input class="range2" type="number" name="budget" step="0.1" value="0.1" min="0.1" max="100" >
            
            </div>
            <div class="mobile_chain">
                <div class="select second">
                    <select name="chain"style="width:200px;height:50px;border-radius:5px;padding:5px;">
                    <option value="1">ETH Chain</option>
                    <option value="2">BTC Chain</option>
                    
                    </select>
                    
                </div>
                

            </div>
            <!-- <button class="favorite styled hvr-shrink" name="filterr" id="mobile_btn" type="submit" style="cursor: pointer;">
                Apply
            </button> -->
            
                

        </div>
    </form>
    <div class="main-container active" style="font-size: 16px;" >
        <div class="cards-header">
            
            <div class="nb-items">
                <i class="fa-solid fa-icons" style="font-size:25px;color:rgb(167, 167, 167);"></i>
                <span style="color:white;font-size:25px;margin-left:10px;"><span id="nb_items"><?=$nb_items?></span> items</span>
            </div>
            <div class="reset-options">
                <a id='reset' href="<?= $router->url('assets')?>"  class="buttonDownload" >Reset</a>
                <div class="select second">
                    
                   <form class="js-filter-form-2" action="<?= $router->url('assets')?>" method="GET">
                         <select name="option" style="height:50px;border-radius:5px;padding:5px;">
                            
                            <!-- <option value="4" >All NFT</option> -->
                            <option value="3">Most favorited</option>
                            <option value="1" >Price:Low to High</option>
                            <option value="2">Price:High to Low</option>
                            
                            
                        
                        </select>
                   </form> 
                  
                    
                </div>
            </div>
        </div>
        <div class="all-cards-container js-filter-content">   
            <?php
                if($message){
                            ?><p style="color:white;"><?=$message?></p><?php
                }
                else{
                    foreach($nfts as $nft){
                        ?>
                           
                            <div class="card_container hvr-float"  >
                            
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
                                <a href="<?=$router->url('single_asset',['id'=>$nft->id,'creator'=>'@'.$nft->username])?>" class="popup-btn">
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
            
            
        </div> 
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script> 
   <script type="text/javascript" src="./SS/script/filter.js"></script>
       
       <!-- <script type="text/javascript" src="./SS/script/buy.js"></script> -->
       <script type="text/javascript" src="./SS/script/like_effect.js"></script>
       <script type="text/javascript" src="./SS/script/range.js"></script>
       <script type="text/javascript" src="./SS/script/like.js"></script>
    
    <script>
        
        const filterhead=document.querySelector('.filterhead');
        filterhead.addEventListener("click",function(){
            
            const navbar= document.querySelector('.navbar');
            const cards= document.querySelector('.main-container');
            const nav_arrow=document.querySelector('.nav-arrow');
            navbar.classList.toggle("active");
            cards.classList.toggle("active");
            if ( nav_arrow.classList.contains('fa-arrow-left') ){
                nav_arrow.classList.remove('fa-arrow-left');
                nav_arrow.classList.add('fa-arrow-right');
            }else{
                nav_arrow.classList.remove('fa-arrow-right');
                nav_arrow.classList.add('fa-arrow-left');
            }
        });

      

        function bind_content(content_class){
            const content=document.querySelector(content_class)
            content.classList.toggle("opened");
        }
        function bind_arrow(arrow_class) {
            
            const arrow=document.querySelector(arrow_class);
           /*  console.log(arrow); */
            if(arrow.classList.contains('fa-arrow-down')){
               arrow.classList.remove('fa-arrow-down');
                arrow.classList.add('fa-arrow-up');
            } 
            else{
                arrow.classList.remove('fa-arrow-up');
                arrow.classList.add('fa-arrow-down');
            }
        }
        
        $("#cat-button").on("click", function(){bind_content(".cat-content");});
        $("#price-button").on("click", function(){bind_content(".price-content");});
        $("#chain-button").on("click", function(){bind_content(".chain-content");});
                            
        $("#cat-button").on("click", function(){bind_arrow(".cat-arrow");});
        $("#price-button").on("click", function(){bind_arrow(".price-arrow");});
        $("#chain-button").on("click", function(){bind_arrow(".chain-arrow");});

        


        
 
      
     
            
    </script>
     
</body>
</html>
<?php

/* $redirection=new app\Redirection($router,$current_user);
$redirection->redirectLogin()
            ->redirectDenied(); */

$action= $_GET['action'] ?? null;

?>
<!DOCTYPE html>
<html>
<head>
    <title>  JinxArt Admin </title>
	<meta charset="utf-8">
    
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="./SS/style/adminV2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
</head>	
<body>
   
    <div class="loader-wrapper">
    <span class="loader"><span class="loader-inner"></span></span>
    <span style="margin-top:15px;font-size:20px;color:white;">Uploading to IPFS . . .</span>
    </div>
    <div class="container">
        <!--     SIDE AREA -->
            <div class="sideArea">
                <div class="avatar">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSCNOdyoIXDDBztO_GC8MFLmG_p6lZ2lTDh1ZnxSDawl1TZY_Zw" alt="">
                    <div class="avatarName">Welcome,<br> JinxArt Admin</div>
                </div>
                <ul class="sideMenu">
                    
                    <li><a href="<?=$router->url('admin_index')?>"><span class="fa fa-prodct"></span>DASHBOARD</a></li>
                    <li><a href="<?=$router->url('home')?>"><span class="fa fa-prodct"></span>VIEW WEBSITE<i style="margin-left:10px;"class="fa-solid fa-arrow-up-right-from-square"></i></a></li>
                    <li><a href="<?=$router->url('logout')?>"><span class="fa fa-contact"></span>LOG OUT<i  style="margin-left:10px;" class="fa-solid fa-arrow-right-from-bracket"></i></a></li>
                </ul>
            </div>
        <!--     SIDE AREA -->
            <div class="mainArea">
                <!-- BEGIN NAV -->
                <nav class="navTop row">
                    <div class="account fr">
                        <div class="name has-submenu">JinxArt Admin<span class="fa fa-angle-down"></span></div>
                        <ul class="accountLinks submenu">
                            <li><a href="<?=$router->url('home')?>">View website</a></li>
                            <li><a href="<?=$router->url('logout')?>">Log out<span class="fa fa-sign-out fr"></span></a></li>
                        </ul>
                    </div>
                </nav>
                <!-- END NAV -->
                <!-- CONTAINER  -->
                <div class="mainContent">  
        <!-- LIST FORM -->
        

        
            <?= app\Form::get_html_add2($action);  ?>
            <div class="formHeader row">
                <h2 class="text-1 fl">Product List</h2>
                
            </div>
            <div class="table">
                <div class="row bg-1">
                    <div class="cell cell-50 text-center text-fff">ID</div>
                    <div class="cell cell-100 text-center text-fff">CATEGORY</div>
                    <div class="cell cell-100 text-fff">IMAGE</div>
                    <div class="cell cell-100p text-fff">NAME</div>
                    
                    <div class="cell cell-200 text-center text-fff">ACTIONS</div>
                </div>
            <!--   BEGIN LOOP -->
                <ul>
                    
                <?php
                    foreach($nfts as $nft){
                        ?>
                            <li class="row" style="color:white;">
                                <div class="cell cell-50 text-center">#<?=$nft->id?></div>
                                <div class="cell cell-100 text-center"><?=$nft->name_cat?></div>
                                <div class="cell cell-100 text-center">
                                    <a href="<?=$router->url('pending_view',['id'=>$nft->id])?>"><img src="./SS/images/<?=$nft->dir_nft?>" alt="" width="50"></a>
                                </div>
                                <div class="cell cell-100p"><a href="<?=$router->url('pending_view',['id'=>$nft->id])?>"><?=$nft->name?></a></div>
                                <div class="cell cell-100 text-center">
                                    
                                    <a  id="view" href="<?=$router->url('pending_view',['id'=>$nft->id,'creator'=>'@'.$nft->username])?>" > VIEW</a>
                                </div>
                                <div class="cell cell-100 text-center">
                                   <a  id="approve" class="approve" href="<?= $router->url('admin_approve',["id"=>$nft->id])?>"> APPROVE</a>
                                </div>
                                <div class="cell cell-100 text-center">
                                    
                                    <a href="#" id="deny" class="popup-btn "> DENY</a>
                                </div>
                                
                            </li>
                            <div class="popup-view">
                                <div class="popup-card" >
                                    <a><i class="fas fa-times close-btn"></i></a>
                                
                                    <div class="info" id="thank-you">
                                    
                                        <span style="font-size:40px;color:white;">Specify motif</span>
                                        <!-- <p>Confirm the transaction to buy NFT</p> -->
                                        <hr style="margin-bottom:20px;">
                                        <form action="<?= $router->url('admin_deny',["id"=>$nft->id])?>" method="post" style="display:flex;flex-direction:column;">
                                            <textarea name="message" id="" cols="30" rows="8" required></textarea>
                                            <!-- <input type="hidden" name="id" value=""> -->
                                            <input type="submit" style="margin-top:10px;" value="envoyer">

                                        </form>
                                        
                                       
                                    </div>
                                </div>
                            </div>
                          
                        <?php
                    }
                   
                ?>      

                </ul>
            <!--   END LOOP -->
            </div>
           
           
        
        


          
        
  


     
        
        
        
        
        
</body>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script> 
<script>
  $(".approve").on("click",function(){
    $(".loader-wrapper").toggleClass("active");
  });
  
 $(".approve").on("load",function(){
     $(".loader-wrapper").fadeOut("slow");
  });  

</script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script type="text/javascript" src="./SS/script/admin.js"></script>
<script type="text/javascript" src="./SS/script/buy.js"></script>
</html>
















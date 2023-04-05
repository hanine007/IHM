

<html style="font-family: 'Nunito', sans-serif;">
  <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1" />
  <link rel='stylesheet prefetch' href='http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css'>
  <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600&family=Sora:wght@700;800&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Sora:wght@700;800&display=swap" rel="stylesheet">
  <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
  <link href="https://fonts.googleapis.com/css?family=Inter:100,200,300,regular,500,600,700,800,900" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/1db09dea83.js" crossorigin="anonymous"></script>

<script>
</script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Sora:wght@700&display=swap" rel="stylesheet">
  <title>JinxArt MarketPlace</title>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300|Sonsie+One" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="stylesheet" href="select_chain.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
  <!-- css linking -->
  <link href="./SS/style/account2h.css" rel="stylesheet">
  <link href="./SS/style/account3h.css"  rel="stylesheet">
  <link href="./SS/style/account-plus.css"  rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <body style="height: fit-content;" class="bg-black">
  </head>
  
<style>
.sticky{
position: -webkit-sticky;
position: sticky;
top: 0;

}
.hide-scroll-bar {
-ms-overflow-style: none;
scrollbar-width: none;
}
.hide-scroll-bar::-webkit-scrollbar {
display: none;
}
.grid-20{
    grid-template-columns: repeat(5, minmax(20%, 1fr));
    row-gap: 2rem;
    
}
#edit-profile:hover{
  color:white;
}


</style>

    
<body >
  

  <div  class="w-full h-30vh bg-100">
    <img style="width: 100%;height: 100%;object-fit: cover;" src="./SS/images/static/JINX2.png" alt="">
  </div>
  <a href="<?=$router->url('edit')?>">
    <div  class="mx-auto -mt-20 mob:-mt-14 w-fit">
      <img class="mob:w-28 mob:h-28 w-32 h-32 rounded-full border border-gray-100 shadow-sm " src="./SS/images/profileImg/<?=$current_user->profile_dir?>" alt="user image" />
      
    </div>
  </a>

  <div>
    <div class="user_name text-white mob:text-2xl text-3xl text-center mob:mt-2 mt-5"><h1>@ <?=$current_user->username?></h1></div>
    <a href="<?=$router->url('edit')?>"><p id="edit-profile" style ="margin-top:10px;font-size:20px;margin-bottom:10px;"class="user_mail text-center text-300 text-xl mob:text-lg"><i style="margin-right:5px;"class="fa-solid fa-pen"></i>Edit Profile</p></a>
    
  
  </div>
  <div 
    style="position:sticky;top:0;background-color: black;"
    class="z-900 mob:py-5 py-6 flex flex-wrap overflow-x-scroll hide-scroll-bar -b-2 border-b-2 
    border-borderWhite border-solid header-border">
          <div
            class="flex space-x-6 mob:space-x-4 cart_tabs:space-x-3 lg:ml-40 md:ml-20 w-1/2 cart_tabs:w-90% m-auto justify-between text-300" >
            <div class="hover:text-white text-center flex mob:px-6 px-8"><i class="fa-solid fa-paint-roller mob:mr-1 mr-2 mob:text-lg text-xl "></i><a class="link mob:text-xl text-2xl" href="<?=$router->url('account').'?tab=created'?>">created</a></div>
            <div class="hover:text-white text-center flex mob:px-6 px-8"><i class="fa-regular fa-heart mob:mr-1 mr-2 mob:text-lg text-xl "></i><a class="link mob:text-xl text-2xl " href="<?=$router->url('account').'?tab=favorited'?>">favorited</a></div>
            <div class="hover:text-white text-center flex mob:px-6 px-8"><i class="fa-solid fa-bag-shopping mob:text-lg text-xl mob:mr-1 mr-2"></i><a class="link mob:text-xl text-2xl" href="<?=$router->url('account').'?tab=collected'?>">purchased</a></div>
            <div class="hover:text-white text-center flex mob:px-6 px-8"><i class="fa-solid fa-spinner mob:text-lg text-xl mob:mr-1 mr-2"></i><a class="link mob:text-xl text-2xl" href="<?=$router->url('account').'?tab=pending'?>">pending</a></div>
          </div>
        </div>
  <!--select -->

  <div style="margin-bottom:150px;" class="xls:grid-cols-4 mx-auto md:mt-10 md:mx-auto lg:w-fit aftab:w-fit mt-12 mob:mt-6 cart_tabs:mt-6 m-auto grid grid-cols-5 md:grid-cols-2 lg:grid-cols-3  gap-y-[1vw] mob:gap-y-4 md:gap-x-4  cart_tabs:gap-x-[3vw] cart_tabs:gap-y-[3vw]  mob:grid-cols-1 cart_tabs:grid-cols-2 md:w-fit md:m-auto mob:w-full w-90%">
    
        
            
         <?php
                if($message){
                            ?><p style="color:white;"><?=$message?></p><?php
                }
                else{
                    foreach($nfts as $nft){
                        ?>
                        
                   
                            
                                <div class="mob:mx-auto  mob:w-[290px] cart_tabs:w-[280px] h-fit w-[300px]     rounded-xl shadow-xl hover:shadow-2xl pt-5 px-5 bg-400 cursor-pointer">
                                  <?php if(isset($_GET['tab']) && $_GET['tab']=="pending"){
                                    $url=$router->url('pending_view',['id'=>$nft->id,'creator'=>'@'.$nft->username]);
                                  }else{
                                    
                                    $url=$router->url('single_asset',['id'=>$nft->id,'creator'=>'@'.$nft->username]);
                                  }  ?>
                                  <a href="<?=$url?>">
                                      <div class="flex justify-center items-center group">
                                          <img  src="./SS/images/<?=$nft->dir_nft?>" class="group-hover:opacity-80 w-full h-64 rounded-lg" alt="card-image">
                                          <i  class="fa-solid fa-eye absolute w-10 hidden group-hover:inline-block text-2xl text-white text-center" alt="view-icon"></i>
                                          
                                      </div>
                                    </a>
                                    
                            
                                    <div class="py-4 border-b border-neutral-dark-blue-line">
                                        <h1 class="mb-2 text-white hover:text-primary-cyan text-[18px] font-bold cursor-pointer"><?= $nft->name?>  #<?= $nft->id?></h1>
                                        
                                        <div class=" flex justify-between items-center">
                                            <div class="flex items-center space-x-2">
                                                <img src="./SS/images/accountImg/icon-ethereum.svg" alt="ethereum-icon">
                                                <span class="text-primary-cyan text-white font-bold"><?= $nft->price?> ETH</span>
                                            </div>
                                            <div class="flex items-center space-x-2">
                                            <span class="material-icons blue-color">verified</span>
                                                <span class="text-white text-sm"><?=$nft->username ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-300 link mx-auto flex justify-between w-90% py-1">
                                        <div class="py-1 dropdown"><!-- <a href="#"> --><div class="dropdown-content">
                                            <?=app\Form::more_options($router,$nft)?>
                                            </div><span style="font-size:20px;"class='bi bi-three-dots dropbtn'></span></div>
                                       <!--  </a> --><div>
                                            <!-- <div class="dropdown"> -->
                                            <!-- <button class="dropbtn" style="color:red;">More -->
                                            <!-- <i class="fa fa-caret-down dropbtn"></i> -->
                                            <!-- </button> -->
                                            
                                           <!--  </div> -->
                                           <form  style ="margin-bottom:0px;" class ="form-js" action="<?= $router->url('like')?>" method="POST" >
                                            <input type="hidden" id="post-id-js" value="<?=$nft->id?>">
                                            <button type="submit"><i id="iconh-js" style="color:red;font-size:16px" class="fa-<?=  $nft->GetLikeClass($options)?> fa-heart"></i></button>
                                            <span id="count-js" class="nblikes"  style="margin-left: 0px;"><?= $nft->likes?></span>
                                        </form>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="popup-view">
                                        <div class="popup-card" >
                                            <a><i class="fas fa-times close-btn"></i></a>
                                        
                                                <?php if($orders == null ){
                                                        echo app\Form::popup_infos($nft,null,$router);
                                                }else{
                                                    echo app\Form::popup_infos($nft,$orders[$nft->id],$router);
                                                }?>
                                                
                                        </div>
                                    </div>
                         <?php
                    }
                }       
            ?>
                                                            
    </div>
  </body>  
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script> 
   <script type="text/javascript" src="./SS/script/filter.js"></script>
       
       <!-- <script type="text/javascript" src="./SS/script/buy.js"></script> -->
       <script type="text/javascript" src="./SS/script/like_effect.js"></script>
       <script type="text/javascript" src="./SS/script/range.js"></script>
       <script type="text/javascript" src="./SS/script/like.js"></script>
       <script type="text/javascript" src="./SS/script/buy.js"></script>                                               

  </html>
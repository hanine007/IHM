<?php

use app\Form;

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../../SS/style/upload.css">
        <link rel="stylesheet" href="../../../SS/style/upload2.css">
        <link rel="stylesheet" href="../../../SS/style/upload3.css">
        <link href="../../../SS/style/output.css" rel="stylesheet">
        <link href="../../../SS/style/style_header_V2.css"  rel="stylesheet">
        <script src="" defer></script>
        <title>Vendre NFT</title>
    </head>
    <body>
        <div class="wrapper">
            <div class="header">
                <h1>Vendre NFT</h1>
            </div>
            <div class="section">
                <form action="<?=$router->url('edit_asset',['id'=>$nft->id,'creator'=>'@'.$nft->username])?>" method="post"  enctype="multipart/form-data" class="active"  >
                <input type="text" name="title"  id="title" placeholder="Titre" style="<?= Form::GetStyle("title",$errors)?>" value="<?=$nft->name?>" >
                <?= Form::errorsHTML('title',$errors)?>
                <textarea id="description" name="description" style="resize: none;<?= Form::GetStyle("description",$errors)?>" placeholder="Description" ><?=$nft->description?></textarea>
                <?= Form::errorsHTML('description',$errors)?>
                <input type="number" step="0.01"  min="0.05"  name="price"  id="price" placeholder="Prix" value="<?=$nft->price?>" style="<?= Form::GetStyle("price",$errors)?>" >
                <?= Form::errorsHTML('price',$errors)?>
                <input type="number" name="qnt" min="0" max="10" placeholder="Quantité" value="<?=$nft->quantity?>" style="<?= Form::GetStyle("qnt",$errors)?>" >
                <?= Form::errorsHTML('qnt',$errors)?>
                <div class="container_upload">
                    <div class="radio_container">
                        <input type="radio" name="category" value="1" id="one" <?= Form::checked(1,$nft->id_category)?>>
                        <label for="one">Art</label>
                        <input type="radio" name="category" value="2" id="two" <?= Form::checked(2,$nft->id_category)?>>
                        <label for="two">Photo</label>
                        <input type="radio" name="category" value="3" id="three" <?= Form::checked(3,$nft->id_category)?>>
                        <label for="three">Music</label>
                        <input type="radio" name="category" value="4" id="four" <?= Form::checked(4,$nft->id_category)?>>
                        <label for="four">Sport</label>
                    </div>
                </div>
                <div class="box" >
                    <select name="chain">
                        <option value="1" <?= Form::selected(1,$nft->id_chain)?>>Ethereum</option>
                        <option value="2" <?= Form::selected(2,$nft->id_chain)?>>Bitcoin</option>
                    </select>
                </div>
                
                <?php $path=dirname(__DIR__,4).DIRECTORY_SEPARATOR."public".DIRECTORY_SEPARATOR."SS".DIRECTORY_SEPARATOR."images".DIRECTORY_SEPARATOR.$nft->dir_nft ?>
                <!-- <div class="image">
                    <input type="file" name="image" value="<?=$path?>" id="pic" accept="image/*" style="<?= Form::GetStyle("file",$errors)?>" >
                </div> -->
                <?= Form::errorsHTML('file',$errors)?>
                <input type="submit" name="submit" value="Edit" placeholder="Submit">
                
                <?= Form::get_html_add($success,"nft edité avec succés");  ?>
                </form>
            </div>
        </div>
        
    </body>
</html>
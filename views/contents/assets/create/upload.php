<?php
use app\Form;

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./SS/style/upload.css">
        <link rel="stylesheet" href="./SS/style/upload2.css">
        <link rel="stylesheet" href="./SS/style/upload3.css">
        <script src="" defer></script>
        <title>Vendre NFT</title>
    </head>
    <body>
        <div class="wrapper">
            <div class="header">
                <h1>Vendre NFT</h1>
            </div>
            <div class="section">
                <form action="<?=$router->url('create')?>" method="post"  enctype="multipart/form-data" class="active">
                <input type="text" name="title"  id="title" placeholder="Titre" style="<?= Form::GetStyle("title",$errors)?>" >
                <?= Form::errorsHTML('title',$errors)?>
                <textarea id="description" name="description" style="resize: none;<?= Form::GetStyle("description",$errors)?>" placeholder="Description"></textarea>
                <?= Form::errorsHTML('description',$errors)?>
                <input type="number" step="0.01"  min="0.05"  name="price"  id="price" placeholder="Prix" style="<?= Form::GetStyle("price",$errors)?>" >
                <?= Form::errorsHTML('price',$errors)?>
                <input type="number" name="qnt" min="0" max="10" placeholder="Quantité" style="<?= Form::GetStyle("qnt",$errors)?>" >
                <?= Form::errorsHTML('qnt',$errors)?>
                <div class="container_upload">
                    <div class="radio_container">
                        <input type="radio" name="category" value="1" id="one" checked>
                        <label for="one">Art</label>
                        <input type="radio" name="category" value="2" id="two">
                        <label for="two">Photo</label>
                        <input type="radio" name="category" value="3" id="three">
                        <label for="three">Music</label>
                        <input type="radio" name="category" value="4" id="four">
                        <label for="four">Sport</label>
                    </div>
                </div>
                <div class="box" >
                    <select name="chain">
                        <option value="1">Ethereum</option>
                        <option value="2">Bitcoin</option>
                    </select>
                </div>
                
                <div class="image">
                    <input type="file" name="image" id="pic" accept="image/*" style="<?= Form::GetStyle("file",$errors)?>" >
                    <img  id="blah" src="./SS/images/static/preview.png" alt="" style="width: 100%;height:200px;margin-bottom:10px;">
                </div>
                <?= Form::errorsHTML('file',$errors)?>
                <input type="submit" name="submit" value="submit" placeholder="Submit">
                <?= Form::get_html_add($success,"votre nft est en attente d'approbation");  ?>
                </form>
            </div>
        </div>
     <script>
         pic.onchange = evt => {
            const [file] = pic.files
            if (file) {
                blah.src = URL.createObjectURL(file)
            }
        }
     </script>   
    </body>
</html>
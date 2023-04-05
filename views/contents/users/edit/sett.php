<?php
/* include '../app/auth/profile.php'; */
// require ('header.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="../SS/style/sett.css">
    <link href="../SS/style/output.css" rel="stylesheet">
    <link href="../SS/style/style_header_V2.css"  rel="stylesheet">
    <!--footer css -->
    
    <title>Profile</title>
</head>

<body>
    <div class="wrapper mt-sm-5">
        <h4 class="pb-4 border-bottom text-white">Account settings</h4>
        <!-- notification message -->
        <?php if ($success == true) : ?>
            <div class="success">
                <p>
                    <?php
                    echo 'modification réussie';
                    
                    ?>
                </p>
            </div>
        <?php endif ?>
        <?php if (count($errors) > 0) : ?>
            <div class="error">
                <?php foreach ($errors as $error) : ?>
                    <p><?php echo $error ?></p>
                <?php endforeach ?>
            </div>
        <?php endif ?>

        <div class=" d-flex align-items-start py-3 border-bottom">
            <img class="img" src="../SS/images/profileImg/<?=$current_user->profile_dir?>" id="wizardPicturePreview" alt="">
            <div class="pl-sm-4 pl-2" id="img-section">
                <b class="text-white">Profile Picture</b>
                <p>Accepted file type .png. Less than 1MB</p>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="btn btn-primary mr-3" style="position: relative;overflow: hidden">
                        Upload
                        <input style="position: absolute;opacity:0;right:0;top:0; cursor:pointer;" type="file" name="image" id="wizard-picture" />
                    </div>
            </div>
        </div>
        <div class="py-2">
            <div class="row py-2">
                <div class="col-md-6">
                    <label for="email">Email Address</label>
                    <input  class="bg-light form-control" name="email" value="<?=$current_user->email?>">
                </div>
                <div class="col-md-6 pt-md-0 pt-3">
                    <label for="phone">Username</label>
                    <input type="text" class="bg-light form-control" name="username" value="<?=$current_user->username?>">
                </div>
                <div class="col-md-6 pt-md-0 pt-3">
                    <label for="phone">New password</label>
                    <input type="password" class="bg-light form-control" name="password" placeholder="your new password">
                </div>
                <div class="col-md-6 pt-md-0 pt-3">
                    <label for="phone">Confirm password</label>
                    <input type="password" class="bg-light form-control" name="password_confirm" placeholder="confirm new password" >
                </div>
            </div>

            <div class="py-3 pb-4 border-bottom">
                <button class="btn btn-primary mr-3" name="submit">Save Changes</button>
            </div>
        </div>
        </form>
    </div>

    <?php //require 'footer.php';?>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="../SS/script/sett.js"></script>

</body>

</html>
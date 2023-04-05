<?php include('../app/auth/server.php') ?>
<!DOCTYPE html>
<html lang="fr"  style="font-size:80%;">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://kit.fontawesome.com/b6b9586b26.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./SS/style/style_login.css" />
    <!-- <script src="../JS/script.js" defer></script> -->
</head>
<body>
    <div id="sign_up">
        <form action="<?=$router->url('register')?>" method="post">
          <span style="font-size:xx-large">Register</span>
          <?php include('../app/auth/errors.php'); ?>
          <div id="field">
            <label><i class="fas fa-user"></i></label>
            <input type="text" name="username" placeholder="Nom utilisateur" required />
          </div>
  
          <div id="field">
            <label><i class="fas fa-envelope-open"></i></label>
            <input type="email" name="email" placeholder="Email" required />
          </div>
  
          <div id="field">
            <label><i class="fas fa-lock"></i></label>
            <input type="password" name="password_1" placeholder="Mot de passe" required />
          </div>
  
          <div id="field">
            <label><i class="fas fa-lock"></i></label>
            <input type="password" name="password_2" placeholder="Confirmer Mot de passe" required />
          </div>
  
          <div id="field">
            <input type="submit" name="reg_user" value="Register" />
          </div>
        </form>
  
        <p> J'ai déja un compte?
          <button><a href="<?=$router->url('login')?>">Login</a></button>
        </p>
      </div>
</body>
</html>
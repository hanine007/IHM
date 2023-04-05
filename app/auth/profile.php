<?php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}
include 'conn.php';

// initializing variables
$username = "";
$email    = "";
$errors = array(); 


$current_user = $_SESSION['username'];

// get current user id, email, img path ...
$sql = "SELECT * FROM users WHERE username='$current_user'";
$results = mysqli_query($db, $sql);
if ($results) {
    if (mysqli_num_rows($results) > 0) {
        while ($row = mysqli_fetch_array($results)) {
            $_SESSION['email'] = $row['email'];
            $_SESSION['img'] = $row['img'];
            $user_id =  $row['id'];
        }
    }
}

// edit user inputs
if(isset($_POST['submit'])){

    $username = mysqli_real_escape_string($db, $_POST['username']);
    $email = mysqli_real_escape_string($db, $_POST['email']);

    //check if username or email already exists
    $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if ($user) { // if user exists
        if ($user['username'] === $username) {
            array_push($errors, "Nom utilisateur existe déja");
        }

        if ($user['email'] === $email) {
            array_push($errors, "Email existe déja");
        }
    }

    if (count($errors) == 0) {
        $query = "UPDATE users SET username = '$username' , email= '$email' WHERE id = '$user_id'";
        mysqli_query($db, $query);
        $_SESSION['username'] = $username;
        $_SESSION['success'] = "Votre compte a été mis à jour";
    }

// image variables
$profileImg = time(). '_' .$_FILES['image']['name'];
$target = './SS/images/profileImg'. $profileImg;

// user profile picture
if(move_uploaded_file($_FILES['image']['tmp_name'], $target)){
        $sql = "UPDATE users SET img = '$profileImg' WHERE id = '$user_id'";
        mysqli_query($db, $sql);
}
    // header('Location: ' . $_SERVER['PHP_SELF']);
    /* header("location: sett.php"); */
}
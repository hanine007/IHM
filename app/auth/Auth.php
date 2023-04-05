<?php
namespace app\auth;

class Auth{
    public static function  is_connected(){
        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }
        if(isset($_SESSION['auth'])){
            return true;
        }else{
            /* $url=$_SERVER["REQUEST_URI"];
            $url=urlencode($url);
            
            throw new AuthException($url); */
            return false;
        }
    }
}
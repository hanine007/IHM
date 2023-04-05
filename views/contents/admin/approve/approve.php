<?php


if($action){
    header("location:".$router->url('admin_index')."?action=success");
}else{
    header("location:".$router->url('admin_index')."?action=failed");
}
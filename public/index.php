<?php

use app\Routing;

require("../vendor/autoload.php");

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

$router = Routing::GetRouting();

$router
    /* home controller */
    ->registerG('/',['controller\HomeController','index'],'home')
    ->registerG('/FAQ',['controller\HomeController','FAQ'],'FAQ')
    ->registerG('/contact',['controller\HomeController','contact'],'contact')
    
    /* assets controllers */
    ->registerG('/assets',['controller\AssetsController','index'],'assets')
    ->registerP('/assets/like',['controller\AssetsController','like'],'like')
    ->registerPG('/create',['controller\AssetsController','create'],'create')
    ->registerG('/assets/[*:creator]/[i:id]',['controller\AssetsController','single_asset'],'single_asset')
    ->registerPG('/assets/[*:creator]/[i:id]/edit',['controller\AssetsController','edit'],'edit_asset')
    ->registerPG('/assets/[*:creator]/[i:id]/edit-denied',['controller\AssetsController','edit_denied'],'edit_denied')

    ->registerG('/viewPending/[*:creator]/[i:id]',['controller\AssetsController','viewPending'],'pending_view')

    /* admin controllers */
    ->registerG('/admin',['controller\AdminController','index'],'admin_index')
   
    ->registerG('/admin/approve/[i:id]',['controller\AdminController','approve'],'admin_approve')
    ->registerPG('/admin/deny/[i:id]',['controller\AdminController','deny'],'admin_deny')
    
    
    ->registerG('/admin/delete/[i:id]',['controller\AdminController','delete'],'admin_delete')
    
    
    ->registerG('/IPFS',['controller\AssetsController','IPFS'],'IPFS')
    
    /* users controllers */
    ->registerPG('/buy',['controller\AssetsController','buy'],'buy')
    ->registerPG('/register',['controller\UsersController','register'],'register')
    ->registerPG('/login',['controller\UsersController','login'],'login')
    ->registerPG('/logout',['controller\UsersController','logout'],'logout')
    ->registerPG('/profile/edit',['controller\UsersController','edit'],'edit')
    ->registerG('/account',['controller\UsersController','account'],'account')
    ->registerG('/denied',['controller\UsersController','deny_access'],'deny_access')
    ->run();
    

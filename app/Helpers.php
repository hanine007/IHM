<?php
namespace app;

class Helpers{
    public static function BuildURL(array $data){
        
        return http_build_query(array_merge($_GET,$data));
    }
}
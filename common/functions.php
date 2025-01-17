<?php

define('HOME', 'http://localhost/portfolio/');
$path = [
    'home' => HOME,
    'post_login' => HOME.'login.php' 
];

function kk_site(){
    return "Portfolio Manager";
}

function kk_get_url($name){
    global $path;
    
    return $path[$name];
}
?>
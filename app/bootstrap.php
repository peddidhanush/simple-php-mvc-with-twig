<?php
    require_once 'config/config.php';
    
    spl_autoload_register(function($class) {
        require __DIR__."/lib/{$class}.php";
    });  
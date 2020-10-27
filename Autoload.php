<?php

function autoload_Controllers($classname){
    include 'app/controllers/'.$classname.'.php';
}

spl_autoload_register('autoload_Controllers');
?>
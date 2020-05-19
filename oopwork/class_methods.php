<?php

class Cars {

    function greeting(){

    }
    function greeting2(){

    }
    
}

$my_methods = get_class_methods('Cars');

foreach ($my_methods as $method) {
    echo $method . "<br>";
}
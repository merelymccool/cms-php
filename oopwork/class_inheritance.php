<?php

class Cars {

    var $wheels = 4;

    function greeting(){

        return "Hello world";

    }
    
}

$bmw = new Cars();

// extends will inherit from specified class
class Trucks extends Cars {


}

$mack = new Trucks();

echo $mack->wheels;
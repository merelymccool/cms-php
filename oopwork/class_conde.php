<?php

class Cars {

    protected $seats = 3;
    static $doors = 5;


    // will be called automatically when instance created
    function __construct(){

        echo $this->seats . "<br>";
        echo self::$doors++;

    }

    function __destruct() {

        echo self::$doors--;
    }
    
}


$bmw = new Cars();

$audi = new Cars();
<?php

class Cars {

    static $wheels = 4;
    // static only called by class, not instance
    static $doors = 4;


    static function car_detail(){

        //echo $this->wheels;
        
        // static function needs static variables called by class
        echo Cars::$wheels . "<br>";
        echo Cars::$doors . "<br>";

    }
    
}


$bmw = new Cars();

//echo $bmw->doors . "<br>"; // static called by instance is undefined

echo Cars::$doors;

Cars::car_detail();
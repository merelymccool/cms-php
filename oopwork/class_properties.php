<?php

class Cars {

    // define property
    var $wheels = 4;
    var $doors = 4;

    function car_detail(){

        return "This car has " . $this->wheels . "wheels";

    }
    
}

// Create instances of the class
$bmw = new Cars();
$audi = new Cars();

echo $bmw->wheels . "<br>"; //default class property
echo $bmw->wheels = 6 . "<br>"; //update class property per instance

echo $bmw->car_detail();
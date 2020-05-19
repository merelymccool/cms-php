<?php

class Cars {

    // public available globally
    public $wheels = 4;
    // private only available inside class
    private $doors = 4;
    // protected available inside class and extends
    protected $seats = 3;

    function car_detail(){

        echo $this->wheels . "<br>";
        echo $this->doors . "<br>";
        echo $this->seats . "<br>";

    }
    
}


$bmw = new Cars();

echo $bmw->wheels . "<br>"; // public available outside class
//echo $bmw->doors . "<br>"; // private gives error, unavailable outside of class
//echo $bmw->seats . "<br>"; // protected gives error, unavailable outside of class

$bmw->car_detail(); // all accessible from within class
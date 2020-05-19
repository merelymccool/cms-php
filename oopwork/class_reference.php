<?php

class Cars {

    static $doors = 4;


    static function car_detail(){

        //echo $this->wheels;
        
        // use "self" as "this" in static
        return self::$doors . "<br>";

    }
    
}

class Trucks extends Cars {

    static function display() {

        // call "parent" to refer to parent class in subclass
        echo parent::car_detail();

    }

}

Trucks::display();
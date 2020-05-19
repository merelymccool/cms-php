<?php

class Cars {

    private $wheels = 4;

    // to access private variables outside of class
    function get_values(){

        echo $this->wheels;

    }
    // to manipulate private variables outside of class
    function set_values(){

        $this->wheels = 10;

    }
    
}

$bmw = new Cars();

$bmw->get_values();

echo "<br>";

$bmw->set_values();

$bmw->get_values();
<?php

class Cars {

    function greeting(){

        echo "Hello world";

    }
    
}

// Create instances of the class
$bmw = new Cars();
$audi = new Cars();

// Active methods through instances
$bmw->greeting();
<?php   
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once __DIR__.'/faker/vendor/autoload.php';

class Faker_custom {
    private $faker = '';


    public function __construct() {
        $this->faker = Faker\Factory::create();
    }
    
    public function getFaker() {
        return $this->faker;
    }
}
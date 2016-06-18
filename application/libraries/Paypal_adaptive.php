<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Paypal_adaptive {
    public function Paypal_adaptive() {
        require_once __DIR__.'/paypal_adaptive_payments/vendor/autoload.php';
    }
}
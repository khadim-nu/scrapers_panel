<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MY_Controller
 *
 * @author awn
 */
class MY_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url', 'date', 'array', 'text'));
        if (is_logged_in()) {
            $user = $this->session->userdata('user_data');
            $method = $this->router->fetch_method();
        }
        $authenticated_methods = array(
            "admin" => array(
                "changepassword",
            ),
            'payment' => array(
                'options'
            ),
            'paypal' => array(
                'pay',
                'checkout'
            ),
            'white' => array(
                'pay',
                'checkout'
            )
        );
        $roles = array("developer", "user", "admin");
        $this->load->helper("url");
        $current_controller = $this->router->class;
        if (array_key_exists($current_controller, $authenticated_methods)) {
            if (in_array($this->router->method, $authenticated_methods[$current_controller]) && !is_logged_in()) {
                if (in_array($current_controller, $roles))
                    redirect($current_controller . '/login');
                else
                    redirect("player/login");
            }
        }
    }

}

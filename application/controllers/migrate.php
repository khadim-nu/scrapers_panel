<?php

defined("BASEPATH") or exit("No direct script access allowed");

class Migrate extends CI_Controller {

    public function index() {
        if (ENVIRONMENT == 'development') {
            $this->load->library('migration');
            if (!$this->migration->latest()) {
                show_error($this->migration->error_string());
            } else {
                echo " development:success<br>";
            }
        } else {
            echo "development:go away<br>";
        }
        if (ENVIRONMENT == 'production') {
            $this->load->library('migration');
            if (!$this->migration->latest()) {
                show_error($this->migration->error_string());
            } else {
                echo "production:success";
            }
        } else {
            echo "production:go away";
        }
    }

}

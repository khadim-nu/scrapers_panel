<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Items extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Items_model');
    }

    public function thesource_scraper() {
        $command='java -jar /var/www/yazzoopa-scraper/scrapping_tools/aws_thesource.jar';
         $output = shell_exec($command);
        redirect('items/thesource');
    }
    public function index() {
        if (is_admin()) {
            $data['title'] = 'Index';
            $this->load->view('items/index', $data);
        } else {
            redirect('admin/login');
        }
    }
    
    public function thesource() {
        if (is_admin()) {
            $data['data'] = $this->Items_model->get_all_custom_where($where=false, $select = FALSE,$table="thesource");
            $data['title'] = 'Thesource Items';
            $this->load->view('items/thesource', $data);
        } else {
            redirect('welcome');
        }
    }
}

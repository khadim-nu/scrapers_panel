<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Items extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Items_model');
    }

    public function thesource_scraper() {
        $call='java -jar /var/www/yazzoopa-scraper/scrapping_tools/loc_thesource.jar';
        //$out = shell_exec($call);
         $output=""; $return=FALSE;
        exec($call, $output, $return);
        var_dump($return);die;
        //redirect('items/thesource');
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

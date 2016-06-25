<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Items extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Items_model');
    }

    public function thesource_scraper() {
        $command = 'java -jar /var/www/yazzoopa-scraper/scrapping_tools/thesource_scraper.jar';
        $output = shell_exec($command);
        redirect('items');
    }

    public function gianttiger_scraper() {
        $command = 'java -jar /var/www/yazzoopa-scraper/scrapping_tools/gianttiger_scraper.jar';
        $output = shell_exec($command);
        redirect('items');
    }

    public function index() {
        if (is_admin()) {
            $data['data'] = $this->Items_model->get_all_custom_where($where = false, $select = FALSE);
            $data['total'] = $this->Items_model->record_count();
            $data['title'] = 'Show Items';
            $this->load->view('items/show', $data);
        } else {
            redirect('admin/login');
        }
    }

    public function thesource() {
        if (is_admin()) {
            $data['data'] = $this->Items_model->get_all_custom_where($where = false, $select = FALSE, $table = "items");
            $data['title'] = 'Thesource Items';
            $this->load->view('items/show', $data);
        } else {
            redirect('welcome');
        }
    }

}

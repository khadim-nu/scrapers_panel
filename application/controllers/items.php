<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Items extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Items_model');
        $this->load->model('Categories_model');
    }

    public function scrape($from=0) {
        $dir = __DIR__;
        $dir = explode("application", $dir);
        $dir = $dir[0];
        $command = "java -jar " . $dir . "scrapping_tools/";
        $command .= 'scrapers.jar ';

        $command .= ' ' . $from;
        die($command);
        $output = shell_exec($command);
        redirect('items');
    }

    public function show($id = NULL) {
        if (is_admin()) {
            $where = array("ad_id like " => "%" . $id . "%");
            $data['data'] = $this->Items_model->get_all_custom_where($where, $select = FALSE);
            $data['total'] = 0;
            if ($data['data'] && !empty($data['data'])) {
                $data['total'] = count($data['data']);
            }
            $data['title'] = 'Show Items';
            $data['title'] = "Show $id Items";
            $data["id"] = $id;
            $this->load->view('items/show', $data);
        } else {
            redirect('admin/login');
        }
    }

    public function index() {
        if (is_admin()) {
            $data['data'] = $this->Items_model->get_all_custom_where($where = false, $select = FALSE, $table = "items");
            $data['title'] = 'Scraped Items';
            $this->load->view('items/index', $data);
        } else {
            redirect('welcome');
        }
    }

    public function export_to_CSV($id = NULL) {
        if (is_admin()) {
            // this is for auction  otherwise 0.00]
            $name = "$id exported-items"; //This will be the name of the csv file.
            header('Content-Type: text/csv; charset=utf-8');
            header('Content-Disposition: attachment; filename=' . $name . '.csv');
            $output = fopen('php://output', 'wt');

            fputcsv($output, array('Name', 'Contact', 'Ad Title', 'Location', 'Source Link', 'Ad Text')); //The column heading row of the csv file

            $select = 'name,contact,ad_title,address,source_link,adText';
            $items = $this->Items_model->get_all($limit = FALSE, $start = 0, $order_by = "id DESC", "ad_id like ", "%$id%", $where_second_column_name = NULL, $where_second_column_value = NULL, $is_in_query = False, $select);

            foreach ($items as $key => $value) {
                $row = array_values($value);
                fputcsv($output, $row);
            }

            fclose($output);
            if (count($items) == 0) {
                $this->session->set_flashdata('message', ERROR_MESSAGE . ": No items availabe");
                redirect('items');
            }
        } else {
            redirect('welcome');
        }
    }

}

<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Items extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Items_model');
        $this->load->model('Categories_model');
    }

    public function vaperanger() {
        $dir     = __DIR__;
        $dir     = explode("application", $dir);
        $dir     = $dir[0];
        $command = "java -jar " . $dir . "scrapping_tools/";
        $command .= 'vaperanger.jar';

        $output = shell_exec($command);
        redirect('items');
    }

    public function show($id = NULL) {
        if (is_admin()) {
            $where         = array("p_id like " => "%" . $id . "%", "title !=" => "");
            $data['data']  = $this->Items_model->get_all_custom_where($where, $select        = FALSE);
            $data['total'] = 0;
            if ($data['data'] && !empty($data['data'])) {
                $data['total'] = count($data['data']);
            }
            $data['title'] = 'Show Items';
            $data['title'] = "Show $id Items";
            $data["id"]    = $id;
            $this->load->view('items/show', $data);
        } else {
            redirect('admin/login');
        }
    }

    public function index() {
        if (is_admin()) {
            redirect('items/show');
        } else {
            redirect('welcome');
        }
    }

    public function export_to_CSV($id = NULL) {
        if (is_admin()) {
            // this is for auction  otherwise 0.00]
            $name   = "$id exported-items"; //This will be the name of the csv file.
            header('Content-Type: text/csv; charset=utf-8');
            header('Content-Disposition: attachment; filename=' . $name . '.csv');
            $output = fopen('php://output', 'wt');
//               fputcsv($output, array('heading1', 'heading2', 'heading... n')); //The column heading row of the csv file

            $items    = $this->Items_model->get_all($limit    = FALSE, $start    = 0, $order_by = "id DESC", "p_id like ", "%$id%");

            foreach ($items as $key => $value) {
                $row=array(
                    $value['title'],
                    $value['link'],
                    $value['status'],
                    $value['published_at'],
                    $value['price'],
                    $value['category'],
                    $value['vendor'],
                    $value['image_url'],
                    $value['description'],
                );
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

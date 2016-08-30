<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Items extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Items_model');
        $this->load->model('Categories_model');
        $this->load->model('Domains_model');
    }

    public function fbscraper() {
        $filename = $_FILES["file"]["tmp_name"];
        if ($_FILES["file"]["size"] > 0) {
            $this->Domains_model->truncate();
            $file     = fopen($filename, "r");
            while (($emapData = fgetcsv($file, 100000, ",")) !== FALSE) {
                $this->Domains_model->save(array('email' => htmlentities($emapData[1])));
            }
            fclose($file);
            $dir     = __DIR__;
            $dir     = explode("application", $dir);
            $dir     = $dir[0];
            $command = "java -jar " . $dir . "scrapping_tools/";
            $command .= 'scrapers.jar';
            $output = shell_exec($command);
        } else {
            $this->session->set_flashdata('message', ERROR_MESSAGE . ": Domain name is incorrect!");
        }
        redirect('items');
    }

    public function show($id = NULL) {
        if (is_admin()) {
            $where         = FALSE; // array("p_id like " => "%" . $id . "%", "title !=" => "");
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
            $data['data']  = $this->Items_model->get_all_custom_where($where         = false, $select        = FALSE, $table         = "items");
            $data['title'] = 'Scraped Items';
            $this->load->view('items/index', $data);
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

            $items_percsv = 20;
            foreach ($items as $key => $value) {
                if (!empty($value['title'])) {

                    $item        = array(
                        $value['email'],
                        $value['link'],
                        $value['title'],
                    );
                    $information = explode(";", $value['information']);
                    foreach ($information as $key => $info) {
                        if (!empty($info)) {
                            $inf    = explode("=>", $info);
                            $item[] = isset($inf[0]) ? $inf[0] : "" . ':' . isset($inf[1]) ? $inf[1] : "";
                        }
                    }

                    $favourites = explode(";", $value['favourites']);
                    foreach ($favourites as $key => $fav) {
                        if (!empty($fav)) {
                            $inf    = explode("=>", $fav);
                            $inf1   = explode(",", $inf[1]);
                            $item[] = (isset($inf[0]) ? $inf[0] : "" ). ':' . (isset($inf1[1]) ? $inf1[1] : "");
                        }
                    }
                    $item[] = $value['image_url'];
                    fputcsv($output, $item);
                }
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

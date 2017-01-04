<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Items extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Items_model');
        $this->load->model('Categories_model');
        $this->load->model('Domains_model');
        $this->load->model('Configs_model');
        $this->load->model('Params_model');
    }

    public function scrape() {
        $string = $this->input->post('string');
        $label = $this->input->post('label');
        $greaterThan = 0; //$this->input->post('greaterThan');
        $lessThan = 0; //$this->input->post('lessThan');

        $this->Params_model->truncate();

        $dataArr = array('string' => $string, 'greaterThan' => $greaterThan, "label" => $label, 'lessThan' => $lessThan);

        $this->Params_model->save($dataArr);

        $this->session->set_flashdata('message', "Saved Successfully! Please click on scraper.bat");

        redirect('admin/scrape_items');
    }

    public function postOnMaltaPark() {
        if (is_admin()) {
            $data['user_role'] = 'admin';
            $data['title'] = 'Post Itmes On Maltapark';
            $labels=$this->Items_model->findByCondition($where=array("status"=>1), $order_by = "label", $group_by = "label", $select = 'id,label');
            $data['labels']=$labels;
            $this->load->view('items/postOnMaltapark', $data);
        } else {
            redirect('admin/login');
        }
    }

    public function startPosting() {
        $price = $this->input->post('price');
        $label = $this->input->post('label');
        $section = $this->input->post('section');
        $cat = $this->input->post('category');
        $wanted = $this->input->post('wanted');
        $wanted = ($wanted) ? 1 : 0;

        $this->Configs_model->truncate();

        $dataArr = array('price' => $price, 'section' => $section,'label'=>$label, 'category' => $cat, 'wanted' => $wanted);

        $this->Configs_model->save($dataArr);

        $this->session->set_flashdata('message', "Saved Successfully! Please click on poster.bat");

        redirect('items/postOnMaltaPark');
    }

    public function show($id = NULL) {
        if (is_admin()) {
            $where = array("p_id like " => "%" . $id . "%", "title !=" => '', "status =" => 1);
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

    public function deleteAll($id = NULL) {
        if (is_admin()) {
            $this->Items_model->truncate();
            redirect('items/show');
        } else {
            redirect('welcome');
        }
    }

}

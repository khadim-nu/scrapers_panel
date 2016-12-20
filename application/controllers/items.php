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
        $greaterThan = $this->input->post('greaterThan');
        $lessThan = $this->input->post('lessThan');

        $this->Params_model->truncate();

        $dataArr = array('string' => $string, 'greaterThan' => $greaterThan, 'lessThan' => $lessThan);

        $this->Params_model->save($dataArr);

        if (!empty($string)) {
//            $this->params_model->updateByCondition(array('id' => 1), array('url' => $domain_url));
            $dir = __DIR__;
            $dir = explode("application", $dir);
            $dir = $dir[0];
            $command = "java -jar ";
            $command .= 'scrapeAmazon.jar';
            echo 'Please run this command on terminal or CMD. <br>';
            die($command);
            $output = shell_exec($command);
        } else {
            $this->session->set_flashdata('message', ERROR_MESSAGE . ": Fill all required fields.");
        }
        redirect('items');
    }

    public function postOnMaltaPark() {
        if (is_admin()) {
            $data['user_role'] = 'admin';
            $data['title'] = 'Post Itmes On Maltapark';
            $this->load->view('items/postOnMaltapark', $data);
        } else {
            redirect('admin/login');
        }
    }

    public function startPosting() {
        $price = $this->input->post('price');
        $section = $this->input->post('section');
        $cat = $this->input->post('category');
        $wanted = $this->input->post('wanted');
        $wanted = ($wanted) ? 1 : 0;

        $this->Configs_model->truncate();

        $dataArr = array('price' => $price, 'section' => $section, 'category' => $cat, 'wanted' => $wanted);

        $this->Configs_model->save($dataArr);

        if (!empty($cat)) {
//            $this->Domains_model->updateByCondition(array('id' => 1), array('url' => $domain_url));
            $dir = __DIR__;
            $dir = explode("application", $dir);
            $dir = $dir[0];
            $command = "java -jar ";
            $command .= 'jamieTool.jar';
            echo 'Please run this command on terminal or CMD. <br>';
            die($command);
            $output = shell_exec($command);
        } else {
            $this->session->set_flashdata('message', ERROR_MESSAGE . ": Fill all required fields.");
        }
        redirect('items');
    }

    public function show($id = NULL) {
        if (is_admin()) {
            $where = array("p_id like " => "%" . $id . "%", "title !=" => "");
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

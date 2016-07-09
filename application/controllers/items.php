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

    public function show($id = NULL) {
        if (is_admin()) {
            // $data['data'] = $this->Items_model->get_all_custom_where($where = false, $select = FALSE);
            $ambiguous_alias_select = "t1.*, t2.title_eng as category_title";
            $from_tbl_1 = "items t1";
            $join_array = array(
                array('table' => 'ilance_categories t2', 'condition' => 't1.category = t2.cid', 'direction' => 'left'),
            );
            $where = array("t1.p_id like " => "%" . $id . "%");
            $data['data'] = $this->Items_model->fetch_join_multiple_limit(NULL, NULL, $ambiguous_alias_select, $from_tbl_1, $join_array, $where, $group_by = false, $order_by = "t1.id DESC");
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
            $data['title'] = "Export $id Items To CSV";
            $data['id'] = $id;
            $this->load->view('items/export', $data);
        } else {
            redirect('welcome');
        }
    }

    public function export_items($id = NULL) {
        if (is_admin()) {
            // this is for auction  otherwise 0.00
            $starting_price = $this->input->post('starting_price');

            // this is for fix  otherwise 0.00
            $buynow_price = $this->input->post('buynow_price');
            $quantity = $this->input->post('quantity');
            $filtered_auctiontype = $this->input->post('auction_type');
            $auction_split = $this->input->post('auction_split');
            $auction_price = $this->input->post('auction_price');
            if ($starting_price >= 0) {
                $name = "$id exported-items"; //This will be the name of the csv file.
                header('Content-Type: text/csv; charset=utf-8');
                header('Content-Disposition: attachment; filename=' . $name . '.csv');
                $output = fopen('php://output', 'wt');
                /*
                 * project_title, description, startprice, buynow_price, reserve_price, buynow_qty, buynow_qty_lot,
                 * project_details, filtered_auctiontype, cid, sample, currency, city, state, zipcode, country, attributes
                 */
//               fputcsv($output, array('heading1', 'heading2', 'heading... n')); //The column heading row of the csv file

                $items = $this->Items_model->get_all($limit = FALSE, $start = 0, $order_by = "id DESC", "p_id like ", "%$id%");

                $buynow_qty = $quantity;
                $buynow_qty_lot = $quantity;
                $project_details = "public";

                $currency = "CAD";
                $city = "Toronto";
                $state = "Ontario";
                $zipcode = "M9V5E6";
                $country = "Canada";

                foreach ($items as $key => $value) {
                    $price = explode("$", $value['price']);

                    $buynowprice = "";
                    $startprice = "";
                    $reserveprice = 0.00;



                    if ($filtered_auctiontype == "regular") {
                        $startprice = $price[1] + $starting_price;
                        $filteredauctiontype = "regular";
                    } else if ($filtered_auctiontype == "fixed") {
                        if ($price[1] <= $auction_split) {
                            $startprice = $price[1] + $auction_price;
                            $filteredauctiontype = "regular";
                        } else {
                            //$startprice = $price[1] + $buynow_price;
                            $buynowprice = $price[1] + $buynow_price;
                            $filteredauctiontype = "fixed";
                        }
                    } elseif ($filtered_auctiontype == "classified") {
                        $startprice = $price[1] + $starting_price;
                        $buynowprice = $price[1] + $buynow_price;
                        $filteredauctiontype = "classified";
                    }
                    $item = array(
                        $value['title'],
                        $value['description'],
                        $startprice,
                        $buynowprice,
                        $reserveprice,
                        $buynow_qty,
                        $buynow_qty_lot,
                        $project_details,
                        $filteredauctiontype,
                        $value['category'],
                        $value['image_url'],
                        $currency,
                        $city,
                        $state,
                        $zipcode,
                        $country
                    );
                    fputcsv($output, $item);
                }

                fclose($output);
                $this->session->set_flashdata('message', "Registered Successfully");
                redirect('items');
            } else {
                $this->session->set_flashdata('message', ERROR_MESSAGE . ": Price less than zero.");

                redirect('items/export_to_CSV');
            }
        } else {
            redirect('welcome');
        }
    }

}

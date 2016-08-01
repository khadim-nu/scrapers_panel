<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Items extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Items_model');
        $this->load->model('Categories_model');
    }

    public function thesource_scraper() {
        $dir = __DIR__;
        $dir = explode("application", $dir);
        $dir = $dir[0];
        $command = "java -jar " . $dir . "scrapping_tools/";
        $command .= 'thesource_scraper.jar';

        $output = shell_exec($command);
        redirect('items');
    }

    public function gianttiger_scraper() {
        $dir = __DIR__;
        $dir = explode("application", $dir);
        $dir = $dir[0];
        $command = "java -jar " . $dir . "scrapping_tools/";
        $command .= 'gianttiger_scraper.jar';

        $output = shell_exec($command);
        redirect('items');
    }

    public function gencomarketplace_scraper() {
        $dir = __DIR__;
        $dir = explode("application", $dir);
        $dir = $dir[0];
        $command = "java -jar " . $dir . "scrapping_tools/";
        $command .= 'gencomarketplace_scraper.jar';

        $output = shell_exec($command);
        redirect('items');
    }

    public function marks_scraper() {

        $perPage = 100;
        $urls_arr = array(
            "https://www.marks.com/services-rest/marks/search-and-promote/products?x1=c.category-level-1&q1=c_00614&x2=c.category-level-2&q2=c_00495&x3=c.category-level-3&q3=c_00554&count=$perPage&page=1",
            "https://www.marks.com/services-rest/marks/search-and-promote/products?x1=c.category-level-1&q1=c_00614&x2=c.category-level-2&q2=c_00495&x3=c.category-level-3&q3=c_00491&count=$perPage&page=1",
            "https://www.marks.com/services-rest/marks/search-and-promote/products?x1=c.category-level-1&q1=c_00614&x2=c.category-level-2&q2=c_00495&x3=c.category-level-3&q3=c_00555&count=$perPage&page=1",
            "https://www.marks.com/services-rest/marks/search-and-promote/products?x1=c.category-level-1&q1=c_00614&x2=c.category-level-2&q2=c_00495&x3=c.category-level-3&q3=c_00556&count=$perPage&page=1",
            "https://www.marks.com/services-rest/marks/search-and-promote/products?x1=c.category-level-1&q1=c_00614&x2=c.category-level-2&q2=c_00495&x3=c.category-level-3&q3=c_00553&count=$perPage&page=1",
            "https://www.marks.com/services-rest/marks/search-and-promote/products?x1=c.category-level-1&q1=c_00614&x2=c.category-level-2&q2=c_00495&x3=c.category-level-3&q3=c_00492&count=$perPage&page=1",
            "https://www.marks.com/services-rest/marks/search-and-promote/products?x1=c.category-level-1&q1=c_00593&x2=c.category-level-2&q2=c_00758&x3=c.category-level-3&q3=c_00723&count=$perPage&page=1",
            "https://www.marks.com/services-rest/marks/search-and-promote/products?x1=c.category-level-1&q1=c_00593&x2=c.category-level-2&q2=c_00758&x3=c.category-level-3&q3=c_00568&count=$perPage&page=1",
            "https://www.marks.com/services-rest/marks/search-and-promote/products?x1=c.category-level-1&q1=c_00593&x2=c.category-level-2&q2=c_00758&x3=c.category-level-3&q3=c_00721&count=$perPage&page=1",
            "https://www.marks.com/services-rest/marks/search-and-promote/products?x1=c.category-level-1&q1=c_00593&x2=c.category-level-2&q2=c_00758&x3=c.category-level-3&q3=c_00725&count=$perPage&page=1",
            "https://www.marks.com/services-rest/marks/search-and-promote/products?x1=c.category-level-1&q1=c_00593&x2=c.category-level-2&q2=c_00758&x3=c.category-level-3&q3=c_00724&count=$perPage&page=1",
            "https://www.marks.com/services-rest/marks/search-and-promote/products?x1=c.category-level-1&q1=c_00593&x2=c.category-level-2&q2=c_00758&x3=c.category-level-3&q3=c_00716&count=$perPage&page=1",
            "https://www.marks.com/services-rest/marks/search-and-promote/products?x1=c.category-level-1&q1=c_00593&x2=c.category-level-2&q2=c_00758&x3=c.category-level-3&q3=c_00765&count=$perPage&page=1",
            "https://www.marks.com/services-rest/marks/search-and-promote/products?x1=c.category-level-1&q1=c_00593&x2=c.category-level-2&q2=c_00758&x3=c.category-level-3&q3=c_00534&count=$perPage&page=1",
            "https://www.marks.com/services-rest/marks/search-and-promote/products?x1=c.category-level-1&q1=c_00593&x2=c.category-level-2&q2=c_00759&x3=c.category-level-3&q3=c_00571&count=$perPage&page=1",
            "https://www.marks.com/services-rest/marks/search-and-promote/products?x1=c.category-level-1&q1=c_00593&x2=c.category-level-2&q2=c_00759&x3=c.category-level-3&q3=c_00753&count=$perPage&page=1",
            "https://www.marks.com/services-rest/marks/search-and-promote/products?x1=c.category-level-1&q1=c_00593&x2=c.category-level-2&q2=c_00759&x3=c.category-level-3&q3=c_00756&count=$perPage&page=1",
            "https://www.marks.com/services-rest/marks/search-and-promote/products?x1=c.category-level-1&q1=c_00593&x2=c.category-level-2&q2=c_00759&x3=c.category-level-3&q3=c_00755&count=$perPage&page=1",
            "https://www.marks.com/services-rest/marks/search-and-promote/products?x1=c.category-level-1&q1=c_00593&x2=c.category-level-2&q2=c_00759&x3=c.category-level-3&q3=c_00752&count=$perPage&page=1",
            "https://www.marks.com/services-rest/marks/search-and-promote/products?x1=c.category-level-1&q1=c_00593&x2=c.category-level-2&q2=c_00759&x3=c.category-level-3&q3=c_00606&count=$perPage&page=1",
            "https://www.marks.com/services-rest/marks/search-and-promote/products?x1=c.category-level-1&q1=c_00593&x2=c.category-level-2&q2=c_00759&x3=c.category-level-3&q3=c_00751&count=$perPage&page=1",
            "https://www.marks.com/services-rest/marks/search-and-promote/products?x1=c.category-level-1&q1=c_00593&x2=c.category-level-2&q2=c_00757&x3=c.category-level-3&q3=c_00637&count=$perPage&page=1",
            "https://www.marks.com/services-rest/marks/search-and-promote/products?x1=c.category-level-1&q1=c_00593&x2=c.category-level-2&q2=c_00757&x3=c.category-level-3&q3=c_00740&count=$perPage&page=1",
            "https://www.marks.com/services-rest/marks/search-and-promote/products?x1=c.category-level-1&q1=c_00593&x2=c.category-level-2&q2=c_00757&x3=c.category-level-3&q3=c_00741&count=$perPage&page=1",
            "https://www.marks.com/services-rest/marks/search-and-promote/products?x1=c.category-level-1&q1=c_00593&x2=c.category-level-2&q2=c_00757&x3=c.category-level-3&q3=c_00754&count=$perPage&page=1",
            "https://www.marks.com/services-rest/marks/search-and-promote/products?x1=c.category-level-1&q1=c_00593&x2=c.category-level-2&q2=c_00757&x3=c.category-level-3&q3=c_00588&count=$perPage&page=1",
            "https://www.marks.com/services-rest/marks/search-and-promote/products?x1=c.category-level-1&q1=c_00593&x2=c.category-level-2&q2=c_00757&x3=c.category-level-3&q3=c_00714&count=$perPage&page=1",
            "https://www.marks.com/services-rest/marks/search-and-promote/products?x1=c.category-level-1&q1=c_00593&x2=c.category-level-2&q2=c_00757&x3=c.category-level-3&q3=c_00745&count=$perPage&page=1",
            "https://www.marks.com/services-rest/marks/search-and-promote/products?x1=c.category-level-1&q1=c_00593&x2=c.category-level-2&q2=c_00760&x3=c.category-level-3&q3=c_00749&count=$perPage&page=1",
            "https://www.marks.com/services-rest/marks/search-and-promote/products?x1=c.category-level-1&q1=c_00593&x2=c.category-level-2&q2=c_00760&x3=c.category-level-3&q3=c_00570&count=$perPage&page=1",
            "https://www.marks.com/services-rest/marks/search-and-promote/products?x1=c.category-level-1&q1=c_00593&x2=c.category-level-2&q2=c_00760&x3=c.category-level-3&q3=c_00747&count=$perPage&page=1",
            "https://www.marks.com/services-rest/marks/search-and-promote/products?x1=c.category-level-1&q1=c_00593&x2=c.category-level-2&q2=c_00760&x3=c.category-level-3&q3=c_00748&count=$perPage&page=1",
            "https://www.marks.com/services-rest/marks/search-and-promote/products?x1=c.category-level-1&q1=c_00593&x2=c.category-level-2&q2=c_00760&x3=c.category-level-3&q3=c_00746&count=$perPage&page=1",
            "https://www.marks.com/services-rest/marks/search-and-promote/products?x1=c.category-level-1&q1=c_00593&x2=c.category-level-2&q2=c_00760&x3=c.category-level-3&q3=c_00662&count=$perPage&page=1",
            "https://www.marks.com/services-rest/marks/search-and-promote/products?x1=c.category-level-1&q1=c_00593&x2=c.category-level-2&q2=c_00760&x3=c.category-level-3&q3=c_00750&count=$perPage&page=1",
            "https://www.marks.com/services-rest/marks/search-and-promote/products?x1=c.category-level-1&q1=c_00728&x2=c.category-level-2&q2=c_00729&x3=c.category-level-3&q3=c_00726&count=$perPage&page=1",
            "https://www.marks.com/services-rest/marks/search-and-promote/products?x1=c.category-level-1&q1=c_00728&x2=c.category-level-2&q2=c_00729&x3=c.category-level-3&q3=c_00739&count=$perPage&page=1",
            "https://www.marks.com/services-rest/marks/search-and-promote/products?x1=c.category-level-1&q1=c_00728&x2=c.category-level-2&q2=c_00729&x3=c.category-level-3&q3=c_00792&count=$perPage&page=1",
            "https://www.marks.com/services-rest/marks/search-and-promote/products?x1=c.category-level-1&q1=c_00728&x2=c.category-level-2&q2=c_00729&x3=c.category-level-3&q3=c_00782&count=$perPage&page=1",
            "https://www.marks.com/services-rest/marks/search-and-promote/products?x1=c.category-level-1&q1=c_00728&x2=c.category-level-2&q2=c_00729&x3=c.category-level-3&q3=c_00788&count=$perPage&page=1",
            "https://www.marks.com/services-rest/marks/search-and-promote/products?x1=c.category-level-1&q1=c_00728&x2=c.category-level-2&q2=c_00729&x3=c.category-level-3&q3=c_00787&count=$perPage&page=1",
            "https://www.marks.com/services-rest/marks/search-and-promote/products?x1=c.category-level-1&q1=c_00728&x2=c.category-level-2&q2=c_00729&x3=c.category-level-3&q3=c_00727&count=$perPage&page=1",
            "https://www.marks.com/services-rest/marks/search-and-promote/products?x1=c.category-level-1&q1=c_00728&x2=c.category-level-2&q2=c_00729&x3=c.category-level-3&q3=c_00497&count=$perPage&page=1",
            "https://www.marks.com/services-rest/marks/search-and-promote/products?x1=c.category-level-1&q1=c_00728&x2=c.category-level-2&q2=c_00729&x3=c.category-level-3&q3=c_00500&count=$perPage&page=1",
            "https://www.marks.com/services-rest/marks/search-and-promote/products?x1=c.category-level-1&q1=c_00728&x2=c.category-level-2&q2=c_00729&x3=c.category-level-3&q3=c_00499&count=$perPage&page=1",
            "https://www.marks.com/services-rest/marks/search-and-promote/products?x1=c.category-level-1&q1=c_00728&x2=c.category-level-2&q2=c_00729&x3=c.category-level-3&q3=c_00498&count=$perPage&page=1",
            "https://www.marks.com/services-rest/marks/search-and-promote/products?x1=c.category-level-1&q1=c_00728&x2=c.category-level-2&q2=c_00712&x3=c.category-level-3&q3=c_00710&count=$perPage&page=1",
            "https://www.marks.com/services-rest/marks/search-and-promote/products?x1=c.category-level-1&q1=c_00728&x2=c.category-level-2&q2=c_00712&x3=c.category-level-3&q3=c_00713&count=$perPage&page=1",
            "https://www.marks.com/services-rest/marks/search-and-promote/products?x1=c.category-level-1&q1=c_00728&x2=c.category-level-2&q2=c_00712&x3=c.category-level-3&q3=c_00509&count=$perPage&page=1",
            "https://www.marks.com/services-rest/marks/search-and-promote/products?x1=c.category-level-1&q1=c_00728&x2=c.category-level-2&q2=c_00528&x3=c.category-level-3&q3=c_00501&count=$perPage&page=1",
            "https://www.marks.com/services-rest/marks/search-and-promote/products?x1=c.category-level-1&q1=c_00728&x2=c.category-level-2&q2=c_00528&x3=c.category-level-3&q3=c_00510&count=$perPage&page=1",
            "https://www.marks.com/services-rest/marks/search-and-promote/products?x1=c.category-level-1&q1=c_00728&x2=c.category-level-2&q2=c_00528&x3=c.category-level-3&q3=c_00511&count=$perPage&page=1",
            "https://www.marks.com/services-rest/marks/search-and-promote/products?x1=c.category-level-1&q1=c_00728&x2=c.category-level-2&q2=c_00528&x3=c.category-level-3&q3=c_00536&count=$perPage&page=1",
            "https://www.marks.com/services-rest/marks/search-and-promote/products?x1=c.category-level-1&q1=c_00728&x2=c.category-level-2&q2=c_00528&x3=c.category-level-3&q3=c_00535&count=$perPage&page=1",
            "https://www.marks.com/services-rest/marks/search-and-promote/products?x1=c.category-level-1&q1=c_00728&x2=c.category-level-2&q2=c_00528&x3=c.category-level-3&q3=c_00493&count=$perPage&page=1"
        );
        for ($i = 0; $i < count($urls_arr); $i++) {
            try {



                $url = $urls_arr[$i];
                $content = file_get_contents($url);
                $page = json_decode($content);
                $items = $page->products;
                foreach ($items as $key1 => $item) {

                    $p_id = '';
                    $category_title = '';
                    $title = "";
                    $status = "";
                    $link = "";
                    $price = "";
                    $image_url = "";
                    $description = "";
                    $specification = "";
                    $other = "";


                    $p_id = 'marks_' . $item->code;
                    $category_title = explode('/', $item->pagePath);
                    $category_title = $category_title[3] . '=>' . $category_title[4] . '/' . $category_title[5] . '/' . $category_title[6];

//                    if ($key1 == 0) {
                    $this->Items_model->remove_record_where("p_id", $p_id);
//                    }

                    $title = $item->title;
                    $status = ($item->available == "true") ? 1 : 0;
                    $link = 'https://www.marks.com' . $item->pagePath . '.html';
                    $price = '$' . $item->price;
                    $images_arr = $item->imageAndColor;
                    foreach ($images_arr as $key => $img) {
                        $image_url .=',http://' . str_replace('//', '', $img->imageUrl);
                    }
                    $description = (strip_tags($item->longDescription[0]));
                    $specification = (($item->features));
                    $other = "";
                    $data = array("p_id" => $p_id, "category" => '', "category_title" => "$category_title", "title" => "$title", "status" => $status, "link" => "$link", "price" => $price, "image_url" => "$image_url", "description" => "$description", "specification" => "$specification", "other" => "$other");
                    $this->Items_model->save($data);
                }
            } catch (Exception $exc) {
                
            }
        }

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
            // this is for auction  otherwise 0.00]


            $quantity = $this->input->post('quantity');

            $filtered_auctiontype = $this->input->post('auction_type');

            $buynow_price = $this->input->post('buynow_price');
            $starting_price = $this->input->post('starting_price');
            $reserve_price = $this->input->post('reserve_price');

            $auction_split = $this->input->post('auction_split');
            $starting_auction = $this->input->post('starting_auction');
            $buynow_auction = $this->input->post('buynow_auction');
            $reserve_auction = $this->input->post('reserve_auction');

            $name = "$id exported-items"; //This will be the name of the csv file.
            header('Content-Type: text/csv; charset=utf-8');
            header('Content-Disposition: attachment; filename=' . $name . '.csv');
            $output = fopen('php://output', 'wt');
            /*
             * project_title, description, startprice, buynow_price, reserve_price, buynow_qty, buynow_qty_lot,
             * project_details, filtered_auctiontype, cid, sample, currency, city, state, zipcode, country, attributes
             */
//               fputcsv($output, array('heading1', 'heading2', 'heading... n')); //The column heading row of the csv file

            $items = $this->Items_model->get_all($limit = FALSE, $start = 0, $order_by = "id DESC", "p_id like ", "%$id%", $where_second_column_name = "category !=", $where_second_column_value = "");

            $buynow_qty = $quantity;
            $buynow_qty_lot = 1;
            $project_details = "public";

            $currency = "CAD";
            $city = "Toronto";
            $state = "Ontario";
            $zipcode = "M9V5E6";
            $country = "Canada";

            foreach ($items as $key => $value) {
                $value_price = str_replace(',', '', $value['price']);
                $price = explode("$", $value_price);
                $item_price = $price[1];
                if (isset($price[1])) {
                    $item_price = floatval($price[1]);
                }
                $buynowprice = "";
                $startprice = "";
                $reserveprice = 0.00;

                if ($filtered_auctiontype == "regular") {
                    $startprice = $starting_price;
                    $buynowprice = $item_price + $buynow_price; //ok
                    $reserveprice = ($buynowprice / 100) * $reserve_price;
                    $filteredauctiontype = "regular";
                } else if ($filtered_auctiontype == "fixed") {
                    if ($item_price <= $auction_split) {
                        $startprice = $starting_auction;
                        $buynowprice = $item_price + $buynow_auction; //ok
                        $reserveprice = ($buynowprice / 100) * $reserve_auction;
                        $filteredauctiontype = "regular";
                    } else {
                        $buynowprice = $item_price + $buynow_price;
                        $filteredauctiontype = "fixed";
                    }
                } elseif ($filtered_auctiontype == "classified") {
                    $startprice = $starting_price;
                    $buynowprice = $item_price + $buynow_price;
                    $reserveprice = ($buynowprice / 100) * $reserve_price;
                    $filteredauctiontype = "classified";
                }
                $imgArr = explode(',', $value['image_url']);
                $img = (isset($imgArr[1])) ? $imgArr[1] : $value['image_url'];
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
                    $img,
                    $currency,
                    $city,
                    $state,
                    $zipcode,
                    $country
                );
                fputcsv($output, $item);
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

    public function assign_categories() {
        if (is_admin()) {
            $where = array("t1.category_title !=" => "");
            /////////
            $ambiguous_alias_select = "t2.cat_id, t2.title as cat_title,count(t1.id) as total,t1.*";
            $from_tbl_1 = "items t1";
            $join_array = array(
                array('table' => 'categories t2', 'condition' => 't1.category_title = t2.title', 'direction' => 'left'),
            );
            // $where = array("t1.p_id like " => "%" . $id . "%");
            $data['data'] = $this->Items_model->fetch_join_multiple_limit(NULL, NULL, $ambiguous_alias_select, $from_tbl_1, $join_array, $where, $group_by = "t1.category_title", $order_by = "t1.p_id ASC");
            /////////////
//            $data['data'] = $this->Items_model->findByCondition($where, $order_by = "category_title ASC", $group_by = "category_title", $select = '*', $like = null);
//            var_dump($data['data']);die;
            $data['title'] = 'Assign Category IDs';
            $this->load->view('items/assign_categories', $data);
        } else {
            redirect('welcome');
        }
    }

    public function assign_cats() {
        if (is_admin()) {
            $item_cats = $_POST;
            for ($i = 1; $i < (count($item_cats) / 2 + 1); $i++) {
                $title = $this->input->post('title_' . $i);
                $id = $this->input->post('id_' . $i);

                $where = array("category_title" => $title);
                $data = array("category" => $id);
                $this->Items_model->updateByCondition($where, $data);
                /////

                if (!$this->Categories_model->get_single("title", $title)) {
                    $data = array("cat_id" => $id, "title" => $title);
                    $this->Categories_model->save($data);
                } else {
                    $where = array("title" => $title);
                    $data = array("cat_id" => $id);
                    $this->Categories_model->updateByCondition($where, $data);
                }

                /////
            }
            $this->session->set_flashdata('message', "Saved Successfully");
            redirect('items/assign_categories');
        } else {
            redirect('welcome');
        }
    }

}

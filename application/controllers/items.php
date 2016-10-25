<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Items extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Items_model');
    }

    public function vaperanger() {
//        $dir = __DIR__;
//        $dir = explode("application", $dir);
//        $dir = $dir[0];
//        $command = "java -jar " . $dir . "scrapping_tools/";
//        $command .= 'vaperanger.jar';
//
//        $output = shell_exec($command);
//        redirect('items');
        /**
         * Imports the shops ID and EHI url from xml. and link the shops ID to 
         * respective EHI urls.
         */
        date_default_timezone_set('Etc/GMT-2');
        set_time_limit(0);

        $user = 'Wassif@vapeco.com';
        $pass = 'Vape21';

//adminLogin($user,$pass);

        $url = 'https://vaperanger.com';
        $this->start($url);
        redirect('items/show');
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
            redirect('items/show');
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
            fputcsv($output, array(
                'product url extension',
                'Title',
                'Body (HTML)',
                'Vendor',
                'Type',
                'Tags',
                //
                'Option1 Name',
                'Option1 Value',
                'Option2 Name',
                'Option2 Value',
                //
                'Variant Price',
                'Variant Compare At Price',
                //
                'Image Src',
                'Image Alt Text',
                'published_at'
            )); //The column heading row of the csv file

            $items = $this->Items_model->get_all($limit = FALSE, $start = 0, $order_by = "id DESC", "p_id like ", "%$id%");

            foreach ($items as $key => $value) {

//                /450,-:-800,-:-450,-:-800,-:-450,-:-800,-:-450,-:-800,-:-
                $varinants = explode('-:-', $value['variants']);

                //Nicotine,0MG,3MG,6MG,12MG-:-Size,15ml,30ml-:-
                $options = explode('-:-', $value['options']);
                $opt1 = isset($options[0]) ? explode(',', $options[0]) : array();
                $opt2 = isset($options[1]) ? explode(',', $options[1]) : array();

                foreach ($varinants as $keyv1 => $v1) {
                    $temp_varints = explode(',', $v1);
                    if ($keyv1 == 0) {
                        $row = array(
                            explode('products/', $value['link'])[1],
                            $value['title'],
                            $value['description'],
                            $value['vendor'],
                            $value['category'],
                            $value['tags'],
                            (isset($opt1[0])) ? $opt1[0] : '',
                            (isset($opt1[1])) ? $opt1[1] : '',
                            (isset($opt2[0])) ? $opt2[0] : '',
                            (isset($opt2[1])) ? $opt2[1] : '',
                            /*
                             * 
                             */
                            (isset($temp_varints[0])) ? $temp_varints[0] : '',
                            (isset($temp_varints[1])) ? $temp_varints[1] : '',
                            $value['image_url'],
                            $value['title'],
                            $value['published_at'],
                        );
                    } else {
                        $row = array(
                            explode('products/', $value['link'])[1],
                            '',
                            '',
                            '',
                            '',
                            '',
                            '',
                            (isset($opt1[$keyv1 + 1])) ? $opt1[$keyv1 + 1] : '',
                            '',
                            (isset($opt2[$keyv1 + 1])) ? $opt2[$keyv1 + 1] : '',
                            /*
                             * 
                             */
                            (isset($temp_varints[0])) ? $temp_varints[0] : '',
                            (isset($temp_varints[1])) ? $temp_varints[1] : '',
                            '',
                            '',
                            '',
                        );
                    }

                    fputcsv($output, $row);
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

    /**
     * Logins the admin
     * 
     * @param string $user admin account email Id
     * @param string $pass admin account password
     *
     * @return string response of curl request
     */
    function adminLogin($user, $pass) {
        // Login to admin
        $url = 'https://vaperanger.com/account/login';
        $params = array(
            'customer[email]' => $user,
            'customer[password]' => $pass
        );
        return $this->curl_req($url, $params, 'post');
    }

    /**
     * Handle the linking of eKomi shops to EHI accounts
     * 
     * @param string $url The url of xml file.
     */
    function start($url) {
        $data = $this->curl_req($url);
        $data = explode('<a href="/collections/', $data);
        $collections = array();
        $count = count($data);
        for ($i = 1; $i < $count; $i++) {
            $k = explode('"', $data[$i])[0];
            $page = 'page=';
            if (strpos($k, '?') !== false)
                $page = '&' . $page;
            else
                $page = '?' . $page;
            $collections[$k] = 'https://vaperanger.com/collections/' . $k . $page;
        }
        foreach ($collections as $key => $co) {
            $continue = TRUE;
            $pageNo = 1;

            while ($continue) {
                $co .=$pageNo;
                $products = $this->curl_req($co);
                $products = explode('class="product-title" href="/products', $products);
                $total_urls = count($products);
                if ($total_urls > 1) {
                    for ($i = 1; $i < $total_urls; $i++) {
                        $produrl = explode('"', $products[$i])[0];

                        $produrl = 'https://vaperanger.com/products' . $produrl . '.js';
                        $product_data = $this->curl_req($produrl);
                        $product_data = json_decode($product_data);
                        // print_r( $product_data);
                        // die();
                        $options = $product_data->options;
                        $options_str = '';
                        foreach ($options as $key => $value) {
                            $options_str .=$value->name . ',' . implode(',', $value->values);
                            $options_str .='-:-';
                        }

                        $variants = $product_data->variants;
                        $variants_str = '';
                        foreach ($variants as $key => $value) {
                            $variants_str .=$value->price . ',' . $value->compare_at_price;
                            $variants_str .='-:-';
                        }
                        $item = array(
                            'p_id' => $product_data->id,
                            'category' => $product_data->type,
                            'vendor' => $product_data->vendor,
                            'published_at' => $product_data->published_at,
                            'title' => $product_data->title,
                            'status' => $product_data->available,
                            'tags' => implode(',', $product_data->tags),
                            'link' => 'https://vaperanger.com' . $product_data->url,
                            'price' => number_format($product_data->price / 100, 2, '.', ' '),
                            // 'price_min' => number_format($product_data->price_min / 100, 2, '.', ' '),
//                            'price_max' => number_format($product_data->price_max / 100, 2, '.', ' '),
//                            'price_varies' => number_format($product_data->price_varies / 100, 2, '.', ' '),
//                            'compare_at_price' => number_format($product_data->compare_at_price / 100, 2, '.', ' '),
//                            'compare_at_price_min' => number_format($product_data->compare_at_price_min / 100, 2, '.', ' '),
//                            'compare_at_price_max' => number_format($product_data->compare_at_price_max / 100, 2, '.', ' '),
                            'image_url' => $product_data->featured_image,
                            'description' => $product_data->description,
                            'created_at' => $product_data->created_at,
                            'options' => $options_str,
                            'variants ' => $variants_str
                        );

                        $this->Items_model->remove_record_where('p_id',$item['p_id']);
                        $this->Items_model->save($item);
                    }
                   // die('Please ask developer to configure it for all site. :)');
                } else {
                    $continue = FALSE;
                }
                $pageNo++;
            }
        }
    }

    /**
     * Submits the curl request
     * 
     * @param string $url    The url on which the curl is to be requested
     * @param array $params  (optinal) key value array of paramters
     * @param string $mehtod Type of request
     *
     * @return string response of curl request
     */
    function curl_req($url, $params = array(), $method = 'get') {
        $ch = curl_init();

        if ($method === 'post') {
            curl_setopt($ch, CURLOPT_POST, 1);
        }
        if (!empty($params)) {
            if ($method === 'post') {
                curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
            } else {
                $url .= (strpos($url, '?') === FALSE ? '?' : '&') . http_build_query($params);
            }
        }

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($ch, CURLOPT_TIMEOUT, 0);
        curl_setopt($ch, CURLOPT_FAILONERROR, 1);

        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        // Set cookiejar and cookiefile
        $cookieJar = 'cookiejar.txt';
        curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieJar);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieJar);

        // Local...
        // curl_setopt($ch, CURLOPT_PROXY, '127.0.0.1:1080');
        //curl_setopt($ch, CURLOPT_PROXYTYPE, 7);
        // Local...

        $result = curl_exec($ch);

        if (empty($result)) {
            $error = curl_error($ch);
            if (!empty($error)) {
                echo "$url: $error";
            }
        }
        curl_close($ch);

        return $result;
    }

}

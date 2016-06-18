<?php

class White_model extends CI_Model {

    private $testApiKey = 'sk_test_1234567890abcdefghijklmnopq';

    public function __construct() {
        parent::__construct();

        $this->load->library('White_charge_custom');
    }
    public function insert_items($amount,$ids,$response,$cart_items,$gateway = 'White', $participation_required = true, $top_up = false){
        $this->load->model('Paymenthistory_model');
        $this->load->model('Participations_model');
        $session_data = $this->session->userdata('user_data');
        
        $referrer_type = 'Competition';
        if ($top_up) { $referrer_type = 'Top up';}
        
        $insertDataPaymentHistory = array(
            'userID' => $session_data->id,
            'type' => 'credit',
            'reason' => $this->session->userdata('current_cart_description'),
            'amount' => $amount['total'],
            'referrer_id' => $ids,
            'referrer_type' => $referrer_type,
            'transaction_id' => $response,
            'gateway' => $gateway
        );
        $this->Paymenthistory_model->save($insertDataPaymentHistory);
            
        if ($participation_required) {
            $insertDataParticipants = array(
                'playerID' => $session_data->id,
                'competitionID' => $cart_items[0]['id'],
                'userName' => $session_data->userName,
                'status' => 1
            );
            $this->Participations_model->save($insertDataParticipants);
        }

        if ($top_up) {
            $this->db->set('v$', 'v$ + ' . $amount['total'], FALSE);
            $this->db->where('id = ' . $session_data->id);
            $this->db->update('player');
            
            $session_data->{'v$'} = $session_data->{'v$'} + $amount['total'];
            $this->session->set_userdata('user_data', $session_data);
        }

        $this->session->set_userdata('current_cart_items', '');
        $this->session->set_userdata('type', '');
        $this->session->set_userdata('competition_id', '');
        $this->session->set_userdata('name', '');
        $this->session->set_userdata('price', '');
    }
    public function charge() {
        $items = array();
        $total = 0.00;
        $cart_items = $this->session->userdata('current_cart_items');
        $ids = '';

        foreach ($cart_items as $i) {
            $item = array();
            $item['quantity'] = $i['quantity'];
            $item['name'] = $i['name'];
            $item['price'] = floatval($i['price']);
            $item['currency'] = $i['currency'];
            array_push($items, $item);
            $total = $total + $item['price'];
            $ids .= $i['id'] . ',';
        }

        $amount = array();
        $amount['total'] = floatval($total);
        $amount['currency'] = $this->input->post('currency');

        $white = new White_charge_custom;
        $white->set_api_key($this->testApiKey);
        $response = $white->charge($total, $amount['currency'], $this->input->post('number'), $this->input->post('expire_month'), $this->input->post('expire_year'), $this->input->post('cvc'), $this->session->userdata('current_cart_description'));

        if ($response['is_captured'] && $response['tag'] && !array_key_exists('error', $response)) {
/////////////////////
            $this->insert_items($amount, $ids, $response['tag'], $cart_items);
/////////////////////
            return true;
        } else {
            return false;
        }
    }

}

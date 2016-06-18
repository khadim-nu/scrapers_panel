<?php

class Paypal_model extends CI_Model {

    private $tokenUrl = 'https://api.sandbox.paypal.com/v1/oauth2/token';
    private $paymentUrl = 'https://api.sandbox.paypal.com/v1/payments/payment';
    private $client = 'Ab6uEhBlyM4XdpB1tOC4MA43cSGNf0_7ckkrRD_WjPIhbnCwgDG4YBdgUUcs';
    private $secret = 'EK_RKxCDzj_udD0NfzFxCWITNkCaFYU5NjCUZO266CKPa5yVrsGxLjxh4pvQ';
    private $token;
    private $tokenHandle;
    private $paymentHandle;

    public function __construct() {
        parent::__construct();
        $this->tokenHandle = curl_init($this->tokenUrl);
        $this->buildTokenRequest();
    }

    public function buildTokenRequest() {
        $header = array(
            'Accept: application/json',
            'Accept-Language: en_US'
        );

        $user = $this->client . ':' . $this->secret;

        $data = 'grant_type=client_credentials';

        curl_setopt($this->tokenHandle, CURLOPT_HTTPHEADER, $header);
        curl_setopt($this->tokenHandle, CURLOPT_USERPWD, $user);
        curl_setopt($this->tokenHandle, CURLOPT_POSTFIELDS, $data);
        curl_setopt($this->tokenHandle, CURLOPT_RETURNTRANSFER, true);

        $this->commitTokenRequest();
    }

    public function commitTokenRequest() {
        $response = json_decode(curl_exec($this->tokenHandle));

        $this->token = $response->access_token;

        curl_close($this->tokenHandle);
    }

    public function buildPaymentRequest($items, $amount, $description) {
        $this->paymentHandle = curl_init($this->paymentUrl);

        $header = array(
            'Accept: application/json',
            'Content-Type: application/json',
            'Accept-Language: en_US',
            'Authorization:Bearer ' . $this->token
        );
        $data = array(
            'intent' => 'sale',
            'payer' => array(
                'payment_method' => $this->input->post('payment_method'),
                'funding_instruments' => array(
                    array(
                        'credit_card' => array(
                            'number' => $this->input->post('number'), // '4982615950233071',
                            'type' => $this->input->post('type'), //'visa',
                            'expire_year' => $this->input->post('expire_year'), //'2018',
                            'expire_month' => $this->input->post('expire_month'), // '04',
                            'first_name' => $this->input->post('first_name'), // 'Kamil',
                            'last_name' => $this->input->post('last_name')// 'Ilyas'
                        )
                    )
                )
            ),
            'transactions' => array(
                '0' => array(
                    'item_list' => array(
                        "items" => $items
                    ),
                    'amount' => $amount,
                    'description' => $description
                )
            )
        );
        $d = json_encode($data);
        curl_setopt($this->paymentHandle, CURLOPT_HTTPHEADER, $header);
        curl_setopt($this->paymentHandle, CURLOPT_USERPWD, $this->client . ':' . $this->secret);
        //curl_setopt($$this->paymentHandle, CURLOPT_HTTPHEADER, true);
        curl_setopt($this->paymentHandle, CURLOPT_POSTFIELDS, $d);
        curl_setopt($this->paymentHandle, CURLOPT_RETURNTRANSFER, true);
        return $this->commitPaymentRequest();
    }

    public function commitPaymentRequest() {
        $response = json_decode(curl_exec($this->paymentHandle));
        if (isset($response->name)) {
            $msg = ERROR_MESSAGE.':VALIDATION_ERROR <br>' . $response->message;
            $this->session->set_flashdata('message', $msg);
            curl_close($this->paymentHandle);
            return false;
        } else {
            $txn_id = $response->transactions[0]->related_resources[0]->sale->id;
            curl_close($this->paymentHandle);
            return $txn_id;
        }
    }
    
    public function adaptive_implicit_payment() {
        # Get the Player's Paypal ID
        $this->load->model('Player_model');
        $this->load->model('Paymenthistory_model');
        $this->load->model('Withdrawal_requests_model');
        
        $where = 'id = ' . $this->input->post('player_id');
        $player = $this->Player_model->findByCondition($where);
        
        $response['status'] = false;
        $response['message'] = ERROR_MESSAGE.':Something went wrong, the request could not be completed';
        
        if (!empty($player) && $player[0]['paypal_id'] != '' && $player[0]['paypal_id'] != null && $this->input->post('amount') > 0 && $player[0]['actual_money'] >= $this->input->post('amount')) {
            $payRequest = new PayRequest();
            
            $receiver = array();
            $receiver[0] = new Receiver();
            $receiver[0]->amount = $this->input->post('amount');
            $receiver[0]->email = $player[0]['paypal_id'];

            $receiverList = new ReceiverList($receiver);
            
            
            $payRequest->receiverList = $receiverList; 			
            $payRequest->senderEmail = "platfo_1255077030_biz@gmail.com";
            
            $requestEnvelope = new RequestEnvelope("en_US");
            $payRequest->requestEnvelope = $requestEnvelope; 
            $payRequest->actionType = "PAY";
            $payRequest->cancelUrl = base_url() . 'admin/payment_error';
            $payRequest->returnUrl = base_url() . 'admin/payment_success';
            $payRequest->currencyCode = "USD";
            
            $sdkConfig = array(
                "mode" => "sandbox",
                "acct1.UserName" => "jb-us-seller_api1.paypal.com",
                "acct1.Password" => "WX4WTU3S8MY44S7F",
                "acct1.Signature" => "AFcWxV21C7fd0v3bYYYRCpSSRl31A7yDhhsPUU2XhtMoZXsWHFxu-RWy",
                "acct1.AppId" => "APP-80W284485P519543T"
            );

            $adaptivePaymentsService = new AdaptivePaymentsService($sdkConfig);
            $payResponse = $adaptivePaymentsService->Pay($payRequest);
            
            $ack = strtoupper($payResponse->responseEnvelope->ack);
            
            if($ack != "SUCCESS") {
            }
            else {
                
                $insertDataPaymentHistory = array(
                    'userID'    => $player[0]['id'],
                    'type'      => 'debit',
                    'reason'    => 'Payment to a player on behalf of a request',
                    'amount'    => $this->input->post('amount'),
                    'referrer_id'   => $player[0]['id'],
                    'referrer_type' => 'Player',
                    'transaction_id'=> '',
                    'gateway'       => 'Paypal'
                );
                $id = $this->Paymenthistory_model->save($insertDataPaymentHistory);
                
                if ($this->input->post('withdrawal_id') != '' && $this->input->post('withdrawal_id') != null) {
                    $where = 'id = ' . $this->input->post('withdrawal_id');
                    $updateDataWithdrawal = array(
                        'approved'      => is_withdrawal_approved(),
                        'payment_id'    => $id
                    );
                    $this->Withdrawal_requests_model->updateByCondition($where, $updateDataWithdrawal);
                    
                    $body = 'You sent a withdrawal request on your paypal id: ' .$player[0]['paypal_id']. ' which has been approved and an amount of $' . $this->input->post('amount') . ' has been sent to your paypal account, please verify.';
                }
                else{
                    $new_balance = floatval(floatval($player[0]['actual_money']) - floatval($this->input->post('amount')));
                    $where = 'id = ' . $player[0]['id'];
                    $updateDataPlayer = array(
                        'actual_money'      => $new_balance,
                    );
                    $id = $this->Player_model->updateByCondition($where, $updateDataPlayer);

                    $body = 'An amount of $' .$this->input->post('amount'). ' has been sent on your paypal id: ' .$player[0]['paypal_id']. ', please verify.';
                }

                mail_me(array(
                    'to' => $player[0]['email'], 
                    'to_name' => $player[0]['fName'] .' '. $player[0]['lName'], 
                    'from' => $this->config->item('adminEmail'), 
                    'from_name' => $this->config->item('adminName'), 
                    'from_pass' => $this->config->item('adminEmail_pass'), 
                    'subject' => 'Payment Made', 
                    'body' => $body)
                );
                
                $response['status'] = true;
                $response['message'] = 'Payment Sucessfully made';
            }
        }

        return $response;
    }
    
    public function adaptive_implicit_payment_developer() {
        # Get the Player's Paypal ID
        $this->load->model('Developer_model');
        $this->load->model('Paymenthistory_model');
        $this->load->model('Withdrawal_requests_model');
        
        $where = 'id = ' . $this->input->post('player_id');
        $player = $this->Developer_model->findByCondition($where);
        
        $response['status'] = false;
        $response['message'] = ERROR_MESSAGE.':Something went wrong, the request could not be completed';
        
        if (!empty($player) && $player[0]['paypal_id'] != '' && $player[0]['paypal_id'] != null && $this->input->post('amount') > 0 && $player[0]['amount'] >= $this->input->post('amount')) {
            $payRequest = new PayRequest();
            
            $receiver = array();
            $receiver[0] = new Receiver();
            $receiver[0]->amount = $this->input->post('amount');
            $receiver[0]->email = $player[0]['paypal_id'];

            $receiverList = new ReceiverList($receiver);            
            
            $payRequest->receiverList = $receiverList; 			
            $payRequest->senderEmail = "platfo_1255077030_biz@gmail.com";
            
            $requestEnvelope = new RequestEnvelope("en_US");
            $payRequest->requestEnvelope = $requestEnvelope; 
            $payRequest->actionType = "PAY";
            $payRequest->cancelUrl = base_url() . 'admin/payment_error';
            $payRequest->returnUrl = base_url() . 'admin/payment_success';
            $payRequest->currencyCode = "USD";
            
            $sdkConfig = array(
                "mode" => "sandbox",
                "acct1.UserName" => "jb-us-seller_api1.paypal.com",
                "acct1.Password" => "WX4WTU3S8MY44S7F",
                "acct1.Signature" => "AFcWxV21C7fd0v3bYYYRCpSSRl31A7yDhhsPUU2XhtMoZXsWHFxu-RWy",
                "acct1.AppId" => "APP-80W284485P519543T"
            );

            $adaptivePaymentsService = new AdaptivePaymentsService($sdkConfig);
            $payResponse = $adaptivePaymentsService->Pay($payRequest);
            
            $ack = strtoupper($payResponse->responseEnvelope->ack);
            
            if($ack != "SUCCESS") {
            }
            else {
                
                $insertDataPaymentHistory = array(
                    'userID'    => $player[0]['id'],
                    'type'      => 'debit',
                    'reason'    => 'Payment to a developer on behalf of a request',
                    'amount'    => $this->input->post('amount'),
                    'referrer_id'   => $player[0]['id'],
                    'referrer_type' => 'Developer',
                    'transaction_id'=> '',
                    'gateway'       => 'Paypal'
                );
                $id = $this->Paymenthistory_model->save($insertDataPaymentHistory);
                
                if ($this->input->post('withdrawal_id') != '' && $this->input->post('withdrawal_id') != null) {
                    $where = 'id = ' . $this->input->post('withdrawal_id');
                    $updateDataWithdrawal = array(
                        'approved'      => is_withdrawal_approved(),
                        'payment_id'    => $id
                    );
                    $this->Withdrawal_requests_model->updateByCondition($where, $updateDataWithdrawal);
                    
                    $body = 'You sent a withdrawal request on your paypal id: ' .$player[0]['paypal_id']. ' which has been approved and an amount of $' . $this->input->post('amount') . ' has been sent to your paypal account, please verify.';
                }
                else{
                    $new_balance = floatval(floatval($player[0]['amount']) - floatval($this->input->post('amount')));
                    $where = 'id = ' . $player[0]['id'];
                    $updateDataPlayer = array(
                        'amount'      => $new_balance,
                    );
                    $id = $this->Developer_model->updateByCondition($where, $updateDataPlayer);

                    $body = 'An amount of $' .$this->input->post('amount'). ' has been sent on your paypal id: ' .$player[0]['paypal_id']. ', please verify.';
                }

                mail_me(array(
                    'to' => $player[0]['email'], 
                    'to_name' => $player[0]['fName'] .' '. $player[0]['lName'], 
                    'from' => $this->config->item('adminEmail'), 
                    'from_name' => $this->config->item('adminName'), 
                    'from_pass' => $this->config->item('adminEmail_pass'), 
                    'subject' => 'Payment Made', 
                    'body' => $body)
                );
                
                $response['status'] = true;
                $response['message'] = 'Payment Sucessfully made';
            }
        }

        return $response;
    }

}

<?php

function social_login($provider) {

    $CI = & get_instance();
    $CI->load->library('HybridAuthLib');
    if ($CI->hybridauthlib->providerEnabled($provider)) {
        $service = $CI->hybridauthlib->authenticate($provider);
        if ($service->isUserConnected()) {
            $user_profile = $service->getUserProfile();
            return $user_profile;
        } else {
            show_error('Cannot authenticate user');
            return false;
        }
    }
}

function getCurlData($url) {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_TIMEOUT, 10);
    curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.16) Gecko/20110319 Firefox/3.6.16");
    $curlData = curl_exec($curl);
    curl_close($curl);
    return $curlData;
}

function isHuman($recaptcha) {
    $google_url = "https://www.google.com/recaptcha/api/siteverify";
    $secret = '6LeHxwkTAAAAADhEFzPb8eF_XaF3VGoy6ZThtXWh';
    $ip = $_SERVER['REMOTE_ADDR'];
    $url = $google_url . "?secret=" . $secret . "&response=" . $recaptcha . "&remoteip=" . $ip;
    $res = getCurlData($url);
    $res = json_decode($res, true);
//reCaptcha success check 
    if ($res['success']) {
        return TRUE;
    } else {
        return FALSE;
    }
}

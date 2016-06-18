<?php

class MY_Exceptions extends CI_Exceptions {

    function __construct() {
        parent::__construct();
    }

    function show_error($heading, $message, $template = 'error_general', $status_code = 500) {
        if (ENVIRONMENT === 'production') {

            if ($status_code == 500) {
                $this->_report_error($message);
            }

            return parent::show_error("Wakakak", "lalalal", $template = 'error_general', $status_code = 500);
        }else{
            return parent::show_error($heading, $message, $template = 'error_general', $status_code = 500);
        }
    }

    function log_exception($severity, $message, $filepath, $line) {
        parent::log_exception($severity, $message, $filepath, $line);
    }

    function _get_debug_backtrace($br = "<BR>") {
        $trace = array_slice(debug_backtrace(), 3);
        $msg = '<code>';
        foreach ($trace as $index => $info) {
            if (isset($info['file'])) {
                $msg .= $info['file'] . ':' . $info['line'] . " -> " . $info['function'] . '(' . $info['args'] . ')' . $br;
            }
        }
        $msg .= '</code>';
        return $msg;
    }

    function _report_error($subject) {



        $CI = & get_instance();

        $CI->load->library('Rabbitmq');
        $CI->load->helper('email_sender');

        $body = '';

        $body .= 'Request: <br/><br/><code>';
        foreach ($_REQUEST as $k => $v) {
            $body .= $k . ' => ' . $v . '<br/>';
        }
        $body .= '</code>';

        $body .= '<br/><br/>Server: <br/><br/><code>';
        foreach ($_SERVER as $k => $v) {
            $body .= $k . ' => ' . $v . '<br/>';
        }
        $body .= '</code>';

        $body .= '<br/><br/>Stacktrace: <br/><br/>';
        $body .= serialize($subject);



        $data = array();
        $data['to'] = "shakaib@incubasys.com";
        $data['to_name'] = "shakaib";
        $data['from'] = ADMIN_EMAIL;
        $data['from_name'] =ADMIN_NAME;
        $data['from_pass'] = ADMIN_EMAIL_PASSWORD;
        $data['subject'] = "Exception"; 
        $data['body'] = $body;

        mail_me($data);
    }

}

?>
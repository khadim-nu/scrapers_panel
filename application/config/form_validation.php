<?php

$config = array(
    
    'admin-registration' => array(
        array(
            'field' => 'name',
            'label' => 'Name',
            'rules' => 'trim|required|name_pattern|min_length[' . TITLE_LIMIT_MIN . ']|max_length[' . TITLE_LIMIT_MAX . ']'
        ),
        array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'trim|valid_email|required|is_unique[admin.email]'
        )
    ),
    'admin-edit' => array(
        array(
            'field' => 'name',
            'label' => 'Name',
            'rules' => 'trim|required|name_pattern|min_length[' . TITLE_LIMIT_MIN . ']|max_length[' . TITLE_LIMIT_MAX . ']'
        )
    ),
    'login' => array(
        array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'trim|required|valid_email'
        ),
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'trim|required|min_length[' . PASSWORD_MIN_LEN . ']|max_length[' . PASSWORD_MAX_LEN . ']'
        )
    ),
    'forgot_password' => array(
        array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'trim|required|valid_email'
        )
    )
);

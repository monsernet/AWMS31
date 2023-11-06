<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config = array(
    'password_validation' => array(
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'trim|required|min_length[6]|callback_password_check'
        )
    )
);

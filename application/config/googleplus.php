<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['googleplus']['application_name'] = 'SocialSportz';
$config['googleplus']['client_id']        = '588043116436-l2h7ddi9meubik5idikpk498a9mj6lso.apps.googleusercontent.com';
$config['googleplus']['client_secret']    ='GL-kVeO1y_FMXLIug9Yb0Cyv';
$config['googleplus']['redirect_uri']     = base_url('login/index');
//$config['googleplus']['redirect_uri_connect']     = base_url('common/connect/connect_to_googleplus');
$config['googleplus']['api_key']          = 'AIzaSyDdn4EphPPuVRZ1c2S1rh5-Z_kfUOHO3CI'; 
$config['googleplus']['scopes']			  = array('email','profile');
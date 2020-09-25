<?php
//////////////////////////////////////////////////////////////
/*
 * PROJECT          : UNIBIZ
 * MODULE           : Google
 * APPLICATION 		: Google CONTROLLER
 * AUTHOR			: ANIL DUBEY
 * CONTRIBUTORS     : ANIL DUBEY
 * VERSION			: 1.0
 * LICENSE          : MIT LICENSE
 * COPYRIGHT		: COPYRIGHT (c) 2017 ETHANE TECHNOLOGIES PVT. LTD.
 */
//////////////////////////////////////////////////////////////

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Google Controller Class
 *
 * This class object is the child class of Public_Controller Class
 *
 * @package		UNIBIZ
 * @subpackage	PUBLIC
 * @category	CATALOG
 * @author		Vibes Development Team
 * @link		https://makingsite.in/unibiz/user_gutrader_ide/Controller.html/#Google_ctrl
 */

class Google_ctrl extends CI_Controller {
	
	public function __construct() {
        parent::__construct();
		//$this->lang->load(array('public/__account/Login'), $this->data['public_language_dir']);
		$this->load->library('__social_media/__googleplus/googleplus');
		$this->config->load('googleplus');
    }

	public function index(){
		//$this->load->model('Account_mdl');
		//if($this->session->userdata('user') == true){
			//redirect(base_url());
		//}
		if (isset($_GET['code'])) {
			//print_r($_GET['code']);
			//authenticate user
            $this->googleplus->getAuthenticate();
			//fetch user data
			$userProfile = $this->googleplus->getUserInfo();
			print_r($userProfile);die;
			
			
            // Preparing data for database insertion
           echo  $userData['oauth_provider'] = 'googleplus';
            echo $userData['oauth_uid'] = $userProfile['id'];
            echo $userData['first_name'] = ucwords($userProfile['given_name']);
            echo $userData['last_name'] = ucwords($userProfile['family_name']);
            echo $userData['email'] = isset($userProfile['email'])?$userProfile['email']:''; die();

            // Insert or update user data
            $userID = $this->Account_mdl->login_with_gPlus($userData);
			if(!empty($userID)){
				if($userData['email'] == ''){
					$this->session->set_flashdata('fb_no_email','No email found');
					redirect(base_url());
				}
				redirect(base_url());
			} else{
				$this->session->set_flashdata('sm_login_error','Error login with gmail');
				redirect(base_url());
			}
			
		} else{
			$this->session->set_flashdata('sm_login_error','Error login with gmail');
			redirect(base_url());
		}
	}
}
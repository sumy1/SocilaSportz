<?php
//////////////////////////////////////////////////////////////
/*
 * PROJECT          : UNIBIZ
 * MODULE           : Facebook
 * APPLICATION 		: Facebook CONTROLLER
 * AUTHOR			: Anil Dubey
 * CONTRIBUTORS     : Anil Dubey
 * VERSION			: 1.0
 * LICENSE          : MIT LICENSE
 * COPYRIGHT		: COPYRIGHT (c) 2017 ETHANE TECHNOLOGIES PVT. LTD.
 */
//////////////////////////////////////////////////////////////

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Facebook Controller Class
 *
 * This class object is the child class of Public_Controller Class
 *
 * @package		UNIBIZ
 * @subpackage	PUBLIC
 * @category	CATALOG
 * @author		Ethane Development Team
 * @link		https://makingsite.in/unibiz/user_gutrader_ide/Controller.html/#Facebook_ctrl
 */

class Facebook_ctrl extends CI_Controller {
    
    /**
     * Class constructor
     *
     * @return	votrader_id
     */
    public function __construct() {
        parent::__construct();
		//$this->lang->load(array('public/__account/Login'), $this->data['public_language_dir']);
		$this->load->library('__social_media/__facebook/facebook');
    }
	
	public function index(){
		//$this->load->model('Account_mdl');
		// Load facebook library
		$userData = array();
		// Check if user is logged in
		if($this->facebook->is_authenticated()){
			// Get user facebook profile details
			$userProfile = $this->facebook->request('get', '/me?fields=id,first_name,last_name,email,gender,locale,picture');
		
			
			print_data($userProfile);
			$userData['email'] = '';
            // Preparing data for database insertion
            $userData['oauth_provider'] = 'facebook';
            $userData['oauth_uid'] = $userProfile['id'];
            $userData['first_name'] = ucwords($userProfile['first_name']);
            $userData['last_name'] = ucwords($userProfile['last_name']);
            $userData['email'] = isset($userProfile['email'])?$userProfile['email']:'';

            // Insert or update user data
            $userID = $this->Account_mdl->login_with_fb($userData);
			if(!empty($userID)){
				if($userData['email'] == ''){
					$this->session->set_flashdata('fb_no_email','No email found');
					redirect(base_url());
				}
				redirect(base_url());
			} else{
				$this->session->set_flashdata('fb_login_error','Error login with gmail');
				redirect(base_url());
			}
		} else{
			$this->session->set_flashdata('sm_login_error','Error login with gmail');
			redirect(base_url());
		}
	}
	
}
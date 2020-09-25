<?php
defined('BASEPATH') OR exit('No direct script access allowed');


require APPPATH . '/libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php'; 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

class Webs extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

	public function validateToken($auth_token){
		$is_token =  $this->CommonMdl->getRow('tbl_tokan','tokan_id',array('tokan_auth_key'=>$auth_token));
		
		return $is_token;
	}
 public function user_query_listing(){
	 $return_array=array();
	 $headers = $this->input->request_headers();
	 $is_token = $this->validateToken($headers['x-auth']);
	 if(!$is_token){
		 $return_array = array(
				'cmd' =>'user query rating',
				'status'=>'0',
				'response'=>$return_array,
				'response_messege' =>'Invalid Token',
			);
			$output=json_encode($return_array);
			echo trim($output,'"');
			exit;
	 }
	 
  
	if(isset($_REQUEST['user_id'])){
       if($_REQUEST['user_id']==''){
		  $return_array=array(
			'cmd'=>'user_id',
			'status'=>'0',
			'response'=>'user_id is required',
			'response_messege'=>'user_id is required'
	      );
		}
		$data['user_query_listing'] =  $this->CommonMdl->getResultByCond('tbl_user_query_to_facility',array('user_id'=>$_REQUEST['user_id']),'*',$order_by='');	  
		  foreach($data['user_query_listing'] as $querylistingkey=>$querylistingVal){
				$data['facility_name'] =  $this->CommonMdl->getRow('tbl_facility','*',array('fac_id'=>$querylistingVal->fac_id));
				$data['user_query_listing'][$querylistingkey]->facility_name=$data['facility_name'];	 
		  }
		  if($data['user_query_listing']){
			  $return_array = array(
					'cmd' =>'User query listing',
					'status'=>'1',
					'response'=>$data['user_query_listing'],
					'response_messege' =>'User query listing',
		);
	  }else{
		   $return_array = array(
				'cmd' =>'User query listing',
				'status'=>'1',
				'response'=>$return_array,
				'response_messege' =>'User query listing',
			);
	  }
	}else{
		$return_array = array(
				'cmd' =>'user query rating',
				'status'=>'1',
				'response'=>$return_array,
				'response_messege' =>'user query is parameter missing',
			);
	}
	$output=json_encode($return_array);
    echo trim($output,'"');
 }

	
	public function getToken(){
		
		$tokenData = array();
		$tokenData['id'] = 1; //TODO: Replace with data for token
		$output['token'] = AUTHORIZATION::generateToken($tokenData);
		
		
		
	}
	
	
}

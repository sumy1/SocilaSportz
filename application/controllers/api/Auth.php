<?php
ini_set("display_errors",0);
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public  function __construct()

    {

   	    parent::__construct();
   	    $this->load->model('ApiMdl');
	}
	
     //send mail
	 public function send_email($data){
			
			  $url= base_url('email_script.php');
			  $handle = curl_init($url);
			  curl_setopt($handle, CURLOPT_POST, true);
			  curl_setopt($handle, CURLOPT_POSTFIELDS, $data);
			  $res=curl_exec($handle);          
			  curl_close($handle);
			  ob_clean();
		}
	
//user login 
public function user_login(){
	$return_array = array();

	if(isset($_REQUEST['user_email']) && $_REQUEST['user_password']!=''){

	$useremail = $_REQUEST['user_email'];
	$userpassword = md5($_REQUEST['user_password']);
	
	$result = $this->CommonMdl->getRow('tbl_user','*',array('user_email'=>$useremail,'user_password'=>$userpassword,'is_mobile_verified'=>'yes','user_status'=>'enable'));
	// echo $this->db->last_query();
	// print_r($result); die;
	// echo count($result);
	if($result){
	
	$my_facility_aminity=$this->CommonMdl->getRow('tbl_user','*',array('user_id'=>$result->user_id));
	
	   foreach($my_facility_aminity as $kk=>$v)
				{
					$my_facility_aminitys=$this->CommonMdl->getResultByCond('tbl_facility_amenities',array('user_id'=>$v),$order_by='');
					
					// $user_bank_details=$this->CommonMdl->getResultByCond('tbl_user_bank_details',array('user_id'=>$v),$order_by='');
					
					
					$user_bank_details = $this->CommonMdl->getRow('tbl_user_bank_details','*',array('user_id'=>$v));
					
					$sport_get = $this->CommonMdl->getResult('tbl_sport_list','*');
					
					
				}
				$result->my_facility_aminity=$my_facility_aminitys;
				
			if($user_bank_details!=''){
				$user_bank_details->folder_name="bankinfo";
				$result->user_bank_details=$user_bank_details;
			}
			else{
				$user_bank_details->folder_name="bankinfo";
				$result->user_bank_details=$user_bank_details=null;
			}
			
			 foreach($sport_get as $key=>$val){
				   $sport_get[$key]->folder_name="sports";
				 
				 
			 }
				$result->sport_list=$sport_get;

				
	     $get_sport_list=$this->CommonMdl->getResultByCond('tbl_sport_list',array('sport_status'=>'enable'),'sport_id,sport_name,sport_icon,created_on,sport_status',$order_by='');
				//$get_sport_list=array('sport_list'=>$get_sport_list);

				//amenity_list
				$get_amenities_data= $this->CommonMdl->getResultByCond('tbl_amenity',array('amenity_status'=>'enable'),'amenity_id,amenity_name,amenity_icon',$order_by='');
				//$get_amenities_data=array('amenities_list'=>$get_amenities_data);
				//get_amenities_data

			
				$reward_achievement_list=$this->CommonMdl->getResultByCond('tbl_reward_achievement',array('reward_status'=>'enable'),'reward_id,reward_name',$order_by='');
				
				
				
				
				
				
				foreach($get_sport_list as $kk=>$v)
				{
					
				 	$get_sport_list[$kk]->folder_name= "sports";
				}
				$result->amenities_list=$get_amenities_data;
				
				
			
				
				foreach($get_amenities_data as $k=>$v)
				{
					$get_amenities_data[$k]->folder_name= "amenity";
				}
				 $result->amenities_list=$get_amenities_data;
				
				foreach($reward_achievement_list as $k=>$v)
				{
					$reward_achievement_list[$k]->folder_name= "rewards";
				}
				$result->reward_achievement_list=$reward_achievement_list;
				
			
				
				$facility_list=$this->CommonMdl->getResultByCond('tbl_facility',array('user_id'=>$result->user_id),'*',$order_by='');
		      
             
				foreach($facility_list as $k=>$v)
				{
				
					//echo  $v->fac_id;
					$facility_list[$k]->folder_name= "fac";
					 $facility_timing_list=$this->CommonMdl->getResultByCond('tbl_facility_timing',array('fac_id'=>$v->fac_id),$order_by='');
					 $facility_list[$k]->fac_timing_list=$facility_timing_list;
					 
					 $facility_reward_achievement=$this->CommonMdl->getResultByCond('tbl_facility_reward_achievement',array('fac_id'=>$v->fac_id),$order_by='');
					 
					 foreach($facility_reward_achievement as $key=>$val){
						 $facility_reward_achievement[$key]->folder_name="rewards";
					
					}
					
					
					 $facility_list[$k]->reward_achievement_list=$facility_reward_achievement;
					  
					
					 
					 
					 $facility_sport=$this->CommonMdl->getResultByCond('tbl_facility_sport',array('fac_id'=>$v->fac_id),$order_by='');
					 $facility_list[$k]->facility_sport_list=$facility_sport;
					 
					 
					 
				}
				 $result->facility_list=$facility_list;
			$tokenData = array();
			$tokenData['id'] = array('user_id'=>base64_encode($result->user_id),'user_name'=>$result->user_name,'date'=>date("Y-m-d H:i:s"));
					

			$output['token'] = AUTHORIZATION::generateToken($tokenData);
			$dataArr=array(
				'tokan_user_id'=>$result->user_id,
				'tokan_auth_key'=>$output['token'],
				'created_on'=>date('y-m-d h:i:s'),
				'updated_on'=>date('y-m-d h:i:s')
			);
			$this->CommonMdl->insertRow($dataArr,'tbl_tokan');
			
//$get_tokan=$this->CommonMdl->getRow('tbl_tokan','tokan_auth_key','');
			
			$result->tokan_list=$output['token'];
			
			
			  
			  
				 
			
				
				
				
				
		
	if(!empty($result)) {
     $return_array = array(
			'cmd' =>'login',
			'status'=>'1',
			'response'=>$result,
			'response_messege' =>'Login successfull'
			);
	}else{
		$return_array = array(
			'cmd' =>'login',
			'status'=>'0',
			'response'=>'',
			'response_messege' =>'Login email and password did not match'
			);
	}
	}
	
	else{
		$return_array = array(
			'cmd' =>'login',
			'status'=>'0',
			'response'=>'',
			'response_messege' =>'Login email and password did not match'
			);
	}


	}

	else
	{
	$return_array = array(
	'cmd' => 'login',
	'status' =>'0',
	'response' =>'0',
	'response_messege' =>'email or password is missing'
	);
	}


	$output = json_encode($return_array);

	echo trim($output,'"');
}


	

}
<?php
ini_set("display_errors",0);
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

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
				 
				 
			
				
				
				
				
		
	if(!empty($result)) {

		
		$return_array = array(
			'cmd' =>'login',
			'status'=>'1',
			'response'=>$result,
			'response_messege' =>'Login successfull'
			);
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


//user_registration
public function user_registration(){
	$return_array=array();
	


    if(@$_REQUEST['user_name'] && @$_REQUEST['user_gender'] && @$_REQUEST['user_mobile_no'] && @$_REQUEST['user_password'] 
	&& @$_REQUEST['user_city'] && @$_REQUEST['user_address'] && @$_REQUEST['user_latitude'] && @$_REQUEST['user_longitude']
	 && @$_REQUEST['user_google_address'] && @$_REQUEST['user_country'] && @$_REQUEST['user_role'] && @$_REQUEST['user_login_type'] && @$_REQUEST['is_mobile_verified'] && @$_REQUEST['is_email_verified'] && @$_REQUEST['user_status'] && @$_REQUEST['created_on'] && @$_REQUEST['user_email'] ){
		
	$user_mobile_no_count=$this->CommonMdl->fetchNumRows('tbl_user',array('user_mobile_no' => $_REQUEST['user_mobile_no']),$cond1='');   
	$user_email_count=$this->CommonMdl->fetchNumRows('tbl_user',array('user_email' =>$_REQUEST['user_email']),$cond1=''); 

	if($user_mobile_no_count == 1){
	$return_array = array(
						'cmd' =>'User registration',
						'status'=>'0',
						'response'=>'user registration  failed',
						'response_messege' =>'Mobile already exist'
					);
	}

	if($user_email_count == 1){
	$return_array = array(
					'cmd' =>'User registration',
					'status'=>'0',
					'response'=>'user registration  failed',
					'response_messege' =>'Email already exist'
					);
	}
	
	


	if($user_mobile_no_count == 0 && $user_email_count == 0){
			   $dataArr= array(
				  'user_name'=>$_REQUEST['user_name'],
				  'user_email'=>$_REQUEST['user_email'],
				  'user_gender'=>$_REQUEST['user_gender'],
				  'user_mobile_no'=>$_REQUEST['user_mobile_no'],
				  'user_password'=>md5($_REQUEST['user_password']),
				  'user_city'=>$_REQUEST['user_city'],
				  'user_address'=>$_REQUEST['user_address'],
				  'user_latitude'=>$_REQUEST['user_latitude'],
				  'user_longitude'=>$_REQUEST['user_longitude'],
				  'user_google_address'=>$_REQUEST['user_google_address'],
				  'user_country'=>$_REQUEST['user_country'],
				  'user_role'=>$_REQUEST['user_role'],
				  'user_login_type'=>$_REQUEST['user_login_type'],
				  'is_mobile_verified'=>$_REQUEST['is_mobile_verified'],
				  'is_email_verified'=>$_REQUEST['is_email_verified'],
				  'user_status'=>$_REQUEST['user_status'],
				  'user_oauth_id'=>$_REQUEST['user_oauth_id'],
				  'created_on'=>$_REQUEST['created_on']
				);	
				 // print_r($res_id);
					 
				
										
				 $res_id = $this->CommonMdl->insertRow($dataArr,'tbl_user');
				 $whr= array('user_id'=>$res_id);
				 $user_info=$this->CommonMdl->getRow('tbl_user','*',$whr);
				  $get_sport_list=$this->CommonMdl->getResultByCond('tbl_sport_list',array('sport_status'=>'enable'),'sport_id,sport_name,sport_icon,created_on,sport_status',$order_by='');
				//$get_sport_list=array('sport_list'=>$get_sport_list);

				//amenity_list
				$get_amenities_data= $this->CommonMdl->getResultByCond('tbl_amenity',array('amenity_status'=>'enable'),'amenity_id,amenity_name,amenity_icon',$order_by='');
				//$get_amenities_data=array('amenities_list'=>$get_amenities_data);

				//reward_achievement_list
				$reward_achievement_list=$this->CommonMdl->getResultByCond('tbl_reward_achievement',array('reward_status'=>'enable'),'reward_id,reward_name',$order_by='');
				//$reward_achievement_list=array('reward_achievement_list'=>$reward_achievement_list);
foreach($get_sport_list as $k=>$v)
				{
					$get_sport_list[$k]->folder_name= "sports";
				}
				
				$user_info->sport_list=$get_sport_list;
				//$result->folder_name="sports";
				$user_info->amenities_list=$get_amenities_data;
				foreach($get_amenities_data as $k=>$v)
				{
					$get_amenities_data[$k]->folder_name= "amenity";
				}
				
				$user_info->reward_achievement_list=$reward_achievement_list;
			 
				$user_info->my_facility=null;
				$user_info->user_bank_details=null;
				
				
				

				
				
				
				
				 
			
				 if($res_id){
						$return_array = array(
						'cmd' =>'User registration',
						'status'=>'1',
						'response'=>$user_info,
						'response_messege' =>'user registration  successfull'
						);					
				}
				
						 
				}
				
	}
	else{
		$return_array = array(
					'cmd' =>'User register verification',
					'status'=>'0',
					'response'=>'',
					'response_messege' =>'parameter is missing'
					);
		
	}

	$output = json_encode($return_array);
	echo trim($output,'"');
}



public function mobile_verification(){
	
	// print_r($six_digit_random_number);
	// die();
	
	

		$user_mobile_nos=$this->CommonMdl->fetchNumRows('tbl_user',array('user_mobile_no' => $_REQUEST['user_mobile_no']),$cond1=''); 
			

			if($user_mobile_nos == 1){
				$return_array = array(
							'cmd' =>'User mobile number',
							'status'=>'0',
							'response'=>'user registration  failed',
							'response_messege' =>'Mobile number already exist'
							);
							
				 }
				 
	     
		      if($user_mobile_nos == 0){	   
			  
			  
	
	
	if(isset($_REQUEST['user_mobile_no'])){
		 
		if($_REQUEST['user_mobile_no']!='')
		{
			
			 
				$return_array=array();
				$six_digit_random_number = mt_rand(100000, 999999);
				$mobile_verification=$_REQUEST['user_mobile_no'];     
	             if($six_digit_random_number!=''){
				$object=array('mobile_verification'=>$six_digit_random_number);
				$return_array = array(
								'cmd' =>'User mobile verification',
								'status'=>'1',
								'response'=>$object,
								'response_messege' =>'user mobile Verification  successfull'
								);
				}
			  
		}
			else{
				$return_array = array(
							'cmd' =>'User mobile verification',
							'status'=>'0',
							'response'=>'',
							'response_messege' =>'mobile number is missing'
							);
				
				
			}
	}
	else{
		$return_array = array(
					'cmd' =>'User mobile verification',
					'status'=>'0',
					'response'=>'',
					'response_messege' =>'parameter is missing'
					);
		
		
	}
			  }

	$output = json_encode($return_array);
	echo trim($output,'"');
}




//change_password Password
public function change_password(){

	  if(@$_REQUEST['user_id'] && @$_REQUEST['new_password']  && @$_REQUEST['old_password'])
	  {
 $user_id=$_REQUEST['user_id'];
         $passwrdreset=md5($_REQUEST['new_password']);
         $old_password=$_REQUEST['old_password'];
		   // $old_password=($old_password);
			$return_array=array();

		  $whr = array('user_id'=>$user_id);
		$user_password_no_count=  $this->CommonMdl->fetchNumRows('tbl_user',array('user_id' => $user_id,'user_password'=>$old_password),$cond1='');
		  // echo $user_password_no_count;
		  // die;
		   //echo $this->db->last_query();
		  //print_r($user_password_no_count);
		  //die();
		  
		  if($user_password_no_count==0){
			  $return_array = array(
						'cmd' =>'change password',
						'status'=>'0',
						'response'=>'User not found',
						'response_messege' =>'user registration  failed'
					);
					
		  }
		 if($user_password_no_count==1){
			     $dataArr=array(
					'user_password'=>$passwrdreset,
				);
				//print_r($dataArr);
				//die();
				$update_password=$this->CommonMdl->updateData($dataArr,$whr,'tbl_user');

				//echo $this->db->last_query();die;
				$user_password = array('new_password'=>$passwrdreset);
						
						if($update_password){
							$return_array = array(
							'cmd' =>'change password',
							'status'=>'1',
							'response'=>$user_password,
							'response_messege' =>'change passsword successfull'
						);
							
							
						}
			}
	  }
	  else{
		  $return_array = array(
					'cmd' =>'User mobile verification',
					'status'=>'0',
					'response'=>'',
					'response_messege' =>'parameter is missing'
					);
		  
	  }

$output=json_encode($return_array);
echo trim($output,'"');

}








public function forgot_password(){
	         $return_array=array();
			 if(isset($_REQUEST['register_email'])){
			 
				  if($_REQUEST['register_email']!=''){
				  $whr_email = array('user_email'=>$_REQUEST['register_email'],'is_mobile_verified'=>'yes','user_status'=>'enable');
				  
                  $user_data = $this->CommonMdl->getResultByCond('tbl_user',$whr_email,'*',$order_by='');
			    
				if(!empty($user_data)){
					$forgot_password_code = md5(uniqid(rand(), true));

					//For Email varification
					$date = array(
					'user_id' => $user_data[0]->user_id,
					'password_code' => $forgot_password_code,
					'expire_on' => date('Y-m-d H:i:s', strtotime('+1 day')),
					'created_on' => date("Y-m-d H:i:s")
					);
					$result=$this->CommonMdl->insertRow($date,'tbl_user_forgot_password');
					 //echo $this->db->last_query();
					 
					//
					/*Email when genrate ref id*/

					$data = array('action' => 'forgot_password','email' => $user_data[0]->user_email,'user_name' => $user_data[0]->user_name,'user_id' => $user_data[0]->user_id,'forgot_password_code' => $forgot_password_code);

				$this->send_email($data);
					
					/*End Email*/
					//echo "1";
					if($result){
							$return_array = array(
							'cmd' =>'forgot password',
							'status'=>'1',
							'response'=>'reset passsword link sent to user',
							'response_messege' =>'reset passsword link sent to user'
						);
					}
                     
		  
				 }
				 else{
				 $return_array = array(
							'cmd' =>'forgot password',
							'status'=>'1',
							'response'=>'Email not found',
							'response_messege' =>'Email not found'
						);

				 }
				}
				else{
					$return_array = array(
							'cmd' =>'forgot password',
							'status'=>'0',
							'response'=>'Email missing',
							'response_messege' =>'Email missing'
						);
				}
			 }
			 else{
				  $return_array = array(
					'cmd' =>'Email password',
					'status'=>'0',
					'response'=>'',
					'response_messege' =>'parameter is missing'
					);
			 }
				 
$output=json_encode($return_array);
echo trim($output,'"');
	
}



public function existing_user(){
   if(isset($_REQUEST['user_email']))
   { 
        $email=trim($_REQUEST['user_email']);
		$user_email_counts=$this->CommonMdl->getRow('tbl_user','*',array('user_email'=>$email)); 
		
		$user_email_count=$this->CommonMdl->getResultByCond('tbl_user',array('user_email'=>$email),$order_by='');
	     //$user_id=$user_email_count->user_id;
		 
		 
	
		 if(count($user_email_count) == 1){
		    
					$my_facility_aminity=$this->CommonMdl->getRow('tbl_user','*',array('user_id'=>$user_email_counts->user_id));


					foreach($my_facility_aminity as $kk=>$v)
					{
					$my_facility_aminitys=$this->CommonMdl->getResultByCond('tbl_facility_amenities',array('user_id'=>$v),$order_by='');
					$user_bank_details = $this->CommonMdl->getRow('tbl_user_bank_details','*',array('user_id'=>$v));
					}

					$user_email_counts->my_facility_aminity=$my_facility_aminitys;

					if($user_bank_details!=''){
					$user_email_counts->user_bank_details=$user_bank_details;
					}
					else
					{
					$user_email_counts->user_bank_details=$user_bank_details=null;
					}
					$sport_get = $this->CommonMdl->getResult('tbl_sport_list','*');
					$user_email_counts->sport_list=$sport_get;
			      
				  
				  
				  
				  
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
				$user_email_counts->amenities_list=$get_amenities_data;
				
				
			
				
				foreach($get_amenities_data as $k=>$v)
				{
					$get_amenities_data[$k]->folder_name= "amenity";
				}
				 $user_email_counts->amenities_list=$get_amenities_data;
				
				foreach($reward_achievement_list as $k=>$v)
				{
					$reward_achievement_list[$k]->folder_name= "rewards";
				}
				$user_email_counts->reward_achievement_list=$reward_achievement_list;
				
			
				
				$facility_list=$this->CommonMdl->getResultByCond('tbl_facility',array('user_id'=>$user_email_counts->user_id),'*',$order_by='');
		      
             
				foreach($facility_list as $k=>$v)
				{
				
					// echo  $v->fac_id;
					// die();
					$facility_list[$k]->folder_name= "fac";
					 $facility_timing_list=$this->CommonMdl->getResultByCond('tbl_facility_timing',array('fac_id'=>$v->fac_id),$order_by='');
					 $facility_list[$k]->fac_timing_list=$facility_timing_list;
					 
					 $facility_reward_achievement=$this->CommonMdl->getResultByCond('tbl_facility_reward_achievement',array('fac_id'=>$v->fac_id),$order_by='');
					 $facility_list[$k]->achievement_list=$facility_reward_achievement;
					  
					
					 
					 
					 $facility_sport=$this->CommonMdl->getResultByCond('tbl_facility_sport',array('fac_id'=>$v->fac_id),$order_by='');
					 $facility_list[$k]->facility_sport_list=$facility_sport;
					 
					 
					 
				}
				 $user_email_counts->facility_list=$facility_list;
				 // print_r($user_email_counts);
				 // die();
				 
				 
				 
				 
			
					$return_array = array(
							'cmd' =>'Email',
							'status'=>'1',
							'response'=>$user_email_counts,
							'response_messege' =>'User email match sucesfully'
							);

			
				
			 
		 }
		 else{
			 $dataarr= array('tag'=>'User email does not exit');
			 
			    $return_array = array(
					'cmd' =>'Email',
					'status'=>'1',
					'response'=>$dataarr,
					'response_messege' =>$dataarr
					);
			 }
   }
	else{
		  $return_array = array(
			'cmd' =>'Email password',
			'status'=>'0',
			'response'=>'0',
			'response_messege' =>'parameter is missing'
			);
	 }
				 
$output=json_encode($return_array);
    echo trim($output,'"');


}

// enquery_Form
public function enquery_form(){
	  $return_array=array();
	   if(isset($_REQUEST['user_id']) && isset($_REQUEST['query_name']) && isset($_REQUEST['query_contact']) && isset($_REQUEST['query_email']) && isset($_REQUEST['query_message']) && isset($_REQUEST['query_title'])){
			if($_REQUEST['user_id'] == ''){
				$return_array=array(
				'cmd'=>'Enquery',
				'status'=>'0',
				'response'=>'user id required',
				'response_messege'=>'user id required'
			);
			}else if($_REQUEST['query_name'] == ''){
			   $return_array=array(
					'cmd'=>'Enquery',
					'status'=>'0',
					'response'=>'query name required',
					'response_messege'=>'query name required'
			  );
			}else if($_REQUEST['query_contact'] == ''){
			   $return_array=array(
					'cmd'=>'Enquery',
					'status'=>'0',
					'response'=>'query contact required',
					'response_messege'=>'query contact required'
			  );
			  
			}else if($_REQUEST['query_email'] == ''){
			   $return_array=array(
					'cmd'=>'Enquery',
					'status'=>'0',
					'response'=>'query email required',
					'response_messege'=>'query email required'
			  );
			  
			}else if($_REQUEST['query_message'] == ''){
				$return_array=array(
					'cmd'=>'Enquery',
					'status'=>'0',
					'response'=>'query message required',
					'response_messege'=>'query message required'
			  );
			}else if($_REQUEST['query_title'] == ''){
			   $return_array=array(
					'cmd'=>'Enquery',
					'status'=>'0',
					'response'=>'query title required',
					'response_messege'=>'query title required'
			  );
			}
			 $query_Arr=array(
					'user_id'=>trim($_REQUEST['user_id']),
					'query_name'=>trim($_REQUEST['query_name']),  
					'query_contact'=>trim($_REQUEST['query_contact']),  
					'query_email'=>trim($_REQUEST['query_email']),  
					'query_message'=>trim($_REQUEST['query_message']),  
					'query_title'=>trim($_REQUEST['query_title']),
					'create_on'=>date("Y-m-d H:i:s"), 			 
					'update_on'=>date("Y-m-d H:i:s")
			    );
				$query_data=$this->CommonMdl->insertRow($query_Arr,'tbl_user_query');
				$whr= array('user_id'=>$_REQUEST['user_id']);
				$Contact_data=$this->CommonMdl->getResultByCond('tbl_user_query',$whr,'*',$order_by='');
                
				$senduserss = array('action' => 'senduser','query_name' => $Contact_data[0]->query_name,'query_email' => $Contact_data[0]->query_email);
                
				$sendAdmin = array('action' => 'sendAdmin','query_name' => $Contact_data[0]->query_name,'query_title' => $Contact_data[0]->query_title,'query_email' => $Contact_data[0]->query_email,'query_contact' => $Contact_data[0]->query_contact,'query_message' =>$Contact_data[0]->query_message);
				
				$this->send_email($senduserss);
				$this->send_email($sendAdmin);
				
				  if(!empty($query_data)){
					     $return_array=array(
								'cmd'=>'Enquery data',
								'status'=>'1',
								'response'=>'1',
								'response_messege'=>'Enquery insert Succesfully'
				          );
				  }else{
					    $return_array=array(
								'cmd'=>'Enquery data',
								'status'=>'1',
								'response'=>$return_array,
								'response_messege'=>'Enquery insert Succesfully'
				          );
					  
				  }
		}else{
		       $return_array=array(
					'cmd'=>'Enquery  data verification',
					'status'=>'0',
					'response'=>$return_array,
					'response_messege'=>'parameter is missing'
				);
		}
	   $output=json_encode($return_array);
	    echo trim($output,'"');
}




  public function rating_review_listing(){
	   if(isset($_REQUEST['user_id'])){
		      if($_REQUEST['user_id'] == ''){
					$return_array=array(
						'cmd'=>'Rating user_id',
						'status'=>'1',
						'response'=>'Rating user_id required',
						'response_messege'=>'Rating user_id required'
					);
				}
				 $user_id=$_REQUEST['user_id'];
				 $rating_data=$this->ApiMdl->get_review_count($user_id);
				   if(!empty($rating_data)){
					     $return_array=array(
						   'cmd'=>'Rating listing',
						   'status'=>'1',
						   'response'=>$rating_data,
						   'response_messege'=>'Rating listing'
	                     );
				   }else{
					    $return_array=array(
						   'cmd'=>'Rating listing',
						   'status'=>'1',
						   'response'=>$return_array,
						   'response_messege'=>'Rating listing'
	                     );
				   }
				
			  
	  }else{
		   $return_array=array(
			   'cmd'=>'Rating review',
			   'status'=>'0',
			   'response'=>$return_array,
			   'response_messege'=>'Parameter is missing'
	      );
	   }
	  $output=json_encode($return_array);
	  echo trim($output,'"');
  }


   public function add_review(){
	    if(isset($_REQUEST['user_id']) && isset($_REQUEST['user_name']) && isset($_REQUEST['user_email']) && isset($_REQUEST['rating_type']) && isset($_REQUEST['rating']) && isset($_REQUEST['fac_id']) && isset($_REQUEST['event_id']) && isset($_REQUEST['report_abuse'])){
			     if($_REQUEST['user_id'] == ''){
				$return_array=array(
				'cmd'=>'Review',
				'status'=>'0',
				'response'=>'user id required',
				'response_messege'=>'user id required'
			);
			}else if($_REQUEST['user_name'] == ''){
			   $return_array=array(
					'cmd'=>'Review',
					'status'=>'0',
					'response'=>'user name required',
					'response_messege'=>'user name required'
			  );
			}else if($_REQUEST['user_email'] == ''){
			   $return_array=array(
					'cmd'=>'Review',
					'status'=>'0',
					'response'=>'user email required',
					'response_messege'=>'user email required'
			  );
			  
			}else if($_REQUEST['rating_type'] == ''){
			   $return_array=array(
					'cmd'=>'Review',
					'status'=>'0',
					'response'=>'rating type required',
					'response_messege'=>'rating type required'
			  );
			  
			}else if($_REQUEST['fac_id'] == ''){
				$return_array=array(
					'cmd'=>'Review',
					'status'=>'0',
					'response'=>'fac id  required',
					'response_messege'=>'fac id required'
			  );
			}else if($_REQUEST['event_id'] == ''){
			   $return_array=array(
					'cmd'=>'Review',
					'status'=>'0',
					'response'=>'event id required',
					'response_messege'=>'event id required'
			  );
			}else if($_REQUEST['report_abuse'] == ''){
			   $return_array=array(
					'cmd'=>'Review',
					'status'=>'0',
					'response'=>'report abuse required',
					'response_messege'=>'report abuse required'
			  );
			}
			       $Rating_Arr=array(
						'user_id'=>trim($_REQUEST['user_id']),
						'user_name'=>trim($_REQUEST['user_name']),
						'user_email'=>trim($_REQUEST['user_email']),
						'rating_type'=>trim($_REQUEST['rating_type']),
						'rating'=>trim($_REQUEST['rating']),
						'fac_id'=>trim($_REQUEST['fac_id']),
						'event_id'=>trim($_REQUEST['event_id']),
						'report_abuse'=>trim($_REQUEST['report_abuse']),
						'created_on'=>date('Y-m-d H:i:s'),
						'updated_on'=>date('Y-m-d  H:i:s')
			        );
					$rating_id=$this->CommonMdl->insertRow($Rating_Arr,'tbl_rating');
					// echo $rating_id;
					// die;
					$return_array=array(
								   'cmd'=>'Rating review',
								   'status'=>'1',
								   'response'=>'1',
								   'response_messege'=>'Rating review insert successfully'
	                           );
			    	
					if(isset($_REQUEST['review_message'])){
					     if($_REQUEST['review_message']){
							    $return_array=array(
									'cmd'=>'review',
									'status'=>'0',
									'response'=>'review message required',
									'response_messege'=>'review message required'
			                     ); 
						   }
                           $review_Arr=array(
							     'rating_id'=>trim($rating_id),
								 'review_message'=>trim($_REQUEST['review_message'])
							   );
							  
							   
                             $this->CommonMdl->insertRow($review_Arr,'tbl_review');
							 // echo $this->db->last_query();
							 
							 $return_array=array(
								   'cmd'=>'Rating review',
								   'status'=>'1',
								   'response'=>'1',
								   'response_messege'=>'Rating review insert sucesfully'
	                           );
							 
					}
					  
					
					
					
					  
				
		  }else{
			 $return_array=array(
			   'cmd'=>'Rating review',
			   'status'=>'',
			   'response'=>$return_array,
			   'response_messege'=>'Parameter Rating review'
	       );
		}
		$output=json_encode($return_array);
	    echo trim($output,'"');
	     
   }  
   
   
   
   
   public function user_login_view(){
	   $return_array=array();
	 
	     if(isset($_REQUEST['user_email']) && isset($_REQUEST['user_password'])){
			 
		      	if($_REQUEST['user_email']==''){
					$return_array=array(
						'cmd'=>'Email',
						'status'=>'0',
						'response'=>'Email is required',
						'response_messege'=>'Email is required'
					 );
				}
				else if($_REQUEST['user_password'] == ''){
					 $return_array=array(
						'cmd'=>'Password',
						'status'=>'0',
						'response'=>'Password is required',
						'response_messege'=>'Password is required'
					 );
					
				}
				
				
				$password=md5(trim($_REQUEST['user_password']));
				$result = $this->CommonMdl->getRow('tbl_user','*',array('user_email'=>$_REQUEST['user_email'],'user_password'=>$password,'is_mobile_verified'=>'yes','user_status'=>'enable'));
				
				$data['user_sport_list'] =   $this->CommonMdl->getResultByCond('tbl_interested_sport',array('user_id'=>$result->user_id),'sport_id',$order_by='');
				
				$data['sport_list'] =  $this->CommonMdl->getResultByCond('tbl_sport_list',array('sport_status'=>'enable'),'*',$order_by='');
				
				$path="http://localhost/socialsportz/assets/public/images/sports/";
				foreach($data['sport_list'] as $sportdata=>$sportval){
						$daraarr[]=array(
									"sport_id"=>$sportval->sport_id,
									"sport_name"=>$sportval->sport_name,
									"sport_icon"=>$path.$sportval->sport_icon,
									"sport_image"=>$path.$sportval->sport_image,
									"created_on"=>$sportval->created_on,
									"created_by"=>$sportval->created_by,
									"updated_on"=>$sportval->updated_on,
									"updated_by"=>$sportval->updated_by,
									"sport_status"=>$sportval->sport_status,
									);
						}
				$result->sport_listing=$daraarr;
				foreach ($data['user_sport_list'] as $key => $user_sport_list) {
					$master_sport =   $this->CommonMdl->getResultByCond('tbl_sport_list',array('sport_status'=>'enable','sport_id'=> $user_sport_list->sport_id),'*',$order_by='');
                }
				
				 $result->rating_listing=$data['get_rating_data']=$this->CommonMdl->getResultByCond('tbl_rating',array('user_id'=>$result->user_id),'*',$order_by='');
				 $data['get_booking_order']=$this->CommonMdl->getResultByCond('tbl_booking_order',array('user_id'=>$result->user_id,'booking_for'=>'event'),'*',$order_by='');
                 $result->booking_order_listing=$data['get_booking_order'];
           
				
				
				
				
				// die;
				if($result) {
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
	
	
				
				
		 }else{
			  $return_array= array(
			     'cmd'=>'login',
				 'status'=>'0',
				 'response'=>$return_array,
				 'response_messege'=>'email or password is missing'
			  
			  );
		 }
		 $output=json_encode($return_array);
		 echo trim($output,'"');
		 
   }





public function interested_sports(){
	   $data['sport_list'] =  $this->CommonMdl->getResultByCond('tbl_sport_list',array('sport_status'=>'enable'),'*',$order_by='');
	   $return_array = array();
				
				$path="http://localhost/socialsportz/assets/public/images/sports/";
				foreach($data['sport_list'] as $sportdata=>$sportval){
						$daraarr[]=array(
									"sport_id"=>$sportval->sport_id,
									"sport_name"=>$sportval->sport_name,
									"sport_icon"=>$path.$sportval->sport_icon,
									"sport_image"=>$path.$sportval->sport_image,
									"created_on"=>$sportval->created_on,
									"created_by"=>$sportval->created_by,
									"updated_on"=>$sportval->updated_on,
									"updated_by"=>$sportval->updated_by,
									"sport_status"=>$sportval->sport_status,
									);
						}
				
				if($daraarr){
					  $return_array = array(
							'cmd' =>'favorite sport',
							'status'=>'1',
							'response'=>$daraarr,
							'response_messege' =>'favorite sport listing',
						);
				  }else{
					   $return_array = array(
							'cmd' =>'favorite sport',
							'status'=>'1',
							'response'=>$return_array,
							'response_messege' =>'favorite sport listing',
						);
				  }
	$output=json_encode($return_array);
    echo trim($output,'"');
	
}










//event_bookings_user
public function  facility_bookings_user(){
	if(isset($_REQUEST['user_id'])){
		$return_array=array();
	  if($_REQUEST['user_id']==''){
	     $return_array=array(
						'cmd'=>'user_id',
						'status'=>'0',
						'response'=>'user_id is required',
						'response_messege'=>'user_id is required'
					 );
	  }
	    $data['get_booking_order']=$this->CommonMdl->getResultByCond('tbl_booking_order',array('user_id'=>$_REQUEST['user_id'],'booking_for'=>'facility'),'*',$order_by='');
	 
	foreach($data['get_booking_order'] as $bookingorderkey=>$bookingorderval){
		$data['get_slot_detail']=$this->CommonMdl->getResultByCond('tbl_booking_slot_detail',array('booking_order_id'=>$bookingorderval->booking_order_id),'*',$order_by='');
		$data['get_booking_order'][$bookingorderkey]->get_slot_detail=$data['get_slot_detail'];
			foreach($data['get_booking_order'][$bookingorderkey]->get_slot_detail as $booking_slotkey=>$booking_slotval){
			  $data['get_facility']=$this->CommonMdl->getRow('tbl_facility','fac_name,fac_id,fac_banner_image',array('fac_id'=>$booking_slotval->fac_id));
			}
			$data['get_booking_order'][$bookingorderkey]->facility_name=$data['get_facility'];
			$data['get_booking_order'][$bookingorderkey]->facility_name->fac_banner_image ="http://localhost/socialsportz/assets/public/images/fac/".$data['get_facility']->fac_banner_image;
	}
	    if($data['get_booking_order']){
					  $return_array = array(
							'cmd' =>'booking facility detail',
							'status'=>'1',
							'response'=>$data['get_booking_order'],
							'response_messege' =>'booking facility detail',
						);
				  }else{
					   $return_array = array(
							'cmd' =>'booking facility detail',
							'status'=>'0',
							'response'=>$return_array,
							'response_messege' =>'booking facility detail',
						);
				  }
	  
	    
			
      
	}else{
			$return_array = array(
						'cmd' =>'booking_order',
						'status'=>'1',
						'response'=>$return_array,
						'response_messege' =>'booking_orderis parameter missing',
				);
	}
	$output=json_encode($return_array);
    echo trim($output,'"');
}





//event_bookings_user
public function  event_bookings_user(){
	if(isset($_REQUEST['user_id'])){
		$return_array=array();
	  if($_REQUEST['user_id']==''){
	     $return_array=array(
						'cmd'=>'user_id',
						'status'=>'0',
						'response'=>'user_id is required',
						'response_messege'=>'user_id is required'
					 );
	  }
	 $data['get_booking_orders']=$this->CommonMdl->getResultByCond('tbl_booking_order',array('user_id'=>$_REQUEST['user_id'],'booking_for'=>'event'),'*',$order_by='');
		foreach($data['get_booking_orders'] as $bookingorderKey=>$bookingorderVal){
			 $data['get_booking_event_betail']=$this->CommonMdl->getRow('tbl_booking_event_detail','*',array('booking_order_id'=>$bookingorderVal->booking_order_id));
			
			
			 $data['get_booking_orders'][$bookingorderKey]->booking_event_details=$data['get_booking_event_betail'];
      
			 $data['get_facility']=$this->CommonMdl->getRow('tbl_facility','fac_name,fac_id,fac_banner_image',array('fac_id'=>$data['get_booking_orders'][$bookingorderKey]->booking_event_details->fac_id));
			
			$data['get_booking_orders'][$bookingorderKey]->facility_listing=$data['get_facility'];
			$data['get_booking_orders'][$bookingorderKey]->facility_listing->fac_banner_image =  "http://localhost/socialsportz/assets/public/images/fac/".$data['get_facility']->fac_banner_image;
		}
		   if($data['get_booking_orders']){
					  $return_array = array(
							'cmd' =>'booking event detail',
							'status'=>'1',
							'response'=>$data['get_booking_orders'],
							'response_messege' =>'booking event detail',
						);
				  }else{
					   $return_array = array(
							'cmd' =>'booking event detail',
							'status'=>'0',
							'response'=>$return_array,
							'response_messege' =>'booking event detail',
						);
				  }
      
	}else{
			$return_array = array(
						'cmd' =>'booking_order',
						'status'=>'1',
						'response'=>$return_array,
						'response_messege' =>'booking_orderis parameter missing',
				);
	}
	$output=json_encode($return_array);
    echo trim($output,'"');
}



public function user_review_rating(){
	$return_array=array();
	if(isset($_REQUEST['user_id'])){
       if($_REQUEST['user_id']==''){
		  $return_array=array(
			'cmd'=>'user_id',
			'status'=>'0',
			'response'=>'user_id is required',
			'response_messege'=>'user_id is required'
	      );
		}
     $data['get_rating_data']=$this->CommonMdl->getResultByCond('tbl_rating',array('user_id'=>$_REQUEST['user_id']),'*',$order_by='');
	foreach($data['get_rating_data'] as $ratingkey=>$ratingval){
			$data['get_facility_data']=$this->CommonMdl->getRow('tbl_facility','*',array('fac_id'=>$ratingval->fac_id));
			$data['get_rating_data'][$ratingkey]->facility_name=$data['get_facility_data'];
			$data['get_review_data']=$this->CommonMdl->getRow('tbl_review','*',array('rating_id'=>$ratingval->rating_id));
			$data['get_rating_data'][$ratingkey]->review_message=$data['get_review_data'];
	}
	
	if($data['get_rating_data']){
	  $return_array = array(
			'cmd' =>'Rating review listing',
			'status'=>'1',
			'response'=>$data['get_rating_data'],
			'response_messege' =>'Rating review listing',
		);
	  }else{
		   $return_array = array(
				'cmd' =>'Rating review listing',
				'status'=>'1',
				'response'=>$return_array,
				'response_messege' =>'Rating review listing',
			);
	  }
	
	}else{
	   	$return_array = array(
				'cmd' =>'user review rating',
				'status'=>'1',
				'response'=>$return_array,
				'response_messege' =>'user review is parameter missing',
			);
	}
	$output=json_encode($return_array);
    echo trim($output,'"');
}	

 public function user_query_listing(){
  $return_array=array();
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
 
   public function user_favourate(){
	    $data['favourate_listing'] =  $this->CommonMdl->getResultByCond('tbl_favourite','','*',$order_by='');
	   foreach($data['favourate_listing'] as $favourateKey=>$favourateVal){
		   $data['get_facility_name'] = $this->CommonMdl->getRow('tbl_facility','fac_name,fac_google_address,fac_banner_image,fac_slug,fac_city',array('fac_id'=>$favourateVal->fac_id));
		   $data['favourate_listing'][$favourateKey]->facility_name=$data['get_facility_name'];	
         $data['favourate_listing'][$favourateKey]->facility_name->fac_banner_image="path".$data['favourate_listing'][$favourateKey]->facility_name->fac_banner_image;		   
	   }
	   if($data['favourate_listing']){
			  $return_array = array(
					'cmd' =>'User favourate listing',
					'status'=>'1',
					'response'=>$data['favourate_listing'],
					'response_messege' =>'User favourate listing',
		);
	  }else{
		   $return_array = array(
				'cmd' =>'User favourate listing',
				'status'=>'1',
				'response'=>$return_array,
				'response_messege' =>'User favourate listing',
			);
	  }
	   
	   
	$output=json_encode($return_array);
    echo trim($output,'"'); 
   }

	  
	

}
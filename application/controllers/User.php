<?php
ini_set("display_errors",0);
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public  function __construct()

    {

   	    parent::__construct();
		 $this->load->model('public/SearchMdl');
   	     $this->load->model('SearchApiMdl');
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

 function search_listing(){
	   $limit='8';
	   $page=$_REQUEST['page'];
	   $type=$_REQUEST['action'];
	   
	   
      if($type == "facility"  || $type == "academy"  || $type == "event" && isset($_REQUEST['fac_latitude']) && isset($_REQUEST['fac_longitude']) && $_REQUEST['user_id'])
	  {
		 $return_array=array();
		  $distanceInMile = 10;
		  if($_REQUEST['action'] == ''){
				$return_array=array(
				'cmd'=>'Search',
				'status'=>'0',
				'response'=>'Search type required',
				'response_messege'=>'Search type required'
			);
			}else if($_REQUEST['fac_latitude'] == ''){
			   $return_array=array(
					'cmd'=>'Search',
					'status'=>'0',
					'response'=>'Search latitude required',
					'response_messege'=>'Search latitudes required'
			  );
			}else if($_REQUEST['fac_longitude'] == ''){
				$return_array=array(
				'cmd'=>'Search',
				'status'=>'0',
				'response'=>'Search longitude required',
				'response_messege'=>'Search longitude required'
			);
			}else if($_REQUEST['user_id'] == ''){
				$return_array=array(
				'cmd'=>'Search',
				'status'=>'0',
				'response'=>'Search user id  required',
				'response_messege'=>'Search user id required'
			);
			}
			     // $condArr['sport_id']= $_REQUEST['sport_id'];
				$condArr['type']= $_REQUEST['action'];
				$condArr['distanceInMile']= $distanceInMile;
				$condArr['fac_latitude']= $_REQUEST['fac_latitude'];
				$condArr['fac_longitude']= $_REQUEST['fac_longitude'];
				$offset=$_REQUEST['page']*8;
				$data['fac_data'] =$this->SearchMdl->getserchfacdata($condArr, $start=0,$limit,$offset);
				
	foreach($data['fac_data'] as $facKey=>$facVal){
			$sportListing=$this->SearchApiMdl->getSportListByFacId($facVal->fac_id);
			$Aminitieslist=$this->SearchApiMdl->getAminitiesListByFacId($facVal->user_id); 
			$data['rating_data']=$this->SearchApiMdl->getfacratinglist($facVal->fac_id);
			$count1=array('fac_id'=>$facVal->fac_id,'user_id'=>$_REQUEST['user_id']);
			$count_favourate=$this->CommonMdl->fetchNumRows('tbl_favourite',$cond='',$count1);
			if($count_favourate != '0'){ $counts = 1; }else{ $counts = 0; }
			$FacTimingList=$this->CommonMdl->getResultByCond('tbl_facility_timing',array('fac_id'=>$facVal->fac_id),'day,open_time,close_time',$order_by='');
				$reward_achivement_date=$this->SearchApiMdl->getRewardListByFacId($facVal->fac_id);
     
   
				$data['fac_data'][$facKey]->folder_name="fac";
				$data['fac_data'][$facKey]->sport_list=$sportListing;
				$data['fac_data'][$facKey]->amenities_list=$Aminitieslist;
				$data['fac_data'][$facKey]->rating_list=$data['rating_data'];
				$data['fac_data'][$facKey]->timing_list=$FacTimingList;
				$data['fac_data'][$facKey]->achievement_list=$reward_achivement_date;
				$data['fac_data'][$facKey]->is_favourate=$counts;
				$rating_count=$this->SearchApiMdl->countfacratinglist($facVal->fac_id);
				$total_1_review=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>$facVal->fac_id,'rating'=>'1'),'');
				$total_2_review=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>$facVal->fac_id,'rating'=>'2'),'');
				$total_3_review=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>$facVal->fac_id,'rating'=>'3'),'');
				$total_4_review=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>$facVal->fac_id,'rating'=>'4'),'');
				$total_5_review=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>$facVal->fac_id,'rating'=>'5'),'');
				$total_rating =($total_5_review*5) + ($total_4_review*4) + ($total_3_review*3) + ($total_2_review*2) + ($total_1_review*1);
				$avg_rating=0;
				if($rating_count>0) {$avg_rating= round($total_rating/$rating_count,1);}
					
					
				$data['fac_data'][$facKey]->rating_count=$rating_count;
				$data['fac_data'][$facKey]->rating_avg=$avg_rating;
				$data['fac_data'][$facKey]->thing_to_note="<ul class=notedlist><li>The booked slot timings must be followed strictly.</li><li>Proper Non-marking shoes only.</li><li>No eatables are allowed inside the courts.</li><li>The management will not be responsible for belongings of players.</li> </ul>";
			 foreach($data['fac_data'][$facKey]->amenities_list as $key=>$Val){
				 $data['fac_data'][$facKey]->amenities_list[$key]->folder_name="amenity";
			 }
			 
			 foreach($data['fac_data'][$facKey]->sport_list as $key=>$val){
				 $data['fac_data'][$facKey]->sport_list[$key]->folder_name="sports";
			 }
			 foreach($data['fac_data'][$facKey]->achievement_list as $AchievmentKey=>$AchievmentVal){
				 $data['fac_data'][$facKey]->achievement_list[$AchievmentKey]->folder_name="rewards";
			 }
					
		 
		}
					
			if($data['fac_data']){
				$return_array=array(
				'cmd'=>'Search Listing',
				'status'=>'1',
				'response'=>$data['fac_data'],
				'response_messege'=>'Search Listing'
			  );
			}else{
				$return_array=array(
				'cmd'=>'Search Listing',
				'status'=>'0',
				'response'=>$return_array,
				'response_messege'=>'Search Listing'
			  );
			}
			
	  }
	  else if($type == "event"){
		  print_r($_POST);
	  }
	  $output=json_encode($return_array);
	    echo trim($output,'"');
	  
   }
   
   
   public function dashboard_Detail(){
	      $limit='8';
		  
	   $page=$_REQUEST['page'];
	   $type=$_REQUEST['action'];
	   	 $return_array=array();
	   
      if(isset($_REQUEST['action']) && isset($_REQUEST['fac_latitude']) && isset($_REQUEST['fac_longitude']) && $_REQUEST['user_id']){
		  
	
		  $distanceInMile = 10;
		  if($_REQUEST['action'] == ''){
				$return_array=array(
				'cmd'=>'Detail',
				'status'=>'0',
				'response'=>'Detail type required',
				'response_messege'=>'Detail type required'
			);
			}else if($_REQUEST['fac_latitude'] == ''){
			   $return_array=array(
					'cmd'=>'Detail',
					'status'=>'0',
					'response'=>'Detail latitude required',
					'response_messege'=>'Detail latitudes required'
			  );
			}else if($_REQUEST['fac_longitude'] == ''){
				$return_array=array(
				'cmd'=>'Detail',
				'status'=>'0',
				'response'=>'Detail longitude required',
				'response_messege'=>'Detail longitude required'
			);
			}else if($_REQUEST['user_id'] == ''){
				$return_array=array(
				'cmd'=>'Detail',
				'status'=>'0',
				'response'=>'Detail user id  required',
				'response_messege'=>'Detail user id required'
			);
			}
			$condArr['type']= $_REQUEST['action'];
			$condArr['distanceInMile']= $distanceInMile;
			$condArr['fac_latitude']= $_REQUEST['fac_latitude'];
			$condArr['fac_longitude']= $_REQUEST['fac_longitude'];
			$offset=$_REQUEST['page']*8;
			$limit-5;
			$data['fac_data']=$this->SearchApiMdl->getserchfacdata($condArr, $start=0,$limit);
			$data['fac_academydata']=$this->SearchApiMdl->getserchacademydata($condArr, $start=0,$limit);
			$data['fac_event']=$this->SearchApiMdl->geteventdata($condArr, $start=0,$limit);

		    foreach($data['fac_data'] as $facKey=>$facVal){
			// $sportListing=$this->SearchApiMdl->getSportListByFacId($facVal->fac_id);
			$sportListing=$this->CommonMdl->getResultByCond('tbl_facility_sport',array('fac_id'=>$facVal->fac_id),'sport_id',$order_by='');
			$Aminitieslist=$this->SearchApiMdl->getAminitiesListId($facVal->user_id); 
			$data['rating_data']=$this->SearchApiMdl->getfacratinglist($facVal->fac_id);
			$count1=array('fac_id'=>$facVal->fac_id,'user_id'=>$_REQUEST['user_id']);
			$count_favourate=$this->CommonMdl->fetchNumRows('tbl_favourite',$cond='',$count1);
			if($count_favourate != '0'){ $counts = 1; }else{ $counts = 0; }
			$FacTimingList=$this->CommonMdl->getResultByCond('tbl_facility_timing',array('fac_id'=>$facVal->fac_id),'day,open_time,close_time',$order_by='');
				$reward_achivement_date=$this->SearchApiMdl->getRewardListByFacId($facVal->fac_id);
     
   
				$data['fac_data'][$facKey]->folder_name="fac";
				$data['fac_data'][$facKey]->sport_list=$sportListing;
				$data['fac_data'][$facKey]->amenities_list=$Aminitieslist;
				$data['fac_data'][$facKey]->rating_list=$data['rating_data'];
				$data['fac_data'][$facKey]->timing_list=$FacTimingList;
				$data['fac_data'][$facKey]->achievement_list=$reward_achivement_date;
				$data['fac_data'][$facKey]->is_favourate=$counts;
				
				
				$rating_count=$this->SearchApiMdl->countfacratinglist($facVal->fac_id);
				$total_1_review=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>$facVal->fac_id,'rating'=>'1'),'');
				$total_2_review=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>$facVal->fac_id,'rating'=>'2'),'');
				$total_3_review=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>$facVal->fac_id,'rating'=>'3'),'');
				$total_4_review=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>$facVal->fac_id,'rating'=>'4'),'');
				$total_5_review=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>$facVal->fac_id,'rating'=>'5'),'');
				$total_rating =($total_5_review*5) + ($total_4_review*4) + ($total_3_review*3) + ($total_2_review*2) + ($total_1_review*1);
				$avg_rating=0;
				if($rating_count>0) {$avg_rating= round($total_rating/$rating_count,1);}
					
					
				$data['fac_data'][$facKey]->rating_count=$rating_count;
				$data['fac_data'][$facKey]->rating_avg=$avg_rating;
				$data['fac_data'][$facKey]->thing_to_note="<ul class=notedlist><li>The booked slot timings must be followed strictly.</li><li>Proper Non-marking shoes only.</li><li>No eatables are allowed inside the courts.</li><li>The management will not be responsible for belongings of players.</li> </ul>";
			 
			 
			
			 foreach($data['fac_data'][$facKey]->achievement_list as $AchievmentKey=>$AchievmentVal){
				 $data['fac_data'][$facKey]->achievement_list[$AchievmentKey]->folder_name="rewards";
			 }
			}
			
			
      ///academy listing
			 foreach($data['fac_academydata'] as $AcdKey=>$AcdVal){
			// $sportListing=$this->SearchApiMdl->getSportListByFacId($AcdVal->fac_id);
			$sportListing=$this->CommonMdl->getResultByCond('tbl_facility_sport',array('fac_id'=>$AcdVal->fac_id),'sport_id',$order_by='');
			$Aminitieslist=$this->SearchApiMdl->getAminitiesListId($AcdVal->user_id); 
			$data['rating_data']=$this->SearchApiMdl->getfacratinglist($AcdVal->fac_id);
			$count1=array('fac_id'=>$AcdVal->fac_id,'user_id'=>$_REQUEST['user_id']);
			$count_favourate=$this->CommonMdl->fetchNumRows('tbl_favourite',$cond='',$count1);
			if($count_favourate != '0'){ $counts = 1; }else{ $counts = 0; }
			$FacTimingList=$this->CommonMdl->getResultByCond('tbl_facility_timing',array('fac_id'=>$AcdVal->fac_id),'day,open_time,close_time',$order_by='');
				$reward_achivement_date=$this->SearchApiMdl->getRewardListByFacId($AcdVal->fac_id);
     
   
			   $data['fac_academydata'][$AcdKey]->folder_name="fac";
				$data['fac_academydata'][$AcdKey]->sport_list=$sportListing;
				$data['fac_academydata'][$AcdKey]->amenities_list=$Aminitieslist;
				$data['fac_academydata'][$AcdKey]->rating_list=$data['rating_data'];
				$data['fac_academydata'][$AcdKey]->timing_list=$FacTimingList;
				$data['fac_academydata'][$AcdKey]->achievement_list=$reward_achivement_date;
				$data['fac_academydata'][$AcdKey]->is_favourate=$counts;
				
				
				$rating_count=$this->SearchApiMdl->countfacratinglist($AcdVal->fac_id);
				$total_1_review=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>$AcdVal->fac_id,'rating'=>'1'),'');
				$total_2_review=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>$AcdVal->fac_id,'rating'=>'2'),'');
				$total_3_review=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>$AcdVal->fac_id,'rating'=>'3'),'');
				$total_4_review=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>$AcdVal->fac_id,'rating'=>'4'),'');
				$total_5_review=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>$AcdVal->fac_id,'rating'=>'5'),'');
				$total_rating =($total_5_review*5) + ($total_4_review*4) + ($total_3_review*3) + ($total_2_review*2) + ($total_1_review*1);
				$avg_rating=0;
				if($rating_count>0) {$avg_rating= round($total_rating/$rating_count,1);}
					
					
				$data['fac_academydata'][$AcdKey]->rating_count=$rating_count;
				$data['fac_academydata'][$AcdKey]->rating_avg=$avg_rating;
				$data['fac_academydata'][$AcdKey]->thing_to_note="<ul class=notedlist><li>The booked slot timings must be followed strictly.</li><li>Proper Non-marking shoes only.</li><li>No eatables are allowed inside the courts.</li><li>The management will not be responsible for belongings of players.</li> </ul>";
			 foreach($data['fac_academydata'][$AcdKey]->achievement_list as $AchievmentKey=>$AchievmentVal){
				 $data['fac_academydata'][$AcdKey]->achievement_list[$AchievmentKey]->folder_name="rewards";
			 }
			}
			
			///Event lsting
			 foreach($data['fac_event'] as $EventKey=>$EventVal){
					$aminitiesListing=$this->CommonMdl->getResultByCond('tbl_event_amenities',array('event_id'=>$EventVal->event_id),'amenity_id',$order_by='');
					 $event_booking_count=$this->CommonMdl->fetchNumRows(' tbl_booking_event_detail',$cond='',array('event_id'=>$EventVal->event_id));
					 
			 
					$data['fac_event'][$EventKey]->folder_name="event/banner";
					$data['fac_event'][$EventKey]->aminities_list=$aminitiesListing;
					$data['fac_event'][$EventKey]->event_booking=$event_booking_count;
					$data['fac_event'][$EventKey]->thing_to_note="<ul class=notedlist><li>The booked slot timings must be followed strictly.</li><li>Proper Non-marking shoes only.</li><li>No eatables are allowed inside the courts.</li><li>The management will not be responsible for belongings of players.</li> </ul>";

			 
			}
			
           $data['eventacademyfacility']=array('facility_list'=>$data['fac_data'],'academy_list'=>$data['fac_academydata'],'event_listing'=>$data['fac_event']);	
		
			
			if($data['eventacademyfacility']){
				$return_array=array(
				'cmd'=>'Dashboard Listing',
				'status'=>'1',
				'response'=>$data['eventacademyfacility'],
				'response_messege'=>'Dashboard Listing'
			  );
			}else{
				$return_array=array(
				'cmd'=>'Dashboard Listing',
				'status'=>'0',
				'response'=>$return_array,
				'response_messege'=>'Dashboard Listing'
			  );
			}
		
		
	  }else{
		  $return_array = array(
		           'cmd' =>'dashboard Detail verification',
					'status'=>'0',
					'response'=>$return_array,
					'response_messege' =>'parameter is missing'
					);
	  }
	 $output=json_encode($return_array);
	    echo trim($output,'"');	
   }
   
   //user_favourate
   public function user_favourate(){
	   $return_array=array();
	   if(isset($_REQUEST['user_id'])){
	    if($_REQUEST['user_id'] === ''){
				$return_array=array(
				'cmd'=>'User id',
				'status'=>'0',
				'response'=>'User id required',
				'response_messege'=>'User id required'
			);
		}
		
		$data['favourate_listing'] =  $this->CommonMdl->getResultfavourate();
		print_data($data['favourate_listing']);
		
		
	    $data['favourate_listing'] =  $this->CommonMdl->getResultfavourate('tbl_favourite',array('user_id'=>$_REQUEST['user_id']),'*',$order_by='');

	   foreach($data['favourate_listing'] as $favourateKey=>$favourateVal){
		   $data['get_facility_name'] = $this->CommonMdl->getResultByCond('tbl_facility',array('fac_id'=>$favourateVal->fac_id),'*',$order_by='');
		   $data['favourate_listing'][$favourateKey]->facility_list=$data['get_facility_name'];	
		   
		   foreach($data['favourate_listing'][$favourateKey]->facility_list as $favkey=>$facVal){
			   $sportListing=$this->CommonMdl->getResultByCond('tbl_facility_sport',array('fac_id'=>$favval->fac_id),'sport_id',$order_by='');
			   $Aminitieslist=$this->SearchApiMdl->getAminitiesListId($facVal->user_id); 
			   // echo $this->db->last_query();
			$data['rating_data']=$this->SearchApiMdl->getfacratinglist($facVal->fac_id);
			$count1=array('fac_id'=>$facVal->fac_id,'user_id'=>$_REQUEST['user_id']);
			$count_favourate=$this->CommonMdl->fetchNumRows('tbl_favourite',$cond='',$count1);
			if($count_favourate != '0'){ $counts = 1; }else{ $counts = 0; }
			$FacTimingList=$this->CommonMdl->getResultByCond('tbl_facility_timing',array('fac_id'=>$facVal->fac_id),'day,open_time,close_time',$order_by='');
			
			$data['favourate_listing'][$favourateKey]->facility_list[$favourateKey]->folder_name='fac';
			$data['favourate_listing'][$favourateKey]->facility_list[$favourateKey]->sportListing=$sportListing;
				$data['favourate_listing'][$favourateKey]->amenities_list=$Aminitieslist;
				$data['favourate_listing'][$favourateKey]->rating_list=$data['rating_data'];
				$data['favourate_listing'][$favourateKey]->timing_list=$FacTimingList;
				$data['favourate_listing'][$favourateKey]->achievement_list=$reward_achivement_date;
				$data['favourate_listing'][$favourateKey]->is_favourate=$counts;
		
				
			   
			   
		   }
		   

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
	   }else{
		  $return_array = array(
		           'cmd' =>'Favourate listing',
					'status'=>'0',
					'response'=>$return_array,
					'response_messege' =>'parameter is missing'
					);
	  }
	   
	   
	$output=json_encode($return_array);
    echo trim($output,'"'); 
   }



}
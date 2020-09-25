<?php
ini_set("display_errors",0);
defined('BASEPATH') OR exit('No direct script access allowed');



class Facility extends CI_Controller {



    public  function __construct()
     {



   	    parent::__construct();

		$this->load->model('ApiMdl');
        $this->load->model('public/FacilityMdl');
   	 
	}







public function facility_profile(){

	 

		

if(@$_REQUEST['user_id'] && @$_REQUEST['user_name'] && @$_REQUEST['user_email'] && @$_REQUEST['user_gender'] && @$_REQUEST['user_mobile_no'] && @$_REQUEST['user_city'] && @$_REQUEST['user_pincode'] && @$_REQUEST['user_address'] && @$_REQUEST['user_address2'] && @$_REQUEST['user_country'] && @$_REQUEST['user_latitude'] && @$_REQUEST['user_longitude'] && @$_REQUEST['user_google_address']){

			   

			   

		if($_REQUEST['user_id']!=''){

			   $return_array = array(

							'cmd' =>'facility profile update',

							'status'=>'1',

							'response'=>"facility id not empty",

							'response_messege' =>'facility  profile update successfull'

						);

		

		

		

		$user_arr = array(

					'user_name' =>$_REQUEST['user_name'],

					'user_email' =>$_REQUEST['user_email'],

					'user_gender' =>$_REQUEST['user_gender'],

					'user_mobile_no' =>$_REQUEST['user_mobile_no'],

					'user_city' =>$_REQUEST['user_city'],



					'user_country'=>$_REQUEST['user_country'],

					'user_latitude'=>$_REQUEST['user_latitude'],

					'user_longitude'=>$_REQUEST['user_longitude'],

					'user_google_address'=>$_REQUEST['user_google_address'],

					'user_pincode' =>$_REQUEST['user_pincode'],

					'user_address' =>$_REQUEST['user_address'],

					'user_address2' =>$_REQUEST['user_address2'],

					'updated_by' => $_REQUEST['user_id']



		);

		

		 $whr = array('user_id'=>$_REQUEST['user_id']);

		 $res=$this->CommonMdl->updateData($user_arr,$whr,'tbl_user');

		 $get_result_facility_profile = $this->CommonMdl->getRow('tbl_user','*',array('user_id'=>$_REQUEST['user_id']));

		 

		 

		 

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

				

				

				

				

				$get_result_facility_profile->sport_list=$get_sport_list;

				$get_result_facility_profile->amenities_list=$get_amenities_data;

				$get_result_facility_profile->reward_achievement_list=$reward_achievement_list;

		 

		 

		 

		 

		 

		 

		 

		 

		 if($res){

			 $return_array = array(

							'cmd' =>'facility profile update',

							'status'=>'1',

							'response'=>$get_result_facility_profile,

							'response_messege' =>'facility profile update successfull'

						);

			 

		 }

		 else{

			 $return_array = array(

							'cmd' =>'facility profile update',

							'status'=>'0',

							'response'=>'facility not update',

							'response_messege' =>'facility not update successfull'

						);

			 

		 }

		}

		else{

			 $return_array = array(

							'cmd' =>'facility profile update',

							'status'=>'0',

							'response'=>'facility id error',

							'response_messege' =>'facility id error'

						);

			

		}

}

else{

	$return_array = array(

					'cmd' =>'User facility verification',

					'status'=>'0',

					'response'=>'',

					'response_messege' =>'parameter is missing'

					);

}

$output=json_encode($return_array);

echo trim($output,'"');

	

}


	 //stap2//



  private function set_upload_options($path){ 

        // upload file options

    $config = array();

        $config['upload_path'] = "./$path/"; //give the path to upload the image in folder

        $config['allowed_types'] = '*';

        $config['max_size'] = '0';

        $config['overwrite'] = FALSE;

        return $config;

    }

	

	

	 private function set_upload_options2($path){ 

        // upload file options

    $config = array();

        $config['upload_path'] = "./$path/"; //give the path to upload the image in folder

        $config['allowed_types'] = '*';

        $config['max_size'] = '0';

        $config['overwrite'] = FALSE;

        return $config;

    }



	

 public function facility_profiling_step2(){

	 $dataarr= array();

	$dataarr=json_decode($_REQUEST['fac_timing']);

		



	if(isset($_REQUEST['user_id']) && isset($_REQUEST['fac_name']) && isset($_REQUEST['fac_type']) && isset($_REQUEST['fac_description']) && isset($_REQUEST['fac_city']) && isset($_REQUEST['fac_pincode']) && isset($_REQUEST['fac_country']) && isset($_REQUEST['fac_address']) && isset($_REQUEST['fac_latitude'])  && isset($_REQUEST['fac_longitude'])  && isset($_REQUEST['fac_google_address'])  && isset($_REQUEST['fac_state']) ){

			   

			   if(!isset($_REQUEST['fac_id'])){

				   

				   

				  

			   

			$fac_banner_image=$_FILES['fac_banner_image']['name'];

		

			

			//$fac_logo_image=$_FILES['fac_logo_image']['name'];

		

			

			

		

			

		

			$path = "assets/public/images/fac";

			$this->upload->initialize($this->set_upload_options($path));

			if ($this->upload->do_upload('fac_banner_image')){

				  $fac_banner['fac_banner_image']= $this->upload->data();



			}

			

			 $fac_banner=$fac_banner['fac_banner_image']['file_name'];

		

			 // $path = "assets/public/images/fac";

               // $this->upload->initialize($this->set_upload_options2($path));

				// if($this->upload->do_upload('fac_logo_image')){

				   // $fac_logo['fac_logo_image']=$this->upload->data();

				// }

			   // $fac_logo=$fac_logo['fac_logo_image']['file_name'];

			  

			   

		

		

		

				   $facilitydataArr=array(

						'user_id'=>$_REQUEST['user_id'],

						'fac_name'=>$_REQUEST['fac_name'],

						'fac_type'=>$_REQUEST['fac_type'],

						'fac_description'=>$_REQUEST['fac_description'],

						'fac_city'=>$_REQUEST['fac_city'],

						'fac_pincode'=>$_REQUEST['fac_pincode'],

						'fac_country'=>$_REQUEST['fac_country'],

						'fac_address'=>$_REQUEST['fac_address'],

						'fac_banner_image'=>$fac_banner,

						// 'fac_logo_image'=>$fac_logo,

						'fac_latitude'=>$_REQUEST['fac_latitude'],

						'fac_longitude'=>$_REQUEST['fac_longitude'],

						'fac_google_address'=>$_REQUEST['fac_google_address'],

						'fac_status'=> 'disable',

						'fac_state'=> $_REQUEST['fac_state'],

						'created_on' =>date("Y-m-d H:i:s"),

						'updated_on' =>date("Y-m-d H:i:s")

				);

				

				// print_r($facilitydataArr);

				// die();

				

				

	 if($_REQUEST['user_id']!=''){

		

	       $facility_id=$this->CommonMdl->insertRow($facilitydataArr,'tbl_facility');

        

            

						foreach($dataarr as $data) {	

					//echo count($dataarr);die;

					 $datafacility_arr[]=array(

						  'fac_id'=>$facility_id,

						  'day'=>$data->day,

						  'day_status'=>$data->day_status,

						  'open_time'=>$data->open_time,

						  'close_time'=>$data->close_time,

						  'created_on'=>date('y-m-d H:i:s'),

					   );

					  

					 

					

					}

					

				

	

		   $facility_timing_id=$this->CommonMdl->insertinBatch($datafacility_arr,'tbl_facility_timing');	

          	

		  		 

				

			  //echo $this->db->last_query();  die();



			$get_result_facility_profile_step2 = $this->CommonMdl->getRow('tbl_facility','*',array('fac_id'=>$facility_id));

			    

			

			$get_result = $this->CommonMdl->getResultByCond('tbl_facility_timing',array('fac_id'=>$facility_id),$order_by='');

			

			

			

			$get_result_facility_profile_step2->fac_timing_list=$get_result;

			

			$get_result_facility_profile_step2->folder_name="fac";

			

	   

		   

		   

	    if($facility_id){

			$return_array = array(

							'cmd' =>'facility profile step1',

							'status'=>'1',

							'response'=>$get_result_facility_profile_step2,

							'response_messege' =>'facility profile insert successfull'

						);

			

		}

		else{

			$return_array = array(

							'cmd' =>'facility profile step-1',

							'status'=>'1',

							'response'=>"facility profile did not insert",

							'response_messege' =>'facility did  not insert'

						);

			

		}

		

	   }

	   else{

		   $return_array = array(

							'cmd' =>'facility profile insert',

							'status'=>'0',

							'response'=>'facility id error',

							'response_messege' =>'facility id not found'

						);  

	   }

	   



						

			

		}

		

		

		

		else{

			    

			  

			

					if(isset($_FILES['fac_banner_image']) && $_FILES['fac_banner_image']!=''){

					$fac_banner_image=$_FILES['fac_banner_image'];

						$path = "assets/public/images/fac";

						$this->upload->initialize($this->set_upload_options($path));

						if($this->upload->do_upload('fac_banner_image')){

						  $fac_banner_image_array= $this->upload->data();

						  $banner_img_name = $fac_banner_image_array['file_name'];

						}

						else if($fac_banner_image==''){

							

							  

							  $banner_img_name = '';

						}

					}else{

						$banner_img_name = '';

					}

					// if(isset($_FILES['fac_logo_image']) && $_FILES['fac_logo_image']['name']){

					// $fac_logo_image=$_FILES['fac_logo_image'];

						// $path = "assets/public/images/fac";

						// $this->upload->initialize($this->set_upload_options2($path));

						// if($this->upload->do_upload('fac_logo_image')){

						  // $fac_logo_image_array= $this->upload->data();

						  // $logo_image_name = $fac_logo_image_array['file_name'];

						// }

						// else if($fac_logo_image==''){

							

							 

							  // $logo_image_name = '';

						

						// }

					// }else{

						// $logo_image_name = '';

					// }

					 // echo $fac_banner_image;

					 // die();

					

					

					

				

				

				$facilitydataArr=array(

					'user_id'=>$_REQUEST['user_id'],

					'fac_name'=>$_REQUEST['fac_name'],

					'fac_type'=>$_REQUEST['fac_type'],

					'fac_description'=>$_REQUEST['fac_description'],

					'fac_city'=>$_REQUEST['fac_city'],

					'fac_pincode'=>$_REQUEST['fac_pincode'],

					'fac_country'=>$_REQUEST['fac_country'],

					'fac_address'=>$_REQUEST['fac_address'],

					'fac_banner_image'=>$banner_img_name,

					// 'fac_logo_image'=>$logo_image_name,

					'fac_latitude'=>$_REQUEST['fac_latitude'],

					'fac_longitude'=>$_REQUEST['fac_longitude'],

					'fac_google_address'=>$_REQUEST['fac_google_address'],

					'fac_status'=> 'disable',

					'fac_state'=> $_REQUEST['fac_state'],

					'created_on' =>date("Y-m-d H:i:s"),

					'updated_on' =>date("Y-m-d H:i:s")

			);

			

			if($banner_img_name==""){

				unset($facilitydataArr['fac_banner_image']);

			}

			// if($logo_image_name==""){

				// unset($facilitydataArr['fac_logo_image']);

			// }

				$result=$this->CommonMdl->updateData($facilitydataArr,array('fac_id'=>$_REQUEST['fac_id']),'tbl_facility');

                

		 

				$get_data=$this->CommonMdl->getRow('tbl_facility','*',array('fac_id'=>$_REQUEST['fac_id']));

				

			

			    

			

			$get_result = $this->CommonMdl->getResultByCond('tbl_facility_timing',array('fac_id'=>$_REQUEST['fac_id']),$order_by='');

			

			

			

			$get_data->fac_timing_list=$get_result;

			

	

				

				$get_data->folder_name='fac';

				

				

				if($result){

				   $return_array = array(

							'cmd' =>'facility step2 update',

							'status'=>'1',

							'response'=>$get_data,

							'response_messege' =>'facility step2 update'

						);

				   

				}

				else{

				   

				   $return_array = array(

							'cmd' =>'facility step2 update',

							'status'=>'1',

							'response'=>"facility step2 did not update",

							'response_messege' =>'facility did  not update'

						);   

				}

		}

	

 }

 

	else{

		 $return_array = array(

					'cmd' =>'User facility profiling verification',

					'status'=>'0',

					'response'=>'',

					'response_messege' =>'parameter is missing'

					);

		

	}

		$output=json_encode($return_array);

		echo trim($output,'"');

		

	

	}

	
//delete facility

function delete_facility(){

	 if(@$_REQUEST['fac_id'])

	 {

			$whr = array('fac_id'=>$_REQUEST['fac_id']);

			$this->CommonMdl->deleteRecord('tbl_facility_reward_achievement',$whr);

			$this->CommonMdl->deleteRecord('tbl_facility_timing',$whr);

			$this->CommonMdl->deleteRecord('tbl_facility_sport',$whr);

	        $this->CommonMdl->deleteRecord('tbl_facility',$whr);

			$return_array = array(

		  'cmd'=> 'sport delete',

		  'status'=>'1',

		  'response'=>'1',

		  'response_messege'=>'Sport delete sucesfully'

		);	 

	 

			

   }

	 else{

	    $return_array = array(

		  'cmd'=> 'sport delete',

		  'status'=>'0',

		  'response'=>'1',

		  'response_messege'=>'Sport parameter missing'

		);	 

	 }

	 $output = json_encode($return_array);

	 echo trim($output);	

}






  ///sports_step_3//

  

  

public function sports_step_3(){

	  
  


	if(isset($_REQUEST['fac_id']) && isset($_REQUEST['user_id']) && isset($_REQUEST['sport_id']) && isset($_REQUEST['sport_court']) && isset($_REQUEST['sport_indor']) && isset($_REQUEST['sport_outdor'])){

			   // print_r($_REQUEST);
			   // die;

	  if($_REQUEST['user_id']!=''){

	if(!isset($_REQUEST['fac_sport_id'])){

					 

					 

		$sport_arr=array(

					'fac_id'=>$_REQUEST['fac_id'],

					'user_id'=>$_REQUEST['user_id'],

					'sport_id'=>$_REQUEST['sport_id'],

					'sport_court'=>$_REQUEST['sport_court'],

					'sport_indor'=>$_REQUEST['sport_indor'],

					'sport_outdor'=>$_REQUEST['sport_outdor'],

					'created_on'=>date("Y-m-d H:i:s")

					);

					
  // print_r($sport_arr);
  // die;




		$insert_id=$this->CommonMdl->insertRow($sport_arr,'tbl_facility_sport');
		 // echo $this->db->last_query();
		 // die;

		 $get_result_facility_sport = $this->CommonMdl->getRow('tbl_facility_sport','*',array('fac_sport_id'=>$insert_id));

	

			 

			 

			 if($insert_id!=''){

				

				  

				  

			 // print_r($get_result_facility_sport);die();

				$return_array = array(

					'cmd' =>'facility sports profile',

					'status'=>'1',

					'response'=>$get_result_facility_sport,

					'response_messege' =>'facility profile insert successfull'

				);

			}

			 else{

				   $return_array = array(

							'cmd' =>'facility profile insert',

							'status'=>'0',

							'response'=>'facility id error',

							'response_messege' =>'facility id not found'

						);

				 

			 }

		 }

		 else{

			 $sport_arrs=array(

					'fac_id'=>$_REQUEST['fac_id'],

					'user_id'=>$_REQUEST['user_id'],

					'sport_id'=>$_REQUEST['sport_id'],

					'sport_court'=>$_REQUEST['sport_court'],

					'sport_indor'=>$_REQUEST['sport_indor'],

					'sport_outdor'=>$_REQUEST['sport_outdor'],

					'created_on'=>date("Y-m-d H:i:s")

					);

			 $whr = array('fac_sport_id'=>$_REQUEST['fac_sport_id']);

			

			$update_id = $this->CommonMdl->updateData($sport_arrs,$whr,'tbl_facility_sport');

			

			$get_result_facility_sport = $this->CommonMdl->getRow('tbl_facility_sport','*',array('fac_sport_id'=>$_REQUEST['fac_sport_id']));

		

					if($update_id!=''){

						$return_array = array(

										'cmd' =>'facility  sports profile update',

										'status'=>'1',

										'response'=>$get_result_facility_sport,

										'response_messege' =>'facility sport   sucessfull'

									);

					}

					else{

						$return_array = array(

										'cmd' =>'facility profile insert',

										'status'=>'0',

										'response'=>'facility id error',

										'response_messege' =>'facility id not found'

									);

					}

	     

		 }

	  

	  

	  }

      else{

		  $return_array = array(

							'cmd' =>'facility  sports profile update',

							'status'=>'0',

							'response'=>'facility sport id error',

							'response_messege' =>'facility id not found'

						);

	  }	  

	  }

	else{

		 $return_array = array(

					'cmd' =>'User facility profiling verification',

					'status'=>'0',

					'response'=>'',

					'response_messege' =>'parameter is missing'

					);

		

	}

 



$output=json_encode($return_array);

echo  trim($output,'"');



}











//facility_stap_4

public function  facility_step_4(){

		$amen=array();

	  $amen=json_decode($_REQUEST['amenities']);

	 //print_r();

	  

	if(@$_REQUEST['user_id'])	 

		{

		

		

		if($_REQUEST['user_id']!=''){

			

			

				foreach($amen as $data) {

					//echo $data->amenity_id; die;

					 $amenityArr[]=array(

					   'amenity_id' => @$data->amenity_id,

					   'user_id' => $_REQUEST['user_id'],

					   'created_on' => date("Y-m-d H:i:s"),

					   'updated_on' => date("Y-m-d H:i:s")

					 );

				}

		

		//print_r($amenityArr);die;

          

		   $this->CommonMdl->deleteRecord('tbl_facility_amenities',array('user_id'=>$_REQUEST['user_id']));

			$data_facility_amenities=$this->CommonMdl->insertinbatch($amenityArr,'tbl_facility_amenities');

		    //echo $this->db->last_query();

			

			if($data_facility_amenities){

				 $get_amenities = $this->CommonMdl->getResultByCond('tbl_facility_amenities',array('user_id'=>$_REQUEST['user_id']),'*',$order_by='');

				 //echo $this->db->last_query();die;

				// print_r($get_amenities);

				// die();

				$return_array = array(

							'cmd' =>'facility amenties',

							'status'=>'1',

							'response'=>$get_amenities,

							'response_messege' =>'facility amenties insert successfull'

						);

						

				

						

			 }

			 else{

				   $return_array = array(

							'cmd' =>'facility amenties',

							'status'=>'0',

							'response'=>'facility amenties',

							'response_messege' =>'facility  not insert error'

						);

				 

			 }

		

		

		

		}

		else{

			$return_array = array(

							'cmd' =>'facility   amenties insert',

							'status'=>'0',

							'response'=>'facility sport id error',

							'response_messege' =>'facility id not found'

						);

			

		}

	}

	 

	else{

		 $return_array = array(

					'cmd' =>'User facility profiling verification',

					'status'=>'0',

					'response'=>'',

					'response_messege' =>'parameter is missing'

					);

		

	}

		

		 	



$output=json_encode($return_array);

echo  trim($output,'"');

}





  private function set_upload_options3($path){ 

    $config = array();

        $config['upload_path'] = "./$path/"; //give the path to upload the image in folder

        $config['allowed_types'] = '*';

        $config['max_size'] = '0';

        $config['overwrite'] = FALSE;

        return $config;

    }

	

	







	  private function set_upload_options5($path){ 

    $config = array();

        $config['upload_path'] = "./$path/"; //give the path to upload the image in folder

        $config['allowed_types'] = '*';

        $config['max_size'] = '0';

        $config['overwrite'] = FALSE;

        return $config;

    }

//facility_stap_5

public function  facility_step_5(){

				
				if(isset($_REQUEST['ifsc_code']) && isset($_REQUEST['bank_name']) && isset($_REQUEST['account_name']) && isset($_REQUEST['account_number']) && isset($_REQUEST['account_type']) && isset($_REQUEST['branch_address']) && isset($_REQUEST['cin_no']) && isset($_REQUEST['gst_no']) && isset($_REQUEST['pan_no']) ){

						

						

                 if(!isset($_REQUEST['bank_info_id'])){

					 

					$gst_image=$_FILES['gst_image']['name'];

					$pan_image=$_FILES['pan_image']['name'];

					$firm_image=$_FILES['firm_image']['name'];

					$address_proof_image=$_FILES['address_proof_image']['name'];

					$cheque_image=$_FILES['cheque_image']['name'];

				

					$path = "assets/public/images/bankinfo";

					$this->upload->initialize($this->set_upload_options($path));

					 

					

				

					if($this->upload->do_upload('gst_image')){

						



					   $fac_gst['gst_image']= $this->upload->data();
                      
					  }

					  

					  

				    $gst_image=$fac_gst['gst_image']['file_name'];

					



                     

					$path = "assets/public/images/bankinfo";

					$this->upload->initialize($this->set_upload_options2($path));

					if($this->upload->do_upload('pan_image')){

					    $fac_pan['pan_image']=$this->upload->data();

					 }

					$pan_image=$fac_pan['pan_image']['file_name'];

					

					

				     

					$path = "assets/public/images/bankinfo";

					$this->upload->initialize($this->set_upload_options3($path));

					

					

					if($this->upload->do_upload('firm_image')){

					    $fac_firm['firm_image']=$this->upload->data();

					}

					$firm_image=$fac_firm['firm_image']['file_name'];





                    $path = "assets/public/images/bankinfo";

					$this->upload->initialize($this->set_upload_options4($path));

					if ($this->upload->do_upload('address_proof_image')){

					$fac_firm_address_proof['address_proof_image']=$this->upload->data();

					}

					$address_proof_image=$fac_firm_address_proof['address_proof_image']['file_name'];

			   

                      

					  

					  

					$path = "assets/public/images/bankinfo";

					$this->upload->initialize($this->set_upload_options5($path));

					if ($this->upload->do_upload('cheque_image')){

					$fac_cheque_image['cheque_image']=$this->upload->data();

					}

					$fac_cheque_image=$fac_cheque_image['cheque_image']['file_name'];

			   

			    $arr_bank_info=array(

				            

							'user_id' => $_REQUEST['user_id'],

							'ifsc_code' => $_REQUEST['ifsc_code'],

							'bank_name' => $_REQUEST['bank_name'],

							'account_name' => $_REQUEST['account_name'],

							'account_number' => $_REQUEST['account_number'],

							'account_type' => $_REQUEST['account_type'],

							'branch_address' => $_REQUEST['branch_address'],

							'gst_image' => $gst_image,

							'pan_image' => $pan_image,

							'firm_image' => $firm_image,

							'address_proof_image' =>$address_proof_image,

							'cheque_image' => $fac_cheque_image,

							'gst_no'=>$_REQUEST['gst_no'],

							'pan_no'=>$_REQUEST['pan_no'],

							'cin_no'=>$_REQUEST['cin_no'],

							'created_on' =>date("Y-m-d H:i:s"),

							'updated_on' =>date("Y-m-d H:i:s")

							    

				 );

				  // print_r($arr_bank_info);
				  // die;

				 

				$res = $this->CommonMdl->insertRow($arr_bank_info,'tbl_user_bank_details');
				
				// print_r($res);
				


				 

				if($res){

					 $get_result_bank_info = $this->CommonMdl->getRow('tbl_user_bank_details','*',array('bank_info_id'=>$res));

				     $get_result_bank_info->folder_name="bankinfo";
                  
					 

					 

					

					 

				$return_array = array(

							'cmd' =>'facility bank  info',

							'status'=>'1',

							'response'=>$get_result_bank_info,

							'response_messege' =>'facility bank insert successfull'

						);

						

				

						

			 }

			 else{

				   $return_array = array(

							'cmd' =>'facility bank  info',

							'status'=>'0',

							'response'=>'facility id error',

							'response_messege' =>'facility  not insert error'

						);

				 

			 }

		  



   }

				else{

				

					

					if(isset($_FILES['gst_image']) && $_FILES['gst_image']!='')

					{

						$gst_image=$_FILES['gst_image'];

						$path = "assets/public/images/bankinfo";

						$this->upload->initialize($this->set_upload_options($path));



					if($this->upload->do_upload('gst_image')){

						$fac_gst_array= $this->upload->data();

						$gst_image_name=$fac_gst_array['file_name'];

					}

					else if($gst_image==''){

						$gst_image_name='';

					}

					}

					else{

						$gst_image_name='';

					}



					if(isset($_FILES['pan_image']) && $_FILES['pan_image']['name'])

					{

						$fac_pan_image=$_FILES['pan_image'];

                        $path = "assets/public/images/bankinfo";

						$this->upload->initialize($this->set_upload_options2($path));

					if($this->upload->do_upload('pan_image'))

					{

						$fac_pan_array=$this->upload->data();

						$fac_pan_image_name=$fac_pan_array['file_name'];

					}

					else if($fac_pan_image==''){



						$fac_pan_image_name='';

					}

					}

					else{

							$fac_pan_image_name='';	 

					}

					

					if(isset($_FILES['firm_image']) && $_FILES['firm_image']['name'])

					{

						$fac_firm_image=$_FILES['firm_image'];

                        $path = "assets/public/images/bankinfo";

						$this->upload->initialize($this->set_upload_options3($path));

					if($this->upload->do_upload('firm_image'))

					{

						$fac_firm_array=$this->upload->data();

						$fac_firm_image_name=$fac_firm_array['file_name'];

					}

					else if($fac_firm_image==''){



						$fac_firm_image_name='';

					}

					}

					else{

							$fac_firm_image_name='';	 

					}

					

					

					if(isset($_FILES['address_proof_image']) && $_FILES['address_proof_image']['name'])

					{

						$fac_address_proof_image=$_FILES['address_proof_image'];

                        $path = "assets/public/images/bankinfo";

						$this->upload->initialize($this->set_upload_options4($path));

					if($this->upload->do_upload('address_proof_image'))

					{

						$address_proof_array=$this->upload->data();

						$address_proof_name=$address_proof_array['file_name'];

					}

					else if($fac_firm_image==''){



						$address_proof_name='';

					}

					}

					else{

					    $address_proof_name='';	 

					}

					

					if(isset($_FILES['cheque_image']) && $_FILES['cheque_image']['name'])

					{

						$cheque_image=$_FILES['cheque_image'];

                        $path = "assets/public/images/bankinfo";

						$this->upload->initialize($this->set_upload_options5($path));

					if($this->upload->do_upload('cheque_image'))

					{

						$cheque_image_array=$this->upload->data();

						$cheque_image_name=$cheque_image_array['file_name'];

					}

					else if($cheque_image==''){



						$cheque_image_name='';

					}

					}

					else{

					    $cheque_image_name='';	 

					}

					

				

					 

			    $arr_bank_info=array(

				            

							'user_id' => $_REQUEST['user_id'],

							'ifsc_code' => $_REQUEST['ifsc_code'],

							'bank_name' => $_REQUEST['bank_name'],

							'account_name' => $_REQUEST['account_name'],

							'account_number' => $_REQUEST['account_number'],

							'account_type' => $_REQUEST['account_type'],

							'branch_address' => $_REQUEST['branch_address'],

							'gst_image' => $gst_image_name,

							'pan_image' => $fac_pan_image_name,

							'firm_image' => $fac_firm_image_name,

							'address_proof_image' =>$address_proof_name,

							'cheque_image' => $cheque_image_name,

							'gst_no'=>$_REQUEST['gst_no'],

							'pan_no'=>$_REQUEST['pan_no'],

							'cin_no'=>$_REQUEST['cin_no'],

							'created_on' =>date("Y-m-d H:i:s"),

							'updated_on' =>date("Y-m-d H:i:s")

							    

				 );

				

				 

				 

				 if($gst_image_name ==''){

					 unset($arr_bank_info['gst_image']);

				 }

				 if($fac_pan_image_name ==''){

					 unset($arr_bank_info['pan_image']);

				 }

				 if($fac_firm_image_name ==''){

					 unset($arr_bank_info['firm_image']);

				 }

				 if($address_proof_name ==''){

					 unset($arr_bank_info['address_proof_image']);

				 }

				 if($cheque_image_name ==''){

					 unset($arr_bank_info['cheque_image']);

				 }

				
              
				$res=$this->CommonMdl->updateData($arr_bank_info,array('bank_info_id'=>$_REQUEST['bank_info_id']),'tbl_user_bank_details');



				

				

				

				 if($res){

					 $get_result_bank_info = $this->CommonMdl->getRow('tbl_user_bank_details','*',array('user_id'=>$_REQUEST['user_id']));

				     $get_result_bank_info->folder_name="bankinfo";

					 

					 

					

					 

				$return_array = array(

							'cmd' =>'facility bank  info',

							'status'=>'1',

							'response'=>$get_result_bank_info,

							'response_messege' =>'facility bank insert successfull'

						);

						

				

						

			 }

			 else{

				   $return_array = array(

							'cmd' =>'facility bank  info',

							'status'=>'0',

							'response'=>'facility id error',

							'response_messege' =>'facility  not insert error'

						);

				 

			 }

			 

			 

			 

				 

				

				

				

				

				

					

				}

			

		  

		}

				

	

			else{

				$return_array = array(

					'cmd' =>'User facility profiling verification',

					'status'=>'0',

					'response'=>'',

					'response_messege' =>'parameter is missing'

					);

			}	

	

 $output=json_encode($return_array);

 echo  trim($output,'"');

}













//Facility/Academy listing API

public function  facility_academy_listing(){
$result_array=array();
	

	   if(isset($_REQUEST['user_id']))

	   {

	

	  $get_facility_data=$this->CommonMdl->getResultByCond('tbl_facility',array('user_id'=>$_REQUEST['user_id']),$clms='',$order_by='');

	

	  $get_fac_id=$this->ApiMdl->getcustomResult($_REQUEST['user_id']);

   	

		foreach($get_facility_data as $k=>$v)

			{

			

				$get_facility_data[$k]->folder_name= "fac";

			

				foreach($get_fac_id as $i=>$vl)

				{

					if($v->fac_id == $vl->fac_id)

					{

					  $get_facility_data[$k]->fac_timing_list[]= $vl;

					}

				}	

				

			}

		             

	 

	  if($get_facility_data!=''){

	  $return_array = array(

							'cmd' =>'facility academy listing',

							'status'=>'1',

							'response'=>$get_facility_data,

							'response_messege' =>'facility academy listing '

						);

				}
				

			 else{

				   $return_array = array(

							'cmd' =>'facility academy listing',

							'status'=>'1',

							'response'=>$result_array,

							'response_messege' =>'facility  not get result error'

						);

				 

			 }

			 

	   }

	  

	   else{

		   $return_array = array(

					'cmd' =>'User facility profiling verification',

					'status'=>'0',

					'response'=>'',

					'response_messege' =>'parameter is missing'

					);

		   

	   }

$output=json_encode($return_array);

echo  trim($output,'"');

}













//Master API - Amenities

function  master_amenities_list(){
$return_array=array();


           if(isset($_REQUEST['action']))
		   {

	    $get_amenities_data= $this->CommonMdl->getResultByCond('tbl_amenity',array('amenity_status'=>'enable'),'amenity_id,amenity_name,amenity_icon',$order_by='');

		

		

		  foreach($get_amenities_data as $k=>$v){

			  $get_amenities_data[$k]->folder_name="amenity";

			  

		  }

						if($get_amenities_data!=''){

						  $return_array = array(

									'cmd' =>'facility academy listing',

									'status'=>'1',

									'response'=>$get_amenities_data,

									'response_messege' =>'facility academy listing get result successfull'

								);

						}

						else{

							 $return_array = array(

									'cmd' =>'facility academy listing',

									'status'=>'1',

									'response'=>$result_array,

									'response_messege' =>'facility  not get result error'

								);

						}

		   }
		   else{
			    $return_array = array(

									'cmd' =>'facility academy listing',

									'status'=>'0',

									'response'=>'0',

									'response_messege' =>'Parameter missing'

								);
		   }

	

$output=json_encode($return_array);

echo  trim($output,'"');



}


//Master API - Sports 

public function master_sport_list(){
$return_array=array();
 	    if(isset($_REQUEST['action']))
		{
    	$get_sport_list=$this->CommonMdl->getResultByCond('tbl_sport_list',array('sport_status'=>'enable'),'sport_id,sport_name,sport_icon,created_on,sport_status',$order_by='');

	

	foreach($get_sport_list as $k=>$v){

		$get_sport_list[$k]->folder_name= "sports";

	}

	if($get_sport_list!=''){

				  $return_array = array(

							'cmd' =>'facility sport listing',

							'status'=>'1',

							'response'=>$get_sport_list,

							'response_messege' =>'facility sport listing get result successfull'

						);

			 }

			 else{

				     $return_array = array(

							'cmd' =>'facility sport listing',

							'status'=>'1',

							'response'=>$return_array,

							'response_messege' =>'facility  not get result error'

						);

			 }
		}
		
		else{
			$return_array = array(

							'cmd' =>'sport listing',

							'status'=>'0',

							'response'=>'0',

							'response_messege' =>'Parameter missing'

						);
			
		}
	 

$output=json_encode($return_array);

echo  trim($output,'"');



}





//Reward Achievemen List

function   reward_achievement_list(){
$return_array=array();
		  
        if(isset($_REQUEST['action']))
		{
	      $reward_achievement_list=$this->CommonMdl->getResultByCond('tbl_reward_achievement',array('reward_status'=>'enable'),'reward_id,reward_name',$order_by='');

		  

	if($reward_achievement_list!=''){

				  $return_array = array(

							'cmd' =>'facility achievement listing',

							'status'=>'1',

							'response'=>$reward_achievement_list,

							'response_messege' =>'facility achievement listing get result successfull'

						);

			 }

			 else{

				     $return_array = array(

							'cmd' =>'facility achievement listing',

							'status'=>'1',

							'response'=>$return_array,

							'response_messege' =>'facility  not get result error'

						);

			 }
		}
		else{
			$return_array = array(

							'cmd' =>'facility achievement listing',

							'status'=>'0',

							'response'=>'0',

							'response_messege' =>'Parameter missing'

						);
			
		}


$output=json_encode($return_array);

echo  trim($output,'"');	  

		

}



function fac_sport_listing(){

	  

if(isset($_REQUEST['user_id'])){

	$user_id = '';

	$fac_id = '';

	$user_id  = $_REQUEST['user_id'];

	$fac_id  = @$_REQUEST['fac_id'];

   

                $facility_sport_list = $this->ApiMdl->getFacSportList($user_id,$fac_id);
				// echo $this->db->last_query();
				// die;
				

              if($facility_sport_list!=''){

					$return_array = array(

					'cmd' =>'1',

					'status'=>'1',

					'response'=>$facility_sport_list,

					'response_messege' =>'facility sport list'

					);				

				}
				

}

	else

	{

			$return_array = array(

			'cmd' => 'facility list',

			'status' =>'0',

			'response' =>'0',

			'response_messege' =>'parameter is missing'

			);

}

	$output = json_encode($return_array);

	echo trim($output,'"');



	

}


//Profile Summary


function profile_summary_update(){

if(@$_REQUEST['user_id'] && @$_REQUEST['user_name'] && @$_REQUEST['user_email'] && @$_REQUEST['user_gender'] && 

@$_REQUEST['user_mobile_no'] && @$_REQUEST['user_city'] && @$_REQUEST['user_pincode'] && @$_REQUEST['user_address'] && @$_REQUEST['user_address2'])

	{			

	

	   $user_arr = array(

                    'user_name' => trim($_REQUEST['user_name']),

                    'user_email' => trim($_REQUEST['user_email']),

                    'user_gender' => trim($_REQUEST['user_gender']),

                    'user_mobile_no' => trim($_REQUEST['user_mobile_no']),

                    'user_city' => trim($_REQUEST['user_city']),

                    'user_pincode' => trim($_REQUEST['user_pincode']),

                    'user_address' => trim($_REQUEST['user_address']),

                    'user_address2' => trim($_REQUEST['user_address2']),

                    'updated_by' => trim($_REQUEST['user_id']),

                    'updated_on' => date("Y-m-d H:i:s"),

                    );

					

				$res=$this->CommonMdl->updateData($user_arr,array('user_id'=>$_REQUEST['user_id']),'tbl_user');





				 if($res){

					 

					 $profile_summary_update=$this->CommonMdl->getRow('tbl_user','*',array('user_id'=>$_REQUEST['user_id']));

					 

				 $return_array = array(

								'cmd' =>'Profile summary update',

								'status'=>'1',

								'response'=>$profile_summary_update,

								'response_messege' =>'Profile summary update successfull'

							);

				 

				}

				else{

				 $return_array = array(

								'cmd' =>'Profile update',

								'status'=>'0',

								'response'=>'Profile not update',

								'response_messege' =>'Profile not update successfull'

							);

				 

				}

	}

		else

	{

			$return_array = array(

			'cmd' => 'Profile list',

			'status' =>'0',

			'response' =>'0',

			'response_messege' =>'parameter is missing'

			);

     }

	$output = json_encode($return_array);

	echo trim($output,'"');

}	



 //Edit your Acheivement Details



function profile_academy_update(){



	if(@$_REQUEST['fac_name'] && @$_REQUEST['fac_description'] && @$_REQUEST['fac_city'] && @$_REQUEST['fac_pincode'] && 

	 @$_REQUEST['fac_address'] && @$_REQUEST['updated_by_type'])

      {

$fac_banner['file_name']='';  

// $fac_logo['file_name']='';



$new_fac_banner = $_FILES['fac_banner']['name'];

// $new_fac_logo = $_FILES['fac_logo']['name'];

$path = "assets/public/images/fac";

   

    

		  

		  

        

		             $_FILES['fac_banner_image']['name'];

		             $_FILES['fac_logo_image']['name'];

		           

			$_REQUEST['fac_name'];

			$_REQUEST['fac_description'];

			$_REQUEST['fac_city'];

			$_REQUEST['fac_pincode'];

			$_REQUEST['fac_address'];

			$_REQUEST['updated_by_type'];

  

     }

}





//Achievements Detail  update





function achievements_details_update(){

	if(@$_REQUEST['reward_achievement_id'] && @$_REQUEST['reward_title'] && @$_REQUEST['reward_id'])

		{

			  

			$image1=$_FILES['file_name']='';

			$image2=$_FILES['file_name']='';



			$new_image1=$_FILES['image1']['name'];

			$new_image2=$_FILES['image2']['name'];

			$path = "assets/public/images/rewards";

			$this->upload->initialize($this->set_upload_options($path));

		if($this->upload->do_upload('image1')){

		  $image1= $this->upload->data();

		}

		else if($new_image1==''){

		  $image1['file_name']=$_REQUEST['image1'];				 

		}

		$path = "assets/public/images/rewards";	

		$this->upload->initialize($this->set_upload_options2($path));

		if ($this->upload->do_upload('image2')){

		    $image2= $this->upload->data();

		}



		else if($new_image2==''){

		$image2['file_name']=$_REQUEST['image2'];

		}

				 

			

			  $datArr=array(

			  'reward_title' => trim($_REQUEST['reward_title']),

			  'reward_id' => trim($_REQUEST['reward_id']),

			  'image1' => $image1['file_name'],

			  'image2' => $image2['file_name'],

			  'updated_on' => date("Y-m-d H:i:s")

			  );

			  

			

			  

			$res=$this->CommonMdl->updateData($datArr,array('reward_achievement_id'=>$_REQUEST['reward_achievement_id']),'tbl_facility_reward_achievement');

			

				 $profile_achievements_detail_update=$this->CommonMdl->getRow('tbl_facility_reward_achievement','*',array('reward_achievement_id'=>$_REQUEST['reward_achievement_id']));

			       

				   $profile_achievements_detail_update->folder_name="rewards";

			      //$profile_achievements_detail_update=array('folder_name'=>$profile_achievements_detail_update);

				  //print_r($profile_achievements_detail_update);

				  

			 if($res){

				$return_array = array(

					'cmd' =>'facility academy details update',

					'status'=>'1',

					'response'=>$profile_achievements_detail_update,

					'response_messege' =>'facility academy details update successfull'

				);



			}

			else{

			$return_array = array(

					'cmd' =>'Profile update',

					'status'=>'0',

					'response'=>'Profile not update',

					'response_messege' =>'Profile not update successfull'

				);



			}        

		}

		

		else{

		$return_array = array(

		'cmd' => 'Profile achievements detail',

		'status' =>'0',

		'response' =>'0',

		'response_messege' =>'Parameter is missing'

		);

			

		}

		$output = json_encode($return_array);

	     echo trim($output,'"');



}







// Sports Details



function profile_sport_details(){



if(@$_REQUEST['sport_court'] && @$_REQUEST['sport_indor'] && @$_REQUEST['sport_outdor'] && @$_REQUEST['sport_id'] && @$_REQUEST['fac_sport_id'])

{





	

	

		$datArr = array(

			'sport_court' => trim($_REQUEST['sport_court']),

			'sport_indor' => trim($_REQUEST['sport_indor']),

			'sport_outdor' => trim($_REQUEST['sport_outdor']),

			'sport_id' => trim($_REQUEST['sport_id']),

			'updated_on' => date("Y-m-d H:i:s"),

		);

		

		

		

		$res=$this->CommonMdl->updateData($datArr,array('fac_sport_id'=>$_REQUEST['fac_sport_id']),'tbl_facility_sport');

            if($res){

				

			 $profile_summary_update=$this->CommonMdl->getRow('tbl_facility_sport','*',array('fac_sport_id'=>$_REQUEST['fac_sport_id']));

			$return_array = array(

					'cmd' =>'Profile sports details update',

					'status'=>'1',

					'response'=>$profile_summary_update,

					'response_messege' =>'Profile  sports details update successfull'

				);



			}

			else{

			$return_array = array(

					'cmd' =>' Profile update',

					'status'=>'0',

					'response'=>'Profile not update',

					'response_messege' =>'Profile not update successfull'

				);



			} 

			

			

		

					

}

else{

	 $return_array = array(

		'cmd' => 'Profile achievements detail',

		'status' =>'0',

		'response' =>'0',

		'response_messege' =>'Profile is missing'

		);

   }

    $output = json_encode($return_array);

	echo trim($output,'"');   

					

}

 

 

 

 // Amenities Detail

 function profile_amenity_edit(){  

 

 $amen=array();

	  $amen=json_decode($_REQUEST['amenities']);

	  

	  

	  	if(@$_REQUEST['user_id'])	 

		{

		

		

				if($_REQUEST['user_id']!=''){

					

					

						foreach($amen as $data) {

							//echo $data->amenity_id; die;

							 $amenityArr[]=array(

							   'amenity_id' => @$data->amenity_id,

							   'user_id' => $_REQUEST['user_id'],

							   'created_on' => date("Y-m-d H:i:s"),

							   'updated_on' => date("Y-m-d H:i:s")

							 );

							 

							 $get_result_profile = $this->CommonMdl->getRow('tbl_facility_timing','*',array('fac_id'=>$_REQUEST['fac_id']));



							$data_facility_amenities=$this->CommonMdl->insertinbatch($amenityArr,'tbl_facility_amenities');

							

							if($data_facility_amenities){

							

							$return_array = array(

							'cmd' =>'Profile amenties',

							'status'=>'1',

							'response'=>$get_result_profile,

							'response_messege' =>'Profile amenties insert successfull'

							);







							}

							else{

							$return_array = array(

							'cmd' =>'Profile amenties',

							'status'=>'0',

							'response'=>'Profile amenties',

							'response_messege' =>'Profile  not insert error'

							);



							}

						}

				}

				else{	

					$return_array = array(

					'cmd' => 'Profile amenity',

					'status' =>'0',

					'response' =>'0',

					'response_messege' =>''

					);

		}

		}

		

		else{

			$return_array = array(

			'cmd' => 'Profile amenity detail',

			'status' =>'0',

			'response' =>'0',

			'response_messege' =>'parameter is missing'

			);

		}

		 $output = json_encode($return_array);

	      echo trim($output,'"'); 

				 

 }

 

 

 //Timings

 

 public function fac_timing_edit(){

	

	

	

	if($_REQUEST['fac_id'])

	{

       $dataarr= array();

	  $dataarr=json_decode($_REQUEST['fac_timing']);

	  

	  		foreach($dataarr as $data) {

              $datafacility_arr[]=array(

						  'fac_id'=>$_REQUEST['fac_id'],

						  'day'=>$data->day,

						  'day_status'=>$data->day_status,

						  'open_time'=>$data->open_time,

						  'close_time'=>$data->close_time,

						  'created_on'=>date('y-m-d H:i:s'),

					   );

					   

						$this->CommonMdl->deleteRecord('tbl_facility_timing',array('fac_id'=>$this->input->post('fac_id')));

						$res=$this->CommonMdl->insertinbatch($datafacility_arr,'tbl_facility_timing');

						$get_result_profile = $this->CommonMdl->getRow('tbl_facility_timing','*',array('fac_id'=>$_REQUEST['fac_id']));

			

	   

						

						if($res){

						$return_array = array(

						'cmd' =>'Profile timings',

						'status'=>'1',

						'response'=>$get_result_profile,

						'response_messege' =>'Profile timings insert successfull'

						);



						}

						else{

						$return_array = array(

						'cmd' =>'Profile timings',

						'status'=>'0',

						'response'=>"Profile timings did not insert",

						'response_messege' =>'Profile timings did  not insert'

						);



						}

					}

	}

	else{

		 $return_array = array(

					'cmd' =>'Profile timings',

					'status'=>'0',

					'response'=>'',

					'response_messege' =>'parameter is missing'

					);

		

	}

		$output=json_encode($return_array);

		echo trim($output,'"');

	 

 }

 

 

 

 public function bank_info_update(){

     if(@$_REQUEST['user_id'] && @$_REQUEST['ifsc_code'] && @$_REQUEST['bank_name'] && @$_REQUEST['account_type'] && 

			@$_REQUEST['branch_address'] && @$_REQUEST['account_name'] && @$_REQUEST['account_number'] && @$_REQUEST['gst_no'] && @$_REQUEST['pan_no'] && @$_REQUEST['business_registration_no'] && @$_REQUEST['gst_image'] && @$_REQUEST['pan_image'] && @$_REQUEST['firm_image'] && @$_REQUEST['cheque_image'] && @$_REQUEST['address_proof_image'])

		{	 

          

		  

			   $update_bank_arr = array(

				  'ifsc_code' => trim($_REQUEST['ifsc_code']),

				  'bank_name' => trim($_REQUEST['bank_name']),

				  'account_type' => trim($_REQUEST['account_type']),

				  'branch_address' => trim($_REQUEST['branch_address']),

				  'account_name' => trim($_REQUEST['account_name']),

				  'account_number' => trim($_REQUEST['account_number']),

				  'gst_no' => trim($_REQUEST['gst_no']),

				  'pan_no' => trim($_REQUEST['pan_no']),

				  'business_registration_no' => trim($_REQUEST['business_registration_no']),

				  'gst_image' => trim($_REQUEST['gst_image']),

				  'pan_image' => trim($_REQUEST['pan_image']),

				  'firm_image' => trim($_REQUEST['firm_image']),

				  'cheque_image' => trim($_REQUEST['cheque_image']),

				  'address_proof_image' => trim($_REQUEST['address_proof_image']),

				  'updated_on' => date("Y-m-d H:i:s")

				  );

				  $this->CommonMdl->deleteRecord('tbl_user_bank_details',array('user_id'=>$_REQUEST['user_id']));

				  // echo $this->db->last_query();

				  // die();

                  $res=$this->CommonMdl->insertRow($update_bank_arr,'tbl_user_bank_details');



				  

				  

				  if($res){

                    $get_result=$this->CommonMdl->getRow('tbl_user_bank_details','*',array('user_id'=>$_REQUEST['user_id']));

					// echo $this->db->last_query();

					

					// die();

					  

					  

				          

				 

				$return_array = array(

							'cmd' =>'Bank details',

							'status'=>'1',

							'response'=>$get_result,

							'response_messege' =>'Profile bank details insert successfull'

						);

						

				

						

			 }

			 else{

				   $return_array = array(

							'cmd' =>'Bank details',

							'status'=>'0',

							'response'=>'Bank details',

							'response_messege' =>'Bank details not insert error'

						);

				 

			 }



		}

	     else{

				$return_array = array(

				'cmd' => 'Bank details detail',

				'status' =>'0',

				'response' =>'0',

				'response_messege' =>'parameter is missing'

				);

			}

		$output = json_encode($return_array);

		echo trim($output,'"'); 

			

			

        

 }

 

 //Achievements insert

 function add_edit_achievements(){

	 

	  if(isset($_REQUEST['fac_id']) && @$_REQUEST['reward_title'])

		{

				

			   if(!isset($_REQUEST['reward_achievement_id']))

			   {		



               		   

			if(isset($_FILES['image1']) && $_FILES['image1']!='')

			{

				$achievement_image1=$_FILES['image1'];

				$path = "assets/public/images/rewards";

				$this->upload->initialize($this->set_upload_options($path));

				if($this->upload->do_upload('image1'))

				{

					$achievement_array=$this->upload->data();

					$achievement_image=$achievement_array['file_name'];

					

				}



				else if($achievement_image1==''){

					$achievement_image='';

				}

			}

			else{

			   $achievement_image='';

			}

			

			



			if(isset($_FILES['image2']) && $_FILES['image2']!='')

			{

				$achievement_image2=$_FILES['image2'];

				$path = "assets/public/images/rewards";

				$this->upload->initialize($this->set_upload_options2($path));

			if($this->upload->do_upload('image2'))

			{

				$achievement_array=$this->upload->data();

				$achievement_imag_2=$achievement_array['file_name'];

			}

			else if($achievement_image2==''){

				$achievement_imag_2='';

			}

			}

			else{

			    $achievement_imag_2='';

			}

			



			



				$insert_achevment = array(

				  'fac_id' => trim($_REQUEST['fac_id']),

				  'reward_title' => trim($_REQUEST['reward_title']),

				  'reward_id' => trim($_REQUEST['reward_id']),

				  'image1' => trim($achievement_image),

				  'image2' => trim($achievement_imag_2),

				);  

				

				 if($achievement_image==''){

					unset($insert_achevment['image1']);

				}

				if($achievement_imag_2==''){

					unset($insert_achevment['image2']);

				}

				

				$res_id=$this->CommonMdl->insertRow($insert_achevment,'tbl_facility_reward_achievement');



				// echo $res_id;

				// die();

				$achievements_get=$this->CommonMdl->getRow('tbl_facility_reward_achievement','*',array('reward_achievement_id'=>$res_id));

				$achievements_get->folder_name="rewards";

				if($res_id)

				{

					$return_array = array(

						'cmd' =>'Achievements',

						'status'=>'1',

						'response'=>$achievements_get,

						'response_messege' =>'Achievements insert  successfull'

						);	

				}

				else{

					   $return_array = array(

							'cmd' =>'Achievements',

							'status'=>'0',

							'response'=>'Achievements',

							'response_messege' =>'Achievements not insert error'

						);

				}

			 

		   }

            else{

          





			if(isset($_FILES['image1']) && $_FILES['image1']!='')

			{

				$achievement_image1=$_FILES['image1'];

				$path = "assets/public/images/rewards";

				$this->upload->initialize($this->set_upload_options($path));

			if($this->upload->do_upload('image1'))

			{

				$achievement_array=$this->upload->data();

				$achievement_image=$achievement_array['file_name'];

				

			}



			else if($achievement_image1==''){

				$achievement_image='';

			}

			}

			else{

			   $achievement_image='';

			}

			

			



			if(isset($_FILES['image2']) && $_FILES['image2']['name'])

			{

				$achievement_image2=$_FILES['image2'];

				$path = "assets/public/images/rewards";

				$this->upload->initialize($this->set_upload_options2($path));

			if($this->upload->do_upload('image2'))

			{

				$achievement_array=$this->upload->data();

				$achievement_imag_2=$achievement_array['file_name'];

			}

			else if($achievement_image2==''){

				$achievement_imag_2='';

			}

			}

			else{

			    $achievement_imag_2='';

			}

			

				$insert_achievements = array(

				  'fac_id' => trim($_REQUEST['fac_id']),

				  'reward_title' => trim($_REQUEST['reward_title']),

				  'reward_id' => trim($_REQUEST['reward_id']),

				  'image1' => trim($achievement_image),

				  'image2' => trim($achievement_imag_2),

				);

			

                if($achievement_image==''){

					unset($insert_achievements['image1']);

				}

				if($achievement_imag_2==''){

					unset($insert_achievements['image2']);

				}

				

              

			  

	        $res_id=$this->CommonMdl->updateData($insert_achievements,array('reward_achievement_id'=>$_REQUEST['reward_achievement_id']),'tbl_facility_reward_achievement');

			  

				// echo $res_id;

				// die();

				$achievements_get=$this->CommonMdl->getRow('tbl_facility_reward_achievement','*',array('reward_achievement_id'=>$_REQUEST['reward_achievement_id']));

				$achievements_get->folder_name="rewards";

				if($res_id)

				{

					$return_array = array(

						'cmd' =>'Achievements',

						'status'=>'1',

						'response'=>$achievements_get,

						'response_messege' =>'Achievements update  successfull'

						);	

				}

				else{

					 $return_array = array(

						'cmd' =>'Achievements',

						'status'=>'1',

						'response'=>'',

						'response_messege' =>'Achievements not update  successfull'

						);

					

					

				}

				

			}		   

			

			

		}

		else{

				$return_array = array(

				'cmd' => 'Achevement detail',

				'status' =>'0',

				'response' =>'0',

				'response_messege' =>'parameter is missing'

				);

			}

		$output = json_encode($return_array);

		echo trim($output,'"'); 

		

	 

 }

 

 

 

 

 

 

 

 ///edit fac timings edit






function fac_timings_edit(){

      $get_data=json_decode($_REQUEST['fac_timing']);

	 

	 if(isset($_REQUEST['fac_id']))

	 {

	      foreach($get_data as $data){

			  

			  

			  $dataArr[]=array(

			  'fac_id'=>trim($_REQUEST['fac_id']),

			 'day'=>trim($data->day),

			 'day_status'=>trim($data->day_status),

			 'open_time'=>trim($data->open_time),

			 'close_time'=>trim($data->close_time),

			 'created_on'=>date("Y-m-d H:i:s"),

			 );

			   

			}

		   // print_r($dataAr);

		   // return false;

		



		 $this->CommonMdl->deleteRecord('tbl_facility_timing',array('fac_id'=>$_REQUEST['fac_id']));

		 $res=$this->CommonMdl->insertinBatch($dataArr,'tbl_facility_timing');

		  $get_timing_result=$this->CommonMdl->getResultByCond('tbl_facility_timing',array('fac_id'=>$_REQUEST['fac_id'],$order_by=''));

		  

		  //$get_timing_result=array('timing_list_update'=>$get_timing_result);

		  

		  if($res){

			  $return_array = array(

			    'cmd' =>'facility timing',

				'status' =>'1',

				'response'=>$get_timing_result,

				'response_messege'=>'facility timing update sucessfully'

			  );

			    

			  

		  }

			

			  

	 }

	 else{

		  $return_array = array(

				'cmd' => 'Achevement detail',

				'status' =>'0',

				'response' =>'0',

				'response_messege' =>'parameter is missing'

		  );

		 

	 }

	 $output = json_encode($return_array);

	 echo trim($output);

	

	

}


//Sport Delete

public function sport_delete(){

	 if(@$_REQUEST['fac_sport_id'] && @$_REQUEST['fac_id'])

	 {

		  $get_sport=$this->CommonMdl->deleteRecord('tbl_facility_sport',array('fac_sport_id'=>$_REQUEST['fac_sport_id'],'fac_id'=>$_REQUEST['fac_id']));

		  // echo $this->db->last_query();

		  

					$return_array = array(

					'cmd' => 'sport detail',

					'status' =>'1',

					'response' =>'1',

					'response_messege' =>'sport detete sucesfully'

			  );   

		  

	}

	 else{

	    $return_array = array(

		  'cmd'=> 'sport delete',

		  'status'=>'0',

		  'response'=>'1',

		  'response_messege'=>'Sport delete sucesfully'

		);	 

	 }

	 $output = json_encode($return_array);

	 echo trim($output);	

}



public function  facility_reward_achievement(){

	 

		

		if(trim(@$_REQUEST['fac_id']))

		{

			$facility_reward_achievment=$this->CommonMdl->getResultByCond('tbl_facility_reward_achievement',array('fac_id'=>trim($_REQUEST['fac_id']),$order_by=''));

			

			

			foreach($facility_reward_achievment as $key=>$val){

				$facility_reward_achievment[$key]->folder_name="rewards";

				

			}
   // print_r($facility_reward_achievment);
   // die;
			

		// $facility_reward_achievment

				  $return_array = array(

				'cmd' => 'Achevement list',

				'status' =>'1',

				'response' =>$facility_reward_achievment,

				'response_messege' =>'Achevement list'

		  );

				  

			

			

			

		}	

	else{

	 $return_array = array(

				'cmd' => 'Achevement list',

				'status' =>'0',

				'response' =>'0',

				'response_messege' =>'parameter is missing'

		  );

	 

	 }

	 $output = json_encode($return_array);

	 echo trim($output);		 

	



	

}









///Master Batch Package List
public function master_batch_package_list(){
           
		   if(trim($_REQUEST['action']))
		   {
			   
					$package=$this->CommonMdl->getResultByCond('tbl_package',array('package_status'=>'active'),'package_id,package_name,package_duration,package_status',$order_by='');
					if($package)
					{
						$return_array = array(
						'cmd' => 'Package list',
						'status' =>'1',
						'response' =>$package,
						'response_messege' =>'Package list'
					);


					}
					else{
						   $return_array = array(
							'cmd' => 'Package list',
							'status' =>'0',
							'response' =>'0',
							'response_messege' =>'Package not list'
					  );
					}
			
		   }
           else{
			     $return_array = array(
							'cmd' => 'Package list',
							'status' =>'0',
							'response' =>'0',
							'response_messege' =>'Parameter Missing'
					  );
			   
		   }		   

   $output = json_encode($return_array);
	 echo trim($output);	
}

//Master Batch Slot List
public function master_batch_slot_type_list(){
           if(trim($_REQUEST['action']))
		   {
					$batch_slot_type=$this->CommonMdl->getResultByCond('tbl_batch_slot_type',array('batch_slot_type_status'=>'active'),'batch_slot_type_id,batch_slot_type,created_by,updated_by',$order_by='');
					if($batch_slot_type)
					{
						$return_array = array(
						'cmd' => 'Batch slot type',
						'status' =>'1',
						'response' =>$batch_slot_type,
						'response_messege' =>'Batch slot list'
					);


					}
					else{
					   $return_array = array(
						'cmd' => 'Batch slot list',
						'status' =>'0',
						'response' =>'0',
						'response_messege' =>'Batch slot not list'
					);
                    }
		   }
		   else{
			     $return_array = array(
						'cmd' => 'Batch slot list',
						'status' =>'0',
						'response' =>'0',
						'response_messege' =>'Parameter missing'
					);
			   
		   }

   $output = json_encode($return_array);
	 echo trim($output);	
}



public function add_edit_slot(){
if(isset($_REQUEST['fac_id']) && isset($_REQUEST['sport_id']) && isset($_REQUEST['batch_slot_type_id']) && isset($_REQUEST['start_date']) && isset($_REQUEST['end_date']) && isset($_REQUEST['start_time']) && isset($_REQUEST['end_time']) && isset($_REQUEST['is_kit_available']) && isset($_REQUEST['kit_price']) && isset($_REQUEST['max_participanets']) && isset($_REQUEST['court_type']) && isset($_REQUEST['court_description']) && isset($_REQUEST['slot_package_price']) ){
	  // echo $_REQUEST['court_type'];
	  // die();
	if(!isset($_REQUEST['batch_slot_id']))
	 {
		 $slotArr=array(
				'fac_id'=>trim($_REQUEST['fac_id']),
				'sport_id'=>trim($_REQUEST['sport_id']),
				'batch_slot_type_id'=>trim($_REQUEST['batch_slot_type_id']),
				'start_date'=>trim($_REQUEST['start_date']),
				'end_date'=>trim($_REQUEST['end_date']),
				'start_time'=>trim($_REQUEST['start_time']),
				'end_time'=>trim($_REQUEST['end_time']),
				'is_kit_available'=>trim($_REQUEST['is_kit_available']),
				'kit_price'=>trim($_REQUEST['kit_price']),
				'max_participanets'=>trim($_REQUEST['max_participanets']),

				'court_type'=>trim($_REQUEST['court_type']),
				'court_description'=>trim($_REQUEST['court_description']),
				// 'fac_batch_slot_status'=>trim($_REQUEST['fac_batch_slot_status']),
				'fac_batch_slot_status'=>'active',
				'create_on'=>date("Y-m-d H:i:s"),
				'update_on'=>date('Y-m-d H:i:s')
		  );
		  // print_r($slotArr);
		  // die();
		 
		  
		  

			$fac_slot_id = $this->CommonMdl->insertRow($slotArr,'tbl_facility_batch_slot');
			$fac_slot_get_data = $this->CommonMdl->getRow('tbl_facility_batch_slot','*',array('batch_slot_id'=>$fac_slot_id));
		    $slot_package_prices=($_REQUEST['slot_package_price']);
			
			
			
			$add_fac_slot_price=array(
			'batch_slot_id'=>$fac_slot_id,
			'slot_package_price'=>$slot_package_prices,
			'created_on'=>date("Y-m-d H:i:s"),
			);

			$get_slot_package=$this->CommonMdl->insertRow($add_fac_slot_price,'tbl_slot_package_price');
			$get_slot_data=$this->CommonMdl->getResultByCond('tbl_slot_package_price',array('slot_package_price_id'=>$get_slot_package),$order_by='');
			// print_r($get_slot_data);
			// die();
			
			//echo $this->db->last_query();
        
		   $weekoff=json_decode($_REQUEST['weekoffs']);
		   // print_r($weekoff);
		   // die();
		   foreach($weekoff as $weekoffs){
			   $add_weekoff_slot[]=array(
				   'batch_slot_id'=>$fac_slot_id,
				   'batch_slot_weekoff_day'=>$weekoffs->batch_slot_weekoff_day,
				   'weekoff_day_status'=>$weekoffs->weekoff_day_status,
				   'created_on'=>date("Y-m-d H:i:s"),
			       'updated_on'=>date('Y-m-d H:i:s')
			   );
			       
		   }
				$this->CommonMdl->deleteRecord('tbl_batch_slot_weekoff',array('batch_slot_id'=>$fac_slot_id));
				$this->CommonMdl->insertinBatch($add_weekoff_slot,'tbl_batch_slot_weekoff');
				$get_batch_slot_weekoff=$this->CommonMdl->getResultByCond('tbl_batch_slot_weekoff',array('batch_slot_id'=>$fac_slot_id),$order_by='');
				 
				  $fac_slot_get_data->pricing=$get_slot_data;
				  $fac_slot_get_data->weekoffs=$get_batch_slot_weekoff;
				  // print_r($fac_slot_get_data);
			      // die();
					 
					
				 
				 if($fac_slot_get_data){
					 // print_r($fac_slot_get_data);
					  // die();
					 
						$result_array = array(
						'cmd'=>'Create slot',
						'status'=>'1',
						'response'=>$fac_slot_get_data,
						'response_messege'=>'Slot insert sucesfully'
						);
					}
				
		
	 
	 }
	else{
	$slotArrupdate=array(
			'fac_id'=>trim($_REQUEST['fac_id']),
			'sport_id'=>trim($_REQUEST['sport_id']),
			'batch_slot_type_id'=>trim($_REQUEST['batch_slot_type_id']),
			'start_date'=>trim($_REQUEST['start_date']),
			'end_date'=>trim($_REQUEST['end_date']),
			'start_time'=>trim($_REQUEST['start_time']),
			'end_time'=>trim($_REQUEST['end_time']),
			'is_kit_available'=>trim($_REQUEST['is_kit_available']),
			'kit_price'=>trim($_REQUEST['kit_price']),
			'max_participanets'=>trim($_REQUEST['max_participanets']),
			'court_type'=>trim($_REQUEST['court_type']),
			'court_description'=>trim($_REQUEST['court_description']),
			// 'fac_batch_slot_status'=>trim($_REQUEST['fac_batch_slot_status']),
			'fac_batch_slot_status'=>'active',
			'create_on'=>date("Y-m-d H:i:s"),
			'update_on'=>date('Y-m-d H:i:s')
	  );
	  
	$result=$this->CommonMdl->updateData($slotArrupdate,array('batch_slot_id'=>$_REQUEST['batch_slot_id']),'tbl_facility_batch_slot');

	$get_slot_data=$this->CommonMdl->getRow('tbl_facility_batch_slot','*',array('batch_slot_id'=>$_REQUEST['batch_slot_id']));


	$edit_fac_slot_price=array(
		'batch_slot_id'=>$_REQUEST['batch_slot_id'],
		'slot_package_price'=>$_REQUEST['slot_package_price'],
		'created_on'=>date("Y-m-d H:i:s"),
	);

		 
	$this->CommonMdl->deleteRecord('tbl_slot_package_price',array('batch_slot_id'=>$_REQUEST['batch_slot_id']));
	$get_slot_package=$this->CommonMdl->insertRow($edit_fac_slot_price,'tbl_slot_package_price');
	$Slot_package_price=$this->CommonMdl->getResultByCond('tbl_slot_package_price',array('batch_slot_id'=>$_REQUEST['batch_slot_id']),$order_by='');
		
		// print_r($Slot_package_price);
		// die();
		
		
	$weekoff=json_decode($_REQUEST['weekoffs']);
	foreach($weekoff as $weekoffs){
			   $add_weekoff_slot[]=array(
				   'batch_slot_id'=>$_REQUEST['batch_slot_id'],
				   'batch_slot_weekoff_day'=>$weekoffs->batch_slot_weekoff_day,
				   'weekoff_day_status'=>$weekoffs->weekoff_day_status,
				   'created_on'=>date("Y-m-d H:i:s"),
				   'updated_on'=>date('Y-m-d H:i:s')
			   );
		
	 }
	 $this->CommonMdl->deleteRecord('tbl_batch_slot_weekoff',array('batch_slot_id'=>$_REQUEST['batch_slot_id']));
		$this->CommonMdl->insertinBatch($add_weekoff_slot,'tbl_batch_slot_weekoff');
	 $get_batch_slot_weekoff=$this->CommonMdl->getResultByCond('tbl_batch_slot_weekoff',array('batch_slot_id'=>$_REQUEST['batch_slot_id']),$order_by='');
       
		$get_slot_data->pricing=$Slot_package_price;
		$get_slot_data->weekoffs=$get_batch_slot_weekoff;
       
	   $result_array = array(
						'cmd'=>'update slot',
						'status'=>'1',
						'response'=>$get_slot_data,
						'response_messege'=>'Slot update sucesfully'
						);
				
	}
	  
}
else{
   $result_array = array(
      'cmd'=>'slot delails',
	  'status'=>'0',
	  'response'=>'0',
	  'response_messege'=>'Parameter is missing'
   );
	
}
$output = json_encode($result_array);

	echo trim($output,'"');
}   




public function add_edit_batch(){
	
	if(isset($_REQUEST['fac_id']) && isset($_REQUEST['sport_id']) && isset($_REQUEST['start_date']) && isset($_REQUEST['end_date']) && isset($_REQUEST['start_time']) && isset($_REQUEST['end_time']) && isset($_REQUEST['max_participanets']) && isset($_REQUEST['is_trial']) ){
		
		 if(!isset($_REQUEST['batch_slot_id']))
		 {
					$slotArr=array(
						'fac_id'=>trim($_REQUEST['fac_id']),
						'sport_id'=>trim($_REQUEST['sport_id']),
						'batch_slot_type_id'=>trim($_REQUEST['batch_slot_type_id']),
						'start_date'=>trim($_REQUEST['start_date']),
						'end_date'=>trim($_REQUEST['end_date']),
						'start_time'=>trim($_REQUEST['start_time']),
						'end_time'=>trim($_REQUEST['end_time']),
						'max_participanets'=>trim($_REQUEST['max_participanets']),
						'is_trial'=>trim($_REQUEST['is_trial'])
					);

					//print_r($slotArr);
					// die();

					$fac_slot_id = $this->CommonMdl->insertRow($slotArr,'tbl_facility_batch_slot');
					$fac_slot_get_data = $this->CommonMdl->getRow('tbl_facility_batch_slot','*',array('batch_slot_id'=>$fac_slot_id));
					// print_r($fac_slot_get_data);
					// die();
					$slot_package_prices=json_decode(($_REQUEST['pricing']));
					// print_r($slot_package_prices);
					// die;
				   foreach($slot_package_prices as $price){
               
					$slot_package_priceArr[]=array(
						'batch_slot_id'=>$fac_slot_id,
						'slot_package_price'=>$price->slot_package_price,
						'package_id'=>$price->package_id,
						'created_on'=>date("y-m-d H:i:s")
					);
				   
					
				   }
				   // print_r($slot_package_priceArr);
					 // die();
				  
					
					
					 // return false;

						$this->CommonMdl->deleteRecord('tbl_slot_package_price',array('batch_slot_id'=>$fac_slot_id));
						$this->CommonMdl->insertinBatch($slot_package_priceArr,'tbl_slot_package_price');
						// $get_slot_package=$this->CommonMdl->insertRow($slot_package_priceArr,'tbl_slot_package_price');
					

					$Slot_package_price=$this->CommonMdl->getResultByCond('tbl_slot_package_price',array('batch_slot_id'=>$fac_slot_id),$order_by='');



					$weekoff=json_decode($_REQUEST['weekoffs']);
					foreach($weekoff as $weekoffs){
					$add_weekoff_slot[]=array(
						   'batch_slot_id'=>$fac_slot_id,
						   'batch_slot_weekoff_day'=>$weekoffs->batch_slot_weekoff_day,
						   'weekoff_day_status'=>$weekoffs->weekoff_day_status,
						   'created_on'=>date("Y-m-d H:i:s"),
						   'updated_on'=>date('Y-m-d H:i:s')
					);

					}
					$this->CommonMdl->deleteRecord('tbl_batch_slot_weekoff',array('batch_slot_id'=>$fac_slot_id));
					$this->CommonMdl->insertinBatch($add_weekoff_slot,'tbl_batch_slot_weekoff');
					$get_batch_slot_weekoff=$this->CommonMdl->getResultByCond('tbl_batch_slot_weekoff',array('batch_slot_id'=>$fac_slot_id),$order_by='');

					$fac_slot_get_data->pricing=$Slot_package_price;
					$fac_slot_get_data->weekoffs=$get_batch_slot_weekoff;			
					$result_array = array(
						'cmd'=>'Batch slot delails',
						'status'=>'1',
						'response'=>$fac_slot_get_data,
						'response_messege'=>'Batch slot insert sucesfully'
					);
				  
			
	 
		 }
		 else{
			   $slotArr_update=array(
						'fac_id'=>trim($_REQUEST['fac_id']),
						'sport_id'=>trim($_REQUEST['sport_id']),
						'batch_slot_type_id'=>trim($_REQUEST['batch_slot_type_id']),
						'start_date'=>trim($_REQUEST['start_date']),
						'end_date'=>trim($_REQUEST['end_date']),
						'start_time'=>trim($_REQUEST['start_time']),
						'end_time'=>trim($_REQUEST['end_time']),
						'max_participanets'=>trim($_REQUEST['max_participanets']),
						'is_trial'=>trim($_REQUEST['is_trial'])
					);
 
				   $this->CommonMdl->updateData($slotArr_update,array('batch_slot_id'=>$_REQUEST['batch_slot_id']),'tbl_facility_batch_slot');
				  
				   $fac_slot_get_data = $this->CommonMdl->getRow('tbl_facility_batch_slot','*',array('batch_slot_id'=>trim($_REQUEST['batch_slot_id'])));
					
					$slot_package_prices=json_decode(($_REQUEST['pricing']));
				   foreach($slot_package_prices as $price){

					$slot_package_priceArr=array(
						'batch_slot_id'=>trim($_REQUEST['batch_slot_id']),
						'slot_package_price'=>$price->slot_package_price,
						'slot_package_price'=>$price->slot_package_price,
						'created_on'=>date("y-m-d H:i:s")
					);
					// print_r($slot_package_priceArr);
					// die();

						$this->CommonMdl->deleteRecord('tbl_slot_package_price',array('batch_slot_id'=>trim($_REQUEST['batch_slot_id'])));
						$get_slot_package=$this->CommonMdl->insertRow($slot_package_priceArr,'tbl_slot_package_price');
					

					$Slot_package_price=$this->CommonMdl->getResultByCond('tbl_slot_package_price',array('batch_slot_id'=>trim($_REQUEST['batch_slot_id'])),$order_by='');

					 // print_r($Slot_package_price);
					  // die(); 
				   }
					$weekoff=json_decode($_REQUEST['weekoffs']);
					foreach($weekoff as $weekoffs){
					$add_weekoff_slot[]=array(
						   'batch_slot_id'=>trim($_REQUEST['batch_slot_id']),
						   'batch_slot_weekoff_day'=>$weekoffs->batch_slot_weekoff_day,
						   'weekoff_day_status'=>$weekoffs->weekoff_day_status,
						   'created_on'=>date("Y-m-d H:i:s"),
						   'updated_on'=>date('Y-m-d H:i:s')
					);

					}
					$this->CommonMdl->deleteRecord('tbl_batch_slot_weekoff',array('batch_slot_id'=>trim($_REQUEST['batch_slot_id'])));
					$this->CommonMdl->insertinBatch($add_weekoff_slot,'tbl_batch_slot_weekoff');
					$get_batch_slot_weekoff=$this->CommonMdl->getResultByCond('tbl_batch_slot_weekoff',array('batch_slot_id'=>trim($_REQUEST['batch_slot_id'])),$order_by='');

					$fac_slot_get_data->pricing=$Slot_package_price;
					$fac_slot_get_data->weekoffs=$get_batch_slot_weekoff;			
					$result_array = array(
						'cmd'=>'Batch slot delails',
						'status'=>'1',
						'response'=>$fac_slot_get_data,
						'response_messege'=>'Batch slot update sucesfully'
					);
			}
		
	 }
	else{
		$result_array = array(
			'cmd'=>'slot delails',
			'status'=>'0',
			'response'=>'0',
			'response_messege'=>'Parameter is missing'
		);
	}
	
$output = json_encode($result_array);
   echo trim($output,'"');
}






function batch_slot_listing(){
$offset='0';
$limit='8';
$page='0';
$itemsPerPage='5';	  
if($_REQUEST['fac_id']){
	
	
		$fac_id = '';
		$sport_id = '';
		$fac_id  = trim($_REQUEST['fac_id']);
		$sport_id  = trim(@$_REQUEST['sport_id']);
        
		 if(isset($_REQUEST['page']) && $_REQUEST['page']!=''){
			
			if(isset($_REQUEST['start_date']) || isset($_REQUEST['end_date']) || isset($_REQUEST['fac_id']) || isset($_REQUEST['sport_id']))
			{
				 $start_date='';
				$end_date='';
				$offset=$_REQUEST['page']*8;
				$start_date=$_REQUEST['start_date'];
				$end_date=$_REQUEST['end_date'];
				
				          
			$get_Result=$this->ApiMdl->getFac_batch_slot_list($fac_id,$sport_id,$start_date,$end_date,$limit,$offset);
			// echo $this->db->last_query();
			// die;
			
			
			// echo $this->db->last_query();
			//print_r($get_Result);
			//	 die;
				foreach($get_Result as $key=>$val)
				{
						 $batch_slot_id = $val->batch_slot_id;
						$tbl_batch_slot_weekoff_list=$this->CommonMdl->getResultByCond('tbl_batch_slot_weekoff',array('batch_slot_id'=>$batch_slot_id),$order_by='');
						$tbl_slot_package_price=$this->CommonMdl->getResultByCond(' tbl_slot_package_price',array('batch_slot_id'=>$batch_slot_id),$order_by='');
						$get_Result[$key]->pricing=$tbl_slot_package_price;
						$get_Result[$key]->weekoffs=$tbl_batch_slot_weekoff_list;

				}

				$return_array = array(
				'cmd' => 'Batch slot listing',
				'status' =>'1',
				'response' =>$get_Result,
				'response_messege' =>'Batch slot listing'
				);
			}
		 }
		 else{
			 $return_array = array(
				'cmd' => 'Batch Slot listing',
				'status' => '0',
				'response' => '0',
				'response_messege' => 'Page missing'
            ); 
			 
		 }
		
	   
}
	else
	{
			$return_array = array(
			'cmd' => 'Batch list',
			'status' =>'0',
			'response' =>'0',
			'response_messege' =>'parameter is missing'
			);
}
	$output = json_encode($return_array);
	echo trim($output,'"');

	
}




// Add Edit Facility Gallery


public function add_edit_facility_gallery(){
	
	   if(@trim($_REQUEST['fac_id']))
	   {
		   if(!isset($_REQUEST['gallery_id']))
		   {
						// echo $_FILES['gallery_image']['name'];
							$path ="assets/public/images/gallery";

							$this->upload->initialize($this->set_upload_options($path));
							if($this->upload->do_upload('gallery_image'))
							{
							$gallery_imag['gallery_image']=$this->upload->data();

							}
							$gallery_image=$gallery_imag['gallery_image']['file_name'];
							$image_array_gallery=array(
								'fac_id'=>trim($_REQUEST['fac_id']),
								'gallery_image'=>$gallery_image,
								'created_on' =>date("Y-m-d H:i:s"),
								'updated_on' =>date("Y-m-d H:i:s")
							);

					  
							$gallery_id=$this->CommonMdl->insertRow($image_array_gallery,'tbl_facility_gallery');
							$get_tbl_facility_gallery=$this->CommonMdl->getRow('tbl_facility_gallery','*',array('gallery_id'=>trim($gallery_id)));
						  $get_tbl_facility_gallery->folder_name="gallery";
						
							
							if($get_tbl_facility_gallery){
								 $return_array = array(
									'cmd' => 'facilit gallery list',
									'status' =>'1',
									'response' =>$get_tbl_facility_gallery,
									'response_messege' =>'facility_gallery insert sucesfully'
								);
							}
						
		   }
           else{
			    $this->CommonMdl->deleteRecord('tbl_facility_gallery',array('gallery_id'=>$_REQUEST['gallery_id'],'fac_id'=>$_REQUEST['fac_id']));
				 // echo $this->db->last_query();
			    // die;
			    
			    $get_result=array('tag'=>'facility gallery delete sucesfully');
				$return_array = array(
					'cmd' => 'facilit gallery delete',
					'status' =>'1',
					'response' =>$get_result,
					'response_messege' =>'facility gallery delete sucesfully'
				   );
							
									
			   }		   
			  
		}
		else
		{
			$return_array = array(
			'cmd' => 'facilit gallery list',
			'status' =>'0',
			'response' =>'0',
			'response_messege' =>'parameter is missing'
			);
		}
		$output = json_encode($return_array);
		echo trim($output,'"');
	   
	   
	   
		 
	 }
	 
	 
// Gallery Listing

public function gallery_listing(){
	 if(trim(@$_REQUEST['fac_id']))
	 {
		  $get_facility_listing=$this->CommonMdl->getResultByCond('tbl_facility_gallery',array('fac_id'=>trim($_REQUEST['fac_id'])),'*',$order_by='');
		  
		  foreach($get_facility_listing as $key=>$val){
			  $get_facility_listing[$key]->folder_name="gallery";
		  }

		  
		  $return_array = array(
					'cmd' => 'facilit gallery list',
					'status' =>'1',
					'response' =>$get_facility_listing,
					'response_messege' =>'facilit gallery listing'
		);
	 
	 
	 
	 
	 
	 }
	else
	{
		$return_array = array(
		'cmd' => 'facilit gallery list',
		'status' =>'0',
		'response' =>'0',
		'response_messege' =>'parameter is missing'
		);
	}
	$output = json_encode($return_array);
	echo trim($output,'"');
 
	 
}




	  private function set_upload_options4($path){ 

    $config = array();

        $config['upload_path'] = "./$path/"; //give the path to upload the image in folder

        $config['allowed_types'] = '*';

        $config['max_size'] = '0';

        $config['overwrite'] = FALSE;

        return $config;

    }
	
	
	  private function set_upload_options10($path){ 

    $config = array();

        $config['upload_path'] = "./$path/"; //give the path to upload the image in folder

        $config['allowed_types'] = '*';

        $config['max_size'] = '0';

        $config['overwrite'] = FALSE;

        return $config;

    }
	
	
	
	  private function set_upload_options6($path){ 

    $config = array();

        $config['upload_path'] = "./$path/"; //give the path to upload the image in folder

        $config['allowed_types'] = '*';

        $config['max_size'] = '0';

        $config['overwrite'] = FALSE;

        return $config;

    }
	
	
	  private function set_upload_options7($path){ 

    $config = array();

        $config['upload_path'] = "./$path/"; //give the path to upload the image in folder

        $config['allowed_types'] = '*';

        $config['max_size'] = '0';

        $config['overwrite'] = FALSE;

        return $config;

    }
	
	  private function set_upload_options8($path){ 

    $config = array();

        $config['upload_path'] = "./$path/"; //give the path to upload the image in folder

        $config['allowed_types'] = '*';

        $config['max_size'] = '0';

        $config['overwrite'] = FALSE;

        return $config;

    }

//Add edit event
function add_edit_event(){

	 
	if(@trim(@$_REQUEST['fac_id']) && trim(@$_REQUEST['sport_id']) && trim(@$_REQUEST['event_name']) && trim(@$_REQUEST['event_description']) && trim(@$_REQUEST['event_price']) && trim(@$_REQUEST['event_start_date']) && trim(@$_REQUEST['event_end_date']) && trim(@$_REQUEST['event_start_time']) && trim(@$_REQUEST['event_end_time']) && trim(@$_REQUEST['event_max_capicity_per_day']) && trim(@$_REQUEST['event_venue']) && trim(@$_REQUEST['event_city']) && trim(@$_REQUEST['event_contact_person']) && trim(@$_REQUEST['event_contact_person_email']) && trim(@$_REQUEST['event_contact_person_no']) && trim(@$_REQUEST['application_start_date']) && trim(@$_REQUEST['application_end_date']) && trim(@$_REQUEST['event_eligibility']) ){
		
				// print_r($_REQUEST);
				// die();
			   if(!isset($_REQUEST['event_id']))
			   {
						$event_banner=$_FILES['event_banner']['name'];
						// print_r($event_banner);
						// die();
						$path = "assets/public/images/event";
						$this->upload->initialize($this->set_upload_options($path));
						if($this->upload->do_upload('event_banner'))
						{
						$event_banners['event_banner']= $this->upload->data();



						}
						$banner_image=$event_banners['event_banner']['file_name'];


						$event_array=array(
						'fac_id'=>trim($_REQUEST['fac_id']),
						'sport_id'=>trim($_REQUEST['sport_id']),
						'event_name'=>trim($_REQUEST['event_name']),
						'event_description'=>trim($_REQUEST['event_description']),
						'event_price'=>trim($_REQUEST['event_price']),
						'event_start_date'=>trim($_REQUEST['event_start_date']),
						'event_end_date'=>trim($_REQUEST['event_end_date']),
						'event_start_time'=>trim($_REQUEST['event_start_time']),
						'event_end_time'=>trim($_REQUEST['event_end_time']),
						'event_max_capicity_per_day'=>trim($_REQUEST['event_max_capicity_per_day']),
						'event_venue'=>trim($_REQUEST['event_venue']),
						'event_city'=>trim($_REQUEST['event_city']),
						'event_contact_person'=>trim($_REQUEST['event_contact_person']),
						'event_contact_person_email'=>trim($_REQUEST['event_contact_person_email']),
						'event_contact_person_no'=>trim($_REQUEST['event_contact_person_no']),
						'event_banner'=>trim($banner_image),
						'application_start_date'=>trim($_REQUEST['application_start_date']),
						'application_end_date'=>trim($_REQUEST['application_end_date']),
						'event_eligibility'=>trim($_REQUEST['event_eligibility']),
						'created_on' =>date("Y-m-d H:i:s"),
						'updated_on' =>date("Y-m-d H:i:s")

						);
						
						$last_event_insert_id = $this->CommonMdl->insertRow($event_array,'tbl_event');
						$get_result_event=$this->CommonMdl->getRow('tbl_event','*',array('event_id'=>trim($last_event_insert_id)));
						 // print_r($get_result_event);
						 // die();
						$event_amenity_data=json_decode($_REQUEST['event_amenity']);
						 // print_r(json_encode($event_amenity_data));
						 // die;
						foreach($event_amenity_data as $event_amenity){
							$data_amenity_Arr[]=array(
								'amenity_id' => $event_amenity->amenity_id,
								'event_id' => trim($last_event_insert_id),
								'created_on' =>date("Y-m-d H:i:s"),
								'updated_on' =>date("Y-m-d H:i:s")
						 );
						}
						
						$this->CommonMdl->insertinbatch($data_amenity_Arr,'tbl_event_amenities');
						$get_event_amenities=$this->CommonMdl->getResultByCond('tbl_event_amenities',array('event_id'=>trim($last_event_insert_id)),'*',$order_by='');
						
						
							
										$image1_name='';
										if(isset($_FILES['image_1']) && $_FILES['image_1']!='')
										{
													$image_1=$_FILES['image_1'];
													$path = "assets/public/images/event";
													$this->upload->initialize($this->set_upload_options($path));

													if($this->upload->do_upload('image_1')){

													  $image1_array= $this->upload->data();

													  $image1_name = $image1_array['file_name'];

													}
													
										}
										
										// echo $image1_name;
										// die;
										$image2_name='';
										if(isset($_FILES['image_2']) && $_FILES['image_2']['name'])
										{
													$image_2=$_FILES['image_2'];
													$path = "assets/public/images/event";
													$this->upload->initialize($this->set_upload_options2($path));

													if($this->upload->do_upload('image_2')){

													  $image2_array=$this->upload->data();

													  $image2_name = $image2_array['file_name'];

													}
													
										}
										
										// echo $image2_name;
										// die;
										
										
										
										 $image3_name='';
										if(isset($_FILES['image_3']) && $_FILES['image_3']['name'])
										{
													$image_3=$_FILES['image_3'];
													$path = "assets/public/images/event";
													$this->upload->initialize($this->set_upload_options3($path));

													if($this->upload->do_upload('image_3')){

													  $image3_array= $this->upload->data();
													  // print_r($image3_array);
													  // die;

													  $image3_name = $image3_array['file_name'];
													  // echo $image3_name;
													  // die;
													}
												
											}
											
											// echo $image3_name;
											// die;
											
											$image4_name='';

											if(isset($_FILES['image_4']) && $_FILES['image_4']['name'])
										{
													$image_4=$_FILES['image_4'];
													$path = "assets/public/images/event";
													$this->upload->initialize($this->set_upload_options10($path));

													if($this->upload->do_upload('image_4')){

													  $image4_array= $this->upload->data();
													  // print_r($image3_array);
													  // die;

													  $image4_name = $image4_array['file_name'];
													  // echo $image3_name;
													  // die;
													}
													
											}
											
											// echo $image4_name;
											 // die;
											
										 $image5_name='';
										if(isset($_FILES['image_5']) && $_FILES['image_5']['name'])
										{
													$image_5=$_FILES['image_5'];
													$path = "assets/public/images/event";
													$this->upload->initialize($this->set_upload_options5($path));

													if($this->upload->do_upload('image_5')){

													  $image5_array= $this->upload->data();

													  $image5_name = $image5_array['file_name'];

													}
													
										}
										
										// echo $image5_name;
										// die;
                                         $image6_name='';
										if(isset($_FILES['image_6']) && $_FILES['image_6']['name'])
										{
													$image_6=$_FILES['image_6'];
													$path = "assets/public/images/event";
													$this->upload->initialize($this->set_upload_options6($path));

													if($this->upload->do_upload('image_6')){

													  $image6_array= $this->upload->data();

													  $image6_name = $image6_array['file_name'];

													}
													
										}
										

										if(isset($_FILES['image_7']) && $_FILES['image_7']['name'])
										{
													$image_7=$_FILES['image_7'];
													$path = "assets/public/images/event";
													$this->upload->initialize($this->set_upload_options7($path));

													if($this->upload->do_upload('image_7')){

													  $image7_array= $this->upload->data();

													  $image7_name = $image7_array['file_name'];

													}
													
										}
										
										// echo $image7_name;
										// die;
                                        $image8_name='';
										
										if(isset($_FILES['image_8']) && $_FILES['image_8']['name'])
										{
													$image_8=$_FILES['image_8'];
													$path = "assets/public/images/event";
													$this->upload->initialize($this->set_upload_options8($path));

													if($this->upload->do_upload('image_8')){

													  $image8_array= $this->upload->data();

													  $image8_name = $image8_array['file_name'];

													}
													
										}
									
				                 if($image1_name!=''){
										$get_gallery_event=array(
											'event_id'=>$last_event_insert_id,
											'image'=>$image1_name,
											'create_on' => date("Y-m-d H:i:s"),
                                            'update_on' => date("Y-m-d H:i:s")
										);
										$this->CommonMdl->insertRow($get_gallery_event,'tbl_event_gallery');
									}
									if($image2_name!=''){
										$get_gallery_event=array(
											'event_id'=>$last_event_insert_id,
											'image'=>$image2_name,
											'create_on' => date("Y-m-d H:i:s"),
                                            'update_on' => date("Y-m-d H:i:s")
										);
										$this->CommonMdl->insertRow($get_gallery_event,'tbl_event_gallery');
									}
									if($image3_name!=''){
										$get_gallery_event=array(
											'event_id'=>$last_event_insert_id,
											'image'=>$image3_name,
											'create_on' => date("Y-m-d H:i:s"),
                                            'update_on' => date("Y-m-d H:i:s")
										);
										$this->CommonMdl->insertRow($get_gallery_event,'tbl_event_gallery');
									}
									if($image4_name!=''){
										$get_gallery_event=array(
											'event_id'=>$last_event_insert_id,
											'image'=>$image4_name,
											'create_on' => date("Y-m-d H:i:s"),
                                            'update_on' => date("Y-m-d H:i:s")
										);
										$this->CommonMdl->insertRow($get_gallery_event,'tbl_event_gallery');
									}

									if($image5_name!=''){
										$get_gallery_event=array(
											'event_id'=>$last_event_insert_id,
											'image'=>$image5_name,
											'create_on' => date("Y-m-d H:i:s"),
                                            'update_on' => date("Y-m-d H:i:s")
										);
										$this->CommonMdl->insertRow($get_gallery_event,'tbl_event_gallery');
									}

									if($image6_name!=''){
										$get_gallery_event=array(
											'event_id'=>$last_event_insert_id,
											'image'=>$image6_name,
											'create_on' => date("Y-m-d H:i:s"),
                                            'update_on' => date("Y-m-d H:i:s")
										);
										$this->CommonMdl->insertRow($get_gallery_event,'tbl_event_gallery');
									}
									if($image7_name!=''){
										$get_gallery_event=array(
											'event_id'=>$last_event_insert_id,
											'image'=>$image7_name,
											'create_on' => date("Y-m-d H:i:s"),
                                            'update_on' => date("Y-m-d H:i:s")
										);
										$this->CommonMdl->insertRow($get_gallery_event,'tbl_event_gallery');
									}

									if($image8_name!=''){
										$get_gallery_event=array(
											'event_id'=>$last_event_insert_id,
											'image'=>$image8_name,
											'create_on' => date("Y-m-d H:i:s"),
                                            'update_on' => date("Y-m-d H:i:s") 
										);
										$this->CommonMdl->insertRow($get_gallery_event,'tbl_event_gallery');
									}
									// echo $this->db->last_query();
									// die;
									$get_gallery_events=$this->CommonMdl->getRow('tbl_event_gallery','*',array('event_id'=>trim($last_event_insert_id)));
								       // print_r(json_encode($get_gallery_event));
									  // die;
									$get_result_event->folder_name="event";
									$get_result_event->event_amenity=$get_event_amenities;
									$get_result_event->event_gallery=$get_gallery_events;
									
									$return_array = array(
											'cmd' => 'event list',
											'status' =>'1',
											'response' =>$get_result_event,
											'response_messege' =>'event insert sucesfully'
										  );
		
		
				}
			   else{
				   
					   $edit_array=array(
									'fac_id'=>trim($_REQUEST['fac_id']),
									'sport_id'=>trim($_REQUEST['sport_id']),
									'event_name'=>trim($_REQUEST['event_name']),
									'event_description'=>trim($_REQUEST['event_description']),
									'event_price'=>trim($_REQUEST['event_price']),
									'event_start_date'=>trim($_REQUEST['event_start_date']),
									'event_end_date'=>trim($_REQUEST['event_end_date']),
									'event_start_time'=>trim($_REQUEST['event_start_time']),
									'event_end_time'=>trim($_REQUEST['event_end_time']),
									'event_max_capicity_per_day'=>trim($_REQUEST['event_max_capicity_per_day']),
									'event_venue'=>trim($_REQUEST['event_venue']),
									'event_city'=>trim($_REQUEST['event_city']),
									'event_contact_person'=>trim($_REQUEST['event_contact_person']),
									'event_contact_person_email'=>trim($_REQUEST['event_contact_person_email']),
									'event_contact_person_no'=>trim($_REQUEST['event_contact_person_no']),
									'event_banner'=>trim($banner_image),
									'application_start_date'=>trim($_REQUEST['application_start_date']),
									'application_end_date'=>trim($_REQUEST['application_end_date']),
									'event_eligibility'=>trim($_REQUEST['event_eligibility']),

							);
						
                    	
						
						
						$this->CommonMdl->updateData($edit_array,array('event_id'=>$_REQUEST['event_id']),'tbl_event');
						$get_result_event=$this->CommonMdl->getResultByCond('tbl_event',array('event_id'=>trim($_REQUEST['event_id'])),'*',$order_by='');
						 
						 
						 
						$event_amenity_data=json_decode($_REQUEST['event_amenity']);
						
						// print_r(json_encode($event_amenity_data));
						// die;
						foreach($event_amenity_data as $event_amenity){
						$data_amenity_Arr[]=array(
						'amenity_id' => $event_amenity->amenity_id,
						'event_id' => trim($_REQUEST['event_id']),
						'created_on' =>date("Y-m-d H:i:s"),
						'updated_on' =>date("Y-m-d H:i:s")
						);
						}
                        
						$this->CommonMdl->deleteRecord('tbl_event_amenities',array('event_id'=>trim($_REQUEST['event_id'])));
 						$this->CommonMdl->insertinbatch($data_amenity_Arr,'tbl_event_amenities');
						$get_event_amenities=$this->CommonMdl->getResultByCond('tbl_event_amenities',array('event_id'=>trim($_REQUEST['event_id'])),'*',$order_by='');
						
						
						$get_event=$this->CommonMdl->getResultByCond('tbl_event_gallery',array('event_id'=>trim($_REQUEST['event_id'])),'*',$order_by='');
						
						  // $get_gallery_events=$this->CommonMdl->getResultByCond('tbl_event_gallery',array('event_id'=>trim($_REQUEST['event_id'])),'image',$order_by='');
						 // $get=$get_gallery_events['image'];
						 // print_r($get_gallery_events);
						 // die;
						 // foreach($get_gallery_events as $old_image){
							     // $old=$old_image->image;
								 
							// echo $old;
							
						 // }
						 
						
						$delete_gallery_image=json_decode($_REQUEST['delete_gallery']);
						// echo $delete_gallery_image[0];
						
						// echo '<pre>'; 
						for($i=0;$i<count($delete_gallery_image);$i++){
							$delete_gallery_image[$i];
							$this->CommonMdl->deleteRecord('tbl_event_gallery',array('event_id'=>$_REQUEST['event_id'],'image'=>$delete_gallery_image[$i]));
							// echo $this->db->last_query();
							// die;
							
						}
						
						
						 
						  
						
										$image1_name='';
										if(isset($_FILES['image_1']) && $_FILES['image_1']!='')
										{
													$image_1=$_FILES['image_1'];
													$path = "assets/public/images/event";
													$this->upload->initialize($this->set_upload_options($path));

													if($this->upload->do_upload('image_1')){

													  $image1_array= $this->upload->data();

													  $image1_name = $image1_array['file_name'];

													}
													
													
										}
										
										
										// echo $image1_name;
										// die;
										$image2_name='';
										if(isset($_FILES['image_2']) && $_FILES['image_2']['name'])
										{
													$image_2=$_FILES['image_2'];
													$path = "assets/public/images/event";
													$this->upload->initialize($this->set_upload_options2($path));

													if($this->upload->do_upload('image_2')){

													  $image2_array=$this->upload->data();

													  $image2_name = $image2_array['file_name'];

													}
													
													
										}
										
										
										// echo $image2_name;
										// die;
										
										
										
										 $image3_name='';
										if(isset($_FILES['image_3']) && $_FILES['image_3']['name'])
										{
													$image_3=$_FILES['image_3'];
													$path = "assets/public/images/event";
													$this->upload->initialize($this->set_upload_options3($path));

													if($this->upload->do_upload('image_3')){

													  $image3_array= $this->upload->data();
													  // print_r($image3_array);
													  // die;

													  $image3_name = $image3_array['file_name'];
													  // echo $image3_name;
													  // die;
													}
												
												
											}
											
											
											// echo $image3_name;
											// die;
											
										$image4_name='';

											if(isset($_FILES['image_4']) && $_FILES['image_4']['name'])
										{
													$image_4=$_FILES['image_4'];
													$path = "assets/public/images/event";
													$this->upload->initialize($this->set_upload_options10($path));

													if($this->upload->do_upload('image_4')){

													  $image4_array= $this->upload->data();
													  // print_r($image3_array);
													  // die;

													  $image4_name = $image4_array['file_name'];
													  // echo $image3_name;
													  // die;
													}
													
													
											}
											
											// echo $image4_name;
											 // die;
											
										 $image5_name='';
										if(isset($_FILES['image_5']) && $_FILES['image_5']['name'])
										{
													$image_5=$_FILES['image_5'];
													$path = "assets/public/images/event";
													$this->upload->initialize($this->set_upload_options5($path));

													if($this->upload->do_upload('image_5')){

													  $image5_array= $this->upload->data();

													  $image5_name = $image5_array['file_name'];

													}
													
													
										}
										
										
										// echo $image5_name;
										// die;
                                         $image6_name='';
										if(isset($_FILES['image_6']) && $_FILES['image_6']['name'])
										{
													$image_6=$_FILES['image_6'];
													$path = "assets/public/images/event";
													$this->upload->initialize($this->set_upload_options6($path));

													if($this->upload->do_upload('image_6')){

													  $image6_array= $this->upload->data();

													  $image6_name = $image6_array['file_name'];

													}
													
													
										}
										
										
                                           $image7_name='';
										if(isset($_FILES['image_7']) && $_FILES['image_7']['name'])
										{
													$image_7=$_FILES['image_7'];
													$path = "assets/public/images/event";
													$this->upload->initialize($this->set_upload_options7($path));

													if($this->upload->do_upload('image_7')){

													  $image7_array= $this->upload->data();

													  $image7_name = $image7_array['file_name'];

													}
													
													
										}
										
										
										// echo $image7_name;
										// die;
                                        $image8_name='';
										
										if(isset($_FILES['image_8']) && $_FILES['image_8']['name'])
										{
													$image_8=$_FILES['image_8'];
													$path = "assets/public/images/event";
													$this->upload->initialize($this->set_upload_options8($path));

													if($this->upload->do_upload('image_8')){

													  $image8_array= $this->upload->data();

													  $image8_name = $image8_array['file_name'];

													}
													
													
										}
										if($image1_name!=''){
										$get_gallery_event=array(
											'event_id'=>trim($_REQUEST['event_id']),
											'image'=>$image1_name,
											'create_on' => date("Y-m-d H:i:s"),
                                            'update_on' => date("Y-m-d H:i:s")
										);
										$this->CommonMdl->insertRow($get_gallery_event,'tbl_event_gallery');
									}
									if($image2_name!=''){
										$get_gallery_event=array(
											'event_id'=>trim($_REQUEST['event_id']),
											'image'=>$image2_name,
											'create_on' => date("Y-m-d H:i:s"),
                                            'update_on' => date("Y-m-d H:i:s")
										);
										$this->CommonMdl->insertRow($get_gallery_event,'tbl_event_gallery');
									}
									if($image3_name!=''){
										$get_gallery_event=array(
											'event_id'=>trim($_REQUEST['event_id']),
											'image'=>$image3_name,
											'create_on' => date("Y-m-d H:i:s"),
                                            'update_on' => date("Y-m-d H:i:s")
										);
										$this->CommonMdl->insertRow($get_gallery_event,'tbl_event_gallery');
									}
									if($image4_name!=''){
										$get_gallery_event=array(
											'event_id'=>trim($_REQUEST['event_id']),
											'image'=>$image4_name,
											'create_on' => date("Y-m-d H:i:s"),
                                            'update_on' => date("Y-m-d H:i:s")
										);
										$this->CommonMdl->insertRow($get_gallery_event,'tbl_event_gallery');
									}

									if($image5_name!=''){
										$get_gallery_event=array(
											'event_id'=>trim($_REQUEST['event_id']),
											'image'=>$image5_name,
											'create_on' => date("Y-m-d H:i:s"),
                                            'update_on' => date("Y-m-d H:i:s")
										);
										$this->CommonMdl->insertRow($get_gallery_event,'tbl_event_gallery');
									}

									if($image6_name!=''){
										$get_gallery_event=array(
											'event_id'=>trim($_REQUEST['event_id']),
											'image'=>$image6_name,
											'create_on' => date("Y-m-d H:i:s"),
                                            'update_on' => date("Y-m-d H:i:s")
										);
										$this->CommonMdl->insertRow($get_gallery_event,'tbl_event_gallery');
									}
									if($image7_name!=''){
										$get_gallery_event=array(
											'event_id'=>trim($_REQUEST['event_id']),
											'image'=>$image7_name,
											'create_on' => date("Y-m-d H:i:s"),
                                            'update_on' => date("Y-m-d H:i:s")
										);
										$this->CommonMdl->insertRow($get_gallery_event,'tbl_event_gallery');
									}

									if($image8_name!=''){
										$get_gallery_event=array(
											'event_id'=>trim($_REQUEST['event_id']),
											'image'=>$image8_name,
											'create_on' => date("Y-m-d H:i:s"),
                                            'update_on' => date("Y-m-d H:i:s") 
										);
										$this->CommonMdl->insertRow($get_gallery_event,'tbl_event_gallery');
									}
									// echo $this->db->last_query();
									// die;
									$get_gallery_events=$this->CommonMdl->getResultByCond('tbl_event_gallery',array('event_id'=>trim($_REQUEST['event_id'])),'image',$order_by='');
									// print_r($get_gallery_event);
									// die;
									foreach($get_result_event as $key=>$val){
											$get_result_event[$key]->folder_name="event";
											$get_result_event[$key]->event_amenity=$get_event_amenities;
											$get_result_event[$key]->event_gallery=$get_gallery_events;
									}

									$return_array = array(
											'cmd' => 'event list',
											'status' =>'1',
											'response' =>$get_result_event,
											'response_messege' =>'event insert sucesfully'
										  );
										  
										  
										  
										
									  
									}
									
				

	}
	else
	{
		$return_array = array(
		'cmd' => 'event list',
		'status' =>'0',
		'response' =>'0',
		'response_messege' =>'parameter is missing'
		);
	}
	$output = json_encode($return_array);
	echo trim($output,'"');
	
	// print_r($_REQUEST);
	// die();

   	
}



// Event Listing
public function event_listing(){
$return_array=array();
$offset='0';
$limit='8';
$page='0';
	if(isset($_REQUEST['fac_id'])){
		if(isset($_REQUEST['page']) && trim($_REQUEST['page'])!=''){
		   if(isset($_REQUEST['start_date']) || isset($_REQUEST['end_date']) || isset($_REQUEST['fac_id'])){
					$start_date='';
					$end_date='';
					$start_date=$_REQUEST['start_date'];
					$end_date=$_REQUEST['end_date'];
					$fac_id=$_REQUEST['fac_id'];
					$offset = $_REQUEST['page']*8;
				    $sport_id=$_REQUEST['sport_id'];
				    $get_event_list=$this->ApiMdl->getResultByevent($fac_id,$sport_id,$start_date,$end_date,$limit,$offset);
					
				   foreach($get_event_list as $key=>$val){
							$event_id= $val->event_id;
							$get_event_amenities=$this->CommonMdl->getResultByCond('tbl_event_amenities',array('event_id'=>trim($event_id)),'*',$order_by='');
							$get_event_gallery=$this->CommonMdl->getResultByCond('tbl_event_gallery',array('event_id'=>trim($event_id)),'image',$order_by='');
							$get_event_list[$key]->folder_name="event/banner";
							$get_event_list[$key]->folder_gallery="event/gallery";
							$get_event_list[$key]->event_amenity=$get_event_amenities;
							$get_event_list[$key]->event_gallery=$get_event_gallery;
                        }
						
					if($get_event_list!=''){
							$return_array = array(
								'cmd' => 'event listing',
								'status' =>'1',
								'response' =>$get_event_list,
								'response_messege' =>'event listing sucesfully'
							);
					   }
					else{
					  $return_array = array(
							'cmd' => 'event listing',
							'status' =>'1',
							'response' =>$return_array,
							'response_messege' =>'event listing'
						);
                      }
						
					
						
			 	}
		}
		else{
		$return_array = array(
			'cmd' => 'event list',
			'status' =>'0',
			'response' =>$return_array,
			'response_messege' =>'parameter is missing'
		);
	}
  }
  else{
	  $return_array = array(
					'cmd' =>'Event list',
					'status'=>'0',
					'response'=>'',
					'response_messege' =>'parameter is missing'
					);
  }
$output = json_encode($return_array);
	echo trim($output,'"'); 
}


//Booking Listing
public function booking_listing(){
$return_array=array();
$offset='0';
$limit=8;
$page='0';


	 if((trim(@$_REQUEST['fac_id'])))
	 {
		    
		 
		    if(isset($_REQUEST['page']) && $_REQUEST['page']!=''){
				     if(!isset($_REQUEST['start_date']) && !isset($_REQUEST['end_date']) && !isset($_REQUEST['booking_type']) && !isset($_REQUEST['sport_id']))
				          {

								$start_date=$_REQUEST['start_date'];
								$end_date=$_REQUEST['end_date'];
                                 $sport_id=$_REQUEST['sport_id'];
								$offset = $_REQUEST['page']*$limit;
								$fac_id=$_REQUEST['fac_id'];
								   
						 $get_booking_order=$this->ApiMdl->getResultByCond_date(trim($fac_id),trim($start_date),trim($end_date),trim($sport_id),trim($limit=''),trim($offset=''));
						
						if($get_booking_order){
						 $n=0;
						 foreach($get_booking_order as $key=>$val){
							 
							 //print_r($get_booking_slot_detail);
							 // die;
							 if($val->booking_order_id == $prev_booking_order_id)
							 {
								//echo "yes";
							            $get_booking_slot_detail[$n-1][0]->booking_slot_listing[]=$val;
								
							 }
							 else
							 {
								//echo "no"; 
									$get_booking_slot_detail[]=$this->ApiMdl->getResultByCond('tbl_booking_order',array('booking_order_id'=>trim($val->booking_order_id)),'*',$order_by='',$limit='',$offset='');	
									//echo $this->db->last_query();
									//print_r($get_booking_slot_detail);
									//echo "<br />";
									//echo($key);
									$get_booking_slot_detail[$n][0]->booking_slot_listing[]=$val;
									$n++;
								
							 }
							$prev_booking_order_id=$val->booking_order_id;
							
							// $get_booking_order[$key]->booking_slot_listing=$get_booking_slot_detail;

							 
						 }
						 $limit=8;
						 $offset=$_REQUEST['page'];
						 $get_booking_slot_detail=array_slice($get_booking_slot_detail,$offset*$limit,$limit);
						 //$countArr1 = count($get_booking_slot_detail);
								/* for($c=$offset*$limit;$c<$limit;$c++)
								{
									//print_r($get_booking_slot_detail);
									$arrayLimit[] = $get_booking_slot_detail[$c];
								} */
						      $flat = array_merge(...$get_booking_slot_detail);
							 
							

									if($get_booking_slot_detail){
											 $return_array= array(
												'cmd' => 'Booking listing',
												'status' =>'1',
												'response' =>$flat,
												'response_messege' =>'Booking listing'
										);
								       
									}
									else{
											$return_array = array(
											'cmd' => 'Booking listing',
											'status' =>'1',
											'response' =>$return_array,
											'response_messege' =>'Booking listing'
											); 
									}
						}
						else{
								 $return_array = array(
									'cmd' => 'Booking listing',
									'status' =>'1',
									'response' =>$return_array,
									'response_messege' =>'Booking listing'
							); 
						}
				}
				else{
						$start_date='';
						$end_date='';
						$start_date=$_REQUEST['start_date'];
						$end_date=$_REQUEST['end_date'];
						$sport_id=$_REQUEST['sport_id'];
						$offset = $_REQUEST['page']*8;
						$fac_id=$_REQUEST['fac_id'];								   
						 $get_booking_order=$this->ApiMdl->getResultByCond_date(trim($fac_id),trim($start_date),trim($end_date),trim($sport_id),trim($limit=''),trim($offset=''));
						//echo $this->db->last_query();
						//print_r($get_booking_order);
						if(count($get_booking_order)>0){
							
	
						 // echo $get_booking_order->booking_order_id;
						 // die;
						$n=0; 
						 foreach($get_booking_order as $key=>$val){
							
							 
							 // die;
							 if($val->booking_order_id ==$prev_booking_order_id)
							 {
								 
										// $get_booking_slot_detail[]=$this->CommonMdl->getResultByCond('tbl_booking_order',array('booking_order_id'=>trim($val->booking_order_id)),'*',$order_by='');
                           
                         				if(isset($_REQUEST['booking_type']) && $_REQUEST['booking_type']!=''){
											$countArr = $this->CommonMdl->getResultByCond('tbl_booking_order',array('booking_order_id'=>trim($val->booking_order_id),'booking_type'=>trim($_REQUEST['booking_type'])),'*',$order_by='');

										}else{
											$countArr = $this->CommonMdl->getResultByCond('tbl_booking_order',array('booking_order_id'=>trim($val->booking_order_id)),'*',$order_by='');
										}										
										

										if(count($countArr)!=0)
										{
												$get_booking_slot_detail[$n-1][0]->booking_slot_listing[]=$val;
										}
							 }
							 else
							 {
								 
						       if(isset($_REQUEST['booking_type']) && $_REQUEST['booking_type']!=''){
											$countArr = $this->CommonMdl->getResultByCond('tbl_booking_order',array('booking_order_id'=>trim($val->booking_order_id),'booking_type'=>trim($_REQUEST['booking_type'])),'*',$order_by='');

										}else{
											$countArr = $this->CommonMdl->getResultByCond('tbl_booking_order',array('booking_order_id'=>trim($val->booking_order_id)),'*',$order_by='');
										}										
										
						        //echo $this->db->last_query();
								if(count($countArr)!=0)
								{	
								if(isset($_REQUEST['booking_type']) && $_REQUEST['booking_type']!=''){
												$get_booking_slot_detail[] = $this->CommonMdl->getResultByCond('tbl_booking_order',array('booking_order_id'=>trim($val->booking_order_id),'booking_type'=>trim($_REQUEST['booking_type'])),'*',$order_by='');

											}else{
												$get_booking_slot_detail[] = $this->CommonMdl->getResultByCond('tbl_booking_order',array('booking_order_id'=>trim($val->booking_order_id)),'*',$order_by='');
											}										
										
										// echo $this->db->last_query();

										//print_r($get_booking_slot_detail);
										//print_r($get_booking_slot_detail);
										//echo "<br />";
										//echo($key);
										$get_booking_slot_detail[$n][0]->booking_slot_listing[]=$val;
										$n++;
								}
							 }
							$prev_booking_order_id=$val->booking_order_id;
							
							// $get_booking_order[$key]->booking_slot_listing=$get_booking_slot_detail;

							 
						 }
							//$newArr=[];
						$limit=8;
						 $offset=$_REQUEST['page'];
						 $get_booking_slot_detail=array_slice($get_booking_slot_detail,$offset*$limit,$limit);
				$flat = array_merge(...$get_booking_slot_detail);

									if($get_booking_slot_detail){
										
											 $return_array = array(
												'cmd' => 'Booking listing',
												'status' =>'1',
												'response' =>$flat,
												'response_messege' =>'Booking listing'
										);
								       
									}
									else{
											$return_array = array(
											'cmd' => 'Booking listing',
											'status' =>'1',
											'response' =>$return_array,
											'response_messege' =>'Booking listing'
											); 
									}
						}
						else{
								 $return_array = array(
									'cmd' => 'Booking listing',
									'status' =>'1',
									'response' =>$return_array,
									'response_messege' =>'Booking listing'
							); 
						}
					
					
				}
			}
			else{
				  $return_array = array(
						'cmd' => 'Booking listing',
						'status' => '0',
						'response' => '0',
						'response_messege' => 'page missing'
                  );
			}
		 
	 }
	 else{
			$return_array = array(
			'cmd' => 'Booking listing',
			'status' =>'0',
			'response' =>'0',
			'response_messege' =>'parameter is missing'
			);
	 }
	$output = json_encode($return_array);
	echo trim($output,'"');
	
	
	
}



public function review_listing(){
	$return_array=array();
	$offset='0';
	$limit='8';
	$page='0';
	$itemsPerPage='5';

	if($_REQUEST['fac_id'])
	{
		if(isset($_REQUEST['page']) && $_REQUEST['page']!=''){
			
			  if(isset($_REQUEST['start_date']) || isset($_REQUEST['end_date']) || isset($_REQUEST['fac_id']))
			  { 
		                 $start_date='';
		                 $end_date='';
		                 $offset = $_REQUEST['page']*8;
						 $start_date=$_REQUEST['start_date'];
						 $end_date=$_REQUEST['end_date'];
						 $fac_id=$_REQUEST['fac_id'];
						 
						 
                        $get_rating_listing=$this->ApiMdl->getResultByCondrating($fac_id,$start_date,$end_date,$limit,$offset);
					    
						
						
							            foreach($get_rating_listing as $key=>$val){
												$get_review=$this->CommonMdl->getResultByCond('tbl_review',array('rating_id'=>trim($rating_id=$val->rating_id)),'*',$order_by='');
								               $get_rating_listing[$key]->review_listing=$get_review;
											   
										}
										if($get_rating_listing){
											$return_array = array(
														'cmd' => 'Review listing',
														'status' =>'1',
														'response' =>$get_rating_listing,
														'response_messege' =>'Review listing'
														);
										}
										else{
											$return_array = array(
														'cmd' => 'Review listing',
														'status' =>'1',
														'response' =>$return_array,
														'response_messege' =>'Review not listing'
														);
										}
										
                                        
						
						
			  }
			  
		}
		else{
		 $return_array = array(
				'cmd' => 'Enquries listing',
				'status' => '0',
				'response' => '0',
				'response_messege' => 'Page missing'
		  ); 
		}
	}
	$output = json_encode($return_array);
	echo trim($output,'"');
	
	
}

// Enquiries Listing
public function enquiries_listing(){
$offset='0';
$limit='8';
$page='0';
$itemsPerPage='5';
$return_array=array();
			if(trim(@$_REQUEST['fac_id']))
			{
				
				
				 if(isset($_REQUEST['page']) && $_REQUEST['page']!=''){
					   if(isset($_REQUEST['start_date']) || isset($_REQUEST['end_date']) || isset($_REQUEST['fac_id']))
				 {
					 // print_r($_REQUEST);
					 // die;
					 
					 
								$start_date='';
								$end_date='';
								$fac_id=$_REQUEST['fac_id'];
								$start_date=$_REQUEST['start_date'];
								$end_date=$_REQUEST['end_date'];
								
								
                                
								$offset = $_REQUEST['page']*8;
								
								
								 $query_to_facility=$this->ApiMdl->getResultBy_user_query($fac_id,$start_date,$end_date,$limit,$offset);
										if($query_to_facility!=''){
												$return_array = array(
												'cmd' => 'Enquiries listing',
												'status' =>'1',
												'response' =>$query_to_facility,
												'response_messege' =>'Enquiries listing'
												);
										}
										else{
											$return_array = array(
												'cmd' => 'Enquiries listing',
												'status' =>'1',
												'response' =>$result_array,
												'response_messege' =>'Enquiries listing'
												);
											
										}
			        }
				 else if($_REQUEST['start_date']){
					 
						$start_date='';
						$end_date='';
						$fac_id=$_REQUEST['fac_id'];
						$start_date=$_REQUEST['start_date'];
						$end_date=$_REQUEST['end_date'];
						$offset = $_REQUEST['page']*8;
		
			 
					 $query_to_facility=$this->ApiMdl->getResultByCond('tbl_user_query_to_facility',array('fac_id'=>trim($fac_id),'create_on>='=>trim($start_date),'create_on>='=>trim($start_date)),'*',$order_by='',$limit,$offset);
					 
					 if($query_to_facility!=''){
									  $return_array = array(
													'cmd' => 'Enquiries listing',
													'status' =>'1',
													'response' =>$query_to_facility,
													'response_messege' =>'Enquiries listing'
													);
									 
					 }
					 else{
						 $return_array = array(
								'cmd' => 'Enquiries listing',
								'status' =>'1',
								'response' =>$return_array,
								'response_messege' =>'Enquiries listing'
								);
						 
					 }
					 
				 }
				 else if($_REQUEST['end_date']){
					 
						$start_date='';
						$end_date='';
						$fac_id=$_REQUEST['fac_id'];
						$start_date=$_REQUEST['start_date'];
						$end_date=$_REQUEST['end_date'];
						$offset = $_REQUEST['page']*8;
					 
					 $query_to_facility=$this->ApiMdl->getResultByCond('tbl_user_query_to_facility',array('fac_id'=>trim($fac_id),'create_on<='=>trim($end_date),'create_on<='=>trim($end_date)),'*',$order_by='',$limit,$offset);
					 
					 if($query_to_facility!=''){
									  $return_array = array(
													'cmd' => 'Enquiries listing',
													'status' =>'1',
													'response' =>$query_to_facility,
													'response_messege' =>'Enquiries listing'
													);
									 
					 }
					 else{
						 $return_array = array(
								'cmd' => 'Enquiries listing',
								'status' =>'1',
								'response' =>$return_array,
								'response_messege' =>'Enquiries listing'
								);
						 
					 }
					 
				 }
				 
				 }
				 else{
					 $return_array = array(
							'cmd' => 'Enquries listing',
							'status' => '0',
							'response' => '0',
							'response_messege' => 'Page missing'
            ); 
					 
					 
				 }
				 


			}
			else{
				$return_array = array(
				'cmd' => 'Enquiries listing',
				'status' =>'0',
				'response' =>'0',
				'response_messege' =>'parameter is missing'
				);
			}
	$output = json_encode($return_array);
	echo trim($output,'"');
	
	
 }

// Notification listing
 
public function notification_listing(){
$offset='0';
$limit='8';
$page='0';
$itemsPerPage='5';
$result_array=array();
   	if(trim(@$_REQUEST['fac_id']))
			{
				
				
				
					$start_date = '';
					$end_date = '';	
					$fac_id=@$_REQUEST['fac_id'];
					$start_date=$_REQUEST['start_date'];
					$end_date=$_REQUEST['end_date'];
				    if(isset($_REQUEST['page']) && $_REQUEST['page']!='')
					{
						if(!isset($_REQUEST['start_date']) && !isset($_REQUEST['end_date']))
						{
								$offset=$_REQUEST['page']*8;

								$get_notification=$this->ApiMdl->getNotificationList(trim($fac_id),trim($limit),trim($offset));
								// print_r($get_notification);
								// die;	
						if($get_notification!=''){
								$return_array = array(
											'cmd' => 'Notification listing',
											'status' =>'1',
											'response' =>$get_notification,
											'response_messege' =>'Notification listing'
										  );
					              }
								  else{
									   $return_array = array(
											'cmd' => 'Notification listing',
											'status' =>'1',
											'response' =>$result_array,
											'response_messege' =>'Notification listing'
										  );
								  }


						}
						else{
								$start_date = '';
								$end_date = '';	
								$fac_id=@$_REQUEST['fac_id'];
								$start_date=$_REQUEST['start_date'];
								$end_date=$_REQUEST['end_date'];
								$offset=$_REQUEST['page']*8;
								 $get_notification=$this->ApiMdl->getNotificationList_date(trim($fac_id),trim($start_date),trim($end_date),trim($limit),trim($offset));
								 if($get_notification!=''){
										  $return_array = array(
													'cmd' => 'Notification listing',
													'status' =>'1',
													'response' =>$get_notification,
													'response_messege' =>'Notification listing'
												  );
								 }
								 else{
								                $return_array = array(
													'cmd' => 'Notification listing',
													'status' =>'1',
													'response' =>$result_array,
													'response_messege' =>'Notification listing'
												  );

									 
								 }
                            }
					
			       }
				else{
					$return_array = array(
					'cmd' => 'Notification listing',
					'status' =>'0',
					'response' =>'0',
					'response_messege' =>'parameter is missing'
					);
				}
		}
		else{
			
				$return_array = array(
				'cmd' => 'Notification listing',
				'status' =>'0',
				'response' =>'0',
				'response_messege' =>'parameter is missing'
				);
			
			
		}
	$output = json_encode($return_array);
	echo trim($output,'"');
	
	
}

//Email Notification Listing
public function email_notification_listing(){
$offset='0';
$limit='8';
$page='0';
$itemsPerPage='5';
$result_array=array();

	if(trim(@$_REQUEST['user_id']))
			{
				$start_date = '';
				$end_date = '';	
				$user_id=@$_REQUEST['user_id'];
				$start_date=$_REQUEST['start_date'];
				$end_date=$_REQUEST['end_date'];
				if(isset($_REQUEST['page']) && $_REQUEST['page']!=''){
						  if(!isset($_REQUEST['start_date']) && !isset($_REQUEST['end_date']))
							{				
										$offset = $_REQUEST['page']*8;
										$get_notification=$this->ApiMdl->getEmailNotificationLists(trim($user_id),trim($limit),trim($offset));
										
										if($get_notification!=''){
												$return_array = array(
												'cmd' => 'Email Notification listing',
												'status' =>'1',
												'response' =>$get_notification,
												'response_messege' =>'Email Notification listing'
												);
										}
										else{
				                             $return_array = array(
												'cmd' => 'Email Notification listing',
												'status' =>'1',
												'response' =>$result_array,
												'response_messege' =>'Email Notification listing'
												);

											
										}
					 
							}
							else{
										$start_date = '';
										$end_date = '';	
										$user_id=@$_REQUEST['user_id'];
										$start_date=$_REQUEST['start_date'];
										$end_date=$_REQUEST['end_date'];
										$offset = $_REQUEST['page']*8;
										$get_notification=$this->ApiMdl->getEmailNotificationLists_date($user_id,$start_date,$end_date,trim($limit),trim($offset));
							             if($get_notification!=''){                                       
											$return_array = array(
											'cmd' => 'Email Notification listing',
											'status' =>'1',
											'response' =>$get_notification,
											'response_messege' =>'Email Notification listing'
											);
										 }
										 else{
											 $return_array = array(
												'cmd' => 'Email Notification listing',
												'status' =>'1',
												'response' =>$result_array,
												'response_messege' =>'Email Notification listing'
												);
											 
										 }
								
							}
				}
					else{
						$return_array = array(
						'cmd' => 'Email Notification listing',
						'status' => '0',
						'response' => '0',
						'response_messege' => 'Page missing'
					); 
				}

			}
			else{
				$return_array = array(
				'cmd' => 'Notification listing',
				'status' =>'0',
				'response' =>'0',
				'response_messege' =>'parameter is missing'
				);
			}
	$output = json_encode($return_array);
	echo trim($output,'"');
}


//logout

public function logout(){
	if(trim($_REQUEST['user_id']))
	{
	   $this->CommonMdl->getRow('tbl_user','*',array('user_id'=>trim($_REQUEST['user_id'])));
	   $return_array = array(
				'cmd' => 'user Logout',
				'status' =>'1',
				'response' =>'1',
				'response_messege' =>'user Logout Succesfully'
				);
       	   
		
	}
	else{
				$return_array = array(
				'cmd' => 'user id',
				'status' =>'0',
				'response' =>'0',
				'response_messege' =>'parameter is missing'
				);
			}
	$output = json_encode($return_array);
	echo trim($output,'"');
	
}




// dashboard_count
public function dashbord_booking(){
	$result_array=array();
	if(trim(@$_REQUEST['fac_id']))
	  {
				$todays_booking_count=$this->CommonMdl->fetchNumRows('tbl_booking_slot_detail',array('fac_id'=>$_REQUEST['fac_id'],'date(created_on)'=>date("Y-m-d")),$cond1='');
				$todays_trial_booking_count=$this->CommonMdl->fetchNumRows('tbl_booking_slot_detail',array('fac_id'=>$_REQUEST['fac_id'],'is_trial'=>'yes','date(created_on)'=>date("Y-m-d")),$cond1='');
                // echo $this->db->last_query();
				// die;
				$total_booking_count=$this->CommonMdl->fetchNumRows('tbl_booking_slot_detail',array('fac_id'=>trim($_REQUEST['fac_id'])),$cond1='');
				$total_confirmed_booking_count=$this->CommonMdl->fetchNumRows('tbl_booking_slot_detail',array('fac_id'=>trim($_REQUEST['fac_id']),'booking_detail_status'=>'confirm'),$cond1='');
				$total_pending_booking_count=$this->CommonMdl->fetchNumRows('tbl_booking_slot_detail',array('fac_id'=>trim($_REQUEST['fac_id']),'booking_detail_status'=>'pending'),$cond1='');

				$todays_booking_count=array('todays_booking_count'=>$todays_booking_count,'todays_trial_booking_count'=>$todays_trial_booking_count,'total_booking_count'=>$total_booking_count,'total_confirmed_booking_count'=>$total_confirmed_booking_count,'total_pending_booking_count'=>$total_pending_booking_count);
               
				//upcoming_events
				$upcoming_events= $this->CommonMdl->getResultByCondLimit('tbl_event',array('fac_id'=>trim($_REQUEST['fac_id']),'event_end_date>'=>date('Y-m-d'),'event_approval'=>'approved'),'*',array('col_name'=>'event_id','order'=>'desc'),'5');
				
				

				//latest_queries				
				$latest_queries = $this->CommonMdl->getResultByCondLimit('tbl_user_query_to_facility',array('fac_id'=>$_REQUEST['fac_id']),'*',array('col_name'=>'query_id','order'=>'desc'),'5');



				//Review_summary  
				$total_1_review=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>trim($_REQUEST['fac_id']),'rating'=>'1'),'');
				$total_2_review=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>trim($_REQUEST['fac_id']),'rating'=>'2'),'');
				$total_3_review=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>trim($_REQUEST['fac_id']),'rating'=>'3'),'');
				$total_4_review=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>trim($_REQUEST['fac_id']),'rating'=>'4'),'');
				$total_5_review=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>trim($_REQUEST['fac_id']),'rating'=>'5'),'');
                $total_6_review=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>trim($_REQUEST['fac_id'])));

				
				$total_1_review=array('total_1_review'=>$total_1_review,'total_2_review'=>$total_2_review,'total_3_review'=>$total_3_review,'total_4_review'=>$total_4_review,'total_5_review'=>$total_5_review,'review_count'=>$total_6_review);
				
		

if($todays_booking_count!='' && $upcoming_events!='' && $latest_queries!='' && $total_1_review!='')
			   {
				   if(count($upcoming_events)==0)
				{
					//echo count($upcoming_events);
					$upcoming_events = [];
				}
				else{
				   foreach($upcoming_events as $key=>$val){
							$upcoming_events[$key]->folder_name="event/banner";
							$upcoming_events[$key]->folder_gallery="event/gallery";
							$get_event_amenities=$this->CommonMdl->getResultByCond('tbl_event_amenities',array('event_id'=>trim($val->event_id)),'*',$order_by='');
							$get_event_gallery=$this->CommonMdl->getResultByCond('tbl_event_gallery',array('event_id'=>$val->event_id),'*',$order_by='');	
							// $get_event_gallery[0]->folder_name="event/gallery";

							$upcoming_events[$key]->event_amenity=$get_event_amenities;
							$upcoming_events[$key]->event_gallery=$get_event_gallery;

							//$data=$upcoming_events;
				   }
				}
				   
				  $todays_booking_count=array('dashbord_booking'=>$todays_booking_count,'upcoming_events'=>$upcoming_events,'latest_queries'=>$latest_queries,'review_summary'=>$total_1_review);


                 if($todays_booking_count)
				 {
				
						$return_array = array(
								'cmd' => 'Todays Booking',
								'status' =>'1',
								'response' =>$todays_booking_count,
								'response_messege' =>'Get Todays Booking'
						);
				 }
				 else{
					 $return_array = array(
								'cmd' => 'Todays Booking',
								'status' =>'1',
								'response' =>$return_array,
								'response_messege' =>'Get Todays Booking'
						); 
					 
				 }
				 
			   }
			   
			  
			  
			   else{
				    $return_array = array(
						'cmd' => 'Todays Booking',
						'status' =>'0',
						'response' =>$result_array,
						'response_messege' =>'Get Todays Booking'
			           );
			   }
		}
	  else{
				$return_array = array(
				'cmd' => 'Notification listing',
				'status' =>'0',
				'response' =>'0',
				'response_messege' =>'parameter is missing'
				);
			}
	$output = json_encode($return_array);
	echo trim($output,'"');
}


function notification_count(){
	
	if(isset($_REQUEST['action']))
	{
	      $unread_notification=$this->CommonMdl->fetchNumRows('tbl_notification',array('notification_status'=>'unread'),$cond1='');
		  $unread_email_notification=$this->CommonMdl->fetchNumRows('tbl_email_notification',array('email_notification_status'=>'unread'),$cond1='');
		    $unreads->unread_notification=$unread_notification;
		    $unreads->unread_email_notification=$unread_email_notification;
			// print_r($unreads);
			// die;
	         //$unreads=array('notification_count'=>$unread_notification);
			$return_array = array(
				'cmd' => 'Unread notification count',
				'status' =>'1',
				'response' =>$unreads,
				'response_messege' =>'Unread notification count'
				);
			 
			 
	}
	else{
		$return_array = array(
				'cmd' => 'Unread notification count',
				'status' =>'0',
				'response' =>'0',
				'response_messege' =>'parameter is missing'
				);
	}
	$output = json_encode($return_array);
	echo trim($output,'"');
}
//start
//Latest Queries

public function latest_queries(){
	if(isset($_REQUEST['fac_id']))
	{
		 $latest_queries = $this->CommonMdl->getResultByCondLimit('tbl_user_query_to_facility',array('fac_id'=>$_REQUEST['fac_id']),'*',array('col_name'=>'query_id','order'=>'desc'),'10');
		 
		 
		 $return_array = array(
			'cmd' => 'Latest Queries listing',
				'status' =>'1',
				'response' =>$latest_queries,
				'response_messege' =>'Latest Queries listing'
				);
	}
	else{
		$return_array = array(
				'cmd' => 'Latest Queries listing',
				'status' =>'0',
				'response' =>'0',
				'response_messege' =>'parameter is missing'
				);
			}
	$output = json_encode($return_array);
	echo trim($output,'"');
		
	
	
	
}



public function upcomming_event(){
	
	if(trim(@$_REQUEST['fac_id']))
	{
		// print_r($_REQUEST);
		// die;
	    $get_data= $this->CommonMdl->getResultByCond('tbl_event',array('fac_id'=>trim($_REQUEST['fac_id']),'event_approval'=>'approved'),'*',array('col_name'=>'event_id','order'=>'desc'));
		
	       $return_array = array(
					'cmd' => 'Upcomming Event listing',
					'status' =>'1',
					'response' =>$get_data,
					'response_messege' =>'Upcomming Event listing'
				);
				
				
	
	}
	else{
		$return_array = array(
				'cmd' => 'Upcomming Event listing',
				'status' =>'0',
				'response' =>'0',
				'response_messege' =>'parameter is missing'
				);
		
	}
	$output = json_encode($return_array);
	echo trim($output,'"');
	
	
}


public function total_review(){
	if(isset($_REQUEST['fac_id']))
	{
			//$total_review=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>trim($_REQUEST['fac_id'])),'');
			$total_1_review=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>trim($_REQUEST['fac_id']),'rating'=>'1'),'');
			$total_2_review=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>trim($_REQUEST['fac_id']),'rating'=>'2'),'');
			$total_3_review=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>trim($_REQUEST['fac_id']),'rating'=>'3'),'');
			$total_4_review=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>trim($_REQUEST['fac_id']),'rating'=>'4'),'');
			$total_5_review=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>trim($_REQUEST['fac_id']),'rating'=>'5'),'');

			$total_1_review=array('total_1_review'=>$total_1_review,'total_2_review'=>$total_2_review,'total_3_review'=>$total_3_review,'total_4_review'=>$total_4_review,'total_5_review'=>$total_5_review);

			// print_r(json_encode($total_1_review));
			// die;
			$return_array = array(
				'cmd' => 'Total Review listing',
				'status' =>'1',
				'response' =>$total_1_review,
				'response_messege' =>'Total Review listing'
			);
		  

	}
	else{
		$return_array = array(
				'cmd' => 'Total Review listing',
				'status' =>'0',
				'response' =>'0',
				'response_messege' =>'parameter is missing'
				);
		
	}
	$output = json_encode($return_array);
	echo trim($output,'"');
	



	  
	
}



//Available Slots

public function available_slots(){
	$return_array=array();
	if(isset($_REQUEST['fac_id']) && isset($_REQUEST['sport_id']))
	{
		               
					
						
                              //facility               
                                  if(!isset($_REQUEST['end_date']) && !isset($_REQUEST['start_date'])){
									$fac_slot= $this->CommonMdl->getResultByCond('tbl_facility_batch_slot',array('fac_id'=>trim($_REQUEST['fac_id']),'sport_id'=>trim($_REQUEST['sport_id'])),'*',$order_by='');
									// print_r($fac_slot);
									// die;
									
									$day = date("D");
									
                                              
									foreach($fac_slot as $key=>$val)
									{
								    // $fac_slot[$key]->dates; 
									$slot_day= $this->CommonMdl->getResultByCond('tbl_batch_slot_weekoff',array('batch_slot_id'=>$val->batch_slot_id,'batch_slot_weekoff_day'=>$day),'*',$order_by='');
									$fac_slot[$key]->weekoffs=$slot_day;
                                  
								  
									$slot_types= $this->CommonMdl->getResultByCond('tbl_batch_slot_type',array('batch_slot_type_id'=>$val->batch_slot_type_id),'batch_slot_type',$order_by='');
									
									
									
									$batch_slot_price= $this->CommonMdl->getResultByCond('tbl_slot_package_price',array('batch_slot_id'=>$val->batch_slot_id),'*',$order_by='');
						            $fac_slot[$key]->pricing=$batch_slot_price; 
						
						

									$count_number=$this->CommonMdl->fetchNumRows('tbl_booking_slot_detail',array('batch_slot_id' =>$val->batch_slot_id,'start_date'=>$_REQUEST['start_date']),$cond1='');
									// $count_number=count($get_count);
									// echo $this->db->last_query();
									// die;
									
									  $fac_slot[$key]->batch_slot_type=$slot_types[0]->batch_slot_type;
                                      if($count_number==1){
										  $fac_slot[$key]->availability="no";
									  }
									  if($count_number == 0){
										 $fac_slot[$key]->availability="yes"; 
										  
									  }
									
                              }
							  
							  if($fac_slot!=''){
												$return_array = array(
												'cmd' => 'Available Slots listing',
												'status' =>'1',
												'response' =>$fac_slot,
										 		'response_messege' =>'Available Slots listing'
										      );
											}
											
											
											
					
						  
					  }
					  
					  if(!isset($_REQUEST['end_date']) && isset($_REQUEST['start_date']))
					  {
						    $package_id = $this->input->post('package_id');
						   $fac_id = $this->input->post('fac_id');
						   $sport_id = $this->input->post('sport_id');
						   $datetime = date('Y-m-d', strtotime($this->input->post('start_date')));
						   $fac_slot= $this->FacilityMdl->getBatchSlotByPackage($fac_id,$sport_id,$package_id,$datetime);
                           // echo $this->db->last_query();
						   // echo "<pre>";
						   // print_r($fac_slot);
						   // die;
						  
						   $day = date('D', strtotime($this->input->post('start_date')));
							
                               $array_d = [];
							   if(!empty($fac_slot))
						     { 
								foreach($fac_slot as $key=>$val)
								{
									
											$datess=array('date'=>$_REQUEST['start_date']);
											// print_r($data);
											// die;
											// print_r($fac_slot);


											$slot_day1= $this->CommonMdl->getResultByCond('tbl_batch_slot_weekoff',array('batch_slot_id'=>$val->batch_slot_id,'batch_slot_weekoff_day'=>$day),'*',$order_by='');
											// print_r($slot_day);
											// die;
											$fac_slot[$key]->weekoffs=$slot_day1;

											$batch_slot_price= $this->CommonMdl->getResultByCond('tbl_slot_package_price',array('batch_slot_id'=>$val->batch_slot_id),'*',$order_by='');
											// print_r($batch_slot_price);
											// die;
											$fac_slot[$key]->pricing=$batch_slot_price; 
											// echo $val->batch_slot_type_id;


											$slot_day= $this->CommonMdl->getResultByCond('tbl_batch_slot_type',array('batch_slot_type_id'=>$val->batch_slot_type_id),'batch_slot_type',$order_by='');

											// $fac_slot[$key]->batch_slot_type=$slot_day;
											$fac_slot[$key]->batch_slot_type=$slot_day[0]->batch_slot_type;
											$count_number=$this->CommonMdl->fetchNumRows('tbl_booking_slot_detail',array('batch_slot_id' =>$val->batch_slot_id,'start_date'=>$_REQUEST['start_date']),$cond1='');
											

											if($count_number==1){
											$fac_slot[$key]->availability="no";
											}
											if($count_number == 0){
											$fac_slot[$key]->availability="yes"; 

											}


											$array_d=$datess;
											if(!empty($slot_day1)){
											$array_d['batch_slot_data']=$fac_slot;
											
											}
											else{
												$data=array();
												$array_d['batch_slot_data']=$data;
											}
											$array_s = array($array_d);
											// print_r($array_s);
											// die;
						
						
							


								}

                                  if($fac_slot!=''){
											$return_array = array(
											'cmd' => 'Available Slots listing',
											'status' =>'1',
											'response' =>$array_s,
											'response_messege' =>'Available Slots listing'
											);
											}
											else{
											$return_array = array(
											'cmd' => 'Available Slots listing',
											'status' =>'1',
											'response' =>$return_array,
											'response_messege' =>'Available Slots listing'
											);
											}



											
					       
						     }
							 else{
								   $return_array = array(
										'cmd' => 'Available Slots listing',
										'status' =>'0',
										'response' =>$return_array,
										'response_messege' =>'Available Slots listing Not found'
				                 );
							}
						   
						   
						   
						   
						   }
								 
								 
								 
                      else
					  {		
    							
						$fac_id=$_REQUEST['fac_id'];


						$sport_id=$_REQUEST['sport_id'];

						$start_date= $_REQUEST['start_date'];
						$end_date= $_REQUEST['end_date'];
						  
					    $period = new DatePeriod(
							new DateTime($_REQUEST['start_date']),
							new DateInterval('P1D'),
							new DateTime($_REQUEST['end_date'])
						);	 
						$array_d = [];
						$nk=0;
						foreach ($period as $value) {
							
							
							

							
							//print_r($value);
							$datess = $value->format('Y-m-d');  
							$start_date=$datess;

							$fac_slot= $this->CommonMdl->getResultByCond('tbl_facility_batch_slot',array('fac_id'=>$fac_id,'sport_id'=>$sport_id,'end_date>='=>$start_date),'*',$order_by='');
	
							//$fac_slot_arr=array($fac_slot);
							$fac_slot_arr=$fac_slot;
							
                            $day = date('D', strtotime($_REQUEST['start_date']));
							$k=0;
						
							foreach($fac_slot as $key=>$val)
							{

									$slot_day= $this->CommonMdl->getResultByCond('tbl_batch_slot_weekoff',array('batch_slot_id'=>$val->batch_slot_id,'batch_slot_weekoff_day'=>$day),'*',$order_by='');
									
									$fac_slot[$key]->wekoffs=$slot_day;

									$slot_types= $this->CommonMdl->getResultByCond('tbl_batch_slot_type',array('batch_slot_type_id'=>$val->batch_slot_type_id),'batch_slot_type',$order_by='');
									
									$batch_slot_price= $this->CommonMdl->getResultByCond('tbl_slot_package_price',array('batch_slot_id'=>$val->batch_slot_id),'*',$order_by='');
									$fac_slot[$key]->pricing=$batch_slot_price; 

									$fac_slot[$key]->batch_slot_type=$slot_types[0]->batch_slot_type;
								 $count_number=$this->CommonMdl->fetchNumRows('tbl_booking_slot_detail',array('batch_slot_id' =>$val->batch_slot_id,'start_date'=>$_REQUEST['start_date']),$cond1='');
									

									if($count_number==1){
									$fac_slot[$key]->availability="no";
									}
									if($count_number == 0){
									$fac_slot[$key]->availability="yes"; 
									}
									$k++;
							} 
							$array_d[$nk]['date']=$datess;	
							$array_d[$nk]['batch_slot_data']=$fac_slot_arr;
							$nk++;
						}
					 // print_r($array_d);
					  //$array_s = array($array_d);	
					  $array_s = $array_d;	
						// $fac_slot[$key]->booking_batch_count=$val->max_participanets;
							if(!empty($array_s)){
								  
									$return_array = array(
									'cmd' => 'Available Slots listing',
									'status' =>'1',
									'response' =>$array_s,
									'response_messege' =>'Available Slots listing'
									);
							}
							
						
						
					  }
						// else{
							 // $return_array = array(
								// 'cmd' => 'Available Slots listing',
								// 'status' =>'0',
								// 'response' =>$return_array,
								// 'response_messege' =>'Available Slots listing Not found'
				            // );
							
						// }
					//}
					 
						

			

				
		
		
	}
	else{
		$return_array = array(
				'cmd' => 'Available Slots listing',
				'status' =>'0',
				'response' =>'0',
				'response_messege' =>'parameter is missing'
				);
		
	}
	$output = json_encode($return_array);
	echo trim($output,'"');
	
	
}












//User Details
public function user_details(){
	$result_array=array();

   
if(isset($_REQUEST['user_field']))
{	
 $data=array('tag'=>'user not found');
	$email=filter_var($_REQUEST['user_field'], FILTER_VALIDATE_EMAIL);			
	if($_REQUEST['user_field'] == $email)
	{
                  $get_data=$this->CommonMdl->getRow('tbl_user','*',array('user_email' => $_REQUEST['user_field']));
					if($get_data!=''){

						$return_array = array(
										'cmd' =>'User details',
										'status'=>'1',
										'response'=>$get_data,
										'response_messege' =>'User details listing'
									);
					}
					else{
							$return_array = array(
								'cmd' =>'User details',
								'status'=>'1',
								'response'=>$data,
								'response_messege' =>'User not found'
							);
					}
					
	}
	else{
		 
         $get_datas=$this->CommonMdl->getRow('tbl_user','*',array('user_mobile_no' => $_REQUEST['user_field']));
		 // print_r($get_datas);
		 // die;
			if($get_datas!=''){
                       $return_array = array(
							'cmd' =>'User details',
							'status'=>'1',
							'response'=>$get_datas,
							'response_messege' =>'User details listing'
						);
			}
			
			 
			else{
				  $return_array = array(
							'cmd' =>'User details',
							'status'=>'1',
							'response'=>$data,
							'response_messege' =>'User not found'
						);
			}
		}    
}
else{
	 $return_array = array(
		'cmd' =>'User listing',
		'status'=>'0',
		'response'=>$result_array,
		'response_messege' =>'parameter is missing'
	);
	
}

$output = json_encode($return_array);
	echo trim($output,'"');
}

	
	
public function sendmail($data){
  $url= base_url('email_script.php');
  $handle = curl_init($url);
  curl_setopt($handle, CURLOPT_POST, true);
  curl_setopt($handle, CURLOPT_POSTFIELDS, $data);
  $res=curl_exec($handle);          
  curl_close($handle);
}



//offline_booking_checkout
public function offline_booking_checkout(){
	   $arr = explode(' ', $_REQUEST['user_name']);
      $pass = $arr[0].'@'.time();
	
	  
	  
	  
	  if(isset($_REQUEST['user_name']) && isset($_REQUEST['user_email']) && isset($_REQUEST['user_gender']) && isset($_REQUEST['user_mobile_no']) && isset($_REQUEST['user_city']) && isset($_REQUEST['user_address']) )
	  {
 		                   $user_id=$_REQUEST['user_id'];
						   
					if($_REQUEST['user_id']==''){
								   $date_arr = array(
										 'user_name' =>trim($_REQUEST['user_name']),
										 'user_email' => trim($_REQUEST['user_email']),
										 'user_gender' => trim($_REQUEST['user_gender']),
										 'user_mobile_no' =>trim($_REQUEST['user_mobile_no']),
										 'user_password' => md5($pass),
										 'user_city' =>trim($_REQUEST['user_city']),
										 'user_address' =>trim($_REQUEST['user_address']),
										 'user_latitude'=>trim($_REQUEST['user_latitude']),
										 'user_longitude'=>trim($_REQUEST['user_longitude']),
										  'user_pincode'=>trim($_REQUEST['user_pincode']),
										 'user_google_address'=>trim($_REQUEST['user_google_address']),
										 'user_country' => 'India',
										 'user_role' => '1',
										 'user_login_type' => '1',
										 'is_mobile_verified' => 'yes',
										 'is_email_verified' => 'yes',
										 'user_status' => 'enable',
										 'created_on' => date("Y-m-d H:i:s"),
										 'updated_on' => date("Y-m-d H:i:s")
									   );
						          $data=$this->CommonMdl->insertRow($date_arr,'tbl_user');
								  
				
				}
				 
				if(isset($user_id)){
				
					$main_booking_arr = array(
							 'booking_order_no' => 'SSZ100000'.time(),
							 'user_id' =>$user_id,
							 'name' => trim($_REQUEST['user_name']),
							 'email' => trim($_REQUEST['user_email']),
							 'mobile' => trim($_REQUEST['user_mobile_no']),
							 'city' => trim($_REQUEST['user_city']),
							 'address' => trim($_REQUEST['user_address']),
							 'total_amount' => trim($_REQUEST['total_amount']),
							 'final_amount' => trim($_REQUEST['total_amount']),
							 'payment_status' => 'success',
							 'booking_type' => 'offline',
							 'booking_status' => 'confirm',
							 'payment_method' => $_REQUEST['payment_method'],
							 'updated_by_type' => 'faclility',
							 'booking_on' => date("Y-m-d H:i:s"),
							 'updated_on' => date("Y-m-d H:i:s")
			        );
					 // print_r($main_booking_arr);
				 // die;
			     $last_booking_insert_id=$this->CommonMdl->insertRow($main_booking_arr,'tbl_booking_order');
				
			     $booking=json_decode($_REQUEST['booking_array']);
				 // print_r($booking);
				    						
								 foreach($booking  as $booking_arrays)
								 {
									 
									
		  
		  
									   $booking_array[] =array(
											'booking_order_id' => $last_booking_insert_id,
											'fac_id' => trim($booking_arrays->fac_id),
											'batch_slot_id' => trim($booking_arrays->batch_slot_id),
											'sport_id' =>  trim($booking_arrays->sport_id),
											// 'booking_detail_total_amount' =>  trim($_REQUEST['actual_amount']),
											// 'booking_detail_final_amount' =>  trim($_REQUEST['actual_amount']),
											'booking_detail_total_amount' => trim($booking_arrays->actual_price),
											'booking_detail_final_amount' => trim($booking_arrays->actual_price),
											'batch_slot_start_time' =>trim($booking_arrays->start_time),
											'batch_slot_end_time' => trim($booking_arrays->end_time),
											'batch_slot_type_id' => trim($booking_arrays->batch_slot_type_id),
											'package_id' => trim($booking_arrays->package_id),
											'start_date' => date('Y-m-d', strtotime($booking_arrays->start_date)),
											'booking_detail_status' => 'confirm',
											'facility_approval' => 'enable',
											'created_on' => date("Y-m-d H:i:s"),
											'updated_on' => date("Y-m-d H:i:s"),
									   );
									}
									
									 $data=$this->CommonMdl->insertinBatch($booking_array,'tbl_booking_slot_detail');
						            
				
			  }
			  
			   if($data){
					$return_array = array(
					'cmd' =>'Booking  Listing',
					'status'=>'1',
					'response'=>"1",
					'response_messege' =>'Booking insert sucesfully'
				);
					}
									
									
				
		   
	   
 
	
	  }
	  else{
		  $return_array = array(
			'cmd' =>'offline Booking Listing',
			'status'=>'0',
			'response'=>$result_array,
			'response_messege' =>'parameter is missing'
		);
	  }
$output = json_encode($return_array);
	echo trim($output,'"');
}


//availability_count_of_month

public function availability_count_of_month(){
$result_array=array();
   if(isset($_REQUEST['fac_id']) && isset($_REQUEST['sport_id']) && isset($_REQUEST['year']) && isset($_REQUEST['month']))
      {
		  
	            $fac_id=$_REQUEST['fac_id'];
	            $sport_id=$_REQUEST['sport_id'];
	            $year=$_REQUEST['year'];
	            $month=$_REQUEST['month'];
	            $type=$_REQUEST['type'];
				if($type=='academy'){ 
					for ($i=1; $i <32 ; $i++) { 
						$year_month = date('Y-m', strtotime($year.'-'.$month));
					    $slot_date =$year_month.'-'.$i;
					    $day = date('D',strtotime($slot_date));
					    $fac_slots= $this->CommonMdl->getResultByCond('tbl_facility_batch_slot',array('fac_id'=>$fac_id,'sport_id'=>$sport_id,'start_date<='=>$slot_date,'end_date>='=>$slot_date),'*',$order_by='');
						
						$max_participanets=0;
						$sport_slot_booking_count=0;
						$arr_count=array();
						foreach ($fac_slots as $fac_slot) {
						  $slot_day['slot_day'] = $this->CommonMdl->getResultByCond('tbl_batch_slot_weekoff',array('batch_slot_id'=>$fac_slot->batch_slot_id,'batch_slot_weekoff_day'=>$day),'*',$order_by='');
						if(!empty($slot_day['slot_day'])){
							$arr_count[]=$fac_slot;
							$max_participanets = $max_participanets+$fac_slot->max_participanets;
							$sport_slot_booking_count = $sport_slot_booking_count+$this->FacilityMdl->fetchslotbookingNumrowsMulti($fac_id,$sport_id,$slot_date,$fac_slot->batch_slot_id, $fac_slot->end_date);
						  }
						
						}
						$data['sport_slot_count'][]=$max_participanets;
						$data['sport_slot_booking_count'][]=$sport_slot_booking_count;
						$date1 = $year.'-'.$month.'-'.$i;
						//$t_count1 = count($arr_count);
						//$av_count1 = $this->FacilityMdl->fetchslotbookingNumrows($fac_id,$sport_id,$slot_date);
						$t_count1 = $max_participanets;
						$av_count1 = $sport_slot_booking_count;
						$res[]=array('date'=>$date1, 'total_seats'=>$t_count1, 'booked_seats'=>$av_count1);
					  }
				}else{	
					 for ($i=1; $i <32 ; $i++) { 
						$year_month = date('Y-m', strtotime($year.'-'.$month));
					    $slot_date =$year_month.'-'.$i;
					    $day = date('D',strtotime($slot_date));
					    $fac_slots= $this->CommonMdl->getResultByCond('tbl_facility_batch_slot',array('fac_id'=>$fac_id,'sport_id'=>$sport_id,'start_date<='=>$slot_date,'end_date>='=>$slot_date),'*',$order_by='');
						$arr_count=array();
						foreach ($fac_slots as $fac_slot) {
						  $slot_day['slot_day'] = $this->CommonMdl->getResultByCond('tbl_batch_slot_weekoff',array('batch_slot_id'=>$fac_slot->batch_slot_id,'batch_slot_weekoff_day'=>$day),'*',$order_by='');
						  if(!empty($slot_day['slot_day'])){
							$arr_count[]=$fac_slot;
						  }
						
						}
					  $data['sport_slot_count'][]=count($arr_count);
					  $data['sport_slot_booking_count'][]=$this->FacilityMdl->fetchslotbookingNumrows($fac_id,$sport_id,$slot_date);
						$date1 = $year.'-'.$month.'-'.$i;
						$t_count1 = count($arr_count);
						$av_count1 = $this->FacilityMdl->fetchslotbookingNumrows($fac_id,$sport_id,$slot_date);
						$res[]=array('date'=>$date1, 'total_seats'=>$t_count1, 'booked_seats'=>$av_count1);
					  }
					}		
			    $return_array = array(
						'cmd' =>'availability listing',
						'status'=>'1',
						'response'=>$res,
						'response_messege' =>'availability listing'
		                   );
		
	  }
	  else{
	       $return_array = array(
			'cmd' =>'offline Booking Listing',
			'status'=>'0',
			'response'=>$result_array,
			'response_messege' =>'parameter is missing'
		);
	  }
	  $output= json_encode($return_array);
	  echo trim($output,'"');
}


//slot_batch_detail
public function slot_batch_detail(){
$result_array=array();
   if(isset($_REQUEST['fac_id']) && isset($_REQUEST['sport_id']) && isset($_REQUEST['date']))
      {
	        $fac_id=$_REQUEST['fac_id'];
	        $sport_id=$_REQUEST['sport_id'];
	        $datetime= $_REQUEST['date'];
	        // $day=$_REQUEST['day'];
	          
            $fac_slots= $this->CommonMdl->getResultByCond('tbl_facility_batch_slot',array('fac_id'=>$fac_id,'sport_id'=>$sport_id,'start_date<='=>$datetime,'end_date>='=>$datetime),'*',$order_by='');
			
			//$day = date("D");
		    foreach($fac_slots as $key=>$val){
			   $slot_weekoff=$this->CommonMdl->getResultByCond('tbl_batch_slot_weekoff',array('batch_slot_id'=>$val->batch_slot_id),'*',$order_by='');
			  
			   // foreach($slot_weekoff as $slot_weekoffs){
						   // $fac_slots[$key]->weekoff=$slot_weekoffs;
						// }
						// print_r($fac_slots);
						
						
			   $fac_slots[$key]->weekoffs=$slot_weekoff;
			  $count_number=$this->CommonMdl->fetchNumRows('tbl_booking_slot_detail',array('batch_slot_id' =>$val->batch_slot_id,'start_date'=>$_REQUEST['date']),$cond1='');
			  //echo $this->db->last_query();
			   
			   $batch_slot_price= $this->CommonMdl->getResultByCond('tbl_slot_package_price',array('batch_slot_id'=>$val->batch_slot_id),'*',$order_by='');
			  $fac_slots[$key]->pricing=$batch_slot_price; 
									
									
			   if($count_number==1){
					$fac_slots[$key]->availability="no";
				}
			  if($count_number == 0){
				 $fac_slots[$key]->availability="yes"; 
				  
			  }
			 }
			 
			   $return_array = array(
					'cmd' =>'Slot Batch Listing',
					'status'=>'1',
					'response'=>$fac_slots,
					'response_messege' =>'Slot Batch Listing'
		           );
			 
     

      }
	  else{
	      $return_array = array(
			'cmd' =>'Slot Batch Listing',
			'status'=>'0',
			'response'=>$result_array,
			'response_messege' =>'parameter is missing'
		);
	  }
	  $output= json_encode($return_array);
	  echo trim($output,'"');
}


public function userbookingdetail(){
$result_array=array();
  if(isset($_REQUEST['batch_slot_id']) && isset($_REQUEST['start_date'])){
          $batch_slot_id=$_REQUEST['batch_slot_id'];
          $start_date=$_REQUEST['start_date'];
		 $booking_slot_detail=$this->FacilityMdl->order_user_detail($batch_slot_id,$start_date);
		 //echo($booking_slot_detail[0]->booking_order_id);
		 foreach ($booking_slot_detail as $key => $value) {
		 	 $booking_order_id = $value->booking_order_id;
		 	$slot_detail_array = $this->FacilityMdl->slot_detail_func($booking_order_id);
		 //	print_r($slot_detail_array);
		 	$booking_slot_detail[$key]->booking_slot_listing = $slot_detail_array;
		 	# code...
		 }
		 //print_r($booking_slot_detail);
		 if($booking_slot_detail)
		 {
				  $return_array = array(
					'cmd' =>'Booking Detail',
					'status'=>'1',
					'response'=>$booking_slot_detail,
					'response_messege' =>'Booking Detail Listing'
				); 
		 }
		 else{
		      $return_array = array(
					'cmd' =>'Booking Detail',
					'status'=>'0',
					'response'=>$result_array,
					'response_messege' =>'Booking Detail Not Found'
					);
		    
		  }
		 
  }
  else{
	      $return_array = array(
			'cmd' =>'Slot Batch  Listing',
			'status'=>'0',
			'response'=>$result_array,
			'response_messege' =>'parameter is missing'
		);
	  }
	  $output= json_encode($return_array);
	  echo trim($output,'"');
}






public function profile_status(){
	$return_array=array();
	if(isset($_REQUEST['user_id']))
	{
		
		    /*profile completion status*/
    $profile_percent1 = 0;
    $profile_percent2 = 0;
    $profile_percent3 = 0;
    $profile_percent4 = 0;
    $profile_percent5 = 0;
    $profile_percent6 = 0;
  
    $user_info=$this->CommonMdl->getRow('tbl_user','*',array('user_id'=>trim($_REQUEST['user_id'])));

    $user_facility=$this->CommonMdl->getResultByCond('tbl_facility',array('user_id'=>trim($_REQUEST['user_id'])),'fac_id','');
    if(count($user_facility)>0){
     $user_sport_count=$this->CommonMdl->fetchNumRows('tbl_facility_sport',array('fac_id'=>$user_facility[0]->fac_id),'');
    }
    $user_amenity_count=$this->CommonMdl->fetchNumRows('tbl_facility_amenities',array('user_id'=>trim($_REQUEST['user_id'])),'');
    $user_bank_info_count=$this->CommonMdl->fetchNumRows('tbl_user_bank_details',array('user_id'=>trim($_REQUEST['user_id'])),'');
    if($user_info->user_pincode!=''){
      $profile_percent1=5;
    }
     if($user_info->is_email_verified=='yes'){
      $profile_percent2=10;
    }
    if(count($user_facility)>0){
      $profile_percent3=30;
    }
     if($user_sport_count>0){
      $profile_percent4=20;
    }
    if($user_amenity_count>0){
      $profile_percent5=10;
    }
    if($user_bank_info_count>0){
      $profile_percent6=10;
    }

    // $data['fac_sports'] = $this->UserMdl->getFacSportList($fac_id);
     $profile_percent=15+$profile_percent1+$profile_percent2+$profile_percent3+$profile_percent4+$profile_percent5+$profile_percent6;
	   $profile_percent=array('profile_status'=>$profile_percent);
	   
		if($profile_percent){
			  $return_array = array(
					'cmd' =>'profile status  count',
					'status'=>'1',
					'response'=>$profile_percent,
					'response_messege' =>'profile status count'
		     );
		}
		else{
			   $return_array = array(
					'cmd' =>'profile status  count',
					'status'=>'0',
					'response'=>$return_array,
					'response_messege' =>'parameter is missing'
		     );
		  }

		
		
	
	
	}
  else{
	      $return_array = array(
			'cmd' =>'profile status  count',
			'status'=>'0',
			'response'=>$result_array,
			'response_messege' =>'parameter is missing'
		);
	  }
	  $output= json_encode($return_array);
	  echo trim($output,'"');
}

	

//facility_detail
function  facility_detail(){
$return_array=array();


           if(isset($_REQUEST['fac_id']))
			{
				$get_facility_data=$this->CommonMdl->getRow('tbl_facility','*',array('fac_id'=>$_REQUEST['fac_id']));
				$reward_achievement= $this->CommonMdl->getResultByCond('tbl_facility_reward_achievement',array('fac_id'=>$get_facility_data->fac_id),'*',$order_by='');
				
				$facility_list=$this->CommonMdl->getResultByCond('tbl_facility_timing',array('fac_id'=>$get_facility_data->fac_id),'*',$order_by='');
				
					
					 
				$get_facility_data->folder_name="fac";
				
				foreach($reward_achievement as $key=>$val){
					$reward_achievement[$key]->folder_name="rewards";
					
					 $facility_sport=$this->ApiMdl->getResultByCondratings($val->fac_id);
				      $get_facility_data->reward_achievement_list=$reward_achievement;
				      $get_facility_data->fac_timing_list=$facility_list;
				      $get_facility_data->facility_sport_list=$facility_sport;
					  
				}
				
                   if($get_facility_data){
					    $return_array = array(
							'cmd' =>'facility Detail',
							'status'=>'1',
							'response'=>$get_facility_data,
							'response_messege' =>'facility Detail Listing'
						 );
				   }
				   else{
					    $return_array = array(
							'cmd' =>'facility Detail',
							'status'=>'1',
							'response'=>$result_array,
							'response_messege' =>'facility Detail Listing'
						 ); 
					   
				   }
		
		
		

         }
		 else{
	      $return_array = array(
			'cmd' =>'facility Detail',
			'status'=>'0',
			'response'=>$return_array,
			'response_messege' =>'parameter is missing'
		 );
	  }
	  $output= json_encode($return_array);
	  echo trim($output,'"');
		   
		 		   
}

// facility_amenities
public function facility_amenities_listing(){
	
	 if(isset($_REQUEST['user_id']))
	 {
		  
		  $amenity_list = $this->CommonMdl->getResultByCond('tbl_facility_amenities',array('user_id'=>trim($_REQUEST['user_id'])),'*',$order_by='');
			 
			  if(!empty($amenity_list))
			  {
					$return_array = array(
					'cmd' =>'Facility Amenities',
					'status'=>'1',
					'response'=>$amenity_list,
					'response_messege' =>'Facility Amenities Listing'
				  );
				  
			  }
			  else{
				   $return_array = array(
					'cmd' =>'Facility Amenities',
					'status'=>'1',
					'response'=>$return_array,
					'response_messege' =>'Facility Amenities Listing'
				  );
				}
		  
		 
	 }
	 else{
	      $return_array = array(
			'cmd' =>'facility Detail',
			'status'=>'0',
			'response'=>$return_array,
			'response_messege' =>'parameter is missing'
		 );
	  }
	  $output= json_encode($return_array);
	  echo trim($output,'"');
	  
	  
}




//bank_detail
public function bank_detail(){
	$return_array=array();
       if(isset($_REQUEST['user_id']))
	 {
		 
		  $user_bank_details = $this->CommonMdl->getRow('tbl_user_bank_details','*',array('user_id'=>trim($_REQUEST['user_id'])));
		   $user_bank_details->folder_name="bankinfo";
			 
			  if(!empty($user_bank_details))
			  {
					$return_array = array(
					'cmd' =>'Bank Detail',
					'status'=>'1',
					'response'=>$user_bank_details,
					'response_messege' =>'Bank Detail Listing'
				  );
				  
			  }
			  else{
				   $return_array = array(
					'cmd' =>'Bank Detail',
					'status'=>'1',
					'response'=>$return_array,
					'response_messege' =>'Bank Detail Listing'
				  );
				}
		  
		 
	 }
	 else{
	      $return_array = array(
			'cmd' =>'Bank Detail',
			'status'=>'0',
			'response'=>$return_array,
			'response_messege' =>'parameter is missing'
		 );
	  }
	  $output= json_encode($return_array);
	  echo trim($output,'"');
	  
	  
	  
}


//user_profile_updated
public function user_profile_updated(){
	  $return_array=array();
       if(isset($_REQUEST['user_id']))
	 {
		 
		  $tbl_user_profile = $this->CommonMdl->getRow('tbl_user','*',array('user_id'=>trim($_REQUEST['user_id'])));
		 
		         if(!empty($tbl_user_profile))
					{
						$return_array = array(
						'cmd' =>'Facility Profile',
						'status'=>'1',
						'response'=>$tbl_user_profile,
						'response_messege' =>'Facility Profile Listing'
					  );
					  
					}
					else{
					   $return_array = array(
						'cmd' =>'Facility Profile',
						'status'=>'1',
						'response'=>$return_array,
						'response_messege' =>'Facility Profile Listing'
					  );
					}
		  
		 
	 }
	 else{
	      $return_array = array(
			'cmd' =>'Facility Profile',
			'status'=>'0',
			'response'=>$return_array,
			'response_messege' =>'parameter is missing'
		 );
	  }
	  $output= json_encode($return_array);
	  echo trim($output,'"');
	
	
}




public function notification_counts(){
	$return_array=array();
	if(isset($_REQUEST['fac_id']) && isset($_REQUEST['user_id']))
	{
		
		 if($_REQUEST['fac_id'] == 0){
		 $unread_notification=0;
	  }
	  else{
		  $unread_notification=$this->CommonMdl->fetchNumRows('tbl_notification',array('notification_status'=>'unread','fac_id'=>$_REQUEST['fac_id']),$cond1='');
	  }
	  
	  
	 
	 
     $unread_email_notification=$this->CommonMdl->fetchNumRows('tbl_email_notification',array('email_notification_status'=>'unread','user_id'=>$_REQUEST['user_id']),$cond1='');
	 $unread_notification=array('notification_count'=>$unread_notification,'email_alert_count'=>$unread_email_notification);
	   
	   $return_array = array(
			'cmd' =>'Notification Count',
			'status'=>'1',
			'response'=>$unread_notification,
			'response_messege' =>'Notification Count'
		 );
		 
    }
	else{
	      $return_array = array(
			'cmd' =>'Notification Count',
			'status'=>'0',
			'response'=>$return_array,
			'response_messege' =>'parameter is missing'
		 );
	  }
	  $output= json_encode($return_array);
	  echo trim($output,'"');
	  
	}






public function update_user_notification_status(){
	
	 if(isset($_REQUEST['fac_id']))
	  {
	  ///$tbl_notification=$this->CommonMdl->getResultByCond('tbl_email_notification',array('user_id'=>trim($_REQUEST['user_id'])),'*',$order_by='');
        $data=$this->CommonMdl->updateData(array('notification_status'=>'read'),array('fac_id'=>$_REQUEST['fac_id'],'notification_status'=>'unread'),'tbl_notification');
		if($data){
		$return_array = array(
			'cmd' =>'User Notification Status',
			'status'=>'1',
			'response'=>'success',
			'response_messege' =>'User Notification updated sucesfully'
		 );
		
		}
		else{
			$return_array = array(
			'cmd' =>'User Notification Status',
			'status'=>'0',
			'response'=>'faild',
			'response_messege' =>'Error occured'
		 );
		}
		
		
		}
	  else{
	      $return_array = array(
			'cmd' =>'User Notification Status',
			'status'=>'0',
			'response'=>$return_array,
			'response_messege' =>'parameter is missing'
		 );
	  }
	  $output= json_encode($return_array);
	  echo trim($output,'"');
}








public function update_email_alert_status(){
	
	 if(isset($_REQUEST['user_id']))
	  {
	  ///$tbl_notification=$this->CommonMdl->getResultByCond('tbl_email_notification',array('user_id'=>trim($_REQUEST['user_id'])),'*',$order_by='');
        $data=$this->CommonMdl->updateData(array('email_notification_status'=>'read'),array('user_id'=>$_REQUEST['user_id'],'email_notification_status'=>'unread'),'tbl_email_notification');
		if($data){
		$return_array = array(
			'cmd' =>'Email Notification Status',
			'status'=>'1',
			'response'=>'success',
			'response_messege' =>'Email Notification updated sucesfully'
		 );
		
		}
		else{
			$return_array = array(
			'cmd' =>'Email Notification Status',
			'status'=>'0',
			'response'=>'faild',
			'response_messege' =>'Error occured'
		 );
		}
		
		
		}
	  else{
	      $return_array = array(
			'cmd' =>'Email Notification Status',
			'status'=>'0',
			'response'=>$return_array,
			'response_messege' =>'parameter is missing'
		 );
	  }
	  $output= json_encode($return_array);
	  echo trim($output,'"');
}




public function facility_timing(){
	$return_array=array();
	if(isset($_REQUEST['fac_id']))
	{
		     $get_facility=$this->CommonMdl->getResultByCond(' tbl_facility_timing',array('fac_id'=>trim($_REQUEST['fac_id'])),'*',$order_by='');
			   if($get_facility!=''){
				 
				    $return_array = array(
					  'cmd'=>'Facility Timing',
					  'status'=>'1',
					  'response'=>$get_facility,
					  'response_messege'=>'Facility Timing Listing'
					);
			   }
	}
	else{
		 $return_array= array(
		    'cmd'=>'Facility Timing',
			'status'=>'0',
			'response'=>$return_array,
			'response_messege' => 'parameter is missing'
		 );
	}
	 $output= json_encode($return_array);
	 
	 echo trim($output,'"');
}





public function facility_listing_view(){
	$return_array=array();
	if(isset($_REQUEST['user_id']))
	{
	  $facility_list=$this->CommonMdl->getResultByCond('tbl_facility',array('user_id'=>$_REQUEST['user_id']),'*',$order_by='');
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
				 $facility_list;
				 
				if(!empty($facility_list)) {


				$return_array = array(
					'cmd' =>'login',
					'status'=>'1',
					'response'=>$facility_list,
					'response_messege' =>'Login successfull'
				);
				}
				else{
				$return_array = array(
					'cmd' =>'login',
					'status'=>'0',
					'response'=>$return_array,
					'response_messege' =>'Login email and password did not match'
				);
				}
				
				 
	}
	
	else{
		 $return_array= array(
		    'cmd'=>'Facility listing',
			'status'=>'0',
			'response'=>$return_array,
			'response_messege' => 'parameter is missing'
		 );
	}
	 $output= json_encode($return_array);
	 
	 echo trim($output,'"');
}




public function update_rating(){
$return_array= array();	
	  if(isset($_REQUEST['fac_id']) && isset($_REQUEST['rating_id'])){
    $date_arr = array(
      'report_abuse' => '1',
      'updated_on' => date("Y-m-d H:i:s"),
    );
    $whr = array('fac_id'=>$this->input->post('fac_id'),'rating_id'=>$this->input->post('rating_id'));
    $res=$this->CommonMdl->updateData($date_arr,$whr,'tbl_rating');
	
     // if()
  if($res){
	  $return_array= array(
		    'cmd'=>'Rating review list',
			'status'=>'1',
			'response'=>$return_array,
			'response_messege' => 'Rating review update succesfully'
		 );
  }
	
	}
	else{
		 $return_array= array(
		    'cmd'=>'Rating review list',
			'status'=>'0',
			'response'=>$return_array,
			'response_messege' => 'Rating review parameter missing'
		 );
	}
	 $output= json_encode($return_array);
	 
	 echo trim($output,'"');
	 
	
}




public function  email_verification(){
$return_array= array();	
	  if(isset($_REQUEST['user_id'])){
       
	    
		
		$user_id=$_REQUEST['user_id'];
  $email_verification_code = md5(uniqid(rand(), true));
  $email_date = array(
    'user_id' => $user_id,
    'verification_code' => $email_verification_code,
    'verification_type' => 'email',
    'expire_on' => date('Y-m-d H:i:s', strtotime('+2 day')),
    'created_on' => date("Y-m-d H:i:s")
  );
  $last_insert_email_id = $this->CommonMdl->insertRow($email_date,'tbl_user_verification');
  

  $whr= array('user_id'=>$user_id);
  $User_data = $this->CommonMdl->getResultByCond('tbl_user',$whr,'*',$order_by='');
  // print_data($data['user_data']);

  /*Email when genrate ref id*/
  $data['user_data'] = array('action' => 'email_verification','email' => $User_data[0]->user_email,'user_name' => $User_data[0]->user_name,'user_id' => $user_id,'verification_code' => $email_verification_code);

  
  $url= base_url('email_script.php');
  $handle = curl_init($url);
  curl_setopt($handle, CURLOPT_POST, true);
  curl_setopt($handle, CURLOPT_POSTFIELDS, $data['user_data']);
  $res=curl_exec($handle);          
  curl_close($handle);

 ob_clean();
 $return_array= array(
		    'cmd'=>'Email verifications',
			'status'=>'1',
			'response'=>'1',
			'response_messege' => 'Email verification sucesfully'
		 );
 
 
	
	}
	else{
		 $return_array= array(
		    'cmd'=>'Email varifications',
			'status'=>'0',
			'response'=>$return_array,
			'response_messege' => 'Email varification parameter'
		 );
	}
	 $output= json_encode($return_array);
	 
	 echo trim($output,'"');
	 
		
	
	
}





public function event_booking(){
	
	
	
$return_array=array();
$offset='0';
$limit=8;
$page='0';


	 if((trim(@$_REQUEST['fac_id'])))
	 {
		    
		 
		    if(isset($_REQUEST['page']) && $_REQUEST['page']!=''){
				     if(!isset($_REQUEST['start_date']) && !isset($_REQUEST['end_date']) && !isset($_REQUEST['sport_id']))
				          {

								$start_date=$_REQUEST['start_date'];
								$end_date=$_REQUEST['end_date'];
                                 $sport_id=$_REQUEST['sport_id'];
								$offset = $_REQUEST['page']*$limit;
								$fac_id=$_REQUEST['fac_id'];
								   
						 $get_booking_order=$this->ApiMdl->getResultByeventCond_date(trim($fac_id),trim($start_date),trim($end_date),trim($sport_id),trim($limit=''),trim($offset=''));
						//echo $this->db->last_query();
						 // print_r($get_booking_order);
						// die;
						// die;

						if($get_booking_order){
						 $n=0;
						 foreach($get_booking_order as $key=>$val){
							 
							 //print_r($get_booking_slot_detail);
							 // die;
							 if($val->booking_order_id == $prev_booking_order_id)
							 {
								//echo "yes";
							            $get_booking_slot_detail[$n-1][0]->booking_event_listing=$val;
								
							 }
							 else
							 {
								//echo "no"; 
									$get_booking_slot_detail[]=$this->ApiMdl->getResultByCond('tbl_booking_order',array('booking_order_id'=>trim($val->booking_order_id)),'*',$order_by='',$limit='',$offset='');	
									//echo $this->db->last_query();
									//print_r($get_booking_slot_detail);
									//echo "<br />";
									//echo($key);
									$get_booking_slot_detail[$n][0]->booking_event_listing=$val;
									$n++;
								
							 }
							$prev_booking_order_id=$val->booking_order_id;
							
							// $get_booking_order[$key]->booking_slot_listing=$get_booking_slot_detail;

							 
						 }
						 $limit=8;
						 $offset=$_REQUEST['page'];
						 $get_booking_slot_detail=array_slice($get_booking_slot_detail,$offset*$limit,$limit);
						 //$countArr1 = count($get_booking_slot_detail);
								/* for($c=$offset*$limit;$c<$limit;$c++)
								{
									//print_r($get_booking_slot_detail);
									$arrayLimit[] = $get_booking_slot_detail[$c];
								} */
						      $flat = array_merge(...$get_booking_slot_detail);
							 
							

									if($get_booking_slot_detail){
											 $return_array= array(
												'cmd' => 'Booking event listing',
												'status' =>'1',
												'response' =>$flat,
												'response_messege' =>'Booking event listing'
										);
								       
									}
									else{
											$return_array = array(
											'cmd' => 'Booking event listing',
											'status' =>'1',
											'response' =>$return_array,
											'response_messege' =>'Booking event listing'
											); 
									}
						}
						else{
								 $return_array = array(
									'cmd' => 'Booking event listing',
									'status' =>'1',
									'response' =>$return_array,
									'response_messege' =>'Booking event listing'
							); 
						}
				}
				else{
						$start_date='';
						$end_date='';
						$start_date=$_REQUEST['start_date'];
						$end_date=$_REQUEST['end_date'];
						$sport_id=$_REQUEST['sport_id'];
						$offset = $_REQUEST['page']*8;
						$fac_id=$_REQUEST['fac_id'];								   
						 $get_booking_order=$this->ApiMdl->getResultByeventCond_date(trim($fac_id),trim($start_date),trim($end_date),trim($sport_id),trim($limit=''),trim($offset=''));
						   // print_r($get_booking_order);
						  // print_data(array_merge(..$get_booking_order));
						 // echo $this->db->last_query();
						 
						
						if(count($get_booking_order)>0){
							
	
						 // echo $get_booking_order->booking_order_id;
						 // die;
						$n=0; 
						 foreach($get_booking_order as $key=>$val){
							
							 
							 // die;
							 if($val->booking_order_id ==$prev_booking_order_id)
							 {
								 
										// $get_booking_slot_detail[]=$this->CommonMdl->getResultByCond('tbl_booking_order',array('booking_order_id'=>trim($val->booking_order_id)),'*',$order_by='');
                           
                         				if(isset($_REQUEST['booking_type']) && $_REQUEST['booking_type']!=''){
											$countArr = $this->CommonMdl->getResultByCond('tbl_booking_order',array('booking_order_id'=>trim($val->booking_order_id),'booking_type'=>trim($_REQUEST['booking_type'])),'*',$order_by='');

										}else{
											$countArr = $this->CommonMdl->getResultByCond('tbl_booking_order',array('booking_order_id'=>trim($val->booking_order_id)),'*',$order_by='');
										}										
										

										if(count($countArr)!=0)
										{
												$get_booking_slot_detail[$n-1][0]->booking_slot_listing[]=$val;
										}
							 }
							 else
							 {
								 
						       if(isset($_REQUEST['booking_type']) && $_REQUEST['booking_type']!=''){
											$countArr = $this->CommonMdl->getResultByCond('tbl_booking_order',array('booking_order_id'=>trim($val->booking_order_id),'booking_type'=>trim($_REQUEST['booking_type'])),'*',$order_by='');

										}else{
											$countArr = $this->CommonMdl->getResultByCond('tbl_booking_order',array('booking_order_id'=>trim($val->booking_order_id)),'*',$order_by='');
										}										
										
						        //echo $this->db->last_query();
								if(count($countArr)!=0)
								{	
								if(isset($_REQUEST['booking_type']) && $_REQUEST['booking_type']!=''){
												$get_booking_slot_detail[] = $this->CommonMdl->getResultByCond('tbl_booking_order',array('booking_order_id'=>trim($val->booking_order_id),'booking_type'=>trim($_REQUEST['booking_type'])),'*',$order_by='');

											}else{
												$get_booking_slot_detail[] = $this->CommonMdl->getResultByCond('tbl_booking_order',array('booking_order_id'=>trim($val->booking_order_id)),'*',$order_by='');
											}										
										
										// echo $this->db->last_query();

										//print_r($get_booking_slot_detail);
										//print_r($get_booking_slot_detail);
										//echo "<br />";
										//echo($key);
										$get_booking_slot_detail[$n][0]->booking_event_listing=$val;
										$n++;
								}
							 }
							$prev_booking_order_id=$val->booking_order_id;
							
							// $get_booking_order[$key]->booking_slot_listing=$get_booking_slot_detail;

							 
						 }
							//$newArr=[];
						$limit=8;
						 $offset=$_REQUEST['page'];
						 $get_booking_slot_detail=array_slice($get_booking_slot_detail,$offset*$limit,$limit);
				$flat = array_merge(...$get_booking_slot_detail);

									if($get_booking_slot_detail){
										
											 $return_array = array(
												'cmd' => 'Booking event listing',
												'status' =>'1',
												'response' =>$flat,
												'response_messege' =>'Booking event listing'
										);
								       
									}
									else{
											$return_array = array(
											'cmd' => 'Booking event listing',
											'status' =>'1',
											'response' =>$return_array,
											'response_messege' =>'Booking listing'
											); 
									}
						}
						else{
								 $return_array = array(
									'cmd' => 'Booking event listing',
									'status' =>'1',
									'response' =>$return_array,
									'response_messege' =>'Booking listing'
							); 
						}
					
					
				}
			}
			else{
				  $return_array = array(
						'cmd' => 'Booking event listing',
						'status' => '0',
						'response' => '0',
						'response_messege' => 'page missing'
                  );
			}
		 
	 }
	 else{
			$return_array = array(
			'cmd' => 'Booking event listing',
			'status' =>'0',
			'response' =>'0',
			'response_messege' =>'parameter is missing'
			);
	 }
	$output = json_encode($return_array);
	echo trim($output,'"');
	
	
	}













}

?>
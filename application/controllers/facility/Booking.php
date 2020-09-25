<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends CI_Controller {

  public  function __construct()

  {
    parent::__construct();
    if(!$this->session->userdata('user_id')){
      redirect('login');
    }
    $this->load->model('public/FacilityMdl');

  }

  public function index(){
    $this->load->view('public/facility-dashboard/booking/BookingDetailView');
  }


  public function booking_detail(){
    $this->load->model('public/UserMdl');
    $fac_id = $this->input->post('fac_id');
    $data['fac_sports'] = $this->UserMdl->getFacSportList($fac_id);

    /*booking count*/


  $data['total_booking_count']=$this->CommonMdl->fetchNumRows('tbl_booking_slot_detail',array('fac_id'=>$fac_id),$cond1='');
   $data['total_confirmed_booking_count']=$this->CommonMdl->fetchNumRows('tbl_booking_slot_detail',array('fac_id'=>$fac_id,'booking_detail_status'=>'confirm' ),$cond1='');
   $data['total_pending_booking_count']=$this->CommonMdl->fetchNumRows('tbl_booking_slot_detail',array('fac_id'=>$fac_id,'booking_detail_status'=>'pending'),$cond1='');
   $data['total_rejected_booking_count']=$this->CommonMdl->fetchNumRows('tbl_booking_slot_detail',array('fac_id'=>$fac_id,'booking_detail_status'=>'rejected'),$cond1='');

    /**************/
    $html['_html'] = $this->load->view('public/facility-dashboard/booking/ajax/BookingView',$data,true);
    return $this->output->set_content_type('application/json')->set_output(json_encode($html));
  }

  public function booking_list_tabel(){
    $fac_id = $this->input->post('fac_id');

    if($this->input->post('action')=='booking_filter'){
      $start_date = '';
      $end_date = '';
      if($this->input->post('from_date')!=''){
       $start_date=date('Y-m-d', strtotime($this->input->post('from_date')));
     }
     if($this->input->post('to_date')!=''){
       $end_date=date('Y-m-d', strtotime($this->input->post('to_date')));
     }
     $sport_id=$this->input->post('sport_id');

     $data['booking_list'] = $this->FacilityMdl->getBookingList($fac_id,$start_date,$end_date,$sport_id,$this->input->post('booking_method'));
   } 
   else{
    $data['booking_list'] = $this->FacilityMdl->getBookingList($fac_id,$start_date='',$end_date='',$sport_id='','');
  }
  $html['_html'] = $this->load->view('public/facility-dashboard/booking/ajax/BookingListView',$data,true);
  return $this->output->set_content_type('application/json')->set_output(json_encode($html));
}

public function booking_view_model(){
  $order_id=$this->input->post('order_id');
  $data['order_main_detail'] = $this->CommonMdl->getRow('tbl_booking_order','*',array('booking_order_id'=>$order_id));
  $data['order_sub_detail'] = $this->CommonMdl->getResultByCond('tbl_booking_slot_detail',array('booking_order_id'=>$order_id),'*',$order_by='');
     // print_r($data['order_detail']);
  $html['_html'] = $this->load->view('public/facility-dashboard/booking/ajax/SingleBookingView',$data,true);
  return $this->output->set_content_type('application/json')->set_output(json_encode($html));
}


public function slot_batch_detail(){
 // print_data($_POST);
    $fac_id = $this->input->post('fac_id');
    $sport_id = $this->input->post('sport_id');
    $fac_type = $this->input->post('fac_type');
    //$day = $this->input->post('day');
  
    //echo $this->input->post('datetime'); die;

   // $day = date("D");

 $datetime=date('Y-m-d', strtotime($this->input->post('datetime')));
 $day=date('D', strtotime($this->input->post('datetime')));
    $data['datetime']= $datetime;
    if($fac_type=='facility'){
    $fac_slot['fac_slots']= $this->CommonMdl->getResultByCond('tbl_facility_batch_slot',array('fac_id'=>$fac_id,'sport_id'=>$sport_id,'start_date<='=>$datetime,'end_date>='=>$datetime),'*',$order_by='');
  //print_data($fac_slot['fac_slots']);
    foreach ($fac_slot['fac_slots'] as $fac_slot) {
      $slot_day['slot_day'] = $this->CommonMdl->getResultByCond('tbl_batch_slot_weekoff',array('batch_slot_id'=>$fac_slot->batch_slot_id,'batch_slot_weekoff_day'=>$day),'*',$order_by='');
      if(!empty($slot_day['slot_day'])){
        $data['fac_slots'][]=$fac_slot;
      }
    
    }
    
   
    $html['_html'] = $this->load->view('public/facility-dashboard/booking/ajax/SlotDetailView',$data,true);
    return $this->output->set_content_type('application/json')->set_output(json_encode($html));
    }

    if($fac_type=='academy'){
   $fac_slot['fac_slots']= $this->CommonMdl->getResultByCond('tbl_facility_batch_slot',array('fac_id'=>$fac_id,'sport_id'=>$sport_id,'start_date<='=>$datetime,'end_date>='=>$datetime),'*',$order_by='');
  //print_data($fac_slot['fac_slots']);
    foreach ($fac_slot['fac_slots'] as $fac_slot) {
      $slot_day['slot_day'] = $this->CommonMdl->getResultByCond('tbl_batch_slot_weekoff',array('batch_slot_id'=>$fac_slot->batch_slot_id,'batch_slot_weekoff_day'=>$day),'*',$order_by='');
      if(!empty($slot_day['slot_day'])){
        $data['fac_slots'][]=$fac_slot;
      }
    
    }
    $html['_html'] = $this->load->view('public/facility-dashboard/booking/ajax/BatchDetailView',$data,true);
    return $this->output->set_content_type('application/json')->set_output(json_encode($html));
    }

  }

  //public function availability_count_of_month(){
    //print_data($_POST);
    //  $fac_id = $this->input->post('fac_id');
     //$sport_id = $this->input->post('sport_id');
     //$year = $this->input->post('year');
     //$month = $this->input->post('month');
     //echo $year.'-'.$month;
     //echo date('Y-m', strtotime($year.'-'.$month));
   /*$date_array =['1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31'];*/
  //for ($i=1; $i <32 ; $i++) {
  //  $year_month = date('Y-m', strtotime($year.'-'.$month));
  // $slot_date =$year_month.'-'.$i;
 // $data['sport_slot_count'][]=$this->FacilityMdl->fetchslotNumrows($fac_id,$sport_id,$slot_date);
 // $data['sport_slot_booking_count'][]=$this->FacilityMdl->fetchslotbookingNumrows($fac_id,$sport_id,$slot_date);
 
//  }
 
  //echo  json_encode($data);
    

 // }

   public function availability_count_of_month(){
    //print_data($_POST);
	$fac_id = $this->input->post('fac_id');
	$sport_id = $this->input->post('sport_id');
	$year = $this->input->post('year');
	$month = $this->input->post('month');
	$fac_type = $this->input->post('fac_type');
	if($fac_type=='academy'){
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
		   $num_count = count($arr_count); 
		   $data['sport_slot_count'][]=$max_participanets;
		   $data['sport_slot_booking_count'][]=$sport_slot_booking_count;
		}
		echo  json_encode($data);
	 
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
		  $data['sport_slot_count'][]=count($arr_count);;
		  $data['sport_slot_booking_count'][]=$this->FacilityMdl->fetchslotbookingNumrows($fac_id,$sport_id,$slot_date);

		}
		echo  json_encode($data);
	}
    

  }


  public function offlinecheckout(){
    //print_data($_POST);
      if(isset($_POST['booking_date1'])){
           $booking_date1 = $this->input->post('booking_date1');
          $_SESSION['post_arr']=$_POST;
        }else{
            if(!empty($_SESSION['post_arr'])){
             $_POST=$_SESSION['post_arr'];
            }
        }
      

  	   if(isset($_POST['fac_type']) && $_POST['fac_type'] == 'facility'){
		    $data['fac_type']='facility';

        

        $booking_date1 = $this->input->post('booking_date1');
			foreach($booking_date1 as $date_val){	
				$batch_slot_id = $this->input->post($date_val);
				if($batch_slot_id!=''){
					$this->session->set_userdata(array('batch_slot_id' => $batch_slot_id,'fac_name' => $this->input->post('fac_name'),'fac_id' => $this->input->post('fac_id'),'package_id' => $this->input->post('package_id'),'booking_date' => $date_val));
				   // $data['slot_batch'][]= $this->CommonMdl->getResultwhere_by('tbl_facility_batch_slot','batch_slot_id',$this->session->userdata['batch_slot_id']);
				    $data['slot_batch'][$date_val][]= $this->CommonMdl->getResultwhere_by('tbl_facility_batch_slot','batch_slot_id',$this->session->userdata['batch_slot_id']);
				}
			}
			$this->load->view('public/facility-dashboard/booking/OfflineMultiCheckoutView',$data);
	   }else{
    // echo "string"; die;
      $this->session->unset_userdata('post_arr');
			$this->session->unset_userdata('fac_type');
			$batch_slot_id = $this->input->post('options');
			if(!empty($batch_slot_id)){
				$this->session->set_userdata(array('batch_slot_id' => $batch_slot_id,'fac_name' => $this->input->post('fac_name'),'fac_id' => $this->input->post('fac_id'),'package_id' => $this->input->post('package_id'),'booking_date' => $this->input->post('booking_date')));
			 }
			 $data['slot_batch']= $this->CommonMdl->getResultwhere_by('tbl_facility_batch_slot','batch_slot_id',$this->session->userdata['batch_slot_id']);
			$this->load->view('public/facility-dashboard/booking/OfflineCheckoutView',$data);
	  }
  }

   public function available_slots(){
    //print_r($_POST);

    $fac_id = $this->input->post('fac_id');
    $sport_id = $this->input->post('fac_sport');
    $fac_type = $this->input->post('fac_type');
    $datetime1=date('Y-m-d', strtotime( $this->input->post('date')));
    $data['fac_type'] = $fac_type;
    $data['date'] = $this->input->post('date');
    $data['fac_name'] = $this->input->post('fac_name');
    $data['sport_id'] = $this->input->post('fac_sport');
    $day = date('D', strtotime( $this->input->post('date')));
    if($fac_type=='facility'){
		for($k=0; $k<6; $k++){
					
			$datetime = date('Y-m-d', strtotime($datetime1. " + $k days")); 
			$day = date('D', strtotime($datetime));		
			$data['show_date'][] = $datetime; 
			$fac_slot1['fac_slots_batch']= $this->CommonMdl->getResultByCond('tbl_facility_batch_slot',array('fac_id'=>$fac_id,'sport_id'=>$sport_id,'start_date<='=>$datetime,'end_date>='=>$datetime),'*',$order_by='');
			foreach ($fac_slot1['fac_slots_batch'] as $fac_slot) {
			  $slot_day['slot_day'] = $this->CommonMdl->getResultByCond('tbl_batch_slot_weekoff',array('batch_slot_id'=>$fac_slot->batch_slot_id,'batch_slot_weekoff_day'=>$day),'*',$order_by='');
			  if(!empty($slot_day['slot_day'])){
				$data['fac_slots'][$k][]=$fac_slot;
			  }
			}
		}
	
  // echo "<pre>"; print_r($data['fac_slots']); die;
  }



  if($fac_type=='academy'){
   $datetime=date('Y-m-d', strtotime( $this->input->post('date')));
   $fac_slot['fac_slots_batch']= $this->CommonMdl->getResultByCond('tbl_facility_batch_slot',array('fac_id'=>$fac_id,'sport_id'=>$sport_id,'end_date>='=>$datetime,'start_date<='=>$datetime),'*',$order_by='');
  //print_data($fac_slot['fac_slots']);
    foreach ($fac_slot['fac_slots_batch'] as $fac_slot) {
      $slot_day['slot_day'] = $this->CommonMdl->getResultByCond('tbl_batch_slot_weekoff',array('batch_slot_id'=>$fac_slot->batch_slot_id,'batch_slot_weekoff_day'=>$day),'*',$order_by='');
      if(!empty($slot_day['slot_day'])){
        //echo "string";
        $data['fac_batch'][]=$fac_slot;
      }
    
    }
    //print_data($data['fac_batch']);
    $data['batch_package'] = $this->CommonMdl->getResultByCond('tbl_package',array('package_status'=>'active'),'package_id,package_name',$order_by='');

    }
    

    $html['_html'] = $this->load->view('public/facility-dashboard/booking/ajax/OfflineBookingModelView',$data,true);
    return $this->output->set_content_type('application/json')->set_output(json_encode($html));
  }

  public function offline_booking_checkout(){
	 
    $user_id = '';
	$user_id =  $this->input->post('user_id');

	$cond = array('user_mobile_no' => trim($this->input->post('countrycode').$this->input->post('phone')),'is_mobile_verified' => 'no');
          $res=$this->CommonMdl->fetchNumRows('tbl_user',$cond,'');

        $cond1 = array('user_email' =>$this->input->post('email') ,'is_mobile_verified' => 'no');
        $res1=$this->CommonMdl->fetchNumRows('tbl_user',$cond1,'');
         
        
         // echo $this->db->last_query(); die;
         if($res==1){
       $user_data = $this->CommonMdl->getResultByCond('tbl_user',array('user_mobile_no'=>trim($this->input->post('countrycode').$this->input->post('phone'))),'user_id',$order_by='');
       //echo $user_data[0]->user_id; die;
         $whr =  array('user_id' => $user_data[0]->user_id);
         $this->CommonMdl->deleteRecord('tbl_user_password_log',$whr);
         $this->CommonMdl->deleteRecord('tbl_user_verification',$whr);
         $this->CommonMdl->deleteRecord('tbl_user',$whr);
        }

        if($res1==1){
       $user_data = $this->CommonMdl->getResultByCond('tbl_user',array('user_email'=>$this->input->post('email')),'user_id',$order_by='');
       //echo $user_data[0]->user_id; die;
          $whr =  array('user_id' => $user_data[0]->user_id);
         $this->CommonMdl->deleteRecord('tbl_user_password_log',$whr);
         $this->CommonMdl->deleteRecord('tbl_user_verification',$whr);
         $this->CommonMdl->deleteRecord('tbl_user',$whr);
        }

        
   // print_data($_POST);
    $arr = explode(' ', $this->input->post('username'));
		//$booking_date =  date('Y-m-d', strtotime($this->input->post('booking_date')));
	if($this->input->post('booking_date')){
		$booking_date =  date('Y-m-d', strtotime($this->input->post('booking_date')));
		$book_type='academy';
	}else{
		$book_type='facility';
	}
      $pass = $arr[0].'@'.time();
  //die();
      if($user_id==''){
       $date_arr = array(
         'user_name' => $this->input->post('username'),
         'user_email' => $this->input->post('register_email'),
         'user_gender' => $this->input->post('gender'),
         'user_mobile_no' =>  trim($this->input->post('countrycode').$this->input->post('phone')),
         'user_password' => md5($pass),
         'user_city' => $this->input->post('city'),
         'user_address' => $this->input->post('address'),
         'user_country' => 'India',
         'user_role' => '1',
         'user_login_type' => '1',
         'is_mobile_verified' => 'yes',
         'is_email_verified' => 'yes',
         'user_status' => 'enable',
         'created_on' => date("Y-m-d H:i:s")
       );
       $user_id = $this->CommonMdl->insertRow($date_arr,'tbl_user');
       $emaildata = array('action' => 'offline_registration','email' => $this->input->post('register_email'),'user_name' => $this->input->post('username'),'password' => $pass);
       $this->sendmail($emaildata);
       }
     // print_data($date_arr);
if($user_id!=''){
	$booking_order_no = 'SSZ'.$user_id.time();
       $main_booking_arr = array(
         'booking_order_no' => $booking_order_no,
         'user_id' => $user_id,
         'name' => $this->input->post('username'),
         'email' => $this->input->post('register_email'),
         'mobile' => $this->input->post('phone'),
         'city' => $this->input->post('city'),
         'address' => $this->input->post('address'),
         'total_amount' => $this->input->post('total_amount'),
         'final_amount' => $this->input->post('total_amount'),
         'discount_amount' => 0,
         'payment_status' => 'success',
         'booking_type' => 'offline',
         'booking_status' => 'confirm',
        'payment_method' => $this->input->post('payment_type'),
         'updated_by_type' => 'faclility',
         'booking_on' => date("Y-m-d H:i:s"),
         'updated_on' => date("Y-m-d H:i:s"),
       );
       $last_booking_insert_id = $this->CommonMdl->insertRow($main_booking_arr,'tbl_booking_order');
      // print_data($_POST);
       for ($i=0; $i < count($this->input->post('batch_slot_ids')) ; $i++) { 
			if($book_type=='facility'){
				$booking_date = $this->input->post('batch_slot_date')[$i];
			}
         $sub_booking_arr[] = array(
          'booking_order_id' => $last_booking_insert_id,
          'fac_id' => $this->session->userdata['fac_id'],
          'batch_slot_id' => $this->input->post('batch_slot_ids')[$i],
          'sport_id' => $this->input->post('sport_id')[$i],
          'booking_detail_total_amount' => $this->input->post('slot_pkg_price')[$i],
          'booking_detail_final_amount' => $this->input->post('slot_pkg_price')[$i],
          'batch_slot_start_time' => $this->input->post('start_times')[$i],
          'batch_slot_end_time' => $this->input->post('end_times')[$i],
          'batch_slot_type_id' => $this->input->post('batch_slot_type_id')[$i],
          'package_id' => $this->input->post('package_id')[$i],
          'booking_order_id' => $last_booking_insert_id,
          'start_date' => $booking_date,
          'booking_detail_status' => 'confirm',
          'facility_approval' => 'enable',
          'created_on' => date("Y-m-d H:i:s"),
          'updated_on' => date("Y-m-d H:i:s"),
         );
		 
		 ## for email data-------
		 $slot_time= $this->input->post('start_times')[$i].'-'.$this->input->post('end_times')[$i];
		 $booking_detail_arr[]=array('booking_date'=>$booking_date,
			 'slot_time'=>$slot_time,
			 'price'=>$this->input->post('slot_pkg_price')[$i],
		 );
       }
       //print_data($booking_arr);
    $this->CommonMdl->insertinBatch($sub_booking_arr,'tbl_booking_slot_detail');
   $fac_detail = $this->CommonMdl->getRow('tbl_facility','fac_name, fac_type', array(
			'fac_id'=>$this->session->userdata['fac_id']));
			 $sport_detail = $this->CommonMdl->getRow('tbl_sport_list','sport_name', array(
			'sport_id'=>$this->input->post('sport_id')[0]));
	
			
    if($last_booking_insert_id){
		$emaildata = array('action' => 'offline_booking',
			'order_no' => $booking_order_no,
			'register_email' => $this->input->post('register_email'),
			'username' => $this->input->post('username'),
			'mobile' => $this->input->post('phone'),
			'city' => $this->input->post('city'),
			'fac_name' => $fac_detail->fac_name,
			'sport_name' => $sport_detail->sport_name,
			'address' => $this->input->post('address'),
			'booking_type' => 'offline',
			'total_amount' => $this->input->post('total_amount'),
			'final_amount' => $this->input->post('total_amount'),
			'booking_detail_arr' => serialize($booking_detail_arr)	
		);
        $this->sendmail($emaildata);
      echo "1";
    }
    else{
      echo "failed";
    }
  }
  }

public function sendmail($data){
  $url= base_url('email_script.php');
  $handle = curl_init($url);
  curl_setopt($handle, CURLOPT_POST, true);
  curl_setopt($handle, CURLOPT_POSTFIELDS, $data);
  $res=curl_exec($handle);          
  curl_close($handle);
}



/*Offline Booking Listing*/


public function offline_booking(){
  $this->load->view('public/facility-dashboard/booking/OfflineBookingDetailView');
}


public function offline_booking_detail(){
    $this->load->model('public/UserMdl');
    $fac_id = $this->input->post('fac_id');
    $data['fac_sports'] = $this->UserMdl->getFacSportList($fac_id);

    /*booking count*/


  $data['total_booking_count']=$this->CommonMdl->fetchNumRows('tbl_booking_slot_detail',array('fac_id'=>$fac_id),$cond1='');
   $data['total_confirmed_booking_count']=$this->CommonMdl->fetchNumRows('tbl_booking_slot_detail',array('fac_id'=>$fac_id,'booking_detail_status'=>'confirm'),$cond1='');
   $data['total_pending_booking_count']=$this->CommonMdl->fetchNumRows('tbl_booking_slot_detail',array('fac_id'=>$fac_id,'booking_detail_status'=>'pending'),$cond1='');
   $data['total_rejected_booking_count']=$this->CommonMdl->fetchNumRows('tbl_booking_slot_detail',array('fac_id'=>$fac_id,'booking_detail_status'=>'rejected'),$cond1='');

    /**************/
    $html['_html'] = $this->load->view('public/facility-dashboard/booking/ajax/OfflineBookingView',$data,true);
    return $this->output->set_content_type('application/json')->set_output(json_encode($html));
  }

    public function offline_booking_list_tabel(){
    $fac_id = $this->input->post('fac_id');

    if($this->input->post('action')=='booking_filter'){
      $start_date = '';
      $end_date = '';
      if($this->input->post('from_date')!=''){
       $start_date=date('Y-m-d', strtotime($this->input->post('from_date')));
     }
     if($this->input->post('to_date')!=''){
       $end_date=date('Y-m-d', strtotime($this->input->post('to_date')));
     }
     $sport_id=$this->input->post('sport_id');

     $data['booking_list'] = $this->FacilityMdl->getBookingList($fac_id,$start_date,$end_date,$sport_id,'offline');
   } 
   else{
    $data['booking_list'] = $this->FacilityMdl->getBookingList($fac_id,$start_date='',$end_date='',$sport_id='','offline');
  }
  $html['_html'] = $this->load->view('public/facility-dashboard/booking/ajax/BookingListView',$data,true);
  return $this->output->set_content_type('application/json')->set_output(json_encode($html));
}

public function filter_batch_by_package(){
   $package_id = $this->input->post('package_id');
   $fac_id = $this->input->post('fac_id');
  $sport_id = $this->input->post('sport_id');
   $datetime = date('Y-m-d', strtotime($this->input->post('date')));
   $day = date('D', strtotime($this->input->post('date')));

   $data['fac_type'] = $this->input->post('fac_type');
    $data['date'] = $this->input->post('date');
    $data['fac_name'] = $this->input->post('fac_name');
    $data['sport_id'] = $this->input->post('fac_sport');
    $data['package_id'] = $this->input->post('package_id');

 $fac_slot['fac_slots_batch']= $this->FacilityMdl->getBatchSlotByPackage($fac_id,$sport_id,$package_id,$datetime);
    foreach ($fac_slot['fac_slots_batch'] as $fac_slot) {
      $slot_day['slot_day'] = $this->CommonMdl->getResultByCond('tbl_batch_slot_weekoff',array('batch_slot_id'=>$fac_slot->batch_slot_id,'batch_slot_weekoff_day'=>$day),'*',$order_by='');
      if(!empty($slot_day['slot_day'])){
        //echo "string";
        $data['fac_batch'][]=$fac_slot;
      }
    
    }
  //  print_r($data['fac_batch']);

   $html['_html'] = $this->load->view('public/facility-dashboard/booking/ajax/BatchFilterView',$data,true);
  return $this->output->set_content_type('application/json')->set_output(json_encode($html));
}

public function user_data(){
   $data['user_data'] = $this->CommonMdl->getRow('tbl_user','*',array('user_mobile_no'=>trim($this->input->post('countrycode').$this->input->post('userphone')),'is_mobile_verified'=>'yes'));
  echo  json_encode($data);

}

public function UserBookingDetail(){
  //print_data($_POST);
  $batch_slot_id = $this->input->post('batch_slot_id');
  $start_date = $this->input->post('datetime');
  $data['order_user_detail'] = $this->FacilityMdl->order_user_detail($batch_slot_id,$start_date);
  $html['_html'] = $this->load->view('public/facility-dashboard/booking/ajax/UserBookingDetailView',$data,true);
  return $this->output->set_content_type('application/json')->set_output(json_encode($html));
}

public function UserBatchBookingDetail(){
  //print_data($_POST);
  $batch_slot_id = $this->input->post('batch_slot_id');
  $start_date = $this->input->post('datetime');
  $data['order_user_detail'] = $this->FacilityMdl->order_user_batch_detail($batch_slot_id,$start_date);
  $html['_html'] = $this->load->view('public/facility-dashboard/booking/ajax/UserBookingDetailView',$data,true);
  return $this->output->set_content_type('application/json')->set_output(json_encode($html));
}

public function order_user_detail($batch_slot_id,$start_date)
    {
      $this->db->select('to.*,tbs.*');
      $this->db->from('tbl_booking_slot_detail tbs');
      $this->db->join('tbl_booking_order to', 'to.booking_order_id = tbs.booking_order_id');
      $this->db->where(array('tbs.batch_slot_id'=>$batch_slot_id,'tbs.start_date'=>$start_date));

      //$this->db->group_by('tp.batch_slot_id');
      //$this->db->order_by('tfs.fac_sport_id','DESC');
      $query = $this->db->get();                                                     
      return $query->result();
    }


}
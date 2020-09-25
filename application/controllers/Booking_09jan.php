<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends CI_Controller {

    public  function __construct()

    {

   	    parent::__construct();
   	    $this->load->model('CommonMdl');
   	    $this->load->model('public/BookingMdl');
		if(empty($this->session->userdata('session_id'))){
			$session_id = session_id();
			$this->session->set_userdata('session_id',$session_id);
		}

	}

	public function index(){
		
		$book_fac_id=''; $book_sport_id=''; $book_sport_type='';
		if(!empty($this->session->userdata('user_id'))){
			$user_id = $this->session->userdata('user_id');
		}
		if($this->input->post('book_fac_id')){
			$book_fac_id = $this->input->post('book_fac_id');
			$this->session->set_userdata(array('book_fac_id' => $book_fac_id));
		}
		if($this->input->post('book_sport_id')){
			$book_sport_id = $this->input->post('book_sport_id');
			$this->session->set_userdata(array('book_sport_id' => $book_sport_id));
		}
		if($this->input->post('book_type')){
			$book_type = $this->input->post('book_type');
			$this->session->set_userdata(array('book_type' => $book_type));
		}
		//$this->session->set_userdata(array('book_fac_id' => '59','book_sport_id' => '4','book_type' => 'facility'));
		if(!empty($this->session->userdata('book_fac_id')) ){
			$book_fac_id = $this->session->userdata('book_fac_id');
			$book_sport_id = $this->session->userdata('book_sport_id');
			$book_type = $this->session->userdata('book_type');
			$data['book_fac_id'] = $book_fac_id;
			$data['book_sport_id'] = $book_sport_id;
			$data['book_type'] = $book_type;
			
			$data['fac_details'] = $this->CommonMdl->getRow('tbl_facility','*', array('fac_id'=>$this->session->userdata('book_fac_id')));
			$data['sport_details'] = $this->CommonMdl->getRow('tbl_sport_list','*', array('sport_id'=>$this->session->userdata('book_sport_id')));
			$data['cart_list_arr'] = $this->CommonMdl->getResultByCond('tbl_cart', array('sport_id'=>$this->session->userdata('book_sport_id'), 'fac_id'=>$this->session->userdata('book_fac_id'), 'session_id'=>$this->session->userdata('session_id')),'*');
			
			$datetime = date('Y-m-d'); 
			$day = date('D', strtotime($datetime));	
			$data['show_date'] = $datetime; 			
			$fac_slot1['fac_slots_batch']= $this->CommonMdl->getResultByCond('tbl_facility_batch_slot',array('fac_id'=>$book_fac_id,'sport_id'=>$book_sport_id,'start_date<='=>$datetime,'end_date>='=>$datetime),'*',$order_by='');
			foreach ($fac_slot1['fac_slots_batch'] as $fac_slot) {
			  $slot_day['slot_day'] = $this->CommonMdl->getResultByCond('tbl_batch_slot_weekoff',array('batch_slot_id'=>$fac_slot->batch_slot_id,'batch_slot_weekoff_day'=>$day),'*',$order_by='');
			  if(!empty($slot_day['slot_day'])){
				$data['fac_slots'][]=$fac_slot;
			  }
			}
			$data['sport_list'] = $this->BookingMdl->getFacSportList($this->session->userdata('book_fac_id'));

			$data['pacakge_list']= $this->CommonMdl->getResultByCond('tbl_package',array('package_status'=>'active'));
                 // print_data($data['pacakge_list']);

			$this->load->view('public/CartView',$data);
		}else{
			redirect(base_url());
		}
	
	}
	## get available slot list *******************************
	public function slots_available_list(){
		$data=array();
		
		$slected_date = $this->input->post('slected_date');
		$book_fac_id = $this->input->post('book_fac_id');
		$book_sport_id = $this->input->post('book_sport_id');
		$book_type = $this->input->post('book_type');
		//$data['facility_type'] = $book_type;
		$book_type = $this->CommonMdl->getRow('tbl_facility','fac_type', array('fac_id'=>$book_fac_id));
		$data['facility_type'] = $book_type->fac_type;
		if($this->input->post('package')!=''){
		$package_id = $this->input->post('package');
		}
		else{
			$package_id = '';
		}
		$data['package_id']=$package_id;
		if($slected_date!='' && $book_fac_id!='' && $book_sport_id!=''){
			$datetime = date('Y-m-d', strtotime($slected_date)); 
			$day = date('D', strtotime($datetime));	
			$data['show_date'] = $datetime;

			$fac_slot1['fac_slots_batch']= $this->CommonMdl->getResultByCond('tbl_facility_batch_slot',array('fac_id'=>$book_fac_id,'sport_id'=>$book_sport_id,'start_date<='=>$datetime,'end_date>='=>$datetime),'*',$order_by='');
			//echo $this->db->last_query();die();
			foreach ($fac_slot1['fac_slots_batch'] as $fac_slot) {
			  $slot_day['slot_day'] = $this->CommonMdl->getResultByCond('tbl_batch_slot_weekoff',array('batch_slot_id'=>$fac_slot->batch_slot_id,'batch_slot_weekoff_day'=>$day),'*',$order_by='');
			  if(!empty($slot_day['slot_day'])){
				$data['fac_slots'][]=$fac_slot;
			  }
			}
		}
		//print_data($data['fac_slots']);
		$html['_html'] = $this->load->view('public/user_ajax/AjaxSlotListCartView',$data,true);
		return $this->output->set_content_type('application/json')->set_output(json_encode($html));
	}
	
## slot addto cart here *******************************
	public function add_to_cart(){
		$package_id = '';
		//print_data($_POST);
		$data=array(); $user_id = '';
		if(!empty($this->session->userdata('user_id'))){
			$user_id = $this->session->userdata('user_id');
		}
		if(empty($this->session->userdata('session_id'))){
			$session_id = session_id();
			$this->session->set_userdata('session_id',$session_id);
		}
		$session_id = $this->session->userdata('session_id');
		$slected_date = $this->input->post('slected_date');
		$book_fac_id = $this->input->post('book_fac_id');
		$book_sport_id = $this->input->post('book_sport_id');
		$book_type = $this->input->post('book_type');
		$book_date = $this->input->post('book_date');
		$slots_batch_ids = $this->input->post('slots_batch_ids');
		$package_id = $this->input->post('package_id');
		$package_name = $this->input->post('package_name');
		//print_data($slots_batch_ids);
		if(count($slots_batch_ids)>0){
			foreach($slots_batch_ids as $batch_slot_id){

				$del_cond = array(
				 'session_id' => $session_id,
                 //'fac_id' => $book_fac_id,
                 //'sport_id' => $book_sport_id,
                 'batch_slot_id' => $batch_slot_id,
				 'book_date' => $book_date
               ); 
			 $this->CommonMdl->deleteRecord('tbl_cart',$del_cond);
				$detailsArr = $this->BookingMdl->slotsDetailById($batch_slot_id,$package_id);
				$cart_item_detail = array(
                 'user_id' =>$user_id,
                 'session_id' => $session_id,
                 'fac_id' => $book_fac_id,
                 'sport_id' => $book_sport_id,
                 'sport_type' => $book_type,
				 'book_date' => $book_date,
                 'batch_slot_id' => $batch_slot_id,
                 'package_id' => $package_id,
                 'package_name' => $package_name,
                 'slot_package_price' => @$detailsArr[0]->slot_package_price,
                 'start_time' => $detailsArr[0]->start_time,
                 'end_time' => $detailsArr[0]->end_time,
                 'is_kit_available' => @$detailsArr[0]->is_kit_available
               ); 
				$res[]= $this->CommonMdl->insertRow($cart_item_detail,'tbl_cart');
			}
			if(!empty($res)){
				$data['cart_list_arr'] = $this->CommonMdl->getResultByCond('tbl_cart', array('sport_id'=>$this->session->userdata('book_sport_id'), 'fac_id'=>$this->session->userdata('book_fac_id'), 'session_id'=>$this->session->userdata('session_id')),'*');
				$html['_html'] = $this->load->view('public/user_ajax/AjaxSideCartView',$data,true);
				return $this->output->set_content_type('application/json')->set_output(json_encode($html));
				//echo "Cart update successfully.";
			}

		}
		
	}
	
	## item remove to cart here *******************************
	public function remove_item_to_cart(){
		$cart_id = $this->input->post('cart_id');
		if($cart_id){
			$res = $this->CommonMdl->deleteRecord('tbl_cart',array('cart_id' => $cart_id));
			if($res){
				$data['cart_list_arr'] = $this->CommonMdl->getResultByCond('tbl_cart', array('sport_id'=>$this->session->userdata('book_sport_id'), 'fac_id'=>$this->session->userdata('book_fac_id'), 'session_id'=>$this->session->userdata('session_id')),'*');
				$html['_html'] = $this->load->view('public/user_ajax/AjaxSideCartView',$data,true);
				return $this->output->set_content_type('application/json')->set_output(json_encode($html));
			}
		}
	}
	
	## item remove to cart here *******************************
	public function checkout(){
		$data=array();
		if(empty($this->session->userdata('user_id'))){
			 $this->session->set_userdata(array('page_visit' => 'checkout'));
			 redirect('login');
		}
		$this->session->unset_userdata('page_visit');
		$user_id = $this->session->userdata('user_id');
		if(!empty($this->session->userdata('book_fac_id')) && !empty($this->session->userdata('book_sport_id')) ){
			$data['user_details'] = $this->CommonMdl->getRow('tbl_user','*', array('user_id'=>$user_id));
			$data['fac_details'] = $this->CommonMdl->getRow('tbl_facility','fac_name,fac_type', array('fac_id'=>$this->session->userdata('book_fac_id')));
			$data['sport_details'] = $this->CommonMdl->getRow('tbl_sport_list','sport_name,sport_id', array('sport_id'=>$this->session->userdata('book_sport_id')));
			$data['cart_list_arr'] = $this->CommonMdl->getResultByCond('tbl_cart', array('sport_id'=>$this->session->userdata('book_sport_id'), 'fac_id'=>$this->session->userdata('book_fac_id'), 'session_id'=>$this->session->userdata('session_id')),'*');
			$this->load->view('public/CheckoutView',$data);
		}else{
			redirect();
		}
	}
	
	## Slot booking function ********************************	
	public function booking_now(){
		if(!empty($this->session->userdata('user_id')) && !empty($this->session->userdata('book_fac_id')) && !empty($this->session->userdata('book_sport_id'))){
			$user_id=$this->session->userdata('user_id');
			$book_fac_id=$this->session->userdata('book_fac_id');
			$book_sport_id=$this->session->userdata('book_sport_id');
			$user_details = $this->CommonMdl->getRow('tbl_user','*', array('user_id'=>$user_id));
			$cart_list_arr = $this->CommonMdl->getResultByCond('tbl_cart', array('sport_id'=>$this->session->userdata('book_sport_id'), 'fac_id'=>$this->session->userdata('book_fac_id'), 'session_id'=>$this->session->userdata('session_id')),'*');
			 
			 $total_amount=0;
			foreach($cart_list_arr as $listVal){ 
				$total_amount = $total_amount+$listVal->slot_package_price;
			}
			 $booking_order_no = 'SSZ'.$user_id.time();
			 $book_data_arr = array(
				 'booking_order_no' => $booking_order_no,
				 'user_id' => $user_id,
				  'booking_for' => $cart_list_arr[0]->sport_type,
				 'name' => $user_details->user_name,
				 'email' => $user_details->user_email,
				 'mobile' => $user_details->user_mobile_no,
				 'city' => $user_details->user_city,
				 'address' => $user_details->user_address,
				 'total_amount' => $total_amount,
				 'final_amount' => $total_amount,
				 'payment_status' => 'pending',
				 'booking_type' => 'online',
				 'booking_status' => 'pending',
				 'payment_method' => 'online',
				 'booking_on' => date("Y-m-d H:i:s"),
				 'updated_on' => date("Y-m-d H:i:s"),
			 );
			 $insert_booking_id = $this->CommonMdl->insertRow($book_data_arr,'tbl_booking_order');
			 if($insert_booking_id){
				 foreach($cart_list_arr as $listVal){ 
					 $bs_type_detail=$this->BookingMdl->batchSlotTypeDetail($listVal->batch_slot_id);
					
					$slot_book_arr = array(
						  'booking_order_id' => $insert_booking_id,
						  'fac_id' => $listVal->fac_id,
						  'batch_slot_id' => $listVal->batch_slot_id,
						  'sport_id' => $book_sport_id,
						  'booking_detail_total_amount' => $listVal->slot_package_price,
						  'booking_detail_final_amount' => $listVal->slot_package_price,
						  'batch_slot_start_time' => $listVal->start_time,
						  'batch_slot_end_time' => $listVal->end_time,
						  'start_date' => $listVal->book_date,
						  'batch_slot_type_id' => @$bs_type_detail->batch_slot_type_id,
						  'batch_slot_type_name' => @$bs_type_detail->batch_slot_type,
						  'package_id' =>$listVal->package_id,
						  'package_name' =>$listVal->package_name,
						  'booking_detail_status' => 'confirm',
						  'facility_approval' => 'enable',
						  'created_on' => date("Y-m-d H:i:s"),
						  'updated_on' => date("Y-m-d H:i:s"),
					);
					$this->CommonMdl->insertRow($slot_book_arr,'tbl_booking_slot_detail');
					
					## for email data-------
					 $slot_time= $listVal->start_time .'-'.$listVal->end_time;
					 $booking_detail_arr[]=array('booking_date'=>$booking_date,
						 'slot_time'=>$slot_time,
						 'price'=>$listVal->slot_package_price,
					 );
				  }
				## set date into array for email sent ************ 
				$emaildata = array('action' => 'online_booking',
					'order_no' => $insert_booking_id,
					'register_email' => $user_details->user_email,
					'username' => $user_details->user_name,
					'mobile' => $user_details->user_mobile_no,
					'city' => $user_details->user_city,
					'address' => $user_details->user_address,
					'total_amount' => $total_amount,
					'final_amount' => $total_amount,
					'booking_detail_arr' => serialize($booking_detail_arr)	
				);
				
				$activitylogdata = array(
					'user_id' => $this->session->userdata['user_id'],
					'description' => 'One booking has been done - '.$booking_order_no,
					'url' => 'dashboard/user_booking',
					'activity_time'=>date('y-m-d H:i:s')
					);
					
					
				$this->sendmail($emaildata);
				
                ## sachin insert data				
				$this->CommonMdl->insertRow($activitylogdata,'tbl_user_activity_log');
				
				## Delete info into cart table************
				$this->CommonMdl->deleteRecord('tbl_cart', array('sport_id'=>$this->session->userdata('book_sport_id'), 'fac_id'=>$this->session->userdata('book_fac_id'), 'session_id'=>$this->session->userdata('session_id')));
				$data['booking_no']=$booking_order_no;
				$this->load->view('public/ThanksView',$data);
				//echo "Thanks you for booking."; 
			  }
		 
		}
	}
	
	
	## event checkout page *******************************
	public function event_checkout(){
		$data=array();
		if($this->input->post('book_event_id')){
			$book_event_id = $this->input->post('book_event_id');
			$this->session->set_userdata(array('book_event_id' => $book_event_id));
		}
		if(empty($this->session->userdata('user_id'))){
			 $this->session->set_userdata(array('page_visit' => 'event_checkout'));
			 redirect('login');
		}
		$this->session->unset_userdata('page_visit');
		
		if(!empty($this->session->userdata('book_event_id'))){
			$user_id = $this->session->userdata('user_id');
			$book_event_id = $this->session->userdata('book_event_id');
			$data['user_details'] = $this->CommonMdl->getRow('tbl_user','*', array('user_id'=>$user_id));
			$data['event_details'] = $this->CommonMdl->getRow(' tbl_event','*', array('event_id'=>$book_event_id));
			$data['fac_name'] = $this->BookingMdl->getFacNameById($data['event_details']->fac_id);
			//echo "<pre>"; print_r($data); exit;
			$this->load->view('public/EventCheckoutView',$data);
		}else{
			redirect();
		}	
	}
	
		
	## Event booking function ********************************	
	public function event_booking_now(){	
		if(!empty($this->session->userdata('user_id')) && !empty($this->session->userdata('book_event_id'))){
			$user_id=$this->session->userdata('user_id');
			$book_event_id=$this->session->userdata('book_event_id');
			$user_details = $this->CommonMdl->getRow('tbl_user','*', array('user_id'=>$user_id));
			$event_details = $this->CommonMdl->getRow(' tbl_event','*', array('event_id'=>$book_event_id));
			 
			 $booking_order_no = 'SSZ'.$user_id.time();
			 $book_data_arr = array(
				 'booking_order_no' => $booking_order_no,
				 'user_id' => $user_id,
				 'name' => $user_details->user_name,
				 'email' => $user_details->user_email,
				 'mobile' => $user_details->user_mobile_no,
				 'city' => $user_details->user_city,
				 'address' => $user_details->user_address,
				 'total_amount' => $event_details->event_price,
				 'final_amount' => $event_details->event_price,
				 'booking_for' => 'event',
				 'payment_status' => 'pending',
				 'booking_type' => 'online',
				 'booking_status' => 'pending',
				 'payment_method' => 'online',
				 'booking_on' => date("Y-m-d H:i:s"),
				 'updated_on' => date("Y-m-d H:i:s"),
			 );
			 $insert_booking_id = $this->CommonMdl->insertRow($book_data_arr,'tbl_booking_order');
			 if($insert_booking_id){
				$event_book_arr = array(
					  'booking_order_id' => $insert_booking_id,
					  'fac_id' => $event_details->fac_id,
					  'event_id' => $event_details->event_id,
					  'event_name' => $event_details->event_name,
					  'event_sport_id' => $event_details->sport_id,
					  'event_start_date' => $event_details->event_start_date,
					  'event_end_date' => $event_details->event_end_date,
					  'event_start_time' => $event_details->event_start_time,
					  'event_end_time' => $event_details->event_end_time,
					  'booking_detail_total_amount' => $event_details->event_price,
					  'booking_detail_discount' => '',
					  'booking_detail_final_amount' => $event_details->event_price,
					  'booking_detail_status' => 'confirm',
					  'facility_approval' => 'enable',
					  'created_on' =>  date("Y-m-d H:i:s"),
					  'updated_on' =>  date("Y-m-d H:i:s"),
					);
					$this->CommonMdl->insertRow($event_book_arr,'tbl_booking_event_detail');

					## set date into array for email sent ************ 
					$emaildata = array('action' => 'event_booking',
						'order_no' => $insert_booking_id,
						'register_email' => $user_details->user_email,
						'username' => $user_details->user_name,
						'mobile' => $user_details->user_mobile_no,
						'city' => $user_details->user_city,
						'address' => $user_details->user_address,
						'total_amount' => $event_details->event_price,
						'final_amount' => $event_details->event_price,
						'event_city' => $event_details->event_city,
					    'event_venue' => $event_details->event_venue,
						'event_name' => $event_details->event_name,
						'event_start_date' => $event_details->event_start_date,
						'event_end_date' => $event_details->event_end_date,
						'event_start_time' => $event_details->event_start_time,
						'event_end_time' => $event_details->event_end_time,
					);
					
					$activitylogdata = array(
					'user_id' => $this->session->userdata['user_id'],
					'description' => 'One event booking has been done - '.$booking_order_no,
					'url' => 'dashboard/user_booking/event',
					'activity_time'=>date('y-m-d H:i:s')
					);
					## sachin insert data				
				     $this->CommonMdl->insertRow($activitylogdata,'tbl_user_activity_log');
					 
					$this->sendmail($emaildata); 
					## Unset book_event_id here ************
					$this->session->unset_userdata('book_event_id');
					$data['booking_no']=$booking_order_no;
					$this->load->view('public/ThanksView',$data);
					//echo "Thanks you for booking."; 
			  }
	 
		}
	}
	
	## this function use for send emails *******************	
	public function sendmail($data){
		$url= base_url('email_script.php');
		$handle = curl_init($url);
		curl_setopt($handle, CURLOPT_POST, true);
		curl_setopt($handle, CURLOPT_POSTFIELDS, $data);
		$res=curl_exec($handle);          
		curl_close($handle);
		ob_clean();
	}

	public function apply_coupon(){
		
		$coupon = $this->CommonMdl->getRow('tbl_coupon','coupon_flat_amount', array(
			'coupon_code'=>$this->input->post('coupon_code'),
			'cart_min_amount<='=>$this->input->post('total_price'),
			'coupon_start_date<='=>date('Y-m-d'),
			'coupon_end_date>='=>date('Y-m-d')
		));
		//echo $this->db->last_query(); die;
		//print_data($coupon);
		if ($coupon) {
		echo $coupon->coupon_flat_amount;
		}
		else {
		echo "0";
		}
	}
	
	public function test(){
		$detailsArr = $this->BookingMdl->slotsDetailById(257);
		echo $detailsArr[0]->slot_package_price;
		echo $detailsArr[0]->start_time;
		echo $detailsArr[0]->end_time;
		echo $detailsArr[0]->is_kit_available;
		echo "<pre>"; print_r($detailsArr); die;
	}

}
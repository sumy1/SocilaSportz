<?php
header('Access-Control-Allow-Origin: *');
defined('BASEPATH') OR exit('No direct script access allowed');

class Searchlisting extends CI_Controller {

	public  function __construct()

	{

		parent::__construct();
		$this->load->model('public/SearchMdl');
		$this->load->model('public/UserMdl');
		$this->load->model('public/CommonMdl');

	}

	
	public function index(){
		$distanceInMile = 10;  // this value is in mile
		$type = '';
		$fac_latitude='';
		$fac_longitude='';
		$sport_id='';
		//$this->session->set_userdata(array('type' => $type));
		if(!empty($this->session->userdata('user_id'))){
			$user_id = $this->session->userdata('user_id');
			$user_details = $this->SearchMdl->get_result('tbl_user',array('user_id'=>$user_id));
			$fac_latitude=$user_details['user_latitude'];
			$fac_longitude=$user_details['user_longitude'];
			$this->session->set_userdata(array('fac_latitude' => $fac_latitude, 'fac_longitude' => $fac_longitude));
		}
		if($this->input->post('latitude')){
			$fac_latitude = $this->input->post('latitude');
			$this->session->set_userdata(array('fac_latitude' => $fac_latitude));
		}
		if($this->input->post('longitude')){
			$fac_longitude = $this->input->post('longitude');
			$this->session->set_userdata(array('fac_longitude' => $fac_longitude));
		}
		if($this->input->post('usercity')){
			$usercity = $this->input->post('usercity');
			$this->session->set_userdata(array('usercity' => $usercity));
		}
		
		if($this->input->post('sport_name')){
			$sport_id = $this->input->post('sport_name');
			$this->session->set_userdata(array('sport_id' => $sport_id));
		}
		if($this->input->post('type')){
			$type = $this->input->post('type');
			$this->session->set_userdata(array('type' => $type));
		}
		if(!empty($this->session->userdata('sport_id'))){
			if(!empty($this->session->userdata('fac_latitude')) && !empty($this->session->userdata('fac_longitude'))){
				$fac_latitude = $this->session->userdata('fac_latitude');
				$fac_longitude = $this->session->userdata('fac_longitude');
			}
			if(!empty($this->session->userdata('type'))){
				$type = $this->session->userdata('type');
			}
			$sport_id = $this->session->userdata('sport_id');
			if ($type!='event'){
				$condArr['sport_id']= $sport_id;
				$condArr['type']= $type;
				$condArr['distanceInMile']= $distanceInMile;
				$condArr['fac_latitude']= $fac_latitude;
				$condArr['fac_longitude']= $fac_longitude;
				$data['sport_id']= $sport_id;
				$data['type']= $type;
				$data['sport_name'] = $this->SearchMdl->getSportNameById($sport_id);
				$data['fac_data'] =$this->SearchMdl->getserchfacdata($condArr, $start=0, $limit = 12);
				$actual_query = explode('LIMIT',$this->db->last_query());
				$query = $this->db->query($actual_query[0]);
				$data['fac_data_count']= $query->num_rows();
				//$data['fac_data_count'] = $this->SearchMdl->getserchcountfacdata($condArr);
				//print_r($data['fac_data_count']);die;
				/*################Sports List############*/
				$data['sport_list'] =  $this->CommonMdl->getResultByCond('tbl_sport_list',array('sport_status'=>'enable'),'sport_id,sport_name',$order_by='');
				/*################Amenity List############*/
				$amenity_order_by = array('col_name'=>'amenity_name','order'=>'asc');
				$data['amenity_list'] = $this->CommonMdl->getResultByCond('tbl_amenity', array('amenity_status'=>'enable'), 'amenity_id,amenity_name,amenity_icon',$amenity_order_by);
				foreach ($data['fac_data'] as $key => $fac_data) {
					$facility_timing =  $this->CommonMdl->getResultByCond('tbl_facility_timing',array('fac_id'=>$fac_data->fac_id),'fac_id,day,open_time,close_time',$order_by='');

					$facility_sport =  $this->UserMdl->getFacSportList($fac_data->fac_id);
					$rating_count =  $this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>$fac_data->fac_id),'');

					$total_1_review=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>$fac_data->fac_id,'rating'=>'1'),'');
					$total_2_review=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>$fac_data->fac_id,'rating'=>'2'),'');
					$total_3_review=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>$fac_data->fac_id,'rating'=>'3'),'');
					$total_4_review=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>$fac_data->fac_id,'rating'=>'4'),'');
					$total_5_review=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>$fac_data->fac_id,'rating'=>'5'),'');
					$total_rating =($total_5_review*5) + ($total_4_review*4) + ($total_3_review*3) + ($total_2_review*2) + ($total_1_review*1);
					$avg_rating=0;
					if($rating_count>0) {$avg_rating= round($total_rating/$rating_count,1);}

					$data['fac_data'][$key]->timing=$facility_timing;
					$data['fac_data'][$key]->sport=$facility_sport;
					$data['fac_data'][$key]->rating_count=$rating_count;
					$data['fac_data'][$key]->avg_rating=$avg_rating;
					
				}
				
				$this->load->view('public/FacilityListView',$data);
			}else{
				
				$condArr['sport_id']= $sport_id;
				$condArr['type']= $type;
				$condArr['distanceInMile']= $distanceInMile;
				$condArr['fac_latitude']= $fac_latitude;
				$condArr['fac_longitude']= $fac_longitude;
				$data['sport_id'] = $sport_id;
				
				$data['event_data'] = $this->SearchMdl->getsercheventdata($condArr, $start=0, $limit = 12);
				$actual_query = explode('LIMIT',$this->db->last_query());
				$query = $this->db->query($actual_query[0]);
				$data['event_data_count']= $query->num_rows();
				//$data['event_data_count'] = $this->SearchMdl->getCountsercheventdata($condArr);
				$data['sport_name'] = $this->SearchMdl->getSportNameById($sport_id);
				/*################Sports List############*/
				$data['sport_list'] =  $this->CommonMdl->getResultByCond('tbl_sport_list',array('sport_status'=>'enable'),'sport_id,sport_name',$order_by='');
				/*################Amenity List############*/
				$amenity_order_by = array('col_name'=>'amenity_name','order'=>'asc');
				$data['amenity_list'] = $this->CommonMdl->getResultByCond('tbl_amenity', array('amenity_status'=>'enable'), 'amenity_id,amenity_name,amenity_icon',$amenity_order_by);
				foreach ($data['event_data'] as $key => $event_data) {
					$data['event_data'][$key]->amenities = $this->SearchMdl->getEventAmenities($event_data->event_id);
				}
				//echo "<pre>"; print_r($data['event_data']); die; 
				$this->load->view('public/EventListView',$data);
			}
			
		}else{
			redirect(base_url());
		}

	}
	
	public function apply_filter(){
		//echo "<pre>"; print_r($_POST); die;
		
		$distanceInMile = 10;  // this value is in mile
		$fac_latitude = $this->input->post('latitude');
		$fac_longitude = $this->input->post('longitude');
		$usercity = $this->input->post('usercity');
		$sport_id = $this->input->post('f_sport');
		if($this->input->post('fac_type')!=''){
			$type = $this->input->post('fac_type');
		}
		else{
			$type = 'facility';
		}
		if($this->input->post('start_limit')){
			$start = $this->input->post('start_limit');
		}else{
			$start=0;
		}
		$amenities_ids = $this->input->post('amenities_ids');
		$rating = $this->input->post('rating');
		$condArr['sport_id']= $sport_id;
		$condArr['type']= $type;
		$condArr['distanceInMile']= $distanceInMile;
		$condArr['fac_latitude']= $fac_latitude;
		$condArr['fac_longitude']= $fac_longitude;
		$condArr['amenities_ids']= $amenities_ids;
		$data['sport_id']= $sport_id;
		$data['usercity']= $usercity;
		$data['type']= $type;

		$this->session->set_userdata(array('sport_id' => $sport_id));
		$data['sport_name'] = $this->SearchMdl->getSportNameById($sport_id);
		$data['fac_data'] =$this->SearchMdl->getserchfacdata($condArr,$start, $limit = 12);
		$actual_query = explode('LIMIT',$this->db->last_query());
		$query = $this->db->query($actual_query[0]);
		$data['fac_data_count']= $query->num_rows();
		//$data['fac_data_count'] = $this->SearchMdl->getserchcountfacdata($condArr);
		foreach ($data['fac_data'] as $key => $fac_data) {


			$facility_timing =  $this->CommonMdl->getResultByCond('tbl_facility_timing',array('fac_id'=>$fac_data->fac_id),'fac_id,day,open_time,close_time',$order_by='');
			$facility_sport =  $this->UserMdl->getFacSportList($fac_data->fac_id);
			$rating_count =  $this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>$fac_data->fac_id),'');

			$total_1_review=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>$fac_data->fac_id,'rating'=>'1'),'');
			$total_2_review=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>$fac_data->fac_id,'rating'=>'2'),'');
			$total_3_review=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>$fac_data->fac_id,'rating'=>'3'),'');
			$total_4_review=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>$fac_data->fac_id,'rating'=>'4'),'');
			$total_5_review=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>$fac_data->fac_id,'rating'=>'5'),'');
			$total_rating =($total_5_review*5) + ($total_4_review*4) + ($total_3_review*3) + ($total_2_review*2) + ($total_1_review*1);
			$avg_rating=0;
			if($rating_count>0) {$avg_rating= round($total_rating/$rating_count,1);}

			$data['fac_data'][$key]->timing=$facility_timing;
			$data['fac_data'][$key]->sport=$facility_sport;
			$data['fac_data'][$key]->rating_count=$rating_count;
			$data['fac_data'][$key]->avg_rating=$avg_rating;	
		}
		
		## if select rating option *********
		if($rating!=''){ $filerData=array();
			foreach ($data['fac_data'] as $key => $fac_data) {
				if($fac_data->avg_rating>=$rating){
					$filerData[]=$fac_data;
				}
			}
			$data['fac_data']=array();
			$data['fac_data']=$filerData;
			$data['fac_data_count']= count($filerData);
		}
		//print_r($data['fac_data']);
		$html['_html']= $this->load->view('public/user_ajax/AjaxFacilityListView', $data, true);
		return $this->output->set_content_type('application/json')->set_output(json_encode($html));

		
	}
	
	public function apply_event_filter(){
		$distanceInMile = 10;  // this value is in mile
		$fac_latitude = $this->input->post('latitude');
		$fac_longitude = $this->input->post('longitude');
		$sport_id = $this->input->post('f_sport');
		$type = $this->input->post('fac_type');
		$amenities_ids = $this->input->post('amenities_ids');
		$rating = $this->input->post('rating');
		$condArr['sport_id']= $sport_id;
		$condArr['distanceInMile']= $distanceInMile;
		$condArr['fac_latitude']= $fac_latitude;
		$condArr['fac_longitude']= $fac_longitude;
		$condArr['amenities_ids']= $amenities_ids;
		$data['sport_id']= $sport_id;
		$data['type']= $type;
		if($this->input->post('start_limit')){
			$start = $this->input->post('start_limit');
		}else{
			$start=0;
		}
		
		$this->session->set_userdata(array('sport_id' => $sport_id));
		$data['event_data'] = $this->SearchMdl->getsercheventdata($condArr, $start, $limit = 12);
		$actual_query = explode('LIMIT',$this->db->last_query());
		$query = $this->db->query($actual_query[0]);
		$data['event_data_count']= $query->num_rows();

		//$data['event_data_count'] = $this->SearchMdl->getCountsercheventdata($condArr);
		$data['sport_name'] = $this->SearchMdl->getSportNameById($sport_id);
		/*################Sports List############*/
		$data['sport_list'] =  $this->CommonMdl->getResultByCond('tbl_sport_list',array('sport_status'=>'enable'),'sport_id,sport_name',$order_by='');
		/*################Amenity List############*/
		$amenity_order_by = array('col_name'=>'amenity_name','order'=>'asc');
		$data['amenity_list'] = $this->CommonMdl->getResultByCond('tbl_amenity', array('amenity_status'=>'enable'), 'amenity_id,amenity_name,amenity_icon',$amenity_order_by);
		foreach ($data['event_data'] as $key => $event_data) {
			$data['event_data'][$key]->amenities = $this->SearchMdl->getEventAmenities($event_data->event_id);
		}
		$html['_html']= $this->load->view('public/user_ajax/AjaxEventListView', $data, true);
		return $this->output->set_content_type('application/json')->set_output(json_encode($html));

		
	}

	public function search_detail($fac_slug){
		$this->session->unset_userdata('page_visit');
		$this->load->model('public/FacilityMdl');
		$data['facility_detail'] =  $this->CommonMdl->getRow('tbl_facility','*',array('fac_slug'=>$fac_slug));
		//print_data($data['facility_detail']);
		if(!empty($data['facility_detail'])>0){
			$order_by = array('col_name'=>'fac_timing_id','order'=>'asc');
			$data['facility_timing'] =  $this->CommonMdl->getResultByCond('tbl_facility_timing',array('fac_id'=>$data['facility_detail']->fac_id),'fac_id,day,open_time,close_time',$order_by);
			$data['facility_sport'] =  $this->UserMdl->getFacSportList($data['facility_detail']->fac_id);
			$data['facility_gallery'] =  $this->CommonMdl->getResultByCond('tbl_facility_gallery',array('fac_id'=>$data['facility_detail']->fac_id),'gallery_image',$order_by='');

			$data['rating_list'] =  $this->FacilityMdl->get_review_list($data['facility_detail']->fac_id,'','');

			foreach ($data['rating_list'] as $key => $rating_list) {
				$sport_id =  $this->CommonMdl->getRow('tbl_booking_slot_detail','sport_id',array('booking_order_id'=>$rating_list->booking_order_id));
				$sport_name =  $this->CommonMdl->getRow('tbl_sport_list','sport_name',array('sport_id'=>$sport_id->sport_id));

				$user_profile_image=$this->CommonMdl->getRow('tbl_user','user_profile_image',array('user_id'=>$rating_list->user_id));

				$data['rating_list'][$key]->sport_name= $sport_name;
				$data['rating_list'][$key]->user_profile_image= $user_profile_image;
			}
				//print_data($data['rating_list']);

			$data['user_listings']=$this->CommonMdl->getRow('tbl_user','user_profile_image',array('user_id'=>@$data['rating_list'][0]->user_id));
			

			$data['fac_achievement'] =  $this->CommonMdl->getResultByCond('tbl_facility_reward_achievement',array('fac_id'=>$data['facility_detail']->fac_id),'*',$order_by='');

			foreach ($data['fac_achievement'] as $key => $fac_achievement) {
				$fac_reward = $this->CommonMdl->getResultByCond('tbl_reward_achievement',array('reward_id'=>$fac_achievement->reward_id),'reward_name',$order_by='');
				$data['fac_achievement'][$key]->reward=$fac_reward;
			}

			$data['user_amenity'] = $this->CommonMdl->getResultByCond('tbl_facility_amenities',array('user_id'=>$data['facility_detail']->user_id),'amenity_id',$order_by='');
			foreach ($data['user_amenity'] as $key => $amenity) {
				$fac_amenity = $this->CommonMdl->getResultByCond('tbl_amenity',array('amenity_id'=>$amenity->amenity_id),'amenity_name,amenity_icon',$order_by='');
				$data['user_amenity'][$key]->amenity=$fac_amenity;
			}
			$data['rating_count'] =  $this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>$data['facility_detail']->fac_id),'');
			$total_1_review=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>$data['facility_detail']->fac_id,'rating'=>'1'),'');
			$total_2_review=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>$data['facility_detail']->fac_id,'rating'=>'2'),'');
			$total_3_review=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>$data['facility_detail']->fac_id,'rating'=>'3'),'');
			$total_4_review=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>$data['facility_detail']->fac_id,'rating'=>'4'),'');
			$total_5_review=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>$data['facility_detail']->fac_id,'rating'=>'5'),'');
			$total_rating =($total_5_review*5) + ($total_4_review*4) + ($total_3_review*3) + ($total_2_review*2) + ($total_1_review*1);
			$data['avg_rating']=0;
			if($data['rating_count']>0) {
				$data['avg_rating']= round($total_rating/$data['rating_count'],1);
			}
			//echo "<pre>"; print_r($data); exit;
			
			//$data['favourite_listing']=$this->CommonMdl->getRow('tbl_favourite',$clms='*',$whr='');
			$this->load->view('public/FacilityDetailView',$data);
		}
		else{
			redirect(base_url());
		}

	}

	public function enquireinsert(){
		$data_Arr=array(
			'user_id'=>$this->session->userdata('user_id'),
			'user_name'=>trim($this->input->post('username')),
			'user_email'=>trim($this->input->post('useremail')),
			'user_mobile'=>trim($this->input->post('userphone')),
			'fac_id'=>trim($this->input->post('fac_id')),
			'event_id'=>trim($this->input->post('event_id')),
			'query_title'=>trim($this->input->post('usersubject')),
			'query_message'=>trim($this->input->post('messagefield')),
			'create_on'=>date("Y-m-d H:i:s"),
			'update_on'=>date("Y-m-d H:i:s")
		);

		$res=$this->CommonMdl->insertRow($data_Arr,'tbl_user_query_to_facility');
		if($res){
			echo "1";
		}
		else{
			echo "failed";
		}
	}

	public function ratinginsert(){
		// echo $this->input->post('rating');
		// echo $this->input->post('rating_message');
		
		$dataArrrating=array(
			'user_id'=>$this->session->userdata('user_id'),
			'user_name'=>$this->session->userdata('user_name'),
			'user_email'=>$this->session->userdata('user_email'),
			'rating_type'=>'facility',
			'rating'=>trim($this->input->post('rating')),
			'fac_id'=>trim($this->input->post('fac_id')),
			'booking_order_id'=>trim($this->input->post('order_id_for_rating')),
			'created_on'=>date("Y-m-d H:i:s"),
			'updated_on'=>date("Y-m-d H:i:s")
		);
		  // print_data($dataArrrating);

		$last_id=$this->CommonMdl->insertRow($dataArrrating,'tbl_rating');
		if($last_id){
			echo "1";
		}
		else{
			echo "failed";
		}

		if(!empty($this->input->post("rating_message"))){
			$dataArrreview=array(
				'rating_id'=>trim($last_id),
				'review_message'=>trim($this->input->post("rating_message")),
			);
			$res=$this->CommonMdl->insertRow($dataArrreview,'tbl_review');
			if($res){
				echo "1";
			}
			else{
				echo "failed";
			}

		}
		
	}


	/*################Event Detail Page#############*/
	public function event_detail($event_slug){
		//$event_slug = 'footbal-event';

		$this->load->model('public/FacilityMdl');
		$data['event_detail'] =  $this->CommonMdl->getRow('tbl_event','*',array('event_slug'=>$event_slug));
		//print_data($data['facility_detail']);
		if(!empty($data['event_detail'])>0){
			
			$data['event_sport'] =  $this->CommonMdl->getRow('tbl_sport_list','sport_name,sport_icon,sport_id',array('sport_id'=>$data['event_detail']->sport_id));

			$data['event_gallery'] =  $this->CommonMdl->getResultByCond('tbl_event_gallery',array('event_id'=>$data['event_detail']->event_id,'admin_approval'=>'enable'),'image',$order_by='');

			
			$data['event_amenity'] = $this->CommonMdl->getResultByCond('tbl_event_amenities',array('event_id'=>$data['event_detail']->event_id),'amenity_id',$order_by='');
			foreach ($data['event_amenity'] as $key => $amenity) {
				$fac_amenity = $this->CommonMdl->getResultByCond('tbl_amenity',array('amenity_id'=>$amenity->amenity_id),'amenity_name,amenity_icon',$order_by='');
				$data['event_amenity'][$key]->amenity=$fac_amenity;
			}
			$data['booked_event_count']=$this->CommonMdl->fetchNumRows('tbl_booking_event_detail',array('event_id' => $data['event_detail']->event_id),$cond1='');
			//echo "<pre>"; print_r($data); exit;
			$this->load->view('public/EventDetailView',$data);
		}
		else{
			redirect(base_url());
		}
		
	}


	public function ajax_favourite_insert(){
		if(!empty($this->session->userdata['user_id'])){

			if($this->input->post('fav_id')!=''){

				$deleteRecord=$this->CommonMdl->deleteRecord('tbl_favourite',array('favourite_id'=>$this->input->post('fav_id')));
		//echo $this->db->last_query();
				if($deleteRecord){
					echo "0";
				}
			}else{
				$Arrfavourite=array(
					'fac_id'=>$this->input->post('fac_id'),
					'user_id'=>$this->session->userdata['user_id'],
					'created_on'=>date('Y-m-d H:i:s')
				);
				$res=$this->CommonMdl->insertRow($Arrfavourite,'tbl_favourite');

				if($res){
					echo $res;
				}else{
					echo "1";
				}
			}
		}
		else{
			$this->session->set_userdata(array('page_visit' => 'search_detail'));
			echo "2";
		}  
	}
	/*All Facility Listing*/
	public function facility(){
		$data['fac_data'] =$this->SearchMdl->getAllfacList('facility',$start=0,$limit=12);
		$actual_query = explode('LIMIT',$this->db->last_query());
		$query = $this->db->query($actual_query[0]);
		$data['fac_data_count']= $query->num_rows();
		/*################Sports List############*/
		$data['sport_list'] =  $this->CommonMdl->getResultByCond('tbl_sport_list',array('sport_status'=>'enable'),'sport_id,sport_name',$order_by='');
		/*################Amenity List############*/
		$amenity_order_by = array('col_name'=>'amenity_name','order'=>'asc');
		$data['amenity_list'] = $this->CommonMdl->getResultByCond('tbl_amenity', array('amenity_status'=>'enable'), 'amenity_id,amenity_name,amenity_icon',$amenity_order_by);
		foreach ($data['fac_data'] as $key => $fac_data) {
			$facility_timing =  $this->CommonMdl->getResultByCond('tbl_facility_timing',array('fac_id'=>$fac_data->fac_id),'fac_id,day,open_time,close_time',$order_by='');

			$facility_sport =  $this->UserMdl->getFacSportList($fac_data->fac_id);
			$rating_count =  $this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>$fac_data->fac_id),'');

			$total_1_review=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>$fac_data->fac_id,'rating'=>'1'),'');
			$total_2_review=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>$fac_data->fac_id,'rating'=>'2'),'');
			$total_3_review=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>$fac_data->fac_id,'rating'=>'3'),'');
			$total_4_review=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>$fac_data->fac_id,'rating'=>'4'),'');
			$total_5_review=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>$fac_data->fac_id,'rating'=>'5'),'');
			$total_rating =($total_5_review*5) + ($total_4_review*4) + ($total_3_review*3) + ($total_2_review*2) + ($total_1_review*1);
			$avg_rating=0;
			if($rating_count>0) {$avg_rating= round($total_rating/$rating_count,1);}

			$data['fac_data'][$key]->timing=$facility_timing;
			$data['fac_data'][$key]->sport=$facility_sport;
			$data['fac_data'][$key]->rating_count=$rating_count;
			$data['fac_data'][$key]->avg_rating=$avg_rating;

		}
		$data['page_title'] = "Facility";
		//print_data( $data['fac_data']);
		//echo "<pre>";
		//print_r($data); die;
		$this->load->view('public/FacilityListView',$data);

	}
	public function event(){

		$data['event_data'] = $this->SearchMdl->getAllEventList($start=0, $limit = 12);
		$actual_query = explode('LIMIT',$this->db->last_query());
		$query = $this->db->query($actual_query[0]);
		$data['event_data_count']= $query->num_rows();

		/*################Sports List############*/
		$data['sport_list'] =  $this->CommonMdl->getResultByCond('tbl_sport_list',array('sport_status'=>'enable'),'sport_id,sport_name',$order_by='');
		/*################Amenity List############*/
		$amenity_order_by = array('col_name'=>'amenity_name','order'=>'asc');
		$data['amenity_list'] = $this->CommonMdl->getResultByCond('tbl_amenity', array('amenity_status'=>'enable'), 'amenity_id,amenity_name,amenity_icon',$amenity_order_by);
		foreach ($data['event_data'] as $key => $event_data) {
			$data['event_data'][$key]->amenities = $this->SearchMdl->getEventAmenities($event_data->event_id);
		}
		$data['page_title'] = "Event";
				//echo "<pre>"; print_r($data['event_data']); die; 
		$this->load->view('public/EventListView',$data);
	}

}
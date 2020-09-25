<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public  function __construct()

    {

   	    parent::__construct();
   	    $this->load->model('public/UserMdl');
   	    $this->load->model('public/FacilityMdl');

	}

	public function index(){
		$this->session->unset_userdata('book_sport_id');
		$this->session->unset_userdata('sport_id');
		$this->session->unset_userdata('book_fac_id');
		$this->session->unset_userdata('usercity');
		$this->session->unset_userdata('fac_longitude');
		$this->session->unset_userdata('fac_latitude');
		/*################Sports############*/
		$data['sport_list'] =  $this->CommonMdl->getResultByCond('tbl_sport_list',array('sport_status'=>'enable'),'sport_id,sport_name',$order_by='');
		
		/*##############Banner##################*/
		$whr =  array('banner_status'=>'enable');
		$order_by = array('col_name'=>'banner_id','order'=>'desc');
		$data['banner'] =  $this->CommonMdl->getResultByCondLimit('tbl_home_banner',$whr,'banner_alt,banner_image',$order_by,$limit=5);

		/*#######Sports below the banner#######*/
		$sports_whr =  array('sport_status'=>'enable');
		$order_by = array('col_name'=>'home_sport_id','order'=>'desc');
		$data['sports'] =  $this->CommonMdl->getResultByCondLimit('tbl_home_sport',$sports_whr,'sport_id,icon_image,sport_image',$order_by,$limit=6);
		
		   foreach($data['sports'] as $key=>$val){
		     $data['sport_name']=$this->CommonMdl->getResultByCond('tbl_sport_list',array('sport_id'=>$val->sport_id),'sport_id,sport_name',$order_by='');
			 
              $data['sports'][$key]->sport_names=$data['sport_name']; 			 
		   }
		   // echo "<pre>";
		// print_r($data['sports']);

		/*#######Popular categories#######*/
		$popular_whr =  array('popular_status'=>'enable');
		$order_by = array('col_name'=>'popular_cat_id','order'=>'desc');
		$data['popular_cat'] =  $this->CommonMdl->getResultByCondLimit('tbl_home_popular_cat',$popular_whr,'popular_title,popular_icon,popular_hover_icon,popular_text,popular_url',$order_by,$limit=3);

		/*#######Popular categories#######*/
		$youtube_whr =  array('youtube_status'=>'enable');
		$order_by = array('col_name'=>'youtube_id','order'=>'desc');
		$data['youtube_data'] =  $this->CommonMdl->getResultByCondLimit('tbl_home_youtube',$youtube_whr,',youtube_id,youtube_title,youtube_link,youtube_text',$order_by,$limit=3);

			/*#######client categories#######*/
		$client_whr =  array('client_status'=>'enable');
		$order_by = array('col_name'=>'client_id','order'=>'desc');
		$data['client_data'] =  $this->CommonMdl->getResultByCondLimit('tbl_home_client',$client_whr,'client_title,client_logo',$order_by,$limit='');

		/*###########latest 6 facility#############*/
		$data['facility_data'] =  $this->FacilityMdl->getAllfacList('facility','3');
		//print_data($data['facility_data']);
		foreach ($data['facility_data'] as $key => $fac_data) {
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

			 $data['facility_data'][$key]->timing=$facility_timing;
			 $data['facility_data'][$key]->sport=$facility_sport;
			 $data['facility_data'][$key]->rating_count=$rating_count;
			 $data['facility_data'][$key]->avg_rating=$avg_rating;
			
		}


		/*###########latest 6 Academy#############*/
		$data['academy_data'] =  $this->FacilityMdl->getAllfacList('academy','3');
		//print_data($data['academy_data']);
		foreach ($data['academy_data'] as $key => $fac_data) {

			$academy_timing =  $this->CommonMdl->getResultByCond('tbl_facility_timing',array('fac_id'=>$fac_data->fac_id),'fac_id,day,open_time,close_time',$order_by='');
			//print_data($academy_timing);
			$academy_sport =  $this->UserMdl->getFacSportList($fac_data->fac_id);
			$rating_count =  $this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>$fac_data->fac_id),'');

		      $total_1_review=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>$fac_data->fac_id,'rating'=>'1'),'');
		      $total_2_review=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>$fac_data->fac_id,'rating'=>'2'),'');
		      $total_3_review=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>$fac_data->fac_id,'rating'=>'3'),'');
		      $total_4_review=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>$fac_data->fac_id,'rating'=>'4'),'');
		      $total_5_review=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>$fac_data->fac_id,'rating'=>'5'),'');
			$total_rating =($total_5_review*5) + ($total_4_review*4) + ($total_3_review*3) + ($total_2_review*2) + ($total_1_review*1);
			$avg_rating=0;
			 if($rating_count>0) {$avg_rating= round($total_rating/$rating_count,1);}

			 $data['academy_data'][$key]->timing=$academy_timing;
			 $data['academy_data'][$key]->sport=$academy_sport;
			 $data['academy_data'][$key]->rating_count=$rating_count;
			 $data['academy_data'][$key]->avg_rating=$avg_rating;
			
		}
		//print_data($data['academy_data']);
		/*###########latest 6 Event#############*/
		
		$data['event_data'] =  $this->FacilityMdl->getAllEventList('3');
//print_data($data['event_data']);
		foreach ($data['event_data'] as $key => $event_data) {
			$event_sport =  $this->CommonMdl->getResultByCond('tbl_sport_list',array('sport_id'=>$event_data->sport_id),'sport_name','');
			 $data['event_data'][$key]->sport=$event_sport;

			 $fac_name =  $this->CommonMdl->getRow('tbl_facility','fac_name',array('fac_id'=>$event_data->fac_id));
			$data['event_data'][$key]->fac_name=$fac_name;
		}

		//echo $this->db->last_query();die();
		//print_data($data['event_data']);
   		$this->load->view('public/HomeView',$data);

	}

	public function thanks(){
		$this->load->view('public/ThanksView');
	}

}
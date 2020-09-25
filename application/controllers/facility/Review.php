<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Review extends CI_Controller {

  public  function __construct()

  {
    parent::__construct();
    if(!$this->session->userdata('user_id')){
      redirect('login');
    }
    $this->load->model('public/FacilityMdl');

  }

    public function index(){
  
        $this->load->view('public/facility-dashboard/review/ReviewRatingView');
      }

	public function ajax_review_list(){
		
		
		$fac_id = $this->input->post('fac_id');
		$review_of = $this->input->post('review_of');
		$total_review_show = $this->input->post('total_review_show');
		if($fac_id!='' && $review_of!=''){
			$data['review_list'] = $this->FacilityMdl->get_review_list($fac_id, $review_of, $total_review_show);
			//echo "<pre>"; print_r($data['review_list']); exit;
			//$data['review_list']=$fac_id.$review_of;
			$html['_html'] = $this->load->view('public/facility-dashboard/review/ajax/ReviewListView',$data,true);
			return $this->output->set_content_type('application/json')->set_output(json_encode($html));
		}
		
	}

  public function review_count(){
    
    
    $fac_id = $this->input->post('fac_id');
    if($fac_id!='' ){
      $data['total_review']=$this->FacilityMdl->get_review_count($fac_id, '');
      $data['total_month_review']=$this->FacilityMdl->get_review_count($fac_id, 'month');
      $data['total_week_review']=$this->FacilityMdl->get_review_count($fac_id, 'week');
     

     /// $data['this_month_review']=$this->CommonMdl->fetchNumRows('tbl_booking_slot_detail',array('fac_id'=>$fac_id,'created_on'=>date("Y-m-d")),$cond1='');


      $html['_html'] = $this->load->view('public/facility-dashboard/review/ajax/ReviewCountView',$data,true);
      return $this->output->set_content_type('application/json')->set_output(json_encode($html));
    }
    
  }


  public function rating(){
    $fac_id = $this->input->post('fac_id');
    if($fac_id!='' ){
      $data['total_review']=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>$fac_id),'');
      $data['total_1_review']=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>$fac_id,'rating'=>'1'),'');
      $data['total_2_review']=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>$fac_id,'rating'=>'2'),'');
      $data['total_3_review']=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>$fac_id,'rating'=>'3'),'');
      $data['total_4_review']=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>$fac_id,'rating'=>'4'),'');
      $data['total_5_review']=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>$fac_id,'rating'=>'5'),'');
      //print_r($data['total_1_review']);
      //$data['total_review']=$this->CommonMdl->fetchNumRows($fac_id, '');
      $html['_html'] = $this->load->view('public/facility-dashboard/review/ajax/RatingView',$data,true);
      return $this->output->set_content_type('application/json')->set_output(json_encode($html));
    }
    
  }
  public function update_rating(){
     $date_arr = array(
      'report_abuse' => '1',
      'updated_on' => date("Y-m-d H:i:s"),
    );
    $whr = array('rating_id'=>$this->input->post('rating_id'));
    $res=$this->CommonMdl->updateData($date_arr,$whr,'tbl_rating');
    if($res){
      echo "1";
    } 
    else{
      echo "failed";
    }


     }


}
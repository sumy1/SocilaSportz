<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {

public  function __construct(){
	parent::__construct();
	$this->load->model('CommonMdl');
	$this->load->model('admin/AdminMdl');
}

	public function index(){
		$order_by=array('col_name'=>'','order'=>'desc');
		$data['careerdata']=$this->CommonMdl->getResultOrderBy('tbl_career','*',$order_by);
		$this->load->view('admin/page/CareerListView',$data);
	}
	public function usercareerexport(){
		$order_by=array('col_name'=>'','order'=>'desc');
		$data['careerdata']=$this->CommonMdl->getResultOrderBy('tbl_career','*',$order_by);
		$this->load->view('admin/page/Excelpage/PageExcelView',$data);
	}
	public function contactlisting(){
		$start_date = '';
		$end_date = '';
		$status = '';
		if($this->input->post('action')=='fac_filter'){
			if($this->input->post('start_date')!=''){ 
				$start_date=date('Y-m-d', strtotime($this->input->post('start_date')));
				$data['start_date']=$this->input->post('start_date');
			}if($this->input->post('end_date')!=''){
				 $end_date=date('Y-m-d', strtotime($this->input->post('end_date')));
				 $data['end_date']=$this->input->post('end_date');
			 }/* if($this->input->post('select_stat')!=''){
			   $status=$this->input->post('select_stat');
			 } */
		$data['contactdata']=$this->AdminMdl->getResultByquery($start_date,$end_date,$status);
		}else{
		 $data['contactdata']=$this->AdminMdl->getResultByquery($start_date,$end_date,$status);
		 // print_data($data);
		 
		}
		$this->load->view('admin/page/ContactListView',$data);
	  
	}
	public function changeuserstatus(){
		$dataArr = array(
			 'approve_status'=>$this->input->post('user_status'),
		  );
		  $res=$this->CommonMdl->updateData($dataArr,array('query_id'=>trim($this->input->post('query_id'))),' tbl_user_query');
		 if($res == 1){
			  echo "1";
		  }else{
			  echo "0";
		  }
	}
	
	public function exportdatacontact(){

		$start_date = '';
		$end_date = '';
		$status = '';
		if($this->input->post('action')=='contact_filter'){
			if($this->input->post('start_date')!=''){ 
				$start_date=date('Y-m-d', strtotime($this->input->post('start_date')));
				$data['start_date']=$this->input->post('start_date');
			}if($this->input->post('end_date')!=''){
				 $end_date=date('Y-m-d', strtotime($this->input->post('end_date')));
				 $data['end_date']=$this->input->post('end_date');
			 }
		$data['contactdata']=$this->AdminMdl->getResultByquery($start_date,$end_date,$status);
		
		}else{
		 $data['contactdata']=$this->AdminMdl->getResultByquery($start_date,$end_date,$status);
		 
		}
		//print_data($data);
	  $this->load->view('admin/page/Excelpage/PageExcelView',$data);
	
	}
	public function enquirelisting(){
		$order_by=array('col_name'=>'query_id','order'=>'desc');
		$start_date = '';
		$end_date = '';
		$status = '';
		if($this->input->post('action')=='fac_filter'){
			if($this->input->post('start_date')!=''){ 
				$start_date=date('Y-m-d', strtotime($this->input->post('start_date')));
				$data['start_date']=$this->input->post('start_date');
			}if($this->input->post('end_date')!=''){
				 $end_date=date('Y-m-d', strtotime($this->input->post('end_date')));
				 $data['end_date']=$this->input->post('end_date');
			 }if($this->input->post('select_stat')!=''){
			   $status=$this->input->post('select_stat');
			 }
		$data['enquiredata']=$this->AdminMdl->getResultByenquire($start_date,$end_date,$status);
		}else{
		$data['enquiredata']=$this->AdminMdl->getResultByenquire($start_date,$end_date,$status);
		}
	$this->load->view('admin/page/EnquireListView',$data);
	}
	 public function enquirechangestatus(){
		$dataArr = array(
			 'approve_status'=>$this->input->post('user_status'),
		  );
		  $res=$this->CommonMdl->updateData($dataArr,array('query_id'=>trim($this->input->post('query_id'))),'  tbl_user_query_to_facility');
		 if($res == 1){
			  echo "1";
		  }else{
			  echo "0";
		  }
	}
	public function exportdataenquire(){
	
		$start_date = '';
		$end_date = '';
		$status = '';
		if($this->input->post('action')=='contact_filter'){
			if($this->input->post('start_date')!=''){ 
				$start_date=date('Y-m-d', strtotime($this->input->post('start_date')));
				$data['start_date']=$this->input->post('start_date');
			}if($this->input->post('end_date')!=''){
				 $end_date=date('Y-m-d', strtotime($this->input->post('end_date')));
				 $data['end_date']=$this->input->post('end_date');
			 }if($this->input->post('select_stat')!=''){
			   $status=$this->input->post('select_stat');
			 }
		$data['enquiredata']=$this->AdminMdl->getResultByenquire($start_date,$end_date,$status);
		
		}else{
		 $data['enquiredata']=$this->AdminMdl->getResultByenquire($start_date,$end_date,$status);
		 
		}
		// print_data($data);
	  $this->load->view('admin/page/Excelpage/PageExcelView',$data);
	  
	  
	}
 
}




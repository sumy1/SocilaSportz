<?php
//ini_set('display_error',1);
defined('BASEPATH') OR exit('No direct script access allowed');

class Slot extends CI_Controller {

    public  function __construct()

    {
   	    parent::__construct();
   	    if(!$this->session->userdata('user_id')){
            redirect('login');
        }
        $this->load->model('public/FacilityMdl');
       
	}

	public function index(){
		$this->load->view('public/facility-dashboard/CreateSlotView');
	}


	public function slot_form(){
		//print_r($_POST);
		$this->load->model('public/UserMdl');

		if($this->input->post('action') =='fac_slot_div')
  {
  	$fac_id = $this->input->post('fac_id');
  	//echo "string";
  $data['fac_details'] = $this->CommonMdl->getRow('tbl_facility','fac_id,fac_name,fac_type',array('fac_id'=>$fac_id));
  $data['fac_sports'] = $this->UserMdl->getFacSportList($fac_id);
  $data['batch_slot_type'] = $this->CommonMdl->getResultByCond('tbl_batch_slot_type',array('batch_slot_type_status'=>'active'),'batch_slot_type_id,batch_slot_type',$order_by='');

  $data['batch_package'] = $this->CommonMdl->getResultByCond('tbl_package',array('package_status'=>'active'),'package_id,package_name',$order_by='');
  $data['week_days'] = $this->CommonMdl->getResultByCond('tbl_facility_timing',array('fac_id'=>$fac_id),'day',$order_by='');


 // print_r($data['batch_slot_type']);
  	$html['_html'] = $this->load->view('public/facility-dashboard/ajax/FacCreateSlotView',$data,true);
   return $this->output->set_content_type('application/json')->set_output(json_encode($html));
	}
}

public function slotListingcount(){
		//print_r($_POST);	
  	$fac_id = $this->input->post('fac_id');

$data['total_slot_count']=$this->CommonMdl->fetchNumRows('tbl_facility_batch_slot',array('fac_id'=>$fac_id),$cond1='');
 $data['total_active_count']=$this->CommonMdl->fetchNumRows('tbl_facility_batch_slot',array('fac_id'=>$fac_id,'fac_batch_slot_status'=>'active'),$cond1='');
 $data['total_inactive_count']=$this->CommonMdl->fetchNumRows('tbl_facility_batch_slot',array('fac_id'=>$fac_id,'fac_batch_slot_status'=>'inactive'),$cond1='');
	echo  json_encode($data);
}

public function create_slot(){
	//echo "<pre>";
	//print_r($this->input->post('day0')); die();


			for($i=0; $i<count($this->input->post('slotstartdate')); $i++) {
					if($this->input->post('kit_aval')[$i]=='on'){
						$kit_aval = 'yes';
						$kit_price = $this->input->post('kitprice')[$i];
					}
					else{
						$kit_aval = 'no';
						$kit_price = '';
					}
			$add_fac_slot = array(
			'fac_id'=>$this->input->post('fac_name'),
			'sport_id'=>$this->input->post('sportslist'),
			'batch_slot_type_id'=>$this->input->post('label_name')[$i],
			'start_date'=>date('Y-m-d', strtotime($this->input->post('slotstartdate')[$i])),
			'end_date'=>date('Y-m-d', strtotime($this->input->post('slotenddate')[$i])),
			'start_time'=>$this->input->post('slotstarttime')[$i],
			'end_time'=>$this->input->post('slotendtime')[$i],
			'is_kit_available'=>$kit_aval,
			'kit_price'=>$kit_price,
			'max_participanets'=>$this->input->post('max_participanets')[$i],
			'court_type'=>$this->input->post('court_type')[$i],
			'court_description'=>$this->input->post('court_desc')[$i],
			'fac_batch_slot_status'=>'active',
			'create_on'=>date("Y-m-d H:i:s"),
			'update_on'=>date('Y-m-d H:i:s'),
			);
			///print_data($add_fac_slot);die();
			$fac_slot_id = $this->CommonMdl->insertRow($add_fac_slot,'tbl_facility_batch_slot');

			$add_fac_slot_price = array(
			'batch_slot_id'=>$fac_slot_id,
			'slot_package_price'=>$this->input->post('slotprice')[$i],
			'created_on'=>date("Y-m-d H:i:s"),
			);
			///print_data($add_fac_slot);die();
		$this->CommonMdl->insertRow($add_fac_slot_price,'tbl_slot_package_price');

			if($fac_slot_id){
				for($j=0; $j<count($this->input->post('day'.$i)); $j++) { 
					$add_weekoff_slot = array(
			'batch_slot_id'=>$fac_slot_id,
			'batch_slot_weekoff_day'=>$this->input->post('day'.$i)[$j],
			'created_by'=>$this->session->userdata('user_id'),
			'updated_by'=>$this->session->userdata('user_id'),
			'created_on'=>date("Y-m-d H:i:s"),
			'updated_on'=>date('Y-m-d H:i:s')
			);
					$res = $this->CommonMdl->insertRow($add_weekoff_slot,'tbl_batch_slot_weekoff');
				}
				echo "1";
			}
			else{
				echo "failed";
			}
			}

			//print_data($add_fac_slot);
					

}

public function slotListing(){
	
		$order_by = array('col_name'=>'batch_slot_id','order'=>'desc');

	if($this->input->post('action')=='slot_filter'){
		$start_date = '';
		$end_date = '';
		if($this->input->post('from_date')!=''){
		$start_date=date('Y-m-d', strtotime($this->input->post('from_date')));
		}
		if($this->input->post('to_date')!=''){
		$end_date=date('Y-m-d', strtotime($this->input->post('to_date')));
		}
		$sport_id=$this->input->post('sport_id');
		
 	$data['slotListing'] = $this->FacilityMdl->getResultBycond('tbl_facility_batch_slot',array(
			'fac_id'=>$this->input->post('fac_id')),'*',$order_by,$sport_id,$start_date,$end_date);
 } 
	else{
		$data['slotListing'] = $this->CommonMdl->getResultBycond('tbl_facility_batch_slot',array('fac_id'=>$this->input->post('fac_id')),'*',$order_by,$sport_id='',$start_date='',$end_date='');
	}
		
		$html['_html'] = $this->load->view('public/facility-dashboard/ajax/SlotListingTableView',$data,true);
  		 return $this->output->set_content_type('application/json')->set_output(json_encode($html));
	}	


	

	public function slot_edit_model(){
		$this->load->model('public/UserMdl');
		$data['fac_name'] = $this->input->post('fac_name');
		$data['fac_id'] = $this->input->post('fac_id');
		$data['slot_details'] = $this->CommonMdl->getRow('tbl_facility_batch_slot','*',array('batch_slot_id'=>$this->input->post('slot_id')));
		$data['fac_sports'] = $this->UserMdl->getFacSportList($this->input->post('fac_id'));
		$data['batch_slot_type'] = $this->CommonMdl->getResultByCond('tbl_batch_slot_type',array('batch_slot_type_status'=>'active'),'batch_slot_type_id,batch_slot_type',$order_by='');
		$data['week_days'] = $this->CommonMdl->getResultByCond('tbl_facility_timing',array('fac_id'=>$this->input->post('fac_id')),'day',$order_by='');
		 $data['slot_week_days'] = $this->CommonMdl->getResultByCond('tbl_batch_slot_weekoff',array('batch_slot_id'=>$data['slot_details']->batch_slot_id),'batch_slot_weekoff_day',$order_by='');
		$data['slot_price'] = $this->CommonMdl->getRow('tbl_slot_package_price','slot_package_price',array('batch_slot_id'=>$data['slot_details']->batch_slot_id));
		//print_r($data['slot_week_days']);

		 $html['_html'] = $this->load->view('public/facility-dashboard/ajax/SlotEditView',$data,true);
  		 return $this->output->set_content_type('application/json')->set_output(json_encode($html));
	}


	public function update_slot(){
		//print_r($_POST);die;
		if($this->input->post('sl_kit_checked')=='true'){
			$is_kit_available = 'yes';
			$kit_price = $this->input->post('kit_price');
		}
		else{
			$is_kit_available = 'no';
			$kit_price = '';
		}
	
			$batch_slot_id = $this->input->post('batch_slot_id');
			$update_fac_slot = array(
			'fac_id'=>$this->input->post('fac_id'),
			'sport_id'=>$this->input->post('sport_id'),
			'batch_slot_type_id'=>$this->input->post('batch_slot_type_id'),
			'start_date'=>date('Y-m-d', strtotime($this->input->post('start_date'))),
			'end_date'=>date('Y-m-d', strtotime($this->input->post('end_date'))),
			'start_time'=>$this->input->post('start_time'),
			'end_time'=>$this->input->post('end_time'),
			'court_type'=>$this->input->post('court_type'),
			'court_description'=>$this->input->post('court_desc'),
			'is_kit_available'=>$is_kit_available,
			'fac_batch_slot_status'=>$this->input->post('fac_batch_slot_status'),
			'kit_price'=>$kit_price,
			'max_participanets'=>$this->input->post('max_participanets'),
			'update_on'=>date('Y-m-d H:i:s'),
			);
			//print_data($update_fac_slot);
			$this->CommonMdl->updateData($update_fac_slot,array('batch_slot_id'=>$batch_slot_id),'tbl_facility_batch_slot');
			//echo $this->db->last_query(); die;

			$update_fac_slot_price = array(
			'batch_slot_id'=>$batch_slot_id,
			'slot_package_price'=>$this->input->post('slotprice'),
			'created_on'=>date("Y-m-d H:i:s")
			);
        $this->CommonMdl->deleteRecord('tbl_slot_package_price',array('batch_slot_id'=>$batch_slot_id ));
		$res=$this->CommonMdl->insertRow($update_fac_slot_price,'tbl_slot_package_price');




			if($res){
				/*$week_days=$this->input->post('week_days');
    			$week_day=explode(',', $week_days);
			for($j=0; $j<count($week_day); $j++) { 
			$add_weekoff_slot[] = array(
			'batch_slot_id'=>$batch_slot_id,
			'batch_slot_weekoff_day'=>$week_day[$j],
			'updated_by'=>$this->session->userdata('user_id'),
			'updated_on'=>date('Y-m-d H:i:s')
			);
				
				}
		$this->CommonMdl->deleteRecord('tbl_batch_slot_weekoff',array('batch_slot_id'=>$batch_slot_id ));
		$this->CommonMdl->insertinBatch($add_weekoff_slot,'tbl_batch_slot_weekoff');*/
				
				echo "1";
			}
			else{
				echo "failed";
			}
			

			//print_data($add_fac_slot);
					

}


public function create_batch(){
	//echo "<pre>";
	//print_data($_POST); 


	$add_batch_slot = Array();
			for($i=0; $i<count($this->input->post('academystartdate')); $i++) {
					if($this->input->post('is_trial')[$i]=='on'){
						$is_trial = 'yes';
					}
					else{
						$is_trial = 'no';
					}
			$add_batch_slot = array(
			'fac_id'=>$this->input->post('academy_name'),
			'sport_id'=>$this->input->post('sport_id'),
			'start_date'=>date('Y-m-d', strtotime($this->input->post('academystartdate')[$i])),
			'end_date'=>date('Y-m-d', strtotime($this->input->post('academyenddate')[$i])),
			'start_time'=>$this->input->post('academystarttime')[$i],
			'end_time'=>$this->input->post('academyendtime')[$i],
			'max_participanets'=>$this->input->post('student')[$i],
			'is_trial'=>@$is_trial,
			'fac_batch_slot_status'=>'active',
			'create_on'=>date("Y-m-d H:i:s"),
			'update_on'=>date('Y-m-d H:i:s'),
			);
			//print_data($add_batch_slot);
			$batch_slot_id = $this->CommonMdl->insertRow($add_batch_slot,'tbl_facility_batch_slot');
		
			for($k=0; $k<count($this->input->post('academybatchprice'.$i)); $k++) { 
			$add_batch_slot_price = array(
			'batch_slot_id'=>$batch_slot_id,
			'slot_package_price'=>$this->input->post('academybatchprice'.$i)[$k],
			'package_id'=>$this->input->post('plan_id'.$i)[$k],
			'created_on'=>date("Y-m-d H:i:s"),
			);
			//print_data($add_fac_slot);
		$this->CommonMdl->insertRow($add_batch_slot_price,'tbl_slot_package_price');
			}
			//print_data($add_batch_slot_price);
			

			if($batch_slot_id){
				for($j=0; $j<count($this->input->post('academyday'.$i)); $j++) {  
					$add_weekoff_batch = array(
						'batch_slot_id'=>$batch_slot_id,
						'batch_slot_weekoff_day'=>$this->input->post('academyday'.$i)[$j],
						'created_by'=>$this->session->userdata('user_id'),
						'updated_by'=>$this->session->userdata('user_id'),
						'created_on'=>date("Y-m-d H:i:s"),
						'updated_on'=>date('Y-m-d H:i:s')
						);
					//print_data($add_weekoff_batch);
				$res = $this->CommonMdl->insertRow($add_weekoff_batch,'tbl_batch_slot_weekoff');
				}
				echo "1";
			}
			else{
				echo "failed";
			   }
			}
		}


		public function batchListing(){
	
		$order_by = array('col_name'=>'batch_slot_id','order'=>'desc');
	if($this->input->post('action')=='batch_filter'){
		$start_date = '';
		$end_date = '';
		if($this->input->post('from_date')!=''){
		$start_date=date('Y-m-d', strtotime($this->input->post('from_date')));
		}
		if($this->input->post('to_date')!=''){
		$end_date=date('Y-m-d', strtotime($this->input->post('to_date')));
		}
		$sport_id=$this->input->post('sport_id');

 	$data['batchListing'] = $this->FacilityMdl->getResultBycond('tbl_facility_batch_slot',array(
			'fac_id'=>$this->input->post('fac_id')),'*',$order_by,$sport_id,$start_date,$end_date);
 
 } 
	else{
		$data['batchListing'] = $this->CommonMdl->getResultBycond('tbl_facility_batch_slot',array('fac_id'=>$this->input->post('fac_id')),'*',$order_by,$sport_id='',$start_date='',$end_date='');
	}
		
		$html['_html'] = $this->load->view('public/facility-dashboard/ajax/BatchListingTableView',$data,true);
  		 return $this->output->set_content_type('application/json')->set_output(json_encode($html));
	}


	public function batch_edit_model(){
		$this->load->model('public/UserMdl');
		$data['fac_name'] = $this->input->post('fac_name');
		$data['fac_id'] = $this->input->post('fac_id');
		$data['slot_details'] = $this->CommonMdl->getRow('tbl_facility_batch_slot','*',array('batch_slot_id'=>$this->input->post('slot_id')));
		$data['fac_sports'] = $this->UserMdl->getFacSportList($this->input->post('fac_id'));
		$data['batch_slot_type'] = $this->CommonMdl->getResultByCond('tbl_batch_slot_type',array('batch_slot_type_status'=>'active'),'batch_slot_type_id,batch_slot_type',$order_by='');

		$data['week_days'] = $this->CommonMdl->getResultByCond('tbl_facility_timing',array('fac_id'=>$this->input->post('fac_id')),'day',$order_by='');

		 $data['slot_week_days'] = $this->CommonMdl->getResultByCond('tbl_batch_slot_weekoff',array('batch_slot_id'=>$data['slot_details']->batch_slot_id),'batch_slot_weekoff_day',$order_by='');
 	$data['batch_package'] = $this->CommonMdl->getResultByCond('tbl_package',array('package_status'=>'active'),'package_id,package_name',$order_by='');

		 $data['batch_price_package'] = $this->FacilityMdl->batch_price_package($data['slot_details']->batch_slot_id);

		
//echo $data['slot_details']->batch_slot_id;
		//print_r($data['slot_details']);

		 $html['_html'] = $this->load->view('public/facility-dashboard/ajax/BatchEditView',$data,true);
  		 return $this->output->set_content_type('application/json')->set_output(json_encode($html));
	}



		public function update_batch(){

			//print_data($_POST);
				if($this->input->post('action') =='batch_slot_update')
  {

  	if($this->input->post('is_trial')=='on'){
						$is_trial = 'yes';
					}
					else{
						$is_trial = 'no';
					}
			$batch_slot_id = $this->input->post('batch_slot_id');
	
			$batch_slot_id = $this->input->post('batch_slot_id');
			$update_fac_slot = array(
			'fac_id'=>$this->input->post('fac_id'),
			'sport_id'=>$this->input->post('sport_id'),
			'start_date'=>date('Y-m-d', strtotime($this->input->post('start_date'))),
			'end_date'=>date('Y-m-d', strtotime($this->input->post('end_date'))),
			'start_time'=>$this->input->post('start_time'),
			'end_time'=>$this->input->post('end_time'),
			'max_participanets'=>$this->input->post('max_participanets'),
			'is_trial'=>$is_trial,
			'fac_batch_slot_status'=>$this->input->post('fac_batch_slot_status'),
			'update_on'=>date('Y-m-d H:i:s'),
			);
			//print_data($update_fac_slot);
			$this->CommonMdl->updateData($update_fac_slot,array('batch_slot_id'=>$batch_slot_id),'tbl_facility_batch_slot');
			//echo $this->db->last_query(); die;
			
    			$package_id=explode(',', $this->input->post('packages_id'));
    			$package_price=explode(',', $this->input->post('package_price'));
			for($i=0; $i<count($package_id); $i++) { 
			$update_package_price[] = array(
			'batch_slot_id'=>$batch_slot_id,
			'slot_package_price'=>$package_price[$i],
			'package_id'=>$package_id[$i],
			'created_on'=>date("Y-m-d H:i:s")
			);
		}
        $this->CommonMdl->deleteRecord('tbl_slot_package_price',array('batch_slot_id'=>$batch_slot_id ));
		$res=$this->CommonMdl->insertinBatch($update_package_price,'tbl_slot_package_price');
			//print_data($update_package_price);



			if($res){
			/*	$week_days=$this->input->post('week_days');
    			$week_day=explode(',', $week_days);
			for($j=0; $j<count($week_day); $j++) { 
			$add_weekoff_slot[] = array(
			'batch_slot_id'=>$batch_slot_id,
			'batch_slot_weekoff_day'=>$week_day[$j],
			'updated_by'=>$this->session->userdata('user_id'),
			'updated_on'=>date('Y-m-d H:i:s')
			);
				
				}
		$this->CommonMdl->deleteRecord('tbl_batch_slot_weekoff',array('batch_slot_id'=>$batch_slot_id ));
		$this->CommonMdl->insertinBatch($add_weekoff_slot,'tbl_batch_slot_weekoff');*/
				
				echo "1";
			}
			else{
				echo "failed";
			}
			

			//print_data($add_fac_slot);
					
}
}


}
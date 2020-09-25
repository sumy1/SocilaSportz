<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Facility extends CI_Controller {

  public  function __construct()

  {

    parent::__construct();
    $this->load->model('admin/FacilityMdl');
    $this->load->model('admin/AdminMdl');


  }

  
public function index(){
	
	if($this->input->post('action')=='fac_filter'){
			$start_date = '';
			$end_date = '';
			$status = '';
		    $user_role='2';
			if($this->input->post('start_date')!=''){ 
			    $start_date=date('Y-m-d', strtotime($this->input->post('start_date')));
				$data['start_date']=$this->input->post('start_date');
			}if($this->input->post('end_date')!=''){
			     $end_date=date('Y-m-d', strtotime($this->input->post('end_date')));
				 $data['end_date']=$this->input->post('end_date');
             }if($this->input->post('select_stat')!=''){
			   $status=$this->input->post('select_stat');
			    $data['end_date']=$this->input->post('select_stat');
             }
			 
			 $order_by = array('col_name'=>'user_id','order'=>'desc');
             $data['userList'] = $this->AdminMdl->getResultByFilterss('tbl_user','*',$order_by,$start_date,$end_date,$user_role,$status);
	}
	else{
	  $order_by = array('col_name'=>'user_id','order'=>'desc');
      $data['userList'] = $this->CommonMdl->getResultByCond('tbl_user',array('user_role'=>'2'),'*',$order_by);

	}
	$this->load->view('admin/facility/FacilityListView',$data);
	
}

 public function exportdatabyfacilityuser(){
	 
	 if($this->input->post('start_date')!='' || $this->input->post('end_date')!='' || $this->input->post('select_stat')!=''){ 
		$start_date = '';
		$end_date = '';
		$status = '';
		$user_role='2';
		   
		   if($this->input->post('start_date')!=''){
		     $start_date=date('Y-m-d', strtotime($this->input->post('start_date')));
			 $data['start_date']=$this->input->post('start_date');
		   }if($this->input->post('end_date')!=''){
			  $end_date=date('Y-m-d', strtotime($this->input->post('end_date')));
			  $data['end_date']=$this->input->post('end_date');
		  }if($this->input->post('select_stat')!=''){
		      $status=$this->input->post('select_stat');
		  }
		 
		 $order_by = array('col_name'=>'user_id','order'=>'desc');
		 $data['userList'] = $this->AdminMdl->getResultByFilterss('tbl_user','*',$order_by,$start_date,$end_date,$user_role,$status);
	}
	else{
	  $order_by = array('col_name'=>'user_id','order'=>'desc');
      $data['userList'] = $this->CommonMdl->getResultByCond('tbl_user',array('user_role'=>'2'),'*',$order_by);

	}
	
	  $this->load->view('admin/Excel/FacilityUserExcelExportView',$data);
	
 }
public function changefacilitystatus(){
	$dataArr = array(
	     'admin_approval'=>$this->input->post('status'),
	  );
	  $res=$this->CommonMdl->updateData($dataArr,array('fac_id'=>trim($this->input->post('fac_id'))),' tbl_facility');
	 
	  if($res == 1){
		  echo "1";
	  }
	  else{
		  echo "0";
	  }
	
	   
	
}
public function editouner($id){
	   $whr=array('user_id'=>$id);
     $data['user_edit'] = $this->CommonMdl->getResultBycond('tbl_user',$whr,'*',$order_by='');
    
    $this->load->view('admin/facility/FacilityOwnerEditView',$data);
}
public function facilityeditowner(){
	    $dataArr=array(
            // 'user_role'=>trim($this->input->post('user_rol')),
            'user_status'=>trim($this->input->post('user_status')),
            'created_on'=>date("Y-m-d H:i:s"),
            'updated_on'=>date("Y-m-d H:i:s")

   );
  
        //echo '<pre>'; print_data($dataArr); die();
          $whr=array('user_id'=>$this->input->post('user_id'));
      $result=$this->CommonMdl->updateData($dataArr,$whr,'tbl_user');
      // echo '<pre>'; print_data($result); die();

      if($result==true)
          {
                    $this->session->set_flashdata('msg','User owner updated sucesfully');
                    $this->session->set_flashdata('msg_class','bg-success');
					 redirect('admin/facility');
          }

   
}

public function editfacility($id)
{
$whr=array('fac_id'=>$id);
	$data['editfacility']=$this->FacilityMdl->getResultBycond('tbl_facility',$whr,'*',$order_by='');
     //print_data($data);
	 $this->load->view('admin/facility/EditFacilityView',$data);
}

   private function set_upload_options($path){
            $config=array();
            $config['upload_path'] = $path; //give the path to upload the image in folder
            $config['allowed_types']= "*";
            $confoig['max_size'] = '0';
            $config['overwrite'] =FALSE;
            return $config;

   }
     private function set_upload_options1($path){
            $config=array();
            $config['upload_path'] = $path; //give the path to upload the image in folder
            $config['allowed_types']= "*";
            $confoig['max_size'] = '0';
            $config['overwrite'] =FALSE;
            return $config;

   }

     private function set_upload_options2($path){
            $config=array();
            $config['upload_path'] = $path; //give the path to upload the image in folder
            $config['allowed_types']= "*";
            $confoig['max_size'] = '0';
            $config['overwrite'] =FALSE;
            return $config;

   }

public function facilityupdate(){

 

   
     
       

       $dataArr=array(
              'admin_approval'=>$this->input->post('fac_statuss'),
              'created_on'=>date("Y-m-d H:i:s"),
              'updated_on'=>date("Y-m-s H:i:s")
           );
         // print_data($dataArr); die();
      
        $savebanner=$this->FacilityMdl->updateData($dataArr,array('fac_id'=>$this->input->post('old_fac_id')),'tbl_facility');
       //echo $this->db->last_query();
	   // print_data($savebanner); die();
       if($savebanner){
               $this->session->set_flashdata('msg','page update sucesfully');
               $this->session->set_flashdata('msg_class','bg-success');
                redirect('admin/Facility');
       }


}


public function facilityacademylist(){
	
	$order_by = array('col_name'=>'fac_id','order'=>'desc');
	if($this->input->post('action')=='fac_filter'){
			$start_date = '';
			$end_date = '';
			$status = '';
			if($this->input->post('start_date')!=''){ 
			    $start_date=date('Y-m-d', strtotime($this->input->post('start_date')));
				$data['start_date']=$this->input->post('start_date');
			}
			 
			 
			if($this->input->post('end_date')!=''){
			    $end_date=date('Y-m-d', strtotime($this->input->post('end_date')));
				 $data['end_date']=$this->input->post('end_date');

			}
			if($this->input->post('select_stat')!=''){
			   $status=$this->input->post('select_stat');
			   $data['status']=$this->input->post('select_stat');

			}
			$data['academy_data'] = $this->AdminMdl->getResultbyfilter('tbl_facility','*',$order_by,$start_date,$end_date,$status);
			foreach($data['academy_data'] as $key=>$val){
			$data['fac_name']=$this->CommonMdl->getResultBycond('tbl_user',array('user_id'=>$val->user_id),'user_name',$order_by='');
			$data['academy_data'][$key]->user_name=$data['fac_name'];

			}
	}
     else{
			$data['academy_data'] = $this->AdminMdl->getResultbyfilter('tbl_facility','*',$order_by,$start_date='',$end_date='',$status='');


 
			foreach($data['academy_data'] as $key=>$val){
				 $data['fac_name']=$this->CommonMdl->getResultBycond('tbl_user',array('user_id'=>$val->user_id),'user_name',$order_by='');
				 $data['academy_data'][$key]->user_name=$data['fac_name'];
			 }
	}
	
	
	$this->load->view('admin/facility/FacilityAcademyListView',$data);
}



public function exportdatabyacademy(){
  $order_by = array('col_name'=>'fac_id','order'=>'desc');
	if($this->input->post('start_date')!=''  || $this->input->post('end_date')!='' || $this->input->post('select_stat')!=''){
		     $start_date = '';
			$end_date = '';
			$status = '';
			if($this->input->post('start_date')!=''){ 
			    $start_date=date('Y-m-d', strtotime($this->input->post('start_date')));
				$data['start_date']=$this->input->post('start_date');
			}
			if($this->input->post('end_date')!=''){
			    $end_date=date('Y-m-d', strtotime($this->input->post('end_date')));
				 $data['end_date']=$this->input->post('end_date');
            }
			if($this->input->post('select_stat')!=''){
			   $status=$this->input->post('select_stat');
             }
			$data['academy_data'] = $this->AdminMdl->getResultbyfilter('tbl_facility','*',$order_by,$start_date,$end_date,$status);
			foreach($data['academy_data'] as $key=>$val){
			$data['fac_name']=$this->CommonMdl->getResultBycond('tbl_user',array('user_id'=>$val->user_id),'user_name',$order_by='');
			$data['academy_data'][$key]->user_name=$data['fac_name'];

			}
	}
     else{
			$data['academy_data'] = $this->AdminMdl->getResultbyfilter('tbl_facility','*',$order_by,$start_date='',$end_date='',$status='');
		
			foreach($data['academy_data'] as $key=>$val){
				 $data['fac_name']=$this->CommonMdl->getResultBycond('tbl_user',array('user_id'=>$val->user_id),'user_name',$order_by='');
				 $data['academy_data'][$key]->user_name=$data['fac_name'];
			 }
	}
	
	$this->load->view('admin/Excel/ProductExcelExportView',$data);
}










public function facacademyedit($fac_id){
		$data['academy_data'] = $this->CommonMdl->getRow('tbl_facility','*',array('fac_id'=>$fac_id)); 
		// $data['academy_data']=$this->CommonMdl->
		$data['user_data'] = $this->CommonMdl->getRow('tbl_user','*',array('user_id'=>$data['academy_data']->user_id));
		$data['academy_data']->user_data=$data['user_data'];
        //print_data($data['academy_data']);	  
	
	$this->load->view('admin/facility/FacAcademyEditView',$data);
}


public function facacademyupdate(){
    $dataArr=array(
				'admin_approval'=> $this->input->post('fac_statuss'),
				'is_home'=> $this->input->post('is_home'),
			  );
			  $whr=array('fac_id'=>$this->input->post('fac_id'));
			  $savebanner=$this->FacilityMdl->updateData($dataArr,$whr,'tbl_facility');
			if($savebanner){
			   $this->session->set_flashdata('msg','Facility academy updated sucesfully');
			   $this->session->set_flashdata('msg_class','bg-success');
			   redirect('admin/facility/facilityacademylist');
			 }
}



public function facilityslotbatchesList(){
	    $start_date = '';
		$end_date = '';
		$status = '';
		$facility_type = '';
	if($this->input->post('action')=='fac_filter'){
		if($this->input->post('start_date')!=''){ 
		   $start_date=date('Y-m-d', strtotime($this->input->post('start_date')));
           $data['start_date']=$this->input->post('start_date');
		}

		if($this->input->post('end_date')!=''){
		   $end_date=date('Y-m-d', strtotime($this->input->post('end_date')));
		   $data['end_date']=$this->input->post('end_date');
 
		// echo $end_date; die;
		}
		if($this->input->post('select_stat')!=''){
		   $status=$this->input->post('select_stat');
		   $data['status']=$this->input->post('select_stat');
         }if($this->input->post('facility_type')!=''){
		   $facility_type=$this->input->post('facility_type');
		   $data['facility_type']=$this->input->post('facility_type');
         }
		  $data['facility_batch_data'] = $this->AdminMdl->getslotByFilter($start_date,$end_date,$status,$facility_type);
		
		}else{
	    
		 $data['facility_batch_data'] = $this->AdminMdl->getslotByFilter($start_date,$end_date,$status,$facility_type);

	}
	
	
	$this->load->view('admin/facility/FacSlotBatchesListView',$data);
}





public function exportdatabyslot(){
	print_data($_POST);
	$order_by = array('col_name'=>'fac_id','order'=>'desc');
	if($this->input->post('start_date')!=''  || $this->input->post('end_date')!='' || $this->input->post('select_stat')!=''){
		     $start_date = '';
			$end_date = '';
			$status = '';
			if($this->input->post('start_date')!=''){ 
			    $start_date=date('Y-m-d', strtotime($this->input->post('start_date')));
				$data['start_date']=$this->input->post('start_date');
			}
			if($this->input->post('end_date')!=''){
			    $end_date=date('Y-m-d', strtotime($this->input->post('end_date')));
				 $data['end_date']=$this->input->post('end_date');
            }
			if($this->input->post('select_stat')!=''){
			   $status=$this->input->post('select_stat');
             }
			 $data['facility_batch_data'] = $this->AdminMdl->getslotByFilter('tbl_facility_batch_slot','*',$order_by,$start_date,$end_date,$status);
		  foreach($data['facility_batch_data'] as $key=>$val){
			 $data['facility_name']=$this->CommonMdl->getResultBycond('tbl_facility',array('fac_id'=>$val->fac_id),
			 'fac_name,user_id,fac_type',$order_by='');
			 $data['user_name']=$this->CommonMdl->getResultBycond('tbl_user',array('user_id'=>$data['facility_name'][0]->user_id),'user_name',$order_by='');
			 $data['facility_batch_data'][$key]->fac_name=$data['facility_name'];
			 $data['facility_batch_data'][$key]->user_name=$data['user_name'];

			}
	}
     else{
			$data['facility_batch_data'] = $this->AdminMdl->getslotByFilter('tbl_facility_batch_slot','*',$order_by,$start_date='',$end_date='',$status='');
		 foreach($data['facility_batch_data'] as $key=>$val){
			$data['facility_name']=$this->CommonMdl->getResultBycond('tbl_facility',array('fac_id'=>$val->fac_id),
			'fac_name,user_id,fac_type',$order_by='');
			$data['user_name']=$this->CommonMdl->getResultBycond('tbl_user',array('user_id'=>$data['facility_name'][0]->user_id),'user_name',$order_by='');
			$data['facility_batch_data'][$key]->fac_name=$data['facility_name'];
			$data['facility_batch_data'][$key]->user_name=$data['user_name'];
		}
	}
 // print_data($data['facility_batch_data']);
	
 $this->load->view('admin/Excel/ProductExcelExportView',$data);
}




public function facslotbatchedit($batch_slot_id){
	$data['facility_batch_slot_data'] = $this->CommonMdl->getRow('tbl_facility_batch_slot','*',array('batch_slot_id'=>$batch_slot_id)); 
	$data['facility_name']=$this->CommonMdl->getRow('tbl_facility','*',array('fac_id'=>$data['facility_batch_slot_data']->fac_id));
	$data['user_name']=$this->CommonMdl->getRow('tbl_user','*',array('user_id'=>$data['facility_name']->user_id));
	$data['facility_batch_slot_data']->fac_name=$data['facility_name'];
	$data['facility_batch_slot_data']->user_name=$data['user_name'];
   
   
   $this->load->view('admin/facility/FacSlotBatchEditView',$data);
}



public function changebatchstatus(){
	 //$batch_slot_id=$this->input->post('batch_slot_id');
	 $Arr_data= array(
	       'fac_batch_slot_status'=>$this->input->post('batch_slot_status'),
	  );
 	$res=$this->CommonMdl->updateData($Arr_data,array('batch_slot_id'=>$this->input->post('batch_slot_id')),'tbl_facility_batch_slot');
	if($res){
		echo "1";
	}
	else{
		echo "0";
	}
	
}


public function facslotupdate(){
 

		$dataArruser=array(
			     'fac_batch_slot_status'=>$this->input->post('slot_status'),
				
		);
	
			  $savebanner=$this->FacilityMdl->updateData($dataArruser,array('batch_slot_id'=>$this->input->post('batch_slot_id')),'tbl_facility_batch_slot');
			if($savebanner){
			   $this->session->set_flashdata('msg','Slot batch updated sucesfully');
			   $this->session->set_flashdata('msg_class','bg-success');
			   redirect('admin/facility/facilityslotbatchesList');
			  }
		  
}

public function facgallerylist(){
	 if($this->input->post('action')=='fac_filter'){
		$start_date = '';
		$end_date = '';
		$status = '';
		$select_type='';
		if($this->input->post('start_date')!=''){ 
		   $start_date=date('Y-m-d', strtotime($this->input->post('start_date')));
           $data['start_date']=$this->input->post('start_date');
		}

		if($this->input->post('end_date')!=''){
		   $end_date=date('Y-m-d', strtotime($this->input->post('end_date')));
		   $data['end_date']=$this->input->post('end_date');
 
		// echo $end_date; die;
		}
		if($this->input->post('select_stat')!=''){
		   $status=$this->input->post('select_stat');
		   $data['status']=$this->input->post('select_stat');
         }
		 if($this->input->post('select_type')!=''){
		   $select_type=$this->input->post('select_type');
		   $data['select_type']=$this->input->post('select_type');
         }
		$data['facility_list']=$this->AdminMdl->getgallertList($start_date,$end_date,$status,$select_type);		
		 
	 }else{
		 
		 $data['facility_list']=$this->AdminMdl->getgallertList($start_date='',$end_date='',$status='',$select_type='');
	 }
			
	$this->load->view('admin/facility/FacGalleryListView',$data);
}

public function excelgallery(){
      $order_by = array('col_name'=>'fac_id','order'=>'desc');
		$data['facility_list']=$this->CommonMdl->getResultByCond('tbl_facility',$whr='','fac_id,fac_name,fac_type',$order_by);
		foreach($data['facility_list'] as $key=>$val){
			$data['facility_list'][$key]->facility_gallery_list=$this->CommonMdl->getResultByCond('tbl_facility_gallery',array('fac_id'=>$val->fac_id),'*',$order_by='');
		}
		$this->load->view('admin/Excel/FacilityUserExcelExportView',$data);
}



public function changegallerystatus(){
	
	 
	 $dataArr = array(
	     'admin_approval'=>$this->input->post('gallery_status'),
	  );
	  $res=$this->CommonMdl->updateData($dataArr,array('gallery_id'=>trim($this->input->post('gallery_id'))),' tbl_facility_gallery');
  
	  if($res == 1){
		  echo "1";
	  }
	  else{
		  echo "0";
	  }
	  
	  
	
	 
}
public function facbookinglist(){
	$start_date='';
	$end_date='';
	$status='';
	$booking_type='';
	if($this->input->post('action')=='fac_filter'){
			if($this->input->post('start_date')!=''){
			  $start_date=date('Y-m-d', strtotime($this->input->post('start_date')));
			   $data['start_date']=$this->input->post('start_date');
			}
			if($this->input->post('end_date')!=''){
			  $end_date=date('Y-m-d', strtotime($this->input->post('end_date')));
			  $data['end_date']=$this->input->post('end_date');
			}
			if($this->input->post('select_stat')!=''){
                $status=$this->input->post('select_stat');
				$data['status']=$this->input->post('select_stat');
             }if($this->input->post('booking_type')!=''){
                $booking_type=$this->input->post('booking_type');
				$data['booking_type']=$this->input->post('booking_type');
             }
			 $data['facility_booking_listing']=$this->AdminMdl->getbookingByFilter($start_date,$end_date,$status,$booking_type);
			 
	}else{
	  $data['facility_booking_listing']=$this->AdminMdl->getbookingByFilter($start_date,$end_date,$status,$booking_type);
	} 

	$this->load->view('admin/facility/FacSlotBookingListView',$data);
}

public function exportslotbooking(){
				$start_date = '';
			$status = '';
			$booking_type='';
			$end_dates='';

	if($this->input->post('start_date')!=''  || $this->input->post('end_dates')!='' || $this->input->post('select_stat')!='' || $this->input->post('booking_type')!=''){
			if($this->input->post('start_date')!=''){ 
			    $start_date=date('Y-m-d', strtotime($this->input->post('start_date')));
			}if($this->input->post('end_dates')!=''){
			    $end_dates=date('Y-m-d', strtotime($this->input->post('end_dates')));
            }if($this->input->post('select_stat')!=''){
			   $status=$this->input->post('select_stat');
             }if($this->input->post('booking_type')!=''){
			   $booking_type=$this->input->post('booking_type');
             }
			$data['facility_booking_listing']=$this->AdminMdl->getbookingByFilter($start_date,$end_dates,$status,$booking_type);
			

	}else{
		
		$data['facility_booking_listing']=$this->AdminMdl->getbookingByFilter($start_date,$end_dates,$status,$booking_type);
	}
	$this->load->view('admin/Excel/ProductExcelExportView',$data);
}


public function facbatchbookinglist(){
	$start_date='';
	$end_date='';
	$status='';
	$booking_type='';
	if($this->input->post('action')=='fac_filter'){
			if($this->input->post('start_date')!=''){
			  $start_date=date('Y-m-d', strtotime($this->input->post('start_date')));
			   $data['start_date']=$this->input->post('start_date');
			}
			if($this->input->post('end_date')!=''){
			  $end_date=date('Y-m-d', strtotime($this->input->post('end_date')));
			  $data['end_date']=$this->input->post('end_date');
			}
			if($this->input->post('select_stat')!=''){
                $status=$this->input->post('select_stat');
				$data['status']=$this->input->post('select_stat');
             }if($this->input->post('booking_type')!=''){
                $booking_type=$this->input->post('booking_type');
				$data['booking_type']=$this->input->post('booking_type');
             }
			 $data['facility_booking_listing']=$this->AdminMdl->getbookingacademyByFilter($start_date,$end_date,$status,$booking_type);
			 
	}else{
	  $data['facility_booking_listing']=$this->AdminMdl->getbookingacademyByFilter($start_date,$end_date,$status,$booking_type);
	} 

	$this->load->view('admin/facility/FacBatchBookingListView',$data);
	   
	
}


public function exportbatchbooking(){
	$start_date = '';
	$end_dates = '';
	$status = '';
	$booking_type='';
	if($this->input->post('start_date')!=''  || $this->input->post('end_dates')!='' || $this->input->post('select_stat')!='' || $this->input->post('booking_type')!=''){
			if($this->input->post('start_date')!=''){ 
			    $start_date=date('Y-m-d', strtotime($this->input->post('start_date')));
			}if($this->input->post('end_dates')!=''){
			    $end_dates=date('Y-m-d', strtotime($this->input->post('end_dates')));
            }if($this->input->post('select_stat')!=''){
			   $status=$this->input->post('select_stat');
             }if($this->input->post('booking_type')!=''){
			   $booking_type=$this->input->post('booking_type');
             }
			$data['academy_listing']=$this->AdminMdl->getbookingacademyByFilter($start_date,$end_dates,$status,$booking_type);
			// print_data($data['academy_listing']);
	}else{
		
		$data['academy_listing']=$this->AdminMdl->getbookingacademyByFilter($start_date,$end_dates,$status,$booking_type);
	}
	
 $this->load->view('admin/Excel/ProductExcelExportView',$data);
}



function exportdatabybooking(){
		$order_by = array('col_name'=>'booking_order_id','order'=>'desc');
	      $data['facility_booking_listing']=$this->CommonMdl->getResultByCond('tbl_booking_order',array('booking_for!='=>'event'),$clms='*',$order_by);

	 foreach($data['facility_booking_listing'] as $key=>$val){
		  $data['facility_booking_listing'][$key]->booking_slot_datail=$this->CommonMdl->getResultByCond('tbl_booking_slot_detail',array('booking_order_id'=>$val->booking_order_id),'*',$order_by='');
		  foreach($data['facility_booking_listing'][$key]->booking_slot_datail as $keys=>$vals){
		    $data['facility_booking_listing'][$key]->facility_name=$this->CommonMdl->getResultByCond('tbl_facility',array('fac_id'=>$vals->fac_id),'fac_name,fac_type',$order_by='');
			
			$data['facility_booking_listing'][$key]->sport_name=$this->CommonMdl->getResultByCond('tbl_sport_list',array('sport_id'=>$vals->sport_id),'sport_name',$order_by=''); 
		  
		  }
	  }

	 
	 
	  // print_data($data['facility_booking_listing']);
	 $this->load->view('admin/Excel/ProductExcelExportView',$data);
}

function exportdatabyeventbooking(){
		$order_by = array('col_name'=>'booking_order_id','order'=>'desc');
	$data['facility_booking_event_listing']=$this->CommonMdl->getResultByCond('tbl_booking_order',array('booking_for='=>'event'),$clms='*',$order_by);

	 foreach($data['facility_booking_event_listing'] as $key=>$val){
		  $data['facility_booking_event_listing'][$key]->booking_slot_datail=$this->CommonMdl->getResultByCond('tbl_booking_slot_detail',array('booking_order_id'=>$val->booking_order_id),'*',$order_by='');
	  }
	 $this->load->view('admin/Excel/ProductExcelExportView',$data);
}

public function faceventlisting(){
		  $start_date='';
			$end_date='';
			$status='';
			$booking_type='';
	
	if($this->input->post('action')=='fac_filter'){
		  
			
			if($this->input->post('start_date')!=''){
			   $start_date=date('Y-m-d', strtotime($this->input->post('start_date')));
			   $data['start_date']=$this->input->post('start_date');
			}if($this->input->post('end_date')!=''){
			  
			  $end_date=date('Y-m-d', strtotime($this->input->post('end_date')));
			  $data['end_date']=$this->input->post('end_date');
			}if($this->input->post('select_stat')!=''){
                $status=$this->input->post('select_stat');
				$data['status']=$this->input->post('select_stat');
             }if($this->input->post('booking_type')!=''){
                $booking_type=$this->input->post('booking_type');
				$data['booking_type']=$this->input->post('booking_type');
             }
			  $data['facility_booking_listing']=$this->AdminMdl->geteventbookingList($start_date,$end_date,$status,$booking_type);
			  // print_data($data);
			 
			 
	}else{
       $data['facility_booking_listing']=$this->AdminMdl->geteventbookingList($start_date,$end_date,$status,$booking_type);
	} 
	 $this->load->view('admin/facility/FacEventBookingListView',$data);
}

public function exporteventbooking(){
	$start_date = '';
	$end_dates = '';
	$status = '';
	$booking_type='';
	if($this->input->post('start_date')!=''  || $this->input->post('end_dates')!='' || $this->input->post('select_stat')!='' || $this->input->post('booking_type')!=''){
			if($this->input->post('start_date')!=''){ 
			    $start_date=date('Y-m-d', strtotime($this->input->post('start_date')));
			}if($this->input->post('end_dates')!=''){
			    $end_dates=date('Y-m-d', strtotime($this->input->post('end_dates')));
            }if($this->input->post('select_stat')!=''){
			   $status=$this->input->post('select_stat');
             }if($this->input->post('booking_type')!=''){
			   $booking_type=$this->input->post('booking_type');
             }
			 $data['event_listing']=$this->AdminMdl->geteventbookingList($start_date,$end_dates,$status,$booking_type);
	}else{
		
		$data['event_listing']=$this->AdminMdl->geteventbookingList($start_date,$end_dates,$status,$booking_type);
	}
	$this->load->view('admin/Excel/ProductExcelExportView',$data);
}
public  function faceventbookingorder($booking_id){
	$data['fac_booking_listing']=$this->CommonMdl->getRow('tbl_booking_order','*',array('booking_order_id'=>$booking_id));
    $data['fac_booking_listing']->booking_detail=$this->CommonMdl->getResultByCond('tbl_booking_event_detail',array('booking_order_id'=>$data['fac_booking_listing']->booking_order_id),'*',$order_by='');
	// $data['fac_booking_listing']->booking_detail=>booking_details=array('rr'=>'rr');

  

 foreach($data['fac_booking_listing']->booking_detail as $key=>$val){
		     $data['fac_booking_listing']->booking_detail[$key]->facility_name=$this->CommonMdl->getResultByCond('tbl_facility',array('fac_id'=>$val->fac_id),'fac_name,fac_type',$order_by='');
	   foreach($data['fac_booking_listing']->booking_detail[$key]->facility_name as $keys=>$valus){
			 $data['fac_booking_listing']->booking_detail[$key]->facility_name[$keys]->sport_name=$this->CommonMdl->getResultByCond('tbl_sport_list',array('sport_id'=>$val->event_sport_id),'sport_name',$order_by='');
			 
		}
	 }
	$this->load->view('admin/facility/bookingorder/EventOrderDetailView',$data);
}


function exportdatabybookingevent(){
		$order_by = array('col_name'=>'booking_order_id','order'=>'desc');
	   $data['facility_booking_listings']=$this->CommonMdl->getResultByCond('tbl_booking_order',array('booking_for='=>'event'),$clms='*',$order_by);

	 foreach($data['facility_booking_listings'] as $key=>$val){
		  $data['facility_booking_listings'][$key]->booking_slot_datail=$this->CommonMdl->getResultByCond('tbl_booking_slot_detail',array('booking_order_id'=>$val->booking_order_id),'*',$order_by='');
	  }
$this->load->view('admin/Excel/FacilityUserExcelExportView',$data);
}









public function facbookingorder($booking_detail_id){
	

	$data['fac_booking_listing']=$this->CommonMdl->getRow('tbl_booking_order','*',array('booking_order_id'=>$booking_detail_id));
    $data['fac_booking_listing']->booking_detail=$this->CommonMdl->getResultByCond('tbl_booking_slot_detail',array('booking_order_id'=>$data['fac_booking_listing']->booking_order_id),'*',$order_by='');
 foreach($data['fac_booking_listing']->booking_detail as $key=>$val){
		     $data['fac_booking_listing']->booking_detail[$key]->facility_name=$this->CommonMdl->getResultByCond('tbl_facility',array('fac_id'=>$val->fac_id),'fac_name,fac_type',$order_by='');
	   foreach($data['fac_booking_listing']->booking_detail[$key]->facility_name as $keys=>$valus){
			 $data['fac_booking_listing']->booking_detail[$key]->facility_name[$keys]->sport_name=$this->CommonMdl->getResultByCond('tbl_sport_list',array('sport_id'=>$val->sport_id),'sport_name',$order_by=''); 
		}
	 }
	 // echo "<pre>";
	 // print_r($data['fac_booking_listing']);
	// die;
	$this->load->view('admin/facility/bookingorder/OrderDetailView',$data);
}


public function changeStatus(){
	$id=$this->input->post('id');
	$status=$this->input->post('status');
     $Arr_array = array(
       			'booking_status' => $status, 
       		);
			$res=$this->CommonMdl->updateData($Arr_array,array('booking_order_id'=>$id),'tbl_booking_order');
			if($res == 1){
				echo "1";
			}
			else{
				echo "0";
			}
            
			
}
public function faceventlist(){
	
	$order_by = array('col_name'=>'event_id','order'=>'desc');
	if($this->input->post('action')=='fac_filter'){
			$start_date = '';
			$end_date = '';
			$status = '';
			if($this->input->post('start_date')!=''){ 
			$start_date=date('Y-m-d', strtotime($this->input->post('start_date')));
			 $data['start_date']=$this->input->post('start_date');
			 

			}

			if($this->input->post('end_date')!=''){
			$end_date=date('Y-m-d', strtotime($this->input->post('end_date')));
            $data['end_date']=$this->input->post('end_date');
			// echo $end_date; die;
			}

			if($this->input->post('select_stat')!=''){
			$status=$this->input->post('select_stat');

			}

			$data['fac_event_listing'] = $this->AdminMdl->geteventByFilter('tbl_event','*',$order_by,$start_date,$end_date,$status);


			foreach($data['fac_event_listing'] as $key=>$val){
			 $data['fac_event_listing'][$key]->sport_name=$this->CommonMdl->getResultBycond('tbl_sport_list',array('sport_id'=>$val->sport_id),'sport_name',$order_by='');
			}
   
	}
   else{
			$data['fac_event_listing'] = $this->AdminMdl->geteventByFilter('tbl_event','*',$order_by,$start_date='',$end_date='',$status='');
			foreach($data['fac_event_listing'] as $key=>$val){
			  $data['fac_event_listing'][$key]->sport_name=$this->CommonMdl->getResultBycond('tbl_sport_list',array('sport_id'=>$val->sport_id),'sport_name',$order_by='');
		   }
   } 
	
	 
	$this->load->view('admin/facility/FacEventListView',$data);
}




public function faceventedit($event_id){
	$data['event_data']=$this->CommonMdl->getRow('tbl_event','*',array('event_id'=>trim($event_id)));
	$data['event_data']->sport_list=$this->CommonMdl->getRow('tbl_sport_list','*',array('sport_id'=>trim($data['event_data']->sport_id)));

	$this->load->view('admin/facility/FacEventEditView',$data);
	
}


public function faceventgallerylist(){
	$order_by = array('col_name'=>'event_id','order'=>'desc');
	$data['event_data_list']=$this->CommonMdl->getResultByCond('tbl_event',$whr='','event_name,fac_id,event_id,event_banner,created_on',$order_by);  
	
	foreach($data['event_data_list'] as $key=>$val){
          $data['event_data_list'][$key]->fac_name=$this->CommonMdl->getRow('tbl_facility','fac_name',array('fac_id'=>trim($val->fac_id)));
		 $data['event_data_list'][$key]->event_gallery=$this->CommonMdl->getResultByCond('tbl_event_gallery',array('event_id'=>$val->event_id),'image,admin_approval,event_gallery_id',$order_by='');
		 
		
   		 
	   
	}
	 // print_data($data['event_data_list']);
	
	$this->load->view('admin/facility/FacEventGalleryListView',$data);
}

public function changeeventgallerystatus(){
	$dataArr=array(
	 'admin_approval'=>$this->input->post('gallery_status'),
	);
	$res=$this->CommonMdl->updateData($dataArr,array('event_gallery_id'=>$this->input->post('gallery_id')),'tbl_event_gallery');
	
	if($res == 1){
		echo "1";
	}
	else{
		echo "0";
	}
}


public function changeeventstatus(){

   $dataArr=array(
	 'event_approval'=>$this->input->post('event_status'),
	);
	$res=$this->CommonMdl->updateData($dataArr,array('event_id'=>$this->input->post('event_id')),'tbl_event');
	if($res == 1){
		echo "1";
	}
	else{
		echo "0";
	}
	
	
}

public function faceventupdate(){
			   $dataArrevent=array(
						'event_approval'=>trim($this->input->post('event_approval')),
						'is_home'=>trim($this->input->post('is_home')),
					 );
					  // echo "<pre>";
					  // print_r($dataArrevent);
                     $whr= array('event_id'=>$this->input->post('event_id'));
					

                   $savebanner=$this->FacilityMdl->updateData($dataArrevent,$whr,'tbl_event');
				  
				  if($savebanner){
				    $this->session->set_flashdata('msg','page update sucesfully');
				    $this->session->set_flashdata('msg_class','bg-success');
					redirect('admin/facility/faceventlist');
				  
				  }           
	}

	
   
	


public function facreviewlist(){
	  
	  $order_by = array('col_name'=>'rating_id','order'=>'desc');
	if($this->input->post('action')=='fac_filter'){
				$start_date = '';
				$end_date = '';
				$status = '';
			if($this->input->post('start_date')!=''){ 
				$start_date=date('Y-m-d', strtotime($this->input->post('start_date')));
				$data['start_date']=$this->input->post('start_date');
				
				
				
			}

			if($this->input->post('end_date')!=''){
				$end_date=date('Y-m-d', strtotime($this->input->post('end_date')));
				$data['end_date']=$this->input->post('end_date');

			}

			if($this->input->post('select_stat')!=''){
			   $status=$this->input->post('select_stat');
			   
			}
			  $data['rating_data']=$this->AdminMdl->getResultByFilter('tbl_rating','*',$order_by,$start_date,$end_date,$status='');
			  foreach($data['rating_data'] as $key=>$val){
				 $data['rating_data'][$key]->review_data=$this->CommonMdl->getResultByCond('tbl_review',array('rating_id'=>$val->rating_id),'*',$order_by='');
			  }
	  
	}
	else{
			$data['rating_data']=$this->AdminMdl->getResultByFilter('tbl_rating','*',$order_by,$start_date='',$end_date='');
		  foreach($data['rating_data'] as $key=>$val){
			     $data['rating_data'][$key]->review_data=$this->CommonMdl->getResultByCond('tbl_review',array('rating_id'=>$val->rating_id),'*',$order_by='');
				 $data['rating_data'][$key]->facility_name=$this->CommonMdl->getRow('tbl_facility','fac_name',array('fac_id'=>$val->fac_id));
				 
              }
	}
	
	// echo "<pre>";
	 // print_r($data['rating_data']);
	 // die;
					 
	 $this->load->view('admin/facility/FacReviewListView',$data);
}

public function excelfacreview(){
$data['rating_data']=$this->AdminMdl->getResultByFilter('tbl_rating','*',$order_by,$start_date='',$end_date='');
  foreach($data['rating_data'] as $key=>$val){
		 $data['rating_data'][$key]->review_data=$this->CommonMdl->getResultByCond('tbl_review',array('rating_id'=>$val->rating_id),'*',$order_by='');
		 $data['rating_data'][$key]->facility_name=$this->CommonMdl->getRow('tbl_facility','fac_name',array('fac_id'=>$val->fac_id));
		}
			  
		 $this->load->view('admin/facility/ReviewExcel/ReviewExcelView',$data);		  
}

public function changeratingstatus(){
	   
	   $dataArr= array(
	      'admin_approval'=>$this->input->post('rating_status'),
	   );
	   
	   $res=$this->CommonMdl->updateData($dataArr,array('rating_id'=>$this->input->post('rating_id')),' tbl_rating');
	   
	   if($res == 1){
		   echo "1";
	   }
	   else{
		   echo "0";
	   }
	   
}

public function facratingedit($rating_id){
	$data['rating_data']=$this->CommonMdl->getRow('tbl_rating','*',array('rating_id'=>trim($rating_id)));
	 
	
	$data['rating_data']->review_data=$this->CommonMdl->getRow('tbl_review','*',array('rating_id'=>trim($data['rating_data']->rating_id)));
	
	
	$this->load->view('admin/facility/FacReviewEditView',$data);
	
}






public function facbanklist(){
	  $order_by = array('col_name'=>'bank_info_id','order'=>'desc');
	  if($this->input->post('action')=='fac_filter'){
			$start_date = '';
			$end_date = '';
			$status = '';
			if($this->input->post('start_date')!=''){ 
			    $start_date=date('Y-m-d', strtotime($this->input->post('start_date')));
				$data['start_date']=$this->input->post('start_date');
			}
			 
			 
			if($this->input->post('end_date')!=''){
			    $end_date=date('Y-m-d', strtotime($this->input->post('end_date')));
				 $data['end_date']=$this->input->post('end_date');

			}
			if($this->input->post('select_stat')!=''){
			   $status=$this->input->post('select_stat');
			   $data['status']=$this->input->post('select_stat');

			}
			$data['user_bank_details_data'] = $this->AdminMdl->getbankByFilter('tbl_user_bank_details','*',$order_by,$start_date,$end_date,$status);
			
			 foreach($data['user_bank_details_data'] as $key=>$val){
		         $data['user_bank_details_data'][$key]->user_names=$this->CommonMdl->getRow('tbl_user','user_name,	user_mobile_no',array('user_id'=>$val->user_id),'user_name');
	              }
	 
			
	}
	else{
	
	 $data['user_bank_details_data']=$this->CommonMdl->getResultByCond('tbl_user_bank_details',$whr='',$clms='*',$order_by);
	 
	  foreach($data['user_bank_details_data'] as $key=>$val){
		$data['user_bank_details_data'][$key]->user_names=$this->CommonMdl->getRow('tbl_user','user_name,user_mobile_no',array('user_id'=>$val->user_id),'user_name');
		 
	 }
	}
	 // print_data($data['user_bank_details_data']);
	 $this->load->view('admin/facility/FacBankListView',$data);
}


public function exportdatabank(){
	
        $order_by = array('col_name'=>'bank_info_id','order'=>'desc');
		$start_date = '';
		$end_date = '';
		$status = '';
		if($this->input->post('action')=='bank_filter'){
			if($this->input->post('start_date')!=''){ 
				$start_date=date('Y-m-d', strtotime($this->input->post('start_date')));
				$data['start_date']=$this->input->post('start_date');
			}if($this->input->post('end_date')!=''){
				 $end_date=date('Y-m-d', strtotime($this->input->post('end_date')));
				 $data['end_date']=$this->input->post('end_date');
			 }if($this->input->post('select_stat')!=''){
			   $status=$this->input->post('select_stat');
			 }
			 $data['user_bank_details_data'] = $this->AdminMdl->getbankByFilter('tbl_user_bank_details','*',$order_by,$start_date,$end_date,$status);
			
			foreach($data['user_bank_details_data'] as $key=>$val){
		         $data['user_bank_details_data'][$key]->user_names=$this->CommonMdl->getRow('tbl_user','user_name,	user_mobile_no',array('user_id'=>$val->user_id),'user_name');
	           }
			   
		}else{
			$data['user_bank_details_data']=$this->CommonMdl->getResultByCond('tbl_user_bank_details',$whr='',$clms='*',$order_by);

			foreach($data['user_bank_details_data'] as $key=>$val){
			  $data['user_bank_details_data'][$key]->user_names=$this->CommonMdl->getRow('tbl_user','user_name,user_mobile_no',array('user_id'=>$val->user_id),'user_name');
			}
		}
    $this->load->view('admin/Excel/FacilityUserExcelExportView',$data);
		
}


public function facbankedit($bank_info_id){
     $data['user_bank_details_data']=$this->CommonMdl->getResultByCond('tbl_user_bank_details',array('bank_info_id'=>$bank_info_id),'*',$order_by='');
	 $data['user_bank_details_data'][0]->user_name=$this->CommonMdl->getRow('tbl_user','user_name',array('user_id'=>$data['user_bank_details_data'][0]->user_id),'user_name');
      $this->load->view('admin/facility/FacBankEditView',$data);
}


public function facilitybankupdate(){
  $dataArr=array(
     'admin_approval'=>$this->input->post('admin_approval'),
	 
  );
  
  $savebanner=$this->CommonMdl->updateData($dataArr,array('bank_info_id'=>$this->input->post('bank_id')),' tbl_user_bank_details');
  if($savebanner){
				    $this->session->set_flashdata('msg','Bank  updates sucesfully');
				    $this->session->set_flashdata('msg_class','bg-success');
					redirect('admin/facility/facbanklist');
				  
				  }  
				  
  
}

public function changefacilitybankstatus(){
 $dataArr= array(
	      'admin_approval'=>$this->input->post('status'),
	   );
	   
	   $res=$this->CommonMdl->updateData($dataArr,array('bank_info_id'=>$this->input->post('bank_info_id')),' tbl_user_bank_details');
	  
	   
	   if($res == 1){
		   echo "1";
	   }
	   else{
		   echo "0";
	   }

}


public function couponinsert($coupon_id=''){
	
	
	 $whr = array('coupon_id'=>$coupon_id);
	$data['editcoupondata'] = $this->CommonMdl->getRow('tbl_coupon','*',$whr);
	$data['alldata'] = $this->CommonMdl->getResult('tbl_coupon','*');
	$this->load->view('admin/coupon/CouponView',$data);
}
public function excelcoupon(){
		$data['coupondata'] = $this->CommonMdl->getResult('tbl_coupon','*');
		$this->load->view('admin/coupon/CouponExcel/CouponExcelView',$data);
		
}

public function add_coupoun(){
	
  $dataArr=array(				
				'coupon_name'=>$this->input->post('coupon_name'),
				'coupon_code'=>$this->input->post('coupon_code'),
				'cart_min_amount'=>$this->input->post('coupon_amount'),
				'coupon_flat_amount'=>$this->input->post('discount_flat'),
				'coupon_start_date'=>date('Y-m-d', strtotime($this->input->post('start_date'))),
				'coupon_end_date'=>date('Y-m-d', strtotime($this->input->post('end_date'))),
				'created_on'=>date("Y-m-d H:i:s"),
				'updated_on'=>date("Y-m-d H:i:s"),
				'created_by'=>$this->session->userdata['admin_id']
				);
			// print_data($dataArr);
				$Savebanner=$this->CommonMdl->insertRow($dataArr,'tbl_coupon');
				if($Savebanner){
				$this->session->set_flashdata('msg','Coupon insert successfully'); 
				$this->session->set_flashdata('msg_class','bg-success'); 
				redirect(base_url().'admin/facility/couponinsert');
				}	
}

public function edit_coupon(){
	$dataArrd=array(
                'coupon_name'=>$this->input->post('coupon_name'),	
				'coupon_code'=>$this->input->post('coupon_codes'),
				'cart_min_amount'=>$this->input->post('coupon_amounts'),
				'coupon_flat_amount'=>$this->input->post('discount_flats'),
				'coupon_start_date'=>date('Y-m-d', strtotime($this->input->post('start_date'))),
				'coupon_end_date'=>date('Y-m-d', strtotime($this->input->post('end_date'))),
				'updated_on'=>date("Y-m-d H:i:s"),
				'updated_by'=>$this->session->userdata['admin_id']
				);
				$whr = array('coupon_id'=>$this->input->post('coupon_id'));
				$Savebanner=$this->CommonMdl->updateData($dataArrd,$whr,'tbl_coupon');
				if($Savebanner){
				$this->session->set_flashdata('msg','Coupon update successfully'); 
				$this->session->set_flashdata('msg_class','bg-success'); 
				redirect(base_url().'admin/facility/couponinsert');
				}
	
}


 public function delete_coupon($coupon_id=''){
	 
        $whr = array('coupon_id'=>$coupon_id);
        if($this->CommonMdl->deleteRecord(' tbl_coupon',$whr)==true){
          $this->session->set_flashdata('msg','Coupon delete successfully'); 
          $this->session->set_flashdata('msg_class','bg-success');  
          redirect(base_url().'admin/facility/couponinsert');  
        }
    }
	
public function check_coupon_code(){
  $coupon_code = $this->input->post('coupon_code');
  $cond = array('coupon_code' => $coupon_code);
  $cond1 ='';
  

  $user_name=$this->CommonMdl->fetchNumRows('tbl_coupon',$cond,$cond1);
  if($user_name){
    echo "1";
  }
  else{
    echo "2";
  }
}




}

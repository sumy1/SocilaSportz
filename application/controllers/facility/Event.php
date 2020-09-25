<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends CI_Controller {

  public  function __construct()

  {
    parent::__construct();
    if(!$this->session->userdata('user_id')){
      redirect('login');
    }
    $this->load->model('public/FacilityMdl');

  }

  private function set_upload_options($path){ 
        // upload file options
    $config = array();
        $config['upload_path'] = "./$path/"; //give the path to upload the image in folder
        $config['allowed_types'] = '*';
        $config['max_size'] = '0';
        $config['overwrite'] = FALSE;
        return $config;
      }

      private function set_upload_options1($path){ 
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
      private function set_upload_options3($path){ 
        // upload file options
        $config = array();
        $config['upload_path'] = "./$path/"; //give the path to upload the image in folder
        $config['allowed_types'] = '*';
        $config['max_size'] = '0';
        $config['overwrite'] = FALSE;
        return $config;
      }
      private function set_upload_options4($path){ 
        // upload file options
        $config = array();
        $config['upload_path'] = "./$path/"; //give the path to upload the image in folder
        $config['allowed_types'] = '*';
        $config['max_size'] = '0';
        $config['overwrite'] = FALSE;
        return $config;
      }
      private function set_upload_options5($path){ 
        // upload file options
        $config = array();
        $config['upload_path'] = "./$path/"; //give the path to upload the image in folder
        $config['allowed_types'] = '*';
        $config['max_size'] = '0';
        $config['overwrite'] = FALSE;
        return $config;
      }
      private function set_upload_options6($path){ 
        // upload file options
        $config = array();
        $config['upload_path'] = "./$path/"; //give the path to upload the image in folder
        $config['allowed_types'] = '*';
        $config['max_size'] = '0';
        $config['overwrite'] = FALSE;
        return $config;
      }
      private function set_upload_options7($path){ 
        // upload file options
        $config = array();
        $config['upload_path'] = "./$path/"; //give the path to upload the image in folder
        $config['allowed_types'] = '*';
        $config['max_size'] = '0';
        $config['overwrite'] = FALSE;
        return $config;
      }


      public function index(){
        $this->load->view('public/facility-dashboard/event/EventView');
      }


      public function create_event(){
        $this->load->model('public/UserMdl');
        $fac_id = $this->input->post('fac_id');
        $data['fac_sports'] = $this->UserMdl->getFacSportList($fac_id);

        $data['amenity_list'] = $this->CommonMdl->getResultByCond('tbl_amenity',array('amenity_status'=>'enable'),'amenity_id,amenity_name,amenity_icon',array('col_name'=>'amenity_name','order'=>'asc'));
        $data['total_event_count']=$this->CommonMdl->fetchNumRows('tbl_booking_event_detail',array('fac_id'=>$fac_id ),$cond1='');
		
        $html['_html'] = $this->load->view('public/facility-dashboard/event/ajax/CreateEventView',$data,true);
        return $this->output->set_content_type('application/json')->set_output(json_encode($html));
      }



    public function event_view_model_ajax(){
		$booking_order_id=$this->input->post('booking_order_id');
		$data['old_booking_deatail']=$this->CommonMdl->getResultByCond('tbl_booking_order',array('booking_order_id'=>$booking_order_id,'booking_for'=>'event'),'*',$order_by='');				
	   foreach($data['old_booking_deatail'] as $bookingorderKey=>$bookingorderVal){
			$data['get_booking_event_betail']=$this->CommonMdl->getResultByCond('tbl_booking_event_detail',array('booking_order_id'=>$bookingorderVal->booking_order_id),'*',$order_by='');
			$data['old_booking_deatail'][$bookingorderKey]->booking_event_details=$data['get_booking_event_betail'];
			$data['get_facility']=$this->CommonMdl->getResultByCond('tbl_facility',array('fac_id'=>$data['old_booking_deatail'][$bookingorderKey]->booking_event_details[0]->fac_id),'fac_name,fac_id,fac_banner_image',$order_by='');
			$data['old_booking_deatail'][$bookingorderKey]->facility_listing=$data['get_facility'];
			$data['get_sport_listing']=$this->CommonMdl->getResultByCond('tbl_sport_list',array('sport_id'=>$data['old_booking_deatail'][$bookingorderKey]->booking_event_details[0]->event_sport_id),'sport_name',$order_by='');
			$data['old_booking_deatail'][$bookingorderKey]->sport_list=$data['get_sport_listing'];
		}
			$html['_html'] = $this->load->view('public/facility-dashboard/event/ajax/SingleEventBookingModelView',$data,true);
			return $this->output->set_content_type('application/json')->set_output(json_encode($html));
					
	  }
	  
	  




      public function eventListingcount(){
        
       $fac_id = $this->input->post('fac_id');

      $data['total_event_count']=$this->CommonMdl->fetchNumRows('tbl_event',array('fac_id'=>$fac_id),$cond1='');
        $data['total_confirmed_event']=$this->CommonMdl->fetchNumRows('tbl_event',array('fac_id'=>$fac_id,' event_approval'=>'approved'),$cond1='');
        $data['total_pending_event']=$this->CommonMdl->fetchNumRows('tbl_event',array('fac_id'=>$fac_id,'  event_approval'=>'pending'),$cond1='');
        $data['total_rejected_event']=$this->CommonMdl->fetchNumRows('tbl_event',array('fac_id'=>$fac_id,' event_approval'=>'rejected'),$cond1='');
echo  json_encode($data);
     
      }

      public function event_list_table(){
       $fac_id = $this->input->post('fac_id');
//print_data($_POST);
       if($this->input->post('action')=='event_filter'){
        $start_date = '';
        $end_date = '';
        if($this->input->post('from_date')!=''){
         $start_date=date('Y-m-d', strtotime($this->input->post('from_date')));
       }
       if($this->input->post('to_date')!=''){
         $end_date=date('Y-m-d', strtotime($this->input->post('to_date')));
       }
       $sport_id=$this->input->post('sport_id');

       $data['event_list'] = $this->FacilityMdl->getEventList($fac_id,$start_date,$end_date,$sport_id);
  //print_data($data['event_list']);

     } 
     else{
      $data['event_list'] = $this->FacilityMdl->getEventList($fac_id,$start_date='',$end_date='',$sport_id='');
    }

    $html['_html'] = $this->load->view('public/facility-dashboard/event/ajax/EventListView',$data,true);
    return $this->output->set_content_type('application/json')->set_output(json_encode($html));
  }


  public function insert_event(){
//print_data($_POST);
    if($this->input->post('action')=='event_form'){
      $event_banner['file_name'] = '';
      $path = "assets/public/images/event/banner";
      $this->upload->initialize($this->set_upload_options($path));
      if ($this->upload->do_upload('eventbanner')){
       $event_banner= $this->upload->data();

     }
	 
	 $event_name=strtolower(trim($this->input->post('event_name')));
	   $event_slug_name=str_replace(' ','-',$event_name);
	   $count_event_slug=$this->CommonMdl->fetchNumRows('tbl_event',array('event_slug'=>$event_slug_name),$cond1='');
		// echo $count_event_slug;
		if($count_event_slug>0){
			   $event_slug=$event_slug_name.'-'.$count_event_slug;
		}
		else{
			$event_slug = $event_slug_name;
		}
		
     $date_arr = array(
      'event_name' => $this->input->post('event_name'),
      'sport_id' => $this->input->post('sport_id'),
      'fac_id' => $this->input->post('fac_id'),
      'user_id' => $this->session->userdata('user_id'),
	   'event_slug' =>$event_slug,
      'event_start_date' => date('Y-m-d', strtotime($this->input->post('event_start_date'))),
      'event_end_date' => date('Y-m-d', strtotime($this->input->post('event_end_date'))),
      'event_start_time' => $this->input->post('event_start_time'),
      'event_end_time' => $this->input->post('event_end_time'),
      'application_start_date' => date('Y-m-d', strtotime($this->input->post('application_start_date'))),
      'application_end_date' => date('Y-m-d', strtotime($this->input->post('application_end_date'))),
      'event_price' => $this->input->post('event_price'),
      'event_max_capicity_per_day' => $this->input->post('event_max_capicity_per_day'),
      'event_venue' => $this->input->post('event_venue'),
      'event_city' => $this->input->post('event_city'),
      'event_latitude' => $this->input->post('latitude'),
      'event_longitude' => $this->input->post('longitude'),
      'Event_contact_person' => $this->input->post('Event_contact_person'),
      'event_contact_person_no' => $this->input->post('event_contact_person_no'),
      'Event_contact_person_email' => $this->input->post('Event_contact_person_email'),
      'event_description' => $this->input->post('event_description'),
      'event_banner' => $event_banner['file_name'],
      'event_eligibility' => $this->input->post('event_eligibility'),
      'created_on' => date("Y-m-d H:i:s"),
      'updated_on' => date("Y-m-d H:i:s")
    );
	 // print_data($date_arr);

     $last_event_insert_id = $this->CommonMdl->insertRow($date_arr,'tbl_event');
     if($last_event_insert_id!=''){

      for ($i=0; $i < count($this->input->post('amenity')); $i++) {
       $amenityArr[] = array(
         'amenity_id' => $this->input->post('amenity')[$i],
         'event_id' =>  $last_event_insert_id,
         'created_on' =>date("Y-m-d H:i:s"),
         'updated_on' =>date("Y-m-d H:i:s")
       );
     }
        //$this->CommonMdl->deleteRecord('tbl_facility_amenities',$whr);
     $res = $this->CommonMdl->insertinbatch($amenityArr,'tbl_event_amenities');

     $gallery = array();
     for ($i=0; $i < count($_FILES['gallery']['name']); $i++) { 
      if($_FILES['gallery']['name'][$i]!=''){
        $_FILES['file']['name']     = $_FILES['gallery']['name'][$i];
        $_FILES['file']['type']     = $_FILES['gallery']['type'][$i];
        $_FILES['file']['tmp_name'] = $_FILES['gallery']['tmp_name'][$i];
        $_FILES['file']['error']     = $_FILES['gallery']['error'][$i];
        $_FILES['file']['size']     = $_FILES['gallery']['size'][$i];
        $path = "assets/public/images/event/gallery";
        $this->upload->initialize($this->set_upload_options($path));
        if ($this->upload->do_upload('file')){
         $gallery_image= $this->upload->data();
       }
 // echo $_FILES['gallery']['name'][$i];

       $gallery[] = array(
        'image' =>$gallery_image['file_name'],
        'event_id' =>$last_event_insert_id,
        'create_on' => date("Y-m-d H:i:s"),
        'update_on' => date("Y-m-d H:i:s") 
      );
     }
   }
   if(!empty($gallery)){
     $this->CommonMdl->insertinbatch($gallery,'tbl_event_gallery');
   }
   echo "1";
 }
 else{
  echo "failed";
}

}
}

public function event_edit_model(){
  //print_r($_POST);
  $this->load->model('public/UserMdl');
  $data['fac_sports'] = $this->UserMdl->getFacSportList($this->input->post('fac_id'));
  $data['amenity_list'] = $this->CommonMdl->getResultByCond('tbl_amenity',array('amenity_status'=>'enable'),'amenity_id,amenity_name,amenity_icon',array('col_name'=>'amenity_name','order'=>'asc'));
  $data['event_detail'] = $this->CommonMdl->getRow('tbl_event','*',array('event_id'=>$this->input->post('event_id')));
  $data['event_amenity'] = $this->CommonMdl->getResultByCond('tbl_event_amenities',array('event_id'=>$this->input->post('event_id')),'amenity_id',$order_by='');


 // print_data($data['event_gallery']);
  $html['_html'] = $this->load->view('public/facility-dashboard/event/ajax/EventEditView',$data,true);
  return $this->output->set_content_type('application/json')->set_output(json_encode($html));
}

public function event_gallery_model(){
  //print_r($_POST);
  $data['event_id'] = $this->input->post('event_id');
  $data['event_gallery'] = $this->CommonMdl->getResultByCond('tbl_event_gallery',array('event_id'=>$this->input->post('event_id')),'image,event_id',$order_by='');

 // print_data($data['event_gallery']);
  $html['_html'] = $this->load->view('public/facility-dashboard/event/ajax/EventGalleryEditView',$data,true);
  return $this->output->set_content_type('application/json')->set_output(json_encode($html));
}

public function update_event_info(){

  //print_data($_POST);

  if($this->input->post('action')=='event_update_info'){
   $event_banner['file_name'] = '';
   $new_banner = $_FILES['eventbanner']['name'];
   $path = "assets/public/images/event/banner";
   $this->upload->initialize($this->set_upload_options($path));
   if ($this->upload->do_upload('eventbanner')){
     $event_banner= $this->upload->data();

   }
   else if($new_banner==''){
    $event_banner['file_name']=$this->input->post('old_event_banner');
  }
  $date_arr = array(
    'event_name' => $this->input->post('event_name'),
    'sport_id' => $this->input->post('sport_id'),
    'event_start_date' => date('Y-m-d', strtotime($this->input->post('event_start_date'))),
    'event_end_date' => date('Y-m-d', strtotime($this->input->post('event_end_date'))),
    'event_start_time' => $this->input->post('event_start_time'),
    'event_end_time' => $this->input->post('event_end_time'),
    'application_start_date' => date('Y-m-d', strtotime($this->input->post('application_start_date'))),
    'application_end_date' => date('Y-m-d', strtotime($this->input->post('application_end_date'))),
    'event_price' => $this->input->post('event_price'),
    'event_max_capicity_per_day' => $this->input->post('event_max_capicity_per_day'),
    'event_venue' => $this->input->post('event_venue'),
    'event_city' => $this->input->post('event_city'),
    'event_latitude' => $this->input->post('latitude'),
    'event_longitude' => $this->input->post('longitude'),
    'Event_contact_person' => $this->input->post('event_contact_person'),
    'event_contact_person_no' => $this->input->post('event_contact_person_no'),
    'Event_contact_person_email' => $this->input->post('event_contact_person_email'),
    'event_description' => $this->input->post('event_description'),
    'event_banner' => $event_banner['file_name'],
    'event_eligibility' => $this->input->post('event_eligibility'),
    'event_status' => $this->input->post('event_status'),
    'updated_on' => date("Y-m-d H:i:s")
  );
//print_data($date_arr);

  $this->CommonMdl->updateData($date_arr,array('event_id'=>$this->input->post('event_id')),'tbl_event');

  for ($i=0; $i < count($this->input->post('amenity')); $i++) {
   $amenityArr[] = array(
     'amenity_id' => $this->input->post('amenity')[$i],
     'event_id' =>  $this->input->post('event_id'),
     'created_on' =>date("Y-m-d H:i:s"),
     'updated_on' =>date("Y-m-d H:i:s")
   );
 }
 $this->CommonMdl->deleteRecord('tbl_event_amenities',array('event_id'=>$this->input->post('event_id')));
 $res = $this->CommonMdl->insertinbatch($amenityArr,'tbl_event_amenities');


 if( $res){
  echo "1";
}
else{
  echo "failed";
}

}
}

public function update_event_gallery(){
  //print_data($_FILES);
  $event_id = $this->input->post('event_id');
  $gallery_image1 = '';
  $gallery_image2 = '';
  $gallery_image3 = '';
  $gallery_image4 = '';
  $gallery_image5 = '';
  $gallery_image6 = '';
  $gallery_image7 = '';
  $gallery_image8 = '';

  $new_gallery_image1 = $_FILES['gallery1']['name'];
  $new_gallery_image2 = $_FILES['gallery2']['name'];
  $new_gallery_image3= $_FILES['gallery3']['name'];
  $new_gallery_image4 = $_FILES['gallery4']['name'];
  $new_gallery_image5 = $_FILES['gallery5']['name'];
  $new_gallery_image6 = $_FILES['gallery6']['name'];
  $new_gallery_image7 = $_FILES['gallery7']['name'];
  $new_gallery_image8 = $_FILES['gallery8']['name'];
  
  $path = "assets/public/images/event/gallery";
  $this->upload->initialize($this->set_upload_options($path));
  if ($this->upload->do_upload('gallery1')){
   $gallery_image1= $this->upload->data();
   $gallery_image1_1 = $gallery_image1['file_name'];
 }

 else if($new_gallery_image1==''){
   $gallery_image1_1=$this->input->post('old_gallery1');
 }

 $this->upload->initialize($this->set_upload_options1($path));
 if ($this->upload->do_upload('gallery2')){
  $gallery_image2= $this->upload->data();
  $gallery_image2_2 = $gallery_image2['file_name'];
}

else if($new_gallery_image2==''){
  $gallery_image2_2=$this->input->post('old_gallery2');
}

$this->upload->initialize($this->set_upload_options2($path));
if ($this->upload->do_upload('gallery3')){
  $gallery_image3= $this->upload->data();
  $gallery_image3_3 = $gallery_image3['file_name'];
}
else if($new_gallery_image3==''){
  $gallery_image3_3=$this->input->post('old_gallery3');
}


$this->upload->initialize($this->set_upload_options3($path));
if ($this->upload->do_upload('gallery4')){
  $gallery_image4= $this->upload->data();
  $gallery_image4_4 = $gallery_image4['file_name'];
}
else if($new_gallery_image4==''){
  $gallery_image4_4=$this->input->post('old_gallery4');
}

$this->upload->initialize($this->set_upload_options4($path));
if ($this->upload->do_upload('gallery5')){
  $gallery_image5= $this->upload->data();
  $gallery_image5_5 = $gallery_image5['file_name'];
}
else if($new_gallery_image5==''){
  $gallery_image5_=$this->input->post('old_gallery5');
}

$this->upload->initialize($this->set_upload_options5($path));
if ($this->upload->do_upload('gallery6')){
  $gallery_image6= $this->upload->data();
  $gallery_image6_6 = $gallery_image6['file_name'];
}
else if($new_gallery_image6==''){
  $gallery_image6=$this->input->post('old_gallery6');
}

$this->upload->initialize($this->set_upload_options6($path));
if ($this->upload->do_upload('gallery7')){
  $gallery_image7= $this->upload->data();
  $gallery_image7_7 = $gallery_image7['file_name'];
}
else if($new_gallery_image7==''){
  $gallery_image_7=$this->input->post('old_gallery7');
}

$this->upload->initialize($this->set_upload_options7($path));
if ($this->upload->do_upload('gallery8')){
  $gallery_image8= $this->upload->data();
  $gallery_image8_8 = $gallery_image8['file_name'];
}
else if($new_gallery_image8==''){
  $gallery_image8_8=$this->input->post('old_gallery8');
}
$del=$this->CommonMdl->deleteRecord('tbl_event_gallery',array('event_id'=>$event_id));

if($gallery_image1_1!=''){
 $gallery_arr = array( 
  'image' =>$gallery_image1_1,
  'event_id' =>$event_id,
  'create_on' => date("Y-m-d H:i:s"),
  'update_on' => date("Y-m-d H:i:s") 

);
 $res=$this->CommonMdl->insertRow($gallery_arr,'tbl_event_gallery');
}
if($gallery_image2_2!=''){
 $gallery_arr = array(  
  'image' => $gallery_image2_2,
  'event_id' =>$event_id,
  'create_on' => date("Y-m-d H:i:s"),
  'update_on' => date("Y-m-d H:i:s") 
);
 $res=$this->CommonMdl->insertRow($gallery_arr,'tbl_event_gallery');
}

if($gallery_image3_3!=''){
 $gallery_arr = array(  
  'image' => $gallery_image3_3,
  'event_id' =>$event_id,
  'create_on' => date("Y-m-d H:i:s"),
  'update_on' => date("Y-m-d H:i:s") 
);
 $res=$this->CommonMdl->insertRow($gallery_arr,'tbl_event_gallery');
}
if($gallery_image4_4!=''){
 $gallery_arr = array(  
  'image' => $gallery_image4_4,
  'event_id' =>$event_id,
  'create_on' => date("Y-m-d H:i:s"),
  'update_on' => date("Y-m-d H:i:s") 
);
 $res=$this->CommonMdl->insertRow($gallery_arr,'tbl_event_gallery');
}
if($gallery_image5_5!=''){
 $gallery_arr = array(  
  'image' => $gallery_image5_5,
  'event_id' =>$event_id,
  'create_on' => date("Y-m-d H:i:s"),
  'update_on' => date("Y-m-d H:i:s") 
);
 $res=$this->CommonMdl->insertRow($gallery_arr,'tbl_event_gallery');
}
if($gallery_image6_6!=''){
 $gallery_arr = array(  
  'image' => $gallery_image6_6,
  'event_id' =>$event_id,
  'create_on' => date("Y-m-d H:i:s"),
  'update_on' => date("Y-m-d H:i:s") 
);
 
 $res=$this->CommonMdl->insertRow($gallery_arr,'tbl_event_gallery');
}
if($gallery_image7_7!=''){
 $gallery_arr = array(  
  'image' => $gallery_image7_7,
  'event_id' =>$event_id,
  'create_on' => date("Y-m-d H:i:s"),
  'update_on' => date("Y-m-d H:i:s") 
);
 $res=$this->CommonMdl->insertRow($gallery_arr,'tbl_event_gallery');
}
if($gallery_image8_8!=''){
 $gallery_arr = array(  
  'image' => $gallery_image8_8,
  'event_id' =>$event_id,
  'create_on' => date("Y-m-d H:i:s"),
  'update_on' => date("Y-m-d H:i:s") 
);
 $res=$this->CommonMdl->insertRow($gallery_arr,'tbl_event_gallery');
}
if($res){
  echo "1";
}
else{
  echo "failed";
}
}

 public function event_booking_list(){
    $fac_id = $this->input->post('fac_id');

    if($this->input->post('action')=='event_booking_filter'){
      $start_date = '';
      $end_date = '';
      if($this->input->post('from_date')!=''){
       $start_date=date('Y-m-d', strtotime($this->input->post('from_date')));
     }
     if($this->input->post('to_date')!=''){
       $end_date=date('Y-m-d', strtotime($this->input->post('to_date')));
     }
     $sport_id=$this->input->post('sport_id');

     $data['event_booking_list'] = $this->FacilityMdl->getEventBookingList($fac_id,$start_date,$end_date,$sport_id);
   } 
   else{
    $data['event_booking_list'] = $this->FacilityMdl->getEventBookingList($fac_id,$start_date='',$end_date='',$sport_id='');
  }
  //print_data($data);
  $html['_html'] = $this->load->view('public/facility-dashboard/event/ajax/EventBookingListView',$data,true);
  return $this->output->set_content_type('application/json')->set_output(json_encode($html));
}

}
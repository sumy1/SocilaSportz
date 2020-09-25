<?php
ini_set('display_error',0);
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public  function __construct()

    {
   	    parent::__construct();
   	    if(!$this->session->userdata('user_id')){
            redirect('login');
        }

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

		if($this->session->userdata('user_role')==2){
   		$this->load->view('public/facility-dashboard/FacilityDashboardView');
    }

  else if($this->session->userdata('user_role')==1){
        $this->load->view('public/user-dashboard/UserDashboardView');
  }
}

  public function accountinfo(){
  $user_id = $this->session->userdata['user_id'];
  $whr = array('user_id'=>$user_id);
   /*profile completion status*/
    $profile_percent1 = 0;
    $profile_percent2 = 0;
    $profile_percent3 = 0;
    $profile_percent4 = 0;
    $profile_percent5 = 0;
    $profile_percent6 = 0;
  
    $user_info=$this->CommonMdl->getRow('tbl_user','*',array('user_id'=>$this->session->userdata['user_id']));

    $user_facility=$this->CommonMdl->getResultByCond('tbl_facility',array('user_id'=>$this->session->userdata['user_id']),'fac_id','');
    if(count($user_facility)>0){
     @$user_sport_count=$this->CommonMdl->fetchNumRows('tbl_facility_sport',array('fac_id'=>$user_facility[0]->fac_id),'');
    }
    @$user_amenity_count=$this->CommonMdl->fetchNumRows('tbl_facility_amenities',array('user_id'=>$this->session->userdata['user_id']),'');
    @$user_bank_info_count=$this->CommonMdl->fetchNumRows('tbl_user_bank_details',array('user_id'=>$this->session->userdata['user_id']),'');
    if($user_info->user_pincode!=''){
      $profile_percent1=5;
    }
     if($user_info->is_email_verified=='yes'){
      $profile_percent2=10;
    }
    if(count(@$user_facility)>0){
      $profile_percent3=30;
    }
     if(@$user_sport_count>0){
      $profile_percent4=20;
    }
    if(@$user_amenity_count>0){
      $profile_percent5=10;
    }
    if(@$user_bank_info_count>0){
      $profile_percent6=10;
    }
$data['profile_percent']=15+$profile_percent1+$profile_percent2+$profile_percent3+$profile_percent4+$profile_percent5+$profile_percent6;

  $data['fac_personal_data'] = $this->CommonMdl->getRow('tbl_user','*',$whr);
    $this->load->view('public/facility-dashboard/AccountInfoView',$data);

  }

public function getfacDetails(){
   $data['fac_count']=$this->CommonMdl->fetchNumRows('tbl_facility',array('user_id'=>$this->session->userdata['user_id']),$cond1='');
    if($this->input->post('action') =='fac_details')
  {
  $data['fac_details'] = $this->CommonMdl->getRow('tbl_facility','*',array('fac_id'=>$this->input->post('fac_id')));
  $data['reward_details'] = $this->CommonMdl->getResultByCond('tbl_facility_reward_achievement',array('fac_id'=>$this->input->post('fac_id')),'*',$order_by='');
  //print_data($data['reward_details']);
  /*$data['reward_type'] = $this->CommonMdl->getRow('tbl_reward_achievement','reward_name',array('reward_id'=>$data['reward_details'][0]->reward_id));*/
  
  $data['rewards_type'] = $this->CommonMdl->getResultByCond('tbl_reward_achievement',array('reward_status'=>'enable'),'reward_id,reward_name',array('col_name'=>'reward_name','order'=>'asc'));
  // print_data($data['rewards_type']);
  
  
   $html['_html'] = $this->load->view('public/facility-dashboard/ajax/FacdetailView',$data,true);
   return $this->output->set_content_type('application/json')->set_output(json_encode($html));
  }

 if($this->input->post('action') =='sport_aminity')
{
  $this->load->model('public/UserMdl');
  $data['sport_master'] = $this->CommonMdl->getResultByCond('tbl_sport_list',array('sport_status'=>'enable'),'sport_id,sport_name',$order_by='');
  $data['sport_list'] = $this->UserMdl->getFacSportList($this->input->post('fac_id'));
  $data['aminity_list'] = $this->UserMdl->getFacaminityList($this->session->userdata['user_id']);
 //print_data($data['aminity_list']);
  $html['_html'] = $this->load->view('public/facility-dashboard/ajax/FacSportAminityView',$data,true);
   return $this->output->set_content_type('application/json')->set_output(json_encode($html));
  }
if($this->input->post('action') =='sport_opening_closing')
{
  $this->load->model('public/UserMdl');
  
  $data['fac_id']  = $this->input->post('fac_id');
  $data['fac_timing'] = $this->CommonMdl->getResultByCond('tbl_facility_timing',array('fac_id'=>$this->input->post('fac_id')),$clms='*',$order_by='');
  $html['_html'] = $this->load->view('public/facility-dashboard/ajax/FacTimingView',$data,true);
   return $this->output->set_content_type('application/json')->set_output(json_encode($html));
  }

  if($this->input->post('action') =='fac_gallery')
{
  $this->load->model('public/UserMdl');
  $data['fac_gallery'] = $this->CommonMdl->getResultByCond('tbl_facility_gallery',array('fac_id'=>$this->input->post('fac_id')),$clms='*',$order_by='');
  $html['_html'] = $this->load->view('public/facility-dashboard/ajax/FacGalleryView',$data,true);
   return $this->output->set_content_type('application/json')->set_output(json_encode($html));
  }

   if($this->input->post('action') =='fac_bank')
{
  $this->load->model('public/UserMdl');
  $data['fac_bank'] = $this->CommonMdl->getRow('tbl_user_bank_details',$clms='*',array('user_id'=>$this->session->userdata['user_id']));
  $html['_html'] = $this->load->view('public/facility-dashboard/ajax/FacBankInfoView',$data,true);
   return $this->output->set_content_type('application/json')->set_output(json_encode($html));
  }


}

/*Update Info*/

public function update_fac_info(){
  $user_id=$this->session->userdata['user_id'];
      if($this->input->post('action') =='persoanl_info')
    {
         $user_arr = array(
                    'user_name' => $this->input->post('name'),
                    'user_email' => $this->input->post('email'),
                    'user_gender' => $this->input->post('gender'),
                    'user_mobile_no' => $this->input->post('phone'),
                    'user_city' => $this->input->post('city'),
                    'user_pincode' => $this->input->post('pincode'),
                    'user_address' => $this->input->post('address1'),
                    'user_address2' => $this->input->post('address2'),
                    'updated_by' =>$user_id,
                    'updated_on' => date("Y-m-d H:i:s"),
                    );
             $res=$this->CommonMdl->updateData($user_arr,array('user_id'=>$user_id),'tbl_user');
             if($res){
              echo "1";
             }
             else{
              echo "failed";
             }
    }
   if($this->input->post('action') =='fac_info_edit')
  {
    $facility_id =$this->input->post('fac_id');
  //$fac_logo['file_name']='';
  $fac_banner['file_name']='';

  $new_fac_banner = $_FILES['fac_banner']['name'];
  //$new_fac_logo = $_FILES['fac_logo']['name'];
  
  $path = "assets/public/images/fac";
           $this->upload->initialize($this->set_upload_options($path));
           if ($this->upload->do_upload('fac_banner')){
             $fac_banner= $this->upload->data();
             }

             else if($new_fac_banner==''){
          $fac_banner['file_name']=$this->input->post('old_fac_banner');
         }

        /*  $this->upload->initialize($this->set_upload_options1($path));
          if ($this->upload->do_upload('fac_logo')){
            $fac_logo= $this->upload->data();
        }

          else if($new_fac_logo==''){
          $fac_logo['file_name']=$this->input->post('old_fac_logo');
         }*/
       
           $update_fac_arr = array(
              'fac_name' => $this->input->post('facilityname'),
              'fac_description' => $this->input->post('fac_text'),
              'fac_city' => $this->input->post('fac_city'),
              'fac_latitude' => $this->input->post('latitude'),
              'fac_longitude' => $this->input->post('longitude'),
              'fac_pincode' => $this->input->post('fac_pincode'),
              'fac_address' => $this->input->post('fac_address'),
              'fac_banner_image' => $fac_banner['file_name'],
              //'fac_logo_image' => $fac_logo['file_name'],
              'updated_by_type' => 'user',
              'updated_on' => date("Y-m-d H:i:s")
              );
           
          $res=$this->CommonMdl->updateData($update_fac_arr,array('fac_id'=>$this->input->post('fac_id')),'tbl_facility');
          if($res){
            echo "success";
          }
          else{
            echo "failed";
          }
    }


    if($this->input->post('action') =='achievement_info_update')
  {

  $image1['file_name']='';
  $image2['file_name']='';

  $new_image1 = $_FILES['image1']['name'];
  $new_image2 = $_FILES['image2']['name'];
  
  $path = "assets/public/images/rewards";
           $this->upload->initialize($this->set_upload_options($path));
           if ($this->upload->do_upload('image1')){
             $image1= $this->upload->data();
             }

             else if($new_image1==''){
          $image1['file_name']=$this->input->post('old_image1');
         }

          $this->upload->initialize($this->set_upload_options1($path));
          if ($this->upload->do_upload('image2')){
            $image2= $this->upload->data();
        }

          else if($new_image2==''){
          $image2['file_name']=$this->input->post('old_image2');
         }
       
           $data = array(
              'reward_title' => $this->input->post('title'),
              'reward_id' => $this->input->post('reward_type'),
              'image1' => $image1['file_name'],
              'image2' => $image2['file_name'],
              'updated_on' => date("Y-m-d H:i:s")
              );
         //print_data($data);
           
          $res=$this->CommonMdl->updateData($data,array('reward_achievement_id'=>$this->input->post('reward_achievement_id')),' tbl_facility_reward_achievement');
          //echo $this->db->last_query();die();
          if($res){
            echo "success";
          }
          else{
            echo "failed";
          }
    }

     if($this->input->post('action') =='sport_edit')
    {
         $data = array(
                    'sport_court' => $this->input->post('sport_court'),
                    'sport_indor' => $this->input->post('sport_indor'),
                    'sport_outdor' => $this->input->post('sport_outdor'),
                    'sport_id' => $this->input->post('sport_id'),
                    'updated_on' => date("Y-m-d H:i:s"),
                    );
       // print_data($_POST);
             $res=$this->CommonMdl->updateData($data,array('fac_sport_id'=>$this->input->post('fac_sport_id')),'tbl_facility_sport');
            // echo $this->db->last_query();
             if($res){
              echo "1";
             }
             else{
              echo "failed";
             }
    }

    if($this->input->post('action') =='amenity_edit')
    {
      //print_data($_POST);
         $amenity_ids=$this->input->post('amenity_ids');
    $amenity_id=explode(',', $amenity_ids);
    //print_r($amenity_id);
    for ($i=0; $i < count($amenity_id); $i++) {
     $amenityArr[] = array(
           'amenity_id' => $amenity_id[$i],
           'user_id' => $user_id,
           'user_id' => $user_id,
           'created_on' =>date("Y-m-d H:i:s"),
           'updated_on' =>date("Y-m-d H:i:s")
         );
       }
//print_data($amenityArr);
       $whr = array('user_id'=>$user_id);
        $this->CommonMdl->deleteRecord('tbl_facility_amenities',$whr);
       $res = $this->CommonMdl->insertinbatch($amenityArr,'tbl_facility_amenities');
       if($res){
            echo "1";
           }
           else{
            echo "failed";
           }
    }



     if($this->input->post('action') =='fac_timing_edit')
    {
   // print_data($_POST);
      $fac_timming_array = array();
           for ($j=0; $j < count($this->input->post('fac_timing')) ; $j++) { 
             $fac_timing = $this->input->post('fac_timing')[$j];
             $exp_fac_timing = explode('-', $fac_timing);

             //print_r($exp_fac_timing);
          
              $fac_timming_array[] = array(
                 'fac_id' =>$this->input->post('fac_id'),
                 'day' => $exp_fac_timing[0],
                 'open_time' => $exp_fac_timing[1],
                 'close_time' => $exp_fac_timing[2],
                 'created_on' =>date("Y-m-d H:i:s"),
                 'updated_on' =>date("Y-m-d H:i:s")
               ); 
           }
          // print_data($fac_timming_array);
           $this->CommonMdl->deleteRecord('tbl_facility_timing',array('fac_id'=>$this->input->post('fac_id')));
          $res= $this->CommonMdl->insertinbatch($fac_timming_array,'tbl_facility_timing');
          if($res){
            echo "success";
          }
          else{
            echo "failed";
          }
    }


     if($this->input->post('action') =='bank_info_update')
  {
    
  $gst_image['file_name']='';
  $pan_image['file_name']='';
  $firm_image['file_name']='';
  $address_proof_image['file_name']='';
  $cheque_image['file_name']='';

  $new_gst_image = $_FILES['gst_image']['name'];
  $new_pan_image = $_FILES['pan_image']['name'];
  $new_firm_image = $_FILES['firm_image']['name'];
  $new_address_proof_image = $_FILES['address_proof_image']['name'];
  $new_cheque_image = $_FILES['cheque_image']['name'];
  
  $path = "assets/public/images/bankinfo";
           $this->upload->initialize($this->set_upload_options($path));
               if ($this->upload->do_upload('gst_image')){
                 $gst_image= $this->upload->data();
                 }

                 else if($new_gst_image==''){
                 $gst_image['file_name']=$this->input->post('old_gst_image');
                }

              $this->upload->initialize($this->set_upload_options1($path));
              if ($this->upload->do_upload('pan_image')){
                $pan_image= $this->upload->data();
                }

              else if($new_pan_image==''){
              $pan_image['file_name']=$this->input->post('old_pan_image');
             }

              $this->upload->initialize($this->set_upload_options2($path));
              if ($this->upload->do_upload('firm_image')){
                $firm_image= $this->upload->data();
            }
              else if($new_firm_image==''){
              $firm_image['file_name']=$this->input->post('old_firm_image');
             }


         $this->upload->initialize($this->set_upload_options3($path));
          if ($this->upload->do_upload('address_proof_image')){
            $address_proof_image= $this->upload->data();
        }
          else if($new_address_proof_image==''){
          $address_proof_image['file_name']=$this->input->post('old_address_proof_image');
         }

         $this->upload->initialize($this->set_upload_options4($path));
          if ($this->upload->do_upload('cheque_image')){
            $cheque_image= $this->upload->data();
        }
          else if($new_cheque_image==''){
          $cheque_image['file_name']=$this->input->post('old_cheque_image');
         }
       
           $update_bank_arr = array(
              'ifsc_code' => $this->input->post('ifsc_code'),
              'user_id' => $user_id,
              'bank_name' => $this->input->post('bank_name'),
              'account_type' => $this->input->post('account_type'),
              'branch_address' => $this->input->post('branch_address'),
              'account_name' => $this->input->post('account_name'),
              'account_number' => $this->input->post('account_number'),
              'gst_no' => $this->input->post('gst_no'),
              'pan_no' => $this->input->post('pan_no'),
              'cin_no' => $this->input->post('business_registration_no'),
              'gst_image' => $gst_image['file_name'],
              'pan_image' => $pan_image['file_name'],
              'firm_image' => $firm_image['file_name'],
              'cheque_image' => $cheque_image['file_name'],
              'address_proof_image' => $address_proof_image['file_name'],
              'updated_on' => date("Y-m-d H:i:s")
              );
           //print_data($update_bank_arr);
         // $res=$this->CommonMdl->updateData($update_bank_arr,array('user_id'=>$user_id),'tbl_user_bank_details');
           $this->CommonMdl->deleteRecord('tbl_user_bank_details',array('user_id'=>$user_id));
        $res=$this->CommonMdl->insertRow($update_bank_arr,'tbl_user_bank_details');
          if($res){
            echo "success";
          }
          else{
            echo "failed";
          }
    }


      if($this->input->post('action') =='gallery_info_update')
  {
    //print_data($_POST);
   // print_data($_FILES);
  $fac_id = $this->input->post('fac_id');
  $gallery_image1 = '';
  $gallery_image2 = '';
  $gallery_image3 = '';
  $gallery_image4 = '';
  $gallery_image5 = '';
  $gallery_image6 = '';
  $gallery_image7 = '';
  $gallery_image8 = '';

  $new_gallery_image1 = $_FILES['gallery_image1']['name'];
  $new_gallery_image2 = $_FILES['gallery_image2']['name'];
  $new_gallery_image3= $_FILES['gallery_image3']['name'];
  $new_gallery_image4 = $_FILES['gallery_image4']['name'];
  $new_gallery_image5 = $_FILES['gallery_image5']['name'];
  $new_gallery_image6 = $_FILES['gallery_image6']['name'];
  $new_gallery_image7 = $_FILES['gallery_image7']['name'];
  $new_gallery_image8 = $_FILES['gallery_image8']['name'];
  
  $path = "assets/public/images/gallery";
           $this->upload->initialize($this->set_upload_options($path));
               if ($this->upload->do_upload('gallery_image1')){
                 $gallery_image1= $this->upload->data();
                 $gallery_image1_1 = $gallery_image1['file_name'];
                 }

                 else if($new_gallery_image1==''){
                 $gallery_image1_1=$this->input->post('old_gallery_image1');
                }

              $this->upload->initialize($this->set_upload_options1($path));
              if ($this->upload->do_upload('gallery_image2')){
                $gallery_image2= $this->upload->data();
                $gallery_image2_2 = $gallery_image2['file_name'];
                }

              else if($new_gallery_image2==''){
              $gallery_image2_2=$this->input->post('old_gallery_image2');
             }

              $this->upload->initialize($this->set_upload_options2($path));
              if ($this->upload->do_upload('gallery_image3')){
                $gallery_image3= $this->upload->data();
                $gallery_image3_3 = $gallery_image3['file_name'];
            }
              else if($new_gallery_image3==''){
              $gallery_image3_3=$this->input->post('old_gallery_image3');
             }


         $this->upload->initialize($this->set_upload_options3($path));
          if ($this->upload->do_upload('gallery_image4')){
            $gallery_image4= $this->upload->data();
            $gallery_image4_4 = $gallery_image4['file_name'];
        }
          else if($new_gallery_image4==''){
          $gallery_image4_4=$this->input->post('old_gallery_image4');
         }

         $this->upload->initialize($this->set_upload_options4($path));
          if ($this->upload->do_upload('gallery_image5')){
            $gallery_image5= $this->upload->data();
            $gallery_image5_5 = $gallery_image5['file_name'];
        }
          else if($new_gallery_image5==''){
          $gallery_image5_5=$this->input->post('old_gallery_image5');
         }

         $this->upload->initialize($this->set_upload_options5($path));
          if ($this->upload->do_upload('gallery_image6')){
            $gallery_image6= $this->upload->data();
            $gallery_image6_6 = $gallery_image6['file_name'];
        }
          else if($new_gallery_image6==''){
          $gallery_image6_6=$this->input->post('old_gallery_image6');
         }

          $this->upload->initialize($this->set_upload_options6($path));
          if ($this->upload->do_upload('gallery_image7')){
            $gallery_image7= $this->upload->data();
            $gallery_image7_7 = $gallery_image7['file_name'];
        }
          else if($new_gallery_image7==''){
          $gallery_image7_7=$this->input->post('old_gallery_image7');
         }

         $this->upload->initialize($this->set_upload_options7($path));
          if ($this->upload->do_upload('gallery_image8')){
            $gallery_image8= $this->upload->data();
            $gallery_image8_8 = $gallery_image8['file_name'];
        }
          else if($new_gallery_image8==''){
          $gallery_image8_8=$this->input->post('old_gallery_image8');
         }
        $del=$this->CommonMdl->deleteRecord('tbl_facility_gallery',array('fac_id'=>$fac_id));
         
          if($gallery_image1_1!=''){
           $gallery_arr = array(  
              'gallery_image' => $gallery_image1_1,
              'fac_id' => $fac_id,
              'updated_on' => date("Y-m-d H:i:s"),
              'created_on' => date("Y-m-d H:i:s"),
              'updated_by' => $user_id,
              'created_by' => $user_id,
              );
          // print_data($gallery_arr);
          $res=$this->CommonMdl->insertRow($gallery_arr,'tbl_facility_gallery');
           }
            if($gallery_image2_2!=''){
           $gallery_arr = array(  
              'gallery_image' => $gallery_image2_2,
              'fac_id' => $fac_id,          
              'updated_on' => date("Y-m-d H:i:s"),
              'created_on' => date("Y-m-d H:i:s"),
              'updated_by' => $user_id,
              'created_by' => $user_id,
              );
           $res=$this->CommonMdl->insertRow($gallery_arr,'tbl_facility_gallery');
           }

             if($gallery_image3_3!=''){
           $gallery_arr = array(  
              'gallery_image' => $gallery_image3_3,
              'fac_id' => $fac_id,          
              'updated_on' => date("Y-m-d H:i:s"),
              'created_on' => date("Y-m-d H:i:s"),
              'updated_by' => $user_id,
              'created_by' => $user_id,
              );
           $res=$this->CommonMdl->insertRow($gallery_arr,'tbl_facility_gallery');
           }
             if($gallery_image4_4!=''){
           $gallery_arr = array(  
              'gallery_image' => $gallery_image4_4,
              'fac_id' => $fac_id,          
              'updated_on' => date("Y-m-d H:i:s"),
              'created_on' => date("Y-m-d H:i:s"),
              'updated_by' => $user_id,
              'created_by' => $user_id,
              );
           $res=$this->CommonMdl->insertRow($gallery_arr,'tbl_facility_gallery');
           }
             if($gallery_image5_5!=''){
           $gallery_arr = array(  
              'gallery_image' => $gallery_image5_5,
              'fac_id' => $fac_id,          
              'updated_on' => date("Y-m-d H:i:s"),
              'created_on' => date("Y-m-d H:i:s"),
              'updated_by' => $user_id,
              'created_by' => $user_id,
              );
           $res=$this->CommonMdl->insertRow($gallery_arr,'tbl_facility_gallery');
           }
             if($gallery_image6_6!=''){
           $gallery_arr = array(  
              'gallery_image' => $gallery_image6_6,
              'fac_id' => $fac_id,          
              'updated_on' => date("Y-m-d H:i:s"),
              'created_on' => date("Y-m-d H:i:s"),
              'updated_by' => $user_id,
              'created_by' => $user_id,
              );
           $res=$this->CommonMdl->insertRow($gallery_arr,'tbl_facility_gallery');
           }
             if($gallery_image7_7!=''){
           $gallery_arr = array(  
              'gallery_image' => $gallery_image7_7,
              'fac_id' => $fac_id,          
              'updated_on' => date("Y-m-d H:i:s"),
              'created_on' => date("Y-m-d H:i:s"),
              'updated_by' => $user_id,
              'created_by' => $user_id,
              );
           $res=$this->CommonMdl->insertRow($gallery_arr,'tbl_facility_gallery');
           }
             if($gallery_image8_8!=''){
           $gallery_arr = array(  
              'gallery_image' => $gallery_image8_8,
              'fac_id' => $fac_id,          
              'updated_on' => date("Y-m-d H:i:s"),
              'created_on' => date("Y-m-d H:i:s"),
              'updated_by' => $user_id,
              'created_by' => $user_id,
              );
           $res=$this->CommonMdl->insertRow($gallery_arr,'tbl_facility_gallery');
           }
           
           //print_r($gallery_arr2); die();
           
         
          
            echo "success";
         
    }


}

public function achievement_edit_form(){
  $data['fac_achievement'] = $this->CommonMdl->getRow('tbl_facility_reward_achievement','*',array('reward_achievement_id'=>$this->input->post('achivement_id')));
  $data['reward_type'] = $this->CommonMdl->getResultByCond('tbl_reward_achievement',array('reward_status'=>'enable'),'*',$order_by='');

  $html['_html'] = $this->load->view('public/facility-dashboard/ajax/FacAchievementEditView',$data,true);
   return $this->output->set_content_type('application/json')->set_output(json_encode($html));
}

public function sport_edit_form(){
  $data['fac_sport'] = $this->CommonMdl->getRow('tbl_facility_sport','*',array('fac_sport_id'=>$this->input->post('fac_sport_id')));
  $data['sport_list'] = $this->CommonMdl->getResultByCond('tbl_sport_list',array('sport_status'=>'enable'),'sport_id,sport_name',$order_by='');
//print_data($data['fac_sport']);
  $html['_html'] = $this->load->view('public/facility-dashboard/ajax/FacSportsEditView',$data,true);
   return $this->output->set_content_type('application/json')->set_output(json_encode($html));
}

public function aminity_edit_form(){
  $user_id=$this->session->userdata['user_id'];
  $data['user_amenity'] = $this->CommonMdl->getResultByCond('tbl_facility_amenities',array('user_id'=>$user_id),'amenity_id',$order_by='');
  $data['amenity_list'] = $this->CommonMdl->getResultByCond('tbl_amenity',array('amenity_status'=>'enable'),'amenity_id,amenity_name,amenity_icon',$order_by='');
//print_data($data['user_amenity']);
  $html['_html'] = $this->load->view('public/facility-dashboard/ajax/FacAmenityEditView',$data,true);
   return $this->output->set_content_type('application/json')->set_output(json_encode($html));
}

public function gallery_edit_form(){
  
  $data['fac_gallery'] = $this->CommonMdl->getResultByCond('tbl_facility_gallery',array('fac_id'=>$this->input->post('fac_id')),'*',$order_by='');
 
  $html['_html'] = $this->load->view('public/facility-dashboard/ajax/FacGalleryEditView',$data,true);
   return $this->output->set_content_type('application/json')->set_output(json_encode($html));
}

public function bank_edit_form(){
  $user_id=$this->session->userdata['user_id'];
  $data['fac_bank'] = $this->CommonMdl->getRow('tbl_user_bank_details','*',array('user_id'=>$user_id));
  $html['_html'] = $this->load->view('public/facility-dashboard/ajax/FacBankEditView',$data,true);
   return $this->output->set_content_type('application/json')->set_output(json_encode($html));
}




public function change_password(){
  $user_id=$this->session->userdata['user_id'];
  $old_pass = md5($this->input->post('oldPassword'));
  $new_Pass = md5($this->input->post('newPassword'));
  $count=$this->CommonMdl->fetchNumRows('tbl_user',array('user_id'=>$user_id,'user_password'=>$old_pass),$cond1='');
  if($count==1){
      $user_arr = array(
              'user_password' => $new_Pass,
              'updated_by' => $user_id,
              'updated_on' => date("Y-m-d H:i:s"),
              );
         $res =$this->CommonMdl->updateData($user_arr,array('user_id' => $user_id),'tbl_user');

        $password_log_date = array(
                'user_id' => $user_id,
                'password' => $new_Pass,
                'created_on' => date("Y-m-d H:i:s")
              );
            $this->CommonMdl->insertRow($password_log_date,'tbl_user_password_log');
            if($res){
              echo "1";
            }
            else{
              echo "0";
            }
  }
  else{
    echo "2";
  }
}


public function add_facility_academy(){

  $data['rewards_type'] = $this->CommonMdl->getResultByCond('tbl_reward_achievement',array('reward_status'=>'enable'),'reward_id,reward_name',array('col_name'=>'reward_name','order'=>'asc'));
$this->load->view('public/facility-dashboard/AddFacilityView',$data);
}

public function add_facility(){
  $user_id=$this->session->userdata['user_id'];

   $fac_logo['file_name']='';
   $fac_banner['file_name']='';
   
   $path = "assets/public/images/fac";
   $this->upload->initialize($this->set_upload_options($path));
   if ($this->upload->do_upload('fac_banner')){
     $fac_banner= $this->upload->data();
     
   }
   $this->upload->initialize($this->set_upload_options1($path));
   if ($this->upload->do_upload('fac_logo')){
     $fac_logo= $this->upload->data();
     
   }

   
   
     $facility_name=strtolower(trim($this->input->post('facilityname')));
     $facility_slug_name=str_replace(' ', '-', $facility_name);
	 
	 $count_slug=$this->CommonMdl->fetchNumRows('tbl_facility',array('fac_slug'=>$facility_slug_name),$cond1='');
  if($count_slug >0){ 
     $facility_slug=$facility_slug_name.'-'.$count_slug;
  }
  else{
	  $facility_slug = $facility_slug_name;
  }   
   
     // insert fac details
   $fac_arr = array(
    'fac_name' => $this->input->post('facilityname'),
    'user_id' => $user_id,
    'fac_type' => $this->input->post('fac_type'),
	   'fac_slug'=>$facility_slug,
    'fac_description' => $this->input->post('fac_text'),
    'fac_city' => $this->input->post('fac_city'),
    'fac_latitude' => $this->input->post('latitude'),
    'fac_longitude' => $this->input->post('longitude'),
    'fac_pincode' => $this->input->post('fac_pincode'),
    'fac_country' => 'india',
    'fac_address' => $this->input->post('fac_area'),
    'fac_banner_image' => $fac_banner['file_name'],
    'fac_logo_image' => $fac_logo['file_name'],
    'updated_by_type' => 'user',
    'created_by_type' => 'user',
    'created_on' => date("Y-m-d H:i:s"),
    'updated_on' => date("Y-m-d H:i:s")
  );
   
   $facility_id = $this->CommonMdl->insertRow($fac_arr,'tbl_facility');
          //$this->session->set_userdata('facility_id', $facility_id);

      //Facility Timing

   $fac_timming_array = array();
   for ($j=0; $j < count($this->input->post('fac_timing')) ; $j++) { 
    $fac_timing = $this->input->post('fac_timing')[$j];
    $exp_fac_timing = explode('-', $fac_timing);

             //print_r($exp_fac_timing);
    
    $fac_timming_array[] = array(
      'fac_id' =>$facility_id,
      'day' => $exp_fac_timing[0],
      'open_time' => $exp_fac_timing[1],
      'close_time' => $exp_fac_timing[2],
      'created_on' =>date("Y-m-d H:i:s"),
      'updated_on' =>date("Y-m-d H:i:s")
    ); 
  }
  $this->CommonMdl->insertinbatch($fac_timming_array,'tbl_facility_timing');

  //print_data($fac_timming_array);


 /* if($this->input->post('reward_type')!=''){
    $achievement_img1['file_name']='';
    $achievement_img2['file_name']='';
    $rewardArr = array();
    for ($i=0; $i < count($this->input->post('reward_type')); $i++) {

     $path = "assets/public/images/rewards";
     $_FILES['file']['name']     = $_FILES['achievement_img1']['name'][$i];
     $_FILES['file']['type']     = $_FILES['achievement_img1']['type'][$i];
     $_FILES['file']['tmp_name'] = $_FILES['achievement_img1']['tmp_name'][$i];
     $_FILES['file']['error']     = $_FILES['achievement_img1']['error'][$i];
     $_FILES['file']['size']     = $_FILES['achievement_img1']['size'][$i];
     $this->upload->initialize($this->set_upload_options($path));
     if ($this->upload->do_upload('file')){
      $achievement_img1= $this->upload->data();
    }
    
    $_FILES['file']['name']     = $_FILES['achievement_img2']['name'][$i];
    $_FILES['file']['type']     = $_FILES['achievement_img2']['type'][$i];
    $_FILES['file']['tmp_name'] = $_FILES['achievement_img2']['tmp_name'][$i];
    $_FILES['file']['error']     = $_FILES['achievement_img2']['error'][$i];
    $_FILES['file']['size']     = $_FILES['achievement_img2']['size'][$i];
    $this->upload->initialize($this->set_upload_options($path));
    if ($this->upload->do_upload('file')){
      $achievement_img2= $this->upload->data();
    }


    $rewardArr[] = array(
      'fac_id' => $facility_id,
      'reward_title' => $this->input->post('reward_title')[$i],
      'reward_id' => $this->input->post('reward_type')[$i],
      'image1' => $achievement_img1['file_name'],
      'image2' => $achievement_img2['file_name'],
      'created_on' =>date("Y-m-d H:i:s"),
      'updated_on' =>date("Y-m-d H:i:s")
    );
  }
  $this->CommonMdl->insertinbatch($rewardArr,'tbl_facility_reward_achievement');
      
}*/


if($facility_id){
  echo "1";
}
else{
  echo "failed";
}

}

public function add_fac_sport(){

$user_id=$this->session->userdata['user_id'];
   $sport_arr = array(
          'fac_id' => $this->input->post('fac_id'),
          'user_id' => $user_id,
          'sport_id' => $this->input->post('sports_id'),
          'sport_court' => $this->input->post('courtnumber'),
          'sport_indor' => $this->input->post('indor_qty'),
          'sport_outdor' => $this->input->post('outdor_qty'),
          'created_on' => date("Y-m-d H:i:s"),
            'updated_on' => date("Y-m-d H:i:s")
           );
        // print_data($sport_arr);
          $insert_id = $this->CommonMdl->insertRow($sport_arr,'tbl_facility_sport');
   
        if($insert_id){
         echo "1";
       }
       else{
         echo "failed";
       }

}


public function dashboard_ajax_view(){
  $this->load->model('public/UserMdl');
  $fac_id = $this->input->post('fac_id');
  if($fac_id!='' ){
  $data['todays_booking_count']=$this->CommonMdl->fetchNumRows('tbl_booking_slot_detail',array('fac_id'=>$fac_id,'date(created_on)'=>date("Y-m-d")),$cond1='');
  $data['todays_trial_booking_count']=$this->CommonMdl->fetchNumRows('tbl_booking_slot_detail',array('fac_id'=>$fac_id,'is_trial'=>'yes','date(created_on)'=>date("Y-m-d")),$cond1='');
  $data['total_booking_count']=$this->CommonMdl->fetchNumRows('tbl_booking_slot_detail',array('fac_id'=>$fac_id),$cond1='');
   $data['total_confirmed_booking_count']=$this->CommonMdl->fetchNumRows('tbl_booking_slot_detail',array('fac_id'=>$fac_id,'booking_detail_status'=>'confirm'),$cond1='');
   $data['total_pending_booking_count']=$this->CommonMdl->fetchNumRows('tbl_booking_slot_detail',array('fac_id'=>$fac_id,'booking_detail_status'=>'pending'),$cond1='');

   $data['upcomming_events'] = $this->CommonMdl->getResultByCond('tbl_event',array('event_approval'=>'approved','event_end_date>'=>date("Y-m-d"),'fac_id'=>$fac_id),'*',array('col_name'=>'event_id','order'=>'desc'));
   $data['latest_queries'] = $this->CommonMdl->getResultByCondLimit('tbl_user_query_to_facility',array('fac_id'=>$fac_id),'*',array('col_name'=>'query_id','order'=>'desc'),'5');
    $data['fac_sports'] = $this->UserMdl->getFacSportList($fac_id);
   // print_data($data['latest_queries']);
  //echo $this->db->last_query();

   $data['total_review']=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>$fac_id),'');
      $data['total_1_review']=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>$fac_id,'rating'=>'1'),'');
      $data['total_2_review']=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>$fac_id,'rating'=>'2'),'');
      $data['total_3_review']=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>$fac_id,'rating'=>'3'),'');
      $data['total_4_review']=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>$fac_id,'rating'=>'4'),'');
      $data['total_5_review']=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>$fac_id,'rating'=>'5'),'');

         /*profile completion status*/
    $profile_percent1 = 0;
    $profile_percent2 = 0;
    $profile_percent3 = 0;
    $profile_percent4 = 0;
    $profile_percent5 = 0;
    $profile_percent6 = 0;
  
    $user_info=$this->CommonMdl->getRow('tbl_user','*',array('user_id'=>$this->session->userdata['user_id']));

    $user_facility=$this->CommonMdl->getResultByCond('tbl_facility',array('user_id'=>$this->session->userdata['user_id']),'fac_id','');
    if(count($user_facility)>0){
     $user_sport_count=$this->CommonMdl->fetchNumRows('tbl_facility_sport',array('fac_id'=>$user_facility[0]->fac_id),'');
    }
    $user_amenity_count=$this->CommonMdl->fetchNumRows('tbl_facility_amenities',array('user_id'=>$this->session->userdata['user_id']),'');
    $user_bank_info_count=$this->CommonMdl->fetchNumRows('tbl_user_bank_details',array('user_id'=>$this->session->userdata['user_id']),'');
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

    $data['fac_sports'] = $this->UserMdl->getFacSportList($fac_id);
$data['profile_percent']=15+$profile_percent1+$profile_percent2+$profile_percent3+$profile_percent4+$profile_percent5+$profile_percent6;

  
  $html['_html'] = $this->load->view('public/facility-dashboard/ajax/FacDashboardView',$data,true);
   return $this->output->set_content_type('application/json')->set_output(json_encode($html));
}
}


 public function check_sport_name(){

if($this->input->post('fac_id')){
$cond= array('fac_id'=>$this->input->post('fac_id'));
}
else{
$cond=array();
}

 if($this->input->post('sport_id')!=''){
      $cond1=array('sport_id'=>$this->input->post('sport_id'));

 }
 else{
$cond1=array();
 }


  $res=$this->CommonMdl->fetchNumRows('tbl_facility_sport',$cond,$cond1);
  
  if($res>0)
  {
   echo "1";  
 
  }
  else{
 echo "2";
  }

}


function exist_sport_name(){
$fac_sport_id=$this->input->post('fac_sport_id');
$whr=array('fac_id'=>$this->input->post('fac_id'),'sport_id'=>$this->input->post('sport_id'));
// print_data($whr);
 $res = $this->CommonMdl->exist_sport_name('tbl_facility_sport',$whr,$fac_sport_id);
 // echo $this->db->last_query();
 
if($res>=1){
	echo "1";
}
else{
	echo "0";
}

}


public function insert_fac_info(){
	$title=$this->input->post('title');
	$image1['file_name'] = '';
	$image2['file_name'] = '';
	$path = "assets/public/images/rewards";
	$this->upload->initialize($this->set_upload_options($path));
	if($this->upload->do_upload('image1')){
	  $image1= $this->upload->data();
	}
	
	$this->upload->initialize($this->set_upload_options1($path));
	if($this->upload->do_upload('image2')){
	   $image2= $this->upload->data();
	}
	
	
	$dataArr = array(
	  'fac_id'=>$this->input->post('fac_id'),
	  'reward_title' => $this->input->post('title'),
	  'reward_id' => $this->input->post('selectOfferTitle'),
	  'image1' => $image1['file_name'],
	  'image2' =>$image2['file_name'],
	  'created_on' => date("Y-m-d H:i:s")
	 );
	 
	 $res=$this->CommonMdl->insertRow($dataArr,'tbl_facility_reward_achievement');
	 if($res){
		 echo "success";
	 }
	 else{
		 echo "failed";
	 }	
}


public function delete_fac_info(){
   
   $whr=array('reward_achievement_id'=>$this->input->post('achivement_id'));
	$res=$this->CommonMdl->deleteRecord('tbl_facility_reward_achievement',$whr);
	if($res){
		echo "success";
	}
	else{
		echo "failed";
	}
}

public function email_re_verification(){
  $user_id=$this->session->userdata['user_id'];
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
       // print_r($User_data);

  /*Email when genrate ref id*/
  $data = array('action' => 'email_verification','email' => $User_data[0]->user_email,'user_name' => $User_data[0]->user_name,'user_id' => $User_data[0]->user_id,'verification_code' => $email_verification_code);

        // echo "<pre>"; print_r( $email_date); echo "<br> Hello=";
         //echo "<pre>"; print_r( $data); die();
  $url= base_url('email_script.php');
  $handle = curl_init($url);
  curl_setopt($handle, CURLOPT_POST, true);
  curl_setopt($handle, CURLOPT_POSTFIELDS, $data);
  $res=curl_exec($handle);          
  curl_close($handle);

 ob_clean();
 echo "success";

  
}

}
<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

  public  function __construct()

  {

    parent::__construct();
    $this->load->model('admin/UserMdl');
    $this->load->model('admin/AdminMdl');



  }

  public function index()

  {
   if($this->session->userdata('admin_id')){

    redirect('admin/user/dashboard');

  }


  $this->load->view('admin/LoginView');



}
public function admin_login()
{
  $username = $this->input->post('username');
  $password = $this->input->post('password');
  $data = array(
    'username' => $this->input->post('username'),
    'password' => $this->input->post('password'),
  );
   if ($this->UserMdl->get_admin_info($data) == 1)
  {
    echo "1";
  }
  else if ($this->UserMdl->get_admin_info($data) == 2)
  {
    echo "2";
  } 
  else
  {
    echo "0";
  }
}

public function logout()
{
  $this->session->unset_userdata('admin_id');
  $this->session->unset_userdata('admin_username');
  $this->session->unset_userdata('admin_useremail');
  $this->session->unset_userdata('admin_name');
  $this->session->unset_userdata('admin_role_id');
  redirect(base_url() . 'admin');
}


public function dashboard()

{
 if(!$this->session->userdata('admin_id')){

  redirect('admin');

}
//print_data($this->session->userdata());    
$data['CountUser']=$this->CommonMdl->fetchNumRows('tbl_user',$cond='',$cond1='');
$data['CountEndUser']=$this->CommonMdl->fetchNumRows('tbl_user',array('user_role'=>'1'),$cond1='');
$data['CountFacilityUser']=$this->CommonMdl->fetchNumRows('tbl_user',array('user_role'=>'2'),$cond1='');




$data['totalFacilityCount']=$this->CommonMdl->fetchNumRows('tbl_facility',$cond='',$cond1='');
$data['CountAcademyBatch']=$this->CommonMdl->fetchNumRows('tbl_facility',array('fac_type'=>'academy'),$cond1='');
$data['CountFacilitySlot']=$this->CommonMdl->fetchNumRows('tbl_facility',array('fac_type'=>'facility'),$cond1='');
$data['CountEvent']=$this->CommonMdl->fetchNumRows('tbl_event',$cond='',$cond1='');
 
 
 $data['RevinewAmount']=$this->AdminMdl->getSunResult();
 $data['RevinewFacilitySlot']=$this->AdminMdl->getSunResultfacility();
 $data['RevinewAcademyBatch']=$this->AdminMdl->getSunResultacademy();
 $data['RevinewEvent']=$this->AdminMdl->getSunResultevent();

$data['totalBookingCount']=$this->CommonMdl->fetchNumRows('tbl_booking_order',$cond='',$cond1='');
$data['CountBookingBatch']=$this->CommonMdl->fetchNumRows('tbl_booking_order',array('booking_for'=>'academy'),$cond1='');
$data['CountBookingSlot']=$this->CommonMdl->fetchNumRows('tbl_booking_order',array('booking_for'=>'facility'),$cond1='');
$data['CountBookingEvent']=$this->CommonMdl->fetchNumRows('tbl_booking_order',array('booking_for'=>'event'),$cond1='');

$data['CountCareer']=$this->CommonMdl->fetchNumRows('tbl_career',$cond='',$cond1='');
$data['CountUserQuery']=$this->CommonMdl->fetchNumRows('tbl_user_query',$cond='',$cond1='');
$order_by = array('col_name'=>'query_id','order'=>'desc');

$dates=date('m');

$order_by = array('col_name'=>'query_id','order'=>'desc');
$data['CountUserQueryLimit']=$this->AdminMdl->UserQueryResult('tbl_user_query','*',array('date(create_on)'=>$dates),$order_by);

/* $data['CountNewsLetter']=$this->CommonMdl->fetchNumRows('tbl_newsletter',$cond='',$cond1=''); */

  $this->load->view('admin/DashboardView',$data);
}


public function admin_form(){
 if(!$this->session->userdata('admin_id')){
  redirect('admin');
}
$data['accessList'] = $this->CommonMdl->getResult('tbl_admin_role_access','*');
$this->load->view('admin/admin-user/AdminAddView',$data);
}

public function check_admin_username(){
  $user_name = $this->input->post('user_name');
  $admin_id=$this->input->post('admin_id');
  $cond = array('admin_username' => $user_name);
  if($admin_id!=''){
    $cond1 = array('admin_id!=' => $admin_id);
  }
  else{
    $cond1 = array();
  }

  $user_name=$this->CommonMdl->fetchNumRows('tbl_admin',$cond,$cond1);
  if($user_name){
    echo "1";
  }
  else{
    echo "2";
  }
}


public function check_admin_email(){
  $Admin_Email = $this->input->post('Admin_Email');
  $admin_id=$this->input->post('admin_id');
  $cond = array('admin_email' => $Admin_Email);
  if($admin_id!=''){
    $cond1 = array('admin_id!=' => $admin_id);
  }
  else{
    $cond1 = array();
  }

  $user_name=$this->CommonMdl->fetchNumRows('tbl_admin',$cond,$cond1);
  if($user_name){
    echo "1";
  }
  else{
    echo "2";
  }
}


public function add_admin(){
   //print_data($_POST['admin_access']);
  if($this->input->post('admin_email')!=''){
    if($this->input->post('status')!='enable'){
      $user_status = 'disable';
    }
    else{
      $user_status= $this->input->post('status');
    }
    $date_arr = array(
      'admin_name' => $this->input->post('admin_name'),
      'admin_email' => $this->input->post('admin_email'),
      'admin_username' => $this->input->post('user_name'),
      'admin_password' => $this->input->post('password'),
      'admin_status' => $user_status,
      'created_on' => date("Y-m-d H:i:s"),
      'updated_on' => date("Y-m-d H:i:s"),
    );
    $insert_id = $this->CommonMdl->insertRow($date_arr,'tbl_admin');

    $admin_access_type=Array() ;
      
      for($i=0 ; $i<count($this->input->post('admin_access')); $i++) {
      $admin_access_type[] = array(
        'admin_id'=>$insert_id,
        'role_access'=>trim($this->input->post('admin_access')[$i]),
		'created_on'=>date('Y-m-d H:i:s')
        );
      }
      $this->CommonMdl->insertinbatch($admin_access_type,'tbl_admin_user_roles');
    if($insert_id!='')
    { 
      $this->session->set_flashdata('msg', 'User Added successfully.');
      $this->session->set_flashdata('msg_class', 'bg-success');
      redirect('admin/user/admin_form');

    }
    else{
      $this->session->set_flashdata('msg', 'User Already Exits.');
      $this->session->set_flashdata('msg_class', 'bg-danger');
      redirect('admin/user/admin_form');
    }

  }

}

public function admin_list(){
 if(!$this->session->userdata('admin_id')){
  redirect('admin');
} 
$order_by = array('col_name'=>'admin_id','order'=>'desc');
$data['adminList'] = $this->CommonMdl->getResultOrderBy('tbl_admin','*',$order_by);
    // print_data($data);
$this->load->view('admin/admin-user/AdminListView',$data);
}

public function admin_edit_form($id){
 if(!$this->session->userdata('admin_id')){
  redirect('admin');
}

$whr = array('admin_id'=>$id);
$data['adminInfo'] = $this->CommonMdl->getResultBycond('tbl_admin',$whr,'*',$order_by='');
$data['useraccessids'] = $this->CommonMdl->getResultBycond('tbl_admin_user_roles',$whr,'*',$order_by='');
$data['accessList'] = $this->CommonMdl->getResult('tbl_admin_role_access','*');
$this->load->view('admin/admin-user/AdminEditView',$data);
}

public function save_admin_edit_data(){
   
   $id=$this->input->post('admin_id');
  if($this->input->post('admin_email')!=''){
    if($this->input->post('status')!='enable'){
      $user_status = 'disable';
    }
    else{
      $user_status= $this->input->post('status');
    }
    $date_arr = array(
      'admin_name' => $this->input->post('admin_name'),
      'admin_email' => $this->input->post('admin_email'),
      'admin_username' => $this->input->post('user_name'),
      'admin_password' => $this->input->post('password'),
      'admin_status' => $user_status,
      'updated_on' => date("Y-m-d H:i:s"),
    );
	
	
    $whr = array('admin_id'=>$id);
    $res = $this->CommonMdl->updateData($date_arr,$whr,'tbl_admin');

      /*##########Admin role code start here##############*/
      $admin_access_type = array();
    for($i=0 ; $i<count($this->input->post('admin_access')); $i++) {
      $admin_access_type[] = array(
        'admin_id'=>$id,
        'role_access'=>$this->input->post('admin_access')[$i],
		'created_on'=>date('Y-m-d H:i:s')
        );
      }
	 
      $this->CommonMdl->deleteRecord('tbl_admin_user_roles',$whr);
      //print_data($admin_access_type);
      $this->CommonMdl->insertinBatch($admin_access_type,'tbl_admin_user_roles');

  /*######################################################*/



    if($res==true)
    { 
      $this->session->set_flashdata('msg', 'Admin updated successfully.');
      $this->session->set_flashdata('msg_class', 'bg-success');
      redirect('admin/user/admin_list');

    }
    else{
      $this->session->set_flashdata('msg', 'Some technical issue occured');
      $this->session->set_flashdata('msg_class', 'bg-danger');
      redirect('admin/user/admin_form');
    }

  }
}


public function delete_admin($id){
 if(!$this->session->userdata('admin_id')){
  redirect('admin');
}
$whr = array('admin_id'=>$id);
$result= $this->CommonMdl->deleteRecord('tbl_admin_user_roles',$whr);
$result= $this->CommonMdl->deleteRecord('tbl_admin',$whr);

if($result==true){
  redirect('admin/user/admin_list');
}
else{
  $this->session->set_flashdata('msg', 'Some technical issue occured.');
  $this->session->set_flashdata('msg_class', 'bg-success');
  redirect('admin/user/admin_list');
}

}

public function userlist(){
 
 if(!$this->session->userdata('admin_id')){
  redirect('admin');
}
$order_by = array('col_name'=>'user_id','order'=>'desc');
if($this->input->post('action')=='fac_filter'){
			$start_date = '';
			$end_date = '';
			$status = '';
		    $user_role='1';
			$data['status']='';
			if($this->input->post('start_date')!=''){ 
			    $start_date=date('Y-m-d', strtotime($this->input->post('start_date')));
				$data['start_date']=$this->input->post('start_date');
			}if($this->input->post('end_date')!=''){
			     $end_date=date('Y-m-d', strtotime($this->input->post('end_date')));
				 $data['end_date']=$this->input->post('end_date');
             }if($this->input->post('select_stat')!=''){
			   $status=$this->input->post('select_stat');
			   $data['status']=$this->input->post('select_stat');
			 
             }
			 
			
             $data['userList'] = $this->AdminMdl->getResultByFilterss('tbl_user','*',$order_by,$start_date,$end_date,$user_role,$status);
	}else{
		 $data['userList'] = $this->CommonMdl->getResultByCond('tbl_user',array('user_role'=>'1'),'*',$order_by);
	}
  //echo $this->db->last_query(); die;
 $this->load->view('admin/user/UserListView',$data);
}


public function exportdatabyuser(){
	$order_by = array('col_name'=>'user_id','order'=>'desc');
	if($this->input->post('action')=='user_filter'){
			$start_date = '';
			$end_date = '';
			$status = '';
		    $user_role='1';
			$data['status']='';
			if($this->input->post('start_date')!=''){ 
			    $start_date=date('Y-m-d', strtotime($this->input->post('start_date')));
				$data['start_date']=$this->input->post('start_date');
			}if($this->input->post('end_date')!=''){
			     $end_date=date('Y-m-d', strtotime($this->input->post('end_date')));
				 $data['end_date']=$this->input->post('end_date');
             }if($this->input->post('select_stat')!=''){
			   $status=$this->input->post('select_stat');
			   $data['status']=$this->input->post('select_stat');
			 
             }
			 
			
             $data['userList'] = $this->AdminMdl->getResultByFilterss('tbl_user','*',$order_by,$start_date,$end_date,$user_role,$status);
	}else{
		 $data['userList'] = $this->CommonMdl->getResultByCond('tbl_user',array('user_role'=>'1'),'*',$order_by);
	}
	
	$this->load->view('admin/user/ExcelUser/UserExcelExportView',$data);
	

	
}



public function changeuserstatus(){
	       if($this->input->post('user_status') == 'enable'){
			   $statuss = 'approved';
		   }else if($this->input->post('user_status') == 'disable'){
			   $statuss = 'disapproved';
	          
		   }
			 $user_name = $this->input->post('user_name');
			 $msg = 'Your Profile has been '.$statuss;
			$dataArrs = array(
				 'user_id'=>$this->input->post('user_id'),
				 'email_notification_title' =>'profile approval',
				 'email_notification_message'=>$msg,
				 'email_notification_activity'=>'Profile '.$statuss,
				 'created_on'=>date('Y-m-d H:i:s'),
				 'updated_on'=>date('Y-m-d H:i:s')
				);	
                $this->CommonMdl->insertRow($dataArrs,'tbl_email_notification');
				

				
				
	   $dataArr=array(
	       'user_status'=>$this->input->post('user_status'),
	   );
	   
	   $res=$this->CommonMdl->updateData($dataArr,array('user_id'=>$this->input->post('user_id')),'tbl_user');
	   
	   if($res == 1){
	    echo "1";
	   }
	   else{
		   echo "0";
	   }
		   
	   }
	   



 public function useredit($id){
     $whr=array('user_id'=>$id);
     $data['user_edit'] = $this->CommonMdl->getResultBycond('tbl_user',$whr,'*',$order_by='');

     $this->load->view('admin/user/EditUserView',$data);
 }


   public function userupdate(){

          $dataArr=array(
            'user_role'=>trim($this->input->post('user_rol')),
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
                    $this->session->set_flashdata('msg','User updated successfully');
                    $this->session->set_flashdata('msg_class','bg-success');
					 redirect('admin/user/userlist');
          }

   }



}
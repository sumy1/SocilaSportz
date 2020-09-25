<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends CI_Controller {

  public  function __construct()

  {
    parent::__construct();
    if(!$this->session->userdata('user_id')){
      redirect('login');
    }
    $this->load->model('public/FacilityMdl');

  }

    public function index(){
       $this->CommonMdl->updateData(array('notification_status'=>'read','updated_on'=>date("Y-m-d H:i:s")),array('notification_status'=>'unread'),'tbl_notification');
   

        $this->load->view('public/facility-dashboard/notification/NotificationView');
      }

       public function notification_list(){

       $fac_id = $this->input->post('fac_id'); 

    if($this->input->post('action')=='notification_filter'){
      $start_date = '';
      $end_date = '';
      if($this->input->post('from_date')!=''){
       $start_date=date('Y-m-d', strtotime($this->input->post('from_date')));
     }
     if($this->input->post('to_date')!=''){
       $end_date=date('Y-m-d', strtotime($this->input->post('to_date')));
     }

     $data['notification_list'] = $this->FacilityMdl->getNotificationList($fac_id,$start_date,$end_date);
   } 
   else{
    $data['notification_list'] = $this->FacilityMdl->getNotificationList($fac_id,$start_date='',$end_date='');
  }
  //print_r($data['notification_list']);

  $html['_html'] = $this->load->view('public/facility-dashboard/notification/ajax/NotificationListView',$data,true);
  return $this->output->set_content_type('application/json')->set_output(json_encode($html));
}

public function notification_count(){
      
       $data['notification_count']=$this->CommonMdl->fetchNumRows('tbl_notification',array('fac_id'=>$this->input->post('fac_id')),$cond1='');

        $html['_html'] = $this->load->view('public/facility-dashboard/notification/ajax/NotificationCountView',$data,true);
      return $this->output->set_content_type('application/json')->set_output(json_encode($html));
      }

public function email_notification(){
       $this->CommonMdl->updateData(array('email_notification_status'=>'read','updated_on'=>date("Y-m-d H:i:s")),array('email_notification_status'=>'unread'),'tbl_email_notification');
      

        $this->load->view('public/facility-dashboard/notification/EmailNotificationView');
      }

      public function email_notification_list(){

       //$fac_id = $this->input->post('fac_id');
       $user_id = $this->session->userdata['user_id']; 

    if($this->input->post('action')=='notification_filter'){
      $start_date = '';
      $end_date = '';
      if($this->input->post('from_date')!=''){
       $start_date=date('Y-m-d', strtotime($this->input->post('from_date')));
     }
     if($this->input->post('to_date')!=''){
       $end_date=date('Y-m-d', strtotime($this->input->post('to_date')));
     }

     $data['notification_list'] = $this->FacilityMdl->getEmailNotificationList($user_id,$start_date,$end_date);
   } 
   else{
    $data['notification_list'] = $this->FacilityMdl->getEmailNotificationList($user_id,$start_date='',$end_date='');
  }
  //print_r($data['notification_list']);

  $html['_html'] = $this->load->view('public/facility-dashboard/notification/ajax/EmailNotificationListView',$data,true);
  return $this->output->set_content_type('application/json')->set_output(json_encode($html));
}
    public function email_notification_count(){
      $user_id = $this->session->userdata['user_id']; 
      
       $data['notification_count']=$this->CommonMdl->fetchNumRows('tbl_email_notification',array('user_id'=> $user_id),$cond1='');

        $html['_html'] = $this->load->view('public/facility-dashboard/notification/ajax/EmailNotificationCountView',$data,true);
      return $this->output->set_content_type('application/json')->set_output(json_encode($html));
      }


      public function unread_notification_count(){
      
       $unread_notification=$this->CommonMdl->fetchNumRows('tbl_notification',array('notification_status'=>'unread'),$cond1='');
        echo $unread_notification;
      }

}
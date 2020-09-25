<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {

  public  function __construct()

  {
    parent::__construct();

   // $this->load->model('public/FacilityMdl');

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
	
	

  public function index(){
    
  }
public function sendmail($data){
	$url= base_url('email_script.php');
  $handle = curl_init($url);
  curl_setopt($handle, CURLOPT_POST, true);
  curl_setopt($handle, CURLOPT_POSTFIELDS, $data);
  $res=curl_exec($handle);          
  curl_close($handle);
}


  public function aboutus(){
	  $data['get_aboutdata']=$this->CommonMdl->getResultByCond('tbl_static_page',array('page_title'=>'About us'),'*',$order_by='');
    
	  $this->load->view('public/page/AboutUsView',$data);
  }
   public function terms_conditions(){
	$data['get_conditions']=$this->CommonMdl->getRow('tbl_static_page','*',array('page_title'=>'Terms conditions'));
	// print_data($data['get_conditions']);
    $this->load->view('public/page/TermsConditionView',$data);
  }
     public function contact_us(){
     $this->load->view('public/page/ContactUsView');
  }

       public function career(){
		   
       $this->load->view('public/page/Career');
  }
         public function careerform(){
			  $_FILES['PostedResume']['name'];
			  $path = "assets/public/images/resume";
			  $this->upload->initialize($this->set_upload_options($path));
			  if($this->upload->do_upload('PostedResume'))
			   {
				   $PostedResume=$this->upload->data();
			   }
			   $data_Arr=array(
					 'name'=>trim($this->input->post('name')),
					 'email'=>trim($this->input->post('email')),
					 'mobile'=>trim($this->input->post('number')),
					 'message'=>trim($this->input->post('message')),
					 'resume'=>trim($PostedResume['file_name']),
					 'created_on'=>date("Y-m-d H:i:s")
			    );
				$success=$this->CommonMdl->insertRow($data_Arr,'tbl_career');
				if(!empty($success)){
				   echo "1";
			      }else{
					echo "failed";
				}
  
         }

         public function partner_with_us(){
		   $data['get_partnerdata']=$this->CommonMdl->getRow('tbl_static_page','*',array('page_title'=>'partner with us'));
		   $this->load->view('public/page/PartnerWithUs',$data);
          }

          public function disclaimer(){
		  $data['get_disclaimer']=$this->CommonMdl->getRow('tbl_static_page','*',array('page_title'=>'Disclaimer'));
		  $this->load->view('public/page/Disclaimer',$data);
       }
  
  public function contactform(){
  	//echo $this->session->userdata('user_role'); die;

	  if($this->session->userdata('user_role')==1){
  		$user_id=$this->session->userdata('user_id');
  		$user_name=$this->session->userdata('user_name');
  		$user_email=$this->session->userdata('user_email');
  		$user_mobile_no=$this->session->userdata('user_mobile_no');
	}
	else{
		$user_id='';
  		$user_name=trim($this->input->post('name'));
  		$user_email=trim($this->input->post('email'));
  		$user_mobile_no=trim($this->input->post('number'));
	}
	  $data_Arr=array(
	         'user_id'=>$user_id,
			 'query_name'=>$user_name,  
	         'query_contact'=>$user_mobile_no,  
	         'query_email'=>$user_email,  
	         'query_message'=>trim($this->input->post('message')),  
	         'query_title'=>trim($this->input->post('subject')),
             'create_on'=>date("Y-m-d H:i:s"), 			 
             'update_on'=>date("Y-m-d H:i:s")
        );
	 // print_data($data_Arr);
	    $success=$this->CommonMdl->insertRow($data_Arr,'tbl_user_query');
        $whr= array('user_id'=>$user_id);
	    $Contact_data=$this->CommonMdl->getResultByCond('tbl_user_query',$whr,'*',$order_by='');
        
		$senduserss = array('action' => 'senduser','query_name' => $Contact_data[0]->query_name,'query_email' => $Contact_data[0]->query_email);
        
		$sendAdmin = array('action' => 'sendAdmin','query_name' => $Contact_data[0]->query_name,'query_title' => $Contact_data[0]->query_title,'query_email' => $Contact_data[0]->query_email,'query_contact' => $Contact_data[0]->query_contact,'query_message' =>$Contact_data[0]->query_message);
        
		$this->sendmail($senduserss);
	    $this->sendmail($sendAdmin);
	     if(!empty($success)){
		   echo "1";
	    }
		else{
			echo "failed";
		}
        
  }
  

  
}
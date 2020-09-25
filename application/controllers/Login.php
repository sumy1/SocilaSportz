<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

  public  function __construct()

  {

    parent::__construct();
    $this->load->helper('captcha');

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

      public function index(){
       if($this->session->userdata('user_id')){
        redirect('dashboard');
      }
		// FACEBOOK LOGIN URL
       $this->load->library('__social_media/__facebook/facebook');
       $data['fbLoginUrl'] = $this->facebook->login_url();
       
        // GOOGLEPLUS LOGIN URL
      $this->load->library('__social_media/__googleplus/googleplus');
      $data['gPlusLoginUrl'] = $this->googleplus->loginURL();
      $this->config->load('googleplus');

        if (isset($_GET['code'])) {
        $userData = array();
        //unset($userData);
        if($this->facebook->is_authenticated()){
      // Get user facebook profile details
      $userProfile = $this->facebook->request('get', '/me?fields=id,first_name,last_name,email,gender,locale,picture');
      $userData['email'] = '';
            // Preparing data for database insertion
            $userData['oauth_provider'] = '2';
            $userData['oauth_uid'] = $userProfile['id'];
            $userData['first_name'] = ucwords($userProfile['first_name']);
            $userData['last_name'] = ucwords($userProfile['last_name']);
            $userData['email'] = isset($userProfile['email'])?$userProfile['email']:'';

            // Insert or update user data
    
    }
      //authenticate user
      
      else if($this->googleplus->getAuthenticate()){

      //fetch user data
      $userProfile = $this->googleplus->getUserInfo();
      
            // Preparing data for database insertion
             $userData['oauth_provider'] = '3';
             $userData['oauth_uid'] = $userProfile['id'];
             $userData['first_name'] = ucwords($userProfile['given_name']);
             $userData['last_name'] = ucwords($userProfile['family_name']);
             $userData['email'] = isset($userProfile['email'])?$userProfile['email']:'';
          }




          $usercount=$this->CommonMdl->fetchNumRows('tbl_user',array('user_email'=>$userData['email']),'');
                // Insert or update user data
                if($usercount==0){
                  $data['oauth_provider']  = $userData['oauth_provider'] ;
                  $data['oauth_uid'] = $userData['oauth_uid'];
                  $data['first_name'] =  $userData['first_name'];
                 $data['last_name']   = $userData['last_name'];
                 $data['email']  = $userData['email']; 
               }
               else if($usercount==1){
                $cond = array('user_email'=>$userData['email']);
                $user_data = $this->CommonMdl->getResultByCond('tbl_user',$cond,'*',$order_by='');
              //print_r($user_data);
              if (!empty($user_data)){
               $this->session->set_userdata(array('user_id' => $user_data[0]->user_id,'user_email' => $user_data[0]->user_email,'user_name' => $user_data[0]->user_name,'user_mobile_no' => $user_data[0]->user_mobile_no,'user_role' => $user_data[0]->user_role,'user_gender' => $user_data[0]->user_gender));
              redirect('dashboard');
               }
             }
                else{
          $this->session->set_flashdata('sm_login_error','Error login with gmail');
          redirect(base_url());
        }
      }
      // END GOOGLEPLUS LOGIN URL
       
       $this->load->view('public/LoginView', $data);

     }

     public function user_registration(){
      if($this->input->post('email')){
      	/*Delete user if mobile not varified*/
      	 $cond = array('user_mobile_no' => trim($this->input->post('countrycode').$this->input->post('phone')),'is_mobile_verified' => 'no');

        $cond1 = array('user_email' =>$this->input->post('email') ,'is_mobile_verified' => 'no');
        $res1=$this->CommonMdl->fetchNumRows('tbl_user',$cond1,'');
      	 
      	 $res=$this->CommonMdl->fetchNumRows('tbl_user',$cond,'');
      	 // echo $this->db->last_query(); die;
      	 if($res==1){
 			 $user_data = $this->CommonMdl->getResultByCond('tbl_user',array('user_mobile_no'=>trim($this->input->post('countrycode').$this->input->post('phone'))),'user_id',$order_by='');
 			 //echo $user_data[0]->user_id; die;
      	 	$whr =  array('user_id' => $user_data[0]->user_id);
      	 $this->CommonMdl->deleteRecord('tbl_user_password_log',$whr);
      	 $this->CommonMdl->deleteRecord('tbl_user_verification',$whr);
      	 $this->CommonMdl->deleteRecord('tbl_user',$whr);
      	}

        else if($res1==1){
       $user_data = $this->CommonMdl->getResultByCond('tbl_user',array('user_email'=>$this->input->post('email')),'user_id',$order_by='');
       //echo $user_data[0]->user_id; die;
          $whr =  array('user_id' => $user_data[0]->user_id);
         $this->CommonMdl->deleteRecord('tbl_user_password_log',$whr);
         $this->CommonMdl->deleteRecord('tbl_user_verification',$whr);
         $this->CommonMdl->deleteRecord('tbl_user',$whr);
        }

 

      	/***********************/
         $is_email_verified = 'no';
        if($this->input->post('login_type')==2 || $this->input->post('login_type')==3){
          $is_email_verified = 'yes';
        }
      // $user_city = explode(',', $this->input->post('address'));
       
       $date_arr = array(
         'user_name' => $this->input->post('name'),
         'user_email' => $this->input->post('email'),
         'user_gender' => $this->input->post('gender'),
         'user_mobile_no' => trim($this->input->post('countrycode').$this->input->post('phone')),
         'user_password' => md5($this->input->post('password')),
         //'user_city' => $user_city[0],
         'user_address' => $this->input->post('address'),
         'user_latitude' => $this->input->post('latitude'),
         'user_longitude' => $this->input->post('longitude'),
         'user_google_address' => $this->input->post('address'),
         'user_country' => $this->input->post('country'),
         'user_role' => $this->input->post('user_type'),
         'user_login_type' => $this->input->post('login_type'),
         'user_oauth_id' => $this->input->post('oauth_uid'),
         'is_mobile_verified' => 'no',
         'is_email_verified' => $is_email_verified,
         'user_status' => 'disable',
         'created_on' => date("Y-m-d H:i:s")
       );
	    //print_data($date_arr);
       $last_user_insert_id = $this->CommonMdl->insertRow($date_arr,'tbl_user');
       $this->session->set_userdata(array('last_user_insert_id' => $last_user_insert_id));
       
       $six_digit_random_number = mt_rand(100000, 999999);
       $email_verification_code = md5(uniqid(rand(), true));
       
       if($last_user_insert_id){
	    	//For mobile varification
         $mob_date = array(
          'user_id' => $last_user_insert_id,
          'verification_code' => $six_digit_random_number,
          'verification_type' => 'mobile',
          'expire_on' => date('Y-m-d H:i:s', strtotime('+2 minute')),
          'created_on' => date("Y-m-d H:i:s")
        );
         $last_insert_mob_id = $this->CommonMdl->insertRow($mob_date,'tbl_user_verification');

         /*************msg code***********************/
         $SENDER_ID = SENDER_ID;
         $AUTH_KEY = AUTH_KEY; 
         $phone = $this->input->post('phone');
         $user_name = $this->input->post('name');   
         $msg="Your One Time Password for socialsportz.com is $six_digit_random_number . Use this to verify your mobile number."; 
         
         $message=array($msg); 
         $message1= http_build_query($message);
         $message1= substr($message1, 2);
         $url= "http://api.msg91.com/api/sendhttp.php?sender=$SENDER_ID&route=4&mobiles=$phone&authkey=$AUTH_KEY&country=91&message=$message1"; 
         
         $curl = curl_init(); 
         
         curl_setopt_array($curl, array(
          CURLOPT_URL =>$url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_SSL_VERIFYHOST => 0,
          CURLOPT_SSL_VERIFYPEER => 0,
        ));
         
         $response = curl_exec($curl); 
         $err = curl_error($curl);
         
         curl_close($curl);
         
         if ($err) {
          "cURL Error #:".$err;
        } else {
         $response;
       }                   
       /********************msg end ******************/


	      //For Email varification
       if($is_email_verified=='no'){
       $email_date = array(
        'user_id' => $last_user_insert_id,
        'verification_code' => $email_verification_code,
        'verification_type' => 'email',
        'expire_on' => date('Y-m-d H:i:s', strtotime('+2 day')),
        'created_on' => date("Y-m-d H:i:s")
      );
       $last_insert_email_id = $this->CommonMdl->insertRow($email_date,'tbl_user_verification');
       $whr_email = array('user_id'=>$this->session->userdata['last_user_insert_id']);
       $User_data = $this->CommonMdl->getResultByCond('tbl_user',$whr_email,'*',$order_by='');
	      //echo $User_email_id[0]->user_email;
	      //print_data($User_email_id);

       /*Email Varification*/
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
}
/*Email Mobile OTP*/
      $data1 = array('action' => 'mobile_verification','email' => $User_data[0]->user_email,'user_name' => $User_data[0]->user_name,'user_id' => $User_data[0]->user_id,'verification_code' => $six_digit_random_number);

        // echo "<pre>"; print_r( $email_date); echo "<br> Hello=";
         //echo "<pre>"; print_r( $data); die();
       $url= base_url('email_script.php');
       $handle = curl_init($url);
       curl_setopt($handle, CURLOPT_POST, true);
       curl_setopt($handle, CURLOPT_POSTFIELDS, $data1);
       $res=curl_exec($handle);          
       curl_close($handle);
       ob_clean();


       /*End Email*/

    		 //For password log
       $password_log_date = array(
        'user_id' => $last_user_insert_id,
        'password' => md5($this->input->post('password')),
        'created_on' => date("Y-m-d H:i:s")
      );
       $last_insert_password_log = $this->CommonMdl->insertRow($password_log_date,'tbl_user_password_log');
	      /////////

     }
     if($last_user_insert_id){

       echo $last_user_insert_id;
     }
     else{
      echo "failed";
    }

    
  }

  
 		 //Mobile Varification
  
  if($mob_otp = $this->input->post('mob_otp')){
   $date= date("Y-m-d H:i:s");
   $cond = array('user_id' => $this->session->userdata['last_user_insert_id'],'verification_code' => $mob_otp,'verification_type' => 'mobile','expire_on>=' =>$date);
   $res=$this->CommonMdl->fetchNumRows('tbl_user_verification',$cond,$cond1='');
   if($res==1){
		    		//update varification table
    $date_arr = array(
      'status' => 'verified',
      'updated_by_user' => date("Y-m-d H:i:s"),
    );
    $whr = array('user_id'=>$this->session->userdata['last_user_insert_id'],'verification_type'=>'mobile');
    $this->CommonMdl->updateData($date_arr,$whr,'tbl_user_verification');

    			 // update user table
    $user_arr = array(
      'is_mobile_verified' => 'yes',
      'user_status' => 'enable',
      'updated_by' => $this->session->userdata['last_user_insert_id'],
      'updated_on' => date("Y-m-d H:i:s"),
    );
    $whr_user = array('user_id'=>$this->session->userdata['last_user_insert_id']);
    $this->CommonMdl->updateData($user_arr,$whr_user,'tbl_user');

    echo "1";
  }
  else{
    echo "failed";
  }
		    	//$this->session->unset_userdata('last_user_insert_id');
}
}
/*#########End user login after registration*/
public function user_after_otp(){

  $user_data = $this->CommonMdl->getResultByCond('tbl_user',array('user_id'=>$this->session->userdata['last_user_insert_id']),'*',$order_by='');
  //print_r($user_data);
  if (!empty($user_data)){
   $this->session->set_userdata(array('user_id' => $user_data[0]->user_id,'user_email' => $user_data[0]->user_email,'user_name' => $user_data[0]->user_name,'user_mobile_no' => $user_data[0]->user_mobile_no,'user_role' => $user_data[0]->user_role,'user_gender' => $user_data[0]->user_gender));
  //print_r($_SESSION);die();
   redirect('dashboard');

}

}
//Regenrate OTP 

public function regenrate_otp(){
  	//print_r($_POST);
  $six_digit_random_number = mt_rand(100000, 999999);
 $user_id =   $this->session->userdata['last_user_insert_id'];
 //$user_id = $this->input->post('user_id')
  $mob_date = array(
    'user_id' =>$user_id,
    'verification_code' => $six_digit_random_number,
    'verification_type' => 'mobile',
    'expire_on' => date('Y-m-d H:i:s', strtotime('+2 minute')),
    'created_on' => date("Y-m-d H:i:s")
  );
  $last_insert_mob_id = $this->CommonMdl->insertRow($mob_date,'tbl_user_verification');

  $whr = array('user_id'=>$user_id);
  $User_data = $this->CommonMdl->getResultByCond('tbl_user',$whr,'user_mobile_no,user_name,user_email',$order_by='');

  /*Email*/
  $data = array('action' => 'mobile_verification','email' => $User_data[0]->user_email,'user_name' => $User_data[0]->user_name,'verification_code' => $six_digit_random_number);

        
       $url= base_url('email_script.php');
       $handle = curl_init($url);
       curl_setopt($handle, CURLOPT_POST, true);
       curl_setopt($handle, CURLOPT_POSTFIELDS, $data);
       $res=curl_exec($handle);          
       curl_close($handle);
       ob_clean();



  /*************msg code***********************/
  $phone = $User_data[0]->user_mobile_no;
  $user_name = $User_data[0]->user_name; 
  $SENDER_ID = SENDER_ID;
  $AUTH_KEY = AUTH_KEY; 
  $msg="Hello $user_name ,\n\nGreetings from SocialSportz!\n\nThank you for registering. Your OTP is $six_digit_random_number\nRegards."; 
  
  $message=array($msg); 
  $message1= http_build_query($message);
  $message1= substr($message1, 2);
  $url= "http://api.msg91.com/api/sendhttp.php?sender=$SENDER_ID&route=1&mobiles=$phone&authkey=$AUTH_KEY&country=91&message=$message1"; 
  
  $curl = curl_init(); 
  
  curl_setopt_array($curl, array(
    CURLOPT_URL =>$url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_SSL_VERIFYHOST => 0,
    CURLOPT_SSL_VERIFYPEER => 0,
  ));
  
  $response = curl_exec($curl); 
  $err = curl_error($curl);
  
  curl_close($curl);
  
  if ($err) {
    "cURL Error #:".$err;
  } else {
   $response;
 }

 if($last_insert_mob_id){
   echo "1";
 }
 else{
   echo "Failed";
 }
}

public function check_email_mobile(){
   //echo $this->input->post('countrycode').$this->input->post('userphone');die();
  $cond = '';
  if($this->input->post('useremail')){
    $cond = array('user_email' => $this->input->post('useremail'),'is_mobile_verified' => 'yes');
  }
  else if($this->input->post('userphone')){
    $cond = array('user_mobile_no' => $this->input->post('countrycode').$this->input->post('userphone'),'is_mobile_verified' => 'yes');
  }
  
  if($this->input->post('page_id')!=''){
    $cond1 = array('page_id!=' => $this->input->post('page_id'));
  }
  else{
    $cond1 = array();
  }

  $res=$this->CommonMdl->fetchNumRows(' tbl_user',$cond,$cond1);
  if($res>0){
    echo "1";
  }
  else{
    echo "2";
  }
}


public function emailverification(){
	$date= date("Y-m-d H:i:s");
  $user_id=$this->uri->segment(3);
  $verification_code=$this->uri->segment(4);

  $whr = array('user_id'=>$user_id,'verification_code'=>$verification_code,'expire_on>=' =>$date);
  $user_data = $this->CommonMdl->getResultByCond('tbl_user_verification',$whr,'expire_on,status',$order_by='');
	//print_data($user_data);
  if(!empty($user_data && $user_data[0]->status=='unverified')){
		//update varification table
    $date_arr = array(
      'status' => 'verified',
      'updated_by_user' => date("Y-m-d H:i:s"),
    );
    
    $this->CommonMdl->updateData($date_arr,$whr,'tbl_user_verification');

    			 // update user table
    $user_arr = array(
      'is_email_verified' => 'yes',
      'updated_by' => $user_id,
      'updated_on' => date("Y-m-d H:i:s"),
    );
    $whr_user = array('user_id'=>$user_id);
    $this->CommonMdl->updateData($user_arr,$whr_user,'tbl_user');

    $this->session->set_flashdata('msg', 'Your Email has been Verified.');
    $this->load->view('public/ThanksView');

  }
  else if($user_data && $user_data[0]->status=='verified'){
    $this->session->set_flashdata('msg', 'Email verification already done.');
    $this->load->view('public/ThanksView');
  }
  
  else{

   $this->session->set_flashdata('msg', "Link has been expired, <a href=".base_url('login/email_re_verification/'.$user_id)."><b>please click here</b></a> to genrate new link");
      	//redirect('thank-you');
   $this->load->view('public/ThanksView');

 }

}

public function email_re_verification(){
	$user_id=$this->uri->segment(3);
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
  /*End Email*/

  $this->session->set_flashdata('msg', "Your email verification Link has been sent, please eheck your mail box");
  redirect('thank-you');
}


public function user_login(){
  $user_email = $this->input->post('username');
  $user_password = md5($this->input->post('password'));

  $cond = array('user_email'=>$user_email,'user_password'=>$user_password,'is_mobile_verified'=>'yes');
  $user_data = $this->CommonMdl->getResultByCond('tbl_user',$cond,'*',$order_by='');
	//print_r($user_data);
  if (!empty($user_data) && $user_data[0]->user_status=='enable'){
   $this->session->set_userdata(array('user_id' => $user_data[0]->user_id,'user_email' => $user_data[0]->user_email,'user_name' => $user_data[0]->user_name,'user_mobile_no' => $user_data[0]->user_mobile_no,'user_role' => $user_data[0]->user_role,'user_gender' => $user_data[0]->user_gender));
	//print_r($_SESSION);die();
   if(!empty($this->input->post('remember')))
   {
    setcookie('username',$user_email, time() + (86400 * 30), "/");
    setcookie('password',$this->input->post('password'), time() + (86400 * 30), "/");
  }
  echo "1";
}
else if(!empty($user_data) && $user_data[0]->user_status=='disable'){
  echo "2";
  }
else{
 echo "0";

}
}

/*================Forgot Password code start here============*/

public function forgotpassword(){
 $whr_email = array('user_email'=>$this->input->post('register_email'));
 $user_data = $this->CommonMdl->getResultByCond('tbl_user',$whr_email,'*',$order_by='');

 if(!empty($user_data) && $user_data[0]->user_status=='enable' && $user_data[0]->is_mobile_verified=='yes'){
  $forgot_password_code = md5(uniqid(rand(), true));

    		  //For Email varification
  $date = array(
    'user_id' => $user_data[0]->user_id,
    'password_code' => $forgot_password_code,
    'expire_on' => date('Y-m-d H:i:s', strtotime('+1 day')),
    'created_on' => date("Y-m-d H:i:s")
  );
  $this->CommonMdl->insertRow($date,'tbl_user_forgot_password');

  /*Email when genrate ref id*/

  $data = array('action' => 'forgot_password','email' => $user_data[0]->user_email,'user_name' => $user_data[0]->user_name,'user_id' => $user_data[0]->user_id,'forgot_password_code' => $forgot_password_code);

  $url= base_url('email_script.php');
  $handle = curl_init($url);
  curl_setopt($handle, CURLOPT_POST, true);
  curl_setopt($handle, CURLOPT_POSTFIELDS, $data);
  $res=curl_exec($handle);          
  curl_close($handle);
  ob_clean();
  /*End Email*/
  echo "1";
}

else if(!empty($user_data && $user_data[0]->user_status=='disable')){
  echo "2";
}
else if(!empty($user_data && $user_data[0]->is_mobile_verified=='no')){
  echo "4";
}
else{
  echo "3";
}
}


public function newpassword($user_id,$password_code){
 $date= date("Y-m-d H:i:s");
 

 $whr = array('user_id'=>$user_id,'password_code'=>$password_code,'expire_on>=' =>$date);
 $data['user_data'] = $this->CommonMdl->getResultByCond('tbl_user_forgot_password',$whr,'*',$order_by='');
	//print_data($data['user_data']);
 if(!empty($data['user_data'])){
   $this->load->view('public/ResetPasswordView',$data);	
 }

 else{

   $this->session->set_flashdata('msg', "Link has been expired");
  $this->load->view('public/ThanksView');
 }

}

public function update_password(){
  $user_id = $this->input->post('user_id');
  $password = $this->input->post('passwrdreset');
		//update user table
  $whr = array('user_id' => $user_id);
  $user_arr = array(
    'user_password' => md5($password),
    'updated_by' => $user_id,
    'updated_on' => date("Y-m-d H:i:s"),
  );
  
  $this->CommonMdl->updateData($user_arr,$whr,'tbl_user');
			 //For password log
  $password_log_date = array(
   'user_id' => $user_id,
   'password' => md5($this->input->post('password')),
   'created_on' => date("Y-m-d H:i:s")
 );
  $this->CommonMdl->insertRow($password_log_date,'tbl_user_password_log');

  $this->session->set_flashdata('msg','congratulations !!! Your password has been changed.');
  redirect('thank-you');

}

/*public function dashboard(){
	echo "User dashboard";
	echo "<br>";
	echo "<pre>";
	print_r($_SESSION);
	echo "<br>";
	echo $this->session->userdata['user_email'];
	echo "<br>";
	echo $this->session->userdata['user_id'];
}*/
public function logout(){
  $this->session->unset_userdata('user_id');
  $this->session->unset_userdata('user_email');
  $this->session->unset_userdata('user_mobile_no');
  $this->session->unset_userdata('user_name');
  $this->session->unset_userdata('user_role');
  $this->session->unset_userdata('user_gender');
  redirect('login');
  
}

public function facilityprofiling(){
	if(!$this->session->userdata('last_user_insert_id')){
    redirect('login');

  }
  $user_id = $this->session->userdata['last_user_insert_id'];
  $whr = array('user_id'=>$user_id);
  $data['fac_personal_data'] = $this->CommonMdl->getRow('tbl_user','*',$whr);

  $reward_whr = array('reward_status'=>'enable');
  $order_by = array('col_name'=>'reward_name','order'=>'asc');
  $data['rewards_type'] = $this->CommonMdl->getResultByCond('tbl_reward_achievement',$reward_whr,'reward_id,reward_name',$order_by);
  
  $sport_whr = array('sport_status'=>'enable');
  $sport_order_by = array('col_name'=>'sport_name','order'=>'asc');
  $data['sport_list'] = $this->CommonMdl->getResultByCond('tbl_sport_list',$sport_whr,'sport_id,sport_name',$sport_order_by);

  $amenity_whr = array('amenity_status'=>'enable');
  $amenity_order_by = array('col_name'=>'amenity_name','order'=>'asc');
  $data['amenity_list'] = $this->CommonMdl->getResultByCond('tbl_amenity',$amenity_whr,'amenity_id,amenity_name,amenity_icon',$amenity_order_by);

  $fac_whr = array('fac_status'=>'enable','user_id'=>$user_id);
  $fac_order_by = array('col_name'=>'fac_name','order'=>'asc');
  
	//print_data($data['rewards_type']);
  $this->load->view('public/FacilityProfileView',$data);

}

public function complete_profiling(){
	$user_id=$this->session->userdata['last_user_insert_id'];

	//Step 1 code start here-------------
	if($this->input->post('action') =='fac_step_1')
  {
		//print_data($_POST);
		 // update user table
    $user_arr = array(
      'user_name' => $this->input->post('name'),
      'user_email' => $this->input->post('email'),
      'user_gender' => $this->input->post('gender'),
      'user_mobile_no' => $this->input->post('phone'),
      'user_city' => $this->input->post('city'),
      'user_google_address' => $this->input->post('address2'),
       'user_latitude' => $this->input->post('latitude'),
      'user_longitude' => $this->input->post('longitude'),
      'user_pincode' => $this->input->post('pincode'),
      'user_address' => $this->input->post('address2'),
      'user_address2' => $this->input->post('address1'),
      'updated_by' => $user_id,
      'updated_on' => date("Y-m-d H:i:s"),
    );
    //print_data($user_arr);
    $whr = array('user_id'=>$user_id);
    $res=$this->CommonMdl->updateData($user_arr,$whr,'tbl_user');
    if($res){
     echo "1";
   }
   else{
     echo "failed";
   }
 }
	//Stpe 2 code start here---------------

 if($this->input->post('action') =='fac_step_2' && $this->input->post('fac_id') =='')
 {
  
   $fac_banner['file_name']='';
   
   $path = "assets/public/images/fac";
   $this->upload->initialize($this->set_upload_options($path));
   if ($this->upload->do_upload('fac_banner')){
     $fac_banner= $this->upload->data();
     
   }
   
     $facility_name=strtolower(trim($this->input->post('facilityname')));
   $facility_slug_name=str_replace(' ','-',$facility_name);
	// echo $facility_slug_name;
    
	 $count_slug=$this->CommonMdl->fetchNumRows('tbl_facility',array('fac_slug'=>$facility_slug_name),$cond1='');
  if($count_slug >0){ 
     $facility_slugs=$facility_slug_name.'-'.$count_slug;
  }
  else{
	  $facility_slugs = $facility_slug_name;
  }
  

		 // insert fac details
   $fac_arr = array(
    'fac_name' => $this->input->post('facilityname'),
    'user_id' => $user_id,
    'fac_type' => $this->input->post('fac_type'),
	 'fac_slug'=>$facility_slugs,
    'fac_description' => $this->input->post('fac_text'),
    'fac_city' => $this->input->post('fac_city'),
    'fac_pincode' => $this->input->post('fac_pincode'),
    'fac_google_address' => $this->input->post('fac_city'),
    'fac_google_address' => $this->input->post('fac_city'),
    'fac_latitude' => $this->input->post('fac_latitude'),
    'fac_longitude' => $this->input->post('fac_longitude'),
    'fac_country' => 'india',
    'fac_address' => $this->input->post('fac_area'),
    'fac_banner_image' => $fac_banner['file_name'],
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

/*update fac data*/
if($this->input->post('action') =='fac_step_2' && $this->input->post('fac_id') !='')
{
	//print_r($_POST);
	$facility_id =$this->input->post('fac_id');
	$fac_banner['file_name']='';

	$new_fac_banner = $_FILES['fac_banner']['name'];
	
	$path = "assets/public/images/fac";
  $this->upload->initialize($this->set_upload_options($path));
  if ($this->upload->do_upload('fac_banner')){
   $fac_banner= $this->upload->data();
 }

 else if($new_fac_banner==''){
   $fac_banner['file_name']=$this->input->post('old_fac_banner');
 }


		 // insert fac details
$update_fac_arr = array(
  'fac_name' => $this->input->post('facilityname'),
  'user_id' => $user_id,
  'fac_type' => $this->input->post('fac_type'),
  'fac_description' => $this->input->post('fac_text'),
  'fac_city' => $this->input->post('fac_city'),
  'fac_pincode' => $this->input->post('fac_pincode'),
  'fac_country' => 'india',
  'fac_address' => $this->input->post('fac_area'),
  'fac_banner_image' => $fac_banner['file_name'],
  'updated_by_type' => 'user',
  'created_by_type' => 'user',
  'created_on' => date("Y-m-d H:i:s"),
  'updated_on' => date("Y-m-d H:i:s")
);

$whr = array('fac_id'=>$facility_id);
$res=$this->CommonMdl->updateData($update_fac_arr,$whr,'tbl_facility');

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
$this->CommonMdl->deleteRecord('tbl_facility_timing',$whr);
$this->CommonMdl->insertinbatch($fac_timming_array,'tbl_facility_timing');

	//print_data($fac_timming_array);


/*if($this->input->post('reward_type')!=''){
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
  else {
    $achievement_img1['file_name']=$this->input->post('old_achievement_image1')[$i];
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
  else{
   $achievement_img2['file_name']=$this->input->post('old_achievement_image2')[$i];
 }


 $update_rewardArr[] = array(
  'fac_id' => $facility_id,
  'reward_title' => $this->input->post('reward_title')[$i],
  'reward_id' => $this->input->post('reward_type')[$i],
  'image1' => $achievement_img1['file_name'],
  'image2' => $achievement_img2['file_name'],
  'created_on' =>date("Y-m-d H:i:s"),
  'updated_on' =>date("Y-m-d H:i:s")
);
}
	     
$this->CommonMdl->deleteRecord('tbl_facility_reward_achievement',$whr);
$this->CommonMdl->insertinbatch($update_rewardArr,'tbl_facility_reward_achievement');
	  
}*/


if($res){
  echo "1";
}
else{
  echo "failed";
}
}






	//Step 3
if($this->input->post('action') =='fac_step_3')
{
		//	print_data($_POST);
		/*if($this->input->post('IndorkitAvl')!='yes'){
          $IndorkitAvl = 'no';
        }
        else{
          $IndorkitAvl = 'yes';
        }
		if($this->input->post('OutdorkitAvl')!='yes'){
          $OutdorkitAvl = 'no';
        }
        else{
          $OutdorkitAvl = 'yes';
        }*/
        $sport_arr = array(
          'fac_id' => $this->input->post('fac_id'),
          'user_id' => $user_id,
          'sport_id' => $this->input->post('sports_id'),
          'sport_court' => $this->input->post('courtnumber'),
          'sport_indor' => $this->input->post('indor_qty'),
          'sport_outdor' => $this->input->post('outdor_qty'),
				      /*'indor_kit_available' => $IndorkitAvl,
					  'outdor_kit_available' => $OutdorkitAvl,
				      'indor_kit_price' => $this->input->post('indoorkitprice'),
				      'outdor_kit_price' => $this->input->post('outdoorkitprice'),*/
				      'created_on' => date("Y-m-d H:i:s"),
				      'updated_on' => date("Y-m-d H:i:s")
           );
        if($this->input->post('sport_court_id')==''){
          $insert_id = $this->CommonMdl->insertRow($sport_arr,'tbl_facility_sport');
        }
        if($this->input->post('sport_court_id')!=''){
          $whr = array('fac_sport_id'=>$this->input->post('sport_court_id'));
          $insert_id = $this->CommonMdl->updateData($sport_arr,$whr,'tbl_facility_sport');
        }
        if($insert_id){
         echo "1";
       }
       else{
         echo "failed";
       }

     }

	 //Step 4
     if($this->input->post('action') =='fac_step_4')
     {
      
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
	//#####

	 //Step 5
   if($this->input->post('action') =='fac_step_5')
   {
    $gst_image='';
    $pan_image='';
    $firm_img='';
    $address_image='';
    $Cancelled_check_image='';

    $gst_image1='';
    $pan_image1='';
    $firm_img1='';
    $address_image1='';
    $Cancelled_check_image1='';
     
     $path = "assets/public/images/bankinfo";
     $this->upload->initialize($this->set_upload_options($path));
     if ($this->upload->do_upload('gst_image')){
       $gst_image= $this->upload->data();
       $gst_image1 = $gst_image['file_name'];
     } 

     $this->upload->initialize($this->set_upload_options1($path));
     if ($this->upload->do_upload('pan_image')){
      $pan_image= $this->upload->data();
      $pan_image1 = $pan_image['file_name'];
    }

    $this->upload->initialize($this->set_upload_options2($path));
    if ($this->upload->do_upload('firm_img')){
      $firm_img= $this->upload->data();
      $firm_img1 = $firm_img['file_name'];
    }
    $this->upload->initialize($this->set_upload_options3($path));
    if ($this->upload->do_upload('address_image')){
      $address_image= $this->upload->data();
      $address_image1 = $address_image['file_name'];
    }
    $this->upload->initialize($this->set_upload_options4($path));
    if ($this->upload->do_upload('Cancelled_check_image')){
      $Cancelled_check_image= $this->upload->data();
      $Cancelled_check_image1 = $Cancelled_check_image['file_name'];
    }

    
    $bankinfo = array(
     'user_id' => $user_id,
     'ifsc_code' => $this->input->post('ifsccode'),
     'bank_name' => $this->input->post('bankname'),
     'account_name' => $this->input->post('account_name'),
     'account_number' => $this->input->post('accountnumber'),
     'account_type' => $this->input->post('account_type'),
     'branch_address' => $this->input->post('branchname'),
     'gst_image' => $gst_image['file_name'],
     'pan_image' => $pan_image['file_name'],
     'firm_image' => $firm_img['file_name'],
     'address_proof_image' => $address_image['file_name'],
     'cheque_image' => $Cancelled_check_image['file_name'],
     'created_on' =>date("Y-m-d H:i:s"),
     'updated_on' =>date("Y-m-d H:i:s")
   );
    
//print_data($bankinfo);
    $res = $this->CommonMdl->insertRow($bankinfo,'tbl_user_bank_details');
    if($res){
     echo "1";
   }
   else{
     echo "failed";
   }


 }



 if($this->input->post('action') =='go_to_dashboard')
     {
      $cond = array('user_id'=>$user_id,'is_mobile_verified'=>'yes','user_status'=>'enable');
     $user_data = $this->CommonMdl->getResultByCond('tbl_user',$cond,'*',$order_by='');
 // print_r($user_data);
  if (!empty($user_data)){
   $this->session->set_userdata(array('user_id' => $user_data[0]->user_id,'user_email' => $user_data[0]->user_email,'user_name' => $user_data[0]->user_name,'user_mobile_no' => $user_data[0]->user_mobile_no,'user_role' => $user_data[0]->user_role,'user_gender' => $user_data[0]->user_gender));

       echo "1";
     }
     else{
       echo "failed";
  
   }
 }
 
}

public function getfacDetails(){
  $user_id=$this->session->userdata['last_user_insert_id'];
  $whr = array('user_id'=>$user_id);
  $data['fac_details'] = $this->CommonMdl->getResultByCond('tbl_facility',$whr,'*',$order_by='');
  $html['_html'] = $this->load->view('public/ajax/FacListingView',$data,true);
  return $this->output->set_content_type('application/json')->set_output(json_encode($html));
}

public function getfacListing(){
  $user_id=$this->session->userdata['last_user_insert_id'];
  $whr = array('user_id'=>$user_id);
  $data['results'] = $this->CommonMdl->getResultByCond('tbl_facility',$whr,'fac_id,fac_name',$order_by='');
  $html['_html'] = $this->load->view('public/ajax/OptionView',$data,true);
  return $this->output->set_content_type('application/json')->set_output(json_encode($html));
}

public function getSportCourtDetails(){
	$this->load->model('public/UserMdl');
  $user_id=$this->session->userdata['last_user_insert_id'];
  $data['sport_details'] = $this->UserMdl->getFacSport($user_id);
//print_data($data);
  $html['_html'] = $this->load->view('public/ajax/SportCourtListingView',$data,true);
  return $this->output->set_content_type('application/json')->set_output(json_encode($html));
}

public function getSingleFac(){
	$whr = array('fac_id'=>$this->input->post('fac_id'));
	$data['single_fac_data'] = $this->CommonMdl->getRow('tbl_facility','*',$whr);
	$data['single_fac_timing'] = $this->CommonMdl->getResultByCond('tbl_facility_timing',$whr,'*',$order_by='');
	$data['fac_reward_data'] = $this->CommonMdl->getResultByCond('tbl_facility_reward_achievement',$whr,'*',$order_by='');
	$reward_whr = array('reward_status'=>'enable');
	$order_by = array('col_name'=>'reward_name','order'=>'asc');
	$data['rewards_type'] = $this->CommonMdl->getResultByCond('tbl_reward_achievement',$reward_whr,'reward_id,reward_name',$order_by);
	//print_data($data['single_fac_timing']);
	echo  json_encode($data);
}


public function getfac_sport(){
	$whr = array('fac_sport_id'=>$this->input->post('fac_sport_id_edit'));
	$data['fac_sport'] = $this->CommonMdl->getRow('tbl_facility_sport','*',$whr);
	$user_id=$this->session->userdata['last_user_insert_id'];
	$whr1 = array('user_id'=>$user_id);
	$data['fac_details'] = $this->CommonMdl->getResultByCond('tbl_facility',$whr1,'fac_id,fac_name',$order_by='');
	
	//print_data($data['single_fac_timing']);
	echo  json_encode($data);

}


public function deletefac(){
	$whr = array('fac_id'=>$this->input->post('fac_id'));
	//$this->CommonMdl->deleteRecord('tbl_facility_reward_achievement',$whr);
	$this->CommonMdl->deleteRecord('tbl_facility_timing',$whr);
	$this->CommonMdl->deleteRecord('tbl_facility_sport',$whr);
	$this->CommonMdl->deleteRecord('tbl_facility',$whr);
	echo "1";
}
public function deletefacsport(){
	$whr = array('fac_sport_id'=>$this->input->post('fac_sport_id'));
	$this->CommonMdl->deleteRecord('tbl_facility_sport',$whr);
	echo "1";
}


public function fac_percent(){
  $user_id=$this->session->userdata['last_user_insert_id'];
  /*profile completion status*/
    $profile_percent1 = 0;
    $profile_percent2 = 0;
    $profile_percent3 = 0;
    $profile_percent4 = 0;
    $profile_percent5 = 0;
    $profile_percent6 = 0;
  
    $user_info=$this->CommonMdl->getRow('tbl_user','*',array('user_id'=>$user_id));

     $user_facility=$this->CommonMdl->getResultByCond('tbl_facility',array('user_id'=>$user_id),'fac_id','');
    if(count($user_facility)>0){
     @$user_sport_count=$this->CommonMdl->fetchNumRows('tbl_facility_sport',array('fac_id'=>$user_facility[0]->fac_id),'');
    }
    @$user_amenity_count=$this->CommonMdl->fetchNumRows('tbl_facility_amenities',array('user_id'=>$user_id),'');
    @$user_bank_info_count=$this->CommonMdl->fetchNumRows('tbl_user_bank_details',array('user_id'=>$user_id),'');
    if($user_info->user_pincode!=''){
      $profile_percent1=5;
    }
     if($user_info->is_email_verified=='yes'){
      $profile_percent2=10;
    }
    if(count($user_facility)>0){
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
//print_r($data['profile_percent']);

  $html['_html'] = $this->load->view('public/ajax/FacProfilePercentView',$data,true);
  return $this->output->set_content_type('application/json')->set_output(json_encode($html));

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
public function email_subscribe(){
  $cond = array('email'=>$this->input->post('EmailId'));
  $res=$this->CommonMdl->fetchNumRows('tbl_newsletter',$cond,$cond1='');
  
  if($res==0){
   
    $date_arr = array(
    'email' =>$this->input->post('EmailId'),
    'updated_by' =>'user',
    'status' =>'active',
    'create_on' =>date("Y-m-d H:i:s"),
    'update_on' =>date("Y-m-d H:i:s"),
     );
     $last_user_insert_id = $this->CommonMdl->insertRow($date_arr,'tbl_newsletter');
      if($last_user_insert_id){
        $data = array('action' => 'email_subscribe','email' => $this->input->post('EmailId'));

       // echo "<pre>"; print_r( $data); echo die;;
         //echo "<pre>"; print_r( $data); die();
       $url= base_url('email_script.php');
       $handle = curl_init($url);
       curl_setopt($handle, CURLOPT_POST, true);
       curl_setopt($handle, CURLOPT_POSTFIELDS, $data);
       $res=curl_exec($handle);          
       curl_close($handle);
       ob_clean();
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

}
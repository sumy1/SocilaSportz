<?php
defined('BASEPATH') OR exit('No direct script access allowed');
function has_session(){
	$ci = & get_instance();
	if($ci->session->userdata('_au')){
		return true;
	}
	else{
		return false;
	}
}
function details($key){
	$ci = & get_instance();
	$admin_details = $ci->session->userdata('_au');
	switch ($key) {
		case 'id':
			return $admin_details['id'];
			break;
		case 'username':
			return $admin_details['username'];
			break;
		case 'useremail':
			return $admin_details['useremail'];
			break;
		case 'name':
			return $admin_details['name'];
			break;
		case 'contact':
			return $admin_details['contact'];
			break;
		case 'profile_img':
			return $admin_details['profile_img'];
			break;
		default:
			return '';
			break;
	}
}
function print_data( $data = array() ){
	echo "<pre>",htmlspecialchars(print_r($data,true)),"</pre>";exit;
}
function check_unique($field,$value,$id=false){
$ci = & get_instance();
$ci->db->select($field)->from('member_details');
$ci->db->where($field,$value);
if($id)
	$ci->db->where('id !=',$id);
$qry = $ci->db->get();
if ($qry->num_rows()>0) {
	return true;
}
else{
	return false;
}
}
function is_user($user_id){
	if(empty($user_id)){
		return false;
	}
	$ci = & get_instance();
	$total = $ci->db->select('count(user_id) as total')
		->from('sr_user_login')
			->where('user_id', $user_id)
				->get()
					->row_array()['total'];
	return ($total > 0) ? true : false;
}

// This function used for 404 redirection========
function is_slug($whr,$table){
	$ci = & get_instance();
	$total = $ci->db->select('count(*) as total')
		->from($table)
			->where($whr)
				->get()
					->row_array()['total'];
	return ($total > 0) ? true : false;
}


// This function used for get name by user_id========
	function getUserNameByUserId($admin_id){
		$name='';
		if($admin_id!='' && $admin_id!='0'){
			$ci = & get_instance();
			$ci->db->select('login_name');
			$ci->db->from('sr_admin');
			$ci->db->where('admin_id', $admin_id);
			$query = $ci->db->get(); 
			$ret = $query->row();
			if($query->num_rows()>0){
				$name = ucwords($ret->login_name);
			}	
		}	
		return $name;	
	}
	/*
	function adminAccessRight($accessPage){
		$admin_id = details('id');
		$rightsArr=array(); $role_id='';
		if($admin_id!='' && $admin_id!='0'){
			$ci = & get_instance();
			$ci->db->select('role_id');
			$ci->db->from('sr_admin');
			$ci->db->where('admin_id', $admin_id);
			$query = $ci->db->get(); 
			$ret = $query->row();
			$resData = $query->result();
			$role_id=$resData[0]->role_id;
			## access rights for owner role=================
			if($role_id==1){
				$rightsArr=array('dashboard','search','photos','interests','flags','users','ep','stats','admin');
			}
			## access rights for Senior Admin role=================
			if($role_id==2){
				$rightsArr=array('dashboard','photos','interests','flags','ep');
			}
			## access rights for Admin role=================
			if($role_id==3){
				$rightsArr=array('dashboard_light','dashboard','photos','interests','flags');
			}	
		}
		if(in_array($accessPage, $rightsArr)){
			return true;
		}else{
			return false;
		}
	}
	function authorizeAccess(){
		$admin_id = details('id');
		$ci = & get_instance();
		if($admin_id!='' && $admin_id!='0'){
			$ci = & get_instance();
			$ci->db->select('role_id');
			$ci->db->from('sr_admin');
			$ci->db->where('admin_id', $admin_id);
			$query = $ci->db->get(); 
			$ret = $query->row();
			$resData = $query->result();
			$role_id=$resData[0]->role_id;
			$controler = $ci->uri->segment(2);/// return controler name
			$contFunction = $ci->uri->segment(3);/// return controler name
			// for profile details page access here
			if($contFunction=='user_profile'){
				if($role_id=='2' || $role_id=='3'){ return false; }  
			}
			if($contFunction=='alluser'){
				if($role_id=='2' || $role_id=='3'){ return false; }  
			}
			// for dashboard, adminuser, stats controller page access here
			if($controler=='powersearch' || $controler=='adminuser' || $controler=='stats'){
				if($role_id=='2' || $role_id=='3'){ return false; } 
			}
			// for Ep chat page access here		
			if($controler=='chat'){
				if($role_id=='3'){ return false; }  
			}
			return true;
		}
	}
	*/
	
	function getChatImage($image){
		if($image!=''){
			if(file_exists(FCPATH."upload/msg_upload/".$image)){
				//return '2';
				return $imgFilePath = base_url().'upload/msg_upload/'.$image; 
			}
			else{ return false; }
		}
		return false;
	}
    
	function authorizeUrl($role){
		$ci = & get_instance();
		$controler = $ci->uri->segment(2);  /// return controler name
		
		$controlerFunction = $ci->uri->segment(3);  /// return controler name
		
	    if($role=='1'){
			$rightsArr=array('dashboard','registeruser','registerlist','category','subcategory','Manageproduct','productlicense','productlocation','producttype','product','coupon','order','blog','job','service','page','banner','user','client','homeCtrl');
        }
	    if($role=='2'){
			$rightsArr=array('dashboard','category','subcategory','Manageproduct','edit_category','admin','Category','producttype','productlicense','productlocation','product','coupon','order','blog','job','service','page','homeCtrl');
	    }
	    if($role=='3'){
			$rightsArr=array('dashboard','order');
	    }
	    if($role=='4'){
			$rightsArr=array('dashboard','page');
	    }
		if($role=='5'){
			$rightsArr=array('dashboard','banner','client','blog','service','category','subcategory','Manageproduct','productlicense','productlocation','producttype','product','coupon','blog','service');      
		}
        if(in_array($controler, $rightsArr)){
          return true;
        }else{
         echo "page not authrized"; exit;
        }	
	}
	
	



  function checkUserRole(){
	$CI =& get_instance();
	$user_role_id=$CI->session->userdata('user_roles');
	$segement=$CI->uri->segment(1);

	
}

	/// user role helper
	function RoleAccessPanel($pageName){
	
		//if($pageName='Home-Configuration'){ echo "testtttttttttttttttttt"; die; }
		$CI =& get_instance();
		$user_role_id=$CI->session->userdata('admin_id');
		if($user_role_id=='1'){
			return true;
		}else{
			$dataList=$CI->CommonMdl->getResultByCond('tbl_admin_user_roles',array('admin_id'=>$user_role_id),'*',$order_by='');
			$accessPagesDb=array();
			foreach($dataList as $val){
				$accessPagesDb[]=trim($val->role_access);
			}

			if(in_array($pageName, $accessPagesDb)){
				return true;
			}else{
				return false;
			}
		}
  }

	
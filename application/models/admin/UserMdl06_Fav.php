<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UserMdl extends CI_Model {

	public function __construct()

	{

		parent::__construct();

		$this->load->database();

	}

   public function get_admin_info($data){

    $this->db->select('*')->from('tbl_admin')-> where (array('admin_username' =>$data['username'] ,'admin_password' =>$data['password'],'admin_status'=>'enable'));

    $qry = $this->db->get();

    if ($qry->num_rows()==0) {

     return false;

   }

   else{	   

	 $row = $qry->row_array();

     $this->session->set_userdata(array('admin_id' => $row['admin_id'],'admin_username' => $row['admin_username'],'adminemail' => $row['admin_email'],'admin_name' => $row['admin_name']));   

     return true;

   }  

 }

 public function getRoleAccess($admin_id){
if($admin_id!=''){
      $this->db->select('ura.role_access_for');
      $this->db->from('tbl_admin_user_role ur');
      $this->db->join('tbl_admin_role_access ura', 'ura.role_access_id = ur.role_access_id');
      $this->db->where('ur.admin_id', $admin_id);
      $query = $this->db->get(); 
     // echo $this->db->last_query(); exit;                                                       
      return $query->result();
    }   
 }


}
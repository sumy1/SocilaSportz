<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UserMdl extends CI_Model {

	public function __construct()

	{

		parent::__construct();

		$this->load->database();

	}

    public function get_admin_info($data){

    $this->db->select('*')->from('tbl_admin')-> where (array('admin_username' =>$data['username'] ,'admin_password' =>$data['password']));

    $qry = $this->db->get();

    if ($qry->num_rows()==0) {

     return 0;

   }

   else{   

   $row = $qry->row_array();
   if($row['admin_status']=='enable'){

     $this->session->set_userdata(array('admin_id' => $row['admin_id'],'admin_username' => $row['admin_username'],'adminemail' => $row['admin_email'],'admin_name' => $row['admin_name']));   

     return 1;

    }
   else if($row['admin_status']=='disable'){
      return 2;
    } 
   }

 }

 public function getRoleAccess($admin_id){
if($admin_id!=''){
      $this->db->select('ur.role_access');
      $this->db->from('tbl_admin_user_roles ur');
      // $this->db->join('tbl_admin_role_access ura', 'ura.role_access_for = ur.role_access');
      $this->db->where('ur.admin_id', $admin_id);
      $query = $this->db->get(); 
     // echo $this->db->last_query(); exit;                                                       
      return $query->result();
    }   
 }


}
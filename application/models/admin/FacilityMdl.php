<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class FacilityMdl extends CI_Model 
{
public function __construct()
{
parent::__construct();

}

public function GetFacilityData(){

$this->db->select('tf.fac_name,tf.fac_type,tf.fac_city,tf.fac_status,tf.created_on,tf.fac_id,tu.user_name');
$this->db->from('tbl_facility tf');

$this->db->join('tbl_user tu', 'tf.user_id = tu.user_id'); 
$this->db->order_by('tf.fac_id','DESC');
$query = $this->db->get(); 
//echo $this->db->last_query(); exit;                                                       
return $query->result();

}

function delete_facility($tbl,$whr){
	if($this->db->delete($tbl,$whr))
		 {
		 	return true;
		 }
}



public function getResultBycond($tbl,$whr,$clms='*',$order_by=''){
   $this->db->select('*');
   $this->db->from($tbl);
   $this->db->where($whr);

  if($order_by!=''){
		$this->db->order_by($order_by['col_name'], $order_by['order']);
		}
		$query=$this->db->get();
		return $query->result();

}



public function updateData($data_arr,$whr,$tbl){
	  $this->db->where($whr);
       if($this->db->update($tbl,$data_arr))
       {
       //echo	$this->db->last_query(); exit; 
       	  return true;
       }
}



}


<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class BookingMdl extends CI_Model 
{
	public function __construct()
	{
		parent::__construct(); 
	}
	
	public function slotsDetailById($slot_batch_id,$package_id='')
	{


		$this->db->select('tbl_facility_batch_slot.*,tbl_slot_package_price.slot_package_price');
		$this->db->from('tbl_facility_batch_slot');
		$this->db->join('tbl_slot_package_price', 'tbl_facility_batch_slot.batch_slot_id = tbl_slot_package_price.batch_slot_id');
		$this->db->where('tbl_facility_batch_slot.batch_slot_id',$slot_batch_id);
		if($package_id!=''){

			$this->db->where('tbl_slot_package_price.package_id',$package_id);
		}
		$query = $this->db->get();

		//echo $this->db->last_query(); die;
		return $query->result();
	}
	
	public function batchSlotTypeDetail($slot_batch_id){
		$this->db->select('tbl_batch_slot_type.*');
		$this->db->from('tbl_batch_slot_type');
		$this->db->join('tbl_facility_batch_slot', 'tbl_facility_batch_slot.batch_slot_type_id = tbl_batch_slot_type.batch_slot_type_id');
		$this->db->where('tbl_facility_batch_slot.batch_slot_id',$slot_batch_id);
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		return $query->row();
	 }

	## get facility name by fac id ------
	public function getFacNameById($fac_id){
		$this->db->select('fac_name');
		$this->db->from('tbl_facility');
		$this->db->where('fac_id', $fac_id);
		$query = $this->db->get();
        $result = $query->result();
		if ($query->num_rows()>0) {
			return $result[0]->fac_name;
		}else{
			return '';
		}
	}
	public function getFacSportList($fac_id)
	{
		 	$this->db->select('tfs.*,tsl.sport_name,tsl.sport_icon');
			$this->db->from('tbl_facility_sport tfs');
			$this->db->join('tbl_sport_list tsl', 'tsl.sport_id = tfs.sport_id');
			$this->db->where('tfs.fac_id', $fac_id);
			//$this->db->group_by('tfc.fac_sport_id');
			$this->db->order_by('tfs.fac_sport_id','DESC');
			$query = $this->db->get(); 
			//echo $this->db->last_query(); exit;                                                       
			return $query->result();
	}
}
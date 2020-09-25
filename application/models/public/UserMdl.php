<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class UserMdl extends CI_Model 
{
	public function __construct()
	{
		parent::__construct(); 
	}
	
	public function getFacSport($user_id)
	{
		 	$this->db->select('tfc.*,tf.fac_name,tsl.sport_name');
			$this->db->from('tbl_facility_sport tfc');
			$this->db->join('tbl_facility tf', 'tf.fac_id = tfc.fac_id');
			$this->db->join('tbl_sport_list tsl', 'tsl.sport_id = tfc.sport_id');
			$this->db->where('tfc.user_id', $user_id);
			$this->db->group_by('tfc.fac_sport_id');
			$this->db->order_by('tfc.fac_sport_id','DESC');
			$query = $this->db->get(); 
			//echo $this->db->last_query(); exit;                                                       
			return $sr_flags = $query->result();
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

	public function getFacaminityList($user_id)
	{
		 	$this->db->select('fa.*,ta.amenity_name,ta.amenity_icon');
			$this->db->from('tbl_facility_amenities fa');
			$this->db->join('tbl_amenity ta', 'ta.amenity_id = fa.amenity_id');
			$this->db->where('fa.user_id', $user_id);
			//$this->db->group_by('tfc.fac_sport_id');
			$this->db->order_by('fa.fac_amenities_id','DESC');
			$query = $this->db->get(); 
			//echo $this->db->last_query(); exit;                                                       
			return $query->result();
	}


	public function getUserSlotBookingCount($user_id)
	{
		 	$this->db->select('tbo.*,tbs.*');
			$this->db->from('tbl_booking_order tbo');
			$this->db->join('tbl_booking_slot_detail tbs', 'tbs.booking_order_id = tbo.booking_order_id');
			$this->db->where('tbo.user_id', $user_id);
			$query = $this->db->get();
			return $query->num_rows();
	}

	public function getUserEventBookingCount($user_id)
	{
		 	$this->db->select('tbo.*,tbs.*');
			$this->db->from('tbl_booking_order tbo');
			$this->db->join('tbl_booking_event_detail tbs', 'tbs.booking_order_id = tbo.booking_order_id');
			$this->db->where('tbo.user_id', $user_id);
			$query = $this->db->get();
			return $query->num_rows();
	}
     public function getResultByCondss($tbl,$whr='',$clms='*',$order_by='',$total_review_show){
		$this->db->select($clms);
		$this->db->from($tbl);
		if($whr!=''){
		$this->db->where($whr);
		}
		if($order_by!=''){
		$this->db->order_by($order_by['col_name'], $order_by['order']);
		}
		if($total_review_show!=''){
			$this->db->limit($total_review_show);
		}
		
		$query=$this->db->get();
	 // echo $this->db->last_query();
	 // die;
		return $query->result();
	}










}
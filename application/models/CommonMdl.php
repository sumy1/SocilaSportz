<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class CommonMdl extends CI_Model 
{
	public function __construct()
	{
		parent::__construct(); 
	}
	public function insertRow($data_arr,$tbl){
		$this->db->insert($tbl,$data_arr);
		return $this->db->insert_id();
	}
	public function insertinBatch($arr,$tbl)
{
	 return $this->db->insert_batch($tbl,$arr);
} 

	public function fetchNumRows($tbl,$cond='',$cond1='')

	{
		$this->db->select('*');
		$this->db->from($tbl);
		if($cond!=''){
		$this->db->where($cond);
	}
		if($cond1!=''){
			$this->db->where($cond1);
		}
		$query = $this->db->get();
	//echo $this->db->last_query();die();
		return $query->num_rows();
	}
	public function getRow($tbl,$clms='*',$whr){
		$this->db->select($clms);
		$this->db->from($tbl);
		if($whr)
		$this->db->where($whr);
		$q=	$this->db->get();
		//echo $this->db->last_query();die();
		return $q->num_rows()?$q->row():'';
	}
	



	public function getResult($tbl,$clms='*'){
		$this->db->select($clms);
		$this->db->from($tbl);
		$query=$this->db->get();
		return $query->result();
	}

	public function getResultOrderBy($tbl,$clms='*',$order_by=''){
		$this->db->select($clms);
		$this->db->from($tbl);
		if($order_by!=''){
		$this->db->order_by($order_by['col_name'], $order_by['order']);
		}
		$query=$this->db->get();
		return $query->result();
	}

	public function getResultByCond($tbl,$whr='',$clms='*',$order_by=''){
		$this->db->select($clms);
		$this->db->from($tbl);
		if($whr!=''){
		$this->db->where($whr);
		}
		if($order_by!=''){
		$this->db->order_by($order_by['col_name'], $order_by['order']);
		}
		$query=$this->db->get();
	
		return $query->result();
	}

		public function getResultByCondLimit($tbl,$whr,$clms='*',$order_by='',$limit=''){
			
		$this->db->select($clms);
		$this->db->from($tbl);
		if($whr!=''){
		$this->db->where($whr);
	}
		if($order_by!=''){
		$this->db->order_by($order_by['col_name'], $order_by['order']);
		}
		if($limit!=''){
		$this->db->limit($limit);
		}
		$query=$this->db->get();
		return $query->result();
	}


	public function deleteRecord($tbl,$whr){
		if($this->db->delete($tbl,$whr)){
			return true;
		}
	}

	public function updateData($date_arr,$whr,$tbl){
		$this->db->where($whr);
   	if($this->db->update($tbl,$date_arr))
	   	{
	   		return true;
	   	} 
	 }



	 public function getResultwhere_by($tbl,$clm,$batch_slot_id){
		$this->db->select('*');
		$this->db->from($tbl);
		$this->db->where_in($clm,$batch_slot_id);
		$query=$this->db->get();
		return $query->result();
	}

		public function getResultByFilter($tbl,$clms='*',$order_by='',$start_date='',$end_date='',$status='')
		{
		$this->db->select($clms);
		$this->db->from($tbl);
		if($start_date!=''){
			$this->db->where('created_on>=',$start_date);
		}
			if($end_date!=''){
			$this->db->where('created_on<=',$end_date);
		}
		if($status!=''){
			$this->db->where('fac_status',$status);
		}
		if($order_by!=''){
		$this->db->order_by($order_by['col_name'], $order_by['order']);
		}
		$query=$this->db->get();
	
		return $query->result();
	}
	
	
	public function getslotByFilter($tbl,$clms='*',$order_by='',$start_date='',$end_date='',$status='')
		{
		$this->db->select($clms);
		$this->db->from($tbl);
		if($start_date!=''){
			$this->db->where('start_date<=',$start_date);
		}
			if($end_date!=''){
			$this->db->where('end_date<=',$end_date);
		}
		if($status!=''){
			$this->db->where('fac_batch_slot_status',$status);
		}
		if($order_by!=''){
		$this->db->order_by($order_by['col_name'], $order_by['order']);
		}
		$query=$this->db->get();
	
		return $query->result();
	}
	
	
	
	public function getbookingByFilter($tbl,$clms='*',$order_by='',$start_date='',$end_date='',$status='')
		{
		$this->db->select($clms);
		$this->db->from($tbl);
		if($start_date!=''){
			$this->db->where('created_on>=',$start_date);
		}
			if($end_date!=''){
			$this->db->where('created_on<=',$end_date);
		}
		if($status!=''){
			$this->db->where('facility_approval',$status);
		}
		if($order_by!=''){
		$this->db->order_by($order_by['col_name'], $order_by['order']);
		}
		$query=$this->db->get();
	
		return $query->result();
	}
	
	
	
	
	public function geteventByFilter($tbl,$clms='*',$order_by='',$start_date='',$end_date='',$status='')
		{
		$this->db->select($clms);
		$this->db->from($tbl);
		if($start_date!=''){
			$this->db->where('event_start_date>=',$start_date);
		}
			if($end_date!=''){
			$this->db->where('event_end_date<=',$end_date);
		}
		if($status!=''){
			$this->db->where('event_status',$status);
		}
		if($order_by!=''){
		$this->db->order_by($order_by['col_name'], $order_by['order']);
		}
		$query=$this->db->get();
	
		return $query->result();
	}
	
	

public function exist_sport_name($tbl,$whr,$fac_sport_id)
   {
	$this->db->where('fac_sport_id!=',$fac_sport_id);
	$this->db->where($whr);
	$this->db->select('*');
	$this->db->from($tbl);
	$qry = $this->db->get();
	 $this->db->last_query(); 
	return $res = $qry->num_rows();

}

public function slotsDetailById($slot_batch_id)
{
	$query = $this->db->query('SELECT tbl_facility_batch_slot.*, tbl_slot_package_price.slot_package_price FROM tbl_facility_batch_slot 
		JOIN tbl_slot_package_price on tbl_facility_batch_slot.batch_slot_id = tbl_slot_package_price.batch_slot_id 
		WHERE tbl_facility_batch_slot.batch_slot_id="'.$slot_batch_id.'"');
	//echo $this->db->last_query(); die;
	return $query->result();
}

/* check slot into cart by conditons */
	public function checkSlotIntoCart($select_date, $batch_slot_id, $session_id)
	{
		$this->db->select('cart_id');
		$this->db->from('tbl_cart');
		$this->db->where('book_date',$select_date);
		$this->db->where('batch_slot_id',$batch_slot_id);
		$this->db->where('session_id',$session_id);
		$result = $this->db->get();
		if($result->num_rows()>0){
			return $result->num_rows();
		}else{
			return 0;
		}	
	}

	## get price by batch slot id ------
	public function getPriceByBSId($batch_slot_id,$package_id=''){
		$this->db->select('slot_package_price');
		$this->db->from('tbl_slot_package_price');
		$this->db->where('batch_slot_id', $batch_slot_id);
		if($package_id!=''){
		$this->db->where('package_id', $package_id);
	}
		$query = $this->db->get();
        $result = $query->result();
		if ($query->num_rows()>0) {
			return $result[0]->slot_package_price;
		}else{
			return '';
		}
	}


}
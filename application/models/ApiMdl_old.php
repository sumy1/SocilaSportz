<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class ApiMdl extends CI_Model 
{
	public function __construct()
	{
		parent::__construct(); 
	}
	
	
		 public function getcustomResult($user_id){
		$this->db->select('tf.fac_id, tft.*');
		$this->db->from('tbl_facility  as tf');
		$this->db->join('tbl_facility_timing  as tft', 'tft.fac_id=tf.fac_id');
		$this->db->where('tf.user_id',$user_id);	
		$query=$this->db->get();
		return $query->result();
	}
	
		public function getFacSportList($user_id,$fac_id='')
	{
		 	$this->db->select('tfs.*,tsl.sport_name');
			$this->db->from('tbl_facility_sport tfs');
			$this->db->join('tbl_sport_list tsl', 'tsl.sport_id = tfs.sport_id');
			$this->db->where('tfs.user_id', $user_id);
			if($fac_id!=''){
			$this->db->where('tfs.fac_id', $fac_id);
			}
			//$this->db->group_by('tfc.fac_sport_id');
			$this->db->order_by('tfs.fac_sport_id','DESC');
			$query = $this->db->get(); 
			//echo $this->db->last_query(); exit;                                                       
			return $query->result();
	}


		public function getFac_batch_slot_list($fac_id='',$sport_id='',$limit,$offset)
	{
		 	$this->db->select('tfs.*,tsl.sport_name');
			$this->db->from('tbl_facility_batch_slot tfs');
			$this->db->join(' tbl_sport_list tsl', 'tsl.sport_id = tfs.sport_id');
			$this->db->where('tfs.fac_id', $fac_id);
			
			if($sport_id!=''){
			$this->db->where('tfs.sport_id', $sport_id);
			}
			if($limit!=''){
			$this->db->limit($limit);
			}
			if($offset!=''){
			$this->db->offset($offset);
			}
			
			//$this->db->group_by('tfc.fac_sport_id');
			$this->db->order_by('tfs.sport_id','DESC');
			$query = $this->db->get(); 
			//echo $this->db->last_query(); exit;                                                       
			return $query->result();
	}
	
	public function getResultss($tbl,$whr='',$clms='*',$order_by='',$limit,$offset){
		
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
		if($offset!=''){
		 $this->db->offset($offset);
		}
		
		$query=$this->db->get();
	
		 //echo $this->db->last_query();die;
		return $query->result();
		
		
		
	}
	
	
	public function getResultByCond($tbl,$whr='',$clms='*',$order_by='',$limit,$offset,$start_date,$end_date){
		echo $tbl; die;
		
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
		if($offset!=''){
		 $this->db->offset($offset);
		}
		if($start_date!=''){
			$this->db->where('date(created_on)>=',$start_date);
		}
		if($end_date!=''){
			$this->db->where('date(created_on)<=',$end_date);
		}
		$query=$this->db->get();
	
		 //echo $this->db->last_query();die;
		return $query->result();
		
	}
	
	
	
	
	public function getNotificationList($fac_id,$start_date='',$end_date='',$limit,$offset)
	{
		 	$this->db->select('*');
			$this->db->from('tbl_notification');
			$this->db->where('fac_id', $fac_id);

			
		if($start_date!=''){
			$this->db->where('date(created_on)>=',$start_date);
		}
		if($end_date!=''){
			$this->db->where('date(created_on)<=',$end_date);
		}
		if($limit!=''){
		$this->db->limit($limit);
		}
		if($offset!=''){
		 $this->db->offset($offset);
		}
		
			$this->db->order_by('notification_id','DESC');
			$query = $this->db->get(); 
			//echo $this->db->last_query(); exit;                                                       
			return $query->result();
	}
	
	
	
		public function getEmailNotificationLists($fac_id,$start_date='',$end_date='',$limit,$offset)
	{
		 	$this->db->select('*');
			$this->db->from('tbl_email_notification');
			//$this->db->where('user_id', $user_id);
			$this->db->where('user_id', $fac_id);
			
		if($start_date!=''){
			$this->db->where('date(created_on)>=',$start_date);
		}
		if($end_date!=''){
			$this->db->where('date(created_on)<=',$end_date);
		}
		if($limit!=''){
		$this->db->limit($limit);
		}
		if($offset!=''){
		 $this->db->offset($offset);
		}
		
		
			$this->db->order_by('email_notification_id','DESC');
			$query = $this->db->get(); 
			//echo $this->db->last_query(); exit;                                                       
			return $query->result();
	}
	
	
	
	
	
	
}
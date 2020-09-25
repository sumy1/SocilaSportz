<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class AdminMdl extends CI_Model 
{
	public function __construct()
	{
		parent::__construct(); 
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
			$this->db->where('admin_approval',$status);
		}
		if($order_by!=''){
		$this->db->order_by($order_by['col_name'], $order_by['order']);
		}
		$query=$this->db->get();
	
		return $query->result();
	}
	
	
	
	public function getResultByFilterss($tbl,$clms='*',$order_by='',$start_date='',$end_date='',$user_role='',$status='')
		{
		$this->db->select($clms);
		$this->db->from($tbl);
		if($start_date!=''){
			$this->db->where('created_on>=',$start_date);
		}
		if($end_date!=''){
			$this->db->where('created_on<=',$end_date);
		}
		if($user_role!=''){
			$this->db->where('user_role',$user_role);
		}
		if($status!=''){
			$this->db->where('user_status',$status);
		}
		if($order_by!=''){
		$this->db->order_by($order_by['col_name'], $order_by['order']);
		}
		$query=$this->db->get();
		return $query->result();
	}
	
	
	public function getResultByUserFilter($tbl,$clms='*',$order_by='',$start_date='',$end_date='')
		{
		$this->db->select($clms);
		$this->db->from($tbl);
		if($start_date!=''){
			$this->db->where('created_on>=',$start_date);
		}
			if($end_date!=''){
			$this->db->where('created_on<=',$end_date);
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
			$this->db->where('start_date>=',$start_date);
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
	
	public function getbankByFilter($tbl,$clms='*',$order_by='',$start_date='',$end_date='',$status='')
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
			$this->db->where('admin_approval',$status);
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


	public function getResultByquery($start_date='',$end_date='',$status=''){
		 	$this->db->select('query.*,users.user_name');
			$this->db->from(' tbl_user_query query');
			$this->db->join('tbl_user users', 'users.user_id = query.user_id');
		    if($start_date!=''){
			  $this->db->where('date(query.create_on)>=',$start_date);
			}if($end_date!=''){
			  $this->db->where('date(query.create_on)<=',$end_date);
			}if($status!=''){
			  $this->db->where('query.approve_status',$status);
			}
			$this->db->order_by('query.query_id','desc');
			$query = $this->db->get(); 
			// echo $this->db->last_query();                                                     
			return $query->result();
	}
	public function getResultByenquire($start_date='',$end_date='',$status=''){
			$this->db->select('enquire.*,facility.fac_name');
			$this->db->from(' tbl_user_query_to_facility enquire');
			$this->db->join('tbl_facility facility', 'facility.fac_id = enquire.fac_id');
			if($start_date!=''){
			  $this->db->where('date(enquire.create_on)>=',$start_date);
			}if($end_date!=''){
			  $this->db->where('date(enquire.create_on)<=',$end_date);
			}if($status!=''){
			  $this->db->where('enquire.approve_status',$status);
			}
			$this->db->order_by('enquire.query_id','desc');
			$query = $this->db->get(); 
		// echo $this->db->last_query(); exit;                                                       
			return $query->result();
	}
	public function geteventbookingList($start_date='',$end_date='',$status=''){
		$this->db->select('tbo.*,tbe.event_sport_id,tbe.event_start_date,tbe.event_end_date,tbe.event_name');
		$this->db->from('tbl_booking_order tbo');
		$this->db->join('tbl_booking_event_detail tbe', 'tbe.booking_order_id = tbo.booking_order_id');
		// $this->db->join(' tbl_sport_list tsl', 'tsl.sport_id = tbe.event_sport_id');
		$this->db->where('tbo.booking_for','event'); 
		$this->db->order_by('tbo.booking_order_id','desc');	
		
		$query = $this->db->get();		   
		return $query->result();
	}
	
	public function getgallertList($start_date='',$end_date='',$status='',$select_type=''){
		$this->db->select('tf.fac_id,tf.fac_name,tf.fac_type,tfg.*');
		$this->db->from(' tbl_facility tf');
		$this->db->join('tbl_facility_gallery tfg', 'tfg.fac_id = tf.fac_id');
		
        if($start_date!=''){
			  $this->db->where('date(tfg.created_on)>=',$start_date);
			}if($end_date!=''){
			  $this->db->where('date(tfg.created_on)<=',$end_date);
			}if($status!=''){
			  $this->db->where('tfg.admin_approval',$status);
			}if($select_type!=''){
			  $this->db->where('tf.fac_type',$select_type);
			}		
		$this->db->order_by('tf.fac_id','desc');
		$query = $this->db->get();		   
		return $query->result();
	}
	
		public function getbookingByFilter($start_date='',$end_date='',$status='',$booking_types=''){
		
				$this->db->select('tbo.*,tbsd.*');
				$this->db->from(' tbl_booking_order tbo');
				$this->db->join(' tbl_booking_slot_detail tbsd', 'tbsd.booking_order_id = tbo.booking_order_id');
					$this->db->where('tbo.booking_for!=','event');
				if($start_date!=''){
					  $this->db->where('date(tbsd.created_on)>=',$start_date);
					}if($end_date!=''){
					  $this->db->where('date(tbsd.created_on)<=',$end_date);
					}if($status!=''){
					  $this->db->where('tbo.payment_status',$status);
					}if($booking_types!=''){
					  $this->db->where('tbo.booking_type',$booking_types);
					}
					
			
			
		$this->db->order_by('tbo.booking_order_id','desc');
		$query=$this->db->get();
		// echo $this->db->last_query();
		// die;
		return $query->result();
	}
	

	
	
	
}

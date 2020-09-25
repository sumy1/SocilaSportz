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
			$this->db->where('date(created_on)>=',$start_date);
		}
		if($end_date!=''){
			$this->db->where('date(created_on)<=',$end_date);
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
	

	
	
	
	public function getbankByFilter($tbl,$clms='*',$order_by='',$start_date='',$end_date='',$status=''){
		$this->db->select($clms);
		$this->db->from($tbl);
		if($start_date!=''){
			$this->db->where('date(created_on)>=',$start_date);
		}if($end_date!=''){
			$this->db->where('date(created_on)<=',$end_date);
		}if($status!=''){
			$this->db->where('admin_approval',$status);
		}if($order_by!=''){
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
		 	$this->db->select('query.*');
			$this->db->from(' tbl_user_query query');
			// $this->db->join('tbl_user users', 'users.user_id = query.user_id');
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
	
	
	public function getgallertList($start_date='',$end_date='',$status='',$select_type=''){
		$this->db->select('tf.fac_id,tf.user_id,tf.fac_name,tf.fac_type,tfg.*');
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
	
	
	

		public function getbookingByFilter($start_date='',$end_date='',$status='',$booking_type=''){
				$this->db->select('tbo.*,tbsd.*,tf.fac_name,fac_type,tsl.sport_name');
				$this->db->from(' tbl_booking_order tbo');
				$this->db->join(' tbl_booking_slot_detail tbsd', 'tbsd.booking_order_id = tbo.booking_order_id');
				$this->db->join(' tbl_facility tf', 'tf.fac_id = tbsd.fac_id');
				$this->db->join(' tbl_sport_list tsl', 'tsl.sport_id = tbsd.sport_id');
					$this->db->where('tbo.booking_for!=','event');
					$this->db->where('tf.fac_type=','facility');
					$this->db->where('tbo.trial_booking=','no');
					/* $this->db->group_start();
					$this->db->where('tbsd.package_id=','0');
					$this->db->or_where('tbsd.package_id=','');
					$this->db->group_end(); */
				if($start_date!=''){
					  $this->db->where('date(tbsd.created_on)>=',$start_date);
					}if($end_date!=''){
					  $this->db->where('date(tbsd.created_on)<=',$end_date);
					}if($status!=''){
					  $this->db->where('tbo.payment_status',$status);
					}if($booking_type!=''){
					  $this->db->where('tbo.booking_type',$booking_type);
					}
			
		$this->db->order_by('tbo.booking_order_id','desc');
		$this->db->group_by('tbo.booking_order_id');
		$query=$this->db->get();
		return $query->result();
	}
	public function getbookingacademyByFilter($start_date='',$end_date='',$status='',$booking_type=''){
				$this->db->select('tbo.*,tbsd.*,tf.fac_name,tf.fac_type,tsl.sport_name');
				$this->db->from(' tbl_booking_order tbo');
				$this->db->join(' tbl_booking_slot_detail tbsd', 'tbsd.booking_order_id = tbo.booking_order_id');
				$this->db->join(' tbl_facility tf', 'tf.fac_id = tbsd.fac_id');
				$this->db->join(' tbl_sport_list tsl', 'tsl.sport_id = tbsd.sport_id');
					$this->db->where('tbo.booking_for!=','event');
					$this->db->where('tf.fac_type=','academy');
					$this->db->where('tbo.trial_booking=','no');
					/* $this->db->group_start();
					$this->db->where('tbsd.package_id=','0');
					$this->db->or_where('tbsd.package_id=','');
					$this->db->group_end(); */
				if($start_date!=''){
					  $this->db->where('date(tbsd.created_on)>=',$start_date);
					}if($end_date!=''){
					  $this->db->where('date(tbsd.created_on)<=',$end_date);
					}if($status!=''){
					  $this->db->where('tbo.payment_status',$status);
					}if($booking_type!=''){
					  $this->db->where('tbo.booking_type',$booking_type);
					}
		$this->db->order_by('tbo.booking_order_id','desc');
		$query=$this->db->get();
		return $query->result();
	}
	
	
	
	
	
	public function getbookingBatchTrialFilter($start_date='',$end_date='',$status='',$booking_type=''){
				$this->db->select('tbo.*,tbsd.*,tf.fac_name,tf.fac_type,tsl.sport_name');
				$this->db->from(' tbl_booking_order tbo');
				$this->db->join(' tbl_booking_slot_detail tbsd', 'tbsd.booking_order_id = tbo.booking_order_id');
				$this->db->join(' tbl_facility tf', 'tf.fac_id = tbsd.fac_id');
				$this->db->join(' tbl_sport_list tsl', 'tsl.sport_id = tbsd.sport_id');
					$this->db->where('tbo.booking_for!=','event');
					$this->db->where('tf.fac_type=','academy');
					$this->db->where('tbo.trial_booking=','yes');
					/* $this->db->group_start();
					$this->db->where('tbsd.package_id=','0');
					$this->db->or_where('tbsd.package_id=','');
					$this->db->group_end(); */
				if($start_date!=''){
					  $this->db->where('date(tbsd.created_on)>=',$start_date);
					}if($end_date!=''){
					  $this->db->where('date(tbsd.created_on)<=',$end_date);
					}if($status!=''){
					  $this->db->where('tbo.payment_status',$status);
					}if($booking_type!=''){
					  $this->db->where('tbo.booking_type',$booking_type);
					}
		$this->db->order_by('tbo.booking_order_id','desc');
		$query=$this->db->get();
		return $query->result();
	}
	
	public function geteventbookingList($start_date='',$end_date='',$status='',$booking_type=''){
		$this->db->select('tbo.*,tbe.event_sport_id,tbe.event_start_date,tbe.event_end_date,tbe.event_name,tbe.event_start_time,tbe.event_end_time,tbe.booking_detail_total_amount,tbe.booking_detail_final_amount,tf.fac_name,tf.fac_type,tsl.sport_name');
		$this->db->from('tbl_booking_order tbo');
		$this->db->join('tbl_booking_event_detail tbe', 'tbe.booking_order_id = tbo.booking_order_id');
	    $this->db->join(' tbl_facility tf', 'tf.fac_id = tbe.fac_id');
	    $this->db->join(' tbl_sport_list tsl', 'tsl.sport_id = tbe.event_sport_id');
		$this->db->where('tbo.booking_for','event');
		$this->db->where('tbo.trial_booking=','no');
		if($start_date!=''){
		  $this->db->where('date(tbe.event_start_date)>=',$start_date);
		}if($end_date!=''){
		  $this->db->where('date(tbe.event_end_date)<=',$end_date);
		}if($status!=''){
		  $this->db->where('tbo.payment_status',$status);
		}if($booking_type!=''){
		  $this->db->where('tbo.booking_type',$booking_type);
		}
		$this->db->order_by('tbo.booking_order_id','desc');		
		$query = $this->db->get();		   
		return $query->result();
	}
  public function getResultByUserFilter($start_date='',$end_date=''){
		  $this->db->select('tis.*,tbu.user_name');
		$this->db->from('tbl_interested_sport tis');
		$this->db->join('tbl_user tbu', 'tbu.user_id = tis.user_id');
		// $this->db->join('tbl_sport_list tsl', 'tis.sport_id = tsl.sport_id');
		$this->db->group_by('user_id');
			if($start_date!=''){
			$this->db->where('date(tis.created_on)>=',$start_date);
			}if($end_date!=''){
			$this->db->where('date(tis.created_on)<=',$end_date);
			}
		$this->db->order_by('tis.interested_sport_id','desc');	
		$query = $this->db->get();
		return $query->result();
	}

	public function getInterestedsport($user_id){
		  $this->db->select('tsl.sport_name');
		$this->db->from('tbl_interested_sport tis');
		//$this->db->join('tbl_user tbu', 'tbu.user_id = tis.user_id');
		 $this->db->join('tbl_sport_list tsl', 'tis.sport_id = tsl.sport_id');
		
		$this->db->where('tis.user_id',$user_id);	
		$query = $this->db->get();
		return $query->result();
	}
	
	public function getfavourateByFilter($start_date='',$end_date=''){
		$this->db->select('tf.*,tu.user_name');
		$this->db->from('tbl_favourite tf');
		// $this->db->join('tbl_facility tbf', 'tbf.fac_id = tf.fac_id');
		$this->db->join('tbl_user tu', 'tu.user_id = tf.user_id');
		
		if($start_date!=''){
			$this->db->where('date(tf.created_on)>=',$start_date);
		}
			if($end_date!=''){
			$this->db->where('date(tf.created_on)<=',$end_date);
		}
		
	   
	    $this->db->order_by('tf.favourite_id','desc');
		$this->db->group_by('tf.user_id');
		$query=$this->db->get();
		// echo $this->db->last_query();
		return $query->result();
	}
	
	
	public function getfavourite($user_id){
		  $this->db->select('tfs.fac_name');
		$this->db->from('tbl_favourite tf');
		 $this->db->join('tbl_facility tfs', 'tfs.fac_id = tf.fac_id');
		
		$this->db->where('tf.user_id',$user_id);	
		$query = $this->db->get();
		return $query->result();
	}
    
	
	public function getslotByFilter($start_date='',$end_date='',$status='',$facility_type=''){
		$this->db->select('tfbs.*,tf.fac_name,tf.user_id,tf.fac_type,tu.user_name');
		$this->db->from('tbl_facility_batch_slot tfbs');
		$this->db->join('tbl_facility tf', 'tf.fac_id = tfbs.fac_id');
	    $this->db->join(' tbl_user tu', 'tu.user_id = tf.user_id');
		if($start_date!=''){
			$this->db->where('date(tfbs.start_date)>=',$start_date);
		}if($end_date!=''){
			$this->db->where('date(tfbs.end_date)<=',$end_date);
		}if($status!=''){
			$this->db->where('tfbs.fac_batch_slot_status',$status);
		}if($facility_type!=''){
			$this->db->where('tf.fac_type',$facility_type);
		}
		$this->db->order_by('tfbs.batch_slot_id','desc');
$this->db->group_by('tfbs.batch_slot_id');		
		$query=$this->db->get();
		return $query->result();
	}
	
	
	public function geteventByFilter($start_date='',$end_date='',$status=''){
		$this->db->select('te.*,tsl.sport_name');
		$this->db->from('tbl_event te');
		$this->db->join('tbl_sport_list tsl', 'tsl.sport_id = te.sport_id');
		
		if($start_date!=''){
			$this->db->where('date(te.event_start_date)>=',$start_date);
		}
			if($end_date!=''){
			$this->db->where('date(te.event_end_date)<=',$end_date);
		}
		if($status!=''){
			$this->db->where('te.event_approval',$status);
		}
	   
	    $this->db->order_by('te.event_id','desc');
		$query=$this->db->get();
		// echo $this->db->last_query();
		return $query->result();
	}
	
	
	
	
	public function getResulyfacilityFilter($start_date='',$end_date='',$status=''){
		$this->db->select('tf.*,tu.user_name');
		$this->db->from('tbl_facility as tf');
		$this->db->join('tbl_user as tu','tu.user_id = tf.user_id');
		if($start_date!=''){
			$this->db->where('date(tf.created_on)>=',$start_date);
		}
			if($end_date!=''){
			$this->db->where('date(tf.created_on)<=',$end_date);
		}
		if($status!=''){
			$this->db->where('tf.admin_approval',$status);
		}
		 $this->db->order_by('tf.fac_id','desc');
		$query=$this->db->get();
	
		return $query->result();
	}
	
	
public function exist_coupon_name($tbl,$whr){
	// $this->db->where('coupon_id!=',$coupon_id);
	$this->db->where($whr);
	$this->db->select('*');
	$this->db->from($tbl);
	$qry = $this->db->get();
	 $this->db->last_query(); 
	return $res = $qry->num_rows();

}

public function getnewsletterlist($start_date='',$end_date=''){
		$this->db->select('*');
		$this->db->from('tbl_newsletter');
		if($start_date!=''){
			$this->db->where('date(create_on)>=',$start_date);
		}
			if($end_date!=''){
			$this->db->where('date(create_on)<=',$end_date);
		}
		
		 $this->db->order_by('newsletter_id','desc');
		$query=$this->db->get();
	
		return $query->result();
	}
	
	public function getSunResult(){
		$query= $this->db->query("select sum(final_amount) as total_amount from tbl_booking_order");
		return $query->result();
	}
	
	
	public function getSunResultfacility(){
		$query= $this->db->query("select sum(final_amount) as slot_amount from tbl_booking_order where booking_for='facility'");
		return $query->result();
	}
	
	
	public function getSunResultacademy(){
		
		$query= $this->db->query("select sum(final_amount) as Batch_amount from tbl_booking_order where booking_for='academy'");
	
		return $query->result();
	}
	
	public function getSunResultevent(){
		
		$query= $this->db->query("select sum(final_amount) as event_amount from tbl_booking_order where booking_for='event'");
	
		return $query->result();
	}
	
	
	
	public function UserQueryResult($tbl,$clms='*',$whr,$order_by=''){
		$this->db->from($tbl);
		$this->db->select($clms);
		$this->db->where($whr);
		$this->db->limit('10');
		if($order_by!=''){
		$this->db->order_by($order_by['col_name'], $order_by['order']);
		}
		$query=$this->db->get();
		return $query->result();
	}
	
	
	
	
}

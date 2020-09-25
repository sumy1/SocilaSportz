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
	
	

	
	
	
	public function getResultByCond($tbl,$whr='',$clms='*',$order_by='',$limit,$offset){
		
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
	
	
	
	
	
	
	
	public function getNotificationList($fac_id,$limit,$offset)
	{
		 	$this->db->select('*');
			$this->db->from('tbl_notification');
			$this->db->where('fac_id', $fac_id);

			
		
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
	
	
		public function getNotificationList_date($fac_id,$start_date='',$end_date='',$limit,$offset)
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
	
	
	
	
		public function getEmailNotificationLists($user_id,$limit,$offset)
	{
		 	$this->db->select('*');
			$this->db->from('tbl_email_notification');
			$this->db->where('user_id', $user_id);
			//$this->db->where('fac_id', $fac_id);
			
		
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
	
			public function getBookingList($fac_id,$start_date='',$end_date='',$sport_id='',$type='',$limit,$offset)
	{
		 	$this->db->select('tbo.*,tbs.*,tfb.sport_id,tfb.start_time,tfb.end_time,tsl.sport_name');
			
			$this->db->from('tbl_booking_order tbo');
			$this->db->join('tbl_booking_slot_detail tbs', 'tbs.booking_order_id = tbo.booking_order_id');
			$this->db->join('tbl_facility_batch_slot tfb', 'tbs.batch_slot_id = tfb.batch_slot_id');
			$this->db->join('tbl_sport_list tsl', 'tsl.sport_id = tfb.sport_id');
			$this->db->where('tbs.fac_id', $fac_id);
			if($type!=''){
			$this->db->where('tbo.booking_type', $type);
		}
			if($sport_id!=''){
			$this->db->where('tfb.sport_id', $sport_id);
			}
			if($start_date!=''){
			$this->db->where('tbs.created_on>=',$start_date);
		}
			if($end_date!=''){
			$this->db->where('tbs.created_on<=',$end_date);
		}
		if($limit!=''){
		$this->db->limit($limit);
		}
		if($offset!=''){
		 $this->db->offset($offset);
		}
		
			$this->db->order_by('tbs.booking_detail_id','DESC');
			$query = $this->db->get(); 
			//echo $this->db->last_query(); exit;                                                       
			return $query->result();
	}
	
	
	
	public function getEmailNotificationLists_date($user_id,$start_date='',$end_date='',$limit,$offset)
	{
		 	$this->db->select('*');
			$this->db->from('tbl_email_notification');
			$this->db->where('user_id', $user_id);
			//$this->db->where('fac_id', $fac_id);
			
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
	
	
	
	
	
	public function getResultByCond_date($fac_id,$start_date,$end_date,$sport_id,$limit,$offset)
	{
		 	$this->db->select('*');
			$this->db->from('tbl_booking_slot_detail');
			$this->db->where('fac_id', $fac_id);
			
			
	 if($start_date!=''){
			$this->db->where('date(start_date)>=',$start_date);
		}
		if($end_date!=''){
			$this->db->where('date(start_date)<=',$end_date);
		}
		if($sport_id!=''){
			$this->db->where('sport_id',$sport_id);
		}
		if($limit!=''){
		$this->db->limit($limit);
		}
		if($offset!=''){
		 $this->db->offset($offset);
		} 
	
		
		
			$this->db->order_by('booking_detail_id','desc');
			$query = $this->db->get(); 
			//echo $this->db->last_query(); exit;                                                       
			return $query->result();
	}
	
	
	
	
		public function get_result_date($fac_id,$sport_id,$start_date,$end_date){
		
		$query=$this->db->query("SELECT * FROM `tbl_facility_batch_slot` WHERE `fac_id` =$fac_id AND `sport_id` =$sport_id AND `start_date`<='$end_date' AND `batch_slot_id` in (select `batch_slot_id` FROM `tbl_facility_batch_slot` WHERE `fac_id` = $fac_id AND `sport_id` = $sport_id  AND `end_date`BETWEEN '$start_date' and '$end_date')");
		
		
	  return $query->result();
		// $query = $this->db->get();                                                     
			// return $query->result();
		
	}
	
	
	
	
	public function getResultByCond_by($tbl,$whr='',$clms='*',$order_by='',$start_date,$end_date){
		$this->db->select($clms);
		$this->db->from($tbl);
		if($whr!=''){
		$this->db->where($whr);
		}
		if($order_by!=''){
		$this->db->order_by($order_by['col_name'], $order_by['order']);
		}
		
		 if($start_date!=''){
			$this->db->where('date(booking_on)>=',$start_date);
		}
		if($end_date!=''){
			$this->db->where('date(booking_on)<=',$end_date);
		}
		$query=$this->db->get();
		return $query->result();
	}
	
	public function getResultByCondrating($fac_id,$start_date,$end_date,$limit,$offset)
	{
		 	$this->db->select('*');
			$this->db->from('tbl_rating');
			$this->db->where('fac_id', $fac_id);
			
			
	 if($start_date!=''){
			$this->db->where('date(created_on)>=',$start_date);
		}
		if($end_date!=''){
			$this->db->where('date(created_on)<=',$end_date);
		}
		// if($sport_id!=''){
			// $this->db->where('sport_id',$sport_id);
		// }
		if($limit!=''){
		$this->db->limit($limit);
		}
		if($offset!=''){
		 $this->db->offset($offset);
		} 
	
		
		
			$this->db->order_by('rating_id','ASC');
			$query = $this->db->get(); 
			//echo $this->db->last_query(); exit;                                                       
			return $query->result();
	}
	
	
	public function getResultByevent($fac_id,$sport_id='',$start_date='',$end_date='',$limit,$offset)
	{
		 	$this->db->select('te.*,tsl.sport_name');
			$this->db->from('tbl_event te');
			$this->db->join('tbl_sport_list tsl', 'te.sport_id = tsl.sport_id');
			$this->db->where('te.fac_id', $fac_id);
			if($sport_id!=''){
			$this->db->where('te.sport_id', $sport_id);
			}
			if($start_date!=''){
			$this->db->where('te.event_start_date>=',$start_date);
		    }
		if($end_date!=''){
			$this->db->where('te.event_start_date<=',$end_date);
		}
		if($limit!=''){
		$this->db->limit($limit);
		}
		if($offset!=''){
		 $this->db->offset($offset);
		} 
			$this->db->order_by('te.event_id','ASC');
			$query = $this->db->get(); 
			//echo $this->db->last_query(); exit;                                                       
			return $query->result();
	}
	
	
	public function getResultBy_user_query($fac_id,$start_date,$end_date,$limit,$offset)
	{
		$this->db->select('*');
		$this->db->from('tbl_user_query_to_facility');
		$this->db->where('fac_id', $fac_id);


		if($start_date!=''){
		$this->db->where('date(create_on)>=',$start_date);
		}
		if($end_date!=''){
		$this->db->where('date(create_on)<=',$end_date);
		}
		// if($sport_id!=''){
		// $this->db->where('sport_id',$sport_id);
		// }
		if($limit!=''){
		$this->db->limit($limit);
		}
		if($offset!=''){
		$this->db->offset($offset);
		} 
        $this->db->order_by('query_id','ASC');
		$query = $this->db->get(); 
		//echo $this->db->last_query(); exit;                                                       
		return $query->result();
	}
	
	
		public function getFac_batch_slot_list($fac_id='',$sport_id='',$start_date='',$end_date='',$limit,$offset)
	{
		 	$this->db->select('tfs.*,tsl.sport_name,tsl.sport_icon');
			$this->db->from('tbl_facility_batch_slot tfs');
			$this->db->join('tbl_sport_list tsl', 'tsl.sport_id = tfs.sport_id');
			$this->db->where('tfs.fac_id', $fac_id);
			
			if($sport_id!=''){
			$this->db->where('tfs.sport_id', $sport_id);
			}
			
	  if($start_date!=''){
			$this->db->where('tfs.start_date>=',$start_date);
		    }
		if($end_date!=''){
			$this->db->where('tfs.end_date<=',$end_date);
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
	
	
		public function getResultByeventCond_date($fac_id,$start_date,$end_date,$sport_id,$limit,$offset)
	{
		 	$this->db->select('*');
			$this->db->from('tbl_booking_event_detail');
			$this->db->where('fac_id', $fac_id);
			
			
	 if($start_date!=''){
			$this->db->where('date(event_start_date)>=',$start_date);
		}
		if($end_date!=''){
			$this->db->where('date(event_end_date)<=',$end_date);
		}
		 if($sport_id!=''){
			 $this->db->where('event_sport_id',$sport_id);
	   }
		if($limit!=''){
		$this->db->limit($limit);
		}
		if($offset!=''){
		 $this->db->offset($offset);
		} 
	
		
		
			$this->db->order_by('booking_detail_id','desc');
			$query = $this->db->get(); 
			//echo $this->db->last_query(); exit;                                                       
			return $query->result();
	}
	
	
	
}
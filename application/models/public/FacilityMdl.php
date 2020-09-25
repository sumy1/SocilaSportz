<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class FacilityMdl extends CI_Model 
{
	public function __construct()
	{
		parent::__construct(); 
	}
	
	/*public function getResultByfilter($tbl,$whr,$clms='*',$order_by='',$start_date,$end_date){
		$this->db->select($clms);
		$this->db->from($tbl);
		$this->db->where($whr);
		$this->db->where('start_date>=',$start_date);
		$this->db->where('end_date<=',$end_date);
		if($order_by!=''){
		$this->db->order_by($order_by['col_name'], $order_by['order']);
		}
		$query=$this->db->get();
		return $query->result();
	}*/
	public function getResultBycond($tbl,$whr,$clms='*',$order_by='',$sport_id='',$start_date='',$end_date=''){
		$this->db->select($clms);
		$this->db->from($tbl);
		$this->db->where($whr);
		if($sport_id!=''){
		 $this->db->where('sport_id',$sport_id);
		}
		if($start_date!=''){
		$this->db->where('start_date>=',$start_date);
	}
	if($end_date!=''){
		$this->db->where('end_date<=',$end_date);
	}
		if($order_by!=''){
		$this->db->order_by($order_by['col_name'], $order_by['order']);
		}
		$query=$this->db->get();
		return $query->result();
	}

	/*public function getBookingList($fac_id)
	{
		 	$this->db->select('tbo.*,tbs.*,tfb.sport_id,tfb.start_time,tfb.end_time,tsl.sport_name');
			$this->db->from('tbl_booking_order tbo');
			$this->db->join('tbl_booking_slot_detail tbs', 'tbs.booking_order_id = tbo.booking_order_id');
			$this->db->join('tbl_facility_batch_slot tfb', 'tbs.batch_slot_id = tfb.batch_slot_id');
			$this->db->join('tbl_sport_list tsl', 'tsl.sport_id = tfb.sport_id');
			$this->db->where('tbs.fac_id', $fac_id);
			//$this->db->group_by('tfc.fac_sport_id');
			$this->db->order_by('tbo.booking_order_id','DESC');
			$query = $this->db->get(); 
			//echo $this->db->last_query(); exit;                                                       
			return $query->result();
	}*/


	/*	public function getBookingList($fac_id,$start_date='',$end_date='',$sport_id='',$type='')
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
			$this->db->where('tbs.start_date>=',$start_date);
		}
			if($end_date!=''){
			$this->db->where('tbs.start_date<=',$end_date);
		}
		
			$this->db->order_by('tbs.booking_detail_id','DESC');
			$query = $this->db->get(); 
			                                                     
			return $query->result();
	}
*/

		public function getBookingList($fac_id,$start_date='',$end_date='',$sport_id='',$type='')
	{
		 	$this->db->select('tbo.*,tbs.*,tsl.sport_name');
			$this->db->from('tbl_booking_order tbo');
			$this->db->join('tbl_booking_slot_detail tbs', 'tbs.booking_order_id = tbo.booking_order_id');
			//$this->db->join('tbl_facility_batch_slot tfb', 'tbs.batch_slot_id = tfb.batch_slot_id');
			$this->db->join('tbl_sport_list tsl', 'tsl.sport_id = tbs.sport_id');
			$this->db->where('tbs.fac_id', $fac_id);
			if($type!=''){
			$this->db->where('tbo.booking_type', $type);
		}
			if($sport_id!=''){
			$this->db->where('tbs.sport_id', $sport_id);
			}
			if($start_date!=''){
			$this->db->where('tbs.start_date>=',$start_date);
		}
			if($end_date!=''){
			$this->db->where('tbs.start_date<=',$end_date);
		}
		
			$this->db->order_by('tbs.booking_detail_id','DESC');
			$query = $this->db->get(); 
			//echo $this->db->last_query(); exit;                                                       
			return $query->result();
	}
	
		public function getEventBookingList($fac_id,$start_date='',$end_date='',$sport_id='')
	{
		 	$this->db->select('tbo.*,tbed.*,tsl.sport_name');
			$this->db->from('tbl_booking_order tbo');
			$this->db->join('tbl_booking_event_detail tbed', 'tbed.booking_order_id = tbo.booking_order_id');
			$this->db->join('tbl_sport_list tsl', 'tsl.sport_id = tbed.event_sport_id');
			$this->db->where('tbed.fac_id', $fac_id);
			
			if($sport_id!=''){
			$this->db->where('tbed.event_sport_id', $sport_id);
			}
			if($start_date!=''){
			$this->db->where('tbed.created_on>=',$start_date);
		}
			if($end_date!=''){
			$this->db->where('tbed.created_on<=',$end_date);
		}
		
			$this->db->order_by('tbed.booking_detail_id','DESC');
			$query = $this->db->get(); 
			//echo $this->db->last_query(); exit;                                                       
			return $query->result();
	}





	public function batch_price_package($batch_slot_id)
	{
		 	$this->db->select('tsp.*,tp.package_name');
			$this->db->from('tbl_slot_package_price tsp');
			$this->db->join('tbl_package tp', 'tp.package_id = tsp.package_id');
			$this->db->where('tsp.batch_slot_id', $batch_slot_id);
			//$this->db->group_by('tfc.fac_sport_id');
			//$this->db->order_by('tfs.fac_sport_id','DESC');
			$query = $this->db->get();                                                     
			return $query->result();
	}

	public function get_order_sport_name($batch_slot_id)
	{
		 	$this->db->select('ts.sport_name');
			$this->db->from('tbl_facility_batch_slot tfb');
			$this->db->join('tbl_sport_list ts', 'ts.sport_id = tfb.sport_id');
			$this->db->where('tfb.batch_slot_id', $batch_slot_id);
			//$this->db->group_by('tfc.fac_sport_id');
			//$this->db->order_by('tfs.fac_sport_id','DESC');
			$query = $this->db->get();                                                     
			return $query->result();
	}


	/*public function getEventList($fac_id)
	{
		 	$this->db->select('te.*,tsl.sport_name');
			$this->db->from('tbl_event te');
			$this->db->join('tbl_sport_list tsl', 'te.sport_id = tsl.sport_id');
			$this->db->where('te.fac_id', $fac_id);
			$this->db->order_by('te.event_id','DESC');
			$query = $this->db->get(); 
			                                                      
			return $query->result();
	}*/

	public function getEventList($fac_id,$start_date='',$end_date='',$sport_id='')
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
			$this->db->where('te.event_end_date<=',$end_date);
		}
			$this->db->order_by('te.event_id','DESC');
			$query = $this->db->get(); 
			//echo $this->db->last_query(); exit;                                                       
			return $query->result();
	}

	public function get_review_list($fac_id, $review_of, $total_review_show)
	{
			$last_month = date('Y-m-1');
			$last_week = date('Y-m-d',strtotime('last Monday'));
		 	$this->db->select('trt.*, trw.review_message');
			$this->db->from('tbl_rating trt');
			$this->db->join('tbl_review trw', 'trw.rating_id = trt.rating_id','left');
			$this->db->where('trt.fac_id', $fac_id);
			if($review_of == "month"){
				$this->db->where('DATE(trt.created_on)>=',$last_month);
			}
			if($review_of == "week"){
				$this->db->where('DATE(trt.created_on)>=',$last_week);
			}			
			$this->db->order_by('trt.rating_id','DESC');
			if($total_review_show!=''){
			$this->db->limit($total_review_show);
		}
			$query = $this->db->get();                                                     
			return $query->result();
	}
	public function get_review_count($fac_id, $review_of)
	{
			$last_month = date('Y-m-1');
			$last_week = date('Y-m-d',strtotime('last Monday'));
		 	$this->db->select('trt.*, trw.*');
			$this->db->from('tbl_rating trt');
			$this->db->join('tbl_review trw', 'trw.rating_id = trt.rating_id','left');
			$this->db->where('trt.fac_id', $fac_id);
			if($review_of == "month"){
				$this->db->where('DATE(trt.created_on)>=',$last_month);
			}
			if($review_of == "week"){
				$this->db->where('DATE(trt.created_on)>=',$last_week);
			}			
			
			$query = $this->db->get();                                                     
			return $query->num_rows();
	}



public function getNotificationList($fac_id,$start_date='',$end_date='')
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
			$this->db->order_by('notification_id','DESC');
			$query = $this->db->get(); 
			//echo $this->db->last_query(); exit;                                                       
			return $query->result();
	}


	public function getEmailNotificationList($user_id,$start_date='',$end_date='')
	{
		 	$this->db->select('*');
			$this->db->from('tbl_email_notification');
			$this->db->where('user_id', $user_id);
			
		if($start_date!=''){
			$this->db->where('date(created_on)>=',$start_date);
		}
		if($end_date!=''){
			$this->db->where('date(created_on)<=',$end_date);
		}
			$this->db->order_by('email_notification_id','DESC');
			$query = $this->db->get(); 
			//echo $this->db->last_query(); exit;                                                       
			return $query->result();
	}
	public function getBatchSlotByPackage($fac_id,$sport_id,$package_id,$datetime)
	{
		 	$this->db->select('tfb.*,tp.*');
			$this->db->from('tbl_facility_batch_slot tfb');
			$this->db->join('tbl_slot_package_price tp', 'tp.batch_slot_id = tfb.batch_slot_id');
			$this->db->where(array('tfb.fac_id'=>$fac_id,'tfb.sport_id'=>$sport_id,'tfb.start_date<='=>$datetime,'tfb.end_date>='=>$datetime,'tp.package_id'=>$package_id));

			//$this->db->group_by('tp.batch_slot_id');
			//$this->db->order_by('tfs.fac_sport_id','DESC');
			$query = $this->db->get();                                                     
			return $query->result();
	}



public function fetchslotNumrows($fac_id,$sport_id,$date){
	$query = $this->db->query("SELECT * FROM `tbl_facility_batch_slot` WHERE fac_id=$fac_id and sport_id=$sport_id AND '$date' between start_date and end_date");
	//echo $this->db->last_query(); //die();
	return $query->num_rows();
}
public function fetchslotbookingNumrows($fac_id,$sport_id,$date){
	$query = $this->db->query("SELECT * FROM `tbl_booking_slot_detail` WHERE fac_id=$fac_id and sport_id=$sport_id AND start_date='$date'");
	//echo $this->db->last_query(); die();
	return $query->num_rows();
}

public function fetchslotbookingNumrowsMulti($fac_id,$sport_id,$date, $batch_slot_id, $batch_slot_end_date){
	$query = $this->db->query("SELECT * FROM `tbl_booking_slot_detail` WHERE fac_id=$fac_id and sport_id=$sport_id AND batch_slot_id=$batch_slot_id AND start_date <= '$date' AND start_date <= '$batch_slot_end_date'");
	return $query->num_rows();
}

public function order_user_detail($batch_slot_id,$start_date)
		{
			$this->db->select('to.*,tbs.*');
			$this->db->from('tbl_booking_slot_detail tbs');
			$this->db->join('tbl_booking_order to', 'to.booking_order_id = tbs.booking_order_id');
			$this->db->where(array('tbs.batch_slot_id'=>$batch_slot_id,'tbs.start_date'=>$start_date));

			//$this->db->group_by('tp.batch_slot_id');
			//$this->db->order_by('tfs.fac_sport_id','DESC');
			$query = $this->db->get();                                                     
			return $query->result();
		}
	public function order_user_batch_detail($batch_slot_id,$start_date)
	{
		$this->db->select('to.*,tbs.*');
		$this->db->from('tbl_booking_slot_detail tbs');
		$this->db->join('tbl_booking_order to', 'to.booking_order_id = tbs.booking_order_id');
		$this->db->where(array('tbs.batch_slot_id'=>$batch_slot_id,'tbs.start_date <='=>$start_date));

		//$this->db->group_by('tp.batch_slot_id');
		//$this->db->order_by('tfs.fac_sport_id','DESC');
		$query = $this->db->get();                                                     
		return $query->result();
	}
		public function slot_detail_func($booking_order_id)
		{
			$this->db->select('*');
			$this->db->from('tbl_booking_slot_detail tbs');
			$this->db->where(array('tbs.booking_order_id'=>$booking_order_id));

			//$this->db->group_by('tp.batch_slot_id');
			//$this->db->order_by('tfs.fac_sport_id','DESC');
			$query = $this->db->get();                                                     
			return $query->result();
		}
		public function getResultByFilter($tbl,$clms='*',$whr,$start_date='',$end_date='',$order_by=''){
		$this->db->select($clms);
		$this->db->from($tbl);
		$this->db->where($whr);
		
		if($start_date!=''){
		$this->db->where('create_on>=',$start_date);
	}
	if($end_date!=''){
		$this->db->where('create_on<=',$end_date);
	}
		if($order_by!=''){
		$this->db->order_by($order_by['col_name'], $order_by['order']);
		}
		$query=$this->db->get();
		return $query->result();
	}


		public function getAllfacList($fac_type,$limit='')
	{
		 	$this->db->select('tf.*');
			$this->db->from('tbl_facility tf');
			$this->db->join('tbl_user tu', 'tu.user_id = tf.user_id');
			$this->db->where(array('tu.user_status'=>'enable','tf.fac_type'=>$fac_type,'tf.fac_status'=>'enable','tf.admin_approval'=>'approved','tf.is_home'=>'yes'));
			$this->db->order_by('tf.fac_id','DESC');
			if($limit!=''){
			$this->db->limit($limit);
		}
			$query = $this->db->get();
			//echo $this->db->last_query(); exit;                                                       
			return $query->result();
	}


		public function getAllEventList($limit='')
	{
		$date = date("Y-m-d");
		 	$this->db->select('te.*');
			$this->db->from('tbl_event te');
			$this->db->join('tbl_facility tf', 'tf.fac_id = te.fac_id');
			$this->db->where(array('te.event_status'=>'enable','te.event_approval'=>'approved','te.	event_end_date>='=>$date,'te.is_home'=>'yes'));
			$this->db->order_by('te.event_id','DESC');
			if($limit!=''){
			$this->db->limit($limit);
		}
			$query = $this->db->get();
		//echo $this->db->last_query(); exit;                                                       
			return $query->result();
	}

}
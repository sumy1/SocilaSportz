<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class SearchApiMdl extends CI_Model 
{
	public function __construct()
	{
		parent::__construct(); 
	}
	
	
		public function getfacratinglist($fac_id){		
			$this->db->select('trt.user_name,trt.user_email,trt.rating,trw.review_message');
			$this->db->from('tbl_rating trt');
			$this->db->join('tbl_review trw', 'trw.rating_id = trt.rating_id');
			$this->db->where('trt.fac_id',$fac_id);
			$this->db->where('trt.admin_approval','Approved');
		    $this->db->order_by('trt.fac_id','desc');
			$this->db->limit('5');
		  //echo $this->db->last_query();
			$query = $this->db->get();                                                       
			return $query->result();
		}
		
		public function getSlotPriceByCond($fac_id,$sport_id,$datetime){		
			$this->db->select('tfbs.*,tsp.slot_package_price');
			$this->db->from('tbl_facility_batch_slot tfbs');
			$this->db->join('tbl_slot_package_price tsp', 'tsp.batch_slot_id = tfbs.batch_slot_id');
			$this->db->where(array('tfbs.fac_id'=>$fac_id,'tfbs.sport_id'=>$sport_id,
			'date(tfbs.start_date)<='=>$datetime,'date(tfbs.end_date)>='=>$datetime));
			$this->db->order_by('tfbs.batch_slot_id','desc');
		    $query = $this->db->get();   	   
			return $query->result();
		}
		
		
		
		
		public function countfacratinglist($fac_id){		
			$this->db->select('trt.user_name,trt.user_email,trt.rating,trw.review_message');
			$this->db->from('tbl_rating trt');
			$this->db->join('tbl_review trw', 'trw.rating_id = trt.rating_id');
			$this->db->where('trt.fac_id',$fac_id);
			$this->db->where('trt.admin_approval','Approved');
		    $this->db->order_by('trt.fac_id','desc');
			$query = $this->db->get();  
		  //echo $this->db->last_query();			
			return $query->num_rows();
		}

		public function getSportListByFacId($fac_id){		
			$this->db->select('tsl.sport_name,tsl.sport_icon');
			$this->db->from('tbl_facility_sport tfs');
			$this->db->join('tbl_sport_list tsl', 'tsl.sport_id = tfs.sport_id');
			$this->db->where('tfs.fac_id',$fac_id);
			$this->db->order_by('tfs.fac_id','desc');
		    $query = $this->db->get();                                                       
			//echo $this->db->last_query();
			return $query->result();
		}
	
	
	
	 public function getAminitiesListByFacId($user_id){
		    $this->db->select('ta.amenity_name,ta.amenity_icon');
			$this->db->from('tbl_facility_amenities tfa');
			$this->db->join('tbl_amenity ta', 'ta.amenity_id = tfa.amenity_id');
			$this->db->where('tfa.user_id',$user_id);
			$this->db->order_by('tfa.fac_amenities_id','desc');
		    $query = $this->db->get();                                                       
			//echo $this->db->last_query();
			return $query->result();
	 }
	 
	  public function getAminitiesListId($user_id){
		    $this->db->select('ta.amenity_id,ta.amenity_icon');
			$this->db->from('tbl_facility_amenities tfa');
			$this->db->join('tbl_amenity ta', 'ta.amenity_id = tfa.amenity_id');
			$this->db->where('tfa.user_id',$user_id);
			$this->db->order_by('tfa.fac_amenities_id','desc');
		    $query = $this->db->get();                                                       
			//echo $this->db->last_query();
			return $query->result();
	 }
	 public function getRewardListByFacId($fac_id){
		    $this->db->select('tfr.reward_title,tfr.image1,tfr.image2,tra.reward_name');
			$this->db->from('tbl_facility_reward_achievement tfr');
			$this->db->join('tbl_reward_achievement tra', 'tra.reward_id = tfr.reward_id');
			$this->db->where('tfr.fac_id',$fac_id);
			$this->db->order_by('tfr.reward_achievement_id','desc');
		    $query = $this->db->get();                                                       
			// echo $this->db->last_query(); exit();
			return $query->result();
	 } 
	 public function getResultsportIcon($fac_id){	
			$this->db->select('trw.sport_name,trw.sport_icon,trw.sport_id');
			$this->db->from(' tbl_facility_sport trt');
			$this->db->join('tbl_sport_list trw', 'trw.sport_id = trt.sport_id','left');
			$this->db->where('trt.fac_id',$fac_id);
     		$this->db->order_by('trt.fac_id','ASC');
			// echo $this->db->last_query();
			$query = $this->db->get();                                                       
			return $query->result();
	}
	public function getserchfacdata($condArr, $start, $limit){
		$distanceInMile = 10;  // this value is in mile
        $limit=5;
		$sport_id = $condArr['sport_id'];
		$type = 'facility';
		$distanceInMile = $condArr['distanceInMile'];
		$fac_latitude = $condArr['fac_latitude'];
		$fac_longitude = $condArr['fac_longitude'];
		$amenities_ids='';
		if(isset($condArr['amenities_ids']) && $condArr['amenities_ids']!=''){
			$amenities_ids = $condArr['amenities_ids'];
		}	
	  if($distanceInMile!='' && $fac_latitude!='' && $fac_latitude!=''){
			    
				 $query = $this->db->query('SELECT tbl_facility.* FROM tbl_facility 
					JOIN tbl_user on tbl_facility.user_id = tbl_user.user_id 
					JOIN tbl_facility_sport on tbl_facility.fac_id = tbl_facility_sport.fac_id 
					WHERE tbl_user.user_status="enable" 
					AND tbl_facility.admin_approval="approved" 
					AND tbl_facility.fac_type="'.$type.'"
					AND tbl_facility.is_home="yes"
					AND  tbl_facility.fac_status="enable"
					AND (3959 * acos( cos( radians('.$fac_latitude.' ) ) * cos( radians( tbl_facility.fac_latitude ) ) * cos( radians( tbl_facility.fac_longitude ) - radians(' . $fac_longitude .') ) + sin( radians('. $fac_latitude . ') ) * sin( radians( tbl_facility.fac_latitude ) ) ) )  <  '. $distanceInMile.' GROUP BY tbl_facility.fac_id LIMIT '.$start.', '.$limit);
				
				
		}
		
		return $query->result();
	}
	
	
		public function getserchacademydata($condArr, $start, $limit){
		$distanceInMile = 10;  // this value is in mile
       $limit=5;
		$sport_id = $condArr['sport_id'];
		$type = 'academy';
		$distanceInMile = $condArr['distanceInMile'];
		$fac_latitude = $condArr['fac_latitude'];
		$fac_longitude = $condArr['fac_longitude'];
		$amenities_ids='';
		if(isset($condArr['amenities_ids']) && $condArr['amenities_ids']!=''){
			$amenities_ids = $condArr['amenities_ids'];
		}	
	  if($distanceInMile!='' && $fac_latitude!='' && $fac_latitude!=''){
			    
				 $query = $this->db->query('SELECT tbl_facility.* FROM tbl_facility 
					JOIN tbl_user on tbl_facility.user_id = tbl_user.user_id 
					JOIN tbl_facility_sport on tbl_facility.fac_id = tbl_facility_sport.fac_id 
					WHERE tbl_user.user_status="enable" 
					AND tbl_facility.admin_approval="approved" 
					AND tbl_facility.fac_type="'.$type.'"
					AND tbl_facility.is_home="yes"
					AND  tbl_facility.fac_status="enable"
					AND (3959 * acos( cos( radians('.$fac_latitude.' ) ) * cos( radians( tbl_facility.fac_latitude ) ) * cos( radians( tbl_facility.fac_longitude ) - radians(' . $fac_longitude .') ) + sin( radians('. $fac_latitude . ') ) * sin( radians( tbl_facility.fac_latitude ) ) ) )  <  '. $distanceInMile.' GROUP BY tbl_facility.fac_id LIMIT '.$start.', '.$limit);
				
				
		}
		
		return $query->result();
	}
	
	public function geteventdata($condArr, $start, $limit){
		$distanceInMile = 10;  // this value is in mile
       $limit=5;
		$sport_id = $condArr['sport_id'];
		$type = 'event';
		$distanceInMile = $condArr['distanceInMile'];
		$fac_latitude = $condArr['fac_latitude'];
		$fac_longitude = $condArr['fac_longitude'];
		$amenities_ids='';
		if(isset($condArr['amenities_ids']) && $condArr['amenities_ids']!=''){
			$amenities_ids = $condArr['amenities_ids'];
		}	
	  if($distanceInMile!='' && $fac_latitude!='' && $fac_latitude!=''){

						$query = $this->db->query('SELECT tbl_event.*, tbl_sport_list.sport_name, 			tbl_facility.fac_name FROM tbl_event 
						JOIN tbl_user on tbl_event.user_id = tbl_user.user_id 
						JOIN tbl_sport_list on tbl_event.sport_id = tbl_sport_list.sport_id 
						JOIN tbl_facility on tbl_event.fac_id = tbl_facility.fac_id 
						WHERE tbl_user.user_status="enable" 
						AND tbl_event.event_approval="approved"
						AND tbl_event.is_home="yes"
						AND  tbl_event.event_status="enable" 
						AND (3959 * acos( cos( radians('.$fac_latitude.' ) ) * cos( radians( tbl_event.event_latitude ) ) * cos( radians( tbl_event.event_longitude ) - radians(' . $fac_longitude .') ) + sin( radians('. $fac_latitude . ') ) * sin( radians( tbl_event.event_latitude ) ) ) )  <  '. $distanceInMile.' LIMIT '.$start.', '.$limit);
				
		}
		
		return $query->result();
	}
	
	
}
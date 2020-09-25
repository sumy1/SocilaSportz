<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class SearchMdl extends CI_Model 
{
	public function __construct()
	{
		parent::__construct(); 
	}
	
	public function getserchfacdata($condArr, $start=0, $limit=12){
		$sport_id = $condArr['sport_id'];
		$type = $condArr['type'];
		$distanceInMile = $condArr['distanceInMile'];
		$fac_latitude = $condArr['fac_latitude'];
		$fac_longitude = $condArr['fac_longitude'];
		$amenities_ids='';
		if(isset($condArr['amenities_ids']) && $condArr['amenities_ids']!=''){
			$amenities_ids = $condArr['amenities_ids'];
		}	
		if($distanceInMile!='' && $fac_latitude!='' && $fac_latitude!='' && $amenities_ids!=''){
			$query = $this->db->query('SELECT tbl_facility.* FROM tbl_facility 
					JOIN tbl_user on tbl_facility.user_id = tbl_user.user_id 
					JOIN tbl_facility_sport on tbl_facility.fac_id = tbl_facility_sport.fac_id 
					JOIN tbl_facility_amenities on tbl_facility.user_id = tbl_facility_amenities.user_id 
					WHERE tbl_facility_amenities.amenity_id IN ('.$amenities_ids.') 
					AND tbl_user.user_status="enable" 
					AND tbl_facility.admin_approval="approved" 
					AND tbl_facility.fac_type="'.$type.'"
					AND tbl_facility_sport.sport_id="'.$sport_id.'"
					AND  tbl_facility.fac_status="enable"
					AND (3959 * acos( cos( radians('.$fac_latitude.' ) ) * cos( radians( tbl_facility.fac_latitude ) ) * cos( radians( tbl_facility.fac_longitude ) - radians(' . $fac_longitude .') ) + sin( radians('. $fac_latitude . ') ) * sin( radians( tbl_facility.fac_latitude ) ) ) )  <  '. $distanceInMile.' GROUP BY tbl_facility.fac_id LIMIT '.$start.', '.$limit);
		}
		elseif($amenities_ids!=''){
			$query = $this->db->query('SELECT tbl_facility.* FROM tbl_facility 
					JOIN tbl_user on tbl_facility.user_id = tbl_user.user_id 
					JOIN tbl_facility_sport on tbl_facility.fac_id = tbl_facility_sport.fac_id 
					JOIN tbl_facility_amenities on tbl_facility.user_id = tbl_facility_amenities.user_id 
					WHERE tbl_facility_amenities.amenity_id IN ('.$amenities_ids.')  
					AND tbl_user.user_status="enable" 
					AND tbl_facility.admin_approval="approved" 
					AND tbl_facility.fac_type="'.$type.'"
					AND tbl_facility_sport.sport_id="'.$sport_id.'"
					AND tbl_facility.fac_status="enable" LIMIT '.$start.', '.$limit);
		}
		elseif($distanceInMile!='' && $fac_latitude!='' && $fac_latitude!=''){
			$query = $this->db->query('SELECT tbl_facility.* FROM tbl_facility 
					JOIN tbl_user on tbl_facility.user_id = tbl_user.user_id 
					JOIN tbl_facility_sport on tbl_facility.fac_id = tbl_facility_sport.fac_id 
					WHERE tbl_user.user_status="enable" 
					AND tbl_facility.admin_approval="approved" 
					AND tbl_facility.fac_type="'.$type.'"
					AND tbl_facility_sport.sport_id="'.$sport_id.'"
					AND  tbl_facility.fac_status="enable" 
					AND (3959 * acos( cos( radians('.$fac_latitude.' ) ) * cos( radians( tbl_facility.fac_latitude ) ) * cos( radians( tbl_facility.fac_longitude ) - radians(' . $fac_longitude .') ) + sin( radians('. $fac_latitude . ') ) * sin( radians( tbl_facility.fac_latitude ) ) ) )  <  '. $distanceInMile.' LIMIT '.$start.', '.$limit);
		}
		else{
			$query = $this->db->query('SELECT tbl_facility.* FROM tbl_facility 
					JOIN tbl_user on tbl_facility.user_id = tbl_user.user_id 
					JOIN tbl_facility_sport on tbl_facility.fac_id = tbl_facility_sport.fac_id 
					WHERE tbl_user.user_status="enable" 
					AND tbl_facility.admin_approval="approved" 
					AND tbl_facility.fac_type="'.$type.'"
					AND tbl_facility_sport.sport_id="'.$sport_id.'"
					AND tbl_facility.fac_status="enable" LIMIT '.$start.', '.$limit);
		}
		//echo $this->db->last_query(); die;
		return $query->result();
	}
	
	
	
	## get event search/filter listing here--------------
	public function getsercheventdata($condArr, $start=0, $limit=12){
		$sport_id = $condArr['sport_id'];
		$distanceInMile = $condArr['distanceInMile'];
		$latitude = $condArr['fac_latitude'];
		$longitude = $condArr['fac_longitude'];
		$amenities_ids='';
		$date = date('Y-m-d');
		if(isset($condArr['amenities_ids']) && $condArr['amenities_ids']!=''){
			$amenities_ids = $condArr['amenities_ids'];
		}
		if($distanceInMile!='' && $latitude!='' && $longitude!='' && $amenities_ids!=''){
			$query = $this->db->query('SELECT tbl_event.*, tbl_sport_list.sport_name, tbl_facility.fac_name FROM tbl_event 
					JOIN tbl_user on tbl_event.user_id = tbl_user.user_id 
					JOIN tbl_sport_list on tbl_event.sport_id = tbl_sport_list.sport_id 
					JOIN tbl_facility on tbl_event.fac_id = tbl_facility.fac_id 
					JOIN tbl_event_amenities on tbl_event.event_id = tbl_event_amenities.event_id 
					WHERE tbl_event_amenities.amenity_id IN ('.$amenities_ids.') 
					AND tbl_user.user_status="enable" 
					AND tbl_event.event_approval="approved" 
					AND tbl_event.sport_id="'.$sport_id.'"
					AND tbl_event.event_end_date>="'.$date.'"
					AND  tbl_event.event_status="enable" 
					AND (3959 * acos( cos( radians('.$latitude.' ) ) * cos( radians( tbl_event.event_latitude ) ) * cos( radians( tbl_event.event_longitude ) - radians(' . $longitude .') ) + sin( radians('. $latitude . ') ) * sin( radians( tbl_event.event_latitude ) ) ) )  <  '. $distanceInMile.' group by tbl_event.event_id LIMIT '.$start.', '.$limit);
		}
		elseif($amenities_ids!=''){
			 $query = $this->db->query('SELECT tbl_event.*, tbl_sport_list.sport_name, tbl_facility.fac_name FROM tbl_event 
					JOIN tbl_user on tbl_event.user_id = tbl_user.user_id 
					JOIN tbl_sport_list on tbl_event.sport_id = tbl_sport_list.sport_id 
					JOIN tbl_facility on tbl_event.fac_id = tbl_facility.fac_id 
					JOIN tbl_event_amenities on tbl_event.event_id = tbl_event_amenities.event_id 
					WHERE tbl_event_amenities.amenity_id IN ('.$amenities_ids.') 
					AND tbl_user.user_status="enable" 
					AND tbl_event.event_approval="approved" 
					AND tbl_event.sport_id="'.$sport_id.'"
					AND tbl_event.event_end_date>="'.$date.'"
					AND  tbl_event.event_status="enable" group by tbl_event.event_id LIMIT '.$start.', '.$limit);
		}					
		elseif($distanceInMile!='' && $latitude!='' && $longitude!=''){
			$query = $this->db->query('SELECT tbl_event.*, tbl_sport_list.sport_name, tbl_facility.fac_name FROM tbl_event 
					JOIN tbl_user on tbl_event.user_id = tbl_user.user_id 
					JOIN tbl_sport_list on tbl_event.sport_id = tbl_sport_list.sport_id 
					JOIN tbl_facility on tbl_event.fac_id = tbl_facility.fac_id 
					WHERE tbl_user.user_status="enable" 
					AND tbl_event.event_approval="approved" 
					AND tbl_event.sport_id="'.$sport_id.'"
					AND tbl_event.event_end_date>="'.$date.'"
					AND  tbl_event.event_status="enable" 
					AND (3959 * acos( cos( radians('.$latitude.' ) ) * cos( radians( tbl_event.event_latitude ) ) * cos( radians( tbl_event.event_longitude ) - radians(' . $longitude .') ) + sin( radians('. $latitude . ') ) * sin( radians( tbl_event.event_latitude ) ) ) )  <  '. $distanceInMile.' LIMIT '.$start.', '.$limit);
		}
		else{
			 $query = $this->db->query('SELECT tbl_event.*, tbl_sport_list.sport_name, tbl_facility.fac_name FROM tbl_event 
					JOIN tbl_user on tbl_event.user_id = tbl_user.user_id 
					JOIN tbl_sport_list on tbl_event.sport_id = tbl_sport_list.sport_id 
					JOIN tbl_facility on tbl_event.fac_id = tbl_facility.fac_id 
					WHERE tbl_user.user_status="enable" 
					AND tbl_event.event_approval="approved" 
					AND tbl_event.sport_id="'.$sport_id.'"
					AND tbl_event.event_end_date>="'.$date.'"
					AND  tbl_event.event_status="enable" LIMIT '.$start.', '.$limit);
		}
		//echo $this->db->last_query(); die;
		return $query->result();
	}
	
	## get event search/filter listing count only here--------------
	public function getCountsercheventdata($condArr){
		$sport_id = $condArr['sport_id'];
		$distanceInMile = $condArr['distanceInMile'];
		$latitude = $condArr['fac_latitude'];
		$longitude = $condArr['fac_longitude'];
		$amenities_ids='';
		$date = date('Y-m-d');
		if(isset($condArr['amenities_ids']) && $condArr['amenities_ids']!=''){
			$amenities_ids = $condArr['amenities_ids'];
		}
		if($distanceInMile!='' && $latitude!='' && $longitude!='' && $amenities_ids!=''){
			$query = $this->db->query('SELECT tbl_event.event_id FROM tbl_event 
					JOIN tbl_user on tbl_event.user_id = tbl_user.user_id 
					JOIN tbl_sport_list on tbl_event.sport_id = tbl_sport_list.sport_id 
					JOIN tbl_facility on tbl_event.fac_id = tbl_facility.fac_id 
					JOIN tbl_event_amenities on tbl_event.event_id = tbl_event_amenities.event_id 
					WHERE tbl_event_amenities.amenity_id IN ('.$amenities_ids.') 
					AND tbl_user.user_status="enable" 
					AND tbl_event.event_approval="approved" 
					AND tbl_event.sport_id="'.$sport_id.'"
					AND tbl_event.event_end_date>="'.$date.'"
					AND  tbl_event.event_status="enable" 
					AND (3959 * acos( cos( radians('.$latitude.' ) ) * cos( radians( tbl_event.event_latitude ) ) * cos( radians( tbl_event.event_longitude ) - radians(' . $longitude .') ) + sin( radians('. $latitude . ') ) * sin( radians( tbl_event.event_latitude ) ) ) )  <  '. $distanceInMile.' group by tbl_event.event_id');
		}
		elseif($amenities_ids!=''){
			 $query = $this->db->query('SELECT tbl_event.event_id FROM tbl_event 
					JOIN tbl_user on tbl_event.user_id = tbl_user.user_id 
					JOIN tbl_sport_list on tbl_event.sport_id = tbl_sport_list.sport_id 
					JOIN tbl_facility on tbl_event.fac_id = tbl_facility.fac_id 
					JOIN tbl_event_amenities on tbl_event.event_id = tbl_event_amenities.event_id 
					WHERE tbl_event_amenities.amenity_id IN ('.$amenities_ids.') 
					AND tbl_user.user_status="enable" 
					AND tbl_event.event_approval="approved" 
					AND tbl_event.sport_id="'.$sport_id.'"
					AND tbl_event.event_end_date>="'.$date.'"
					AND  tbl_event.event_status="enable" group by tbl_event.event_id');
		}					
		elseif($distanceInMile!='' && $latitude!='' && $longitude!=''){
			$query = $this->db->query('SELECT tbl_event.event_id FROM tbl_event 
					JOIN tbl_user on tbl_event.user_id = tbl_user.user_id 
					JOIN tbl_sport_list on tbl_event.sport_id = tbl_sport_list.sport_id 
					JOIN tbl_facility on tbl_event.fac_id = tbl_facility.fac_id 
					WHERE tbl_user.user_status="enable" 
					AND tbl_event.event_approval="approved" 
					AND tbl_event.sport_id="'.$sport_id.'"
					AND tbl_event.event_end_date>="'.$date.'"
					AND  tbl_event.event_status="enable" 
					AND (3959 * acos( cos( radians('.$latitude.' ) ) * cos( radians( tbl_event.event_latitude ) ) * cos( radians( tbl_event.event_longitude ) - radians(' . $longitude .') ) + sin( radians('. $latitude . ') ) * sin( radians( tbl_event.event_latitude ) ) ) )  <  '. $distanceInMile);
		}
		else{
			 $query = $this->db->query('SELECT tbl_event.event_id FROM tbl_event 
					JOIN tbl_user on tbl_event.user_id = tbl_user.user_id 
					JOIN tbl_sport_list on tbl_event.sport_id = tbl_sport_list.sport_id 
					JOIN tbl_facility on tbl_event.fac_id = tbl_facility.fac_id 
					WHERE tbl_user.user_status="enable" 
					AND tbl_event.event_approval="approved" 
					AND tbl_event.sport_id="'.$sport_id.'"
					AND tbl_event.event_end_date>="'.$date.'"
					AND  tbl_event.event_status="enable"');
		}
		//echo $this->db->last_query(); die;
		//return $query->result();
		return $query->num_rows();
	}
	
	public function getEventAmenities($event_id){
		$this->db->select('ta.amenity_id, ta.amenity_name, ta.amenity_icon');
		$this->db->from('tbl_event_amenities as tea');
		$this->db->join('tbl_amenity as ta', 'ta.amenity_id = tea.amenity_id');
		$this->db->where('tea.event_id', $event_id);
		//$this->db->group_by('tea.amenity_id');
        $query = $this->db->get();
        return  $result = $query->result();	
	}
	
	
	
	public function get_result($tbl,$cond)
	{
		$this->db->select('*');
		$this->db->from($tbl);
		$this->db->where($cond);
		$result = $this->db->get();
		if($result->num_rows()>0)
		{
			return $result->row_array();
		}
	}

	## get sport name by sport id ------
	public function getSportNameById($sport_id){
		$this->db->select('sport_name');
		$this->db->from('tbl_sport_list');
		$this->db->where('sport_id', $sport_id);
		$query = $this->db->get();
        $result = $query->result();
		if ($query->num_rows()>0) {
			return $result[0]->sport_name;
		}else{
			return '';
		}
	}
 public function getAllfacList($fac_type,$limit='')
	{
		 	$this->db->select('tf.*');
			$this->db->from('tbl_facility tf');
			$this->db->join('tbl_user tu', 'tu.user_id = tf.user_id');
			$this->db->where(array('tu.user_status'=>'enable','tf.fac_type'=>$fac_type,'tf.fac_status'=>'enable','tf.admin_approval'=>'approved'));
			$this->db->order_by('tf.fac_id','DESC');
			if($limit!=''){
			$this->db->limit($limit);
		}
			$query = $this->db->get();
			//echo $this->db->last_query(); exit;                                                       
			return $query->result();
	}

public function getAllEventList($start=0, $limit=12){
		$date = date('Y-m-d');
		$query = $this->db->query('SELECT tbl_event.*, tbl_sport_list.sport_name, tbl_facility.fac_name FROM tbl_event 
					JOIN tbl_user on tbl_event.user_id = tbl_user.user_id 
					JOIN tbl_sport_list on tbl_event.sport_id = tbl_sport_list.sport_id 
					JOIN tbl_facility on tbl_event.fac_id = tbl_facility.fac_id 
					WHERE tbl_user.user_status="enable" 
					AND tbl_event.event_approval="approved"
					AND tbl_event.event_end_date>="'.$date.'"
					AND  tbl_event.event_status="enable" LIMIT '.$start.', '.$limit);
		
		//echo $this->db->last_query(); die;
		return $query->result();
	}





}
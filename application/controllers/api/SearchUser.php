<?php
 ini_set("display_errors",0);
defined("BASEPATH")oR exit("No direct script access allowed");


class SearchUser extends CI_Controller{
	
	  public function __construct(){
		  parent::__construct();
		  $this->load->model('public/SearchMdl');
		  $this->load->model('public/UserMdl');
		  $this->load->model('public/FacilityMdl');
		  $this->load->model('public/CommonMdl');
		  $this->load->model('ApiMdl');
		  $this->load->model('SearchApiMdl');
	  }
	

   function search_listing(){
	   $limit='8';
	   $page=$_REQUEST['page'];
	   $type=$_REQUEST['action'];
	   
	   
      if($type == "facility"  || $type == "academy"  || $type == "event" && isset($_REQUEST['fac_latitude']) && isset($_REQUEST['fac_longitude']) && $_REQUEST['user_id'])
	  {
		 $return_array=array();
		  $distanceInMile = 10;
		  if($_REQUEST['action'] == ''){
				$return_array=array(
				'cmd'=>'Search',
				'status'=>'0',
				'response'=>'Search type required',
				'response_messege'=>'Search type required'
			);
			}else if($_REQUEST['fac_latitude'] == ''){
			   $return_array=array(
					'cmd'=>'Search',
					'status'=>'0',
					'response'=>'Search latitude required',
					'response_messege'=>'Search latitudes required'
			  );
			}else if($_REQUEST['fac_longitude'] == ''){
				$return_array=array(
				'cmd'=>'Search',
				'status'=>'0',
				'response'=>'Search longitude required',
				'response_messege'=>'Search longitude required'
			);
			}else if($_REQUEST['user_id'] == ''){
				$return_array=array(
				'cmd'=>'Search',
				'status'=>'0',
				'response'=>'Search user id  required',
				'response_messege'=>'Search user id required'
			);
			}
			     // $condArr['sport_id']= $_REQUEST['sport_id'];
				$condArr['type']= $_REQUEST['action'];
				$condArr['distanceInMile']= $distanceInMile;
				$condArr['fac_latitude']= $_REQUEST['fac_latitude'];
				$condArr['fac_longitude']= $_REQUEST['fac_longitude'];
				$offset=$_REQUEST['page']*8;
				$data['fac_data'] =$this->SearchMdl->getserchfacdata($condArr, $start=0,$limit,$offset);
				
	foreach($data['fac_data'] as $facKey=>$facVal){
			$sportListing=$this->SearchApiMdl->getSportListByFacId($facVal->fac_id);
			$Aminitieslist=$this->SearchApiMdl->getAminitiesListByFacId($facVal->user_id); 
			$data['rating_data']=$this->SearchApiMdl->getfacratinglist($facVal->fac_id);
			$count1=array('fac_id'=>$facVal->fac_id,'user_id'=>$_REQUEST['user_id']);
			$count_favourate=$this->CommonMdl->fetchNumRows('tbl_favourite',$cond='',$count1);
			if($count_favourate != '0'){ $counts = 1; }else{ $counts = 0; }
			$FacTimingList=$this->CommonMdl->getResultByCond('tbl_facility_timing',array('fac_id'=>$facVal->fac_id),'day,open_time,close_time',$order_by='');
				$reward_achivement_date=$this->SearchApiMdl->getRewardListByFacId($facVal->fac_id);
     
   
				$data['fac_data'][$facKey]->folder_name="fac";
				$data['fac_data'][$facKey]->sport_list=$sportListing;
				$data['fac_data'][$facKey]->amenities_list=$Aminitieslist;
				$data['fac_data'][$facKey]->rating_list=$data['rating_data'];
				$data['fac_data'][$facKey]->timing_list=$FacTimingList;
				$data['fac_data'][$facKey]->achievement_list=$reward_achivement_date;
				$data['fac_data'][$facKey]->is_favourate=$counts;
				$rating_count=$this->SearchApiMdl->countfacratinglist($facVal->fac_id);
				$total_1_review=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>$facVal->fac_id,'rating'=>'1'),'');
				$total_2_review=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>$facVal->fac_id,'rating'=>'2'),'');
				$total_3_review=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>$facVal->fac_id,'rating'=>'3'),'');
				$total_4_review=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>$facVal->fac_id,'rating'=>'4'),'');
				$total_5_review=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>$facVal->fac_id,'rating'=>'5'),'');
				$total_rating =($total_5_review*5) + ($total_4_review*4) + ($total_3_review*3) + ($total_2_review*2) + ($total_1_review*1);
				$avg_rating=0;
				if($rating_count>0) {$avg_rating= round($total_rating/$rating_count,1);}
					
					
				$data['fac_data'][$facKey]->rating_count=$rating_count;
				$data['fac_data'][$facKey]->rating_avg=$avg_rating;
				$data['fac_data'][$facKey]->thing_to_note="<ul class=notedlist><li>The booked slot timings must be followed strictly.</li><li>Proper Non-marking shoes only.</li><li>No eatables are allowed inside the courts.</li><li>The management will not be responsible for belongings of players.</li> </ul>";
			 foreach($data['fac_data'][$facKey]->amenities_list as $key=>$Val){
				 $data['fac_data'][$facKey]->amenities_list[$key]->folder_name="amenity";
			 }
			 
			 foreach($data['fac_data'][$facKey]->sport_list as $key=>$val){
				 $data['fac_data'][$facKey]->sport_list[$key]->folder_name="sports";
			 }
			 foreach($data['fac_data'][$facKey]->achievement_list as $AchievmentKey=>$AchievmentVal){
				 $data['fac_data'][$facKey]->achievement_list[$AchievmentKey]->folder_name="rewards";
			 }
					
		 
		}
					
			if($data['fac_data']){
				$return_array=array(
				'cmd'=>'Search Listing',
				'status'=>'1',
				'response'=>$data['fac_data'],
				'response_messege'=>'Search Listing'
			  );
			}else{
				$return_array=array(
				'cmd'=>'Search Listing',
				'status'=>'0',
				'response'=>$return_array,
				'response_messege'=>'Search Listing'
			  );
			}
			
	  }
	  else if($type == "event"){
		  print_r($_POST);
	  }
	  $output=json_encode($return_array);
	    echo trim($output,'"');
	  
   }
   
   
   public function dashboard_Detail(){
	      $limit='8';
		  
	   $page=$_REQUEST['page'];
	   $type=$_REQUEST['action'];
	   
	   
      if(isset($_REQUEST['action']) && isset($_REQUEST['fac_latitude']) && isset($_REQUEST['fac_longitude']) && $_REQUEST['user_id']){
		 $return_array=array();
		  $distanceInMile = 10;
		  if($_REQUEST['action'] == ''){
				$return_array=array(
				'cmd'=>'Detail',
				'status'=>'0',
				'response'=>'Detail type required',
				'response_messege'=>'Detail type required'
			);
			}else if($_REQUEST['fac_latitude'] == ''){
			   $return_array=array(
					'cmd'=>'Detail',
					'status'=>'0',
					'response'=>'Detail latitude required',
					'response_messege'=>'Detail latitudes required'
			  );
			}else if($_REQUEST['fac_longitude'] == ''){
				$return_array=array(
				'cmd'=>'Detail',
				'status'=>'0',
				'response'=>'Detail longitude required',
				'response_messege'=>'Detail longitude required'
			);
			}else if($_REQUEST['user_id'] == ''){
				$return_array=array(
				'cmd'=>'Detail',
				'status'=>'0',
				'response'=>'Detail user id  required',
				'response_messege'=>'Detail user id required'
			);
			}
			if($_REQUEST['action']!='event'){
			$condArr['type']= $_REQUEST['action'];
			$condArr['distanceInMile']= $distanceInMile;
			$condArr['fac_latitude']= $_REQUEST['fac_latitude'];
			$condArr['fac_longitude']= $_REQUEST['fac_longitude'];
			$offset=$_REQUEST['page']*8;
			$limit-5;
			$data['fac_data']=$this->SearchApiMdl->getserchfacdata($condArr, $start=0,$limit);
		    foreach($data['fac_data'] as $facKey=>$facVal){
			$sportListing=$this->SearchApiMdl->getSportListByFacId($facVal->fac_id);
			$Aminitieslist=$this->SearchApiMdl->getAminitiesListByFacId($facVal->user_id); 
			$data['rating_data']=$this->SearchApiMdl->getfacratinglist($facVal->fac_id);
			$count1=array('fac_id'=>$facVal->fac_id,'user_id'=>$_REQUEST['user_id']);
			$count_favourate=$this->CommonMdl->fetchNumRows('tbl_favourite',$cond='',$count1);
			if($count_favourate != '0'){ $counts = 1; }else{ $counts = 0; }
			$FacTimingList=$this->CommonMdl->getResultByCond('tbl_facility_timing',array('fac_id'=>$facVal->fac_id),'day,open_time,close_time',$order_by='');
				$reward_achivement_date=$this->SearchApiMdl->getRewardListByFacId($facVal->fac_id);
     
   
				$data['fac_data'][$facKey]->folder_name="fac";
				$data['fac_data'][$facKey]->sport_list=$sportListing;
				$data['fac_data'][$facKey]->amenities_list=$Aminitieslist;
				$data['fac_data'][$facKey]->rating_list=$data['rating_data'];
				$data['fac_data'][$facKey]->timing_list=$FacTimingList;
				$data['fac_data'][$facKey]->achievement_list=$reward_achivement_date;
				$data['fac_data'][$facKey]->is_favourate=$counts;
				$rating_count=$this->SearchApiMdl->countfacratinglist($facVal->fac_id);
				$total_1_review=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>$facVal->fac_id,'rating'=>'1'),'');
				$total_2_review=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>$facVal->fac_id,'rating'=>'2'),'');
				$total_3_review=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>$facVal->fac_id,'rating'=>'3'),'');
				$total_4_review=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>$facVal->fac_id,'rating'=>'4'),'');
				$total_5_review=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>$facVal->fac_id,'rating'=>'5'),'');
				$total_rating =($total_5_review*5) + ($total_4_review*4) + ($total_3_review*3) + ($total_2_review*2) + ($total_1_review*1);
				$avg_rating=0;
				if($rating_count>0) {$avg_rating= round($total_rating/$rating_count,1);}
					
					
				$data['fac_data'][$facKey]->rating_count=$rating_count;
				$data['fac_data'][$facKey]->rating_avg=$avg_rating;
				$data['fac_data'][$facKey]->thing_to_note="<ul class=notedlist><li>The booked slot timings must be followed strictly.</li><li>Proper Non-marking shoes only.</li><li>No eatables are allowed inside the courts.</li><li>The management will not be responsible for belongings of players.</li> </ul>";
			 foreach($data['fac_data'][$facKey]->amenities_list as $key=>$Val){
				 $data['fac_data'][$facKey]->amenities_list[$key]->folder_name="amenity";
			 }
			 
			 foreach($data['fac_data'][$facKey]->sport_list as $key=>$val){
				 $data['fac_data'][$facKey]->sport_list[$key]->folder_name="sports";
			 }
			 foreach($data['fac_data'][$facKey]->achievement_list as $AchievmentKey=>$AchievmentVal){
				 $data['fac_data'][$facKey]->achievement_list[$AchievmentKey]->folder_name="rewards";
			 }
			}
			
			if($data['fac_data']){
				$return_array=array(
				'cmd'=>'Detail Listing',
				'status'=>'1',
				'response'=>$data['fac_data'],
				'response_messege'=>'Detail Listing'
			  );
			}else{
				$return_array=array(
				'cmd'=>'Detail Listing',
				'status'=>'0',
				'response'=>$return_array,
				'response_messege'=>'Detail Listing'
			  );
			}
		
		}else{
				$condArr['type']= $_REQUEST['action'];
				$condArr['distanceInMile']= $distanceInMile;
				$condArr['fac_latitude']= $_REQUEST['fac_latitude'];
				$condArr['fac_longitude']= $_REQUEST['fac_longitude'];
				$offset=$_REQUEST['page']*8;
				$data['fac_data'] = $this->SearchApiMdl->getserchfacdata($condArr, $start=0, $limit = 5);
				foreach($data['fac_data'] as $facKey=>$facVal){
				$sportListing=$this->SearchApiMdl->getSportListByFacId($facVal->fac_id);
				$Aminitieslist=$this->SearchApiMdl->getAminitiesListByFacId($facVal->user_id); 
				$data['rating_data']=$this->SearchApiMdl->getfacratinglist($facVal->fac_id);
				$count1=array('fac_id'=>$facVal->fac_id,'user_id'=>$_REQUEST['user_id']);
				$count_favourate=$this->CommonMdl->fetchNumRows('tbl_favourite',$cond='',$count1);
				if($count_favourate != '0'){ $counts = 1; }else{ $counts = 0; }
				$FacTimingList=$this->CommonMdl->getResultByCond('tbl_facility_timing',array('fac_id'=>$facVal->fac_id),'day,open_time,close_time',$order_by='');
					$reward_achivement_date=$this->SearchApiMdl->getRewardListByFacId($facVal->fac_id);
		 
	   
					$data['fac_data'][$facKey]->folder_name="fac";
					$data['fac_data'][$facKey]->sport_list=$sportListing;
					$data['fac_data'][$facKey]->amenities_list=$Aminitieslist;
					$data['fac_data'][$facKey]->rating_list=$data['rating_data'];
					$data['fac_data'][$facKey]->timing_list=$FacTimingList;
					$data['fac_data'][$facKey]->achievement_list=$reward_achivement_date;
					$data['fac_data'][$facKey]->is_favourate=$counts;
					$rating_count=$this->SearchApiMdl->countfacratinglist($facVal->fac_id);
					$total_1_review=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>$facVal->fac_id,'rating'=>'1'),'');
					$total_2_review=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>$facVal->fac_id,'rating'=>'2'),'');
					$total_3_review=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>$facVal->fac_id,'rating'=>'3'),'');
					$total_4_review=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>$facVal->fac_id,'rating'=>'4'),'');
					$total_5_review=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>$facVal->fac_id,'rating'=>'5'),'');
					$total_rating =($total_5_review*5) + ($total_4_review*4) + ($total_3_review*3) + ($total_2_review*2) + ($total_1_review*1);
					$avg_rating=0;
					if($rating_count>0) {$avg_rating= round($total_rating/$rating_count,1);}
						
						
					$data['fac_data'][$facKey]->rating_count=$rating_count;
					$data['fac_data'][$facKey]->rating_avg=$avg_rating;
					$data['fac_data'][$facKey]->thing_to_note="<ul class=notedlist><li>The booked slot timings must be followed strictly.</li><li>Proper Non-marking shoes only.</li><li>No eatables are allowed inside the courts.</li><li>The management will not be responsible for belongings of players.</li> </ul>";
				 foreach($data['fac_data'][$facKey]->amenities_list as $key=>$Val){
					 $data['fac_data'][$facKey]->amenities_list[$key]->folder_name="amenity";
				 }
				 
				 foreach($data['fac_data'][$facKey]->sport_list as $key=>$val){
					 $data['fac_data'][$facKey]->sport_list[$key]->folder_name="sports";
				 }
				 foreach($data['fac_data'][$facKey]->achievement_list as $AchievmentKey=>$AchievmentVal){
					 $data['fac_data'][$facKey]->achievement_list[$AchievmentKey]->folder_name="rewards";
				 }
				}
				
				if($data['fac_data']){
					$return_array=array(
					'cmd'=>'Detail Listing',
					'status'=>'1',
					'response'=>$data['fac_data'],
					'response_messege'=>'Detail Listing'
				  );
				}else{
					$return_array=array(
					'cmd'=>'Detail Listing',
					'status'=>'0',
					'response'=>$return_array,
					'response_messege'=>'Detail Listing'
				  );
				}
		}
	  }
	 $output=json_encode($return_array);
	    echo trim($output,'"');	
   }
   
   
   public function search_details(){
	   $return_array=array();

	   if(isset($_REQUEST['fac_slug'])){
		   if($_REQUEST['fac_slug'] == ''){
				$return_array=array(
				'cmd'=>'Search',
				'status'=>'0',
				'response'=>'Facility slug  required',
				'response_messege'=>'Facility slug required'
			);
		   }
		    $facility_detail =  $this->CommonMdl->getRow('tbl_facility','*',array('fac_slug'=>$_REQUEST['fac_slug']));
			if(!empty($facility_detail)>0){
					$order_by = array('col_name'=>'fac_timing_id','order'=>'asc');
					$facility_detail->facility_timing= $this->CommonMdl->getResultByCond('tbl_facility_timing',array('fac_id'=>$facility_detail->fac_id),'fac_id,day,open_time,close_time',$order_by);
					$facility_detail->facility_sport = $this->UserMdl->getFacSportList($facility_detail->fac_id);
					$facility_detail->facility_gallery =  $this->CommonMdl->getResultByCond('tbl_facility_gallery',array('fac_id'=>$facility_detail->fac_id),'gallery_image',$order_by='');
					$facility_detail->rating_list = $this->FacilityMdl->get_review_list($facility_detail->fac_id,'','');
					
					$facility_detail->fac_achievement= $this->CommonMdl->getResultByCond('tbl_facility_reward_achievement',array('fac_id'=>$facility_detail->fac_id),'*',$order_by='');

					foreach($facility_detail->fac_achievement as $achievementkey=>$achievementval){
					$facility_detail->fac_achievement[$achievementkey]->reward_listing = $this->CommonMdl->getResultByCond('tbl_reward_achievement',array('reward_id'=>$achievementval->reward_id),'reward_name',$order_by='');
					}

					$facility_user_amenity = $this->CommonMdl->getResultByCond('tbl_facility_amenities',array('user_id'=>$_REQUEST['user_id']),'amenity_id',$order_by='');

					foreach ($facility_user_amenity as $amenitykey => $amenityval) {
					$facility_user_amenity[$amenitykey]->amenity_listing = $this->CommonMdl->getResultByCond('tbl_amenity',array('amenity_id'=>$amenityval->amenity_id),'amenity_name,amenity_icon',$order_by='');
					}
					$facility_detail->rating_count =  $this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>$facility_detail->fac_id),'');

					// print_data($facility_detail->rating_count);
					$total_1_review=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>$facility_detail->fac_id,'rating'=>'1'),'');
					$total_2_review=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>$facility_detail->fac_id,'rating'=>'2'),'');
					$total_3_review=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>$facility_detail->fac_id,'rating'=>'3'),'');
					$total_4_review=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>$facility_detail->fac_id,'rating'=>'4'),'');
					$total_5_review=$this->CommonMdl->fetchNumRows('tbl_rating',array('fac_id'=>$facility_detail->fac_id,'rating'=>'5'),'');
					$total_rating =($total_5_review*5) + ($total_4_review*4) + ($total_3_review*3) + ($total_2_review*2) + ($total_1_review*1);
					
					$avg_rating=0;
					
					if($facility_detail->rating_count>0) {
					$avg_rating= round($total_rating/$rating_count,1);
					}

					$facility_detail->avg_rating= $avg_rating;
					
					if($facility_detail){
						 $return_array= array(
							   'cmd'=>'Facility details',
							   'status'=>'1',
							   'response'=>$facility_detail,
							   'response_messege'=>'Facility Details'
							
						);
						
					}else{
						$return_array= array(
							   'cmd'=>'Facility details',
							   'status'=>'0',
							   'response'=>$return_array,
							   'response_messege'=>'Facility Details'
							
						);
					}
			}
			
   }
   else{
	    $return_array= array(
		   'cmd'=>'Facility details',
		   'status'=>'0',
		   'response'=>$return_array,
		   'response_messege'=>'Facility Details'
		);
   }
   $output=json_encode($return_array);
   echo trim($output,'"');
   }
   
   
 public function slots_available_list(){
	 $return_array=array();
	 if(isset($_REQUEST['date']) && isset($_REQUEST['fac_id']) && isset($_REQUEST['sport_id'])){
	 if($_REQUEST['date'] == ''){
				$return_array=array(
				'cmd'=>'Slot details',
				'status'=>'0',
				'response'=>'Slected date required',
				'response_messege'=>'Slected date required'
			);
			}else if($_REQUEST['fac_id'] == ''){
			   $return_array=array(
					'cmd'=>'Slot details',
					'status'=>'0',
					'response'=>'Fac id required',
					'response_messege'=>'Fac id required'
			  );
			}else if($_REQUEST['sport_id'] == ''){
				$return_array=array(
				'cmd'=>'Slot details',
				'status'=>'0',
				'response'=>'Sport id required',
				'response_messege'=>'Sport id required'
			);
			}
			$datetime = date('Y-m-d', strtotime($_REQUEST['date'])); 
			$datess=array('date'=>$datetime);
			$data=$datess;
			$day = date('D', strtotime($datetime));
            $data['fac_slots_batch']= $this->CommonMdl->getResultByCond('tbl_facility_batch_slot',array('fac_id'=>$_REQUEST['fac_id'],'sport_id'=>$_REQUEST['sport_id'],'start_date<='=>$datetime,'end_date>='=>$datetime),'*',$order_by='');
			
			foreach ($data['fac_slots_batch'] as $facslotKey=>$facslolVal) {
				  $data['slot_day'] = $this->CommonMdl->getResultByCond('tbl_batch_slot_weekoff',array('batch_slot_id'=>$facslolVal->batch_slot_id,'batch_slot_weekoff_day'=>$day),'*',$order_by='');
				 $data['fac_slots_batch'][$facslotKey]->slot_day=$data['slot_day'];
				
			}
			if($data['fac_slots_batch']){
						 $return_array= array(
							   'cmd'=>'Facility details',
							   'status'=>'1',
							   'response'=> $data['fac_slots_batch'],
							   'response_messege'=>'Facility Details'
							
						);
						
					}else{
						$return_array= array(
							   'cmd'=>'Facility details',
							   'status'=>'0',
							   'response'=>$return_array,
							   'response_messege'=>'Facility Details'
							
						);
					}		
	 }else{
		 $return_array= array(
		   'cmd'=>'Slot details',
		   'status'=>'0',
		   'response'=>$return_array,
		   'response_messege'=>'Slot Details'
		);
	 }
   $output=json_encode($return_array);
   echo trim($output,'"');
 }  
   
   
	
} 
 


?>
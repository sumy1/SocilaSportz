  <?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Controller {

    public  function __construct()

    {

   	    parent::__construct();
		$this->load->model('admin/AdminMdl');
   	    if(!$this->session->userdata('admin_id')){
            redirect('admin');
			

        }

	}


	public function index($id='')
	{

	}

	private function set_upload_options($path){ 
        // upload file options
		$config = array();
        $config['upload_path'] = "./$path/"; //give the path to upload the image in folder
        $config['allowed_types'] = '*';
        $config['max_size'] = '0';
        $config['overwrite'] = FALSE;
        return $config;
    }

    private function set_upload_options1($path){ 
        // upload file options
		$config = array();
        $config['upload_path'] = "./$path/"; //give the path to upload the image in folder
        $config['allowed_types'] = '*';
        $config['max_size'] = '0';
        $config['overwrite'] = FALSE;
        return $config;
    }

	public function sports($id=''){
		$whr = array('sport_id'=>$id);
		$data['edit_sport'] = $this->CommonMdl->getResultByCond('tbl_sport_list',$whr,'*');
		//print_data($data['edit_banner']);
		 $order_by = array('col_name'=>'sport_id','order'=>'desc');
		$data['alldata'] = $this->CommonMdl->getResultOrderBy('tbl_sport_list','*',$order_by);
		//print_data($data['alldata']);
	   $this->load->view('admin/master/sport/SportView',$data);

	}
public function exportsport(){
        $order_by = array('col_name'=>'sport_id','order'=>'desc');
		$data['MasterSportdata'] = $this->CommonMdl->getResultOrderBy('tbl_sport_list','*',$order_by);
	$this->load->view('admin/master/Excel/MasterDataExportView',$data);
}




	public function add_sport(){
		//print_data($_FILES);
		// $page_new_banner_img = $_FILES['banner_img']['name'] ;
			$path = "assets/public/images/sports";
		$this->upload->initialize($this->set_upload_options($path));
			if ($this->upload->do_upload('icon_image'))
			{
				$icon_image = $this->upload->data();
			}
			$this->upload->initialize($this->set_upload_options1($path));
			if ($this->upload->do_upload('sport_image'))
			{
				$sport_image = $this->upload->data();
			}
			  if($this->input->post('status')!='enable'){
		      $user_status = 'disable';
		    }
		    else{
		      $user_status= $this->input->post('status');
		    }

				$dataArr=array(				
					'sport_name'=>$this->input->post('sport_title'),
					'sport_icon'=>$icon_image['file_name'],                         				
					'sport_image'=>$sport_image['file_name'],                         			
					'sport_status'=>$user_status,
					'created_on'=>date("Y-m-d H:i:s"),
					'created_by'=>$this->session->userdata('admin_id'),
					'updated_by'=>$this->session->userdata('admin_id'),
					'updated_on'=>date("Y-m-d H:i:s")
				); 
				//print_data($dataArr);                                     

				$Savebanner=$this->CommonMdl->insertRow($dataArr,'tbl_sport_list');

				if($Savebanner){
					$this->session->set_flashdata('msg','Sport added successfully'); 
					$this->session->set_flashdata('msg_class','bg-success'); 
					redirect(base_url().'admin/master/sports');
				}
            }

      public function delete_sports($id){
    	$whr = array('sport_id'=>$id);
        if($this->CommonMdl->deleteRecord('tbl_sport_list',$whr)==true){
			  $this->session->set_flashdata('msg','Sport delete successfully'); 
			  $this->session->set_flashdata('msg_class','bg-success');  
			  redirect(base_url() . 'admin/master/sports');  
        }
     }

     public function edit_sport(){
    	if($this->input->post('status')!='enable'){
		      $sport_status = 'disable';
		    }
		    else{
		      $sport_status= $this->input->post('status');
		    }

			$new_icon_img = $_FILES['icon_image']['name'] ;
			$new_sport_img = $_FILES['sport_image']['name'] ;
			$path = "assets/public/images/sports";
			$this->upload->initialize($this->set_upload_options($path));
			if ($this->upload->do_upload('icon_image'))
			{
				$edit_new_icon_img1 = $this->upload->data();
				$new_icon_img = $edit_new_icon_img1['file_name'];
			}
			if($new_icon_img==''){
				$new_icon_img=$this->input->post('old_icon_image');
			}

			if ($this->upload->do_upload('sport_image'))
			{
				$edit_new_sport_img1 = $this->upload->data();
				$new_sport_img = $edit_new_sport_img1['file_name'];
			}
			if($new_sport_img==''){
				$new_sport_img=$this->input->post('old_sport_image');
			}



		    	$dataArr=array(				
				'sport_name'=>$this->input->post('sport_title'),
				'sport_icon'=>$new_icon_img,                         				
				'sport_image'=>$new_sport_img,                         			
				'sport_status'=>$sport_status,
				'updated_by'=>$this->session->userdata('admin_id'),
				'updated_on'=>date("Y-m-d H:i:s")
				); 
				//print_data($dataArr);                                    
    			$whr = array('sport_id'=>$this->input->post('sport_id'));
				$Savebanner=$this->CommonMdl->updateData($dataArr,$whr,'tbl_sport_list');

				if($Savebanner){

				$this->session->set_flashdata('msg','Sport updated successfully'); 

				$this->session->set_flashdata('msg_class','bg-success'); 

				redirect(base_url().'admin/master/sports');
				}
    }

    public function reward_achievement($id='')

	{
		$whr = array('reward_id'=>$id);
		$data['edit_reward'] = $this->CommonMdl->getResultByCond('tbl_reward_achievement',$whr,'*');
		//print_data($data['edit_banner']);
		 $order_by = array('col_name'=>'reward_id','order'=>'desc');
		$data['alldata'] = $this->CommonMdl->getResultOrderBy('tbl_reward_achievement','*',$order_by);
		//print_data($data['alldata']);
	   $this->load->view('admin/master/reward-achievement/RewardView',$data);

	}

	public function add_reward_achievement(){
		
			  if($this->input->post('status')!='enable'){
		      $status = 'disable';
		    }
		    else{
		      $status= $this->input->post('status');
		    }

				$dataArr=array(				
				'reward_name'=>$this->input->post('reward_title'),	
				'reward_status'=>$status,
				'created_on'=>date("Y-m-d H:i:s"),
				'updated_on'=>date("Y-m-d H:i:s"),
				'created_by'=>$this->session->userdata('admin_id'),
				'updated_by'=>$this->session->userdata('admin_id')
				
				); 
				//print_data($dataArr);                                     

				$res=$this->CommonMdl->insertRow($dataArr,'tbl_reward_achievement');

				if($res){

				$this->session->set_flashdata('msg','Reward added successfully'); 

				$this->session->set_flashdata('msg_class','bg-success'); 

				redirect(base_url().'admin/master/reward_achievement');
				}

            }


          public function edit_reward_achievement(){
    		
    		if($this->input->post('status')!='enable'){
		      $status = 'disable';
		    }
		    else{
		      $status= $this->input->post('status');
		    }
		    	$dataArr=array(				
				'reward_name'=>$this->input->post('reward_title'),	
				'reward_status'=>$status,
				'updated_on'=>date("Y-m-d H:i:s"),
				'updated_by'=>$this->session->userdata('admin_id')
				); 
				//print_data($dataArr);                                    
    			$whr = array('reward_id'=>$this->input->post('reward_id'));
				$Savebanner=$this->CommonMdl->updateData($dataArr,$whr,'tbl_reward_achievement');

				if($Savebanner){

				$this->session->set_flashdata('msg','Reward updated successfully'); 

				$this->session->set_flashdata('msg_class','bg-success'); 

				redirect(base_url().'admin/master/reward_achievement');
				}
    }

     public function delete_reward_achievement($id)

    {
    	$whr = array('reward_id'=>$id);
        if($this->CommonMdl->deleteRecord('tbl_reward_achievement',$whr)==true)

        {

          $this->session->set_flashdata('msg','Reward delete successfully'); 

          $this->session->set_flashdata('msg_class','bg-success');  

          redirect(base_url() . 'admin/master/reward_achievement');  

        }

    }




    public function amenity($id='')

	{
		$whr = array('amenity_id'=>$id);
		$data['edit_amenity'] = $this->CommonMdl->getResultByCond('tbl_amenity',$whr,'*');
		//print_data($data['edit_banner']);
		 $order_by = array('col_name'=>'amenity_id','order'=>'desc');
		$data['alldata'] = $this->CommonMdl->getResultOrderBy('tbl_amenity','*',$order_by);
		//print_data($data['alldata']);
	   $this->load->view('admin/master/amenity/AmenityView',$data);

	}

	public function add_amenity(){
		//print_data($_FILES);
		// $page_new_banner_img = $_FILES['banner_img']['name'] ;
			$path = "assets/public/images/amenity";
		$this->upload->initialize($this->set_upload_options($path));
			if ($this->upload->do_upload('icon_image'))
			{
				$icon_image = $this->upload->data();
			}
			
			  if($this->input->post('status')!='enable'){
		      $user_status = 'disable';
		    }
		    else{
		      $user_status= $this->input->post('status');
		    }

				$dataArr=array(				
				'amenity_name'=>$this->input->post('amenity_name'),
				'amenity_icon'=>$icon_image['file_name'],                         			
				'amenity_status'=>$user_status,
				'created_on'=>date("Y-m-d H:i:s"),
				'created_by'=>$this->session->userdata('admin_id'),
				'updated_by'=>$this->session->userdata('admin_id'),
				'updated_on'=>date("Y-m-d H:i:s")
				); 
				//print_data($dataArr);                                     

				$Savebanner=$this->CommonMdl->insertRow($dataArr,'tbl_amenity');

				if($Savebanner){

				$this->session->set_flashdata('msg','Amenity added successfully'); 

				$this->session->set_flashdata('msg_class','bg-success'); 

				redirect(base_url().'admin/master/amenity');
				}

            }

      public function delete_amenity($id)

    {
    	$whr = array('amenity_id'=>$id);
        if($this->CommonMdl->deleteRecord('tbl_amenity',$whr)==true)

        {

          $this->session->set_flashdata('msg','Amenity delete successfully'); 

          $this->session->set_flashdata('msg_class','bg-success');  

          redirect(base_url() . 'admin/master/amenity');  

        }

    }


    public function edit_amenity(){
    	if($this->input->post('status')!='enable'){
		      $status = 'disable';
		    }
		    else{
		      $status= $this->input->post('status');
		    }

			$new_icon_img = $_FILES['icon_image']['name'] ;
			$path = "assets/public/images/amenity";
			$this->upload->initialize($this->set_upload_options($path));
			if ($this->upload->do_upload('icon_image'))
			{
				$edit_new_icon_img1 = $this->upload->data();
				$new_icon_img = $edit_new_icon_img1['file_name'];
			}
			if($new_icon_img==''){
				$new_icon_img=$this->input->post('old_icon_image');
			}

			



		    	$dataArr=array(				
				'amenity_name'=>$this->input->post('amenity_name'),
				'amenity_icon'=>$new_icon_img,                         			
				'amenity_status'=>$status,
				'updated_by'=>$this->session->userdata('admin_id'),
				'updated_on'=>date("Y-m-d H:i:s")
				); 
				//print_data($dataArr);                                    
    			$whr = array('amenity_id'=>$this->input->post('amenity_id'));
				$res=$this->CommonMdl->updateData($dataArr,$whr,'tbl_amenity');

				if($res){

				$this->session->set_flashdata('msg','Amenity updated successfully'); 

				$this->session->set_flashdata('msg_class','bg-success'); 

				redirect(base_url().'admin/master/amenity');
				}
    }
	
	public function addpackage($package_id=''){
		 $whr = array('package_id'=>$package_id);
		$data['edit_package'] = $this->CommonMdl->getResultByCond('tbl_package',$whr,'*');
		$order_by = array('col_name'=>'package_id','order'=>'desc');
		$data['alldata'] = $this->CommonMdl->getResultOrderBy('tbl_package','*',$order_by);
		 $this->load->view('admin/master/package/PackageView',$data);
	}
	
	public function packageinsert(){
		if($this->input->post('status')!='active'){
		      $status = 'inactive';
		    }
		    else{
		     $status= $this->input->post('status');
		   }
		   
		$packageArr=array(
				'package_name'=>$this->input->post('package_name'),
				'package_status'=>$status,
				'create_on'=>date("Y-m-d H:i:s"),
				'update_on'=>date("Y-m-d H:i:s"),
				'created_by'=>$this->session->userdata('admin_id'),
				'updated_by'=>$this->session->userdata('admin_id')
			);
			
			$Savebanner=$this->CommonMdl->insertRow($packageArr,'tbl_package');

				if($Savebanner){

				$this->session->set_flashdata('msg','Package added successfully'); 

				$this->session->set_flashdata('msg_class','bg-success'); 

				redirect(base_url().'admin/master/addpackage');
				}
				
		 
	}
	
	public function edit_package(){
		
		if($this->input->post('status')!='active'){
		      $status = 'inactive';
		    }
		    else{
		     $status= $this->input->post('status');
		   }
			$packageArr=array(
				'package_name'=>$this->input->post('package_name'),
				'package_status'=>$status,
				'create_on'=>date("Y-m-d H:i:s"),
				'update_on'=>date("Y-m-d H:i:s"),
				'created_by'=>$this->session->userdata('admin_id'),
				'updated_by'=>$this->session->userdata('admin_id')
			);
			
			$whr = array('package_id'=>$this->input->post('package_id'));
		      $res=$this->CommonMdl->updateData($packageArr,$whr,' tbl_package');

				if($res){

				$this->session->set_flashdata('msg','Package updated successfully'); 

				$this->session->set_flashdata('msg_class','bg-success'); 

				redirect(base_url().'admin/master/addpackage');
				}
	
			
	
			
	}
	public function addbatchslot($batch_id=''){
		$whr = array('batch_slot_type_id'=>$batch_id);
		$data['edit_batc_slot'] = $this->CommonMdl->getResultByCond('tbl_batch_slot_type',$whr,'*');
		$order_by = array('col_name'=>'batch_slot_type_id','order'=>'desc');
		$data['alldata'] = $this->CommonMdl->getResultOrderBy('tbl_batch_slot_type','*',$order_by);
		$this->load->view('admin/master/batch-slot/BatchSlotView',$data);
	}
	
	public function add_batch(){
		if($this->input->post('status')!='active'){
		      $status = 'inactive';
		    }
		    else{
		     $status= $this->input->post('status');
		   }
		   
		$batchArr=array(
				'batch_slot_type'=>$this->input->post('batch_type'),
				'batch_slot_type_status'=>$status,
				'create_on'=>date("Y-m-d H:i:s"),
				'update_on'=>date("Y-m-d H:i:s"),
				'created_by'=>$this->session->userdata('admin_id'),
				'updated_by'=>$this->session->userdata('admin_id')
			);
			
			$Savebanner=$this->CommonMdl->insertRow($batchArr,'tbl_batch_slot_type');

				if($Savebanner){

				$this->session->set_flashdata('msg','Batch slot added successfully'); 

				$this->session->set_flashdata('msg_class','bg-success'); 

				redirect(base_url().'admin/master/addbatchslot');
				}
				
	}
	
	
	public function editbatchslot(){
		if($this->input->post('status')!='active'){
		      $status = 'inactive';
		    }
		    else{
		     $status= $this->input->post('status');
		   }
			$packageArr=array(
				'batch_slot_type'=>$this->input->post('Btach_type'),
				'batch_slot_type_status'=>$status,
				'create_on'=>date("Y-m-d H:i:s"),
				'update_on'=>date("Y-m-d H:i:s"),
				'created_by'=>$this->session->userdata('admin_id'),
				'updated_by'=>$this->session->userdata('admin_id')
			);
		$whr = array('batch_slot_type_id'=>$this->input->post('batch_slot_id'));
		      $res=$this->CommonMdl->updateData($packageArr,$whr,'tbl_batch_slot_type');

				if($res){

				$this->session->set_flashdata('msg','Batch slot updated successfully'); 

				$this->session->set_flashdata('msg_class','bg-success'); 

				redirect(base_url().'admin/master/addbatchslot');
				}
	}
	
	
	
	public function interestedsport(){
		$start_date = '';
	     $end_date = '';
		if($this->input->post('action')=='fac_filter'){
		 
			if($this->input->post('start_date')!=''){ 
			    $start_date=date('Y-m-d', strtotime($this->input->post('start_date')));
				$data['start_date']=$this->input->post('start_date');
			} 
			if($this->input->post('end_date')!=''){
			    $end_date=date('Y-m-d', strtotime($this->input->post('end_date')));
				 $data['end_date']=$this->input->post('end_date');
			}
            $data['user_sport_list'] = $this->AdminMdl->getResultByUserFilter($start_date,$end_date);
		}else{
			 $data['user_sport_list'] = $this->AdminMdl->getResultByUserFilter($start_date,$end_date);
		  
		}
		$this->load->view('admin/user_dashboard/UserInterestedSportsView',$data);
	}
	
public function exportdatabyinterestedsport(){
	$start_date='';
	$end_date='';
		if($this->input->post('start_date')!=''  || $this->input->post('end_date')!=''){
			$start_date = '';
			$end_date = '';
			if($this->input->post('start_date')!=''){ 
				$start_date=date('Y-m-d', strtotime($this->input->post('start_date')));
				$data['start_date']=$this->input->post('start_date');
			}if($this->input->post('end_date')!=''){
				$end_date=date('Y-m-d', strtotime($this->input->post('end_date')));
				 $data['end_date']=$this->input->post('end_date');
            }
			
			$data['user_sport_list'] = $this->AdminMdl->getResultByUserFilter($start_date,$end_date);
		}else{
	          $data['user_sport_list'] = $this->AdminMdl->getResultByUserFilter($start_date,$end_date);
		}
		// print_data($data);
   $this->load->view('admin/user_dashboard/ExcelUserInterestedSport/UserInterestedView',$data);
}
	public function exportdatainterestedsport(){
	   $order_by = array('col_name'=>'interested_sport_id','order'=>'desc');
	    $data['user_sport_list'] =   $this->CommonMdl->getResultByCond('tbl_interested_sport','','sport_id,created_on,user_id',$order_by);
	    foreach($data['user_sport_list'] as $sportlistKey=>$sportval){
			$master_sport =   $this->CommonMdl->getResultByCond('tbl_sport_list',array('sport_id'=> $sportval->sport_id),'sport_name,sport_icon',$order_by='');
			$data['user_sport_list'][$sportlistKey]->sport_list= $master_sport;
			$user_list =   $this->CommonMdl->getResultByCond('tbl_user',array('user_id'=> $sportval->user_id),'user_name',$order_by='');
			$data['user_sport_list'][$sportlistKey]->user_list= $user_list;	
		  }
		 
		  
	  $this->load->view('admin/user_dashboard/ProductExcelExportView',$data);
	}
	
	public function userfavouritelist(){
		$start_date = '';
		$end_date = '';
		if($this->input->post('action')=='fac_filter'){
			if($this->input->post('start_date')!=''){ 
			    $start_date=date('Y-m-d', strtotime($this->input->post('start_date')));
				$data['start_date']=$this->input->post('start_date');
			} 
			if($this->input->post('end_date')!=''){
			    $end_date=date('Y-m-d', strtotime($this->input->post('end_date')));
				 $data['end_date']=$this->input->post('end_date');
			}
	           $data['favourate_listing'] = $this->AdminMdl->getfavourateByFilter($start_date,$end_date);
		}else{
		 $data['favourate_listing'] = $this->AdminMdl->getfavourateByFilter($start_date,$end_date); 
		}
	 // print_data($data['favourate_listing']);
	 // die;
	   $this->load->view('admin/user_dashboard/UserFavourateView',$data);
	}
	
	
	public function exportdatafavourate(){
		$start_date = '';
		$end_date = '';

		 if($this->input->post('start_date')!='' || $this->input->post('end_date')!=''){
			$start_date=date('Y-m-d',strtotime($this->input->post('start_date')));
		    $end_date=date('Y-m-d',strtotime($this->input->post('end_date')));
			$data['favourate_listing'] = $this->AdminMdl->getfavourateByFilter($start_date,$end_date);			
		 }else{
			$data['favourate_listing'] = $this->AdminMdl->getfavourateByFilter($start_date,$end_date);
		 }
		 
		   $this->load->view('admin/user_dashboard/ExcelUserInterestedSport/UserInterestedView',$data);
		   
		   
	}
	
	
	public function globelconfig(){
		$data['globel_config_listing'] =  $this->CommonMdl->getResultByCond('tbl_globel_config','','*',$order_by='');
		 
		 $this->load->view('admin/user_dashboard/GlobalConfigView',$data);
	}
	
	
	public function editglobelconfig(){
		$dataArr=array(				
				'config_email'=>$this->input->post('config_email'),
				'config_phone'=>$this->input->post('config_phone'),                         				
				'config_address'=>$this->input->post('config_address'),                         			
				'twitter_link'=>$this->input->post('twitter_link'),
				'fb_link'=>$this->input->post('fb_link'),
				'linkedin_link'=>$this->input->post('linkedin_link')
				); 
			
    			$whr = array('config_id'=>$this->input->post('config_idss'));
				$Savebanner=$this->CommonMdl->updateData($dataArr,$whr,'tbl_globel_config');

				if($Savebanner){

				$this->session->set_flashdata('msg','Config updated successfully'); 

				$this->session->set_flashdata('msg_class','bg-success'); 

				redirect(base_url().'admin/master/globelconfig');
				}
	}
	
	
	public function newsletterlist(){
		$start_date = '';
		$end_date = '';
		if($this->input->post('action')=='fac_filter'){
			if($this->input->post('start_date')!=''){ 
			    $start_date=date('Y-m-d', strtotime($this->input->post('start_date')));
				$data['start_date']=$this->input->post('start_date');
			}if($this->input->post('end_date')!=''){
			     $end_date=date('Y-m-d', strtotime($this->input->post('end_date')));
				 $data['end_date']=$this->input->post('end_date');
             }
			 $data['letterlist'] = $this->AdminMdl->getnewsletterlist($start_date,$end_date);
			
	}else{
		$data['letterlist'] = $this->AdminMdl->getnewsletterlist($start_date,$end_date);
		
	}
		$this->load->view('admin/user_dashboard/NewsLetterListView',$data);
	}
	
	 public function exportdatabynewletter(){
		 $start_date='';
		 $end_date='';
	   if($this->input->post('start_date')!='' || $this->input->post('end_date')!=''){
		   if($this->input->post('start_date')!=''){
		     $start_date=date('Y-m-d', strtotime($this->input->post('start_date')));
		   }if($this->input->post('end_date')!=''){
			  $end_date=date('Y-m-d', strtotime($this->input->post('end_date')));
		  }
		   $data['letterlist'] = $this->AdminMdl->getnewsletterlist($start_date,$end_date); 
	   }else{
		   $data['letterlist'] = $this->AdminMdl->getnewsletterlist($start_date,$end_date);
	   }
	    $this->load->view('admin/Excel/FacilityUserExcelExportView',$data);
  }


}

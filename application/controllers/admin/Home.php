<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public  function __construct()

    {

   	    parent::__construct();
   	    if(!$this->session->userdata('admin_id')){
            redirect('admin');

        }

	}

	public function index()

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
	public function banner($id=''){
		$whr = array('banner_id'=>$id);
		$data['edit_banner'] = $this->CommonMdl->getResultByCond('tbl_home_banner',$whr,'*');
		//print_data($data['edit_banner']);
	$data['alldata'] = $this->CommonMdl->getResult('tbl_home_banner','*');
   $this->load->view('admin/home/banner/BannerView',$data);

	}

	public function add_banner(){
		// $page_new_banner_img = $_FILES['banner_img']['name'] ;
			$path = "assets/admin/images/home";
		$this->upload->initialize($this->set_upload_options($path));
			if ($this->upload->do_upload('banner_img'))
			{
				$banner_img = $this->upload->data();
			}
			  if($this->input->post('status')!='enable'){
		      $user_status = 'disable';
		    }
		    else{
		      $user_status= $this->input->post('status');
		    }

				$dataArr=array(				
				'banner_alt'=>$this->input->post('alt_name'),
				'banner_text'=>$this->input->post('banner_text'),
				'banner_image'=>$banner_img['file_name'],                          				
				'banner_status'=>$user_status,
				'created_on'=>date("Y-m-d H:i:s"),
				'updated_on'=>date("Y-m-d H:i:s")
				); 
				//print_data($dataArr);                                     

				$Savebanner=$this->CommonMdl->insertRow($dataArr,'tbl_home_banner');

				if($Savebanner){

				$this->session->set_flashdata('msg','Banner added successfully'); 

				$this->session->set_flashdata('msg_class','bg-success'); 

				redirect(base_url().'admin/home/banner');
				}

                            }

       

    public function delete_banner($id='')

    {
    	$whr = array('banner_id'=>$id);
        if($this->CommonMdl->deleteRecord('tbl_home_banner',$whr)==true)

        {

          $this->session->set_flashdata('msg','Banner delete successfully'); 

          $this->session->set_flashdata('msg_class','bg-success');  

          redirect(base_url() . 'admin/home/banner');  

        }

    }

    public function edit_banner(){
    	if($this->input->post('status')!='enable'){
		      $user_status = 'disable';
		    }
		    else{
		      $user_status= $this->input->post('status');
		    }

			$new_banner_img = $_FILES['banner_img']['name'] ;
			$path = "assets/admin/images/home";
			$this->upload->initialize($this->set_upload_options($path));
			if ($this->upload->do_upload('banner_img'))
			{
				$edit_new_banner_img1 = $this->upload->data();
				$new_banner_img = $edit_new_banner_img1['file_name'];
			}
			if($new_banner_img==''){
				$new_banner_img=$this->input->post('banner_img1');
			}



    	$dataArr=array(				
				'banner_alt'=>$this->input->post('alt_name'),
				'banner_text'=>$this->input->post('banner_text'),
				'banner_image'=>$new_banner_img,                   	
				'banner_status'=>$user_status,
				'updated_on'=>date("Y-m-d H:i:s")
				);                                     
    			$whr = array('banner_id'=>$this->input->post('banner_id'));
				$Savebanner=$this->CommonMdl->updateData($dataArr,$whr,'tbl_home_banner');

				if($Savebanner){

				$this->session->set_flashdata('msg','Banner updated successfully'); 

				$this->session->set_flashdata('msg_class','bg-success'); 

				redirect(base_url().'admin/home/banner');
				}
    }


    public function sport($id=''){
		$whr = array('home_sport_id'=>$id);
	
		$data['edit_sport'] = $this->CommonMdl->getResultByCond('tbl_home_sport',$whr,'*');
		
		$data['alldata'] = $this->CommonMdl->getResult('tbl_home_sport','*');
		foreach($data['alldata'] as $key=>$val){
			$data['alldata'][$key]->sport_names=$this->CommonMdl->getResultByCond('tbl_sport_list',array('sport_id'=>$val->sport_id),'sport_id,sport_name',$order_by='');
		}
		
		$data['sport_data'] = $this->CommonMdl->getResult('tbl_sport_list','*');
		
		$this->load->view('admin/home/sport/SportView',$data);

	}

public function add_sport(){
		// $page_new_banner_img = $_FILES['banner_img']['name'] ;
			$path = "assets/admin/images/home";
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
				'sport_id'=>$this->input->post('sport_id'),
				'icon_image'=>$icon_image['file_name'],                         				
				'sport_image'=>$sport_image['file_name'],                         			
				'sport_status'=>$user_status,
				'created_on'=>date("Y-m-d H:i:s"),
				'updated_on'=>date("Y-m-d H:i:s")
				); 
				                                  

				$Savebanner=$this->CommonMdl->insertRow($dataArr,'tbl_home_sport');

				if($Savebanner){

				$this->session->set_flashdata('msg','Sport added successfully'); 

				$this->session->set_flashdata('msg_class','bg-success'); 

				redirect(base_url().'admin/home/sport');
				}

            }

      public function delete_sport($id)

    {
    	$whr = array('home_sport_id'=>$id);
        if($this->CommonMdl->deleteRecord('tbl_home_sport',$whr)==true)

        {

          $this->session->set_flashdata('msg','Sport delete successfully'); 

          $this->session->set_flashdata('msg_class','bg-success');  

          redirect(base_url() . 'admin/home/sport');  

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
			$path = "assets/admin/images/home";
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
				'sport_id'=>$this->input->post('sport_id'),
				'icon_image'=>$new_icon_img,                   	
				'sport_image'=>$new_sport_img,                   	
				'sport_status'=>$sport_status,
				'updated_on'=>date("Y-m-d H:i:s")
				);  
				//print_data($dataArr);                                    
    			$whr = array('home_sport_id'=>$this->input->post('home_sport_id'));
				$Savebanner=$this->CommonMdl->updateData($dataArr,$whr,'tbl_home_sport');

				if($Savebanner){

				$this->session->set_flashdata('msg','Sport updated successfully'); 

				$this->session->set_flashdata('msg_class','bg-success'); 

				redirect(base_url().'admin/home/sport');
				}
    }


    public function popular_categoties($id=''){
		$whr = array('popular_cat_id'=>$id);
		$data['edit_data'] = $this->CommonMdl->getResultByCond('tbl_home_popular_cat',$whr,'*');
		// print_data($data['edit_banner']);
	$data['alldata'] = $this->CommonMdl->getResult(' tbl_home_popular_cat','*');
   $this->load->view('admin/home/popular-categories/PopularCatView',$data);

	}
  
  public function add_popular_data(){
		// $page_new_banner_img = $_FILES['banner_img']['name'] ;
			$path = "assets/admin/images/home";
		$this->upload->initialize($this->set_upload_options($path));
			if ($this->upload->do_upload('icon_image'))
			{
				$icon_image = $this->upload->data();
			}

			$this->upload->initialize($this->set_upload_options1($path));
			if ($this->upload->do_upload('hover_image'))
			{
				$hover_image = $this->upload->data();
			}
			
			  if($this->input->post('status')!='enable'){
		      $status = 'disable';
		    }
		    else{
		      $status= $this->input->post('status');
		    }

				$dataArr=array(				
				'popular_title'=>$this->input->post('title'),
				'popular_text'=>$this->input->post('text'),
				'popular_url'=>$this->input->post('url'),
				'popular_icon'=>$icon_image['file_name'],                        			
				'popular_hover_icon'=>$hover_image['file_name'],                        			
				'popular_status'=>$status,
				'created_on'=>date("Y-m-d H:i:s"),
				'updated_on'=>date("Y-m-d H:i:s")
				);                                     

				$Savebanner=$this->CommonMdl->insertRow($dataArr,'tbl_home_popular_cat');

				if($Savebanner){

				$this->session->set_flashdata('msg','Data added successfully'); 

				$this->session->set_flashdata('msg_class','bg-success'); 

				redirect(base_url().'admin/home/popular_categoties');
				}

            }

         public function delete_popular_cat($id){
          $whr = array('popular_cat_id'=>$id);
        if($this->CommonMdl->deleteRecord('tbl_home_popular_cat',$whr)==true)

        {

          $this->session->set_flashdata('msg','Data delete successfully'); 

          $this->session->set_flashdata('msg_class','bg-success');  

          redirect(base_url() . 'admin/home/popular_categoties');  

        }

            }


          public function edit_popular_cat(){
    	if($this->input->post('status')!='enable'){
		      $status = 'disable';
		    }
		    else{
		      $status= $this->input->post('status');
		    }

			$new_icon_img = $_FILES['icon_image']['name'] ;
			$new_hover_img = $_FILES['hover_image']['name'] ;
			$path = "assets/admin/images/home";
			$this->upload->initialize($this->set_upload_options($path));
			if ($this->upload->do_upload('icon_image'))
			{
				$edit_new_icon_img1 = $this->upload->data();
				$new_icon_img = $edit_new_icon_img1['file_name'];
			}
			if($new_icon_img==''){
				$new_icon_img=$this->input->post('old_icon_image');
			}

			if ($this->upload->do_upload('hover_image'))
			{
				$edit_new_hover_img1 = $this->upload->data();
				$new_hover_img = $edit_new_hover_img1['file_name'];
			}
			if($new_hover_img==''){
				$new_hover_img=$this->input->post('old_hover_image');
			}



    	$dataArr=array(				
				'popular_title'=>$this->input->post('title'),
				'popular_text'=>$this->input->post('text'),
				'popular_url'=>$this->input->post('url'),
				'popular_icon'=>$new_icon_img,                   	
				'popular_hover_icon'=>$new_hover_img,                   	
				'popular_status'=>$status,
				'updated_on'=>date("Y-m-d H:i:s")
				);  
				//print_data($dataArr);                                    
    			$whr = array('popular_cat_id'=>$this->input->post('popular_cat_id'));
				$Savebanner=$this->CommonMdl->updateData($dataArr,$whr,'tbl_home_popular_cat');

				if($Savebanner){

				$this->session->set_flashdata('msg','Data updated successfully'); 

				$this->session->set_flashdata('msg_class','bg-success'); 

				redirect(base_url().'admin/home/popular_categoties');
				}
    }


     public function youtube($id=''){
		$whr = array('youtube_id'=>$id);
		$data['edit_data'] = $this->CommonMdl->getResultByCond('tbl_home_youtube',$whr,'*');
		//print_data($data['edit_banner']);
	$data['alldata'] = $this->CommonMdl->getResult('tbl_home_youtube','*');
   $this->load->view('admin/home/youtube-link/YoutubeLinkView',$data);

	}

	public function add_youtube(){
			
			 if($this->input->post('status')!='enable'){
		      $status = 'disable';
		    }
		    else{
		      $status= $this->input->post('status');
		    }

				$dataArr=array(				
				'youtube_title'=>$this->input->post('youtube_title'),
				'youtube_text'=>$this->input->post('youtube_text'),
				'youtube_link'=>$this->input->post('youtube_link'),                     			
				'youtube_status'=>$status,
				'created_on'=>date("Y-m-d H:i:s"),
				'updated_on'=>date("Y-m-d H:i:s")
				); 
				//print_data($dataArr);                                     

				$Savedata=$this->CommonMdl->insertRow($dataArr,'tbl_home_youtube');

				if($Savedata){

				$this->session->set_flashdata('msg','Data added successfully'); 

				$this->session->set_flashdata('msg_class','bg-success'); 

				redirect(base_url().'admin/home/youtube');
				}
		
	}

	public function edit_youtube(){

		 if($this->input->post('status')!='enable'){
		      $status = 'disable';
		    }
		    else{
		      $status= $this->input->post('status');
		    }

				$dataArr=array(				
				'youtube_title'=>$this->input->post('youtube_title'),
				'youtube_text'=>$this->input->post('youtube_text'),
				'youtube_link'=>$this->input->post('youtube_link'),                     			
				'youtube_status'=>$status,
				'updated_on'=>date("Y-m-d H:i:s")
				); 
				//print_data($dataArr);                                     

				$whr = array('youtube_id'=>$this->input->post('youtube_id'));
				$Savebanner=$this->CommonMdl->updateData($dataArr,$whr,'tbl_home_youtube');

				if($Savebanner){

				$this->session->set_flashdata('msg','Data updated successfully'); 

				$this->session->set_flashdata('msg_class','bg-success'); 

				redirect(base_url().'admin/home/youtube');
				}

	}


	   public function delete_youtube($id){
          $whr = array('youtube_id'=>$id);
        if($this->CommonMdl->deleteRecord('tbl_home_youtube',$whr)==true)

        {

          $this->session->set_flashdata('msg','Data deleted successfully'); 

          $this->session->set_flashdata('msg_class','bg-success');  

          redirect(base_url() . 'admin/home/youtube');  

        }

            }



     public function clients($id=''){
		$whr = array('client_id'=>$id);
		$data['edit_data'] = $this->CommonMdl->getResultByCond('tbl_home_client',$whr,'*');
		//print_data($data['edit_banner']);
	$data['alldata'] = $this->CommonMdl->getResult('tbl_home_client','*');
   $this->load->view('admin/home/client/ClientView',$data);

	}


	public function add_client(){
			$path = "assets/admin/images/home";
		$this->upload->initialize($this->set_upload_options($path));
			if ($this->upload->do_upload('client_logo'))
			{
				$client_logo = $this->upload->data();
			}
			  if($this->input->post('status')!='enable'){
		      $status = 'disable';
		    }
		    else{
		      $status= $this->input->post('status');
		    }

				$dataArr=array(				
				'client_title'=>$this->input->post('client_title'),
				'client_logo'=>$client_logo['file_name'],                          				
				'client_status'=>$status,
				'created_on'=>date("Y-m-d H:i:s"),
				'updated_on'=>date("Y-m-d H:i:s")
				); 
				//print_data($dataArr);                                     

				$savedata=$this->CommonMdl->insertRow($dataArr,'tbl_home_client');

				if($savedata){

				$this->session->set_flashdata('msg','client added successfully'); 

				$this->session->set_flashdata('msg_class','bg-success'); 

				redirect(base_url().'admin/home/clients');
				}
			   }



	public function edit_client(){
    	if($this->input->post('status')!='enable'){
		      $status = 'disable';
		    }
		    else{
		      $status= $this->input->post('status');
		    }

			$new_logo_img = $_FILES['client_logo']['name'] ;
			$path = "assets/admin/images/home";
			$this->upload->initialize($this->set_upload_options($path));
			if ($this->upload->do_upload('client_logo'))
			{
				$edit_new_logo_img = $this->upload->data();
				$new_logo_img = $edit_new_logo_img['file_name'];
			}
			if($new_logo_img==''){
				$new_logo_img=$this->input->post('client_logo_old');
			}

    	$dataArr=array(				
				'client_title'=>$this->input->post('client_title'),
				'client_logo'=>$new_logo_img,                          				
				'client_status'=>$status,
				'created_on'=>date("Y-m-d H:i:s"),
				'updated_on'=>date("Y-m-d H:i:s")
				);
				//print_data($dataArr);                               
    			$whr = array('client_id'=>$this->input->post('client_id'));
				$savedata=$this->CommonMdl->updateData($dataArr,$whr,'tbl_home_client');

				if($savedata){

				$this->session->set_flashdata('msg','Client updated successfully'); 

				$this->session->set_flashdata('msg_class','bg-success'); 

				redirect(base_url().'admin/home/clients');
				}
    }


	public function delete_client($id){
          $whr = array('client_id'=>$id);
        if($this->CommonMdl->deleteRecord('tbl_home_client',$whr)==true)

        {

          $this->session->set_flashdata('msg','client deleted successfully'); 

          $this->session->set_flashdata('msg_class','bg-success');  

          redirect(base_url() . 'admin/home/clients');  

        }

            }

         public function footer($id=''){
		$whr = array('footer_id'=>$id);
		$data['edit_data'] = $this->CommonMdl->getResultByCond('tbl_home_client',$whr,'*');
		//print_data($data['edit_banner']);
	$data['alldata'] = $this->CommonMdl->getResult('tbl_home_client','*');
   $this->load->view('admin/home/client/ClientView',$data);

	}

}
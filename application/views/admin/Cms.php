<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cms extends CI_Controller {

    public  function __construct()

    {

   	    parent::__construct();
   	    if(!$this->session->userdata('admin_id')){
            redirect('admin');

        }

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


	public function index()
	{
    $order_by = array('col_name'=>'page_id','order'=>'desc');
    $data['alldata'] = $this->CommonMdl->getResultOrderBy('tbl_static_page','*',$order_by);
    $this->load->view('admin/static-page/PageListView',$data);
	}


  public function add_page_form()
  {
    $this->load->view('admin/static-page/AddPageView');
  }

  public function add_page()
  {

      $path = "assets/public/images/cms";
    $this->upload->initialize($this->set_upload_options($path));
      if ($this->upload->do_upload('page_banner'))
      {
        $page_banner = $this->upload->data();
      }
        if($this->input->post('status')!='enable'){
          $status = 'disable';
        }
        else{
          $status= $this->input->post('status');
        }

        $dataArr=array(       
        'page_title'=>$this->input->post('page_name'),
        'page_slug'=>$this->input->post('page_slug'),
        'page_banner'=>$page_banner['file_name'],                                 
        'first_section'=>$this->input->post('first_section'),                                
        'second_section'=>$this->input->post('second_section'),                                
        'third_section'=>$this->input->post('third_section'),                                
        'page_meta'=>$this->input->post('page_meta'),                                
        'page_status'=>$status,
        'created_on'=>date("Y-m-d H:i:s"),
        'updated_on'=>date("Y-m-d H:i:s")
        ); 
       // print_data($dataArr);                                     

        $res=$this->CommonMdl->insertRow($dataArr,'tbl_static_page');

        if($res){

        $this->session->set_flashdata('msg','Page added successfully'); 

        $this->session->set_flashdata('msg_class','bg-success'); 

        redirect(base_url().'admin/cms');
        }
  }

  public function delete_page($id='')

    {
      $whr = array('page_id'=>$id);
        if($this->CommonMdl->deleteRecord('tbl_static_page',$whr)==true)

        {

          $this->session->set_flashdata('msg','page delete successfully'); 

          $this->session->set_flashdata('msg_class','bg-success');  

          redirect(base_url() . 'admin/cms');  

        }

    }


     public function page_edit_form($id=''){
        $whr = array('page_id'=>$id);
        $data['edit_page'] = $this->CommonMdl->getResultByCond('tbl_static_page',$whr,'*');
        $this->load->view('admin/static-page/EditPageView',$data);

  }


  public function update_page(){
      if($this->input->post('status')!='enable'){
          $status = 'disable';
        }
        else{
          $status= $this->input->post('status');
        }

    $new_banner_img = $_FILES['page_banner']['name'] ;
      $path = "assets/public/images/cms";
      $this->upload->initialize($this->set_upload_options($path));
      if ($this->upload->do_upload('page_banner'))
      {
        $edit_new_banner_img1 = $this->upload->data();
        $new_banner_img = $edit_new_banner_img1['file_name'];
      }
      if($new_banner_img==''){
        $new_banner_img=$this->input->post('old_page_banner');
      }


 $dataArr=array(       
        'page_title'=>$this->input->post('page_name'),
        'page_slug'=>$this->input->post('page_slug'),
        'page_banner'=>$new_banner_img,                                 
        'first_section'=>$this->input->post('first_section'),                                
        'second_section'=>$this->input->post('second_section'),                                
        'third_section'=>$this->input->post('third_section'),                                
        'page_meta'=>$this->input->post('page_meta'),                                
        'page_status'=>$status,
        'created_on'=>date("Y-m-d H:i:s"),
        'updated_on'=>date("Y-m-d H:i:s")
        ); 
       //print_data($dataArr);                                    
          $whr = array('page_id'=>$this->input->post('page_id'));
        $Savebanner=$this->CommonMdl->updateData($dataArr,$whr,'tbl_static_page');

        if($Savebanner){

        $this->session->set_flashdata('msg','Page updated successfully'); 

        $this->session->set_flashdata('msg_class','bg-success'); 

        redirect(base_url().'admin/cms');
        }
    }



  public function check_page_name(){
   // echo $this->input->post('page_id');die();
    $cond = '';
    if($this->input->post('page_name')){
      $cond = array('page_title' => $this->input->post('page_name'));
    }
    else if($this->input->post('page_slug')){
      $cond = array('page_slug' => $this->input->post('page_slug'));
    }
  
  if($this->input->post('page_id')!=''){
    $cond1 = array('page_id!=' => $this->input->post('page_id'));
  }
  else{
    $cond1 = array();
  }

  $res=$this->CommonMdl->fetchNumRows(' tbl_static_page',$cond,$cond1);
  if($res){
    echo "1";
  }
  else{
    echo "2";
  }
  }

}

?>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->lang->load('admin', get_lang() );
        $this->load->library('session');
        $this->load->library('pagination');
        $this->load->model('data','','true');
        $this->load->library('upload');
        $this->load->helper(array('form', 'url','text'));
        $this->load->library('lib_pagination');
        $this->load->library('CKEditor');
        $this->load->library('CKFinder');
        $this->ckfinder->SetupCKEditor($this->ckeditor,'../../design/ckfinder/');      
    }
    public function gen_random_string()
    {
        $chars ="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";//length:36
        $final_rand='';
        for($i=0;$i<4; $i++) {
            $final_rand .= $chars[ rand(0,strlen($chars)-1)];
        }
        return $final_rand;
    }

    public function index(){
        redirect(base_url().'admin/pages/show','refresh');
    }





	public function home_intro(){
		$data['site_info']= $this->data->get_table_data('home_page');
		$this->load->view("admin/home/home_intro",$data); 
    }

	public function home_doctor(){
		$data['site_info']= $this->data->get_table_data('home_page');
		$this->load->view("admin/home/home_doctor",$data); 
    }

	public function home_background(){
		$data['site_info']= $this->data->get_table_data('home_page');
		$this->load->view("admin/home/home_background",$data); 
    }
	

	public function edit_about(){
		$about_site=$this->input->post('about_site');
		$about_site_ar=$this->input->post('about_site_ar');
		$data = array('breif_txt_eng'=>$about_site,'breif_txt_ar'=>$about_site_ar);
		$this->db->update('home_page',$data,array('id'=>1));

		//die();
		//echo "fFF".$_FILES['file']['name'];
		if($_FILES['file']['name']!=""){
		  $logo = $this->data->get_table_row('home_page',array('id'=>1),'breif_img'); 
		  if ($logo != "") {
		  unlink("uploads/site_setting/$logo");
		  }
		  $img_name=$this->gen_random_string(); 
		  $imagename = $img_name;
		  $config['upload_path'] = 'uploads/site_setting/';
		  $config['allowed_types']        = 'gif|jpg|png|jpeg';
		  $config['max_size']             =600000;
		  $config['max_width']            = 600000;
		  $config['max_height']           = 600000;
		  $config['file_name'] = $imagename; 
		  $this->load->library('upload', $config);
		  $this->upload->initialize($config);
		  if (!$this->upload->do_upload('file')){
		  echo $this->upload->display_errors();
		   }
		  else {
		  $url= $_FILES['file']['name'];
		  $ext = explode(".",$url);
		  $file_extension = end($ext);
		  $data = array('breif_img'=>$imagename.".".$file_extension);
		  $this->db->update('home_page',$data,array('id'=>1));
		   //echo $this->db->last_query();
		 //die();
			}
		  
			}
			$this->session->set_flashdata('msg', 'تم التعديل بنجاحٍ');
			$this->session->mark_as_flash('msg');
			redirect('/admin/pages/home_intro');	

}



public function edit_doctor(){
	$about_site=$this->input->post('about_site');
	$about_site_ar=$this->input->post('about_site_ar');
	$data = array('team_title_eng'=>$about_site,'team_title_ar'=>$about_site_ar);
	$this->db->update('home_page',$data,array('id'=>1));

	//die();
	//echo "fFF".$_FILES['file']['name'];
	if($_FILES['file']['name']!=""){
	  $logo = $this->data->get_table_row('home_page',array('id'=>1),'team_background'); 
	  if ($logo != "") {
	  unlink("uploads/site_setting/$logo");
	  }
	  $img_name=$this->gen_random_string(); 
	  $imagename = $img_name;
	  $config['upload_path'] = 'uploads/site_setting/';
	  $config['allowed_types']        = 'gif|jpg|png|jpeg';
	  $config['max_size']             =600000;
	  $config['max_width']            = 600000;
	  $config['max_height']           = 600000;
	  $config['file_name'] = $imagename; 
	  $this->load->library('upload', $config);
	  $this->upload->initialize($config);
	  if (!$this->upload->do_upload('file')){
	  echo $this->upload->display_errors();
	   }
	  else {
	  $url= $_FILES['file']['name'];
	  $ext = explode(".",$url);
	  $file_extension = end($ext);
	  $data = array('team_background'=>$imagename.".".$file_extension);
	  $this->db->update('home_page',$data,array('id'=>1));
	   //echo $this->db->last_query();
	 //die();
		}
	  
		}






		if($_FILES['file1']['name']!=""){
			$logo = $this->data->get_table_row('home_page',array('id'=>1),'team_img'); 
			if ($logo != "") {
			unlink("uploads/site_setting/$logo");
			}
			$img_name=$this->gen_random_string(); 
			$imagename = $img_name;
			$config['upload_path'] = 'uploads/site_setting/';
			$config['allowed_types']        = 'gif|jpg|png|jpeg';
			$config['max_size']             =600000;
			$config['max_width']            = 600000;
			$config['max_height']           = 600000;
			$config['file_name'] = $imagename; 
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('file1')){
			echo $this->upload->display_errors();
			 }
			else {
			$url= $_FILES['file1']['name'];
			$ext = explode(".",$url);
			$file_extension = end($ext);
			$data = array('team_img'=>$imagename.".".$file_extension);
			$this->db->update('home_page',$data,array('id'=>1));
			 //echo $this->db->last_query();
		   //die();
			  }
			
			  }
		$this->session->set_flashdata('msg', 'تم التعديل بنجاحٍ');
		$this->session->mark_as_flash('msg');
		redirect('/admin/pages/home_doctor');	

}




public function edit_slider_img(){

	if($_FILES['file']['name']!=""){
	  $logo = $this->data->get_table_row('home_page',array('id'=>1),'slider_background'); 
	  if ($logo != "") {
	  unlink("uploads/site_setting/$logo");
	  }
	  $img_name=$this->gen_random_string(); 
	  $imagename = $img_name;
	  $config['upload_path'] = 'uploads/site_setting/';
	  $config['allowed_types']        = 'gif|jpg|png|jpeg';
	  $config['max_size']             =600000;
	  $config['max_width']            = 600000;
	  $config['max_height']           = 600000;
	  $config['file_name'] = $imagename; 
	  $this->load->library('upload', $config);
	  $this->upload->initialize($config);
	  if (!$this->upload->do_upload('file')){
	   $this->db->update('home_page',$data,array('id'=>1));
	   }
	  else {
	  $url= $_FILES['file']['name'];
	  $ext = explode(".",$url);
	  $file_extension = end($ext);
	  $data = array('slider_background'=>$imagename.".".$file_extension);
	  $this->db->update('home_page',$data,array('id'=>1));
			}
	  
		}
		$this->session->set_flashdata('msg', 'تم التعديل بنجاحٍ');
		$this->session->mark_as_flash('msg');
		redirect('/admin/pages/home_background');	

}


}

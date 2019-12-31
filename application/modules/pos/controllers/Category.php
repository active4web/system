<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends MX_Controller
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
		$pg_config['sql'] = $this->data->get_sql('category','','id','DESC');
        $pg_config['per_page'] = 50;
        $data = $this->lib_pagination->create_pagination($pg_config);
        $this->load->view("pos/category/show", $data); 
    }

    public function show(){
        $pg_config['sql'] = $this->data->get_sql('category','','id','DESC');
        $pg_config['per_page'] = 50;
        $data = $this->lib_pagination->create_pagination($pg_config);
        $this->load->view("pos/category/show", $data); 
    }

    public function add_category(){
        $this->load->view("pos/category/add_category"); 
    }

    public function category_action(){
		$food_name=$this->input->post('food_name');
        $data['name'] = $food_name;
        $data['creation_date'] =date("Y-m-d");
        $this->db->insert('category',$data);
        $this->session->set_flashdata('msg', 'تم الاضافة بنجاح');
       redirect(base_url().'pos/category','refresh');
    }

    public function delete_category(){
        $id_blog = $this->input->get('id_type');
        $check=$this->input->post('check');
        if($id_blog!=""){
        $ret_value=$this->data->delete_table_row('category',array('id'=>$id_blog)); 
        }
     
        if(isset($check) && $check!=""){  
        $check=$this->input->post('check');
        $length=count($check);
        for($i=0;$i<$length;$i++){
        $ret_value=$this->data->delete_table_row('category',array('id'=>$check[$i]));    
        }
        }
        $this->session->set_flashdata('msg', 'تم الحذف بنجاح');
        redirect(base_url().'pos/category','refresh');
    }

    function view(){
        $id = $this->input->post("id");
        $ser = $this->db->get_where("category",array("id"=>$id,"view" => "1"))->num_rows();
        if ($ser == 1) {
            $this->db->update("category",array("view" => "0"),array("id"=>$id));
            echo "0";
        }
        if ($ser == 0) {
            $this->db->update("category",array("view" => "1"),array("id"=>$id));
            echo "1";
        } 
    }

    public function update_category(){
        $id=$this->input->get('id_type');
        $data['data'] = $this->data->get_table_data('category',array('id'=>$id));
        $this->load->view("pos/category/update_category",$data); 
    }

    function edit_action(){
		$food_name=$this->input->post('food_name');
		$id = $this->input->post('id');
        $data['name'] = $food_name;
        $data['creation_date'] = date('Y-m-d');
		$this->data->edit_table_id('category',array('id'=>$id),$data);
        $this->session->set_flashdata('msg', 'تم التعديل بنجاح');
        redirect(base_url().'pos/category/','refresh');
	}
	
/*********************************************************************** *////

}

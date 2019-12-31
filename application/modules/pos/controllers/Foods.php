<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Foods extends MX_Controller
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
                $this->load->helper('my_helper');

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
		redirect(base_url().'pos/foods/Meals','refresh');
    }

    public function Meals(){
        $pg_config['sql'] = $this->data->get_sql('product','','id','DESC');
        $pg_config['per_page'] = 50;
        $data = $this->lib_pagination->create_pagination($pg_config);
        $this->load->view("pos/foods/meals", $data); 
    }

    public function add_meals(){
        $this->load->view("pos/foods/add_meals"); 
    }

    public function product_action(){
       
		$title=$this->input->post('title');
		$price=$this->input->post('price');
        $discount=$this->input->post('discount');
        $id_cat=$this->input->post('id_cat');
$details_ar=$this->input->post('details_ar');
$min_amount_value=$this->input->post('min_amount_value');
$creation_date=date("Y-m-d H:i");

        $data['title'] = $title;
        $data['id_cat'] = $id_cat;
        $data['price'] = $price;
        $data['offers'] = $discount;
        $data['creation_date'] = $creation_date;
        $data['update_date'] = $creation_date;
        $data['details'] = $details_ar;
        
        $this->db->insert('product',$data);
         $id = $this->db->insert_id();

        if($_FILES['file']['name']!=""){
            $img_name=$this->gen_random_string(); 
            $imagename = $img_name;
            $config['upload_path'] = 'uploads/meals/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             =100000;
            $config['max_width']            =100000;
            $config['max_height']           =100000;
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
            $data = array('img'=>$imagename.".".$file_extension);
            $this->data->edit_table_id('product',array('id'=>$id),$data);
            }
        }
        
        
        $this->session->set_flashdata('msg', 'تم الاضافة بنجاح');
       redirect(base_url().'pos/foods','refresh');
    }

    public function delete_meal(){
        $id_blog = $this->input->get('id_type');
        $check=$this->input->post('check');
        if($id_blog!=""){
$img=get_tab_row('product',array('id'=>$id_blog),'img');
unlink("uploads/meals/$img");
        $ret_value=$this->data->delete_table_row('product',array('id'=>$id_blog)); 
        }
     
        if(isset($check) && $check!=""){  
        $check=$this->input->post('check');
        $length=count($check);
        for($i=0;$i<$length;$i++){
$img=get_tab_row('product',array('id'=>$check[$i]),'img');
unlink("uploads/meals/$img");
        $ret_value=$this->data->delete_table_row('product',array('id'=>$check[$i]));    
        }
        }
        $this->session->set_flashdata('msg', 'تم الحذف بنجاح');
        redirect(base_url().'pos/foods','refresh');
    }

    function check_view_meal(){
        $id = $this->input->post("id");
        $ser = $this->db->get_where("product",array("id"=>$id,"view" => "1"))->num_rows();
        if ($ser == 1) {
            $this->db->update("product",array("view" => "0"),array("id"=>$id));
            echo "0";
        }
        if ($ser == 0) {
            $this->db->update("product",array("view" => "1"),array("id"=>$id));
            echo "1";
        } 
    }

    public function update_meal(){
        $id=$this->input->get('id_type');
        $data['data'] = $this->data->get_table_data('product',array('id'=>$id));
        $this->load->view("pos/foods/update_meal",$data); 
    }

    function edit_action(){
		$title=$this->input->post('title');
		$price=$this->input->post('price');
        $discount=$this->input->post('discount');
        $id_cat=$this->input->post('id_cat');
$details_ar=$this->input->post('details_ar');
$min_amount_value=$this->input->post('min_amount_value');

$id=$this->input->post('id');
$creation_date=date("Y-m-y");

        $data['title'] = $title;
        $data['id_cat'] = $id_cat;
        $data['price'] = $price;
        $data['offers'] = $discount;
        $data['update_date'] = $creation_date;
        $data['details'] = $details_ar;
        $this->db->update('product',$data,array('id'=>$id));
        

        if($_FILES['file']['name']!=""){
            $img_name=$this->gen_random_string(); 
            $imagename = $img_name;
            $config['upload_path'] = 'uploads/meals/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             =100000;
            $config['max_width']            =100000;
            $config['max_height']           =100000;
            $config['file_name'] = $imagename; 
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('file')){
                echo $this->upload->display_errors();
               }
            else {
$img=get_tab_row('product',array('id'=>$id),'img');
unlink("uploads/meals/$img");
            $url= $_FILES['file']['name'];
            $ext = explode(".",$url);
            $file_extension = end($ext);
            $data = array('img'=>$imagename.".".$file_extension);
            $this->data->edit_table_id('product',array('id'=>$id),$data);
            }
        }
        $this->session->set_flashdata('msg', 'تم التعديل بنجاح');
        redirect(base_url().'pos/foods/','refresh');
	}
	
/*********************************************************************** *////

}

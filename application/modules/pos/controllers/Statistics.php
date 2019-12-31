<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Statistics extends MX_Controller
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
        $this->lang->load('main_lang', get_lang() );
        if( isset($this->session->get_userdata('lang')['lang']) ){
        $lang = $this->session->get_userdata('lang')['lang'];
        }else{
        $lang = 'arabic';
        }
        $dir = ( $lang == 'arabic' )? 'left' : 'right' ;
		define( "LANGU" , $lang );
        }
        
        
        public function lang_site( $lang = null ){
    $curt = $this->uri->segment(3);
$main_curt=$this->uri->segment(1);
$controller_curt=$this->uri->segment(2);
$curt_sub =$_SESSION['curt'];
$curt_id =$_SESSION['curt_id'];
 
        if( $lang == 'ar' ){
            $newdata = array(
            'lang'  => 'arabic'
            );
            $this->session->set_userdata($newdata);
        }else{
            $newdata = array(
            'lang'  => 'english'
            );
            $this->session->set_userdata($newdata);
		}
//echo  $this->session->get_userdata($newdata);
if($curt_id!=""){
redirect(DIR."pos/".$controller_curt."/".$curt_sub."/".$curt_id);
}
else {
redirect(DIR."pos/".$controller_curt."/".$curt_sub);    
}

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
	redirect(base_url().'pos/orders/Meals','refresh');
    }

    
public function casher(){
$id_admin=$this->input->get("id");
$pg_config['sql'] = $this->data->get_sql('final_order',array('id_admin'=>$id_admin),'id','DESC');
        $pg_config['per_page'] = 50;
        $data = $this->lib_pagination->create_pagination($pg_config);
        $this->load->view("pos/statistics/casher", $data); 
    }
    


    
public function casher_search(){
$end_time=$this->input->post('end_time');
$start_time=$this->input->post('start_time');
$id_admin=$this->input->post('id_admin');
if($start_time!=""){
$pg_config['sql'] =$this->data->get_sql('final_order',array("date >="=>$start_time,'id_admin'=>$id_admin),'id','desc');
}
if($end_time!=""){
$pg_config['sql'] =$this->data->get_sql('final_order',array("date<="=>$end_time,'id_admin'=>$id_admin),'id','desc');
}

if($end_time!=""&&$start_time!=""){
$pg_config['sql'] =$this->data->get_sql('final_order',array("date<="=>$end_time,"date>="=>$start_time,'id_admin'=>$id_admin),'id','desc');
}
if($end_time==""&&$start_time==""){
redirect(base_url().'pos/Statistics/casher','refresh');
}
$pg_config['per_page'] = 50;
 $data = $this->lib_pagination->create_pagination($pg_config);
$this->load->view("pos/statistics/casher_search", $data); 

}

    

public function order_details(){
        $id=$this->input->get('id');
        $data['data'] = $this->data->get_table_data('final_order',array('id'=>$id));
        $data['order_data'] = $this->data->get_table_data('order_data',array('order_id'=>$id));
        $this->load->view("pos/statistics/order_details",$data); 
}

/*********************************************************************** *////

}

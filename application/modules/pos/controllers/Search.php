<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Search extends MX_Controller
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
public function inventory(){
    $array="date as ids,id_meal as id_meal,total_price as total_price ,qty as qty";
$pg_config['sql'] =$this->data->get_sql_groupby('order_data','','date','desc',
$array,"id_meal");
        $pg_config['per_page'] = 50;
        $data = $this->lib_pagination->create_pagination($pg_config);
$this->load->view("pos/search/inventory", $data); 
    }
    
        public function billing(){
$pg_config['sql'] = $this->data->get_sql('final_order',array('view'=>'1'),'date','DESC');
        $pg_config['per_page'] = 50;
        $data = $this->lib_pagination->create_pagination($pg_config);
        $this->load->view("pos/search/billing", $data); 
    }
    

        public function search(){
        $pg_config['sql'] = $this->data->get_sql('team_work',array('view'=>'1'),'id','DESC');
        $pg_config['per_page'] = 50;
        $data = $this->lib_pagination->create_pagination($pg_config);
        $this->load->view("pos/search/search", $data); 
    }
    
            public function customers(){
        $pg_config['sql'] = $this->data->get_sql('team_work',array('limit_value!='=>0),'id','DESC');
        $pg_config['per_page'] = 50;
        $data = $this->lib_pagination->create_pagination($pg_config);
        $this->load->view("pos/search/customers", $data); 
    }
    
    

        public function billing_search(){
        $end_time=$this->input->post('end_time');
		$start_time=$this->input->post('start_time');

			$array="";
			if($start_time!=""){
$data['result']=$this->db->get_where("final_order",
array('view'=>'1',"DATE_FORMAT(date,'%Y-%m-%d')>="=>$start_time))->result();
}
if($end_time!=""){
$data['result']=$this->db->get_where("final_order",
array('view'=>'1',"DATE_FORMAT(date,'%Y-%m-%d')<="=>$end_time))->result();	    
	}
if($end_time!=""&&$start_time!=""){
$data['result']=$this->db->get_where("final_order",
array('view'=>'1',"DATE_FORMAT(date,'%Y-%m-%d')<="=>$end_time,"DATE_FORMAT(date,'%Y-%m-%d')>="=>$start_time))->result();	
//echo count($data['result']);
	}
if($end_time==""&&$start_time==""){
 redirect(base_url().'pos/search/billing','refresh');
}

$this->load->view("pos/search/billing_search", $data); 
    }
    

public function search_clients(){
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
$this->load->view("pos/search/search_clients", $data); 

}


public function search_result(){
$id_admin=$this->input->get("id");
$pg_config['sql'] = $this->data->get_sql('final_order',array('id_customer'=>$id_admin),'id','DESC');
        $pg_config['per_page'] = 50;
        $data = $this->lib_pagination->create_pagination($pg_config);
        $this->load->view("pos/search/search_result", $data); 
    }

            public function clients_search(){
        $end_time=$this->input->post('end_time');
		$start_time=$this->input->post('start_time');

			$array="";
			if($start_time!=""){
$data['result']=$this->db->get_where("limit_payment",
array("DATE_FORMAT(date,'%Y-%m-%d')>="=>$start_time))->result();
}
if($end_time!=""){
$data['result']=$this->db->get_where("limit_payment",
array("DATE_FORMAT(date,'%Y-%m-%d')<="=>$end_time))->result();	    
	}
if($end_time!=""&&$start_time!=""){
$data['result']=$this->db->get_where("limit_payment",
array("DATE_FORMAT(date,'%Y-%m-%d')<="=>$end_time,"DATE_FORMAT(date,'%Y-%m-%d')>="=>$start_time))->result();	
//echo count($data['result']);
	}
if($end_time==""&&$start_time==""){
 redirect(base_url().'pos/search/search','refresh');
}
$this->load->view("pos/search/clients_search", $data); 
    }
    
    
public function inventory_search(){
$end_time=$this->input->post('end_time');
$start_time=$this->input->post('start_time');
$array="date as ids,id_meal as id_meal,total_price as total_price ,qty as qty";

if($start_time!=""){
$pg_config['sql'] =$this->data->get_sql_groupby('order_data',array("DATE_FORMAT(date,'%Y-%m-%d')>="=>$start_time),'date','desc',
$array,"id_meal");

}
if($end_time!=""){
$pg_config['sql'] =$this->data->get_sql_groupby('order_data',array("DATE_FORMAT(date,'%Y-%m-%d')<="=>$end_time),'date','desc',
$array,"id_meal");
}

if($end_time!=""&&$start_time!=""){
    $pg_config['sql'] =$this->data->get_sql_groupby('order_data',array("DATE_FORMAT(date,'%Y-%m-%d')<="=>$end_time,"DATE_FORMAT(date,'%Y-%m-%d')>="=>$start_time),'date','desc',
$array,"id_meal");
	
    }
    
if($end_time==""&&$start_time==""){
redirect(base_url().'pos/search/inventory','refresh');
}
$pg_config['per_page'] = 50;
 $data = $this->lib_pagination->create_pagination($pg_config);
$this->load->view("pos/search/inventory_search", $data); 

}

    
public function billing_details(){
$id_admin=$this->input->get("id");
$pg_config['sql'] = $this->data->get_sql('order_data',array('order_id'=>$id_admin),'id','DESC');
        $pg_config['per_page'] = 50;
        $data = $this->lib_pagination->create_pagination($pg_config);
        $this->load->view("pos/search/billing_details", $data); 
    }

/*********************************************************************** *////

}

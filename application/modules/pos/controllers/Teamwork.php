<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teamwork extends MX_Controller
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
//echo $controller_curt;
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
		$pg_config['sql'] = $this->data->get_sql('team_work','','id','DESC');
        $pg_config['per_page'] = 50;
        $data = $this->lib_pagination->create_pagination($pg_config);
        $this->load->view("pos/teamwork/teamwork", $data); 
    }

    public function teamwork(){
        $pg_config['sql'] = $this->data->get_sql('team_work','','id','DESC');
        $pg_config['per_page'] = 50;
        $data = $this->lib_pagination->create_pagination($pg_config);
        $this->load->view("pos/teamwork/teamwork", $data); 
    }


    public function add_teamwork(){
        $this->load->view("pos/teamwork/add_teamwork"); 
    }
  
    
    public function product_action(){
		$user_category=$this->input->post('user_category');
			$code=$this->input->post('code');
				$phone=$this->input->post('special_code');
					$id_cat=$this->input->post('id_cat');
        $data['title'] = $user_category;
        $data['code'] = $code;
        $data['specail_code'] = $phone;
        $data['id_customer'] = $id_cat;
        $data['creation_date'] = date("Y-m-d H:i");
        
        $this->db->insert('team_work',$data);
        $id = $this->db->insert_id();
        $this->session->set_flashdata('msg', 'تم الاضافة بنجاح');
       redirect(base_url().'pos/teamwork/teamwork','refresh');
    }

    public function delete_teamwork(){
        $id_blog = $this->input->get('id_type');
        $check=$this->input->post('check');

        if($id_blog!=""){
        $ret_value=$this->data->delete_table_row('team_work',array('id'=>$id_blog)); 
        }
     
        if(isset($check) && $check!=""){  
        $check=$this->input->post('check');
        $length=count($check);
        for($i=0;$i<$length;$i++){
        $ret_value=$this->data->delete_table_row('team_work',array('id'=>$check[$i]));    
        }
        }

        $this->session->set_flashdata('msg', 'تم الحذف بنجاح');
        redirect(base_url().'pos/teamwork/teamwork','refresh');
    }

    function check_view_teamwork(){
        $id = $this->input->post("id");
        $ser = $this->db->get_where("team_work",array("id"=>$id,"view" => "1"))->num_rows();
        if ($ser == 1) {
            $this->db->update("team_work",array("view" => "0"),array("id"=>$id));
            echo "0";
        }
        if ($ser == 0) {
            $this->db->update("team_work",array("view" => "1"),array("id"=>$id));
            echo "1";
        } 
    }

    public function update_teamwork(){
        $id=$this->input->get('id_type');
        $data['data'] = $this->data->get_table_data('team_work',array('id'=>$id));
        $this->load->view("pos/teamwork/update_teamwork",$data); 
    }
    

    

    function edit_action(){
		$title=$this->input->post('title');
		$id_cat=$this->input->post('id_cat');
		$id = $this->input->post('id');
        $data['title'] = $title;
		$this->data->edit_table_id('team_work',array('id'=>$id),$data);
		if($id_cat!=""){
		 $datac['id_customer'] = $id_cat;
		$this->data->edit_table_id('team_work',array('id'=>$id),$datac);
   
		}
        $this->session->set_flashdata('msg', 'تم التعديل بنجاح');
        redirect(base_url().'pos/teamwork/','refresh');
	}
    

///this is for customer functions:view,add,delete,check_phone,change_phone

    public function customers(){
        $pg_config['sql'] = $this->data->get_sql('clients','','id','DESC');
        $pg_config['per_page'] = 50;
        $data = $this->lib_pagination->create_pagination($pg_config);
        $this->load->view("pos/teamwork/customers", $data); 
    }

    public function add_customer(){
        $this->load->view("pos/teamwork/add_customer"); 
    }


    public function customer_action(){
        $name=$this->input->post('name');
        $discount=$this->input->post('discount');
        $max_times=$this->input->post('max_times');
        $max_clients=$this->input->post('max_clients');
        $max_period=$this->input->post('max_period');
        $max_orders=$this->input->post('max_orders');
        $max_money=$this->input->post('max_money');
        $min_money=$this->input->post('min_money');
        $max_discount=$this->input->post('max_discount');
        $limit=$this->input->post('limit');
        
        $data['limit_value'] = $limit;
        $data['name'] = $name;
        $data['discount'] = $discount;
        $data['max_times'] = $max_times;
        $data['max_clients'] = $max_clients;
        $data['period'] = $max_period;
        $data['total_money'] = $max_money;
        $data['discount_clients'] = $max_discount;
        $data['max_orders'] = $max_orders;
        $data['min_price'] = $min_money;
        $this->db->insert('clients',$data);
        $id = $this->db->insert_id();
        $this->session->set_flashdata('msg', 'تم الاضافة بنجاح');
       redirect(base_url().'pos/teamwork/customers','refresh');
    
    }



    public function update_customer(){
        $id=$this->input->get('id_type');
        $data['data'] = $this->data->get_table_data('clients',array('id'=>$id));
        $this->load->view("pos/teamwork/update_customer",$data); 
    }

    public function update_phone(){
        $id=$this->input->get('id_type');
        $data['data'] = $this->data->get_table_data('team_work',array('id'=>$id));
        $this->load->view("pos/teamwork/update_phone",$data); 
    }
    function update_action(){
        $name=$this->input->post('name');
        $discount=$this->input->post('discount');
        $max_times=$this->input->post('max_times');
        $max_clients=$this->input->post('max_clients');
        $max_period=$this->input->post('max_period');
        $max_orders=$this->input->post('max_orders');
        $max_money=$this->input->post('max_money');
        $min_money=$this->input->post('min_money');
         $max_discount=$this->input->post('max_discount');
                $limit=$this->input->post('limit');
        
       
        $id=$this->input->post('id');
         $data['limit_value'] = $limit;
        $data['name'] = $name;
        $data['discount'] = $discount;
        $data['max_times'] = $max_times;
        $data['max_clients'] = $max_clients;
        $data['period'] = $max_period;
        $data['max_orders'] = $max_orders;
        $data['total_money'] = $max_money;
        $data['min_price'] = $min_money;
          $data['discount_clients'] = $max_discount;
        
        $this->db->update('clients',$data,array('id'=>$id));
        $this->session->set_flashdata('msg', 'تم الاضافة بنجاح');
       redirect(base_url().'pos/teamwork/customers','refresh');

	}
    



    function phone_action(){
        $phone=$this->input->post('phone');
        $id=$this->input->post('id');
        $data['phone'] = $phone;
        $this->db->update('team_work',$data,array('id'=>$id));
        $this->session->set_flashdata('msg', 'تم الاضافة بنجاح');
       redirect(base_url().'pos/teamwork/teamwork','refresh');

    }
    
    public  function search_username(){
        $phone=$this->input->post('phone');
        $sql=$this->db->get_where('team_work',array('view'=>'1','code'=>$phone))->result();
        if(count($sql)>0){
        foreach($sql as $sql){
        $user_code=$sql->title;
       
        }
    }
        
        echo json_encode($user_code);    
    
    }


 public  function special_code_username(){
        $phone=$this->input->post('phone');
        $sql=$this->db->get_where('team_work',array('view'=>'1','specail_code'=>$phone))->result();
        if(count($sql)>0){
        foreach($sql as $sql){
        $user_code=$sql->title;
       
        }
    }
        
        echo json_encode($user_code);    
    
    }

    

 public  function changelimit_username(){
$special_code=$this->input->post('special_code_value');
$special_code=1009;
$id_customer=get_table_filed("team_work",array("specail_code"=>$special_code),"id");
$type_customer=get_table_filed("team_work",array("id"=>$id_customer),"id_customer");
$main_limit_value=get_table_filed("clients",array("id"=>$type_customer),"limit_value");
$limit_value=get_table_filed("team_work",array("id"=>$id_customer),"limit_value");
if($limit_value<$main_limit_value){echo json_encode(1);}
else {echo json_encode(2);}
    }


//client search result
    public function client_search(){
        $phone=$this->input->get("username");
        $pg_config['sql'] = $this->data->get_sql('clients',array('phone'=>$phone),'id','DESC');
        $pg_config['per_page'] = 50;
        $data = $this->lib_pagination->create_pagination($pg_config);
        $this->load->view("pos/teamwork/client_search", $data); 
    }
    /*********************************************************************** *////

public function check_mobile(){
	$mobile = $this->input->post('mobile');	
	$id_jobseeker = $this->data->get_table_row('team_work',array('phone'=>$mobile),'id');
	if($id_jobseeker>0){
	$exite=1 ; 
	}
	else{
	$exite=0;
	}
	echo json_encode ($exite) ; 
    }
    
    function check_view_customer(){
        $id = $this->input->post("id");
        $ser = $this->db->get_where("clients",array("id"=>$id,"view" => "1"))->num_rows();
        if ($ser == 1) {
            $this->db->update("clients",array("view" => "0"),array("id"=>$id));
            echo "0";
        }
        if ($ser == 0) {
            $this->db->update("clients",array("view" => "1"),array("id"=>$id));
            echo "1";
        } 
    }

    public function delete_customer(){
        $id_blog = $this->input->get('id_type');
        $check=$this->input->post('check');

        if($id_blog!=""){
        $ret_value=$this->data->delete_table_row('clients',array('id'=>$id_blog)); 
        }
     
        if(isset($check) && $check!=""){  
        $check=$this->input->post('check');
        $length=count($check);
        for($i=0;$i<$length;$i++){
        $ret_value=$this->data->delete_table_row('clients',array('id'=>$check[$i]));    
        }
        }

        $this->session->set_flashdata('msg', 'تم الحذف بنجاح');
        redirect(base_url().'pos/teamwork/customers','refresh');
    }

}

<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends MX_Controller

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
        $this->load->library('Pdf');
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
 $newdata = array('lang'  => 'english');
$this->session->set_userdata($newdata);
}
if($curt_id!=""){
redirect(DIR."pos/".$controller_curt."/".$curt_sub."/".$curt_id);
}
else {
redirect(DIR."pos/".$controller_curt."/".$curt_sub);    
}
}

public function gen_random_string(){
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

public function Meals(){
        $pg_config['sql'] = $this->data->get_sql('product',array('view'=>'1',"min_amount>"=>0),'id','DESC');
        $pg_config['per_page'] = 50;
        $data = $this->lib_pagination->create_pagination($pg_config);
        $this->load->view("pos/orders/meals", $data); 

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
$creation_date=date("Y-m-y");
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



public function insert_order($id_clients=null,$check){
for($i=0;$i<$length;$i++){
            $qty= $this->input->post('value'.$check[$i]);
            $id_orders= $check[$i];
            $price=get_tab_row('product',array('id'=>$check[$i]),'price');
            $discount=get_tab_row('product',array('id'=>$check[$i]),'offers');
            if($discount!=""){
                $main_price=($price-(round(($price*$discount)/100)));
            }
            else {
             $main_price=$price;
            }

            if($id_order!=""){
            $total_price=$main_price*$qty;
            $order_meal['qty']=$qty;
            $order_meal['order_id']=$id_order;
            $order_meal['main_price']=$main_price;
            $order_meal['total_price']=$total_price;
            $order_meal['date']=date("Y-m-d H:i") ;
            $order_meal['id_meal']=$check[$i];
            $this->db->insert("order_data",$order_meal);
            }
                 }
}
public function register_customer($phone,$name=null){
if($name!=""){
$client_data['title']= $name;        
    }

$code=get_rondam_code();
$client_data['phone']=$phone;
$client_data['code']= $code;
$client_data['creation_date']=date("Y-m-d H:i");
$this->db->insert("team_work",$client_data);  
return $code;
}

public function get_ordercode(){
$ordercode=$this->db->order_by('id','desc')->limit(1)->get_where('final_order')->result();
if(count($ordercode)>0){
foreach($ordercode as $ordercode)
if(date("Y-m-d")>$ordercode->date){
$new_serail=str_pad("0001", 4, '0', STR_PAD_LEFT); //to add 00 in left of int
}

else {
 $serail=++$ordercode->order_code;
$new_serail=str_pad($serail, 4, '0', STR_PAD_LEFT);//to add 00 in left of int  
}
}
else {
$new_serail=str_pad("0001", 4, '0', STR_PAD_LEFT); //to add 00 in left of int
}
return $new_serail;
}


public function add_order(){
$code=$this->input->post('code');
$special_code=$this->input->post('special_code');
$service=get_tab_row('site_info',array('id'=>'1'),'service_value');
$taxi=get_tab_row('site_info',array('id'=>'1'),'taxi');
$check=$this->input->post('check');
$total_price=0;
/*******************************************************
First case for user with no,code and not registered
**********************************************************/

if($code==""&&$special_code==""){
        if(isset($check) && $check!=""){ 
            $length=count($check);
        for($i=0;$i<$length;$i++){
        $qty= $this->input->post('value'.$check[$i]);
        $id_orders= $check[$i];
        $price=get_tab_row('product',array('id'=>$id_orders),'price');
        $discount=get_tab_row('product',array('id'=>$id_orders),'offers');
        if($discount!=""){
        $main_price=($price-(round(($price*$discount)/100)))*$qty;
        }
        else {
        $main_price=$price*$qty;
        }
        $total_price=$main_price+ $total_price;
        }        
        }
        $order_details['date']=date("Y-m-d H:i");
        $order_details['subtotal_price']=$total_price;
        $final_price=$total_price;
        if($taxi!=""){
            $final_price=$final_price+ceil(($total_price*$taxi)/100);
        }
        if($service!=""){
            $final_price=$final_price+$service;
        }
        $order_details['total_price']=$final_price;
        $order_details['taxi']=$taxi;
        $order_details['service']=$service;
        $order_details['order_code']=$this->get_ordercode(); ;
        $order_details['date_code']="PO".date("y").date("m");
        $order_details['order_day']=date("d");
        $order_details['id_admin']=$this->session->userdata("id_admin");
     $this->db->insert("final_order",$order_details);
        $id_order = $this->db->insert_id();
        /*****************************Create order**/
          for($i=0;$i<$length;$i++){
            $qty= $this->input->post('value'.$check[$i]);
            $id_orders= $check[$i];
$price=get_table_filed('product',array('id'=>$check[$i]),'price');
$discount=get_table_filed('product',array('id'=>$check[$i]),'offers');
$min_amount=get_table_filed('product',array('id'=>$check[$i]),'min_amount');
$discount_value=get_table_filed('product',array('id'=>$check[$i]),'offers');


 if($discount!=""){
$main_price=($price-(round(($price*$discount)/100)));
}
else {$main_price=$price;}
            if($id_order!=""){
            if($min_amount>=$qty){
            $total_price=$main_price*$qty;
            $order_meal['qty']=$qty;
            $order_meal['order_id']=$id_order;
            $order_meal['main_price']=$price;
            $order_meal['total_price']=$total_price;
            $order_meal['date']=date("Y-m-d H:i") ;
            $order_meal['id_meal']=$check[$i];
            $order_meal['Product_discount']=$discount_value;
           $this->db->insert("order_data",$order_meal);
            $meal_data['min_amount']=$min_amount-$qty;
            $this->db->update("product",$meal_data,array("id"=>$check[$i]));
            }
            }
}
}
/**************************************END First CASE**********************/

/***********************************Start Second CASE**********************/


if($code!=""&&$special_code==""){

$id_customer=get_table_filed('team_work',array('code'=>$code),'id');
$type_customer=get_table_filed('team_work',array('id'=>$id_customer),'id_customer');
$min_price=get_table_filed('clients',array('id'=>$type_customer),'min_price');
$discount_clients=get_table_filed('clients',array('id'=>$type_customer),'discount_clients');
$count_clients=get_table_filed('team_work',array('id'=>$id_customer),'count_clients');
    

if(isset($check) && $check!=""){ 
            $length=count($check);
        for($i=0;$i<$length;$i++){
        $qty= $this->input->post('value'.$check[$i]);
        $id_orders= $check[$i];
        $price=get_tab_row('product',array('id'=>$id_orders),'price');
        $discount=get_tab_row('product',array('id'=>$id_orders),'offers');
        if($discount!=""){
        $main_price=($price-(round(($price*$discount)/100)))*$qty;
        }
        else {
        $main_price=$price*$qty;
        }
        $total_price=$main_price+ $total_price;

        }  
        }
 $order_data=$this->db->get_where("final_order",array('view'=>'0','id_customer'=>$id_customer))->result();
if(count($order_data)==0){
        $order_details['date']=date("Y-m-d");
        $order_details['time_h']=date("H:i");
        
        $order_details['subtotal_price']=$total_price;
        $final_price=$total_price;
        if($taxi!=""){
            $final_price=$final_price+ceil(($total_price*$taxi)/100);
        }
        if($service!=""){
            $final_price=$final_price+$service;
        }
        if($discount_clients!=""){
           $total_price_code=ceil(($final_price*$discount_clients)/100);
            $final_price=$final_price-ceil(($final_price*$discount_clients)/100);
        }

           
        $order_details['total_price']=$final_price;
        $order_details['taxi']=$taxi;
        $order_details['service']=$service;
        $order_details['order_code']=$this->get_ordercode(); ;
        $order_details['date_code']="PO".date("y").date("m");
        $order_details['order_day']=date("d");
        $order_details['id_customer']=$id_customer;
         $order_details['id_admin']=$this->session->userdata("id_admin");
         if($final_price>$min_price){
         $order_details['discount_total']=$discount_clients;
         $order_details['total_price_code']=$total_price_code;
         $finalcount_clients=$count_clients+1;
         $data_count_data['count_clients']=$finalcount_clients;
     $this->db->update("team_work",$data_count_data,array('id'=>$id_customer));
         }
  $this->db->insert("final_order",$order_details);
        $id_order = $this->db->insert_id();
        }
        
        /*****************************Create order**/
          for($i=0;$i<$length;$i++){
            $qty= $this->input->post('value'.$check[$i]);
            $id_orders= $check[$i];
$price=get_tab_row('product',array('id'=>$check[$i]),'price');
$discount=get_tab_row('product',array('id'=>$check[$i]),'offers');
$min_amount=get_tab_row('product',array('id'=>$check[$i]),'min_amount');
$discount_value=get_tab_row('product',array('id'=>$check[$i]),'offers');
 if($discount!=""){
$main_price=($price-(round(($price*$discount)/100)));
}
else {$main_price=$price;}
            if($id_order!=""){
            if($min_amount>=$qty){
            $total_price=$main_price*$qty;
            $order_meal['qty']=$qty;
            $order_meal['order_id']=$id_order;
            $order_meal['main_price']=$price;
            $order_meal['total_price']=$total_price;
            $order_meal['date']=date("Y-m-d H:i") ;
            $order_meal['id_meal']=$check[$i];
            $order_meal['Product_discount']=$discount_value;
           $this->db->insert("order_data",$order_meal);
            $meal_data['min_amount']=$min_amount-$qty;
            $this->db->update("product",$meal_data,array("id"=>$check[$i]));
            }
            }
}
}
/**************************************END Second CASE**********************/







/***********************************Start Third CASE**********************/


if($special_code!=""){

$id_customer=get_table_filed('team_work',array('specail_code'=>$special_code),'id');
$Paying_installments=$this->input->post('Paying_installments');
$type_customer=get_table_filed('team_work',array('id'=>$id_customer),'id_customer');
$min_price=get_table_filed('clients',array('id'=>$type_customer),'min_price');
$discount_clients=get_table_filed('clients',array('id'=>$type_customer),'discount');
$main_limit_value=get_table_filed('clients',array('id'=>$type_customer),'limit_value');
$limit_value=get_table_filed('team_work',array('id'=>$id_customer),'limit_value');
$mywallet=get_table_filed('team_work',array('id'=>$id_customer),'mywallet');


if(isset($check) && $check!=""){ 
            $length=count($check);
        for($i=0;$i<$length;$i++){
        $qty= $this->input->post('value'.$check[$i]);
        $id_orders= $check[$i];
        $price=get_tab_row('product',array('id'=>$id_orders),'price');
        $discount=get_tab_row('product',array('id'=>$id_orders),'offers');
        if($discount!=""){
        $main_price=($price-(round(($price*$discount)/100)))*$qty;
        }
        else {
        $main_price=$price*$qty;
        }
        $total_price=$main_price+ $total_price;

        }  
        }
        
 $order_data=$this->db->get_where("final_order",array('view'=>'0','id_customer'=>$id_customer))->result();
if(count($order_data)==0){
$order_details['id_client']=$id_customer;
        $order_details['date']=date("Y-m-d");
        $order_details['time_h']=date("H:i");
        
        $order_details['subtotal_price']=$total_price;
        $final_price=$total_price;
        if($taxi!=""){
            $final_price=$final_price+ceil(($total_price*$taxi)/100);
        }
        if($service!=""){
            $final_price=$final_price+$service;
        }
       
       $mai_v=1;

        if($mywallet!=""&&$mywallet!=0){
            if($final_price>=$mywallet){ $final_price=$final_price-$mywallet;$main_data_myw['mywallet']=0;}
            else if($final_price<$mywallet){$final_price=$mywallet-$final_price; $main_data_myw['mywallet']=$final_price;$final_price=0;}
            $this->db->update('team_work',$main_data_myw,array('id'=>$id_customer));
       $mai_v=2;
        } 
         if($discount_clients!=""){
           $total_price_code=ceil(($final_price*$discount_clients)/100);
            $final_price=$final_price-ceil(($final_price*$discount_clients)/100);
        }
        if($final_price!=0&&$Paying_installments==1&&$mai_v==1){
            $limit_value=$limit_value+$final_price;
            if($limit_value<=$main_limit_value){
                $limit_value_data['limit_value']=$limit_value;
                $this->db->update('team_work',$limit_value_data,array('id'=>$id_customer));
                
            }
            else {
             $this->session->set_flashdata('msg', 'We apologize for not executing your order as the cost  is greater than the limit');
redirect(base_url()."pos/orders/Meals",'refresh');   
            }
                $order_data_limit['id_client']=$id_customer;
                $order_data_limit['value_limit']=$final_price;
                $order_data_limit['date']=date("Y-d-m");;
                  $this->db->insert("limit_payment",$order_data_limit);
           
        }
        $order_details['total_price']=$final_price;
        $order_details['taxi']=$taxi;
        $order_details['service']=$service;
        $order_details['order_code']=$this->get_ordercode(); ;
        $order_details['date_code']="PO".date("y").date("m");
        $order_details['order_day']=date("d");
        $order_details['id_customer']=$id_customer;
         $order_details['id_admin']=$this->session->userdata("id_admin");
         if($mai_v==1){
         $order_details['discount_total']=$discount_clients;
         $order_details['total_price_code']=$total_price_code;
         }
  $this->db->insert("final_order",$order_details);
        $id_order = $this->db->insert_id();
        }
        
        /*****************************Create order**/
          for($i=0;$i<$length;$i++){
            $qty= $this->input->post('value'.$check[$i]);
            $id_orders= $check[$i];
$price=get_tab_row('product',array('id'=>$check[$i]),'price');
$discount=get_tab_row('product',array('id'=>$check[$i]),'offers');
$min_amount=get_tab_row('product',array('id'=>$check[$i]),'min_amount');
$discount_value=get_tab_row('product',array('id'=>$check[$i]),'offers');
 if($discount!=""){
$main_price=($price-(round(($price*$discount)/100)));
}
else {$main_price=$price;}
            if($id_order!=""){
            if($min_amount>=$qty){
            $total_price=$main_price*$qty;
            $order_meal['qty']=$qty;
            $order_meal['order_id']=$id_order;
            $order_meal['main_price']=$price;
            $order_meal['total_price']=$total_price;
            $order_meal['date']=date("Y-m-d H:i") ;
            $order_meal['id_meal']=$check[$i];
            $order_meal['Product_discount']=$discount_value;
           $this->db->insert("order_data",$order_meal);
            $meal_data['min_amount']=$min_amount-$qty;
            $this->db->update("product",$meal_data,array("id"=>$check[$i]));
            }
            }
}
}
/**************************************END Third CASE**********************/

$this->session->set_flashdata('msg', 'تم تسجيل الطلب بنجاح');
redirect(base_url()."pos/orders/pricelist?id_order=$id_order",'refresh');

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



    

    

    public function pricelist(){
 $id=$this->input->get('id_order');
$data['data'] = $this->data->get_table_data('final_order',array('id'=>$id));
$data['meals'] = $this->data->get_table_data('order_data',array('order_id'=>$id));
$this->load->view("pos/orders/pricelist",$data); 
 }
 
public function print_pdf(){
$this->session->userdata('lang');
if($this->session->userdata('lang')==""){
$this->session->set_userdata(array('lang'=>'arabic'));
}   
//echo $this->session->userdata('lang');;
 $id=$this->input->get('id_order');
 $main_data['view']='1';
 $this->db->update("final_order",$main_data,array("id"=>$id));
$data['data'] = $this->data->get_table_data('final_order',array('id'=>$id));
$data['meals'] = $this->data->get_table_data('order_data',array('order_id'=>$id));
$data['meals_second'] = $this->data->get_table_data('order_data',array('order_id'=>$id));
$this->load->view("pos/orders/print_pdf",$data); 
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

	
public function delete_order(){
$ordercode = $this->input->get('ordercode');
if($ordercode!=""){
$order_data=$this->data->delete_table_row('order_data',array('order_id'=>$ordercode));
$final_order=$this->data->delete_table_row('final_order',array('id'=>$ordercode));
}
$this->session->set_flashdata("msg","Successfully Deleted");
redirect(base_url().'pos/orders','refresh');
}
/*********************************************************************** *////
}


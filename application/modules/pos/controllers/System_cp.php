<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class System_cp extends MX_Controller {
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

    

/****Gen_Random_String***********************************************/

public function gen_random_string()

{
$chars ="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";//length:36
$final_rand='';
for($i=0;$i<4; $i++) {
 $final_rand .= $chars[ rand(0,strlen($chars)-1)];
    }
return $final_rand;
}

/**** END Gen_Random_String**********************************************/

public function index(){
	$day_d=date('d');
$month_d=date('m'); 
$year_d=date('Y'); 
// echo $year_d;
$id_pharmacy=$this->session->userdata('id_pharmacy');

 $this->data = array( 
 'total_visitor'=> $this->db->get_where('visiting',array('day_t'=>$day_d,'month_d'=>$month_d,'year_d'=>$year_d))->result(),
 'total_final'=> $this->db->get_where('visiting')->result(),
 'num_product'=> $this->data->get_table_data('pharmaceutical',array('id_pharmacy'=>$id_pharmacy)),
 'num_offers'=> $this->data->get_table_data('category',array('view'=>'1')));
$this->load->view('home',$this->data);

}

public function home(){
$this->load->view('home');
}
public function about_page(){
$this->data = array(
'mainpage'=> $this->data->get_table_data('site_info'));	
$this->load->view('about_page',$this->data);
}


public function login(){
$this->load->view('pos/login');
}





public function user_profile(){
  if($this->session->userdata['id_admin']!=""){
  $id_admin=$this->session->userdata['id_admin'];;
  
   $id_pharmacy=$this->session->userdata("id_pharmacy");
$this->data = array(
'pharmacy_setting'=>$this->data->get_table_data('pharmacy_setting',array('id_pharmacy'=>$id_pharmacy)),
'data_admin'=>$this->data->get_table_data('onwer_pharamcy',array('id'=>$id_admin)));
 $this->load->view('pos/user_profile',$this->data);
}
else {
  redirect(base_url().'pos/system_cp/login', 'refresh'); 
}
    }


public function about_profile(){
  $id_admin=$this->session->userdata['id_admin'];
  $id=$this->input->post('id');
  $name=$this->input->post('name');
  $pharmacy_phone=$this->input->post('pharmacy_phone');
  $pharmacy_email=$this->input->post('pharmacy_email');
  $pharmacy_about=$this->input->post('pharmacy_about');

  $data['name']=$name;
  $data['about']=$pharmacy_about;
  $data['phone']=$pharmacy_phone;
  $data['email']=$pharmacy_email;
  $res_result=$this->data->edit_table('pharmacy_setting',$id,$data);
  
if(isset($_FILES['pharmacy_img']['name'])){
    echo $_FILES['pharmacy_img']['name'];
$file=$_FILES['pharmacy_img']['name'];
$file_name="pharmacy_img";

    
     $logo = $this->data->get_table_row('pharmacy_setting',array('id'=>$id_admin),'logo'); 
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
  if (!$this->upload->do_upload('pharmacy_img')){
  echo $this->upload->display_errors();
   }
  else {
  $url= $_FILES['pharmacy_img']['name'];
  $ext = explode(".",$url);
  $file_extension = end($ext);
  $data = array('logo'=>$imagename.".".$file_extension);
  $this->db->update('pharmacy_setting',$data,array('id'=>$id));
  }
    
}           
  
  $this->session->set_flashdata('msg',lang("data_updated"));
 redirect(base_url().'pos/system_cp/user_profile', 'refresh'); 
}


public function update_profile(){
  $id_admin=$this->session->userdata['id_admin'];
  $fname=$this->input->post('name');
  $phone=$this->input->post('phone');
  $email=$this->input->post('email');
  $this->session->set_userdata(array('admin_name' => $fname));
  $data['name']=$fname;
  $data['email']=$email;
  $data['phone']=$phone;
  $res_result=$this->data->edit_table('onwer_pharamcy',$id_admin,$data);
  $this->session->set_flashdata('msg',lang("data_updated"));
  redirect(base_url().'pos/system_cp/user_profile', 'refresh'); 
}

public function profileimg(){
  $id_admin=$this->session->userdata['id_admin'];
//echo $_FILES['file']['name'];
if($_FILES['file']['name']!=""){

  $logo = $this->data->get_table_row('onwer_pharamcy',array('id'=>$id_admin),'img'); 
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
  $data = array('img'=>$imagename.".".$file_extension);
  $this->db->update('onwer_pharamcy',$data,array('id'=>$id_admin));
  $myimg =$this->data->get_table_row('onwer_pharamcy',array('id'=>$id_admin),'img');
 $this->session->set_userdata(array('myimg' => $myimg));
  $this->session->set_flashdata('msg',lang("data_updated"));
$this->session->mark_as_flash('msg'); 
redirect(base_url().'pos/system_cp/user_profile', 'refresh'); 


    }
  
    }

  }
  
  
public function logout(){
session_destroy();
$this->load->view('pos/logout');
}

    public function sendpassword($mail)
    {
      $this->load->library('email');
      $email = $mail;
      $findemail = $this->data->get_table_row('onwer_pharamcy',array('email'=>$email),'id');
      $name = $this->data->get_table_row('onwer_pharamcy',array('email'=>$email),'name');
      //echo $findemail;die;
      if (count((array)$findemail)>0)
        {
          $passwordplain = "";
          $passwordplain  = $this->gen_random_string();
          $newpass = md5($passwordplain);
          $data = array('password'=>$newpass);
          $this->data->edit_table('onwer_pharamcy',$findemail,$data);
          $subject = 'Your Reset Password';
          $mail_message='Dear '.$name.','. "\r\n";
          $mail_message.='Thanks for contacting regarding to forgot password,<br> Your New <b>Password</b> is <b>'.$passwordplain.'</b>'."\r\n";
          $mail_message.='<br>Please Update your password.';
          $mail_message.='<br>Thanks & Regards';
          $mail_message.='<br>Dmitry.com';
          $message = $mail_message;
          $body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
          <html xmlns="http://www.w3.org/1999/xhtml">
          <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
              
              <title>' . html_escape($subject) . '</title>
              <style type="text/css">
                  body {
                      font-family: Arial, Verdana, Helvetica, sans-serif;
                      font-size: 16px;
                  }
              </style>
          </head>
          <body>
          ' . $message . '
          </body>
          </html>';
          $result = $this->email
        ->from('info@roshatat.com')
        ->reply_to('info@roshatat.com')    // Optional, an account where a human being reads.
        ->to($email)
        ->subject($subject)
        ->message($body)
        ->send();
    
        //var_dump($result);
        if($result==true){
			unset($_SESSION['msg']);
			$this->session->set_flashdata('msg','Password sent to your email!');
			redirect(base_url().'pos/system_cp/login','refresh');
        }else{
			unset($_SESSION['msg']);
			$this->session->set_flashdata('msg','Failed to send password, please try again!');
			redirect(base_url().'pos/system_cp/login','refresh');
        }
        //echo $this->email->print_debugger();
        }
        else
        {
			unset($_SESSION['msg']);
			$this->session->set_flashdata('msg','Email not found try again!');
			redirect(base_url().'pos/System_cp/login','refresh');
        }
    }
        
    
    public function ForgotPassword()
    {
      $email = $this->input->post('email');      
      $findemail = $this->data->get_table_row('admin',array('mail'=>$email),'mail');
      if($findemail){
      $this->sendpassword($findemail);        
      }else{
      $this->load->helper('url');
      $this->session->set_flashdata('msg','Email not found!');
      redirect(base_url().'pos/system_cp/login','refresh');
      }
    }

public function submit_login(){
$dd=base_url();
ob_start();
$username = $this->security->sanitize_filename($this->input->post('user_name'),true);
$password = $this->security->sanitize_filename($this->input->post('password'),true);
$passwordp=md5($password);
 $customer_id="";
$customer_id = $this->data->get_table_row('onwer_pharamcy',array('phone'=>$username,'password'=>$passwordp,'view'=>'1','Validity!='=>'0'),'id');

if($customer_id != ""){
$id_pharmacy=get_table_filed("onwer_pharamcy",array('id'=>$customer_id),"pharmacy_id");

$name_pharmacy=get_table_filed("pharmacy_setting",array('id_pharmacy'=>$id_pharmacy),"name");
$logo_pharmacy=get_table_filed("pharmacy_setting",array('id_pharmacy'=>$id_pharmacy),"logo");
$about_pharmacy=get_table_filed("pharmacy_setting",array('id_pharmacy'=>$id_pharmacy),"about");
$phone_pharmacy=get_table_filed("pharmacy_setting",array('id_pharmacy'=>$id_pharmacy),"phone");
$email_pharmacy=get_table_filed("pharmacy_setting",array('id_pharmacy'=>$id_pharmacy),"email");

$site_name = $this->data->get_table_row('site_info',array(),'name_site_ar');
$site_favicon = $this->data->get_table_row('site_info',array(),'favicon');
$logo_site = $this->data->get_table_row('site_info',array(),'logo');


$username=get_table_filed("onwer_pharamcy",array('id'=>$customer_id),"name");
$type =$this->data->get_table_row('onwer_pharamcy',array('id'=>$customer_id),'type');
$last_login =$this->data->get_table_row('onwer_pharamcy',array('id'=>$customer_id),'last_login');
$myimg =$this->data->get_table_row('onwer_pharamcy',array('id'=>$customer_id),'img');
$mylang=$this->data->get_table_row('onwer_pharamcy',array('id'=>$customer_id),'lang');

$this->session->set_userdata(array('id_pharmacy' => $id_pharmacy));
$this->session->set_userdata(array('id_admin' => $customer_id));
$this->session->set_userdata(array('admin_name' => $username));
$this->session->set_userdata(array('type_admin' => $type));
$this->session->set_userdata(array('last_login' => $last_login));
$this->session->set_userdata(array('site_name' => $site_name));
$this->session->set_userdata(array('site_favicon' => $site_favicon));
$this->session->set_userdata(array('logo_site' => $logo_site));
$this->session->set_userdata(array('myimg' => $myimg));

$this->session->set_userdata(array('name_pharmacy' => $name_pharmacy));
$this->session->set_userdata(array('logo_pharmacy' => $logo_pharmacy));
$this->session->set_userdata(array('about_pharmacy' => $about_pharmacy));
$this->session->set_userdata(array('phone_pharmacy' => $phone_pharmacy));
$this->session->set_userdata(array('email_pharmacy' => $email_pharmacy));

if(isset($_SESSION['admin_name'])){
if($mylang==1){
$newdata = array('lang'=> 'english');
$this->session->set_userdata($newdata);    
}
else if($mylang==2){
$newdata = array('lang'  => 'arabic');
$this->session->set_userdata($newdata);
}
redirect(base_url().'pos/system_cp/','refresh');
          }
          }
else {
$this->session->set_flashdata('msg','كلمة السر او اسم المستخدم غير صحيح');
redirect(base_url().'pos/system_cp/login','refresh');
} 

}

public function team_work(){
$pg_config['sql'] = $this->data->get_sql('admin','','id','DESC');
$pg_config['per_page'] =15;
$data = $this->lib_pagination->create_pagination($pg_config);
$this->load->view("pos/admin/team_work", $data); 
  }





 public function add_admin(){
 $this->load->view('pos/admin/add_admin',$this->data);
    } 

  

public function update_admin(){
$this->load->view("pos/admin/update_admin");
    }



public function admin_action(){
  $mail=$this->input->post('mail');
  $username = $this->input->post('username');
  $fname=$this->input->post('fname');
  $lname=$this->input->post('lname');
  $phone=$this->input->post('phone');
  $permission=$this->input->post('permission');
  $password=$this->input->post('password');

  $this->form_validation->set_rules('username','اسم المستخدم','trim|required|is_unique[admin.username]');
	$this->form_validation->set_rules('fname','الإسم الأول','trim|required');
	$this->form_validation->set_rules('lname','الإسم الثاني','trim|required');
  $this->form_validation->set_rules('mail','البريد الالكتروني','trim|required|valid_email|is_unique[admin.mail]');
  $this->form_validation->set_rules('password','كلمة المرور','trim|required|min_length[6]');
  
  if ($this->form_validation->run()) {
  $data_inerest= array('password'=>md5($password),'type'=>$permission,'mail'=>$mail,'username'=>$username,'fname'=>$fname,'lname'=>$lname,'phone'=>$phone);
  $this->db->insert('admin',$data_inerest);  
  $insert_id = $this->db->insert_id();


  if($_FILES['file']['name']!=""){
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
   $data = array('img'=>$imagename.".".$file_extension);
   $this->db->update('admin',$data,array('id'=>$insert_id));
    //echo $this->db->last_query();
  //die();
     }
     }
     $this->session->set_flashdata('msg', 'Data added successfully');
     $this->session->mark_as_flash('msg');
     redirect('pos/system_cp/team_work', 'refresh');
  }
  $this->load->view('pos/admin/add_admin');
}

public function update_admin_action(){
 $id=$this->input->post('id');
 $mail=$this->input->post('mail');
 $username = $this->input->post('username');
 $fname=$this->input->post('fname');
 $lname=$this->input->post('lname');
 $phone=$this->input->post('phone');
 $permission=$this->input->post('permission');
 
 $password=$this->input->post('password');

 
 $data_inerest= array('mail'=>$mail,'username'=>$username,'fname'=>$fname,'lname'=>$lname,'phone'=>$phone);
 $this->data->edit_table('admin',$id,$data_inerest);  

 if($password!=""){
  $datapassword = array('password'=>md5($password));
 $this->data->edit_table('admin',$id,$datapassword);    
 }

 if($permission!=""){
 $datapermission= array('type'=>$permission);
 $this->data->edit_table('admin',$id,$datapermission);
 }


 if($_FILES['file']['name']!=""){


  $logo = $this->data->get_table_row('admin',array('id'=>$id),'img'); 
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
  $data = array('img'=>$imagename.".".$file_extension);
  $this->db->update('admin',$data,array('id'=>$id));
   //echo $this->db->last_query();
 //die();
    }
  
    }


$this->session->set_flashdata('msg', 'Data added successfully');
$this->session->mark_as_flash('msg');
redirect('/pos/system_cp/team_work', 'refresh');
 }

public function delete_admin(){
   $product_id = $this->input->get('id_type');
  //echo $product_id;
   $check=$this->input->post('check');
   if($product_id!=""){
   $ret_value=$this->data->delete_table_row('admin',array('id'=>$product_id)); 
   }

      if(isset($check)&&$check!=""){  
   $check=$this->input->post('check');
   $length=count($check);
   for($i=0;$i<$length;$i++){
   $ret_value=$this->data->delete_table_row('admin',array('id'=>$check[$i]));    
    }
   }
 
 $this->session->set_flashdata('msg', 'Data added successfully');
$this->session->mark_as_flash('msg');
 redirect('/admin/team_work?success', 'refresh');

  }

   public function check_view_teamwork(){    
    $id = $this->input->post("id");
    $ser = $this->db->get_where("admin",array("id"=>$id,"view" => "1"))->num_rows();
    if ($ser == 1) {
      $this->db->update("admin",array("view" => "0"),array("id"=>$id));
      echo "0";
    }
    if ($ser == 0) {
      $this->db->update("admin",array("view" => "1"),array("id"=>$id));
      echo "1";
    }    

  }   

/********************************************************************

*********************************************************************

*********************************************************************

******Gen_Random_String**********************************************/

public function setting(){

//$site_info=$this->db->get_where('site_info')->result();
$this->load->view('pos/setting');
  }

public function update_setting(){
$site_name_ar=$this->input->post('site_name_ar');
$site_name=$this->input->post('site_name');
$main_lang=$this->input->post('main_lang');
$service_value=$this->input->post('service_value');
$taxi=$this->input->post('taxi');


$data = array('name_site'=>$site_name,'name_site_ar'=>$site_name_ar,'service_value'=>$service_value,'taxi'=>$taxi);
$this->db->update('site_info',$data,array('id'=>1));
if($main_lang!=0){
 $id_admin=$this->session->userdata("id_admin");
$data_lang = array('lang'=>$main_lang);
$this->db->update('admin',$data_lang,array('id'=>$id_admin));    


if($main_lang==1){
$newdata = array('lang'=> 'english');
$this->session->set_userdata($newdata);    
}
else if($main_lang==2){
$newdata = array('lang'  => 'arabic');
$this->session->set_userdata($newdata);
}

}

if($_FILES['file']['name']!=""){
  $logo = $this->data->get_table_row('site_info',array('id'=>1),'logo'); 
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
  $data = array('logo'=>$imagename.".".$file_extension);
  $this->db->update('site_info',$data,array('id'=>1));

    }
  
    }



    if($_FILES['file1']['name']!=""){
      $logo = $this->data->get_table_row('site_info',array('id'=>1),'favicon'); 
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
      $data = array('favicon'=>$imagename.".".$file_extension);
      $this->db->update('site_info',$data,array('id'=>1));
        }
        }
$this->session->set_flashdata('msg', 'تم التعديل بنجاحٍ');
$this->session->mark_as_flash('msg');
redirect('/pos/system_cp/setting');
  }

/********************************************************************************************************
*********************************************************************************************************
*************************************************Start Notes Section*************************************
*********************************************************************************************************/

public function update_contact(){
$this->data = array(
'num_admin'=> $this->data->get_table_data('admin'),
'site_info'=> $this->data->get_table_data('site_info'),
'contact_info'=> $this->data->get_table_data('contact_info')
);
$this->load->view('contact/update_contact',$this->data);

}

/***************** START SLIDER **********************/
  public function slider_home(){
  $pg_config['sql'] = $this->data->get_sql('slider','','id','DESC');
  $pg_config['per_page'] =15;
  $data = $this->lib_pagination->create_pagination($pg_config);
  $this->load->view("admin/slider", $data); 
  }


   public function add_slider(){
$this->data = array(
'num_admin'=> $this->data->get_table_data('admin'),
'site_info'=> $this->data->get_table_data('site_info'));
$this->load->view('admin/add_slider',$this->data);
  }

public function slider_action(){
$title=$this->input->post('title');
$title_eng=$this->input->post('title_eng');
$description_ar=$this->input->post('description_ar');
$description_eng=$this->input->post('description_eng');
$link=$this->input->post('link');
$data['name'] = $title_eng;
$data['name_ar'] = $title;
$data['details_ar'] = $description_ar;
$data['details'] = $description_eng;
$data['link'] = $link;
$this->db->insert('slider',$data);
$this->session->set_flashdata('msg', 'تم الاضافة بنجاح');
redirect(base_url().'admin/slider_home','refresh');
}
 
  public function check_view_slider(){
  $id = $this->input->post("id");
  $ser = $this->db->get_where("slider",array("id"=>$id,"view" => "1"))->num_rows();
  if ($ser == 1) {
  $this->db->update("slider",array("view" => "0"),array("id"=>$id));
  echo "0";
  }
  if ($ser == 0) {
  $this->db->update("slider",array("view" => "1"),array("id"=>$id));
  echo "1";
        }      
    } 

public function delete_slider(){
$product_id = $this->input->get('id_type');
$check=$this->input->post('check');
if($product_id!=""){

$ret_value=$this->data->delete_table_row('slider',array('id'=>$product_id));
}
if(isset($check)&&$check!=""){  
  $check=$this->input->post('check');
  $length=count($check);
  for($i=0;$i<$length;$i++){
$ret_value=$this->data->delete_table_row('slider',array('id'=>$check[$i]));     
 }
 }
 $this->load->helper('url');
 $this->session->set_flashdata('msg', 'تم الحذف بنجاح');
 $this->session->mark_as_flash('msg');
 redirect('/admin/slider_home', 'refresh');
  }
  
    public function update_slider(){
		$id_slider=$this->input->get('id_type');
$this->data = array(
'num_admin'=> $this->data->get_table_data('admin'),
'site_info'=> $this->data->get_table_data('site_info'),
'silder_data'=> $this->data->get_table_data('slider',array('id'=>$id_slider)));

$this->load->view('admin/update_slider',$this->data);
  } 
  
  
 public function updateslider_action(){
$id=$this->input->post('id');
$title=$this->input->post('title');
$title_eng=$this->input->post('title_eng');
$description_ar=$this->input->post('description_ar');
$description_eng=$this->input->post('description_eng');
$link=$this->input->post('link');
$data['name'] = $title_eng;
$data['name_ar'] = $title;
$data['details_ar'] = $description_ar;
$data['details'] = $description_eng;
$data['link'] = $link;
  $this->db->update('slider',$data,array('id'=>$id));
   
$this->load->helper('url');
$this->session->set_flashdata('msg', 'تم تعديل الداتا بنجاح');
$this->session->mark_as_flash('msg');
redirect('/admin/slider_home', 'refresh');
  }
/********************************************************************/
/**************************************24-12-2017********************************/

/***************************************End 24-12-2017************************************************/
/***************************************Start 1-1-2018************************************************/


    public function updatecontact_action(){
      $address=$this->input->post('address');
			$address_ar=$this->input->post('address_ar');
			$map=$this->input->post('map');
			$Phone=$this->input->post('Phone');
			$email=$this->input->post('email');
      $data['address_ar'] = $address_ar;
			$data['address_eng'] = $address;
			$data['phone_sales'] = $Phone;
			$data['email_sales'] = $email;
			$data['map'] = $map;
			print_r($data);
			$this->db->update('contact_info',$data,array('id'=>1));
			$this->session->set_flashdata('msg', 'تم حفظ التغير المطلوب');
			$this->session->mark_as_flash('msg');
redirect('/admin/update_contact');
     
          }

/**********************************************End Country***************************************************/

public function messages(){
        $pg_config['sql'] = $this->data->get_sql('messages','','id_message','DESC');
        $pg_config['per_page'] = 10;
        $data = $this->lib_pagination->create_pagination($pg_config);
        $this->load->view("admin/messages/messages", $data); 
      }
   
			

			public function check_view_message(){
				$id = $this->input->post("id");
				$ser = $this->db->get_where("messages",array("id_message"=>$id,"view" => "1"))->num_rows();
				if ($ser == 1) {
				$this->db->update("messages",array("view" => "0"),array("id_message"=>$id));
				echo "0";
				}
				if ($ser == 0) {
				$this->db->update("messages",array("view" => "1"),array("id_message"=>$id));
				echo "1";
							}      
					} 
			
					
					public function delete_message(){
						$product_id = $this->input->get('id');
						$check=$this->input->post('check');
						if($product_id!=""){
						$ret_value=$this->data->delete_table_row('messages',array('id_message'=>$product_id));
						}
						if(isset($check)&&$check!=""){  
							$check=$this->input->post('check');
							$length=count($check);
							for($i=0;$i<$length;$i++){
						$ret_value=$this->data->delete_table_row('messages',array('id_message'=>$check[$i]));     
						 }
						 }
						 $this->load->helper('url');
						 $this->session->set_flashdata('msg', 'تم الحذف بنجاح');
						 $this->session->mark_as_flash('msg');
						 redirect('/admin/messages', 'refresh');
							}


							Public function view_message(){
							$id_slider=$this->input->get('id');
								$this->db->update("messages",array("view" => "1"),array("id_message"=>$id_slider));
						$this->data = array(
						'num_admin'=> $this->data->get_table_data('admin'),
						'site_info'=> $this->data->get_table_data('site_info'),
						'messages_data'=> $this->data->get_table_data('messages',array('id_message'=>$id_slider)));
						$this->load->view('admin/messages/view_message',$this->data);
							} 


      public function check_password(){
      $password=$this->input->post('newpassword');
$repassword=$this->input->post('confirmpassword');
if($password!=$repassword){$exit="1";}
else if($password==""&&$repassword==""){$exit="1";}
echo json_encode($exit);
      }
      public function old_password(){
        $id_admin=$this->session->userdata['id_admin'];;
        $password=$this->input->post('oldpassword');
$count_pass=$this->db->get_where('onwer_pharamcy',array('id'=>$id_admin,'password'=>md5($password)))->result();
 if(count($count_pass)>0){$exit="1";}
 else if(count($count_pass)==0){$exit="2";}
  if($password==""){$exit="3";}
  echo json_encode($exit);
        }

        
        public function editpassword(){
          $id_admin=$this->session->userdata['id_admin'];;
          $newpassword=$this->input->post('newpassword');
             
              $data['password'] = md5($newpassword);
          $re=$this->db->update('onwer_pharamcy',$data,array('id'=>$id_admin));
          $this->load->helper('url');
          $this->session->set_flashdata('msg', 'Data added successfully');
        $this->session->mark_as_flash('msg');
        redirect(base_url().'pos/system_cp/user_profile');
          }
      
}

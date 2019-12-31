<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Description of site
 *
 * @author https://www.roytuts.com
 */
class Pages extends MX_Controller {

    function __construct() {
		parent::__construct();
		$this->lang->load('main_lang', get_lang() );
        $this->db->order_by('id', 'DESC');
        $this->load->library('session');
        if( isset($this->session->get_userdata('lang')['lang']) ){
        $lang = $this->session->get_userdata('lang')['lang'];
        }else{
        $lang = 'arabic';
        }
        $dir = ( $lang == 'arabic' )? 'left' : 'right' ;
		define( "LANGU" , $lang );
		$this->load->model('data','','true');
    }

public function lang_site( $lang = null ){
    $curt = $this->uri->segment(3);
$main_curt=$this->uri->segment(1);
$controller_curt=$this->uri->segment(2);
$curt_sub =$_SESSION['curt'];
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
redirect(DIR."site/".$controller_curt."/".$curt_sub);
    }


function about() {

		global $lang;
		if( isset($this->session->get_userdata('lang')['lang']) ){
			$lang = $this->session->get_userdata('lang')['lang'];
			}else{
			$lang = 'arabic';
			}
		$data['site_info'] =$this->db->get_where('site_info')->result(); 
		$data['lang'] =$lang; 
		
		$data_contant['lang'] =$lang; 
	$this->load->view('include/head',$data );
	$this->load->view('include/insideheader',$data );
	$this->load->view('about',$data);
	$this->load->view('include/footer',$data);
	}
	
	function contact() {
		global $lang;
		if( isset($this->session->get_userdata('lang')['lang']) ){
			$lang = $this->session->get_userdata('lang')['lang'];
			}else{
			$lang = 'arabic';
			}
		$data['site_info'] =$this->db->get_where('site_info')->result(); 
		$data['lang'] =$lang; 
		$data_contant['siteinfo']=$this->db->get_where('site_info')->result();
		$data_contant['contact_info']=$this->db->get_where('contact_info')->result();
		$data_contant['main_slider']=$this->db->get_where('slider',array('view'=>'1'))->result();
		$data_contant['home_products']=$this->db->order_by('id','desc')->limit(12)->get_where('product',array('view'=>'1'))->result()
		; 
		$data_contant['lang'] =$lang; 
	$this->load->view('include/head',$data );
	$this->load->view('include/insideheader',$data );
	$this->load->view('contact',$data_contant);
	$this->load->view('include/footer',$data);    
}

public function contact_action(){
	$fname=$this->input->post('name');
	$email=$this->input->post('email');
	$message=$this->input->post('message');
	$data['name'] = $fname;
	$data['mail'] = $email;
	$data['message'] = $message;
	$subject="رسالة جديدة من الموقع";
	$main_email = $this->data->get_table_row('site_info',array('id'=>1),'message_email');

echo $main_email;

	$mail_message='مركز'.'الرجيم الصحى'. "\r\n";
	$mail_message.='رسالة خاصة من'.'&nbsp; &nbsp;'.$fname."\r\n";
	$mail_message.='<br>p1.al-yasser.info'."\r\n";
	$mail_message.=$message;
	$message = $mail_message;
	$body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	  <html xmlns="http://www.w3.org/1999/xhtml">
	  <head>
		  <meta http-equiv="Content-Type" content="text/html; charset=' . strtolower(config_item('charset')) . '" />
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
	->from("ashraf.m@wisyst.com")
	->reply_to("ashraf.m@wisyst.com")    // Optional, an account where a human being reads.
	->to($main_email)
	->subject($subject)
	->message($body)
	->send();
	//  echo $email_to;
	//var_dump($result);
	//echo $this->email->print_debugger();
	 //die;
	

	$this->db->insert('messages',$data);
	$this->session->set_flashdata('msg',lang('sendmessage_result'));
	$this->session->mark_as_flash('msg');
	redirect(base_url("site/pages/contact"));
	}
	   
	
	function bmi() {

		global $lang;
		if( isset($this->session->get_userdata('lang')['lang']) ){
			$lang = $this->session->get_userdata('lang')['lang'];
			}else{
			$lang = 'arabic';
			}
		$data['site_info'] =$this->db->get_where('site_info')->result(); 
		$data['home_page'] =$this->db->get_where('home_page')->result(); 
		$data['lang'] =$lang; 

		$this->load->view('include/head',$data );
	$this->load->view('include/insideheader',$data );
	$this->load->view('bmi',$data);
	$this->load->view('include/footer',$data);
	}
	
}

/* End of file Site.php */
/* Location: ./application/modules/site/controllers/site.php */

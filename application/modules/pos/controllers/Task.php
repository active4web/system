<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Task extends MX_Controller {
public function __construct()

        {
          parent::__construct();
          $this->load->library('session');
          $this->load->model('data','','true');
          $this->load->helper(array('form', 'url','text'));
    
        }
        
        
    
    

public function index(){
$this->load->view('task');
}


       function overview(){
           $string=$this->input->get("str");
           $indexes=0;
            foreach(array_unique(str_split($string)) as $letter){
                $indexes++;$count = 0;$before = '';$after = '';$maxdistance = null;
                foreach(str_split($string) as $i=>$l){
                    if($l === $letter){
                        $count++;
                        if(($i+1)<count(str_split($string))){
                        $before = ($before!=''?$before.',':'').str_split($string)[$i+1]?:'none';
                        }else{$before  ="none";}
                        if($i>0){
                        $after  = ($after!=''?$after.',':'').str_split($string)[$i-1]?:'none';
                        }
                        else{$after  ="none";}
                        $maxdistance = $count > 1?$i-array_search($l,str_split($string))-1:null;
                    }
                }
                echo $letter.' :'.$count.': before :('.$before.') after : ('.$after .')'.($count>1?' :max-distance: ':'').$maxdistance.'</br>';
            }
        }


public function overview1(){
$str=$this->input->get("str");
if(strlen($str)<255){
$chars = str_split($str);
    $counts = array_count_values($chars);
for($i=0; $i<count($chars); $i++){
    $arr=array();
    if($counts[$chars[$i]]<2){
      if($i==0){$after="(none)";}else{$after="(".$chars[$i-1].")";}
      if(($i+1)==count($chars)){$before="(none)";}else{$before="(".$chars[$i+1].")";}
      $t=$chars[$i].":".$counts[$chars[$i]]." before ".$before." "." after ".$after."<br>";
    }
    else {

        $arr=array_keys($chars,$chars[$i]);

for($j=0; $j<count($arr); $j++){
     if($j==0){$after="(none)";}else{$after="(".$arr[$j-1].")";}
      if(($j+1)==count($arr)){$before="(none)";}else{$before="(".$arr[$j+1].")";}
            $t=$chars[$i].":".$counts[$chars[$i]]." before ".$before." "." after ".$after."<br>";


}
         }
    
      echo $t;


}
}

else {
  $this->session->set_flashdata('msg',"error");
  $this->session->mark_as_flash('msg');;
   redirect(base_url().'pos/task', 'refresh');

}


 

  }

}

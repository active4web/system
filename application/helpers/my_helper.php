<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

function get_tab_row($table,$where=array(),$filed=null){
$CI =& get_instance();
$query = $CI->db->get_where($table,$where);
foreach($query->result() as $row){
return $row->$filed;	
}
}

function get_rondam_code(){
    $CI =& get_instance();
  mt_srand((double)microtime()*10000);
            $charid = md5(uniqid(rand(), true));
            $c = unpack("C*",$charid);
            $c = implode("",$c);

            return substr($c,0,4);
    }

function get_alltab($table,$where=array(),$limit=null,$order_field=null,$order_type=null){
$CI =& get_instance();
$CI->db->where($where);	
if($limit)
$CI->db->limit($limit);
if($order_field)
$CI->db->order_by($order_field,$order_type);
$query = $CI->db->get($table);
return $query->result();	
}



/***********************************************************END CASE****/

/****************Case if code correct and customer not register***************/

if($id_clients!=""&&$id_customer==""){
$discount_id=get_tab_row('team_work',array('id'=>$id_clients),'id_customer');
$count_clients=get_tab_row('team_work',array('id'=>$id_clients),'count_clients');
$new_count_clients=$count_clients+1;
$discount_code=get_tab_row('clients',array('id'=>$discount_id),'discount_clients');
$discount_code=get_tab_row('clients',array('id'=>$discount_id),'discount_clients');
$min_price=get_tab_row('clients',array('id'=>$discount_id),'min_price');
$code_customer=$this->register_customer($phone,$request_name);
$id_customer=get_tab_row('team_work',array('code'=>$code_customer),'id');
        if(isset($check) && $check!=""){ 
            $length=count($check);
        for($i=0;$i<$length;$i++){
        $qty= $this->input->post('value'.$check[$i]);
        $id_orders= $check[$i];
        $price=get_tab_row('product',array('id'=>$check[$i]),'price');
        $discount=get_tab_row('product',array('id'=>$check[$i]),'offers');
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
        $order_details['id_client']=$id_clients;
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
        echo ceil(($final_price*$discount_code)/100);
        if($final_price>$min_price){
        $order_details['total_price_code']=$final_price-ceil(($final_price*$discount_code)/100);
        }

        $order_details['taxi']=$taxi;
        $order_details['service']=$service;
        $order_details['order_code']=$this->get_ordercode(); ;
        $order_details['date_code']="PO".date("y").date("m");
        $order_details['order_day']=date("d");
        $order_details['id_customer']=$id_customer;
         $order_details['id_client']=$id_clients;
        $this->db->insert("final_order",$order_details);
        $id_order = $this->db->insert_id();
 if($final_price>$min_price){
        $data_client_count['count_clients']=$new_count_clients;
         $this->db->update("team_work",$data_client_count,array("id"=>$id_clients));
 }
} 
/*****************************Create order**/
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

/*****************************************END SECOND CASE**********************/

 

 

 

 

 

  

/****************Case if code correct and customer not register***************/

if($id_customer!=""){
$discount_id=get_tab_row('team_work',array('id'=>$id_customer),'id_customer');
$num_discount=get_tab_row('team_work',array('id'=>$id_customer),'num_discount');
$count_clients=get_tab_row('team_work',array('id'=>$id_customer),'count_clients');
$max_times=get_tab_row('clients',array('id'=>$discount_id),'max_times');
$total_money=get_tab_row('clients',array('id'=>$discount_id),'total_money');
$discount_code=get_tab_row('clients',array('id'=>$discount_id),'discount');
$id_money=get_tab_row('customer_total',array('client_id'=>$id_customer,'commission'=>0),'id');
$count_num_money=get_tab_row('customer_total',array('client_id'=>$id_customer,'commission'=>0),'count_num');
$total_price_money=get_tab_row('customer_total',array('client_id'=>$id_customer,'commission'=>0),'total_price');
        if(isset($check) && $check!=""){ 
            $length=count($check);
        for($i=0;$i<$length;$i++){
        $qty= $this->input->post('value'.$check[$i]);
        $id_orders= $check[$i];
        $price=get_tab_row('product',array('id'=>$check[$i]),'price');
        $discount=get_tab_row('product',array('id'=>$check[$i]),'offers');
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
        if($id_money!=""&&$count_num_money<$max_times){
           if($total_price_money>0){
               if($total_price_money>=$final_price){
        $reaming_data['total_price']=$total_price_money-$final_price;
                $reaming_data['count_num']=$count_num_money+1;
        $order_details['total_price_code']=-1;
               }
               else if($total_price_money<$final_price){
        $reaming_data['total_price_code']=$final_price-$total_price_money;
        $reaming_data['count_num']=$count_num_money+1;
        $order_details['total_price']=0;
               }
$this->db->update("customer_total",$reaming_data,array("id"=>$id_money));
     if($total_price_money==0){
         $commission_data['commission']='1';
$this->db->update("customer_total",$commission_data,array("id"=>$id_money));
     }          
           }
        }
if($max_times>$num_discount){
        $order_details['total_price_code']=$final_price-ceil(($final_price*$discount_code)/100);
        $data_client_count['num_discount']=$num_discount+1;
         $this->db->update("team_work",$data_client_count,array("id"=>$id_clients));
        }
        $order_details['taxi']=$taxi;
        $order_details['service']=$service;
        $order_details['order_code']=$this->get_ordercode(); ;
        $order_details['date_code']="PO".date("y").date("m");
        $order_details['order_day']=date("d");
        $order_details['id_customer']=$id_customer;
        $this->db->insert("final_order",$order_details);
        $id_order = $this->db->insert_id();
        } 
        /*****************************Create order**/
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
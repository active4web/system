<?php 
$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
foreach($data as $maindata) {
$admin_id=$this->session->userdata("id_admin");
$subtotal_price=$maindata->subtotal_price;
$maindate=$maindata->date;
$total_price_main=$maindata->total_price;
$order_code=$maindata->date_code.$maindata->order_code;
$order_day=$maindata->order_day;
$taxi=$maindata->taxi;
$service=$maindata->service;
$discount_total=$maindata->discount_total;
$time_h=$maindata->time_h;
$id_customer=$maindata->id_customer;
$order_day=$maindata->order_day;
$total_price_code=$maindata->total_price_code;

$code_name=get_tab_row('team_work',array('id'=>$id_customer),'code');
$name_site=get_tab_row('site_info',array('id'=>1),'name_site');
$name_site_ar=get_tab_row('site_info',array('id'=>1),'name_site_ar');
$fname=get_tab_row('admin',array('id'=>$admin_id),'fname');
$lname=get_tab_row('admin',array('id'=>$admin_id),'lname');
$fullname=$fname." ".$lname;
$lang = $this->session->userdata('lang');
$title=($lang=='arabic')?$name_site_ar:$name_site;
$code_customer=lang("code_customer");
$main_seller=lang("seller");
$pdf->SetTitle(lang("Invoice"));
$pdf->SetHeaderMargin(0);
$pdf->SetTopMargin(5); 
$pdf->setFooterMargin(5);
$pdf->SetAutoPageBreak(false);
$pdf->SetAuthor('active4web');
$pdf->SetDisplayMode('real', 'default');
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->AddPage();
$pdf->SetMargins(20,30,20);
$pdf->setJPEGQuality(30);
$pdf->SetDisplayMode('fullpage', 'SinglePage', 'UseNone');
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
}
$billing_code=lang("billing_code");
$date=lang("date");
$Meals=lang("Meals");
$price=lang("price");
$qty=lang("qty");
$discount=lang("discount");
$total_price="Price";

$tb0= <<<EOD
<style>
span#message {
text-align:center;
}
</style>
<p><span id="message"></span></p>
EOD;
$pdf->writeHTML($tb0, true, false, true, false, '');

$tb1= <<<EOD
<style>
span#message {
text-align:center;
margin-right:400px
}
</style>
<p><span id="message">
<img src="https://life-goaleg.com/Presso_cafe/uploads/site_setting/eyru.png" style="width:200px;height:160px">
</span></p>
EOD;
$pdf->writeHTML($tb1, true, false, true, false, '');

$tb2= <<<EOD
<style>
span#message {
text-align:center;
font-style: italic;
font-size:20px;
text-transform: capitalize;
}
</style>
<p><span id="message">$main_seller: $fullname</span></p>
EOD;
$pdf->writeHTML($tb2, true, false, true, false, '');



$tb3= <<<EOD
<style>
span#message {
text-align:center;
font-style: italic;
font-size:20px;
text-transform: capitalize;
font-weight:bold;
}
</style>
<p><span id="message">
<table>
<tr><th></th>
<th></th>
</tr>
<tr><th>$date</th>
<th>$billing_code</th>
</tr>

<tr><th>$maindate $time_h</th>
<th>$order_code</th>
</tr>

</table>
</span></p>
EOD;
$pdf->writeHTML($tb3, true, false, true, false, '');


$tb4=<<<EOD
<style>
span#message {
text-align:center;
font-style: italic;
font-size:18px;
text-transform: capitalize;
}
</style>
<p><span id="message">
<table>
<tr>
<th></th>
<th></th>
<th></th>
<th></th>
<th></th>
</tr>


<tr>
<th>$Meals</th>
<th>$price</th>
<th>$qty</th>
<th>$discount</th>
<th>$total_price</th>
</tr>

</table>
</span></p>
EOD;
$pdf->writeHTML($tb4, true, false, true, false, '');
foreach($meals as $meals){
     $main_qty=$meals->qty;
      $main_dis=$meals->Product_discount;
      $main_p=$meals->main_price;
       $main_total_p=$meals->total_price;
        $id_meal=$meals->id_meal;
        $pname=mb_substr(get_tab_row('product',array('id'=>$id_meal),'title'),0,30);
$tb5=<<<EOD
<style>
span#message {
text-align:center;
font-style: italic;
font-size:25px;
text-transform: capitalize;
}
</style>
<p><span id="message">
<table>
<tr>
<th>$pname</th>
<th>$main_p</th>
<th>$main_qty</th>
<th>$main_dis</th>
<th>$main_total_p</th>
</tr>

</table>
</span></p>
EOD;
$pdf->writeHTML($tb5, true, false, true, false, '');
}
if($subtotal_price!=""){
  $langEGP=lang("EGP");
$tb6=<<<EOD
<style>
span#message {
text-align:center;
font-style: italic;
font-size:25px;
text-transform: capitalize;
}
</style>
<p><span id="message">
<table>
<tr>
<th></th>
<th></th>
<th></th>
<th></th>
<th></th>
<th></th>
</tr>

<tr>
<th></th>
<th colspan="2">$price</th>
<th colspan="2">$subtotal_price $langEGP</th>
<th></th>
</tr>

</table>
</span></p>
EOD;
$pdf->writeHTML($tb6, true, false, true, false, '');

}
if($taxi!=""&&$taxi!=0){
  $langtax=lang("taxi");
$tb7=<<<EOD
<style>
span#message {
text-align:center;
font-style: italic;
font-size:25px;
text-transform: capitalize;
}
</style>
<p><span id="message">
<table>
<tr>
<th></th>
<th></th>
<th>$langtax</th>
<th>$taxi %</th>
<th></th>
<th></th>
</tr>

</table>
</span></p>
EOD;
$pdf->writeHTML($tb7, true, false, true, false, '');
 }
 
 if($service!=""&&$service!=0){
  $langservice=lang("service");
  $langegp=lang("EGP");
$tb8=<<<EOD
<style>
span#message {
text-align:center;
font-style: italic;
font-size:25px;
text-transform: capitalize;
}
</style>
<p><span id="message">
<table>
<tr>
<th></th>
<th></th>
<th>$langservice</th>
<th>$service $langegp</th>
<th></th>
<th></th>
</tr>

</table>
</span></p>
EOD;
$pdf->writeHTML($tb8, true, false, true, false, '');
   
}
 
 
 
 
 
 
  if($service!=""){
  $langtotal_price=lang("total_price");
  $langegp=lang("EGP");
$tb9=<<<EOD
<style>
span#message {
text-align:center;
font-style: italic;
font-size:25px;
text-transform: capitalize;
}
</style>
<p><span id="message">
<table>
<tr>
<th></th>
<th colspan="2">$langtotal_price</th>
<th colspan="2">$total_price_main $langegp</th>
<th></th>
</tr>

</table>
</span></p>
EOD;
$pdf->writeHTML($tb9, true, false, true, false, '');
}



$pdf->SetTitle(lang("Invoice"));
$pdf->SetHeaderMargin(0);
$pdf->SetTopMargin(10); 
$pdf->setFooterMargin(10);
$pdf->SetAutoPageBreak(false);
$pdf->SetAuthor('active4web');
$pdf->SetDisplayMode('real', 'default');
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->AddPage();
$pdf->SetMargins(30,70,30);
$pdf->setJPEGQuality(50);
$pdf->SetDisplayMode('fullpage', 'SinglePage', 'UseNone');
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

$billing_code=lang("billing_code");
$date=lang("date");
$Meals=lang("Meals");
$price=lang("price");
$qty=lang("qty");
$discount=lang("discount");
$total_price=lang("total_price");

$tb1= <<<EOD
<style>
span#message {
text-align:center;
}
</style>
<p><span id="message">
<img src="https://life-goaleg.com/Presso_cafe/uploads/site_setting/eyru.png" style="width:200px;height:160px">
</span></p>
EOD;
$pdf->writeHTML($tb1, true, false, true, false, '');

$tb2= <<<EOD
<style>
span#message {
text-align:center;
font-style: italic;
font-size:20px;
text-transform: capitalize;
}
</style>
<p><span id="message">$main_seller: $fullname</span></p>
EOD;
$pdf->writeHTML($tb2, true, false, true, false, '');


$tb3= <<<EOD
<style>
span#message {
text-align:center;
font-style: italic;
font-size:20px;
text-transform: capitalize;
font-weight:bold;
}
</style>
<p><span id="message">
<table>
<tr><th></th>
<th></th>
</tr>
<tr><th>$date</th>
<th>$billing_code</th>
</tr>

<tr><th>$maindate $time_h</th>
<th>$order_code</th>
</tr>

</table>
</span></p>
EOD;
$pdf->writeHTML($tb3, true, false, true, false, '');



if($subtotal_price!=""){
  $langEGP=lang("EGP");
$tb6=<<<EOD
<style>
span#message {
text-align:center;
font-style: italic;
font-size:25px;
text-transform: capitalize;
}
</style>
<p><span id="message">
<table>
<tr>
<th></th>
<th></th>
<th></th>
<th></th>
<th></th>
<th></th>
</tr>

<tr>
<th></th>
<th colspan="2">$price</th>
<th colspan="2">$subtotal_price $langEGP</th>
<th></th>
</tr>

</table>
</span></p>
EOD;
$pdf->writeHTML($tb6, true, false, true, false, '');

}
if($taxi!=""&&$taxi!=0){
  $langtax=lang("taxi");
$tb7=<<<EOD
<style>
span#message {
text-align:center;
font-style: italic;
font-size:25px;
text-transform: capitalize;
}
</style>
<p><span id="message">
<table>
<tr>
<th></th>
<th></th>
<th>$langtax</th>
<th>$taxi %</th>
<th></th>
<th></th>
</tr>

</table>
</span></p>
EOD;
$pdf->writeHTML($tb7, true, false, true, false, '');
 }
 
 if($service!=""&&$service!=0){
  $langservice=lang("service");
  $langegp=lang("EGP");
$tb8=<<<EOD
<style>
span#message {
text-align:center;
font-style: italic;
font-size:25px;
text-transform: capitalize;
}
</style>
<p><span id="message">
<table>
<tr>
<th></th>
<th></th>
<th>$langservice</th>
<th>$service $langegp</th>
<th></th>
<th></th>
</tr>

</table>
</span></p>
EOD;
$pdf->writeHTML($tb8, true, false, true, false, '');
   
}
 
 
 
 
 
 
  if($service!=""){
  $langtotal_price=lang("total_price");
  $langegp=lang("EGP");
$tb9=<<<EOD
<style>
span#message {
text-align:center;
font-style: italic;
font-size:25px;
text-transform: capitalize;
}
</style>
<p><span id="message">
<table>
<tr>
<th></th>
<th  colspan="2">$langtotal_price</th>
<th colspan="2">$total_price_main $langegp</th>
<th></th>
</tr>

</table>
</span></p>
EOD;
$pdf->writeHTML($tb9, true, false, true, false, '');
}



$pdf->lastPage();
$pdf->Output('pricelist.pdf', 'I');
?>
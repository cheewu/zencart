<?php
require('includes/application_top.php');
//$languages = zen_get_languages();
//print_r($languages);
//error_reporting(E_ALL);
if($_SESSION['languages_code']=='en')
{
	define('SERVER_NO','13680000000028003');
}
else
{
	define('SERVER_NO','13680000000076002');
}
$crm=$db->Execute("select * from ".TABLE_ORDERS." where order_crm='0' and payment_method!='' and NOW()-(date_purchased+0)>1000");
while(!$crm->EOF)
{
    //------------------------- add 5 5 ----------------------------//
	include(DIR_WS_CLASSES . 'order.php');
	$order=new order($crm->fields['orders_id']);
//print_r($order);
    try{
    global $currencies;
    $crm_pro_string = '';
    $crm_i = 0;
    $crm_carrier = '';
    foreach($order->products as $crm_pro){
        $crm_i ++;
        $crm_pro_string .= '<product no="' . $crm_i . '">';
        $crm_pro_string .= '<FL val="Product Id">' . defined_crm_curl_getid('Products','LV_' . $crm_pro['id'],'Product Code') . '</FL><FL val="Unit Price">' . $crm_pro['price'] . '</FL><FL val="Quantity">' . $crm_pro['qty'] . '</FL><FL val="Total">' . $crm_pro['final_price'] . '</FL><FL val="Discount">0</FL><FL val="Total After Discount">' . $crm_pro['final_price'] . '</FL><FL val="List Price">' . $crm_pro['final_price'] . '</FL><FL val="Net Total">' . $crm_pro['final_price'] . '</FL>';
        $crm_pro_string .= '</product>';
    }
//freeoptions,item
    if($order->info['shipping_module_code'] == 'item'){
        $crm_carrier = "UPS快递";
    } else if($order->info['shipping_module_code'] == 'freeoptions'){
        $crm_carrier = "EMS";
    }

    $crm_array = array();

    $crm_array = array('websiteid'=> STORE_NAME . '_' . $crm->fields['orders_id'],       //网站标识+'_'+id,如ugg_34
                       'Subject'=>  STORE_NAME . '_' . $crm->fields['orders_id'],    //* 商机名
                       'Account Name'=> $order->customer['email_address'],       //* 客户名
                       'Carrier'=> $crm_carrier,
                       'order date'=> date("Y-m-d"),
                       'Status'=>"创建" ,
                       'CONTACTID'=>defined_crm_curl_getid('Contacts',STORE_NAME . '_' . $order->customer['id'],'websiteid'),
                       'SMOWNERID'=>SERVER_NO,
                       '支付'=>$order->info['payment_method'],
                       'Description'=> addslashes(get_comments($crm->fields['orders_id'])),
                       'Product Details'=>$crm_pro_string,

                       'Sub Total' => str_replace("$","",$order->totals[0]['text']),
                       'Discount' => '0',
                       'Tax' => $order->info['tax'],
                       'Adjustment' => str_replace("$","",$order->totals[1]['text']),
                       'Grand Total' => $order->info['total'],

                       'Shipping Name' => addslashes($order->delivery['name']),
                       'Shipping Street' => addslashes($order->delivery['street_address']),
                       'Shipping City' => addslashes($order->delivery['city']),
                       'Shipping Code' => addslashes($order->delivery['postcode']),
                       'Shipping State' => addslashes($order->delivery['state']),
                       'Shipping Country' => addslashes($order->delivery['country']),
                       'Shipping Tel' => addslashes($order->billing['tel']),
                       'Billing Name' => addslashes($order->billing['name']),
                       'Billing Street' => addslashes($order->billing['street_address']),
                       'Billing City' => addslashes($order->billing['city']),
                       'Billing Code' => addslashes($order->billing['postcode']),
                       'Billing State' => addslashes($order->billing['state']),
                       'Billing Country' => addslashes($order->billing['country']),
                       'Billing Tel' => addslashes($order->billing['tel'])//addslashes($order->billing['tel'])
                );//die(crm_curl_getid('Contacts',STORE_NAME . '_' . $_SESSION['customer_id'],'websiteid'));


//print_r($crm_array);
//exit;
    defined_crm_curl_post('SalesOrders',$crm_array);
	$db->Execute("update ".TABLE_ORDERS." set order_crm=1 where orders_id='".$crm->fields['orders_id']."'");
	exit;
    } catch (Exception $e){
    }
    //-------------------------- over ------------------------------//
	$crm->MoveNext();
}
function defined_crm_curl_post($module = '',$post_array='',$method="insert",$id=""){
    //------------这里写常用的变量
    $loginName = defined("CRM_ACCOUNT")?CRM_ACCOUNT:'tigermarketing';
    $ticket = defined("CRM_TICKET")?CRM_TICKET:'31fff547b84516ea6707164820c08276';        //貌似得每个星期申请一次来着
    //$loginName = 'wublue12';
    //$ticket = 'b1760087e3a1e4497c632be9b10391fe';       //貌似得每个星期申请一次来着

    //------------下面是post的地址
    if($method == 'insert'){
        $crm_url = 'http://crm.baihui.com/crm/private/xml/' . $module . '/insertRecords';
        $crm_url .= "?newFormat=1&loginName=" . $loginName . "&ticket=" . $ticket;
    } else if($method == 'update'){
        $crm_url = 'http://crm.baihui.com/crm/private/xml/' . $module . '/updateRecords';
        $crm_url .= "?newFormat=1&loginName=" . $loginName . "&ticket=" . $ticket . "&id=" . $id;
    } else {
        return;
    }

    //------------下面是post的数据
    $post_string = '';
    $post_string .= '<' . $module . '>'; //这里还是用xml格式的吧,json的没做
    $post_string .= '<row no="1">';
    foreach($post_array as $key => $value){
        $post_string .= '<FL val="' . $key . '">' . $value . '</FL>';
    }
    $post_string .= '</row>';
    $post_string .= '</' . $module . '>';
    $post_string = str_replace('&','',$post_string);

    $crm_string = 'xmlData=' . urlencode($post_string);
  //  echo $crm_url . '<br>';
   // echo $crm_string;
   // die($crm_string);
    $crm_curl = curl_init();
    curl_setopt($crm_curl,CURLOPT_URL,$crm_url);
    //curl_setopt($crm_curl,CURLOPT_POST,1);
    curl_setopt($crm_curl,CURLOPT_POSTFIELDS,$crm_string);
    curl_setopt($crm_curl,CURLOPT_RETURNTRANSFER,1);    //设置不要返回的内容
    $data = curl_exec($crm_curl);
    preg_match("|.*<FL val=\"Id\">(\d+)<\/FL>|i",$data,$match);
    curl_close($crm_curl);
    return $match[1];
}

function defined_crm_curl_getid($module,$val = '',$search = 'websiteid') {
	//print_r(func_get_args());
    $loginName = defined("CRM_ACCOUNT")?CRM_ACCOUNT:'tigermarketing';
    $ticket = defined("CRM_TICKET")?CRM_TICKET:'31fff547b84516ea6707164820c08276';       //貌似得每个星期申请一次来着

    $get_url = 'http://crm.baihui.com/crm/private/xml/' . $module . '/getSearchRecords';
    $get_url .= '?newFormat=1&loginName=' . $loginName . '&ticket=' . $ticket;
    $get_url .= '&selectColumns=' . $module . '(*)';    //这是选择显示的字段,奇怪的是括号里不管写什么都会返回id,
    $get_url .= '&searchCondition=(' . $search . '|=|' . $val . ')';  //如果想用like的话请把=改成contain
//echo $get_url;
        //这里开始是访问crm取得id
    $xml = new DOMDocument();
    try{

    if($xml->load($get_url)){
    foreach($xml->getElementsByTagName('FL') as $fl)
    {
        $value = $fl->firstChild->nodeValue;  //获取完毕
    }
    //---------------- 如果不存在则添加
    if($module == 'Products') {
        $id = (int)substr($val,3);
                                 
        if(!$value) {       
            global $db;
            $crm_pro = $db->Execute("select pd.products_name,p.products_model,p.products_price
                                     from " . TABLE_PRODUCTS . " p," . TABLE_PRODUCTS_DESCRIPTION . " pd
                                     where p.products_id = pd.products_id and pd.language_id = 1 and p.products_id = " . $id);
            $crm_array = array('Product Code' => $val,
                            'Product Name' => zen_db_prepare_input($crm_pro->fields['products_name']),
                            '商品链接' => 'http://sale.onfas.com/wwwdata/lv-p' . $id . '.html',
                            'Unit Price' => $crm_pro->fields['products_price']);
            $value = defined_crm_curl_post('Products',$crm_array);
        } else {
            $crm_array['商品链接'] = 'http://sale.onfas.com/wwwdata/lv-p' . $id . '.html';
            defined_crm_curl_post('Products',$crm_array,'update',$value);
        }
    }
    
    //----------------
    }

      } catch (Exception $e) {
        return ;
        }
    //$crm_url .= '&id=' . $value;
    return $value;
}
function get_comments($orders_id)
{
		global $db;
	    $address_query = "select * FROM ".TABLE_ORDERS_STATUS_HISTORY." where orders_id='".$orders_id."'";
		$address=$db->Execute($address_query);
		return $address->fields['comments'];
}
?>
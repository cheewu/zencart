<?php
/**
 * @author wuxutao
 * @copyright 2010
 * 功能:插入本网站的时候同时插入到crm中去
 * 函数参数:$module,需插入的模块名称,现在主要用Contacts(用户),Potentials(未付款),PurchaseOrders(已付款),Invoices(已发货)
 *      $post_array,发送的数组,字段需要按照crm中的来,另外有个必须的自定义字段websiteid,这是我自己加的,格式是 网站标识_id,以便于更新时
 *                  好查询id
 *      $method,操作,有insert和update两种,百会貌似没有提供delete接口
 *      $type,发送和接收类型,有xml和json两种,json先摒弃
 *      $action,新加的参数,因为找不到删除接口,所以添加两个参数do_in(没有数据则插入)和do_no(没有数据则返回),用在$method=update的情况下
 * 变量:$loginName,百会登录帐号,也可以是邮箱
 *      $ticket,这是生成的ticket,貌似那个apikey没用到,只是在申请ticket的时候用到了,感觉怪怪的,每个ticket能使用1个星期,过了一个星期后
 *              需要重新申请
 *              申请地址 例如:https://accounts.zoho.com/login?servicename=ZohoCRM&FROM_AGENT=true&LOGIN_ID=Zoho Username or Email Address&PASSWORD=Password,要改
 *              login_id和password
 *
 * 模块:详细的请参照http://zohocrm.wiki.zoho.com/Zoho-CRM---Standard-Fields.html,这里只列出可能用到的,*表明是必须的
 *      1.Contacts
 *        array('websiteid'=>       //网站标识+'_'+id,如ugg_34
 *              'First Name'=>
 *              'Last Name'=>       //*这个是必须的
 *              'Salutation'=>      //Mr. or Ms.
 *              'Email'=>
 *              'Phone'=>
 *              'Fax'=>
 *              )
 *      2.Potentials
 *        array('websiteid'=>        //网站标识+'_'+id,如ugg_34
 *              'Potential Name'=>      //* 商机名
 *              'Account Name'=>        //* 客户名
 *              'Closing Date'=>        //* 日期,格式是2010-05-06
 *              'Stage'=>              //* 阶段
 *              'Contact Name'=>
 *              'Amount'=>              //金额
 *              'Description'=>
 *              )
 *      3.PurchaseOrders,这里先暂时省略产品
 *        array('websiteid'=>        //网站标识+'_'+id,如ugg_34
 *              'Subject'=>         //*主题
 *              'Vendor Name'=>     //*供货商
 *              'PO Number'=>       订单号
 *              'Contact Name'=>
 *              'Purchase Order Date'=>
 *              'Sales Commission'=>
 *              'Shipping Street'=>
 *              'Shipping City'=>
 *              'Shipping State'=>
 *              'Shipping Zip'=>
 *              'Shipping Country'=>
 *              'Billing Street'=>
 *              'Billing City'=>
 *              'Billing State'=>
 *              'Billing Zip'=>
 *              'Billing Country'=>
 *              )
 *      4.Invoices
 *        array('websiteid'=>        //网站标识+'_'+id,如ugg_34
 *              'Subject'=>         //*主题
 *              'Account Name'=>    //*
 *              'Contact Name'=>
 *              'Sales Order'=>      //发货日期
 *              'Sales Commission'=>    //销售日期
 *              'Shipping Street'=>
 *              'Shipping City'=>
 *              'Shipping State'=>
 *              'Shipping Zip'=>
 *              'Shipping Country'=>
 *              'Billing Street'=>
 *              'Billing City'=>
 *              'Billing State'=>
 *              'Billing Zip'=>
 *              'Billing Country'=>
 *              )
 *
 */

//----------- 数组请务必保证有websiteid字段,这个就是由这个网站的标识+在这个网站的id组成的
/*
$post_array = array('Potential Name' => 'azxcvxz@sf.cc',
                    'Account Name' => 'cccc',
                    'Closing Date' => date("Y-m-d"),
                    'Stage' => '2222',
                    'Shipping Street'=>'asdf',
                    'Shipping City'=>'asdf',
               'Shipping State'=>'asdf',
               'Shipping Zip'=>'asdf',
               'Shipping Country'=>'asdf',
               'Billing Street'=>'asdf',
               'Billing City'=>'asdf',
               'Billing State'=>'asdf',
              'Billing Zip'=>'asdf',
              'Billing Country'=>'asdf');*/
//post_crm_curl('insert','Potentials',$post_array);
function crm_curl_post($module = '',$post_array='',$method="insert",$id=""){
    //------------这里写常用的变量
    $loginName = defined("CRM_ACCOUNT")?CRM_ACCOUNT:'tigermarketing';
    $ticket = defined("CRM_TICKET")?CRM_TICKET:'31fff547b84516ea6707164820c08276';        //貌似得每个星期申请一次来着
    //$loginName = 'wublue12';
    //$ticket = 'b1760087e3a1e4497c632be9b10391fe';       //貌似得每个星期申请一次来着

    //------------下面是post的地址
    if($method == 'insert'){
        $crm_url = 'http://crm.baihui.com/crm/private/xml/' . $module . '/insertRecords';
        $crm_url .= "?newFormat=1&loginName=" . $loginName . "&apikey=wMkBDCvkY648QSw4Owj4xDJoKjrxaTvi&ticket=" . $ticket;
    } else if($method == 'update'){
        $crm_url = 'http://crm.baihui.com/crm/private/xml/' . $module . '/updateRecords';
        $crm_url .= "?newFormat=1&loginName=" . $loginName . "&apikey=wMkBDCvkY648QSw4Owj4xDJoKjrxaTvi&ticket=" . $ticket . "&id=" . $id;
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

function crm_curl_getid($module,$val = '',$search = 'websiteid') {
	global $crm_pname_s,$crm_pname_r;
    $loginName = defined("CRM_ACCOUNT")?CRM_ACCOUNT:'tigermarketing';
    $ticket = defined("CRM_TICKET")?CRM_TICKET:'31fff547b84516ea6707164820c08276';       //貌似得每个星期申请一次来着

    $get_url = 'http://crm.baihui.com/crm/private/xml/' . $module . '/getSearchRecords';
    $get_url .= '?newFormat=1&loginName=' . $loginName . '&apikey=wMkBDCvkY648QSw4Owj4xDJoKjrxaTvi&ticket=' . $ticket;
    $get_url .= '&selectColumns=' . $module . '(*)';    //这是选择显示的字段,奇怪的是括号里不管写什么都会返回id,
    $get_url .= '&searchCondition=(' . $search . '|=|' . $val . ')';  //如果想用like的话请把=改成contain

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

        global $db;
        $crm_pro = $db->Execute("select pd.products_name,p.products_model,p.products_price
                                 from " . TABLE_PRODUCTS . " p," . TABLE_PRODUCTS_DESCRIPTION . " pd
                                 where p.products_id = pd.products_id and pd.language_id = 1 and p.products_id = " . $id);
		$p_name = str_ireplace($crm_pname_s,$crm_pname_r,zen_db_prepare_input($crm_pro->fields['products_name']));
        if(!$value) {       
            $crm_array = array('Product Code' => $val,
                            'Product Name' => $p_name,
                            '商品链接' => 'http://sale.onfas.com/wwwdata/lv-p' . $id . '.html',
                            'Unit Price' => $crm_pro->fields['products_price']);
            $value = crm_curl_post('Products',$crm_array);
        } else {
            $crm_array = array('Product Name' => $p_name,
                               '商品链接' => 'http://sale.onfas.com/wwwdata/lv-p' . $id . '.html');
            crm_curl_post('Products',$crm_array,'update',$value);
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

?>
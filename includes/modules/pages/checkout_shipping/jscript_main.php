<?php

/**

 * jscript_main

 *

 * @package page

 * @copyright Copyright 2003-2006 Zen Cart Development Team

 * @copyright Portions Copyright 2003 osCommerce

 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0

 * @version $Id: jscript_main.php 3505 2006-04-24 04:00:05Z drbyte $

 */

?>

<script language="javascript" type="text/javascript"><!--

var submitter = null;

function popupWindow(url) {

  window.open(url,'popupWindow','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=450,height=320,screenX=150,screenY=150,top=150,left=150')

}



function couponpopupWindow(url) {

  window.open(url,'couponpopupWindow','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=450,height=320,screenX=150,screenY=150,top=150,left=150')

}



function submitFunction($gv,$total) {

   if ($gv >=$total) {

     submitter = 1;	

   }

}



function submitonce(){

  if (document.checkout_confirmation.btn_submit) {

	  document.checkout_confirmation.btn_submit.disabled = true;

    setTimeout('button_timeout()', 4000);

    document.checkout_confirmation.submit();

  }

}



function button_timeout() {

  document.checkout_confirmation.submit.disabled = false;

}


function submitonce_open(){
    window.open('<?php echo zen_href_link('help_pay', '', 'SSL');?>');
    submitonce();
}

function change_shipping(bu){
    var val;
    var tit;
    var total_val;
    if(bu.checked){
        val = document.getElementById(bu.value+'_v').value;
        tit = document.getElementById(bu.value+'_t').value;
        total_val = document.getElementById(bu.value+'_v_t').value;
        document.getElementById('ot_shipping_t').innerHTML = tit+':';
        document.getElementById('ot_shipping_v').innerHTML = val;
        document.getElementById('ot_total_v').innerHTML = total_val;
        document.getElementById('v_amount').value = document.getElementById(bu.value+'_v_p').value;
    };
}
function methodSelect(theMethod) {
  if (document.getElementById(theMethod)) {
    document.getElementById(theMethod).checked = 'checked';
  }
}
//--></script>
<?php

/*
***author: Gayward S. Mendoza, E.c.E.
***mentor: Henry Kwan
***file:datafeed.php
***date: January 22, 2009
Sample Data feed Page
*/

/*
To check if there are parameters passed:
	if($_POST){
	print_r($_POST);
	}else{
	echo "There are no parameters passed";
	}

*/

$src	= $_REQUEST['src'];
$prc	= $_REQUEST['prc'];
$Ord = $_REQUEST['Ord'];
$Holder = $_REQUEST['Holder'];
$successcode = $_REQUEST['successcode'];
$Ref = $_REQUEST['Ref'];
$PayRef	= $_REQUEST['PayRef'];
$Amt	= $_REQUEST['Amt'];
$Cur	= $_REQUEST['Cur'];
$remark	= $_REQUEST['remark'];

echo "OK. Bank processed the payment,";


if($successcode == 0){
/*
the sending of e-mail is generated by zen cart.
*/
echo "and the customer's transaction is SUCCESSFUL.";
}

else{
/*
the merchant should void the transaction whenever the transaction is failed. they can see it in the paydollar or pesopay system
Therefore should check the system regularly. or they can put codes here that send mails and notify the merchant that there is an unsuccessful transaction
*/
echo "but transaction is FAILED. Please void the merchant's payment";
}

?>
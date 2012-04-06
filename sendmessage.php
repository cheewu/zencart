<?php
include('includes/application_top.php');
$sql = "select id,type,json,status
        from sendmessage
        where status = 0";
$sendmessage = $db->Execute($sql);
$sendmessage_id = '';
while(!$sendmessage->EOF)
{

    /*
    if($sendmessage->fields['type'] == 'crm') {
        send_crm_message($sendmessage->fields['json']);
    } else if($sendmessage->fields['type'] == 'email') {
        send_email_message($sendmessage->fields['json']);
    }
    $sendmessage_id .= $sendmessage->fields['id'] . ",";
    */
    
    if($sendmessage->fields['type'] == 'crm') {
        $send_array['crm'][] = array('id' => $sendmessage->fields['id'],
                                     'json' => $sendmessage->fields['json']);
    } else if($sendmessage->fields['type'] == 'email') {
        $send_array['email'][] = array('id' => $sendmessage->fields['id'],
                                      'json' => $sendmessage->fields['json']);
    }
    $sendmessage->MoveNext();
}

if(is_array($send_array['crm'])) {
    foreach($send_array['crm'] as $key => $value) {
        send_crm_message($value['json']);
        update_send_message($value['id'],'crm');
    }
}

if(is_array($send_array['email'])) {
    foreach($send_array['email'] as $key => $value) {
        if(send_email_message($value['json'])) {
            update_send_message($value['id'], 'email');
        } else {
            echo 'email : ' . $value['id'] . ' false <br />';
        }
    }
}


/*
if(strlen($sendmessage_id) > 1) {
$sendmessage_id = substr($sendmessage_id,0,-1);
$sql = "update sendmessage set status = 1 where id in (" . $sendmessage_id . ")";
$db->Execute($sql);
}
*/




function update_send_message($id,$type) {
    global $db;
    if($id) {
        $sql = "update sendmessage set status = 1 where id = " . $id;
        $db->Execute($sql);
        echo $type . ' : ' . $id . ' is success. <br />';
    } else {
        echo $type . ' : ' . 'id is empty ?<br />';
    }
}


function send_crm_message($json) {
    $array = json_decode($json,true);
    
    if($array['action'] == 'SalesOrders') { //下面的数据只有插入订单的时候才会用到
        $crm_pro_string = '';// 生成产品列表
        foreach($array['products'] as $crm_pro){
            $crm_i ++;
            $crm_pro_string .= '<product no="' . $crm_i . '">';
            $crm_pro_string .= '<FL val="Product Id">' . crm_curl_getid('Products','LV_' . $crm_pro['id'],'Product Code') . '</FL><FL val="Unit Price">' . $crm_pro['price'] . '</FL><FL val="Quantity">' . $crm_pro['qty'] . '</FL><FL val="Total">' . $crm_pro['final_price'] . '</FL><FL val="Discount">0</FL><FL val="Total After Discount">' . $crm_pro['final_price'] . '</FL><FL val="List Price">' . $crm_pro['final_price'] . '</FL><FL val="Net Total">' . $crm_pro['final_price'] . '</FL>';
            $crm_pro_string .= '</product>';
        }

        $contactid = crm_curl_getid('Contacts',STORE_NAME . '_' . $array['contactid'],'websiteid');

        $array['data']['CONTACTID'] = $contactid;
        $array['data']['Product Details'] = $crm_pro_string;
    }

    if($array['method'] == 'update') {

        $array['id'] = crm_curl_getid('Contacts',STORE_NAME . '_' . $array['id']);//现在目前只限于更新用户信息
    }
    $array['method'] = isset($array['method'])?$array['method']:'insert';
    $array['id'] = isset($array['id'])?$array['id']:'';

    crm_curl_post($array['action'],$array['data'],$array['method'],$array['id']);
}

function send_email_message($json) {//echo $json . '<br>--------<br>';

    $array = json_decode($json,true);//print_r($array);
    $status = zen_mail_OLD($array['to_name'], $array['to_address'], $array['email_subject'], $array['email_text'], $array['from_email_name'], $array['from_email_address'], $array['block'], $array['module'], $array['attachments_list'] );
    return $status;
}


  function zen_mail_OLD($to_name, $to_address, $email_subject, $email_text, $from_email_name, $from_email_address, $block=array(), $module='default', $attachments_list='' ) {
    global $db, $messageStack, $zco_notifier;
    if (!defined('DEVELOPER_OVERRIDE_EMAIL_STATUS') || (defined('DEVELOPER_OVERRIDE_EMAIL_STATUS') && DEVELOPER_OVERRIDE_EMAIL_STATUS == 'site'))
      if (SEND_EMAILS != 'true') return false;  // if sending email is disabled in Admin, just exit

    if (defined('DEVELOPER_OVERRIDE_EMAIL_ADDRESS') && DEVELOPER_OVERRIDE_EMAIL_ADDRESS != '') $to_address = DEVELOPER_OVERRIDE_EMAIL_ADDRESS;

    // ignore sending emails for any of the following pages
    // (The EMAIL_MODULES_TO_SKIP constant can be defined in a new file in the "extra_configures" folder)
    if (defined('EMAIL_MODULES_TO_SKIP') && in_array($module,explode(",",constant('EMAIL_MODULES_TO_SKIP')))) return false;

    // check for injection attempts. If new-line characters found in header fields, simply fail to send the message
    foreach(array($from_email_address, $to_address, $from_email_name, $to_name, $email_subject) as $key=>$value) {
      if (preg_match("/\r/",$value) || preg_match("/\n/",$value)) return false;
    }

    // if no text or html-msg supplied, exit
    if (trim($email_text) == '' && (!zen_not_null($block) || (isset($block['EMAIL_MESSAGE_HTML']) && $block['EMAIL_MESSAGE_HTML'] == '')) ) return false;

    // Parse "from" addresses for "name" <email@address.com> structure, and supply name/address info from it.
    if (preg_match("/ *([^<]*) *<([^>]*)> */",$from_email_address,$regs)) {
      $from_email_name = trim($regs[1]);
      $from_email_address = $regs[2];
    }
    // if email name is same as email address, use the Store Name as the senders 'Name'
    if ($from_email_name == $from_email_address) $from_email_name = STORE_NAME;

    // loop thru multiple email recipients if more than one listed  --- (esp for the admin's "Extra" emails)...
    foreach(explode(',',$to_address) as $key=>$value) {
      if (preg_match("/ *([^<]*) *<([^>]*)> */",$value,$regs)) {
        $to_name = str_replace('"', '', trim($regs[1]));
        $to_email_address = $regs[2];
      } elseif (preg_match("/ *([^ ]*) */",$value,$regs)) {
        $to_email_address = trim($regs[1]);
      }
      if (!isset($to_email_address)) $to_email_address=$to_address; //if not more than one, just use the main one.

      //define some additional html message blocks available to templates, then build the html portion.
      if ($block['EMAIL_TO_NAME']=='')      $block['EMAIL_TO_NAME'] = $to_name;
      if ($block['EMAIL_TO_ADDRESS']=='')   $block['EMAIL_TO_ADDRESS'] = $to_email_address;
      if ($block['EMAIL_SUBJECT']=='')      $block['EMAIL_SUBJECT'] = $email_subject;
      if ($block['EMAIL_FROM_NAME']=='')    $block['EMAIL_FROM_NAME'] = $from_email_name;
      if ($block['EMAIL_FROM_ADDRESS']=='') $block['EMAIL_FROM_ADDRESS'] = $from_email_address;
      $email_html = zen_build_html_email_from_template($module, $block);
      if (!is_array($block) && $block == '' || $block == 'none') $email_html = '';

      // Build the email based on whether customer has selected HTML or TEXT, and whether we have supplied HTML or TEXT-only components
      // special handling for XML content
      if ($email_text == '') {
        $email_text = str_replace(array('<br>','<br />'), "<br />\n", $block['EMAIL_MESSAGE_HTML']);
        $email_text = str_replace('</p>', "</p>\n", $email_text);
        $email_text = ($module != 'xml_record') ? htmlspecialchars(stripslashes(strip_tags($email_text))) : $email_text;
      } else {
        $email_text = ($module != 'xml_record') ? strip_tags($email_text,'<a><img>') : $email_text;
      }

      if ($module != 'xml_record') {
        if (!strstr($email_text, sprintf(EMAIL_DISCLAIMER, STORE_OWNER_EMAIL_ADDRESS)) && $to_email_address != STORE_OWNER_EMAIL_ADDRESS && !defined('EMAIL_DISCLAIMER_NEW_CUSTOMER')) $email_text .= "\n" . sprintf(EMAIL_DISCLAIMER, STORE_OWNER_EMAIL_ADDRESS);
        if (!strstr($email_text, EMAIL_SPAM_DISCLAIMER) && $to_email_address != STORE_OWNER_EMAIL_ADDRESS) $email_text .= "\n" . EMAIL_SPAM_DISCLAIMER;
      }

      // bof: body of the email clean-up
      // clean up &amp; and && from email text
      while (strstr($email_text, '&amp;&amp;')) $email_text = str_replace('&amp;&amp;', '&amp;', $email_text);
      while (strstr($email_text, '&amp;')) $email_text = str_replace('&amp;', '&', $email_text);
      while (strstr($email_text, '&&')) $email_text = str_replace('&&', '&', $email_text);

      // clean up currencies for text emails
      $zen_fix_currencies = preg_split("/[:,]/" , CURRENCIES_TRANSLATIONS);
      $size = sizeof($zen_fix_currencies);
      for ($i=0, $n=$size; $i<$n; $i+=2) {
        $zen_fix_current = $zen_fix_currencies[$i];
        $zen_fix_replace = $zen_fix_currencies[$i+1];
        if (strlen($zen_fix_current)>0) {
          while (strpos($email_text, $zen_fix_current)) $email_text = str_replace($zen_fix_current, $zen_fix_replace, $email_text);
        }
      }

      // fix double quotes
      while (strstr($email_text, '&quot;')) $email_text = str_replace('&quot;', '"', $email_text);
      // prevent null characters
      while (strstr($email_text, chr(0))) $email_text = str_replace(chr(0), ' ', $email_text);

      // fix slashes
      $text = stripslashes($email_text);
      $email_html = stripslashes($email_html);

      // eof: body of the email clean-up

      //determine customer's email preference type: HTML or TEXT-ONLY  (HTML assumed if not specified)
      $sql = "select customers_email_format from " . TABLE_CUSTOMERS . " where customers_email_address= :custEmailAddress:";
      $sql = $db->bindVars($sql, ':custEmailAddress:', $to_email_address, 'string');
      $result = $db->Execute($sql);
      $customers_email_format = ($result->RecordCount() > 0) ? $result->fields['customers_email_format'] : '';
      if ($customers_email_format == 'NONE' || $customers_email_format == 'OUT') return; //if requested no mail, then don't send.
//      if ($customers_email_format == 'HTML') $customers_email_format = 'HTML'; // if they opted-in to HTML messages, then send HTML format

      // handling admin/"extra"/copy emails:
      if (ADMIN_EXTRA_EMAIL_FORMAT == 'TEXT' && substr($module,-6)=='_extra') {
        $email_html='';  // just blank out the html portion if admin has selected text-only
      }
      //determine what format to send messages in if this is an admin email for newsletters:
      if ($customers_email_format == '' && ADMIN_EXTRA_EMAIL_FORMAT == 'HTML' && in_array($module, array('newsletters', 'product_notification')) && isset($_SESSION['admin_id'])) {
        $customers_email_format = 'HTML';
      }

      // special handling for XML content
      if ($module == 'xml_record') {
        $email_html = '';
        $customers_email_format =='TEXT';
      }

      //notifier intercept option
      $zco_notifier->notify('NOTIFY_EMAIL_AFTER_EMAIL_FORMAT_DETERMINED');

      // now lets build the mail object with the phpmailer class
      $mail = new PHPMailer();
      $lang_code = strtolower(($_SESSION['languages_code'] == '' ? 'en' : $_SESSION['languages_code'] ));
      $mail->SetLanguage($lang_code, DIR_FS_CATALOG . DIR_WS_CLASSES . 'support/');
      $mail->CharSet =  (defined('CHARSET')) ? CHARSET : "UTF-8";
      $mail->Encoding = (defined('EMAIL_ENCODING_METHOD')) ? EMAIL_ENCODING_METHOD : "7bit";
      if ((int)EMAIL_SYSTEM_DEBUG > 0 ) $mail->SMTPDebug = (int)EMAIL_SYSTEM_DEBUG;
      $mail->WordWrap = 76;    // set word wrap to 76 characters
      // set proper line-endings based on switch ... important for windows vs linux hosts:
      $mail->LE = (EMAIL_LINEFEED == 'CRLF') ? "\r\n" : "\n";

      switch (EMAIL_TRANSPORT) {
        case 'smtp':
          $mail->IsSMTP();
          $mail->Host = trim(EMAIL_SMTPAUTH_MAIL_SERVER);
          if (EMAIL_SMTPAUTH_MAIL_SERVER_PORT != '25' && EMAIL_SMTPAUTH_MAIL_SERVER_PORT != '') $mail->Port = trim(EMAIL_SMTPAUTH_MAIL_SERVER_PORT);
          $mail->LE = "\r\n";
          break;
        case 'smtpauth':
          $mail->IsSMTP();
          $mail->SMTPAuth = true;
          $mail->Username = (zen_not_null(EMAIL_SMTPAUTH_MAILBOX)) ? trim(EMAIL_SMTPAUTH_MAILBOX) : EMAIL_FROM;
          $mail->Password = trim(EMAIL_SMTPAUTH_PASSWORD);
          $mail->Host = trim(EMAIL_SMTPAUTH_MAIL_SERVER);
          if (EMAIL_SMTPAUTH_MAIL_SERVER_PORT != '25' && EMAIL_SMTPAUTH_MAIL_SERVER_PORT != '') $mail->Port = trim(EMAIL_SMTPAUTH_MAIL_SERVER_PORT);
          $mail->LE = "\r\n";
          //set encryption protocol to allow support for Gmail
          if (EMAIL_SMTPAUTH_MAIL_SERVER_PORT == '465' && EMAIL_SMTPAUTH_MAIL_SERVER == 'smtp.gmail.com') $mail->Protocol = 'ssl';
          if (defined('SMTPAUTH_EMAIL_PROTOCOL') && SMTPAUTH_EMAIL_PROTOCOL != 'none') {
            $mail->Protocol = SMTPAUTH_EMAIL_PROTOCOL;
            if (SMTPAUTH_EMAIL_PROTOCOL == 'starttls'){
              $mail->Starttls = true;
              $mail->Context = $Email_Certificate_Context;
            }
          }
          break;
        case 'PHP':
          $mail->IsMail();
          break;
        case 'Qmail':
          $mail->IsQmail();
          break;
        case 'sendmail':
        case 'sendmail-f':
          $mail->LE = "\n";
        default:
          $mail->IsSendmail();
          if (defined('EMAIL_SENDMAIL_PATH')) $mail->Sendmail = trim(EMAIL_SENDMAIL_PATH);
          break;
      }

      $mail->Subject  = $email_subject;
      $mail->From     = $from_email_address;
      $mail->FromName = $from_email_name;
      $mail->AddAddress($to_email_address, $to_name);
      //    $mail->AddAddress($to_email_address);    // (alternate format if no name, since name is optional)

      // set the reply-to address.  If none set yet, then use Store's default email name/address.
      // If sending from contact-us or tell-a-friend page, use the supplied info
      $email_reply_to_address = ($email_reply_to_address) ? $email_reply_to_address : (in_array($module, array('contact_us',  'tell_a_friend')) ? $from_email_address : EMAIL_FROM);
      $email_reply_to_name    = ($email_reply_to_name)    ? $email_reply_to_name    : (in_array($module, array('contact_us',  'tell_a_friend')) ? $from_email_name    : STORE_NAME);
      $mail->AddReplyTo($email_reply_to_address, $email_reply_to_name);

      // if mailserver requires that all outgoing mail must go "from" an email address matching domain on server, set it to store address
      if (EMAIL_SEND_MUST_BE_STORE=='Yes') $mail->From = EMAIL_FROM;

      if (EMAIL_TRANSPORT=='sendmail-f' || EMAIL_SEND_MUST_BE_STORE=='Yes') {
        $mail->Sender = EMAIL_FROM;
      }

      // PROCESS FILE ATTACHMENTS
      if ($attachments_list == '') $attachments_list = array();
      if (is_string($attachments_list)) {
        if (file_exists($attachments_list)) {
          $attachments_list = array(array('file' => $attachments_list));
        } elseif (file_exists(DIR_FS_CATALOG . $attachments_list)) {
          $attachments_list = array(array('file' => DIR_FS_CATALOG . $attachments_list));
        } else {
          $attachments_list = array();
        }
      }
      $zco_notifier->notify('NOTIFY_EMAIL_BEFORE_PROCESS_ATTACHMENTS', $attachments_list);
      if (defined('EMAIL_ATTACHMENTS_ENABLED') && EMAIL_ATTACHMENTS_ENABLED && is_array($attachments_list) && sizeof($attachments_list) > 0) {
        foreach($attachments_list as $key => $val) {
          $fname = (isset($val['name']) ? $val['name'] : null);
          $mimeType = (isset($val['mime_type']) && $val['mime_type'] != '' && $val['mime_type'] != 'application/octet-stream') ? $val['mime_type'] : '';
          switch (true) {
            case (isset($val['raw_data']) && $val['raw_data'] != ''):
              $fdata = $val['raw_data'];
              if ($mimeType != '') {
                $mail->AddStringAttachment($fdata, $fname, "base64", $mimeType);
              } else {
                $mail->AddStringAttachment($fdata, $fname);
              }
              break;
            case (file_exists($val['file'])): //'file' portion must contain the full path to the file to be attached
              $fdata = $val['file'];
              if ($mimeType != '') {
                $mail->AddAttachment($fdata, $fname, "base64", $mimeType);
              } else {
                $mail->AddAttachment($fdata, $fname);
              }
              break;
          } // end switch
        } //end foreach attachments_list
      } //endif attachments_enabled
      $zco_notifier->notify('NOTIFY_EMAIL_AFTER_PROCESS_ATTACHMENTS', sizeof($attachments_list));

      // prepare content sections:
      if (EMAIL_USE_HTML == 'true' && trim($email_html) != '' &&
      ($customers_email_format == 'HTML' || (ADMIN_EXTRA_EMAIL_FORMAT != 'TEXT' && substr($module,-6)=='_extra'))) {
        $mail->IsHTML(true);           // set email format to HTML
        $mail->Body    = $email_html;  // HTML-content of message
        $mail->AltBody = $text;        // text-only content of message
      }  else {                        // use only text portion if not HTML-formatted
        $mail->Body    = $text;        // text-only content of message
      }
//die($mail->Body . '<br>' . EMAIL_PAYMENT_WEBSRC_LINK);
/**
 * Send the email. If an error occurs, trap it and display it in the messageStack
 */
      $ErrorInfo = '';
      $zco_notifier->notify('NOTIFY_EMAIL_READY_TO_SEND');
      if (!($result = $mail->Send())) {
        if (IS_ADMIN_FLAG === true) {
          $messageStack->add_session(sprintf(EMAIL_SEND_FAILED . '&nbsp;'. $mail->ErrorInfo, $to_name, $to_email_address, $email_subject),'error');
        } else {
          $messageStack->add('header',sprintf(EMAIL_SEND_FAILED . '&nbsp;'. $mail->ErrorInfo, $to_name, $to_email_address, $email_subject),'error');
        }
        $ErrorInfo .= $mail->ErrorInfo . '<br />';
      }
      $zco_notifier->notify('NOTIFY_EMAIL_AFTER_SEND');

      // Archive this message to storage log
      // don't archive pwd-resets and CC numbers
      if (EMAIL_ARCHIVE == 'true'  && $module != 'password_forgotten_admin' && $module != 'cc_middle_digs' && $module != 'no_archive') {
        zen_mail_archive_write($to_name, $to_email_address, $from_email_name, $from_email_address, $email_subject, $email_html, $text, $module, $ErrorInfo );
      } // endif archiving
    } // end foreach loop thru possible multiple email addresses
    $zco_notifier->notify('NOTIFY_EMAIL_AFTER_SEND_ALL_SPECIFIED_ADDRESSES');

    if (EMAIL_FRIENDLY_ERRORS=='false' && $ErrorInfo != '') {
        echo $to_address . ' fail!' . '<br /><br />电子邮件错误: ' . $ErrorInfo;
        return false;
    } else {
        return true;
    }

    return $ErrorInfo;
  }
?>
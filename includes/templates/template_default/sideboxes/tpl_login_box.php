<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
// $Id: tpl_login_box.php,v 1.0 2003/11/21 19:16:29 ajeh Exp $
//

// Designed for Zen Cart v1.00 Alpha
// Created by: Linda McGrath ZenCart@WebMakers.com
// http://www.thewebmakerscorner.com

  $content = '<div id="loginContent" class="sideBoxContent">';

  echo zen_draw_form('login_box', zen_href_link(FILENAME_LOGIN, 'action=process', 'SSL'));

  $login_box_content = "<div>" . ENTRY_EMAIL_ADDRESS . "<br />" . zen_draw_input_field('email_address', '', 'size="20"') . "</div>
                                       <div>" . ENTRY_PASSWORD . "<br />" . zen_draw_password_field('password', '', 'size="20"') . "</div>
									   
									   <div class='btn' >" . zen_image_submit(BUTTON_IMAGE_LOGIN, BUTTON_LOGIN_ALT) . "</div>
									   
                                       <div>" . '<a href="' . zen_href_link(FILENAME_PASSWORD_FORGOTTEN, '', 'SSL') . '">' . TEXT_FORGOT_YOUR_PASSWORD . '</a>' . "<br />" . '<a href="' . zen_href_link(FILENAME_LOGIN, '', 'SSL') . '">' . TEXT_REGISTER . '</a>' . "</div>
                                       </form>";
  $content .= $login_box_content;

  $content .= '</div>';
?>
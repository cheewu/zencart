<?php
/**
 * Top Box Template
 *
 * @package templateSystem
 * @copyright Copyright 2007 iChoze Internet Solutions http://ichoze.com
 * @copyright Portions Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 */
    $content = "";
    $content .= zen_draw_form('currencies_form_header', zen_href_link(basename(preg_replace('/.php/','', $PHP_SELF)), '', $request_type, false), 'get');
    $content .= BOX_HEADING_CURRENCIES . ': ' . zen_draw_pull_down_menu('currency', $currencies_array, $_SESSION['currency'], 'onchange="this.form.submit();" class="header"') . $hidden_get_variables . zen_hide_session_id();
    $content .= '</form>';
?>
<?php
/**
 * tpl_block_checkout_shipping_address.php
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_modules_checkout_address_book.php 3101 2006-03-03 05:56:23Z drbyte $
 */
?>
<?php
/**
 * require code to get address book details
 */
  require(DIR_WS_MODULES . zen_get_module_directory('checkout_address_book.php'));
?>

<?php
    $adr_i = 0;
      while (!$addresses->EOF) {
        if($adr_i%2 == 0){
            $adr_style = "float:left;width:40%;height:300px";
        } else {
            $adr_style = "float:right;width:40%;height:300px";
        }

        if ($addresses->fields['address_book_id'] == $_SESSION['sendto']) {

          echo '      <div style="' . $adr_style . '">' . "\n";

        } else {

          echo '      <div style="' . $adr_style . '">' . "\n";

        }

?>

        <div><?php echo zen_draw_radio_field('address', $addresses->fields['address_book_id'], ($addresses->fields['address_book_id'] == $_SESSION['sendto']), 'id="name-' . $addresses->fields['address_book_id'] . '"'); ?></div>
        
        <address><?php echo zen_address_format($format_id, $addresses->fields, true, ' ', '<br />'); ?></address>
        <div><a href="javascript:if(confirm('Are you sure deleting this shipping address?')){window.location.href='<?php echo zen_href_link("checkout_shipping_address", 'delete=' . $addresses->fields['address_book_id'], 'SSL');?>';}">
		<?php echo zen_image_button('btn_delete.gif','');?></a></div>

        <!--<div><label for="name-<?php echo $addresses->fields['address_book_id']; ?>"><?php //echo zen_output_string_protected($addresses->fields['firstname'] . ' ' . $addresses->fields['lastname']); ?></label></div>-->
      </div>

     

       



<?php
        $adr_i ++;
        $addresses->MoveNext();

      }

?>
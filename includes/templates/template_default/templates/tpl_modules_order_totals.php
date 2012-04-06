<?php

/**

 * Module Template

 *

 * @package templateSystem

 * @copyright Copyright 2003-2005 Zen Cart Development Team

 * @copyright Portions Copyright 2003 osCommerce

 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0

 * @version $Id: tpl_modules_order_totals.php 2993 2006-02-08 07:14:52Z birdbrain $

 */

 ?>

<?php

/**

 * Displays order-totals modules' output

 */

  for ($i=0; $i<$size; $i++) { ?>

<div id="<?php echo str_replace('_', '', $GLOBALS[$class]->code); ?>">

    <div class="totalBox_right" id="<?php echo $GLOBALS[$class]->code . '_v'; ?>"><?php echo $GLOBALS[$class]->output[$i]['text']; ?></div>
    <input type="hidden" name="<?php echo $GLOBALS[$class]->code; ?>" id="<?php echo $GLOBALS[$class]->code; ?>" value="<?php echo $GLOBALS[$class]->output[$i]['value']; ?>" />
    <div class="totalBox_left" id="<?php echo $GLOBALS[$class]->code . '_t'; ?>"><?php echo $GLOBALS[$class]->output[$i]['title']; ?></div>

</div>
<br class="clearBoth" />
<br class="clearBoth" />

<?php } ?>


<?php
/**
 * @package admin
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: new_product_preview.php 3009 2006-02-11 15:41:10Z wilt $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
// copy image only if modified
        if (!isset($_GET['read']) || $_GET['read'] == 'only') {
          $products_image = new upload('products_image');
          $products_image->set_destination(DIR_FS_CATALOG_IMAGES_TMP . $_POST['img_dir']);
          if ($products_image->parse() && $products_image->save($_POST['overwrite']) && $products_image->change_name('main')) {
            $products_image_name = $_POST['img_dir'] . $products_image->filename;
          } else {
            $products_image_name = (isset($_POST['products_previous_image']) ? $_POST['products_previous_image'] : '');
          }
          
          //--- products_description  图片
          $products_image1 = new upload('products_image1');
          $products_image1->set_destination(DIR_FS_CATALOG_IMAGES_TMP . $_POST['img_dir']);
          if ($products_image1->parse() && $products_image1->save($_POST['overwrite']) && $products_image1->change_name()) {
            $products_image1_name = $_POST['img_dir'] . $products_image1->filename;
          } else {
            $products_image1_name = (isset($_POST['products_previous_image1']) ? $_POST['products_previous_image1'] : '');
          }
          
          $products_image2 = new upload('products_image2');
          $products_image2->set_destination(DIR_FS_CATALOG_IMAGES_TMP . $_POST['img_dir']);
          if ($products_image2->parse() && $products_image2->save($_POST['overwrite']) && $products_image2->change_name()) {
            $products_image2_name = $_POST['img_dir'] . $products_image2->filename;
          } else {
            $products_image2_name = (isset($_POST['products_previous_image2']) ? $_POST['products_previous_image2'] : '');
          }
          
          $products_image3 = new upload('products_image3');
          $products_image3->set_destination(DIR_FS_CATALOG_IMAGES_TMP . $_POST['img_dir']);
          if ($products_image3->parse() && $products_image3->save($_POST['overwrite']) && $products_image3->change_name()) {
            $products_image3_name = $_POST['img_dir'] . $products_image3->filename;
          } else {
            $products_image3_name = (isset($_POST['products_previous_image3']) ? $_POST['products_previous_image3'] : '');
          }
          
          $products_image4 = new upload('products_image4');
          $products_image4->set_destination(DIR_FS_CATALOG_IMAGES_TMP . $_POST['img_dir']);
          if ($products_image4->parse() && $products_image4->save($_POST['overwrite']) && $products_image4->change_name()) {
            $products_image4_name = $_POST['img_dir'] . $products_image4->filename;
          } else {
            $products_image4_name = (isset($_POST['products_previous_image4']) ? $_POST['products_previous_image4'] : '');
          }
          
          $products_image5 = new upload('products_image5');
          $products_image5->set_destination(DIR_FS_CATALOG_IMAGES_TMP . $_POST['img_dir']);
          if ($products_image5->parse() && $products_image5->save($_POST['overwrite']) && $products_image5->change_name()) {
            $products_image5_name = $_POST['img_dir'] . $products_image5->filename;
          } else {
            $products_image5_name = (isset($_POST['products_previous_image5']) ? $_POST['products_previous_image5'] : '');
          }
          
          $products_image6 = new upload('products_image6');
          $products_image6->set_destination(DIR_FS_CATALOG_IMAGES_TMP . $_POST['img_dir']);
          if ($products_image6->parse() && $products_image6->save($_POST['overwrite']) && $products_image6->change_name()) {
            $products_image6_name = $_POST['img_dir'] . $products_image6->filename;
          } else {
            $products_image6_name = (isset($_POST['products_previous_image6']) ? $_POST['products_previous_image6'] : '');
          }
        }
?>
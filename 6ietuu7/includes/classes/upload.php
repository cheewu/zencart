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
//  $Id: upload.php 1969 2005-09-13 06:57:21Z drbyte $
//

  class upload {
    var $file, $filename, $destination, $permissions, $extensions, $tmp_filename, $message_location;

    function upload($file = '', $destination = '', $permissions = '777', $extensions = '') {
      $this->set_file($file);
      $this->set_destination($destination);
      $this->set_permissions($permissions);
      $this->set_extensions($extensions);

      $this->set_output_messages('direct');

      if (zen_not_null($this->file) && zen_not_null($this->destination)) {
        $this->set_output_messages('session');

        if ( ($this->parse() == true) && ($this->save() == true) ) {
          return true;
        } else {
// self destruct
           while(list($key,) = each($this)) {
             $this->$key = null;
           }

          return false;
        }
      }
    }

    function parse() {
      global $messageStack;
//echo '<pre>';print_r($_FILES);die();
      if (isset($_FILES[$this->file])) {
        $file = array('name' => $_FILES[$this->file]['name'],
                      'type' => $_FILES[$this->file]['type'],
                      'size' => $_FILES[$this->file]['size'],
                      'tmp_name' => $_FILES[$this->file]['tmp_name']);
      } elseif (isset($GLOBALS['HTTP_POST_FILES'][$this->file])) {
        global $HTTP_POST_FILES;

        $file = array('name' => $HTTP_POST_FILES[$this->file]['name'],
                      'type' => $HTTP_POST_FILES[$this->file]['type'],
                      'size' => $HTTP_POST_FILES[$this->file]['size'],
                      'tmp_name' => $HTTP_POST_FILES[$this->file]['tmp_name']);
      } else {
        $file = array('name' => (isset($GLOBALS[$this->file . '_name']) ? $GLOBALS[$this->file . '_name'] : ''),
                      'type' => (isset($GLOBALS[$this->file . '_type']) ? $GLOBALS[$this->file . '_type'] : ''),
                      'size' => (isset($GLOBALS[$this->file . '_size']) ? $GLOBALS[$this->file . '_size'] : ''),
                      'tmp_name' => (isset($GLOBALS[$this->file]) ? $GLOBALS[$this->file] : ''));
      }

      if ( zen_not_null($file['tmp_name']) && ($file['tmp_name'] != 'none') && is_uploaded_file($file['tmp_name']) ) {
        if (sizeof($this->extensions) > 0) {
// modified by zen-cart.cn
          if (!in_array(GBcase(substr($file['name'], strrpos($file['name'], '.')+1),"lower"), $this->extensions)) {
            if ($this->message_location == 'direct') {
              $messageStack->add(ERROR_FILETYPE_NOT_ALLOWED, 'error');
            } else {
              $messageStack->add_session(ERROR_FILETYPE_NOT_ALLOWED, 'error');
            }

            return false;
          }
        }

        $this->set_file($file);
        $this->set_filename($file['name']);
        $this->set_tmp_filename($file['tmp_name']);

        return $this->check_destination();
      } else {
        if ($file['name'] !='' && $file['tmp_name'] !='') {
          if ($this->message_location == 'direct') {
            $messageStack->add(WARNING_NO_FILE_UPLOADED, 'warning');
          } else {
            $messageStack->add_session(WARNING_NO_FILE_UPLOADED, 'warning');
          }
        }
        return false;
      }
    }

    function save($overwrite=true) {
      global $messageStack;

      if (!$overwrite and file_exists($this->destination . $this->filename)) {
            $messageStack->add_session(TEXT_IMAGE_OVERWRITE_WARNING . $this->filename, 'caution');
            return true;
      } else {

        if (substr($this->destination, -1) != '/') $this->destination .= '/';

        if (move_uploaded_file($this->file['tmp_name'], $this->destination . $this->filename)) {
          chmod($this->destination . $this->filename, $this->permissions);

          if ($this->message_location == 'direct') {
            $messageStack->add(sprintf(SUCCESS_FILE_SAVED_SUCCESSFULLY,$this->filename), 'success');
          } else {
            $messageStack->add_session(sprintf(SUCCESS_FILE_SAVED_SUCCESSFULLY,$this->filename), 'success');
          }

          return true;
        } else {
          if ($this->message_location == 'direct') {
            $messageStack->add(ERROR_FILE_NOT_SAVED, 'error');
          } else {
            $messageStack->add_session(ERROR_FILE_NOT_SAVED, 'error');
          }

          return false;
        }
      }
    }

    function set_file($file) {
      $this->file = $file;
    }

    function set_destination($destination) {
      $this->destination = $destination;
    }

    function set_permissions($permissions) {
      $this->permissions = octdec($permissions);
    }

    function set_filename($filename) {
      $this->filename = $filename;
    }

    function set_tmp_filename($filename) {
      $this->tmp_filename = $filename;
    }

    function set_extensions($extensions) {
      if (zen_not_null($extensions)) {
        if (is_array($extensions)) {
          $this->extensions = $extensions;
        } else {
          $this->extensions = array($extensions);
        }
      } else {
        $this->extensions = array();
      }
    }

    function check_destination() {
      global $messageStack;

      if (!is_writeable($this->destination)) {
        if (is_dir($this->destination)) {
          if ($this->message_location == 'direct') {
            $messageStack->add_session(sprintf(ERROR_DESTINATION_NOT_WRITEABLE, $this->destination), 'error');
          } else {
            $messageStack->add_session(sprintf(ERROR_DESTINATION_NOT_WRITEABLE, $this->destination), 'error');
          }
        } else {
          if ($this->message_location == 'direct') {
            $messageStack->add(sprintf(ERROR_DESTINATION_DOES_NOT_EXIST, $this->destination), 'error');
          } else {
            $messageStack->add_session(sprintf(ERROR_DESTINATION_DOES_NOT_EXIST, $this->destination), 'error');
          }
        }

        return false;
      } else {
        return true;
      }
    }

    function set_output_messages($location) {
      switch ($location) {
        case 'session':
          $this->message_location = 'session';
          break;
        case 'direct':
        default:
          $this->message_location = 'direct';
          break;
      }
    }
   
    
    function change_name($type = '') {
        $new_file_name = date("YmdHis") . rand(0,100) . '.jpg';
        if($type == 'main')
            rename($this->destination . $this->filename, $this->destination . 'main/' . $new_file_name);
        else
            rename($this->destination . $this->filename, $this->destination . $new_file_name);
        $this->set_filename($new_file_name);
        
        return true;
    }

  }
?>
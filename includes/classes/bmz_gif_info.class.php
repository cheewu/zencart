<?php
/**
 * gif_info.php
 * gif-info class for transparency stuff
 *
 * @version $Id: bmz_gif_info.class.php,v 1.2 2006/04/11 22:00:55 tim Exp $
 */

   class gifinfo
   {
       var $m_transparentRed;
       var $m_transparentGreen;
       var $m_transparentBlue;
       var $m_signature;
       var $m_version;
       var $m_width;
       var $m_height;
       var $m_colorFlag;
       var $m_backgroundIndex;
      
      
       function gifinfo($filename)
       {

           $fp                        = fopen($filename,"rb");
           $result                    = fread($fp,13);
           $this->m_signature    = substr($result,0,3);
           $this->m_version        = substr($result,3,3);
           $this->m_width        = ord(substr($result,6,1)) + ord(substr($result,7,1)) * 256;
           $this->m_height        = ord(substr($result,8,1)) + ord(substr($result,9,1)) * 256;
           $this->m_colorFlag    = ord(substr($result,10,1)) >> 7;
           $this->m_background    = ord(substr($result,11));
  
           if($this->m_colorFlag)
           {
               $tableSizeNeeded = ($this->m_background + 1) * 3;
               $result = fread($fp,$tableSizeNeeded);
               $this->m_transparentRed    = ord(substr($result,$this->m_background * 3,1));
               $this->m_transparentGreen    = ord(substr($result,$this->m_background * 3 + 1,1));       
               $this->m_transparentBlue    = ord(substr($result,$this->m_background * 3 + 2,1));           
           }
           fclose($fp);
       }
   }
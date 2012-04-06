<?php
/**
 * jscript_addr_pulldowns
 *
 * handles pulldown menu dependencies for state/country selection
 *
 * @package page
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: jscript_addr_pulldowns.php 4830 2006-10-24 21:58:27Z drbyte $
 */
?>
<script language="javascript" type="text/javascript"><!--
function update_zone(theForm) {
  // if there is no zone_id field to update, or if it is hidden from display, then exit performing no updates
  if (!theForm || !theForm.elements["zone_id"]) return;
  if (theForm.zone_id.type == "hidden") return;
  // set initial values
  var SelectedCountry = theForm.zone_country_id.options[theForm.zone_country_id.selectedIndex].value;
  var SelectedZone = theForm.elements["zone_id"].value;
  // reset the array of pulldown options so it can be repopulated
  var NumState = theForm.zone_id.options.length;
  while(NumState > 0) {
    NumState = NumState - 1;
    theForm.zone_id.options[NumState] = null;
  }
  // build dynamic list of countries/zones for pulldown
<?php echo zen_js_zone_list('SelectedCountry', 'theForm', 'zone_id'); ?>
  // if we had a value before reset, set it again
  if (SelectedZone != "") theForm.elements["zone_id"].value = SelectedZone;
}
  function hideStateField(theForm) {
    theForm.state.disabled = true;
    theForm.state.className = 'hiddenField';
    theForm.state.setAttribute('className', 'hiddenField');
    document.getElementById("stateLabel").className = 'hiddenField';
    document.getElementById("stateLabel").setAttribute('className', 'hiddenField');
    document.getElementById("stText").className = 'hiddenField';
    document.getElementById("stText").setAttribute('className', 'hiddenField');
    document.getElementById("stBreak").className = 'hiddenField';
    document.getElementById("stBreak").setAttribute('className', 'hiddenField');
  }
  function showStateField(theForm) {
    theForm.state.disabled = false;
    theForm.state.className = 'inputLabel visibleField';
    theForm.state.setAttribute('className', 'visibleField');
    document.getElementById("stateLabel").className = 'inputLabel visibleField';
    document.getElementById("stateLabel").setAttribute('className', 'inputLabel visibleField');
    document.getElementById("stText").className = 'alert visibleField';
    document.getElementById("stText").setAttribute('className', 'alert visibleField');
    document.getElementById("stBreak").className = 'clearBoth visibleField';
    document.getElementById("stBreak").setAttribute('className', 'clearBoth visibleField');
  }
function copy_shipping_to_billing(theForm){//alert(theForm.elements['gender-male'].checked);
    theForm.elements['gender-male_b'].checked = theForm.elements['gender-male'].checked;
    theForm.elements['gender-female_b'].checked = theForm.elements['gender-female'].checked;
    
    theForm.firstname_b.value = theForm.firstname.value;
    theForm.lastname_b.value = theForm.lastname.value;
    theForm.street_address_b.value = theForm.street_address.value;
    theForm.suburb_b.value = theForm.suburb.value;
    
    theForm.zone_country_id_b.value = theForm.zone_country_id.value;
	theForm.telephone_b.value = theForm.telephone.value;
    update_billing_zone(theForm);
    
	theForm.postcode_b.value = theForm.postcode.value;
    theForm.city_b.value = theForm.city.value;
    theForm.zone_id_b.value = theForm.zone_id.value;
    theForm.state_b.value = theForm.state.value;
	
    //theForm.postcode_b.value = theForm.postcode.value;
	//document.getElementById("postcode_b").value = document.getElementById("postcode").value;
}
// billing
function update_billing_zone(theForm) {
  // if there is no zone_id field to update, or if it is hidden from display, then exit performing no updates
  if (!theForm || !theForm.elements["zone_id_b"]) return;
  if (theForm.zone_id_b.type == "hidden") return;
  // set initial values
  var SelectedCountry = theForm.zone_country_id_b.options[theForm.zone_country_id_b.selectedIndex].value;
  var SelectedZone = theForm.elements["zone_id_b"].value;
  // reset the array of pulldown options so it can be repopulated
  var NumState = theForm.zone_id_b.options.length;
  while(NumState > 0) {
    NumState = NumState - 1;
    theForm.zone_id_b.options[NumState] = null;
  }
  // build dynamic list of countries/zones for pulldown
<?php echo zen_js_zone_list('SelectedCountry', 'theForm', 'zone_id_b', '_b'); ?>
  // if we had a value before reset, set it again
  if (SelectedZone != "") theForm.elements["zone_id_b"].value = SelectedZone;
}
 function hideStateField_b(theForm) {
    theForm.state_b.disabled = true;
    theForm.state_b.className = 'hiddenField';
    theForm.state_b.setAttribute('className', 'hiddenField');
    document.getElementById("stateLabel_b").className = 'hiddenField';
    document.getElementById("stateLabel_b").setAttribute('className', 'hiddenField');
    document.getElementById("stText_b").className = 'hiddenField';
    document.getElementById("stText_b").setAttribute('className', 'hiddenField');
    document.getElementById("stBreak_b").className = 'hiddenField';
    document.getElementById("stBreak_b").setAttribute('className', 'hiddenField');
  }
  function showStateField_b(theForm) {
    theForm.state_b.disabled = false;
    theForm.state_b.className = 'inputLabel visibleField';
    theForm.state_b.setAttribute('className', 'visibleField');
    document.getElementById("stateLabel_b").className = 'inputLabel visibleField';
    document.getElementById("stateLabel_b").setAttribute('className', 'inputLabel visibleField');
    document.getElementById("stText_b").className = 'alert visibleField';
    document.getElementById("stText_b").setAttribute('className', 'alert visibleField');
    document.getElementById("stBreak_b").className = 'clearBoth visibleField';
    document.getElementById("stBreak_b").setAttribute('className', 'clearBoth visibleField');
  }
//--></script>
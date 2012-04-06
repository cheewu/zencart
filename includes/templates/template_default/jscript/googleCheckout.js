<!-- /* <[CDATA[ */

// preload images
function preloadImgs() {
  var imgs = ['https://checkout.google.com/seller/accept/images/sc.gif','https://checkout.google.com/seller/accept/images/gl.gif','https://checkout.google.com/seller/accept/images/x.gif','https://checkout.google.com/seller/accept/images/gcb.gif','https://checkout.google.com/seller/accept/images/ht.gif','https://checkout.google.com/seller/accept/images/st.gif'];
  for (var i = 0; i < imgs.length; i++) {
    var img = new Image();
    img.src = imgs[i];
  }
}
function setPos(n) {
	var el = $('i'+n)
	var pos = findPos(el);
	$('h'+n).style.left = pos[0]+184+'px';
	//alert(pos[0]);
	$('h'+n).style.top = pos[1]-40+'px';
}
// show/hide hidden div
function showHide(n) {
  setPos(n);
  var h = $('h'+n);
  h.style.display = (h.style.display == "none") ? "block" : "none";  
}

function showMark(n) {
	document.write('<style>#google_amark_b .h{position:absolute;width:325px;border:1px solid #ccc; background:#fff; text-align:left;padding:10px;z-index:1000;}#google_amark_b #x { position:absolute; right:0px;top:0px}#google_amark_b #i2{top:-6px}</style>');
    document.images.onload=preloadImgs();
    document.write('<span id="google_amark_b"><img class="relative" onclick="showHide(2)" src="https://checkout.google.com/seller/accept/images/ht.gif" width="182" height="44" id="i'+n+'" alt="Google Checkout Acceptance Mark" />'); 
    document.write('<div id="h'+n+'" class="h" style="display:none;"><ul id="t"><img src="https://checkout.google.com/seller/accept/images/gl.gif"  width="154" height="28" id="l" alt="Google Checkout logo" /><div id="x"><img onclick="showHide(2)" src="https://checkout.google.com/seller/accept/images/x.gif" width="16" height="16" alt="" /></div></ul><ul id="c"><p>Google Checkout is a fast, secure way to buy from stores across the web.</p><p class="p">When it\'s time to buy, look for the <img src="https://checkout.google.com/seller/accept/images/gcb.gif" width="104" height="19" alt="Google Checkout button image" /> button.</p><p>Use it once and stop creating new accounts every time you buy. <a href="https://checkout.google.com/buyer/tour.html" target="_blank">Learn more</a></p></ul></div></span>');
 
}
showMark(2);
/* ]]> */ //-->

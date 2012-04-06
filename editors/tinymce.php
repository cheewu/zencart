
<script language="javascript" type="text/javascript" src="<?php echo DIR_WS_CATALOG; ?>editors/tiny_mce/tiny_mce_gzip.php"></script>
	<script language="javascript" type="text/javascript">
		tinyMCE.init({
<?php if (strstr($PHP_SELF, 'newsletters') || strstr($PHP_SELF, 'mail') || (strstr($PHP_SELF, 'coupon_admin') && $_GET['action']=='email') ) { ?>
		mode : "exact",
		elements : "message_html",
		editor_selector : "editorHook",
<?php } else { ?>
		mode : "textareas",
<?php } ?>
		theme : "advanced",
		width : "100%",
		height : "460",
		relative_urls : false,
		remove_script_host : true,
		document_base_url : "<?php echo HTTP_SERVER . DIR_WS_CATALOG; ?>",
		plugins : "ibrowser,table,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,zoom,searchreplace,print,paste,directionality,fullscreen,noneditable,contextmenu",
		theme_advanced_buttons1_add : "fontselect,fontsizeselect,forecolor,ibrowser",
		theme_advanced_buttons2_add : "separator,insertdate,inserttime,preview,zoom,separator,backcolor,liststyle",
		theme_advanced_buttons2_add_before: "cut,copy,paste,pastetext,pasteword,separator,search,replace,separator",
		theme_advanced_buttons3_add_before : "tablecontrols,separator",
		theme_advanced_buttons3_add : "emotions,iespell,advhr,separator,print,separator,ltr,rtl,separator,fullscreen",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "center",
		theme_advanced_disable : "image",
		theme_advanced_statusbar_location : "bottom",
		content_css : "<?php echo HTTP_SERVER . DIR_WS_CATALOG; ?>editors/tinymce.css",
		plugin_insertdate_dateFormat : "%Y-%m-%d",
		plugin_insertdate_timeFormat : "%H:%M:%S",
		extended_valid_elements : "hr[class|width|size|noshade]",
		file_browser_callback : "fileBrowserCallBack",
		custom_undo_redo_levels : 10,
		paste_use_dialog : false

	});
	</script>
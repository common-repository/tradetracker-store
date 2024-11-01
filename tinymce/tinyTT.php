<?php
function TTtinymce() {
?>
<html>
<head>
<title>Select Store</title>
</head>
<body>
<?php

	global $wpdb;
	global $ttstoremultitable;
	$path = ABSPATH . WPINC . '/js/jquery/jquery.js';
	wp_enqueue_script('jquery', $path);
	$path = ABSPATH . WPINC . '/js/tinymce/tiny_mce_popup.js';
	wp_enqueue_script('my-tinymce-popup', $path);
?>
	<script type="text/javascript">
		var TTTiny = {
	e: '',
	init: function(e) {
		TTTiny.e = e;
		tinyMCEPopup.resizeToInnerSize();
	},
	insert: function createTTShortcode(e) {
		//Create gallery Shortcode
		var store = jQuery('#store').val();
		<?php $ttsliderenable = get_option("Tradetracker_sliderenable");
		if($ttsliderenable == "1"){ ?>
			var output = '[display_filter ';
			if(store) {
				output += 'store="'+store+'"';
			}
			output += ']';
		<?php } else { ?>
			var output = '';
		<?php } ?>
		output += '[display_pages ';
		if(store) {
			output += 'store="'+store+'"';
		}
		output += ']';
		output += '[user_pages ';
		if(store) {
			output += 'store="'+store+'"';
		}
		output += ']';
		output += '[user_sort ';
		if(store) {
			output += 'store="'+store+'"';
		}
		output += ']<div class="cleared"></div>';
		output += '[display_multi ';
		if(store) {
			output += 'store="'+store+'"';
		}
		output += ']<div class="cleared"></div>';
		output += '[display_pages ';
		if(store) {
			output += 'store="'+store+'"';
		}
		output += ']';
		output += '[user_pages ';
		if(store) {
			output += 'store="'+store+'"';
		}
		output += ']';

		tinyMCEPopup.execCommand('mceReplaceContent', false, output);

		tinyMCEPopup.close();

	}
}
tinyMCEPopup.onInit.add(TTTiny.init, TTTiny);
	</script>

<form id="TTShortcode" style="font-size: 13px; text-align: center;">
<?php _e('Which Store:','tradetracker-store'); ?> <select name="store" id="store" style="font-size:13px;">
<?php
	$storeoverview=$wpdb->get_results("SELECT id, multiname FROM ".$ttstoremultitable."");
	foreach ($storeoverview as $store_val){
		echo "<option value=\"".esc_attr($store_val->id)."\">".esc_attr($store_val->multiname)."</option>";
	}
?>
</select>
</form>
<div class="mceActionPanel">
<div style="margin: 8px auto; text-align: center;padding-bottom: 10px;">
<input id="apply" type="button" onclick="javascript:TTTiny.insert(TTTiny.e);" title="Insert" value="<?php esc_attr_e('Insert') ?>" name="Insert">
<input id="cancel" type="button" onclick="tinyMCEPopup.close();" title="Close" value="<?php esc_attr_e('Close') ?>" name="cancel">
</div>
</div>
</body>
</html>
<?php
}
?>
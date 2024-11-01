<?php
function pluginsettings(){
	//global variables
	global $wpdb;
	global $ttstoresubmit;
	global $ttstorehidden;

	//variables for this function
	$Tradetracker_fancylink_name = 'Tradetracker_fancylink';
	$Tradetracker_debugemail_name = 'Tradetracker_debugemail';
	$Tradetracker_importtool_name = 'Tradetracker_importtool';
	$Tradetracker_loadextra_name = 'Tradetracker_loadextra';
	$Tradetracker_removelayout_name = 'Tradetracker_removelayout';
	$Tradetracker_removestores_name = 'Tradetracker_removestores';
	$Tradetracker_removeproducts_name = 'Tradetracker_removeproducts';
	$Tradetracker_removexml_name = 'Tradetracker_removexml';
	$Tradetracker_removeother_name = 'Tradetracker_removeother';
	$Tradetracker_adminheight_name = 'Tradetracker_adminheight';
	$Tradetracker_adminwidth_name = 'Tradetracker_adminwidth';
	$Tradetracker_showurl_name = 'Tradetracker_showurl';
	$Tradetracker_usecss_name = 'Tradetracker_usecss';
	$Tradetracker_csslink_name = 'Tradetracker_csslink';
	$Tradetracker_TTnewcategory_name = 'TTnewcategory';
	$Tradetracker_slidertheme_name = 'Tradetracker_slidertheme';
	$Tradetracker_sliderenable_name = 'Tradetracker_sliderenable';


	//filling variables from database
	$Tradetracker_fancylink_val = get_option( $Tradetracker_fancylink_name );
	$Tradetracker_debugemail_val = get_option( $Tradetracker_debugemail_name );
	$Tradetracker_importtool_val = get_option( $Tradetracker_importtool_name );
	$Tradetracker_loadextra_val = get_option( $Tradetracker_loadextra_name );
	$Tradetracker_removelayout_val = get_option( $Tradetracker_removelayout_name );
	$Tradetracker_removestores_val = get_option( $Tradetracker_removestores_name );
	$Tradetracker_removeproducts_val = get_option( $Tradetracker_removeproducts_name );
	$Tradetracker_removexml_val = get_option( $Tradetracker_removexml_name );
	$Tradetracker_removeother_val = get_option( $Tradetracker_removeother_name );
	$Tradetracker_adminheight_val = get_option( $Tradetracker_adminheight_name );
	$Tradetracker_adminwidth_val = get_option( $Tradetracker_adminwidth_name );
	$Tradetracker_showurl_val = get_option( $Tradetracker_showurl_name );
	$Tradetracker_usecss_val = get_option( $Tradetracker_usecss_name );
	$Tradetracker_csslink_val = get_option( $Tradetracker_csslink_name );
	$Tradetracker_TTnewcategory_val = get_option( $Tradetracker_TTnewcategory_name );
	$Tradetracker_slidertheme_val = get_option( $Tradetracker_slidertheme_name );
	$Tradetracker_sliderenable_val = get_option( $Tradetracker_sliderenable_name );



	//see if form has been submitted
	if( isset($_POST[ $ttstoresubmit ]) && $_POST[ $ttstoresubmit ] == 'Y' ) {
		$Tradetracker_fancylink_val = ttstore_sanitize($_POST[ $Tradetracker_fancylink_name ]);
		$Tradetracker_debugemail_val = ttstore_sanitize($_POST[ $Tradetracker_debugemail_name ]);
		$Tradetracker_importtool_val = ttstore_sanitize($_POST[ $Tradetracker_importtool_name ]);
		$Tradetracker_loadextra_val = ttstore_sanitize($_POST[ $Tradetracker_loadextra_name ]);
		$Tradetracker_removelayout_val = ttstore_sanitize($_POST[ $Tradetracker_removelayout_name ]);
		$Tradetracker_removestores_val = ttstore_sanitize($_POST[ $Tradetracker_removestores_name ]);
		$Tradetracker_removeproducts_val = ttstore_sanitize($_POST[ $Tradetracker_removeproducts_name ]);
		$Tradetracker_removexml_val = ttstore_sanitize($_POST[ $Tradetracker_removexml_name ]);
		$Tradetracker_removeother_val = ttstore_sanitize($_POST[ $Tradetracker_removeother_name ]);
		$Tradetracker_adminheight_val = ttstore_sanitize($_POST[ $Tradetracker_adminheight_name ]);
		$Tradetracker_adminwidth_val = ttstore_sanitize($_POST[ $Tradetracker_adminwidth_name ]);
		$Tradetracker_showurl_val = ttstore_sanitize($_POST[ $Tradetracker_showurl_name ]);
		$Tradetracker_usecss_val = ttstore_sanitize($_POST[ $Tradetracker_usecss_name ]);
		$Tradetracker_csslink_val = ttstore_sanitize($_POST[ $Tradetracker_csslink_name ]);
		$Tradetracker_TTnewcategory_val = ttstore_sanitize($_POST[ $Tradetracker_TTnewcategory_name ]);
		$Tradetracker_slidertheme_val = ttstore_sanitize($_POST[ $Tradetracker_slidertheme_name ]);
		$Tradetracker_sliderenable_val = ttstore_sanitize($_POST[ $Tradetracker_sliderenable_name ]);

		if ( get_option("Tradetracker_fancylink")  != $Tradetracker_fancylink_val) {
			update_option( $Tradetracker_fancylink_name, $Tradetracker_fancylink_val );
		}
		if ( get_option("Tradetracker_debugemail")  != $Tradetracker_debugemail_val) {
			update_option( $Tradetracker_debugemail_name, $Tradetracker_debugemail_val );
		}
		if ( get_option("Tradetracker_importtool")  != $Tradetracker_importtool_val) {
			update_option( $Tradetracker_importtool_name, $Tradetracker_importtool_val );
		}
		if ( get_option("Tradetracker_loadextra")  != $Tradetracker_loadextra_val) {
			update_option( $Tradetracker_loadextra_name, $Tradetracker_loadextra_val );
		}
		if ( get_option("Tradetracker_removelayout")  != $Tradetracker_removelayout_val) {
			update_option( $Tradetracker_removelayout_name, $Tradetracker_removelayout_val );
		}
		if ( get_option("Tradetracker_removestores")  != $Tradetracker_removestores_val) {
			update_option( $Tradetracker_removestores_name, $Tradetracker_removestores_val );
		}
		if ( get_option("Tradetracker_removeproducts")  != $Tradetracker_removeproducts_val) {
			update_option( $Tradetracker_removeproducts_name, $Tradetracker_removeproducts_val );
		}
		if ( get_option("Tradetracker_removexml")  != $Tradetracker_removexml_val) {
			update_option( $Tradetracker_removexml_name, $Tradetracker_removexml_val );
		}
		if ( get_option("Tradetracker_removeother")  != $Tradetracker_removeother_val) {
			update_option( $Tradetracker_removeother_name, $Tradetracker_removeother_val );
		}
		if ( get_option("Tradetracker_adminheight") != "" && get_option("Tradetracker_adminheight")  != $Tradetracker_adminheight_val) {
			update_option( $Tradetracker_adminheight_name, $Tradetracker_adminheight_val );
		}
		if ( get_option("Tradetracker_adminwidth") != "" && get_option("Tradetracker_adminwidth")  != $Tradetracker_adminwidth_val) {
			update_option( $Tradetracker_adminwidth_name, $Tradetracker_adminwidth_val );
		}
		if ( get_option("Tradetracker_showurl")  != $Tradetracker_showurl_val) {
			update_option( $Tradetracker_showurl_name, $Tradetracker_showurl_val );
		}
		if ( get_option("Tradetracker_usecss")  != $Tradetracker_usecss_val) {
			update_option( $Tradetracker_usecss_name, $Tradetracker_usecss_val );
		}
		if ( get_option("Tradetracker_csslink")  != $Tradetracker_csslink_val) {
			update_option( $Tradetracker_csslink_name, $Tradetracker_csslink_val );
		}
		if ( get_option("TTnewcategory")  != $Tradetracker_TTnewcategory_val) {
			update_option( $Tradetracker_TTnewcategory_name, $Tradetracker_TTnewcategory_val );
		}
		if ( get_option("Tradetracker_slidertheme")  != $Tradetracker_slidertheme_val) {
			update_option( $Tradetracker_slidertheme_name, $Tradetracker_slidertheme_val );
		}
		if ( get_option("Tradetracker_sliderenable")  != $Tradetracker_sliderenable_val) {
			update_option( $Tradetracker_sliderenable_name, $Tradetracker_sliderenable_val );
		}

	        //put an settings updated message on the screen
		$savedmessage = __("Settings saved", "ttstore");
		$saved = "<div id=\"ttstoreboxsaved\"><strong>".$savedmessage."</strong></div>";
	}
?>
<?php $adminwidth = get_option("Tradetracker_adminwidth"); ?>
<?php $adminheight = get_option("Tradetracker_adminheight"); ?>

<div  id="TB_overlay" class="TB_overlayBG"></div>
<div id="TB_window1" style="left: auto;margin-left: auto;margin-right: auto; margin-top: 0;right: auto;top: 48px;visibility: visible;z-index:100051;width: <?php echo esc_attr($adminwidth); ?>px;">
	<div id="ttstorebox">
	<form name="form1" method="post" action="">
	<?php echo $ttstorehidden; ?>
		<div id="TB_title">
			<div id="TB_ajaxWindowTitle"><? _e('Change plugin options.','tradetracker-store'); ?></div>
			<div id="TB_closeAjaxWindow">
				<a title="Close" id="TB_closeWindowButton" href="admin.php?page=tt-store">
					<img src="<?php echo plugins_url( 'images/tb-close.png' , __FILE__ )?>">
				</a>
			</div>
		</div>
		<div id="ttstoreboxoptions" style="max-height:<?php echo esc_attr($adminheight); ?>px;">
			<table width="<?php echo esc_attr($adminwidth)-15; ?>">
				<tr>
					<td width="400px">
						<label for="tradetrackerusenewcategorye" title="<?php _e('Do you want to use new category structure.','tradetracker-store');?>" class="info">
							<?php _e("Do you want to use new category structure:", 'tradetracker-store' ); ?> 
							<br />
							<?php _e('If you change this you will have to manually reselect all categories for all your stores.','tradetracker-store');?>
						</label>
					</td>
					<td>
						<input type="radio" name="<?php echo esc_attr($Tradetracker_TTnewcategory_name); ?>" <?php if($Tradetracker_TTnewcategory_val==1) {echo "checked";} ?> value="1"> <?php _e('Yes','tradetracker-store');?>
						<br>
						<input type="radio" name="<?php echo esc_attr($Tradetracker_TTnewcategory_name); ?>" <?php if($Tradetracker_TTnewcategory_val==0){echo "checked";} ?> value="0"> <?php _e('No','tradetracker-store');?>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<hr />
					</td>
				</tr>
				<tr>
					<td width="400px">
						<label for="tradetrackersliderenable" title="<?php _e('Do you want to use a price slider.','tradetracker-store');?>" class="info">
							<?php _e("Do you want to use the price slider:", 'tradetracker-store' ); ?> 
						</label>
					</td>
					<td>
						<input type="radio" name="<?php echo esc_attr($Tradetracker_sliderenable_name); ?>" <?php if($Tradetracker_sliderenable_val==1) {echo "checked";} ?> value="1"> <?php _e('Yes','tradetracker-store');?>
						<br>
						<input type="radio" name="<?php echo esc_attr($Tradetracker_sliderenable_name); ?>" <?php if($Tradetracker_sliderenable_val==0){echo "checked";} ?> value="0"> <?php _e('No','tradetracker-store');?>
					</td>
				</tr>
				<tr>
					<td width="400px">
						<label for="tradetrackerslidertheme" title="<?php _e('Choose the theme of the price slider.','tradetracker-store');?>" class="info">
							<?php _e("Choose the theme of the price slider:", 'tradetracker-store' ); ?> 
							<br />
							<?php _e('You can preview them by going to Gallery on http://jqueryui.com/themeroller/.','tradetracker-store');?>
						</label>
					</td>
					<td>
						<select name="<?php echo esc_attr($Tradetracker_slidertheme_name); ?>">
							<option <?php if($Tradetracker_slidertheme_val == "base") { echo "selected=\"selected\""; } ?> value="base">Base</option>
							<option <?php if($Tradetracker_slidertheme_val == "ui-lightness") { echo "selected=\"selected\""; } ?> value="ui-lightness">Ui Lightness</option>
							<option <?php if($Tradetracker_slidertheme_val == "ui-darkness") { echo "selected=\"selected\""; } ?> value="ui-darkness">Ui Darkness</option>
							<option <?php if($Tradetracker_slidertheme_val == "smoothness") { echo "selected=\"selected\""; } ?> value="smoothness">Smoothness</option>
							<option <?php if($Tradetracker_slidertheme_val == "start") { echo "selected=\"selected\""; } ?> value="start">Start</option>
							<option <?php if($Tradetracker_slidertheme_val == "redmond") { echo "selected=\"selected\""; } ?> value="redmond">Redmond</option>
							<option <?php if($Tradetracker_slidertheme_val == "sunny") { echo "selected=\"selected\""; } ?> value="sunny">Sunny</option>
							<option <?php if($Tradetracker_slidertheme_val == "overcast") { echo "selected=\"selected\""; } ?> value="overcast">Overcast</option>
							<option <?php if($Tradetracker_slidertheme_val == "le-frog") { echo "selected=\"selected\""; } ?> value="le-frog">Le Frog</option>
							<option <?php if($Tradetracker_slidertheme_val == "flick") { echo "selected=\"selected\""; } ?> value="flick">Flick</option>
							<option <?php if($Tradetracker_slidertheme_val == "pepper-grinder") { echo "selected=\"selected\""; } ?> value="pepper-grinder">Pepper Grinder</option>
							<option <?php if($Tradetracker_slidertheme_val == "eggplant") { echo "selected=\"selected\""; } ?> value="eggplant">Eggplant</option>
							<option <?php if($Tradetracker_slidertheme_val == "dark-hive") { echo "selected=\"selected\""; } ?> value="dark-hive">Dark Hive</option>
							<option <?php if($Tradetracker_slidertheme_val == "cupertino") { echo "selected=\"selected\""; } ?> value="cupertino">Cupertino</option>
							<option <?php if($Tradetracker_slidertheme_val == "south-street") { echo "selected=\"selected\""; } ?> value="south-street">South Street</option>
							<option <?php if($Tradetracker_slidertheme_val == "blitzer") { echo "selected=\"selected\""; } ?> value="blitzer">Blitzer</option>
							<option <?php if($Tradetracker_slidertheme_val == "humanity") { echo "selected=\"selected\""; } ?> value="humanity">Humanity</option>
							<option <?php if($Tradetracker_slidertheme_val == "hot-sneaks") { echo "selected=\"selected\""; } ?> value="hot-sneaks">Hot Sneaks</option>
							<option <?php if($Tradetracker_slidertheme_val == "excite-bike") { echo "selected=\"selected\""; } ?> value="excite-bike">Excite Bike</option>
							<option <?php if($Tradetracker_slidertheme_val == "vader") { echo "selected=\"selected\""; } ?> value="vader">Vader</option>
							<option <?php if($Tradetracker_slidertheme_val == "dot-luv") { echo "selected=\"selected\""; } ?> value="dot-luv">Dot Luv</option>
							<option <?php if($Tradetracker_slidertheme_val == "mint-choc") { echo "selected=\"selected\""; } ?> value="mint-choc">Mint Choc</option>
							<option <?php if($Tradetracker_slidertheme_val == "black-tie") { echo "selected=\"selected\""; } ?> value="black-tie">Black Tie</option>
							<option <?php if($Tradetracker_slidertheme_val == "trontastic") { echo "selected=\"selected\""; } ?> value="trontastic">Trontastic</option>
							<option <?php if($Tradetracker_slidertheme_val == "swanky-purse") { echo "selected=\"selected\""; } ?> value="swanky-purse">Swanky Purse</option>
						</select>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<hr />
					</td>
				</tr>

				<tr>
					<td width="400px">
						<label for="tradetrackerusecss" title="<?php _e('If you want to create your own CSS file.','tradetracker-store');?>" class="info">
							<?php _e("Do you want to use a CSS file.:", 'tradetracker-store' ); ?> 
							<br />
							<?php _e('If you enable this you won\'t be able to use add/delete layout. You can however use your own css file.','tradetracker-store');?>
						</label>
					</td>
					<td>
						<input type="radio" name="<?php echo esc_attr($Tradetracker_usecss_name); ?>" <?php if($Tradetracker_usecss_val==1) {echo "checked";} ?> value="1"> <?php _e('Yes','tradetracker-store');?>
						<br>
						<input type="radio" name="<?php echo esc_attr($Tradetracker_usecss_name); ?>" <?php if($Tradetracker_usecss_val==0){echo "checked";} ?> value="0"> <?php _e('No','tradetracker-store');?>
					</td>
				</tr>
				<tr>
					<td>
						<label for="tradetrackercsslink" title="<?php _e('Where is the CSS file located','tradetracker-store');?>" class="info">
							<?php _e("Full url to the CSS file:", 'tradetracker-store' ); ?> 
						</label>
					</td>
					<td>
						<input type="text" name="<?php echo esc_attr($Tradetracker_csslink_name); ?>" value="<?php echo esc_attr($Tradetracker_csslink_val); ?>" size="70"> <br />
<?php $exampleurl = plugins_url( 'style.css' , __FILE__ ); ?>
<?php printf(__('Make sure this is not saved in the plugins folder. Cause that will be overwritten with an update. For an example go to <a href="%s" target="_blank">here</a>','tradetracker-store'),$exampleurl);?>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<hr />
					</td>
				</tr>
				<tr>
					<td width="400px">
						<label for="tradetrackerdebugemail" title="<?php _e('Do you like to get an email when XML feeds are not imported?', 'tradetracker-store');?>" class="info">
							<?php _e("Get email when import fails:", 'tradetracker-store' ); ?> 
						</label>
					</td>
					<td>
						<input type="radio" name="<?php echo esc_attr($Tradetracker_debugemail_name); ?>" <?php if($Tradetracker_debugemail_val==1) {echo "checked";} ?> value="1"> <?php _e('Yes','tradetracker-store');?>
						<br>
						<input type="radio" name="<?php echo esc_attr($Tradetracker_debugemail_name); ?>" <?php if($Tradetracker_debugemail_val==0){echo "checked";} ?> value="0"> <?php _e('No','tradetracker-store');?>
					</td>
				</tr>
				<tr>
					<td width="400px">
						<label for="tradetrackerfancylink" title="<?php _e('Would you like to show a link in the lightbox?', 'tradetracker-store');?>" class="info">
							<?php _e("Product link in lightbox:", 'tradetracker-store' ); ?> 
						</label>
					</td>
					<td>
						<input type="radio" name="<?php echo esc_attr($Tradetracker_fancylink_name); ?>" <?php if($Tradetracker_fancylink_val==1) {echo "checked";} ?> value="1"> <?php _e('Yes','tradetracker-store');?>
						<br>
						<input type="radio" name="<?php echo esc_attr($Tradetracker_fancylink_name); ?>" <?php if($Tradetracker_fancylink_val==0){echo "checked";} ?> value="0"> <?php _e('No','tradetracker-store');?>
					</td>
				</tr>
				<tr>
					<td>
						<label for="tradetrackerimporttool" title="<?php _e('Which tool should be used to import XML?','tradetracker-store'); ?>" class="info">
							<?php _e("Which import tool:", 'tradetracker-store' ); ?> 
						</label>
					</td>
					<td>
						<?php if (ini_get('allow_url_fopen') == true) { ?>
							<input type="radio" name="<?php echo esc_attr($Tradetracker_importtool_name); ?>" <?php if($Tradetracker_importtool_val==1) {echo "checked";} ?> value="1"> <?php _e('Fopen (most reliable)','tradetracker-store'); ?>
						<?php } ?>
						<?php if (function_exists('curl_init')) { ?>
							<br>
							<input type="radio" name="<?php echo esc_attr($Tradetracker_importtool_name); ?>" <?php if($Tradetracker_importtool_val==2){echo "checked";} ?> value="2"> <?php _e('Curl/Fwrite (can run out of memory)','tradetracker-store'); ?>
							<br>
							<input type="radio" name="<?php echo esc_attr($Tradetracker_importtool_name); ?>" <?php if($Tradetracker_importtool_val==3){echo "checked";} ?> value="3"> <?php _e('Curl (sometimes causes issues)','tradetracker-store'); ?>
						<?php } ?>
					</td>
				</tr>
				<tr>
					<td>
						<label for="tradetrackerloadextra" title="<?php _e('Load the extra fields in the database, if you don\'t use extra fields it is smarter to disable them here','tradetracker-store'); ?>" class="info">
							<?php _e("Import extra fields:", 'tradetracker-store' ); ?> 
						</label>
					</td>
					<td>
						<input type="radio" name="<?php echo esc_attr($Tradetracker_loadextra_name); ?>" <?php if($Tradetracker_loadextra_val==1) {echo "checked";} ?> value="1"> <?php _e('Yes','tradetracker-store'); ?>
						<br>
						<input type="radio" name="<?php echo esc_attr($Tradetracker_loadextra_name); ?>" <?php if($Tradetracker_loadextra_val==0){echo "checked";} ?> value="0"> <?php _e('No','tradetracker-store'); ?> <?php _e('(Can prevent timeouts, But then you cannot show extra fields)','tradetracker-store'); ?>
					</td>
				</tr>
				<tr>
					<td>
						<label for="tradetrackeradminheight" title="<?php _e('What height should the admin menu be?, standard is 460','tradetracker-store'); ?>" class="info">
							<?php _e("Admin menu height:", 'tradetracker-store' ); ?> 
						</label>
					</td>
					<td>
						<input type="text" name="<?php echo esc_attr($Tradetracker_adminheight_name); ?>" value="<?php echo esc_attr($Tradetracker_adminheight_val); ?>" size="20">
					</td>
				</tr>
				<tr>
					<td>
						<label for="tradetrackeradminwidth" title="<?php _e('What width should the admin menu be?, standard is 1000','tradetracker-store'); ?>" class="info">
							<?php _e("Admin menu width:", 'tradetracker-store' ); ?> 
						</label>
					</td>
					<td>
						<input type="text" name="<?php echo esc_attr($Tradetracker_adminwidth_name); ?>" value="<?php echo esc_attr($Tradetracker_adminwidth_val); ?>" size="20">
					</td>
				</tr>
				<tr>
					<td>
						<label for="tradetrackershowurl" title="<?php _e('Show url to plugin website in the source of the site','tradetracker-store'); ?>" class="info">
							<?php _e("Show url to plugin website in the source:", 'tradetracker-store' ); ?> 
						</label>
					</td>
					<td>
						<input type="radio" name="<?php echo esc_attr($Tradetracker_showurl_name); ?>" <?php if($Tradetracker_showurl_val==1) {echo "checked";} ?> value="1"> <?php _e('Yes','tradetracker-store'); ?>
						<br>
						<input type="radio" name="<?php echo esc_attr($Tradetracker_showurl_name); ?>" <?php if($Tradetracker_showurl_val==0){echo "checked";} ?> value="0"> <?php _e('No','tradetracker-store'); ?>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<hr />
						<?php _e('What should happen when you deactivate the plugin:','tradetracker-store'); ?>
					</td>
				<tr>
					<td>
						<label for="tradetrackerremovelayout" title="<?php _e('Should all layouts be removed','tradetracker-store'); ?>" class="info">
							<?php _e("Remove all layouts:", 'tradetracker-store' ); ?> 
						</label>
					</td>
					<td>
						<input type="radio" name="<?php echo esc_attr($Tradetracker_removelayout_name); ?>" <?php if($Tradetracker_removelayout_val==1) {echo "checked";} ?> value="1"> <?php _e('Yes','tradetracker-store'); ?> 
						<br>
						<input type="radio" name="<?php echo esc_attr($Tradetracker_removelayout_name); ?>" <?php if($Tradetracker_removelayout_val==0){echo "checked";} ?> value="0"> <?php _e('No','tradetracker-store'); ?>
					</td>
				</tr>
				<tr>
					<td>
						<label for="tradetrackerremovestores" title="<?php _e('Should all stores be removed','tradetracker-store'); ?>" class="info">
							<?php _e("Remove all stores:", 'tradetracker-store' ); ?> 
						</label>
					</td>
					<td>
						<input type="radio" name="<?php echo esc_attr($Tradetracker_removestores_name); ?>" <?php if($Tradetracker_removestores_val==1) {echo "checked";} ?> value="1"> <?php _e('Yes','tradetracker-store'); ?>
						<br>
						<input type="radio" name="<?php echo esc_attr($Tradetracker_removestores_name); ?>" <?php if($Tradetracker_removestores_val==0){echo "checked";} ?> value="0"> <?php _e('No','tradetracker-store'); ?>
					</td>
				</tr>
				<tr>
					<td>
						<label for="tradetrackerremoveproducts" title="<?php _e('Should all products be removed','tradetracker-store'); ?>" class="info">
							<?php _e("Remove all products:", 'tradetracker-store' ); ?> 
						</label>
					</td>
					<td>
						<input type="radio" name="<?php echo esc_attr($Tradetracker_removeproducts_name); ?>" <?php if($Tradetracker_removeproducts_val==1) {echo "checked";} ?> value="1"> <?php _e('Yes','tradetracker-store'); ?>
						<br>
						<input type="radio" name="<?php echo esc_attr($Tradetracker_removeproducts_name); ?>" <?php if($Tradetracker_removeproducts_val==0){echo "checked";} ?> value="0"> <?php _e('No','tradetracker-store'); ?>
					</td>
				</tr>
				<tr>
					<td>
						<label for="tradetrackerremovexml" title="<?php _e('Should all XML settings be removed','tradetracker-store'); ?>" class="info">
							<?php _e("Remove all XML settings:", 'tradetracker-store' ); ?> 
						</label>
					</td>
					<td>
						<input type="radio" name="<?php echo esc_attr($Tradetracker_removexml_name); ?>" <?php if($Tradetracker_removexml_val==1) {echo "checked";} ?> value="1"> <?php _e('Yes','tradetracker-store'); ?>
						<br>
						<input type="radio" name="<?php echo esc_attr($Tradetracker_removexml_name); ?>" <?php if($Tradetracker_removexml_val==0){echo "checked";} ?> value="0"> <?php _e('No','tradetracker-store'); ?>
					</td>
				</tr>
				<tr>
					<td>
						<label for="tradetrackerremovexml" title="<?php _e('Should all other settings be removed','tradetracker-store'); ?>" class="info">
							<?php _e("Remove all other settings:", 'tradetracker-store' ); ?> 
						</label>
					</td>
					<td>
						<input type="radio" name="<?php echo esc_attr($Tradetracker_removeother_name); ?>" <?php if($Tradetracker_removeother_val==1) {echo "checked";} ?> value="1"> <?php _e('Yes','tradetracker-store'); ?>
						<br>
						<input type="radio" name="<?php echo esc_attr($Tradetracker_removeother_name); ?>" <?php if($Tradetracker_removeother_val==0){echo "checked";} ?> value="0"> <?php _e('No','tradetracker-store'); ?>
					</td>
				</tr>
			</table>
		</div>
		<div id="ttstoreboxbottom">
			<?php
				if(isset($saved)){
					echo wp_kses_post($saved);
				}
			?>
			<input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Save Changes') ?>" /> 
			<INPUT type="button" name="Close" class="button-secondary" value="<?php esc_attr_e('Close') ?>" onclick="location.href='admin.php?page=tt-store'"> 
		</div>
	</form>
	</div>
</div>
<?php
}
?>
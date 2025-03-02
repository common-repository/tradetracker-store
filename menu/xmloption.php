<?php
function xmloption(){
	//global variables
	global $wpdb;
	global $ttstoresubmit;
	global $ttstorehidden;
	global $ttstoretable;
	global $ttstoreextratable;

	//variables for this function


	$Tradetracker_xmlfeedsperupdate_name = 'Tradetracker_xmlfeedsperupdate';
	$Tradetracker_xmlupdate_name = 'Tradetracker_xmlupdate';
	$Tradetracker_currency_name = 'Tradetracker_currency';
	$Tradetracker_currencyloc_name = 'Tradetracker_currencyloc';
	$Tradetracker_newcur_name = 'Tradetracker_newcur';
	$Tradetracker_extra_name = 'Tradetracker_extra';

	//filling variables from database
	$Tradetracker_xmlfeedsperupdate_val = get_option( $Tradetracker_xmlfeedsperupdate_name );
	$Tradetracker_xmlupdate_val = get_option( $Tradetracker_xmlupdate_name );
	$Tradetracker_currency_val = get_option( $Tradetracker_currency_name );
	$Tradetracker_currencyloc_val = get_option( $Tradetracker_currencyloc_name );
	$Tradetracker_newcur_val = get_option( $Tradetracker_newcur_name );
	$Tradetracker_extra_val = get_option( $Tradetracker_extra_name );


	//see if form has been submitted
	if( isset($_POST[ $ttstoresubmit ]) && $_POST[ $ttstoresubmit ] == 'Y' ) {

		//get posted data
		$Tradetracker_xmlfeedsperupdate_val = ttstore_sanitize($_POST[ $Tradetracker_xmlfeedsperupdate_name ]);
		$Tradetracker_xmlupdate_val = ttstore_sanitize($_POST[ $Tradetracker_xmlupdate_name ]);
		$Tradetracker_currency_val = ttstore_sanitize($_POST[ $Tradetracker_currency_name ]);
		$Tradetracker_currencyloc_val = ttstore_sanitize($_POST[ $Tradetracker_currencyloc_name ]);
		if(isset($_POST['extra'])){
			$extraPost = ttstore_sanitize($_POST['extra']);
			$Tradetracker_extra_val = $extraPost;
		} else {
			$Tradetracker_extra_val = "";
		}
		if(isset($_POST['oldcur'])){
			$Tradetracker_newcur_val = "";
			$a1=ttstore_sanitize($_POST['oldcur']); 
			$a2 = ttstore_sanitize($_POST['newcur']); 
			$Tradetracker_newcur_val = array_combine($a1,$a2);
		} else {
			$Tradetracker_newcur_val = "";
		}
		//save the posted value in the database
		if ( get_option("Tradetracker_xmlupdate")  != $Tradetracker_xmlupdate_val) {
			update_option( $Tradetracker_xmlupdate_name, $Tradetracker_xmlupdate_val );
			wp_clear_scheduled_hook('xmlscheduler');
		}
		if ( get_option("Tradetracker_xmlfeedsperupdate")  != $Tradetracker_xmlfeedsperupdate_val) {
			update_option( $Tradetracker_xmlfeedsperupdate_name, $Tradetracker_xmlfeedsperupdate_val );
		}
		if ( get_option("Tradetracker_currency")  != $Tradetracker_currency_val) {
			update_option( $Tradetracker_currency_name, $Tradetracker_currency_val );
		}
		if ( get_option("Tradetracker_currencyloc")  != $Tradetracker_currencyloc_val) {
			update_option( $Tradetracker_currencyloc_name, $Tradetracker_currencyloc_val );
		}
		if ( get_option("Tradetracker_newcur")  != $Tradetracker_newcur_val) {
			update_option( $Tradetracker_newcur_name, $Tradetracker_newcur_val );
		}
		if ( get_option("Tradetracker_extra")  != $Tradetracker_extra_val) {
			update_option( $Tradetracker_extra_name, $Tradetracker_extra_val );
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
			<div id="TB_ajaxWindowTitle"><?php _e('Change XML options.','tradetracker-store'); ?></div>
			<div id="TB_closeAjaxWindow">
				<a title="Close" id="TB_closeWindowButton" href="admin.php?page=tt-store">
					<img src="<?php echo plugins_url( 'images/tb-close.png' , __FILE__ )?>">
				</a>
			</div>
		</div>
		<div id="ttstoreboxoptions" style="max-height:<?php echo esc_attr($adminheight); ?>px;">
			<table width="<?php echo esc_attr($adminwidth)-15; ?>">
				<tr>
					<td>
						<label for="tradetrackerextrafield" title="<?php _e('Which extra fields would you like to use?','tradetracker-store'); ?>" class="info">
							<?php _e("Which extra fields?:", 'tradetracker-store' ); ?> 
						</label>
					</td>
					<td>
					<?php
					$extra = $wpdb->get_results("SELECT extravalue, extrafield FROM $ttstoreextratable group by extrafield", ARRAY_A);


					// $extra = get_option("Tradetracker_xml_extra");
					if(!empty($extra)){
						echo "<table width=\"400\">";
						$i="1";
						foreach($extra as $extraselect) {
							if($i=="1"){
								echo "<tr><td>";
							} else {
								echo "<td>";
							}
							if(!empty($Tradetracker_extra_val)){
								if(in_array($extraselect[extrafield], $Tradetracker_extra_val, true)) {
									echo "<input type=\"checkbox\" checked=\"yes\" name=\"extra[]\" value=\"".esc_attr($extraselect[extrafield])."\" />".esc_attr($extraselect[extrafield])."<br />";
								} else {
									echo "<input type=\"checkbox\" name=\"extra[]\" value=\"".esc_attr($extraselect[extrafield])."\" />".esc_attr($extraselect[extrafield])."<br />";
								}
							} else {
									echo "<input type=\"checkbox\" name=\"extra[]\" value=\"".esc_attr($extraselect[extrafield])."\" />".esc_attr($extraselect[extrafield])."<br />";
							}
							if($i=="1"){
								echo "</td>";
								$i++;
							} else {
								echo "</td></tr>";
								$i--;
							}
						}
						echo "</table>";
					}
					?>
					</td>
				</tr>
				<tr>
					<td>
						<label for="tradetrackerupdate" title="<?php _e('When should it update?, standard is 00:00:00','tradetracker-store'); ?>" class="info">
							<?php _e("Update time:", 'tradetracker-store' ); ?> 
						</label>
					</td>
					<td>
						<input type="text" name="<?php echo esc_attr($Tradetracker_xmlupdate_name); ?>" value="<?php if($Tradetracker_xmlupdate_val==""){ echo "00:00:00"; } else { echo esc_attr($Tradetracker_xmlupdate_val);} ?>" size="20"> <?php _e('Time has to be in hh:mm:ss','tradetracker-store'); ?>
					</td>
				</tr>
				<tr>
					<td>
						<label for="tradetrackerupdate" title="<?php _e('How many feeds should it import every 10 minutes','tradetracker-store'); ?>" class="info">
							<?php _e("Feeds per update:", 'tradetracker-store' ); ?> 
						</label>
					</td>
					<td>
						<input type="text" name="<?php echo esc_attr($Tradetracker_xmlfeedsperupdate_name); ?>" value="<?php if($Tradetracker_xmlfeedsperupdate_val==""){ echo "0"; } else { echo esc_attr($Tradetracker_xmlfeedsperupdate_val);} ?>" size="20"> <?php _e('0 if you want it to go through all feeds, else it will import x amount of feeds every 10 minutes till all feeds are imported','tradetracker-store'); ?>
					</td>
				</tr>
		<tr>
			<td>
				<label for="tradetrackercurrency" title="<?php _e('Do you like to use fill in your own currency or get it from the XML?','tradetracker-store'); ?>" class="info">
					<?php _e("Use your own currency symbol:", 'tradetracker-store' ); ?> 
				</label>
			</td>
			<td>
				<input type="radio" name="<?php echo esc_attr($Tradetracker_currency_name); ?>" <?php if($Tradetracker_currency_val==1) {echo "checked";} ?> value="1"> <?php _e('Yes','tradetracker-store'); ?>
				<br>
				<input type="radio" name="<?php echo esc_attr($Tradetracker_currency_name); ?>" <?php if($Tradetracker_currency_val==0){echo "checked";} ?> value="0"> <?php _e('No','tradetracker-store'); ?>
			</td>
		</tr>
		<tr>
			<td>
				<label for="tradetrackercurrencyloc" title="<?php _e('Do you like to have the currency before or after the price?','tradetracker-store'); ?>" class="info">
					<?php _e("Location of the currency:", 'tradetracker-store' ); ?> 
				</label>
			</td>
			<td>
				<input type="radio" name="<?php echo esc_attr($Tradetracker_currencyloc_name); ?>" <?php if($Tradetracker_currencyloc_val==1) {echo "checked";} ?> value="1"> <?php _e('After the price','tradetracker-store'); ?>
				<br>
				<input type="radio" name="<?php echo esc_attr($Tradetracker_currencyloc_name); ?>" <?php if($Tradetracker_currencyloc_val==0){echo "checked";} ?> value="0"> <?php _e('Before the price','tradetracker-store'); ?>
			</td>
		</tr>
		<?php 
		if($Tradetracker_currency_val==1) {
		?>
			<tr>
				<td colspan="2">
					<b><?php _e('Adjust Currency:','tradetracker-store'); ?></b>
				</td>
			</tr>
			<tr>
				<td>
					<label for="tradetrackercurrency" title="<?php _e('Current currency in the XML?','tradetracker-store'); ?>" class="info">
						<?php _e("XML Currency:", 'tradetracker-store' ); ?> 
					</label>
				</td>
				<td>
					<label for="tradetrackercurrency" title="<?php _e("What would you like to show instead of the XML currency?", 'tradetracker-store' ); ?>" class="info">
						<?php _e("New Currency:", 'tradetracker-store' ); ?> 
					</label>
				</td>
			</tr>
			<?php
			

			$currency=$wpdb->get_results("SELECT currency FROM ".$ttstoretable." group by currency");
			$i="0";
			foreach ($currency as $currency_val){
			$array = get_option( $Tradetracker_newcur_name );
			$key = $currency_val->currency; 
			$value = $array[$key]; 
			?>
				<tr>
					<td>
						<input type="text" readonly="readonly" name="oldcur[<?php echo esc_attr($i); ?>]" value="<?php echo esc_attr($currency_val->currency); ?>">
					</td>
					<td>
						<input type="text" name="newcur[<?php echo esc_attr($i); ?>]" value="<?php echo esc_attr($array[$key]); ?>">						
					</td>
				</tr>
			<?php
			$i++;
			}
		}
		?>
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
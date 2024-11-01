<?php
function xmlfeed(){
	//global variables
	global $wpdb;
	global $ttstoresubmit;
	global $ttstorehidden;
	global $ttstorexmltable;

	//variables for this function
	$Tradetracker_xml_name = 'Tradetracker_xml';
	$Tradetracker_xmlname_name = 'Tradetracker_xmlname';

	//filling variables from database
	$Tradetracker_xml_val = get_option( $Tradetracker_xml_name );
	$Tradetracker_xmlname_val = get_option( $Tradetracker_xmlname_name );
	if(isset($_GET['edit'])){
		$TTedit = sanitize_text_field($_GET['edit']);
	}
	
	if(isset($_GET['delete'])){
		$wpdb->query( $wpdb->prepare( "DELETE FROM $ttstorexmltable WHERE id = %d",intval($_GET['delete'] )));
		$savedmessage = __("Feed deleted", "ttstore");
		$saved = "<div id=\"ttstoreboxsaved\"><strong>".$savedmessage."</strong></div>";
	}
	if(isset($_GET['test'])){
		global $folderhome;
		$error = "";
		$menuid = intval($_GET['test']);
		$query = $wpdb->prepare("SELECT xmlfeed, xmlname, xmlprovider, id FROM $ttstorexmltable where id=%s order by xmlname", $menuid);
		$xmlfeed=$wpdb->get_row($query);
		$xmlfile = $xmlfeed->xmlfeed;
		$url = $xmlfile;
		$permfile = TT_STORE_plugipath.".cache/cache.xml";
		$tmpfile = download_url( $url, $timeout = 300 );
		copy( $tmpfile, $permfile );
		unlink( $tmpfile ); // must unlink afterwards
rewind($verbose);
$verboseLog = stream_get_contents($verbose);

$server = "Verbose information:\n<pre>" .htmlspecialchars($verboseLog). "</pre>\n";
rewind($verbose);
$verboseLog = stream_get_contents($verbose);

$server = "Verbose information:\n<pre>" .htmlspecialchars($verboseLog). "</pre>\n";
			$handle = fopen($folderhome."/cache/cache.xml","r");
		if ($handle) {
			while (!feof($handle)) {
    				$buffer = stream_get_line($handle, 10000);
				echo "<br><a href=\"admin.php?page=tt-store&option=xmlfeed\">Back</a>";
				echo "<br><strong>XMLlink:</strong> ".esc_attr($xmlfile);
				echo "<br><strong>XMLname:</strong> ".esc_attr($xmlfeed->xmlname);
				if(isset($server)){
					echo "<br><strong>Server message:</strong> ".esc_attr($server);
				}
				if(isset($error)){
					echo "<br><strong>Possible error:</strong> ".esc_attr($error);
				}
				echo "<pre>";				
					print_r(error_get_last());
					print_r(curl_getinfo($handle));
				echo "</pre>";
				echo "<br><strong>Showing first 10.000 characters from the feed:</strong>";
				echo "<br>";
				echo "<pre>";
				echo htmlentities($buffer);
				echo "</pre>";
				echo "<br><a href=\"admin.php?page=tt-store&option=xmlfeed\">Back</a>";
				exit();
			}
		} else {
			echo "<br>error or something, no idea what is going on";
			echo "<br><a href=\"admin.php?page=tt-store&option=xmlfeed\">Back</a>";
		}
	}

	//see if form has been submitted
	if( isset($_POST[ $ttstoresubmit ]) && $_POST[ $ttstoresubmit ] == 'Y' ) {
		if(isset($_POST['xmlfeedid']) && !empty($_POST['xmlfeedid'])){
			$Tradetracker_xmlid_val = ttstore_sanitize($_POST['xmlfeedid']);
			$Tradetracker_xml_val = ttstore_sanitize($_POST['xmlfeed']);
			$Tradetracker_xmlconv_val = ttstore_sanitize($_POST['xmlfeedconv']);
			$Tradetracker_xmlname_val = ttstore_sanitize($_POST['xmlname']);	
			$Tradetracker_autoimport_val = ttstore_sanitize($_POST['autoimport']);
			if(!empty($Tradetracker_xml_val)){
				$wpdb->update( 
					''.$ttstorexmltable.'', 
					array( 
						'xmlfeed' => ''.$Tradetracker_xml_val.'',	
						'xmlprovider' => ''.$Tradetracker_xmlconv_val.'',
						'autoimport' => ''.$Tradetracker_autoimport_val.'',
						'xmlname' => ''.$Tradetracker_xmlname_val.''
					), 
					array( 'id' => ''.$Tradetracker_xmlid_val.'' ), 
					array( 
						'%s',
						'%s',
						'%d',
						'%s'
					), 
					array( '%d' ) 
				);
				?>
<script type="text/javascript">
<!--
window.location = "admin.php?page=tt-store&option=xmlfeed"
//-->
</script>

				<?php
			}			
		} else {
			//get posted data
			$Tradetracker_xml_val = ttstore_sanitize($_POST['xmlfeed']);
			$Tradetracker_xmlconv_val = ttstore_sanitize($_POST['xmlfeedconv']);
			$Tradetracker_xmlname_val = ttstore_sanitize($_POST['xmlname']);
			$Tradetracker_autoimport_val = ttstore_sanitize($_POST['autoimport']);
			if(!empty($Tradetracker_xml_val)){
	       	 		$currentpage["xmlfeed"]=$Tradetracker_xml_val;
       		 		$currentpage["xmlprovider"]=$Tradetracker_xmlconv_val;
       		 		$currentpage["xmlname"]=$Tradetracker_xmlname_val;
       		 		$currentpage["xmltitle"]=" ";
       		 		$currentpage["xmlimage"]= " ";
       		 		$currentpage["xmldescription"]= " ";
       		 		$currentpage["xmlprice"]= " ";
       		 		$currentpage["autoimport"]=$Tradetracker_autoimport_val;
       		 		$wpdb->insert( $ttstorexmltable, $currentpage);
				$multiid = $wpdb->insert_id;
			}
		}

	        //put an settings updated message on the screen
		$savedmessage = __("Feed added, click Update Items when all feeds are added", "ttstore");
		$saved = "<div id=\"ttstoreboxsaved\"><strong>".$savedmessage."</strong></div>";
?>
		
<?php
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
			<div id="TB_ajaxWindowTitle"><?php _e("Add or Edit XML feeds.","ttstore"); ?></div>
			<div id="TB_closeAjaxWindow">
				<a title="Close" id="TB_closeWindowButton" href="admin.php?page=tt-store">
					<img src="<?php echo plugins_url( 'images/tb-close.png' , __FILE__ )?>">
				</a>
			</div>
		</div>
		<div id="ttstoreboxoptions" style="max-height:<?php echo $adminheight; ?>px;">
			<table width="<?php echo esc_attr($adminwidth)-15; ?>">
			<?php
				$xmlfeed=$wpdb->get_results("SELECT xmlfeed, xmlname, xmlprovider, autoimport, id FROM ".$ttstorexmltable." order by xmlname");
				if(count($xmlfeed)>0){
			?>
			<tr>
				<td>
					<strong><?php _e("Link to XML","ttstore"); ?></strong>
				</td>
				<td>
					<strong><?php _e("XML Name","ttstore"); ?></strong>
				</td>
				<td>
					<strong><?php _e("XML Provider","ttstore"); ?></strong>
				</td>
				<td>
					<strong><?php  _e("Edit","ttstore"); ?></strong>
				</td>
				<td>
					<strong><?php _e("Delete","ttstore"); ?></strong>
				</td>
				<td>
					<strong><?php _e("Test","ttstore"); ?></strong>
				</td>
				<td>
					<strong><?php _e("Auto Update","ttstore"); ?></strong>
				</td>
			</tr>
				<?php

					//$xmlfeed1 = get_option("Tradetracker_xmlname");
					foreach ($xmlfeed as $xml) {
						echo "<tr><td>";
						echo "<a href=\"".esc_url($xml->xmlfeed)."\">Feed</a>";
						echo "</td><td>";
						echo esc_attr($xml->xmlname);
						echo "</td><td>";
						echo esc_attr($xml->xmlprovider);	
						echo "</td><td>";
						echo "<a href=\"admin.php?page=tt-store&option=xmlfeed&edit=".esc_attr($xml->id)."\">".__("Edit","ttstore")."</a>";
						echo "</td><td>";
						echo "<a href=\"admin.php?page=tt-store&option=xmlfeed&delete=".esc_attr($xml->id)."\">".__("Delete","ttstore")."</a>";
						echo "</td><td>";
						echo "<a href=\"admin.php?page=tt-store&option=xmlfeed&test=".esc_attr($xml->id)."\">".__("Test","ttstore")."</a>";
						echo "</td><td>";
						if($xml->autoimport == "1"){
							echo _e('Yes','tradetracker-store');
						} else {
							echo _e('No','tradetracker-store');
							echo "*";
						}
						echo "</td></tr>";				
					}
					echo "<td colspan=\"7\"><hr></td></tr><tr><td colspan=\"7\"><font style=\"font-size:10px\"><font color=\"red\"><strong>*</strong></font> ".__("This only applies to the automatic daily import of the feeds. Manual import will still import all feeds","ttstore")."</font></td></tr><tr><td colspan=\"7\"><hr></td></tr></table>";
				}
					?>
				<table width="<?php echo esc_attr($adminwidth)-15; ?>">
				<tr>
					<td>
						<strong><?php _e("Link to XML","ttstore"); ?></strong>
					</td>
					<td>
						<strong><?php _e("XML Name","ttstore"); ?></strong>
					</td>
					<td>
						<strong><?php _e("XML Provider","ttstore"); ?></strong>
					</td>
					<td>
						<strong><?php _e("Auto Update","ttstore"); ?></strong>
					</td>
				</tr>
				<?php
				if(isset($TTedit)&&!empty($TTedit)){
					$oldfeed = $wpdb->get_row("SELECT xmlfeed, xmlname, xmlprovider, id, autoimport FROM ".$ttstorexmltable." where id='$TTedit'");
					echo "<tr><td>";
					echo "<input type=\"text\" name=\"xmlfeed\" value=\"".esc_attr($oldfeed->xmlfeed)."\" size=\"50\">";
					echo "</td><td>";
					echo "<input type=\"text\" name=\"xmlname\" value=\"".esc_attr($oldfeed->xmlname)."\" size=\"20\">";
					echo "</td><td>";
					echo "<input type=\"hidden\" name=\"xmlfeedid\" value=\"".esc_attr($oldfeed->id)."\" size=\"40\">";

					if(get_option('tt_premium_provider')=="") {
						echo "<input type=\"hidden\" name=\"xmlfeedconv\" value=\"tradetracker\" size=\"40\">";
					} else {
						echo "<select name=\"xmlfeedconv\" width=\"120\" style=\"width: 120px\">";
						$provider = get_option('tt_premium_provider');
						foreach($provider as $providers) {
							if($providers == $oldfeed->xmlprovider){
								echo "<option value=\"".esc_attr($providers)."\" selected=\"selected\">".esc_attr($providers)."</option>";
							} else {
								echo "<option value=\"".esc_attr($providers)."\">".esc_attr($providers)."</option>";
							}
						}
						echo "</select>";
					}
					echo "</td><td>";
				?>
					<input type="radio" name="autoimport" <?php if($oldfeed->autoimport==1) {echo "checked";} ?> value="1"> <?php _e('Yes','tradetracker-store');?>
					<input type="radio" name="autoimport" <?php if($oldfeed->autoimport==0){echo "checked";} ?> value="0"> <?php _e('No','tradetracker-store');?><font color="red"><strong>*</strong></font>
				<?php
				} else {
					echo "<tr><td>";
					echo "<input type=\"text\" name=\"xmlfeed\" value=\"\" size=\"50\">";
					echo "</td><td>";
					echo "<input type=\"text\" name=\"xmlname\" value=\"input a xml name\" size=\"20\">";
					echo "</td><td>";
					if(get_option('tt_premium_provider')=="") {
						echo "<input type=\"hidden\" name=\"xmlfeedconv\" value=\"tradetracker\" size=\"40\">";
					} else {
						echo "<select name=\"xmlfeedconv\" width=\"120\" style=\"width: 120px\">";
						$provider = get_option('tt_premium_provider');
						foreach($provider as $providers) {
							echo "<option value=\"".esc_attr($providers)."\">".esc_attr($providers)."</option>";
						}
						echo "</select>";
					}
					echo "</td><td>";
				?>
					<input type="radio" name="autoimport" checked value="1"> <?php _e('Yes','tradetracker-store');?>
					<input type="radio" name="autoimport" value="0"> <?php _e('No','tradetracker-store');?><font color="red"><strong>*</strong></font>
				<?php

				}
					?>			
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
			<INPUT type="button" name="Close" class="button-secondary" value="<?php  _e('Update Items','tradetracker-store') ?>" onclick="location.href='admin.php?page=tt-store&update=yes'"> 
			<input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Save Changes') ?>" /> 
			<INPUT type="button" name="Close" class="button-secondary" value="<?php esc_attr_e('Close') ?>" onclick="location.href='admin.php?page=tt-store'"> 
		</div>
	</form>
	</div>
</div>
<?php	
}
?>
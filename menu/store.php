<?php
function store() {

	//global variables
	global $wpdb;
	global $ttstoresubmit;
	global $ttstorehidden;
	global $ttstoremultitable;
	global $ttstorexmltable;
	global $ttstorelayouttable;
	global $ttstoretable;
	global $ttstorecattable;

	//variables for this function
	$Tradetracker_buynow_name = 'Tradetracker_buynow';
	$Tradetracker_multiname_name = 'Tradetracker_multiname';
	$Tradetracker_multisorting_name = 'Tradetracker_multisorting';
	$Tradetracker_multiorder_name = 'Tradetracker_multiorder';
	$Tradetracker_multilayout_name = 'Tradetracker_multilayout';
	$Tradetracker_multiamount_name = 'Tradetracker_multiamount';
	$Tradetracker_multipageamount_name = 'Tradetracker_multipageamount';
	$Tradetracker_multilightbox_name = 'Tradetracker_multilightbox';
	$Tradetracker_multixmlfeed_name = 'Tradetracker_multixmlfeed';
	$Tradetracker_multiproductpage_name = 'Tradetracker_multiproductpage';
	$Tradetracker_multimaxprice_name = 'Tradetracker_multimaxprice';
	$Tradetracker_multiminprice_name = 'Tradetracker_multiminprice';
	$Tradetracker_multicurrency_name = 'Tradetracker_multicurrency';
	$Tradetracker_categories_name = 'Tradetracker_categories';
	$readonlylock = "no";
	if(isset($_GET['return'])){
		$returnpage = "1";
	}
	if(isset($post['return'])){
		$returnpage = "1";
	}
	if(isset($_GET['delete'])){
		$delete = ttstore_sanitize($_GET['delete']);
		if($delete>"1"){
			$wpdb->query("DELETE FROM ".$ttstoremultitable." WHERE `id` = ".$delete."");
		}
	}
	//filling variables from database when editting
	if (isset($_GET['multiid']) || isset($_POST['multiid'])){
		if(isset($_GET['multiid'])){
			$multiid = ttstore_sanitize($_GET['multiid']);
		} 
		if(isset($_POST['multiid'])){
			$multiid = ttstore_sanitize($_POST['multiid']);
		} 
		$multi=$wpdb->get_results("SELECT buynow, multixmlfeed, multisorting, multiorder,multimaxprice,multiminprice, multicurrency, multiproductpage, multiname, multilayout, multiamount, multipageamount, multilightbox, categories FROM ".$ttstoremultitable." where id='".$multiid."'");
		foreach ($multi as $multi_val){
			$Tradetracker_buynow_val = $multi_val->buynow;
			$db_buynow_val = $multi_val->buynow;
			$Tradetracker_multiname_val = $multi_val->multiname;
			$db_multiname_val = $multi_val->multiname;
			$Tradetracker_multisorting_val = $multi_val->multisorting;
			$db_multisorting_val = $multi_val->multisorting;
			$Tradetracker_multiorder_val = $multi_val->multiorder;
			$db_multiorder_val = $multi_val->multiorder;
			$Tradetracker_multixmlfeed_val = $multi_val->multixmlfeed;
			$db_multixmlfeed_val = $multi_val->multixmlfeed;
			$Tradetracker_multilayout_val = $multi_val->multilayout;
			$db_multilayout_val = $multi_val->multilayout;
			$Tradetracker_multiamount_val = $multi_val->multiamount;
			$db_multiamount_val = $multi_val->multiamount;
			$Tradetracker_multipageamount_val = $multi_val->multipageamount;
			$db_multipageamount_val = $multi_val->multipageamount;
			$Tradetracker_multilightbox_val = $multi_val->multilightbox;
			$db_multilightbox_val = $multi_val->multilightbox;
			$Tradetracker_categories_val = $multi_val->categories;
			$db_categories_val = $multi_val->categories;
			$Tradetracker_multiproductpage_val = $multi_val->multiproductpage;
			$db_multiproductpage_val = $multi_val->multiproductpage;

			$Tradetracker_multimaxprice_val = $multi_val->multimaxprice;
			$db_multimaxprice_val = $multi_val->multimaxprice;
			$Tradetracker_multiminprice_val = $multi_val->multiminprice;
			$db_multiminprice_val = $multi_val->multiminprice;
			$Tradetracker_multicurrency_val = $multi_val->multicurrency;
			$db_multicurrency_val = $multi_val->multicurrency;
		}

	} elseif(isset($_GET['copyid'])) {
		$multi=$wpdb->get_results("SELECT buynow, multixmlfeed, multisorting, multiorder,multimaxprice,multiminprice, multicurrency, multiproductpage, multiname, multilayout, multiamount, multipageamount, multilightbox, categories FROM ".$ttstoremultitable." where id='".intval($_GET['copyid'])."'");
		foreach ($multi as $multi_val){
			$Tradetracker_buynow_val = $multi_val->buynow;
			$db_buynow_val = $multi_val->buynow;
			$Tradetracker_multiname_val = $multi_val->multiname;
			$db_multiname_val = $multi_val->multiname;
			$Tradetracker_multisorting_val = $multi_val->multisorting;
			$db_multisorting_val = $multi_val->multisorting;
			$Tradetracker_multiorder_val = $multi_val->multiorder;
			$db_multiorder_val = $multi_val->multiorder;
			$Tradetracker_multixmlfeed_val = $multi_val->multixmlfeed;
			$db_multixmlfeed_val = $multi_val->multixmlfeed;
			$Tradetracker_multilayout_val = $multi_val->multilayout;
			$db_multilayout_val = $multi_val->multilayout;
			$Tradetracker_multiamount_val = $multi_val->multiamount;
			$db_multiamount_val = $multi_val->multiamount;
			$Tradetracker_multipageamount_val = $multi_val->multipageamount;
			$db_multipageamount_val = $multi_val->multipageamount;
			$Tradetracker_multilightbox_val = $multi_val->multilightbox;
			$db_multilightbox_val = $multi_val->multilightbox;
			$Tradetracker_categories_val = $multi_val->categories;
			$db_categories_val = $multi_val->categories;
			$Tradetracker_multiproductpage_val = $multi_val->multiproductpage;
			$db_multiproductpage_val = $multi_val->multiproductpage;

			$Tradetracker_multimaxprice_val = $multi_val->multimaxprice;
			$db_multimaxprice_val = $multi_val->multimaxprice;
			$Tradetracker_multiminprice_val = $multi_val->multiminprice;
			$db_multiminprice_val = $multi_val->multiminprice;
			$Tradetracker_multicurrency_val = $multi_val->multicurrency;
			$db_multicurrency_val = $multi_val->multicurrency;
		}
	}
	//see if form has been submitted
	if( isset($_POST[ $ttstoresubmit ]) && $_POST[ $ttstoresubmit ] == 'Y' ) {
        // Read their posted value
        	$Tradetracker_buynow_val = ttstore_sanitize($_POST[ $Tradetracker_buynow_name ]);
       		$Tradetracker_multixmlfeed_val = ttstore_sanitize($_POST[ $Tradetracker_multixmlfeed_name ]);
        	$Tradetracker_multiname_val = ttstore_sanitize($_POST[ $Tradetracker_multiname_name ]);
        	$Tradetracker_multisorting_val = ttstore_sanitize($_POST[ $Tradetracker_multisorting_name ]);
        	$Tradetracker_multiorder_val = ttstore_sanitize($_POST[ $Tradetracker_multiorder_name ]);
        	$Tradetracker_multilayout_val = ttstore_sanitize($_POST[ $Tradetracker_multilayout_name ]);
		$Tradetracker_multiamount_val = ttstore_sanitize($_POST[ $Tradetracker_multiamount_name ]);
		$Tradetracker_multipageamount_val = ttstore_sanitize($_POST[ $Tradetracker_multipageamount_name ]);
		$Tradetracker_multilightbox_val = ttstore_sanitize($_POST[ $Tradetracker_multilightbox_name ]);
		$Tradetracker_multiproductpage_val = ttstore_sanitize($_POST[ $Tradetracker_multiproductpage_name ]);
		$Tradetracker_multimaxprice_val = ttstore_sanitize($_POST[ $Tradetracker_multimaxprice_name ]);
		$Tradetracker_multiminprice_val = ttstore_sanitize($_POST[ $Tradetracker_multiminprice_name ]);
		$Tradetracker_multicurrency_val = ttstore_sanitize($_POST[ $Tradetracker_multicurrency_name ]);
		if(isset($_POST[ $Tradetracker_categories_name ])){
			$Tradetracker_categories_val = serialize(ttstore_sanitize($_POST[ $Tradetracker_categories_name ]));
		} else {
			$Tradetracker_categories_val = "";
		}
		if(isset($_GET['multiid'])){
			$Tradetracker_multiid_val = absint($_GET['multiid']);
		} 

		if($Tradetracker_multiname_val=="" || $Tradetracker_multiamount_val==""){
			$error = "<div id=\"ttstoreboxerror\"><strong>Please fill mandatory fields</strong></div>";
		} else {
			// Save the posted value in the database
			if(!empty($Tradetracker_multiid_val)) {
				if ( $db_buynow_val  != $Tradetracker_buynow_val) {
					$query = $wpdb->update( $ttstoremultitable, array( 'buynow' => $Tradetracker_buynow_val), array( 'id' => $Tradetracker_multiid_val), array( '%s'), array( '%s'), array( '%d' ) );
  				}
 				if ( $db_multiname_val  != $Tradetracker_multiname_val) {
					$query = $wpdb->update( $ttstoremultitable, array( 'multiname' => $Tradetracker_multiname_val), array( 'id' => $Tradetracker_multiid_val), array( '%s'), array( '%s'), array( '%d' ) );
  				}
 				if ( $db_multisorting_val  != $Tradetracker_multisorting_val) {
					$query = $wpdb->update( $ttstoremultitable, array( 'multisorting' => $Tradetracker_multisorting_val), array( 'id' => $Tradetracker_multiid_val), array( '%s'), array( '%s'), array( '%d' ) );
  				}
 				if ( $db_multiorder_val  != $Tradetracker_multiorder_val) {
					$query = $wpdb->update( $ttstoremultitable, array( 'multiorder' => $Tradetracker_multiorder_val), array( 'id' => $Tradetracker_multiid_val), array( '%s'), array( '%s'), array( '%d' ) );
  				}
 				if ( $db_multixmlfeed_val  != $Tradetracker_multixmlfeed_val) {
					$query = $wpdb->update( $ttstoremultitable, array( 'multixmlfeed' => $Tradetracker_multixmlfeed_val), array( 'id' => $Tradetracker_multiid_val), array( '%s'), array( '%s'), array( '%d' ) );
  				}
 				if ( $db_multilayout_val  != $Tradetracker_multilayout_val) {
					$query = $wpdb->update( $ttstoremultitable, array( 'multilayout' => $Tradetracker_multilayout_val), array( 'id' => $Tradetracker_multiid_val), array( '%s'), array( '%s'), array( '%d' ) );
  				}
				if ( $db_multiamount_val  != $Tradetracker_multiamount_val) {
					$query = $wpdb->update( $ttstoremultitable, array( 'multiamount' => $Tradetracker_multiamount_val), array( 'id' => $Tradetracker_multiid_val), array( '%s'), array( '%s'), array( '%d' ) );
				}
				if ( $db_multipageamount_val  != $Tradetracker_multipageamount_val) {
					$query = $wpdb->update( $ttstoremultitable, array( 'multipageamount' => $Tradetracker_multipageamount_val), array( 'id' => $Tradetracker_multiid_val), array( '%s'), array( '%s'), array( '%d' ) );
				}
 				if ( $db_multilightbox_val  != $Tradetracker_multilightbox_val) {
					$query = $wpdb->update( $ttstoremultitable, array( 'multilightbox' => $Tradetracker_multilightbox_val), array( 'id' => $Tradetracker_multiid_val), array( '%s'), array( '%s'), array( '%d' ) );
 				}
 				if ( $db_multimaxprice_val  != $Tradetracker_multimaxprice_val) {
					$query = $wpdb->update( $ttstoremultitable, array( 'multimaxprice' => $Tradetracker_multimaxprice_val), array( 'id' => $Tradetracker_multiid_val), array( '%s'), array( '%s'), array( '%d' ) );
 				}
 				if ( $db_multiminprice_val  != $Tradetracker_multiminprice_val) {
					$query = $wpdb->update( $ttstoremultitable, array( 'multiminprice' => $Tradetracker_multiminprice_val), array( 'id' => $Tradetracker_multiid_val), array( '%s'), array( '%s'), array( '%d' ) );
 				}
 				if ( $db_multicurrency_val  != $Tradetracker_multicurrency_val) {
					$query = $wpdb->update( $ttstoremultitable, array( 'multicurrency' => $Tradetracker_multicurrency_val), array( 'id' => $Tradetracker_multiid_val), array( '%s'), array( '%s'), array( '%d' ) );
 				}
				if ( $db_multiproductpage_val  != $Tradetracker_multiproductpage_val) {
					$query = $wpdb->update( $ttstoremultitable, array( 'multiproductpage' => $Tradetracker_multiproductpage_val), array( 'id' => $Tradetracker_multiid_val), array( '%s'), array( '%s'), array( '%d' ) );
 				}
 				if ( $db_categories_val  != $Tradetracker_categories_val) {
					$query = $wpdb->update( $ttstoremultitable, array( 'categories' =>  $Tradetracker_categories_val), array( 'id' => $Tradetracker_multiid_val), array( '%s'), array( '%s'), array( '%d' ) );
 				}
				$multiid = intval($_POST['multiid']);
			} else {
				//save new variables
       	 			$currentpage["buynow"]=$Tradetracker_buynow_val;
       	 			$currentpage["multiname"]=$Tradetracker_multiname_val;
       	 			$currentpage["multisorting"]=$Tradetracker_multisorting_val;
       	 			$currentpage["multiorder"]=$Tradetracker_multiorder_val;
        			$currentpage["multilayout"]=$Tradetracker_multilayout_val;
        			$currentpage["multiamount"]=$Tradetracker_multiamount_val;
        			$currentpage["multipageamount"]=$Tradetracker_multipageamount_val;
				$currentpage["multiitems"]="";
        			$currentpage["multilightbox"]=$Tradetracker_multilightbox_val;
        			$currentpage["multimaxprice"]=$Tradetracker_multimaxprice_val;
        			$currentpage["multiminprice"]=$Tradetracker_multiminprice_val;
        			$currentpage["multicurrency"]=$Tradetracker_multicurrency_val;
        			$currentpage["multixmlfeed"]=$Tradetracker_multixmlfeed_val;
				if(isset($Tradetracker_multiproductpage_val)){
        				$currentpage["multiproductpage"]=$Tradetracker_multiproductpage_val;
				} else {
					$currentpage["multiproductpage"]="0";
				}
        			$currentpage["categories"]=$Tradetracker_categories_val;
				$wpdb->insert( $ttstoremultitable, $currentpage);
				$multiid = $wpdb->insert_id;
				$wpdb->print_error();
			}
			//put an settings updated message on the screen
			if (isset($_POST['Submitclose'])) {
				if(isset($returnpage)){$exitlink = "admin.php?page=tt-store&option=itemselect"; } else {$exitlink = "admin.php?page=tt-store&option=store";}
				?>
				<script type="text/javascript">
					window.location.href='<?php echo esc_url($exitlink); ?>';
				</script>
				<?php

			} else {
				$savedmessage = __("Settings saved", "ttstore");
				$saved = "<div id=\"ttstoreboxsaved\"><strong>".$savedmessage."</strong></div>";
			}
		}
	}
	if(!isset($_GET['function'])){
?>
<?php $adminwidth = get_option("Tradetracker_adminwidth"); ?>
<?php $adminheight = get_option("Tradetracker_adminheight"); ?>
<div  id="TB_overlay" class="TB_overlayBG"></div>
<div id="TB_window1" style="left: auto;margin-left: auto;margin-right: auto; margin-top: 0;right: auto;top: 48px;visibility: visible;z-index:100051;width: <?php echo esc_attr($adminwidth); ?>px;">
	<div id="ttstorebox">
		<div id="TB_title">
			<div id="TB_ajaxWindowTitle"><?php _e('Would you like to edit or add a store?','tradetracker-store'); ?></div>
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
					<a href="admin.php?page=tt-store&option=store&sort=id"><strong><?php _e('ID','tradetracker-store'); ?></strong></a>
				</td>
				<td>
					<a href="admin.php?page=tt-store&option=store&sort=multiname"><strong><?php _e('Store Name','tradetracker-store'); ?></strong></a>
				</td>
				<td>
					<strong><?php _e('Sorting','tradetracker-store'); ?></strong>
				</td>
				<td>
					<strong><?php _e('Order','tradetracker-store'); ?></strong>
				</td>
				<td>
					<strong><?php _e('Layout','tradetracker-store'); ?></strong>
				</td>
				<td>
					<strong><?php _e('Feed','tradetracker-store'); ?></strong>
				</td>
				<td>
					<strong><?php _e('Button Text','tradetracker-store'); ?></strong>
				</td>
				<td>
					<strong><?php _e('Items','tradetracker-store'); ?></strong>
				</td>
				<td>
					<strong><?php _e('Lightbox','tradetracker-store'); ?></strong>
				</td>
				<td>
					<strong><?php _e('Edit','tradetracker-store'); ?></strong>
				</td>
				<td>
					<strong><?php _e('Delete','tradetracker-store'); ?></strong>
				</td>
				<td>
					<strong><?php _e('Copy','tradetracker-store'); ?></strong>
				</td>
			</tr>
<?php
		$sort = sanitize_text_field($_GET['sort']);
		if(!isset($sort) || $sort == ""){
			$sort = 'id';
		}
		$storeedit=$wpdb->get_results("SELECT ".$ttstoremultitable.".id, layname, multisorting, multiorder, multilayout, multiname, multiamount, multilightbox, multixmlfeed, buynow FROM ".$ttstoremultitable.", ".$ttstorelayouttable." where ".$ttstoremultitable.".multilayout = ".$ttstorelayouttable.".id order by ".$sort."");
		foreach ($storeedit as $store_val){
?>
			<tr>
				<td>
					<?php echo esc_attr($store_val->id); ?>
				</td>
				<td>
					<?php echo esc_attr($store_val->multiname); ?>
				</td>
				<td>
					<?php echo esc_attr($store_val->multisorting); ?>
				</td>
				<td>
					<?php echo esc_attr($store_val->multiorder); ?>
				</td>
				<td>
					<?php echo esc_attr($store_val->layname); ?>
				</td>
				<td>
					<?php if ($store_val->multixmlfeed == "*"){_e('All Feeds','tradetracker-store');} else { $xmlfeed=$wpdb->get_var("SELECT xmlname FROM ".$ttstorexmltable." where id=".$store_val->multixmlfeed.""); echo esc_attr($xmlfeed); }?>
				</td>
				<td>
					<?php echo esc_attr($store_val->buynow); ?>
				</td>
				<td>
					<?php echo esc_attr($store_val->multiamount); ?>
				</td>
				<td>
					<?php if($store_val->multilightbox=="1"){ _e('Yes','tradetracker-store');} else {echo _e('No','tradetracker-store');} ?>
				</td>
				<td>
					<?php if($store_val->id>"1"){ echo "<a href=\"admin.php?page=tt-store&option=store&function=new&multiid=".esc_attr($store_val->id)."\">".__('Edit','tradetracker-store')."</a>"; } ?>
				</td>
				<td>
					<?php if($store_val->id>"1"){ echo "<a href=\"admin.php?page=tt-store&option=store&delete=".esc_attr($store_val->id)."\">".__('Delete','tradetracker-store')."</a>"; } ?>
				</td>
				<td>
					<?php if($store_val->id>"1"){ echo "<a href=\"admin.php?page=tt-store&option=store&function=new&copyid=".esc_attr($store_val->id)."\">".__('Copy','tradetracker-store')."</a>"; } ?>
				</td>
			</tr>
			
<?php		
		
		}
?>
		</table>
		</div>
		<div id="ttstoreboxbottom">
			<INPUT type="button" name="Close" class="button-primary" value="<?php _e('Add New','tradetracker-store'); ?>" onclick="location.href='admin.php?page=tt-store&option=store&function=new'"> 
			<INPUT type="button" name="Close" class="button-secondary" value="<?php esc_attr_e('Close') ?>" onclick="location.href='admin.php?page=tt-store'"> 
		</div>
	</div>
</div>
<?php
	}else if($_GET['function']=="new") {
?>
<?php $adminwidth = get_option("Tradetracker_adminwidth"); ?>
<?php $adminheight = get_option("Tradetracker_adminheight"); ?>
<div  id="TB_overlay" class="TB_overlayBG"></div>
<div id="TB_window1" style="left: auto;margin-left: auto;margin-right: auto; margin-top: 0;right: auto;top: 48px;visibility: visible;z-index:100051;width: <?php echo esc_attr($adminwidth); ?>px;">
	<div id="ttstorebox">
	<form name="form1" method="post" action="">
	<?php echo $ttstorehidden; ?>
		<div id="TB_title">
			<div id="TB_ajaxWindowTitle"><?php if(isset($multiid)){ _e('Edit Store','tradetracker-store'); } else { _e('Create Store','tradetracker-store'); } ?></div>
			<div id="TB_closeAjaxWindow">
				<a title="Close" id="TB_closeWindowButton" href="admin.php?page=tt-store&option=<?php if(isset($returnpage)){echo "itemselect"; } else {echo "store";}?>">
					<img src="<?php echo plugins_url( 'images/tb-close.png' , __FILE__ )?>">
				</a>
			</div>
		</div>
		<div id="ttstoreboxoptions" style="max-height:<?php echo esc_attr($adminheight); ?>px;">

		<input type="hidden" name="multiid" value="<?php if(isset($multiid)){ echo esc_attr($multiid);} ?>">
		<?php if(isset($returnpage)){ echo "<input type=\"hidden\" name=\"return\" value=\"item\">"; }?>
<table width="<?php echo esc_attr($adminwidth)-15; ?>">
	<tr>
		<td>
			<label for="tradetrackername" title="<?php _e('Fill in the name for the store.','tradetracker-store'); ?>" class="info">
				<?php _e("Name for Store:", 'tradetracker-store' ); ?>
			</label> 
		</td>
		<td>
			<input type="text" name="<?php echo esc_attr($Tradetracker_multiname_name); ?>" value="<?php if(isset($Tradetracker_multiname_val)) {echo esc_attr($Tradetracker_multiname_val);} ?>" size="30"> 
			<?php if(isset($error)){ echo "<font color=\"red\">*</font>"; }?>
			<?php _e('This cannot start with a number','tradetracker-store'); ?>
		</td>
	</tr>
	<tr>
		<td>
			<label for="tradetrackersorting" title="<?php _e('It will sort the items on this field.','tradetracker-store'); ?>" class="info">
				<?php _e("Order by this field:", 'tradetracker-store' ); ?>
			</label> 
		</td>
		<td>
			<select width="200" style="width: 200px" name="<?php echo esc_attr($Tradetracker_multisorting_name); ?>">
<?php
		$sorting=array('rand()','price', 'categorie', 'name');
		foreach ($sorting as $sorting_val){
			if(isset($Tradetracker_multisorting_val) && $sorting_val == $Tradetracker_multisorting_val) {
				echo "<option selected=\"selected\" value=\"".esc_attr($sorting_val)."\">$sorting_val</option>";
			} else {
				echo "<option value=\"".esc_attr($sorting_val)."\">$sorting_val</option>";
			}
		}
		
?>
			</select> <?php _e('When rand() is selected it will only show 1 page of items.','tradetracker-store'); ?>		
		</td>
	</tr>
	<tr>
		<td>
			<label for="tradetrackerorder" title="<?php _e('How should it be ordered.','tradetracker-store');?>" class="info">
				<?php _e("Descending or Ascending:", 'tradetracker-store' ); ?>
			</label> 
		</td>
		<td>
			<select width="200" style="width: 200px" name="<?php echo esc_attr($Tradetracker_multiorder_name); ?>">
<?php
		$ordering=array('desc','asc');
		foreach ($ordering as $ordering_val){
			if(isset($Tradetracker_multiorder_val) && $ordering_val == $Tradetracker_multiorder_val) {
				echo "<option selected=\"selected\" value=\"".esc_attr($ordering_val)."\">$ordering_val</option>";
			} else {
				echo "<option value=\"".esc_attr($ordering_val)."\">$ordering_val</option>";
			}
		}
		
?>
			</select>		
		</td>
	</tr>
	<tr>
		<td>
			<label for="tradetrackerwidth" title="<?php _e('Which layout would you like to use.','tradetracker-store'); ?>" class="info">
				<?php _e("Layout:", 'tradetracker-multilayout' ); ?>
			</label> 
		</td>
		<td>
			<select width="200" style="width: 200px" name="<?php echo esc_attr($Tradetracker_multilayout_name); ?>">
<?php
		$layout=$wpdb->get_results("SELECT id, layname FROM ".$ttstorelayouttable."");
		foreach ($layout as $layout_val){
			if(isset($Tradetracker_multilayout_val) && $layout_val->id == $Tradetracker_multilayout_val) {
				echo "<option selected=\"selected\" value=\"".esc_attr($layout_val->id)."\">$layout_val->layname</option>";
			} else {
				echo "<option value=\"".esc_attr($layout_val->id)."\">$layout_val->layname</option>";
			}
		}
		
?>
			</select>		
		</td>
	</tr>
<?php 	$provider = get_option('tt_premium_function');
	if(!empty($provider)){
		foreach($provider as $providers) {
			if($providers == "productpage"){ 
				$productpage="1";
			?>	
			<tr>
				<td>
					<label for="tradetrackerproductpage" title="<?php _e('Do you like to use a product page?','tradetracker-store');?>" class="info">
						<?php _e("Use a productpage:", 'tradetracker-productpage' ); ?> 
					</label>
				</td>
				<td>
					<input type="radio" name="<?php echo esc_attr($Tradetracker_multiproductpage_name); ?>" <?php if(isset($Tradetracker_multiproductpage_val) && $Tradetracker_multiproductpage_val=="1") {echo "checked";} ?> value="1"> <?php _e('Yes','tradetracker-store'); ?> 
					<br>
					<input type="radio" name="<?php echo esc_attr($Tradetracker_multiproductpage_name); ?>" <?php if((isset($Tradetracker_multiproductpage_val) && $Tradetracker_multiproductpage_val=="0") || !isset($Tradetracker_multiproductpage_val)){echo "checked";} ?> value="0"> <?php _e('No','tradetracker-store'); ?>
				</td>
			</tr>
			<?php
			}
		}
		if (!isset($productpage)){
				echo "<input type=\"hidden\" name=\"".esc_attr($Tradetracker_multiproductpage_name)."\" value=\"".esc_attr($Tradetracker_multiproductpage_val)."\">";
		}
	}
?>

	<tr>
		<td>
			<label for="tradetrackerwidth" title="<?php _e('Which feed would you like to use.','tradetracker-store'); ?>" class="info">
				<?php _e("Feed:", 'tradetracker-store' ); ?>
			</label> 
		</td>
		<td>
			<select width="200" style="width: 200px" name="<?php echo esc_attr($Tradetracker_multixmlfeed_name); ?>" onchange="toggleOther();">
<?php
		if(!isset($$Tradetracker_multixmlfeed_val) || $Tradetracker_multixmlfeed_val == "*"){
			echo "<option selected=\"selected\" value=\"*\">".__('All feeds','tradetracker-store')."</option>";
		} else {
			echo "<option value=\"*\">".__('All feeds','tradetracker-store')."</option>";
		}
		$xmlfeed=$wpdb->get_results("SELECT xmlname, id FROM ".$ttstorexmltable."");
		//$xmlfeed1 = get_option("Tradetracker_xmlname");
		foreach ($xmlfeed as $xml) {
			if($Tradetracker_multixmlfeed_val != "*" && $Tradetracker_multixmlfeed_val == $xml->id) {
				echo "<option selected=\"selected\" value=\"".esc_attr($xml->id)."\">".esc_attr($xml->xmlname)."</option>";
			} else {
				echo "<option value=\"".esc_attr($xml->id)."\">".esc_attr($xml->xmlname)."</option>";
			}
		}
?>
			</select>		
		</td>
	</tr>
<script>
function toggleOther(){
  document.getElementById('Save').style.visibility = 'visible';
  document.getElementById('Option').style.display = 'none';


}
</script>

	<tr>
		<td valign="top">
			<label for="tradetrackercategoriesfield" title="<?php _e('Which categories would you like to use?','tradetracker-store'); ?>" class="info">
				<?php _e("Which categories?:", 'tradetracker-store' ); ?> 
			</label>
		</td>
		<td>
			<div id="Save" style="visibility:hidden">
				<?php _e('You changed the XML Feed, You need to save first before you can select any category.','tradetracker-store'); ?>
			</div>
			<div id="Option" style="visibility:visible">

		<?php
		if((isset($Tradetracker_multixmlfeed_val) && $Tradetracker_multixmlfeed_val == "*") || !isset($Tradetracker_multixmlfeed_val) ){
			$multixmlfeed = "";
		} else {
			$multixmlfeed = "and xmlfeed = '".$Tradetracker_multixmlfeed_val."' ";
		}
			$categorie = $wpdb->get_results('SELECT '.$ttstorecattable.'.categorie, xmlfeed, '.$ttstorecattable.'.categorieid FROM '.$ttstoretable.', '.$ttstorecattable.' where '.$ttstorecattable.'.productID = '.$ttstoretable.'.productID '.$multixmlfeed.' group by xmlfeed, categorie ORDER BY xmlfeed, `'.$ttstorecattable.'`.`categorie` ASC', OBJECT);
			if(!empty($categorie)){
				echo "<table width=\"400\">";
				$i="1";
				$xmlfeedname = $wpdb->get_results("select id, xmlname FROM ".$ttstorexmltable."", OBJECT_K);
				foreach($categorie as $categorieselect) {
					echo "<tr><td>";
					if(is_serialized($Tradetracker_categories_val)){
						if(in_array($categorieselect->categorieid, unserialize($Tradetracker_categories_val), true)) {
							echo "<input type=\"checkbox\" checked=\"yes\" name=\"".esc_attr($Tradetracker_categories_name)."[]\" value=\"".esc_attr($categorieselect->categorieid)."\" />".esc_attr($xmlfeedname[$categorieselect->xmlfeed]->xmlname)." - ".esc_attr($categorieselect->categorie)."<br />";
						} else {
							echo "<input type=\"checkbox\" name=\"".esc_attr($Tradetracker_categories_name)."[]\" value=\"".esc_attr($categorieselect->categorieid)."\" />".esc_attr($xmlfeedname[$categorieselect->xmlfeed]->xmlname)." - ".esc_attr($categorieselect->categorie)."<br />";
						}
					} else {
						echo "<input type=\"checkbox\" name=\"".esc_attr($Tradetracker_categories_name)."[]\" value=\"".esc_attr($categorieselect->categorieid)."\" />".esc_attr($xmlfeedname[$categorieselect->xmlfeed]->xmlname)." - ".esc_attr($categorieselect->categorie)."<br />";
					}
					echo "</td></tr>";
				}
				echo "</table>";
			}
		?>
			</div>
		</td>
	</tr>

	<tr>
		<td colspan="2">
			<hr />
		</td>
	</tr>

	<tr>
		<td>
			<label for="tradetrackerbuynow" title="<?php _e('What text would you like to use on the button (standard is Buy now).','tradetracker-store');?>" class="info">
				<?php _e("Text on button:", 'tradetracker-buynow' ); ?>
			</label> 
		</td>
		<td>
			<input type="text" name="<?php echo esc_attr($Tradetracker_buynow_name); ?>" value="<?php if(isset($Tradetracker_buynow_val)) { echo esc_attr($Tradetracker_buynow_val); }?>" size="30"> 
		</td>
	</tr>
	<tr>
		<td>
			<label for="tradetrackerfont" title="<?php _e('How much items would you like to show.','tradetracker-store'); ?>" class="info">
				<?php _e("Amount of items:", 'tradetracker-store' ); ?> 
			</label> 
		</td>
		<td>
			<input type="text" name="<?php echo esc_attr($Tradetracker_multiamount_name); ?>" value="<?php if (!isset($Tradetracker_multiamount_val)) {echo "10"; } else {echo esc_attr($Tradetracker_multiamount_val);} ?>" size="30">
			<?php if(isset($error)){ echo "<font color=\"red\">*</font>"; }?> <?php _e('use 0 if you don\'t want a limit at all','tradetracker-store'); ?>
		</td>
	</tr>
	<tr>
		<td>
			<label for="tradetrackerfont" title="<?php _e('How much items would you like to show on one page.','tradetracker-store'); ?>" class="info">
				<?php _e("Amount of items on a single page:", 'tradetracker-store' ); ?> 
			</label> 
		</td>
		<td>
			<input type="text" name="<?php echo esc_attr($Tradetracker_multipageamount_name); ?>" value="<?php if (!isset($Tradetracker_multipageamount_val)) {echo "10"; } else {echo esc_attr($Tradetracker_multipageamount_val);} ?>" size="30">
			<?php if(isset($error)){ echo "<font color=\"red\">*</font>"; }?> <?php _e('Use 0 if you want to show all items on 1 page','tradetracker-store'); ?>
		</td>
	</tr>
		<?php $ttsliderenable = get_option("Tradetracker_sliderenable");
		if($ttsliderenable == "1"){ ?>

	<tr>
		<td>
			<label for="tradetrackerfont" title="<?php _e('Min price shown in slider.','tradetracker-store'); ?>" class="info">
				<?php _e("Min price shown for slider:", 'tradetracker-store' ); ?> 
			</label> 
		</td>
		<td>
			<input type="text" name="<?php echo esc_attr($Tradetracker_multiminprice_name); ?>" value="<?php if (!isset($Tradetracker_multiminprice_val)) {echo "0"; } else {echo esc_attr($Tradetracker_multiminprice_val);} ?>" size="30">
			<?php if(isset($error)){ echo "<font color=\"red\">*</font>"; }?> <?php _e('use 0 if you don\'t want a pricelimit at all','tradetracker-store'); ?>
		</td>
	</tr>
	<tr>
		<td>
			<label for="tradetrackerfont" title="<?php _e('Max price shown in slider.','tradetracker-store'); ?>" class="info">
				<?php _e("Max price shown for slider:", 'tradetracker-store' ); ?> 
			</label> 
		</td>
		<td>
			<input type="text" name="<?php echo esc_attr($Tradetracker_multimaxprice_name); ?>" value="<?php if (!isset($Tradetracker_multimaxprice_val)) {echo "0"; } else {echo esc_attr($Tradetracker_multimaxprice_val);} ?>" size="30">
			<?php if(isset($error)){ echo "<font color=\"red\">*</font>"; }?> <?php _e('use 0 if you don\'t want a pricelimit at all','tradetracker-store'); ?>
		</td>
	</tr>
<?php } else {
		echo "<input type=\"hidden\" name=\"".esc_attr($Tradetracker_multimaxprice_name)."\" value=\"".esc_attr($Tradetracker_multimaxprice_val)."\">";
		echo "<input type=\"hidden\" name=\"".esc_attr($Tradetracker_multiminprice_name)."\" value=\"".esc_attr($Tradetracker_multiminprice_val)."\">";
} ?>
	<tr>
		<td>
			<label for="tradetrackercurrency" title="<?php _e('Which currency should the price filter show.','tradetracker-store');?>" class="info">
				<?php _e("Which currency for pricefilter:", 'tradetracker-store' ); ?>
			</label> 
		</td>
		<td>
			<select width="200" style="width: 200px" name="<?php echo esc_attr($Tradetracker_multicurrency_name); ?>">
<?php
		$currency=array('u20AC','u0024', 'u20a4', 'u007Au0142');
		foreach ($currency as $currency_val){
			$curdisplay = str_replace('u','&#x',$currency_val). ";";
			if(isset($Tradetracker_multicurrency_val) && $currency_val == $Tradetracker_multicurrency_val) {
				echo "<option selected=\"selected\" value=\"".esc_attr($currency_val)."\">$curdisplay </option>";
			} else {
				echo "<option value=\"".esc_attr($currency_val)."\">$curdisplay </option>";
			}
		}
		
?>
			</select>		
		</td>
	</tr>

	<tr>
		<td>
			<label for="tradetrackerlightbox" title="<?php _e('Do you want to use lightbox for the images? You will need an extra plugin for that','tradetracker-store'); ?>" class="info">
				<?php _e("Use Lightbox:", 'tradetracker-lightbox' ); ?> 
			</label>
		</td>
		<td>
			<input type="radio" name="<?php echo esc_attr($Tradetracker_multilightbox_name); ?>" <?php if(isset($Tradetracker_multilightbox_val) && $Tradetracker_multilightbox_val=="1") {echo "checked";} ?> value="1"> <?php _e('Yes','tradetracker-store'); ?> (<a href="http://wordpress.org/extend/plugins/wp-jquery-lightbox/" target="_blank"><?php _e('You will need this plugin','tradetracker-store'); ?></a>)
		</td>
	</tr>
	<tr>
		<td>
		</td>
		<td>
			<input type="radio" name="<?php echo esc_attr($Tradetracker_multilightbox_name); ?>" <?php if((isset($Tradetracker_multilightbox_val) && $Tradetracker_multilightbox_val=="0") || !isset($Tradetracker_multilightbox_val)){echo "checked";} ?> value="0"> <?php _e('No','tradetracker-store'); ?>
		</td>
	</tr>
</table>
		</div>
		<div id="ttstoreboxbottom">
			<?php
				if(isset($saved)){
					echo wp_kses_post($saved);
				}
				if(isset($error)){
					echo wp_kses_post($error);
				}
			?>
			<input type="submit" name="Submit" class="button-primary" value="<?php if(isset($multiid)){ esc_attr_e('Save Changes'); } else { _e('Create','tradetracker-store'); } ?>" /> 
			<?php if(isset($multiid)){ ?>
			<input type="submit" name="Submitclose" class="button-primary" value="<?php esc_attr_e('Save Changes and close'); ?>" />
			<?php } ?>
			<INPUT type="button" name="Close" class="button-secondary" value="<?php esc_attr_e('Close') ?>" onclick="location.href='admin.php?page=tt-store&option=<?php if(isset($returnpage)){echo "itemselect"; } else {echo "store";}?>'"> 
		</div>
	</form>
	</div>
</div>
<?php
	}
}
?>
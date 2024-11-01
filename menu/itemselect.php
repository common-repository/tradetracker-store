<?php
function itemselect() {
	global $wpdb;
	global $ttstoresubmit;
	global $ttstorehidden;
	global $ttstoremultitable;
	global $ttstoreitemtable;
	global $ttstoretable;
	global $ttstoreextratable;
	global $ttstorexmltable;
	global $ttstorecattable;
	global $folderhome;
	if(!isset($_GET['function']) || $_GET['function']=="delete" || $_GET['function']=="deleteempty"){
 		if(isset($_GET['function']) && $_GET['function']=="delete") {
			$multiid = intval($_GET['multiid']);
			$query = "DELETE b FROM `".$ttstoreitemtable."` b LEFT JOIN `".$ttstoretable."` f ON f.productID = b.productID WHERE b.storeID = '".$multiid."'";
			$wpdb->query($query);
			$deleted = __("deleted all items", "ttstore");
		} 
 		if(isset($_GET['function']) && $_GET['function']=="deleteempty") {
			$multiid = intval($_GET['multiid']);
			$itemsid = explode(",", sanitize_text_field($_GET['emptyitems']));
			foreach($itemsid as $item){
				$query = "DELETE b FROM `".$ttstoreitemtable."` b LEFT JOIN `".$ttstoretable."` f ON f.productID = b.productID WHERE f.productID IS NULL and b.storeID = '".$multiid."'";
				$wpdb->query($query);
			}
			$deleted = __("deleted the items", "ttstore");
		} 
?>
<?php $adminwidth = get_option("Tradetracker_adminwidth"); ?>
<?php $adminheight = get_option("Tradetracker_adminheight"); ?>

<div  id="TB_overlay" class="TB_overlayBG"></div>
<div id="TB_window1" style="left: auto;margin-left: auto;margin-right: auto; margin-top: 0;right: auto;top: 48px;visibility: visible;z-index:100051;width: <?php echo esc_attr($adminwidth); ?>px;">
	<div id="ttstorebox">
		<div id="TB_title">
			<div id="TB_ajaxWindowTitle"><?php _e("Select items for which store", "ttstore"); ?></div>
			<div id="TB_closeAjaxWindow">
				<a title="Close" id="TB_closeWindowButton" href="admin.php?page=tt-store">
					<img src="<?php echo plugins_url( 'images/tb-close.png' , __FILE__ )?>">
				</a>
			</div>
		</div>
		<div id="ttstoreboxoptions" style="max-height:<?php echo esc_attr($adminheight); ?>px;">
	<table width="<?php echo esc_attr($adminwidth-15); ?>">
		<tr>
			<td>
				<b><?php _e("Store Name", "ttstore"); ?></b>
			</td>
			<td>
				<b><?php _e("Edit", "ttstore"); ?></b>
			</td>
			<td>
				<b><?php _e("Select Item", "ttstore"); ?></b>
			</td>
			<td>
				<b><?php _e("Delete", "ttstore"); ?></b>
			</td>
			<td>
				<b><?php _e("Delete", "ttstore"); ?></b>
			</td>
			<td>
			</td>
		</tr>
<?php
		$layoutedit=$wpdb->get_results("SELECT ".$ttstoremultitable.".id, multiname, multiitems, count(".$ttstoreitemtable.".id) as totalitems FROM ".$ttstoremultitable." left join ".$ttstoreitemtable." on ".$ttstoremultitable.".id = ".$ttstoreitemtable.".storeID group by storeID, multiname order by ".$ttstoremultitable.".id");
		foreach ($layoutedit as $layout_val){
			if($layout_val->totalitems > "0" ){
				$nonexisting=$wpdb->get_results('select t1.productID from '.$ttstoreitemtable.' t1 left join '.$ttstoretable.' t2 on t1.productID = t2.productID  where t1.storeID = "'.$layout_val->id.'" and t2.productID is null group by t1.productID');
				$productcount = $layout_val->totalitems;
				$emptyproductcount = count($nonexisting);
				$result = array();
				foreach($nonexisting as $term){
					$result[] = $term->productID;
				}
				$emptyitems = implode(",", $result);
			} else {
				$emptyproductcount = "";
				$emptyitems = "";
			}
?>

		<tr>
			<td>
				<?php echo esc_attr($layout_val->multiname); ?>
			</td>
			<td>
				<?php if($layout_val->id > "1"){ ?>
					<a href="admin.php?page=tt-store&option=store&function=new&return=item&multiid=<?php echo esc_attr($layout_val->id); ?>"><?php _e("Edit Store", "ttstore"); ?></a>
				<?php } ?>
			</td>
			<td>
				<a href="admin.php?page=tt-store&option=itemselect&function=select&multiid=<?php echo esc_attr($layout_val->id); ?>"><?php _e("Select Items", "ttstore"); ?></a>
			</td>
			<td>
				<?php if(isset($productcount)){ ?>
					<a href="admin.php?page=tt-store&option=itemselect&function=delete&multiid=<?php echo esc_attr($layout_val->id); ?>"><?php printf(__('All %d selected Item(s)', 'tradetracker-store'), $productcount); ?></a>
				<?php } ?>
			</td>
			<td>
				<?php if(isset($emptyproductcount) && $emptyproductcount > "0"){ ?>
					<a href="admin.php?page=tt-store&option=itemselect&function=deleteempty&multiid=<?php echo esc_attr($layout_val->id); ?>"><?php echo esc_attr($emptyproductcount); ?> <?php _e("items no longer in a feed", "ttstore"); ?></a>
					<?php $emptyproductcount = ""; ?>
				<?php } ?>
			</td>
			<td>
				<?php if(isset($multiid) && $layout_val->id == $multiid){
					echo esc_html($deleted);
				} ?>
			</td>
		</tr>
			
<?php		
		unset($productcount);
		}
?>
	</table>
		</div>
		<div id="ttstoreboxbottom">
			<INPUT type="button" name="Close" class="button-secondary" value="<?php esc_attr_e('Close') ?>" onclick="location.href='admin.php?page=tt-store'"> 
		</div>
	</div>
</div>

<?php
	} else if($_GET['function']=="select") {
		if(!isset($_GET['order'])) {
			$order = "name";
		} else {
			$order = sanitize_text_field($_GET['order']);
		}
		$multiid = intval($_GET['multiid']);
	if( isset($_POST[ $ttstoresubmit ]) && $_POST[ $ttstoresubmit ] == 'Y' ) {
		$Tradetracker_items = ttstore_sanitize($_POST['item']);
		if((isset($Tradetracker_items) && $Tradetracker_items != "") || $Tradetracker_items == ""){
			$query = "DELETE FROM `".$ttstoreitemtable."` WHERE `".$ttstoreitemtable."`.`storeID` = ".$multiid."";
			$wpdb->query($query);
		}
		if(isset($_POST['itemsother']) && $_POST['itemsother']!="")
		{
			$itemsother = explode(",",sanitize_text_field($_POST['itemsother']));
			$Tradetracker_items = array_merge($Tradetracker_items, $itemsother);
		}
		foreach ($Tradetracker_items as $itemoverview){
			$wpdb->insert( 
				$ttstoreitemtable, 
				array( 
					'storeID' => $multiid, 
					'productID' => $itemoverview 
				), 
				array( 
					'%d', 
					'%s' 
				) 
			);
		}
		$savedmessage = __("Settings saved", "ttstore");
		$saved = "<div id=\"ttstoreboxsaved\"><strong>".$savedmessage."</strong></div>";
	}
		$layoutedit=$wpdb->get_results("SELECT ".$ttstoremultitable.".id, multixmlfeed, multiitems, multiname, categories, count(".$ttstoreitemtable.".id) as totalitems FROM ".$ttstoremultitable." left join ".$ttstoreitemtable." on ".$ttstoremultitable.".id = ".$ttstoreitemtable.".storeID where ".$ttstoremultitable.".id='".$multiid."' group by storeID, multiname");
		foreach ($layoutedit as $layout_val){
			if($layout_val->totalitems >0){
				$multiitems=$wpdb->get_results("SELECT ".$ttstoreitemtable.".productID FROM ".$ttstoreitemtable." where ".$ttstoreitemtable.".storeID = ".$layout_val->id."");
				$productID = array();
				foreach($multiitems as $term){
					$productID[] = $term->productID;
				}	
			}
			$multiname = $layout_val->multiname;
			if($layout_val->multixmlfeed == "*" ){
				$multixmlfeed = "";
				$searchxmlfeed = "";
				}elseif($layout_val->multixmlfeed == "" ){
					$multixmlfeed = "";
					$searchxmlfeed = "";
				} else {
					$multixmlfeed = "and xmlfeed = ".$layout_val->multixmlfeed." ";
				$searchxmlfeed = " and xmlfeed = ".$layout_val->multixmlfeed." ";
			}
			$i="1";
			$categories = unserialize($layout_val->categories);
			if(!empty($categories)){
				foreach ($categories as $categories){
					if($i == "1" ) {
						if($multixmlfeed == ""){
							$categorieselect = " and (categorieid = \"".$categories."\"";
							$searchcategorieselect = " and (categorieid = \"".$categories."\"";
						}else {
							$categorieselect = " and (categorieid = \"".$categories."\"";
							$searchcategorieselect = " and (categorieid = \"".$categories."\"";
						}
					$i = "2";
					} else {
							$categorieselect .= " or categorieid = \"".$categories."\"";
							$searchcategorieselect .= " or categorieid = \"".$categories."\"";
					}
				}
				$categorieselect .= ") ";
				$searchcategorieselect .= ") ";
			} else {
				$categorieselect = "";
				$searchcategorieselect = "";
			}
		}
	if(isset($_GET['limit'])){
		$limit = sanitize_text_field($_GET['limit']);
	}
	if(isset($_GET['currentpage'])){
		$currentpage = sanitize_text_field($_GET['currentpage']);
	}
	if (!isset($limit))
	{
		$limit = 100;
	}
	if (!isset($currentpage)){
		$currentpage = 0;
	}
	if(isset($_GET['search']) && $_GET['search'] !=""){
		$keyword = sanitize_text_field($_GET['search']);
		
			if(preg_match("/\bor\b/i", $keyword, $matches1)){
	list($a, $b) = explode(' or ', $keyword);
		$keywordor = "1";
	}
		if(preg_match("/\band\b/i", $keyword, $matches1)){
	list($a, $b) = explode(' and ', $keyword);
		$keywordand = "1";
	}
	if($_GET['title']=='yes'){
		if($keywordor=="1"){
			$searchtitle = "CONVERT(`name` USING utf8) LIKE '%$a%' or CONVERT(`name` USING utf8) LIKE '%$b%'";
		} else if ($keywordand=="1"){
			$searchtitle = "(CONVERT(`name` USING utf8) LIKE '%$a%' and CONVERT(`name` USING utf8) LIKE '%$b%')";
		} else {
			$searchtitle = "CONVERT(`name` USING utf8) LIKE '%$keyword%'";
		}
	}
	if($_GET['description']=='yes'){
		if($keywordor=="1"){
			if(isset($searchtitle)){
				$searchdescription = "or CONVERT(`description` USING utf8) LIKE '%$a%' or CONVERT(`name` USING utf8) LIKE '%$b%'";
			} else {
				$searchdescription = "CONVERT(`description` USING utf8) LIKE '%$a%' or CONVERT(`name` USING utf8) LIKE '%$b%'";
			}
		} else if ($keywordand=="1"){
			if(isset($searchtitle)){
				$searchdescription = "or (CONVERT(`description` USING utf8) LIKE '%$a%' and CONVERT(`name` USING utf8) LIKE '%$b%')";
			} else {
				$searchdescription = "CONVERT(`description` USING utf8) LIKE '%$a%' and CONVERT(`name` USING utf8) LIKE '%$b%'";
			}
		} else {
			if(isset($searchtitle)){
				$searchdescription = "or CONVERT(`description` USING utf8) LIKE '%$keyword%'";
			} else {
				$searchdescription = "CONVERT(`description` USING utf8) LIKE '%$keyword%'";
			}
		}
	}
		$searchlink = "&search=".$keyword;
		$countquery=$wpdb->get_row("SELECT COUNT(DISTINCT ".$ttstoretable.".productID) as cnt FROM (".$ttstoretable.", ".$ttstorecattable.") where ".$ttstorecattable.".productID = ".$ttstoretable.".productID and ($searchtitle $searchdescription) ".$searchcategorieselect." ".$searchxmlfeed." ");
	} else {
		$searchlink = "";
		if(isset($_GET['selected']) && $_GET['selected']=="yes"){
			$products = '"' . implode('","', $productID) . '"';;
			$countquery=$wpdb->get_row("SELECT COUNT(DISTINCT ".$ttstoretable.".productID) as cnt FROM ".$ttstoretable.", ".$ttstorecattable." where (".$ttstorecattable.".productID = ".$ttstoretable.".productID ".$multixmlfeed." ".$categorieselect.") and ".$ttstoretable.".productID IN (".$products.") ");
		} else {
			$countquery=$wpdb->get_row("SELECT COUNT(DISTINCT ".$ttstoretable.".productID) as cnt FROM ".$ttstoretable.", ".$ttstorecattable." where ".$ttstorecattable.".productID = ".$ttstoretable.".productID ".$multixmlfeed." ".$categorieselect."");
		}
	}
	$numrows = $countquery->cnt;
	$pages = intval($numrows/$limit); // Number of results pages.
	if ($numrows%$limit) 
	{
		$pages++;
	} 
	$current = ($currentpage/$limit) + 1;
	if (($pages < 1) || ($pages == 0)) 
	{
		$total = 1;
	} else {
		$total = $pages;
	} 
	$first = $currentpage + 1;
	if (!((($currentpage + $limit) / $limit) >= $pages) && $pages != 1) 
	{
		$last = $currentpage + $limit;
	} else {
		$last = $numrows;
	}
?>
<style type="text/css" media="screen">

span.link1 {

}

span.link1 a span {
	display: none;
	left: 0;
	position: absolute;
	top: 0;
}

span.link1 a:hover {
    	font-size: 99%;
    	font-color: #000000;
}
span.link1 a:hover span { 
	display: block; 
    	position: absolute; 
    	margin-top: 10px; 
    	margin-left: 500px; 
	max-width:400px;
	max-height:700px;
	padding: 5px; 
    	z-index: 1001; 
    	color: #000000; 
    	background: #FFFFAA; 
    	font: 12px "Arial", sans-serif;
    	text-align: left; 
    	text-decoration: none;
	overflow:hidden;
}

span.link {

}

span.link a span {
	display: none;
	left: 0;
	position: absolute;
	top: 0;
	overflow: hidden;
}

span.link a:hover {
    	font-size: 99%;
    	font-color: #000000;
}
span.link a:hover span { 
	display: block; 
    	position: absolute; 
    	margin-top: 10px; 
    	margin-left: -100px; 
	max-width:400px;
	max-height:700px;
	padding: 5px; 
    	z-index: 1001; 
    	color: #000000; 
    	background: #FFFFAA; 
    	font: 12px "Arial", sans-serif;
    	text-align: left; 
    	text-decoration: none;
		overflow:hidden;
}
span table, span table tr, span table td{
	border: 0 none;
	padding-right: 5px;
	min-width: 75px;
	padding-left: 5px;
}
/*  */
</style>

<script type="text/javascript">
function selectToggle(toggle, form) {
     var myForm = document.forms[form];
     for( var i=0; i < myForm.length; i++ ) { 
          if(toggle) {
               myForm.elements[i].checked = "checked";
          } 
          else {
               myForm.elements[i].checked = "";
          }
     }
}
</script>
<?php $adminwidth = get_option("Tradetracker_adminwidth"); ?>
<?php $adminheight = get_option("Tradetracker_adminheight"); ?>

<div  id="TB_overlay" class="TB_overlayBG"></div>
<div id="TB_window1" style="left: auto;margin-left: auto;margin-right: auto; margin-top: 0;right: auto;top: 48px;visibility: visible;z-index:100051;width: <?php echo esc_attr($adminwidth); ?>px;">
	<div id="ttstorebox">
		<div id="TB_title">
			<div id="TB_ajaxWindowTitle"><?php _e("Select the items you want to show", "ttstore"); ?></div>
			<div id="TB_closeAjaxWindow">
				<a title="Close" id="TB_closeWindowButton" href="admin.php?page=tt-store&option=itemselect">
					<img src="<?php echo plugins_url( 'images/tb-close.png' , __FILE__ )?>">
				</a>
			</div>
		</div>
		<div id="ttstoreboxoptions" style="max-height:<?php echo esc_attr($adminheight); ?>px;">
		<form class="" action="admin.php" method="get">
		<input type="hidden" name="page" value="tt-store">
		<input type="hidden" name="option" value="itemselect">
		<input type="hidden" name="function" value="select">
		<input type="hidden" name="multiid" value="<?php echo esc_attr($multiid);?>">
		<input type="hidden" name="limit" value="<?php echo esc_attr($limit);?>">
		<input type="hidden" name="order" value="<?php echo esc_attr($order);?>">
		<input class="s" type="text" name="search" value="<?php if(isset($keyword)) {  echo esc_attr($keyword);} ?>">
		<?php if(!isset($_GET['title'])&&!isset($_GET['description'])){ ?>
			<input type="checkbox" name="title" checked="checked" value="yes">title
			<input type="checkbox" name="description" checked="checked" value="yes">description
		<?php 
			$filterurl = '';
			} else { ?>
			<?php 
			if(isset($_GET['title']) && $_GET['title']=='yes'){
				$titleurl = '&title=yes';
			} else {
				$titleurl = '';
			}
			if(isset($_GET['description']) && $_GET['description']=='yes'){
				$descriptionurl = '&description=yes';
			} else {
				$descriptionurl = '';
			}
				$filterurl = $titleurl."".$descriptionurl;
			?>
			<input type="checkbox" name="title" <?php if($_GET['title']=='yes'){ echo "checked=\"checked\""; }?> value="yes">title
			<input type="checkbox" name="description" <?php if($_GET['description']=='yes'){ echo "checked=\"checked\""; }?> value="yes">description
		<?php } ?>

		<input class="searchsubmit" type="submit" title="search item" value="Search">
		</form>
<table width="<?php echo esc_attr($adminwidth-30); ?>" border="0">
	<tr>
		<td width="50%" align="left">
			<?php _e("Showing products", "ttstore"); ?> <b><? echo esc_attr($first); ?></b> - <b><?php echo esc_attr($last); ?></b> <?php _e("of", "ttstore"); ?> <b><?php echo esc_attr($numrows); ?></b>
  		</td>
  		<td width="50%" align="right">
			<?php if ($currentpage != 0) { $back_page = $currentpage - $limit; echo("<a href=\"admin.php?page=tt-store&option=itemselect&function=select".esc_attr($searchlink)."&multiid=".esc_attr($multiid)."&order=$order".esc_attr($filterurl)."&currentpage=".esc_attr($back_page)."&limit=".esc_attr($limit)."\"><</a>");} ?> <?php _e("Page", "ttstore"); ?> <b><?php echo esc_attr($current); ?></b> <?php _e("of", "ttstore"); ?> <b><?php echo esc_attr($total); ?></b> <?php if (!((($currentpage+$limit) / $limit) >= $pages) && $pages != 1) { $next_page = $currentpage + $limit; echo("<a href=\"admin.php?page=tt-store&option=itemselect&function=select".esc_attr($searchlink)."&multiid=".esc_attr($multiid)."&order=$order".esc_attr($filterurl)."&currentpage=".esc_attr($next_page)."&limit=".esc_attr($limit)."\">></a>");} ?>
  		</td>
 	</tr>
 	<tr>
  		<td colspan="2" align="right">
			<?php _e("Results per-page:", "ttstore"); ?> <a href="admin.php?page=tt-store&option=itemselect&function=select<?php echo esc_attr($searchlink); ?>&multiid=<?php echo esc_attr($multiid); ?>&order=<?php echo esc_attr($order); ?><?php echo esc_attr($filterurl); ?>&currentpage=<?php echo esc_attr($currentpage); ?>&limit=100">100</a> | <a href="admin.php?page=tt-store&option=itemselect&function=select<?php echo esc_attr($searchlink); ?>&multiid=<?php echo esc_attr($multiid); ?>&order=<?php echo esc_attr($order); ?><?php echo esc_attr($filterurl);?>&currentpage=<?php echo esc_attr($currentpage); ?>&limit=200">200</a> | <a href="admin.php?page=tt-store&option=itemselect&function=select<?php echo esc_attr($searchlink); ?>&multiid=<?php echo esc_attr($multiid); ?>&order=<?php echo esc_attr($order); ?><?php echo esc_attr($filterurl);?>&currentpage=<?php echo esc_attr($currentpage); ?>&limit=500">500</a> | <a href="admin.php?page=tt-store&option=itemselect&function=select<?php echo esc_attr($searchlink); ?>&multiid=<?php echo esc_attr($multiid); ?>&order=<?php echo esc_attr($order); ?><?php echo esc_attr($filterurl); ?>&currentpage=<?php echo esc_attr($currentpage); ?>&limit=1000">1000</a>
  		</td>
 	</tr>
</table>
<?php
if(isset($_GET['search']) && $_GET['search']!=""){
	$keyword = sanitize_text_field($_GET['search']);
	if(preg_match("/\bor\b/i", $keyword, $matches1)){
	list($a, $b) = explode(' or ', $keyword);
		$keywordor = "1";
	}
		if(preg_match("/\band\b/i", $keyword, $matches1)){
	list($a, $b) = explode(' and ', $keyword);
		$keywordand = "1";
	}
	if($_GET['title']=='yes'){
		if($keywordor=="1"){
			$searchtitle = "CONVERT(`name` USING utf8) LIKE '%$a%' or CONVERT(`name` USING utf8) LIKE '%$b%'";
		} else if ($keywordand=="1"){
			$searchtitle = "(CONVERT(`name` USING utf8) LIKE '%$a%' and CONVERT(`name` USING utf8) LIKE '%$b%')";
		} else {
			$searchtitle = "CONVERT(`name` USING utf8) LIKE '%$keyword%'";
		}
	}
	if($_GET['description']=='yes'){
		if($keywordor=="1"){
			if(isset($searchtitle)){
				$searchdescription = "or CONVERT(`description` USING utf8) LIKE '%$a%' or CONVERT(`name` USING utf8) LIKE '%$b%'";
			} else {
				$searchdescription = "CONVERT(`description` USING utf8) LIKE '%$a%' or CONVERT(`name` USING utf8) LIKE '%$b%'";
			}
		} else if ($keywordand=="1"){
			if(isset($searchtitle)){
				$searchdescription = "or (CONVERT(`description` USING utf8) LIKE '%$a%' and CONVERT(`name` USING utf8) LIKE '%$b%')";
			} else {
				$searchdescription = "CONVERT(`description` USING utf8) LIKE '%$a%' and CONVERT(`name` USING utf8) LIKE '%$b%'";
			}
		} else {
			if(isset($searchtitle)){
				$searchdescription = "or CONVERT(`description` USING utf8) LIKE '%$keyword%'";
			} else {
				$searchdescription = "CONVERT(`description` USING utf8) LIKE '%$keyword%'";
			}
		}
	}
	$visits=$wpdb->get_results("SELECT ".$ttstoretable.".*, ".$ttstorecattable.".categorieid, ".$ttstorecattable.".categorie FROM ".$ttstoretable.", ".$ttstorecattable." where ".$ttstorecattable.".productID = ".$ttstoretable.".productID and (".$searchtitle." ".$searchdescription.") ".$searchcategorieselect." ".$searchxmlfeed." group by ".$ttstoretable.".productID ORDER BY ".$order." ASC  LIMIT ".$currentpage.", ".$limit."");
} else {
	if(isset($_GET['selected']) && $_GET['selected']=="yes"){
		$products = '"' . implode('","', $productID) . '"';;
		$visits=$wpdb->get_results("SELECT ".$ttstoretable.".*, ".$ttstorecattable.".categorieid, ".$ttstorecattable.".categorie FROM ".$ttstoretable.", ".$ttstorecattable." where (".$ttstorecattable.".productID = ".$ttstoretable.".productID ".$multixmlfeed." ".$categorieselect." ) and ".$ttstoretable.".productID IN (".$products.") group by ".$ttstoretable.".productID ORDER BY ".$order." ASC");
	} else {
		$visits=$wpdb->get_results("SELECT ".$ttstoretable.".*, ".$ttstorecattable.".categorieid, ".$ttstorecattable.".categorie FROM ".$ttstoretable.", ".$ttstorecattable." where ".$ttstorecattable.".productID = ".$ttstoretable.".productID ".$multixmlfeed." ".$categorieselect." group by ".$ttstoretable.".productID ORDER BY ".$order." ASC LIMIT ".$currentpage.", ".$limit."");
	}
}
	echo "<table width=\"".esc_attr($adminwidth-15)."\" border=\"0\" style=\"border-width: 0px;padding:0px;border-spacing:0px;\">";
		echo "<tr><td width=\"20\">";
			if(!isset($_GET['selected']) || $_GET['selected']==""){
			echo "<b><a href=\"admin.php?page=tt-store&option=itemselect&limit=".esc_attr($limit)."&function=select".esc_attr($searchlink)."&multiid=".esc_attr($multiid)."&order=".esc_attr($order)."".esc_attr($filterurl)."&selected=yes\">"; _e('Selected', 'tradetracker-store'); echo "</a></b>";
			} else {
			echo "<b><a href=\"admin.php?page=tt-store&option=itemselect&limit=".esc_attr($limit)."&function=select".esc_attr($searchlink)."".esc_attr($filterurl)."&multiid=".esc_attr($multiid)."\">"; _e('Selected', 'tradetracker-store'); echo "</a></b>";
			}
		echo "</td><td width=\"200\">";
			echo "<b><a href=\"admin.php?page=tt-store&option=itemselect&limit=".esc_attr($limit)."&function=select".esc_attr($searchlink)."&multiid=".esc_attr($multiid)."&order=productID".esc_attr($filterurl)."\">"; _e('ProductID', 'tradetracker-store'); echo "</a></b>";
		echo "</td><td width=\"435\">";
			echo "<b><a href=\"admin.php?page=tt-store&option=itemselect&limit=".esc_attr($limit)."&function=select".esc_attr($searchlink)."&multiid=".esc_attr($multiid)."&order=name".esc_attr($filterurl)."\">"; _e('Product name', 'tradetracker-store'); echo "</a></b>";
		echo "</td><td width=\"180\">";
			echo "<b><a href=\"admin.php?page=tt-store&option=itemselect&limit=".esc_attr($limit)."&function=select".esc_attr($searchlink)."&multiid=".esc_attr($multiid)."&order=xmlfeed".esc_attr($filterurl)."\">"; _e('XMLFeed', 'tradetracker-store'); echo "</a></b>";
		echo "</td><td width=\"50\">";
			echo "<b><a href=\"admin.php?page=tt-store&option=itemselect&limit=".esc_attr($limit)."&function=select".esc_attr($searchlink)."&multiid=".esc_attr($multiid)."&order=price".esc_attr($filterurl)."\">"; _e('Price', 'tradetracker-store'); echo "</a></b>";
		echo "</td><td width=\"65\">";
			echo "<b>"; _e('Currency', 'tradetracker-store'); echo "</b>";
		echo "</td><td width=\"50\">";
			echo "<b>"; _e("Extra's", "ttstore"); echo "</b>";
		echo "</td></tr>";
	echo "<tr><td colspan=\"5\">"; _e("Select", "ttstore"); echo " <a href=\"javascript:selectToggle(true, 'form2');\">"; _e("All", "ttstore"); echo "</a> | <a href=\"javascript:selectToggle(false, 'form2');\">"; _e("None", "ttstore"); echo "</a></td></tr>";

	echo "<form name=\"form2\" method=\"post\" action=\"\">";
		echo esc_attr($ttstorehidden);
			$array2="";
			$colors = "1";
			foreach ($visits as $product){
				if ($colors == "1"){
					$tdbgcolor= "background-color:#f0f0f0";
				} else {
					$tdbgcolor= "background-color:#ffffff";
				}
				$array2 .= ",".$product->productID."";
				echo "<tr style=\"".esc_attr($tdbgcolor).";\"><td>";
			if(isset($_GET['selected']) && $_GET['selected']=="yes"){
				if(!empty($productID) && in_array($product->productID, $productID, true))
				{
					echo "<input type=\"checkbox\" checked=\"yes\" name=\"item[]\" value=".esc_attr($product->productID)." /></td><td>";
					$xmlfeedname = get_option('Tradetracker_xmlname');
					echo esc_attr($product->productID);
					echo "</td><td><span class=\"link1\"><a href=\"javascript: void(0)\">";
					echo esc_attr($product->name);
					echo "<span><img src=\"".esc_url($imageURL)."\" width=\"400px\"></span></a></span></td><td>";
					$xmlfeed=$wpdb->get_var("SELECT xmlname FROM ".$ttstorexmltable." where id=".$product->xmlfeed.""); 
					echo esc_attr($xmlfeed);
					echo "</td><td>";
					echo esc_attr($product->price);
					echo "</td><td>";
					echo esc_attr($product->currency);
					$extraname = "";
					$extravar ="";
					$extras = $wpdb->get_results("SELECT extravalue, extrafield FROM $ttstoreextratable where productID='".$product->productID."'", ARRAY_A);
					foreach ($extras as $extra) {
						$Tradetracker_extra_val = get_option("Tradetracker_extra");
						if(!empty($Tradetracker_extra_val)){
							if(in_array($extra[extrafield], $Tradetracker_extra_val, true)) {
								$extraname .= "<td><b>".$extra[extrafield]."</b></td>";
								$extravar .= "<td>".$extra[extravalue]."</td>";
							}
						}
					}
					if($extraname != ""){
						echo "</td><td><span class=\"link\"><a href=\"javascript: void(0)\">"; _e("Yes", "ttstore"); echo "<span><table><tr>".esc_attr($extraname)."</tr><tr>".esc_attr($extravar)."</tr></table> </span></a></span></td></tr>";
					} else {
						echo "</td><td>"; _e("No", "ttstore"); echo "</td></tr>";
					}
					unset($extras);
					if ($colors == "1"){
						$colors++;
					} else {
						$colors--;
					}
				}
			} else {
				if(!empty($productID) && in_array($product->productID, $productID, true))
				{
					echo "<input type=\"checkbox\" checked=\"yes\" name=\"item[]\" value=".esc_attr($product->productID)." /></td><td>";
				} else {
					echo "<input type=\"checkbox\" name=\"item[]\" value=".esc_attr($product->productID)." /></td><td>";
				}
				if($product->imageURL==""){
					$imageURL = plugins_url( 'images/No_image.png' , __FILE__ );
				} else {
					$imageURL = $product->imageURL;
				}
				$xmlfeedname = get_option('Tradetracker_xmlname');
				echo esc_attr($product->productID);
				echo "</td><td><span class=\"link1\"><a href=\"javascript: void(0)\">";
				echo esc_attr($product->name);
				echo "<span><img src=\"".esc_url($imageURL)."\" width=\"400px\">$product->description</a></span></span></td><td>";
				$xmlfeed=$wpdb->get_var("SELECT xmlname FROM ".$ttstorexmltable." where id=".$product->xmlfeed.""); 
				echo esc_attr($xmlfeed);
				echo "</td><td>";
				echo esc_attr($product->price);
				echo "</td><td>";
				echo esc_attr($product->currency);
				$extraname = "";
				$extravar ="";
				$extras = $wpdb->get_results("SELECT extravalue, extrafield FROM $ttstoreextratable where productID='".$product->productID."'", ARRAY_A);
				foreach ($extras as $extra) {
					$Tradetracker_extra_val = get_option("Tradetracker_extra");
					if(!empty($Tradetracker_extra_val)){
						if(in_array($extra['extrafield'], $Tradetracker_extra_val, true)) {
							$extraname .= "<td><b>".$extra['extrafield']."</b></td>";
							$extravar .= "<td>".$extra['extravalue']."</td>";
						}
					}
				}
				if($extraname != ""){
					echo "</td><td><span class=\"link\"><a href=\"javascript: void(0)\">"; _e("Yes", "ttstore"); echo "<span><table><tr>".esc_attr($extraname)."</tr><tr>".esc_attr($extravar)."</tr></table> </span></a></span></td></tr>";
				} else {
					echo "</td><td>"; _e("No", "ttstore"); echo "</td></tr>";
				}
				unset($extras);
				if ($colors == "1"){
					$colors++;
				} else {
					$colors--;
				}

			}
			}
		if(!empty($array2) && !empty($productID)){
			$array1 = $productID;
			$array2 = explode(",", $array2);
			$result = array_diff($array1, $array2);
			if(isset($result)){
				$result = implode(",", $result);
				echo "<input type=\"hidden\" name=\"itemsother\" value=\"".esc_attr($result)."\" />";
			}
		}
			
	echo "<tr><td colspan=\"5\">"; _e("Select", "ttstore"); echo " <a href=\"javascript:selectToggle(true, 'form2');\">"; _e("All", "ttstore"); echo "</a> | <a href=\"javascript:selectToggle(false, 'form2');\">"; _e("None", "ttstore"); echo "</a></td></tr>";
	echo "</table>";
	echo "<table width=\"<?php echo $adminwidth-15; ?>\"><tr><td>";
	if ($currentpage != 0) { // Don't show back link if current page is first page.
		$back_page = $currentpage - $limit;
		echo("<a href=\"admin.php?page=tt-store&option=itemselect&function=select".esc_attr($searchlink)."&multiid=".esc_attr($multiid)."&order=$order".esc_attr($filterurl)."&currentpage=".esc_attr($back_page)."&limit=".esc_attr($limit)."\">back</a>    \n");
	}
	for ($i=1; $i <= $pages; $i++){
		$ppage = $limit*($i - 1);
		if ($ppage == $currentpage){
			echo("<b>".esc_attr($i)."</b> \n"); // If current page don't give link, just text.
		}else{
			echo("<a href=\"admin.php?page=tt-store&option=itemselect&function=select".esc_attr($searchlink)."&multiid=".esc_attr($multiid)."&order=$order".esc_attr($filterurl)."&currentpage=".esc_attr($ppage)."&limit=".esc_attr($limit)."\">".esc_attr($i)."</a> \n");
		}
	}
	if (!((($currentpage+$limit) / $limit) >= $pages) && $pages != 1) { // If last page don't give next link.
		$next_page = $currentpage + $limit;
		echo("    <a href=\"admin.php?page=tt-store&option=itemselect&function=select".esc_attr($searchlink)."&multiid=".esc_attr($multiid)."&order=$order".esc_attr($filterurl)."&currentpage=".esc_attr($next_page)."&limit=".esc_attr($limit)."\">next</a>\n");
	}
	echo "</td></tr></table>";
?>

		</div>
		<div id="ttstoreboxbottom">
			<?php
				if(isset($saved)){
					echo $saved;
				}
			?>
			<input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Save Changes') ?>" /> 
			<INPUT type="button" name="Close" class="button-secondary" value="<?php esc_attr_e('Close') ?>" onclick="location.href='admin.php?page=tt-store&option=itemselect'"> 
		</div>
	</div>
</div>


<?php

	}
}
?>
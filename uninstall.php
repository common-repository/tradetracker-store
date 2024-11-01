<?php
if (function_exists( 'is_multisite' ) && is_multisite() ) {
   global $wpdb;
   $old_blog =  $wpdb->blogid;
   //Get all blog ids
   $blogids =  $wpdb->get_col( "SELECT blog_id FROM $wpdb->blogs" );
   foreach ( $blogids as $blog_id ) {
      switch_to_blog($blog_id);
      delete_table();
   }
   switch_to_blog( $old_blog );
} else {
   delete_table();
}
/**
 * Delete custom table and options created by plugin
 *
 * @since 1.0
 * @global WPDB $wpdb
 * @return void
 */
function delete_table(){
	global $wpdb;
	$TT_Storepro_table_prefix=$wpdb->prefix.'tradetracker_';
	define('TT_StorePRO_TABLE_PREFIX', $TT_Storepro_table_prefix);
	$ttstoretable = TT_StorePRO_TABLE_PREFIX."store";
	$ttstorelayouttable = TT_StorePRO_TABLE_PREFIX."layout";
	$ttstoremultitable = TT_StorePRO_TABLE_PREFIX."multi";
	$ttstoreitemtable = TT_StorePRO_TABLE_PREFIX."item";
	$ttstorexmltable = TT_StorePRO_TABLE_PREFIX."xml";
	$ttstorecattable = TT_StorePRO_TABLE_PREFIX."cat";
	$ttstoreextratable = TT_StorePRO_TABLE_PREFIX."extra";
	$ttstoreproviderlogotable = TT_StorePRO_TABLE_PREFIX."providerlogo";
	$ttstorestatstable = TT_StorePRO_TABLE_PREFIX."stats";
	wp_clear_scheduled_hook('xml_update');
	$structure = "drop table if exists $ttstoretable";
	$wpdb->query($structure);
	$structure2 = "drop table if exists $ttstorelayouttable";
	$wpdb->query($structure2); 
	$structure3 = "drop table if exists $ttstoremultitable";
	$wpdb->query($structure3); 
	$structure4 = "drop table if exists $ttstoreitemtable";
	$wpdb->query($structure4); 
	$structure5 = "drop table if exists $ttstorexmltable";
	$wpdb->query($structure5); 
	$structure6 = "drop table if exists $ttstorecattable";
	$wpdb->query($structure6); 
	$structure7 = "drop table if exists $ttstoreextratable";
	$wpdb->query($structure7); 
	$structure8 = "drop table if exists $ttstorestatstable";
	$wpdb->query($structure8); 
	$structure9 = "drop table if exists $ttstoreproviderlogotable";
	$wpdb->query($structure9); 
	delete_option("TTnewcategory", "1" );
	delete_option("Tradetracker_xml");
	delete_option("Tradetracker_xmlname");
	delete_option("Tradetracker_xmlupdate");
	delete_option("Tradetracker_debugemail");
	delete_option("Tradetracker_currency");
	delete_option("Tradetracker_currencyloc");
	delete_option("Tradetracker_newcur");
	delete_option("Tradetracker_extra");
	delete_option("Tradetracker_xml_extra");
	delete_option("TTstoreversion");
	delete_option("Tradetracker_width");
	delete_option("Tradetracker_debugemail");
	delete_option("Tradetracker_importtool");
	delete_option("Tradetracker_removelayout");
	delete_option("Tradetracker_removestores");
	delete_option("Tradetracker_removeproducts");
	delete_option("Tradetracker_removexml");
	delete_option("Tradetracker_removeother");
	delete_option("tt_premium_provider");
	delete_option("tt_premium_function");
	delete_option("Tradetracker_premiumupdate");
	delete_option("Tradetracker_premiumaccepted");
	delete_option("Tradetracker_premiumapi");
	delete_option("Tradetracker_adminheight");
	delete_option("Tradetracker_adminwidth");
	delete_option("Tradetracker_searchlayout");
	delete_option("Tradetracker_loadextra");
}
?>
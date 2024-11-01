<?php
function ttstore_rllog() {
	global $foldercache;
	$rllog_dir = $foldercache.'releaselog.xml';
	if (!file_exists($rllog_dir)) {
		$rllog_dir = 'http://wpaffiliatefeed.com/category/releaselog/feed/'; 
		$rllog_rec = wp_remote_get($rllog_dir);
		$rllog = $rllog_rec['body'];
	} else {
		$rllog = file_get_contents($rllog_dir);
	}
	$rllog = simplexml_load_string($rllog);
	echo "<ul>";
		foreach($rllog->channel->item as $newsmsg) // loop through our items
		{
			echo "<li><strong><a href=\"".esc_url($newsmsg->link)."\">".esc_attr($newsmsg->title)."</a></strong><br><strong>Posted: ".date("d M Y",strtotime($newsmsg->pubDate))."</strong><br>".esc_attr($newsmsg->description)."</li>";
		}
	echo "</ul>";
}
?>
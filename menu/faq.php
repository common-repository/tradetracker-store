<?php
function ttstore_faq() {
	global $foldercache;
	$faq_dir = $foldercache.'faq.xml';
	if (!file_exists($faq_dir)) {
		$faq_dir = 'http://wpaffiliatefeed.com/tradetracker-store/faq.xml'; 
		$faq_rec = wp_remote_get($faq_dir);
		$faq = $faq_rec['body'];
	} else {
		$faq = file_get_contents($faq_dir);
	}
	$faq = simplexml_load_string($faq);
	echo "<ul>";

	foreach($faq as $faqs) // loop through our items
	{
		if(!isset($faqcategory)){
			$faqcategory = $faqs->faqcategory;
			echo "<li><strong>".esc_attr($faqcategory)."</strong></li>";
			echo "<li><a href=\"".esc_url($faqs->faqadres)."\" target=\"_blank\">".esc_attr($faqs->faqnaam)."</a></li>";
		} else if($faqs->faqcategory != "".$faqcategory.""){
			$faqcategory = $faqs->faqcategory;
			echo "<li><strong>".esc_attr($faqcategory)."</strong></li>";
			echo "<li><a href=\"".esc_url($faqs->faqadres)."\" target=\"_blank\">".esc_attr($faqs->faqnaam)."</a></li>";
		} else {
			echo "<li><a href=\"".esc_url($faqs->faqadres)."\" target=\"_blank\">".esc_attr($faqs->faqnaam)."</a></li>";
		}	
	}
	echo "</ul>";
}
?>
<?php
$name = ttstore_sanitize($_POST['layoutname']);
$width = ttstore_sanitize($_POST['layoutwidth']);
if($width == ""){
	$width="200";
}
$font = ttstore_sanitize($_POST['layoutfont']);
$fontsize = ttstore_sanitize($_POST['layoutfontsize']);
$colortitle = ttstore_sanitize($_POST['layoutcolortitle']);
$colorimagebg = ttstore_sanitize($_POST['layoutcolorimagebg']);
$colorfooter = ttstore_sanitize($_POST['layoutcolorfooter']);
$colorborder = ttstore_sanitize($_POST['layoutcolorborder']);
$colorbutton = ttstore_sanitize($_POST['layoutcolorbutton']);
$colorbuttonfont = ttstore_sanitize($_POST['layoutcolorbuttonfont']);
$colorfont = ttstore_sanitize($_POST['layoutcolorfont']);


$widthtitle = $width-6;
echo "<style type=\"text/css\" media=\"screen\">";
echo ".store-outerbox{width:".esc_attr($width)."px;color:".esc_attr($colorfont).";font-family:".esc_attr($font).";float:left;min-height:353px;border:solid 1px ".esc_attr($colorborder).";position:relative;}";
echo ".store-titel{width:".esc_attr($widthtitle)."px;background-color:".esc_attr($colortitle).";color:".esc_attr($colorfont).";float:left;position:relative;height:30px;line-height:15px;font-size:".esc_attr($fontsize)."px;padding:3px;font-weight:bold;text-align:center;}";
echo ".store-image{width:".esc_attr($width)."px;height:180px;padding:0px;overflow:hidden;margin: auto;background-color:".esc_attr($colorimagebg).";}";
echo ".store-image img{display: block;border:0px;margin: auto;}";
echo ".store-footer{width:".esc_attr($width)."px;background-color:".esc_attr($colorfooter).";float:left;position:relative;min-height:137px;}";
echo ".store-description{width:".esc_attr($widthtitle)."px;color:".esc_attr($colorfont).";position:relative;top:5px;left:5px;height:90px;line-height:14px;font-size:".esc_attr($fontsize)."px;overflow:auto;}";
echo ".store-more{min-height:20px; width:".esc_attr($widthtitle)."px;position: relative;float: left;margin-top:10px;margin-left:5px;margin-bottom: 5px;}";
echo ".store-more img{margin:0px !important;}";
echo ".store-price {border: 0 solid #65B9C1;color: #4E4E4E !important;float: right;font-size: ".esc_attr($fontsize)."px !important;font-weight: bold !important;height: 30px !important;position: relative;text-align: center !important;width: 80px !important;}";
echo ".store-price table {background-color: ".esc_attr($colorfooter)." !important;border: 1px none !important;border-collapse: inherit !important;float: right;margin-left: 1px;margin-top: 1px;text-align: center !important;}";
echo ".store-price table tr {padding: 1px !important;}";
echo ".store-price table tr td {padding: 1px !important;}";
echo ".store-price table td, table th, table tr {border: 1px solid #CCCCCC;padding: 0 !important;}";
echo ".store-price table td.euros {font-size: ".esc_attr($fontsize)."px !important;letter-spacing: -1px !important; }";
echo ".store-price {background-color: ".esc_attr($colorborder)." !important;}";
echo ".buttons a, .buttons button {height:18px;background-color: ".esc_attr($colorbutton).";border: 1px solid ".esc_attr($colorbutton).";bottom: 0;color: ".esc_attr($colorbuttonfont).";cursor: pointer;display: block;float: left;font-size: ".esc_attr($fontsize)."px;font-weight: bold;margin-top: 0;padding: 5px 10px 5px 7px;position: relative;text-decoration: none;width: 100px;}";
echo ".buttons button {overflow: visible;padding: 4px 10px 3px 7px;width: auto;}";
echo ".buttons button[type] {line-height: 17px;padding: 5px 10px 5px 7px;}";
echo ":first-child + html button[type] {padding: 4px 10px 3px 7px;}";
echo ".buttons button img, .buttons a img {border: medium none;margin: 0 3px -3px 0 !important;padding: 0;}";
echo ".button.regular, .buttons a.regular {color: ".esc_attr($colorbuttonfont).";}";
echo ".buttons a.regular:hover, button.regular:hover {background-color: #4E4E4E;border: 1px solid #4E4E4E;color: ".esc_attr($colorbuttonfont).";}";
echo ".buttons a.regular:active {background-color: #FFFFFF;border: 1px solid ".esc_attr($colorbutton).";color: ".esc_attr($colorbuttonfont).";}";
echo "</style>";

?>
		<div class="store-outerbox">
			<div class="store-titel">
				<?php echo esc_attr($name); ?>
			</div>			
			<div class="store-image">
				<img src="" style="max-width:<?php echo esc_attr($width); ?>px;max-height:180px;">
			</div>
			<div class="store-footer">
				<div class="store-description">
					The description for the item you can buy using the <?php echo esc_attr($font); ?> font using font-size <?php echo esc_attr($fontsize); ?>
				</div>
				<div class="store-more"></div>
				<div class="buttons">
					<a href="#" class="regular">
						Buy Item
					</a>
				</div>
				<div class="store-price">
					<table cellspacing="0" cellpadding="0" border="0">
						<tr>
							<td style="border: 1px none; width: 100px; margin: 1px; height: 29px;" class="euros">
								0,00 EUR
							</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
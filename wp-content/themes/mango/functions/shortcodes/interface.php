<?php require_once('config.php');
if ( !is_user_logged_in() || !current_user_can('edit_posts') ) wp_die(__('You are not allowed to be here', 'premitheme')); ?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php _e('Premitheme Shortcodes', 'premitheme');?></title>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php echo get_option('blog_charset'); ?>" />

<script language="javascript" type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo get_template_directory_uri() ?>/functions/shortcodes/shortcodes-scripts.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo get_template_directory_uri() ?>/functions/shortcodes/send_to_editor.js"></script>

<base target="_self" />
<link href="<?php echo get_template_directory_uri() ?>/functions/shortcodes/style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo get_template_directory_uri() ?>/css/font-awesome.css" rel="stylesheet" type="text/css" />
</head>
<body onLoad="tinyMCEPopup.executeOnLoad('init();');document.body.style.display='';" id="link">
<form name="pt_shortcode_form" action="#">

<div id="shortcode_wrap">
<div id="shortcode_panel" class="current">
<fieldset style="border:0;">

<h2><?php _e('Select Shortcode', 'premitheme');?></h2>

<div class="row">
	<label for="scSelect"><?php _e('Shortcode', 'premitheme');?></label>
	<select id="scSelect" name="scSelect">
		<option value="0" style="font-weight:bold;font-style:italic;"><?php _e('Select Option &hellip;', 'premitheme');?></option>
		<option value="scColumn"><?php _e('Layout Columns', 'premitheme');?></option>
		<option value="scTypography"><?php _e('Typography', 'premitheme');?></option>
		<option value="scButton"><?php _e('Button', 'premitheme');?></option>
		<option value="scDivider"><?php _e('Divider', 'premitheme');?></option>
		<option value="scList"><?php _e('List', 'premitheme');?></option>
		<option value="scAccordion"><?php _e('Accordion', 'premitheme');?></option>
		<option value="scTabs"><?php _e('Tabs', 'premitheme');?></option>
		<option value="scImage"><?php _e('Image', 'premitheme');?></option>
		<option value="scVideo"><?php _e('Video (URL)', 'premitheme');?></option>
        <option value="scVideoEmbed"><?php _e('Video (Embed Code)', 'premitheme');?></option>
		<option value="scAudio"><?php _e('Audio', 'premitheme');?></option>
		<option value="scTestimonial"><?php _e('Testimonial', 'premitheme');?></option>
		<option value="scNotification"><?php _e('Notification Box', 'premitheme');?></option>
		<option value="scService"><?php _e('Service/Feature Block', 'premitheme');?></option>
		<option value="scSlider"><?php _e('Image Slider', 'premitheme');?></option>
		<option value="scPopup"><?php _e('Popup Box (lightbox)', 'premitheme');?></option>
		<option value="scGraph"><?php _e('Bar Graph', 'premitheme');?></option>
		<option value="scPrice"><?php _e('Price Label', 'premitheme');?></option>
	</select>
	<div class="clear"></div>
</div>

<div id="scColumn">
	<h2><?php _e('Layout Columns Shortcode', 'premitheme');?></h2>
	<div class="row">
		<label for="columnLayout"><?php _e('layout', 'premitheme');?></label>
		<select id="columnLayout" name="columnLayout">
			<option value="0" style="font-weight:bold;font-style:italic;"><?php _e('Select Option &hellip;', 'premitheme');?></option>
			<option value="fullwidth_column"><?php _e('Full-width Column', 'premitheme');?></option>
			<option value="two_columns"><?php _e('2 Columns', 'premitheme');?></option>
			<option value="three_columns"><?php _e('3 Columns', 'premitheme');?></option>
			<option value="four_columns"><?php _e('4 Columns', 'premitheme');?></option>
			<option value="five_columns"><?php _e('5 Columns', 'premitheme');?></option>
			<option value="six_columns"><?php _e('6 Columns', 'premitheme');?></option>
			<option value="one_fourth_three_fourth_columns"><?php _e('1/4 + 3/4', 'premitheme');?></option>
			<option value="three_fourth_one_fourth_columns"><?php _e('3/4 + 1/4', 'premitheme');?></option>
			<option value="one_third_two_third_columns"><?php _e('1/3 + 2/3', 'premitheme');?></option>
			<option value="two_third_one_third_columns"><?php _e('2/3 + 1/3', 'premitheme');?></option>
			<option value="one_fourth_one_half_one_fourth_columns"><?php _e('1/4 + 1/2 + 1/4', 'premitheme');?></option>
			<option value="one_half_one_fourth_one_fourth_columns"><?php _e('1/2 + 1/4 + 1/4', 'premitheme');?></option>
			<option value="one_fourth_one_fourth_one_half_columns"><?php _e('1/4 + 1/4 + 1/2', 'premitheme');?></option>
		</select>
		<div class="clear"></div>
	</div>
	<p class="insertNotice"><?php _e('Select layout and "Insert" the shortcode', 'premitheme');?></p>
</div>

<div id="scTypography">
	<h2><?php _e('Typography Shortcode', 'premitheme');?></h2>
	<div class="row">
		<label for="typoElement"><?php _e('Element', 'premitheme');?></label>
		<select id="typoElement" name="typoElement">
			<option value="0" style="font-weight:bold;font-style:italic;"><?php _e('Select Option &hellip;', 'premitheme');?></option>
			<option value="typoHighlighted"><?php _e('Highlighted Text', 'premitheme');?></option>
			<option value="typoDropcap"><?php _e('Dropcap Letter', 'premitheme');?></option>
			<option value="typoBlockquote"><?php _e('Blockquote', 'premitheme');?></option>
			<option value="typoPullquoteLeft"><?php _e('Pullquote - Left Aligned', 'premitheme');?></option>
			<option value="typoPullquoteRight"><?php _e('Pullquote - Right Aligned', 'premitheme');?></option>
		</select>
		<div class="clear"></div>
	</div>
	<p class="insertNotice"><?php _e('Select element and "Insert" the shortcode', 'premitheme');?></p>
</div>

<div id="scButton">
	<h2><?php _e('Button Shortcode', 'premitheme');?></h2>
	<div class="row">
		<label for="btnColor"><?php _e('Button Color', 'premitheme');?></label>
		<select id="btnColor" name="btnColor">
			<option value="0" style="font-weight:bold;font-style:italic;"><?php _e('Select Option &hellip;', 'premitheme');?></option>
			<option value="turquoise"><?php _e('Turquoise', 'premitheme');?></option>
			<option value="orange"><?php _e('Orange', 'premitheme');?></option>
			<option value="pink"><?php _e('Pink', 'premitheme');?></option>
			<option value="blue"><?php _e('Blue', 'premitheme');?></option>
			<option value="brown"><?php _e('Brown', 'premitheme');?></option>
			<option value="green"><?php _e('Green', 'premitheme');?></option>
			<option value="purple"><?php _e('Purple', 'premitheme');?></option>
			<option value="gray"><?php _e('Light Gray', 'premitheme');?></option>
			<option value="dark-gray"><?php _e('Dark Gray', 'premitheme');?></option>
		</select>
		<div class="clear"></div>
	</div>
	
	<div class="row">
		<label for="btnText"><?php _e('Button Text', 'premitheme');?></label>
		<input id="btnText" name="btnText" type="text" value="<?php _e('Sample Link', 'premitheme');?>"/>
		<div class="clear"></div>
	</div>
	
	<div class="row">
		<label for="btnUrl"><?php _e('Button URL', 'premitheme');?></label>
		<input id="btnUrl" name="btnUrl" type="text" value="http://"/>
		<div class="clear"></div>
	</div>
	
	<div class="row">
		<label for="btnLiquid" class="for_checkbox"><?php _e('Liquid Width', 'premitheme');?></label>
		<input id="btnLiquid" class="checkbox" name="btnLiquid" type="checkbox"/>
		<div class="clear"></div>
	</div>
	
	<div class="row">
		<label for="btnTarget" class="for_checkbox"><?php _e('Open Link in New Window', 'premitheme');?></label>
		<input id="btnTarget" class="checkbox" name="btnTarget" type="checkbox"/>
		<div class="clear"></div>
	</div>
	
	<p class="insertNotice"><?php _e('Customize and "Insert" the shortcode', 'premitheme');?></p>
</div>

<div id="scDivider">
	<h2><?php _e('Divider Shortcode', 'premitheme');?></h2>
	<div class="row">
		<label for="divType"><?php _e('Type', 'premitheme');?></label>
		<select id="divType" name="divType">
			<option value="0" style="font-weight:bold;font-style:italic;"><?php _e('Select Option &hellip;', 'premitheme');?></option>
			<option value="divNormal"><?php _e('Standard Divider', 'premitheme');?></option>
			<option value="divTop"><?php _e('Standard Divider with Top Link', 'premitheme');?></option>
			<option value="divSpace"><?php _e('Horizontal space', 'premitheme');?></option>
		</select>
		<div class="clear"></div>
	</div>
	<p class="insertNotice"><?php _e('Select type and "Insert" the shortcode', 'premitheme');?></p>
</div>

<div id="scList">
	<h2><?php _e('List Shortcode', 'premitheme');?></h2>
	<div class="row">
		<label for="listType"><?php _e('List Type', 'premitheme');?></label>
		<select id="listType" name="listType">
			<option value="0" style="font-weight:bold;font-style:italic;"><?php _e('Select Option &hellip;', 'premitheme');?></option>
			<option value="arrow-right"><?php _e('Arrow List', 'premitheme');?></option>
			<option value="check"><?php _e('Check List', 'premitheme');?></option>
			<option value="heart"><?php _e('Heart List', 'premitheme');?></option>
			<option value="star"><?php _e('Star List', 'premitheme');?></option>
			<option value="times"><?php _e('Error List', 'premitheme');?></option>
			<option value="plus"><?php _e('Plus List', 'premitheme');?></option>
			<option value="thumbs-up"><?php _e('Thumbs Up List', 'premitheme');?></option>
			<option value="thumbs-down"><?php _e('Thumbs Down List', 'premitheme');?></option>
		</select>
		<div class="clear"></div>
	</div>
	<p class="insertNotice"><?php _e('Select type and "Insert" the shortcode', 'premitheme');?></p>
</div>

<div id="scAccordion">
	<h2><?php _e('Accordion Shortcode', 'premitheme');?></h2>
	<p class="insertNotice"><?php _e('Now "Insert" the shortcode', 'premitheme');?></p>
</div>

<div id="scTabs">
	<h2><?php _e('Tabs Shortcode', 'premitheme');?></h2>
	<p class="insertNotice"><?php _e('Now "Insert" the shortcode', 'premitheme');?></p>
</div>

<div id="scImage">
	<h2><?php _e('Image Shortcode', 'premitheme');?></h2>
	<div class="row">
		<label for="imgPath"><?php _e('Image Path', 'premitheme');?></label>
		<input id="imgPath" name="imgPath" type="text" value=""/>
		<div class="clear"></div>
	</div>
	
	<div class="row">
		<label for="imgWidth"><?php _e('Image Width in Pixels', 'premitheme');?></label>
		<input id="imgWidth" name="imgWidth" type="text" value=""/>
		<div class="clear"></div>
	</div>
	
	<div class="row">
		<label for="imgHeight"><?php _e('Image Height in Pixels', 'premitheme');?></label>
		<input id="imgHeight" name="imgHeight" type="text" value=""/>
		<div class="clear"></div>
		<p><?php _e('Leave height empty for auto height', 'premitheme');?></p>
	</div>
	
	<div class="row">
		<label for="imgAlt"><?php _e('Alt Attribute Text', 'premitheme');?></label>
		<input id="imgAlt" name="imgAlt" type="text" value=""/>
		<div class="clear"></div>
	</div>
	
	<div class="row">
		<label for="imgTitle"><?php _e('Title Attribute Text', 'premitheme');?></label>
		<input id="imgTitle" name="imgTitle" type="text" value=""/>
		<div class="clear"></div>
	</div>
	
	<div class="row">
		<label for="imgAlign"><?php _e('Align', 'premitheme');?></label>
		<select id="imgAlign" name="imgAlign">
			<option value="alignnone"><?php _e('None', 'premitheme');?></option>
			<option value="alignleft"><?php _e('Left', 'premitheme');?></option>
			<option value="alignright"><?php _e('Right', 'premitheme');?></option>
			<option value="aligncenter"><?php _e('Center', 'premitheme');?></option>
		</select>
		<div class="clear"></div>
	</div>
	
	<div class="row">
		<label for="imgLink"><?php _e('Link URL (optional)', 'premitheme');?></label>
		<input id="imgLink" name="imgLink" type="text" value=""/>
		<div class="clear"></div>
		<p><?php _e('Insert the same image path to open in lightbox', 'premitheme');?></p>
	</div>
	
	<div class="row">
		<label for="imgFrame" class="for_checkbox"><?php _e('Image with frame', 'premitheme');?></label>
		<input id="imgFrame" class="checkbox" name="imgFrame" type="checkbox" checked="checked"/>
		<div class="clear"></div>
	</div>
	
	<p class="insertNotice"><?php _e('Customize and "Insert" the shortcode', 'premitheme');?></p>
</div>

<div id="scVideo">
	<h2><?php _e('Video Shortcode', 'premitheme');?></h2>
	<div class="row">
		<label for="vidUrl"><?php _e('Video URL', 'premitheme');?></label>
		<input id="vidUrl" name="vidUrl" type="text" value=""/>
		<div class="clear"></div>
	</div>
	
	<div class="row">
		<label for="vidAlign"><?php _e('Align', 'premitheme');?></label>
		<select id="vidAlign" name="vidAlign">
			<option value="aligncenter"><?php _e('Center', 'premitheme');?></option>
			<option value="alignleft"><?php _e('Left', 'premitheme');?></option>
			<option value="alignright"><?php _e('Right', 'premitheme');?></option>
			<option value="alignnone"><?php _e('None', 'premitheme');?></option>
		</select>
		<div class="clear"></div>
	</div>
	
	<div class="row">
		<label for="vidWidth"><?php _e('Video Width in Pixels', 'premitheme');?></label>
		<input id="vidWidth" name="vidWidth" type="text" value=""/>
		<div class="clear"></div>
	</div>
	<p><?php _e('Leave width empty for full width (according to container width).', 'premitheme'); ?> <a href="http://codex.wordpress.org/Embeds#Okay.2C_So_What_Sites_Can_I_Embed_From.3F"><?php _e('List of supported video types', 'premitheme');?></a></p>
	
	<p class="insertNotice"><?php _e('Customize and "Insert" the shortcode', 'premitheme');?></p>
</div>

<div id="scVideoEmbed">
    <h2><?php _e('Video Shortcode (Using Embed Code)', 'premitheme');?></h2>
    <div class="row">
        <label for="vidEmbed"><?php _e('Video Embed Code', 'premitheme');?></label>
        <input id="vidEmbed" name="vidEmbed" type="text" value=""/>
        <div class="clear"></div>
    </div>
    
    <p class="insertNotice"><?php _e('Customize and "Insert" the shortcode', 'premitheme');?></p>
</div>

<div id="scAudio">
	<h2><?php _e('Audio Shortcode', 'premitheme');?></h2>
	<div class="row">
		<label for="audioMp3"><?php _e('MP3 File Path (required)', 'premitheme');?></label>
		<input id="audioMp3" name="audioMp3" type="text" value=""/>
		<div class="clear"></div>
	</div>
	
	<div class="row">
		<label for="audioOga"><?php _e('OGA File Path (required)', 'premitheme');?></label>
		<input id="audioOga" name="audioOga" type="text" value=""/>
		<div class="clear"></div>
	</div>
	
	<div class="row">
		<label for="audioID"><?php _e('Unique ID', 'premitheme');?></label>
		<input id="audioID" name="audioID" type="text" value=""/>
		<div class="clear"></div>
	</div>
	<p><?php _e('This ID must be unique.', 'premitheme'); ?></p>
	
	<p class="insertNotice"><?php _e('Customize and "Insert" the shortcode', 'premitheme');?></p>
</div>

<div id="scTestimonial">
	<h2><?php _e('Testimonial Shortcode', 'premitheme');?></h2>
	<p class="insertNotice"><?php _e('Now "Insert" the shortcode', 'premitheme');?></p>
</div>

<div id="scNotification">
	<h2><?php _e('Notification Box Shortcode', 'premitheme');?></h2>
	<div class="row">
		<label for="boxType"><?php _e('Message Color', 'premitheme');?></label>
		<select id="boxType" name="boxType">
			<option value="0" style="font-weight:bold;font-style:italic;"><?php _e('Select Option &hellip;', 'premitheme');?></option>
			<option value="green"><?php _e('Green', 'premitheme');?></option>
			<option value="red"><?php _e('Red', 'premitheme');?></option>
			<option value="orange"><?php _e('Orange', 'premitheme');?></option>
			<option value="purple"><?php _e('Purple', 'premitheme');?></option>
			<option value="blue"><?php _e('Blue', 'premitheme');?></option>
			<option value="grey"><?php _e('Grey', 'premitheme');?></option>
		</select>
		<div class="clear"></div>
	</div>
	<p class="insertNotice"><?php _e('Select type and "Insert" the shortcode', 'premitheme');?></p>
</div>

<div id="scService">
	<h2><?php _e('Service/Feature Block Shortcode', 'premitheme');?></h2>
	<div class="row">
		<label for="serviceTitle"><?php _e('Service/Feature Title', 'premitheme');?></label>
		<input id="serviceTitle" name="serviceTitle" type="text" value="Sample title"/>
		<div class="clear"></div>
	</div>
	
	<div class="row">
		<label for="iconLayout"><?php _e('Layout', 'premitheme');?></label>
		<select id="iconLayout" name="iconLayout">
			<option value="left" style="font-weight:bold;font-style:italic;"><?php _e('Select Option &hellip;', 'premitheme');?></option>
			<option value="left"><?php _e('Icon on left', 'premitheme');?></option>
			<option value="right"><?php _e('Icon on right', 'premitheme');?></option>
			<option value="center"><?php _e('Icon on top', 'premitheme');?></option>
		</select>
		<div class="clear"></div>
	</div>

	<div class="row">
		<label for="iconType"><?php _e('Icon', 'premitheme');?>
		<!-- <div class="help"> -->
			<!-- <img title="Icons Guide" alt="Help" src="<?php //echo get_template_directory_uri() ?>/functions/shortcodes/images/help.png" /> -->
			<!-- <i class="fa fa-heart"></i> -->
			<!-- <div class="help_popup">
				<p><?php //_e('Icons Guide', 'premitheme');?>:</p>
				<img alt="" src="<?php //echo get_template_directory_uri() ?>/functions/shortcodes/images/icons_guide.png" />
			</div> -->
		<!-- </div> -->
		</label>
		<fieldset class="radio-btns">
			<div class="icon-example">
				<input type="radio" name="iconType" value="heart"><i class="fa fa-heart fa-lg"></i>
			</div>

			<div class="icon-example">
				<input type="radio" name="iconType" value="music"><i class="fa fa-music fa-lg"></i>
			</div>

			<div class="icon-example">
				<input type="radio" name="iconType" value="search"><i class="fa fa-search fa-lg"></i>
			</div>

			<div class="icon-example">
				<input type="radio" name="iconType" value="star"><i class="fa fa-star fa-lg"></i>
			</div>

			<div class="icon-example">
				<input type="radio" name="iconType" value="film"><i class="fa fa-film fa-lg"></i>
			</div>

			<div class="icon-example">
				<input type="radio" name="iconType" value="check"><i class="fa fa-check fa-lg"></i>
			</div>

			<div class="icon-example">
				<input type="radio" name="iconType" value="power-off"><i class="fa fa-power-off fa-lg"></i>
			</div>

			<div class="icon-example">
				<input type="radio" name="iconType" value="signal"><i class="fa fa-signal fa-lg"></i>
			</div>

			<div class="icon-example">
				<input type="radio" name="iconType" value="cog"><i class="fa fa-cog fa-lg"></i>
			</div>

			<div class="icon-example">
				<input type="radio" name="iconType" value="home"><i class="fa fa-home fa-lg"></i>
			</div>

			<div class="icon-example">
				<input type="radio" name="iconType" value="clock-o"><i class="fa fa-clock-o fa-lg"></i>
			</div>

			<div class="icon-example">
				<input type="radio" name="iconType" value="download"><i class="fa fa-download fa-lg"></i>
			</div>

			<div class="icon-example">
				<input type="radio" name="iconType" value="upload"><i class="fa fa-upload fa-lg"></i>
			</div>

			<div class="icon-example">
				<input type="radio" name="iconType" value="inbox"><i class="fa fa-inbox fa-lg"></i>
			</div>

			<div class="icon-example">
				<input type="radio" name="iconType" value="refresh"><i class="fa fa-refresh fa-lg"></i>
			</div>

			<div class="icon-example">
				<input type="radio" name="iconType" value="lock"><i class="fa fa-lock fa-lg"></i>
			</div>

			<div class="icon-example">
				<input type="radio" name="iconType" value="unlock-alt"><i class="fa fa-unlock-alt fa-lg"></i>
			</div>

			<div class="icon-example">
				<input type="radio" name="iconType" value="flag"><i class="fa fa-flag fa-lg"></i>
			</div>

			<div class="icon-example">
				<input type="radio" name="iconType" value="headphones"><i class="fa fa-headphones fa-lg"></i>
			</div>

			<div class="icon-example">
				<input type="radio" name="iconType" value="volume-up"><i class="fa fa-volume-up fa-lg"></i>
			</div>

			<div class="icon-example">
				<input type="radio" name="iconType" value="tags"><i class="fa fa-tags fa-lg"></i>
			</div>

			<div class="icon-example">
				<input type="radio" name="iconType" value="book"><i class="fa fa-book fa-lg"></i>
			</div>

			<div class="icon-example">
				<input type="radio" name="iconType" value="print"><i class="fa fa-print fa-lg"></i>
			</div>

			<div class="icon-example">
				<input type="radio" name="iconType" value="camera"><i class="fa fa-camera fa-lg"></i>
			</div>

			<div class="icon-example">
				<input type="radio" name="iconType" value="video-camera"><i class="fa fa-video-camera fa-lg"></i>
			</div>

			<div class="icon-example">
				<input type="radio" name="iconType" value="picture-o"><i class="fa fa-picture-o fa-lg"></i>
			</div>

			<div class="icon-example">
				<input type="radio" name="iconType" value="map-marker"><i class="fa fa-map-marker fa-lg"></i>
			</div>

			<div class="icon-example">
				<input type="radio" name="iconType" value="pencil"><i class="fa fa-pencil fa-lg"></i>
			</div>

			<div class="icon-example">
				<input type="radio" name="iconType" value="tint"><i class="fa fa-tint fa-lg"></i>
			</div>

			<div class="icon-example">
				<input type="radio" name="iconType" value="play"><i class="fa fa-play fa-lg"></i>
			</div>

			<div class="icon-example">
				<input type="radio" name="iconType" value="crosshairs"><i class="fa fa-crosshairs fa-lg"></i>
			</div>

			<div class="icon-example">
				<input type="radio" name="iconType" value="ban"><i class="fa fa-ban fa-lg"></i>
			</div>

			<div class="icon-example">
				<input type="radio" name="iconType" value="plus"><i class="fa fa-plus fa-lg"></i>
			</div>

			<div class="icon-example">
				<input type="radio" name="iconType" value="gift"><i class="fa fa-gift fa-lg"></i>
			</div>

			<div class="icon-example">
				<input type="radio" name="iconType" value="leaf"><i class="fa fa-leaf fa-lg"></i>
			</div>

			<div class="icon-example">
				<input type="radio" name="iconType" value="eye"><i class="fa fa-eye fa-lg"></i>
			</div>

			<div class="icon-example">
				<input type="radio" name="iconType" value="exclamation-triangle"><i class="fa fa-exclamation-triangle fa-lg"></i>
			</div>

			<div class="icon-example">
				<input type="radio" name="iconType" value="plane"><i class="fa fa-plane fa-lg"></i>
			</div>

			<div class="icon-example">
				<input type="radio" name="iconType" value="calendar"><i class="fa fa-calendar fa-lg"></i>
			</div>

			<div class="icon-example">
				<input type="radio" name="iconType" value="shopping-cart"><i class="fa fa-shopping-cart fa-lg"></i>
			</div>

			<div class="icon-example">
				<input type="radio" name="iconType" value="folder-open"><i class="fa fa-folder-open fa-lg"></i>
			</div>

			<div class="icon-example">
				<input type="radio" name="iconType" value="key"><i class="fa fa-key fa-lg"></i>
			</div>

			<div class="icon-example">
				<input type="radio" name="iconType" value="comments"><i class="fa fa-comments fa-lg"></i>
			</div>

			<div class="icon-example">
				<input type="radio" name="iconType" value="thumbs-o-up"><i class="fa fa-thumbs-o-up fa-lg"></i>
			</div>

			<div class="icon-example">
				<input type="radio" name="iconType" value="thumbs-o-down"><i class="fa fa-thumbs-o-down fa-lg"></i>
			</div>

			<div class="icon-example">
				<input type="radio" name="iconType" value="trophy"><i class="fa fa-trophy fa-lg"></i>
			</div>
			
			<div class="icon-example">
				<input type="radio" name="iconType" value="phone"><i class="fa fa-phone fa-lg"></i>
			</div>

			<div class="icon-example">
				<input type="radio" name="iconType" value="rss"><i class="fa fa-rss fa-lg"></i>
			</div>

			<div class="icon-example">
				<input type="radio" name="iconType" value="bullhorn"><i class="fa fa-bullhorn fa-lg"></i>
			</div>

			<div class="icon-example">
				<input type="radio" name="iconType" value="globe"><i class="fa fa-globe fa-lg"></i>
			</div>

			<div class="icon-example">
				<input type="radio" name="iconType" value="wrench"><i class="fa fa-wrench fa-lg"></i>
			</div>
			
			<div class="icon-example">
				<input type="radio" name="iconType" value="briefcase"><i class="fa fa-briefcase fa-lg"></i>
			</div>

			<div class="icon-example">
				<input type="radio" name="iconType" value="users"><i class="fa fa-users fa-lg"></i>
			</div>

			<div class="icon-example">
				<input type="radio" name="iconType" value="link"><i class="fa fa-link fa-lg"></i>
			</div>

			<div class="icon-example">
				<input type="radio" name="iconType" value="cloud"><i class="fa fa-cloud fa-lg"></i>
			</div>

			<div class="icon-example">
				<input type="radio" name="iconType" value="magic"><i class="fa fa-magic fa-lg"></i>
			</div>
			
			<div class="icon-example">
				<input type="radio" name="iconType" value="truck"><i class="fa fa-truck fa-lg"></i>
			</div>

			<div class="icon-example">
				<input type="radio" name="iconType" value="usd"><i class="fa fa-usd fa-lg"></i>
			</div>

			<div class="icon-example">
				<input type="radio" name="iconType" value="eur"><i class="fa fa-eur fa-lg"></i>
			</div>

			<div class="icon-example">
				<input type="radio" name="iconType" value="gbp"><i class="fa fa-gbp fa-lg"></i>
			</div>

			<div class="icon-example">
				<input type="radio" name="iconType" value="bolt"><i class="fa fa-bolt fa-lg"></i>
			</div>

			<div class="icon-example">
				<input type="radio" name="iconType" value="sitemap"><i class="fa fa-sitemap fa-lg"></i>
			</div>

			<div class="icon-example">
				<input type="radio" name="iconType" value="umbrella"><i class="fa fa-umbrella fa-lg"></i>
			</div>
			
			<div class="icon-example">
				<input type="radio" name="iconType" value="lightbulb-o"><i class="fa fa-lightbulb-o fa-lg"></i>
			</div>

			<div class="icon-example">
				<input type="radio" name="iconType" value="coffee"><i class="fa fa-coffee fa-lg"></i>
			</div>

			<div class="icon-example">
				<input type="radio" name="iconType" value="cutlery"><i class="fa fa-cutlery fa-lg"></i>
			</div>

			<div class="icon-example">
				<input type="radio" name="iconType" value="desktop"><i class="fa fa-desktop fa-lg"></i>
			</div>

			<div class="icon-example">
				<input type="radio" name="iconType" value="laptop"><i class="fa fa-laptop fa-lg"></i>
			</div>
			
			<div class="icon-example">
				<input type="radio" name="iconType" value="tablet"><i class="fa fa-tablet fa-lg"></i>
			</div>

			<div class="icon-example">
				<input type="radio" name="iconType" value="mobile"><i class="fa fa-mobile fa-lg"></i>
			</div>

			<div class="icon-example">
				<input type="radio" name="iconType" value="quote-left"><i class="fa fa-quote-left fa-lg"></i>
			</div>

			<div class="icon-example">
				<input type="radio" name="iconType" value="rocket"><i class="fa fa-rocket fa-lg"></i>
			</div>

			<div class="icon-example">
				<input type="radio" name="iconType" value="anchor"><i class="fa fa-anchor fa-lg"></i>
			</div>

			<div class="icon-example">
				<input type="radio" name="iconType" value="envelope"><i class="fa fa-envelope fa-lg"></i>
			</div>

			<div class="icon-example">
				<input type="radio" name="iconType" value="flask"><i class="fa fa-flask fa-lg"></i>
			</div>

			<div class="icon-example">
				<input type="radio" name="iconType" value="file-text"><i class="fa fa-file-text fa-lg"></i>
			</div>

			<div class="icon-example">
				<input type="radio" name="iconType" value="puzzle-piece"><i class="fa fa-puzzle-piece fa-lg"></i>
			</div>

			<div class="icon-example">
				<input type="radio" name="iconType" value="microphone"><i class="fa fa-microphone fa-lg"></i>
			</div>

			<div class="icon-example">
				<input type="radio" name="iconType" value="question"><i class="fa fa-question fa-lg"></i>
			</div>

			<div class="icon-example">
				<input type="radio" name="iconType" value="info"><i class="fa fa-info fa-lg"></i>
			</div>

			<div class="icon-example">
				<input type="radio" name="iconType" value="exclamation"><i class="fa fa-exclamation fa-lg"></i>
			</div>
		</fieldset>
		<!-- <select id="iconType" name="iconType">
			<option value="0" style="font-weight:bold;font-style:italic;"><?php //_e('Select Option &hellip;', 'premitheme');?></option>
			<option value="cloud"><?php //_e('1- Cloud Icon', 'premitheme');?></option>
			<option value="heart"><?php //_e('2- Heart Icon', 'premitheme');?></option>
			<option value="tv"><?php //_e('3- TV Icon', 'premitheme');?></option>
			<option value="star"><?php //_e('4- Star Icon', 'premitheme');?></option>
			<option value="speaker"><?php //_e('5- Speaker/Sound Icon', 'premitheme');?></option>
			<option value="video"><?php //_e('6- Video Icon', 'premitheme');?></option>
			<option value="trash"><?php //_e('7- Trash Icon', 'premitheme');?></option>
			<option value="user"><?php //_e('8- User Icon', 'premitheme');?></option>
			<option value="key"><?php //_e('9- Key/Access Icon', 'premitheme');?></option>
			<option value="search"><?php //_e('10- Magnifier/Search Icon', 'premitheme');?></option>
			<option value="gear"><?php //_e('11- Gear/Settings Icon', 'premitheme');?></option>
			<option value="camera"><?php //_e('12- Camera Icon', 'premitheme');?></option>
			<option value="tag"><?php //_e('13- Tag/Label Icon', 'premitheme');?></option>
			<option value="diamond"><?php //_e('14- Diamond Icon', 'premitheme');?></option>
			<option value="lock"><?php //_e('15- Lock/Security Icon', 'premitheme');?></option>
			<option value="light"><?php //_e('16- Light/Bulb Icon', 'premitheme');?></option>
			<option value="pencil"><?php //_e('17- Pencil Icon', 'premitheme');?></option>
			<option value="monitor"><?php //_e('18- Computer/Monitor Icon', 'premitheme');?></option>
			<option value="location"><?php //_e('19- Location Icon', 'premitheme');?></option>
			<option value="eye"><?php //_e('20- Eye Icon', 'premitheme');?></option>
			<option value="speech"><?php //_e('21- Speech Buble Icon', 'premitheme');?></option>
			<option value="inbox"><?php //_e('22- Inbox/Stack Icon', 'premitheme');?></option>
			<option value="drink"><?php //_e('23- Cup/Drink Icon', 'premitheme');?></option>
			<option value="phone"><?php //_e('24- Smart Phone Icon', 'premitheme');?></option>
			<option value="news"><?php //_e('25- News Icon', 'premitheme');?></option>
			<option value="envelope"><?php //_e('26- Message/Envelope Icon', 'premitheme');?></option>
			<option value="like"><?php //_e('27- Like Icon', 'premitheme');?></option>
			<option value="photo"><?php //_e('28- Photo Icon', 'premitheme');?></option>
			<option value="note"><?php //_e('29- Note/Document Icon', 'premitheme');?></option>
			<option value="watch"><?php //_e('30- Watch/Clock Icon', 'premitheme');?></option>
			<option value="paperplane"><?php //_e('31- Paper Plane Icon', 'premitheme');?></option>
			<option value="settings"><?php //_e('32- Parameters/Settings Icon', 'premitheme');?></option>
			<option value="cash"><?php //_e('33- Cash/Economics Icon', 'premitheme');?></option>
			<option value="data"><?php //_e('34- Data/Storage Icon', 'premitheme');?></option>
			<option value="music"><?php //_e('35- Music Icon', 'premitheme');?></option>
			<option value="announcement"><?php //_e('36- Announcement Icon', 'premitheme');?></option>
			<option value="study"><?php //_e('37- Study/Academic Cap Icon', 'premitheme');?></option>
			<option value="lab"><?php //_e('38- Lab Icon', 'premitheme');?></option>
			<option value="food"><?php //_e('39- Food/Restaurants Icon', 'premitheme');?></option>
			<option value="tshirt"><?php //_e('40- T-Shirt Icon', 'premitheme');?></option>
			<option value="fire"><?php //_e('41- Fire Icon', 'premitheme');?></option>
			<option value="clip"><?php //_e('42- Paper Clip Icon', 'premitheme');?></option>
			<option value="shop"><?php //_e('43- Shop/Store Icon', 'premitheme');?></option>
			<option value="calendar"><?php //_e('44- Calendar Icon', 'premitheme');?></option>
			<option value="wallet"><?php //_e('45- Wallet Icon', 'premitheme');?></option>
			<option value="disk"><?php //_e('46- Disk Icon', 'premitheme');?></option>
			<option value="truck"><?php //_e('47- Truck Icon', 'premitheme');?></option>
			<option value="globe"><?php //_e('48- Globe Icon', 'premitheme');?></option>
		</select> -->
		<div class="clear"></div>
	</div>
	<p class="insertNotice"><?php _e('Customize and "Insert" the shortcode', 'premitheme');?></p>
</div>

<div id="scSlider">
	<h2><?php _e('Image Slider Shortcode', 'premitheme');?></h2>
	<div class="row">
		<label for="sliderWidth"><?php _e('Slider Width in Pixels', 'premitheme');?></label>
		<input id="sliderWidth" name="sliderWidth" type="text" value=""/>
		<div class="clear"></div>
	</div>
	
	<div class="row">
		<label for="sliderHeight"><?php _e('Slider Height in Pixels', 'premitheme');?></label>
		<input id="sliderHeight" name="sliderHeight" type="text" value=""/>
		<div class="clear"></div>
	</div>
	<p class="insertNotice"><?php _e('Customize and "Insert" the shortcode', 'premitheme');?></p>
</div>

<div id="scPopup">
	<h2><?php _e('Popup Box Shortcode', 'premitheme');?></h2>
	<div class="row">
		<label for="popupColor"><?php _e('Trigger Button Color', 'premitheme');?></label>
		<select id="popupColor" name="popupColor">
			<option value="0" style="font-weight:bold;font-style:italic;"><?php _e('Select Option &hellip;', 'premitheme');?></option>
			<option value="turquoise"><?php _e('Turquoise', 'premitheme');?></option>
			<option value="orange"><?php _e('Orange', 'premitheme');?></option>
			<option value="pink"><?php _e('Pink', 'premitheme');?></option>
			<option value="blue"><?php _e('Blue', 'premitheme');?></option>
			<option value="brown"><?php _e('Brown', 'premitheme');?></option>
			<option value="green"><?php _e('Green', 'premitheme');?></option>
			<option value="purple"><?php _e('Purple', 'premitheme');?></option>
			<option value="gray"><?php _e('Light Gray', 'premitheme');?></option>
			<option value="dark_gray"><?php _e('Dark Gray', 'premitheme');?></option>
		</select>
		<div class="clear"></div>
	</div>
	
	<div class="row">
		<label for="popupText"><?php _e('Trigger Button Text', 'premitheme');?></label>
		<input id="popupText" name="popupText" type="text" value=""/>
		<div class="clear"></div>
	</div>
	
	<div class="row">
		<label for="popupId"><?php _e('Popup ID', 'premitheme');?></label>
		<input id="popupId" name="popupId" type="text" value=""/>
		<div class="clear"></div>
		<p><?php _e('Must be unique ID, Don\'t use it in multiple popups', 'premitheme');?></p>
	</div>
	<p class="insertNotice"><?php _e('Customize and "Insert" the shortcode', 'premitheme');?></p>
</div>

<div id="scGraph">
	<h2><?php _e('Bar Graph Shortcode', 'premitheme');?></h2>
	<p class="insertNotice"><?php _e('Now "Insert" the shortcode', 'premitheme');?></p>
</div>

<div id="scPrice">
	<h2><?php _e('Price Label Shortcode', 'premitheme');?></h2>
	<div class="row">
		<label for="colSize"><?php _e('Column Size', 'premitheme');?></label>
		<select id="colSize" name="colSize">
			<option value="0" style="font-weight:bold;font-style:italic;"><?php _e('Select Option...', 'premitheme');?></option>
			<option value="fullwidth"><?php _e('Full Width', 'premitheme');?></option>
			<option value="one-half"><?php _e('One Half', 'premitheme');?></option>
			<option value="one-third"><?php _e('One Third', 'premitheme');?></option>
			<option value="one-fourth"><?php _e('One Fourth', 'premitheme');?></option>
			<option value="one-fifth"><?php _e('One Fifth', 'premitheme');?></option>
			<option value="one-sixth"><?php _e('One Sixth', 'premitheme');?></option>
		</select>
		<div class="clear"></div>
	</div>
	
	<div class="row">
		<label for="itemName"><?php _e('Item Name', 'premitheme');?></label>
		<input id="itemName" name="itemName" type="text" value=""/>
		<div class="clear"></div>
	</div>
	
	<div class="row">
		<label for="itemPrice"><?php _e('Item Price', 'premitheme');?></label>
		<input id="itemPrice" name="itemPrice" type="text" value=""/>
		<div class="clear"></div>
	</div>
	
	<div class="row">
		<label for="priceSuffix"><?php _e('Price Suffix (optional e.g "/month")', 'premitheme');?></label>
		<input id="priceSuffix" name="priceSuffix" type="text" value=""/>
		<div class="clear"></div>
	</div>
	
	<div class="row">
		<label for="itemFeatured" class="for_checkbox"><?php _e('Make this featured Item', 'premitheme');?></label>
		<input id="itemFeatured" class="checkbox" name="itemFeatured" type="checkbox"/>
		<div class="clear"></div>
	</div>	
	<p class="insertNotice"><?php _e('Customize and "Insert" the shortcode', 'premitheme');?></p>
</div>

</fieldset>
</div><!-- end shortcode_panel -->

<div class="buttons">
<img style="float:left" alt="" src="<?php echo get_template_directory_uri() ?>/functions/shortcodes/logo.png"/>
<div style="float:right"><input type="submit" id="insert" name="insert" value="<?php _e('Insert', 'premitheme');?>" onClick="embedshortcode();" /></div>
<div style="float:right; margin-right:10px;"><input type="button" id="cancel" name="cancel" value="<?php _e('Close', 'premitheme');?>" onClick="tinyMCEPopup.close();" /></div>
<div class="clear"></div>
</div>

</div><!-- end shortcode_wrap -->

</form>

</body>
</html>

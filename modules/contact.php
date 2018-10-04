<style>
	.box_menu_category{
		display: block !important;
	}
</style>
<script type="text/javascript">
	$(document).ready(function() {
		$('.box_left h3 i').off();
	})
</script>
<div class="home2">
	<div class="cont clearfix">
<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//-----------------

$breadcrumb_home = '<a href="'. HOME_URL_LANG . '" title="' . $lgTxt_menu_home . '"><i class="fa fa-home"></i></a>';
$breadcrumb_category = $breadcrumb_menu_parent = $breadcrumb_menu = '';
$breadcrumb_category = '<a href="' . HOME_URL_LANG . '/' . $lgTxt_slug_contact . '" title="' . $lgTxt_menu_contact . '">' . $lgTxt_menu_contact . '</a>';
include(_F_INCLUDES . DS . "tth_left.php");
echo '<div class="content">';
echo '<div class="breadcrumb">' . $breadcrumb_home . $breadcrumb_category . $breadcrumb_menu_parent . $breadcrumb_menu . '</div>';
?>
<div class="wrap-detail">
	<div><?=getPage('contact_maps')?></div>
	<h4 class="title-upc f-space30"><?=getPage('contact_page', 'name')?></h4>
	<div class="contact-info f-space10">
		<?php echo getPage('contact_page')?>
	</div>
	<input type="hidden" name="lang_field" value="<?php echo $txtEnter_field;?>"/>
	<input type="hidden" name="lang_email" value="<?php echo $txtEnter_email;?>"/>
	<input type="hidden" name="lang_phone" value="<?php echo $txtEnter_tell;?>"/>
	<form id="_frm_contact" name="frm_contact" class="frm f-space20" method="post" onsubmit="return sendMail('send_contact', '_frm_contact');">
		<div class="f-space05 clearfix">
			<div class="form-item form-sm">
				<input type="text" name="full_name" placeholder="<?=$txtdistri_name?>" value="" maxlength="250">
				<i class="fa fa-user"></i>
			</div>
			<div class="form-item form-sm">
				<input type="text" name="address" placeholder="<?=$txtContact_address?>" value="" maxlength="250">
				<i class="fa fa-building-o"></i>
			</div>
			<div class="clearfix"></div>
			<div class="form-item form-sm">
				<input type="text" name="email" placeholder="<?=$txtContact_email?>" value="" maxlength="250">
				<i class="fa fa-envelope"></i>
			</div>
			<div class="form-item form-sm">
				<input type="text" name="tell" placeholder="<?=$txtContact_fone?>" value="" maxlength="20">
				<i class="fa fa-phone fa-lg"></i>
			</div>
		</div>
		<div class="form-item form-bg">
			<textarea name="content" placeholder="<?=$txtContact_content?>" cols="60" rows="5"></textarea>
			<i class="fa fa-pencil"></i>
		</div>
		<div class="form-bg clearfix">
			<div class="form-sm hidden-xs">&nbsp;</div>
			<div class="form-item form-sm">
				<input type="submit" id="_send_contact" name="send_contact" value="">
			</div>
		</div>
	</form>
	<script>
		window.onload = check_contact();
	</script>
</div>
<?php
echo '</div>';
?>
</div>
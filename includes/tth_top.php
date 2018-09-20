<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//-------------
?>
<div class="top">
	<div class="cont clearfix">
    	<div class="logo"><h1><a href="<?php echo HOME_URL_LANG; ?>"><img src="../images/logo.png" alt="<?php echo getConstant('title') ?>"/></a></h1></div>
    	<?php include(_F_INCLUDES . DS . "tth_menu_main.php"); ?>
    </div>
</div>
<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//--

$breadcrumb_home = '<a href="'. HOME_URL_LANG . '" title="' . $lgTxt_menu_home . '"><i class="fa fa-home"></i></a>';
$breadcrumb_category = $breadcrumb_menu_parent = $breadcrumb_menu = '';
$breadcrumb_category = '<a class="error" href="' . HOME_URL_LANG . '" title="' . $lgTxt_error_page . '">' . $lgTxt_error_page . '</a>';

echo '<div class="breadcrumb">' . $breadcrumb_home . $breadcrumb_category . $breadcrumb_menu_parent . $breadcrumb_menu . '</div>';
echo '<section class="content clearfix">
<div class="content-left">';
?>
<div class="error404 f-space20">
    <p><?php echo $lgTxt_page404;?> <a href="<?php echo HOME_URL_LANG;?>"><?php echo $lgTxt_page404_click;?></a> <?php echo $lgTxt_page404_back;?> <a href="<?php echo HOME_URL_LANG;?>"><?php echo $lgTxt_menu_home;?></a><p>
    <p><i class="fa fa-warning color-red"></i></p>
</div>
<?php
echo '</div>';
include(_F_INCLUDES . DS . "tth_right.php");
echo '</section>';
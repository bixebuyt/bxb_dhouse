<style>
	.slider{
		display:none;
	}
</style>
<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//-------------

$date = new DateClass();
$stringObj = new String();

$slug_cat74 = getSlugCategory(74);

?>
<div class="home">
	<div class="cont clearfix">

<?php

//-----------------
$category_id = 0;
$breadcrumb_home = '<a href="'. HOME_URL_LANG . '" title="' . $lgTxt_menu_home . '"><i class="fa fa-home"></i></a>';
$breadcrumb_category = $breadcrumb_menu_parent = $breadcrumb_menu = '';
$breadcrumb_category = '<a href="' . HOME_URL_LANG . '/' . $lgTxt_slug_search . '" title="' . $lgTxt_title_search . '">' . $lgTxt_title_search . '</a>';




echo '<div class="content"><div class="breadcrumb">' . $breadcrumb_home . $breadcrumb_category . $breadcrumb_menu_parent . $breadcrumb_menu . '</div>';
?>
<?php
if(isset($_GET['btsearch'])) {
	$search	= (isset($_GET['search'])) ? $_GET['search'] : '';
	$type = (isset($_GET['type'])) ? $_GET['type']+0 : 0;
	
	$db->table = "article";
	$db->condition = "`name`  LIKE '%" . $search . "%'";
	$db->order = "created_time DESC";
	$db->limit = "";
	$slug_search    = '';
	$slug_search    .= "&search=" . $search;
	$rows = $db->select();
	$total = $db->RowCount;
	if ($total > 0) {
		$total_pages = 0;
		$per_page = 9;
		if ($total % $per_page == 0) $total_pages = $total / $per_page;
		else $total_pages = floor($total / $per_page) + 1;
		if ($page <= 0) $page = 1;
		$start = ($page - 1) * $per_page;

		$db->table = "article";
		$db->condition = "`name`  LIKE '%" . $search . "%'";
		$db->order = "created_time DESC";
		$db->limit = $start . ',' . $per_page;
		$rows = $db->select();
		$i = 0;
		echo '<div class="l-news clearfix">';
		foreach($rows as $row) {
			$photo_avt = '';
			$alt = ($row['img_note']!="") ? stripslashes($row['img_note']) : stripslashes($row['name']);
			if($row['img']!="" && $row['img']!="no") {
			$photo_avt = '<img src="'. HOME_URL .'/uploads/article/'. $row['img'] . '" alt="' . $alt . '" />';
			$photo_avt = '<a href="'. HOME_URL_LANG . '/' . $slug_cat74 . '/' . getSlugMenu($row['article_menu_id'], 'article') . '/' . $stringObj->getLinkHtml($row['name'], $row['article_id']) . '" title="' . stripslashes($row['name']) . '">' . $photo_avt . '</a>';
			} else {
			$photo_avt = '<img src="'. HOME_URL .'/images/404-product.jpg" alt="'.$alt.'" />';
			$photo_avt = '<a href="'. HOME_URL_LANG . '/' . $slug_cat74 . '/' . getSlugMenu($row['article_menu_id'], 'article') . '/' . $stringObj->getLinkHtml($row['name'], $row['article_id']) . '" title="' . stripslashes($row['name']) . '">' . $photo_avt . '</a>';
			}
			
			/*$sale = $price = '';
			if($row['hot']>0) $sale = '<div class="_hot">&nbsp;</div>';
			if($row['sale']>0) $sale = '<div class="_sale">&nbsp;</div>';
			if($row['price']>0) $price = $lgTxt_price . ' <span class="price">' . formatNumberVN($row['price']) . $lgTxt_price_unit . '</span>';
			else $price = $lgTxt_price . ' <span class="price">' . $lgTxt_price_contact . '</span>';*/
			?>
<div class="news clearfix">
    <img  src="<?php HOME_URL ?>/images/demo.png"/>
    <div class="time-l">
    	<p class="time-tab-r"><i style="margin-right:5px;    vertical-align: baseline;" class="fa fa-calendar" aria-hidden="true"></i> 23/1/2016  <span style="margin:0px 5px"></span> <span class="views"><i class="fa fa-eye" aria-hidden="true"></i> 5</span></p>
    </div>
    <div class="info-news">
        <h6><a href="<?php echo HOME_URL_LANG . '/' . $slug_cat . '/' . getSlugMenu($row['article_menu_id'], 'article') . '/' .  $stringObj->getLinkHtml($row['name'], $row['article_id'])?>"><?php echo $row['name']; ?></a></h6>
       
        <p style="color:#8e8e8e"><?php echo $stringObj->crop(stripslashes($row['comment']), 30)?></p>
    </div>
</div>	
		<?php
		}
		echo showPageNavigation($page, $total_pages, '/' . 'tim-kiem?btsearch=OK' . $slug_search . '&p=');
		echo'</div> </div> ';

	}else echo '<div class="box-search">
                <h3>Không tìm thấy kết quả phù hợp!</h4>
            </div> </div> </div>';

}
	


?>
 
  <?php include(_F_INCLUDES . DS . "tth_right.php"); ?>
  </div>
<?php include(_F_INCLUDES . DS . "tth_slider.php"); ?>
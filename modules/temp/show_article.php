<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//

$sumView = 0;
$db->table = "article";
$db->condition = "is_active = 1 and article_id = ".$id;
$db->order = "";
$db->limit = "";
$rows = $db->select();
if($db->RowCount>0){
	foreach($rows as $row) {
		$db->table = "article";
		$db->condition = "is_active = 1 and article_menu_id = ".($row['article_menu_id']+0).' and article_id <> '.$id;
		$db->order = "created_time DESC";
		$db->limit = 10;
		$rows2 = $db->select();
		$total = $db->RowCount;
		$price = $row['img_note']  === '' ? 'Liên hệ' : $row["img_note"].' VNĐ';
?>
<div class="wrap-detail clearfix">
	<?php if($slug_cat=='news-event' || $slug_cat=='tin-tuc-su-kien' || $slug_cat=='cam-nang-du-lich') echo '<p class="time-d"><i class="fa fa-calendar"></i> &nbsp;' . $date->vnFull($row['created_time']) . '</p>';?>
	<h3 style="text-transform:uppercase;" class="title-detail"><?php echo stripslashes($row['name']);?></h3>
	<p class="txt_price"><span>Giá trị hợp đồng</span> : <?php echo $price; ?></p>
	<?php echo '<h4 style="font-weight:bold;" class="f-space10">' . stripslashes($row['comment']) . '</h4>';?>

	<div class="con-wp f-space15"><?php echo stripslashes($row['content']); ?></div>
	<div class="others">
		<?php
		//----------------------------------------------------------
		if($total>0) {
			echo '<ul class="list-other">';
			foreach($rows2 as $row2) {
				include(_F_TEMPLATES . DS . "show_other_article.php");
			}
			echo '</ul>';
		} ?>
	</div>
	<?php if($slug_cat != 'gioi-thieu') { ?>
		<div class="fb-comments" data-href="<?php echo site_url()?>" data-width="100%" data-numposts="5"></div>
	<?php  } ?>
</div>

<?php
		$sumView = $row['views']+1;
	}
	$db->table = "article";
	$data = array(
		'views'=>$sumView
	);
	$db->condition = "article_id = ".$id;
	$db->update($data);

}
else include(_F_MODULES . DS . "error_404.php");
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
?>
<div class="wrap-detail clearfix">
	<?php if($slug_cat=='news-event' || $slug_cat=='tin-tuc-su-kien' || $slug_cat=='cam-nang-du-lich') echo '<p class="time-d"><i class="fa fa-calendar"></i> &nbsp;' . $date->vnFull($row['created_time']) . '</p>';?>
	<h3 style="text-transform:uppercase;" class="title-detail"><?php echo stripslashes($row['name']);?></h3>
    
	<?php echo '<h4 style="font-weight:bold;" class="f-space10">' . stripslashes($row['comment']) . '</h4>';?>
	<div class="con-wp f-space15"><?php echo stripslashes($row['content']); ?></div>
	<?php
	$list_img = "";
	$db->table = "uploads_tmp";
	$db->condition = "upload_id = ".($row['upload_id']+0);
	$db->order = "";
	$rows_pr = $db->select();
	foreach ($rows_pr as $row_pr){
		$list_img = $row_pr['list_img'];
	}
	$img = explode(";",$list_img);
	//-----------------------------------
	if($list_img!="") {
		?>
	<div class="box-gallery">
		<div id="_gallery" style="position: relative; top: 0; left: 0; width: 810px; height: 601px; overflow: hidden;">
			<!-- Loading Screen -->
			<div u="loading" style="position: absolute; top: 0; left: 0;">
				<div style="filter: alpha(opacity=70); opacity:0.7; position: absolute; display: block; top: 0; left: 0; width: 100%; height:100%;">
				</div>
				<div style="position: absolute; display: block; background: url(<?php echo HOME_URL;?>/images/loading.gif) no-repeat center center; top: 0; left: 0; width: 100%; height:100%;">
				</div>
			</div>
			<!-- Slides Container -->
			<div u="slides" style="cursor: move; position: absolute; left: 0; top: 0; width: 810px; height: 481px; overflow: hidden;">
				<?php
				for ($i = 0; $i < count($img); $i++) {
					if ($img[$i] != "") {
						?>
						<div>
							<img u="image" src="<?php echo HOME_URL;?>/uploads/photos/<?= $img[$i] ?>" />
							<img u="thumb" src="<?php echo HOME_URL;?>/uploads/photos/thm_<?= $img[$i] ?>" />
						</div>
						<?
					}
				}
				?>
			</div>
			<!-- Arrow Left -->
			<span u="arrowleft" class="jssora05l" style="width: 29px; height: 44px; bottom: 38px; left: 10px;"></span>
			<!-- Arrow Right -->
			<span u="arrowright" class="jssora05r" style="width: 29px; height: 44px; bottom: 38px; right: 10px;"></span>
			<!-- Arrow Navigator Skin End -->
			<!-- Thumbnail Navigator Skin Begin -->
			<div u="thumbnavigator" class="jssort01" style="position: absolute; width: 708px; height: 120px; bottom: 0;">
				<!-- Thumbnail Item Skin Begin -->
				<div u="slides" style="cursor: move;">
					<div u="prototype" class="p" style="position: absolute; width: 135px; height: 80px; top: 0; left: 0;">
						<div class=w><thumbnailtemplate style=" width: 100%; height: 100%; border: none; position:absolute; top: 0; left: 0;"></thumbnailtemplate></div>
						<div class=c>
						</div>
					</div>
				</div>
				<!-- Thumbnail Item Skin End -->
			</div>
			<!-- Thumbnail Navigator Skin End -->
		</div>
		<script type="text/javascript">
			jssor_slider_gallery('_gallery');
		</script>
	</div>
	<?php } ?>
	 <div style="clear:both"></div>
<!-- Go to www.addthis.com/dashboard to customize your tools --> <div class="addthis_inline_share_toolbox_ow13"></div>
			<div style="clear:both"></div>
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
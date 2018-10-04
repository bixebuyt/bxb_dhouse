<?php
	if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
	//-------------
	$date = new DateClass();
	$stringObj = new String();
?>
<div class="home clearfix">
	<div class="content">
  		<div class="con_slider">
		<?php
		$db->table = "gallery";
		$db->condition = "is_active = 1 and gallery_menu_id IN (SELECT `gallery_menu_id` FROM `".TTH_DATA_PREFIX."gallery_menu` WHERE `category_id` = 56)";
		$db->order = "created_time DESC";
		$db->limit = "";
		$rows = $db->select();
		foreach ($rows as $row){
			echo '<div class="box_slider">';
			$imgShow = '<a target="_blank" href="'.$row['link'].'" title="'.stripslashes($row['name']).'"><img src="'.HOME_URL.'/uploads/gallery/slider-'.$row['img'].'" alt="'.stripslashes($row['name']).'" /><h3>'.$row['name'].'</h3></a>';
			echo $imgShow;
			echo '</div>';
		}
		?>
		</div>
    </div>
<div class="menu_bottom">
	<div class="cont clearfix">
		<ul>
			<?php
				$db->table = "category";
				$db->condition = "`is_active` = 1 AND `type_id` = 1 AND `hot` = 1";
				$db->order = "`sort` ASC";
				$db->limit = 4;
				$rows_mn = $db->select();
				foreach($rows_mn as $row_mn) {
			?>
			<li><a href="<?php echo HOME_URL_LANG . '/' . $row_mn['slug'] ?>"><?php echo $row_mn['name'] ?></a></li>
			<?php
				}
			?>
		</ul>
	</div>
</div>

</div>
<div class="content con_news_home view_sp">
	<h2><?php echo $txt_Special; ?></h2>
	<div class="l-news clearfix">
		<?php
			$db->table = "category";
			$db->condition = "is_active = 1 AND `type_id` = 1";
			$db->order = "";
			$db->limit = "";
			$rows_cate = $db->select();
			foreach ($rows_cate as $row_cate){
		?>
		<?php
			$db->table = "article_menu";
			$db->condition = "is_active = 1 and category_id = ".$row_cate["category_id"]."";
			$db->order = "created_time DESC";
			$db->limit = "12";
			$rows_mn = $db->select();
			foreach ($rows_mn as $row_mn){
		?>
		<?php
			$db->table = "article";
			$db->condition = "is_active = 1 AND article_menu_id = ".$row_mn["article_menu_id"]."";
			$db->order = "created_time DESC";
			$db->limit = "";
			$rows = $db->select();
			foreach ($rows as $row){
			$price = $row['img_note']  === '' ? 'Liên hệ' : $row["img_note"].' VNĐ';
			$photo_avt = '';
			$alt = ($row['img_note']!="") ? stripslashes($row['img_note']) : stripslashes($row['name']);
			if($row['img']!="" && $row['img']!="no") {
				$photo_avt = '<img src="'. HOME_URL .'/uploads/article/news-'. $row['img'] . '" alt="' . $alt . '" />';
				$photo_avt = '<a href="'. HOME_URL_LANG . '/' . $row_cate['slug'] . '/' . getSlugMenu($row['article_menu_id'], 'article') . '/' . $stringObj->getLinkHtml($row['name'], $row['article_id']) . '" title="' . stripslashes($row['name']) . '">' . $photo_avt . '</a>';
			} else {
				$photo_avt = '<img src="'. HOME_URL .'/images/no_img.png" alt="'.$alt.'" />';
				$photo_avt = '<a href="'. HOME_URL_LANG . '/' . $row_cate['slug'] . '/' . getSlugMenu($row['article_menu_id'], 'article') . '/' . $stringObj->getLinkHtml($row['name'], $row['article_id']) . '" title="' . stripslashes($row['name']) . '">' . $photo_avt . '</a>';
			}
		?>
		<div class="news clearfix">
		    <?php echo $photo_avt; ?>
		    <div class="info-news">
		        <h3><a href="<?php echo HOME_URL_LANG . '/' . $slug_cat . '/' . getSlugMenu($row['article_menu_id'], 'article') . '/' .  $stringObj->getLinkHtml($row['name'], $row['article_id'])?>"><?php echo $row['name']; ?></a>
		        </h3>
		        <p class="txt_price"><?php echo $lgTxt_price; ?>: <?php echo $price; ?></p>
		        <div class="box_archive">
		            <p><a href="<?php echo HOME_URL_LANG . '/' . $slug_cat?>"><?php echo $row_cate['name'] ?></a>, <a href="<?php echo HOME_URL_LANG . '/' . $slug_cat .'/'. getSlugMenu($row['article_menu_id'], 'article')?>"><?php echo getNameMenu(stripslashes($row['article_menu_id']), 'article'); ?></a></p>
		            <a class="link" href="<?php echo HOME_URL_LANG . '/' . $slug_cat . '/' . getSlugMenu($row['article_menu_id'], 'article') . '/' .  $stringObj->getLinkHtml($row['name'], $row['article_id'])?>"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
		        </div>
		    </div>
		</div>
		<?php
			}}}
		?>
	</div>
</div> 





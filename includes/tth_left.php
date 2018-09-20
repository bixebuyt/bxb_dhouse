<?php
	if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
?>
        
<div class="box_left">
	<h3><i class="fa fa-align-left" aria-hidden="true"></i><a href="<?php echo HOME_URL_LANG; ?>">D HOUSE</a></h3>
	<div class="box_menu_category">
		<ul>
			<?php
				$db->table = "category";
				$db->condition = "`is_active` = 1 AND `menu_main` = 1";
				$db->order = "`sort` DESC";
				$db->limit = "";
				$rows_mn = $db->select();
				foreach($rows_mn as $row_mn) {
			?>
				<li><a <?php if ($slug_cat === $row_mn['slug']) echo 'class="active"' ?> href="<?php echo HOME_URL_LANG?>/<?php echo $row_mn['slug']; ?>"><?php echo $row_mn['name'] ?></a></li>
			<?php
				}
			?>
		</ul>
	</div>
	<div class="box_menu_article">
		<ul>
			<?php
				$db->table = "category";
				$db->condition = "`is_active` = 1 and `slug` = '".$slug_cat."'";
				$db->order = "`sort_hide` ASC";
				$db->limit = "";
				$rows_mn = $db->select();
				foreach($rows_mn as $row_mn){
			?>
				<?php
					$db->table = "article_menu";
					$db->condition = "`is_active` = 1 AND `category_id` = ".$row_mn['category_id']."";
					$db->order = "created_time ASC";
					$db->limit = 10;
					$rows = $db->select();
					foreach($rows as $row) {
				?>			
					<li><a <?php if($slug_cat==$row_mn['slug'] && $id_menu==$row['article_menu_id']) echo 'class="active"'; ?> href="<?php echo HOME_URL_LANG . '/' . $row_mn['slug'] . '/' .  $row['slug']; ?>" ><?php echo $row['name'] ?></a></li>
				<?php
					}
				?>
			<?php 
				}
			?>
		</ul>
	</div>
	<div class="copyright view_pc-tab">
		<div class="socical">
			<ul>
				<li class="fb"><a target="_blank" href="<?php echo getConstant('link_facebook');?>"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
				<li class="insta"><a target="_blank" href="<?php echo getConstant('link_googleplus');?>"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
				<li class="twitter"><a target="_blank" href="<?php echo getConstant('link_twitter');?>"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
			</ul>
		</div>
		<?php echo getPage('copyright');?>
	</div>
</div>
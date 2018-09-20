<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//-------------
?>
<div class="con_top_sp view_sp">
	<a id="hamburger"><span class="breadcrumb"></span></a>
	<div class="box_lang">
		<ul>
			<li><a href="<?php echo HOME_URL;?>"><img src="images/ic_vn.png" alt="Viet Nam" /></a></li>
			<li><a href="<?php echo HOME_URL . '/en/';?>"><img src="images/ic_en.png" alt="English" /></a></li>
		</ul>
	</div>
	<div class="menu_sp">
		<div class="cont clearfix">
			<div class="menu clearfix">
				<div class="cont-menu">
					<nav class="navigation" role="navigation">
						<ul>
						    <?php
						        $db->table = "category";
						        $db->condition = "`is_active` = 1 and `menu_main` = 1";
						        $db->order = "`sort_hide` ASC";
						        $db->limit = "";
						        $rows = $db->select();
						        foreach($rows as $row){
						    ?>
						        <li <?php if($slug_cat==$row['slug']) echo 'class="active"'; ?> ><i class="fa fa-angle-double-right" aria-hidden="true"></i>
						            <a href="<?php echo HOME_URL_LANG?>/<?php echo $row['slug']; ?>" title="<?php echo stripslashes($row['name']); ?>">
						                <span><?php echo stripslashes($row['name']); ?></span>
						            </a> 
						        </li>
						    <?php
						        } 
						    ?>
						        <li <?php if($slug_cat=='lien-he') echo 'class="active"'; ?>><i class="fa fa-angle-double-right" aria-hidden="true"></i>
						            <a href="<?php echo HOME_URL_LANG . '/' . $lgTxt_slug_contact; ?>" title="<?php echo $lgTxt_menu_contact; ?>" >
						                <span><?php echo $lgTxt_menu_contact; ?></span>
						            </a>
						        </li>
						 </ul>
					</nav>
				</div>
		    </div>
		</div>
	</div>
</div>
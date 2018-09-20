<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//-------------
?>
<!-- menu -->
<div class="menu view_pc-tab clearfix">
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
			        <li <?php if($slug_cat==$row['slug']) echo 'class="active"'; ?> >
			            <a href="<?php echo HOME_URL_LANG?>/<?php echo $row['slug']; ?>" title="<?php echo stripslashes($row['name']); ?>">
			                <span><?php echo stripslashes($row['name']); ?></span>
			            </a> 
			        </li>
			    <?php
			        } 
			    ?>
			        <li <?php if($slug_cat=='lien-he') echo 'class="active"'; ?>>
			            <a href="<?php echo HOME_URL_LANG . '/' . $lgTxt_slug_contact; ?>" title="<?php echo $lgTxt_menu_contact; ?>" >
			                <span><?php echo $lgTxt_menu_contact; ?></span>
			            </a>
			        </li>
			 </ul>
		</nav>
		<div class="box_social">
			<ul class="clearfix">
				<li class="fb"><a target="_blank" href="<?php echo getConstant('link_facebook');?>"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
				<li class="insta"><a target="_blank" href="<?php echo getConstant('link_googleplus');?>"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
				<li class="twitter"><a target="_blank" href="<?php echo getConstant('link_twitter');?>"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
			</ul>
		</div>
		<div class="box_lang">
			<ul>
				<li><a href="<?php echo HOME_URL;?>"><img src="images/ic_vn.png" alt="Viet Nam" /></a></li>
				<li><a href="<?php echo HOME_URL . '/en/';?>"><img src="images/ic_en.png" alt="English" /></a></li>
			</ul>
		</div>
    </div>
</div>

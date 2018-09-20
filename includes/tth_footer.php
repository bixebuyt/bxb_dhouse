<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//-------------
?>

<div class="footer clearfix">
    <div class="cont clearfix">
    <div class="copyright view_sp">
        <div class="socical">
            <ul>
                <li class="fb"><a target="_blank" href="<?php echo getConstant('link_facebook');?>"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                <li class="insta"><a target="_blank" href="<?php echo getConstant('link_googleplus');?>"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                <li class="twitter"><a target="_blank" href="<?php echo getConstant('link_twitter');?>"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
            </ul>
        </div>
        <?php echo getPage('copyright');?>
    </div>
    <ul class="menu_bottom">
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
    </div>
</div>
<!-- / .footer -->

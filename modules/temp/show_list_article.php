<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }

$photo_avt = '';
$alt = ($row['img_note']!="") ? stripslashes($row['img_note']) : stripslashes($row['name']);
if($row['img']!="" && $row['img']!="no") {
	$photo_avt = '<img src="'. HOME_URL .'/uploads/article/news-'. $row['img'] . '" alt="' . $alt . '" />';
	$photo_avt = '<a href="'. HOME_URL_LANG . '/' . $slug_cat . '/' . getSlugMenu($row['article_menu_id'], 'article') . '/' . $stringObj->getLinkHtml($row['name'], $row['article_id']) . '" title="' . stripslashes($row['name']) . '">' . $photo_avt .'</a>';
} else {
	$photo_avt = '<img src="'. HOME_URL .'/images/404-post.jpg" alt="'.$alt.'" />';
	$photo_avt = '<a href="'. HOME_URL_LANG . '/' . $slug_cat . '/' . getSlugMenu($row['article_menu_id'], 'article') . '/' . $stringObj->getLinkHtml($row['name'], $row['article_id']) . '" title="' . stripslashes($row['name']) . '">' . $photo_avt .'</a>';
}
?>
<div class="news clearfix">
    <?php echo $photo_avt; ?>
    <div class="info-news">
        <h3><a href="<?php echo HOME_URL_LANG . '/' . $slug_cat . '/' . getSlugMenu($row['article_menu_id'], 'article') . '/' .  $stringObj->getLinkHtml($row['name'], $row['article_id'])?>"><?php echo $row['name']; ?></a>
        </h3>
        <div class="box_archive">
            <p><a href="<?php echo HOME_URL_LANG . '/' . $slug_cat?>"><?php echo getTitleCategory($slug_cat);?></a>, <a href="<?php echo HOME_URL_LANG . '/' . $slug_cat .'/'. getSlugMenu($row['article_menu_id'], 'article')?>"><?php echo getNameMenu(stripslashes($row['article_menu_id']), 'article'); ?></a></p>
            <a class="link" href="<?php echo HOME_URL_LANG . '/' . $slug_cat . '/' . getSlugMenu($row['article_menu_id'], 'article') . '/' .  $stringObj->getLinkHtml($row['name'], $row['article_id'])?>"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
        </div>
    </div>
</div>
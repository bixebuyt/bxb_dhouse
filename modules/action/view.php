
<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//

$date = new DateClass();
$stringObj = new String();

$sumView = 0;
$db->table = "article";
$db->condition = "is_active = 1 and article_id = ".$id;
$db->order = "";
$db->limit = "";
$rows = $db->select();
if($db->RowCount>0){
	foreach($rows as $row) {
	$photo_avt = '';
		$alt = ($row['img_note']!="") ? stripslashes($row['img_note']) : stripslashes($row['name']);
		if($row['img']!="" && $row['img']!="no") {
			$photo_avt = '<img  u="image" src="'. HOME_URL .'/uploads/article/'. $row['img'] . '" alt="' . $alt . '" />';
		} else {
			$photo_avt = '<img src="'. HOME_URL .'/images/404.png" alt="'.$alt.'" />';
		}
?>
	 <div  class="animated fadeInDown" id="ex1">
		<h2><?php echo $row['name']; ?></h2>
			<div style="clear:both"></div>
			<p><?php echo $row['comment']; ?></p>
		<div id="content-popup">		
			<p><?php echo stripslashes($row['content']); ?></p>
			
		<script type="text/javascript">
			$(function(){
				$('#content-popup').slimScroll({
					height: '326px'
				});
			});
		</script>
		</div>
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
?>


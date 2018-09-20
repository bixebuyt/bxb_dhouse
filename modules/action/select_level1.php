
<?php

if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//-------------

$date = new DateClass();
$stringObj = new String();

$slug_cat73 = getSlugCategory(73);
$slug_cat7 = getSlugCategory(7);
$slug_cat55 = getSlugCategory(55);
?>

<?php
	 if(isset($_POST['id'])) {
     $id = $_POST['id'] + 0;
	 $db->table = "article";
	 $db->condition = "`article_id` = $id";
	 $db->order = "`modified_time` ASC";
	 $db->limit = "";
	 $rows = $db->select();
	 foreach($rows as $row) {	 
?>
	<div class="dt-comm">
		<h3 style="color:#00b03b"><?php  echo $row['name']; ?></h3>
		<p style="margin-bottom:20px; font-style:italic"><?php echo $row['comment']; ?></p>
		<p><?php echo $row['content']; ?></p>
	</div>
<?php
	 }}
?>

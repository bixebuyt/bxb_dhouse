<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//
?>

<!-- Menu path -->
<div class="row">
	<ol class="breadcrumb">
		<li>
			<a href="<?=ADMIN_DIR?>"><i class="fa fa-home"></i> Trang chủ</a>
		</li>
		<li>
			<a href="?<?=TTH_PATH?>=road_manager"><i class="fa fa-edit"></i> Quản lý nội dung</a>
		</li>
		<li>
			<a href="?<?=TTH_PATH?>=road_manager"><i class="fa fa-road"></i> Chiều rộng đường</a>
		</li>
		<li>
			<i class="fa fa-plus-square-o"></i> Thêm mục
		</li>
	</ol>
</div>
<!-- /.row -->
<?php
include_once (_A_TEMPLATES . DS . "road.php");
if(empty($typeFunc)) $typeFunc = "no";

$OK = false;
$error = '';
if($typeFunc=='add'){
	if(empty($name)) $error = '<span class="show-error">Vui lòng nhập tên mục.</span>';
	else {
		$stringObj = new String();

		$slug = (empty($slug)) ? $name : $slug;
		$slug = $stringObj->getSlug($slug);

		$db->table = "road";
		$data = array(
			'name'=>$db->clearText($name),
			'sort'=>sortAcs()+1,
			'is_active'=>$is_active+0,
			'hot'=>$hot+0,
			'created_time'=>time(),
			'modified_time'=>time(),
			'user_id'=>$_SESSION["user_id"]
		);
		$db->insert($data);

		loadPageSucces("Đã thêm Mục thành công.","?".TTH_PATH."=road_manager");
		$OK = true;
	}
}
else {
	$name			= "";
	$is_active		= 1;
	$hot			= 0;
}
if(!$OK) road("?".TTH_PATH."=road_add", "add", 0, $name, $is_active, $hot, $error);
?>

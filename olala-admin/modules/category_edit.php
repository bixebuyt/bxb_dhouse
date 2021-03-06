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
			<i class="fa fa-edit"></i> Quản lý nội dung
		</li>
		<li>
			<i class="fa fa-cog"></i> Chỉnh sửa thể loại
		</li>
	</ol>
</div>
<!-- /.row -->
<?php
include_once (_A_TEMPLATES . DS . "category.php");
if(empty($typeFunc)) $typeFunc = "no";
$category_id =  isset($_GET['id_cat']) ? $_GET['id_cat']+0 : $category_id+0;
$db->table = "category";
$db->condition = "category_id = ".$category_id;
$rows = $db->select();
if($db->RowCount==0) loadPageAdmin("Thể loại không tồn tại.", ADMIN_DIR);

$OK = false;
$error = '';
if($typeFunc=='edit'){
	if(empty($name)) $error = '<span class="show-error">Vui lòng nhập tên chuyên mục.</span>';
	else {
		$handleUploadImg = false;
		$file_max_size = FILE_MAX_SIZE;
		$dir_dest = ROOT_DIR . DS . 'uploads' . DS . 'category' . DS ;
		$file_size = $_FILES['img']['size'];

		if($file_size>0) {
			$imgUp = new Upload($_FILES['img']);

			$imgUp->file_max_size = $file_max_size;
			if ($imgUp->uploaded) {
				$handleUploadImg = true;
				$OK = true;
			}
			else {
				$error = '<span class="show-error">Lỗi tải hình: '.$imgUp->error.'</span>';
			}
		}
		else {
			$handleUploadImg = false;
			$OK = true;
		}

		if($OK) {
			$id_query = 0;
			$db->table = "category";
			$data = array(
				'name'=>$db->clearText($name),
				'slug'=>$db->clearText($slug),
				'plus'=>$db->clearText($txt_plus),
				'title'=>$db->clearText($title),
				'description'=>$db->clearText($description),
				'keywords'=>$db->clearText($keywords),
				'icon'=>$db->clearText($font_icon),
				'comment'=>$db->clearText($comment),
				'menu_main'=>$menu_main+0,
				'is_active'=>$is_active+0,
				'hot'=>$hot+0,
				'modified_time'=>time(),
				'user_id'=>$_SESSION["user_id"]
			);
			$db->condition = "category_id = ".$category_id;
			$db->update($data);
			$id_query = $category_id;

			if($handleUploadImg) {
				$stringObj = new String();

				if(!empty($img)) array_map("unlink", glob($dir_dest.'*'.$img));

				$name_image = getRandomString().'-'.$id_query.'-'.substr($stringObj->getSlug($name),0,120);

				$imgUp->file_new_name_body    = $name_image;
				$imgUp->image_resize          = true;
				$imgUp->image_ratio_y         = true;
				$imgUp->image_x               = 760;
				$imgUp->Process($dir_dest);
				if($imgUp->processed) {
					$name_img = $imgUp->file_dst_name;
					$db->table = "category";
					$data = array(
						'img'=>$db->clearText($name_img)
					);
					$db->condition = "category_id = ".$id_query;
					$db->update($data);
				}
				else {
					loadPageAdmin("Lỗi tải hình: ".$imgUp->error, "?".TTH_PATH."=".getSlugCat($type_id));
				}

				$imgUp->file_new_name_body    = 'pj-' . $name_image;
				$imgUp->image_resize          = true;
				$imgUp->image_ratio_crop      = 'T';
				$imgUp->image_y               = 326;
				$imgUp->image_x               = 490;
				$imgUp->Process($dir_dest);

				$imgUp->file_new_name_body    = 'pr-menu-' . $name_image;
				$imgUp->image_resize          = true;
				$imgUp->image_ratio_crop      = true;
				$imgUp->image_y               = 315;
				$imgUp->image_x               = 318;
				$imgUp->Process($dir_dest);

				$imgUp->file_new_name_body    = 'menu-' . $name_image;
				$imgUp->image_resize          = true;
				$imgUp->image_ratio_crop      = true;
				$imgUp->image_y               = 334;
				$imgUp->image_x               = 517;
				$imgUp->Process($dir_dest);
				
				$imgUp->file_new_name_body    = 'sn-menu-' . $name_image;
				$imgUp->image_resize          = true;
				$imgUp->image_ratio_crop      = true;
				$imgUp->image_y               = 170;
				$imgUp->image_x               = 517;
				$imgUp->Process($dir_dest);
				
				$imgUp-> Clean();
			}

			loadPageSucces("Đã chỉnh sửa Thể loại thành công.", "?".TTH_PATH."=".getSlugCat($type_id));
			$OK = true;
		}
	}
}
else {
	$db->table = "category";
	$db->condition = "category_id = ".$category_id;
	$rows = $db->select();
	foreach($rows as $row) {
		$name			= $row['name'];
		$slug           = $row['slug'];
		$txt_plus		= $row['plus'];
		$title			= $row['title'];
		$description	= $row['description'];
		$keywords		= $row['keywords'];
		$comment        = $row['comment'];
		$is_active		= $row['is_active']+0;
		$hot			= $row['hot']+0;
		$img            = $row['img'];
		$menu_main      = $row['menu_main']+0;
		$type_id		= $row['type_id'];
		$font_icon			= $row['icon'];
	}
}
if(!$OK) articleCat("?".TTH_PATH."=category_edit", "edit", $category_id, $name, $slug, $txt_plus, $title, $description, $keywords, $comment, $is_active, $hot, $img, $menu_main, $type_id, $font_icon, $error);
?>

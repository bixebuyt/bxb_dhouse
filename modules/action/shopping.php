<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//

$sumView = 0;
$db->table = "product";
$db->condition = "is_active = 1 and product_id = ".$id;
$db->order = "";
$db->limit = "";
$rows = $db->select();
if($db->RowCount>0){
	foreach($rows as $row) {
		$sale = '';
		$db->table = "product";
		$db->condition = "is_active = 1 and product_menu_id = ".($row['product_menu_id']+0).' and product_id <> '.$id;
		$db->order = "created_time DESC";
		$db->limit = 9;
		$rows2 = $db->select();
		$total = $db->RowCount;

		if($row['sale']==0){
			 $sale= 'none';
			 $price_show = 'block';
		}else{
			 $sale= 'block';
			 $price_show = 'none';
		}
		
		$photo_avt = '';
		$alt = ($row['img_note']!="") ? stripslashes($row['img_note']) : stripslashes($row['name']);
		if($row['img']!="" && $row['img']!="no") {
			$photo_avt = '<img u="image" src="'. HOME_URL .'/uploads/product/full_'. $row['img'] . '" alt="' . $alt . '" />';
		} else {
			$photo_avt = '<img src="'. HOME_URL .'/images/not-found.jpg" alt="'.$alt.'" />';
		}
		
		//$sale = $price = '';
		//if($row['sale']>0) $sale = '<span class="_sale_">-' . $row['sale']  . '%</span>';
		//if($row['price']>0) $price = '<div class="price-tb-bx"><p class="price-tb-dea">' . $sale . '<span class="price-sw">' . formatNumberVN($row['price']) . '<sup>' . //$lgTxt_price_unitTour . '</sup></span></p></div>';
		//else $price = '<div class="price-tb-bx"><p class="price-tb-dea"><span class="price-sw">' . $lgTxt_price . '<sup>' . $lgTxt_price_contact . '</sup></span></p></div>';
?>
<div class="send_product animated fadeInDown" style="padding:0px;">
    <form style="width:100%" id="_frm_order" action="" name="frm_order" class="frm modal" method="post" onsubmit="return sendMail('send_order', '_frm_order');">
		
		<input type="hidden" name="lang_field" value="<?php echo $txtEnter_field;?>"/>
		<input type="hidden" name="lang_email" value="<?php echo $txtEnter_email;?>"/>
		<input type="hidden" name="lang_phone" value="<?php echo $txtEnter_tell;?>"/>
		<div class="prod-order">
			<div><?php echo $photo_avt; ?></div>
			<div class="form-con" style="padding-left:1%">
					<h5><?php echo $row['name']; ?> </h5>
					<p  class="" style="color:#A80006;margin:5px 0px;display:<?php echo $price_show; ?>"><?php echo stripslashes(formatNumberVN($row['price'])); ?> VND</p>
					<p  class="" style="color:#A80006;margin:5px 0px;display:<?php echo $sale; ?>"><?php echo stripslashes(formatNumberVN($row['sale'])); ?> VND</p>
					<div style="text-align:left; margin-top: auto;" class="bh"><p>Bảo hành: <span class="sp1"><?php echo $row['model']; ?></span></p> </div>
					
				<div class="contact-prod form-info">
					<?php echo $row['comment']; ?>
				</div>
			</div>
		</div>
		
		<div class="f-space05 form-order clearfix">
			<input type="hidden" name="id" value="<?php echo $row['product_id'];?>">
          
			<div class="title-order">
				<h2>THÔNG TIN ĐẶT HÀNG</h2>
			</div>
            <div class="form-item form-sm">
                <input type="text" name="full_name" placeholder="Họ và tên:" value="" maxlength="250" >
                <i class="fa fa-user"></i>
            </div>
            <div class="form-item form-sm">
                <input type="text" name="address" placeholder="Địa chỉ:" value="" maxlength="250">
                <i class="fa fa-map-marker"></i>
            </div>
			<div class="form-item form-sm">
                <input type="text" name="email" placeholder="Email:" value="" maxlength="250">
                <i class="fa fa-envelope"></i>
            </div>
            <div class="form-item form-sm">
                <input type="text" name="tell" placeholder="Số điện thoại:" value="" maxlength="20">
                <i class="fa fa-phone fa-lg"></i>
            </div>
            <div class="form-item form-sm">
                <input type="text" class="auto-number" name="number_product" placeholder="Số Lượng:" value="" maxlength="3" >
                <i class="fa fa-money fa-lg"></i>
            </div>
			<div style="width:100%" class="form-item form-sm">
				<textarea name="content" placeholder="Ghi chú:" cols="60" rows="5"></textarea>
				<i class="fa fa-pencil"></i>
			</div>
            <div class="clearfix"></div>
			
			<div class="form-bg ">
            <div class="form-item form-bt clearfix">
                <input type="submit" id="send_order" name="send_order" value="">
               
              
            </div>
        </div>
			
        </div>
		
        
    </form>
 
</div>
<?php
		$sumView = $row['views']+1;
	}
	$db->table = "product";
	$data = array(
		'views'=>$sumView
	);
	$db->condition = "product_id = ".$id;
	$db->update($data);

}
else include(_F_MODULES . DS . "error_404.php");
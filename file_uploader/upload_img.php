<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
?>

<script type="text/javascript" src="/file_uploader/js/ajaxupload.3.5.js" ></script>
<link rel="stylesheet" type="text/css" href="/file_uploader/styles.css" />
<script type="text/javascript" >
	$(function(){
		var btnUpload=$('#upload');
		var status=$('#status');
		new AjaxUpload(btnUpload, {
			action: '/file_uploader/upload-file.php?id=<?=$upload_img_id?>',
			name: 'uploadfile',
			onSubmit: function(file, ext){
				 if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){ 
                    // extension is not allowed 
					status.text('Chỉ JPG, PNG hoặc GIF là các tập tin được cho phép.');
					return false;
				}
				$("#status").html('<div id="fadingBarsG"> <div id="fadingBarsG_1" class="fadingBarsG"> </div> <div id="fadingBarsG_2" class="fadingBarsG"> </div> <div id="fadingBarsG_3" class="fadingBarsG"> </div> <div id="fadingBarsG_4" class="fadingBarsG"> </div> <div id="fadingBarsG_5" class="fadingBarsG"> </div> <div id="fadingBarsG_6" class="fadingBarsG"> </div> <div id="fadingBarsG_7" class="fadingBarsG"> </div> <div id="fadingBarsG_8" class="fadingBarsG"> </div> </div>');
			},
			onComplete: function(file, response){
				//On completion clear the status
				status.text('');
				//Add uploaded file to list
				if(response.substring(0,2)==="OK"){
					loader_img_upload(<?=$upload_img_id?>);
				}
				else {
					alert(response);
				}
			}
		});
		
	});
</script>
<div id="mainbody" >
	<div id="upload" ><span>Tải hình lên</span></div>
	<div style="clear: both;"></div>
	<span id="status" ></span>
</div>
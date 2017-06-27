<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>admin</title>
	<link href="<?php echo THEME_PATH; ?>admin/css/index.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo THEME_PATH; ?>admin/css/table_form.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo THEME_PATH; ?>js/swfupload/swfupload.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript">var memberpath = "<?php echo MEMBER_PATH; ?>";</script>
	<script type="text/javascript" src="<?php echo THEME_PATH; ?>js/<?php echo SITE_LANGUAGE; ?>.js"></script>
	<script type="text/javascript" src="<?php echo THEME_PATH; ?>js/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo THEME_PATH; ?>js/jquery-ui.min.js"></script>
	<script type="text/javascript" src="<?php echo THEME_PATH; ?>js/jquery.artDialog.js?skin=default"></script>
	<script type="text/javascript" src="<?php echo THEME_PATH; ?>js/validate.js"></script>
	<script type="text/javascript" src="<?php echo THEME_PATH; ?>js/admin.js"></script>
	<script type="text/javascript" src="<?php echo THEME_PATH; ?>js/dayrui.js"></script>
	<script type="text/javascript" src="<?php echo THEME_PATH; ?>js/swfupload/swfupload.js"></script>
	<script type="text/javascript" src="<?php echo THEME_PATH; ?>js/swfupload/fileprogress.js"></script>
	<script type="text/javascript" src="<?php echo THEME_PATH; ?>js/swfupload/handlers.js"></script>
	<script type="text/javascript">
		var swfu = '';
		function SwapTab2(id) {
			$("#myform .tabBut").children("li").removeClass("on");
			$(".tabBut li:eq("+id+")").attr("class", "on");
			$("#myform .dr_hide").hide();
			$("#cnt_"+id).show();
			$("#myform #page").val(id);
			$("#is_down").attr('checked', false);
			if (id == 1) {
				$("#is_down").attr('checked', true);
			}
		}
		$(document).ready(function(){
			SwapTab2(<?php echo $page; ?>);
			swfu = new SWFUpload({
				flash_url:"<?php echo THEME_PATH; ?>js/swfupload/swfupload.swf?"+Math.random(),
				upload_url:"<?php if ($is_admin) { ?>/<?php echo SELF; ?>?c=api&m=swfupload<?php } else { ?>/index.php?s=member&c=api&m=swfupload<?php } ?>",
				file_post_name : "Filedata",
				post_params:{"session":"<?php echo $session; ?>", "code":"<?php echo $code; ?>", "fileid":"<?php echo $fileid; ?>", "siteid":"<?php echo $siteid; ?>", "path":"<?php echo urlencode($path); ?>"},
				file_size_limit:"<?php echo $size; ?>",
				file_types:"<?php echo $types; ?>",
				file_types_description:"All Files",
				file_upload_limit:"<?php echo $fcount; ?>",
				custom_settings : {progressTarget : "fsUploadProgress",cancelButtonId : "btnCancel"},

				button_image_url: "",
				button_width: 75,
				button_height: 28,
				button_placeholder_id: "buttonPlaceHolder",
				button_text_style: "",
				button_text_top_padding: 3,
				button_text_left_padding: 12,
				button_window_mode: SWFUpload.WINDOW_MODE.TRANSPARENT,
				button_cursor: SWFUpload.CURSOR.HAND,

				file_dialog_start_handler : fileDialogStart,
				file_queued_handler : fileQueued,
				file_queue_error_handler:fileQueueError,
				file_dialog_complete_handler:fileDialogComplete,
				upload_progress_handler:uploadProgress,
				upload_error_handler:uploadError,
				upload_success_handler:uploadSuccess,
				upload_complete_handler:uploadComplete
			});
		})
	</script>
	<?php if ($is_admin) { ?>
	<style>
		.icon{ background:none!important; }
	</style>
	<?php } ?>
</head>
<body style=";font-size: 12px;">
<div class="pad-10">
	<div class="table-list col-tab" id="myform">
		<ul class="tabBut cu-li">
			<li onclick="SwapTab2(0);" class="on"><?php echo fc_lang('上传文件'); ?></li>
			<?php if (!$is_admin) { ?>
			<li onclick="SwapTab2(1);"><?php echo fc_lang('手动输入'); ?></li>
			<?php if ($member['adminid']) { ?><li onclick="SwapTab2(2);set_iframe('myattach', '/index.php?s=member&c=api&m=myattach&ext=<?php echo $ext; ?>&fcount=<?php echo $fcount; ?>');"><?php echo fc_lang('网站附件'); ?></li><?php }  if ($notused) { ?><li onclick="SwapTab2(3);"><?php echo fc_lang('未使用的文件'); ?></li><?php }  } ?>
		</ul>
		<div class="content pad-10" style="clear:both">
			<div id="cnt_0" style="display:block" class="dr_hide">
				<div>
					<div class="addnew" id="addnew">
						<span id="buttonPlaceHolder"></span>
					</div>
					<input type="button" id="btupload" value="<?php echo fc_lang('开始上传'); ?>" onClick="swfu.startUpload();" />
					<div id="nameTip" class="onShow"><?php echo fc_lang('最多上传 <font color=red>%s</font> 个文件,单文件最大 <font color=red>%s</font> MB', $fcount, $size/1024); ?></div>
					<div class="bk3"></div>
					<div class="lh24"><?php echo fc_lang('文件格式：%s', str_replace('|', '、', $ext)); ?></div>
				</div>
				<div class="bk10"></div>
				<fieldset class="blue pad-10" id="swfupload">
					<legend><?php echo fc_lang('文件列表'); ?></legend>
					<ul class="attachment-list" id="fsUploadProgress">
					</ul>
				</fieldset>
			</div>
			<div id="cnt_1" style="display: none;" class="dr_hide">
				<p style="margin-bottom: 10px;">
					<input type="text" name="url" class="input-text" value="" style="width:99%;" onblur="addonlinefile(this)">
				</p>
				<p style="float:left">
					<?php echo fc_lang('输入一个文件的URL链接'); ?>
				</p>
				<?php if ($get['df']) { ?>
				<p style="float:right">
					<input id="is_down" type="checkbox" checked value="1"> <?php echo fc_lang('是否远程下载'); ?>
				</p>
				<?php } ?>
			</div>
			<?php if ($member['adminid']) { ?>
			<div id="cnt_2" style="display: none;" class="dr_hide">
				<iframe name="myfile" src="<?php echo THEME_PATH; ?>admin/images/loading.gif" frameborder="false" scrolling="auto" style="overflow-x:hidden;border:none" width="100%" height="330" allowtransparency="true" id="myattach"></iframe>
			</div>
			<?php }  if ($notused) { ?>
			<div id="cnt_3" style="display: none;" class="dr_hide">
				<div class="explain-col"><?php echo fc_lang('上次上传未使用的文件，如使用请点击选择。'); ?></div>
				<ul class="attachment-list" id="album">
					<?php if (is_array($notused)) { $count=count($notused);foreach ($notused as $t) { ?>
					<li id="notused_<?php echo $t['id']; ?>">
						<div class="img-wrap">
							<a id="a_notused_<?php echo $t['id']; ?>" href="javascript:;" class="off" title="<?php echo $t['filename']; ?>">
								<div onclick="javascript:album_cancel('<?php echo $t['id']; ?>')" class="icon"></div>
								<div onclick="dr_delete_file('<?php echo $t['id']; ?>')" class="delete"></div>
								<img class="loading" width="80" aid="<?php echo $t['id']; ?>" path="<?php echo $t['icon']; ?>" src="<?php echo THEME_PATH; ?>admin/images/srcloading.gif" load_src="<?php echo $t['show']; ?>" size="<?php echo $t['size']; ?>" title="<?php echo dr_strcut($t['filename'], 15); ?>" />
							</a>
						</div>
					</li>
					<?php } } ?>
				</ul>
			</div>
			<?php } ?>
		</div>
		<div id="att-status" class="hidden"></div>
		<div id="att-status-del" class="hidden"><?php echo $fileid; ?></div>
		<!-- swf -->
	</div>
</div>
</body>
<script type="text/javascript">
	if ($.browser.mozilla) {
		window.onload=function(){
			if (location.href.indexOf("&rand=")<0) {
				location.href=location.href+"&rand="+Math.random();
			}
		}
	}
	function imgWrap(obj){
		$(obj).hasClass('on') ? $(obj).removeClass("on") : $(obj).addClass("on");
	}

	function addonlinefile(obj) {
		var strs = $(obj).val() ? '|'+ $(obj).val()+',<?php echo THEME_PATH; ?>admin/images/ext/url.gif' : '';
		$('#att-status').html(strs);
	}
	function dr_delete_file(id) {
		$.post(memberpath+"index.php?s=member&c=api&m=swfdelete&siteid=<?php echo $siteid; ?>", {id: id}, function(data){
			$('#notused_'+id).remove();
		});
		return;
	}
	function change_params(){
		if($('#watermark_enable').attr('checked')) {
			swfu.addPostParam('watermark_enable', '1');
		} else {
			swfu.removePostParam('watermark_enable');
		}
	}
	function set_iframe(id,src){
		$("#"+id).attr("src",src);
	}
	function album_cancel(id){
		var obj = $('#a_notused_'+id);
		var aid = $(obj).children("img").attr("aid");
		if ($(obj).hasClass('on')){
			$(obj).attr("class", "off");
			var imgstr = $("#att-status").html();
			var length = $("a[class='on']").children("img").length;
			var strs = '';
			for (var i=0;i<length;i++){
				strs += '|'+$("a[class='on']").children("img").eq(i).attr('aid')+','+$("a[class='on']").children("img").eq(i).attr('path')+','+$("a[class='on']").children("img").eq(i).attr('size')+','+$("a[class='on']").children("img").eq(i).attr('title');
			}
			$('#att-status').html(strs);
		} else {
			var num = $('#att-status').html().split('|').length;
			var file_upload_limit = '<?php echo $fcount; ?>';
			if(num > <?php echo $fcount; ?>) {
				dr_tips("<?php echo fc_lang('不能选择超过 %s 个文件', $fcount); ?>");
				return false;
			}
			$(obj).attr("class", "on");
			$('#att-status').append('|'+aid+','+$(obj).children("img").attr("path")+','+$(obj).children("img").attr("size")+','+$(obj).children("img").attr("title"));
		}
	}
	$(function () {
		$('.loading').each(function () {
			var src = $(this).attr('load_src');
			$(this).attr('src', src);
		});
	});
</script>
</html>

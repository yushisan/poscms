<?php if ($fn_include = $this->_include("header.html")) include($fn_include); ?>
<script type="text/javascript">
function dr_space_dialog(url) {
	var throughBox = $.dialog.through; // 创建窗口
	var dr_Dialog = throughBox({title: "<?php echo fc_lang('模板售价'); ?>"});
	// ajax调用窗口内容
	$.ajax({type: "GET", url:url+"&"+Math.random(), dataType:'text', success: function (text) {
			var win = $.dialog.top;
			dr_Dialog.content(text);
			// 添加按钮
			dr_Dialog.button({name: fc_lang[36], callback:function() {
					win.$("#mark").val("0"); // 标示可以提交表单
					if (win.dr_form_check()) { // 按钮返回验证表单函数
						var _data = win.$("#myform").serialize();
						$.ajax({type: "POST",dataType:"json", url: url, data: _data, // 将表单数据ajax提交验证
							success: function(data) {
								dr_tips(data.code, 2, 1);
								dr_Dialog.close();
							},
							error: function(HttpRequest, ajaxOptions, thrownError) {
								alert(thrownError + "\r\n" + HttpRequest.statusText + "\r\n" + HttpRequest.responseText);
							}
						});
					}
					return false;
				},
				focus: true
			});
	    },
	    error: function(HttpRequest, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + HttpRequest.statusText + "\r\n" + HttpRequest.responseText);
		}
	});
}
</script>
<div class="subnav">
	<div class="content-menu ib-a blue line-x">
		<?php echo $menu; ?>
	</div>
	<div class="bk10"></div>
	<div class="explain-col">
		<font color="gray"><?php echo fc_lang('模板由模板文件目录和模板风格目录组成，为了安全起见建议模板文件目录与模板风格目录名称不要相同'); ?></font>
	</div>
	<div class="bk10"></div>
	<div class="table-list">
		<table width="100%" cellspacing="0">
		<tbody>
		<tr>
			<td align="left"><?php echo fc_lang('当前目录'); ?>：<?php echo dr_strcut(str_replace(array(WEBPATH, FCPATH), '/', $path), 40); ?></td>
			<td align="left">
			<?php if ($this->ci->is_auth($auth.'add')) { ?>
				<a class="add" title="<?php echo fc_lang('添加'); ?>" href="javascript:dr_dialog('<?php echo dr_url($furi.'add', array('dir'=> $dir, 'ismb'=>$ismb)); ?>', 'add');"></a>
                <a style="margin-left:10px" class="upload" title="<?php echo fc_lang('上传'); ?>" href="javascript:<?php echo $upload; ?>;"></a>
			<?php } ?>
			</td>
		</tr>
		<?php if ($parent) { ?>
		<tr>
			<td align="left">
				<a href="<?php echo dr_url($furi.$ci->router->method, array('dir' => $parent)); ?>"><img src="<?php echo THEME_PATH; ?>admin/images/folder-closed.gif"><?php echo fc_lang('上一层目录'); ?></a>
			</td>
			<td align="left" width="70%"></td>
		</tr>
		<?php }  if (is_array($list)) { $count=count($list);foreach ($list as $t) {  $icon=$t['icon'];$file=$t['file']; ?>
		<tr>
		<?php if (is_dir($path.$file)) { ?>
			<td align="left">
				<a href="<?php echo dr_url($furi.$ci->router->method, array('dir' => $dir.'/'.basename($file))); ?>"><img src="<?php echo THEME_PATH; ?>admin/images/folder-closed.gif"> <b><?php echo basename($file); ?></b></a>
			</td>
		<?php } else { ?>
            <td align="left">
                <a href="<?php echo $t['eurl']; ?>"><img style="width:15px;height:14px" src="<?php echo THEME_PATH; ?>admin/images/<?php echo $icon; ?>"> <?php echo $file; ?>
            </td>
        <?php } ?>
			<td align="left">
				<?php if ($this->ci->is_auth($auth.'del')) { ?>
					<label><a class="btn red btn-xs" href="javascript:;" onClick="return dr_dialog_del('<span><?php echo fc_lang('您确定要这样操作吗？'); ?></span>','<?php echo dr_url($furi.'del', array('file' => $dir.'/'.$file, 'ismb'=>$ismb)); ?>');"> <?php echo fc_lang('删除'); ?> </a></label>
					<?php if ($t['ext'] == 'zip') { ?>
					<label><a class="btn blue btn-xs" href="<?php echo dr_url($furi.'jie', array('file' => $dir.'/'.$file, 'ismb'=>$ismb)); ?>"> <?php echo fc_lang('解压'); ?> </a></label>
					<?php }  }  if ($space && !$parent) { ?>
					<label><a class="btn green btn-xs" href="javascript:;" onClick="return dr_space_dialog('<?php echo dr_url($furi.'permission', array('dir'=>basename($file))); ?>');"> <?php echo fc_lang('模板售价'); ?> </a></label>
				<?php } ?>
			</td>
		</tr>
		<?php } } ?>
		<tr>
			<td align="left" colspan="2"></td>
		</tr>
		</tbody>
		</table>
	</div>
</div>
<?php if ($fn_include = $this->_include("footer.html")) include($fn_include); ?>
<?php if ($fn_include = $this->_include("nheader.html")) include($fn_include); ?>
<script type="text/javascript">
$(function() {
	<?php if ($result) { ?>
	dr_tips('<?php echo $result; ?>');
	<?php } ?>
});
function dr_form_check() {
	var radio = $('input[name="_all"]').filter(':checked');
	if (radio.length && radio.val() == 1) {
		if (d_required('names')) return false;
	} else {
		if (d_required('name')) return false;
		if (d_required('dirname')) return false;
	}
	return true;
}
function dr_select_all() {
    $("#dr_synid").find("option").attr("selected", "selected");
}
</script>
<form class="form-horizontal" action="" method="post" id="myform" name="myform">
<input name="page" id="page" type="hidden" value="<?php echo $page; ?>" />
<input name="backurl" type="hidden" value="<?php echo $backurl; ?>" />
	<div class="page-bar">
		<ul class="page-breadcrumb mylink">
			<?php echo $menu['link']; ?>

		</ul>
		<ul class="page-breadcrumb myname">
			<?php echo $menu['name']; ?>
		</ul>
		<div class="page-toolbar">
			<div class="btn-group pull-right">
				<button type="button" class="btn green btn-sm btn-outline dropdown-toggle" data-toggle="dropdown" aria-expanded="false" data-hover="dropdown"> <?php echo fc_lang('操作菜单'); ?>
					<i class="fa fa-angle-down"></i>
				</button>
				<ul class="dropdown-menu pull-right" role="menu">
					<?php if (is_array($menu['quick'])) { $count=count($menu['quick']);foreach ($menu['quick'] as $t) { ?>
					<li>
						<a href="<?php echo $t['url']; ?>"><?php echo $t['icon'];  echo $t['name']; ?></a>
					</li>
					<?php } } ?>
					<li class="divider"> </li>
					<li>
						<a href="javascript:window.location.reload();">
							<i class="icon-refresh"></i> <?php echo fc_lang('刷新页面'); ?></a>
					</li>
				</ul>
			</div>
		</div>
	</div>

	<h3 class="page-title">
		<small><?php echo fc_lang('栏目分类是模块内容的归类，可以在不同的栏目中设置附加字段，发布时会显示对应栏目的附加字段'); ?></small>
	</h3>


	<div class="portlet light bordered myfbody">
		<div class="portlet-title tabbable-line">
			<ul class="nav nav-tabs" style="float:left;">
				<li class="active">
					<a href="#tab_0" data-toggle="tab"> <i class="fa fa-cog"></i> <?php echo fc_lang('基本设置'); ?> </a>
				</li>
				<li class="">
					<a href="#tab_1" data-toggle="tab"> <i class="fa fa-cubes"></i> <?php echo fc_lang('更多设置'); ?> </a>
				</li>
				<li class="">
					<a href="#tab_2" data-toggle="tab"> <i class="fa fa-internet-explorer"></i> <?php echo fc_lang('SEO设置'); ?> </a>
				</li>
				<li class="">
					<a href="#tab_3" data-toggle="tab"> <i class="fa fa-picture-o"></i> <?php echo fc_lang('模板设置'); ?> </a>
				</li>
				<li class="">
					<a href="#tab_4" data-toggle="tab"> <i class="fa fa-user-plus"></i> <?php echo fc_lang('管理权限'); ?> </a>
				</li>
				<?php if ($data['id']) { ?>
				<li class="">
					<a href="#tab_5" data-toggle="tab"> <i class="fa fa-user"></i> <?php echo fc_lang('会员权限'); ?> </a>
				</li>
				<li class="">
					<a href="#tab_6" data-toggle="tab"> <i class="fa fa-refresh"></i> <?php echo fc_lang('同步到其他'); ?> </a>
				</li>
				<?php } ?>
			</ul>
		</div>
		<div class="portlet-body">
			<div class="tab-content">

				<div class="tab-pane active" id="tab_0">
					<div class="form-body">
						<div class="form-group">
							<label class="col-md-2 control-label"><font color="red">*</font>&nbsp;<?php echo fc_lang('上级栏目'); ?>：</label>
							<div class="col-md-9">
								<label><?php echo $select; ?></label>
							</div>
						</div>
						<?php if (!$data['id']) { ?>

						<div class="form-group r1">
							<label class="col-md-2 control-label" style="padding-top: 10px;"><?php echo fc_lang('批量添加'); ?>：</label>
							<div class="col-md-9">
								<div class="radio-list">
									<label class="radio-inline"><input type="radio" name="_all" value="0" onclick="$('.dr_more').hide();$('.dr_one').show();" checked /> <?php echo fc_lang('否'); ?></label>
									<label class="radio-inline"><input type="radio" name="_all" value="1" onclick="$('.dr_more').show();$('.dr_one').hide();" /> <?php echo fc_lang('是'); ?></label>
								</div>
							</div>
						</div>
						<div class="form-group dr_more" style="display: none">
							<label class="col-md-2 control-label"><font color="red">*</font>&nbsp;<?php echo fc_lang('栏目列表'); ?>：</label>
							<div class="col-md-9">
								<textarea class="form-control" style="width:200px;height:150px" name="names" id="dr_names" /></textarea>
								<span class="help-block" id="dr_names_tips"><?php echo fc_lang('格式: 栏目名称|栏目目录 [回车换行]，如果不填写栏目目录时，会自动用拼音代替'); ?></span>
							</div>
						</div>
						<?php } ?>
						<div class="form-group dr_one">
							<label class="col-md-2 control-label"><font color="red">*</font>&nbsp;<?php echo fc_lang('栏目名称'); ?>：</label>
							<div class="col-md-9">
								<label><input class="form-control" type="text" name="data[name]" value="<?php echo htmlspecialchars($data['name']); ?>" id="dr_name" onblur="d_topinyin('dirname','name', 1);"></label>
								<span class="help-block" id="dr_name_tips"><?php echo fc_lang('栏目的一个名称，如“国际新闻”、“饰品服装”等'); ?></span>
							</div>
						</div>
						<div class="form-group dr_one">
							<label class="col-md-2 control-label"><font color="red">*</font>&nbsp;<?php echo fc_lang('栏目目录'); ?>：</label>
							<div class="col-md-9">
								<label><input class="form-control" type="text" name="data[dirname]" id="dr_dirname" value="<?php echo $data['dirname']; ?>"></label>
								<span class="help-block" id="dr_dirname_tips"><?php echo fc_lang('栏目目录确保唯一，用于url填充或者生成目录，如“china”等'); ?></span>
							</div>
						</div>
						<div class="form-group dr_one">
							<label class="col-md-2 control-label"><font color="red">*</font>&nbsp;<?php echo fc_lang('首字母'); ?>：</label>
							<div class="col-md-9">
								<label><input class="form-control" type="text"  name="data[letter]" id="dr_letter" value="<?php echo $data['letter']; ?>"></label>
								<span class="help-block"><?php echo fc_lang('a-z单个字母，不区分大小写'); ?></span>
							</div>
						</div>
						<div class="form-group r1">
							<label class="col-md-2 control-label" style="padding-top: 10px;"><?php echo fc_lang('是否显示'); ?>：</label>
							<div class="col-md-9">
								<div class="radio-list">
									<label class="radio-inline"><input type="radio" name="data[show]" value="1" <?php echo dr_set_radio('show', $data['show'], '1', TRUE); ?> /> <?php echo fc_lang('是'); ?></label>
									<label class="radio-inline"><input type="radio" name="data[show]" value="0" <?php echo dr_set_radio('show', $data['show'], '0'); ?> /> <?php echo fc_lang('否'); ?></label>
								</div>
								<span class="help-block"><?php echo fc_lang('选择“否”时，前端循环调用不会显示'); ?></span>
							</div>
						</div>
						<div class="form-group r1">
							<label class="col-md-2 control-label" style="padding-top: 10px;"><?php echo fc_lang('允许修改'); ?>：</label>
							<div class="col-md-9">
								<div class="radio-list">
									<label class="radio-inline"><input type="radio" name="data[setting][edit]" value="0" <?php if (!$data['setting']['edit']) { ?>checked<?php } ?> /> <?php echo fc_lang('是'); ?></label>
									<label class="radio-inline"><input type="radio" name="data[setting][edit]" value="1" <?php if ($data['setting']['edit']) { ?>checked<?php } ?> /> <?php echo fc_lang('否'); ?></label>
								</div>
								<span class="help-block"><?php echo fc_lang('选择“否”时，一旦发布内容不允许修改栏目分类'); ?></span>
							</div>
						</div>
					</div>
				</div>
				<div class="tab-pane" id="tab_1">
					<div class="form-body">
						<div class="form-group">
							<label class="col-md-2 control-label"><?php echo fc_lang('转向链接'); ?>：</label>
							<div class="col-md-9">
								<input class="form-control" type="text" name="data[setting][linkurl]" value="<?php echo $data['setting']['linkurl']; ?>">
								<span class="help-block"><?php echo fc_lang('可跳转到指定地址（不允许发布内容）'); ?></span>
							</div>
						</div>

						<?php echo $thumb;  echo $field; ?>
					</div>
				</div>
				<div class="tab-pane" id="tab_2">
					<div class="form-body">
						<div class="form-group">
							<label class="col-md-2 control-label"><?php echo fc_lang('内容Title'); ?>：</label>
							<div class="col-md-9">
								<div class="input-group">
									<div class="input-icon">
										<input name="data[setting][seo][show_title]" value="<?php echo $data['setting']['seo']['show_title']; ?>" class="form-control" type="text" style="padding-left:10px" >
									</div>
									<span class="input-group-btn">
										<button class="btn btn-success" onclick="dr_seo_rule()" type="button"><i class="fa fa-code"></i> <?php echo fc_lang('使用规则'); ?></button>
									</span>
								</div>
							</div>
						</div>
						<?php if ($extend) { ?>
						<div class="form-group">
							<label class="col-md-2 control-label"><?php echo fc_lang('内容扩展Title'); ?>：</label>
							<div class="col-md-9">
								<div class="input-group">
									<div class="input-icon">
										<input name="data[setting][seo][extend_title]" value="<?php echo $data['setting']['seo']['extend_title']; ?>" class="form-control" type="text" style="padding-left:10px" >
									</div>
									<span class="input-group-btn">
										<button class="btn btn-success" onclick="dr_seo_rule()" type="button"><i class="fa fa-code"></i> <?php echo fc_lang('使用规则'); ?></button>
									</span>
								</div>
							</div>
						</div>
						<?php } ?>
						<div class="form-group">
							<label class="col-md-2 control-label"><?php echo fc_lang('列表Title'); ?>：</label>
							<div class="col-md-9">
								<div class="input-group">
									<div class="input-icon">
										<input name="data[setting][seo][list_title]" value="<?php echo $data['setting']['seo']['list_title']; ?>" class="form-control" type="text" style="padding-left:10px" >
									</div>
									<span class="input-group-btn">
										<button class="btn btn-success" onclick="dr_seo_rule()" type="button"><i class="fa fa-code"></i> <?php echo fc_lang('使用规则'); ?></button>
									</span>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label"><?php echo fc_lang('列表Keywords'); ?>：</label>
							<div class="col-md-9">
								<div class="input-group">
									<div class="input-icon">
										<input name="data[setting][seo][list_keywords]" value="<?php echo $data['setting']['seo']['list_keywords']; ?>" class="form-control" type="text" style="padding-left:10px" >
									</div>
									<span class="input-group-btn">
										<button class="btn btn-success" onclick="dr_seo_rule()" type="button"><i class="fa fa-code"></i> <?php echo fc_lang('使用规则'); ?></button>
									</span>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label"><?php echo fc_lang('列表Description'); ?>：</label>
							<div class="col-md-9">
								<div class="input-group">
									<div class="input-icon">
										<input name="data[setting][seo][list_description]" value="<?php echo $data['setting']['seo']['list_description']; ?>" class="form-control" type="text" style="padding-left:10px" >
									</div>
									<span class="input-group-btn">
										<button class="btn btn-success" onclick="dr_seo_rule()" type="button"><i class="fa fa-code"></i> <?php echo fc_lang('使用规则'); ?></button>
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="tab-pane" id="tab_3">
					<div class="form-body">
						<div class="form-group">
							<label class="col-md-2 control-label"><?php echo fc_lang('列表信息数'); ?>：</label>
							<div class="col-md-9">
								<label><input class="form-control" type="text" value="<?php echo $data['setting']['template']['pagesize']; ?>" name="data[setting][template][pagesize]"></label>
								<span class="help-block"><?php echo fc_lang('列表页面每页显示的信息数量'); ?></span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label"><?php echo fc_lang('内容页模板'); ?>：</label>
							<div class="col-md-9">
								<label><input class="form-control" type="text" value="<?php echo $data['setting']['template']['show']; ?>" name="data[setting][template][show]"></label>
								<span class="help-block"><?php echo fc_lang('默认show.html'); ?></span>
							</div>
						</div>
						<?php if ($extend) { ?>
						<div class="form-group">
							<label class="col-md-2 control-label"><?php echo fc_lang('扩展页模板'); ?>：</label>
							<div class="col-md-9">
								<label><input class="form-control" type="text" value="<?php echo $data['setting']['template']['extend'] ? $data['setting']['template']['extend'] : 'extend.html' ?>" name="data[setting][template][extend]"></label>
								<span class="help-block"><?php echo fc_lang('默认extend.html'); ?></span>
							</div>
						</div>
						<?php } ?>
						<div class="form-group">
							<label class="col-md-2 control-label"><?php echo fc_lang('列表首页模板'); ?>：</label>
							<div class="col-md-9">
								<label><input class="form-control" type="text" value="<?php echo $data['setting']['template']['category']; ?>" name="data[setting][template][category]"></label>
								<span class="help-block"><?php echo fc_lang('默认category.html'); ?></span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label"><?php echo fc_lang('列表页模板'); ?>：</label>
							<div class="col-md-9">
								<label><input class="form-control" type="text" value="<?php echo $data['setting']['template']['list']; ?>" name="data[setting][template][list]"></label>
								<span class="help-block"><?php echo fc_lang('默认list.html'); ?></span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label"><?php echo fc_lang('搜索页模板'); ?>：</label>
							<div class="col-md-9">
								<label><input class="form-control" type="text" value="<?php echo $data['setting']['template']['search'] ? $data['setting']['template']['search'] : 'search.html' ?>" name="data[setting][template][search]"></label>
								<span class="help-block"><?php echo fc_lang('默认search.html'); ?></span>
							</div>
						</div>
					</div>
				</div>
				<div class="tab-pane" id="tab_4">
					<div class="form-body">
						<?php if (!$data['child'] || MODULE_PCATE_POST) {  echo dr_admin_rule($role, $data['setting']['admin']); ?>
						<div class="form-group">
							<label class="col-md-2 control-label"></label>
							<div class="col-md-9">
								<span class="help-block"><?php echo fc_lang('不选中项表示无权限，当新增角色组时默认无权限'); ?></span>
							</div>
						</div>
						<?php } else { ?>
						<div class="form-group">
							<label class="col-md-2 control-label"></label>
							<div class="col-md-9">
								<span class="help-block"><?php echo fc_lang('栏目为可发布的最终栏目时才能划分权限'); ?></span>
							</div>
						</div>
						<?php } ?>
					</div>
				</div>
				<?php if ($data['id']) { ?>
				<div class="tab-pane" id="tab_5">
					<div class="form-body">
						<?php if (!$data['child'] || MODULE_PCATE_POST) {  $groups[0]=array('id'=>0, 'name'=>fc_lang('游客')); $groups+= $ci->get_cache('member', 'group');  echo dr_member_rule($groups, $data); ?>

						<div class="form-group">
							<label class="col-md-2 control-label"></label>
							<div class="col-md-9">
								<span class="help-block"><?php echo fc_lang('负数表示减少值，正数表示增加值<br>拒绝访问表示此栏目及内容页拒绝访问（静态页面无效）<br>不选“审核”表示该组投稿不经过审核，“审核流程”在“系统”-“角色权限”-“审核流程”中添加'); ?></span>
							</div>
						</div>

						<?php } else { ?>
						<div class="form-group">
							<label class="col-md-2 control-label"></label>
							<div class="col-md-9">
								<span class="help-block"><?php echo fc_lang('栏目为可发布的最终栏目时才能划分权限'); ?></span>
							</div>
						</div>
						<?php } ?>
					</div>
				</div>
				<div class="tab-pane" id="tab_6">
					<div class="form-body">

						<div class="form-group">
							<label class="col-md-2 control-label"><?php echo fc_lang('同步到栏目'); ?>：</label>
							<div class="col-md-9">
								<label><?php echo $select_syn; ?></label>

								<label><button type="button" onclick="dr_select_all()" name="button" class="btn blue btn-sm"> <i class="fa fa-arrow-left"></i>  <?php echo fc_lang('全选'); ?> </button> </label>
								<span class="help-block"> <?php echo fc_lang('可以将当前栏目的设置（含权限规则）同步到其他栏目中，按“CTRL”实现多选'); ?> </span>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-2 control-label"><?php echo fc_lang('同步选项'); ?>：</label>
							<div class="col-md-9">
								<div class="checkbox-list">
									<label class="checkbox-inline"><input name="syn[]" type="checkbox" value="1"> <?php echo fc_lang('SEO设置'); ?></label>
									<label class="checkbox-inline"><input name="syn[]" type="checkbox" value="2"> <?php echo fc_lang('模板设置'); ?></label>
									<label class="checkbox-inline"><input name="syn[]" type="checkbox" value="3"> <?php echo fc_lang('管理权限'); ?></label>
									<label class="checkbox-inline"><input name="syn[]" type="checkbox" value="4"> <?php echo fc_lang('会员权限'); ?></label>
									<label class="checkbox-inline"><input name="syn[]" type="checkbox" value="5"> <?php echo fc_lang('URL规则'); ?></label>
								</div>
							</div>
						</div>

					</div>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>

	<div class="myfooter">
		<div class="row">
			<div class="portlet-body form">
				<div class="form-body">
					<div class="form-actions">
						<div class="row">
							<div class="col-md-12 text-center">
								<button type="submit" class="btn green"> <i class="fa fa-save"></i> <?php echo fc_lang('保存'); ?></button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
<?php if ($fn_include = $this->_include("nfooter.html")) include($fn_include); ?>
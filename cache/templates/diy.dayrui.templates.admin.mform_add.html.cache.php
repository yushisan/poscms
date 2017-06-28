<?php if ($fn_include = $this->_include("nheader.html")) include($fn_include); ?>
<form class="form-horizontal" action="" method="post" id="myform" name="myform">
	<input name="page" id="page" type="hidden" value="<?php echo $page; ?>" />
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
		<small><?php echo fc_lang('模块表单是对模块内容的一种扩展，如内容评论、内容报名、内容留言、内容反馈等等'); ?></small>
	</h3>

	<div class="portlet light bordered">
		<div class="portlet-title tabbable-line">
			<ul class="nav nav-tabs" style="float:left;">
				<li class="active">
					<a href="#tab_0" data-toggle="tab"> <i class="fa fa-cog"></i> <?php echo fc_lang('基本设置'); ?> </a>
				</li>
				<li class="">
					<a href="#tab_1" data-toggle="tab"> <i class="fa fa-user"></i> <?php echo fc_lang('会员权限'); ?> </a>
				</li>
			</ul>
		</div>
		<div class="portlet-body">
			<div class="tab-content">

				<div class="tab-pane active" id="tab_0">
					<div class="form-body">

						<div class="form-group">
							<label class="col-md-2 control-label"><?php echo fc_lang('名称'); ?>：</label>
							<div class="col-md-9">
								<label><input class="form-control" type="text" name="data[name]" required id="dr_name" onblur="d_topinyin('tablename','name');" value="<?php echo htmlspecialchars($data['name']); ?>" /></label>
								<span class="help-block"><?php echo fc_lang('给它一个描述名称'); ?></span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label"><?php echo fc_lang('表名称'); ?>：</label>
							<div class="col-md-9">
								<label><input class="form-control" type="text" name="data[table]" <?php if ($data['table']) { ?> readonly<?php } ?> required id="dr_tablename" value="<?php echo $data['table']; ?>" /></label>
								<span class="help-block"><?php echo fc_lang('只能由英文字母、数字组成'); ?></span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label"><?php echo fc_lang('菜单图标'); ?>：</label>
							<div class="col-md-9">
								<label><input type="text" class="form-control" name="data[setting][icon]" value="<?php echo $data['setting']['icon']; ?>"></label>
								<span class="help-block"> <a href="<?php echo dr_member_url('api/icon'); ?>" target="_blank"><?php echo fc_lang('菜单前面的图标，点击查看更多图标'); ?></a> </span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label"><?php echo fc_lang('开启邮件提醒'); ?>：</label>
							<div class="col-md-9">
								<input type="checkbox" name="data[setting][email]" value="1" <?php if ($data['setting']['email']) { ?>checked<?php } ?> data-on-text="<?php echo fc_lang('开启'); ?>" data-off-text="<?php echo fc_lang('关闭'); ?>" data-on-color="success" data-off-color="danger" class="make-switch" data-size="small">
								<span class="help-block"><?php echo fc_lang('开启之后，有人提交表单数据时会提醒信息发布者'); ?></span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label"><?php echo fc_lang('开启短信提醒'); ?>：</label>
							<div class="col-md-9">
								<input type="checkbox" name="data[setting][sms]" value="1" <?php if ($data['setting']['sms']) { ?>checked<?php } ?> data-on-text="<?php echo fc_lang('开启'); ?>" data-off-text="<?php echo fc_lang('关闭'); ?>" data-on-color="success" data-off-color="danger" class="make-switch" data-size="small">
								<span class="help-block"><?php echo fc_lang('需要开启短信功能，“系统”-“短信系统”-“设置账号”'); ?></span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label"><?php echo fc_lang('表单验证码'); ?>：</label>
							<div class="col-md-9">
								<input type="checkbox" name="data[setting][code]" value="1" <?php if ($data['setting']['code']) { ?>checked<?php } ?> data-on-text="<?php echo fc_lang('开启'); ?>" data-off-text="<?php echo fc_lang('关闭'); ?>" data-on-color="success" data-off-color="danger" class="make-switch" data-size="small">

							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label"><?php echo fc_lang('提交成功跳转URL'); ?>：</label>
							<div class="col-md-9">
								<input type="text" class="form-control input-xlarge" name="data[setting][rt_url]" value="<?php echo $data['setting']['rt_url']; ?>" >
								<span class="help-block"> <?php echo fc_lang('当用户提交表单成功之后跳转的链接, 默认为当前文章的URL, {cid}是文章id通配符, {catid}是文章栏目的通配符'); ?> </span>
							</div>
						</div>
					</div>
				</div>
				<div class="tab-pane" id="tab_1">
					<div class="form-body">
						<?php $groups[0]=array('id'=>0, 'name'=>fc_lang('游客')); $groups+= $ci->get_cache('member', 'group'); ?>
						<div class="form-group dr_one">
							<label class="col-md-2 control-label"></label>
							<div class="col-md-9">
								<label class="radio-inline"><?php echo fc_lang('禁用'); ?></label>
								<label class="radio-inline"><?php echo fc_lang('禁改'); ?></label>
								<label class="radio-inline"><?php echo fc_lang('发布增减%s', SITE_EXPERIENCE); ?></label>
								<label class="radio-inline"><?php echo fc_lang('发布增减%s', SITE_SCORE); ?></label>
								<label class="radio-inline">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo fc_lang('每日发布数'); ?></label>
								<label class="radio-inline">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo fc_lang('评论间隔'); ?></label>
							</div>
						</div>
						<?php if (is_array($groups)) { $count=count($groups);foreach ($groups as $group) {  if ($group['id']>2) { ?>
						<div class="form-group dr_one">
							<label class="col-md-2 control-label"><?php echo $group['name']; ?>：</label>
							<div class="col-md-9"></div>
						</div>
						<?php if (is_array($group['level'])) { $count=count($group['level']);foreach ($group['level'] as $level) {  $id=$group['id'].'_'.$level['id']; ?>
						<div class="form-group dr_one">
							<label class="col-md-2 control-label"><?php echo $level['name']; ?>：</label>
							<div class="col-md-9">
								<label class="radio-inline"><input type="checkbox" name="data[permission][<?php echo $id; ?>][disabled]" <?php if ($data['permission'][$id]['disabled']) { ?>checked="checked"<?php } ?> value="1" /></label>
								<label class="radio-inline"><input type="checkbox" name="data[permission][<?php echo $id; ?>][notedit]" <?php if ($data['permission'][$id]['notedit']) { ?>checked="checked"<?php } ?> value="1" /></label>
								<label class="radio-inline"><input class="input-text" type="text" name="data[permission][<?php echo $id; ?>][experience]" value="<?php echo $data['permission'][$id]['experience']; ?>" size="10" /></label>
								<label class="radio-inline"><input class="input-text" type="text" name="data[permission][<?php echo $id; ?>][score]" value="<?php echo $data['permission'][$id]['score']; ?>" size="10" /></label>
								<label class="radio-inline"><input class="input-text" type="text" name="data[permission][<?php echo $id; ?>][postnum]" value="<?php echo $data['permission'][$id]['postnum']; ?>" size="10" /></label>
								<label class="radio-inline"><input class="input-text" type="text" name="data[permission][<?php echo $id; ?>][postcount]" value="<?php echo $data['permission'][$id]['postcount']; ?>" size="10" /></label>
							</div>
						</div>
						<?php } }  } else {  $id=$group['id']; ?>
						<div class="form-group dr_one">
							<label class="col-md-2 control-label"><?php echo $group['name']; ?>：</label>
							<div class="col-md-9">
								<label class="radio-inline"><input type="checkbox" name="data[permission][<?php echo $id; ?>][disabled]" <?php if ($data['permission'][$id]['disabled']) { ?>checked="checked"<?php } ?> value="1" /></label>
								<label class="radio-inline"><input type="checkbox" name="data[permission][<?php echo $id; ?>][notedit]" <?php if ($data['permission'][$id]['notedit']) { ?>checked="checked"<?php } ?> value="1" /></label>
								<label class="radio-inline"><input class="input-text" type="text" name="data[permission][<?php echo $id; ?>][experience]" value="<?php echo $data['permission'][$id]['experience']; ?>" size="10" /></label>
								<label class="radio-inline"><input class="input-text" type="text" name="data[permission][<?php echo $id; ?>][score]" value="<?php echo $data['permission'][$id]['score']; ?>" size="10" /></label>
								<label class="radio-inline"><input class="input-text" type="text" name="data[permission][<?php echo $id; ?>][postnum]" value="<?php echo $data['permission'][$id]['postnum']; ?>" size="10" /></label>
								<label class="radio-inline"><input class="input-text" type="text" name="data[permission][<?php echo $id; ?>][postcount]" value="<?php echo $data['permission'][$id]['postcount']; ?>" size="10" /></label>
							</div>
						</div>
						<?php }  } } ?>
					</div>
				</div>
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
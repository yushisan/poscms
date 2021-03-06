<ul class="nav navbar-nav pull-right">
	<?php if ($member) { ?>
	<script language="javascript">
		var dr_url = "<?php echo dr_member_url('api/notice'); ?>&"+Math.random();
		var dr_step = 0;
		var dr_callbacktitle = "【新提醒】"+document.title;
		var dr_caltitle = "【　　　】"+document.title;

		$.ajax({type: "GET", url:dr_url, dataType:'jsonp',jsonp:"callback",async: false,
			success: function (data) {
				if (data.status) {
					$(".dr_notece_num").html(data.status);
					dr_flash_title();
				} else {
					$(".dr_notece_num").html(0);
				}
			},
			error: function(HttpRequest, ajaxOptions, thrownError) {

			}
		});

		function dr_flash_title() {
			dr_step++;
			if (dr_step==3) {
				dr_step=1;
			}
			if (dr_step==1) {
				document.title=dr_callbacktitle;
			}
			if (dr_step==2) {
				document.title=dr_caltitle;
			}
			setTimeout("dr_flash_title()", 500);
		}
	</script>
	<li class="dropdown dropdown-extended dropdown-notification">
		<a href="<?php echo SITE_URL; ?>" target="_blank" title="去首页" class="dropdown-toggle" >
			<i class="icon-home"></i>
		</a>
		<ul class="dropdown-menu">
		</ul>
	</li>
	<!-- 提醒 -->
	<li class="dropdown dropdown-extended dropdown-notification dropdown-dark">
		<a href="<?php echo dr_member_url('notice/go'); ?>" class="dropdown-toggle" >
			<i class="icon-bell"></i>
			<span class="badge badge-default dr_notece_num">0</span>
		</a>
		<ul class="dropdown-menu">
		</ul>
	</li>
	<!-- 会员信息 -->
	<li class="dropdown dropdown-user dropdown-dark">
		<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
			<img alt="<?php echo $member['username']; ?>" class="img-circle" src="<?php echo $member['avatar_url']; ?>">
			<span class="username username-hide-mobile"><?php echo $member['username']; ?></span>
		</a>
		<ul class="dropdown-menu dropdown-menu-default">
			<li>
				<a href="<?php echo dr_member_url('home/index'); ?>">
					<i class="icon-home"></i> 会员中心 </a>
			</li>
			<li>
				<a href="<?php echo dr_member_url('account/index'); ?>">
					<i class="icon-user"></i> 我的资料 </a>
			</li>
			<li>
				<a href="<?php echo dr_member_url('account/password'); ?>">
					<i class="icon-lock"></i> 修改密码 </a>
			</li>
			<li>
				<a href="<?php echo dr_member_url('account/avatar'); ?>">
					<i class="icon-picture"></i> 上传头像
				</a>
			</li>
			<li>
				<a href="<?php echo dr_member_url('notice/go'); ?>">
					<i class="icon-bell"></i> 提醒消息
					<span class="badge dr_notece_num"> 0 </span>
				</a>
			</li>
			<li class="divider"> </li>
			<li>
				<a href="javascript:;" onclick="dr_loginout('退出成功')">
					<i class="icon-key"></i> 我要退出 </a>
			</li>
		</ul>
	</li>
	<?php } else { ?>

	<li class="dropdown dropdown-extended">
		<a href="<?php echo dr_member_url('register/index'); ?>" class="dropdown-toggle" >
			<i class="icon-user-follow"></i> 免费注册
		</a>
	</li>
	<li class="dropdown dropdown-extended">
		<a href="<?php echo dr_member_url('login/index'); ?>" class="dropdown-toggle" >
			<i class="icon-user"></i> 直接登录
		</a>
	</li>
	<?php } ?>
</ul>
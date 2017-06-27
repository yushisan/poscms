<?php if ($fn_include = $this->_include("nheader.html")) include($fn_include); ?>
<script type="text/javascript">
function dr_to_key() {
	$.post("<?php echo dr_url('system/syskey'); ?>", function(data){
        $("#sys_key").val(data);
    });
    $.post("<?php echo dr_url('system/referer'); ?>", function(data){
        $("#sys_referer").val(data);
    });
}
</script>
<div class="page-bar">
    <ul class="page-breadcrumb mylink">
        <?php echo $menu['link']; ?>
        <li> <a href="<?php echo dr_help_url(2108); ?>" target="_blank"><i class="fa fa-book"></i> <?php echo fc_lang('在线帮助'); ?></a> </li>
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
    <small></small>
</h3>

<form class="form-horizontal" action="" method="post" id="myform" name="myform">
<input name="page" id="mypage" type="hidden" value="<?php echo $page; ?>" />
    <div class="portlet light bordered myfbody">
        <div class="portlet-title tabbable-line">
            <ul class="nav nav-tabs" style="float:left;">
                <li class="<?php if ($page==0) { ?>active<?php } ?>">
                    <a href="#tab_0" data-toggle="tab" onclick="$('#mypage').val('0')"> <i class="fa fa-cog"></i> <?php echo fc_lang('基本设置'); ?> </a>
                </li>
                <li class="<?php if ($page==2) { ?>active<?php } ?>">
                    <a href="#tab_2" data-toggle="tab" onclick="$('#mypage').val('2')"> <i class="fa fa-cubes"></i> <?php echo fc_lang('后台设置'); ?> </a>
                </li>
                <li class="<?php if ($page==3) { ?>active<?php } ?>">
                    <a href="#tab_3" data-toggle="tab" onclick="$('#mypage').val('3')"> <i class="fa fa-cogs"></i> <?php echo fc_lang('后台域名'); ?> </a>
                </li>
                <li class="<?php if ($page==4) { ?>active<?php } ?>">
                    <a href="#tab_4" data-toggle="tab" onclick="$('#mypage').val('4')"> <i class="fa fa-location-arrow"></i> <?php echo fc_lang('优化设置'); ?> </a>
                </li>
                <li class="<?php if ($page==5) { ?>active<?php } ?>">
                    <a href="#tab_5" data-toggle="tab" onclick="$('#mypage').val('5')"> <i class="fa fa-clock-o"></i> <?php echo fc_lang('缓存时间'); ?> </a>
                </li>
                <li class="<?php if ($page==6) { ?>active<?php } ?>">
                    <a href="#tab_6" data-toggle="tab" onclick="$('#mypage').val('6')"> <i class="fa fa-get-pocket"></i> <?php echo fc_lang('数据安全'); ?> </a>
                </li>
                <li class="<?php if ($page==7) { ?>active<?php } ?>">
                    <a href="#tab_7" data-toggle="tab" onclick="$('#mypage').val('7')"> <i class="fa fa-rmb"></i> <?php echo fc_lang('交易配置'); ?> </a>
                </li>
            </ul>
        </div>
        <div class="portlet-body">
            <div class="tab-content">

                <div class="tab-pane <?php if ($page==0) { ?>active<?php } ?>" id="tab_0">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo fc_lang('调试器'); ?>：</label>
                            <div class="col-md-9">
                                <input type="checkbox" name="data[SYS_DEBUG]" value="TRUE" <?php if ($data['SYS_DEBUG']) { ?>checked<?php } ?> data-on-text="<?php echo fc_lang('开启'); ?>" data-off-text="<?php echo fc_lang('关闭'); ?>" data-on-color="success" data-off-color="danger" class="make-switch" data-size="small">
                                <span class="help-block"><?php echo fc_lang('用于后台查看程序和SQL执行详情'); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo fc_lang('兼容性'); ?>：</label>
                            <div class="col-md-9">
                                <input type="checkbox" name="data[SYS_UPDATE]" value="TRUE" <?php if ($data['SYS_UPDATE']) { ?>checked<?php } ?> data-on-text="<?php echo fc_lang('开启'); ?>" data-off-text="<?php echo fc_lang('关闭'); ?>" data-on-color="success" data-off-color="danger" class="make-switch" data-size="small">
                                <span class="help-block"><?php echo fc_lang('开启之后可避免一些致命的SQL错误，但会降低系统效率'); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo fc_lang('系统邮箱'); ?>：</label>
                            <div class="col-md-9">
                                <label><input class="form-control" type="text" name="data[SYS_EMAIL]" value="<?php echo $data['SYS_EMAIL']; ?>" ></label>
                                <span class="help-block"><?php echo fc_lang('用于接收系统发送的通知信息的可用邮箱'); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo fc_lang('模板目录名称'); ?>：</label>
                            <div class="col-md-9">
                                <label><input class="form-control" type="text" name="data[SYS_TEMPLATE]" value="<?php echo $data['SYS_TEMPLATE']; ?>" ></label>
                                <span class="help-block"><a href="<?php echo SYS_HELP_URL; ?>2339.html" target="_blank"><?php echo fc_lang('用于指定跟目录下的templates模板目录名称，非模块下的模板目录'); ?></a></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-2 control-label">极验验证ID：</label>
                            <div class="col-md-9">
                                <input class="form-control input-xlarge" type="text" name="data[SYS_GEE_CAPTCHA_ID]" value="<?php echo $data['SYS_GEE_CAPTCHA_ID']; ?>" >
                            </div>
                        </div>
                    </div>
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-2 control-label">极验验证KEY：</label>
                            <div class="col-md-9">
                                <input class="form-control input-xlarge" type="text" name="data[SYS_GEE_PRIVATE_KEY]" value="<?php echo $data['SYS_GEE_PRIVATE_KEY']; ?>" >
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane <?php if ($page==2) { ?>active<?php } ?>" id="tab_2">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo fc_lang('程序名称'); ?>：</label>
                            <div class="col-md-9">
                                <label><input class="form-control" type="text" name="data[SYS_CMS]" value="<?php echo $data['SYS_CMS']; ?>" ></label>

                            </div>
                        </div>
                        <div style="<?php if ($admin['color']=='v2') { ?>display:block<?php } else { ?>display:none<?php } ?>" class="form-group">
                            <label class="col-md-2 control-label"><?php echo fc_lang('Logo名称'); ?>：</label>
                            <div class="col-md-9">
                                <label><input class="form-control" type="text" name="data[SYS_NAME]" value="<?php echo $data['SYS_NAME']; ?>" ></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo fc_lang('开启使用帮助'); ?>：</label>
                            <div class="col-md-9">
                                <input type="checkbox" name="data[SYS_NEWS]" value="TRUE" <?php if ($data['SYS_NEWS']) { ?>checked<?php } ?> data-on-text="<?php echo fc_lang('开启'); ?>" data-off-text="<?php echo fc_lang('关闭'); ?>" data-on-color="success" data-off-color="danger" class="make-switch" data-size="small">

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo fc_lang('是否同步登录'); ?>：</label>
                            <div class="col-md-9">
                                <input type="checkbox" name="data[SYS_SYNC_ADMIN]" value="TRUE" <?php if ($data['SYS_SYNC_ADMIN']) { ?>checked<?php } ?> data-on-text="<?php echo fc_lang('开启'); ?>" data-off-text="<?php echo fc_lang('关闭'); ?>" data-on-color="success" data-off-color="danger" class="make-switch" data-size="small">
                                <span class="help-block"><?php echo fc_lang('开启时当域名多的时候登录后台可能会卡几秒'); ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo fc_lang('后台操作日志'); ?>：</label>
                            <div class="col-md-9">
                                <input type="checkbox" name="data[SYS_LOG]" value="TRUE" <?php if ($data['SYS_LOG']) { ?>checked<?php } ?> data-on-text="<?php echo fc_lang('开启'); ?>" data-off-text="<?php echo fc_lang('关闭'); ?>" data-on-color="success" data-off-color="danger" class="make-switch" data-size="small">
                                <span class="help-block"><?php echo fc_lang('多用户操作后台建议打开日志功能'); ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo fc_lang('后台登录验证码'); ?>：</label>
                            <div class="col-md-9">
                                <input type="checkbox" name="data[SITE_ADMIN_CODE]" value="TRUE" <?php if ($data['SITE_ADMIN_CODE']) { ?>checked<?php } ?> data-on-text="<?php echo fc_lang('开启'); ?>" data-off-text="<?php echo fc_lang('关闭'); ?>" data-on-color="success" data-off-color="danger" class="make-switch" data-size="small">

                            </div>
                        </div>
                        <div class="form-body">
                            <div class="form-group">
                                <label class="col-md-2 control-label"><?php echo fc_lang('栏目归类展示'); ?>：</label>
                                <div class="col-md-9">
                                    <input type="checkbox" name="data[SYS_CATE_SHARE]" value="TRUE" <?php if ($data['SYS_CATE_SHARE']) { ?>checked<?php } ?> data-on-text="<?php echo fc_lang('开启'); ?>" data-off-text="<?php echo fc_lang('关闭'); ?>" data-on-color="success" data-off-color="danger" class="make-switch" data-size="small">
                                    <span class="help-block"><?php echo fc_lang('开启之后共享模块的栏目呈树状结构展示在左侧菜单中'); ?></span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo fc_lang('后台数据分页条数'); ?>：</label>
                            <div class="col-md-9">
                                <label><input class="form-control" type="text" name="data[SITE_ADMIN_PAGESIZE]" value="<?php echo $data['SITE_ADMIN_PAGESIZE']; ?>" ></label>
                                <span class="help-block"><?php echo fc_lang('例如文章每页显示的数量控制'); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane <?php if ($page==4) { ?>active<?php } ?>" id="tab_4">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo fc_lang('任务队列'); ?>：</label>
                            <div class="col-md-9">
                                <input type="checkbox" name="data[SYS_CRON_QUEUE]" value="1" <?php if ($data['SYS_CRON_QUEUE']) { ?>checked<?php } ?> data-on-text="<?php echo fc_lang('本站执行'); ?>" data-off-text="<?php echo fc_lang('第三方执行'); ?>" class="make-switch" data-size="small">
                                <span class="help-block"><a href="http://help.dayrui.com/72.html" target="_blank" style="color:blue !important"><?php echo fc_lang('选择“第三方”时，请参考这里'); ?></a></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo fc_lang('每次执行任务数量'); ?>：</label>
                            <div class="col-md-9">
                                <label><input class="form-control" type="text" name="data[SYS_CRON_NUMS]" value="<?php echo $data['SYS_CRON_NUMS']; ?>" > </label>
                                <span class="help-block"><?php echo fc_lang('建议不要设置的太大，否则可能会影响执行速度'); ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo fc_lang('每次执行任务间隔'); ?>：</label>
                            <div class="col-md-9">
                                <label><input class="form-control" type="text" name="data[SYS_CRON_TIME]" value="<?php echo $data['SYS_CRON_TIME']; ?>" > </label>
                                <span class="help-block"><?php echo fc_lang('单位秒，建议设置30分钟执行一次'); ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo fc_lang('最大在线人数'); ?>：</label>
                            <div class="col-md-9">
                                <label><input class="form-control" type="text" name="data[SYS_ONLINE_NUM]" value="<?php echo $data['SYS_ONLINE_NUM']; ?>" > </label>
                                <span class="help-block"><?php echo fc_lang('指服务器能承受的最大访问量，0为不限制，建议设置为平均在线人数的10倍左右'); ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo fc_lang('在线保持时间'); ?>：</label>
                            <div class="col-md-9">
                                <label><input class="form-control" type="text" name="data[SYS_ONLINE_TIME]" value="<?php echo $data['SYS_ONLINE_TIME']; ?>" > </label>
                                <span class="help-block"><?php echo fc_lang('单位秒，访问量大的站点应当调小该数值，过大或者过小的设置都有可能会增大服务器资源开销'); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane <?php if ($page==5) { ?>active<?php } ?>" id="tab_5">
                    <div class="form-body row">

                        <div class="form-body">
                            <div class="form-group">
                                <label class="col-md-2 control-label"><?php echo fc_lang('缓存功能'); ?>：</label>
                                <div class="col-md-9">
                                    <input type="checkbox" name="data[SYS_AUTO_CACHE]" value="TRUE" <?php if ($data['SYS_AUTO_CACHE']) { ?>checked<?php } ?> data-on-text="<?php echo fc_lang('开启'); ?>" data-off-text="<?php echo fc_lang('关闭'); ?>" data-on-color="success" data-off-color="danger" class="make-switch" data-size="small">
                                    <span class="help-block"><?php echo fc_lang('关闭缓存将会大大降低系统运行效率'); ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-body">
                            <div class="form-group">
                                <label class="col-md-2 control-label"><?php echo fc_lang('Memcached 缓存'); ?>：</label>
                                <div class="col-md-9">
                                    <input type="checkbox" name="data[SYS_MEMCACHE]" value="1" <?php if ($data['SYS_MEMCACHE']) { ?>checked<?php } ?> data-on-text="<?php echo fc_lang('开启'); ?>" data-off-text="<?php echo fc_lang('关闭'); ?>" data-on-color="success" data-off-color="danger" class="make-switch" data-size="small">
                                    <span class="help-block"><?php echo fc_lang('需要开启缓存功能此项才生效，可以在 config/memcached.php 配置文件中指定多个 Memcached 服务器'); ?></span>
                                </div>
                            </div>
                        </div>
                        <?php if (is_array($config)) { $count=count($config);foreach ($config as $i=>$t) {  if (strpos($i, 'SYS_CACHE') === 0) { ?>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-5 control-label"><?php echo fc_lang($t); ?>：</label>
                                <div class="col-md-5">
                                    <label><input class="form-control" type="text" name="data[<?php echo $i; ?>]" value="<?php echo intval($data[$i]); ?>" ></label>
                                </div>
                            </div>
                        </div>
                        <?php }  } } ?>
                    </div>
                    <div class="alert alert-danger"><?php echo fc_lang('缓存时间单位秒，设置为0时关闭缓存，为了网站负载力和性能，建议设置一个合理的缓存时间，不建议设置0'); ?></div>
                </div>
                <div class="tab-pane <?php if ($page==6) { ?>active<?php } ?>" id="tab_6">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo fc_lang('安全密钥'); ?>：</label>
                            <div class="col-md-9">
                                <label><input class="form-control" type="text" name="data[SYS_KEY]" id="sys_key" value="<?php if ($data['SYS_KEY']) { ?>***<?php } ?>"  ></label>
                                <label><button class="btn btn-sm blue" type="button" name="button" onclick="dr_to_key()"> <?php echo fc_lang('重新生成'); ?> </button></label>
                                <span class="help-block"><?php echo fc_lang('密钥建议定期更换'); ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo fc_lang('来路字符'); ?>：</label>
                            <div class="col-md-9">
                                <input class="form-control" type="text" name="data[SYS_REFERER]" id="sys_referer" value="<?php echo $data['SYS_REFERER']; ?>"  >
                                <span class="help-block"><?php echo fc_lang('用于移动端或API数据调用的认证字符串'); ?>&nbsp;&nbsp;<a href="<?php echo SYS_HELP_URL; ?>240.html" target="_blank" style="color:blue !important"><?php echo fc_lang('格式参考'); ?></a></span>
                            </div>
                        </div>
                        <div class="form-body">
                            <div class="form-group">
                                <label class="col-md-2 control-label"><?php echo fc_lang('HTTPS模式'); ?>：</label>
                                <div class="col-md-9">
                                    <input type="checkbox" name="data[SYS_HTTPS]" value="TRUE" <?php if ($data['SYS_HTTPS']) { ?>checked<?php } ?> data-on-text="<?php echo fc_lang('开启'); ?>" data-off-text="<?php echo fc_lang('关闭'); ?>" data-on-color="success" data-off-color="danger" class="make-switch" data-size="small">
                                    <span class="help-block"><?php echo fc_lang('开启之后全系统将采用https地址模式'); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane <?php if ($page==7) { ?>active<?php } ?>" id="tab_7">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo fc_lang('兑换比例'); ?>：</label>
                            <div class="col-md-9">
                                <?php echo fc_lang('<label>1 '.SITE_MONEY.' = &nbsp;&nbsp;</label><label>%s</label><label>&nbsp;&nbsp;'.SITE_SCORE.'</label>', '<input class="form-control input-small" type="text" name="data[SITE_CONVERT]" value="'.$data['SITE_CONVERT'].'" />'); ?>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">SITE_EXPERIENCE：</label>
                            <div class="col-md-9">
                                <label><input class="form-control" type="text" name="data[SITE_EXPERIENCE]" value="<?php echo $data['SITE_EXPERIENCE']; ?>" ></label>
                                <span class="help-block"><?php echo fc_lang('例如“经验值”，“积分值”等等'); ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">SITE_SCORE：</label>
                            <div class="col-md-9">
                                <label><input class="form-control" type="text" name="data[SITE_SCORE]" value="<?php echo $data['SITE_SCORE']; ?>" ></label>
                                <span class="help-block"><?php echo fc_lang('例如“虚拟值”，“F币”，“A币”，“B币”等等'); ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">SITE_MONEY：</label>
                            <div class="col-md-9">
                                <label><input class="form-control" type="text" name="data[SITE_MONEY]" value="<?php echo $data['SITE_MONEY']; ?>" ></label>
                                <span class="help-block"><?php echo fc_lang('例如“RMB”，“人民币”，“资金”等等，实际交易为人民币'); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane <?php if ($page==3) { ?>active<?php } ?>" id="tab_3">
                    <div class="form-body">

                        <?php if (is_array($ci->site_info)) { $count=count($ci->site_info);foreach ($ci->site_info as $sid=>$t) { ?>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo fc_lang(dr_strcut($t['SITE_NAME'], 20)); ?>：</label>
                            <div class="col-md-9">
                                <label><input class="form-control input-large" type="text" name="domain[<?php echo $sid; ?>]" value="<?php echo $domain[$sid]; ?>" ></label>
                                <span class="help-block"><a href="<?php echo SYS_HELP_URL; ?>2108.html" target="_blank"><?php echo fc_lang('绑定域名之后,只能通过此域名来访问该站点的后台'); ?></a></span>
                            </div>
                        </div>
                        <?php } } ?>

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
    </div>
</form>
<script type="text/javascript">
<!--
function memcache_test() {
	$("#memcache").val('Loading');
	$.get("<?php echo dr_url('system/memcache'); ?>&"+Math.random(),function(data){
		alert(data);
		$("#memcache").val('<?php echo fc_lang('测试'); ?>');
	})
}
//-->
</script>
<?php if ($fn_include = $this->_include("nfooter.html")) include($fn_include); ?>
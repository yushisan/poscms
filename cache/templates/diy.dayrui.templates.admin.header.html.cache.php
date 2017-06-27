<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8" />
    <title>admin</title>
    <link href="<?php echo THEME_PATH; ?>admin/css/index.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo THEME_PATH; ?>admin/css/table_form.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo THEME_PATH; ?>admin/css/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="<?php echo THEME_PATH; ?>admin/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo THEME_PATH; ?>admin/my.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo THEME_PATH; ?>admin/global/css/components-rounded.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <script type="text/javascript">var siteurl = "<?php echo SITE_PATH;  echo SELF; ?>";var memberpath = "<?php echo MEMBER_PATH; ?>";var sys_theme = "<?php echo THEME_PATH; ?>admin/";</script>
    <script type="text/javascript" src="<?php echo THEME_PATH; ?>js/<?php echo SITE_LANGUAGE; ?>.js"></script>
    <script type="text/javascript" src="<?php echo THEME_PATH; ?>js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo THEME_PATH; ?>js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?php echo THEME_PATH; ?>js/jquery.cookie.js"></script>

    <link rel="stylesheet" href="<?php echo THEME_PATH; ?>js/ui-dialog.css">
    <script type="text/javascript"t src="<?php echo THEME_PATH; ?>js/dialog-plus.js"></script>
    <script type="text/javascript" src="<?php echo THEME_PATH; ?>js/jquery.artDialog.js?skin=default"></script>
    <script type="text/javascript" src="<?php echo THEME_PATH; ?>js/validate.js"></script>
    <script type="text/javascript" src="<?php echo THEME_PATH; ?>js/admin.js"></script>
    <script type="text/javascript" src="<?php echo THEME_PATH; ?>js/dayrui.js"></script>
    <script type="text/javascript">
        var dr_login = 1;
        $(function() {
            top.$("#rightMain").attr("url", "<?php echo SELF; ?>"+window.location.search);
            //离开提示失效
            var _t;
            var blnCheckUnload = false;
            window.onunloadcancel = function(){
                clearTimeout(_t);
                top.$('.page-loading').remove();
            }
            window.onbeforeunload = function() {
                if (blnCheckUnload) {
                    setTimeout(function(){_t = setTimeout(onunloadcancel, 0)}, 0);
                    return "<?php echo fc_lang('本页面的数据未被保存'); ?>";
                }
            }
            $("[type='submit'], [type='button']").click(function(){
                blnCheckUnload = false;
            });
            $(":input").change(function(){
                blnCheckUnload = true;
            });

            <?php if (!$mymain || !$sysfield) { ?>
            top.hideNavHide();
            <?php } ?>
                    $(".table-list tr").last().addClass("dr_border_none");
                    $("#pages a").first().addClass("noloading");
                    $(".subnav .content-menu span").last().remove();
                    //art.dialog.close();
                    $("input[name='dr_select']").click(function(){
                        $(".dr_select").prop("checked",$(this).prop("checked"));
                    });
                    // 排序操作
                    $('.table-list thead th').click(function(e) {
                        var _class = $(this).attr("class");
                        if (_class == undefined) return;
                        var _name = $(this).attr("name");
                        var _order = '';
                        if (_class == "sorting") {
                            _order = 'desc';
                        } else if (_class == "sorting_desc") {
                            _order = 'asc';
                        } else {
                            _order = 'desc';
                        }
                        <?php if (isset($param['search']) && $param['search']) $get['search'] = 1; ?>
                        var url = "<?php echo dr_url(1, $get); ?>&order="+_name+" "+_order;
                        location.href=url;
                    });
                    // 适应浏览器分辨率
                    var width = $(window).width();
                    $('.table-list td, .table-list th').each(function(e){
                        if (width < 1000 && $(this).attr('hide')) {
                            $(this).hide();
                        }
                    });
                    var h = 0;
                    $(".dr_row_hide").each(function(){
                        var hh = $(this).height();
                        if (h > 0 && hh != h) {
                            $('.table-list td, .table-list th').each(function(e){
                                if ($(this).attr('hide')) {
                                    $(this).hide();
                                }
                            });
                        } else {
                            h = hh;
                        }
                    });
                    // 关闭加载窗口
                    top.$('.page-loading').remove();
                    $('.onloading, #pages a, .sorting, .sorting_desc, .sorting_asc, :submit').click(function(){
                        top.dr_loading();
                    });
                    $('.sp-choose, .noloading').click(function(){
                        top.$('.page-loading').remove();
                    });
                    // 登录检测
                    setInterval('dr_test_login()', 5000);
                });
                function dr_test_login() {
                    $.get('<?php echo dr_url("api/login"); ?>', function(html){
                        if (html.indexOf("this_finecms_test") >= 0) {
                            dr_login = 1;
                        } else {
                            if (dr_login == 1) {
                                dr_login = 0;
                                var throughBox = art.dialog.through;
                                var win = $.dialog.top;
                                throughBox({
                                    content: html,
                                    title: '<?php echo fc_lang("登录超时"); ?>',
                                    cancel: function() {
                                        dr_login = 1;
                                    },
                                    ok: function() {
                                        // 标示可以提交表单
                                        win.$("#mark").val("0");
                                        // 按钮返回验证表单函数
                                        if (win.dr_form_check()) {
                                            var _data = win.$("#myform").serialize();
                                            // 将表单数据ajax提交验证
                                            $.ajax({type: "POST",dataType:"json", url: '<?php echo dr_url("login/ajax"); ?>' , data: _data,
                                                success: function(data) {
                                                    //验证成功
                                                    if (data.status == 1) {
                                                        dr_tips('<?php echo fc_lang("登录成功"); ?>', 2, 1);
                                                    } else {
                                                        //验证失败
                                                        dr_tips(data.code);
                                                    }
                                                },
                                                error: function(HttpRequest, ajaxOptions, thrownError) {
                                                    dr_alert(HttpRequest.responseText);
                                                }
                                            });
                                        }
                                        dr_login = 1;
                                    }
                                });
                            }
                        }
                    });
                }
    </script>
</head>
<body>
<style>
    .mydate {
        height: 28px;
        border: 1px solid #d0d0d0;
    }
    .row {
        clear: both;
    }
    .col-md-3 {
        float: left;
        width: 33%;
    }
    .explain-col .input-text {
        height: 24px;
        background: #fff;
    }
</style>
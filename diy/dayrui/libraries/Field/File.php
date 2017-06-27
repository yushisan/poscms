<?php

/* v3.1.0  */

class F_File extends A_Field {

	/**
	 * 构造函数
	 */
	public function __construct() {
		parent::__construct();
		$this->name = fc_lang('单文件'); // 字段名称
		$this->fieldtype = array('VARCHAR' => '255'); // TRUE表全部可用字段类型,自定义格式为 array('可用字段类型名称' => '默认长度', ... )
		$this->defaulttype = 'VARCHAR'; // 当用户没有选择字段类型时的缺省值
	}

	/**
	 * 字段相关属性参数
	 *
	 * @param	array	$value	值
	 * @return  string
	 */
	public function option($option) {

		$data = $this->ci->get_cache('downservers');
		$downservers = '';

		if ($data) {
			$server = isset($option['server']) ? $option['server'] : array();
			foreach ($data as $t) {
				$downservers.= '<label><input '.(@in_array($t['id'], $server) ? 'checked' : '').' type="checkbox" value="'.$t['id'].'" name="data[setting][option][server][]"> '.$t['name'].'</label>';
			}
		}

		$option['width'] = isset($option['width']) ? $option['width'] : 200;
		$option['fieldtype'] = isset($option['fieldtype']) ? $option['fieldtype'] : '';
		$option['uploadpath'] = isset($option['uploadpath']) ? $option['uploadpath'] : '';
		$option['fieldlength'] = isset($option['fieldlength']) ? $option['fieldlength'] : '';
		$option['is_swfupload'] = isset($option['is_swfupload']) ? $option['is_swfupload'] : 0;

		return '<div class="form-group">
                    <label class="col-md-2 control-label">'.fc_lang('文件大小').'：</label>
                    <div class="col-md-9">
						<label><input id="field_default_value" type="text" class="form-control" value="'.$option['size'].'" name="data[setting][option][size]"></label>
						<span class="help-block">'.fc_lang('单位MB').'</span>
                    </div>
                </div>
				<div class="form-group">
                    <label class="col-md-2 control-label">'.fc_lang('扩展名').'：</label>
                    <div class="col-md-9">
                    	<label><input type="text" class="form-control" size="40" name="data[setting][option][ext]" value="'.$option['ext'].'"></label>
						<span class="help-block">'.fc_lang('格式：jpg,gif,png,exe,html,php,rar,zip').'</span>
                    </div>
                </div>
				<div class="form-group">
                    <label class="col-md-2 control-label">'.fc_lang('图片专用字段').'：</label>
                    <div class="col-md-9">
                    	<input type="checkbox" name="data[setting][option][image]" '.($option['image'] ? 'checked' : '').' value="1"  data-on-text="'.fc_lang('开启').'" data-off-text="'.fc_lang('关闭').'" data-on-color="success" data-off-color="danger" class="make-switch" data-size="small">
					</div>
                </div>
				
				<div class="form-group">
                    <label class="col-md-2 control-label">'.fc_lang('镜像服务器').'：</label>
                    <div class="col-md-9"><fieldset class="downservers">'.$downservers.'</fieldset></div>
                </div>
				<div class="form-group">
                    <label class="col-md-2 control-label">'.fc_lang('本地存储目录').'：</label>
                    <div class="col-md-9">
                    <input type="text" class="form-control" size="50" name="data[setting][option][uploadpath]" value="'.$option['uploadpath'].'">
					<span class="help-block">'.fc_lang('目录中不得包含中文 <br />标签介绍：站点id{siteid}、模块目录{module}、年{y}、月{m}、日{d} <br />例如：{siteid}/{module}/test/，将附件保存至：uploadfile/站点/模块目录/test目录/附件名称.扩展名').'</span>
                    </div>
                </div>';
	}

	/**
	 * 字段输出
	 */
	public function output($value) {
		return $value;
	}

	/**
	 * 获取附件id
	 */
	public function get_attach_id($value) {

		$data = array();
		if (!$value || !is_numeric($value)) {
			return $data;
		}

		$data[] = $value;

		return $data;
	}

	/**
	 * 附件处理
	 */
	public function attach($data, $_data) {

		// 新旧数据都无附件就跳出
		if (!$data && !$_data) {
			return NULL;
		}

		// 新旧数据都一样时表示没做改变就跳出
		if ($data === $_data) {
			return NULL;
		}

		// 当无新数据且有旧数据表示删除旧附件
		if (!$data && $_data) {
			return array(
				array(),
				array($_data)
			);
		}

		// 当无旧数据且有新数据表示增加新附件
		if ($data && !$_data) {
			return array(
				array($data),
				array()
			);
		}

		// 剩下的情况就是删除旧文件增加新文件
		return array(
			array($data),
			array($_data)
		);
	}


	/**
	 * 字段入库值
	 *
	 * @param	array	$field	字段信息
	 * @return  void
	 */
	public function insert_value($field) {

		$value = $this->ci->post[$field['fieldname']];

		// 存在缩略图值时
		if (!$value && $field['fieldname'] == 'thumb' && isset($this->ci->data[1]['thumb']) && $this->ci->data[1]['thumb']) {
			return;
		}

		$this->ci->data[$field['ismain']][$field['fieldname']] = $value;
	}

	/**
	 * 字段表单输入
	 *
	 * @param	string	$cname	字段别名
	 * @param	string	$name	字段名称
	 * @param	array	$cfg	字段配置
	 * @param	array	$data	值
	 * @return  string
	 */
	public function input($cname, $name, $cfg, $value = NULL, $id = 0) {
		// 字段显示名称
		$text = (isset($cfg['validate']['required']) && $cfg['validate']['required'] == 1 ? '<font color="red">*</font>' : '').''.$cname.'：';
		// 表单附加参数
		$attr = isset($cfg['validate']['formattr']) && $cfg['validate']['formattr'] ? $cfg['validate']['formattr'] : '';
		// 字段提示信息
		$tips = isset($cfg['validate']['tips']) && $cfg['validate']['tips'] ? '<span class="help-block" id="dr_'.$name.'_tips">'.$cfg['validate']['tips'].'</span>' : '';
		// 禁止修改
		$disabled = !IS_ADMIN && $id && $value && isset($cfg['validate']['isedit']) && $cfg['validate']['isedit'] ? 'disabled' : '';
		// 当字段是缩略图或者预览图时调用专属字段
		if (isset($cfg['option']['image']) && $cfg['option']['image']) {
			// 上传的URL
			$url = '/index.php?s=member&c=api&m=ajax_upload&name='.$name.'&siteid='.SITE_ID.'&code='.str_replace('=', '', dr_authcode($cfg['option']['size'].'|'.$this->get_upload_path($cfg['option']['uploadpath']), 'ENCODE'));
			// 剪切的URL
			$url2= dr_url('api/ajax_edit_image').'&name='.$name.'&siteid='.SITE_ID.'&code='.str_replace('=', '', dr_authcode($cfg['option']['size'].'|'.$this->get_upload_path($cfg['option']['uploadpath']), 'ENCODE'));
			// 输出变量
			$str ='';
			$str.= '<script type="text/javascript" src="'.THEME_PATH.'js/ajax.upload.js"></script>';
			$str.= '<ul class="cover imgreset" id="dr_upload_'.$name.'">';
			$str.= '<li class="upload-container" style="float:none;border:none;padding:0 0 10px 0;width:90px;height:71px;">';
			$str.= '<div class="upload-trigger '.($value ? 'completed" style="display:none' : '').'" id="dr_'.$name.'_upload"></div>';
			$str.= '<div class="upload-preview" style="display:'.($value ? 'block' : 'none').';">';
			$str.= '<input type="hidden" class="dr_'.$name.'_upload_value" name="data['.$name.']" id="cover" value="'.$value.'" />';
			$str.= '<div class="pic" style="width:90px;height:71px; overflow:hidden;background-image:none !important"><img class="dr_'.$name.'_upload_img" src="'.($value ? dr_get_file($value) : 'javascript:void(0);').'" style="height:auto;" /></div>';
			$str.= '<a href="javascript:dr_remove_'.$name.'()" title="删除" class="remove" style="display: none;"></a>';
			if (IS_ADMIN) {
				$str.= '<span class="rearrange-text" title="剪切图片" onclick="dr_edit_'.$name.'()" style="display: none;">剪切</span>';
			}
			$str.= '</div>';
			$str.= '</li>';
			$str.= '<script type="text/javascript">
            function dr_edit_'.$name.'() {
                art.dialog.open("'.$url2.'&file="+$(".dr_'.$name.'_upload_value").val(), {
                id: "crop",
                title: "剪切图片",
                opacity: 0.1,
                width: 530,
                height: 380,
                ok: function () {
                    var iframe = this.iframe.contentWindow;
                    if (!iframe.document.body) {
                        dr_tips("iframe loading")
                        return false;
                    };
                    iframe.uploadfile();
                    return false;
                },
                cancel: true
            });
            }
			function dr_remove_'.$name.'() {
				var cover = $("#dr_'.$name.'_upload");
				cover.removeClass("completed");
				cover.show();
				cover.html("");
				$(".dr_'.$name.'_upload_value").val("");
				var preview = cover.next(\'div\');
				$(\'img\', preview).attr({src:\'javascript:void(0);\'});
				preview.hide();
			}
			$(".upload-container").bind({
				mouseenter:function(){
				  $("a,span", $(this)).show();
				},
				mouseleave:function(){
				  $("a,span", $(this)).hide();
				}
			});
			$(function () {
				var $cover_'.$name.' = $("#dr_'.$name.'_upload");
				var $preview_'.$name.' = $cover_'.$name.'.next(\'div\');
				var fileType = "pic",fileNum = "one";
				var button = $("#dr_'.$name.'_upload"), interval;
				new AjaxUpload(button, {
					action: "'.$url.'",
					name: "Filedata",
					onSubmit: function (file, ext) {
						if(ext && /^(jpg|jpeg|png|gif)$/i.test(ext)){
							// 上传成功
							$cover_'.$name.'.html("<img src=\"'.THEME_PATH.'admin/images/loading-mini.gif\">");
						}else{
							dr_tips("请上传图片");
							return false;
						}
					},
					onComplete: function (file, response) {
						var json = $.parseJSON(response);
						if(json.code){
						  $("img", $preview_'.$name.').attr({src:json.url});
						  $("input", $preview_'.$name.').val(json.id);
						  $cover_'.$name.'.addClass("completed").hide();
						  $preview_'.$name.'.show();
						  $(\'div.upload-trigger:not(".completed")\').eq(0).html(\'\').show();
						}else{
						  $(\'img\', $preview_'.$name.').attr({src:\'javascript:void(0);\'});
						  $(\'input\', $preview_'.$name.').val(\'\');
						  dr_tips(json.msg);
						}
					}
				});
			});
			</script>';
			$str.= '</ul>';
			//$str.= '<input type="button" style="cursor:pointer;width:90px;" '.$disabled.' class="button" onclick="dr_edit_thumb(\''.$name.'\')" value="裁剪图片" />';
			$str.= $tips;
		} else {
			// 快速上传
			$url = '/index.php?s=member&c=api&m=new_ajax_upload&name='.$name.'&siteid='.SITE_ID.'&count=1&code='.str_replace('=', '', dr_authcode($cfg['option']['size'].'|'.$cfg['option']['ext'].'|'.$this->get_upload_path($cfg['option']['uploadpath']), 'ENCODE'));
			// 文件值
			$my = $file = $info = '';

			if ($value) {
				$file = $value;
				$data = dr_file_info($file);
				if ($data) {
					$my = '
					<button type="button" style="cursor:pointer;" class="btn green btn-sm" onclick="dr_show_file_info(\''.$data['id'].'\')"> <i class="fa fa-search"></i> '.fc_lang('预览').'</button>
					<button type="button" style="cursor:pointer;"  class="btn red btn-sm" onclick="dr_delete_file2(\''.$name.'\')"> <i class="fa fa-trash"></i> ' . fc_lang('删除') . '</button>
					';
				} elseif (is_numeric($file) && !get_attachment($file)) {
					$my = '<span class="badge badge-danger">'.fc_lang('文件信息不存在').'</span>';
				}
				unset($data);
			}
			$str = '<div class="row" style="margin:0">
		    <input type="hidden" value="'.$value.'" name="data['.$name.']" id="fileid_'.$name.'" />';
			// 加载js
			if (!defined('FINECMS_FILES_MOBILE')) {
				$str.= '<script type="text/javascript" src="'.THEME_PATH.'js/dmuploader.min.js"></script>
				<style>
				div.uploader {
					height:30px !important;
					line-height:30px;
					width:auto!important;
					background-image: none !important;
					cursor: pointer;
					padding:0px 5px 0 5px;
				}
				.my_list .badge {margin-top: 5px;}
				.my_list {
					margin-top: 0px;padding-left:5px
				}
				.my_upload {
					width:66px!important;
					margin-top: 0px;padding-left:0px
				}
				
				.uploader input {
					position: absolute;
					top: 0;
					right: 0;
					margin: 0;
					border: solid transparent;
					border-width: 0 0 100px 200px;
					opacity: .0;
					filter: alpha(opacity= 0);
					-o-transform: translate(250px,-50px) scale(1);
					-moz-transform: translate(-300px,0) scale(4);
					direction: ltr;
					cursor: pointer;
				}</style>';
				define('FINECMS_FILES_MOBILE', 1);//防止重复加载JS
			}
			if (!$disabled) {
				// 完整上传
				$furl = '/index.php?s=member&c=api&m=upload&name='.$name.'&siteid='.SITE_ID.'&count=1&code='.str_replace('=', '', dr_authcode($cfg['option']['size'].'|'.$cfg['option']['ext'].'|'.$this->get_upload_path($cfg['option']['uploadpath']), 'ENCODE'));
				$str.= '<div class="col-md-3 my_upload"><button type="button" style="cursor:pointer;"  class="btn blue btn-sm" onclick="dr_upload_file(\''.$name.'\', \''.$furl.'\')"> <i class="fa fa-upload"></i> ' . fc_lang('上传') . '</button></div>';

				$str.= '
				<div id="drag-and-drop-zone-'.$name.'" class="col-md-3 btn btn-sm blue uploader">
					<i class="fa fa-cloud-upload"></i> '.fc_lang('快传').' <input type="file" name="file">
				</div>';
			}
			$str.= '
          	<div id="dr_my_'.$name.'_list" class="col-md-6 my_list">'.$my.'</div>
          	</div>
          	<div id="dr_hide_'.$name.'_list" style="display:none"></div>
          	<script type="text/javascript">
      $("#drag-and-drop-zone-'.$name.'").dmUploader({
        url: "'.$url.'",
        dataType: "json",
        allowedTypes: "*",
        onInit: function(){
        },
        onBeforeUpload: function(id){
            $("#dr_hide_'.$name.'_list").html($("#dr_my_'.$name.'_list").html());
            $("#dr_my_'.$name.'_list").html("<span class=\"badge badge-danger\">0%</span>");
        },
        onNewFile: function(id, file){
          //alert(file);
        },
        onComplete: function(){
          //alert("All pending tranfers completed");
        },
        onUploadProgress: function(id, percent){
            $("#dr_my_'.$name.'_list").html("<span class=\"badge badge-danger\">"+(percent-1)+"%</span>");
        },
        onUploadSuccess: function(id, data){
		  if (data.code == 1) {
		  	dr_tips("上传成功", 3, 1);
		  	$("#fileid_'.$name.'").val(data.id);
		  	$("#dr_my_'.$name.'_list").html("<button type=\"button\" style=\"cursor:pointer;\" class=\"btn green btn-sm\" onclick=\"dr_show_file_info(\'"+data.id+"\')\"> <i class=\"fa fa-search\"></i> '.fc_lang('预览').'</button> ");
			$("#dr_my_'.$name.'_list").append("<button type=\"button\" style=\"cursor:pointer;\" class=\"btn red btn-sm\" onclick=\"dr_delete_file2(\''.$name.'\')\"> <i class=\"fa fa-trash\"></i> "+lang["del_file"]+"</button> ");
		  } else {
		  	dr_tips(data.msg,5);
            $("#dr_my_'.$name.'_list").html($("#dr_hide_'.$name.'_list").html());
		  }

        },
        onUploadError: function(id, message){
          alert("Failed to Upload file #" + id + ": " + message);
          $("#dr_my_'.$name.'_list").html("");
        },
        onFileTypeError: function(file){
          alert("File \"" + file.name + "\" cannot be added: must be an image");
          $("#dr_my_'.$name.'_list").html("");
        },
        onFileSizeError: function(file){
          alert( "File \"" + file.name + "\" cannot be added: size excess limit");
          $("#dr_my_'.$name.'_list").html("");
        },
        onFallbackMode: function(message){
          alert( "Browser not supported(do something else here!): " + message);
          $("#dr_my_'.$name.'_list").html("");
        }
      });
    </script>
          	';
		}

		return $this->input_format($name, $text, $str.$tips);
	}
}
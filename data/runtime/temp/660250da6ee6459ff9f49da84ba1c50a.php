<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:40:"themes/admin_simpleboot3/md\md\edit.html";i:1541732868;s:81:"D:\phpStudy\PHPTutorial\WWW\md\public\themes\admin_simpleboot3\public\header.html";i:1516847130;}*/ ?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <!-- Set render engine for 360 browser -->
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- HTML5 shim for IE8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <![endif]-->


    <link href="/themes/admin_simpleboot3/public/assets/themes/<?php echo cmf_get_admin_style(); ?>/bootstrap.min.css" rel="stylesheet">
    <link href="/themes/admin_simpleboot3/public/assets/simpleboot3/css/simplebootadmin.css" rel="stylesheet">
    <link href="/static/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        form .input-order {
            margin-bottom: 0px;
            padding: 0 2px;
            width: 42px;
            font-size: 12px;
        }

        form .input-order:focus {
            outline: none;
        }

        .table-actions {
            margin-top: 5px;
            margin-bottom: 5px;
            padding: 0px;
        }

        .table-list {
            margin-bottom: 0px;
        }

        .form-required {
            color: red;
        }
    </style>
    <script type="text/javascript">
        //全局变量
        var GV = {
            ROOT: "/",
            WEB_ROOT: "/",
            JS_ROOT: "static/js/",
            APP: '<?php echo \think\Request::instance()->module(); ?>'/*当前应用名*/
        };
    </script>
    <script src="/themes/admin_simpleboot3/public/assets/js/jquery-1.10.2.min.js"></script>
    <script src="/static/js/wind.js"></script>
    <script src="/themes/admin_simpleboot3/public/assets/js/bootstrap.min.js"></script>
    <script>
        Wind.css('artDialog');
        Wind.css('layer');
        $(function () {
            $("[data-toggle='tooltip']").tooltip();
            $("li.dropdown").hover(function () {
                $(this).addClass("open");
            }, function () {
                $(this).removeClass("open");
            });
        });
    </script>
    <?php if(APP_DEBUG): ?>
        <style>
            #think_page_trace_open {
                z-index: 9999;
            }
        </style>
    <?php endif; ?>
<style type="text/css">
    .pic-list li {
        margin-bottom: 5px;
    }
</style>
<script type="text/html" id="photos-item-tpl">
    <li id="saved-image{id}">
        <input id="photo-{id}" type="hidden" name="photo_urls[]" value="{filepath}">
        <input class="form-control" id="photo-{id}-name" type="text" name="photo_names[]" value="{name}"
               style="width: 200px;" title="图片名称">
        <img id="photo-{id}-preview" src="{url}" style="height:36px;width: 36px;"
             onclick="imagePreviewDialog(this.src);">
        <a href="javascript:uploadOneImage('图片上传','#photo-{id}');">替换</a>
        <a href="javascript:(function(){$('#saved-image{id}').remove();})();">移除</a>
    </li>
</script>
<script type="text/html" id="files-item-tpl">
    <li id="saved-file{id}">
        <input id="file-{id}" type="hidden" name="file_urls[]" value="{filepath}">
        <input class="form-control" id="file-{id}-name" type="text" name="file_names[]" value="{name}"
               style="width: 200px;" title="文件名称">
        <a id="file-{id}-preview" href="{preview_url}" target="_blank">下载</a>
        <a href="javascript:uploadOne('图片上传','#file-{id}','file');">替换</a>
        <a href="javascript:(function(){$('#saved-file{id}').remove();})();">移除</a>
    </li>
</script>
</head>
<body>
<div class="wrap js-check-wrap">
    <ul class="nav nav-tabs">
        <li><a href="<?php echo url('model_list'); ?>">文件管理</a></li>
        <li>
            <a href="<?php echo url('add'); ?>">添加文件</a>
        </li>
        <li class="active"><a href="#">编辑文件</a></li>
    </ul>
    <form action="<?php echo url('editPost'); ?>" method="post" class="form-horizontal js-ajax-form margin-top-20">
        <div class="row">
            <div class="col-md-9">
                <table class="table table-bordered">
                    <tr>
                        <th>文件标题<span class="form-required">*</span></th>
                        <td>
                            <input class="form-control" type="text" name="title"
                                   id="title" required value="<?php echo $model['title']; ?>" placeholder="请输入标题"/>
                            <input type="hidden"name="id"value="<?php echo $model['id']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <th>附件</th>
                        <td>
                            <ul id="files" class="pic-list list-unstyled form-inline">
                                <?php if(!(empty($model['model']) || (($model['model'] instanceof \think\Collection || $model['model'] instanceof \think\Paginator ) && $model['model']->isEmpty()))): $file_url=cmf_get_file_download_url($model['model']); ?>
                                        <li id="saved-file">
                                            <input id="file" type="hidden" name="file_urls[]"
                                                   value="<?php echo $model['model']; ?>">
                                            <input class="form-control" id="file-name" type="text"
                                                   name="file_names[]"
                                                   value="<?php echo $model['model_name']; ?>" style="width: 200px;" title="文件名称">
                                            <a id="file-preview" href="<?php echo $file_url; ?>" target="_blank">下载</a>
                                            <a href="javascript:uploadOne('图片上传','#file','file');">替换</a>
                                            <a href="javascript:(function(){$('#saved-file').remove();})();">移除</a>
                                        </li>

                                <?php endif; ?>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <th><b>文件封面</b></th>
                        <td>
                            <div style="text-align: center;">
                                <input type="hidden" name="avatar" id="avatar"
                                       value="<?php echo (isset($model['avatar']) && ($model['avatar'] !== '')?$model['avatar']:''); ?>">
                                <a href="javascript:uploadOneImage('图片上传','#avatar');">
                                    <?php if(empty($model['avatar'])): ?>
                                        <img src="/themes/admin_simpleboot3/public/assets/images/default-thumbnail.png"
                                             id="avatar-preview"
                                             width="135" style="cursor: pointer"/>
                                        <?php else: ?>
                                        <img src="<?php echo cmf_get_image_preview_url($model['avatar']); ?>"
                                             id="avatar-preview"
                                             width="135" style="cursor: pointer"/>
                                    <?php endif; ?>
                                </a>
                                <input type="button" class="btn btn-sm btn-cancel-avatar" value="取消图片">
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary js-ajax-submit"><?php echo lang('SAVE'); ?></button>
                <a class="btn btn-default" href="javascript:history.back(-1);"><?php echo lang('BACK'); ?></a>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript" src="/static/js/admin.js"></script>
<script type="text/javascript">
    //编辑器路径定义
    var editorURL = GV.WEB_ROOT;
</script>
<script type="text/javascript" src="/static/js/ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="/static/js/ueditor/ueditor.all.min.js"></script>
<script type="text/javascript">

    function uploadMultiFile(dialog_title, container_selector, item_tpl_wrapper_id, filetype, extra_params, app) {
        filetype = filetype ? filetype : 'file';
        openUploadDialog(dialog_title, function (dialog, files) {
            var tpl  = $('#' + item_tpl_wrapper_id).html();
            var html = '';
            $.each(files, function (i, item) {
                var itemtpl = tpl;
                itemtpl     = itemtpl.replace(/\{id\}/g, item.id);
                itemtpl     = itemtpl.replace(/\{url\}/g, item.url);
                itemtpl     = itemtpl.replace(/\{preview_url\}/g, item.preview_url);
                itemtpl     = itemtpl.replace(/\{filepath\}/g, item.filepath);
                itemtpl     = itemtpl.replace(/\{name\}/g, item.name);
                html += itemtpl;
            });
            $(container_selector).append(html);

        }, extra_params, 0, filetype, app);
    }

    $(function () {

        editorcontent = new baidu.editor.ui.Editor();
        editorcontent.render('content');
        try {
            editorcontent.sync();
        } catch (err) {
        }

        $('.btn-cancel-avatar').click(function () {
            $('#avatar-preview').attr('src', '/themes/admin_simpleboot3/public/assets/images/default-thumbnail.png');
            $('#avatar').val('');
        });

        $('#more-template-select').val("<?php echo (isset($post['more']['template']) && ($post['more']['template'] !== '')?$post['more']['template']:''); ?>");
    });

    function doSelectCategory() {
        var selectedCategoriesId = $('#js-categories-id-input').val();
        openIframeLayer("<?php echo url('AdminCategory/select'); ?>?ids=" + selectedCategoriesId, '请选择分类', {
            area: ['700px', '400px'],
            btn: ['确定', '取消'],
            yes: function (index, layero) {
                //do something

                var iframeWin          = window[layero.find('iframe')[0]['name']];
                var selectedCategories = iframeWin.confirm();
                if (selectedCategories.selectedCategoriesId.length == 0) {
                    layer.msg('请选择分类');
                    return;
                }
                $('#js-categories-id-input').val(selectedCategories.selectedCategoriesId.join(','));
                $('#js-categories-name-input').val(selectedCategories.selectedCategoriesName.join(' '));
                //console.log(layer.getFrameIndex(index));
                layer.close(index); //如果设定了yes回调，需进行手工关闭
            }
        });
    }
</script>
</body>
</html>

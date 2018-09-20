
$(function() {
    var page = {
        init: function() {

            // 渲染编辑菜单的选项
            this.renderMenuTree();
            this.renderPicPrev();

            $('#descript_en').summernote({
                minHeight: 200,
                placeholder: 'Please enter the description(en)',
                dialogsFade: true,
                dialogsInBody: true,
                disableDragAndDrop: false,
                callbacks: {
                    onImageUpload: function(files) {
                        var $files = $(files),
                            url = config.apiServer + 'pic_content/post?actionxm=upload_contentImg';
                        $files.each(function() {
                            var file = this;
                            var data = new FormData();
                            data.append('file', file);
                            $.ajax({
                                data: data,
                                type: 'POST',
                                url: url,
                                cache: false,
                                contentType: false,
                                processData: false,
                                success: function(res) {
                                    var data = JSON.parse(res);
                                    $('#descript_en').summernote('insertImage', data.name, function($image) { });

                                },
                                error: function() {
                                    console.error('error');
                                }
                            });
                        });
                    }
                }
            });
            $('#descript_tc').summernote({
                lang: 'zh-TW',
                minHeight: 200,
                placeholder: '请输入描述（tc）',
                dialogsFade: true,
                dialogsInBody: true,
                disableDragAndDrop: false,
                callbacks: {
                    onImageUpload: function(files) {
                        var $files = $(files),
                            url = config.apiServer + 'pic_content/post?actionxm=upload_contentImg';
                        $files.each(function() {
                            var file = this;
                            var data = new FormData();
                            data.append('file', file);
                            $.ajax({
                                data: data,
                                type: 'POST',
                                url: url,
                                cache: false,
                                contentType: false,
                                processData: false,
                                success: function(res) {
                                    var data = JSON.parse(res);
                                    $('#descript_tc').summernote('insertImage', data.name, function($image) { });

                                },
                                error: function() {
                                    console.error('error');
                                }
                            });
                        });
                    }
                }
            });
        },

        /**
         * 渲染分类树
         * @param  {[type]} list [description]
         * @return {[type]}      [description]
         */
        renderMenuTree: function() {
            var self = this,
                json = {
                    api: config.apiServer + 'pic_clazz/get',
                    type: 'get',
                    data: {
                        actionxm: 'search'
                    }
                };
            var callback = function(res) {
                if(res.status == 0) {
                    var list = res.data,
                        listTpl = '<option value="0">/</option>';
                    for(var i in list) {
                        var prefix = '';
                        while(list[i]['level'] >= 0) {
                            prefix += '|--';
                            list[i]['level']--;
                        }
                        console.log(prefix.length);
                        if(prefix.length>4){
                            listTpl += '<option value="' + list[i]['id'] + '">' + prefix + list[i]['name_en'] + '（' + list[i]['name_tc'] + '）' + '</option>';
                        }else{
                            listTpl += '<option disabled="disabled" value="' + list[i]['id'] + '">' + prefix + list[i]['name_en'] + '（'+ list[i]['name_tc'] + '）' + '</option>';
                        }
                    }
                    $('#clazz_id').html(listTpl);
                    if($('.js_update_clazz_id').val() != '') {
                        $('#clazz_id').val($('.js_update_clazz_id').val());
                    }
                    if($('.js_add_pic').val() == 'true') {
                        $('#clazz_id').val(0);
                    }
                } else {
                    alert(res.msg);
                }
            };
            json.callback = callback;
            Utils.requestData(json);
        },

        // 渲染预览图片
        renderPicPrev: function() {
            if(!!$('.js_update_pic').val()) {
              var picJson = $('.js_update_pic').val().split(','),
                  picHtml = '';
              for(var i=0; i<picJson.length; i++) {
                  picHtml += '<div><div class="prev-frame"><em class="js_delete_pic" data-url="' + picJson[i] + '">x</em><img src="' + picJson[i] + '" class="prev-pic"></div></div>';
              }
              $('.js_picPrevArea').append(picHtml);
            }
        }
    };

    page.init();

    $('body').delegate('.js_delete_pic', 'click', function(e) {
        $(e.currentTarget).parent().parent().remove();
    });

    $('body').delegate('.js_submit', 'click', function() {
        var title_en = $('#title_en').val(),
            title_tc = $('#title_tc').val(),
            clazz_id = $('#clazz_id').val(),
            pic = '',
            num = $('#num').val(),
            prize_en = $('#prize_en').val(),
            prize_tc = $('#prize_tc').val(),
            descript_en = $('#descript_en').summernote('code'),
            descript_tc = $('#descript_tc').summernote('code'),
            pdf = $('.js_pdf').val(),
            sort = $('#sort').val();
        // 获取图片json
        var prevPicDom = $('.prev-pic'),
            picArr = new Array();
        for(var i=0; i<prevPicDom.length; i++) {
            picArr.push($(prevPicDom[i]).attr('src'));
        }
        pic =  picArr.toString();
        if(title_en == '') {
            alert('请输入标题（en）！');
            return;
        }
        if(title_tc == '') {
            alert('请输入标题（tc）！');
            return;
        }
        if(clazz_id == '') {
            alert('请选择分类！');
            return;
        }
        if(pic == '') {
            alert('请上传图片！');
            return;
        }
        if(num == '') {
            alert('请输入标号！');
            return;
        }
        if(descript_en == '') {
            alert('请输入描述（en）!');
            return;
        }
        if(descript_tc == '') {
            alert('请输入描述（tc）!');
            return;
        }
        if(sort == '') {
            alert('请输入排序!');
            return;
        }
        var nid = $('.js_nid').val();
        var json = {
            api: config.apiServer + 'pic_content/post',
            type: 'post',
            data: {
                actionxm: 'add',
                nid: nid,
                params: {
                    title_en: title_en,
                    title_tc: title_tc,
                    clazz_id: clazz_id,
                    pic: pic,
                    num: num,
                    prize_en: prize_en,
                    prize_tc: prize_tc,
                    descript_en: descript_en,
                    descript_tc: descript_tc,
                    pdf: pdf,
                    sort: sort
                }
            }
        };
        var callback = function(res) {
            if(res.status == 0) {
                alert('保存成功！');
                window.location.href = "/adm/pic_content";
            } else {
                alert(res.msg);
            }
        };
        json.callback = callback;
        Utils.requestData(json);
    });

    $('#pic').uploadifive({
        fileTypeDesc: '上传文件',
        fileTypeExts: '*.jpg;*.jpeg;*.gif;*.png',
        multi: true,
        buttonText: '上传图片',
        height: '25',
        width: '100',
        method: 'post',
        fileObjName: 'uploadfile',
        uploadScript: config.apiServer + 'pic_content/post',
        formData: {
            'actionxm': 'upload_photo'
        },
        onUploadComplete: function(file, data, response) {
            result = $.parseJSON(data);
            if(result['status']==0) {
                var html = '<div><div class="prev-frame"><em class="js_delete_pic" data-url="' + result['name'] + '">x</em><img src="' + result['name'] + '" class="prev-pic"></div></div>';
                $('.js_picPrevArea').append(html);
            } else {
                alert(result['msg']);
            }
        }
    });
});

$(function() {
    var page = {
        init: function() {

            // 渲染编辑菜单的选项
            this.renderMenuTree();
            this.renderPicPrev();

            $('#content_en').summernote({
                minHeight: 200,
                placeholder: 'Please enter the text content',
                dialogsFade: true,
                dialogsInBody: true,
                disableDragAndDrop: false,
                callbacks: {
                    onImageUpload: function(files) {
                        var $files = $(files),
                            url = config.apiServer + 'content/post?actionxm=upload_contentImg';
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
                                    $('#content_en').summernote('insertImage', data.name, function($image) { });

                                },
                                error: function() {
                                    console.error('error');
                                }
                            });
                        });
                    }
                }
            });
            $('#content_tc').summernote({
                lang: 'zh-TW',
                minHeight: 200,
                placeholder: '请输入正文内容',
                dialogsFade: true,
                dialogsInBody: true,
                disableDragAndDrop: false,
                callbacks: {
                    onImageUpload: function(files) {
                        var $files = $(files),
                            url = config.apiServer + 'content/post?actionxm=upload_contentImg';
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
                                    $('#content_tc').summernote('insertImage', data.name, function($image) { });

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
        },

        /**
         * 渲染分类树
         * @param  {[type]} list [description]
         * @return {[type]}      [description]
         */
        renderMenuTree: function() {
            var self = this,
                json = {
                    api: config.apiServer + 'clazz/get',
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
                        listTpl += '<option value="' + list[i]['id'] + '">' + prefix + list[i]['name_en'] + '（' + list[i]['name_tc'] + '）' + '</span></option>';
                    }
                    $('#clazz_id').html(listTpl);
                    if($('.js_update_clazz_id').val() != '') {
                        $('#clazz_id').val($('.js_update_clazz_id').val());
                        if($('#clazz_id').val()==2){
                            $('.press_show').hide()
                            $('.media_show').show()
                        // }else if($('#clazz_id').val()==0){
                        //     $('.press_show').show()
                        //     $('.media_show').show()
                        }else{
                            $('.press_show').show()
                            $('.media_show').hide()
                        }
                    }
                    if($('.js_add_clazz_id').val() == 'add') {
                        $('#clazz_id').val(0);
                        $('.press_show').show()
                        $('.media_show').show()
                    }
                } else {
                    alert(res.msg);
                }
            };
            json.callback = callback;
            Utils.requestData(json);
        },
    };

    page.init();

    $('body').delegate('#clazz_id', 'change', function(e) {
        console.log($('#clazz_id').val());
        if($('#clazz_id').val()==2){

            $('.media_show').show()
            $('.press_show').hide()
        }else if($('#clazz_id').val()==0){
            $('.press_show').show()
            $('.media_show').show()
        }else{
            $('.press_show').show()
            $('.media_show').hide()
        }
    });

    $('body').delegate('.js_delete_pic', 'click', function(e) {
        $(e.currentTarget).parent().parent().remove();
    });

    $('body').delegate('.js_delete_pdf', 'click', function(e) {
        $(e.currentTarget).remove();
        $('.js_pdf').val('');
        $('.js_pdf_prev').html('');
    });

    $('body').delegate('.js_delete_pdf2', 'click', function(e) {
        $(e.currentTarget).remove();
        $('.js_pdf2').val('');
        $('.js_pdf_prev2').html('');
    });

    $('body').delegate('.js_submit', 'click', function() {
        var title_en = $('#title_en').val(),
            title_tc = $('#title_tc').val(),
            clazz_id = $('#clazz_id').val(),
            // pic = $('#prevArea').attr('src'),
            pic = '',
            descript_en = $('#descript_en').val(),
            descript_tc = $('#descript_tc').val(),
            content_en = $('#content_en').summernote('code'),
            content_tc = $('#content_tc').summernote('code'),
            pdf_en = $('.js_pdf').val(),
            pdf_tc = $('.js_pdf2').val(),
            author_en = $('#author_en').val();
            author_tc = $('#author_tc').val();
        if(title_en == '') {
            alert('请输入标题（en）！');
            return;
        }
        if(title_tc == '') {
            alert('请输入标题（tc）！');
            return;
        }
        if(clazz_id == '0') {
            alert('请选择分类！');
            return;
        }
        if(clazz_id === '2'){
            pic = $('#prevArea').attr('src');
        } else {
            var prevPicDom = $('.prev-pic'),
                picArr = new Array();
            for(var i=0; i<prevPicDom.length; i++) {
                picArr.push($(prevPicDom[i]).attr('src'));
            }
            pic =  picArr.toString();
        }
        // if(pic == '') {
        //     alert('请上传封面图！');
        //     return;
        // }
        // if(content_en == '') {
        //     alert('请输入正文内容（en）!');
        //     return;
        // }
        // if(content_tc == '') {
        //     alert('请输入正文内容（tc）!');
        //     return;
        // }
        // if(author == '') {
        //     alert('请输入作者!');
        //     return;
        // }
        var nid = $('.js_nid').val();
        var json = {
            api: config.apiServer + 'content/post',
            type: 'post',
            data: {
                actionxm: 'add',
                nid: nid,
                params: {
                    title_en: title_en,
                    title_tc: title_tc,
                    clazz_id: clazz_id,
                    pic: pic,
                    descript_en: descript_en,
                    descript_tc: descript_tc,
                    content_en: content_en,
                    content_tc: content_tc,
                    author_en: author_en,
                    author_tc: author_tc,
                    pdf_en: pdf_en,
                    pdf_tc: pdf_tc
                }
            }
        };
        var callback = function(res) {
            if(res.status == 0) {
                alert('保存成功！');
                window.location.href = "/adm/content";
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
            multi: false,
            buttonText: '上传图片',
            height: '25',
            width: '100',
            method: 'post',
            fileObjName: 'uploadfile',
            uploadScript: config.apiServer + 'content/post',
            formData: {
                'actionxm': 'upload_photo'
            },
            onUploadComplete: function(file, data, response) {
                result = $.parseJSON(data);
                if(result['status']==0) {
                    $('#prevArea').attr('src', result['name']);
                } else {
                    alert(result['msg']);
                }
            }
        });
        $('#pic2').uploadifive({
            fileTypeDesc: '上传文件',
            fileTypeExts: '*.jpg;*.jpeg;*.gif;*.png',
            multi: true,
            buttonText: '上传图片',
            height: '25',
            width: '100',
            method: 'post',
            fileObjName: 'uploadfile',
            uploadScript: config.apiServer + 'content/post',
            formData: {
                'actionxm': 'upload_album'
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

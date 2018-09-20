$(function() {
    var page = {
        init: function(p) {
            console.log(p);
            var json = {
                api: config.apiServer + 'pic_content/get',
                type: 'get',
                data: {
                    actionxm: 'getList',
                    page: !p ? 1 : p,
                    size: 20,
                    keyword: $('#title').val(),
                    clazz_id: $('.js_add_menuTree').val()
                }
            };
            var callback = function(res) {
                // 处理表格数据
                var idx = 1,
                    list = res['list'],
                    listTpl = '<tr><th>编号</th><th>标题（en）</th><th>标题（tc）</th><th>分类</th><th>创建时间</th><th>修改时间</th><th>操作</th></tr>';
                for(var i in list) {
                    listTpl += '<tr>';
                    listTpl += '<td>' + (idx++) + '</td>';
                    listTpl += '<td>' + list[i]['title_en'] + '</td>';
                    listTpl += '<td>' + list[i]['title_tc'] + '</td>';
                    if(list[i]['clazz_name_en'] == '') {
                        listTpl += '<td>/（/）</td>';
                    } else {
                        listTpl += '<td>' + list[i]['clazz_name_en'] + '（' + list[i]['clazz_name_tc'] + '）</td>';
                    }
                    listTpl += '<td>' + list[i]['create_time'] + '</td>';
                    listTpl += '<td>' + list[i]['update_time'] + '</td>';
                    listTpl += '<td><button type="button" class="btn btn-sm btn-primary js_edit" data-id="' + list[i]['id'] + '">修改</button>&nbsp;&nbsp;<button type="button" class="btn btn-sm btn-danger js_delete" data-id="' + list[i]['id'] + '">删除</button></td>';
                    listTpl += '</tr>';
                }
                $('.js_table').html(listTpl);
                // 处理分页
                var pageTpl = '',
                    total = parseInt(res.total),
                    size = parseInt(res.size),
                    page = parseInt(res.page),
                    itemNum = Math.ceil(total / size),
                    itemStart = 1,
                    itemMax = 1,
                    fisrtItemCls = page==1 ? ' class="disabled"' : '',
                    lastItemCls = page==itemNum ? ' class="disabled"' : '';
                pageTpl += '<li ' + fisrtItemCls + '><a href="javascript:void(0)" aria-label="Previous" data-page="1" class="js_pageItem"><span aria-hidden="true">&laquo;</span></a></li>';
                if(page>3) {
                    itemStart = (page + 2) > itemNum ? itemNum - 4 : page - 2;
                    itemMax = (page + 2) > itemNum ? itemNum : page + 2;
                } else {
                    itemMax = itemNum>=5 ? 5 : itemNum;
                }
                for(itemStart; itemStart<=itemMax; itemStart++) {
                    var pageItemCls = itemStart==page ? ' class="active"' : '';
                    pageTpl += '<li ' + pageItemCls + '><a href="javascript:void(0)" data-page="' + itemStart + '" class="js_pageItem">' + itemStart + '</a></li>';
                }
                pageTpl += '<li ' + lastItemCls + '><a href="javascript:void(0)" aria-label="Next" data-page="' + itemNum + '" class="js_pageItem"><span aria-hidden="true">&raquo;</span></a></li>';
                $('.js_page').html(pageTpl);
            };
            var errorCall = function() {
                $('.alert-warning').text('系统繁忙，请稍后再试').show();
                setTimeout("$('.alert').hide()", 3000);
            };
            json.callback = callback;
            json.errorCall = errorCall;
            Utils.requestData(json);
        },
        deleteItem: function(id) {
            var json = {
                api: config.apiServer + 'pic_content/post',
                type: 'post',
                data: {
                    actionxm: 'delete',
                    id: id
                }
            };
            var callback = function(res) {
                if(res.status==0) {
                    alert('删除成功！');
                    var p = $('.js_page li[class=active] a').data('page');
                    page.init(p);
                } else {
                    alert(res.msg);
                }
            };
            var errorCall = function() {
                $('.alert-warning').text('系统繁忙，请稍后再试').show();
                setTimeout("$('.alert').hide()", 3000);
            };
            json.callback = callback;
            json.errorCall = errorCall;
            Utils.requestData(json);
        },
        addExl: function(id) {
            var json = {
                api: config.apiServer + 'pic_content/post',
                type: 'post',
                data: {
                    actionxm: 'addExl',
                    id: id
                }
            };
            var callback = function(res) {
                if(res.status==0) {
                    alert('导入成功！');
                    var p = $('.js_page li[class=active] a').data('page');
                    page.init(p);
                } else {
                    alert(res.msg);
                }
            };
            var errorCall = function() {
                $('.alert-warning').text('系统繁忙，请稍后再试').show();
                setTimeout("$('.alert').hide()", 3000);
            };
            json.callback = callback;
            json.errorCall = errorCall;
            Utils.requestData(json);
        }
    };

    page.init();

    $('body').delegate('.js_addContent', 'click', function() {
        window.location.href = '/adm/pic_content/add';
    });
    $('.js_searchFrom').submit(function(e) {
        e.preventDefault();
        var p = $('.js_page li[class=active] a').data('page');
        page.init(p);
        $('#title').val('');
    });
    $('body').delegate('.js_add_menuTree', 'change', function(e) {
        // console.log();
        var p = $('.js_page li[class=active] a').data('page');
        page.init(p, $('.js_add_menuTree').val());
    });
    $('body').delegate('.js_delete', 'click', function(e) {
        var id = $(e.currentTarget).data('id');
        page.deleteItem(id);
    });
    $('body').delegate('.js_edit', 'click', function(e) {
        var id = $(e.currentTarget).data('id');
        window.location.href = '/adm/pic_content/add/' + id;
    });
    $('body').delegate('.js_pageItem', 'click', function(e) {
        var p = $(e.currentTarget).data('page');
        page.init(p);
    });
    $('body').delegate('.js_addExl', 'click', function(e) {
        page.init(p);
    });

    $('#js_addExl').uploadifive({
        fileType: 'application/vnd.ms-excel',
        multi: false,
        removeCompleted: true,
        buttonText: '导入exel',
        fileSizeLimit: '100MB',
        method: 'post',
        buttonClass: 'signup-upload-file',
        fileObjName: 'uploadExl',
        uploadScript: config.apiServer + 'pic_content/post',
        formData: {
            'actionxm': 'addExl',
            'clazz_id': ''
        },
        onUpload: function(filesToUpload) {
            if($(".js_add_menuTree").val()==='0'){
                alert('請先選擇分類');
                $(this).uploadifive('cancel', $('.uploadifive-queue-item').first().data('file'));
            }else{
                var element = {
                    'actionxm': 'addExl',
                    'clazz_id': $('.js_add_menuTree').val()
                };
                $(this).data('uploadifive').settings.formData = element;

            }
        },
        onUploadComplete: function(file, data, response) {
            var result = $.parseJSON(data);
            if(result['status']=='0') {
                alert('导入成功！');
                var p = $('.js_page li[class=active] a').data('page');
                page.init(p);
            }
        },
        onError: function(errorType) {
            alert('The error was: ' + errorType);
        }
    });

});

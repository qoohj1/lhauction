$(function() {
    var page = {
        init: function(p) {
            var json = {
                api: config.apiServer + 'notice/get',
                type: 'get',
                data: {
                    actionxm: 'search',
                    page: !p ? 1 : p,
                    size: 20
                }
            };
            var callback = function(res) {
                // 处理表格数据
                var list = res['list'],
                    listTpl = '<tr><th>编号</th><th>内容（en）</th><th>内容（tc）</th><th>链接（en）</th><th>链接（tc）</th><th>排序</th><th>操作</th></tr>';
                for(var i in list) {
                    listTpl += '<tr>';
                    listTpl += '<td>' + list[i]['id'] + '</td>';
                    listTpl += '<td>' + list[i]['content_en'] + '</td>';
                    listTpl += '<td>' + list[i]['content_tc'] + '</td>';
                    listTpl += '<td><a href="' + list[i]['url_en'] + '" target="blank">' + list[i]['url_en'] + '</a></td>';
                    listTpl += '<td><a href="' + list[i]['url_tc'] + '" target="blank">' + list[i]['url_tc'] + '</a></td>';
                    listTpl += '<td>' + list[i]['sort'] + '</td>';
                    listTpl += '<td><button type="button" class="btn btn-sm btn-primary js_edit" data-toggle="modal" data-target="#editModal" data-id="' + list[i]['id'] + '">编辑</button>&nbsp;&nbsp;<button type="button" class="btn btn-sm btn-danger js_delete" data-id="' + list[i]['id'] + '">删除</button></td>';
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
            json.callback = callback;
            Utils.requestData(json);
        },
        getDetail: function(id) {
            var json = {
                api: config.apiServer + 'notice/get',
                type: 'get',
                data: {
                    actionxm: 'detail',
                    id: !id ? 1 : id
                }
            };
            var callback = function(res) {
                $('.js_id').text(res['data'].id);
                $('.js_update_content_en').val(res['data'].content_en);
                $('.js_update_content_tc').val(res['data'].content_tc);
                $('.js_update_url_en').val(res['data'].url_en);
                $('.js_update_url_tc').val(res['data'].url_tc);
                $('.js_update_sort').val(res['data'].sort);
            };
            json.callback = callback;
            Utils.requestData(json);
        },
        deleteConfirmTip: function(id) {
            $('#confirmModal').find('.js_sure_delete').attr('data-id', id);
            $('#confirmModal').modal('show');
        },
        deletItem: function(id) {
            var json = {
                api: config.apiServer + 'notice/post',
                type: 'post',
                data: {
                    actionxm: 'delete',
                    id: id
                }
            };
            var callback = function(res) {
                if(res.status==0) {
                    $('#confirmModal').modal('hide');
                    alert(res.msg);
                    window.location.reload();
                } else {
                    alert(res.msg);
                }
            };
            json.callback = callback;
            Utils.requestData(json);
        }
    };
    page.init();
    $('body').delegate('.js_pageItem', 'click', function(e) {
        var p = $(e.currentTarget).data('page');
        page.init(p);
    });
    $('body').delegate('.js_edit', 'click', function(e) {
        var id = $(e.currentTarget).data('id');
        page.getDetail(id);
    });
    $('body').delegate('.js_delete', 'click', function(e){
        var id = $(e.currentTarget).data('id');
        page.deleteConfirmTip(id);
    });
    $('body').delegate('.js_sure_delete', 'click', function(e){
        var id = $(e.currentTarget).data('id');
        page.deletItem(id);
    });
    $('body').delegate('.js_add_saveBtn', 'click', function() {
        var content_en = $('.js_add_content_en').val(),
            content_tc = $('.js_add_content_tc').val(),
            url_en = $('.js_add_url_en').val(),
            url_tc = $('.js_add_url_tc').val(),
            sort = $('.js_add_sort').val();
        var json = {
                api: config.apiServer + 'notice/post',
                type: 'post',
                data: {
                    actionxm: 'add',
                    params: {
                        content_en: content_en,
                        content_tc: content_tc,
                        url_en: url_en,
                        url_tc: url_tc,
                        sort: sort
                    }
                }
            };
        var callback = function(res) {
            if(res.status==0) {
                alert(res.msg);
                window.location.reload();
            } else {
                alert(res.msg);
            }
        };
        json.callback = callback;
        Utils.requestData(json);
    });
    $('body').delegate('.js_saveBtn', 'click', function() {
        var id = $('.js_id').text(),
            content_en = $('.js_update_content_en').val(),
            content_tc = $('.js_update_content_tc').val(),
            url_en = $('.js_update_url_en').val(),
            url_tc = $('.js_update_url_tc').val(),
            sort = $('.js_update_sort').val();
        var json = {
                api: config.apiServer + 'notice/post',
                type: 'post',
                data: {
                    actionxm: 'update',
                    id: id,
                    params: {
                        content_en: content_en,
                        content_tc: content_tc,
                        url_en: url_en,
                        url_tc: url_tc,
                        sort: sort
                    }
                }
            };
        var callback = function(res) {
            if(res.status==0) {
                alert(res.msg);
                window.location.reload();
            } else {
                alert(res.msg);
            }
        };
        json.callback = callback;
        Utils.requestData(json);
    });
    $('#photo').uploadifive({
        fileTypeDesc: '上传文件',
        fileTypeExts: '*.jpg;*.jpeg;*.gif;*.png',
        multi: false,
        buttonText: '上传文件',
        height: '25',
        width: '100',
        method: 'post',
        fileObjName: 'uploadfile',
        uploadScript: config.apiServer + 'banner/post',
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
});

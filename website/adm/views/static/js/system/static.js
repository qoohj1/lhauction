$(function() {
    var page = {
        init: function(p) {
            var json = {
                api: config.apiServer + 'staticpage/get',
                type: 'get',
                data: {
                    actionxm: 'getStatic'
                }
            };
            var callback = function(res) {
                // 处理表格数据
                var list = res['list'],
                    listTpl = '<tr><th>编号</th><th>欄目（en）</th><th>欄目（tc）</th><th>操作</th></tr>';
                for(var i in list) {
                    listTpl += '<tr>';
                    listTpl += '<td>' + list[i]['id'] + '</td>';
                    listTpl += '<td>' + list[i]['name_en'] + '</td>';
                    listTpl += '<td>' + list[i]['name_tc'] + '</td>';
                    listTpl += '<td><button type="button" class="btn btn-sm btn-primary js_edit" data-id="' + list[i]['id'] + '">編輯</button></td>';
                    listTpl += '</tr>';
                }
                $('.js_table').html(listTpl);
            };
            json.callback = callback;
            Utils.requestData(json);
        }
    };
    page.init();
    $('body').delegate('.js_edit', 'click', function(e) {
        var id = $(e.currentTarget).data('id');
        window.location.href = '/adm/staticpage/update/' + id;
    });
    $('body').delegate('.js_addContent', 'click', function() {
        window.location.href = '/adm/static/update';
    });

});

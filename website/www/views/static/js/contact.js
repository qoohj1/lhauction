$(function() {
    $('body').delegate('#submit', 'click', function(e) {
        var name = $('#name').val(),
            email = $('#email').val(),
            phone = $('#phone').val();


            var ck = $("input[type='checkbox']:checked")    //获取选中的复选框数组

            var ckVal = "";

            for(var i = 0; i<ck.length; i++){

              //alert($(ck[i]).val())//循环得到当前选择的值

              ckVal += $(ck[i]).val() + ",";

            }
        ckVal = ckVal.substr(0,ckVal.length - 1);
        if(name == '') {
            alert('请输入姓名（name）！');
            return;
        }
        if(email == '') {
            alert('请输入邮箱（email）！');
            return;
        }
        if(phone == '') {
            alert('请输入电话（phone）！');
            return;
        }
        if(ckVal == '') {
            alert('请输入類別（category）！');
            return;
        }


        var json = {
            api: config.apiServer + 'contact/post',
            type: 'post',
            data: {
                actionxm: 'cataRequest',
                params: {
                    name: name,
                    email: email,
                    phone: phone,
                    category: ckVal
                }
            }
        };
        var callback = function(res) {
            alert('傳送成功！');
        };
        var errorCall = function() {
            // $('.alert-warning').text('系统繁忙，请稍后再试').show();
            // setTimeout("$('.alert').hide()", 3000);
        };
        json.callback = callback;
        json.errorCall = errorCall;
        Utils.requestData(json);
    });


});

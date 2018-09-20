$(function() {
  $('.menu2 .nav').on('click', function(){
    $(this).addClass('cur');
    $(this).siblings().removeClass('cur');
  })
  var cid = Utils.GetQueryString('cid');
  if(cid){
    $('.sub-tit[data-cid='+cid+']').parent().addClass('cur');
    $('.sub-tit[data-cid='+cid+']').parent().parent().addClass('cur');
  }else{
    $('.nav:first-child').addClass('cur');
    $('.nav:first-child').find('.sub-navi').first().addClass('cur');
  }

      // var page = {
      //
      //     // 页面初始化方法
      //     init: function() {
      //         var self = this,
      //             cid = Utils.GetQueryString('cid'),
      //             json = {
      //                 api: config.apiServer + 'catalogue/get',
      //                 type: 'get',
      //                 data: {
      //                     actionxm: 'getaid',
      //                     id: cid
      //                 }
      //             };
      //         var callback = function(res) {
      //             if(res.status == 0) {
      //               var aid = res.data['parent_id'],
      //                   cid = Utils.GetQueryString('cid');
      //               $('.nav[data-aid='+aid+']').addClass('cur');
      //               $('.sub-tit[data-cid='+cid+']').parent().addClass('cur');
      //             } else {
      //                 alert(res.msg);
      //             }
      //         };
      //
      //         json.callback = callback;
      //         Utils.requestData(json);
      //     },
      //
      //
      // };
      //
      // page.init();
      //
  // var aid =
})

$(function() {
    var flag=1
    $('.sub-nav').hide()
  $('.menu .nav:first-child').on('click', function(){
      if(flag==1){
          $(this).find('.sub-nav').show()
          flag=0
      }else{
          $(this).find('.sub-nav').hide()
          flag=1
      }
  })

  var aid = Utils.GetQueryString('aid');
  $('.sub-tit[data-aid='+aid+']').addClass('cur');

  var id = Utils.GetQueryString('id');
  if(id){
    $('.sub-tit[data-id='+id+']').addClass('cur');
  }else{
  }


})

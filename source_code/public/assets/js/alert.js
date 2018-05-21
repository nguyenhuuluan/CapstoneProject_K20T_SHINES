function alertSuccess(message)
{
  $.alert({
    icon: 'fa fa-thumbs-o-up',
    type: 'blue',
    title:'Thông báo!!',
    content: message,
    buttons: {
      Ok: {
        keys: ['enter'],
        btnClass: 'btn-default',
      }
    }
  });
}
function alertError(message)
{
  $.confirm({
    icon: 'fa fa-warning',
    title: 'Lỗi!',
    content: message,
    type: 'red',
    typeAnimated: true,
    buttons: {
      tryAgain: {
        text: 'Đồng ý',
        btnClass: 'btn-red',
      },
    }
  });
}
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
function validateImg(input){
  var ext = input.value.match(/\.([^\.]+)$/)[1];
  switch(ext.toLowerCase())
  {
    case 'jpg':
    case 'png':
    case 'gif':
    case 'bmp':
    case 'jpeg':
    case 'JPG':
    case 'PNG':
    case 'GIF':
    case 'BMP':
    case 'JPEG':
    return true;
    break;
    default:
    return false;
  }
}
function validateSizeIMG(input){
  var file_size = input.files[0].size;
  if(file_size>2097152){
    return false;
  } else{ return true;}
}
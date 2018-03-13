@extends('layouts2.master-layout',['title' => 'Cập nhật thông tin công ty', 'isDisplaySearchHeader' => false])

@section('content')
<section>
   <div class="container">
      <div class="col-md-3 col-sm-12 col-xs-12">
         <center>
            <div class="form-group">
             <input type="file" class="dropify" data-default-file="assets/img/fpt.jpg">
             <span class="help-block">Logo công ty của bạn</span>
          </div>
       </center>
       <hr>
       <center>
         <p>Liên hệ với VLU Jobs</p>
         <strong>08 123 4568</strong><br><br>
         <a href="company-detail-preview.html" target="_blank" class="btn btn-warning">Xem công ty của bạn</a>
      </center>
      <br>
   </div>
   <div class="col-md-9 col-sm-12 col-xs-12">
      <div class="table-responsive">
         <table class="table">
            <thead>
               <tr>
                  <th>Chi tiết công ty</th>
                  <th></th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td>Tên công ty</td>
                  <td><input type="text" class="form-control input-sm" value="FPT"></td>
               </tr>
               <tr>
                  <td>Mã số kinh doanh</td>
                  <td><input type="text" class="form-control input-sm" value="12424234ABC"></td>
               </tr>
               <tr>
                  <td>Email</td>
                  <td><input type="text" class="form-control input-sm" value="info@fpt.com.vn"></td>
               </tr>
               <tr>
                  <td>Email dự phòng</td>
                  <td><input type="text" class="form-control input-sm" value="infofo@fpt.com.vn"></td>
               </tr>
               <tr>
                  <td>Số điện thoại</td>
                  <td><input type="text" class="form-control input-sm" value="+84 123456789"></td>
               </tr>
               <tr>
                  <td>Địa chỉ</td>
                  <td><input type="text" class="form-control input-sm" value="45 Nguyễn Khắc Nhu"></td>
               </tr>
               <tr>
                  <td>Quận/ Huyện</td>
                  <td>
                     <select class="form-control selectpicker">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option selected="selected" value="3">3</option>
                        <option value="4">4</option>
                     </select>
                  </td>
               </tr>
               <tr>
                  <td>Tỉnh/Thành Phố</td>
                  <td>
                   <select class="form-control selectpicker">
                     <option selected="selected">Hồ Chí Minh</option>
                     <option>Hà Nội</option>
                     <option>Đà Nẵng</option>
                     <option>Cần Thơ</option>
                     <option>Hải Phòng</option>
                  </select>
               </td>
            </tr>
            <tr>
               <td>Quốc Gia</td>
               <td><input type="text" class="form-control input-sm" value="Việt Nam"></td>
            </tr>
            <tr>
               <td>Website</td>
               <td><input type="text" class="form-control input-sm" value="www.fpt.com.vn"></a></td>
            </tr>
            <tr>
               <td>Thời gian làm việc</td>
               <td>
                  <select class="form-control selectpicker" data-placeholder="Nhấn để chọn...">
                     <option>Thứ hai - thứ sáu</option>
                     <option>Thứ hai - thứ bảy</option>
                     <option>Thứ hai - chủ nhật</option>
                  </select>
               </td>
            </tr>
            <tr>
               <td>Quy mô công ty</td>
               <td>
                  <select class="form-control selectpicker" data-placeholder="Nhấn để chọn...">
                     <option selected="selected">Ít hơn 10 nhân viên</option>
                     <option>10 - 200 nhân viên</option>
                     <option>200 - 300 nhân viên</option>
                     <option>Hơn 300 nhân viên</option>
                  </select>
               </td>
            </tr>
            <tr>
               <td>Năm thành lập</td>
               <td><input type="text" class="form-control input-sm" placeholder="vd. 1996"></td>
            </tr>
            <tr>
               <td>Lĩnh vực công ty</td>
               <td><input type="text" class="form-control input-sm" value="Mạng và phần mềm"></td>
            </tr>
            <tr>
               <td>Loại công ty</td>
               <td>
                  <select class="form-control selectpicker" data-placeholder="Nhấn để chọn...">
                     <option>Việc làm Kế toán</option>
                     <option>Việc làm Ngân hàng</option>
                     <option selected="selected">Việc làm IT - Phần mềm</option>
                     <option>Việc làm IT-Phần cứng/Mạng</option>
                     <option>Việc làm Xây dựng</option>
                     <option>Việc làm Quảng cáo/Khuyến mãi</option>
                     <option>Việc làm Hàng không/Du lịch</option>
                     <option>Việc làm Giáo dục/Đào tạo</option>
                     <option>Việc làm Điện/Điện tử</option>
                     <option>Việc làm Bán hàng</option>
                  </select>
               </td>
            </tr>
            <tr>
               <td>Công ty có yêu cầu làm ngoài giờ không?</td>
               <td>
                  <select class="form-control selectpicker">
                     <option>Có</option>
                     <option>Không</option>
                  </select>
               </td>
            </tr>
            <tr>
               <td>Giới thiệu</td>
               <td>
                  <textarea class="form-control" rows="3">Google là một công ty Internet có trụ sở tại Hoa Kỳ, được thành lập vào năm 1998...</textarea>
               </td>
            </tr>
            <tr>
               <td>Tại sao bạn nên làm việc tại FPT?</td>
               <td>
                  <textarea class="form-control" rows="3">Mình thích thì mình làm thôi</textarea>
               </td>
            </tr>
            <tr>
               <td>TAG</td>
               <td>
                  <input class="tagsinput" type="text" name="tags" class="123input tm-input form-control tm-input-info tagsinput-typeahead" data-role="tagsinput" placeholder="Nhập tag" value="PHP, HTML" />
               </td>
            </tr>
         </tbody>
      </table>
   </div>
</div>
</div>
</section>

@endsection

@section('scripts')
<script src="https://twitter.github.io/typeahead.js/releases/latest/typeahead.bundle.js" type="text/javascript" charset="utf-8"></script>

<script type="text/javascript">
   var tagnames = new Bloodhound({
   datumTokenizer: Bloodhound.tokenizers.obj.whitespace("name"),
  queryTokenizer: Bloodhound.tokenizers.whitespace,
  prefetch: {
    url:'../../tags',
    filter: function(list) {
      return $.map(list, function(tagname) {
        return { name: tagname }; });
    }
  }
});

tagnames.initialize();

$('.tagsinput').tagsinput({
  typeaheadjs: {
    name: 'tags',
    displayKey: 'name',
    valueKey: 'name',
    source: tagnames.ttAdapter()
  }
});
</script>

@endsection
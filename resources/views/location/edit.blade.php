@extends('backend.layout')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Địa điểm   
    </h1>   
  </section>

  <!-- Main content -->
  <section class="content">
    <a class="btn btn-default btn-sm" href="{{ route('location.index') }}" style="margin-bottom:5px">Quay lại</a>
    <form role="form" method="POST" action="{{ route('location.update') }}" id="dataForm" class="productForm" enctype="multipart/form-data">
    <input type="hidden" name="id" value="{{ $detail->id }}">
    <div class="row">
      <!-- left column -->

      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Cập nhật</h3>
          </div>
          <!-- /.box-header -->               
            {!! csrf_field() !!}          
            <div class="box-body">
                @if (count($errors) > 0)
                  <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                  </div>
                @endif
                <div>
                <div class="form-group input-group">
                            <label>Danh mục</label>
                            <select class="form-control select2" name="cate_id" id="cate_id">
                              <option value="">--Chọn--</option>
                              @foreach($cateList as $cate)
                              <option value="{{ $cate->id }}" {{ old('cate_id', $detail->cate_id) == $cate->id ? "selected" : "" }}>{!! $cate->name !!}</option>
                              @endforeach
                            </select>
                            <span class="input-group-btn">
                              <button style="margin-top:30px" class="btn btn-primary btn-sm" id="btnAddTag" type="button" data-value="3">
                                Thêm mới
                              </button>
                            </span>
                          </div> 
                                                                                                   
                        <div class="form-group" >                  
                          <label>Tên địa điểm<span class="red-star">*</span></label>
                          <input type="text" class="form-control req" name="name" id="name" value="{{ old('name', $detail->name) }}">
                        </div>
                        <div class="form-group" style="display: none;">                  
                          <label>Slug <span class="red-star">*</span></label>                  
                          <input type="text" class="form-control req" readonly="readonly" name="slug" id="slug" value="{{ old('slug', $detail->slug) }}">
                        </div>
                 
                        <div class="form-group">
                            <label>Địa chỉ</label>
                            <input type="input" id="address" class="form-control" name="address" value="{{ old('address', $detail->address) }}">
                        </div> 
                        <div class="form-group">
                          <label>Số điện thoại </label>
                          <input type="text" class="form-control" name="phone" id="phone" value="{{ old('phone', $detail->phone) }}">
                          <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude', $detail->latitude) }}">
                        <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude', $detail->longitude) }}">
                        </div> 
                        <div class="form-group">
                          <label>ZALO</label>
                          <input type="text" class="form-control" name="zalo" id="zalo" value="{{ old('zalo', $detail->zalo) }}">
                        </div>
                          <div class="form-group">
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" name="ship" value="1" {{ old('ship', $detail->ship) == 1 ? "checked" : "" }}>
                              <span style="color:red">CÓ SHIP</span>
                            </label>
                          </div>               
                        </div>   
                        <div class="form-group">
                            <label>Giờ mở cửa </label>
                            <input type="text" class="form-control" name="time_opening" id="time_opening" value="{{ old('time_opening', $detail->time_opening) }}">
                          </div>
                          <div class="form-group">
                            <label>Người liên hệ </label>
                            <input type="text" class="form-control" name="contact_person" id="contact_person" value="{{ old('contact_person', $detail->contact_person) }}">
                          </div>
                        
                        <div class="form-group">
                           <div id='map_canvas'></div>
                           <div id="current" style="display: none;">Nothing yet...</div>
                        </div> 
                        
                       
                        <div class="form-group" style="margin-top:20px;margin-bottom:10px">  
                         
                          <div class="col-md-12" style="padding-left: 0px">
                            <input type="file" id="file-image" value="Chọn hình ảnh" multiple="true" name="images[]" style="display: none;" />
                 
                  
                            <button class="btn btn-danger" id="btnUploadImage" type="button"><span class="glyphicon glyphicon-upload" aria-hidden="true"></span> Upload hình ảnh</button> <span id="so_anh" style="font-weight: bold;font-size: 18px"></span>
                            <div class="clearfix"></div>
                            <div id="div-image" style="margin-top:10px">
                              @if(!empty($imageArr))                             
                              @foreach($imageArr as $img)
                              <div class="col-md-3 col-xs-4 divImg">
                                <img src="{{ Helper::showImageNew($img->image_url) }}" class="img-responsive">
                                <input type="hidden" name="imgOld[]" value="{{ $img->id }}">
                                 <button type="button" class="btn btn-sm btn-danger removeImg" data-id="{{ $img->id }}" value="Xóa">Xóa</button>
                              </div>
                              @endforeach
                              @endif
                            </div>
                          </div>
                          <div style="clear:both"></div>
                        </div>
                        <div class="form-group" style="margin-top:20px;margin-bottom:10px">  
                         
                          <div class="col-md-12" style="padding-left: 0px">
                            <input type="file" id="file-image2" value="Chọn hình ảnh" multiple="true" name="images2[]" style="display: none;" />
                 
                  
                            <button class="btn btn-danger" id="btnUploadImage2" type="button"><span class="glyphicon glyphicon-upload" aria-hidden="true"></span> Upload thực đơn/bảng giá</button> <span id="so_anh2" style="font-weight: bold;font-size: 18px"></span>
                            <div class="clearfix"></div>
                            <div id="div-image2" style="margin-top:10px">
                              @if(!empty($bgArr))
                              @foreach($bgArr as $img)
                              <div class="col-md-3 col-xs-4 divImg">
                                <img src="{{ Helper::showImageNew($img->image_url) }}" class="img-responsive">
                                <input type="hidden" name="bgOld[]" value="{{ $img->id }}">
                                <button type="button" class="btn btn-sm btn-danger removeImg" data-id="{{ $img->id }}" value="Xóa">Xóa</button>
                              </div>
                              @endforeach
                              @endif
                            </div>
                          </div>
                          <div style="clear:both"></div>
                        </div>
                        <!-- <div class="form-group" style="margin-top:10px;margin-bottom:10px;display: none">  
                          <label class="col-md-3 row">Banner ( 1350x500 px)</label>    
                          <div class="col-md-9">
                            <img id="thumbnail_banner" src="{{ old('banner_url') ? Helper::showImage(old('banner_url')) : asset('admin/dist/img/img.png') }}" class="img-thumbnail" width="300">                    
                            <button class="btn btn-default btn-sm btnSingleUpload" data-set="banner_url" data-image="thumbnail_banner" type="button"><span class="glyphicon glyphicon-upload" aria-hidden="true"></span> Upload</button>
                            <input type="hidden" name="banner_url" id="banner_url" value="{{ old('banner_url') }}"/>
                          </div>
                          <div style="clear:both"></div>
                        </div>                    -->
                        <!-- <div class="form-group" style="margin-top: 15px !important;">
                          <label>Giới thiệu</label>
                          <button class="btnUploadEditor btn btn-info" type="button" style="float:right;margin-bottom: 3px !important;" data-editor="description">Chèn ảnh</button>
                          <div class="clearfix"></div>
                          <textarea class="form-control" rows="4" name="description" id="description">{{ old('description') }}</textarea>
                        </div>       -->                                 
                        
                       <!--  <div class="form-group">
                            <label>Email </label>
                            <input type="text" class="form-control" name="email" id="email" value="{{ old('email') }}">
                          </div>
                          <div class="form-group">
                            <label>Website </label>
                            <input type="text" class="form-control" name="website" id="website" value="{{ old('website') }}">
                          </div> -->
                         <!--   <div class="form-group">
                          <label>Meta title </label>
                          <input type="text" class="form-control" name="meta_title" id="meta_title" value="{{ old('meta_title') }}">
                        </div>
                        <div class="form-group">
                          <label>Meta desciption</label>
                          <textarea class="form-control" rows="6" name="meta_desc" id="meta_desc">{{ old('meta_desc') }}</textarea>
                        </div>   
                        <div class="form-group">
                          <label>Meta keywords</label>
                          <textarea class="form-control" rows="6" name="meta_keywords" id="meta_keywords">{{ old('meta_keywords') }}</textarea>
                        </div>  -->
                       
                </div>
                  
            </div>
            <div class="box-footer">              
              <button type="button" class="btn btn-default" id="btnLoading" style="display:none"><i class="fa fa-spin fa-spinner"></i></button>
              <button type="submit" class="btn btn-primary" id="btnSave">Lưu</button>
              <a class="btn btn-default" class="btn btn-primary" href="{{ route('location.index')}}">Hủy</a>
            </div>
            
        </div>
        <!-- /.box -->     

      </div>      
    </form>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<input type="hidden" id="route_upload_tmp_image_multiple" value="{{ route('image.tmp-upload-multiple') }}">
<input type="hidden" id="route_upload_tmp_image" value="{{ route('image.tmp-upload') }}">
<style type="text/css">
  .nav-tabs>li.active>a{
    color:#FFF !important;
    background-color: #444345 !important;
  }
  .error{
    border : 1px solid red;
  }
  .select2-container--default .select2-selection--single{
    height: 35px !important;
  }
  .select2-container--default .select2-selection--multiple .select2-selection__choice{
    color: red !important;    
    font-size: 20px !important; 
  }
  .select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover{
    color: red !important;
    
    font-size:20px !important;
  }
  .select2-container--default .select2-selection--multiple .select2-selection__rendered{
    font-size:20px !important;
  }
  #map_canvas {
    width: 100%;
    height: 300px;
}
#current {
    padding-top: 25px;
}
</style>

<div id="tagTag" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
    <form method="POST" action="{{ route('cate.ajax-save')}}" id="formAjaxTag">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add new danh mục</h4>
      </div>
      <div class="modal-body" id="contentTag">
          <input type="hidden" name="type" value="1">
           <!-- text input -->
          <div class="col-md-12">
            <div class="form-group">
              <label>Tên danh mục<span class="red-star">*</span></label>
              <input type="text" class="form-control" id="add_address" value="" name="str_tag"></textarea>
            </div>
            
          </div>
          <div classs="clearfix"></div>
      </div>
      <div style="clear:both"></div>
      <div class="modal-footer" style="text-align:center">
        <button type="button" class="btn btn-primary btn-sm" id="btnSaveTagAjax"> Save</button>
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal" id="btnCloseModalTag">Close</button>
      </div>
      </form>
    </div>

  </div>
</div>
@stop
@section('javascript_page')
<script async="false"
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAo-7CTx8EZK3gke_d683kHeimJFfphAcQ&callback=initMap&libraries=&v=weekly"
      defer
    ></script>
<script type="text/javascript">
  $(document).on('click', '#btnSaveTagAjax', function(){
    $(this).attr('disabled', 'disabled');
      $.ajax({
        url : $('#formAjaxTag').attr('action'),
        data: $('#formAjaxTag').serialize(),
        type : "post", 
        success : function(str_id){          
          $('#btnCloseModalTag').click();
          $.ajax({
            url : "{{ route('cate.ajax-list') }}",
            data: {
              str_id : str_id
            },
            type : "get", 
            success : function(data){
                $('#cate_id').html(data);
                $('#cate_id').select2('refresh');
                
            }
          });
        }
      });
   });
function initMap(){
  var latt = '{{ $detail->latitude ?? "35.137879" }}';
  var longtt = '{{ $detail->longitude ?? "-82.836914" }}';
  
    var map = new google.maps.Map(document.getElementById('map_canvas'), {
        zoom: 19,
        center: new google.maps.LatLng(latt, longtt),
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var myMarker = new google.maps.Marker({
        position: new google.maps.LatLng(latt, longtt),
        draggable: true
    });

    google.maps.event.addListener(myMarker, 'dragend', function (evt) {
    
      document.getElementById('latitude').value = evt.latLng.lat();
      document.getElementById('longitude').value = evt.latLng.lng();
       
    });

    google.maps.event.addListener(myMarker, 'dragstart', function (evt) {
        document.getElementById('current').innerHTML = '<p>Currently dragging marker...</p>';
    });

    map.setCenter(myMarker.position);
    myMarker.setMap(map);

 
   
}
    $(document).ready(function(){
      $('.removeImg').click(function(){
        if(confirm('Bạn muốn xóa hình này?')){
          $(this).parents('.divImg').remove();
          var imgId = $(this).data('id');
          $.ajax({
            url: '{{ route('location.delete-img')}}?id=' + imgId,
            type: "GET",           
          });
        }        
      });
      $('#btnUploadImage').click(function(){        
        $('#file-image').click();
      }); 
      $('#btnUploadImage2').click(function(){        
        $('#file-image2').click();
      });    
      $('#file-image').change(function(e){ 
        var so_anh = e.target.files.length;
        if(so_anh > 0){
          $('#so_anh').html('[Đã chọn '+ so_anh +' ảnh]');         
        }        
      });
      $('#file-image2').change(function(e){ 
        var so_anh2 = e.target.files.length;
        if(so_anh2 > 0){
          $('#so_anh2').html('[Đã chọn '+ so_anh2 +' ảnh]');         
        }        
      });
      $('#btnAddTag').click(function(){
          $('#tagTag').modal('show');
      });  
    
      /* 
      $('#file-image').change(function(e){
       // $('#thumbnail_image').attr('src', "{{ URL::asset('admin/dist/img/loading.gif') }}");
         files = e.target.files;
         
         if(files != ''){
           var dataForm = new FormData();        
          $.each(files, function(key, value) {
             dataForm.append('file', value);
          });   
          console.log(dataForm);
          dataForm.append('date_dir', 1);
          dataForm.append('folder', 'tmp');

          $.ajax({
            url: $('#route_upload_tmp_image').val(),
            type: "POST",
            async: false,      
            data: dataForm,
            processData: false,
            contentType: false,
            beforeSend : function(){
              $('#thumbnail_image').attr('src', "{{ URL::asset('admin/dist/img/loading.gif') }}");
            },
            success: function (response) {
              if(response.image_path){
                $('#thumbnail_image').attr('src',$('#upload_url').val() + response.image_path);
                $( '#image_url' ).val( response.image_path );
                $( '#image_name' ).val( response.image_name );
              }
              console.log(response.image_path);
                //window.location.reload();
            },
            error: function(response){                             
                var errors = response.responseJSON;
                for (var key in errors) {
                  
                }
                //$('#btnLoading').hide();
                //$('#btnSave').show();
            }
          });
        }
      });
      
      */
       $(".select2").select2();
      $('#parent_id').change(function(){
        location.href="{{ route('location.create') }}?parent_id=" + $(this).val();
      })
      
      $('#dataForm').submit(function(){        
        $('#btnSave').hide();
        $('#btnLoading').show();
      });  
    });
    
</script>

@stop

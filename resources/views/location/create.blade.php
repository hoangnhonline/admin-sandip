@extends('layout')
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
    <form role="form" method="POST" action="{{ route('location.store') }}" id="dataForm" class="productForm" enctype="multipart/form-data">
    <input type="hidden" name="is_copy" value="1">
    <div class="row">
      <!-- left column -->

      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Thêm mới</h3>
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
              
                                                                                                   
                        <div class="form-group" >                  
                          <label>Tên địa điểm<span class="red-star">*</span></label>
                          <input type="text" class="form-control req" name="name" id="name" value="{{ old('name') }}">
                        </div>
                        <input type="text" name="latitude" id="latitude" value="">
                        <input type="text" name="longitude" id="longitude" value="">
                     
                        <div class="form-group">
                           <div id='map_canvas'></div>
                           <div id="current" style="display: none;">Nothing yet...</div>
                        </div> 
                        
                     
                      
                       
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

@stop
@section('javascript_page')
<script async="false"
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAo-7CTx8EZK3gke_d683kHeimJFfphAcQ&callback=initMap&libraries=&v=weekly"
      defer
    ></script>
<script type="text/javascript">
  
function initMap(){
  var latt = 35.137879;
  var longtt = -82.836914;
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function showLocation(position) {
    latt = position.coords.latitude;
    longtt = position.coords.longitude;
    document.getElementById('latitude').value = latt;
    document.getElementById('longitude').value = longtt;
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
});
  } else { 
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
   
}
    $(document).ready(function(){
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

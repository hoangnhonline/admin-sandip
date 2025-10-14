@extends('layout')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Banner <span style="color:red">{{ $detail->name }}</span>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{ route('banner.index', ['object_id' => $object_id, 'object_type' => $object_type]) }}">banner</a></li>
      <li class="active">Add new</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <a class="btn btn-default btn-sm " href="{{ route('banner.index', ['object_id' => $object_id, 'object_type' => $object_type]) }}" style="margin-bottom:5px">Quay lại</a>
    
    <form role="form" method="POST" action="{{ route('banner.store') }}">
    <div class="row">
      <!-- left column -->

      <div class="col-md-8">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Add new</h3>
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
              <div class="form-group">
                  <label>Thứ tự hiển thị</label>
                  <input type="text" name="display_order" id="display_order" class="form-control" value="{{ old('display_order') }}">
                </div>    
              @if($object_type == 3 && $object_id == 1)
                <div class="form-group" style="display: none;">
                  <label>Tiêu đề</label>
                  <input type="text" name="title" class="form-control" value="{{ old('title') }}">
                </div>          
                <div class="form-group" style="display: none;">
                  <label>Mô tả</label>
                  <input type="text" name="description" class="form-control" value="{{ old('description') }}">
                </div> 
                <div class="form-group" style="display: none;">
                  <label>Button text</label>
                  <input type="text" name="button_text" class="form-control" value="{{ old('button_text') }}">
                </div> 
                <div class="form-group" style="display: none;">
                  <label>Button link</label>
                  <input type="text" name="button_link" class="form-control" value="{{ old('button_link') }}">
                </div>          
                @endif
                 <div class="form-group" style="margin-top:10px;margin-bottom:10px">  
                  <label class="col-md-3 row">Banner <?php 
                  if($object_type == 1){
                    echo "( 500 x 280 px)";
                  }else{
                    if($object_id == 1){
                      echo "( 1950 x 700 px)";
                    }elseif($object_id == 5){
                      echo "( 1950 x 700 px)";
                    }
                  }
                  
                  ?></label>    
                  <div class="col-md-9">
                    <img id="thumbnail_image" src="{{ old('image_url') ? Helper::showImage(old('image_url')) : asset('admin/dist/img/img.png') }}" class="img-thumbnail" width="145" height="85">
                    
                    <input type="file" id="file-image" style="display:none" />
                 
                    <button class="btn btn-default btn-sm" id="btnUploadImage" type="button"><span class="glyphicon glyphicon-upload" aria-hidden="true"></span> Upload</button>
                  </div>
                  <div style="clear:both"></div>
                </div>   
                               
                <input type="hidden" name="status" value="1">     
                <!-- textarea -->
                <div class="form-group">
                  <label>Loại banner</label>
                  <select name="type" class="form-control" id="type">
                  	<option value="1" {{ old('type') == 1  ? "selected" : "" }}>Không liên kết</option>
                  	<option value="2" {{ old('type') == 2 ? "selected" : "" }}>Có liên kết</option>
                  </select>
                </div>  
                <div class="form-group" id="div_lk" style="display:none">
                  <label>Liên kết</label>
                  <input type="text" name="link" id="link" value="{{ old('link') }}" class="form-control">
                </div>  
                <input type="hidden" name="image_url" id="image_url" value="{{ old('image_url') }}"/>         
            	
                <input type="hidden" name="object_id" value="{{ $object_id }}">
                <input type="hidden" name="object_type" value="{{ $object_type }}">
            </div>                        
            <div class="box-footer">
              <button type="submit" class="btn btn-primary btn-sm">Lưu</button>
              <a class="btn btn-default btn-sm" class="btn btn-primary btn-sm" href="{{ route('banner.index', ['object_id' => $object_id, 'object_type' => $object_type])}}">Hủy</a>
            </div>
            
        </div>
        <!-- /.box -->     

      </div>
      <div class="col-md-4"></div>
      <!--/.col (left) -->      
    </div>
    </form>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<input type="hidden" id="route_upload_tmp_image" value="{{ route('image.tmp-upload') }}">
@stop
@section('js')
<script type="text/javascript">
var h = screen.height;
var w = screen.width;
var left = (screen.width/2)-((w-300)/2);
var top = (screen.height/2)-((h-100)/2);
function openKCFinder_singleFile() {
      window.KCFinder = {};
      window.KCFinder.callBack = function(url) {
         $('#image_url').val(url);
         $('#thumbnail_image').attr('src', $('#app_url').val() + url);
          window.KCFinder = null;
      };
      window.open('{{ asset("admin/dist/js/kcfinder/browse.php?type=images") }}', 'kcfinder_single','scrollbars=1,menubar=no,width='+ (w-300) +',height=' + (h-300) +',top=' + top+',left=' + left);
  }
    $(document).ready(function(){
      
      $('#btnUploadImage').click(function(){        
        //$('#file-image').click();
        openKCFinder_singleFile();
      });      
      var files = "";
      $('#file-image').change(function(e){
         files = e.target.files;
         
         if(files != ''){
           var dataForm = new FormData();        
          $.each(files, function(key, value) {
             dataForm.append('file', value);
          });   
          
          dataForm.append('date_dir', 1);
          dataForm.append('folder', 'tmp');

          $.ajax({
            url: $('#route_upload_tmp_image').val(),
            type: "POST",
            async: false,      
            data: dataForm,
            processData: false,
            contentType: false,
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
      
      var type = $('#type').val();
      checkType( type );

      $('#type').change(function(){
      	checkType( $(this).val() );
      });
      
     
    });
    function checkType( type ){
    	if( type == 1){
    		$('#div_lk').hide();
    	}else{
    		$('#div_lk').show();
    	}
    }
</script>
@stop
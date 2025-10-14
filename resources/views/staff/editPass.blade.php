@extends('layout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Đặt lại mật khẩu cho nhân viên: <span style="color:#e8a23e">{{ $detail->name }}</span>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route( 'dashboard' ) }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ route('staff.index') }}">Nhân viên</a></li>
            <li class="active">Cập nhật</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <a class="btn btn-default btn-sm" href="{{ route('staff.index') }}" style="margin-bottom:5px">Quay lại</a>
        <form role="form" method="GET" action="{{ route('resetPass') }}" id="dataForm">
            <div class="row">
                <!-- left column -->
                <input name="id" value="{{ $detail->id }}" type="hidden">
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            Đặt lại mật khẩu
                        </div>
                        <!-- /.box-header -->
                        {!! csrf_field() !!}

                        <div class="box-body">
                            @if(Session::has('message'))
                            <p class="alert alert-info">{{ Session::get('message') }}</p>
                            @endif
                            @if (count($errors) > 0)
                            <div class="alerts alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                            <div class="form-group">
                                <label>Mật khẩu mới</label>
                                <input type="text" class="form-control" name="pass" id="pass"
                                    value="{{ old('pass') }}">
                            </div>
                            

                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary btn-sm">Lưu</button>
                            <a class="btn btn-default btn-sm" class="btn btn-primary btn-sm"
                                href="{{ route('staff.index')}}">Hủy</a>
                        </div>

                    </div>
                    <!-- /.box -->

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
  $(document).ready(function(){
    $('#btnUploadImage').click(function(){        
        $('#file-image').click();
      });      
      var files = "";
      $('#file-image').change(function(e){
        $('#thumbnail_image').attr('src', "{{ URL::asset('admin/dist/img/loading.gif') }}");
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
  });
</script>
@stop

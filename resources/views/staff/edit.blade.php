@extends('layout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Nhân viên: <span style="color:#e8a23e">{{ $detail->name }}</span>
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
        <form role="form" method="POST" action="{{ route('staff.update') }}" id="dataForm">
            <div class="row">
                <!-- left column -->
                <input name="id" value="{{ $detail->id }}" type="hidden">
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            Chỉnh sửa
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
                                <label>Bộ phận</label>
                                <select class="form-control" name="department_id" id="department_id">
                                    @foreach($departmentList as $department)
                                    <option value="{{ $department->id }}"
                                        {{ old('department_id',$detail->department_id ) == $department->id  ? "selected" : "" }}>
                                        {{ $department->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Chi nhánh</label>
                                <select class="form-control" name="city_id" id="city_id">
                                    <option value="1" {{ old('city_id',$detail->city_id ) == 1  ? "selected" : "" }}>Phú Quốc</option>
                                    <option value="2" {{ old('city_id',$detail->city_id ) == 2  ? "selected" : "" }}>Đà Nẵng</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Họ tên</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    value="{{ old('name',$detail->name) }}">
                            </div>
                            <div class="form-group">
                                <label>Số điện thoại</label>
                                <input type="text" class="form-control" name="phone" id="phone"
                                    value="{{ old('phone',$detail->phone) }}">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" id="email"
                                    value="{{ old('email',$detail->email) }}">
                            </div>
                            <div class="form-group">
                                <label>Ngày sinh (d/m/y)</label>
                                <input type="text" class="form-control datepicker" name="birthday" id="birthday"
                                    value="{{ date('d/m/Y', strtotime($detail->birthday)) }}" autocomplete="off">
                            </div>
                            <div class="form-group col-md-12" style="margin-top:10px;margin-bottom:10px">
                                <label class="col-md-3 row">Hình ảnh </label>
                                <div class="col-md-9">
                                  <img id="thumbnail_image" src="{{ old('image_url', $detail->image_url) ? Helper::showImageNew(old('image_url', $detail->image_url)) : URL::asset('admin/dist/img/img.png') }}" class="img-thumbnail" width="145" height="85">

                                  <input type="file" id="file-image" style="display:none" />

                                  <button class="btn btn-default" id="btnUploadImage" type="button"><span class="glyphicon glyphicon-upload" aria-hidden="true"></span> Upload</button>
                                </div>
                                <div style="clear:both"></div>
                                <input type="hidden" name="image_url" id="image_url" value="{{ old('image_url', $detail->image_url) }}"/>
                                <input type="hidden" name="image_name" id="image_name" value="{{ old('image_name') }}"/>
                              </div>


                            <div class="form-group">
                                <label style="font-weight: bold; color: red">
                                    <input type="checkbox" id="is_leader" name="is_leader" value="1"
                                        {{ $detail->is_leader == 1 ? "checked" : "" }}>
                                    LEADER
                                </label>
                            </div>

                            <div class="form-group">
                                <label style="font-weight: bold; color: red">
                                    <input type="checkbox" id="is_partner" name="is_partner" value="1" {{ $detail->is_partner == 1 ? "checked" : "" }}>
                                    PARTNER
                                </label>
                            </div>

                            <div class="form-group">
                                <label>Ngày gia nhập</label>
                                <input type="text" class="form-control datepicker" name="date_join" id="date_join"
                                    value="{{ date('d/m/Y', strtotime($detail->date_join)) }}" autocomplete="off">

                            </div>
                            <div class="form-group">
                                <label>Lương</label>
                                <input type="text" class="form-control" name="salary" id="salary"
                                    value="{{ old('salary', number_format($detail->salary)) }}">
                            </div>

                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" name="status" id="status">
                                    <option value="2" {{ $detail->status == 2 ? "selected" : "" }}>Khóa</option>
                                    <option value="1" {{ $detail->status == 1 ? "selected" : "" }}>Mở</option>
                                </select>
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

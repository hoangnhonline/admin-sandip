@extends('layout')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Tài xế
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{ route('drivers.index') }}">Tài xế</a></li>
      <li class="active">Cập nhật</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <a class="btn btn-default btn-sm" href="{{ route('drivers.index') }}" style="margin-bottom:5px">Quay lại</a>
    <form role="form" method="POST" action="{{ route('drivers.update') }}" id="dataForm">
      <input type="hidden" name="id" value="{{ $detail->id }}">
    <div class="row">
      <!-- left column -->

      <div class="col-md-7">
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
                <div class="form-group">
                  <label for="type">Loại xe</label>
                  <select class="form-control select2" name="car_cate_id" id="car_cate_id">
                    <option value="">--Chọn--</option>
                    @foreach($carCateList as $cate)
                    <option value="{{ $cate->id }}" {{ old('car_cate_id', $detail->car_cate_id) == $cate->id ? "selected" : "" }}>{{ $cate->name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="type">Thành phố</label>
                  <select class="form-control select2" name="city_id" id="city_id">
                    <option value="1" {{ old('city_id' ,$detail->city_id) == 1 ? "selected" : "" }}>Phú Quốc</option>
                    <option value="2" {{ old('city_id' ,$detail->city_id) == 2 ? "selected" : "" }}>Đà Nẵng</option>
                  </select>
                </div>
                 <!-- text input -->
                <div class="form-group">
                  <label>Tên tài xế <span class="red-star">*</span></label>
                  <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $detail->name) }}">
                </div>
                <div class="form-group">
                  <label>Số điện thoại<span class="red-star">*</span></label>
                  <input type="text" class="form-control" name="phone" id="phone" value="{{ old('phone', $detail->phone) }}">
                </div>                 
                                            
            </div>                        
            <div class="box-footer">
              <button type="submit" class="btn btn-primary btn-sm">Lưu</button>
              <a class="btn btn-default btn-sm" class="btn btn-primary btn-sm" href="{{ route('drivers.index')}}">Hủy</a>
            </div>
            
        </div>
        <!-- /.box -->     

      </div>
      <div class="col-md-5">
              
        </div>
        <!-- /.box -->     

      </div>
      <!--/.col (left) -->      
    </div>
    </form>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>

@stop
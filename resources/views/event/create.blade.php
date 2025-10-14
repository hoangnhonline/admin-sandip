@extends('layout')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Sự kiện
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{ route('event.index') }}">Sự kiện</a></li>
      <li class="active">Add new</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <a class="btn btn-default btn-sm" href="{{ route('event.index', ['cate_id' => $cate_id]) }}" style="margin-bottom:5px">Quay lại</a>
    <form role="form" method="POST" action="{{ route('event.store') }}" id="dataForm">
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
                <label for="email">Danh mục </label>
                <select class="form-control" name="cate_id" id="cate_id">
                  <option value="">--Chọn--</option>
                  @if( $cateList->count() > 0)
                    @foreach( $cateList as $value )
                    <option value="{{ $value->id }}" {{ $value->id == $cate_id ? "selected" : "" }}>{{ $value->name }}</option>
                    @endforeach
                  @endif
                </select>
              </div>
              <div class="form-group">
                  <label for="email">Tỉnh/Thành </label>
                  <select class="form-control select2" name="city_id" id="city_id">
                    <option value="">--Chọn--</option>
                    @if( $cityList->count() > 0)
                      @foreach( $cityList as $value )
                      <option value="{{ $value->id }}" {{ $value->id == old('city_id') ? "selected" : "" }}>{{ $value->name }}</option>
                      @endforeach
                    @endif
                  </select>
                </div>
                <div class="form-group" >
                  
                  <label>Tên <span class="red-star">*</span></label>
                  <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
                </div>
                <span class=""></span>
                <div class="form-group">                  
                  <label>Slug <span class="red-star">*</span></label>                  
                  <input type="text" class="form-control"  readonly="readonly" name="slug" id="slug" value="{{ old('slug') }}">
                </div>
                <div class="form-group" >
                  
                  <label>Địa điểm</label>
                  <input type="text" class="form-control" name="address" id="address" value="{{ old('address') }}">
                </div>
                <div class="row">
                <div class="form-group col-md-6" >            
                  <label>Ngày bắt đầu</label>
                  <input type="text" class="form-control datepicker" name="start_date" id="start_date" value="{{ old('start_date') }}">
                </div>
                <div class="form-group col-md-6" >                  
                  <label>Ngày kết thúc</label>
                  <input type="text" class="form-control datepicker" name="end_date" id="end_date" value="{{ old('end_date') }}">
                </div>
              </div>
                <div class="form-group" >
                  
                  <label>URL</label>
                  <input type="text" class="form-control" name="website" id="website" value="{{ old('website') }}">
                </div>
                <div class="form-group" style="margin-top:10px;margin-bottom:10px">  
                  <label class="col-md-3 row">Thumbnail ( 245x150 px)</label>    
                  <div class="col-md-9">
                    <img id="thumbnail_image" src="{{ old('image_url') ? Helper::showImage(old('image_url')) : asset('admin/dist/img/img.png') }}" class="img-thumbnail" width="145" height="85">                    
                    <button class="btn btn-default btn-sm btnSingleUpload" data-set="image_url" data-image="thumbnail_image" type="button"><span class="glyphicon glyphicon-upload" aria-hidden="true"></span> Upload</button>
                    <input type="hidden" name="image_url" id="image_url" value="{{ old('image_url') }}"/>
                  </div>
                  <div style="clear:both"></div>
                </div>
                <div style="clear:both"></div>              
          
                <div class="form-group">
                  <label>Mô tả</label>
                  <textarea class="form-control" rows="6" name="description" id="description">{{ old('description') }}</textarea>
                </div>
               
                <div class="form-group">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="is_hot" value="1" {{ old('is_hot') == 1 ? "checked" : "" }}>
                      Sự kiện nổi bật
                    </label>
                  </div>               
                </div>
                <div class="form-group">
                  <label>Ẩn/hiện</label>
                  <select class="form-control" name="status" id="status">                  
                    <option value="0" {{ old('status') == 0 ? "selected" : "" }}>Ẩn</option>
                    <option value="1" {{ old('status') == 1 || old('status') == NULL ? "selected" : "" }}>Hiện</option>                  
                  </select>
                </div>

                              
                <div class="form-group">
                  <label>Chi tiết</label>
                  <textarea class="form-control" rows="4" class="editor" name="content" id="content">{{ old('content') }}</textarea>
                </div>
                <input type="hidden" id="editor" value="content">
                  
            </div>          
                              
            <div class="box-footer">
              <button type="submit" class="btn btn-primary btn-sm">Lưu</button>
              <a class="btn btn-default btn-sm" class="btn btn-primary btn-sm" href="{{ route('event.index', ['cate_id' => $cate_id])}}">Hủy</a>
            </div>
            
        </div>
        <!-- /.box -->     

      </div>
      <div class="col-md-4">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Thông tin SEO</h3>
          </div>
          <!-- /.box-header -->
            <div class="box-body">
              <div class="form-group">
                <label>Meta title </label>
                <input type="text" class="form-control" name="meta_title" id="meta_title" value="{{ old('meta_title') }}">
              </div>
              <!-- textarea -->
              <div class="form-group">
                <label>Meta desciption</label>
                <textarea class="form-control" rows="4" name="meta_description" id="meta_description">{{ old('meta_description') }}</textarea>
              </div>  

              <div class="form-group">
                <label>Meta keywords</label>
                <textarea class="form-control" rows="4" name="meta_keywords" id="meta_keywords">{{ old('meta_keywords') }}</textarea>
              </div>  
              <div class="form-group">
                <label>Custom text</label>
                <textarea class="form-control" rows="4" name="custom_text" id="custom_text">{{ old('custom_text') }}</textarea>
              </div>
            
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
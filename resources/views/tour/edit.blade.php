@extends('layout')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Tour 
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{ route('w-articles.index') }}">Tour</a></li>
      <li class="active">Cập nhật</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <a class="btn btn-default btn-sm" href="{{ route('w-articles.index') }}" style="margin-bottom:5px">Quay lại</a>
    <form role="form" method="POST" action="{{ route('tour.update') }}" id="dataForm" class="productForm">
    <input type="hidden" name="id" value="{{ $detail->id }}">    
    <div class="row">
      <!-- left column -->

      <div class="col-md-8">
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

                  <!-- Nav tabs -->
                  <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Thông tin chi tiết</a></li>                                          
                    <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Hình ảnh</a></li>                    
                  </ul>

                  <!-- Tab panes -->
                  <div class="tab-content">
                   
                    <div role="tabpanel" class="tab-pane active" id="home">                         
                      <input type="hidden" name="type" value="1">                                                                                       
                        <div class="form-group" >                  
                          <label>Tên tour <span class="red-star">*</span></label>
                          <input type="text" class="form-control req" name="name" id="name" value="{{ old('name', $detail->name) }}">
                        </div>
                        <div class="form-group">                  
                          <label>Slug <span class="red-star">*</span></label>                  
                          <input type="text" class="form-control req" readonly="readonly" name="slug" id="slug" value="{{ old('slug', $detail->slug) }}">
                        </div>
                        <div class="form-group" >                  
                          <label>Video Youtube ID<span class="red-star">*</span></label>
                          <input type="text" class="form-control req" name="video_id" id="video_id" value="{{ old('video_id', $detail->video_id) }}">
                        </div>
                        <div class="form-group" >                  
                          <label>Khu vực<span class="red-star">*</span></label>
                          <input type="text" class="form-control req" name="khu_vuc" id="khu_vuc" value="{{ old('khu_vuc', $detail->khu_vuc) }}">
                        </div>
                        <div class="form-group" style="margin: 20px 0 20px 0">
                          @foreach($objectsList as $obj)
                          <div class="col-md-3">
                            <label>
                              <input type="checkbox" {{ in_array($obj->id, old('objects_id', $objectSelected)) ? "checked" : "" }} name="objects_id[]" value="{{ $obj->id }}">
                              {{ $obj->name }}
                            </label>
                          </div>
                          @endforeach
                        </div>
                        <div class="form-group" style="margin-top:15px;">                  
                          <label>Phân loại trẻ em <span class="red-star">*</span></label>                  
                          <select class="form-control" name="children_type" id="children_type">
                            <option value="1" {{ old('children_type', $detail->children_type) == 1 ? "selected" : "" }}>Theo độ tuổi</option>
                            <option value="2" {{ old('children_type', $detail->children_type) == 2 ? "selected" : "" }} >Theo chiều cao</option>
                          </select>
                        </div>
                        <div class="row">
                          <div class="col-md-4 form-group">
                            <label>Giá người lớn <span class="red-star">*</span></label>
                            <input type="text" class="form-control req number" maxlength="11" name="price_adult" id="price_adult" value="{{ old('price_adult', $detail->price_adult) }}">
                          </div> 
                          <div class="col-md-4 form-group">
                            <label>Giá trẻ em <span class="red-star">*</span></label>
                            <input type="text" class="form-control req number" maxlength="11" name="price_child" id="price_child" value="{{ old('price_child', $detail->price_child) }}">
                          </div>  
                          <div class="col-md-4 form-group">
                            <label>Giá con nít<span class="red-star">*</span></label>
                            <input type="text" class="form-control req number" maxlength="11" name="price_infant" id="price_infant" value="{{ old('price_infant', $detail->price_infant) }}">
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" name="is_hot" value="1" {{ old('is_hot', $detail->is_hot) == 1 ? "checked" : "" }}>
                              <span style="color:red">NỔI BẬT</span>
                            </label>
                          </div>               
                        </div>    
                        <div class="form-group" style="margin-top:10px;margin-bottom:10px">  
                          <label class="col-md-3 row">Banner ( 1350x500 px)</label>    
                          <div class="col-md-9">                           
                            <img id="thumbnail_banner" src="{{ $detail->banner_url ? Helper::showImage($detail->banner_url ) : asset('admin/dist/img/img.png') }}" class="img-thumbnail" width="300">                    
                            <button class="btn btn-default btn-sm btnSingleUpload" data-set="banner_url" data-image="thumbnail_banner" type="button"><span class="glyphicon glyphicon-upload" aria-hidden="true"></span> Upload</button>
                            <input type="hidden" name="banner_url" id="banner_url" value="{{ old('banner_url', $detail->banner_url) }}"/>
                          </div>
                          <div style="clear:both"></div>
                        </div>                   
                        <div class="form-group" style="margin-top: 15px !important;">
                          <label>Mô tả ngắn</label>
                          <button class="btnUploadEditor btn btn-info" type="button" style="float:right;margin-bottom: 3px !important;" data-editor="description">Chèn ảnh</button>
                          <div class="clearfix"></div>
                          <textarea class="form-control" rows="4" name="description" id="description">{{ old('description', $detail->description) }}</textarea>
                        </div>                                       
                        <div class="form-group" style="margin-top: 15px !important;">
                          <label>Chi tiết</label>
                          <button class="btnUploadEditor btn btn-info" type="button" style="float:right;margin-bottom: 3px !important;" data-editor="content">Chèn ảnh</button>
                          <div class="clearfix"></div>
                          <textarea class="form-control" rows="4" name="content" id="content">{{ old('content', $detail->content) }}</textarea>
                        </div>
                        
                        <div style="margin-bottom:10px;clear:both"></div>
                        <div class="clearfix"></div>
                    </div><!--end thong tin co ban-->                    
                    <input type="hidden" id="editor" value="">                     
                     <div role="tabpanel" class="tab-pane" id="settings">
                        <div class="form-group" style="margin-top:10px;margin-bottom:10px">  
                         
                          <div class="col-md-12" style="text-align:center">                            
                            
                            <input type="file" id="file-image"  style="display:none" multiple/>
                         
                            <button class="btn btn-primary btnMultiUpload" type="button"><span class="glyphicon glyphicon-upload" aria-hidden="true"></span> Upload</button>
                            <div class="clearfix"></div>
                            <div id="div-image" style="margin-top:10px">                              
                              @if( $detail->images->count() > 0 )
                                @foreach( $detail->images as $k => $hinh)
                                  <div class="col-md-3">
                                    <img class="img-thumbnail" src="{{ Helper::showImage($hinh->image_url) }}" style="width:100%">
                                    <div class="checkbox">                                   
                                      <label><input type="radio" name="thumbnail_id" class="thumb" value="{{ $hinh->id }}" {{ $detail->thumbnail_id == $hinh->id ? "checked" : "" }}> Ảnh đại diện </label>
                                      <button class="btn btn-danger btn-sm remove-image" type="button" data-value="{{  $hinh->image_url }}" data-id="{{ $hinh->id }}" >Xóa</button>
                                    </div>
                                    <input type="hidden" name="image_id[]" value="{{ $hinh->id }}">
                                  </div>
                                @endforeach
                              @endif

                            </div>
                          </div>
                          <div style="clear:both"></div>
                        </div>

                     </div><!--end hinh anh-->                
                  </div>

                </div>
                  
            </div>
            <div class="box-footer">              
              <button type="button" class="btn btn-default" id="btnLoading" style="display:none"><i class="fa fa-spin fa-spinner"></i></button>
              <button type="submit" class="btn btn-primary" id="btnSave">Lưu</button>
              <a class="btn btn-default" class="btn btn-primary" href="{{ route('w-articles.index')}}">Hủy</a>
            </div>
            
        </div>
        <!-- /.box -->     

      </div>
      <div class="col-md-4">      
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Thông tin SEO</h3>
          </div>          
            <div class="box-body">
              <input type="hidden" name="meta_id" value="{{ $detail->meta_id }}">
              <div class="form-group">
                <label>Meta title </label>
                <input type="text" class="form-control" name="meta_title" id="meta_title" value="{{ !empty((array)$meta) ? $meta->title : "" }}">
              </div>
              <!-- textarea -->
              <div class="form-group">
                <label>Meta desciption</label>
                <textarea class="form-control" rows="6" name="meta_description" id="meta_description">{{ !empty((array)$meta) ? $meta->description : "" }}</textarea>
              </div>  

              <div class="form-group">
                <label>Meta keywords</label>
                <textarea class="form-control" rows="4" name="meta_keywords" id="meta_keywords">{{ !empty((array)$meta) ? $meta->keywords : "" }}</textarea>
              </div>  
              <div class="form-group">
                <label>Custom text</label>
                <textarea class="form-control" rows="6" name="custom_text" id="custom_text">{{ !empty((array)$meta) ? $meta->custom_text : ""  }}</textarea>
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
</style>
@stop
@section('javascript_page')
<script type="text/javascript">

    $(document).ready(function(){
       $(".select2").select2();
      $('#parent_id').change(function(){
        location.href="{{ route('tour.create') }}?parent_id=" + $(this).val();
      })
      
      $('#dataForm').submit(function(){        
        $('#btnSave').hide();
        $('#btnLoading').show();
      });  
    });
    
</script>
@stop

@extends('layout')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      FAQs
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{ route('faqs.index') }}">FAQs</a></li>
      <li class="active">Add new</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <a class="btn btn-default btn-sm" href="{{ route('faqs.index') }}" style="margin-bottom:5px">Quay lại</a>
    <form role="form" method="POST" action="{{ route('faqs.store') }}" id="dataForm">
    <div class="row">
      <!-- left column -->

      <div class="col-md-5">
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
                
                <div class="form-group" >
                  
                  <label>Câu hỏi <span class="red-star">*</span></label>
                  <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}">
                </div>
                <div class="form-group" >
                  
                  <label>Thứ tự hiển thị <span class="red-star">*</span></label>
                  <input type="text" class="form-control" name="display_order" id="display_order" value="{{ old('display_order') }}">
                </div>
                <div class="form-group">
                  <label>Trả lời</label>
                  <textarea class="form-control" rows="6" name="content" id="content">{{ old('content') }}</textarea>
                </div>
            </div>          
                              
            <div class="box-footer">
              <button type="submit" class="btn btn-primary btn-sm">Lưu</button>
              <a class="btn btn-default btn-sm" class="btn btn-primary btn-sm" href="{{ route('faqs.index')}}">Hủy</a>
            </div>
            
        </div>
        <!-- /.box -->     

      </div>
      <div class="col-md-7">
             
    </div>
    </form>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
@stop
@section('js')
<script type="text/javascript">
  $(document).ready(function(){
     if($('#how_to_cook').length == 1){
      CKEDITOR.replace( 'how_to_cook', {
        height : 300
      });
    }
    if($('#components').length == 1){
      CKEDITOR.replace( 'components', {
        height : 300
      });
    }
  });
</script>
@stop
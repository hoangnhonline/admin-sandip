@extends('layout')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      List công việc   
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route( 'dashboard' ) }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{ route('task.index') }}">List công việc</a></li>
      <li class="active">Add new</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <a class="btn btn-default btn-sm" href="{{ route('task.index') }}" style="margin-bottom:5px">Quay lại</a>
    <form role="form" method="POST" action="{{ route('task.store') }}" id="dataForm">
    <div class="row">
      <!-- left column -->

      <div class="col-12">
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
                 <!-- text input -->
                <div class="form-group">
                  <label>Tên công việc <span class="red-star">*</span></label>
                  <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
                </div>
                @if(Auth::user()->role == 1)
                <div class="form-group">
                  <label>Bộ phận <span class="red-star">*</span></label>
                  <select class="form-control" name="department_id" id="department_id">
                    <option value="">--Chọn--</option>
                      @foreach($departmentList as $department)
                      <option value="{{ $department->id }}"
                          {{ old('department_id') == $department->id  ? "selected" : "" }}>
                          {{ $department->name }}</option>
                      @endforeach
                  </select>
                </div>
                @endif
                <div class="form-group">
                  <label>Loại công việc <span class="red-star">*</span></label>
                  <select class="form-control" name="type" id="type">           
                    <option value="1" {{ old('type') == 1 ? "selected" : "" }}>Việc cố định</option>
                    <option value="2" {{ old('type') == 2 || old('type') == NULL ? "selected" : "" }}>Việc phát sinh</option>                  
                  </select>
                </div> 
                 
            </div>                        
            <div class="box-footer">
              <button type="submit" class="btn btn-primary btn-sm">Lưu</button>
              <a class="btn btn-default btn-sm" class="btn btn-primary btn-sm" href="{{ route('task.index')}}">Hủy</a>
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
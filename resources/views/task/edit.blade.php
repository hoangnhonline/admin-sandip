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
            <li class="active">Cập nhật</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <a class="btn btn-default btn-sm" href="{{ route('task.index') }}" style="margin-bottom:5px">Quay lại</a>
        <div class="row">
            <!-- left column -->
            <div class="block-author edit">
                <ul>
                    <li>
                        <span>Ngày tạo:</span>
                        <span class="name">{!! date('d/m/Y H:i', strtotime($detail->created_at)) !!}</span>
    
                    </li>
                    <li>
                        <span>Cập nhật lần cuối:</span>
                        <span class="name">( {!! date('d/m/Y H:i', strtotime($detail->updated_at)) !!} )</span>
                    </li>
                    <li>
                        <span>Bởi:</span>
                        <span class="name">( {!! $detail->updatedUser->name !!} )</span>
                    </li>
                </ul>
            </div>

            <div class="col-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        Chỉnh sửa
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" method="POST" action="{{ route('task.update') }}" id='dataForm'>
                        {!! csrf_field() !!}
                        <input type="hidden" name="id" value="{{ $detail->id }}">
                        <div class="box-body">
                            @if(Session::has('message'))
                            <p class="alert alert-info">{{ Session::get('message') }}</p>
                            @endif
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
                                <input type="text" class="form-control" name="name" id="name"
                                    value="{{ old('name', $detail->name) }}">
                            </div>
                            @if(Auth::user()->role == 1)
                            <div class="form-group">
                                <label>Bộ phận <span class="red-star">*</span></label>
                                <select class="form-control" name="department_id" id="department_id">
                                    <option value="">--Chọn--</option>
                                    @foreach($departmentList as $department)
                                    <option value="{{ $department->id }}"
                                        {{ old('department_id',$detail->department_id ) == $department->id  ? "selected" : "" }}>
                                        {{ $department->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @endif
                            <div class="form-group">
                                <label>Loại công việc <span class="red-star">*</span></label>
                                <select class="form-control" name="type" id="type">
                                    <option value="2" {{ $detail->type == 2 ? "selected" : "" }}>Việc phát sinh
                                    </option>
                                    <option value="1" {{ $detail->type == 1 ? "selected" : "" }}>Việc cố định</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Status <span class="red-star">*</span></label>
                                <select class="form-control" name="status" id="status">
                                    <option value="2" {{ $detail->status == 2 ? "selected" : "" }}>Đã hoàn thành
                                    </option>
                                    <option value="1" {{ $detail->status == 1 ? "selected" : "" }}>Chưa hoàn thành</option>
                                </select>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary btn-sm">Lưu</button>
                            <a class="btn btn-default btn-sm" class="btn btn-primary btn-sm"
                                href="{{ route('task.index', ['parent_id' => $detail->parent_id])}}">Hủy</a>
                        </div>

                </div>
                <!-- /.box -->

            </div>
            </form>
            <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
@stop

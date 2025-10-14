@extends('layout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Quản lý công việc
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route( 'dashboard' ) }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ route( 'task-detail.index' ) }}">Quản lý công việc</a></li>
            <li class="active">List</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                @if(Session::has('message'))
                <p class="alert alert-info">{{ Session::get('message') }}</p>
                @endif
                <a href="{{ route('task-detail.create', ['task_id' => $task_id]) }}" class="btn btn-info btn-sm"
                    style="margin-bottom:5px">Add new</a>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Bộ lọc</h3>
                    </div>
                    <div class="panel-body">
                        <form class="form-inline" role="form" method="GET" action="{{ route('task-detail.index') }}"
                            id="searchForm">                            
                            @if($userRole < 3)
                            <div class="form-group">                                
                                <select class="form-control select2" name="department_id" id="department_id"
                                    style="width: 150px">
                                    <option value="">--Bộ phận--</option>
                                    @if( $departmentArr->count() > 0)
                                    @foreach( $departmentArr as $value )
                                    <option value="{{ $value->id }}"
                                        {{ $value->id == $department_id ? "selected" : "" }}>
                                        {{ $value->name }}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                            @endif
                            <div class="form-group">                                
                                <select class="form-control select2" name="staff_id" id="staff_id" style="width: 200px">
                                    <option value="">--Nhân viên--</option>
                                    @if( $staffArr->count() > 0)
                                    @foreach( $staffArr as $value )
                                    <option value="{{ $value->id }}" {{ $value->id == $staff_id ? "selected" : "" }}>
                                        {{ $value->name }}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                            
                             <div class="form-group">                                
                                <select class="form-control select2" name="task_id" id="task_id" style="width: 200px">
                                    <option value="">--Công việc--</option>
                                    @if( $taskArr->count() > 0)
                                    @foreach( $taskArr as $value )
                                    <option value="{{ $value->id }}" {{ $value->id == $task_id ? "selected" : "" }}>
                                        {{ $value->name }}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="time_type" id="time_type">
                                    <option value="">--Thời gian--</option>
                                    <option value="1" {{ $time_type == 1 ? "selected" : "" }}>Theo tháng</option>
                                    <option value="2" {{ $time_type == 2 ? "selected" : "" }}>Khoảng ngày</option>
                                    <option value="3" {{ $time_type == 3 ? "selected" : "" }}>Ngày cụ thể </option>
                                </select>
                            </div>
                            @if($time_type == 1)
                            <div class="form-group  chon-thang">
                                <select class="form-control" id="month_change" name="month">
                                    <option value="">--THÁNG--</option>
                                    @for($i = 1; $i <=12; $i++) <option value="{{ str_pad($i, 2, "0", STR_PAD_LEFT) }}"
                                        {{ $month == $i ? "selected" : "" }}>{{ str_pad($i, 2, "0", STR_PAD_LEFT) }}
                                        </option>
                                        @endfor
                                </select>
                            </div>
                            <div class="form-group  chon-thang">
                                <select class="form-control" id="year_change" name="year">
                                    <option value="">--Năm--</option>
                                    <option value="2021" {{ $year == 2021 ? "selected" : "" }}>2021</option>
                                    <option value="2022" {{ $year == 2022 ? "selected" : "" }}>2022</option>
                                    <option value="2023" {{ $year == 2023 ? "selected" : "" }}>2023</option>
                                </select>
                            </div>
                            @endif
                            @if($time_type == 2 || $time_type == 3)
                            <div class="form-group chon-ngay">
                                <input type="text" class="form-control datepicker" autocomplete="off"
                                    name="use_date_from" placeholder="@if($time_type == 2) Từ ngày @else Ngày @endif "
                                    value="{{ $arrSearch['use_date_from'] }}" style="width: 90px">
                            </div>

                            @if($time_type == 2)
                            <div class="form-group chon-ngay den-ngay">
                                <input type="text" class="form-control datepicker" autocomplete="off" name="use_date_to"
                                    placeholder="Đến ngày" value="{{ $arrSearch['use_date_to'] }}" style="width: 90px">
                            </div>
                            @endif
                            @endif

                            <button type="submit" class="btn btn-info btn-sm" style="margin-top: -5px;">Lọc</button>
                        </form>
                    </div>
                </div>
                <div class="box">

                    <div class="box-header with-border">
                        <h3 class="box-title">List ( <span class="value">{{ $items->total() }} công việc )</span>
                        </h3>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                        <div style="text-align:center">
                            {{ $items->appends( ['task_id' => $task_id] )->links() }}
                        </div>
                        <table class="table table-bordered" id="table-list-data">
                            <tr>
                                <th style="width: 1%">#</th>
                                <th width="15%">Nhân viên</th>
                                <th>Công việc</th>                                
                                <th>Chi tiết</th>
                                <th>Báo cáo</th>
                                <th width="1%" style="white-space: nowrap;" class="text-center">Tiến độ</th>
                                <th width="7%" class="text-center">Ngày</th>
                                <th width="7%" class="text-center">Deadline</th>
                                <th width="1%" style="white-space: nowrap;">Thao tác</th>
                            </tr>
                            <tbody>
                                @if( $items->count() > 0 )
                                <?php $i = 0; ?>
                                @foreach( $items as $item )
                                <?php $i ++; ?>
                                <tr id="row-{{ $item->id }}">
                                    <td><span class="order">{{ $i }}</span></td>
                                    <td>
                                        {{ $item->staff->name }}
                                        @if($item->department)
                                        <br><span style="color:blue">Bộ phận: {{ $item->department->name }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $item->task->name }}
                                    </td>
                                    
                                    <td>
                                        {!! nl2br($item->content) !!}
                                    </td>
                                    <td>
                                        {!! $item->content_result !!}
                                    </td>
                                    <td class="text-center">
                                        {{ $item->percent }}%
                                    </td>
                                    <td class="text-center">
                                        {{ date('d/m/y', strtotime($item->task_date)) }}
                                    </td>
                                    <td class="text-center">
                                        @php
                                            $hour = date('H:i:s', strtotime($item->task_deadline));
                                            $hour_temp = date('H:i:s', strtotime("00:00:00"));
                                        @endphp
                                        @if($item->task_deadline)
                                            @if($hour === $hour_temp)
                                            {{ date('d/m/Y', strtotime($item->task_deadline)) }}
                                            @else 
                                            {{ date('d/m/Y H:i', strtotime($item->task_deadline)) }}
                                            @endif
                                        @endif

                                    </td>
                                    <td style="white-space:nowrap">
                                        @php $arrEdit = array_merge(['id' => $item->id], $arrSearch) @endphp 
                                        <a href="{{ route( 'task-detail.edit', $arrEdit) }}"
                                            class="btn btn-warning btn-sm"><span
                                                class="glyphicon glyphicon-pencil"></span></a>

                                        <a onclick="return callDelete('{{ $item->name }}','{{ route( 'task-detail.destroy', [ 'id' => $item->id ]) }}');"
                                            class="btn btn-danger btn-sm {{ $item->status == 2? "disabled" :""}}"><span
                                                class="glyphicon glyphicon-trash"></span></a>

                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="9">Không có dữ liệu.</td>
                                </tr>
                                @endif

                            </tbody>
                        </table>
                        <div style="text-align:center">
                            {{ $items->appends( ['task_id' => $task_id] )->links() }}
                        </div>
                    </div>
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
    </section>
    <!-- /.content -->
</div>
<input type="hidden" id="table_name" value="task-detail">
@stop

@section('js')

<script type="text/javascript">
    function callDelete(name, url) {
        swal({
            title: 'Bạn muốn xóa việc này"' + name + '"?',
            text: "Dữ liệu sẽ không thể phục hồi.",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then(function () {
            location.href = url;
        })
        return flag;
    }
    $(document).ready(function () {
        $('#department_id').change(function () {
            $('#searchForm').submit();
        });
    });

</script>
@stop

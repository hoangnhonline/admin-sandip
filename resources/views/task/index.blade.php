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
            <li><a href="{{ route( 'task.index' ) }}">List công việc</a></li>
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
                <a href="{{ route('task.create') }}" class="btn btn-info btn-sm" style="margin-bottom:5px">Add new</a>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Bộ lọc</h3>
                    </div>
                    <div class="panel-body">
                        <form class="form-inline" role="form" method="GET" action="{{ route('task.index') }}"
                            id="searchForm">


                            <div class="form-group">
                                <select class="form-control" name="status" id="status">
                                    <option value="">--Status--</option>
                                    <option value="1" {{ $status == 1 ? "selected" : "" }}>Đang tiến hành</option>
                                    <option value="2" {{ $status == 2 ? "selected" : "" }}>Đã hoàn thành</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-default btn-sm">Lọc</button>
                        </form>
                    </div>
                </div>
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">List công việc</h3>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                        <div style="text-align:center">
                            {{ $items->links() }}
                        </div>
                        <table class="table table-bordered" id="table-list-data">
                            <tr>
                                <th style="width: 1%">#</th>
                                <th>Tên</th>
                                <th width="10%">Bộ phận</th>
                                <th width="10%;">Loại CV</th>
                                <th width="10%;">Status</th>
                                <th width="1%;white-space:nowrap">Thao tác</th>
                            </tr>
                            <tbody>
                                @if( $items->count() > 0 )
                                <?php $i = 0; ?>
                                @foreach( $items as $item )
                                <?php $i ++; ?>
                                <tr id="row-{{ $item->id }}">
                                    <td><span class="order">{{ $i }}</span></td>

                                    <td>
                                        <a href="{{ route( 'task.edit', [ 'id' => $item->id ]) }}">{{ $item->name }}</a>
                                    </td>
                                    <td style="vertical-align:middle;text-align:center">
                                        @if($item->department)
                                        {{ $item->department->name }}
                                        @endif
                                    </td>
                                    <td style="vertical-align:middle;text-align:center">
                                        @if ($item->type == 1)
                                        {{ "Việc cố định" }}
                                        @else
                                        {{ "Việc phát sinh" }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->status == 1)
                                            {{ "Đang tiến hành" }}
                                        @elseif ($item->status == 2)
                                            {{ "Hoàn thành" }}
                                        @endif
                                    </td>
                                    <td style="white-space:nowrap">

                                        <a class="btn btn-primary btn-sm"
                                            href="{{ route('task-detail.index', ['task_id' => $item->id])}}"><span
                                                class="badge">{{ $item->taskDetail->count() }}</span> Công việc cụ thể
                                        </a>
                                        <a href="{{ route( 'task.edit', [ 'id' => $item->id ]) }}"
                                            class="btn btn-warning btn-sm"><span
                                                class="glyphicon glyphicon-pencil"></span></a>
                                        
                                        <a onclick="return callDelete('{{ $item->name }}','{{ route( 'task.delete', [ 'id' => $item->id ]) }}');"
                                            class="btn btn-danger btn-sm {{ $item->status == 2? "disabled" :""}}"><span
                                                class="glyphicon glyphicon-trash"></span>
                                        </a>
                                        {{-- @if( $item->taskDetail->count() == 0)
                                        <a onclick="return callDestroy('{{ $item->name }}','{{ route( 'task.destroy', [ 'id' => $item->id ]) }}');"
                                            class="btn btn-danger btn-sm">XÓA</a>
                                        @endif --}}
                                        
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="5">Không có dữ liệu.</td>
                                </tr>
                                @endif

                            </tbody>
                        </table>
                        <div style="text-align:center">
                            {{ $items->links() }}
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
@stop
@section('js')
<script type="text/javascript">
    function callDestroy(name, url) {
        swal({
            title: 'Bạn chắc chắn muốn xóa "' + name + '"?',
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
    function callDelete(name, url) {
        swal({
            title: 'Bạn muốn xóa "' + name + '"?',
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
        $(document).ready(function () {
        $('#status').change(function () {
            $('#searchForm').submit();
        });
    });

    });

</script>
@stop

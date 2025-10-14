@extends('layout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Cộng tác viên
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route( 'dashboard' ) }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ route('ctv.index') }}">Nhân viên</a></li>
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
                <a href="{{ route('ctv.create') }}" class="btn btn-info btn-sm" style="margin-bottom:5px">Add new</a>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Bộ lọc</h3>
                    </div>
                    <div class="panel-body">
                        <form class="form-inline" role="form" method="GET" action="{{ route('ctv.index') }}" id="frmContact">
                           
                            <div class="form-group">              
                                <select class="form-control" name="city_id" id="city_id">
                                    <option value="">--Chi Nhánh -- </option>
                                    <option value="1" {{ $city_id == 1 ? "selected" : "" }}>Phú Quốc</option>
                                    <option value="2" {{ $city_id == 2 ? "selected" : "" }}>Đà Nẵng</option>
                                </select>
                            </div> 
                             
                            <div class="form-group">                                
                                <input type="text" class="form-control" name="name" value="{{ $name }}" placeholder="Tên">
                            </div>
                            <button type="submit" class="btn btn-default btn-sm">Lọc</button>
                        </form>
                    </div>
                </div>
                <div class="box">

                    <div class="box-header with-border">
                        <h3 class="box-title">List ( <span class="value">{{ $items->total() }} CTV
                                )</span></h3>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                        {{-- <a href="{{ route('ctv.export') }}" class="btn btn-info btn-sm"
                            style="margin-bottom:5px;float:right" target="_blank">Export</a> --}}
                        <div style="text-align:center">
                            {{ $items->appends( ['phone' => $phone] )->links() }}
                        </div>
                        <table class="table table-bordered table-hover" id="table-list-data">
                            <tr>
                                <th style="width: 1%">#</th>
                                <th>Họ tên</th>                               
                                <th>Số điện thoại</th>
                                <th>Email</th>                 
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
                                        <a href="javascript:;" data-id="{{$item->id}}" class="view-staff">{{ $item->name }}</a>                                        
                                    </td>
                                    
                                    <td>{{ $item->phone }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td style="white-space:nowrap;#e8a23e">
                                        @if($item->role > 1)
                                        <a href="{{ route( 'ctv.editPass', [ 'id' => $item->id ]) }}"
                                            class="btn btn-warning btn-sm" title="Reset pass"><span
                                                class="glyphicon glyphicon-repeat"></span></a>
                                        <a href="{{ route( 'ctv.edit', [ 'id' => $item->id ]) }}"
                                            class="btn btn-warning btn-sm" title="Edit info"><span
                                                class="glyphicon glyphicon-pencil"></span></a>
                                        
                                        <a onclick="return callDelete('{{ $item->name }}','{{ route( 'ctv.destroy', [ 'id' => $item->id ]) }}');"
                                            class="btn btn-danger btn-sm"><span
                                                class="glyphicon glyphicon-trash"></span></a>
                                        @endif

                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="7">Không có dữ liệu.</td>
                                </tr>
                                @endif

                            </tbody>
                        </table>
                        <div style="text-align:center">
                            {{ $items->appends( ['phone' => $phone] )->links() }}
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
<div class="modal fade" id="staffModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header"  style="text-align: center;"> 
                <h5 class="modal-title" id="exampleModalLongTitle">Hồ sơ chi tiết</h5>       
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        </div>
      </div>
    </div>
</div>
<input type="hidden" id="route_get_modal_staff" value="{{ route('ctv.getModal') }}">
@stop
@section('js')
<style>
    .table-modal tr:nth-child(even) {
    background-color: #dddddd;
    }
</style>
<script type="text/javascript">
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
    $(document).ready(function(){
        $('#status').change(function(){
            $('#frmContact').submit();
        });
        $('#department_id').change(function(){
            $('#frmContact').submit();
        });
        $('#city_id').change(function(){
            $('#frmContact').submit();
        });
        $('.view-staff').on("click", function(event) {
            $("#staffModal").modal('show');
            var staff_id = $(this).data('id');
            console.log(staff_id);
            $.ajax({
                url: $('#route_get_modal_staff').val(),
                type:'GET',
                dataType: 'html',
                // dataType: 'json',
                data: {
                    id : staff_id,
                },
                success : function(response){
                    console.log(response.detail);
                    $("#staffModal").find('.modal-body').html(response); 
                }
            });
            
        });
    });
</script>
@stop

@extends('layout')
@section('content')
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Dịch vụ
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="{{ route( 'cate.index' ) }}">Danh mục</a></li>
    <li class="active">List</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      @if(Session::has('message'))
      <p class="alert alert-info" >{{ Session::get('message') }}</p>
      @endif
      <a href="{{ route('cate.create') }}" class="btn btn-info btn-sm" style="margin-bottom:5px">Add new</a>
      <div class="box">
        <div class="panel-body">
        @php
       // $role = 4;
        @endphp
        <form class="form-inline" role="form" method="GET" action="{{ route('cate.index') }}">
                  
          <div class="form-group">
            <label>&nbsp;&nbsp;Tên</label>
            <input type="text" name="name" value="{{ $arrSearch['name'] }}" class="form-control">
          </div>
          <div class="form-group">
            <label>&nbsp;&nbsp;Số tiền</label>
            <input type="text" name="price" value="{{ $arrSearch['price'] > 0 ? number_format($arrSearch['price']) : "" }}" class="form-control number">
          </div>
          <div class="form-group" style="font-weight: bold; color: blue">            
            <input type="checkbox" name="hon_son" value="1" {{ $arrSearch['hon_son'] == 1 ? "checked" : "" }}> Hòn Sơn
          </div>
         
          <button class="btn btn-info" type="submit">Lọc</button>     
          </form>
      </div>
      </div>
        <div class="box-header with-border">
          <h3 class="box-title">List</h3>
        </div>
        
        <!-- /.box-header -->
        <div class="box-body">
          <table class="table table-bordered" id="table-list-data">
            <tr>
              <th style="width: 1%">#</th>
              
              <th>Tên</th> 
              <th class="text-right">Giá tiền</th>          
              <th class="text-center">Hòn Sơn</th>                              
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
                  <a href="{{ route( 'cate.edit', [ 'id' => $item->id ]) }}">{{ $item->name }}</a>               

                </td> 
                <td class="text-right">
                  {{ number_format($item->price) }}
                </td>  
                <td class="text-center">
                  <input id="hon_son_{{ $item->id }}" data-table="cate" type="checkbox" data-column="hon_son" class="change-column-value-booking" value="1" data-id="{{ $item->id }}"  value="1" {{ $item->hon_son == 1 ? "checked" : "" }}


                  > Hiện
                </td>                             
                <td style="white-space:nowrap">                 
                  <a href="{{ route( 'cate.edit', [ 'id' => $item->id ]) }}" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-pencil"></span></a>
                  <!-- <a onclick="return callDelete('{{ $item->name }}','{{ route( 'cate.destroy', [ 'id' => $item->id ]) }}');" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span></a> -->
             
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
function callDelete(name, url){  
  swal({
    title: 'Bạn muốn xóa "' + name +'"?',
    text: "Dữ liệu sẽ không thể phục hồi.",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes'
  }).then(function() {
    location.href= url;
  })
  return flag;
}

$(document).ready(function(){
  $('.change-column-value-booking').change(function(){
        var obj = $(this);
        if(confirm('Chắc chắn đã thu tiền?')){
            
            ajaxChange(obj.data('id'), obj);
        }else {
          obj.removeAttr('checked');
        }  
       });


});
function ajaxChange(id, obj){
        $.ajax({
            url : "{{ route('cate.change-value-by-column') }}",
            type : 'GET',
            data : {
              id : id,
              col : obj.data('column'),
              value: obj.val()
            },
            success: function(data){
                console.log(data);
            }
          });
      }
</script>
@stop
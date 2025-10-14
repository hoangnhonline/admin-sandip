@extends('layout')
@section('content')
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Món ăn
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="{{ route( 'articles-cate.index' ) }}">Món ăn</a></li>
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
      <a href="{{ route('articles-cate.create', ['parent_id' => $parent_id]) }}" class="btn btn-info btn-sm" style="margin-bottom:5px">Add new</a>
      <div class="box">
        <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Bộ lọc</h3>
        </div>
        <div class="panel-body">
          <form class="form-inline" role="form" method="GET" action="{{ route('articles-cate.index') }}" id="searchForm">    
            <div class="form-group">
              <label for="email">Danh mục cha</label>
              <select class="form-control" name="parent_id" id="parent_id">
                <option value="">--Tất cả--</option>
                @if( $cateParentList->count() > 0)
                  @foreach( $cateParentList as $value )
                  <option value="{{ $value->id }}" {{ $value->id == $parent_id ? "selected" : "" }}>{{ $value->name }}</option>
                  @endforeach
                @endif
              </select>
            </div>        
            
            <button type="submit" class="btn btn-default btn-sm">Lọc</button>
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
              <th style="width: 1%;white-space:nowrap">Thứ tự</th>                         
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
                  <a href="{{ route( 'articles-cate.edit', [ 'id' => $item->id ]) }}">{{ $item->name }}</a>
                  
                 @if( $item->is_hot == 1 )
                  <label class="label label-danger">HOT</label>
                  @endif

                  <p>{{ $item->description }}</p>
                </td>               
                <td style="vertical-align:middle;text-align:center">
                  {{ $item->display_order }}
                </td> 
                <td style="white-space:nowrap">
                
                <a href="{{ route( 'w-banner.index', [ 'object_id' => $item->id, 'object_type' => 7 ]) }}" class="link_edit btn-sm btn-info btn"><span style="font-size: 16px;" class="badge">{{ $item->banners($item->id) }}</span> banner</a> 
                  <a class="btn btn-primary btn-sm" href="{{ route('w-articles.index', ['cate_id' => $item->id])}}" ><span class="badge">{{ $item->articles->count() }}</span> Bài viết </a>
                  <a href="{{ route( 'articles-cate.edit', [ 'id' => $item->id ]) }}" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-pencil"></span></a>                 
                  @if( $item->articles->count() == 0)
                  <a onclick="return callDelete('{{ $item->name }}','{{ route( 'articles-cate.destroy', [ 'id' => $item->id ]) }}');" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span></a>
                  @endif
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
  $('#table-list-data tbody').sortable({
        placeholder: 'placeholder',
        handle: ".move",
        start: function (event, ui) {
                ui.item.toggleClass("highlight");
        },
        stop: function (event, ui) {
                ui.item.toggleClass("highlight");
        },          
        axis: "y",
        update: function() {
            var rows = $('#table-list-data tbody tr');
            var strOrder = '';
            var strTemp = '';
            for (var i=0; i<rows.length; i++) {
                strTemp = rows[i].id;
                strOrder += strTemp.replace('row-','') + ";";
            }     
            updateOrder("loai_sp", strOrder);
        }
    });
});
function updateOrder(table, strOrder){
  $.ajax({
      url: $('#route_update_order').val(),
      type: "POST",
      async: false,
      data: {          
          str_order : strOrder,
          table : table
      },
      success: function(data){
          var countRow = $('#table-list-data tbody tr span.order').length;
          for(var i = 0 ; i < countRow ; i ++ ){
              $('span.order').eq(i).html(i+1);
          }                        
      }
  });
}
</script>
@stop
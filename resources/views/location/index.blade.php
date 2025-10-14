@extends('layout')
@section('content')
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Địa điểm
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="{{ route( 'location.index' ) }}">Địa điểm</a></li>
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
      <a href="{{ route('location.create') }}" class="btn btn-info btn-sm" style="margin-bottom:5px">Add new</a>
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Bộ lọc</h3>
        </div>
        <div class="panel-body">
          <form class="form-inline" id="formSearch" role="form" method="GET" action="{{ route('location.index') }}">
           <!--  <div class="form-group">
              <label for="email">Địa điểm :</label>
              <select class="form-control select2" name="location_id" id="location_id">                          
              <option value="">--Chọn--</option>      
                @foreach($all as $item)
                <option value="{{ $item->id }}" {{ $id == $item->id ? "selected" : "" }}>{{ $item->name }}</option>
                @endforeach
              </select>
            </div>  -->  
            <div class="form-group">
              <label for="email">ID</label>
              <input type="text" style="width: 100px" class="form-control" id="id" name="id" value="{{ $id_search }}">
            </div>         
            <div class="form-group">
              <label for="email">&nbsp;&nbsp;&nbsp;Tên địa điểm</label>
              <input type="text" class="form-control" id="name" name="name" value="{{ $name }}">
            </div>
            <div class="form-group">         
            <select style="width: 200px" name="area_id" id="area_id" class="form-control select2">                  
              <option value="">--KHU VỰC--</option>
              @foreach($areaList as $area)
              <option value="{{ $area->id }}" {{ $area_id == $area->id ? "selected" : "" }} >{{ $area->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group chon-ngay">              
              <input type="text" class="form-control datepicker" autocomplete="off" name="use_date_from" placeholder="Ngày booking" value="{{ $arrSearch['use_date_from'] }}" style="width: 110px">
            </div>
            <div class="form-group">
              &nbsp;&nbsp;&nbsp;<input type="checkbox"name="no_area" id="no_area" {{ $no_area == 1 ? "checked" : "" }} value="1">
              <label for="no_area" style="color:red">Chưa chọn khu vực</label>
            </div>
            <button type="submit" class="btn btn-primary btn-sm">Lọc</button>
               </form>    
        </div>
      </div>
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">List ({{ number_format($items->total()) }} địa điểm)</h3>
        </div>
        @if(Auth::user()->role == 1)
        <div class="form-inline" style="padding: 5px">
          <div class="form-group">         
            <select style="font-size: 11px; width: 200px" class="form-control select2 multi-change-column-value" data-column="area_id">                  
              <option value="">--SET KHU VỰC--</option>
              @foreach($areaList as $area)
              <option value="{{ $area->id }}" >{{ $area->name }}</option>
              @endforeach
            </select>
          </div>
          <button class="btn btn-danger btn-sm" style="float: right">Xóa mục đã chọn</button>
        </div>
        @endif
        <!-- /.box-header -->
        <div class="box-body">
          <div style="text-align:right">
          
          </div>
          <form action="{{ route('location.delete-multi') }}" method="GET">
            
          <table class="table table-bordered table-hover table-list-data" id="table-list-data">
            <tr>
              <th style="width: 1%"><input type="checkbox" id="checkall" /></th>
              <th width="1%">STT</th>
              
              <th width="20%">Tên</th>             
              <th>Khu vực</th>
              <th width="150">Giờ đón</th>
              <th width="250">Tọa độ</th>
              <th>Latitude</th>
              <th>Longitude</th>
              <th width="1%">Bản đồ</th>
              <th>Ngày đón gần nhất</th>    
              <th width="1%"></th>         
            </tr>
            <tbody>
            @if( $items->count() > 0 )
              <?php $i = 0; ?>
              @foreach( $items as $item )
                <?php $i ++; ?>

              <tr id="row-{{ $item->id }}">
                <td>
                  @if($id != $item->id)
                  <input class="check_location" type="checkbox" name="replace_id[]" value="{{ $item->id }}">
                  @endif
                </td>       
                <td style="text-align: center;">{{ $i }}
                  
                </td>  
                     
                <td> 
                <input type="text" class="change-values form-control" data-column="name" data-id="{{ $item->id }}" value="{{ $item->name }}" style="width:80%">
                </td>     
                <td>
                  <select class="form-control select2 change-values" data-column="area_id" data-id="{{ $item->id }}" style="width: 180px !important;">
                    <option>--Khu vực--</option>
                    @foreach($areaList as $area)
                    <option value="{{ $area->id }}" {{ $item->area_id == $area->id ? "selected" : "" }}>{{ $area->name }}</option>
                    @endforeach
                  </select>
                </td>
                
                <td>
                  <input type="text" class="change-values form-control" data-column="pickup_time" data-id="{{ $item->id }}" value="{{ $item->pickup_time }}">
                </td>
                <td>
                 
                  <input type="text" class="change-values form-control" data-column="address" data-id="{{ $item->id }}" value="{{ $item->address }}">
        
                </td>
                <td>
                  {{ $item->latitude }}
                </td>
                <td>
                  {{ $item->longitude }}
                </td>
                <td>
                  <a class="btn btn-sm 
                  @if($item->address)
                  btn-success
                  @else
                  btn-warning
                  @endif
                  " href="https://www.google.com/maps/search/{{ urlencode($item->name) }}" target="_blank" title="{{ $item->address }}">Bản đồ</a>
                </td> 
                
                <td>
                  <?php 
                  $max_date = $item->maxDate($item->id);
                  ?>
                  @if(strtotime($max_date) > time())
                  <span style="color:red">{{ $max_date }}</span>
                  @else
                  {{ $max_date }}
                  @endif
                  @php
                  if($max_date == ''){                 
                    App\Models\Location::where('id', $item->id)->delete();                 
                  }
                  @endphp
                </td> 
                <td>
                  <a href="javascript:;" class="btn btn-danger btn-sm ajaxDelete" data-id="{{ $item->id }}"><i class="fa fa-trash"></i></a>
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
          </form>
          <div style="text-align:right">          
          
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
<input type="hidden" id="route_tag_index" value="{{ route('location.index') }}">
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
  $('#area_id').change(function(){
    $('#formSearch').submit();
  });
  $("#checkall").change(function(){
    $('.check_location').not(this).prop('checked', this.checked);     
});
  $('.change-values').change(function(){
    var id = $(this).data('id');
    var value = $(this).val();
    var column = $(this).data('column');
    saveValueColumn(id, value, column);
  });
  
  $('.ajaxDelete').click(function(){
    var id = $(this).data('id');
    var parents = $(this).parents('tr');
    $.ajax({
      url : '{{ route('location.ajax-delete')}}',
      type : 'GET',
      data:{
        id : id
      }, 
      success: function(data){
        parents.remove();
      }
    });
  });
  $('.multi-change-column-value').change(function(){
          var obj = $(this);      
          $('.check_location:checked').each(function(){
              $.ajax({
                url : "{{ route('location.change-value-by-column') }}",
                type : 'GET',
                data : {
                  id : $(this).val(),
                  col : obj.data('column'),
                  value: obj.val()
                },
                success: function(data){

                }
              });
          });
          
       });
  function saveValueColumn(id, value, column){
    $.ajax({
      url : '{{ route('location.save-value-column')}}',
      type : 'GET',
      data:{
        id : id,
        value : value,
        column : column
      }, 
      success: function(data){

      }
    }); 
  }
  $('#location_id').change(function(){
    $(this).parents('form').submit();
  });
});
</script>
@stop
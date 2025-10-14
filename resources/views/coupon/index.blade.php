@extends('layout')
@section('content')
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Mã giảm giá
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="{{ route( 'coupon.index' ) }}">Mã giảm giá</a></li>
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
      <a href="{{ route('coupon.create') }}" class="btn btn-info btn-sm" style="margin-bottom:5px">Add new</a>
      <div class="row">
      <!-- left column -->

      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Add new</h3>
          </div>
            <div class="box-body">
              <form role="form" method="POST" action="{{ route('coupon.store') }}" id="dataForm">
                {!! csrf_field() !!}
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif 
                <div class="row">
                  <div class="form-group col-md-12">
                    <label>NHÀ HÀNG<span class="red-star">*</span></label>
                    <select class="form-control select2" name="shop_id" id="shop_id">
                        <option value="">--CHỌN--</option>
                        @foreach($shopList as $shop)
                        <option value="{{ $shop->id }}" {{ old('shop_id') == $shop->id ? "selected" : "" }}>{{ $shop->name }}</option>
                        @endforeach
                    </select>
                  </div>    
                </div>  
              <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-sm">TẠO MÃ</button>
              </div>      
              </form>      
          </div>
        </div>
        <!-- /.box -->     

      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Bộ lọc</h3>
        </div>
        <div class="panel-body">
          <form class="form-inline" role="form" method="GET" action="{{ route('coupon.index') }}" id="searchForm">
            <div class="form-group">
              <label for="type">Nhà hàng</label>
              <select class="form-control select2" name="shop_id" id="shop_id">
                <option value="">--Tất cả--</option>
                @foreach($shopList as $shop)
                <option value="{{ $shop->id }}" {{ $shop_id == $shop->id ? "selected" : "" }}>{{ $shop->name }}</option>
                @endforeach
                
              </select>
            </div>           
            <div class="form-group">
              <label for="use_date_from">&nbsp;&nbsp;&nbsp;Từ ngày</label>
              <input type="text" class="form-control datepicker" autocomplete="off" name="use_date_from" placeholder="Từ ngày" value="{{ $arrSearch['use_date_from'] }}" style="width: 100px">
            </div>
            <div class="form-group">
              <label for="use_date_to">&nbsp;&nbsp;&nbsp;Đến ngày</label>
              <input type="text" class="form-control datepicker" autocomplete="off" name="use_date_to" placeholder="Đến ngày" value="{{ $arrSearch['use_date_to'] }}" style="width: 100px">
            </div>
            <button type="submit" class="btn btn-default btn-sm">Lọc</button>
          </form>         
        </div>
      </div>
      <div class="box">

        <div class="box-header with-border">
          <h3 class="box-title">List ( <span class="value">{{ $items->total() }} code )</span></h3>
        </div>
        
        <!-- /.box-header -->
        <div class="box-body">
          <div style="text-align:center">
            {{ $items->links() }}
          </div>  
          <table class="table table-bordered table-hover" id="table-list-data">
            <tr>
              <th style="width: 1%">#</th>
              <th class="text-left">Mã giảm giá</th>
            </tr>
            <tbody>
            @if( $items->count() > 0 )
              <?php $i = 0; ?>
              @foreach( $items as $item )
                <?php $i ++; ?>
              <tr id="row-{{ $item->id }}">
                <td><span class="order">{{ $i }}</span></td>   
                
                <td class="text-left">  
                    Mã giảm giá tại <span style="font-weight: bold">{{ $item->shop->name }}</span> được {{ $item->user->name }} tạo vào lúc {{ date('H:i d/m', strtotime($item->created_at)) }}: 
                    <span  style="font-weight: bold; color: #06b7a4; font-size: 15px">{{ $item->code }}                                       </span>
                </td>               
              </tr> 
              @endforeach
            @else
            <tr>
              <td colspan="4">Không có dữ liệu.</td>
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
<div class="modal fade" id="uncModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="text-align: center;">
       <div class="modal-header">        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <img src="" id="unc_img" style="width: 100%">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
      </div>
    </div>
  </div>
</div>
<input type="hidden" id="table_name" value="articles">
@stop
@section('js')
<script type="text/javascript">
  $(document).ready(function(){
    $('img.img-unc').click(function(){
      $('#unc_img').attr('src', $(this).attr('src'));
      $('#uncModal').modal('show');
    }); 
  });
</script>
@stop
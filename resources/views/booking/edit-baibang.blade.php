@extends('layout')
@section('content')
<div class="content-wrapper">

  <!-- Content Header (Page header) -->
  <section class="content-header">
  <h1 style="text-transform: uppercase;">
      Cập nhật booking
    </span></h1>
  </section>
@php
  if($detail->use_date){
      $use_date = old('use_date', date('d/m/Y', strtotime($detail->use_date)));
  }else{
      $use_date = old('use_date');
  }
@endphp
  <!-- Main content -->
  <section class="content">
    <a class="btn btn-default btn-sm" href="{{ route('booking.index') }}" style="margin-bottom:5px">Quay lại</a>
    <a class="btn btn-success btn-sm" href="{{ route('booking.index') }}" style="margin-bottom:5px">Xem danh sách booking</a>
    <form role="form" method="POST" action="{{ route('booking.update') }}" id="dataForm">
      <input type="hidden" name="id" value="{{ $detail->id }}">
      <input type="hidden" name="count_services" id="count_services" value="{{ $detail->details->count() }}">
    <div class="row">
      <!-- left column -->

      <div class="col-md-12">
        <div id="content_alert"></div>
        <!-- general form elements -->
        <div class="box box-primary">

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
               <div class="row">
               <!--  <div class="form-group col-xs-6">
                      <label style="font-weight: bold; color: blue">
                        <input type="checkbox" id="xe_4t" name="xe_4t" value="1" {{ old('xe_4t', $detail->xe_4t) == 1 ? "checked" : "" }}>
                        4T
                      </label>
                  </div> -->
                  <div class="form-group col-xs-6">
                      <label style="font-weight: bold; color: red">
                        <input type="checkbox" id="da_thu" name="da_thu" value="1" {{ old('da_thu', $detail->da_thu) == 1 ? "checked" : "" }}>
                        ĐÃ THU TIỀN
                      </label>
                  </div>
                 
                </div>
              <div class="row">
                <input type="hidden" name="beach_id" value="7">
                  <input type="hidden" name="partner_id" value="">    
                  <input type="hidden" name="phone" value="">    
                  <input type="hidden" name="name" value="">
               
                 <div class="form-group col-md-6 col-xs-6">
                    <label>Ngày chơi <span class="red-star">*</span></label>
                    <input type="text" class="form-control datepicker" name="use_date" id="use_date" value="{{ $use_date }}" autocomplete="off">
                  </div>
                  <div class="form-group col-md-6 col-xs-6">
                    <label>Bill số</label>
                    <input type="text" class="form-control" name="bill_no" id="bill_no" value="{{ old('bill_no', $detail->bill_no) }}" autocomplete="off">
                  </div>                  
                </div>
                @foreach($detail->details as $item)
                <div class="row services" style="margin-top: 4px;margin-bottom: 4px;" >
                  <div class="form-group col-xs-5" style="padding-right: 0px">
                    <!-- <label>Dịch vụ</label> -->
                    <select name="cate_id[]" class="form-control select2 cate">
                      <option value="">-Dịch vụ-</option>
                      @foreach($cateList as $cate)
                        <option value="{{ $cate->id }}" {{ $item->cate_id == $cate->id ? "selected" : "" }} data-price="{{ $cate->price }}">{{ $cate->name }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group col-xs-3">
                   <!--  <label>Số lượng</label> -->
                    <select name="amount[]" class="form-control select2 amount">
                      <option value="">-SL-</option>
                     @for($i = 1; $i <= 10; $i++)
                        <option value="{{ $i }}"
                      {{ $item->amount == $i ? "selected" : "" }}   >{{ $i }}</option>
                      @endfor
                      </select>
                  </div>
                  <div class="form-group col-xs-4" style="padding-left: 0px;">
                    <input type="text" name="total[]" class="form-control number total" placeholder="Thành tiền" value="{{ $item->total_price }}">
                  </div>
                </div>
                @endforeach
                @php
                $con_lai = 5 - $detail->details->count();
                @endphp
                @for($k = 0; $k < $con_lai; $k++)
                <div class="row services" style="margin-top: 4px;margin-bottom: 4px;" >
                  <div class="form-group col-xs-5" style="padding-right: 0px">
                    <!-- <label>Dịch vụ</label> -->
                    <select name="cate_id[]" class="form-control select2 cate">
                      <option value="">-Dịch vụ-</option>
                      @foreach($cateList as $cate)
                        <option value="{{ $cate->id }}" data-price="{{ $cate->price }}">{{ $cate->name }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group col-xs-3">
                   <!--  <label>Số lượng</label> -->
                    <select name="amount[]" class="form-control select2 amount">
                      <option value="">-SL-</option>
                     @for($i = 1; $i <= 10; $i++)
                        <option value="{{ $i }}"
                        >{{ $i }}</option>
                      @endfor
                      </select>
                  </div>
                  <div class="form-group col-xs-4" style="padding-left: 0px;">
                    <input type="text" name="total[]" class="form-control number total" placeholder="Thành tiền">
                  </div>
                </div>
                @endfor
                <!-- <div class="col-md-12" style="padding-right: 0px; text-align: right;">
                  <button type="button" id="btnAdd" class="btn btn-info btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> Thêm</button>
                </div> -->

                <div class="row">
                  <div class="form-group col-xs-6" >
                      <label>TỔNG TIỀN</label>
                    <input type="text" class="form-control number" autocomplete="off" name="total_price" id="total_price" value="{{ old('total_price', $detail->total_price) }}">
                  </div>
                  <div class="form-group col-xs-6" >
                      <label>Giảm giá</label>
                    <input type="text" class="form-control number" autocomplete="off" name="discount" id="discount" value="{{ old('discount', $detail->discount) }}">
                  </div>
                  <div class="form-group col-xs-6">
                      <label>Tư vấn</label>
                      <select name="nguoi_tu_van" id="nguoi_tu_van" class="form-control select2">
                        <option value="">--Chọn--</option>
                        @foreach($tuvanList as $ck)
                        <option value="{{ $ck->id }}" {{ old('nguoi_tu_van', $detail->nguoi_tu_van) == $ck->id ? "selected" : "" }}>{{ $ck->name }}</option>
                        @endforeach
                      </select>
                  </div>
                  <div class="form-group col-md-6 col-xs-6">
                      <label>Tiền chiết khấu</label>
                    <input type="text" class="form-control number" name="commision" id="commision" value="{{ old('commision', $detail->commision) }}">
                  </div>
                  <div class="form-group col-md-6 col-xs-6" style="display: none;">
                      <label>Tiền cọc</label>
                    <input type="text" class="form-control number" name="tien_coc" id="tien_coc" value="{{ old('tien_coc', $detail->tien_coc) }}">
                  </div>
                  <div class="form-group col-md-6 col-xs-6" style="display: none;">
                      <label>Người thu cọc</label>
                      <select class="form-control select2" name="nguoi_thu_coc" id="nguoi_thu_coc">
                        <option value="">--Chọn--</option>
                        <option value="1" {{ old('nguoi_thu_coc', $detail->nguoi_thu_coc) == 1 ? "selected" : "" }}>Sales</option>
                        <option value="2" {{ old('nguoi_thu_coc', $detail->nguoi_thu_coc) == 2 ? "selected" : "" }}>CTY</option>
                        <option value="3" {{ old('nguoi_thu_coc', $detail->nguoi_thu_coc) == 3 ? "selected" : "" }}>A Phương</option>
                        <option value="4" {{ old('nguoi_thu_coc', $detail->nguoi_thu_coc) == 4 ? "selected" : "" }}>Tiền mặt</option>
                      </select>
                  </div>
                  
                </div>
                <div class="row">
                   <div class="form-group col-md-6 col-xs-6" >
                      <label>CÒN LẠI</label>
                      <input type="text" class="form-control number" name="con_lai" id="con_lai" value="{{ old('con_lai', $detail->con_lai) }}">
                  </div>
                  <div class="form-group col-xs-6" >
                      <label>Receiver <span class="red-star">*</span></label>
                      <select class="form-control select2" name="nguoi_thu_tien" id="nguoi_thu_tien">
                        @foreach($collecterList as $payer)
                        <option value="{{ $payer->id }}" {{ old('nguoi_thu_tien', $detail->nguoi_thu_tien) == $payer->id ? "selected" : "" }}>{{ $payer->name }}</option>
                        @endforeach
                      </select>
                  </div>
                </div>

                <div class="form-group">
                  <label>Ghi chú</label>
                  <textarea class="form-control" rows="6" name="notes" id="notes">{{ old('notes', $detail->notes) }}</textarea>
                </div>
               
            </div>

            <div class="box-footer">
              <button type="button" class="btn btn-default btn-sm" id="btnLoading" style="display:none"><i class="fa fa-spin fa-spinner"></i> Đang xử lý...</button>
              <button type="submit" id="btnSave" class="btn btn-primary btn-sm">Lưu</button>
              <a class="btn btn-default btn-sm" class="btn btn-primary btn-sm" href="{{ route('booking.index') }}">Hủy</a>
            </div>

        </div>
        <!-- /.box -->

      </div>

    </form>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<style type="text/css">
  .select2-container .select2-selection--single .select2-selection__rendered{
    padding-left: 0px !important;
    padding-right: 0px !important;
  }
</style>
@stop
@section('js')
<script type="text/javascript">
  function setPrice(){
    var total_price = 0;
    var total_price_ck = 0;
    var count_services = 0;
    $('.services').each(function(){
      var row = $(this);
      var cate_id = row.find('.cate').val();
      var amount = row.find('.amount').val();
      //console.log(cate_id, amount);
      if(cate_id > 0 && amount > 0){
        count_services++;
        var price = row.find('.cate option:selected').data('price');
        var total = price*amount;
        row.find('.total').val(total);
        total_price = total_price + total;
        if(cate_id != 15 && cate_id != 16 && cate_id != 27){
          total_price_ck = total_price_ck + total;
        }
      }
    });
    var per_com = $('#per_com').val();
    if($('#nguoi_tu_van').val() > 0){      
      $('#commision').val(total_price_ck*0.1);       
    }else{
      $('#commision').val(0);       
    }
    var discount = 0;
    if($('#discount').val()){
      discount = parseInt($('#discount').val());
      total_price_ck = total_price_ck - discount;
    }
    var commision = $('#commision').val();
    if($('#beach_id').val() != 4){
      if(per_com > 0){
        if(per_com <= 100){
          commision = per_com*total_price_ck/100;
        }else{
          commision = per_com;
        }
      }
      $('#commision').val(commision);
    }
    
    var tien_coc = 0;
    if($('#tien_coc').val()){
      tien_coc = parseInt($('#tien_coc').val());
    }
    var con_lai = parseInt(total_price) - discount - commision - tien_coc;
    
    $('#total_price').val(total_price);
    $('#con_lai').val(con_lai);
    if(count_services > 0){
      $('#count_services').val(count_services);
    }
  }
  var levelLogin = {{ Auth::user()->level }};

  $(document).on('click','#btnSave', function(){

    if(parseInt($('#tien_coc').val()) > 0 && $('#nguoi_thu_coc').val() == ''){
      alert('Bạn chưa chọn người thu cọc');
      return false;
    }
  });
  $('#btnAdd').click(function(){
    $('.hidden:first').removeClass('hidden');
  });

  $(document).ready(function(){
    $('.cate, .amount, #per_com, #nguoi_tu_van').change(function(){
      setPrice();
    });
    $('#discount, #tien_coc, #commision').keyup(function(){
      setPrice();
    });


    $('#dataForm').submit(function(){
      $('#btnSave').hide();
      $('#btnLoading').show();
    });   

  });

</script>
@stop

@extends('layout')
@section('content')
<div class="content-wrapper">
  
<!-- Content Header (Page header) -->
<section class="content-header" style="padding-top: 10px;">
  <h1 style="text-transform: uppercase;">    
    @if($time_type == 3)
    THỂ THAO BIỂN {{$arrSearch['use_date_from']}}
    @elseif($time_type == 1)
    THỂ THAO BIỂN THÁNG {{$month}}/{{ $year }}
    @elseif($time_type == 2)
    THỂ THAO BIỂN TỪ {{ date('d/m', strtotime($use_date_from_format)) }} ĐẾN {{ date('d/m', strtotime($use_date_to_format)) }}
    @endif
  </h1>
  
</section>

<!-- Main content -->
<section class="content">
  
  <div class="row">
    <div class="col-md-12">
      <div id="content_alert"></div>
      @if(Session::has('message'))
      <p class="alert alert-info" >{{ Session::get('message') }}</p>
      @endif
      
      @if(Auth::user()->id == 518)        
        <a href="{{ route('booking-bbc.index') }}" class="btn btn-success btn-sm" style="margin-bottom:5px; float: right">
          <i class="fa fa-camera"></i>
        KHU CHỤP ẢNH</a>     
      @endif
      <div class="clearfix"></div>
      <div class="panel panel-default">        
        <div class="panel-body">
          
          <form class="form-inline" role="form" method="GET" action="{{ route('booking.index') }}" id="searchForm">
            
            
            
            <div class="row">
              <div class="form-group col-xs-12">              
                <select class="form-control select2" name="time_type" id="time_type">                  
                  <option value="">--Thời gian--</option>
                  <option value="1" {{ $time_type == 1 ? "selected" : "" }}>Theo tháng</option>
                  <option value="2" {{ $time_type == 2 ? "selected" : "" }}>Khoảng ngày</option>
                  <option value="3" {{ $time_type == 3 ? "selected" : "" }}>Ngày cụ thể </option>
                </select>
              </div>
              @if($time_type == 1)
            <div class="form-group col-xs-6 chon-thang">                
                <select class="form-control select2 " id="month_change" name="month">
                  <option value="">--THÁNG--</option>
                  @for($i = 1; $i <=12; $i++)
                  <option value="{{ str_pad($i, 2, "0", STR_PAD_LEFT) }}" {{ $month == $i ? "selected" : "" }}>{{ str_pad($i, 2, "0", STR_PAD_LEFT) }}</option>
                  @endfor
                </select>
              </div>
              <div class="form-group col-xs-6 chon-thang">                
                <select class="form-control select2" id="year_change" name="year">
                  <option value="">--Năm--</option>
                  <option value="2023" {{ $year == 2023 ? "selected" : "" }}>2023</option>
                  <option value="2024" {{ $year == 2024 ? "selected" : "" }}>2024</option>
                  <option value="2025" {{ $year == 2025 ? "selected" : "" }}>2025</option>
                  <option value="2026" {{ $year == 2026 ? "selected" : "" }}>2026</option>
                </select>
              </div>
            @endif
            @if($time_type == 2 || $time_type == 3)            
              <div class="form-group @if($time_type == 3) col-xs-12 @else col-xs-6 @endif">
                <input type="text" class="form-control datepicker" autocomplete="off" name="use_date_from" placeholder="@if($time_type == 2) Từ ngày @else Ngày @endif " value="{{ $arrSearch['use_date_from'] }}">
              </div>
              
              @if($time_type == 2)
              <div class="form-group col-xs-6">
                <input type="text" class="form-control datepicker" autocomplete="off" name="use_date_to" placeholder="Đến ngày" value="{{ $arrSearch['use_date_to'] }}" >
              </div>
              @endif
            @endif
            </div>                          
            <button type="submit" class="btn btn-info btn-sm">Lọc</button>
            <button type="button" id="btnReset" class="btn btn-default btn-sm">Reset</button>
          </form>         
        </div>
      </div>
      <div style="background-color: #dbdbd5;" class="table-responsive">
       
       <table class="table table-bordered" id="table_report">
              <tr>
                <th >Tổng BK</th>
                <td class="text-right">
                  {{ number_format($arrData['tong_bk']) }}
                </td>
                </tr>
              <tr>
                <th>Tổng tiền</th>
                <td class="text-right">
                  {{ number_format($arrData['tong_tien']) }}
                </td>
              </tr>
              <tr>
                <th>Tổng chiết khấu</th>
                <td class="text-right" style="color: blue; font-weight: bold;">
                  {{ number_format(($arrData['tong_tien'] - $arrData['tong_giam'])*0.2) }}
                </td>
              </tr>              
          </table>
       
             
        </div>
        
      
        <div style="text-align:center; margin-top: 10px;">
            {{ $items->appends( $arrSearch )->links() }}
          </div>  
       
          <div class="table-responsive" style="font-size: 12px;border: none;">            
            <ul style="padding: 0px; ">
             @if( $items->count() > 0 )
              <?php $i = 0; ?>
              @foreach( $items as $item )
                <?php $i ++; ?>
                <li id="row-{{ $item->id }}" class="booking" style="padding: 10px;background-color: #fff; font-size:15px;margin-bottom: 10px; border-radius: 5px; color: #2c323f"  data-id="{{ $item->id }}" data-date="{{ $item->use_date }}"> 
                <span class="label label-sm label-danger" id="error_unc_{{ $item->id }}"></span>       
                  <strong style="float: right; font-style: italic;">{{ date('d/m/Y', strtotime($item->use_date)) }}</strong><br>
                    @php $arrEdit = array_merge(['id' => $item->id], $arrSearch) @endphp
                    
                    <span style="color: #eea236; font-weight: bold;">BK{{ str_pad($item->id,5,"0",STR_PAD_LEFT) }}</span> 
                  
                    
                    <br>
                        <a style="text-transform: uppercase;font-weight:bold;" href="{{ route( 'booking.edit', $arrEdit ) }}">
                       {{ $item->name }}</a>
                    
                  @php $arrEdit = array_merge(['id' => $item->id], $arrSearch) @endphp
                   
                    <i class="glyphicon glyphicon-phone"></i> <a href="tel:{{ $item->phone }}" target="_blank">{{ $item->phone }}</a> <br>
                 <table class="table" style="margin-top:5px;margin-bottom: 10px;">
                   @foreach($item->details as $service)
                   <tr>
                     <td width="50%">{{ $service->cate->name }}</td>
                     <td width="20%">{{ $service->amount }}</td>   
                     <td width="30%" class="text-right">{{ number_format($service->total_price) }}</td>                  
                   </tr>
                   @endforeach
                 </table>  
                  - Tổng tiền: {{ number_format($item->total_price) }} 
                   
                    @if($item->commision > 0) 
                    <br>- HH: <span style="color: red;font-weight: bold;">{{ number_format($item->commision) }}</span>                    
                    @endif                    
                
                    <br>- Còn lại: {{ number_format($item->total_price-$item->commision) }} 
                    <br>- Chiết khấu: <span style="color: blue;font-weight: bold;">{{ number_format(($item->total_price - $item->commision)*0.05) }}<br>
                    @if($item->notes)                    
                    <span style="color:red; font-style: italic;">{!! nl2br($item->notes) !!}</span>
                    @endif    
                    
                    
                      <div style="clear: both;"></div>
                </li>              
              @endforeach
            @else
            <li>
              <p>Không có dữ liệu.</p>
            </li>
            @endif
            </ul>
          
          </div>
        
          
          <div style="text-align:center">
            {{ $items->appends( $arrSearch )->links() }}
          </div>       
      </div>
     
    <!-- /.col -->  
  </div> 
</section>
<!-- /.content -->
</div>
<input type="hidden" id="table_name" value="articles">
<!-- Modal -->
<div id="capnhatModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content" id="modal_content">
      
    </div>

  </div>
</div>
<style type="text/css">
  .form-group{
    margin-bottom: 10px !important;
  }
</style>

<input type="hidden" id="route_upload_tmp_image" value="{{ route('image.tmp-upload') }}"><div id="uncModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <form role="form" method="GET" action="{{ route('booking-payment.store') }}" id="dataFormPayment">
    <div class="row">
       <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">UPLOAD UNC PTT<span id="id_load_unc"></span></h3>
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
                <input type="hidden" name="booking_id" value="" id="booking_id_unc">
                 
                  <div class="form-group" style="margin-top:10px;margin-bottom:10px">  
                  <label class="col-md-3 row">Hình ảnh </label>    
                  <div class="col-md-9">
                    <img id="thumbnail_image" src="{{ old('image_url') ? Helper::showImage(old('image_url')) : URL::asset('admin/dist/img/img.png') }}" class="img-thumbnail" width="145" height="85">
                    
                    <input type="file" id="file-image" style="display:none" />
                 
                    <button class="btn btn-default" id="btnUploadImage" type="button"><span class="glyphicon glyphicon-upload" aria-hidden="true"></span> Upload</button>
                  </div>
                  <div style="clear:both"></div>
                  <input type="hidden" name="image_url" id="image_url" value="{{ old('image_url') }}"/>          
                  <input type="hidden" name="image_name" id="image_name" value="{{ old('image_name') }}"/>
                </div>                               
                  
                  <div style="clear:both"></div>              
            
                  <div class="form-group">
                    <label>Ghi chú</label>
                    <textarea class="form-control" rows="6" name="notes" id="notes">{{ old('notes') }}</textarea>
                  </div>            
                  
                 
              </div>          
                                
              <div class="box-footer">
                <button type="button" id="btnSavePayment" class="btn btn-primary btn-sm">Lưu</button>   
                <button type="button" class="btn btn-default btn-sm" id="btnLoading" style="display:none"><i class="fa fa-spin fa-spinner"></i> Đang xử lý...</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>                
              </div>
              
          </div>
          <!-- /.box -->     

        </div>
    </div>
  </form>
    </div>

  </div>
</div>
<div id="uncModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <form role="form" method="POST" action="{{ route('booking-payment.store') }}" id="dataFormPayment">
    <div class="row">
       <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">UPLOAD UNC PTT<span id="id_load_unc"></span></h3>
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
                <input type="hidden" name="booking_id" value="" id="booking_id_unc">
                  
                  <div class="form-group" >                  
                    <label>Ngày chuyển <span class="red-star">*</span></label>
                    <input type="text" class="form-control datepicker" name="pay_date" id="pay_date" value="{{ old('pay_date') }}"  autocomplete="off">
                  </div>                
                  <div class="form-group" >                  
                    <label>Số tiền <span class="red-star">*</span></label>
                    <input type="text" class="form-control number" name="amount" id="amount" value="{{ old('amount') }}" autocomplete="off">
                  </div> 
                  <div class="form-group" style="margin-top:10px;margin-bottom:10px">  
                  <label class="col-md-3 row">Hình ảnh </label>    
                  <div class="col-md-9">
                    <img id="thumbnail_image" src="{{ old('image_url') ? Helper::showImage(old('image_url')) : URL::asset('admin/dist/img/img.png') }}" class="img-thumbnail" width="145" height="85">
                    
                    <input type="file" id="file-image" style="display:none" />
                 
                    <button class="btn btn-default" id="btnUploadImage" type="button"><span class="glyphicon glyphicon-upload" aria-hidden="true"></span> Upload</button>
                  </div>
                  <div style="clear:both"></div>
                  <input type="hidden" name="image_url" id="image_url" value="{{ old('image_url') }}"/>          
                  <input type="hidden" name="image_name" id="image_name" value="{{ old('image_name') }}"/>
                </div>                               
                  
                  <div style="clear:both"></div>              
            
                  <div class="form-group">
                    <label>Ghi chú</label>
                    <textarea class="form-control" rows="6" name="notes" id="notes">{{ old('notes') }}</textarea>
                  </div>            
                  
                 
              </div>          
                                
              <div class="box-footer">
                <button type="button" id="btnSavePayment" class="btn btn-primary btn-sm">Lưu</button>   
                <button type="button" class="btn btn-default btn-sm" id="btnLoading" style="display:none"><i class="fa fa-spin fa-spinner"></i> Đang xử lý...</button>                
              </div>
              
          </div>
          <!-- /.box -->     

        </div>
    </div>
  </form>
    </div>

  </div>
</div>
<div class="modal fade" id="uncModalImg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
@stop
@section('js')
<script type="text/javascript">
  $(document).ready(function(){
    $('.img-unc').click(function(){
      $('#unc_img').attr('src', $(this).data('src'));
      $('#uncModalImg').modal('show');
    }); 
    $('#btnSavePayment').click(function(){
          $.ajax({
            url: "{{ route('booking-payment.store') }}",
            type: "GET",          
            data: {
              image_url : $('#image_url').val(),
              image_name : $('#image_name').val(),
              notes : $('#notes_payment').val(),
              booking_id : $('#booking_id_unc').val()
            },            
            beforeSend : function(){
              //$('#btnSavePayment').hide();
             // $('#btnLoading').show();
            },
            success: function (response) {
              
              window.location.reload();
            },
            error: function(response){                             
                alert('Có lỗi xảy ra');
            }
          });
    });
    $('#btnUploadImage').click(function(){        
        $('#file-image').click();
      });      
      var files = "";
      $('#file-image').change(function(e){
        $('#thumbnail_image').attr('src', "{{ URL::asset('admin/dist/img/loading.gif') }}");
         files = e.target.files;
         
         if(files != ''){
           var dataForm = new FormData();        
          $.each(files, function(key, value) {
             dataForm.append('file', value);
          });   
          
          dataForm.append('date_dir', 1);
          dataForm.append('folder', 'tmp');

          $.ajax({
            url: $('#route_upload_tmp_image').val(),
            type: "POST",
            async: false,      
            data: dataForm,
            processData: false,
            contentType: false,
            beforeSend : function(){
              $('#thumbnail_image').attr('src', "{{ URL::asset('admin/dist/img/loading.gif') }}");
            },
            success: function (response) {
              if(response.image_path){
                $('#thumbnail_image').attr('src',$('#upload_url').val() + response.image_path);
                $( '#image_url' ).val( response.image_path );
                $( '#image_name' ).val( response.image_name );
              }
              console.log(response.image_path);
                //window.location.reload();
            },
            error: function(response){                             
                var errors = response.responseJSON;
                for (var key in errors) {
                  
                }
                //$('#btnLoading').hide();
                //$('#btnSave').show();
            }
          });
        }
      });
  });
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('click', '.btnUnc',function(){     
         $('#uncModal').modal('show');
        $('#booking_id_unc').val($(this).data('id'));
        $('#id_load_unc').html($(this).data('id'));
       
      });
      $('#btnReset').click(function(){
        $('#searchForm select').val('');
        $('#searchForm').submit();
      });
    $('#searchForm input[type=checkbox]').change(function(){
        $('#searchForm').submit();
      });
    
  });
  
</script>
@stop
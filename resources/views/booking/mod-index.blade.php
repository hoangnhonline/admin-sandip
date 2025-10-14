@extends('layout')
@section('content')
<div class="content-wrapper">


<!-- Content Header (Page header) -->
<section class="content-header">
  <h1 style="text-transform: uppercase;">    
    Quản lý booking
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="{{ route( 'booking.index') }}">
    Booking 
    </a></li>
    <li class="active">List</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">

    <div class="col-md-12">
      <div id="content_alert"></div>
      @if(Session::has('message'))
      <p class="alert alert-info" >{{ Session::get('message') }}</p>
      @endif     
      
      <div class="panel panel-default">
        
        <div class="panel-body" style="padding: 5px !important;">
          <form class="form-inline" role="form" method="GET" action="{{ route('booking.index') }}" id="searchForm" style="margin-bottom: 0px;">                    
            
            <div class="form-group">              
              <select class="form-control select2" name="time_type" id="time_type">                  
                <option value="">--Thời gian--</option>
                <option value="1" {{ $time_type == 1 ? "selected" : "" }}>Theo tháng</option>
                <option value="2" {{ $time_type == 2 ? "selected" : "" }}>Khoảng ngày</option>
                <option value="3" {{ $time_type == 3 ? "selected" : "" }}>Ngày cụ thể </option>
              </select>
            </div> 
            @if($time_type == 1)
            <div class="form-group  chon-thang">                
                <select class="form-control select2" id="month_change" name="month">
                  <option value="">--THÁNG--</option>
                  @for($i = 1; $i <=12; $i++)
                  <option value="{{ str_pad($i, 2, "0", STR_PAD_LEFT) }}" {{ $month == $i ? "selected" : "" }}>{{ str_pad($i, 2, "0", STR_PAD_LEFT) }}</option>
                  @endfor
                </select>
              </div>
              <div class="form-group  chon-thang">                
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
            <div class="form-group chon-ngay">              
              <input type="text" class="form-control datepicker" autocomplete="off" name="use_date_from" placeholder="@if($time_type == 2) Từ ngày @else Ngày @endif " value="{{ $arrSearch['use_date_from'] }}" style="width: 110px">
            </div>
            @if($time_type == 2)
            <div class="form-group chon-ngay den-ngay">              
              <input type="text" class="form-control datepicker" autocomplete="off" name="use_date_to" placeholder="Đến ngày" value="{{ $arrSearch['use_date_to'] }}" style="width: 110px">
            </div>
             @endif
            @endif
            <button type="submit" class="btn btn-info btn-sm" style="margin-top: -5px">Lọc</button>
            <div class="form-group">
              <button type="button" id="btnReset" class="btn btn-default btn-sm">Reset</button>
            </div>
            <div>             
            </div>
          </form>         
        </div>
      </div>
      <div class="panel" style="margin-bottom: 15px;">
        <div class="panel-body" style="padding: 5px;">
          <div class="table-responsive">
   
         
        
            @if(Auth::user()->partner_type == 2)
            <table class="table table-bordered" id="table_report" style="margin-bottom:0px;font-size: 14px;">
                <tr style="background-color: #f4f4f4">
                  <th class="text-center">Tổng BK</th>
                  <th class="text-right">Tổng tiền</th>
                  <th class="text-right">Dù đôi</th>
                  <th class="text-right">Dù đơn</th>
                  <th class="text-right">Hoa hồng cano</th>
                  <th class="text-right">Còn lại</th>
                  <th class="text-right">Chiết khấu</th>  
                </tr>
                <tr>
                  <td class="text-center">
                    {{ number_format($arrData['tong_bk']) }}
                  </td>
                  
                    <td class="text-right">
                      {{ number_format($arrData['tong_tien']) }}
                    </td>
                    <td class="text-right">
                      {{ number_format($arrData['tong_du_doi']) }}
                    </td>
                    <td class="text-right">
                      {{ number_format($arrData['tong_du_don']) }}
                    </td>        
                    <td class="text-right">
                      {{ number_format($arrData['tong_chietkhau']) }}
                    </td>
                    <td class="text-right">
                      {{ number_format($arrData['tong_tien'] - $arrData['tong_chietkhau']) }}
                    </td>
                    <td class="text-right" style="color: blue; font-weight: bold;">
                      <?php 
                          $chiet_khau_5 = ($arrData['tong_tien'] - $arrData['tong_chietkhau'])*0.05;
                          ?>
                      @if(Auth::user()->id == 502)
                      <table class="table">
                        <tr>
                          <td>5% sau CK</td>
                          
                          <td class="text-right"> {{ number_format($chiet_khau_5) }}</td>
                        </tr>
                        <tr>
                          <td>Dù đôi</td>
                          <?php 
                          $du_doi = $arrData['tong_du_doi']*100000;
                          ?>
                          <td class="text-right"> {{ number_format($du_doi) }}</td>
                        </tr>
                        <tr>
                          <td>Dù đơn</td>
                          <?php 
                          $du_don = $arrData['tong_du_don']*50000;
                          ?>
                          <td class="text-right"> {{ number_format($du_don) }}</td>
                        </tr>
                        <tr>
                          <td>Tổng chiết khấu</td>
                          <td  class="text-right" style="color: red"> {{ number_format($chiet_khau_5 + $du_don + $du_doi)  }}</td>
                        </tr>
                      </table>
                      @else
                      {{ number_format($chiet_khau_5) }}
                      @endif
                    </td>
                </tr>
            </table>
            @else
             <table class="table table-bordered" id="table_report" style="margin-bottom:0px;font-size: 14px;">
              <tr style="background-color: #f4f4f4">
                <th class="text-center">Tổng BK</th>
                <th class="text-right">Tổng tiền</th>
                <th class="text-right">Tiền flycam</th>
                <th class="text-right">Tổng KO flycam</th>                                
                <th class="text-right">Tổng đã chi cano + HDV</th>
                <th class="text-right">Còn lại</th>
                <th class="text-right">10% sau chiết khấu</th>  
              </tr>
              <tr>
                <td class="text-center">
                  {{ number_format($arrData['tong_bk']) }}
                </td>
                  <td class="text-right">
                    {{ number_format($arrData['tong_tien']) }}
                  </td> 
                  <td class="text-right">
                  {{ number_format($arrData['tong_cam']) }}
                </td>
                <td class="text-right">
                  {{ number_format($arrData['tong_tien_ko_cam_jt']) }}
                </td>
                <td class="text-right">
                  {{ number_format($arrData['tong_chietkhau']) }}
                </td>
                <td class="text-right">
                  {{ number_format($arrData['tong_tien_ko_cam_jt'] - $arrData['tong_chietkhau']) }}
                </td>
                  <td class="text-right" style="color: blue; font-weight: bold;">
                    {{ number_format(($arrData['tong_tien_ko_cam_jt'] - $arrData['tong_chietkhau'])*0.1) }}
                  </td>
              </tr>
          </table>
            @endif
         
        </div>
        </div>
      </div>           
      <div class="box">
        
        
        @if(Auth::user()->role == 1)
        <div class="form-inline col-md-12" style="padding: 5px">
           
          <div class="form-group" style="float: right">
            <a href="javascript:;" class="btn btn-primary btn-sm" id="btnExport">Export Excel</a>
          </div>
        </div>
        @endif
        <!-- /.box-header -->
        <div class="clearfix"></div>
        <div class="box-body">
          <div style="text-align:center">
            {{ $items->appends( $arrSearch )->links() }}
          </div>  
          <div class="table-responsive">
          @if(Auth::user()->beach_id)
          <table class="table table-bordered table-hover" id="table-list-data">
            <tr style="background-color: #f4f4f4">              
              <th style="width: 1%" class="text-center" ><input type="checkbox" id="check_all" value="1"></th>
              <th width="1%">STT</th>
              <th width="1%">CODE</th>             
              <th style="width: 150px">Thông tin</th>              
              <th>Dịch vụ</th>
              <th class="text-right" >Tổng tiền</th>            
              <th class="text-right" >Chiết khấu</th>
            </tr>
            <tbody>
            @if( $items->count() > 0 )
              <?php $l = 0; ?>
              @foreach( $items as $item )
                <?php $l ++; ?>
              <tr class="booking" id="row-{{ $item->id }}" data-id="{{ $item->id }}" data-date="{{ $item->use_date }}" style="border-bottom: 1px solid #000 !important;@if($item->status == 3) background-color: #f77e7e; @endif">
                <td>
                  
                </td>
                <td class="text-center"> {{ $l }}</td>
                <td class="text-center"> <span style="color: #eea236; font-weight: bold;">BK{{ str_pad($item->id,5,"0",STR_PAD_LEFT) }}</span>
                  @if($item->bill_no)
                    - Bill : <span style="color: blue; font-weight: bold">{{ $item->bill_no }}</span>
                    @endif
                    @if($item->da_thu == 0)
                    <label class="label label-danger">CHƯA THU TIỀN</label>
                    @endif
                  </td>
                <td>
                  {{ $item->name }} / {{ $item->phone }}
                </td>
                <td>
                  <table class="table" style="margin-top:5px;margin-bottom: 10px;">
                   @foreach($item->details as $service)
                   <tr>
                     <td width="50%">{{ $service->cate->name }}</td>
                     <td width="20%">{{ $service->amount }}</td>
                     <td width="30%" class="text-right">{{ number_format($service->total_price) }}</td>
                   </tr>
                   @endforeach
                 </table>
                </td>
                <td class="text-right">
                  {{ number_format($item->total_price) }}
                </td>
               
                <td class="text-right" style="color: blue; font-weight: bold;">
                  {{ number_format(($item->total_price - $item->discount)*0.2) }}
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
          @else
            @if(Auth::user()->partner_type == 2)
              <table class="table table-bordered table-hover" id="table-list-data">
              <tr style="background-color: #f4f4f4">              
                <th style="width: 1%" class="text-center" ><input type="checkbox" id="check_all" value="1"></th>
                <th width="1%">STT</th>
                <th width="1%">CODE</th>             
                <th style="width: 150px">Thông tin</th>              
                <th>Dịch vụ</th>
                <th class="text-right" >Tổng tiền</th>
                <th class="text-right" >Hoa hồng</th>
                <th class="text-right" >Còn lại</th>
                <th class="text-right" >Chiết khấu 5%</th>
              </tr>
              <tbody>
              @if( $items->count() > 0 )
                <?php $l = 0; ?>
                @foreach( $items as $item )
                  <?php $l ++; ?>
                <tr class="booking" id="row-{{ $item->id }}" data-id="{{ $item->id }}" data-date="{{ $item->use_date }}" style="border-bottom: 1px solid #000 !important;@if($item->status == 3) background-color: #f77e7e; @endif">
                  <td>
                    
                  </td>
                  <td class="text-center"> {{ $l }}</td>
                  <td class="text-center"> <span style="color: #eea236; font-weight: bold;">BK{{ str_pad($item->id,5,"0",STR_PAD_LEFT) }}</span>
                    @if($item->bill_no)
                      - Bill : <span style="color: blue; font-weight: bold">{{ $item->bill_no }}</span>
                      @endif</td>
                  <td>
                    {{ $item->name }} / {{ $item->phone }}
                  </td>
                  <td>
                    <table class="table" style="margin-top:5px;margin-bottom: 10px;">
                     @foreach($item->details as $service)
                     <tr>
                       <td width="50%">{{ $service->cate->name }}</td>
                       <td width="20%">{{ $service->amount }}</td>
                       <td width="30%" class="text-right">{{ number_format($service->total_price) }}</td>
                     </tr>
                     @endforeach
                   </table>
                  </td>
                  <td class="text-right">
                    {{ number_format($item->total_price) }}
                  </td>
                  <td class="text-right">
                    {{ $item->commision ?number_format($item->commision) : '-' }}
                  </td>                
                  <td class="text-right">
                    {{ number_format($item->total_price - $item->commision) }}
                  </td>
                  <td class="text-right" style="color: blue; font-weight: bold;">
                    {{ number_format(($item->total_price - $item->commision)*0.05) }}
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
            @else
              <table class="table table-bordered table-hover" id="table-list-data">
              <tr style="background-color: #f4f4f4">              
                <th style="width: 1%" class="text-center" ><input type="checkbox" id="check_all" value="1"></th>
                <th width="1%">STT</th>
                <th width="1%">CODE</th>             
                <th style="width: 150px">Thông tin</th>              
                <th>Dịch vụ</th>
                <th class="text-right" >Tổng tiền</th>
                <th class="text-right" >Giảm giá</th>
                <th class="text-right" >Còn lại</th>
                <th class="text-right" >Chiết khấu</th>
              </tr>
              <tbody>
              @if( $items->count() > 0 )
                <?php $l = 0; ?>
                @foreach( $items as $item )
                  <?php $l ++; ?>
                <tr class="booking" id="row-{{ $item->id }}" data-id="{{ $item->id }}" data-date="{{ $item->use_date }}" style="border-bottom: 1px solid #000 !important;@if($item->status == 3) background-color: #f77e7e; @endif">
                  <td>
                    
                  </td>
                  <td class="text-center"> {{ $l }}</td>
                  <td class="text-center"> <span style="color: #eea236; font-weight: bold;">BK{{ str_pad($item->id,5,"0",STR_PAD_LEFT) }}</span>
                    @if($item->bill_no)
                      - Bill : <span style="color: blue; font-weight: bold">{{ $item->bill_no }}</span>
                      @endif</td>
                  <td>
                    {{ $item->name }} / {{ $item->phone }}
                  </td>
                  <td>
                    <table class="table" style="margin-top:5px;margin-bottom: 10px;">
                     @foreach($item->details as $service)
                     <tr>
                       <td width="50%">{{ $service->cate->name }}</td>
                       <td width="20%">{{ $service->amount }}</td>
                       <td width="30%" class="text-right">{{ number_format($service->total_price) }}</td>
                     </tr>
                     @endforeach
                   </table>
                  </td>
                  <td class="text-right">
                    {{ number_format($item->total_price) }}
                  </td>
                  <td class="text-right">
                    {{ $item->discount ?number_format($item->discount) : '-' }}
                  </td>                
                  <td class="text-right">
                    {{ number_format($item->total_price - $item->discount) }}
                  </td>
                  <td class="text-right" style="color: blue; font-weight: bold;">
                    {{ number_format(($item->total_price - $item->discount)*0.1) }}
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
            @endif
          
          @endif
          </div>
          <div style="text-align:center">
            {{ $items->appends( $arrSearch )->links() }}
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
<input type="hidden" id="table_name" value="articles">
@stop
<style type="text/css">
  .hdv{
    cursor: pointer;
  }
  .hdv:hover, .hdv.selected{
    background-color: #06b7a4;
    color: #FFF
  }  
  label{
    cursor: pointer;
  }
  #table_report th td {padding: 2px !important;}
  #searchForm, #searchForm input{
    font-size: 13px;
  }
  .form-control{
    font-size: 13px !important; 
  }
  .select2-container--default .select2-selection--single .select2-selection__rendered{
    
    font-size: 12px !important;
  } 
  tr.error{
    background-color:#ffe6e6
  }  
</style>
<div id="uncModal" class="modal fade" role="dialog">
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
                    <textarea class="form-control" rows="6" name="notes" id="notes_payment">{{ old('notes') }}</textarea>
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
<input type="hidden" id="route_upload_tmp_image" value="{{ route('image.tmp-upload') }}">
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
      $('#searchForm input[type=checkbox]').change(function(){
        $('#searchForm').submit();
      });
      $('tr.booking').click(function(){
        $(this).find('.check_one').attr('checked', 'checked');
      });
      $("#check_all").click(function(){
          $('input.check_one').not(this).prop('checked', this.checked);
      });
      $('#btnExport').click(function(){
        var oldAction = $('#searchForm').attr('action');
        $('#searchForm').attr('action', "{{ route('export.cong-no-tour') }}").submit().attr('action', oldAction);
      });
    
       $('.change-column-value').change(function(){
          var obj = $(this);      
          if(obj.data('column') == 'cano_id'){
           // alert('Tất cả các booking cùng HDV sẽ được gán chung vào cano này');
          }
          $.ajax({
            url : "{{ route('change-value-by-column') }}",
            type : 'GET',
            data : {
              id : obj.data('id'),
              col : obj.data('column'),
              value: obj.val()
            },
            success: function(data){
                console.log(data);
            }
          });
       });
       $('.multi-change-column-value').change(function(){
          var obj = $(this);      
          $('.check_one:checked').each(function(){
              $.ajax({
                url : "{{ route('change-value-by-column') }}",
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
     
      $('#btnReset').click(function(){
        $('#searchForm select').val('');
        $('#searchForm').submit();
      });
    });
  </script>
@stop
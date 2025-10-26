<!DOCTYPE html>
<html lang="vi">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Xác nhận đặt dịch vụ</title>        

        <!-- Bootstrap core CSS -->
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" />
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300&display=swap" rel="stylesheet" />
        <style>
            body {
                font-family: 'Rubik', sans-serif;
            }
        </style>
        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script type="text/javascript"></script>
        <script src="https://use.fontawesome.com/92c6fc74a0.js"></script>
    </head>

    <body>
        <div class="container" style="margin: 0 auto; max-width: 700px;">
            
            <table cellspacing="0" cellpadding="10" class="table table-bordered" width="100%" style="@if($detail->user_id_manage==333) color:#333; @else color:#1f497d; @endif; margin: 20px auto;">
                @if($detail->user_id_manage != 333)
                <tr>
                    <td colspan="2">
                        <img src="https://phuquocseasports.com/images/logo-light.png" alt="logo" width="130px" align="left" />
                        <div style="text-align: right; font-size: 12px; color: #5f6368;">
                            <p style="font-weight: bold; margin-top: 5px; margin-bottom: 5px;">SEA SPORTS PHÚ QUỐC</p>
                            <i class="fa fa-map-marker" aria-hidden="true"></i> <b>Bãi Sao, An Thới, Phú Quốc</b>
                                                    
                            
                        </div>
                         <h4 class="text-center" style="color: #ff9d00;clear: both;margin-top: 20px;">HÓA ĐƠN DỊCH VỤ</h4>
                    </td>                              
                </tr>
                @else
                <tr>
                    <td colspan="2" class="text-center">
                        <img src="{{ asset('images/logo-group.jpg') }}" alt="logo" width="120px" />
                         <h4 class="text-center" style="color: #ff9d00;clear: both;">XÁC NHẬN ĐẶT DỊCH VỤ</h4>
                    </td>                              
                </tr>
                @endif
                <tr>
                    <td width="110">
                        Mã booking
                    </td>
                    <td>                        
                        <span style="font-weight: bold;font-size: 20px;color: red">BK{{ str_pad($detail->id,5,"0",STR_PAD_LEFT) }}</span>
                        
                    </td>
                </tr>
               

                <tr>
                    <td>
                         Ngày sử dụng:
                    </td>
                    <td>
                        {{ date('d/m/Y', strtotime($detail->use_date)) }}
                    </td>
                </tr>

                <tr>
                    <td>
                        Tên KH
                    </td>
                    <td>
                        {{ $detail->name }}
                    </td>
                </tr>
                <tr>
                    <td>
                        Số điện thoại:
                    </td>
                    <td>
                        {{ $detail->phone }}
                    </td>
                </tr>
                
                <tr>
                    <td>
                       Dịch vụ
                    </td>
                    <td>
                        <table class="table table-bordered" style="margin-top:5px;margin-bottom: 10px;">
                           @foreach($detail->details as $service)
                           <tr>
                             <td width="50%">{{ $service->cate->name }}</td>
                             <td width="20%">{{ $service->amount }} vé</td>
                             <td width="30%" class="text-right">{{ number_format($service->total_price) }} VNĐ</td>
                           </tr>
                           @endforeach
                         </table>
                    </td>
                </tr>
                @if($detail->discount)
                <tr>
                    <td>Giảm giá</td>
                    <td>
                        {{ number_format($detail->discount) }}
                    </td>
                </tr>
                @endif
                @if($detail->tien_coc)
                <tr>
                    <td>Tiền cọc</td>
                    <td>
                        {{ number_format($detail->tien_coc) }}
                    </td>
                </tr>
                @endif
                <tr>
                    <td>Tổng tiền</td>
                    <td>
                        {{ number_format($detail->total_price) }}
                    </td>
                </tr>
                
                <tr>
                    <td>
                        Thanh toán
                    </td>
                    <td style="color: red; font-weight: bold;">
                        {{ number_format($detail->total_price - $detail->discount - $detail->tien_coc)}}
                    </td>
                </tr>
                @if($detail->notes)
                <tr>
                    <td>
                        Ghi chú
                    </td>
                    <td>
                         {!! nl2br($detail->notes ) !!}
                    </td>
                </tr>
                @endif
                
                <tr>
                    <td>
                        Hotline
                    </td>
                    <td>
                        <span style="font-weight: bold; font-size: 16px; color: red;">0901.424.868
                        </span>
                    </td>
                </tr>
            </table>
        </div>
    </body>
   
</html>

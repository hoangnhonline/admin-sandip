<!DOCTYPE html>
<html lang="vi">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>email</title>

        <!-- Bootstrap core CSS -->
        <link href="../../dist/css/bootstrap.min.css" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" />
        <style>
            body {
                font-family: "Roboto" !important;
            }
        </style>
        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script type="text/javascript"></script>
        <style type="text/css">
            body {
                font-family: DejaVu Sans;
            }
        </style>
    </head>

    <body>
        <div class="container" style="margin: 0 auto; max-width: 700px;">
            <a target="_blank" href="{{ route('pdf-tour',['id' => $detail->id]) }}" style="padding: 5px 10px; background-color: red; color: #fff; text-decoration: none; margin-bottom: 20px; display: block; text-align: center;">Xuất PDF </a>
            <table border="1" cellspacing="0" cellpadding="10" class="table table-bordered" width="100%" style="color: #1f497d; margin: 0 auto;">
                <tr>
                    <td colspan="2">
                        <img src="{{ asset('images/logo-plan-to-travel.png') }}" alt="logo" width="130px" align="left" />
                        <div style="text-align: right; font-size: 12px; color: #5f6368;">
                            <p style="font-weight: bold; margin-top: 5px; margin-bottom: 5px;">CTY TNHH TMDV & DU LỊCH PLAN TO TRAVEL</p>
                            ĐC: <b>124 Trần Hưng Đạo, Dương Tơ, Phú Quốc, KG</b>
                            <br />
                            MST: <b>0315788585</b>
                            <br />
                            Hotline: <b>0911 380 111</b>
                        </div>
                    </td>
                </tr>
                <tr style="clear: both;">
                    <td colspan="2" style="text-align: center;">
                        <h3>XÁC NHẬN ĐẶT TOUR</h3>
                    </td>
                </tr>

                <tr>
                    <td width="170">
                        Mã booking
                    </td>
                    <td>
                        <span style="font-weight: bold; font-size: 20px; color: red;">PTT{{$detail->id}}</span>
                    </td>
                </tr>
                <tr>
                    <td width="170">
                        Loại tour
                    </td>
                    <td>
                        <?php 
            if($detail->tour_id == 1){ $loai_tour = '4 ĐẢO'; }elseif($detail->tour_id == 2){ $loai_tour = '2 ĐẢO'; }else{ $loai_tour = 'RẠCH VẸM'; } ?> {{ $loai_tour }} /
                        <?php 
            if($detail->tour_type == 1){ $tour_type = 'Tour ghép'; }elseif($detail->tour_type == 2){ $tour_type = 'Tour VIP'; }else{ $tour_type = 'Thuê cano'; } ?> {{ $tour_type }}
                    </td>
                </tr>

                <tr>
                    <td>
                        Ngày đi:
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
                        Nơi đón
                    </td>
                    <td>
                        @if($detail->location_id) {{ $detail->location->name }} @else {{ $detail->address }} @endif
                    </td>
                </tr>
                <tr>
                    <td>
                        Người lớn/Trẻ em/Em bé
                    </td>
                    <td>
                        {{ $detail->adults }}/{{ $detail->childs }}/{{ $detail->infants }}
                    </td>
                </tr>
                <tr>
                    <td>
                        Số phần ăn
                    </td>
                    <td style="font-weight: bold;">
                        <?php 
              $meals = $detail->meals; if($meals > 0){ $meals+= $detail->childs/2; } ?> {{ $meals }}
                    </td>
                </tr>
                @if($detail->extra_fee)
                <tr>
                    <td>Phụ thu</td>
                    <td>
                        {{ number_format($detail->extra_fee) }}
                    </td>
                </tr>
                @endif @if($detail->discount)
                <tr>
                    <td>Giảm giá</td>
                    <td>
                        {{ number_format($detail->discount) }}
                    </td>
                </tr>
                @endif
                <tr>
                    <td>Tổng tiền</td>
                    <td>
                        {{ number_format($detail->total_price) }}
                    </td>
                </tr>
                @if($detail->tien_coc) @if($detail->tien_coc == $detail->total_price)
                <tr>
                    <td colspan="2">
                        ĐÃ THANH TOÁN
                    </td>
                </tr>
                @else
                <tr>
                    <td>
                        Tiền cọc
                    </td>
                    <td style="color: red; font-weight: bold;">
                        {{ number_format($detail->tien_coc) }}
                    </td>
                </tr>
                <tr>
                    <td>
                        Còn lại
                    </td>
                    <td style="color: red; font-weight: bold;">
                        {{ number_format($detail->con_lai)}}
                    </td>
                </tr>
                @endif @endif

                <tr>
                    <td>
                        Ghi chú
                    </td>
                    <td>
                        @if($detail->notes) {!! nl2br($detail->notes ) !!} @endif
                    </td>
                </tr>
                <tr>
                    <td>
                        Sales
                    </td>
                    <td style="font-weight: bold;">
                        {{ $sales }} - {{ $sales_phone }}
                    </td>
                </tr>
                <tr>
                    <td>
                        Hotline
                    </td>
                    <td>
                        <span style="font-weight: bold; font-size: 16px; color: red;">0911.380.111</span>
                    </td>
                </tr>
            </table>
        </div>
    </body>
</html>

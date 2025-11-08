<style type="text/css">
    p div td tr th span{
        font-size: 13px !important;
    }
    @media print {
        p div td tr th span{
            font-size: 11px !important;
        }
      #print-btn {
        display: none !important;
      }
    }
</style>
<p><button id="print-btn" onclick="window.print()">🖨️ In hóa đơn</button></p>
<br>
<div style="font-size: 13px; width: 220px;">
<span style="font-size:13px; text-align: center;">SANDIP INDIAN RESTAURANT</span><br>
<span style="font-size:13px; text-align: center;">A09-A11-A13 Le Loi street, Duong Dong</span><br>
<span style="font-size:13px; text-align: center;">Hotline: +84325005781</span>
<br>
---
<br>
<span>Invoice: #{{ str_pad($detail->id,5,"0",STR_PAD_LEFT) }} {{ date('m/d/y H:i') }}</span><br>
---
<br>
<table cellpadding="2" cellspacing="0" border="0">    
    <tr style="font-size:13px;">
        <td style="border-bottom: 1px dotted #000 !important;">DISH NAME</td>
        <td style="text-align: right;border-bottom: 1px dotted #000 !important;">DETAIL</td>       
       
    </tr>
    @php
    $total = 0;
    @endphp
    @foreach($detail->details as $item)
    @php
    $total+= $item->total_price;
    @endphp
    <tr style="font-size:13px; ">
        <td  style="text-transform: capitalize !important;border-bottom: 1px dotted #000 !important;">{{ ucwords($item->dish->name) }}</td>
        <td style="text-align: right;border-bottom: 1px dotted #000 !important;">{{ number_format($item->price) }}
           
        x {{ $item->amount }}<br>
        = {{ number_format($item->total_price) }}
        </td>
    </tr>
    @endforeach
    <tr style="font-size:13px !important;">
        <td style="text-align: right;">TOTAL</td>
        <td style="text-align: right;">{{ number_format($total) }}</td>       
       
    </tr>

</table>
<p style="text-align:center">*** THANK YOU ***</p>
</div>

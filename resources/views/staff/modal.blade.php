<div style='display: flex; justify-content: center; margin-bottom: 20px'>
    <img id='thumbnail_image' src='{{ $detail->image_url ? Helper::showImageNew($detail->image_url) : asset('admin/dist/img/user.png') }}  ' class='img-thumbnail' width='145' height='85'>
</div>
<table class='table-modal table table-bordered'>
    <tr>
        <th>Họ tên</th>
        <td>{{ $detail->name }} </td>
    </tr>
    <tr>
        <th>Ngày sinh</th>
        <td>{{  date('d/m/Y', strtotime($detail->birthday)) }}</td>
    </tr>
    <tr>
        <th>Bộ phận</th>
        <td>{{ $detail->department->name }}  {{ $detail->is_leader == 1 ? "(LEADER)" : "" }}</td>
    </tr>
    <tr>
        <th>Chi nhánh</th>
        <td>{{ $detail->city_id == 1 ? "Phú Quốc" : "Đà Nẵng" }}</td>
    </tr>
    <tr>
        <th>Số điện thoại</th>
        <td>{{ $detail->phone }}</td>
    </tr>
    <tr>
        <th>Email</th>
        <td>{{ $detail->email }}</td>
    </tr>
    <tr>
        <th>Ngày gia nhập</th>
        <td>{{ date('d/m/Y', strtotime($detail->date_join)) }} </td>
    </tr>
    <tr>
        <th>Lương</th>
        <td>{{ number_format($detail->salary) }}đ</td>
    </tr>

    
</table>
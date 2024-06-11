<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tra cứu</title>
    <link rel="stylesheet" href="">
</head>
<style>
    a{
        text-decoration: none;
    }
</style>
<body style="margin: auto;">
    <div style="margin-left: 50%; transform: translateX(-50%);">
    @foreach($hmtl_tickets as $hmtl_ticket)
    {!!$hmtl_ticket!!}
    @endforeach
    </div>
    @if ($response !== null) 
    <div><h1 style="color: red;">Tra cứu hóa đơn đang được bảo trì, quý khách vui lòng quay lại sau!</h1></div>
    @endif
    @if ($url !== null) 
    <div>
        <h1>Hóa đơn được lưu về dưới dạng .pdf hoặc .zip. Bạn có muốn tiếp tục? <a href="{{$url ?? ''}}">Có </a><a href="https://www.google.com/" target="_blank">Không</a></h1>
        <p style="color:red;">Lưu ý sử dụng trình duyệt để lưu .zip</p>
    </div>
    @endif
</body>
</html>







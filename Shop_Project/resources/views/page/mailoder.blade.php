<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Dear {{cus_name}}</h2>
    <h3>Your order:</h3>
    @foreach($product as $item)
    <div class ="media">
        <img width="25%" src="source/image/product/{{$item['item']['image']}}" alt="" class="pull-left">
        <div class="media-body">
            <p class="color-gray your-order-infor">{{$item->name}}
        </div>
    <div>
    @endforeach
    <div>
        Total order: {{$total}} dongs
    </div>
</body>
</html>
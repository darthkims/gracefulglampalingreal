<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>

    <link rel="stylesheet" href="{{ public_path('customer/pdf.css') }}" type="text/css"> 

</head>
<body>
    <table class="w-full">
        <tr>
            <td class="w-half">
                <img src="{{ public_path('customer')}}/img/gg_full.png" alt="gracefulglam" width="200" />
            </td>
            <td class="w-half">
                <h2>Invoice ID: {{ $orders->order_number }}</h2>
            </td>
        </tr>
    </table>
 
    <div class="margin-top">
        <table class="w-full">
            <tr>
                <td class="w-half">
                    <div><h4>To:</h4></div>
                    <div>{{ $userData['name'] }}</div>
                    <div>{{ $userData['address'] }}</div>
                </td>
                <td class="w-half">
                    <div><h4>From:</h4></div>
                    <div>Graceful Glam</div>
                    <div>Mydin MITC</div>
                </td>
            </tr>
        </table>
    </div>
 
    <div class="margin-top">
        <table class="products">
            <tr>
                <th>Qty</th>
                <th>Description</th>
                <th>Price (RM)</th>
            </tr>
            @foreach($data as $item)
            <tr class="items">
                
                    <td>
                        {{ $item['quantity'] }}
                    </td>
                    <td>
                        {{ $item['description'] }}
                    </td>
                    <td>
                        {{ $item['price'] }}
                    </td>
                
            </tr>
            @endforeach
        </table>
    </div>
 
    <div class="total">
        Total: RM{{ number_format($totalPrice, 2) }}
    </div>
 
    <div class="footer margin-top">
        <div>Thank you</div>
        <div>&copy; Graceful Glam</div>
    </div>
</body>
</html>
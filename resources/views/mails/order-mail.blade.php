<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تأكيد طلبك - متجر المكياج</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f3f3f3;
            margin: 0;
            padding: 0;
            direction: rtl;
        }

        .email-container {
            max-width: 600px;
            margin: auto;
            background-color: #ffffff;
            border-radius: 10px;
            padding: 20px;
        }

        .header {
            text-align: center;
            color: #d63384;
        }

        .product-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .product-table th, .product-table td {
            border: 1px solid #eee;
            padding: 10px;
            font-size: 14px;
            text-align: center;
        }

        .product-table th {
            background-color: #f9f9f9;
        }

        .product-image {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 6px;
        }

        .total-row td {
            font-weight: bold;
            background-color: #f0f0f0;
        }

        .footer {
            margin-top: 30px;
            color: gray;
            font-size: 13px;
            text-align: center;
        }

        @media only screen and (max-width: 600px) {
            .email-container {
                padding: 10px;
            }

            .product-table th, .product-table td {
                font-size: 12px;
                padding: 6px;
            }

            .product-image {
                width: 40px;
                height: 40px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <h2 class="header">شكراً لطلبك من متجرنا 💄</h2>
        <p>مرحباً {{ $user->name }}،</p>
        <p>تم تأكيد طلبك بنجاح، التفاصيل كالتالي:</p>

        <table class="product-table">
            <thead>
                <tr>
                    <th>الصورة</th>
                    <th>المنتج</th>
                    <th>السعر</th>
                    <th>الكمية</th>
                    <th>الإجمالي</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach($order as $product)
                    @php
                        $subtotal = $product->price * $product->pivot->number_of_copies;
                        $total += $subtotal;
                    @endphp
                    <tr>
                        <td>
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="product-image">
                        </td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->price }}$</td>
                        <td>{{ $product->pivot->number_of_copies }}</td>
                        <td>{{ $subtotal }}$</td>
                    </tr>
                @endforeach
                <tr class="total-row">
                    <td colspan="4">المجموع الكلي</td>
                    <td>{{ $total }}$</td>
                </tr>
            </tbody>
        </table>

        <div class="footer">
            <p>📦 سنقوم بشحن طلبك في أقرب وقت.</p>
            <p>📞 لأي استفسار، لا تترددي في التواصل معنا.</p>
        </div>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>فاتورة الطلب رقم {{ $order->id }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: 'Cairo', Tahoma, Arial, sans-serif;
            background: #f8fafc;
            color: #22223b;
            margin: 0;
            padding: 0;
            font-size: 0.93rem;
        }

        .print-btn {
            text-align: center;
            margin-top: 20px;
        }

        .receipt-container {
            max-width: 600px;
            margin: 40px auto;
            background: #fff;
            border: 2px dashed #bbb;
            border-radius: 12px;
            padding: 24px 12px;
            box-shadow: 0 2px 8px 0 rgba(0,0,0,0.04);
            font-size: 0.97rem;
        }
        .receipt-header {
            text-align: center;
            margin-bottom: 18px;
        }
        .receipt-header h2 {
            margin-bottom: 4px;
            font-weight: 700;
            letter-spacing: 2px;
            font-size: 1.15rem;
        }
        .receipt-header .text-muted {
            color: #888;
            font-size: 0.95rem;
        }
        .receipt-section {
            margin-bottom: 12px;
        }
        .receipt-section strong {
            min-width: 90px;
            display: inline-block;
        }
        .receipt-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 1rem;
            margin-bottom: 0;
        }
        .receipt-table th, .receipt-table td {
            padding: 6px 4px;
            text-align: right;
            font-size: 0.97rem;
        }
        .receipt-table th {
            border-bottom: 1px solid #eee;
            background: #f8fafc;
            font-weight: 700;
        }
        .receipt-table td {
            border-bottom: 1px solid #f3f3f3;
        }
        .receipt-summary {
            text-align: left;
            margin-top: 10px;
            font-size: 0.93rem;
        }
        .receipt-total {
            font-size: 1rem;
            font-weight: bold;
        }
        .receipt-footer {
            text-align: center;
            color: #888;
            font-size: 1rem;
            margin-top: 24px;
        }
        @media print {
            body { background: #fff; }
            .print-btn { display: none !important; }
            .receipt-container { box-shadow: none; border: 1px dashed #bbb; }
        }
    </style>
</head>
<body>
<div class="text-center mt-4 print-btn">
    <button onclick="window.print()" class="btn btn-outline-dark px-4"><i class="fa fa-print ms-2"></i>طباعة الفاتورة</button>
</div>
<div class="receipt-container">
    <div class="d-flex justify-content-between align-items-center mb-2" style="display:flex;justify-content:space-between;align-items:center;">
        <div class="receipt-brand text-end" style="min-width:140px;">
            <img src="{{ asset('images/favicon-32x32.png') }}" alt="فستان ريهام" style="width:40px;height:40px;vertical-align:middle;">
            <span class="fw-bold" style="color: font-size:0.9rem;vertical-align:middle;">فستان ريهام | Reham Dress</span>
        </div>
        <div class="flex-grow-1"></div>
    </div>
    <div class="receipt-header text-center flex-grow-1 mb-2">
        <h2>فاتورة شراء</h2>
        <div class="text-muted">رقم الطلب: {{ $order->id }}</div>
        <div class="text-muted">تاريخ: {{ $order->created_at->format('Y-m-d H:i') }}</div>
    </div>
    <hr>
    <div class="row g-2 receipt-section" style="display: flex; flex-wrap: wrap;">
        <div class="col-6" style="flex:1 1 50%; min-width:180px;">
            <strong>العميل:</strong> {{ $order->user->name ?? '-' }}<br>
            <strong>البريد الإلكتروني:</strong> {{ $order->user->email ?? '-' }}<br>
            <strong>رقم الهاتف:</strong> {{ $order->phone }}
        </div>
        <div class="col-6" style="flex:1 1 50%; min-width:180px;">
            <strong>طريقة الدفع:</strong> {{ $order->payment_method == 'COD' ? 'الدفع عند الاستلام' : 'بطاقة ائتمان' }}<br>
            <strong>العنوان:</strong> {{ $order->address }}
        </div>
    </div>
    <hr>
    <div class="receipt-section">
        <strong>تفاصيل المنتجات:</strong>
        <table class="receipt-table">
            <thead>
                <tr>
                    <th>المنتج</th>
                    <th>اللون</th>
                    <th>المقاس</th>
                    <th>الكمية</th>
                    <th>السعر</th>
                    <th>المجموع</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->orderItems as $item)
                <tr>
                    <td>{{ $item->product ? $item->product->name : 'منتج غير متوفر' }}</td>
                    <td>{{ $item->color }}</td>
                    <td>{{ $item->age }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->price }} د.أ</td>
                    <td>{{ $item->price * $item->quantity }} د.أ</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <hr>
    <div class="receipt-summary" style="font-size:0.93rem;">
        <div><strong>المجموع الفرعي:</strong> {{ $order->total_amount + $order->discount_amount - $order->shipping_fee }} د.أ</div>
        <div><strong>رسوم الشحن:</strong> {{ number_format($order->shipping_fee, 2) }} د.أ</div>
        @if ($order->discount_amount > 0)
        <div class="text-success">
            <strong>الخصم ({{ $order->coupon->code }}):</strong> -{{ $order->discount_amount }} د.أ
        </div>
        @endif
        <div class="receipt-total mt-2" style="font-size:1rem;">المجموع الكلي: {{ $order->total_amount }} د.أ</div>
    </div>
    <div class="receipt-footer">
        شكراً لتسوقك معنا!
    </div>
</div>
</body>
</html>
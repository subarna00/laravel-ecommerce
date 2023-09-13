<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Bill</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 7px 10px;
        }

        .centers {
            width: 80vw;
            flex-direction: column;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 24px;
        }

        .logo {
            display: block;
            max-width: 100px;
            max-height: 100px;
            object-fit: contain;
            margin-left: auto;
            margin-right: auto;
        }

        p {
            /* text-align: center; */
        }

        .company_name {
            font-weight: 700;
            font-size: 20px;
            margin-bottom: 10px;
        }

        .company_address {
            font-size: 14px;
        }



        table {
            margin-left: auto;
            margin-right: auto;
        }
        .mx-auto{
            margin-right: auto;
            margin-left: auto;
        }
    </style>
</head>

<body>
    <div class="centers">
<center>
    <img src="{{ public_path('images/' . $siteSetting->logo) }}" alt="" class="logo mx-auto">
    <div class="company_name mx-auto">
        {{ $siteSetting->name }}
    </div>
    <div class="company_address mx-auto">
        {{ $siteSetting->email }} <br> {{ $siteSetting->number }} ,{{ $siteSetting->address }}
    </div>

    <p class="order_id " style="margin-top: 10px">
        <span style="">Invoice ID: {{ $orders->id }}</span>
        <span style="margin-left:300px">Date: {{ date('Y/m/d') }}</span>
    </p>
</center>

        <div class="invoice">
            <table>
                <thead>
                    <tr>
                        <th>S.N</th>
                        <th>Item</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Amount</th>
                    </tr>
                </thead>

                <?php
                $totalPrice = 0;
                ?>
                <tbody>
                    @foreach ($orders->orderProducts ?? [] as $key => $op)
                        <?php $totalPrice += $op->total; ?>
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $op->product->name }}</td>
                            <td>Rs. {{ $op->price }}</td>
                            <td>{{ $op->quantity }}</td>
                            <td>Rs. {{ $op->total }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="3"></td>

                        <td>Total</td>
                        <td>Rs. {{ $totalPrice ?? '' }}</td>
                    </tr>

                </tbody>
            </table>

        </div>
        <div class="digital_s " style="max-width: 500px;margin-right:auto;margin-left:auto" >
            <div class="" style="max-width:350px;margin-top:10px">
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Et, sunt.</p>
            </div>
            <div class="" style="float:right;margin-top:-30px">
                <img src="{{ public_path('images/' . $siteSetting->digital_s) }}" alt="" style="max-height:60px;width:100px;object-fit:contain;">
                <div style="border-top: 1px solid black;padding-top:10px;width:100px;text-align:center;margin-top:10px">Signature</div>
            </div>

        </div>
    </div>
</body>

</html>

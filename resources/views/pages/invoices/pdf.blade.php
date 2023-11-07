<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Накладная</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #f0f0f0;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #333;
            padding: 10px;
        }

        .photo {
            margin-top: 20px;
            max-width: 100%; /* Чтобы фото не превышало ширину контейнера */
        }
    </style>
</head>
<body>
    <div class="container">
        @if($company)
        <h3>{{$company}}</h3><br><br>
        @endif
        <h1 style="color: #333; text-align: center;">Накладная</h1>

        <label>Магазин:</label>
        <span>{{$shop}}</span><br>

        <label>Экспедитор:</label>
        <span>{{$expeditor}}</span><br>

        <label>Тип оплаты:</label>
        <span>{{$payment_type}}</span><br>

        <table>
            <tr>
                <th>Продукт</th>
                <th>Стоимость</th>
                <th>Передано</th>
                <th>Сумма</th>
            </tr>
            @foreach ($products as $product)
            @if($product['input_count2']!=0)
            <tr>
                <td>{{$product['input_name']}}</td>
                <td>{{$product['input_count1']}}</td>
                <td>{{$product['input_count2']}}</td>
                <td>{{$product['input_count1']*$product['input_count2']}}</td>
            </tr>
            @endif
            @endforeach
            <!-- <tr>
                <td>Продукт 2</td>
                <td>5</td>
            </tr> -->
        </table>
        <br>
        <label>Дата:</label>
        <span>{{$date}}</span>
        <br>
        <label>Общая сумма:</label>
        <span>{{$sum_price}}</span>
    </div>
</body>
</html>

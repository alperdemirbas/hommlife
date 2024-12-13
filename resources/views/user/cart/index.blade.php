<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sepetim</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 50px auto;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 15px;
            text-align: center;
        }

        th {
            background-color: #333;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .product-name {
            text-align: left;
        }

        .product-image img {
            width: 60px;
            height: 60px;
            border-radius: 5px;
            object-fit: cover;
        }

        .quantity-buttons {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .quantity-buttons button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 8px 12px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .quantity-buttons button:hover {
            background-color: #0056b3;
        }

        .quantity-buttons input {
            width: 40px;
            text-align: center;
            margin: 0 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
            height: 35px;
        }

        .btn-delete {
            background-color: #ff4d4d;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-delete:hover {
            background-color: #cc0000;
        }

        .total-price {
            font-size: 18px;
            text-align: right;
            font-weight: bold;
            margin-top: 10px;
        }

        .btn-checkout {
            display: block;
            width: 100%;
            padding: 15px;
            background-color: #28a745;
            color: #fff;
            text-align: center;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-checkout:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Sepetim</h1>

    <!-- Sepet tablosu -->
    <table>
        <thead>
        <tr>
            <th>Ürün Resmi</th>
            <th>Ürün Adı</th>
            <th>Fiyat</th>
            <th>Adet</th>
            <th>Toplam</th>
            <th>İşlemler</th>
        </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
                <tr>
                    <td class="product-image"><img src="https://via.placeholder.com/60" alt="Ürün Resmi"></td>
                    <td class="product-name">{{ $item->product->name }}</td>
                    @if($item->is_gift)
                        <td>0.00 ₺</td>
                        <td>1</td>
                        <td>0.00 ₺</td>
                        <td></td>
                    @else
                        <td>{{ $item->product->price }} ₺</td>
                        <td>
                            <div class="quantity-buttons">
                                <form class="quantityUpdate" method="POST" action="{{ route('carts.update', ['cart' => $item->id]) }}">
                                    @method('PUT')
                                    @csrf
                                    <button type="button" class="decrement">-</button>
                                    <input type="number" class="quantity" name="quantity" value="{{ $item->quantity }}" min="1">
                                    <button type="button" class="increment">+</button>
                                </form>
                            </div>
                        </td>
                        <td>{{ $item->product->price * $item->quantity }} ₺</td>
                        <td>
                            <form method="POST" action="{{ route('carts.destroy', ['cart' => $item->id]) }}">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn-delete">Sil</button>
                            </form>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Toplam fiyat ve ödeme butonu -->
    <div class="total-price">
        Toplam: {{ $total }} ₺
    </div>

    <form method="POST" action="{{ route('orders.store') }}">
        @csrf
        <button type="submit" class="btn-checkout">Ödeme Yap</button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const decrementButtons = document.querySelectorAll('.decrement');
        const incrementButtons = document.querySelectorAll('.increment');
        const quantityInputs = document.querySelectorAll('.quantity');
        const quantityUpdate = document.querySelectorAll('.quantityUpdate');

        // Azaltma butonuna tıklama olayı
        decrementButtons.forEach(button => {
            button.addEventListener('click', function() {
                const form = this.closest('form');
                const input = this.nextElementSibling; // Input elemanı
                let currentValue = parseInt(input.value);
                if (currentValue > 1) {
                    input.value = currentValue - 1;
                    form.submit();
                }
            });
        });

        // Artırma butonuna tıklama olayı
        incrementButtons.forEach(button => {
            button.addEventListener('click', function() {
                const form = this.closest('form');
                const input = this.previousElementSibling; // Input elemanı
                let currentValue = parseInt(input.value);
                input.value = currentValue + 1;
                form.submit();
            });
        });

        // Input doğrudan değiştirildiğinde minimum kontrolü
        quantityInputs.forEach(input => {
            input.addEventListener('change', function() {
                if (input.value < 1) input.value = 1; // Değer 1'in altına inemez
            });
        });
    });
</script>

</body>
</html>

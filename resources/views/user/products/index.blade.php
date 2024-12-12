<style>
    body {
        font-family: Arial, sans-serif;
    }

    .container {
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    .product-list {
        display: flex;
        flex-wrap: wrap;
    }

    .product-item {
        width: 30%;
        margin: 1.66%;
        border: 1px solid #ccc;
        border-radius: 10px;
        padding: 15px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .product-item img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 10px;
    }

    .product-item h3 {
        margin: 15px 0;
        font-size: 18px;
        color: #333;
    }

    .product-item p {
        font-size: 16px;
        color: #555;
        margin-bottom: 10px;
    }

    .btn-detail {
        display: inline-block;
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
    }

    .btn-detail:hover {
        background-color: #0056b3;
    }
</style>
</head>
<body>

<div class="container">
    <h1>Ürün Listesi</h1>

    <div class="product-list">
        @forelse($products as $index => $product)
            <div class="product-item">
                <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
                <h3>{{ $product->name }}</h3>
                <p>Fiyat: {{ number_format($product->price, 2) }} TL</p>
                <a href="{{ route('product.get', $product->id) }}" class="btn-detail">Detay</a>
            </div>

            @if(($index + 1) % 3 === 0)
                <div style="width: 100%; height: 10px;"></div>
            @endif
        @empty
            <p>Henüz ürün eklenmedi.</p>
        @endforelse
    </div>
</div>


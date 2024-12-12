@if($product)
    <h2>Ürün Adı: {{ $product->name }}</h2>
    <p><strong>Fiyat:</strong> {{ number_format($product->price, 2) }} TL</p>

    @if($product->image)
        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" width="300">
    @else
        <p>Bu ürünün resmi mevcut değil.</p>
    @endif
    <p><button class="bg-blend-darken">Sepete Ekle</button></p>
@else
    <p>Ürün bulunamadı.</p>
@endif


    <h1>Kampanya Dönem Ürünleri</h1>

    <a href="{{ route('admin.campaigns.periods.products.create') }}" class="btn btn-primary">Yeni Ürün Ekle</a>

    @foreach ($products as $product)
        <div class="card mt-4">
            <h2>Dönem: {{ $product->period->name }}</h2>
            <p><strong>Ürün Adı:</strong> {{ $product->product->name ?? 'Ürün Adı Yok' }}</p>

            <a href="{{ route('admin.campaigns.periods.products.edit', $product->id) }}" class="btn btn-warning">Düzenle</a>

            <form action="{{ route('admin.campaigns.periods.products.destroy', $product->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Sil</button>
            </form>
        </div>
    @endforeach


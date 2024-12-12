    <h1>Dönem Ürününü Düzenle</h1>

    <form action="{{ route('admin.campaigns.periods.products.update', $product->id) }}" method="POST">
        @csrf
        @method('PATCH')

        <label for="period_id">Dönem</label>
        <input type="number" name="period_id" value="{{ $product->period_id }}" required>

        <label for="product_id">Ürün</label>
        <input type="number" name="product_id" value="{{ $product->product_id }}" required>

        <button type="submit" class="btn btn-success">Güncelle</button>
    </form>

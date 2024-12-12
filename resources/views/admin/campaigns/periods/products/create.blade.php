<h1>Yeni Ürün Ekle</h1>

<form action="{{ route('admin.campaigns.periods.products.store') }}" method="POST">
    @csrf
    <label for="period_id">Dönem</label>
    <input type="number" name="period_id" required>

    <label for="product_id">Ürün</label>
    <input type="number" name="product_id" required>

    <button type="submit" class="btn btn-success">Ekle</button>
</form>

<h1>Ürünü Düzenle</h1>
<form action="{{ route('admin.products.update', $product->id) }}" method="POST">
    @csrf
    @method('PUT')
    <input type="text" name="name" value="{{ $product->name }}" required>
    <input type="number" name="price" value="{{ $product->price }}" required>
    <button type="submit">Güncelle</button>
</form>

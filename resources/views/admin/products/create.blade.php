<h1>Yeni Ürün Ekle</h1>
<form action="{{ route('admin.products.store') }}" method="POST">
    @csrf
    <input type="text" name="name" placeholder="Ürün Adı" required>
    <input type="text" name="code" placeholder="Ürün Kodu" required>
    <input type="number" name="price" placeholder="Fiyat" required>
    <input type="text" name="image" placeholder="Resim" required>
    <button type="submit">Kaydet</button>
</form>

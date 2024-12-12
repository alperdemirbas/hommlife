<h1>Yeni Kampanya Ekle</h1>

<form action="{{ route('admin.campaign.store') }}" method="POST">
    @csrf
    <label for="name">Kampanya Adı</label>
    <input type="text" name="name" required>

    <label for="start_date">Başlangıç Tarihi</label>
    <input type="date" name="start_date" required>

    <label for="end_date">Bitiş Tarihi</label>
    <input type="date" name="end_date" required>

    <label for="description">Açıklama</label>
    <textarea name="description"></textarea>

    <button type="submit" class="btn btn-success">Ekle</button>
</form>

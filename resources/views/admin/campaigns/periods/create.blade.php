<h1>Yeni Dönem Ekle</h1>

<form action="{{ route('admin.campaigns.periods.store') }}" method="POST">
    @csrf
    <label for="name">Dönem Adı</label>
    <input type="text" name="name" required>

    <label for="campaign_id">Kampanya</label>
    <input type="number" name="campaign_id" required>

    <label for="start_date">Başlangıç Tarihi</label>
    <input type="date" name="start_date" required>

    <label for="end_date">Bitiş Tarihi</label>
    <input type="date" name="end_date" required>

    <label for="min_price">Minimum Sepet Tutarı</label>
    <input type="number" step="0.01" name="min_price" required>

    <button type="submit" class="btn btn-success">Ekle</button>
</form>

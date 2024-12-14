##########
<h1>Kampanya Düzenle</h1>

<form action="{{ route('admin.campaign.update', $campaign->id) }}" method="POST">
    @csrf
    @method('PATCH')

    <label for="name">Kampanya Adı</label>
    <input type="text" name="name" value="{{ $campaign->name }}" required>

    <label for="start_date">Başlangıç Tarihi</label>
    <input type="date" name="start_date" value="{{ $campaign->start_date }}" required>

    <label for="end_date">Bitiş Tarihi</label>
    <input type="date" name="end_date" value="{{ $campaign->end_date }}" required>

    <label for="description">Açıklama</label>
    <textarea name="description">{{ $campaign->description }}</textarea>

    <button type="submit" class="btn btn-success">Güncelle</button>
</form>

<h1>Dönem Düzenle</h1>

<form action="{{ route('admin.campaigns.periods.update', $period->id) }}" method="POST">
    @csrf
    @method('PATCH')
    <input type="text" name="name" value="{{ $period->name }}" required>

    <input type="number" name="campaign_id" value="{{ $period->campaign_id }}" required>

    <input type="date" name="start_date" value="{{ $period->start_date }}" required>

    <input type="date" name="end_date" value="{{ $period->end_date }}" required>

    <input type="number" name="min_price" value="{{ $period->min_price }}" required>

    <button type="submit" class="btn btn-success">Güncelle</button>
</form>

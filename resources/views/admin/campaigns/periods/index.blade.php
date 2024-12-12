<h1>Kampanya Dönemleri</h1>

<a href="{{ route('admin.campaigns.periods.create') }}" class="btn btn-primary">Yeni Dönem Ekle</a>

@foreach ($periods as $period)
    <div class="card mt-4">
        <h1>Kampanya Bilgileri : {{ $period->campaign->name }}</h1>

        <h2>Dönem Adı : {{ $period->name }}</h2>
        <p>Başlangıç: {{ $period->start_date }} - Bitiş: {{ $period->end_date }}</p>
        <p>Minimum Sepet Tutarı: {{ $period->min_price }}</p>
        <a href="{{ route('admin.campaigns.periods.edit', $period->id) }}" class="btn btn-warning">Düzenle</a>

        <form action="{{ route('admin.campaigns.periods.destroy', $period->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Sil</button>
        </form>
    </div>
    <hr>
@endforeach

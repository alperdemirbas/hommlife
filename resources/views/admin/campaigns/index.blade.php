<h1>Kampanyalar</h1>

<a href="{{ route('admin.campaign.create') }}" class="btn btn-primary">Yeni Kampanya Ekle</a>

@if($campaigns->isEmpty())
    <p>Henüz kampanya bulunmamaktadır.</p>
@else
    @foreach ($campaigns as $campaign)
        <div class="card mt-4">
            <h2>{{ $campaign->name }}</h2>
            <p>Başlangıç: {{ $campaign->start_date }} - Bitiş: {{ $campaign->end_date }}</p>
            <p>{{ $campaign->description }}</p>
            <a href="{{ route('admin.campaign.edit', $campaign->id) }}" class="btn btn-warning">Düzenle</a>

            <form action="{{ route('admin.campaign.destroy', $campaign->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Sil</button>
            </form>
        </div>
    @endforeach
@endif

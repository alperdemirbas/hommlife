<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kampanyalar') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 text-gray-900">
                <a href="{{ route('admin.campaign.create') }}" class="btn btn-primary">
                    <x-button class="mb-4">
                        Yeni Kampanya Ekle
                    </x-button>
                </a>
                <div class="container mx-auto">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                        @if($campaigns->isEmpty())
                            <p>Henüz kampanya bulunmamaktadır.</p>
                        @else
                            @foreach($campaigns as $campaign)
                                <div class="max-w-sm bg-white rounded shadow-md dark:bg-white dark:border-gray-700 p-4">
                                    <div class="px-5 pb-5">
                                        <h1 class="text-bold text-lg"><b>Kampanya Adı : </b>{{ $campaign->name }}</h1>
                                        <p><b>Başlangıç Tarihi :</b> {{ $campaign->start_date }}</p>
                                        <p><b>Bitiş Tarihi : </b>{{ $campaign->end_date }}</p>
                                        <p><b>Açıklama : </b>{{ $campaign->description }}</p>

                                        <h1 class="text-lg mt-3"><b>Dönemler</b></h1>
                                        <div class="flex">

                                            @if($campaign->periods->isEmpty())
                                                <p class="m-4">Kampanyaya ait bir dönem girilmemiş.</p>
                                            @else
                                                @foreach($campaign->periods as $period)
                                                    <div class="grid border shadow-lg p-4" style="margin-right:10px;">
                                                        <p><b>{{$period->name}}</b></p>
                                                        <p>Başlangıç Tarihi
                                                            : {{ date_format($period->start_date,'Y-m-d' )}}</p>
                                                        <p>Bitiş Tarihi
                                                            : {{ date_format($period->end_date,'Y-m-d')}}</p>
                                                        <p>Min Tutar : {{ $period->min_price }} ₺</p>
                                                        <a href="{{route('admin.campaigns.periods.products.create',['campaign'=>$campaign->id,'period'=>$period->id])}}"><x-button>Ürünler</x-button></a>
                                                    </div>
                                                @endforeach
                                            @endif


                                        </div>
                                        <p>
                                            <a href="{{ route('admin.campaigns.periods.create',['campaign_id'=>$campaign->id]) }}">
                                                Dönem eklemek için tıklayın</a></p></p>

                                        <div class="flex">
                                            <a href="{{ route('admin.campaign.edit', $campaign->id) }}"
                                               class="btn btn-warning">
                                                <x-button>Kampanyayı Düzenle</x-button>
                                            </a>

                                            <form action="{{ route('admin.campaign.destroy', $campaign->id) }}"
                                                  method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <x-button style="margin-left:10px;" type="submit">Sil</x-button>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

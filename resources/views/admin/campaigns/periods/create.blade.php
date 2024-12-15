<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kampanyalar') }}
            -> {{$campaigns->first()->name}}
            -> Dönem Ekle
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 text-gray-900">
                <div class="container mx-auto">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">

                        <div class="max-w-sm bg-white rounded shadow-md dark:bg-white dark:border-gray-700 p-4">
                            <div class="px-5 pb-5">
                                <form action="{{ route('admin.campaigns.periods.store') }}" method="POST">
                                    <input type="number" name="campaign_id" hidden value="{{$campaigns->first()->id}}">
                                    @csrf
                                    <div class="flex">
                                        <div style="margin-right: 20px;">
                                            <x-input-label>Dönem Adı</x-input-label>
                                            <x-text-input name="name"></x-text-input>
                                        </div>

                                        <div style="margin-right: 20px;">
                                            <x-input-label>Başlangıç Tarihi</x-input-label>
                                            <x-text-input type="datetime-local" name="start_date"></x-text-input>
                                        </div>

                                        <div style="margin-right: 20px;">
                                            <x-input-label>Bittiş Tarihi</x-input-label>
                                            <x-text-input type="datetime-local" name="end_date"></x-text-input>
                                        </div>

                                        <div style="margin-right: 20px;">
                                            <x-input-label>Minimum Sepet Tutarı</x-input-label>
                                            <x-text-input type="number" name="min_price"></x-text-input>
                                        </div>

                                        <x-button style="margin-left:10px;" type="submit">Dönem ekle</x-button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

#######################################################################################################################################

###<h1>Yeni Dönem Ekle</h1>

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

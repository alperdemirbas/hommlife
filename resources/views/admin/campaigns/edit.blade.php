<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kampanya Oluştur') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div>
                <div class="bg-gray-50 p-4 border rounded-lg shadow-lg">
                    <form action="{{ route('admin.campaign.update', $campaign->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="flex space-x-4">
                            <div style="margin-right: 20px;">
                                <x-input-label>Kampamya Adı</x-input-label>
                                <x-text-input name="name" value="{{ $campaign->name }}"></x-text-input>
                            </div>
                            <div style="margin-right: 20px;">
                                <x-input-label>Başlangıç Tarihi</x-input-label>
                                <x-text-input type="datetime-local" name="start_date" value="{{ $campaign->start_date }}"></x-text-input>
                            </div>
                            <div style="margin-right: 20px;">
                                <x-input-label>Biriş Tarihi</x-input-label>
                                <x-text-input type="datetime-local" name="end_date" value="{{ $campaign->end_date }}">{{ $campaign->end_date }}</x-text-input>
                            </div>
                            <div style="margin-right: 20px;">
                                <x-input-label>Açıklama</x-input-label>
                                <x-text-input name="description" value="{{ $campaign->description }}">{{ $campaign->description }}</x-text-input>
                            </div>
                        </div>
                        <x-button type="submit">Güncelle</x-button>
                    </form>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>

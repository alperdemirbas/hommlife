<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kampanya') }}
            -> {{$campaign->name}}
            -> {{$period->first()->name}}
            -> Ürün Ekle
        </h2>
    </x-slot>
    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                @forelse($products as $index => $product)
                    @php
                        $has = "";
                    @endphp
                    @foreach($added_products as $add_product)
                        @if($product->id == $add_product->product_id)
                            @php
                                $has = "border:5px solid black!important;background-color:#FFF";
                            @endphp
                        @endif
                    @endforeach

                    <form action="{{ route('admin.campaigns.periods.products.store') }}" method="POST">
                        @csrf
                        <div style="{{ $has }}" class="bg-gray-100 p-4 text-center border rounded-lg shadow-md hover:bg-gray-50">
                            <div class="flex justify-center"><img src="{{ $product->image }}"
                                                                  alt="{{ $product->name }}">
                            </div>
                            <h3 class="font-semibold text-lg mt-2 mb-2">{{ $product->name }}</h3>
                            <p class="text-xs">{{ $product->price }} ₺</p>
                            <input hidden name="period_id" value="{{ $period->first()->id }}">
                            <input hidden name="product_id" value="{{ $product->id }}"/>
                            <x-button type="submit">Ürünü ekle</x-button>
                        </div>
                    </form>


                @empty
                    <p>Henüz ürün eklenmedi.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{ route('product.index') }}"> {{ __('Ürünler ') }}</a> -> {{  $product->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="flex">
                <div class="bg-gray-50 p-4 border rounded-lg shadow-lg">
                    @if($product)
                        @if($product->image)
                            <img src="{{ $product->image }}" alt="{{ $product->name }}" width="300">
                        @else
                            <p>Bu ürünün resmi mevcut değil.</p>
                        @endif
                        <h3 class="text-lg font-semibold mb-3">{{ $product->name }}</h3>
                        <p><strong>Fiyat:</strong> {{ number_format($product->price, 2) }} ₺</p>
                        <p>

                        <form action="{{ route('carts.store') }}" method="POST" class="inline">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id  }}">
                            <input type="hidden" name="product_id" value="{{ $product->id  }}">
                            <input hidden type="text" name="is_gift" value="0">
                            <input type="number" hidden name="quantity" value="1">
                            <x-button type="submit">Sepete Ekle</x-button>
                        </form>

                        </p>
                    @else
                        <p>Ürün bulunamadı.</p>
                    @endif
                </div>

            </div>
        </div>
    </div>

</x-app-layout>

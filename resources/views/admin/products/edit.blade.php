<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{ route('admin.products.index') }}"> {{ __('Ürünler ') }}</a> -> {{  $product->name }} [DÜZENLE]
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
                            <form action="{{ route('admin.product.update',$product->id) }}" method="POST" class="inline">
                        <p><x-text-input name="name" class="mb-4" value="{{ $product->name }}"></x-text-input></p>
                        <x-text-input name="price" value="{{ number_format($product->price, 2) }}">asd</x-text-input>
                        <p>

                            @csrf
                            @method("PATCH")
                            <x-button type="submit">Güncelle</x-button>
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


#################################
<h1>Ürünü Düzenle</h1>
<form action="{{ route('admin.product.update', $product->id) }}" method="POST">
    @csrf
    @method('PATCH')
    <input type="text" name="name" value="{{ $product->name }}" required>
    <input type="number" step="0.01" name="price" value="{{ $product->price }}" required>
    <button type="submit">Güncelle</button>
</form>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ürün Listesi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container mx-auto">
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                            @foreach($products as $product)
                                <div class="max-w-sm bg-white rounded shadow-md dark:bg-white dark:border-gray-700">
                                    <img class="p-8" src="{{ $product['image'] }}"/>
                                    <div class="px-5 pb-5">
                                        <h5 class="text-xl font-bold tracking-tight text-gray-900 dark:text-dark">{{ $product['name'] }}</h5>
                                        <p class="mt-2 mb-4 text-gray-500 dark:text-gray-400">{{$product->price}} TL</p>
                                        <a href="#" class="text-blue-500 hover:underline">Daha Fazla</a>

                                        <form action="{{ route('admin.products.destroy', $product->id) }}"
                                              method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit">Sil</button>
                                        </form>

                                    </div>

                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>


</x-app-layout>

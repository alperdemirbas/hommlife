<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sepet Detayı ') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-gray-50 p-4 border rounded-lg shadow-lg">
                <table class="border-collapse table-auto w-full text-sm">
                    <thead>
                    <th class="border-b dark:border-slate-600 font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-start">
                        Ürün Resmi
                    </th>
                    <th class="border-b dark:border-slate-600 font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-start">
                        Ürün Adı
                    </th>
                    <th class="border-b dark:border-slate-600 font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-start">
                        Ürün Fiyatı
                    </th>
                    <th class="border-b dark:border-slate-600 font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-start">
                        Ürün Adedi
                    </th>
                    <th class="border-b dark:border-slate-600 font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-start">
                        Toplam
                    </th>
                    <th class="border-b dark:border-slate-600 font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-start">
                        İşlem
                    </th>
                    </thead>
                    <tbody class="bg-white dark:bg-slate-800">
                    @foreach($data as $item)
                        <tr>
                            <td class="product-image  border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">
                                <img src="https://via.placeholder.com/60" alt="Ürün Resmi"></td>
                            <td class="product-name border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">
                                {{ $item->product->name }}
                            </td>


                            @if($item->is_gift)

                                <td class="product-name border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">
                                    0.00
                                </td>
                                <td class="product-name border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">
                                    1
                                </td>
                                <td class="product-name border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">
                                    0.00
                                </td>
                                <td class="product-name border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">
                                    Hedyie
                                </td>
                            @else
                                <td class="product-name border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">
                                    {{ $item->product->price }} ₺
                                </td>
                                <td class="product-name border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">
                                    <div class="quantity-buttons">
                                        <form class="quantityUpdate" method="POST"
                                              action="{{ route('carts.update', ['cart' => $item->id]) }}">
                                            @method('PUT')
                                            @csrf


                                            <x-button type="button" class="decrement px-2">-</x-button>

                                            <input type="number" class="quantity border border-transparent"
                                                   style="width:50px;" readonly name="quantity"
                                                   value="{{ $item->quantity }}"
                                                   min="1">
                                            <x-button type="button" class="increment">+</x-button>


                                        </form>
                                    </div>
                                </td>
                                <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">
                                    {{ $item->product->price * $item->quantity }} ₺
                                </td>
                                <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">
                                    <form method="POST" action="{{ route('carts.destroy', ['cart' => $item->id]) }}">
                                        @method('DELETE')
                                        @csrf

                                        <x-button type="submit">Sil</x-button>
                                    </form>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>


                <div class="text-right">
                    <div class="bg-dark total-price mt-4">
                        Toplam: {{ $total }} ₺
                    </div>

                    <form method="POST" action="{{ route('orders.store') }}">
                        @csrf
                        <x-button type="submit">Ödeme Yap</x-button>
                    </form>
                </div>

            </div>
        </div>
    </div>

</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const decrementButtons = document.querySelectorAll('.decrement');
        const incrementButtons = document.querySelectorAll('.increment');
        const quantityInputs = document.querySelectorAll('.quantity');
        const quantityUpdate = document.querySelectorAll('.quantityUpdate');

        // Azaltma butonuna tıklama olayı
        decrementButtons.forEach(button => {
            button.addEventListener('click', function () {
                const form = this.closest('form');
                const input = this.nextElementSibling; // Input elemanı
                let currentValue = parseInt(input.value);
                if (currentValue > 1) {
                    input.value = currentValue - 1;
                    form.submit();
                }
            });
        });

        // Artırma butonuna tıklama olayı
        incrementButtons.forEach(button => {
            button.addEventListener('click', function () {
                const form = this.closest('form');
                const input = this.previousElementSibling; // Input elemanı
                let currentValue = parseInt(input.value);
                input.value = currentValue + 1;
                form.submit();
            });
        });

        // Input doğrudan değiştirildiğinde minimum kontrolü
        quantityInputs.forEach(input => {
            input.addEventListener('change', function () {
                if (input.value < 1) input.value = 1; // Değer 1'in altına inemez
            });
        });
    });
</script>

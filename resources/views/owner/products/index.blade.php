<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <x-flash-message status="session('status')" />
                    <div class="flex justify-end mb-4">
                        <button onclick="location.href='{{ route('owner.products.create') }}'"
                            class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">新規登録する</button>
                    </div>
                    <div class="flex flex-wrap">
                        @foreach ($ownerInfo as $owner)
                            @foreach ($owner->shop->product as $product)
                                <div class="w-1/4 p-2 md:p-4">
                                    <a href="{{ route('owner.products.edit', ['product' => $product->id]) }}">
                                        <div class="border rounded-md p-2 md:p-4">
                                            <x-thumbnail type="products"
                                                filename="{{ $product->imageFirst->filename ?? '' }}" />
                                            {{-- <div class="text-gray-700">{{ $product->name }}</div> --}}
                                            <div class="mt-4">
                                                <h3 class="text-gray-500 text-xs tracking-widest title-font mb-1">{{ $product->category->name }}</h3>
                                                <h2 class="text-gray-900 title-font text-lg font-medium">{{ $product->name }}</h2>
                                                <p class="mt-1">{{ number_format($product->price) }}<span class="text-sm text-gray-700">円（税込）</span></p>
                                              </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                    {{-- {{ $images->links() }} --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

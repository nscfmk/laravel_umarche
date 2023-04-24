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
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                    <form method="post" action="{{ route('owner.products.store') }}">
                        @csrf
                        <div class="-m-2">
                            <div class="p-2 w-1/2 mx-auto">
                                <div class="relative">
                                    <select name="category">
                                        @foreach ($categories as $category)
                                        <optgroup label="{{ $category->name }}">
                                            @foreach ($category->secondary as $secondary)
                                            <option value="{{ $secondary->id }}">
                                                {{ $secondary->name }}
                                            </option>
                                            @endforeach
                                            @endforeach
                                        </select>
                                        <div class="p-2 w-full flex justify-around mt-4">
                                            <button type="submit"
                                                class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">登録する</button>
                                            <button type="burron" onclick="location.href='{{ route('owner.products.index') }}'"
                                                class=" text-black bg-gray-400 border-0 py-2 px-8 focus:outline-none hover:bg-gray-600 rounded text-lg">戻る</button>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

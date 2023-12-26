<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Food') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-10">
                <a href="{{ route('food.create') }}"
                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" style="background-color: green">
                    + Create Food
                </a>
            </div>
            <br>
            <div class="bg-white">
                <table class="table-auto w-full">
                    <thead>
                        <tr>
                            <th class="border px-6 py-4">ID</th>
                            <th class="border px-6 py-4">NAME</th>
                            <th class="border px-6 py-4">PRICE</th>
                            <th class="border px-6 py-4">RATE</th>
                            <th class="border px-6 py-4">TYPES</th>
                            <th class="border px-6 py-4">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($food as $item)
                            <tr>
                                <td class="border px-6 py-4">{{ $item->id }}</td>
                                <td class="border px-6 py-4">{{ $item->name }}</td>
                                <td class="border px-6 py-4">{{ number_format($item->price) }}</td>
                                <td class="border px-6 py-4">{{ $item->reting }}</td>
                                <td class="border px-6 py-4">{{ $item->types }}</td>
                                <td class="border px-6 py-4 text-center">
                                    <a href="{{ route('food.edit', $item->id) }}"
                                        class=" bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 mx-2 rounded"
                                        style="background-color: green">
                                        Edit</a>
                                    <form action="{{ route('food.destroy', $item->id) }}" method="POST"
                                        class="inline-block ml-8">
                                        {!! method_field('delete') . csrf_field() !!}
                                        <button type="submit"
                                            class=" bg-red-500 hover:bg-red-700 text-white py-2 px-4 mx-2 rounded"
                                            style="background-color: red">Delete</button>
                                    </form>
                                </td>
                            </tr>

                        @empty
                        <tr>
                            <td colspan="6" class="border text-center p-5">
                                Data Tidak Ditemukan
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="text-center mt-5">
                {{ $food->links() }}
            </div>
        </div>
    </div>
</x-app-layout>

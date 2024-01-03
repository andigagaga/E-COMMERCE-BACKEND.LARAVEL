<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transaction') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white">
                <table class="table-auto w-full">
                    <thead>
                        <tr>
                            <th class="border px-6 py-4">ID</th>
                            <th class="border px-6 py-4">FOOD</th>
                            <th class="border px-6 py-4">USER</th>
                            <th class="border px-6 py-4">QUANTITY</th>
                            <th class="border px-6 py-4">TOTAL</th>
                            <th class="border px-6 py-4">STATUS</th>
                            <th class="border px-6 py-4">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transactions as $item)
                            <tr>
                                <td class="border px-6 py-4">{{ $item->id }}</td>
                                <td class="border px-6 py-4">{{ $item->food ? $item->food->name : 'N/A' }}</td>
                                <td class="border px-6 py-4">{{ $item->user ? $item->user->name : 'N/A' }}</td>
                                <td class="border px-6 py-4">{{ $item->quantity }}</td>
                                <td class="border px-6 py-4">{{ number_format($item->total) }}</td>
                                <td class="border px-6 py-4">{{ $item->status }}</td>
                                <td class="border px-6 py-4 text-center">
                                    <a href="{{ route('transaction.show', $item->id) }}"
                                        class=" bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 mx-2 rounded"
                                        style="background-color: green">
                                        Lihat
                                    </a>
                                    <form action="{{ route('transaction.destroy', $item->id) }}" method="POST"
                                        class="inline-block ml-8">
                                        {!! method_field('delete') . csrf_field() !!}
                                        <button type="submit"
                                            class=" bg-red-500 hover:bg-red-700 text-white py-2 px-4 mx-2"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?')">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="border px-6 py-4 text-center">Tidak ada transaksi ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
            <div class="text-center mt-5">
                {{ $transactions->links() }}
            </div>
        </div>
    </div>
</x-app-layout>

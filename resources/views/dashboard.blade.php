<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">
            User Dashboard
        </h2>
    </x-slot>

    <div class="p-6 bg-gray-50 min-h-screen space-y-8">

        {{-- SEARCH --}}
        <form method="GET" class="flex gap-2">
            <input
                type="text"
                name="search"
                value="{{ $search }}"
                placeholder="Search books by title or author..."
                class="w-full border rounded-xl px-4 py-2 focus:ring focus:ring-blue-200"
            >

            <button class="bg-blue-600 text-white px-5 py-2 rounded-xl hover:bg-blue-700 transition">
                Search
            </button>
        </form>

        {{-- CATALOGUE --}}
        <div>
            <h3 class="text-xl font-semibold mb-4">Catalogue</h3>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">

                @foreach($books as $book)
                    <div class="bg-white p-4 rounded-2xl shadow hover:shadow-lg transition">

                        <h4 class="font-bold text-lg">{{ $book->title }}</h4>
                        <p class="text-gray-500 text-sm">{{ $book->author }}</p>

                        <span class="text-xs px-2 py-1 rounded-full 
                            {{ $book->status === 'available' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-600' }}">
                            {{ $book->status }}
                        </span>

                        <div class="mt-4">
                            @if($book->status === 'available')
                                <form method="POST" action="/reservations">
                                    @csrf
                                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                                    <button class="w-full bg-green-600 text-white py-2 rounded-xl hover:bg-green-700 transition">
                                        Reserve
                                    </button>
                                </form>
                            @else
                                <button disabled class="w-full bg-gray-300 text-gray-600 py-2 rounded-xl">
                                    Not Available
                                </button>
                            @endif
                        </div>

                    </div>
                @endforeach

            </div>
        </div>

        {{-- RESERVATIONS --}}
        <div>
            <h3 class="text-xl font-semibold mb-4">My Reservations</h3>

            <div class="space-y-2">
                @foreach($reservations as $res)
                    <div class="bg-white p-3 rounded-xl shadow flex justify-between">
                        <span>{{ $res->book->title }}</span>
                        <span class="text-sm text-gray-500">{{ $res->status }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- LOANS --}}
        <div>
            <h3 class="text-xl font-semibold mb-4">My Loans</h3>

            <div class="space-y-2">
                @foreach($loans as $loan)
                    <div class="bg-white p-3 rounded-xl shadow flex justify-between">
                        <span>{{ $loan->book->title }}</span>
                        <span class="text-sm text-gray-500">{{ $loan->status }}</span>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
</x-app-layout>
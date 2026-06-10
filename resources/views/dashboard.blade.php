<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-3xl font-serif font-bold text-amber-900">
                📚 Library Catalogue
            </h2>
            <p class="text-amber-700 text-sm">Welcome, {{ Auth::user()->name }}!</p>
        </div>
    </x-slot>

    <div class="p-6 bg-gradient-to-b from-amber-50 to-white min-h-screen space-y-8">

        {{-- SEARCH SECTION --}}
        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-amber-600">
            <h3 class="library-section-title">🔍 Find Your Next Read</h3>
            <form method="GET" class="flex gap-3">
                <input
                    type="text"
                    name="search"
                    value="{{ $search }}"
                    placeholder="Search books by title or author..."
                    class="library-input flex-1"
                >
                <button class="library-btn-primary">
                    Search
                </button>
            </form>
        </div>

        {{-- CATALOGUE --}}
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="library-section-title">📖 Available Books</h3>

            @if($books->count() > 0)
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-5">
                    @foreach($books as $book)
                        <div class="library-card p-5 border border-amber-100 hover:border-amber-300 transition-all duration-200">
                            
                            <div class="flex items-start justify-between mb-3">
                                <h4 class="font-serif font-bold text-lg text-amber-900 flex-1 leading-tight">{{ $book->title }}</h4>
                                <span class="text-2xl ml-2">📘</span>
                            </div>
                            
                            <p class="text-amber-700 text-sm mb-3 italic">{{ $book->author }}</p>

                            <div class="mb-4">
                                <span class="inline-block text-xs font-medium px-3 py-1 rounded-full 
                                    {{ $book->status === 'available' ? 'bg-green-100 text-green-700 border border-green-300' : 'bg-red-100 text-red-700 border border-red-300' }}">
                                    {{ ucfirst($book->status) }}
                                </span>
                            </div>

                            <div class="pt-3 border-t border-amber-100">
                                @if($book->status === 'available')
                                    <form method="POST" action="/reservations">
                                        @csrf
                                        <input type="hidden" name="book_id" value="{{ $book->id }}">
                                        <button class="w-full library-btn-primary text-sm py-2">
                                            Reserve This Book
                                        </button>
                                    </form>
                                @else
                                    <button disabled class="w-full bg-gray-300 text-gray-600 py-2 rounded-lg font-medium text-sm cursor-not-allowed">
                                        Not Available
                                    </button>
                                @endif
                            </div>

                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12 text-amber-700">
                    <p class="text-lg">📚 No books found. Try searching for something else!</p>
                </div>
            @endif
        </div>

        {{-- RESERVATIONS --}}
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="library-section-title">🏷️ My Reservations</h3>

            @if($reservations->count() > 0)
                <div class="space-y-3">
                    @foreach($reservations as $res)
                        <div class="library-book-item border-l-4 border-blue-400">
                            <div class="flex-1">
                                <p class="font-semibold text-amber-900">{{ $res->book->title }}</p>
                                <p class="text-xs text-amber-700 mt-1">By {{ $res->book->author }}</p>
                            </div>
                            <div class="text-right">
                                <span class="inline-block px-3 py-1 rounded text-xs font-medium 
                                    {{ $res->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : ($res->status === 'approved' ? 'bg-blue-100 text-blue-700' : 'bg-red-100 text-red-700') }}">
                                    {{ ucfirst($res->status) }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center text-amber-600 py-6">No reservations yet. Reserve a book to get started!</p>
            @endif
        </div>

        {{-- LOANS --}}
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="library-section-title">✅ My Loans</h3>

            @if($loans->count() > 0)
                <div class="space-y-3">
                    @foreach($loans as $loan)
                        <div class="library-book-item border-l-4 border-green-400">
                            <div class="flex-1">
                                <p class="font-semibold text-amber-900">{{ $loan->book->title }}</p>
                                <p class="text-xs text-amber-700 mt-1">By {{ $loan->book->author }}</p>
                            </div>
                            <div class="text-right">
                                <span class="inline-block px-3 py-1 rounded text-xs font-medium 
                                    {{ $loan->status === 'ongoing' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
                                    {{ ucfirst($loan->status) }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center text-amber-600 py-6">You don't have any active loans. Start reserving books!</p>
            @endif
        </div>

    </div>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-3xl font-serif font-bold text-amber-900">
                📚 Books Management
            </h2>
            <a href="{{ route('books.create') }}" class="library-btn-primary">
                ➕ Add New Book
            </a>
        </div>
    </x-slot>

    <div class="p-6 bg-gradient-to-b from-amber-50 to-white min-h-screen">

        @if($books->count() > 0)
            <div class="grid gap-4">
                @foreach($books as $book)
                    <div class="library-card p-6 border-l-4 border-amber-600 hover:shadow-lg transition-all">

                        <div class="flex items-start justify-between gap-4">
                            <div class="flex-1">
                                <h3 class="font-serif font-bold text-xl text-amber-900">{{ $book->title }}</h3>
                                <p class="text-amber-700 italic mt-1">{{ $book->author }}</p>
                                
                                @if($book->description)
                                    <p class="text-gray-700 text-sm mt-3">{{ Str::limit($book->description, 150) }}</p>
                                @endif

                                <div class="mt-3">
                                    <span class="inline-block text-xs font-medium px-3 py-1 rounded-full 
                                        {{ $book->status === 'available' ? 'bg-green-100 text-green-700 border border-green-300' : 'bg-red-100 text-red-700 border border-red-300' }}">
                                        {{ ucfirst($book->status) }}
                                    </span>
                                </div>
                            </div>

                            <div class="text-4xl">📖</div>
                        </div>

                        <div class="flex gap-2 mt-4 pt-4 border-t border-amber-100">
                            <a href="{{ route('books.edit', $book) }}" class="library-btn-secondary text-sm py-2 px-3">
                                ✏️ Edit
                            </a>

                            <form method="POST" action="{{ route('books.destroy', $book) }}" class="inline" onsubmit="return confirm('Are you sure you want to delete this book?');">
                                @csrf
                                @method('DELETE')
                                <button class="bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-3 rounded-lg text-sm transition">
                                    🗑️ Delete
                                </button>
                            </form>
                        </div>

                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white rounded-lg shadow-md p-12 text-center">
                <p class="text-4xl mb-4">📭</p>
                <p class="text-amber-700 text-lg mb-6">No books in the library yet.</p>
                <a href="{{ route('books.create') }}" class="library-btn-primary inline-block">
                    ➕ Add Your First Book
                </a>
            </div>
        @endif

    </div>
</x-app-layout>
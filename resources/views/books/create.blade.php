<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-serif font-bold text-amber-900">
            ➕ Add New Book
        </h2>
    </x-slot>

    <div class="p-6 bg-gradient-to-b from-amber-50 to-white min-h-screen">

        <div class="max-w-2xl mx-auto">
            <div class="bg-white rounded-lg shadow-md p-8 border-l-4 border-amber-600">

                <form method="POST" action="{{ route('books.store') }}" class="space-y-6">
                    @csrf

                    {{-- Title Field --}}
                    <div>
                        <label class="block text-amber-900 font-medium mb-2">
                            📖 Book Title
                        </label>
                        <input 
                            type="text"
                            name="title" 
                            placeholder="Enter book title..."
                            class="library-input"
                            required
                        >
                        @error('title')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Author Field --}}
                    <div>
                        <label class="block text-amber-900 font-medium mb-2">
                            ✍️ Author
                        </label>
                        <input 
                            type="text"
                            name="author" 
                            placeholder="Enter author name..."
                            class="library-input"
                            required
                        >
                        @error('author')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Description Field --}}
                    <div>
                        <label class="block text-amber-900 font-medium mb-2">
                            📝 Description (Optional)
                        </label>
                        <textarea 
                            name="description"
                            placeholder="Enter book description..."
                            class="library-input h-32 resize-none"
                            rows="5"
                        ></textarea>
                        @error('description')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex gap-3 pt-4 border-t border-amber-100">
                        <button 
                            type="submit" 
                            class="library-btn-primary flex-1"
                        >
                            ✓ Save Book
                        </button>
                        <a 
                            href="{{ route('books.index') }}" 
                            class="library-btn-secondary flex-1 text-center"
                        >
                            ✕ Cancel
                        </a>
                    </div>

                </form>

            </div>
        </div>

    </div>
</x-app-layout>
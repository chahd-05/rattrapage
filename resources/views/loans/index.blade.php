<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-serif font-bold text-amber-900">
            📚 My Loans
        </h2>
    </x-slot>

    <div class="p-6 bg-gradient-to-b from-amber-50 to-white min-h-screen">

        @if(count($loans) > 0)
            <div class="space-y-4">
                @foreach($loans as $loan)
                    <div class="library-card p-6 border-l-4 {{ $loan->status === 'ongoing' ? 'border-green-600' : 'border-gray-400' }} hover:shadow-lg transition-all">
                        <div class="flex items-start justify-between gap-4">
                            <div class="flex-1">
                                <h3 class="font-serif font-bold text-lg text-amber-900">
                                    {{ $loan->book->title }}
                                </h3>
                                <p class="text-amber-700 italic mt-1">By {{ $loan->book->author }}</p>
                                <p class="text-sm text-gray-700 mt-3">
                                    📅 Loan Status
                                </p>
                            </div>
                            <div>
                                <span class="inline-block px-4 py-2 rounded-full text-sm font-medium 
                                    {{ $loan->status === 'ongoing' ? 'bg-green-100 text-green-700 border border-green-300' : 'bg-gray-100 text-gray-700 border border-gray-300' }}">
                                    {{ ucfirst($loan->status) }}
                                </span>
                            </div>
                        </div>

                        @if($loan->status === 'ongoing')
                            <div class="mt-5 pt-4 border-t border-amber-100">
                                <form method="POST" action="/loans/{{ $loan->id }}/return">
                                    @csrf
                                    <button class="library-btn-primary text-sm py-2 w-full">
                                        🔄 Return Book
                                    </button>
                                </form>
                            </div>
                        @else
                            <div class="mt-5 pt-4 border-t border-amber-100">
                                <p class="text-center text-gray-600 text-sm font-medium">
                                    ✅ This loan has been completed
                                </p>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white rounded-lg shadow-md p-12 text-center">
                <p class="text-4xl mb-4">📭</p>
                <p class="text-amber-700 text-lg mb-6">You don't have any loans yet.</p>
                <a href="{{ route('dashboard') }}" class="library-btn-primary inline-block">
                    📖 Browse Catalogue
                </a>
            </div>
        @endif

    </div>
</x-app-layout>
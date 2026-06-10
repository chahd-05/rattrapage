<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-3xl font-serif font-bold text-amber-900">
                🔑 Admin Dashboard
            </h2>
            <p class="text-amber-700 text-sm">Library Management System</p>
        </div>
    </x-slot>

    <div class="p-6 bg-gradient-to-b from-amber-50 to-white min-h-screen space-y-8">

        {{-- STATISTICS CARDS --}}
        <div class="grid md:grid-cols-4 gap-5">

            <div class="library-stat-card">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-amber-700 font-medium text-sm">Total Books</p>
                        <p class="text-3xl font-serif font-bold text-amber-900 mt-2">{{ $booksCount }}</p>
                    </div>
                    <span class="text-4xl">📖</span>
                </div>
            </div>

            <div class="library-stat-card">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-amber-700 font-medium text-sm">Total Users</p>
                        <p class="text-3xl font-serif font-bold text-amber-900 mt-2">{{ $usersCount }}</p>
                    </div>
                    <span class="text-4xl">👥</span>
                </div>
            </div>

            <div class="library-stat-card">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-amber-700 font-medium text-sm">Reservations</p>
                        <p class="text-3xl font-serif font-bold text-amber-900 mt-2">{{ $reservationsCount }}</p>
                    </div>
                    <span class="text-4xl">🏷️</span>
                </div>
            </div>

            <div class="library-stat-card">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-amber-700 font-medium text-sm">Active Loans</p>
                        <p class="text-3xl font-serif font-bold text-amber-900 mt-2">{{ $loansCount }}</p>
                    </div>
                    <span class="text-4xl">✅</span>
                </div>
            </div>

        </div>

        {{-- PENDING RESERVATIONS --}}
        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-blue-600">
            <h3 class="library-section-title">⏳ Pending Reservations</h3>

            @if($pendingReservations->count() > 0)
                <div class="space-y-3">
                    @foreach($pendingReservations as $res)
                        <div class="library-book-item border-b border-amber-100 pb-4">
                            <div class="flex-1">
                                <p class="font-semibold text-amber-900">{{ $res->user->name }}</p>
                                <p class="text-sm text-amber-700 mt-1">📖 {{ $res->book->title }}</p>
                                <p class="text-xs text-gray-500 mt-1">By {{ $res->book->author }}</p>
                            </div>

                            <div class="flex gap-2">
                                <form method="POST" action="/reservations/{{ $res->id }}/approve" class="inline">
                                    @csrf
                                    <button class="library-btn-primary text-xs py-1.5 px-3">
                                        ✓ Approve
                                    </button>
                                </form>

                                <form method="POST" action="/reservations/{{ $res->id }}/reject" class="inline">
                                    @csrf
                                    <button class="bg-red-600 hover:bg-red-700 text-white font-medium py-1.5 px-3 rounded-lg text-xs transition">
                                        ✕ Reject
                                    </button>
                                </form>
                            </div>

                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center text-amber-600 py-6">✨ All reservations are up to date!</p>
            @endif
        </div>

        {{-- LOANS MANAGEMENT --}}
        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-green-600">
            <h3 class="library-section-title">📚 Loan Management</h3>

            @if($loans->count() > 0)
                <div class="space-y-3">
                    @foreach($loans as $loan)
                        <div class="library-book-item border-b border-amber-100 pb-4">
                            <div class="flex-1">
                                <p class="font-semibold text-amber-900">{{ $loan->user->name }}</p>
                                <p class="text-sm text-amber-700 mt-1">📖 {{ $loan->book->title }}</p>
                                <p class="text-xs text-gray-500 mt-1">By {{ $loan->book->author }}</p>
                            </div>

                            <div class="flex items-center gap-3">
                                <span class="inline-block px-3 py-1 rounded text-xs font-medium 
                                    {{ $loan->status === 'ongoing' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
                                    {{ ucfirst($loan->status) }}
                                </span>
                                
                                @if($loan->status === 'ongoing')
                                    <form method="POST" action="/loans/{{ $loan->id }}/return" class="inline">
                                        @csrf
                                        <button class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-1.5 px-3 rounded-lg text-xs transition">
                                            🔄 Mark Returned
                                        </button>
                                    </form>
                                @endif
                            </div>

                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center text-amber-600 py-6">No active loans at the moment.</p>
            @endif
        </div>

    </div>
</x-app-layout>
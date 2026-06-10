<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">
            Admin Panel
        </h2>
    </x-slot>

    <div class="p-6 bg-gray-50 min-h-screen space-y-8">

        {{-- STATS --}}
        <div class="grid md:grid-cols-4 gap-4">

            <div class="bg-white p-4 rounded-2xl shadow">
                <p class="text-gray-500">Books</p>
                <p class="text-2xl font-bold">{{ $booksCount }}</p>
            </div>

            <div class="bg-white p-4 rounded-2xl shadow">
                <p class="text-gray-500">Users</p>
                <p class="text-2xl font-bold">{{ $usersCount }}</p>
            </div>

            <div class="bg-white p-4 rounded-2xl shadow">
                <p class="text-gray-500">Reservations</p>
                <p class="text-2xl font-bold">{{ $reservationsCount }}</p>
            </div>

            <div class="bg-white p-4 rounded-2xl shadow">
                <p class="text-gray-500">Loans</p>
                <p class="text-2xl font-bold">{{ $loansCount }}</p>
            </div>

        </div>

        {{-- RESERVATIONS --}}
        <div>
            <h3 class="text-xl font-semibold mb-4">Pending Reservations</h3>

            <div class="space-y-2">

                @foreach($pendingReservations as $res)
                    <div class="bg-white p-3 rounded-xl shadow flex justify-between items-center">

                        <div>
                            <p class="font-semibold">{{ $res->user->name }}</p>
                            <p class="text-sm text-gray-500">{{ $res->book->title }}</p>
                        </div>

                        <div class="flex gap-2">

                            <form method="POST" action="/reservations/{{ $res->id }}/approve">
                                @csrf
                                <button class="bg-green-600 text-white px-3 py-1 rounded-xl hover:bg-green-700">
                                    Approve
                                </button>
                            </form>

                            <form method="POST" action="/reservations/{{ $res->id }}/reject">
                                @csrf
                                <button class="bg-red-500 text-white px-3 py-1 rounded-xl hover:bg-red-600">
                                    Reject
                                </button>
                            </form>

                        </div>

                    </div>
                @endforeach

            </div>
        </div>

        {{-- LOANS --}}
        <div>
            <h3 class="text-xl font-semibold mb-4">Loans</h3>

            <div class="space-y-2">

                @foreach($loans as $loan)
                    <div class="bg-white p-3 rounded-xl shadow flex justify-between">

                        <div>
                            <p class="font-semibold">{{ $loan->user->name }}</p>
                            <p class="text-sm text-gray-500">{{ $loan->book->title }}</p>
                        </div>

                        <div>
                            @if($loan->status === 'ongoing')
                                <form method="POST" action="/loans/{{ $loan->id }}/return">
                                    @csrf
                                    <button class="bg-blue-600 text-white px-3 py-1 rounded-xl hover:bg-blue-700">
                                        Return
                                    </button>
                                </form>
                            @endif
                        </div>

                    </div>
                @endforeach

            </div>
        </div>

    </div>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-serif font-bold text-amber-900">
            🏷️ Reservations Management
        </h2>
    </x-slot>

    <div class="p-6 bg-gradient-to-b from-amber-50 to-white min-h-screen">

        @if(count($reservations) > 0)
            <div class="space-y-4">
                @foreach($reservations as $res)
                    <div class="library-card p-6 border-l-4 border-blue-600 hover:shadow-lg transition-all">
                        <div class="flex items-start justify-between gap-4">
                            <div class="flex-1">
                                <h3 class="font-serif font-bold text-lg text-amber-900">
                                    {{ $res->book->title }}
                                </h3>
                                <p class="text-amber-700 italic mt-1">By {{ $res->book->author }}</p>
                                <p class="text-sm text-gray-700 mt-3 font-medium">
                                    👤 Requested by: <span class="text-amber-900">{{ $res->user->name }}</span>
                                </p>
                            </div>
                            <div>
                                <span class="inline-block px-4 py-2 rounded-full text-sm font-medium 
                                    {{ $res->status === 'pending' ? 'bg-yellow-100 text-yellow-700 border border-yellow-300' : ($res->status === 'approved' ? 'bg-green-100 text-green-700 border border-green-300' : 'bg-red-100 text-red-700 border border-red-300') }}">
                                    {{ ucfirst($res->status) }}
                                </span>
                            </div>
                        </div>

                        @if($res->status === 'pending')
                            <div class="flex gap-2 mt-5 pt-4 border-t border-amber-100">
                                <form method="POST" action="/reservations/{{ $res->id }}/approve" class="flex-1">
                                    @csrf
                                    <button class="w-full library-btn-primary text-sm py-2">
                                        ✓ Approve
                                    </button>
                                </form>

                                <form method="POST" action="/reservations/{{ $res->id }}/reject" class="flex-1">
                                    @csrf
                                    <button class="w-full bg-red-600 hover:bg-red-700 text-white font-medium py-2 rounded-lg text-sm transition">
                                        ✕ Reject
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white rounded-lg shadow-md p-12 text-center">
                <p class="text-4xl mb-4">✨</p>
                <p class="text-amber-700 text-lg">All reservations are processed!</p>
            </div>
        @endif

    </div>
</x-app-layout>
@foreach($reservations as $res)
    <p>
        {{ $res->user->name }} requested {{ $res->book->title }}
        ({{ $res->status }})

        <form method="POST" action="/reservations/{{ $res->id }}/approve">
            @csrf
            <button>Approve</button>
        </form>

        <form method="POST" action="/reservations/{{ $res->id }}/reject">
            @csrf
            <button>Reject</button>
        </form>
    </p>
@endforeach
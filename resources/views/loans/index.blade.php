@foreach($loans as $loan)
    <p>
        {{ $loan->book->title }} - {{ $loan->status }}

        @if($loan->status === 'ongoing')
            <form method="POST" action="/loans/{{ $loan->id }}/return">
                @csrf
                <button>Return Book</button>
            </form>
        @endif
    </p>
@endforeach
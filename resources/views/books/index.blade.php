<h1>Books</h1>

<a href="{{ route('books.create') }}">Add Book</a>

@foreach($books as $book)
    <p>
        {{ $book->title }} - {{ $book->author }}

        <a href="{{ route('books.edit', $book) }}">Edit</a>

        <form method="POST" action="{{ route('books.destroy', $book) }}">
            @csrf
            @method('DELETE')
            <button>Delete</button>
        </form>
    </p>
@endforeach

<form method="POST" action="/reservations">
    @csrf
    <input type="hidden" name="book_id" value="{{ $book->id }}">
    <button>Reserve</button>
</form>
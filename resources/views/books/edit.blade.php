<form method="POST" action="{{ route('books.update', $book) }}">
    @csrf
    @method('PUT')

    <input name="title" value="{{ old('title', $book->title) }}">
    <input name="author" value="{{ old('author', $book->author) }}">

    <textarea name="description">{{ old('description', $book->description) }}</textarea>

    <button type="submit">Update</button>
</form>
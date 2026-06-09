<h1>Add Book</h1>

<form method="POST" action="{{ route('books.store') }}">
    @csrf

    <input name="title" placeholder="Title">
    <input name="author" placeholder="Author">
    <textarea name="description"></textarea>

    <button type="submit">Save</button>
</form>
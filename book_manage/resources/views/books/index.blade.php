<!DOCTYPE html>
<html>
<head>
    <title>Books</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        h1 {
            background-color: #007BFF;
            color: white;
            padding: 20px;
            text-align: center;
        }

        a.button {
            background-color: #007BFF;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            border-radius: 5px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            background-color: white;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: center;
            padding: 8px;
        }

        th {
            background-color: #007BFF;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>
    <h1>Book List</h1>

    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($books as $book)
            <tr>
                <td>{{ $book->title }}</td>
                <td>{{ $book->author }}</td>
                <td>${{ $book->price }}</td>
                <td>{{ $book->stock }}</td>
                <td>
                    <a class="button" href="/books/{{ $book->id }}/edit">Edit</a>
                </td>
                <td>
                    <form action="{{ route('books.destroy', $book) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="button" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a class="button" href="/books/create">Add a Book</a>

    <h3>Issuance</h3>

    <form method="post" action="/books/decrease" >
        @csrf
        <select name="bookTitle">
            @foreach ($books as $book)
                <option value="{{ $book->title }}">{{ $book->title }}</option>
            @endforeach
        </select>
        <input type="text" name="username" placeholder="Enter username">
        <button class="button" type="submit"  >Issuance</button>
    </form>

    <div id="bookDetails"></div>
    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    <h3>Return</h3>
    <form method="post" action="/books/returnbook" >
        @csrf
        <select name="bookTitle">
            @foreach ($books as $book)
                <option value="{{ $book->title }}">{{ $book->title }}</option>
            @endforeach
        </select>
        <select name="userTitle">
            @foreach ($users as $usser)
                <option value="{{ $usser->username }}">{{ $usser->username }}</option>
            @endforeach
        </select>
        <button class="button" type="submit"  >return </button>
    </form>

</body>
</html>

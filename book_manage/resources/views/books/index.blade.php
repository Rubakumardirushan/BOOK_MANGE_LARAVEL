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
            margin-bottom: 20px;
        }

        a.button, button.button {
            background-color: #007BFF;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 5px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            background-color: white;
            margin-bottom: 20px;
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

        select, input {
            padding: 8px;
            border-radius: 5px;
            margin: 5px;
        }

        form {
            margin-bottom: 20px;
        }

        .alert {
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            margin-bottom: 15px;
        }

    </style>
</head>
<body>
    <h1>Book List</h1>

    @if (session('success'))
        <div class="alert">
            {{ session('success') }}
        </div>
    @endif

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
                <td>{{ $book->price }}/=</td>
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
    <i>{{ session('msg_update') }}</i>

    <h3>Issuance</h3>
    <form method="post" action="/books/decrease">
        @csrf
        <select name="bookTitle">
            @foreach ($books as $book)
                <option value="{{ $book->title }}">{{ $book->title }}</option>
            @endforeach
        </select>
        <input type="text" name="username" placeholder="Enter username">
        <button class="button" type="submit">Issuance</button>
    </form>



    <h3>Return</h3>
    <form method="post" action="/books/returnbook">
        @csrf
        <select name="bookTitle">
            @foreach ($users as $user)
                <option value="{{ $user->book_title }}">{{ $user->book_title }}</option>
            @endforeach
        </select>
        <select name="userTitle">
            @foreach ($users as $user)
                <option value="{{ $user->username }}">{{ $user->username }}</option>
            @endforeach
        </select>
        <button class="button" type="submit">Return</button>
    </form>
<i><h3 style="color: red"><?=session('dirushan')?></h3></i>
<i><h3 style="color: red">{{ session('show') }}</h3></i>
<I><H3 style="color: red"> <?=session('error')?></H3></I>
</body>
</html>

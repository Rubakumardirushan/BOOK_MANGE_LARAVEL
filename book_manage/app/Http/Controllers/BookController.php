<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Book;
use App\Models\Issuance;
class BookController extends Controller
{


public function index()
{
    $books = Book::all();
    return view('books.index', compact('books'));
}

public function create()
{
    return view('books.create');
}

public function store(Request $request)
{
    $request->validate([
        'title' => 'required',
        'author' => 'required',
        'price' => 'required|numeric',
        'stock' => 'required|integer',
    ]);

    Book::create($request->all());

    return redirect('/books');
}

public function returnbook(Request $request){
    $bookTitle = $request->input('bookTitle');
    $book = Book::where('title', $bookTitle)->first();
    $book->stock += 1;
    $book->save();
    return redirect('/books');

}




public function decrease(Request $request)
{
    // Validate the request data if needed
    $request->validate([
        'bookTitle' => 'required',
        'username' => 'required',
    ]);

    // Get the data from the request
    $bookTitle = $request->input('bookTitle');
    $username = $request->input('username');

    // Create a new Issuance record and save it to the database
    $issuance = new Issuance();
    $issuance->book_title= $bookTitle;
    $issuance->username = $username;
    $issuance->save();


    $book = Book::where('title', $bookTitle)->first();




    if ($book->stock <= 0) {
        return redirect()->route('books.index')->with('error', 'Book is out of stock');
    }


    $book->stock -= 1;
    $book->save();



    return redirect('/books');
}





public function edit(Book $book)
{
    return view('books.edit', compact('book'));
}

public function update(Request $request, Book $book)
{
    $request->validate([
        'title' => 'required',
        'author' => 'required',
        'price' => 'required|numeric',
        'stock' => 'required|integer',
    ]);

    $book->update($request->all());

    return redirect('/books');
}


public function destroy(Book $book)
{
    $book->delete();
    return redirect()->route('books.index')->with('success', 'Book deleted successfully');
}


}

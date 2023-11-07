<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Book;
use App\Models\Issuance;
class BookController extends Controller
{


public function index()
{
    $books = Book::all();
    $users= Issuance::all();
    return view('books.index', compact('books','users'));
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

    $books = Book::all();
    foreach ($books as $book) {
        $title = $book->title;
        if ( $title === $request->input('title')) {

            return redirect('/books/create')->with('error',$title.'  book already add in table ');
        } else {

        }
    }
    Book::create($request->all());

    return redirect('/books');
}






public function returnbook(Request $request){
    $bookTitle = $request->input('bookTitle');
    $book = Book::where('title', $bookTitle)->first();


    $userTitle = $request->input('userTitle');
    if($bookTitle!=null && $userTitle!=null){
        $book->stock += 1;
        $book->save();
    }


    $issuanceRecord=Issuance::where('book_title', $bookTitle)->where('username', $userTitle)->first();

    if($issuanceRecord!=null){
    $issuanceRecord->delete();}else{
        $book->stock -= 1;
        $book->save();
        return redirect('/books')->with('dirushan',$userTitle.' not take '.$bookTitle.'  book');
    }

    return redirect('/books');

}










public function decrease(Request $request)
{

    $request->validate([
        'bookTitle' => 'required',
        'username' => 'required',
    ]);


    $bookTitle = $request->input('bookTitle');
    $username = $request->input('username');

    $book = Book::where('title', $bookTitle)->first();
    $issuance = new Issuance();
    $issuance->book_title= $bookTitle;
    $issuance->username = $username;

    if($book->stock>0){
        $issuance->save();
      }






    if ($book->stock <= 0) {
        return redirect('/books')->with('error', '  '.$bookTitle.' is out of stock');
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

  //  $book->update($request->all());
  $book->author = $request->input('author');
$book->price = $request->input('price');
$book->stock = $request->input('stock');
$book->save();

    return redirect('/books')->with('msg_update','you cannot update title   '  .$book->title);
}






public function destroy(Book $book)
{
    $issus = Issuance::all();
    foreach ($issus as $diru) {
        $title = $diru->book_title;
        if ( $title === $book->title) {

           return redirect('/books')->with('show','you cannot delete '.$book->title.'  book  ');
        } else {

        }
    }








    $book->delete();
    return redirect('/books');
}


}

<?php

namespace App\Http\Controllers\Api\Books;

use App\Http\Controllers\Controller;
use App\Models\Books;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BooksController extends Controller
{
  function __construct()
  {
    $this->middleware('auth:sanctum');
  }

  public function getBooks()
  {
    $books = Books::where('active', 1)->orderBy('id')->get();
    return response()->json($books);
  }

  public function getBook(Request $request)
  {
    $book = Books::where(['active' => 1, 'id' => $request->id])->orderby('id')->first();
    if($book == null){
      return response()->json(['error' => 'No se encontró el libro']);
    }
    return response()->json($book);
  }

  public function createBook(Request $request)
  {
    $data = $request->all();
    $validator = Validator::make($request->all(), [
      'isbn' => 'required|unique:books|max:100',
      'title' => 'required',
      'author' => 'required',
      'price' => 'required',
      'publication_date' => 'required',
      'gender_id' => 'required'
    ]);
    if ($validator->fails()) {
      return response()->json($validator->errors());
    }
    $book = new Books();
    $book->isbn = $data['isbn'];
    $book->title = $data['title'];
    $book->author = $data['author'];
    $book->price = $data['price'];
    $book->publication_date = $data['publication_date'];
    $book->gender_id = $data['gender_id'];
    $book->save();
    return response()->json($book);
  }
  public function updateBook(Request $request)
  {
    $data = $request->all();
    $validator = Validator::make($request->all(), [
      'id' => 'required',
    ]);
    if ($validator->fails()) {
      return response()->json($validator->errors());
    }
    $book = Books::where(['active' => 1, 'id' => $data['id']])->first();
    if($book == null){
      return response()->json(['error' => 'No se encontró el libro']);
    }

    $book->isbn = $data['isbn'] ?? $book->isbn;
    $book->title = $data['title'] ?? $book->title;
    $book->author = $data['author'] ?? $book->author;
    $book->price = $data['price'] ?? $book->price;
    $book->publication_date = $data['publication_date'] ?? $book->publication_date;
    $book->gender_id = $data['gender_id'] ?? $book->gender_id;
    $book->save();
    return response()->json($book);
  }
  public function deleteBook(Request $request)
  {
    $data = $request->all();
    $book = Books::where(['active' => 1, 'id' => $data['id']])->first();
    if($book == null){
      return response()->json(['error' => 'No se encontró el libro']);
    }
    $book->active = 0;
    $book->save();
    return response()->json($book);
  }
}

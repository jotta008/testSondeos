<?php

namespace App\Http\Controllers\Books;

use App\Http\Controllers\Controller;
use App\Models\Books;
use App\Models\Genders;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $books = Books::where(['active' => 1])->orderby('id')->paginate(5);
        return view('books.index', compact('books'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }


    public function create()
    {
        $genders = Genders::where(['active' => 1])->orderby('id')->get();
        return view('books.create', compact('genders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'isbn' => 'required',
            'title' => 'required',
            'author' => 'required',
            'price' => 'required',
            'publication_date' => 'required',
            'gender_id' => 'required'
        ]);

        Books::create($request->all());

        return redirect()->route('books.index')
            ->with('success', 'Libro creado correctamente');
    }


    public function show(Books $book)
    {
        return view('books.view', compact('book'));
    }


    public function edit(Books $book)
    {
        $genders = Genders::where(['active' => 1])->orderby('id')->get();
        return view('books.edit', compact('book', 'genders'));
    }


    public function update(Request $request, Books $book)
    {
        $request->validate([
            'isbn' => 'required',
            'title' => 'required',
            'author' => 'required',
            'price' => 'required',
            'publication_date' => 'required',
            'gender_id' => 'required'
        ]);

        $book->update($request->all());

        return redirect()->route('books.index')
            ->with('success', 'Libro actualizado correctamente');
    }


    public function destroy(Books $book)
    {
        // $book->update(['active' => 0]);
        return redirect()->route('books.index')
            ->with('success', 'Libro eliminado correctamente');
    }
}

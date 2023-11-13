<?php

namespace App\Http\Controllers;

use App\Models\BackupDatabase;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LibraryIndexController extends Controller
{
    public function index(Request $request)
    {
        $this->searchTerm = $request->search ?: false;
        $this->categoryId = $request->category ?: false;


        $allCategories = DB::table('book_categories')->get();
        $books = null;

        if ($this->searchTerm) {
            $books = Book::where('title', 'LIKE', "%{$this->searchTerm}%")->orWhere('subtitle', 'LIKE', "%{$this->searchTerm}%")->orWhere('author', 'LIKE', "%{$this->searchTerm}%")->paginate(15);
        } else if ($this->categoryId) {
            $books = Book::where('category_id', $this->categoryId)->paginate(15);
        } else {
            $books = Book::paginate(15);
        }

        return view('library.index', [
            'books' => $books,
            'allCategories' => $allCategories,
        ]);

    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ]);
        $book = new Book;
        $book->title = $request->title;
        $book->author = $request->author;
        $book->subtitle = $request->subtitle;
        $book->category_id = $request->category_id;
        $book->save();
        return redirect()->route('library.index')
        ->with('success', $book->title . ' Has Been Created successfully');
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Reading  $Reading
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id)
    {
        BackupDatabase::backup();
        $request->validate([
            'title' => 'required',
        ]);
        $book = Book::find($id);
        $book->title = $request->title;
        $book->author = $request->author;
        $book->subtitle = $request->subtitle;
        $book->category_id = $request->category_id;
        $book->save();
        return redirect()->route('library.index')
        ->with('success', $book->title . ' Has Been updated successfully');
    }

   /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Book  $book
    * @return \Illuminate\Http\Response
    */
    public function destroy(Book $book, $id)
    {
        BackupDatabase::backup();
        $book = Book::find($id);
        $book->delete();
        return redirect()->route('library.index')
        ->with('success', $book->title . 'has been successfully deleted');
    }

}

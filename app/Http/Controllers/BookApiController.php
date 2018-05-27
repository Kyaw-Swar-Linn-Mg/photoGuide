<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookApiController extends Controller
{
    public function index()
    {
        $books= Book::paginate(5);

        foreach ($books as $book)
        {
            $book->cover_photo = url('/book_cover/'.$book->cover_photo);
        }
        return response()->json($books);

    }
}
